<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

require_once($CFG->dirroot.'/grade/export/lib.php');

class grade_export_fusion extends grade_export {

    public $plugin = 'fusion';

    public $separator; // default separator

    public $tablename; // The table being created

    public function grade_export_fusion($course, $groupid=0, $itemlist='', $export_feedback=false, $updatedgradesonly = false, $displaytype = GRADE_DISPLAY_TYPE_REAL, $decimalpoints = 2, $tablename = false, $separator='comma') {
        $this->grade_export($course, $groupid, $itemlist, $export_feedback, $updatedgradesonly, $displaytype, $decimalpoints);
        $this->separator = $separator;
        $this->tablename = preg_replace('/\s/', '_', clean_filename(trim($tablename)));
    }

    public function __construct($formdata) {
        parent::__construct($formdata);
        if (isset($formdata->separator)) {
            $this->separator = $formdata->separator;
        }
        if (isset($formdata->tablename)) {
            $this->tablename = preg_replace('/\s/', '_', clean_filename(trim($tablename)));
        }
    }

    public function set_table($tablename) {
            $this->tablename = preg_replace('/\s/', '_', clean_filename(trim($tablename)));
    }

    public function get_export_params() {
        $params = parent::get_export_params();
        $params['separator'] = $this->separator;
        $params['tablename'] = $this->tablename;
        return $params;
    }

    // dummy function
    public function print_grades() {
    }


    public function table_exists($tables, $name) {
        foreach ($tables as $table) {
            if ($table['name'] == $name) {
                return true;
            }
        }
        return false;
    }

    public function clean_column_name($name) {
        $name = preg_replace('/[^a-zA-Z0-9\_ ]/', ' ', $name);
        $name = preg_replace('/\s+/', ' ', $name);
        $name = preg_replace('/\s/', '_', $name);
        return $name;
    }

    public function export_grades($oauth) {
        global $CFG;

        //echo "<pre>";
        $export_tracking = $this->track_exports();

        $tables = $oauth->show_tables();
        if ($oauth->table_exists($this->tablename)) {
            //echo "Allready there\n";
            // tell them to delete it
        }
        else {
            $columns = array(
                         "firstname" => 'STRING',
                         "lastname" => 'STRING',
                         "idnumber" => 'STRING',
                         "institution" => 'STRING',
                         "department" => 'STRING',
                         "email" => 'STRING',
                         );

            foreach ($this->columns as $grade_item) {
                //echo ' | '.$this->format_column_name($grade_item);
                $column = self::clean_column_name($this->format_column_name($grade_item));
                $columns[$column] = 'NUMBER';
            }
            //echo "Creating table\n";
            $result = $oauth->create_table($this->tablename, $columns);

            //var_dump($result);
        }


        $tables = $oauth->show_tables();
        if ($oauth->table_exists($this->tablename)) {
            //echo "Allready there\n";
        }
        //var_dump($tables);


/// Print all the lines of data.
        $geub = new grade_export_update_buffer();
        $gui = new graded_users_iterator($this->course, $this->columns, $this->groupid);
        $gui->init();
        $rows = array();
        $separator = ' | ';
        while ($userdata = $gui->next_user()) {

            $user = $userdata->user;

            //echo $user->firstname.$separator.$user->lastname.$separator.$user->idnumber.$separator.$user->institution.$separator.$user->department.$separator.$user->email;
            $row = array($user->firstname, $user->lastname, $user->idnumber, $user->institution, $user->department, $user->email,);

            $grades = array();
            foreach ($userdata->grades as $itemid => $grade) {
                $grades[(int)$itemid]=  $this->format_grade($grade);
            }

            ksort($grades);
            //var_dump($grades);
            foreach ($grades as $itemid => $grade) {
                //echo $separator."($itemid)".$separator.$grade;
                $row[]=  $grade;
            }
            //echo "\n";
            $rows[]= $row;
        }
        $gui->close();
        $geub->close();

        $result = $oauth->insert_rows($this->tablename, $rows);

        $table = $oauth->table_by_name($this->tablename, true);
        $table_id = $table['table id'];
        redirect('http://tables.googlelabs.com/DataSource?dsrcid='.$table_id);
        exit;
    }



    /**
     * Either prints a "Export" box, which will redirect the user to the download page,
     * or prints the URL for the published data.
     * @return void
     */
    public function print_continue() {
        global $CFG, $OUTPUT;

        $params = $this->get_export_params();
        $return_to = new moodle_url('/grade/export/'.$this->plugin.'/export.php', $params);
        $params['return_to'] = urlencode($return_to->out());

        //echo $OUTPUT->heading(get_string('export', 'grades'));
        print_heading(get_string('export', 'grades'));

        //echo $OUTPUT->container_start('gradeexportlink');
        echo '<div class="gradeexportlink">';

        if (!$this->userkey) {      // this button should trigger a download prompt
            //echo $OUTPUT->single_button(new moodle_url('/grade/export/'.$this->plugin.'/export.php', $params), get_string('export', 'grades'));
            print_single_button($CFG->wwwroot.'/grade/export/'.$this->plugin.'/export.php',
                                $params, get_string('export', 'grades'));

        } else {
            $paramstr = '';
            $sep = '?';
            foreach($params as $name=>$value) {
                $paramstr .= $sep.$name.'='.$value;
                $sep = '&';
            }

            $link = $CFG->wwwroot.'/grade/export/'.$this->plugin.'/dump.php'.$paraM.str.'&key='.$this->userkey;

            //echo get_string('download', 'admin').': ' . html_writer::link($link, $link);
            echo get_string('download', 'admin').': <a href="'.$link.'">'.$link.'</a>';
        }
        //echo $OUTPUT->container_end();
        echo '</div>';

        //echo $OUTPUT->heading(get_string('tablename', 'local_oauth').': '.$this->tablename);
        print_heading(get_string('tablename', 'local_oauth').': '.$this->tablename);
    }

}


