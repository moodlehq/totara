<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
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
 * @author Eugene Venter <eugene@catalyst.net.nz>
 * @author Dongsheng Cai <dongsheng@moodle.com>
 * @package totara
 * @subpackage comment
 */

class comment {
    /**
     * @var integer
     */
    private $page;
    /**
     * there may be several comment box in one page
     * so we need a client_id to recognize them
     * @var integer
     */
    private $cid;
    private $contextid;
    /**
     * commentarea is used to specify different
     * parts shared the same itemid
     * @var string
     */
    private $commentarea;
    /**
     * itemid is used to associate with commenting content
     * @var integer
     */
    private $itemid;

    /**
     * this html snippet will be used as a template
     * to build comment content
     * @var string
     */
    private $template;
    private $context;
    private $courseid;
    /**
     * course module object, only be used to help find pluginname automatically
     * if pluginname is specified, it won't be used at all
     * @var string
     */
    private $cm;
    private $plugintype;
    /**
     * When used in module, it is recommended to use it
     * @var string
     */
    private $pluginname;
    private $viewcap;
    private $postcap;
    /**
     * to costomize link text
     * @var string
     */
    private $linktext;
    /**
    * If set to true then comment sections won't be able to be opened and closed
    * instead they will always be visible.
    * @var bool
    */
    protected $notoggle = false;
    /**
     * If set to true comments are automatically loaded as soon as the page loads.
     * Normally this happens when the user expands the comment section.
     * @var bool
     */
    protected $autostart = false;
    /**
     * The # of comments to display per page
     */
    private $commentsperpage;


    // static variable will be used by non-js comments UI
    private static $nonjs = false;
    private static $comment_itemid = null;
    private static $comment_context = null;
    private static $comment_area = null;
    private static $comment_page = null;
    private static $comment_component = null;
    /**
     * Construct function of comment class, initialise
     * class members
     * @param stdClass $options
     * @param object $options {
     *            context => context context to use for the comment [required]
     *            component => string which plugin will comment being added to [required]
     *            itemid  => int the id of the associated item (forum post, glossary item etc) [required]
     *            area    => string comment area
     *            cm      => stdClass course module
     *            course  => course course object
     *            client_id => string an unique id to identify comment area
     *            autostart => boolean automatically expend comments
     *            showcount => boolean display the number of comments
     *            displaycancel => boolean display cancel button
     *            notoggle => boolean don't show/hide button
     *            linktext => string title of show/hide button
     *            commentsperpage => int comments displayed per page
     * }
     */
    public function __construct($options) {
        global $CFG;

        if (!empty($options->commentsperpage)) {
            $this->commentsperpage = $options->commentsperpage;
        } elseif (!empty($CFG->commentsperpage)) {
            $this->commentsperpage = $CFG->commentsperpage;
        } else {
            $this->commentsperpage = 15;
        }

        $this->viewcap = false;
        $this->postcap = false;

        // setup client_id
        if (!empty($options->client_id)) {
            $this->cid = $options->client_id;
        } else {
            $this->cid = uniqid();
        }

        // setup context
        if (!empty($options->context)) {
            $this->context = $options->context;
            $this->contextid = $this->context->id;
        } else if(!empty($options->contextid)) {
            $this->contextid = $options->contextid;
            $this->context = get_context_instance_by_id($this->contextid);
        } else {
            print_error('invalidcontext');
        }

        if (!empty($options->component)) {
            $this->set_component($options->component);
        }

        // setup course
        // course will be used to generate user profile link
        if (!empty($options->course)) {
            $this->courseid = $options->course->id;
        } else if (!empty($options->courseid)) {
            $this->courseid = $options->courseid;
        } else {
            $this->courseid = SITEID;
        }

        // setup coursemodule
        if (!empty($options->cm)) {
            $this->cm = $options->cm;
        } else {
            $this->cm = null;
        }

        // setup commentarea
        if (!empty($options->area)) {
            $this->commentarea = $options->area;
        }

        // setup itemid
        if (!empty($options->itemid)) {
            $this->itemid = $options->itemid;
        } else {
            $this->itemid = 0;
        }

        // setup customized linktext
        if (!empty($options->linktext)) {
            $this->linktext = $options->linktext;
        } else {
            $this->linktext = get_string('comments', 'local_comment');
        }

        if (!empty($options->ignore_permission)) {
            $this->ignore_permission = true;
        } else {
            $this->ignore_permission = false;
        }

        if (!empty($options->showcount)) {
            $count = $this->count();
            if (empty($count)) {
                $this->count = '';
            } else {
                $this->count = '('.$count.')';
            }
        } else {
            $this->count = '';
        }

        // setup options for callback functions
        $this->args = new stdClass();
        $this->args->context     = $this->context;
        $this->args->courseid    = $this->courseid;
        $this->args->cm          = $this->cm;
        $this->args->commentarea = $this->commentarea;
        $this->args->itemid      = $this->itemid;

        // setting post and view permissions
        $this->check_permissions();

        // load template
        $this->template = <<<EOD
<div class="comment-userpicture">___picture___</div>
<div class="comment-content">
    ___name___
    <div>___content___</div>
    <span class="comment-datetime">___time___</span>
</div>
<div class="comment-footer"></div>
EOD;
        if (!empty($this->plugintype)) {
            $this->template = plugin_callback($this->plugintype, $this->pluginname, FEATURE_COMMENT, 'template', $this->args, $this->template);
        }

        // setup notoggle
        if (!empty($options->notoggle)) {
            $this->notoggle = $options->notoggle;
        }

        // setup autostart
        if (!empty($options->autostart)) {
            $this->autostart = $options->autostart;
        }

        unset($options);
    }

    /**
     * Receive nonjs comment parameters
     */
    public static function init() {
        global $PAGE, $CFG;
        // setup variables for non-js interface
        self::$nonjs = optional_param('nonjscomment', '', PARAM_BOOL);
        self::$comment_itemid  = optional_param('comment_itemid',  '', PARAM_INT);
        self::$comment_context = optional_param('comment_context', '', PARAM_INT);
        self::$comment_page    = optional_param('comment_page',    '', PARAM_INT);
        self::$comment_area    = optional_param('comment_area',    '', PARAM_TEXT);
        /*
        $PAGE->requires->string_for_js('addcomment', 'moodle');
        $PAGE->requires->string_for_js('deletecomment', 'moodle');
        $PAGE->requires->string_for_js('comments', 'moodle');
        $PAGE->requires->string_for_js('commentsrequirelogin', 'moodle');
        */
        /*
        echo '<script>'.
            'var M.str.moodle.addcomment ='.json_encode(get_string('addcomment', 'moodle')).'; '.
            'var M.str.moodle.deletecomment ='.json_encode(get_string('deletecomment', 'moodle')).'; '.
            'var M.str.moodle.comments ='.json_encode(get_string('comments', 'moodle')).'; '.
            'var M.str.moodle.commentsrequirelogin ='.json_encode(get_string('commentsrequirelogin', 'moodle')).'; '.
            '</script>';
            */
    }

    public function set_component($component) {
        $this->component = $component;
        list($this->plugintype, $this->pluginname) = normalize_component($component);
        return null;
    }

    public function set_view_permission($value) {
        $this->viewcap = $value;
    }

    public function set_post_permission($value) {
        $this->postcap = $value;
    }

    /**
     * check posting comments permission
     * It will check based on user roles and ask modules
     * If you need to check permission by modules, a
     * function named $pluginname_check_comment_post must be implemented
     */
    private function check_permissions() {
        global $CFG;
        $this->postcap = has_capability('local/comment:post', $this->context);
        $this->viewcap = has_capability('local/comment:view', $this->context);
        if (!empty($this->plugintype)) {
            $permissions = plugin_callback($this->plugintype, $this->pluginname, FEATURE_COMMENT, 'permissions', array($this->args), array('post'=>true, 'view'=>true));
            if ($this->ignore_permission) {
                $this->postcap = $permissions['post'];
                $this->viewcap = $permissions['view'];
            } else {
                $this->postcap = $this->postcap && $permissions['post'];
                $this->viewcap = $this->viewcap && $permissions['view'];
            }
        }
    }

    /**
     * Prepare comment code in html
     * @param  boolean $return
     * @return mixed
     */
    public function output($return = true) {
        global $CFG, $FULLME;
		static $template_printed;

        // Needed for older versions of PHP io to utilise json_encode/json_decode
        require_once($CFG->libdir.'/pear/HTML/AJAX/JSON.php');

        $this->link = $FULLME;
        $murl = new moodle_url($this->link);
        $murl->remove_params('nonjscomment');
        $murl->param('nonjscomment', 1);
        $murl->param('comment_itemid', $this->itemid);
        $murl->param('comment_context', $this->context->id);
        $murl->param('comment_area', $this->commentarea);
        $murl->remove_params('comment_page');
        $this->link = $murl->out();

        $options = new stdClass();
        $options->client_id = $this->cid;
        $options->commentarea = $this->commentarea;
        $options->itemid = $this->itemid;
        $options->page   = 0;
        $options->courseid = $this->courseid;
        $options->contextid = $this->contextid;
        $options->component = $this->component;
        $options->commentsperpage = $this->commentsperpage;
        $options->notoggle = $this->notoggle;
        $options->autostart = $this->autostart;

        //$PAGE->requires->js_init_call('M.core_comment.init', array($options), true);
        require_js(array(
            $CFG->wwwroot.'/local/js/lib/jquery-1.3.2.min.js',
            'yui_yahoo', 'yui_dom', 'yui_event', 'yui_container', 'yui_connection',
            'yui_dragdrop', 'yui_element', 'yui_json', 'yui_animation'));
        echo '<script>
            if (typeof totara_comment_options == "undefined") {
                var totara_comment_options = new Array();
            }
            totara_comment_options.push('.json_encode($options).');

            if (typeof(totara_core_comment) == "undefined") {
                // Ensure comment JS gets loaded in head
                // Done this way for lame ie6
                var commentJS = document.createElement("script");
                commentJS.src = "'.$CFG->wwwroot.'/local/comment/comment.js.php";
                commentJS.type = "text/javascript";
                $("head").append(commentJS);
            }
            </script>';

        if (!empty(self::$nonjs)) {
            // return non js comments interface
            return $this->print_comments(self::$comment_page, $return, true);
        }

        $strsubmit = get_string('savecomment', 'local_comment');
        $strcancel = get_string('cancel');
        $strshowcomments = get_string('showcommentsnonjs', 'local_comment').' '.$this->count;
        $sesskey = sesskey();
        $html = '';
        // print html template
        // Javascript will use the template to render new comments
        if (empty($template_printed) && !empty($this->viewcap)) {
            $html .= '<div style="display:none" id="cmt-tmpl">' . $this->template . '</div>';
            $template_printed = true;
        }

        if (!empty($this->viewcap)) {
            // print commenting icon and tooltip
            $icon = $CFG->pixpath.'/t/collapsed.png';
            $html .= <<<EOD
<div class="mdl-left">
<a class="showcommentsnonjs" href="{$this->link}">{$strshowcomments}</a>
EOD;
            if (!$this->autostart) {
                $html .= <<<EOD
<a id="comment-link-{$this->cid}" class="comment-link" href="#">
    <img id="comment-img-{$this->cid}" src="$icon" alt="{$this->linktext}" title="{$this->linktext}" />
    <span id="comment-link-text-{$this->cid}">{$this->linktext} {$this->count}</span>
</a>
EOD;
            }

            $html .= <<<EOD
<div id="comment-ctrl-{$this->cid}" class="comment-ctrl">
    <ul id="comment-list-{$this->cid}" class="comment-list">
        <li class="first"></li>
EOD;
            if ($this->autostart) {
                $html .= $this->print_comments(0, true, false);
                $html .= '</ul>';
                $html .= $this->get_pagination(0);
            } else {
                $html .= <<<EOD
    </ul>
    <div id="comment-pagination-{$this->cid}" class="comment-pagination"></div>
EOD;
            }

            // print posting textarea
            if (!empty($this->postcap)) {
                $straddcomment = get_string('addcomment', 'local_comment');
                $html .= <<<EOD
<div class='comment-area'>
    <div class="bd">
        <textarea name="content" rows="5" cols="20" id="dlg-content-{$this->cid}" style="color:gray;">{$straddcomment}</textarea>
    </div>
    <div class="fd" id="comment-action-{$this->cid}">
        <a href="#" id="comment-action-post-{$this->cid}"> {$strsubmit} </a>
EOD;
                if (!$this->notoggle) {
                    $html .= "<span> | </span><a href=\"#\" id=\"comment-action-cancel-{$this->cid}\"> {$strcancel} </a>";
                }
                $html .= <<<EOD
    </div>
</div>
<div class="clearer"></div>
EOD;
            }

            $html .= <<<EOD
</div><!-- end of comment-ctrl -->
</div>
EOD;
        } else {
            $html = '';
        }

        if ($return) {
            $returnhtml = '<br /><h3>' . get_string('comments', 'local_comment') . '</h3>';
            $returnhtml .= '<div id="comments">';
            $returnhtml .= $html;
            $returnhtml .= '</div>';

            return $returnhtml;
        } else {
            echo $html;
        }
    }

    /**
     * Return matched comments
     *
     * @param  int $page
     * @return mixed
     */
    public function get_comments($page = '') {
        global $CFG, $USER;
        if (empty($this->viewcap)) {
            return false;
        }
        if (!is_numeric($page)) {
            $page = 0;
        }
        $this->page = $page;
        $start = $page * $this->commentsperpage;
        $sql = "SELECT u.*, c.id AS cid, c.content AS ccontent, c.format AS cformat, c.timecreated AS ctimecreated
                  FROM {$CFG->prefix}comments c
                  JOIN {$CFG->prefix}user u ON u.id = c.userid
                  WHERE c.contextid =  {$this->contextid} AND c.commentarea = '{$this->commentarea}' AND c.itemid = {$this->itemid}
              ORDER BY c.timecreated ASC";

        $comments = array();
        $candelete = has_capability('local/comment:delete', $this->context);
        $formatoptions = array('overflowdiv' => true);
        $rs = get_recordset_sql($sql, $start, $this->commentsperpage);
        foreach ($rs as $u) {
            $u = (object)$u;
            $c = new stdClass();
            $c->id          = $u->cid;
            $c->userid      = $u->id;
            $c->content     = $u->ccontent;
            $c->format      = $u->cformat;
            $c->timecreated = $u->ctimecreated;
            $url = new moodle_url('/user/view.php', array('id'=>$u->id, 'course'=>$this->courseid));
            $c->profileurl = $url->out();
            $c->fullname = fullname($u);
            $c->time = userdate($c->timecreated, get_string('strftimerecent', 'langconfig'));
            $c->content = format_text($c->content, $c->format, (object)$formatoptions);

            $c->avatar = print_user_picture($u, SITEID, $u->picture, 18, true);
            if (($USER->id == $u->id) || !empty($candelete)) {
                $c->delete = true;
            }
            $comments[] = $c;
        }
        $rs->close();

        if (!empty($this->plugintype)) {
            // moodle module will filter comments
            $comments = plugin_callback($this->plugintype, $this->pluginname, FEATURE_COMMENT, 'display', array($comments, $this->args), $comments);
        }

        return $comments;
    }

    public function get_latest_comment() {
        global $CFG, $USER;

        if (empty($this->viewcap)) {
            return false;
        }
        $sql = "SELECT u.*, c.id AS cid, c.content AS ccontent, c.format AS cformat, c.timecreated AS ctimecreated
                  FROM {$CFG->prefix}comments c
                  JOIN {$CFG->prefix}user u ON u.id = c.userid
                  WHERE c.contextid =  {$this->contextid} AND c.commentarea = '{$this->commentarea}' AND c.itemid = {$this->itemid}
              ORDER BY c.timecreated DESC";

        return get_record_sql($sql, true);
    }

    public function count() {
        if ($count = count_records('comments', 'itemid', $this->itemid, 'commentarea', $this->commentarea, 'contextid', $this->context->id)) {
            return $count;
        } else {
            return 0;
        }
    }

    public function get_pagination($page = 0) {
        global $DB, $CFG;
        $count = $this->count();
        $pages = (int)ceil($count / $this->commentsperpage);
        if ($pages == 1 || $pages == 0) {
            return '';
        }
        if (!empty(self::$nonjs)) {
            // used in non-js interface
            ob_start();
            print_paging_bar($count, $page, $this->commentsperpage, $this->link.'&amp;', 'comment_page');
            $out = ob_get_contents();
            ob_end_clean();

            return $out;
        } else {
            // return ajax paging bar
            $str = '';
            $str .= '<div class="comment-paging" id="comment-pagination-'.$this->cid.'">';
            for ($p=0; $p<$pages; $p++) {
                if ($p == $page) {
                    $class = 'curpage';
                } else {
                    $class = 'pageno';
                }
                $str .= '<a href="#" class="'.$class.'" id="comment-page-'.$this->cid.'-'.$p.'">'.($p+1).'</a> ';
            }
            $str .= '</div>';
        }
        return $str;
    }

    /**
     * Add a new comment
     * @param string $content
     * @return mixed
     */
    public function add($content, $format = FORMAT_MOODLE) {
        global $CFG, $USER;
        if (empty($this->postcap)) {
            //throw new comment_exception('nopermissiontocomment');
            print_error('nopermissiontocomment');
        }
        $now = time();
        $newcmt = new stdClass();
        $newcmt->contextid    = $this->contextid;
        $newcmt->commentarea  = $this->commentarea;
        $newcmt->itemid       = $this->itemid;
        $newcmt->content      = $content;
        $newcmt->format       = $format;
        $newcmt->userid       = $USER->id;
        $newcmt->timecreated  = $now;

        if (!empty($this->plugintype)) {
            // moodle module will check content
            $ret = plugin_callback($this->plugintype, $this->pluginname, FEATURE_COMMENT, 'add', array(&$newcmt, $this->args), true);
            if (!$ret) {
                //throw new comment_exception('modulererejectcomment');
                print_error('modulererejectcomment');
            }
        }

        $cmt_id = insert_record('comments', $newcmt);
        if (!empty($cmt_id)) {
            // Get the fresh record
            $newcmt = get_record('comments', 'id', $cmt_id);

            $newcmt->time = userdate($now, get_string('strftimerecent', 'langconfig'));
            $newcmt->fullname = fullname($USER);
            $url = new moodle_url('/user/view.php', array('id'=>$USER->id, 'course'=>$this->courseid));
            $newcmt->profileurl = $url->out();
            $newcmt->content = format_text($newcmt->content, $format, (object)array('overflowdiv'=>true));
            $newcmt->avatar = print_user_picture($USER, SITEID, $USER->picture, 18, true);
            return $newcmt;
        } else {
            //throw new comment_exception('dbupdatefailed');
            print_error('dbupdatefailed');
        }
    }

    /**
     * delete by context, commentarea and itemid
     * @param object $param {
     *            contextid => int the context in which the comments exist [required]
     *            commentarea => string the comment area [optional]
     *            itemid => int comment itemid [optional]
     * }
     * @return boolean
     */
    public function delete_comments($param) {
        $param = (array)$param;
        if (empty($param['contextid']) || empty($param['commentarea']) || empty($param['itemid'])) {
            return false;
        }
        delete_records('comments', 'contextid', $param['contextid'], 'commentarea', $param['commentarea'], 'itemid', $param['itemid']);
        return true;
    }

    /**
     * Delete page_comments in whole course, used by course reset
     * @param object $context course context
     */
    public function reset_course_page_comments($context) {
        $contexts = array();
        $contexts[] = $context->id;
        $children = get_child_contexts($context);
        foreach ($children as $c) {
            $contexts[] = $c->id;
        }
        list($ids, $params) = $DB->get_in_or_equal($contexts);
        if ($contexts) {
            $cids = implode(',', array_keys($contexts));
            delete_records_select('comments', "commentarea='page_comments' AND contextid IN ({$contexts})");
        }
    }

    /**
     * Delete a comment
     * @param  int $commentid
     * @return mixed
     */
    public function delete($commentid) {
        global $USER;
        $candelete = has_capability('local/comment:delete', $this->context);
        if (!$comment = get_record('comments', 'id', $commentid)) {
            //throw new comment_exception('dbupdatefailed');
            print_error('dbupdatefailed');
        }
        if (!($USER->id == $comment->userid || !empty($candelete))) {
            //throw new comment_exception('nopermissiontocomment');
            print_error('nopermissiontocomment');
        }
        delete_records('comments', 'id', $commentid);
        return true;
    }

    /**
     * Print comments
     * @param int $page
     * @param boolean $return return comments list string or print it out
     * @param boolean $nonjs print nonjs comments list or not?
     * @return mixed
     */
    public function print_comments($page = 0, $return = true, $nonjs = true) {
        global $CFG, $USER, $FULLME;
        $html = '';
        if (!(self::$comment_itemid == $this->itemid &&
            self::$comment_context == $this->context->id &&
            self::$comment_area == $this->commentarea)) {
            $page = 0;
        }
        $comments = $this->get_comments($page);

        $html = '';
        if ($nonjs) {
            $html .= "<ul id='comment-list-$this->cid' class='comment-list'>";
        }
        $results = array();
        $list = '';

        foreach ($comments as $cmt) {
            $commentclass = $USER->id == $cmt->userid ? 'comment-own-post' : 'comment-others-post';
            $list .= '<li id="comment-'.$cmt->id.'-'.$this->cid.'" class="'.$commentclass.'">'.$this->print_comment($cmt, $nonjs).'</li>';
        }
        $html .= $list;
        if ($nonjs) {
            $html .= '</ul>';
            $html .= $this->get_pagination($page);
        }
        $sesskey = sesskey();
        $returnurl = $FULLME;
        $strsubmit = get_string('submit');
        if ($nonjs) {
        $html .= <<<EOD
<div class='comment-area'>
    <form method="POST" action="{$CFG->wwwroot}/local/comment/comment_post.php">
    <textarea name="content" rows="5" cols="20"></textarea>
    <input type="hidden" name="contextid" value="$this->contextid" />
    <input type="hidden" name="action" value="add" />
    <input type="hidden" name="area" value="$this->commentarea" />
    <input type="hidden" name="component" value="$this->component" />
    <input type="hidden" name="itemid" value="$this->itemid" />
    <input type="hidden" name="courseid" value="{$this->courseid}" />
    <input type="hidden" name="sesskey" value="{$sesskey}" />
    <input type="hidden" name="returnurl" value="{$returnurl}" />
    <div class="fd">
    <input type="submit" value="{$strsubmit}" />
    </div>
    </form>
</div>
EOD;
        }
        if ($return) {
            return $html;
        } else {
            echo $html;
        }
    }

    public function print_comment($cmt, $nonjs = true) {
        global $CFG;

        $patterns = array();
        $replacements = array();

        if (!empty($cmt->delete)) {
            if (empty($nonjs)) {
                $cmt->content = '<div class="comment-delete"><a href="#" id ="comment-delete-'.$this->cid.'-'.$cmt->id.'"><img src="'.$CFG->pixpath.'/t/comment-delete.gif" alt="'.get_string('delete').'" /></a></div>' . $cmt->content;
                // add the button
            } else {
                $cmt->content = '<div class="comment-delete">
                    <a href="'.$CFG->wwwroot.'/local/comment/comment_ajax.php?ajax=0&amp;area='.$this->commentarea.'&amp;contextid='.$this->contextid.'&amp;commentid='.$cmt->id.'&amp;client_id='.$this->cid.'&amp;sesskey='.sesskey().'&amp;itemid='.$this->itemid.'&amp;action=delete&amp;component=plan" id="comment-delete-'.$this->cid.'-'.$cmt->id.'">
                        <img src="'.$CFG->pixpath.'/t/comment-delete.gif" alt="'.get_string('delete').'" />
                    </a></div>' . $cmt->content;
            }
        }
        $patterns[] = '___picture___';
        $patterns[] = '___name___';
        $patterns[] = '___content___';
        $patterns[] = '___time___';
        $replacements[] = $cmt->avatar;
        $replacements[] = '<a href="'.$cmt->profileurl.'">'.$cmt->fullname.'</a>';
        $replacements[] = $cmt->content;
        $replacements[] = userdate($cmt->timecreated, get_string('strftimerecent', 'langconfig'));

        // use html template to format a single comment.
        return str_replace($patterns, $replacements, $this->template);
    }
}
/*
class comment_exception extends moodle_exception {
    public $message;
    function __construct($errorcode) {
        $this->errorcode = $errorcode;
        $this->message = get_string($errorcode, 'error');
    }
}*/
