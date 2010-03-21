<?php

/**
 * Constants for defining JS to load
 */
define('MBE_JS_TREEVIEW',       1);
define('MBE_JS_ADVANCED',       2);

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

    // If advanced enabled
    if (in_array(MBE_JS_ADVANCED, $options)) {

        require_js(array(
            $CFG->wwwroot.'/local/js/jquery-ui-1.7.2.custom.min.js',
        ));
    }
}

/**
 * Return markup for a branch of a hierarchy based treeview
 *
 * @param   $elements       array       Single level array of elements
 * @param   $error_string   string      String to display if no elements supplied
 * @param   $max_depth      int         Maximum depthid for the hierarchy framework, or true is single level
 * @return  $html
 */
function build_treeview($elements, $error_string, $max_depth = true) {

    $html = '';

    if (is_array($elements) && !empty($elements)) {

        $total = count($elements);
        $count = 0;
        $is_max_depth = false;

        // If this is the max depth
        if ($max_depth === true || reset($elements)->depthid == $max_depth) {
            $is_max_depth = true;
        }

        // Loop through elements
        foreach ($elements as $element) {
            ++$count;

            // Initialise class vars
            $li_class = '';
            $div_class = '';
            $span_class = '';

            // If last element
            if ($count == $total) {
                $li_class .= ' last';
            }

            // If this isn't the max depth level, assume children
            if (!$is_max_depth) {
                $li_class = 'expandable closed';
                $div_class = 'hitarea closed-hitarea expandable-hitarea';
                $span_class = 'folder';

                if ($count == $total) {
                    $li_class .= ' lastExpandable';
                    $div_class .= ' lastExpandable-hitarea';
                }
            }

            $html .= '<li class="'.$li_class.'" id="item_list_'.$element->id.'">';
            $html .= '<div class="'.$div_class.'"></div>';
            $html .= '<span id="item_'.$element->id.'" class="'.$span_class.'">';
            $html .= format_string($element->fullname);
            $html .= '</span>';

            if ($div_class !== '') {
                $html .= '<ul style="display: none;"></ul>';
            }
            $html .= '</li>'.PHP_EOL;
        }
    }
    else {
        $html .= '<li class="last"><span class="empty">';
        $html .= $error_string;
        $html .= '</span></li>'.PHP_EOL;
    }

    return $html;
}

/**
 * Display markup for an error in a hierarchy based treeview and die
 *
 * @param   $error_string   string      String to display if no elements supplied
 * @param   $child          boolean     This is a child node (print treeview branch markup)
 * @return  $html
 */
function treeview_error($error_string, $child = false) {

    if ($child) {
        echo build_treeview(null, $error_string);
    }
    else {
        print_heading(get_string('error'));
        print_simple_box($error_string, '', '', '', '', 'errorbox');
    }

    die();
}

/**
 * Return markup for a simple picker in a dialog
 *
 * @param   $options    array   options/values
 * @param   $selected   mixed   $options key for currently selected element
 * @param   $class      string  select element's class
 * @return  $html
 */
function display_dialog_selector($options, $selected, $class) {

    $html = '<select class="'.$class.'">';

    foreach ($options as $key => $value) {
        $html .= '<option value="'.$key.'"';

        if ($key == $selected) {
            $html .= ' selected="selected"';
        }

        $html .= '>'.htmlentities($value).'</option>';
    }

    $html .= '</select>';

    return $html;
}
