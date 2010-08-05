<?php
///////////////////////////////////////////////////////////////////////////
//                                                                       //
// This file is part of Moodle - http://moodle.org/                      //
// Moodle - Modular Object-Oriented Dynamic Learning Environment         //
//                                                                       //
// Moodle is free software: you can redistribute it and/or modify        //
// it under the terms of the GNU General Public License as published by  //
// the Free Software Foundation, either version 3 of the License, or     //
// (at your option) any later version.                                   //
//                                                                       //
// Moodle is distributed in the hope that it will be useful,             //
// but WITHOUT ANY WARRANTY; without even the implied warranty of        //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         //
// GNU General Public License for more details.                          //
//                                                                       //
// You should have received a copy of the GNU General Public License     //
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.       //
//                                                                       //
///////////////////////////////////////////////////////////////////////////

/**
 * Oauth renderer.
 * @package   localoauth
 * @copyright 2010 Moodle Pty Ltd (http://moodle.com)
 * @author    Piers Harding
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
//class local_oauth_renderer extends plugin_renderer_base {
class local_oauth_renderer {

//    public function __construct(moodle_page $page, $target) {
    public function __construct() {
        //parent::__construct($page, $target);
//        $this->page->requires->css('/lib/gallery/assets/skins/sam/gallery-lightbox-skin.css');
        //$this->page->requires->css('/local/oauth/styles.css');
    }

    /**
     * Display a box message confirming a site registration (add or update)
     * @param string $confirmationmessage
     * @return string
     */
    public function registration_confirmation($confirmationmessage) {
        global $OUTPUT;
        $linktositelist = html_writer::tag('a', get_string('sitelist','local_oauth'), array('href' => new moodle_url('/index.php')));
        $message = $confirmationmessage.html_writer::empty_tag('br').$linktositelist;
        return $OUTPUT->box($message);
    }

    /**
     * Display a box confirmation message for removing a site from the directory
     * @param object $site - site to delete
     * @return string
     */
    public function delete_confirmation($site) {
        global $OUTPUT;
        $optionsyes = array('delete'=>$site->id, 'confirm'=>1, 'sesskey'=>sesskey());
        $optionsno  = array('sesskey'=>sesskey());
        $formcontinue = new single_button(new moodle_url("/local/oauth/admin/registrations.php", $optionsyes), get_string('delete'), 'post');
        $formcancel = new single_button(new moodle_url("/local/oauth/admin/registrations.php", $optionsno), get_string('cancel'), 'get');
        $sitename = html_writer::tag('strong', $site->name);
        return $OUTPUT->confirm(get_string('deleteconfirmation', 'local_oauth', $sitename), $formcontinue, $formcancel);
    }


    /**
     * Display a list of sites with a search box + title
     * @param array $sites
     * @param string $searchdefaultvalue the default value of the search text field
     * @param boolean $withwriteaccess
     * @return string
     */
    public function searchable_site_list($sites, $searchdefaultvalue = '', $withwriteaccess=true) {
        global $OUTPUT;
        return $this->search_box($searchdefaultvalue).
                html_writer::empty_tag('br').
                $this->site_list($sites,  $withwriteaccess);
    }


    /**
     * Display a search box
     * @param string $searchdefaultvalue the default value of the search text field
     * @return string
     */
    public function search_box($searchdefaultvalue = '') {
        global $OUTPUT;
        $searchtextfield = html_writer::empty_tag('input', array('type' => 'text',
                'name' => 'search', 'id' => 'search', 'value' => $searchdefaultvalue));
        $submitbutton = html_writer::empty_tag('input', array('type' => 'submit',
                'value' => get_string('search', 'local_oauth')));
        $formcontent = $searchtextfield . $submitbutton;
        $formcontent = html_writer::tag('div', $formcontent, array()); //input element cannot be straight
        //into a form element (XHTML strict)
        $searchform = html_writer::tag('form', $formcontent, array('action' => '',
                'method' => 'post'));
        return $searchform;
    }


    /**
     * Display a list of sites
     * If $withwriteaccess = true, we display visible field,
     * trust/prioritise button, and timecreated/modified information.
     * @param array $sites
     * @param boolean $withwriteaccess
     * @return string
     */
    public function site_list($sites,  $withwriteaccess=false) {
        global $OUTPUT, $CFG;

        $renderedhtml = '';

        $table = new html_table();

        if ($withwriteaccess) {
            $table->head  = array(get_string('sitename', 'local_oauth'),
                    get_string('consumer_key', 'local_oauth'),
                    get_string('consumer_secret', 'local_oauth'),
                    get_string('sitetokenurls', 'local_oauth'),
                    get_string('enabled', 'local_oauth'),
                    get_string('operation', 'local_oauth'));

            $table->align = array('left', 'left', 'left', 'left', 'center', 'left');
            $table->size = array('10%', '10%', '15%', '50%', '%5', '%10');
        } else {
            $table->head  = array(get_string('sitename', 'local_oauth'),
                    get_string('consumerkey', 'local_oauth'),
                    get_string('consumersecret', 'local_oauth'),
                    get_string('sitetokenurls', 'local_oauth'),
                    );

            $table->align = array('left', 'left', 'left');
            $table->size = array('10%', '20%', '20%', '50%');
        }

        if (empty($sites)) {
            $renderedhtml .= get_string('nosite', 'local_oauth');
        } else {

            $table->width = '100%';
            $table->data  = array();
            $table->attributes['class'] = 'sitedirectory';

            // iterate through sites and add to the display table
            foreach ($sites as $site) {

                $sitenamehtml = $site->name;
                $keyhtml = $site->consumer_key;
                $secrethtml = $site->consumer_secret;

                $urltab = new html_table();
                $urltab->align = array('left', 'left');
                $urltab->size = array('10%', '90%');
                $urltab->width = '100%';
                $urltab->attributes['class'] = 'siteurls';
                $urltab->data  = array();
                $urltab->data[] = new html_table_row(array(get_string('request', 'local_oauth'), $site->request_token_url));
                $urltab->data[] = new html_table_row(array(get_string('authorize', 'local_oauth'), $site->authorize_token_url));
                $urltab->data[] = new html_table_row(array(get_string('access', 'local_oauth'), $site->access_token_url));
                $siteurlshtml = html_writer::table($urltab);

                if ($withwriteaccess) {
                    //edit button
                    $editmsg = get_string('edit', 'local_oauth');
                    $editurl = new moodle_url("/local/oauth/admin/registrations.php",
                            array('sesskey' => sesskey(), 'edit' => $site->id));
                    $editbutton = new single_button($editurl, $editmsg);
//                    $editbuttonhtml = $OUTPUT->render($editbutton);
                    $editbuttonhtml = core_renderer::render_single_button($editbutton);

                    //enabled
                    if ($site->enabled) {
//                        $hideimgtag = html_writer::empty_tag('img', array('src' => $OUTPUT->pix_url('i/hide'),
                        $hideimgtag = html_writer::empty_tag('img', array('src' => $CFG->pixpath.'/i/hide.gif',
                                'class' => 'siteimage', 'alt' => get_string('disable')));
                        $makeenabled = false;
                    } else {
//                        $hideimgtag = html_writer::empty_tag('img', array('src' => $OUTPUT->pix_url('i/show'),
                        $hideimgtag = html_writer::empty_tag('img', array('src' => $CFG->pixpath.'/i/show.gif',
                                'class' => 'siteimage', 'alt' => get_string('enable')));
                        $makeenabled = true;
                    }
                    $enabledurl = new moodle_url("/local/oauth/admin/registrations.php",
                            array('sesskey' => sesskey(), 'enabled' => $makeenabled, 'id' => $site->id));
                    $enabledhtml = html_writer::tag('a', $hideimgtag, array('href' => $enabledurl));

                    //delete link
                    $deleteeurl = new moodle_url("/local/oauth/admin/registrations.php",
                            array('sesskey' => sesskey(), 'delete' => $site->id));
                    $deletelinkhtml = html_writer::tag('a', get_string('delete'), array('href' => $deleteeurl));

                    // setup the operation buttons/links
                    $oprtab = new html_table();
                    $oprtab->align = array('left', 'left');
                    $oprtab->size = array('50%', '50%');
                    $oprtab->width = '100%';
                    $oprtab->attributes['class'] = 'siteurls';
                    $oprtab->data  = array(new html_table_row(array($editbuttonhtml, $deletelinkhtml)));
                    // add a row to the table
                    $cells = array($sitenamehtml, $keyhtml, $secrethtml, $siteurlshtml, $enabledhtml,
                                   html_writer::table($oprtab));

                } else {
                    // add a row to the table
                    $cells = array($sitenamehtml, $keyhtml, $secrethtml, $siteurlshtml);
                }

                $row = new html_table_row($cells);
                $table->data[] = $row;
            }
            $renderedhtml .= html_writer::table($table);
        }
        return $renderedhtml;
    }

}
