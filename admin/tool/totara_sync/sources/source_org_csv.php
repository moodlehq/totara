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
        global $CFG;

        $filepath = $this->get_filepath();
        if (empty($filepath) && get_config('totara_sync', 'fileaccess') == FILE_ACCESS_DIRECTORY) {
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
        if (get_config('totara_sync', 'fileaccess') == FILE_ACCESS_DIRECTORY) {
             $mform->addElement('static', 'nameandloc', get_string('nameandloc', 'tool_totara_sync'),
                 html_writer::tag('strong', $filepath));
        } else {
             $link = "{$CFG->wwwroot}/admin/tool/totara_sync/admin/uploadsourcefiles.php";
             $mform->addElement('static', 'uploadfilelink', get_string('uploadfilelink', 'tool_totara_sync', $link));
        }

        parent::config_form($mform);
    }

    function import_data($temptable) {
        global $CFG, $DB;

        $fileaccess = get_config('totara_sync', 'fileaccess');
        if ($fileaccess == FILE_ACCESS_DIRECTORY) {
            if (!$this->filesdir) {
                throw new totara_sync_exception($this->get_element_name(), 'populatesynctablecsv',
                    'nofilesdir');
            }
            $filepath = $this->get_filepath();
            if (!file_exists($filepath)) {
                throw new totara_sync_exception($this->get_element_name(), 'populatesynctablecsv', 'nofiletosync', $filepath, null, 'warn');
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

            // See if file is readable
            if (!$file = is_readable($filepath)) {
                throw new totara_sync_exception($this->get_element_name(), 'populatesynctablecsv',
                    'cannotreadx', $filepath);
            }

            /// Move file to store folder
            $storedir = $this->filesdir . '/csv/store';
            if (!totara_sync_make_dirs($storedir)) {
                throw new totara_sync_exception($this->get_element_name(), 'populatesynctablecsv',
                    'cannotcreatedirx', $storedir);
            }

            $storefilepath = $storedir . '/' . time() . '.' .basename($filepath);

            rename($filepath, $storefilepath);
        } else if ($fileaccess == FILE_ACCESS_UPLOAD) {
            $fs = get_file_storage();
            $systemcontext = get_context_instance(CONTEXT_SYSTEM);
            $fieldid = get_config('totara_sync', 'sync_org_itemid');

            //check the file exists
            if (!$fs->file_exists($systemcontext->id, 'totara_sync', 'org', $fieldid, '/', '')) {
                throw new totara_sync_exception($this->get_element_name(), 'populatesynctablecsv', 'nofileuploaded', $this->get_element_name(), null, 'warn');
            }

            // Get the file
            $fsfiles = $fs->get_area_files($systemcontext->id, 'totara_sync', 'org', $fieldid, 'id DESC', false);
            $fsfile = reset($fsfiles);

            //set up the temp dir
            $tempdir = $CFG->tempdir . '/totarasync/csv';
            check_dir_exists($tempdir, true, true);

            //create temporary file (so we know the filepath)
            $fsfile->copy_content_to($tempdir.'/org.php');
            $itemid = $fsfile->get_itemid();
            $fs->delete_area_files($systemcontext->id, 'totara_sync', 'org', $itemid);
            $storefilepath = $tempdir.'/org.php';

        }

        // Open file from store for processing
        if (!$file = fopen($storefilepath, 'r')) {
            throw new totara_sync_exception($this->get_element_name(), 'populatesynctablecsv',
                'cannotopenx', $storefilepath);
        }

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
                if ($f == $m) {
                    throw new totara_sync_exception($this->get_element_name(), 'mapfields',
                        'csvnotvalidmissingfieldx', $f);
                } else {
                    throw new totara_sync_exception($this->get_element_name(), 'mapfields',
                        'csvnotvalidmissingfieldxmappingx',
                        (object)array('field' => $f, 'mapping' => $m));
                }
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
        $fieldcount = new object();
        $fieldcount->headercount = count($fields);
        $fieldcount->rownum = 0;

        $csvdateformat = (isset($CFG->csvdateformat)) ? $CFG->csvdateformat : get_string('csvdateformatdefault', 'totara_core');

        while ($row = fgetcsv($file)) {
            $fieldcount->rownum++;
            // skip empty rows
            if (is_array($row) && current($row) === null) {
                $fieldcount->fieldcount = 0;
                $this->addlog(get_string('fieldcountmismatch', 'tool_totara_sync', $fieldcount), 'error', 'populatesynctablecsv');
                continue;
            }
            $fieldcount->fieldcount = count($row);
            if ($fieldcount->fieldcount !== $fieldcount->headercount) {
                $this->addlog(get_string('fieldcountmismatch', 'tool_totara_sync', $fieldcount), 'error', 'populatesynctablecsv');
                continue;
            }
            $row = array_combine($fields, $row);  // nice associative array ;)

            // clean the data a bit
            $row = array_map('trim', $row);
            $row = array_map(create_function('$s', 'return clean_param($s, PARAM_TEXT);'), $row);

            $row['parentidnumber'] = $row['parentidnumber'] == $row['idnumber'] ? '' : $row['parentidnumber'];
            $row['typeidnumber'] = !empty($row['typeidnumber']) ? $row['typeidnumber'] : '';

            if (empty($row['timemodified'])) {
                $row['timemodified'] = $now;
            } else {
                //try to parse the contents - if parse fails assume a unix timestamp and leave unchanged
                $parsed_date = totara_date_parse_from_format($csvdateformat, trim($row['timemodified']));
                if ($parsed_date) {
                    $row['timemodified'] = $parsed_date;
                }
            }

            // Custom fields - need to handle custom field formats like dates here
            $customfieldkeys = preg_grep('/^customfield_.*/', $fields);
            if (!empty($customfieldkeys)) {
                $customfields = array();
                foreach ($customfieldkeys as $key) {
                    //get shortname and check if we need to do field type processing
                    $value = trim($row[$key]);
                    if (!empty($value)) {
                        $shortname = str_replace('customfield_', '', $key);
                        $datatype = $DB->get_field('org_type_info_field', 'datatype', array('shortname' => $shortname));
                        switch ($datatype) {
                            case 'datetime':
                                //try to parse the contents - if parse fails assume a unix timestamp and leave unchanged
                                $parsed_date = totara_date_parse_from_format($csvdateformat, $value);
                                if ($parsed_date) {
                                    $value = $parsed_date;
                                }
                                break;
                            default:
                                break;
                        }
                    }
                    $customfields[$key] = $value;
                    unset($row[$key]);
                }

                $row['customfields'] = json_encode($customfields);
            }

            $datarows[] = $row;
            $rowcount++;

            if ($rowcount >= $dbpersist) {
                // bulk insert
                try {
                    totara_sync_bulk_insert($temptable, $datarows);
                } catch (dml_exception $e) {
                    throw new totara_sync_exception($this->get_element_name(), 'populatesynctablecsv', 'couldnotimportallrecords', $e->getMessage());
                }

                $rowcount = 0;
                unset($datarows);
                $datarows = array();

                gc_collect_cycles();
            }
        }  // while

        // Insert remaining rows
        try {
            totara_sync_bulk_insert($temptable, $datarows);
        } catch (dml_exception $e) {
            throw new totara_sync_exception($this->get_element_name(), 'populatesynctablecsv', 'couldnotimportallrecords', $e->getMessage());
        }

        fclose($file);

        //done, clean up the file(s)
        if ($fileaccess == FILE_ACCESS_UPLOAD) {
            unlink($storefilepath); //don't store this file in temp
        }

        return true;
    }
}
