<?php

defined('MOODLE_INTERNAL') || die();

require_once(__DIR__ . '/lib.php');

$THEME->name = 'wandernurse';
$THEME->sheets = [];
$THEME->editor_sheets = [];
$THEME->editor_scss = ['editor'];
$THEME->usefallback = true;
$THEME->scss = function($theme) {
    return theme_boost_get_main_scss_content($theme);
};

$THEME->parents = ['boost'];

$THEME->layouts = [

    // Custom homepage layout
    'frontpage' => array(
        'file' => 'homepage.php',
      'regions' => array('side-pre'),
    'defaultregion' => 'side-pre',
    'options' => array('nonavbar' => true),
    ),
];
