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
 * Strings for component 'auth_cas', language 'th', branch 'MOODLE_22_STABLE'
 *
 * @package   auth_cas
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['auth_cas_baseuri'] = 'URI ของเซิร์ฟเวอร์ ตัวอย่างเช่น ในกรณีที่ CAS เซิร์ฟเวอร์ทำงานโต้ตอบกับ  host.domain.uk/CAS/   ค่าของ  cas_basuri= CAS/';
$string['auth_cas_create_user'] = 'เปิดใช้งานค่านี้ถ้าหากต้องการแทรกการอนุมัติผ่าน CAS ในฐานข้อมูล Moodle  หากไม่เฉพาะสมาชิกที่อยู่ในฐานข้อมูลเท่านั้นจึงสามารถเข้าสู่ระบบได้';
$string['auth_cas_enabled'] = 'เปิดใช้งานค่านี้หากต้องการใช้งานการอนุมัติผ่าน CAS';
$string['auth_cas_hostname'] = 'ชื่อโฮสต์ของ CAS เซิร์ฟเวอร์ เช่น  host.domain.uk';
$string['auth_cas_invalidcaslogin'] = 'ขออภัยค่ะ เข้าสู่ระบบไม่สำเร็จคุณไม่ได้รับอนุญาตให้เข้าสู่ระบบ';
$string['auth_cas_language'] = 'เลือกภาษา';
$string['auth_cas_logincas'] = 'การเข้าสู่ระบบแบบความปลอดภัยสูง';
$string['auth_cas_port'] = 'พอร์ตสำหรับ CAS เซิร์ฟเวอร์';
$string['auth_cas_server_settings'] = 'การตั้งค่า CAS เซิร์ฟเวอร์';
$string['auth_cas_text'] = 'การเข้าสู่ระบบความปลอดภัยสูง';
$string['auth_cas_version'] = 'เวอร์ชันของ CAS';
$string['auth_casdescription'] = 'วิธีนี้เป็นการใช้ CAS เซิร์ฟเวอร์ ( Central Authentication Service) เพื่ออนุมัติการเข้าใช้งานของสมาชิกเพื่อให้สามารถเข้าใช้งานแบบ Single Sign On environment (SSO) คือทำการตรวจสอบชื่อผู้ใช้และรหัสผ่านร่วมกับการอนุมัติผ่าน LDAP อย่างง่าย ในกรณีที่ชื่อผู้ใช้และรหัสผ่านถูกต้องตาม CAS   Moodle จะทำการสร้างสมาชิกใหม่ลงในฐานข้อมูลโดยนำข้อมูลผู้ใช้จาก LDAP หากจำเป็น ในการเข้าสู่ระบบครั้งต่อไประบบจะทำการตรวจสอบเฉพาะชื่อผู้ใช้และรหัสผ่านเท่านั้น';
$string['pluginname'] = 'ใช้ CAS เซิร์ฟเวอร์ (SSO)';
