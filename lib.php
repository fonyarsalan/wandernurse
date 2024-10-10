<?php

// Every file should have GPL and copyright in the header - we skip it in tutorials but you should not skip it for real.

// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die();

// We will add callbacks here as we add features to our theme.
function theme_wandernurse_get_main_scss_content($theme) {
    global $CFG;

    $scss = '';
    $filename = !empty($theme->settings->preset) ? $theme->settings->preset : null;
    $fs = get_file_storage();

    $context = context_system::instance();
    if ($filename == 'default.scss') {
        // We still load the default preset files directly from the boost theme. No sense in duplicating them.
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/default.scss');
    } else if ($filename == 'plain.scss') {
        // We still load the default preset files directly from the boost theme. No sense in duplicating them.
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/plain.scss');

    } else if ($filename && ($presetfile = $fs->get_file($context->id, 'theme_wandernurse', 'preset', 0, '/', $filename))) {
        // This preset file was fetched from the file area for theme_wandernurse and not theme_boost (see the line above).
        $scss .= $presetfile->get_content();
    } else {
        // Safety fallback - maybe new installs etc.
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/default.scss');
    }

    // Pre CSS - this is loaded AFTER any prescss from the setting but before the main scss.
    $pre = file_get_contents($CFG->dirroot . '/theme/wandernurse/scss/pre.scss');
    // Post CSS - this is loaded AFTER the main scss but before the extra scss from the setting.
    $post = file_get_contents($CFG->dirroot . '/theme/wandernurse/scss/post.scss');
    // Combine them together.
    return $pre . "\n" . $scss . "\n" . $post;
}

function theme_wandernurse_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = array()) { 
    static $theme; 
    if (empty($theme)) { 
        $theme = theme_config::load('wandernurse'); 
    } 
    if ($context->contextlevel == CONTEXT_SYSTEM) { 
        $number_of_services = get_config('theme_wandernurse', 'number_of_services');
        if ($filearea === 'backgroundimage') { 
            return $theme->setting_file_serve('backgroundimage', $args, $forcedownload, $options); 
        }
        if($number_of_services > 0) {
            for ($i = 1; $i <= $number_of_services; $i++) {
                if ($filearea === "service_image_$i") { 
                    return $theme->setting_file_serve("service_image_$i", $args, $forcedownload, $options); 
                }
            }
        }


    } else { 
        send_file_not_found(); 
    }
}

function theme_wandernurse_get_extra_scss($theme) {
    $content = '';

    // Fetch the brand color from the theme settings.
    $brandcolor = get_config('theme_wandernurse', 'primarycolor'); // Use the correct theme name.

    // If brand color exists, add it to SCSS.
    if (!empty($brandcolor)) {
        $content .= '$primary: ' . $brandcolor . ';';
    }

    // If there are additional SCSS settings, append them.
    if (!empty($theme->settings->scss)) {
        $content .= "\n" . $theme->settings->scss;
    }

    return $content;
}
