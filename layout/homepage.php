<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at my option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * A drawer based layout for the boost theme.
 *
 * @package   theme_boost
 * @copyright 2021 Bas Brands
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/behat/lib.php');
require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->libdir . '/filelib.php');


// Add block button in editing mode.
$addblockbutton = $OUTPUT->addblockbutton();

if (isloggedin()) {
    $courseindexopen = (get_user_preferences('drawer-open-index', true) == true);
    $blockdraweropen = (get_user_preferences('drawer-open-block') == true);
} else {
    $courseindexopen = false;
    $blockdraweropen = false;
}

if (defined('BEHAT_SITE_RUNNING') && get_user_preferences('behat_keep_drawer_closed') != 1) {
    $blockdraweropen = true;
}

$extraclasses = ['uses-drawers'];
if ($courseindexopen) {
    $extraclasses[] = 'drawer-open-index';
}

$blockshtml = $OUTPUT->blocks('side-pre');
$hasblocks = (strpos($blockshtml, 'data-block=') !== false || !empty($addblockbutton));
if (!$hasblocks) {
    $blockdraweropen = false;
}
$courseindex = core_course_drawer();
if (!$courseindex) {
    $courseindexopen = false;
}

$bodyattributes = $OUTPUT->body_attributes($extraclasses);
// $forceblockdraweropen = $OUTPUT->firstview_fakeblocks();

$secondarynavigation = false;
$overflow = '';
if ($PAGE->has_secondary_navigation()) {
    $tablistnav = $PAGE->has_tablist_secondary_navigation();
    $moremenu = new \core\navigation\output\more_menu($PAGE->secondarynav, 'nav-tabs', true, $tablistnav);
    $secondarynavigation = $moremenu->export_for_template($OUTPUT);
    $overflowdata = $PAGE->secondarynav->get_overflow_menu_data();
    if (!is_null($overflowdata)) {
        $overflow = $overflowdata->export_for_template($OUTPUT);
    }
}


$primary = new core\navigation\output\primary($PAGE);
$renderer = $PAGE->get_renderer('core');
$primarymenu = $primary->export_for_template($renderer);
$buildregionmainsettings = !$PAGE->include_region_main_settings_in_header_actions() && !$PAGE->has_secondary_navigation();
// If the settings menu will be included in the header then don't add it here.
$regionmainsettingsmenu = $buildregionmainsettings ? $OUTPUT->region_main_settings_menu() : false;
$header = $PAGE->activityheader;



// Fetching all theme settings related to the hero section and storing them in an associative array.
$hero = [
    'title'       => get_config('theme_wandernurse', 'hero_title'),
    'subtitle'    => get_config('theme_wandernurse', 'hero_subtitle'),
    'description' => get_config('theme_wandernurse', 'hero_description'),
    'addbutton'   => get_config('theme_wandernurse', 'addbutton'),
];

// If the addbutton setting is enabled, fetch the button text.
if ($hero['addbutton']) {
    $hero['button1_text'] = get_config('theme_wandernurse', 'button1_text');
    $hero['button2_text'] = get_config('theme_wandernurse', 'button2_text');
}


$enablefeatures = get_config('theme_wandernurse', 'enablefeatures');

// Initialize an empty array for features.
$features = [];

// If 'enablefeatures' is enabled, fetch the feature-related settings.
if ($enablefeatures) {
    // Fetch the features heading.
    $features['heading'] = get_config('theme_wandernurse', 'features_heading');
    
    // Fetch the number of features.
    $number_of_features = get_config('theme_wandernurse', 'number_of_features');
    
    // Loop through the number of features and fetch each feature's settings.
    if ($number_of_features > 0) {
        for ($i = 1; $i <= $number_of_features; $i++) {
            // Fetch each feature's title, icon, and description.
            $features['list'][] = [
                'title' => get_config('theme_wandernurse', "featuretitle_$i"),
                'icon'  => get_config('theme_wandernurse', "foricon_$i"),
                'description' => get_config('theme_wandernurse', "featuredescription_$i")
            ];
        }
    }
}

$aboutsection = get_config('theme_wandernurse', 'aboutsection');
$about = [];
    $about['heading'] = get_config('theme_wandernurse', 'about_heading');
    $about['heading_description'] = get_config('theme_wandernurse', 'aboutheading_desc');


    $servicesection = get_config('theme_wandernurse', 'servicesection');
$services = [];

    $services['heading'] = get_config('theme_wandernurse', 'service_heading');
    $services['heading_description'] = get_config('theme_wandernurse', 'serviceheading_desc');
    $number_of_services = get_config('theme_wandernurse', 'number_of_services');
    
    if ($number_of_services > 0) {
        for ($i = 1; $i <= $number_of_services; $i++) {
            $services['items'][] =
          [ 
           'title' => get_config('theme_wandernurse', "servicestitle_$i"),
           'description'=> get_config('theme_wandernurse', "servicesdescription_$i"),
           'image' => $PAGE->theme->setting_file_url("service_image_$i", "service_image_$i"), 
          ];
        }
    }


    $whyussection = get_config('theme_wandernurse', 'whyussection');
    $whyus = [];
    $number_of_answers = get_config('theme_wandernurse', 'number_of_answers');
    if ($number_of_answers > 0) {
        for ($i = 1; $i <= $number_of_answers; $i++) {
            // Fetch the title, description, and icon for each answer.
            $whyus['items'][] = [
                'title' => get_config('theme_wandernurse', "answertitle_$i"),
                'description' => get_config('theme_wandernurse', "answerdescription_$i"),
                'icon' => get_config('theme_wandernurse', "answerforicon_$i"),
            ];
        }
    }

    $ourprogramssection = get_config('theme_wandernurse', 'ourprogramssection');
$programs = [];
    for ($i = 1; $i <= 2; $i++) {
        $programs['items'][] = [
            'title' => get_config('theme_wandernurse', "programtitle_$i"),
            'description' => get_config('theme_wandernurse', "programdescription_$i")
        ];
    }

    if (isloggedin()){
        $render_primarynav=true;
    }else{
        $render_primarynav=false;
    }



$templatecontext = [
    'primarynav'=>$render_primarynav,
    'hasprograms'=>$ourprogramssection,
    'ourprograms'=>$programs,
    'haswhyus'=>$whyussection,
    'whyus'=>$whyus,
    'hasservices'=>$servicesection,
    'services'=>$services,
    'hasabout'=>$aboutsection,
    'about'=>$about,
    'features'=>$features,
    'hasfeatures'=>$enablefeatures,
    'hero'=>$hero,
    'sitename' => format_string($SITE->shortname, true, ['context' => context_course::instance(SITEID), "escape" => false]),
    'output' => $OUTPUT,
    'sidepreblocks' => $blockshtml,
    'hasblocks' => $hasblocks,
    'bodyattributes' => $bodyattributes,
    'courseindexopen' => $courseindexopen,
    'blockdraweropen' => $blockdraweropen,
    'courseindex' => $courseindex,
    'primarymoremenu' => $primarymenu['moremenu'],
    'secondarymoremenu' => $secondarynavigation ?: false,
    'mobileprimarynav' => $primarymenu['mobileprimarynav'],
    'usermenu' => $primarymenu['user'],
    'langmenu' => $primarymenu['lang'],
    // 'forceblockdraweropen' => $forceblockdraweropen,
    'regionmainsettingsmenu' => $regionmainsettingsmenu,
    'hasregionmainsettingsmenu' => !empty($regionmainsettingsmenu),
    'overflow' => $overflow,
    'addblockbutton' => $addblockbutton
];

echo $OUTPUT->render_from_template('theme_wandernurse/homepage', $templatecontext);
