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

/**
 * Strings for component 'condition', language 'th', branch 'MOODLE_22_STABLE'
 *
 * @package   condition
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addcompletions'] = 'เพิ่ม {ไม่} เงื่อนไขกิจกรรมในรูปแบบ';
$string['addgrades'] = 'เพิ่ม {ไม่} เงื่อนไขเกรดในรูปแบบ';
$string['availabilityconditions'] = 'จำกัดที่ว่าง';
$string['availablefrom'] = 'เฉพาะพร้อมใช้งานจาก';
$string['availableuntil'] = 'เฉพาาะใช้จนกว่าจะสิ้นสุด';
$string['badavailabledates'] = 'วันที่ไม่ถูกต้อง ถ้าคุณตั้งค่าวันที่ทั้งสอง \'พร้อมใช้งานจาก\' วันที่ควรจะเป็นก่อนวันที่ \'จนกระทั่ง\'';
$string['completion_complete'] = 'จะต้องทำเครื่องหมายที่เสร็จสมบูรณ์';
$string['completion_fail'] = 'จะต้องสมบูรณ์ด้วยเกรดที่ล้มเหลว';
$string['completion_incomplete'] = 'จะต้องไม่ถูกทำเครื่องหมายเสร็จสมบูรณ์';
$string['completion_pass'] = 'เกรดจะต้องผ่านจึงจะสมบูรณ์';
$string['completioncondition'] = 'เงื่อนไขเสร็จสิ้นกิจกรรม';
$string['configenableavailability'] = 'เมื่อเปิดใช้งานนี้ช่วยให้คุณกำหนดเงื่อนไข (ขึ้นอยู่กับวันที่เกรดเสร็จหรือ) ตัวควบคุมที่ไม่ว่าจะเป็นกิจกรรมที่สามารถใช้ได้';
$string['enableavailability'] = 'เปิดใช้งานพร้อมเงื่อนไข';
$string['grade_atleast'] = 'ต้องมีอย่างน้อย';
$string['grade_upto'] = 'และน้อยกว่า';
$string['gradecondition'] = 'สภาพเกรด';
$string['help_conditiondates'] = 'วันที่ใช้ได้';
$string['help_showavailability'] = 'แสดงกิจกรรมที่ไม่พร้อมใช้งาน';
$string['none'] = '(ไม่มี)';
$string['notavailableyet'] = 'ยังไม่พร้อม';
$string['requires_completion_0'] = 'ไม่สามารถใช้ได้จนกว่า <strong> กิจกรรม {$a} </strong> ไม่สมบูรณ์';
$string['requires_completion_1'] = 'ไม่สามารถใช้ได้จนกว่า <strong> กิจกรรม {$a} </strong> มีการทำเครื่องหมายสมบูรณ์';
$string['requires_completion_2'] = 'ไม่สามารถใช้ได้จนกว่า <strong> กิจกรรม {$a} </strong> จะเสร็จสมบูรณ์และส่งผ่านไป';
$string['requires_completion_3'] = 'ไม่สามารถใช้ได้จนกว่า <strong> กิจกรรม {$a} </strong> จะเสร็จสมบูรณ์และล้มเหลว';
$string['requires_date'] = 'ที่มีจำหน่ายจาก {$a}';
$string['requires_date_before'] = 'ที่มีจำหน่ายจนถึง {$a}';
$string['requires_date_both'] = 'ที่มีจำหน่ายจาก {$a->from} ไป {$a->until}';
$string['requires_grade_any'] = 'ไม่สามารถใช้ได้จนกว่าคุณจะมีเกรดใน <strong> {$a} </strong>';
$string['requires_grade_max'] = 'ไม่สามารถใช้ได้จนกว่าคุณจะได้รับคะแนนที่เหมาะสมใน <strong> {$a} </strong>';
$string['requires_grade_min'] = 'ไม่สามารถใช้ได้จนกว่าคุณจะบรรลุความต้องการใน <strong> {$a} </strong>';
$string['requires_grade_range'] = 'ไม่สามารถใช้ได้จนกว่าคุณจะได้รับคะแนนโดยเฉพาะอย่างยิ่งใน <strong> {$a} </strong>';
$string['showavailability'] = 'ก่อนที่กิจกรรมสามารถใช้ได้';
$string['showavailability_hide'] = 'ซ่อนกิจกรรมทั้งหมด';
$string['showavailability_show'] = 'แสดงกิจกรรมที่ greyed-out, มีข้อมูลที่จำกัด';
$string['userrestriction_hidden'] = 'ถูกจำกัด (ที่ซ่อนอยู่ได้อย่างสมบูรณ์ไม่มีข้อความ): \'{$a}\'';
$string['userrestriction_visible'] = 'ถูกจำกัด : \'{$a}\'';
