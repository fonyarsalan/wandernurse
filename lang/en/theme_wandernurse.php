<?php
// Every file should have GPL and copyright in the header - we skip it in tutorials but you should not skip it for real.

// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die();

// A description shown in the admin theme selector.
$string['choosereadme'] = 'Theme wandernurse is a child theme of Boost. It adds the ability to upload background photos.';
// The name of our plugin.
$string['pluginname'] = 'wandernurse theme';
// We need to include a lang string for each block region.
$string['region-side-pre'] = 'Right';
// The name of the second tab in the theme settings.
$string['advancedsettings'] = 'Advanced settings';
// The brand colour setting.
$string['brandcolor'] = 'Brand colour';
// The brand colour setting description.
$string['brandcolor_desc'] = 'The accent colour.';
// Name of the settings pages.
$string['configtitle'] = 'wandernurse settings';
// Name of the first settings tab.
$string['generalsettings'] = 'General settings';
// Preset files setting.
$string['presetfiles'] = 'Additional theme preset files';
// Preset files help text.
$string['presetfiles_desc'] = 'Preset files can be used to dramatically alter the appearance of the theme. See <a href=https://docs.moodle.org/dev/Boost_Presets>Boost presets</a> for information on creating and sharing your own preset files, and see the <a href=http://moodle.net/boost>Presets repository</a> for presets that others have shared.';
// Preset setting.
$string['preset'] = 'Theme preset';
// Preset help text.
$string['preset_desc'] = 'Pick a preset to broadly change the look of the theme.';
// Raw SCSS setting.
$string['rawscss'] = 'Raw SCSS';
// Raw SCSS setting help text.
$string['rawscss_desc'] = 'Use this field to provide SCSS or CSS code which will be injected at the end of the style sheet.';
// Raw initial SCSS setting.
$string['rawscsspre'] = 'Raw initial SCSS';
// Raw initial SCSS setting help text.
$string['rawscsspre_desc'] = 'In this field you can provide initialising SCSS code, it will be injected before everything else. Most of the time you will use this setting to define variables.';

$string['frontpagesettings']='Frontpage';
$string['backgroundimage']='Add a background image';
$string['backgroundimagedesc']='Background Image for the hero section';



$string['herotitle'] = 'Hero Title';
$string['herotitledesc'] = 'Enter the title for the Hero section.';

$string['herosubtitle'] = 'Hero Subtitle';
$string['herosubtitledesc'] = 'Enter the subtitle for the Hero section.';

$string['herodescription'] = 'Hero Description';
$string['herodescriptiondesc'] = 'Enter the description for the Hero section.';

$string['addbutton'] = 'Add Button';
$string['addbuttondesc'] = 'Choose whether to add buttons in the Hero section.';

$string['button1text'] = 'Button 1 Text';
$string['button1textdesc'] = 'Enter the text for the first button in the Hero section.';

$string['button2text'] = 'Button 2 Text';
$string['button2textdesc'] = 'Enter the text for the second button in the Hero section.';


$string['enablefeatures'] = 'Enable Features';
$string['enablefeaturesdesc'] = 'Choose whether to enable the Features section on the homepage.';

$string['featuresheading'] = 'Features Heading';
$string['featuresheadingdesc'] = 'Enter the heading for the Features section.';

$string['numberoffeatures'] = 'Number of Features';
$string['numberoffeaturesdesc'] = 'Select the number of features to display in the Features section.';

$string['featuretitle'] = 'Feature Title {$a}';
$string['featuretitledesc'] = 'Enter the title for Feature {$a}.';

$string['foricon'] = 'Icon HTML for Feature {$a}';
$string['foricondesc'] = 'Enter the HTML for the icon for Feature {$a}. You can use Font Awesome or custom SVG code.';

$string['featuredescription'] = 'Feature Description {$a}';
$string['featuredescriptiondesc'] = 'Enter the description for Feature {$a}.';

$string['aboutsection'] = 'About Section';
$string['aboutsectiondesc'] = 'Enable about section ';


$string['aboutheading'] = 'About Section Heading';
$string['aboutheadingdesc'] = 'Enter the heading for the About section.';

$string['aboutheading_desc'] = 'About Section Description';
$string['aboutheadingdesc'] = 'Enter the description text for the About section.';

$string['servicesection'] = 'Enable Service Section';
$string['servicesectiondesc'] = 'Toggle to enable or disable the Service section on the homepage.';

$string['serviceheading'] = 'Service Section Heading';
$string['serviceheadingdesc'] = 'Enter the heading text for the Service section.';

$string['serviceheading_desc'] = 'Service Section Description';
$string['serviceheadingdesc'] = 'Enter a description for the Service section.';

$string['numberofservices'] = 'Number of Services';
$string['numberofservicesdesc'] = 'Select the number of services to display in the Service section.';

$string['servicestitle'] = 'Service Title {$a}';
$string['servicestitledesc'] = 'Enter the title for service {$a}.';

$string['serviceimage'] = 'Service Image {$a}';
$string['serviceimagedesc'] = 'Upload an image for service {$a}. Accepted formats: .png, .jpg, .jpeg, .gif, .webp, .svg.';

$string['servicesdescription'] = 'Service Description {$a}';
$string['servicesdescriptiondesc'] = 'Enter a brief description for service {$a}.';

$string['ourprogramssection'] = 'Enable Our Programs Section';
$string['ourprogramssectiondesc'] = 'Toggle to enable or disable the Our Programs section on the homepage.';

$string['programtitle'] = 'Program Title {$a}';
$string['programtitledesc'] = 'Enter the title for Program {$a}.';

$string['programdescription'] = 'Program Description {$a}';
$string['programdescriptiondesc'] = 'Enter a description for Program {$a}.';

$string['whyussection'] = 'Enable Why Choose Us Section';
$string['whyussectiondesc'] = 'Toggle to enable or disable the Why Choose Us section on the homepage.';

$string['numberofanswers'] = 'Number of Answers';
$string['numberofanswersdesc'] = 'Select the number of answers or reasons to display in the Why Choose Us section.';

$string['answertitle'] = 'Answer Title {$a}';
$string['answertitledesc'] = 'Enter the title for answer {$a}.';

$string['answerforicon'] = 'Image for Answer {$a}';
$string['answerforicondesc'] = 'Enter the icon HTML or class for answer {$a}.';

$string['answerdescription'] = 'Answer Description {$a}';
$string['answerdescriptiondesc'] = 'Enter a description or brief explanation for answer {$a}.';

$string['testimonialssection'] = 'Enable Testimonials Section';
$string['testimonialssectiondesc'] = 'Toggle to enable or disable the Testimonials section on the homepage.';

$string['testimonialname'] = 'Testimonial Name {$a}';
$string['testimonialnamedesc'] = 'Enter the name of Testimonial {$a}.';

$string['testimonialtext'] = 'Testimonial Text {$a}';
$string['testimonialtextdesc'] = 'Enter the text of Testimonial {$a}.';

$string['testimonialimage'] = 'Testimonial Image {$a}';
$string['testimonialimagedesc'] = 'Upload an image for Testimonial {$a}.';

$string['testimonialheading'] = 'Testimonials Section Heading';
$string['testimonialheadingdesc'] = 'Enter the heading for the Testimonials section.';

$string['testimonialsubheading'] = 'Testimonials Section Sub-heading';
$string['testimonialsubheadingdesc'] = 'Enter the sub-heading for the Testimonials section.';

$string['testimonialpractice'] = 'Testimonial Practice Area {$a}';
$string['testimonialpracticedesc'] = 'Enter the practice area or testimonial details for Testimonial {$a}.';

$string['numberoftestimonials'] = 'Number of Testimonials';
$string['numberoftestimonialsdesc'] = 'Select the number of testimonials to display on the homepage.';

$string['featuredjobssection'] = 'Featured Jobs Section';
$string['featuredjobssectiondesc'] = 'Enable or disable the Featured Jobs section on the homepage.';


$string['ourresourcessection'] = 'Our Resources Section';
$string['ourresourcessectiondesc'] = 'Enable or disable the Our Resources section on the homepage.';
$string['resourceimage'] = 'Resource Image';
$string['resourceimagedesc'] = 'Upload an image for the Resources section.';
$string['ourresourcesheading'] = 'Resources Heading';
$string['ourresourcesheadingdesc'] = 'Enter a heading for the Resources section.';
$string['ourresourcesdescription'] = 'Resources Description';
$string['ourresourcesdescriptiondesc'] = 'Enter a description for the Resources section.';


$string['blogpostsheading'] = 'Blog Posts Heading';
$string['blogpostsheadingdesc'] = 'Enter the heading for the Blog Posts section.';
$string['enableblogposts'] = 'Enable Blog Posts';
$string['enableblogpostsdesc'] = 'Enable or disable the Blog Posts section.';
$string['numberofblogposts'] = 'Number of Blog Posts';
$string['numberofblogpostsdesc'] = 'Select the number of blog posts to display.';
$string['blogposttitle'] = 'Blog Post Title {$a}';
$string['blogposttitledesc'] = 'Enter the title for blog post {$a}.';
$string['blogposticon'] = 'Blog Post Icon {$a}';
$string['blogposticondesc'] = 'Enter the icon for blog post {$a}.';
$string['blogpostdescription'] = 'Blog Post Description {$a}';
$string['blogpostdescriptiondesc'] = 'Enter the description for blog post {$a}.';

$string['contactssection'] = 'CONTACTS SECTION';
$string['enablecontacts'] = 'Enable Contacts Section';
$string['enablecontactsdesc'] = 'Choose whether to enable or disable the Contacts Section';


$string['contactsheading'] = 'Contacts Section Heading';
$string['contactsheadingdesc'] = 'Enter the heading for the Contacts section.';


$string['enablesubscription'] = 'Enable Subscription Section';
$string['enablesubscriptiondesc'] = 'Choose whether to display the Subscription section.';
$string['subscriptionheading'] = 'Subscription Section Heading';
$string['subscriptionheadingdesc'] = 'Enter the heading for the Subscription section.';
$string['subscriptiondescription'] = 'Subscription Section Description';
$string['subscriptiondescriptiondesc'] = 'Enter the description for the Subscription section.';


$string['brandcolor'] = 'Brand Color';
$string['brandcolordesc'] = 'Select the brand color for your theme.';
$string['thisisaccahnge'] = 'change';