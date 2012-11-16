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
 * Strings for component 'auth_shibboleth', language 'th', branch 'MOODLE_22_STABLE'
 *
 * @package   auth_shibboleth
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['auth_shib_convert_data'] = 'การเปลี่ยนแปลงข้อมูล API';
$string['auth_shib_convert_data_description'] = 'คุณสามารถใช้ API ในการแก้ไขข้อมูลต่าง ๆ ที่ป้อนจาก Shibboleth อ่าน <a href="../auth/shibboleth/README.txt" target="_blank">README</a> หากต้องการข้อมูลเพิ่มเติม';
$string['auth_shib_convert_data_warning'] = 'ไม่พบไฟล์ที่ต้องการหรือไม่สามารถอ่านได้จากกระบวนการเว็บเซิร์ฟเวอร์';
$string['auth_shib_instructions'] = 'ถ้าหากสถาบันของท่านสนับสนุนการใช้งาน Shibboleth ท่านสามารถ ใช้ <a href="{$a}">เข้าสู่ระบบผ่าน Shibboleth</a> หากไม่สามารถเข้าสู่ระบบโดยวิธีปกติได้ที่นี่';
$string['auth_shib_instructions_help'] = 'อธิบายวิธีการเข้าสู่ระบบแก่สมาชิกเพื่ออธิบาย Shibboleth ซึ่งวิธีการดังกล่าวจะนำไปแสดงในหน้าการเข้าสู่ระบบในส่วนของคำแนะนำ วิธีดังกล่าวควรจะมีลิงก์ไปยัง แหล่งข้อมูลที่ป้องกันด้วย Shibboleth ที่จะทำหน้าที่นำสมาชิกไปยัง "**{$a}**" เพื่อให้สมาชิก Shibboleth สามารถเข้าสู่ระบบใน Moodle หากปล่อยว่างไว้ระบบจะแสดงวิธีการใช้งานที่ตั้งไว้';
$string['auth_shib_only'] = 'Shibboleth  เท่านั้น';
$string['auth_shib_only_description'] = 'เลือกค่านี้หากต้องการใช้การอนุมัติผ่าน Shibboleth';
$string['auth_shib_username_description'] = 'ชื่อของตัวแปร "ชื่อผู้ใช้" ใน Shibboleth เว็บเซิร์ฟเวอร์ที่จะใช้ใน Moodle';
$string['auth_shibboleth_login'] = 'การเข้าสู่ระบบผ่าน Shibboleth';
$string['auth_shibboleth_manual_login'] = 'เข้าสู่ระบบด้วยตนเอง';
$string['auth_shibbolethdescription'] = 'ใช้วิธีนี้หากต้องการสร้างผู้ใช้และอนุมัติโดยใช้ a href="http://shibboleth.internet2.edu/" target="_blank">Shibboleth</a><br> อ่านข้อมูลเพิ่มเติม <a href="../auth/shibboleth/README.txt" target="_blank">README</a> เกี่ยวกับวิธีการตั้งค่า Moodle กับ Shibboleth';
$string['pluginname'] = 'Shibboleth';
$string['shib_no_attributes_error'] = 'ดูเหมือนท่านจะผ่านการอนุมัติแบบ Shibboleth แต่ moodle ไม่ได้รับการตั้งค่าใด ๆ ของสมาชิกกรุณาตรวจสอบว่า Identity Provider  ได้ให้ค่าที่จำเป็น ({$a}) ต่อ Service Provider ที่ใช้งาน moodle อยู่หรือไม่ หรือแจ้งเว็บมาสเตอร์ของเซิร์ฟเวอร์ดังกล่าว';
$string['shib_not_all_attributes_error'] = 'moodle ต้องการการตั้งค่า Shibboleth ที่แน่นอนแต่ไม่ปรากฎค่าดังกล่าวในกรณีของคุณ ค่านั้นคือ {$a}  กรุณาติดต่อเว็บมาสเตอร์ของเซิร์ฟเวอร์ที่ใช้บริการอยู่';
$string['shib_not_set_up_error'] = 'การอนุมัติผ่าน Shibboleth  ไม่ได้รับการติดตั้งให้ถูกต้อง ให้ศึกษา <a href="README.txt">README</a> สำหรับวิธีการติดตั้ง';
