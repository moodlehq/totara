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
 * Strings for component 'auth', language 'th', branch 'MOODLE_22_STABLE'
 *
 * @package   auth
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['alternatelogin'] = 'ใส่ url ของหน้าที่ต้องการใช้เป็นหน้าสำหรับเข้าสู่ระบบโดยหน้าดังกล่าวควรประกอบไปด้วย <strong>\'{$a}\'</strong> และมีฟิลด์ต่อไปนี้ <strong>ชื่อผู้ใช้</strong> และ <strong>รหัสผ่าน</strong> <br />  โปรดใช้ความระมัดระวังในการใส่ค่า url  เพราะการใส่ค่าที่ไม่ถูกต้องอาจทำให้ระบบนำคุณออกจากระบบ <br /> ทิ้งช่องนี้ให้ว่างไว้เพื่อใช้หน้าที่ระบบตั้งไว้';
$string['alternateloginurl'] = 'URL ของหน้าเข้าสู่ระบบที่ต้องการ';
$string['auth_changepasswordhelp'] = 'ช่วยเหลือการเปลี่ยนรหัสผ่าน';
$string['auth_changepasswordhelp_expl'] = 'แสดงการช่วยเหลือสำหรับสมาชิกที่ทำรหัสผ่านหาย หน้านี้จะเป็นการแสดงข้อมูล URL สำหรับเปลี่ยนรหัสผ่านหรือใช้งานการเปลี่ยนรหัสผ่านใน Moodle';
$string['auth_changepasswordurl'] = 'URL สำหรับเปลี่ยนรหัสผ่าน';
$string['auth_changepasswordurl_expl'] = 'ระบุ Url หน้าที่ต้องการให้สมาชิกที่ทำรหัสผ่านหาย โดยตั้งค่า <strong>ใช้หน้าการเปลี่ยนรหัสผ่านมาตรฐาน</strong> เป็น <strong>ไม่</strong>.';
$string['auth_common_settings'] = 'การตั้งค่าทั่วไป';
$string['auth_data_mapping'] = 'การจับคู่ข้อมูล';
$string['authenticationoptions'] = 'วิธีการอนุมัติการเป็นสมาชิก';
$string['auth_fieldlock'] = 'ล็อคค่า';
$string['auth_fieldlock_expl'] = '<p><b>ล็อคค่า:</b> หากเปิดใช้งานจะทำให้สมาชิก Moodle และผู้ดูแลระบบไม่สามารถแก้ไขค่าในฟิลด์ต่าง ๆ ได้โดยตรง ให้เลือกใช้ค่านี้หากคุณต้องการเก็บข้อมูลต่าง ๆ ไว้ในฐานข้อมูลนอก </p>';
$string['auth_fieldlocks'] = 'ล็อคฟิลด์สมาชิก';
$string['auth_fieldlocks_help'] = 'คุณสามารถล็อคฟิลด์ข้อมูลสมาชิก มีประโยชน์สำหรับเว็บไซต์ที่เฉพาะผู้ดูแลระบบทำเท่านั้นที่จะทำหน้าที่แก้ไขข้อมูลของสมาชิกจากนั้นทำการอัพโหลดสมาชิกเข้าสู่ระบบ ถ้าหากมีการล็อกฟิลด์ให้ตรวจสอบให้ดีว่าได้ทำการเพิ่มข้อมูลที่จำเป็นสำหรับการสร้างบัญชีผู้ใช้ใน moodle  เรียบร้อยแล้วมิเช่นนั้นบัญชีผู้ใช้จะไม่สามารถใช้การได้ 
<p> หากต้องการหลีกเลี่ยงปัญหาดังกล่าวให้ตั้งค่าโหมดการล็อคไว้ที่ "เปิดล็อคหากไม่มีข้อมูล"';
$string['authinstructions'] = 'คุณสามารถให้ข้อมูลกับสมาชิก และแนะนำวิธีการใช้ ผ่านส่วนนี้ ทำให้สมาชิกทราบว่า username และ password ของตัวเองคืออะไร ข้อความที่คุณระบุในส่วนนี้จะปรากฎ ใน หน้าล็อกอิน  ถ้าหากคุณปล่อยว่างไว้ จะไม่มีวิธีการใช้ปรากฎ';
$string['auth_multiplehosts'] = 'สามารถใส่โฮสต์หลาย ๆ ตัวลงไป เช่น host1.com;host2.com;host3.com';
$string['auth_passwordisexpired'] = 'รหัสผ่านของคุณกำลังจะหมดอายุต้องการเปลี่ยนหรือไม่คะ';
$string['auth_passwordwillexpire'] = 'รหัสผ่านของคุณจะหมดอายุในอีก {$a} วันต้องการเปลี่ยนรหัสผ่านตอนนี้หรือไม่คะ';
$string['auth_updatelocal'] = 'อัพเดทข้อมูลภายใน';
$string['auth_updatelocal_expl'] = '<p><b>อัพเดทข้อมูลภายใน :</b> หากเปิดใช้งาน ฟิลด์ของตารางในฐานข้อมูลภายนอกจะมีการอัพเดททุกครั้งที่สมาชิกเข้าสู่ระบบหรือมีการ synchronise ฐานข้อมูลสมาชิก  ในกรณีที่เลือกให้อัพเดทข้อมูลภายในควรทำการล็อกฟิลด์เอาไว้</p>';
$string['auth_updateremote'] = 'อัพเดทข้อมูลภายนอก';
$string['auth_updateremote_expl'] = '<p><b>อัพเดทข้อมูลภายนอก:</b>หากเปิดใช้งานฐานข้อมูลภายนอกจะได้รับการอัพเดททุกครั้งที่สมาชิกทำการเปลี่ยนแปลงระเบียนประวัติ ควรทำการเปิดล็อคฟิลด์หากอนุญาตให้ทำการแก้ไข</p>';
$string['auth_updateremote_ldap'] = '<p><b>หมายเหตุ:</b> อัพเดทข้อมูล LDAP จากภายนอกจำเป็นต้องตั้งค่า binddn และ bindpw โดยให้สิทธิ์bind-user ในการแก้ไขระเบียนประวัติ ค่าปัจจุบันที่ตั้งไว้ไม่สามารถใช้แอตทริบิวต์หลายตัวและจะทำการทิ้งค่าที่เพิ่มขึ้นมาในการอัพเดท </p>';
$string['auth_user_create'] = 'อนุญาตให้เพิ่มสมาชิกได้';
$string['auth_user_creation'] = 'อนุญาตให้สมาชิกทั่วไปสามารถสร้างบัญชีสมาชิกและตอบยืนยันได้ ถ้าอนุญาต โปรดอย่าลืมไปปรับแก้ระบบ moodule-specific ตัวเลือก user creation ด้วย';
$string['auth_usernameexists'] = 'มีสมาชิกชื่อนี้ในระบบแล้ว กรุณาเลือกชื่อใหม่';
$string['changepassword'] = 'เปลี่ยนรหัส URL';
$string['changepasswordhelp'] = 'คุณสามารถระบุลิงก์ ที่สมาชิกสามารถจะเปลี่ยน หรือ หา ชื่อ และ passwordได้ เมื่อมีการลืม ลิงก์ดังกล่าวจะนำสมาชิกไปยังหน้า ล็อกอิน และหน้าข้อมูลส่วนตัว แต่หากไม่เติมอะไร ปุ่มดังกล่าวจะไม่ปรากฎ';
$string['chooseauthmethod'] = 'เลือกวิธีการอนุมัติ';
$string['createpasswordifneeded'] = 'สร้างรหัสผ่านหากต้องการ';
$string['forcechangepassword'] = 'บังคับให้เปลี่ยนรหัสผ่าน';
$string['forcechangepasswordfirst_help'] = 'บังคับให้สมาชิกเปลี่ยนรหัสผ่านในครั้งแรกที่เข้าสู่ระบบ';
$string['forcechangepassword_help'] = 'บังคับสมาชิกให้เปลี่ยนรหัสผ่านในครั้งต่อไปที่เข้าสู่ระบบ';
$string['guestloginbutton'] = 'ปุ่มล็อกอินในฐานะบุคคลทั่วไป';
$string['infilefield'] = 'ฟิลด์ที่ต้องการในไฟล์';
$string['instructions'] = 'วิธีใช้';
$string['internal'] = 'ภายใน';
$string['locked'] = 'ล็อคไว้';
$string['md5'] = 'เข้ารหัสแบบ MD5';
$string['passwordhandling'] = 'การจัดการฟิลด์รหัสผ่าน';
$string['plaintext'] = 'ตัวหนังสือธรรมดา(Plain Text)';
$string['showguestlogin'] = 'คุณสามารถซ่อนหรือแสดงปุ่มล็อกอินในฐานะบุคคลทั่วไปในหน้าล็อกอินเข้าสู่ระบบ';
$string['stdchangepassword'] = 'ใช้หน้าปกติในการเปลี่ยนรหัสผ่าน';
$string['stdchangepassword_expl'] = 'ในกรณีที่ใช้ระบบการอนุมัติจากภายนอกที่อนุญาตให้เปลี่ยนรหัสผ่าน moodle  ให้ตั้งค่านี้เป็น "ใช่" ค่านี้จะตั้งค่าทับกับลิงก์ "เปลี่ยนรหัสผ่าน"';
$string['stdchangepassword_explldap'] = 'หมายเหตุ : ขอแนะนำให้ท่านใช้ LDAP ผ่านการเข้ารหัสแบบ SSL (ldaps://) ในกรณีที่ใช้ LDAP เซิร์ฟเวอร์เป็นหลัก';
$string['unlocked'] = 'เปิดล็อค';
$string['unlockedifempty'] = 'เปิดล็อคหากไม่มีค่า';
$string['update_never'] = 'ไม่เคย';
$string['update_oncreate'] = 'เมื่อสร้างใหม่';
$string['update_onlogin'] = 'เมื่อเข้าสู่ระบบทุกครั้ง';
$string['update_onupdate'] = 'เมื่อมีการอัพเดท';
