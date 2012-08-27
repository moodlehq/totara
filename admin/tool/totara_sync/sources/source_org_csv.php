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

require_once($CFG->dirroot.'/admin/tool/totara_sync/sources/classes/source.org.class.php');
require_once($CFG->dirroot.'/admin/tool/totara_sync/lib.php');

class totara_sync_source_org_csv extends totara_sync_source_org {

    function get_filepath() {
        return empty($this->filesdir) ? '' : $this->filesdir.'/csv/ready/org.csv';
    }

    function config_form(&$mform) {
        $filepath = $this->get_filepath();
        if (empty($filepath)) {
            $mform->addElement('html', html_writer::tag('p', get_string('nofilesdir', 'tool_totara_sync')));
            return false;
        }

        // Display file example
        $fieldmappings = array();
        foreach ($this->fields as $f) {
            if (!empty($this->config->{'fieldmapping_'.$f})) {
                $fieldmappings[] = '"'.$this->config->{'fieldmapping_'.$f}.'"';
            } else {
                $fieldmappings[] = '"'.$f.'"';
            }
        }
        $mform->addElement('html',  html_writer::tag('div', html_writer::tag('p', get_string('csvimportfilestructinfo', 'tool_totara_sync', implode(',', $fieldmappings)), array('class' => "informationbox"))));

        // Add some source file details
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
            $this->addlog(get_string('xnotfound', 'tool_totara_sync', $filepath),
                'error', 'populatesynctablecsv');
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
            $this->addlog(get_string('cannotopenx', 'tool_totara_sync',
                $filepath), 'error', 'populatesynctablecsv');
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
            if (empty($this->config->{'fieldmapping_'.$f})) {
                $fieldmappings[$f] = $f;
            } else {
                $fieldmappings[$this->config->{'fieldmapping_'.$f}] = $f;
            }
        }
        // Ensure necessary fields are present
        foreach ($fieldmappings as $f => $m) {
            if (!in_array($f, $fields)) {
                if ($m == 'typeidnumber') {
                    // typeidnumber field can be optional if no custom fields specified
                    $customfieldspresent = false;
                    foreach ($fields as $ff) {
                        if (preg_match('/^customfield_/', $ff)) {
                            $customfieldspresent = true;
                            break;
                        }
                    }
                    if (!$customfieldspresent) {
                        // No typeidnumber and no customfields; this is not a problem then ;)
                        continue;
                    }
                }
                $errorstr = get_string('csvnotvalidmissingfieldx', 'tool_totara_sync', $f);
                $errorstr .= ($f != $m) ? ' ('.get_string('mappingforx', 'tool_totara_sync', $m).')' : '';
                $this->addlog($errorstr, 'error', 'mapfields');
                return false;
            }
        }
        // Finally, perform CSV to db field mapping
        foreach ($fields as $i => $f) {
            if (!preg_match('/^customfield_/', $f)) {
                if (in_array($f, array_keys($fieldmappings))) {
                    $fields[$i] = $fieldmappings[$f];
                }
            }
        }
        unset($fieldmappings);


        /// Populate temp sync table from CSV
        $now = time();
        $datarows = array();    // holds csv row data
        $dbpersist = TOTARA_SYNC_DBROWS;  // # of rows to insert into db at a time
        $rowcount = 0;

        while ($row = fgetcsv($file)) {
            $row = array_combine($fields, $row);  // nice associative array ;)

            // clean the data a bit
            $row = array_map('trim', $row);
            $row = array_map(create_function('$s', 'return clean_param($s, PARAM_TEXT);'), $row);

            $row['parentidnumber'] = $row['parentidnumber'] == $row['idnumber'] ? '' : $row['parentidnumber'];
            $row['typeidnumber'] = !empty($row['typeidnumber']) ? $row['typeidnumber'] : '';
            $row['timemodified'] = empty($row['timemodified']) ? $now : $row['timemodified'];

            // Custom fields
            $customfieldkeys = preg_grep('/^customfield_.*/', $fields);
            if (!empty($customfieldkeys)) {
                $customfields = array();
                foreach ($customfieldkeys as $key) {
                    $customfields[$key] = $row[$key];
                    unset($row[$key]);
                }

                $row['customfields'] = json_encode($customfields);
            }

            $datarows[] = $row;
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
