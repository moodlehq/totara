<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
 * Copyright (C) 1999 onwards Martin Dougiamas 
 * 
 * This program is free software; you can redistribute it and/or modify  
 * it under the terms of the GNU General Public License as published by  
 * the Free Software Foundation; either version 2 of the License, or     
 * (at your option) any later version.                                   
 *                                                                       
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Simon Coggins <simonc@catalyst.net.nz>
 * @package totara
 * @subpackage reportbuilder 
 */

defined('MOODLE_INTERNAL') || die();

require_once(dirname(dirname(dirname(__FILE__))).'/totara_msg/lib.php');

class rb_source_totaramessages extends rb_base_source {
    public $base, $joinlist, $columnoptions, $filteroptions;
    public $contentoptions, $paramoptions, $defaultcolumns;
    public $defaultfilters, $requiredcolumns, $sourcetitle;

    function __construct() {
        global $CFG;
        //$this->base = $CFG->prefix . 'message_working20';
        $this->base = $CFG->prefix . 'message_metadata';
        $this->joinlist = $this->define_joinlist();
        $this->columnoptions = $this->define_columnoptions();
        $this->filteroptions = $this->define_filteroptions();
        $this->contentoptions = $this->define_contentoptions();
        $this->paramoptions = $this->define_paramoptions();
        $this->defaultcolumns = $this->define_defaultcolumns();
        $this->defaultfilters = $this->define_defaultfilters();
        $this->requiredcolumns = $this->define_requiredcolumns();
        $this->sourcetitle = get_string('sourcetitle', 'rb_source_totaramessages');
        parent::__construct();
    }

    //
    //
    // Methods for defining contents of source
    //
    //

    function define_joinlist() {
        global $CFG;

        $joinlist = array(
            new rb_join(
                'msg',
                'INNER',
                $CFG->prefix . 'message20',
                'msg.id = base.messageid',
                REPORT_BUILDER_RELATION_ONE_TO_ONE
            ),
            new rb_join(
                'wrk',
                'INNER',
                $CFG->prefix . 'message_working20',
                'wrk.unreadmessageid = base.messageid',
                REPORT_BUILDER_RELATION_ONE_TO_ONE
            ),
            new rb_join(
                'processor',
                'INNER',
                $CFG->prefix . 'message_processors20',
                'wrk.processorid = processor.id',
                REPORT_BUILDER_RELATION_ONE_TO_ONE,
                array('base','wrk')
            ),
        );

        // include some standard joins
        $this->add_user_table_to_joinlist($joinlist, 'msg', 'useridfrom');
        $this->add_position_tables_to_joinlist($joinlist, 'msg', 'useridfrom');

        return $joinlist;
    }

    function define_columnoptions() {
        $columnoptions = array(
            new rb_column_option(
                'message_values',         // type
                'statement',              // value
                get_string('statement', 'rb_source_totaramessages'),              // name
                'msg.fullmessagehtml',        // field
                array('joins' => 'msg')   // options

            ),
            new rb_column_option(
                'message_values',         // type
                'statementurl',              // value
                get_string('statementurl', 'rb_source_totaramessages'),              // name
                'msg.fullmessage',        // field
                array('joins' => 'msg',   // options
                      'displayfunc' => 'msgtype_statementurl',
                      'extrafields' => array(
                        'msgurl' => 'msg.contexturl'),
                    )
            ),
            new rb_column_option(
                'message_values',
                'urgency',
                get_string('msgurgency', 'rb_source_totaramessages'),
                'base.urgency',
                array('displayfunc' => 'urgency_link')
                ),
            new rb_column_option(
                'message_values',
                'urgency_text',
                get_string('msgurgency', 'rb_source_totaramessages'),
                'base.urgency',
                array('displayfunc' => 'urgency_text')
                ),
            new rb_column_option(
                'message_values',
                'msgtype',
                get_string('msgtype', 'rb_source_totaramessages'),
                'base.msgtype',
                array('joins' => array('msg'),
                      'displayfunc' => 'msgtype_link',
                      'extrafields' => array(
                        'msgid' => 'base.messageid'),
                    )
            ),
            new rb_column_option(
                'message_values',
                'category',
                get_string('msgcategory', 'rb_source_totaramessages'),
                // icon uses format like 'competency-regular'
                // strip from first '-' to get general message category
                sql_substr() . '(base.icon, 0, ' . sql_position("'-'", 'base.icon') . ')'
            ),
            new rb_column_option(
                'message_values',
                'msgtype_text',
                get_string('msgtype', 'rb_source_totaramessages'),
                'base.msgtype',
                array('displayfunc' => 'msgtype_text')
            ),
            new rb_column_option(
                'message_values',
                'sent',
                get_string('sent', 'rb_source_totaramessages'),
                'msg.timecreated',
                array('joins' => 'msg',
                      'displayfunc' => 'nice_date')
            ),
            /*
            new rb_column_option(
                'message_values',
                'task_links',
                get_string('actions', 'rb_source_totaramessages'),
                'base.messageid',
                array('displayfunc' => 'task_links',
                      'noexport' => true,
                      'nosort' => true)
            ),
            */
            new rb_column_option(
                'message_values',
                'checkbox',
                get_string('select', 'rb_source_totaramessages'),
                'base.messageid',
                array('displayfunc' => 'message_checkbox',
                      'noexport' => true,
                      'nosort' => true)
            ),
            new rb_column_option(
                'message_values',
                'msgid',
                get_string('msgid', 'rb_source_totaramessages'),
                'base.messageid',
                array('nosort' => true,
                      'noexport' => true,
                      'hidden' => 1,
                    )
            ),
        );

        // include some standard columns
        $this->add_user_fields_to_columns($columnoptions);
        $this->add_position_fields_to_columns($columnoptions);

        return $columnoptions;
    }

    function define_filteroptions() {
        $filteroptions = array(
            new rb_filter_option(
                'message_values',       // type
                'sent',                 // value
                get_string('datesent', 'rb_source_totaramessages'),            // label
                'date',                 // filtertype
                array()                 // options
            ),
            new rb_filter_option(
                'message_values',
                'statement',
                get_string('details', 'rb_source_totaramessages'),
                'text'
            ),
            new rb_filter_option(
                'message_values',
                'urgency',
                'Message Urgency',
                'select',
                array(
                    'selectfunc' => 'message_urgency_list',
                    'selectoptions' => rb_filter_option::select_width_limiter(),
                )
            ),
            new rb_filter_option(
                'message_values',
                'category',
                get_string('msgtype', 'rb_source_totaramessages'),
                'multicheck',
                array(
                    'selectfunc' => 'message_type_list',
                )
            ),
        );
        // include some standard filters
        $this->add_user_fields_to_filters($filteroptions);
        $this->add_position_fields_to_filters($filteroptions);

        return $filteroptions;
    }

    function define_contentoptions() {
        $contentoptions = array(
        );
        return $contentoptions;
    }

    function define_paramoptions() {
        // this is where you set your hardcoded filters
        $paramoptions = array(
            new rb_param_option(
                'userid',        // parameter name
                'msg.useridto',  // field
                'msg'            // joins
            ),
            new rb_param_option(
                'name',            // parameter name
                'processor.name',  // field
                'processor'        // joins
            ),
            new rb_param_option(
                'roleid',          // parameter name
                'base.roleid'      // field
            ),
        );

        return $paramoptions;
    }

    function define_defaultcolumns() {
        $defaultcolumns = array(
        );
        return $defaultcolumns;
    }

    function define_defaultfilters() {
        $defaultfilters = array(
        );
        return $defaultfilters;
    }

    function define_requiredcolumns() {
        $requiredcolumns = array(
            new rb_column(
                'message_values',
                'dismiss_link',
                get_string('dismissmsg', 'rb_source_totaramessages'),
                'base.messageid',
                array('displayfunc' => 'dismiss_link',
                      'required' => true,
                      'noexport' => true,
                      //'capability' => 'moodle/local:updatethingy',
                      'nosort' => true)
            ),
        );
        return $requiredcolumns;
    }

    //
    //
    // Source specific column display methods
    //
    //

    // generate status icon link
    function rb_display_msgstatus_link($comp, $row) {
        global $CFG;
        $display = totara_msg_msgstatus_text($row->message_values_msgstatus);
        return "<img class=\"iconsmall\" src=\"{$display['icon']}\" alt=\"{$display['text']}\" />";
    }

    // generate status text
    function rb_display_msgstatus_text($comp, $row) {
        global $CFG;
        $display = totara_msg_msgstatus_text($row->message_values_msgstatus);
        return $display['text'];
    }

    // generate statement url
    function rb_display_msgtype_statementurl($comp, $row) {
        return "<a href=\"".$row->msgurl."\">".$comp."</a>";
    }

    // generate urgency icon link
    function rb_display_urgency_link($comp, $row) {
        global $CFG;
        $display = totara_msg_urgency_text($row->message_values_urgency);
        return "<img class=\"iconsmall\" src=\"{$display['icon']}\" title=\"{$display['text']}\" alt=\"{$display['text']}\" />";
    }

    // generate urgency text
    function rb_display_urgency_text($comp, $row) {
        global $CFG;
        $display = totara_msg_urgency_text($row->message_values_urgency);
        return $display['text'];
    }

    // generate type icon link
    function rb_display_msgtype_link($comp, $row) {
        global $CFG;
        $msg = get_record('message20', 'id', $row->msgid);
        $metadata = get_record('message_metadata', 'messageid', $row->msgid);
        $icon = ($metadata ? $metadata->icon : 'default.png');
        return '<img class="msgicon" src="' . totara_msg_icon_url($icon) . '" title="' . format_string($msg->subject) . '" alt="' . format_string($msg->subject) .'" />';
    }

    // generate status type text
    function rb_display_msgtype_text($comp, $row) {
        global $CFG;
        $display = totara_msg_msgtype_text($row->message_values_msgtype);
        return $display['text'];
    }

    // generate dismiss message link
    function rb_display_dismiss_link($id, $row) {
        return '<div class="totara_alerts_actions">'.
                '<table class="totara_messages_actions" border="0"><tr><td>'.
                totara_msg_dismiss_action($id).
                '</td><td>'.
                '<script type="text/javascript"> '.
                "// bind functionality to page on load
                $(function() {
                    // checkbox
                    (function() {
                        $('#totara_msgcbox_".$id."').css('display','block');
                    })();
                });" .
                '</script>'.
                '<input class="selectbox" name="totara_message_'.$id.'" value="'.$id.'" type="checkbox" id="totara_msgcbox_'.$id.'" style="display:none;"/></td>'.
                '</tr></table>'.
                '</div>';
    }

    // generate task message links
    function rb_display_task_links($id, $row) {
        return '<div class="totara_tasks_actions">'.
                '<table class="totara_messages_actions" border="0"><tr>'.
                '<td>'.totara_msg_accept_reject_action($id).'</td>'.
                '<td>'.totara_msg_dismiss_action($id).'</td>'.
                '<td>'.
                '<script type="text/javascript"> '.
                "// bind functionality to page on load
                $(function() {
                    // checkbox
                    (function() {
                        $('#totara_msgcbox_".$id."').css('display','block');
                    })();
                });" .
                '</script>'.
                '<input class="selectbox" name="totara_message_'.$id.'" value="'.$id.'" type="checkbox" id="totara_msgcbox_'.$id.'" style="display:none;"/></td>'.
                '</tr></table>'.
                '</div>';
    }


    // generate message checkbox
    function rb_display_message_checkbox($id, $row) {
        return '<input class="selectbox" name="totara_message_'.$id.'" value="'.$id.'" type="checkbox" id="totara_message">';
    }

    //
    //
    // Source specific filter display methods
    //
    //

    function rb_filter_message_status_list() {
        $statusselect = array();
        $statusselect[TOTARA_MSG_STATUS_OK] = 'Status OK';
        $statusselect[TOTARA_MSG_STATUS_NOTOK] = 'Status not OK';
        $statusselect[TOTARA_MSG_STATUS_UNDECIDED] = 'Status undecided';
        return $statusselect;
    }

    function rb_filter_message_urgency_list() {
        $urgencyselect = array();
        $urgencyselect[TOTARA_MSG_URGENCY_NORMAL] = 'Normal';
        $urgencyselect[TOTARA_MSG_URGENCY_URGENT] = 'Urgent';
        return $urgencyselect;
    }

    function rb_filter_message_type_list() {
        global $CFG;
        $out = array();
        foreach(array('blended', 'competency', 'course', 'elearning',
            'evidence', 'facetoface', 'learningplan', 'objective', 'resource')
            as $type) {

            $typename = get_string($type, 'local_totara_msg');

            $out[$type] = '<img src="' . $CFG->pixpath . '/msgicons/' . $type . '-regular.gif" alt="' . $typename . '" />&nbsp;' . $typename;

        }

        return $out;
    }

} // end of rb_source_competency_evidence class
