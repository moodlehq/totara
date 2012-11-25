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
 * Strings for component 'enrol_authorize', language 'th', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol_authorize
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['anlogin'] = 'Authorize.net: ชื่อผู้ใช้';
$string['anpassword'] = 'Authorize.net: รหัสผ่าน';
$string['anreferer'] = 'ระบุ url ที่ต้องการติดตั้งบัญชี authorize.net ซึ่งจะทำการส่ง Referer URL ฝังลงในเว็บที่เรียกมา';
$string['antestmode'] = 'ทดสอบการส่งเงินรับเงินในโหมดการทดสอบ (ไม่มีการรับ จ่ายเงินจริง)';
$string['antrankey'] = 'Authorize.net: Transaction Key';
$string['ccexpire'] = 'หมดอายุ';
$string['ccexpired'] = 'บัตรเครดิตหมดอายุ';
$string['ccinvalid'] = 'หมายเลขบัตรไม่ถูกต้อง';
$string['ccno'] = 'หมายเลขบัตรเครดิต';
$string['cctype'] = 'ประเภทบัตรเครดิต';
$string['ccvv'] = 'ยืนยันบัตรเครดิต';
$string['ccvvhelp'] = 'ให้ดูหมายเลขสามตัวท้ายด้านหลังบัตรเครดิต';
$string['choosemethod'] = 'ถ้าหากคุณทราบรหัสผ่านเข้าไปยังรายวิชาให้ใส่ที่นี่หากไม่ทราบให้ทำการจ่ายค่าลงทะเบียนก่อนเข้าไปยังรายวิชา';
$string['chooseone'] = 'เติมฟิลด์ที่ว่างไว้หนึ่งหรือทั้งสองช่อง';
$string['description'] = 'โมดูล Authorize.net ช่วยในการติดตั้งระบบการจ่ายเงินค่าลงทะเบียนผ่านทางบัตรเครดิต ถ้าหากค่าลงทะเบียนของรายวิชาใดเป็น 0 ระบบจะไม่ถามให้นักเรียนจ่ายเงินก่อนเข้าเรียน  คุณสามารถตั้งค่าราคาสำหรับแต่ละรายวิชาไว้เป็นค่าเบื้องต้น จากนั้นในแต่ละรายวิชาก็สามารถจะเปลี่ยนค่าดังกล่าวอีกครั้ง';
$string['enrolname'] = 'เกทเวย์สำหรับบัตรเครดิต Authorize.net';
$string['expired'] = 'หมดอายุ';
$string['howmuch'] = 'เท่าไร';
$string['httpsrequired'] = 'ขออภัยที่ต้องแจ้งให้ทราบว่าระบบไม่สามารถตัดบัตรเครดิตได้ในขณะนี้ การตั้งค่าของเว็บไซต์ยังไม่ถูกต้อง
<br /><br />
กรุณาอย่าใส่หมายเลขบัตรเครดิตของคุณถ้าหากไม่เห็นรูปแม่กุญแจสีเหลืองด้านล่างเว็บบราวเซอร์ซึ่งหมายความว่าข้อมูลที่ส่งระหว่างเครื่องลูกไปยังเซิร์ฟเวอร์มีความปลอดภัยทำให้ข้อมูลเกี่ยวกับบัตรเครดิตของคุณไม่ถูกดักไว้ในอินเทอร์เน็ต';
$string['logindesc'] = 'ต้องเปิดใช้งานตัวเลือกนี้<br /><br />
คุณสามารถติดตั้ง <a href="{$a->url}">loginhttps</a> ในส่วน การแก้ไขตัวแปร / ความปลอดภัย
<br /><br />
เปิดการใช้งานในส่วนนี้ Moodle จะเรียกใช้ https ในการติดต่อระหว่างหน้าการเข้าสู่ระบบและหน้าการจ่ายเงิน';
$string['nameoncard'] = 'ชื่อบนบัตร';
$string['reviewnotify'] = 'การจ่ายเงินของคุณจะมีการตรวจสอบก่อน สามารถทำการตรวจสอบสถานะจากอาจารย์ผ่านทางอีเมลได้ในเร็ว ๆ นี้';
$string['sendpaymentbutton'] = 'ส่งค่าลงทะเบียน';
$string['zipcode'] = 'รหัสไปรษณีย์';
