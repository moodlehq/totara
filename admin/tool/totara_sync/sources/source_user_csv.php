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

require_once($CFG->dirroot.'/admin/tool/totara_sync/sources/classes/source.user.class.php');
require_once($CFG->dirroot.'/admin/tool/totara_sync/lib.php');

class totara_sync_source_user_csv extends totara_sync_source_user {

    function get_filepath() {
        return empty($this->filesdir) ? '' : $this->filesdir.'/csv/ready/user.csv';
    }

    function config_form(&$mform) {
        $filepath = $this->get_filepath();
        if (empty($filepath)) {
            $mform->addElement('html', html_writer::tag('p', get_string('nofilesdir', 'tool_totara_sync')));
            return false;
        }

        /// Display file example
        $fieldmappings = array();
        foreach ($this->fields as $f) {
            if (!empty($this->config->{'fieldmapping_'.$f})) {
                $fieldmappings[$f] = $this->config->{'fieldmapping_'.$f};
            }
        }
        $filestruct = array();
        foreach ($this->fields as $f) {
            if (!empty($this->config->{'import_'.$f})) {
                $filestruct[] = !empty($fieldmappings[$f]) ? '"'.$fieldmappings[$f].'"' : '"'.$f.'"';
            }
        }
        foreach (array_keys($this->customfields) as $f) {
            if (!empty($this->config->{'import_'.$f})) {
                $filestruct[] = '"'.$f.'"';
            }
        }
        // add stupid line breaks :(
        $fcount = 0;
        foreach ($filestruct as $i => $f) {
            if (!empty($fcount) && !($fcount % 8)) {
                $filestruct[$i] = html_writer::empty_tag('br').$f;
            }
            $fcount++;
        }
        unset($fcount);

        $filestruct = implode(',', $filestruct);
        $mform->addElement('html', html_writer::tag('div', html_writer::tag('p', get_string('csvimportfilestructinfo', 'tool_totara_sync', $filestruct)), array('class' => "informationbox")));

        /// Add some source file details
        $mform->addElement('header', 'fileheader', get_string('filedetails', 'tool_totara_sync'));
        $mform->addElement('static', 'nameandloc', get_string('nameandloc', 'tool_totara_sync'),
            html_writer::tag('strong', $filepath));

        parent::config_form($mform);
    }

    function import_data($temptable) {

        if (!$this->filesdir) {
            $this->addlog(get_string('nofilesdir', 'tool_totara_sync'), 'error', 'populatesynctablecsv');
            return false;
        }
        $filepath = $this->get_filepath();
        if (!file_exists($filepath)) {
            $this->addlog(get_string('xnotfound', 'tool_totara_sync', $filepath), 'error', 'populatesynctablecsv');
            return false;
        }
        $filemd5 = md5_file($filepath);
        while (true) {
            // Ensure file is not currently being written to
            sleep(2);
            $newmd5 = md5_file($filepath);
            if ($filemd5 != $newmd5) {
                $filemd5 = $newmd5;
            } else {
                break;
            }
        }
        if (!$file = fopen($filepath, 'r')) {
            $this->addlog(get_string('cannotopenx', 'tool_totara_sync', $filepath),
                'error', 'populatesynctablecsv');
            return false;
        }

        /// Move file to store folder
        $storedir = $this->filesdir.'/csv/store';
        if (!totara_sync_make_dirs($storedir)) {
            $this->addlog(get_string('cannotcreatedirx', 'tool_totara_sync',
                $currdir), 'error', 'populatesynctablecsv');
            return false;
        }
        rename($filepath, $storedir.'/'.time().'.'.basename($filepath));

        /// Map CSV fields
        $fields = fgetcsv($file);
        $fieldmappings = array();
        foreach ($this->fields as $f) {
            if (empty($this->config->{'import_'.$f})) {
                continue;
            }
            if (!empty($this->config->{'fieldmapping_'.$f})) {
                $fieldmappings[$this->config->{'fieldmapping_'.$f}] = $f;
            }
        }
        // Ensure necessary mapped fields are present in the CSV
        foreach ($fieldmappings as $m => $f) {
            if (!in_array($m, $fields)) {
                $errorstr = get_string('csvnotvalidmissingfieldx', 'tool_totara_sync', $m);
                $errorstr .= ($m != $f) ? ' ('.get_string('mappingforx', 'tool_totara_sync', $f).')' : '';
                $this->addlog($errorstr, 'error', 'mapfieldscheck');
                return false;
            }
        }
        // Finally, perform CSV to db field mapping
        foreach ($fields as $i => $f) {
            if (in_array($f, array_keys($fieldmappings))) {
                $fields[$i] = $fieldmappings[$f];
            }
        }

        /// Check field integrity
        foreach ($this->fields as $f) {
            if (empty($this->config->{'import_'.$f}) || in_array($f, $fieldmappings)) {
                // Disabled or mapped fields can be ignored
                continue;
            }
            if (!in_array($f, $fields)) {
                $this->addlog(get_string('csvnotvalidmissingfieldx', 'tool_totara_sync', $f), 'error', 'importdata');
                return false;
            }
        }
        foreach (array_keys($this->customfields) as $f) {
            if (empty($this->config->{'import_'.$f})) {
                // Disabled custom fields can be ignored
                continue;
            }
            if (!in_array($f, $fields)) {
                $this->addlog(get_string('csvnotvalidmissingfieldx', 'tool_totara_sync', $f), 'error', 'importdata');
                return false;
            }
        }
        unset($fieldmappings);

        ///
        /// Populate temp sync table from CSV
        ///
        $now = time();
        $datarows = array();    // holds csv row data
        $dbpersist = TOTARA_SYNC_DBROWS;  // # of rows to insert into db at a time
        $rowcount = 0;

        while ($csvrow = fgetcsv($file)) {
            $csvrow = array_combine($fields, $csvrow);  // nice associative array ;)

            // clean the data a bit
            $csvrow = array_map('trim', $csvrow);
            $csvrow = array_map(create_function('$s', 'return clean_param($s, PARAM_TEXT);'), $csvrow);

            // Set up a db row
            $dbrow = array();

            // General fields
            foreach ($this->fields as $f) {
                if (!empty($this->config->{'import_'.$f})) {
                    $dbrow[$f] = $csvrow[$f];
                }
            }
            $dbrow['timemodified'] = empty($dbrow['timemodified']) ? $now : $dbrow['timemodified'];

            // Custom fields are special - needs to be json-encoded
            if (!empty($this->customfields)) {
                $cfield_data = array();
                foreach (array_keys($this->customfields) as $cf) {
                    if (!empty($this->config->{'import_'.$cf})) {
                        $cfield_data[$cf] = $csvrow[$cf];
                    }
                }
                $dbrow['customfields'] = json_encode($cfield_data);
                unset($cfield_data);
            }

            $datarows[] = $dbrow;
            $rowcount++;

            if ($rowcount >= $dbpersist) {
                // bulk insert
                if (!totara_sync_bulk_insert($temptable, $datarows)) {
                    $this->addlog(get_string('couldnotimportallrecords', 'tool_totara_sync'), 'error', 'populatesynctablecsv');
                    return false;
                }

                $rowcount = 0;
                unset($datarows);
                $datarows = array();

                gc_collect_cycles();
            }
        }  // while


        // Insert remaining rows
        if (!totara_sync_bulk_insert($temptable, $datarows)) {
            $this->addlog(get_string('couldnotimportallrecords', 'tool_totara_sync'), 'error', 'populatesynctablecsv');
            return false;
        }

        fclose($file);

        return true;
    }
}
