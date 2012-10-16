<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
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
 * @package totara
 * @subpackage totara_sync
 */

require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/admin/tool/totara_sync/lib.php');
require_once($CFG->dirroot.'/admin/tool/totara_sync/admin/forms.php');

admin_externalpage_setup('uploadsyncfiles');

$form = new totara_sync_source_files_form();

/// Process actions
if ($data = $form->get_data()) {

    $elements = totara_sync_get_elements($onlyenabled=true);

    // Save files to temporary location
    $tempdir = $CFG->tempdir.'/totarasync';
    check_dir_exists($tempdir, true, true);


    foreach ($elements as $e) {
        $elementname = $e->get_name();
        if (!$form->hasFile($elementname)) {
            continue;
        }
        $source = $e->get_source();
        $f = basename($source->get_filepath());
        if (!$form->save_file($e->get_name(), $tempdir.'/'.$f, true)) {
            totara_set_notification(get_string('uploaderror', 'tool_totara_sync'), $FULLME);
        }
    }

    // Move files to source's 'ready' folders
    $readyfiles = array();
    foreach ($elements as $e) {
        $source = $e->get_source();
        if ($source) {
            $sfilepath = $source->get_filepath();
            $tfilepath = $tempdir . '/' . basename($sfilepath);
            if (file_exists($tfilepath)) {
                if (!totara_sync_make_dirs(dirname($sfilepath))) {
                    totara_set_notification(get_string('couldnotmakedirsforx', 'tool_totara_sync', $sfilepath), $FULLME);
                }
                rename($tfilepath, $sfilepath . '.copying');  // will remove the .copying when all files are moved
                $readyfiles[] = $sfilepath . '.copying';
            } else {
                continue;
            }
        }
    }

    // Now remove the appended .copying from the filenames
    // Done this way to ensure that files are not picked up when copying/moving is in progress
    foreach ($readyfiles as $f) {
        rename($f, str_replace('.copying', '', $f));
    }

    totara_set_notification(get_string('uploadsuccess', 'tool_totara_sync'), $FULLME,
        array('class'=>'notifysuccess'));
}


/// Output
echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('uploadsyncfiles', 'tool_totara_sync'));

if (!get_config('totara_sync', 'filesdir')) {
    print_string('nofilesdir', 'tool_totara_sync');
} else {
    $form->display();
}

echo $OUTPUT->footer();
