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
 * Strings for component 'auth_ldap', language 'th', branch 'MOODLE_22_STABLE'
 *
 * @package   auth_ldap
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['auth_ldap_bind_dn'] = 'ถ้าหากต้องการใช้ bind-user เพื่อค้นหาสมาชิกอื่นได้ สามารถ ระบุดังต่อไปนี้  \'cn=ldapuser,ou=public,o=org\'';
$string['auth_ldap_bind_pw'] = 'รหัสผ่านสำหรับ bind-user.';
$string['auth_ldap_bind_settings'] = 'ค่าตั้งค่า';
$string['auth_ldap_contexts'] = 'เนื้อหาที่พบสมาชิกอยู่ ในกรณีที่มีหลายแหล่งให้แยกกันด้วยเครื่องหมาย \';\' เช่น \'ou=users,o=org; ou=others,o=org\'';
$string['auth_ldap_create_context'] = 'เปิดให้สมาชิกสามารถสร้างข้อความตอบรับทางอีเมลด้วยตนเองได้
คุณไม่จำเป็นต้องใส่ข้อความนี้ที่ ldap_context-variable, Moodle จะค้นหาให้อัตโนมัติ';
$string['auth_ldap_creators'] = 'กลุ่มสมาชิกที่ได้รับสิทธิ์ในการสร้างหลักสูตรใหม่ได้ สามารถใส่ได้หลายกลุ่มโดยใช้เครื่องหมาย \';\' เพื่อคั่นแต่ละรายการ ดังตัวอย่าง  \'cn=teachers,ou=staff,o=myorg\'';
$string['auth_ldap_expiration_desc'] = 'เลือก "ไม่" หากต้องการปิดการใช้งานการตรวจสอบวันหมดอายุของรหัสผ่านหรือใช้ LDAP ในการอ่านค่า passwordexpiration';
$string['auth_ldap_expiration_warning_desc'] = 'จำนวนวันที่ต้องการเตือนสมาชิกล่วงหน้าก่อนที่รหัสผ่านจะหมดอายุ';
$string['auth_ldap_expireattr_desc'] = 'ใช้ค่านี้ทับค่าแอตทริบิวต์ของ ldap ใน asswordAxpirationTime';
$string['auth_ldap_graceattr_desc'] = 'ใช้ค่านี้ทับค่าแอตทริบิวต์ gracelogin';
$string['auth_ldap_gracelogins_desc'] = 'เปิดการใช้งาน gracelogin หลังจากที่รหัสผ่านหมดอายุแล้วสมาชิกยังสามารถเข้าสู่ระบบได้จนกว่า gracelogin จะมีค่าเป็น 0 เปิดการใช้งานส่วนนี้หากต้องการให้ระบบแสดงข้อความเตือนว่ารหัสผ่านจะหมดอายุ';
$string['auth_ldap_host_url'] = 'ระบุ LDAP host เช่น  \'ldap://ldap.myorg.com/\' หรือ  \'ldaps://ldap.myorg.com/\'';
$string['auth_ldap_login_settings'] = 'ตั้งค่าการเข้าสู่ระบบ';
$string['auth_ldap_memberattribute'] = 'คุณสมบัติของสมาชิกใหม่ของกลุ่ม ปกติใช้  \'member\'';
$string['auth_ldap_objectclass'] = 'ฟิลเตอร์คุ้นเคยกับชื่อหรือการค้นหาสมาชิก โดยปกติแล้วจะตั้งค่าไว้ตัวอย่างเช่น objectClass=posixAccount  โดยค่าที่ตั้งไว้ objectClass=* ค่าที่จะแสดงจาก LDAP';
$string['auth_ldap_opt_deref'] = 'พิจารณาว่าต้องการจัดการกับนามแฝงที่ใช้ในการค้นหาอย่างไร เลือกค่าใดค่าหนึ่งต่อไปนี้ "ไม่" (LDAP_DEREF_NEVER) หรือ "ใช่" (LDAP_DEREF_ALWAYS)';
$string['auth_ldap_passwdexpire_settings'] = 'ตั้งค่าวันหมดอายุของหรหัสผ่าน LDAP';
$string['auth_ldap_preventpassindb'] = 'เลือก "ใช่" เพื่อป้องกันมิให้รหัสผ่านเก็บไว้ในฐานข้อมูล Moodle';
$string['auth_ldap_search_sub'] = 'ใส่ค่า <> 0 ถ้าหากต้องการ ค้นหาสมาชิกผ่านหัวข้อย่อย';
$string['auth_ldap_server_settings'] = 'ตั้งค่า LDAP เซิร์ฟเวอร์';
$string['auth_ldap_update_userinfo'] = 'อัพเดทข้อมูลสมาชิก (ชื่อ,นามสกุล,ที่อยู่..) จาก LDAP ถึง  Moodle. ดูเพิ่มเติมที่  /auth/ldap/attr_mappings.php';
$string['auth_ldap_user_attribute'] = 'attribute ที่ใช้ในการค้นหาชื่อสมาชิก ส่วนใหญ่จะใช้  \'cn\'.';
$string['auth_ldap_user_settings'] = 'ตั้งค่าการค้นหาสมาชิก';
$string['auth_ldap_user_type'] = 'เลือกวิธีจัดเก็บสมาชิกไว้ใน LDAP ค่านี้จะระบุถึงวิธีที่รหัสผ่านจะหมดอายุ gracelogin รวมไปถึงการเพิ่มสมาชิกด้วยเช่นกัน';
$string['auth_ldap_version'] = 'รุ่นของ LDAP ที่ใช้อยู่';
$string['auth_ldapdescription'] = 'วิธีการอนุมัติการใช้งานผ่าน  external LDAP server ถ้าหาก ชื่อ และ รหัสที่ใส่มานั้นถูกต้อง Moodle จะทำการสร้าง รายชื่อสมาชิกใหม่ในฐานข้อมูล  โมดูลดังกล่าว สามารถ อ่าน attribute ของสมาชิกจาก LDAP  และ ใส่ค่าที่ต้องการใน moodle ล่วงหน้า  หลังจากนั้น เวลาล็อกอิน ก็จะมีการเช็ค แค่ชื่อและรหัสผ่านเท่านั้น';
$string['auth_ldapextrafields'] = 'ช่องนี้จะเติมหรือไม่ก็ได้  คุณสามารถเลือกใช้ ค่าที่ระบบ ตั้งไว้ก่อน จาก  <b>LDAP fileds</b><p>  ถ้าหาก ปล่อยว่าง ไม่เติม จะไม่มีการดึงข้อมูลจาก LDAP ระบบจะเลือกใช้ ค่า default ใน moodle <p> และ ทั้งสองกรณี สมาชิกสามารถที่จะแก้ไขค่าต่างๆ ได้ ภายหลังจาก ล็อกอิน';
$string['pluginname'] = 'ใช้ LDAP server';
