<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Course renderer.
 *
 * @package    theme_wandernurse
 * @copyright  2022 Willian Mano {@link https://conecti.me}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_wandernurse\output\core;

use html_writer;
use coursecat_helper;
use stdClass;
use core_course_list_element;
use theme_wandernurse\util\course;
use moodle_url;

/**
 * Renderers to align wandernurse's course elements to what is expect
 *
 * @package    theme_wandernurse
 * @copyright  2022 Willian Mano {@link https://conecti.me}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class course_renderer extends \core_course_renderer {

    /**
     * Displays one course in the list of courses.
     *
     * This is an internal function, to display an information about just one course
     * please use core_course_renderer::course_info_box()
     *
     * @param coursecat_helper $chelper various display options
     * @param core_course_list_element|stdClass $course
     * @param string $additionalclasses additional classes to add to the main <div> tag (usually
     *    depend on the course position in list - first/last/even/odd)
     * @return string
     *
     * @throws \coding_exception
     * @throws \dml_exception
     * @throws \moodle_exception
     */
    protected function coursecat_coursebox(coursecat_helper $chelper, $course, $additionalclasses = '') {
        if (!isset($this->strings->summary)) {
            $this->strings->summary = get_string('summary');
        }

        if ($chelper->get_show_courses() <= self::COURSECAT_SHOW_COURSES_COUNT) {
            return '';
        }

        if ($course instanceof stdClass) {
            $course = new core_course_list_element($course);
        }

        return $this->coursecat_coursebox_content($chelper, $course);
    }

    /**
     * Returns HTML to display course content (summary, course contacts and optionally category name)
     *
     * This method is called from coursecat_coursebox() and may be re-used in AJAX
     *
     * @param coursecat_helper $chelper various display options
     * @param stdClass|core_course_list_element $course
     *
     * @return string
     *
     * @throws \coding_exception
     * @throws \dml_exception
     * @throws \moodle_exception
     */
    protected function coursecat_coursebox_content(coursecat_helper $chelper, $course) {
        if ($course instanceof stdClass) {
            $course = new core_course_list_element($course);
        }

        $courseutil = new course($course);

        $coursecontacts = $courseutil->get_course_contacts();

        $courseenrolmenticons = $courseutil->get_enrolment_icons();
        $courseenrolmenticons = !empty($courseenrolmenticons) ? $this->render_enrolment_icons($courseenrolmenticons) : false;

        $courseprogress = $courseutil->get_progress();
        $hasprogress = $courseprogress != null;

        $data = [
            'id' => $course->id,
            'fullname' => $chelper->get_course_formatted_name($course),
            'visible' => $course->visible,
            'image' => $courseutil->get_summary_image(),
            'summary' => $courseutil->get_summary($chelper),
            'category' => $courseutil->get_category(),
            'customfields' => $courseutil->get_custom_fields(),
            'hasprogress' => $hasprogress,
            'progress' => (int) $courseprogress,
            'hasenrolmenticons' => $courseenrolmenticons != false,
            'enrolmenticons' => $courseenrolmenticons,
            'hascontacts' => !empty($coursecontacts),
            'contacts' => $coursecontacts,
            'courseurl' => $this->get_course_url($course->id),
        ];

        return $this->render_from_template('theme_wandernurse/coursecard', $data);
    }

    /**
     * Returns enrolment icons
     *
     * @param array $icons
     *
     * @return array
     */
    protected function render_enrolment_icons(array $icons): array {
        $data = [];

        foreach ($icons as $icon) {
            $data[] = $this->render($icon);
        }

        return $data;
    }

    /**
     * Returns the course URL based on some criterias.
     *
     * @param int $courseid
     *
     * @return moodle_url
     * @throws \moodle_exception
     */
    private function get_course_url($courseid) {
        if (class_exists('\local_course\output\index')) {
            return new moodle_url('/local/course/index.php', ['id' => $courseid]);
        }

        return new moodle_url('/course/view.php', ['id' => $courseid]);
    }

    protected function coursecat_tree(coursecat_helper $chelper, $coursecat) {
        // Reset the category expanded flag for this course category tree first.
        $this->categoryexpandedonload =true;
        $categorycontent = $this->coursecat_category_content($chelper, $coursecat, 0);
        if (empty($categorycontent)) {
            return '';
        }

        // Start content generation
        $content = '';
        $attributes = $chelper->get_and_erase_attributes('course_category_tree clearfix');
        $content .= html_writer::start_tag('div', $attributes);
        $content .= html_writer::tag('div', $categorycontent, array('class' => 'content'));
        $content .= html_writer::end_tag('div'); // .course_category_tree

        return $content;
    }

    protected function coursecat_category(coursecat_helper $chelper, $coursecat, $depth) {
        // open category tag
        $classes = array('category');
        if (empty($coursecat->visible)) {
            $classes[] = 'dimmed_category';
        }
        if (false && $chelper->get_subcat_depth() > 0 && $depth >= $chelper->get_subcat_depth()) {
            // do not load content
            $categorycontent = '';
            $classes[] = 'notloaded';
            if ($coursecat->get_children_count() ||
                    ($chelper->get_show_courses() >= self::COURSECAT_SHOW_COURSES_COLLAPSED && $coursecat->get_courses_count())) {
                $classes[] = 'with_children';
                $classes[] = 'collapsed';
            }
        } else {
            // load category content
            $categorycontent = $this->coursecat_category_content($chelper, $coursecat, $depth);
            $classes[] = 'loaded';
            if (!empty($categorycontent)) {
                $classes[] = 'with_children';
                // Category content loaded with children.
                $this->categoryexpandedonload = true;
            }
        }
        // Make sure JS file to expand category content is included.
        $this->coursecat_include_js();
        $content = html_writer::start_tag('div', array(
            'class' => join(' ', $classes),
            'data-categoryid' => $coursecat->id,
            'data-depth' => $depth,
            'data-showcourses' => $chelper->get_show_courses(),
            'data-type' => self::COURSECAT_TYPE_CATEGORY,
        ));
        // category name
        $categoryname = $coursecat->get_formatted_name();
        $categoryname = html_writer::link(new moodle_url('/course/index.php',
                array('categoryid' => $coursecat->id)),
                $categoryname);
        if ($chelper->get_show_courses() == self::COURSECAT_SHOW_COURSES_COUNT
                && ($coursescount = $coursecat->get_courses_count())) {
            $categoryname .= html_writer::tag('span', ' ('. $coursescount.')',
                    array('title' => get_string('numberofcourses'), 'class' => 'numberofcourse'));
        }
        $content .= html_writer::start_tag('div', array('class' => 'info'));
        $content .= html_writer::tag(($depth > 1) ? 'h4' : 'h3', $categoryname, array('class' => 'categoryname aabtn'));
        $content .= html_writer::end_tag('div'); // .info
        // add category content to the output
        $content .= html_writer::tag('div', $categorycontent, array('class' => 'content'));
        $content .= html_writer::end_tag('div'); // .category
        // Return the course category tree HTML
        return $content;
    }
    public function course_category($category) {
        global $CFG;
        $usertop = \core_course_category::user_top();
        if (empty($category)) {
            $coursecat = $usertop;
        } else if (is_object($category) && $category instanceof \core_course_category) {
            $coursecat = $category;
        } else {
            $coursecat = \core_course_category::get(is_object($category) ? $category->id : $category);
        }
        $site = get_site();
        $actionbar = new \core_course\output\category_action_bar($this->page, $coursecat);
        $output = $this->render_from_template('core_course/category_actionbar', $actionbar->export_for_template($this));

        if (\core_course_category::is_simple_site()) {
            // There is only one category in the system, do not display link to it.
            $strfulllistofcourses = get_string('fulllistofcourses');
            $this->page->set_title($strfulllistofcourses);
        } else if (!$coursecat->id || !$coursecat->is_uservisible()) {
            $strcategories = get_string('categories');
            $this->page->set_title($strcategories);
        } else {
            $strfulllistofcourses = get_string('fulllistofcourses');
            $this->page->set_title($strfulllistofcourses);
        }

        // Print current category description
        $chelper = new coursecat_helper();
        if ($description = $chelper->get_category_formatted_description($coursecat)) {
            $output .= $this->box($description, array('class' => 'generalbox info'));
        }

        // Prepare parameters for courses and categories lists in the tree
        $chelper->set_show_courses(self::COURSECAT_SHOW_COURSES_AUTO)
                ->set_attributes(array('class' => 'category-browse category-browse-'.$coursecat->id));

        $coursedisplayoptions = array();
        $catdisplayoptions = array();
        $browse = optional_param('browse', null, PARAM_ALPHA);
        $perpage = optional_param('perpage', $CFG->coursesperpage, PARAM_INT);
        $page = optional_param('page', 0, PARAM_INT);
        $baseurl = new moodle_url('/course/index.php');
        if ($coursecat->id) {
            $baseurl->param('categoryid', $coursecat->id);
        }
        if ($perpage != $CFG->coursesperpage) {
            $baseurl->param('perpage', $perpage);
        }
        $coursedisplayoptions['limit'] = $perpage;
        $catdisplayoptions['limit'] = $perpage;
        if ($browse === 'courses' || !$coursecat->get_children_count()) {
            $coursedisplayoptions['offset'] = $page * $perpage;
            $coursedisplayoptions['paginationurl'] = new moodle_url($baseurl, array('browse' => 'courses'));
            $catdisplayoptions['nodisplay'] = true;
            $catdisplayoptions['viewmoreurl'] = new moodle_url($baseurl, array('browse' => 'categories'));
            $catdisplayoptions['viewmoretext'] = new \lang_string('viewallsubcategories');
        } else if ($browse === 'categories' || !$coursecat->get_courses_count()) {
            $coursedisplayoptions['nodisplay'] = false;
            $catdisplayoptions['offset'] = $page * $perpage;
            $catdisplayoptions['paginationurl'] = new moodle_url($baseurl, array('browse' => 'categories'));
            $coursedisplayoptions['viewmoreurl'] = new moodle_url($baseurl, array('browse' => 'courses'));
            $coursedisplayoptions['viewmoretext'] = new \lang_string('viewallcourses');
        } else {
            // we have a category that has both subcategories and courses, display pagination separately
            $coursedisplayoptions['viewmoreurl'] = new moodle_url($baseurl, array('browse' => 'courses', 'page' => 1));
            $catdisplayoptions['viewmoreurl'] = new moodle_url($baseurl, array('browse' => 'categories', 'page' => 1));
        }
        $chelper->set_courses_display_options($coursedisplayoptions)->set_categories_display_options($catdisplayoptions);

        // Display course category tree.
        $output .= $this->coursecat_tree($chelper, $coursecat);

        return $output;
    }
}
