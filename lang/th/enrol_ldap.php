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
 * Strings for component 'enrol_ldap', language 'th', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol_ldap
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['autocreate'] = 'ระบบจะสร้างรายวิชาขึ้นโดยอัตโนมัติถ้าหากมีการสมัครเข้าเป็นนักเรียนในวิชาใด ๆ ถึงแม้จะยังไม่มีการสร้างรายวิชาดังกล่าวใน Moodle';
$string['autocreation_settings'] = 'การตั้งค่าการสร้างรายวิชาอัตโนมัติ';
$string['bind_dn'] = 'ถ้าหากต้องการใช้ bind-user ในการค้นหาผู้ใช้ให้ระบุค่าที่นี่ เช่น
\'cn=ldapuser,ou=public,o=org\'';
$string['bind_pw'] = 'รหัสผ่านสำหรับ bind-user';
$string['category'] = 'ประเภทสำหรับรายวิชาที่สร้างขึ้นอัตโนมัติ';
$string['course_fullname'] = 'ตัวเลือก :  ฟิลด์ LDAP ที่จะดึงข้อมูลชื่อเต็ม';
$string['course_idnumber'] = 'ชี้ไปยัง unique identifier ใน LDAP โดยทั่วไปแล้วจะเป็น <em>cn</em> หรือ<em>uid</em>  คุณควรจะทำการล็อคค่านี้เอาไว้หากเลือกใช้วิธีการสร้างรายวิชาอัตโนมัติ';
$string['course_settings'] = 'การตั้งค่าการรับเข้าเป็นนักเรียนในรายวิชา';
$string['course_shortname'] = 'ตัวเลือก : ฟิลด์ LDAP ที่จะดึงข้อมูลชื่อย่อ';
$string['course_summary'] = 'ตัวเลือก : ฟิลด์ LDAP ที่จะดึงข้อมูลบทคัดย่อ';
$string['editlock'] = 'ล็อคค่า';
$string['enrolname'] = 'LDAP';
$string['general_options'] = 'ตัวเลือกทั่วไป';
$string['host_url'] = 'ระบุ Host LDAP ในรูปแบบของ url เช่น \'ldap://ldap.myorg.com/\'';
$string['objectclass'] = 'objectClass ที่ใช้ในการค้นหารายวิชา โดยทั่วไปใช้ \'posixGroup\'';
$string['pluginname_desc'] = '<p>ท่านสามารถใช้เซิร์ฟเวอร์ LDAP สำหรับอนุมัติให้เข้าเรียน โดยเซิร์ฟเวอร์ดังกล่าวจะต้องประกอบไปด้วยกลุ่มที่ชี้ไปยังรายวิชาต่าง ๆ  และ กลุ่มหรือรายวิชานั้น ๆ จะมีรายชื่อสมาชิกเพื่อยันกับข้อมูลในเซิร์ฟเวอร์ </p>
<p>ภายใน LDAP นั้นจะมีการจำกัดความรายวิชาให้เป็นกลุ่มหนึ่งกลุ่ม โดยแต่ละกลุ่มจะมีฟิลด์สมาชิกหลายฟิลด์ด้วยกันเช่น
(<em>member</em> or <em>memberUid</em>)
ซึ่งจะเป็นข้อมูลเฉพาะสำหรับการยืนยันตัวผู้ใช้แต่ละคน
</p>
<p>ในการใช้การอนุมัติผ่าน LDAP นั้น< ผู้ใช้ต้องมีฟิลด์หมายเลขประจำตัว (ID Number) ที่ถูกต้อง  โดยในกลุ่มแต่ละกลุ่มใน LDAP จะต้องมีฟิลด์หมายเลขประจำตัวในฟิลด์สมาชิกที่สร้างขึ้นสำหรับสมาชิกในการจะเข้าเป็นนักเรียนในรายวิชานั้น ๆ  จะใช้งานได้ดีหากท่านใช้การอนุมัติผ่าน LDAP อยู่ก่อนแล้ว</p>

<p>ระบบจะทำการอัพเดทข้อมูลการเข้าเป็นนักเรียนทุกครั้งที่สมาชิกเข้าสู่ระบบ คุณสามารถใช้งานสคริปต์เพื่อให้ข้อมูลการเป็นนักเรียนนั้นตรงกัน ให้ดูใน <em>enrol/ldap/enrol_ldap_sync.php</em>.</p>

<p>ปลั๊กอินนี้สามารถสร้างรายวิชาใหม่ขึ้นทันทีที่ปรากฎชื่อกลุ่มใหม่ขึ้นภายใน LDAP</P>';
$string['server_settings'] = 'การตั้งค่าเซิร์ฟเวอร์ LDAP';
$string['template'] = 'ตัวเลือก :  การสร้างรายวิชาอัตโนมัติสามารถทำการสำเนาค่าต่าง ๆ จากรายวิชาต้นแบบ';
$string['updatelocal'] = 'อัพเดทข้อมูลในเครื่อง';
$string['version'] = 'เวอร์ชันของ LDAP ที่ใช้อยู่';
