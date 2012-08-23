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
 * Strings for component 'message_email', language 'th', branch 'MOODLE_22_STABLE'
 *
 * @package   message_email
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['allowusermailcharset'] = 'สมาชิกสามารถเลือกชุดอักขระที่ใช้งาน';
$string['configallowusermailcharset'] = 'เปิดการใช้งานส่วนนี้ จะทำให้สมาชิกสามารถเลือกชุดอักขระสำหรับอีเมลการรับส่งอีเมลได้';
$string['configmailnewline'] = 'ใช้อักขระการขึ้นบรรทัดใหม่ในอีเมล จำเป็นต้องใช้ CRLF ตามกำหนดของ RFC 822bis  เมลเซิร์ฟเวอร์บางเครื่องจะทำการเปลี่ยน จาก LF เป็น CRLF โดยอัตโนมัติ แต่บางเซิร์ฟเวอร์ไม่สามารถเปลี่ยนจาก CRLF เป็น CRCRLF ได้ถูกต้อง  และเซิร์ฟเวอร์อีกจำนวนหนึ่งที่ไม่ยอมรับค่า  LF  อาทิ ใน qmail ให้ลองเปลี่ยนการตั้งค่านี้หากมีปัญหาในการส่งอีเมลที่มี ข้อความเป็นการขึ้นบรรทัดใหม่สองบรรทัด';
$string['confignoreplyaddress'] = 'ในบางครั้งระบบจะทำการส่งอีเมลในฐานะของสมาชิก เช่น ในกรณีโพสต์ในกระดานเสวนา อีเมลที่คุณระบุไว้ในหน้าประวัติส่วนตัวจะนำมาใช้ในช่อง "From" แต่ถ้าสมาชิกไม่ต้องการให้ใครเห็นอีเมลให้ตั้งค่าไม่แสดงอีเมล ผู้รับจะไม่สามารถตอบเมล์ถึงสมาชิกได้โดยตรง';
$string['configsitemailcharset'] = 'อีเมลทุกฉบับที่ส่งออกจากเว็บไซต์นี้จะเป็นอักขระที่ท่านระบุไว้ที่นี่ แต่ท่านสามารถเลือกให้สมาชิก ปรับค่าดังกล่าวโดยการเปิดให้ใช้งานในส่วนนี้';
$string['configsmtphosts'] = 'ใส่ชื่อเต็มของ SMTP เซิร์ฟเวอร์ ที่โปรแกรม Moodle จะใช้สำหรับส่งเมล์ (เช่น mail.a.acom หรือ mail.b.com หรือ mail.c.com) ถ้าหากคุณทิ้งว่างไว้ Moodle จะเลือกใช้ ค่าที่ตั้งไว้แล้ว ในการส่งเมล';
$string['configsmtpmaxbulk'] = 'จำนวนข้อความสูงสุดที่ส่งได้ในหนึ่ง smtp เซสชั่น การรวมข้อความสามารถที่จะเพิ่มความเร็วในการส่งอีเมล ค่าที่ต่ำกว่า 2 จะบังคับให้มีการสร้าง smtp เซสชั่นใหม่ทุกครั้งสำหรับการอีเมลแต่ละครั้ง';
$string['configsmtpuser'] = 'หากต้องการระบุ SMTP เซิร์ฟเวอร์ข้างต้น และ เซิร์ฟเวอร์ต้องการรหัสผ่านให้ทำการ ใส่ "ชื่อผู้ใช้" และ "รหัสผ่าน"';
$string['mailnewline'] = 'ขึ้นบรรทัดใหม่ในเมล';
$string['noreplyaddress'] = 'ที่อยู่สำหรับ No-Reply';
$string['sitemailcharset'] = 'ชุดอักขระ';
$string['smtphosts'] = 'โฮสต์ SMTP';
$string['smtpmaxbulk'] = 'จำนวนสูงสุดของ SMTP เซสชัน';
$string['smtppass'] = 'รหัสผ่าน SMTP';
$string['smtpuser'] = 'ชื่อผู้ใช้ SMTP';
