<?php

defined('MOODLE_INTERNAL') || die();

/**
 * Makes our changes to the CSS
 *
 * @param string $css
 * @param theme_config $theme
 * @return string
 */
function customtotara_process_css($css, $theme) {

    $substitutions = array(
        'linkcolor' => '#087BB1',
        'linkvisitedcolor' => '#087BB1',
        'headerbgc' => '#F5F5F5',
        'buttoncolor' => '#E6E6E6',
    );
    $css = totara_theme_generate_autocolors($css, $theme, $substitutions);

    // Set the custom CSS
    if (!empty($theme->settings->customcss)) {
        $customcss = $theme->settings->customcss;
    } else {
        $customcss = null;
    }
    $css = customtotara_set_customcss($css, $customcss);

    return $css;

}


/**
 * Sets the custom css variable in CSS
 *
 * @param string $css
 * @param mixed $customcss
 * @return string
 */
function customtotara_set_customcss($css, $customcss) {
    $tag = '[[setting:customcss]]';
    $replacement = $customcss;
    if (is_null($replacement)) {
        $replacement = '';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}
