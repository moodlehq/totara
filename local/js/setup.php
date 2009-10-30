<?php

/**
 * Constants for defining JS to load
 */
define('MBE_JS_TREEVIEW',       1);


/**
 * Load appropriate JS and CSS files for lightbox
 *
 * @param $options array Array of option constants
 */
function setup_lightbox($options = array()) {
    global $CFG;

    // Include required javascript libraries
    require_js(array(
        'yui_yahoo',
        'yui_dom',
        'yui_event',
        'yui_element',
        'yui_animation',
        'yui_connection',
        'yui_container',
        'yui_json',
        $CFG->wwwroot.'/local/js/jquery-1.3.2.min.js',
        $CFG->wwwroot.'/local/js/dialog.js',
    ));

    // If treeview enabled
    if (in_array(MBE_JS_TREEVIEW, $options)) {

        $CFG->stylesheets[] = $CFG->wwwroot.'/local/js/jquery.treeview.css';

        require_js(array(
            $CFG->wwwroot.'/local/js/jquery.treeview.min.js',
        ));
    }
}
