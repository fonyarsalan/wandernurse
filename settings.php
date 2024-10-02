<?php

// Every file should have GPL and copyright in the header - we skip it in tutorials but you should not skip it for real.

// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die();

// This is used for performance, we don't need to know about these settings on every page in Moodle, only when
// we are looking at the admin settings pages.
if ($ADMIN->fulltree) {
<<<<<<< HEAD
    
}
=======

    // Boost provides a nice setting page which splits settings onto separate tabs. We want to use it here.
    $settings = new theme_boost_admin_settingspage_tabs('themesettingwandernurse', get_string('configtitle', 'theme_wandernurse'));

    // Each page is a tab - the first is the "General" tab.
    $page = new admin_settingpage('theme_wandernurse_general', get_string('generalsettings', 'theme_wandernurse'));

    // Replicate the preset setting from boost.
    $name = 'theme_wandernurse/preset';
    $title = get_string('preset', 'theme_wandernurse');
    $description = get_string('preset_desc', 'theme_wandernurse');
    $default = 'default.scss';

    // We list files in our own file area to add to the drop down. We will provide our own function to
    // load all the presets from the correct paths.
    $context = context_system::instance();
    $fs = get_file_storage();
    $files = $fs->get_area_files($context->id, 'theme_wandernurse', 'preset', 0, 'itemid, filepath, filename', false);

    $choices = [];
    foreach ($files as $file) {
        $choices[$file->get_filename()] = $file->get_filename();
    }
    // These are the built in presets from Boost.
    $choices['default.scss'] = 'default.scss';
    $choices['plain.scss'] = 'plain.scss';

    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Preset files setting.
    $name = 'theme_wandernurse/presetfiles';
    $title = get_string('presetfiles','theme_wandernurse');
    $description = get_string('presetfiles_desc', 'theme_wandernurse');

    $setting = new admin_setting_configstoredfile($name, $title, $description, 'preset', 0, array('maxfiles' => 20, 'accepted_types' => array('.scss')));
    $page->add($setting);

    // Variable $brand-color.
    // We use an empty default value because the default colour should come from the preset.
    $name = 'theme_wandernurse/brandcolor';
    $title = get_string('brandcolor', 'theme_wandernurse');
    $description = get_string('brandcolor_desc', 'theme_wandernurse');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Must add the page after definiting all the settings!
    $settings->add($page);

    // Advanced settings.
    $page = new admin_settingpage('theme_wandernurse_advanced', get_string('advancedsettings', 'theme_wandernurse'));

    // Raw SCSS to include before the content.
    $setting = new admin_setting_configtextarea('theme_wandernurse/scsspre',get_string('rawscsspre', 'theme_wandernurse'), get_string('rawscsspre_desc', 'theme_wandernurse'), '', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Raw SCSS to include after the content.
    $setting = new admin_setting_configtextarea('theme_wandernurse/scss', get_string('rawscss', 'theme_wandernurse'),get_string('rawscss_desc', 'theme_wandernurse'), '', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    
    ///////////////////////////////////////////
    /////////////FRONTPAGE SETTINGS////////////
    //////////////////////////////////////////




    $page = new admin_settingpage('theme_wandernurse_frontpage', get_string('frontpagesettings', 'theme_wandernurse'));
    
    
    // $name = "theme_wandernurse/backgroundimage";
    // $title = get_string('backgroundimage', 'theme_wandernurse');
    // $description = get_string('backgroundimagedesc', 'theme_wandernurse');
    // $fileid = "background_image";
    // $options = [
    //     'accepted_types' => ['.png', '.jpg', '.jpeg', '.gif', '.webp', '.svg'],
    //     'maxfiles' => 1
    // ];
    // $setting = new admin_setting_configstoredfile($name, $title, $description, $fileid, 0, $options);
    // $setting->set_updatedcallback('theme_reset_all_caches');
    // $page->add($setting);

    $setting = new admin_setting_heading('herosection', 'HERO SECTION', '<hr>');
    $page->add($setting);

    $name = 'theme_wandernurse/hero_title';
    $title = get_string('herotitle', 'theme_wandernurse');
    $description = get_string('herotitledesc', 'theme_wandernurse');
    $setting = new admin_setting_configtext($name, $title, $description, 'default', PARAM_TEXT);
    $page->add($setting);

    $page->add($setting);
    $name = 'theme_wandernurse/hero_subtitle';
    $title = get_string('herosubtitle', 'theme_wandernurse');
    $description = get_string('herosubtitledesc', 'theme_wandernurse');
    $setting = new admin_setting_configtext($name, $title, $description, 'default', PARAM_TEXT);
    $page->add($setting);

    $page->add($setting);
    $name = 'theme_wandernurse/hero_description';
    $title = get_string('herodescription', 'theme_wandernurse');
    $description = get_string('herodescriptiondesc', 'theme_wandernurse');
    $setting = new admin_setting_configtext($name, $title, $description, 'default', PARAM_TEXT);
    $page->add($setting);

    $name = 'theme_wandernurse/addbutton';
    $title = get_string('addbutton', 'theme_wandernurse');
    $description = get_string('addbuttondesc', 'theme_wandernurse');
    $default = 1;
    $choices = [0 => get_string('no'), 1 => get_string('yes')];
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $page->add($setting);

    $addbutton=get_config('theme_wandernurse','addbutton');

    if($addbutton){
    $name = 'theme_wandernurse/button1_text';
    $title = get_string('button1text', 'theme_wandernurse');
    $description = get_string('button1textdesc', 'theme_wandernurse');
    $setting = new admin_setting_configtext($name, $title, $description, 'default', PARAM_TEXT);
    $page->add($setting);

    $name = 'theme_wandernurse/button2_text';
    $title = get_string('button2text', 'theme_wandernurse');
    $description = get_string('button2textdesc', 'theme_wandernurse');
    $setting = new admin_setting_configtext($name, $title, $description, 'default', PARAM_TEXT);
    $page->add($setting);
    }


    $setting = new admin_setting_heading('featuresection', 'FEATURES', '<hr>');
    $page->add($setting);

    $name = 'theme_wandernurse/enablefeatures';
    $title = get_string('enablefeatures', 'theme_wandernurse');
    $description = get_string('enablefeaturesdesc', 'theme_wandernurse');
    $default = 1;
    $choices = [0 => get_string('no'), 1 => get_string('yes')];
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $page->add($setting);

    $enablefeatures=get_config('theme_wandernurse','enablefeatures');

if($enablefeatures){
    $name = 'theme_wandernurse/features_heading';
    $title = get_string('featuresheading', 'theme_wandernurse');
    $description = get_string('featuresheading', 'theme_wandernurse');
    $setting = new admin_setting_configtext($name, $title, $description, 'default', PARAM_TEXT);
    $page->add($setting);

    $name = 'theme_wandernurse/number_of_features';
    $title = get_string('numberoffeatures', 'theme_wandernurse');
    $description = get_string('numberoffeaturesdesc', 'theme_wandernurse');
    $default = 0;
    $choices = array_combine(range(0, 3), range(0, 3)); // Allow users to select between 0 and 10 courses.
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $number_of_features= get_config('theme_wandernurse','number_of_features');
if($number_of_features>0){      
    
    for($i=1;$i<=$number_of_features;$i++){

    $name= "theme_wandernurse/featuretitle_$i";
    $title = get_string('featuretitle', 'theme_wandernurse', $i);
    $description = get_string('featuretitledesc', 'theme_wandernurse', $i);
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $page->add($setting);   

    $name = "theme_wandernurse/foricon_$i";
    $title = get_string('foricon', 'theme_wandernurse',$i);
    $description = get_string('foricondesc', 'theme_wandernurse',$i);
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description,$default);
    $setting->set_updatedcallback('theme_reset_all_caches'); 
    $page->add($setting);

    $name= "theme_wandernurse/featuredescription_$i";
    $title = get_string('featuredescription', 'theme_wandernurse', $i);
    $description = get_string('featuredescriptiondesc', 'theme_wandernurse', $i);
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $page->add($setting); 
    }
  }
}

$setting = new admin_setting_heading('aboutsection', 'ABOUT SECTION', '<hr>');
$page->add($setting);

$name = 'theme_wandernurse/aboutsection';
$title = get_string('aboutsection', 'theme_wandernurse');
$description = get_string('aboutsectiondesc', 'theme_wandernurse');
$default = 1;
$choices = [0 => get_string('no'), 1 => get_string('yes')];
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$page->add($setting);

$aboutsection=get_config('theme_wandernurse','aboutsection');

if($aboutsection){
    $name = 'theme_wandernurse/about_heading';
    $title = get_string('aboutheading', 'theme_wandernurse');
    $description = get_string('aboutheadingdesc', 'theme_wandernurse');
    $setting = new admin_setting_configtext($name, $title, $description, 'default', PARAM_TEXT);
    $page->add($setting);
    
    $name = 'theme_wandernurse/aboutheading_desc';
    $title = get_string('aboutheadingdesc', 'theme_wandernurse');
    $description = get_string('aboutheadingdesc', 'theme_wandernurse');
    $setting = new admin_setting_configtext($name, $title, $description, 'default', PARAM_TEXT);
    $page->add($setting);
}



$setting = new admin_setting_heading('servicesection', 'SERVICE SECTION', '<hr>');
$page->add($setting);

$name = 'theme_wandernurse/servicesection';
$title = get_string('servicesection', 'theme_wandernurse');
$description = get_string('servicesectiondesc', 'theme_wandernurse');
$default = 1;
$choices = [0 => get_string('no'), 1 => get_string('yes')];
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$page->add($setting);

$servicesection=get_config('theme_wandernurse','servicesection');

if($servicesection){
    $name = 'theme_wandernurse/service_heading';
    $title = get_string('serviceheading', 'theme_wandernurse');
    $description = get_string('serviceheadingdesc', 'theme_wandernurse');
    $setting = new admin_setting_configtext($name, $title, $description, 'default', PARAM_TEXT);
    $page->add($setting);
    
    $name = 'theme_wandernurse/serviceheading_desc';
    $title = get_string('serviceheadingdesc', 'theme_wandernurse');
    $description = get_string('serviceheadingdesc', 'theme_wandernurse');
    $setting = new admin_setting_configtext($name, $title, $description, 'default', PARAM_TEXT);
    $page->add($setting);

    $name = 'theme_wandernurse/number_of_services';
    $title = get_string('numberofservices', 'theme_wandernurse');
    $description = get_string('numberofservicesdesc', 'theme_wandernurse');
    $default = 0;
    $choices = array_combine(range(0, 3), range(0, 3)); // Allow users to select between 0 and 10 courses.
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $number_of_services= get_config('theme_wandernurse','number_of_services');
if($number_of_services>0){      
    
    for($i=1;$i<=$number_of_services;$i++){

    $name= "theme_wandernurse/servicestitle_$i";
    $title = get_string('servicestitle', 'theme_wandernurse', $i);
    $description = get_string('servicestitledesc', 'theme_wandernurse', $i);
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $page->add($setting);   

 // service Image
 $name = "theme_wandernurse/service_image_$i";
 $title = get_string('serviceimage', 'theme_wandernurse', $i);
 $description = get_string('serviceimagedesc', 'theme_wandernurse', $i);
 $fileid = "service_image_$i";
 $options = [
     'accepted_types' => ['.png', '.jpg', '.jpeg', '.gif', '.webp', '.svg'],
     'maxfiles' => 1
 ];
 $setting = new admin_setting_configstoredfile($name, $title, $description, $fileid, 0, $options);
 $setting->set_updatedcallback('theme_reset_all_caches');
 $page->add($setting);


    $name= "theme_wandernurse/servicesdescription_$i";
    $title = get_string('servicesdescription', 'theme_wandernurse', $i);
    $description = get_string('servicesdescriptiondesc', 'theme_wandernurse', $i);
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $page->add($setting); 
    }
  }

}


$setting = new admin_setting_heading('whychooseussection', 'WHYCHOOSEUS SECTION', '<hr>');
$page->add($setting);

$name = 'theme_wandernurse/whyussection';
$title = get_string('whyussection', 'theme_wandernurse');
$description = get_string('whyussectiondesc', 'theme_wandernurse');
$default = 1;
$choices = [0 => get_string('no'), 1 => get_string('yes')];
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$page->add($setting);

$whyussection=get_config('theme_wandernurse','whyussection');

if($whyussection){
    $name = 'theme_wandernurse/number_of_answers';
    $title = get_string('numberofanswers', 'theme_wandernurse');
    $description = get_string('numberofanswersdesc', 'theme_wandernurse');
    $default = 0;
    $choices = array_combine(range(0, 3), range(0, 3)); // Allow users to select between 0 and 10 courses.
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $number_of_answers= get_config('theme_wandernurse','number_of_answers');
if($number_of_answers>0){      
    
    for($i=1;$i<=$number_of_answers;$i++){

    $name= "theme_wandernurse/answertitle_$i";
    $title = get_string('answertitle', 'theme_wandernurse', $i);
    $description = get_string('answertitledesc', 'theme_wandernurse', $i);
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $page->add($setting);   

    $name = "theme_wandernurse/answerforicon_$i";
    $title = get_string('answerforicon', 'theme_wandernurse',$i);
    $description = get_string('answerforicondesc', 'theme_wandernurse',$i);
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description,$default);
    $setting->set_updatedcallback('theme_reset_all_caches'); 
    $page->add($setting);

    $name= "theme_wandernurse/answerdescription_$i";
    $title = get_string('answerdescription', 'theme_wandernurse', $i);
    $description = get_string('answerdescriptiondesc', 'theme_wandernurse', $i);
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $page->add($setting); 
    }
  }
}

$setting = new admin_setting_heading('ourprogramssection', 'OUR PROGRAMS SECTION', '<hr>');
$page->add($setting);

$name = 'theme_wandernurse/ourprogramssection';
$title = get_string('ourprogramssection', 'theme_wandernurse');
$description = get_string('ourprogramssectiondesc', 'theme_wandernurse');
$default = 1;
$choices = [0 => get_string('no'), 1 => get_string('yes')];
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$page->add($setting);

$ourprogramssection=get_config('theme_wandernurse','ourprogramssection');

if($ourprogramssection){
    for($i=1;$i<=2;$i++){
        $name= "theme_wandernurse/programtitle_$i";
        $title = get_string('programtitle', 'theme_wandernurse', $i);
        $description = get_string('programtitledesc', 'theme_wandernurse', $i);
        $setting = new admin_setting_configtext($name, $title, $description, '');
        $page->add($setting);   

        $name= "theme_wandernurse/programdescription_$i";
        $title = get_string('programdescription', 'theme_wandernurse', $i);
        $description = get_string('programdescriptiondesc', 'theme_wandernurse', $i);
        $setting = new admin_setting_configtext($name, $title, $description, '');
        $page->add($setting);   
        
    }
}




$setting = new admin_setting_heading('testimonialssection', 'TESTIMONIALS SECTION', '<hr>');
$page->add($setting);

$name = 'theme_wandernurse/testimonialssection';
$title = get_string('testimonialssection', 'theme_wandernurse');
$description = get_string('testimonialssectiondesc', 'theme_wandernurse');
$default = 1;
$choices = [0 => get_string('no'), 1 => get_string('yes')];
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$page->add($setting);

$testimonialssection = get_config('theme_wandernurse', 'testimonialssection');


if ($testimonialssection) {

    $name = 'theme_wandernurse/testimonial_heading';
    $title = get_string('testimonialheading', 'theme_wandernurse');
    $description = get_string('testimonialheadingdesc', 'theme_wandernurse');
    $setting = new admin_setting_configtext($name, $title, $description, 'default', PARAM_TEXT);
    $page->add($setting);

    $name = 'theme_wandernurse/testimonialsub_heading';
    $title = get_string('testimonialsubheading', 'theme_wandernurse');
    $description = get_string('testimonialsubheadingdesc', 'theme_wandernurse');
    $setting = new admin_setting_configtext($name, $title, $description, 'default', PARAM_TEXT);
    $page->add($setting);

    $name = 'theme_wandernurse/number_of_testimonials';
    $title = get_string('numberoftestimonials', 'theme_wandernurse');
    $description = get_string('numberoftestimonialsdesc', 'theme_wandernurse');
    $default = 0;
    $choices = array_combine(range(0, 7), range(0, 7)); // Allow users to select between 0 and 10 courses.
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $number_of_testimonials= get_config('theme_wandernurse','number_of_testimonials');

    if($number_of_testimonials>0){for ($i = 1; $i <= $number_of_testimonials; $i++) {
        $name = "theme_wandernurse/testimonialname_$i";
        $title = get_string('testimonialname', 'theme_wandernurse', $i);
        $description = get_string('testimonialnamedesc', 'theme_wandernurse', $i);
        $setting = new admin_setting_configtext($name, $title, $description, '');
        $page->add($setting);

        $name = "theme_wandernurse/testimonialtext_$i";
        $title = get_string('testimonialtext', 'theme_wandernurse', $i);
        $description = get_string('testimonialtextdesc', 'theme_wandernurse', $i);
        $setting = new admin_setting_configtext($name, $title, $description, '');
        $page->add($setting);

        $name = "theme_wandernurse/testimonialpractice_$i";
        $title = get_string('testimonialpractice', 'theme_wandernurse', $i);
        $description = get_string('testimonialpracticedesc', 'theme_wandernurse', $i);
        $setting = new admin_setting_configtext($name, $title, $description, '');
        $page->add($setting);
        
        $name = "theme_wandernurse/testimonialimage_$i";
        $title = get_string('testimonialimage', 'theme_wandernurse', $i);
        $description = get_string('testimonialimagedesc', 'theme_wandernurse', $i);
        $fileid = "testimonial_image_$i";
        $options = [
            'accepted_types' => ['.png', '.jpg', '.jpeg', '.gif', '.webp', '.svg'],
            'maxfiles' => 1
        ];
        $setting = new admin_setting_configstoredfile($name, $title, $description, $fileid, 0, $options);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $page->add($setting);
    }}
    
}


$setting = new admin_setting_heading('featuredjobssection', 'FEATURED JOBS SECTION', '<hr>');
$page->add($setting);

$name = 'theme_wandernurse/featuredjobssection';
$title = get_string('featuredjobssection', 'theme_wandernurse');
$description = get_string('featuredjobssectiondesc', 'theme_wandernurse');
$default = 1;
$choices = [0 => get_string('no'), 1 => get_string('yes')];
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$page->add($setting);


$setting = new admin_setting_heading('ourresourcessection', 'OUR RESOURCES SECTION', '<hr>');
$page->add($setting);

$name = 'theme_wandernurse/ourresourcessection';
$title = get_string('ourresourcessection', 'theme_wandernurse');
$description = get_string('ourresourcessectiondesc', 'theme_wandernurse');
$default = 1;
$choices = [0 => get_string('no'), 1 => get_string('yes')];
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$page->add($setting);


$resources= get_config('theme_wandernurse','ourresourcessection');

if ($resources){

    $name = "theme_wandernurse/resource_image";
    $title = get_string('resourceimage', 'theme_wandernurse');
    $description = get_string('resourceimagedesc', 'theme_wandernurse');
    $fileid = "resource_image";
    $options = [
        'accepted_types' => ['.png', '.jpg', '.jpeg', '.gif', '.webp', '.svg'],
        'maxfiles' => 1
    ];
    $setting = new admin_setting_configstoredfile($name, $title, $description, $fileid, 0, $options);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $name = 'theme_wandernurse/ourresources_heading';
    $title = get_string('ourresourcesheading', 'theme_wandernurse');
    $description = get_string('ourresourcesheadingdesc', 'theme_wandernurse');
    $setting = new admin_setting_configtext($name, $title, $description, 'default', PARAM_TEXT);
    $page->add($setting);

    
    $name = 'theme_wandernurse/ourresources_description';
    $title = get_string('ourresourcesdescription', 'theme_wandernurse');
    $description = get_string('ourresourcesdescriptiondesc', 'theme_wandernurse');
    $setting = new admin_setting_configtext($name, $title, $description, 'default', PARAM_TEXT);
    $page->add($setting);

}

$setting = new admin_setting_heading('blogpostssection', 'BLOG POSTS SECTION', '<hr>');
$page->add($setting);

$name = 'theme_wandernurse/enableblogposts';
$title = get_string('enableblogposts', 'theme_wandernurse');
$description = get_string('enableblogpostsdesc', 'theme_wandernurse');
$default = 1;
$choices = [0 => get_string('no'), 1 => get_string('yes')];
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$page->add($setting);

$enableblogposts = get_config('theme_wandernurse', 'enableblogposts');

if ($enableblogposts) {
    $name = 'theme_wandernurse/blogposts_heading';
    $title = get_string('blogpostsheading', 'theme_wandernurse');
    $description = get_string('blogpostsheadingdesc', 'theme_wandernurse');
    $setting = new admin_setting_configtext($name, $title, $description, 'default', PARAM_TEXT);
    $page->add($setting);

    $name = 'theme_wandernurse/number_of_blogposts';
    $title = get_string('numberofblogposts', 'theme_wandernurse');
    $description = get_string('numberofblogpostsdesc', 'theme_wandernurse');
    $default = 0;
    $choices = array_combine(range(0, 5), range(0, 5)); // Allow users to select between 0 and 5 blog posts.
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $number_of_blogposts = get_config('theme_wandernurse', 'number_of_blogposts');
    if ($number_of_blogposts > 0) {
        for ($i = 1; $i <= $number_of_blogposts; $i++) {

            $name = "theme_wandernurse/blogposttitle_$i";
            $title = get_string('blogposttitle', 'theme_wandernurse', $i);
            $description = get_string('blogposttitledesc', 'theme_wandernurse', $i);
            $setting = new admin_setting_configtext($name, $title, $description, '');
            $page->add($setting);

            $name = "theme_wandernurse/blogposticon_$i";
            $title = get_string('blogposticon', 'theme_wandernurse', $i);
            $description = get_string('blogposticondesc', 'theme_wandernurse', $i);
            $fileid = "blogposticon_$i";
            $options = [
                'accepted_types' => ['.png', '.jpg', '.jpeg', '.gif', '.webp', '.svg'],
                'maxfiles' => 1
            ];
            $setting = new admin_setting_configstoredfile($name, $title, $description, $fileid, 0, $options);
            $setting->set_updatedcallback('theme_reset_all_caches');
            $page->add($setting);

            $name = "theme_wandernurse/blogpostdescription_$i";
            $title = get_string('blogpostdescription', 'theme_wandernurse', $i);
            $description = get_string('blogpostdescriptiondesc', 'theme_wandernurse', $i);
            $setting = new admin_setting_configtextarea($name, $title, $description, '');
            $page->add($setting);
        }
    }
}

$setting = new admin_setting_heading('contactssection', 'CONTACTS SECTION', '<hr>');
$page->add($setting);

$name = 'theme_wandernurse/enablecontacts';
$title = get_string('enablecontacts', 'theme_wandernurse');
$description = get_string('enablecontactsdesc', 'theme_wandernurse');
$default = 1;
$choices = [0 => get_string('no'), 1 => get_string('yes')];
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$page->add($setting);

$enablecontacts = get_config('theme_wandernurse', 'enablecontacts');

if ($enablecontacts){
    $name = 'theme_wandernurse/contacts_heading';
    $title = get_string('contactsheading', 'theme_wandernurse');
    $description = get_string('contactsheadingdesc', 'theme_wandernurse');
    $setting = new admin_setting_configtext($name, $title, $description, 'GET IN TOUCH', PARAM_TEXT);
    $page->add($setting);
}




$setting = new admin_setting_heading('subscriptionsection', 'SUBSCRIPTION SECTION', '<hr>');
$page->add($setting);

$name = 'theme_wandernurse/enablesubscription';
$title = get_string('enablesubscription', 'theme_wandernurse');
$description = get_string('enablesubscriptiondesc', 'theme_wandernurse');
$default = 1;
$choices = [0 => get_string('no'), 1 => get_string('yes')];
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$page->add($setting);

$enablesubscription = get_config('theme_wandernurse', 'enablesubscription');

if ($enablesubscription) {
    $name = 'theme_wandernurse/subscription_heading';
    $title = get_string('subscriptionheading', 'theme_wandernurse');
    $description = get_string('subscriptionheadingdesc', 'theme_wandernurse');
    $setting = new admin_setting_configtext($name, $title, $description, 'default', PARAM_TEXT);
    $page->add($setting);

    $name = 'theme_wandernurse/subscription_description';
    $title = get_string('subscriptiondescription', 'theme_wandernurse');
    $description = get_string('subscriptiondescriptiondesc', 'theme_wandernurse');
    $setting = new admin_setting_configtextarea($name, $title, $description, 'default');
    $page->add($setting);
}

$setting = new admin_setting_heading('color', 'THEME COLOR', '<hr>');
$page->add($setting);

// Brand Color Setting.









    $settings->add($page);

}
>>>>>>> 576d7ca (MY COMMIT)
