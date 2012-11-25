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
 * Strings for component 'tool_uploaduser', language 'th', branch 'MOODLE_22_STABLE'
 *
 * @package   tool_uploaduser
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['allowdeletes'] = 'เปิดใช้งานการลบข้อมูล';
$string['allowrenames'] = 'อนุญาตให้เปลี่ยนชื่อ';
$string['csvdelimiter'] = 'CSV delimiter';
$string['defaultvalues'] = 'ค่าที่ตั้งไว้';
$string['deleteerrors'] = 'ลบข้อความแสดงข้อผิดพลาด';
$string['encoding'] = 'เข้ารหัส';
$string['errors'] = 'มีข้อผิดพลาด';
$string['nochanges'] = 'ไม่มีการเปลี่ยนแปลง';
$string['renameerrors'] = 'มีข้อผิดพลาดระหว่างการเปลี่ยนชื่อ';
$string['requiredtemplate'] = 'ต้องการ : คุณสามารถใช้ syntax ต้นแบบต่อไปนี้ (%l = lastname, %f = firstname, %u = username) ดูการช่วยเหลือสำหร้บรายละเอียดและตัวอย่าง';
$string['rowpreviewnum'] = 'ดูตัวอย่างแถว';
$string['uploadpicture_baduserfield'] = 'ลักษณะประจำตัวสมาชิกที่ระบุไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง';
$string['uploadpicture_cannotmovezip'] = 'ไม่สามารถย้ายซิปไฟล์ไปยังไดเรกทอรีชั่วคราวได้';
$string['uploadpicture_cannotprocessdir'] = 'ไม่สามารถ unzip ไฟล์ได้';
$string['uploadpicture_cannotsave'] = 'ไม่สามารถบันทึกภาพส่วนตัวสำหรับ {$a} กรุณาตรวจสอบไฟล์อีกครั้ง';
$string['uploadpicture_cannotunzip'] = 'ไม่สามารถ unzip ไฟล์รูปภาพ';
$string['uploadpicture_invalidfilename'] = 'ไฟล์ภาพ {$a} มีตัวอักษรที่ระบบไม่สามารถอ่านค่าได้ กำลังข้ามไปภาพต่อไป';
$string['uploadpicture_overwrite'] = 'เขียนทับรูปประจำตัวที่มีอยู่หรือไม่ ?';
$string['uploadpicture_userfield'] = 'ใช้ลักษณะประจำตัวสมาชิกในการจับคู่รูปภาพ';
$string['uploadpicture_usernotfound'] = 'ไม่พบสมาชิกทีมีฟิลด์ \'{$a->userfield}\' มีค่าเป็น \'{$a->uservalue}\' ข้ามไป';
$string['uploadpicture_userskipped'] = 'ข้าม {$a} เพราะมีภาพส่วนตัวแล้ว';
$string['uploadpicture_userupdated'] = 'อัพเดทรูปภาพส่วนตัวของ {$a} แล้ว';
$string['uploadpictures'] = 'อัพโหลดรูปภาพส่วนตัว';
$string['uploadusers'] = 'อัพโหลดสมาชิก';
$string['uploadusers_help'] = 'Firstly, note that **it is usually not necessary to import users in bulk** - to keep your own maintenance work down you should first explore forms of authentication that do not require manual maintenance, such as connecting to existing external databases or letting the users create their own accounts. See the Authentication section in the admin menus.
If you are sure you want to import multiple user accounts from a text file, then you need to format your text file as follows:

* Each line of the file contains one record
* Each record is a series of data separated by commas
* The first record of the file is special, and contains a list of fieldnames. This defines the format of the rest of the file.
>
> **Required fieldnames:** these fields must be included in the first record, and defined for each user
>
>
>
>
>
> username, password, firstname, lastname, email
>
> **Default fieldnames:** these are optional - if they are not included then the values are taken from the primary admin
>
>
> institution, department, city, country, lang, timezone
>
>
> **Optional fieldnames: **all of these are completely optional. The course names are the "shortnames" of the courses - if present then the user will be enrolled as students in those courses. Group names must be associated to the corresponding courses, i.e. group1 to course1, etc.
>
>
> idnumber, icq, phone1, phone2, address, url, description, mailformat, maildisplay, htmleditor, autosubscribe, course1, course2, course3, course4, course5, group1, group2, group3, group4, group5
>
>
>
* Commas within the data should be encoded as &#44 - the script will automatically decode these back to commas.
* For Boolean fields, use 0 for false and 1 for true.
* Note: If a user is already registered in the Moodle user database, this script will return the
userid number (database index) for that user, and will enrol the user as a student in any of the
specified courses WITHOUT updating the other specified data.

Here is an example of a valid import file:
username, password, firstname, lastname, email, lang, idnumber, maildisplay, course1, group1
jonest, verysecret, Tom, Jones, jonest@someplace.edu, en, 3663737, 1, Intro101, Section 1
reznort, somesecret, Trent, Reznor, reznort@someplace.edu, en_us, 6736733, 0, Advanced202, Section 3';
$string['uploaduserspreview'] = 'แสดงสมาชิกที่อัพโหลด';
$string['uploadusersresult'] = 'ผลการอัพโหลดสมาชิก';
$string['useraccountupdated'] = 'อัพเดทสมาชิกแล้ว';
$string['userdeleted'] = 'ลบสมาชิกเรียบร้อยแล้ว';
$string['userrenamed'] = 'เปลี่ยนชื่อสมาชิกแล้ว';
$string['userscreated'] = 'เพิ่มสมาชิกแล้ว';
$string['usersdeleted'] = 'ลบสมาชิกแล้ว';
$string['usersrenamed'] = 'เปลี่ยนชื่อสมาชิกแล้ว';
$string['usersskipped'] = 'ข้ามสมาชิกต่อไปนี้';
$string['usersupdated'] = 'อัพเดทสมาชิกแล้ว';
$string['usersweakpassword'] = 'สมาชิกที่มีรหัสผ่านที่มีความปลอดภัยต่ำ';
$string['uubulk'] = 'เลือกการปฎิบัติการที่ต้องการทำในคราวเดียว';
$string['uubulkall'] = 'สมาชิกทั้งหมด';
$string['uubulknew'] = 'สมาชิกใหม่';
$string['uubulkupdated'] = 'อัพเดทสมาชิกแล้ว';
$string['uucsvline'] = 'บรรทัด CSV';
$string['uulegacy1role'] = '(นักเรียนที่มีอยู่เดิม) typeN=1';
$string['uulegacy2role'] = '(ผู้สอนที่มีอยู่เดิม) typeN=2';
$string['uulegacy3role'] = '(ผู้สอนที่ไม่มีสิทธิ์ในการแก้ไขที่มีอยู่เดิม) typeN=3';
$string['uunoemailduplicates'] = 'ป้องกันอีเมลซ้ำ';
$string['uuoptype'] = 'ประเภทอัพโหลด';
$string['uuoptype_addinc'] = 'เพิ่มทั้งหมด ยกเลิกการนับสำหรับชื่อผู้ใช้หากจำเป็น';
$string['uuoptype_addnew'] = 'เพิ่มผู้ใช้ใหม่เท่านั้นข้ามผู้ใช้ปัจจุบัน';
$string['uuoptype_addupdate'] = 'เพิ่มผู้ใช้ใหม่และอัพเดทผู้ใช้ปัจจุบัน';
$string['uuoptype_update'] = 'อัพเดทข้อมูลผู้ใช้ปัจจุบันเท่านั้น';
$string['uupasswordnew'] = 'รหัสผ่านใหม่';
$string['uupasswordold'] = 'รหัสผ่านปัจจุบัน';
$string['uuupdateall'] = 'อัพเดทข้อมูลจากไฟล์และค่าที่ตั้งไว้';
$string['uuupdatefromfile'] = 'อัพเดทข้อมูลจากไฟล์';
$string['uuupdatemissing'] = 'เติมค่าที่ว่างอยู่จากไฟล์และค่าที่ตั้งไว้';
$string['uuupdatetype'] = 'ข้อมูลผู้ใช้ที่มีอยู่';
