<?php
/**
 * Block for displaying user-defined links
 *
 * @package   totara
 * @copyright 2010 Totara Learning Solutions Ltd
 * @author    Eugene Venter <aaronb@catalyst.net.nz>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_quicklinks extends block_base {

    function init() {
        $this->title = get_string('quicklinks', 'block_quicklinks');
        $this->version = 2010111000;
    }

    function preferred_width() {
        return 210;
    }

    function specialization() {
        // After the block has been loaded we customize the block's title display
        if (!empty($this->config) && !empty($this->config->title)) {
            // There is a customized block title, display it
            $this->title = $this->config->title;
        } else {
            // No customized block title, use localized remote news feed string
            $this->title = get_string('quicklinks', 'block_quicklinks');
        }
    }

    function get_content() {
        global $CFG, $USER;

        // Check if content is cached
        if($this->content !== NULL) {
            return $this->content;
        }

        $this->content = new stdClass;
        $this->content->text   = '';
        $this->content->footer = '';

        if (empty($this->instance)) {
            // We're being asked for content without an associated instance
            return $this->content;
        }

        if (empty($this->instance->pinned)) {
            $context = get_context_instance(CONTEXT_BLOCK, $this->instance->id);
        } else {
            $context = get_context_instance(CONTEXT_SYSTEM); // pinned blocks do not have own context
        }

        $html = '';

        // Get links to display
        $links = get_records('block_quicklinks', 'block_instance_id', $this->instance->id, 'displaypos');
        $links = empty ($links) ? array() : $links;

        foreach ($links as $l) {
            $html .= '<div class="block_quicklinks_link"><a href="'.format_string($l->url).'">'.$this->format_title($l->title).'</a></div>';
        }

        $this->content->text = $html;

        return $this->content;
    }

    function instance_allow_multiple() {
        return true;
    }

    function instance_allow_config() {
        $context = get_context_instance(CONTEXT_BLOCK, $this->instance->id);

        if ($this->instance_is_dashlet()) {
            return (has_capability('block/quicklinks:manageownlinks', $context) || has_capability('block/quicklinks:managealllinks', $context));
        } else {
            return has_capability('block/quicklinks:managealllinks', $context);
        }
    }

    function instance_config_save($data) {
        global $USER;

        if (!empty($data->btnCancel)) {
            // Do nothing
            return true;
        }
        if (!empty($data->url)) {
            $addlink = isset($data->btnAddLink);
            if (empty($data->linktitle)) {
                if (!empty($data->url)) {
                    $data->linktitle = $data->url;
                }
            }
           // Save the block link
           $link = new stdClass;
           $link->userid = $this->instance_is_dashlet() ? $USER->id : 0;
           $link->block_instance_id = $this->instance->id;
           $link->title = empty($data->linktitle) ? $data->url : $data->linktitle;
           $link->url = $data->url;
           $link->displaypos = count_records('block_quicklinks', 'block_instance_id', $this->instance->id) > 0 ? get_field('block_quicklinks', 'MAX(displaypos)+1', 'block_instance_id', $this->instance->id) : 0;
           insert_record('block_quicklinks', $link);
           unset($link);
        }


        unset($data->btnAddLink, $data->linktitle, $data->url);
        if (parent::instance_config_save($data)) {
            if (!empty($addlink)) {
                // HACK: redirect back to the same page
                redirect(get_referer(false));
            } else {
                return true;
            }
        }
    }

    function instance_create() {
        global $CFG, $USER;

        // Add some default quicklinks
        $links = array();
        if ($this->instance_is_dashlet()) {
            // Insert default links, according to role
            $sql = "SELECT r.shortname
                FROM {$CFG->prefix}dashb d
                INNER JOIN {$CFG->prefix}dashb_instance di ON d.id = di.dashb_id
                INNER JOIN {$CFG->prefix}role r on d.roleid = r.id
                WHERE di.id = {$this->instance->pageid}";       // The pageid is the dashb instance id
            $role = get_field_sql($sql);

            switch ($role) {
                case 'admin' :
                case 'administrator' :
                    $links = array('Home'=>"{$CFG->wwwroot}/index.php",
                        'Logs'=>"{$CFG->wwwroot}/course/report/log/index.php",
                        'Manage Reports'=>"{$CFG->wwwroot}/local/reportbuilder/index.php");
                    break;
                case 'manager' :
                case 'teacher' :
                case 'trainer' :
                case 'student' :
                default:
                    $links = array('Home'=>"{$CFG->wwwroot}/index.php",
                        'Reports'=>"{$CFG->wwwroot}/my/reports.php",
                        'Courses'=>"{$CFG->wwwroot}/course/find.php");
                    break;
            }
        } else {
            // Insert global default links
            $links = array('Home'=>"{$CFG->wwwroot}/index.php",
                'Reports'=>"{$CFG->wwwroot}/my/reports.php",
                'Courses'=>"{$CFG->wwwroot}/course/find.php");
        }

        $poscount = 0;
        foreach ($links as $title=>$url) {
            $link = new stdClass;
            $link->block_instance_id = $this->instance->id;
            $link->title = $title;
            $link->url = $url;
            $link->displaypos = $poscount;
            $link->userid = $this->instance_is_dashlet() ? $USER->id : 0;
            insert_record('block_quicklinks', $link);
            $poscount++;
        }

        return true;

    }

    function instance_delete() {
        // Do some additional cleanup
        delete_records('block_quicklinks', 'block_instance_id', $this->instance->id);

        return true;
    }

    // Strips the title down and adds '...' for excessively long titles.
    function format_title($title,$max=64) {

    /// Loading the textlib singleton instance. We are going to need it.
        $textlib = textlib_get_instance();

        if ($textlib->strlen($title) <= $max) {
            return s($title);
        } else {
            return s($textlib->substr($title,0,$max-3).'...');
        }
    }

    /**
    * Determines whether the block instance is a dashlet, on a dashboard page
    * @return boolean
    **/
    function instance_is_dashlet() {
        return ($this->instance->pagetype == 'totara-dashboard' && $this->instance->position == 'c');
    }
}

?>
