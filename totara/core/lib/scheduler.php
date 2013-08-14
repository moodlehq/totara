<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010 - 2013 Totara Learning Solutions LTD
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
 * @author Valerii Kuznetsov <valerii.kuznetsov@totaralms.com>
 * @package totara
 * @subpackage core
 */

/**
 * This class incapsulates operation with scheduling
 *
 * It operates on DB row objects by changing it's fields. After applying changes on object, this
 * object should be saved in DB by $DB->insert_record or $DB->update_record
 *
 * To avoid overwriting other fields use scheduler::to_object().
 * This method will return object with only scheduler specific fields and 'id' field
 * Scheduler changes original object fields aswell, so no need to use scheduler::to_object() if you
 * save original object after applying scheduler changes.
 *
 * To support scheduling db table represented by operated db row object must have next fields:
 * frequency (int), schedule(int), nextevent (bigint)
 * If field(s) have dfferent names it can be configured via set_field method
 * Also, it has tight integration with Scheduler form element, and as result it's easily to integrate
 * them.
 */
class scheduler {
    /**
     *  Schedule constants
     *
     */
    const DAILY = 1;
    const WEEKLY = 2;
    const MONTHLY = 3;

    /**
     * DB row decorated object
     *
     * @var stdClass
     */
    protected $subject = null;

    /**
     * status changes
     *
     * @var bool
     */
    protected $changed = false;

    /**
     * Mapping of field names used by scheduler
     *
     * @var array
     */
    protected $map = array('frequency' => 'frequency',
                           'schedule' => 'schedule',
                           'nextevent' => 'nextevent');

    protected $time = 0;
    /**
     * Constructor
     *
     * @param object DB row object
     * @param array $alias_map Optional field renaming
     */
    public function __construct(stdClass $row = null, array $alias_map = array()) {
        if (is_null($row)) {
            $row = new stdClass();
        }
        $this->subject = $row;
        // Remap and add fields.
        foreach ($this->map as $k => $v) {
            $v = (isset($alias_map[$k])) ? $alias_map[$k] : $v;
            $this->set_field($k, $v);
            $this->subject->{$v} = isset($this->subject->{$v}) ? $this->subject->{$v} : null;
        }
        $this->set_time();
    }

    /**
     * Set operational time
     *
     * @param int $time
     */
    public function set_time($time = null) {
        if (is_null($time)) {
            $this->time = time();
        } else {
            $this->time = $time;
        }
    }

    /**
     * Change field name used by scheduler to filed represented in db row object
     *
     * @param string $name Name used in scheduler
     * @param string $alias Field used in DB
     */
    public function set_field($name, $alias) {
        if (isset($this->map[$name])) {
            $this->map[$name] = $alias;
        }
    }

    public function do_asap() {
        $this->changed = true;
        $this->subject->{$this->map['nextevent']} = $this->time - 1;
    }

    /**
     * Calculate next time of execution
     *
     * @return scheduler $this
     */
    public function next() {
        if (!isset($this->subject->{$this->map['frequency']})) {
            return $this;
        }
        $this->changed = true;
        $calendardays = calendar_get_days();
        $init = !isset($this->subject->{$this->map['nextevent']});
        $cache = property_exists($this->subject, 'cachetable');
        $frequency = $this->subject->{$this->map['frequency']};
        $schedule = $this->subject->{$this->map['schedule']};

        $timemonth = date('n', $this->time);
        $timeday = date('j', $this->time);
        $timeyear = date('Y', $this->time);

        switch ($frequency) {
            case self::DAILY:
                if (!$cache) {
                    // If the scheduled hour has passed then set the offset to 86400 (1 day).
                    $offset = ($init && date('G', $this->time) <= $schedule) ? 0 : 86400;
                } else {
                    $offset = (date('G', $this->time) < $schedule) ? 0 : 86400;
                }
                // Calculate next report time (startofcurrentday + offset + hourofschedule).
                $nextevent = mktime(0, 0, 0, $timemonth, $timeday, $timeyear) + $offset + ($schedule * 60 * 60);
                break;

            case self::WEEKLY:
                if ($init && strftime('%A', $this->time) == $calendardays[$schedule]) {
                    // If the today is the day then set the next reportdate to today.
                    $nextevent = mktime(0, 0, 0, $timemonth, $timeday, $timeyear);
                } else {
                    $nextevent = strtotime('next '. $calendardays[$schedule], $this->time);
                }
                break;

            case self::MONTHLY:
                if ($init && date('j', $this->time) == $schedule) {
                    // If the schedule is due to run today then nextreport is the start of today.
                    $nextevent = mktime(0, 0, 0, $timemonth, $timeday, $timeyear);
                } else {
                    $nextevent = self::get_next_monthly($this->time, $schedule);
                }
                break;
            default:
                $nextevent = 0;
        }
        $this->subject->{$this->map['nextevent']} = $nextevent;
        return $this;
    }

    /**
     * Check if it's time to run event
     *
     * @return bool
     */
    public function is_time() {
        return $this->subject->{$this->map['nextevent']} < $this->time;
    }

    /**
     * Is there any changes to object made by scheduler
     *
     * @return bool
     */
    public function is_changed() {
        return $this->changed;
    }

    /**
     * Get available scheduler options
     *
     * @return array
     */
    public static function get_options() {
        return array('daily' => self::DAILY,
                     'weekly' => self::WEEKLY,
                     'monthly' => self::MONTHLY);
    }

    /**
     * Given scheduled report frequency and schedule data, output a human readable string.
     *
     * @param integer Code representing the frequency of reports (one of Schedule::get_options)
     * @param integer The scheduled date/time (either hour of day, day or week or day of month)
     * @param object User object belonging to the recipient (optional). Defaults to current user
     * @return string Human readable string describing the schedule
     */
    public function get_formatted($user = null) {
        // Use current user if not set.
        if ($user === null) {
            global $USER;
            $user = $USER;
        }
        $calendardays = calendar_get_days();
        $dateformat = ($user->lang == 'en') ? 'jS' : 'j';
        $out = '';
        $schedule = $this->subject->{$this->map['schedule']};

        $timemonth = date('n', $this->time);
        $timeday = date('j', $this->time);
        $timeyear = date('Y', $this->time);

        switch($this->subject->{$this->map['frequency']}) {
            case self::DAILY:
                $out .= get_string('daily', 'totara_reportbuilder') . ' ' .  get_string('at', 'totara_reportbuilder') . ' ';
                $out .= strftime('%I:%M%p' , mktime($schedule, 0, 0, $timemonth, $timeday, $timeyear));
                break;
            case self::WEEKLY:
                $out .= get_string('weekly', 'totara_reportbuilder') . ' ' . get_string('on', 'totara_reportbuilder') . ' ';
                $out .= get_string($calendardays[$schedule], 'calendar');
                break;
            case self::MONTHLY:
                $out .= get_string('monthly', 'totara_reportbuilder') . ' ' . get_string('onthe', 'totara_reportbuilder') . ' ';
                $out .= date($dateformat , mktime(0, 0, 0, 0, $schedule, $timeyear));
                break;
        }

        return $out;
    }

    /**
     * Return timestamp when scheduled event is going to run
     * @return int timestamp
     */
    public function get_scheduled_time() {
        return $this->subject->{$this->map['nextevent']};
    }

    /**
     * Populate data based on initial array
     *
     * Compatible with scheduler form element data @see MoodleQuickForm_scheduler::exportValue()
     *
     * @param array $data - array with schedule parameters. If not set, default schedule will be applied
     */
    public function from_array(array $data = array()) {
        $this->changed = true;

        $data['frequency'] = isset($data['frequency']) ? $data['frequency'] : self::DAILY;
        $data['schedule'] = isset($data['schedule']) ? $data['schedule'] : 0;
        $data['initschedule'] = isset($data['initschedule']) ? $data['initschedule'] : false;
        $this->subject->{$this->map['frequency']} = $data['frequency'];
        $this->subject->{$this->map['schedule']} = $data['schedule'];
        // If no need in reinitialize, don't change nextreport value.
        if ($data['initschedule']) {
            $this->subject->{$this->map['nextevent']} = $this->time - 1;
        } else {
            $this->next();
        }
    }

    /**
     * Export scheduler parameters as an array
     * @return array
     */
    public function to_array() {
        $result = array(
                        'frequency' => $this->subject->{$this->map['frequency']},
                        'schedule' => $this->subject->{$this->map['schedule']},
                        'nextevent' => $this->subject->{$this->map['nextevent']},
                        'initschedule' => ($this->subject->{$this->map['nextevent']} <= $this->time)
        );
        return $result;
    }

    /**
     * Export scheduler parameters as an object
     *
     * Useful for saving in DB
     * @param mixed array|string $extrafields primary key name and other fields to export
     * @return stdClass
     */
    public function to_object($extrafields = 'id') {
        if (!is_array($extrafields)) {
            $extrafields = array($extrafields);
        }

        $obj = new stdClass();
        $obj->{$this->map['nextevent']} = $this->subject->{$this->map['nextevent']};
        $obj->{$this->map['frequency']} = $this->subject->{$this->map['frequency']};
        $obj->{$this->map['schedule']} = $this->subject->{$this->map['schedule']};
        foreach ($extrafields as $field) {
            if (isset($this->subject->$field)) {
                $obj->$field = $this->subject->$field;
            }
        }
        return $obj;
    }

    /**
     *  Calculates the next specified day of a month
     *  eg. the 3rd of next month
     *
     * @param integer $time The timestamp to do the calcuation from
     * @param integer $day The date of the month to calculate
     *
     * @return integer Calculated date at midnight
     */
    protected static function get_next_monthly($time, $day) {
        $currentday = date('j', $time);
        $currentmonth = date('n', $time);
        $currentyear = date('Y', $time);

        // If the day we want hasn't already passed, the next day will
        // be in the current month. Otherwise it will be in the following
        // month - offset it accordingly.
        if ($currentday >= $day) {
            $offset = 1;
        } else {
            $offset = 0;
        }
        $newmonth = $currentmonth+$offset;

        if ($newmonth == 13) { // The end of the year.
            $newyear = $currentyear+1;
            $newmonth = 1;
        } else {
            $newyear = $currentyear;
        }

        $daysinmonth = date('t', mktime(0, 0, 0, $newmonth, 3, $newyear));
        // If the new day is greater than the days in the month,
        // then set it to be the last day of the month.
        if ($day > $daysinmonth) {
            $newday = $daysinmonth;
        } else {
            $newday = $day;
        }

        $nexttime = mktime(0, 0, 0, $newmonth, $newday, $newyear);

        return $nexttime;
    }
}
