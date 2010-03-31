<?php

/**
 * Constants for defining JS to load
 */
define('MBE_JS_DIALOG',         1);
define('MBE_JS_TREEVIEW',       2);
define('MBE_JS_DATEPICKER',     3);

/**
 * Load appropriate JS and CSS files for lightbox
 *
 * @param $options array Array of option constants
 */
function local_js($options = array()) {
    global $CFG;

    // Include required javascript libraries
    require_js(array(
        $CFG->wwwroot.'/local/js/lib/jquery-1.3.2.min.js',
    ));

    $CFG->stylesheets[] = $CFG->wwwroot.'/local/js/lib/ui-lightness/jquery-ui-1.7.2.custom.css';

    // If dialog
    if (in_array(MBE_JS_DIALOG, $options)) {

        require_js(array(
            $CFG->wwwroot.'/local/js/lib/jquery-ui-1.7.2.custom.min.js',
            $CFG->wwwroot.'/local/js/lib/dialog.js',
        ));
    }

    // If treeview enabled
    if (in_array(MBE_JS_TREEVIEW, $options)) {

        require_js(array(
            $CFG->wwwroot.'/local/js/lib/jquery.treeview.min.js',
        ));

        $CFG->stylesheets[] = $CFG->wwwroot.'/local/js/lib/jquery.treeview.css';
    }
}

/**
 * Return markup for a branch of a hierarchy based treeview
 *
 * @param   $elements       array       Single level array of elements
 * @param   $error_string   string      String to display if no elements supplied
 * @param   $hierarchy      object      The hierarchy object (optional)
 * @return  $html
 */
function build_treeview($elements, $error_string, $hierarchy = null) {

    $html = '';

    if (is_array($elements) && !empty($elements)) {

        // Get parents array
        if ($hierarchy) {
            $parents = $hierarchy->get_all_parents();
        }

        $total = count($elements);
        $count = 0;

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

            // Element has children
            if (array_key_exists($element->id, $parents)) {
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

/*
 * Create a none javascript version of treeview
 *
 * @param array $elements Array of items to display
 * @param string $error_string String to print if something goes wrong
 * @param string $actionurl URL to go to to assign an item
 * @param array $actionparams Array of url parameters to include when going to $actionurl
 * @param string $expandurl URL to go to to expand an item to view its children
 * @param array $parents Array of IDs of items that are parents. Used to decide if link to children
 *                       should be shown
 * @return string HTML code displaying the treeview based on input params
 *
 */
function build_nojs_treeview($elements, $error_string, $actionurl, $actionparams, $expandurl, $parents = array()) {
    $html = '<table>';

    if (is_array($elements) && !empty($elements)) {

        // Loop through elements
        foreach ($elements as $element) {
            $params = $actionparams + array('add' => $element->id);
            $html .= '<tr>';
            $html .= '<td>';
            $html .= print_single_button($actionurl, $params, get_string('assign','hierarchy'), 'get', '_self', true);
            $html .= '</td><td>';

            // Element has children
            if (array_key_exists($element->id, $parents)) {
                $html .= '<a href="'.$expandurl.'&amp;parentid='.$element->id.'">';
                $html .= format_string($element->fullname);
                if(!empty($element->idnumber)) $html .= ' - '.$element->idnumber;
                $html .= '</a>';
            } else {
                $html .= format_string($element->fullname);
                if(!empty($element->idnumber)) $html .= ' - '.$element->idnumber;
            }

            $html .= '</td></tr>'.PHP_EOL;
        }
    }
    else {
        $html .= '<tr><td>';
        $html .= $error_string;
        $html .= '</td></tr>'.PHP_EOL;
    }
    $html .= '</table>';
    return $html;
}

/*
 * Create a none js breadcrumb trail, indicating the current position in the framework
 * hierarchy and allowing the user to navigate between levels
 *
 * @param object $hierarchy Hierarchy to generate breadcrumbs for
 * @param integer $parentid Current items parent ID, used to determine what to show
 * @param string $url URL to assign to the breadcrumbs links
 * @param array $urlparams Array of url parameters to pass along with URL
 * @return string HTML to print the breadcrumbs trail
 *
 */
function build_nojs_breadcrumbs($hierarchy, $parentid, $url, $urlparams) {

    $murl = new moodle_url($url, $urlparams);
    $nofwurl = $murl->out(false, array('frameworkid' => 0));

    $html = '<div class="breadcrumb"><h2 class="accesshide " >You are here</h2> <ul>';
    $html .= '<li class="first"><a href="'.$nofwurl.'">'.
        get_string('allframeworks','hierarchy').'</a></li>';
    if($parentid) {
        if($lineage = $hierarchy->get_item_lineage($parentid)) {
            // correct order for breadcrumbs
            $items = array_reverse($lineage);
            foreach($items as $item) {
                $itemurl = $murl->out(false, array('parentid'=>$item->parentid));
                $html .= '<li> <span class="accesshide " >/&nbsp;</span>';
                $html .= '<span class="arrow sep">&#x25BA;</span>';
                $html .= '<a href="'.$itemurl.'">'.$item->fullname.'</a></li>';
            }
        }
    }
    $html .= '</ul></div>';
    return $html;
}

/*
 * Create a none javascript framework picker page, allowing the user to select which
 * framework to use to assign an item
 *
 * @param object $hierarchy Hierarchy to generate picker for
 * @param string $url URL to take the user to when they click a framework link
 * @params array $urlparams array of url parameters to pass along with URL
 * @return string HTML to print the framework picker list
 *
 */
function build_nojs_frameworkpicker($hierarchy, $url, $urlparams) {
    $murl = new moodle_url($url, $urlparams);
    if($fws = get_records($hierarchy->prefix.'_framework')) {
        echo '<div id="nojsinstructions"><p>'.PHP_EOL;
        echo get_string('pickaframework','hierarchy');
        echo '</p></div>'.PHP_EOL;
        echo '<div class="nojsselect"><ul>'.PHP_EOL;
        foreach ($fws as $fw) {
            $fullurl = $murl->out(false, array('frameworkid' => $fw->id));
            echo '<li><a href="'.$fullurl.'">'.$fw->fullname.'</a></li>'.PHP_EOL;
        }
        echo '</ul></div>'.PHP_EOL;
    } else {
        error('noframeworks',$hierarchy->prefix);
    }
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
