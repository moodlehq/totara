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
 * Strings for component 'install', language 'th', branch 'MOODLE_22_STABLE'
 *
 * @package   install
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['admindirerror'] = 'ไดเรกทอรี admin ที่ระบุไม่ถูกต้อง';
$string['admindirname'] = 'ไดเรกทอรี admin';
$string['admindirsetting'] = 'มีเว็บโฮสต์จำนวนน้อยที่ใช้ /admin  ในการติดตั้งระบบควบคุมเว็บไซต์เอาไว้ ซึ่งเป็นชื่อเดียวกับหน้าผู้ดูแลระบบใน moodle  วิธีหลีกเลี่ยงปัญหาคือให้คุณเปลี่ยนชื่อ admin ใน Moodle เป็นชื่ออื่นในระหว่างการติดตั้ง และใส่ชื่อใหม่ที่ต้องการตัวอย่างเช่น moodleadmin';
$string['admindirsettinghead'] = 'ตั้งค่าไดเรกทอรี admin';
$string['admindirsettingsub'] = 'เว็บโฮสติ้งจำนวนน้อยที่ใช้ /admin เป็น url พิเศษเพื่อที่จะเข้าไปยังหน้า control panel หรืออื่น ๆ ซึ่งอาจทำให้เกิดปัญหากับหน้า admin ของ Moodle ท่านสามารถทำการแก้ไขได้โดยการเปลี่ยนชื่อไดเรกทอรี admin ในการติดตั้งและใส่ชื่อใหม่ลงไป  เช่น <br /> <br /><b>moodleadmin</b><br /> <br />
การเปลี่ยนค่านี้จะเป็นการแก้ไขหน้าลิงก์ admin ใน moodle';
$string['availablelangs'] = 'ภาษาทั้งหมด';
$string['caution'] = 'คำเตือน';
$string['chooselanguage'] = 'เลือกภาษา';
$string['chooselanguagehead'] = 'เลื่อกภาษา';
$string['chooselanguagesub'] = 'กรุณาเลือกภาษาที่ใช้ในการติดตั้งเท่านั้น คุณจะสามารถเลือกตั้งค่าภาษาสำหรับเว็บไซต์และสำหรับสมาชิกแต่ละคนในหน้าจอต่อไป';
$string['compatibilitysettings'] = 'ตรวจสอบการตั้งค่า PHP';
$string['compatibilitysettingshead'] = 'ตรวจสอบการตั้งค่า PHP';
$string['compatibilitysettingssub'] = 'เซิร์ฟเวอร์ของท่านควรผ่านการทดสอบทั้งหมดนี้เพื่อให้ Moodle สามารถทำงานได้เป็นปกติ';
$string['configfilenotwritten'] = 'ตัวติดตั้งอัตโนมัติไม่สามารถสร้างไฟล์ config.php ได้ อาจเป็นเพราะว่าไม่สามารถเขียนลงไดเรกทอรี moodle ได้ คุณสามารถสร้างไฟล์ดังกล่าวได้เองโดยการก้อปปี้โค้ดต่อไปนี้ลงในไฟล์ที่ต้องการสร้างใหม่';
$string['configfilewritten'] = 'สร้าง config.php เรียบร้อยแล้ว';
$string['configurationcomplete'] = 'ตั้งค่าตัวแปรเสร็จสิ้นแล้ว';
$string['configurationcompletehead'] = 'ตั้งค่าตัวแปรเสร็จสิ้นแล้ว';
$string['configurationcompletesub'] = 'Moodle ทำการบันทึกไฟล์การตั้งค่าลงในโฟลเดอร์ moodle หลังจากทำการติดตั้ง';
$string['database'] = 'ฐานข้อมูล';
$string['databasecreationsettings'] = 'คุณจำเป็นต้องตั้งค่าฐานข้อมูลที่ใช้ในการเก็บข้อมูลของ moodle ฐานข้อมูลดังกล่าวจะต้องมีการสร้างไว้แล้วล่วงหน้า
<br /> <br />

<b>ประเภท:</b> ตั้งค่าไว้ที่ mysql <br />

<b>โฮสต์:</b> ตั้งค่าไว้ที่ localhost <br />

<b>ชื่อฐานข้อมูล:</b> ชื่อฐานข้อมูล, เช่นmoodle<br />

<b>ชื่อผู้ใช้ (username):</b>ตั้งค่าไว้ที่ root <br />

<b>รหัสผ่าน:</b> รหัสผ่านเข้าฐานข้อมูล<br />

<b>คำนำหน้าตาราง:</b> คำนำหน้าตาราง มีประโยชน์หากมีฐานข้อมูลของหลายโปรแกรมทำให้แยกออกได้ง่ายว่า ตารางใดเป็นของโปรแกรมใด เช่น mdl_';
$string['databasecreationsettingshead'] = 'คุณจำเป็นต้องตั้งค่าฐานข้อมูลที่ใช้ในการเก็บข้อมูลของ moodle ฐานข้อมูลดังกล่าวจะต้องมีการสร้างไว้แล้วล่วงหน้า';
$string['databasecreationsettingssub'] = '<b>ประเภท:</b> ตั้งค่าไว้ที่ mysql <br />

<b>โฮสต์:</b> ตั้งค่าไว้ที่ localhost <br />

<b>ชื่อฐานข้อมูล:</b> ชื่อฐานข้อมูล, เช่น moodle<br />

<b>ชื่อผู้ใช้ (user):</b>ตั้งค่าไว้ที่ root <br />

<b>รหัสผ่าน:</b> รหัสผ่านเข้าฐานข้อมูล<br />

<b>คำนำหน้าตาราง:</b> คำนำหน้าตาราง มีประโยชน์หากมีฐานข้อมูลของหลายโปรแกรมทำให้แยกออกได้ง่ายว่า ตารางใดเป็นของโปรแกรมใด เช่น mdl_';
$string['databasehost'] = 'ที่เก็บฐานข้อมูล:';
$string['databasename'] = 'ชื่อฐานข้อมูล:';
$string['databasepass'] = 'password ฐานข้อมูล';
$string['databasesettings'] = 'คุณจำเป็นต้องตั้งค่าฐานข้อมูลที่ใช้ในการเก็บข้อมูลของ moodle ฐานข้อมูลดังกล่าวจะต้องมีการสร้างไว้แล้วล่วงหน้า
<br />';
$string['databasesettingshead'] = 'คุณจำเป็นต้องตั้งค่าฐานข้อมูลที่ใช้ในการเก็บข้อมูลของ moodle ฐานข้อมูลดังกล่าวจะต้องมีการสร้างไว้แล้วล่วงหน้า';
$string['databasesettingssub'] = '<b>ประเภท:</b> ตั้งค่าไว้ที่ mysql <br />

<b>โฮสต์:</b> ตั้งค่าไว้ที่ localhost <br />

<b>ชื่อฐานข้อมูล:</b> ชื่อฐานข้อมูล, เช่นmoodle<br />

<b>ชื่อผู้ใช้ (username):</b>ตั้งค่าไว้ที่ root <br />

<b>รหัสผ่าน:</b> รหัสผ่านเข้าฐานข้อมูล<br />

<b>คำนำหน้าตาราง:</b> คำนำหน้าตาราง มีประโยชน์หากมีฐานข้อมูลของหลายโปรแกรมทำให้แยกออกได้ง่ายว่า ตารางใดเป็นของโปรแกรมใด เช่น mdl_';
$string['databasesettingssub_mssql'] = '<b>Type:</b> SQL*Server (non UTF-8) <b><strong class="errormsg">Experimental! (not for use in production)</strong></b><br />\n<b>Host:</b> eg localhost or db.isp.com<br />\n<b>Name:</b> database name, eg moodle<br />\n<b>User:</b> your database username<br />\n<b>Password:</b> your database password<br />\n<b>Tables Prefix:</b> prefix to use for all table names (mandatory)';
$string['databasesettingssub_mssql_n'] = '<b>Type:</b> SQL*Server (UTF-8 enabled)<br />\n<b>Host:</b> eg localhost or db.isp.com<br />\n<b>Name:</b> database name, eg moodle<br />\n<b>User:</b> your database username<br />\n<b>Password:</b> your database password<br />\n<b>Tables Prefix:</b> prefix to use for all table names (mandatory)';
$string['databasesettingssub_mysql'] = '<b>Type:</b> MySQL<br />\n<b>Host:</b> eg localhost or db.isp.com<br />\n<b>Name:</b> database name, eg moodle<br />\n<b>User:</b> your database username<br />\n<b>Password:</b> your database password<br />\n<b>Tables Prefix:</b> prefix to use for all table names (optional)';
$string['databasesettingssub_mysqli'] = '<b>Type:</b> Improved MySQL<br />\n<b>Host:</b> eg localhost or db.isp.com<br />\n<b>Name:</b> database name, eg moodle<br />\n<b>User:</b> your database username<br />\n<b>Password:</b> your database password<br />\n<b>Tables Prefix:</b> prefix to use for all table names (optional)';
$string['databasesettingssub_oci8po'] = '<b>Type:</b> Oracle<br />\n<b>Host:</b> not used, must be left blank<br />\n<b>Name:</b> given name of the tnsnames.ora connection<br />\n<b>User:</b> your database username<br />\n<b>Password:</b> your database password<br />\n<b>Tables Prefix:</b> prefix to use for all table names (mandatory, 2cc. max)';
$string['databasesettingssub_odbc_mssql'] = '<b>Type:</b> SQL*Server (over ODBC) <b><strong class="errormsg">Experimental! (not for use in production)</strong></b><br />\n<b>Host:</b> given name of the DSN in the ODBC control panel<br />\n<b>Name:</b> database name, eg moodle<br />\n<b>User:</b> your database username<br />\n<b>Password:</b> your database password<br />\n<b>Tables Prefix:</b> prefix to use for all table names (mandatory)';
$string['databasesettingssub_postgres7'] = '<b>Type:</b> PostgreSQL<br />\n<b>Host:</b> eg localhost or db.isp.com<br />\n<b>Name:</b> database name, eg moodle<br />\n<b>User:</b> your database username<br />\n<b>Password:</b> your database password<br />\n<b>Tables Prefix:</b> prefix to use for all table names (mandatory)';
$string['databasesettingswillbecreated'] = '<b> หมายเหตุ: </b> โปรแกรมติดตั้งจะพยายามสร้างฐานข้อมูลโดยอัตโนมัติถ้าไม่อยู่';
$string['databaseuser'] = 'ผู้ใช้ฐานข้อมูล:';
$string['dataroot'] = 'ไดเรกทอรีข้อมูล';
$string['datarooterror'] = 'ไม่พบไดเรกทอรีข้อมูลที่คุณระบุไว้หรือไม่สามารถสร้างได้ กรุณาแก้ไข Path ให้ถูกต้องหรือสร้างไดเรกทอรีนี้ใหม่';
$string['datarootpublicerror'] = '\'ไดเรกทอรีข้อมูล\' คุณระบุไว้โดยตรงที่สามารถเข้าถึงได้ผ่านทางเว็บคุณต้องใช้ในไดเรกทอรีที่แตกต่างกัน';
$string['dbconnectionerror'] = 'ไม่สามารถติดต่อฐานข้อมูลที่คุณระบุไว้ได้ กรุณาตรวจสอบค่าที่ตั้งไว้ของฐานข้อมูล';
$string['dbcreationerror'] = 'มีข้อผิดพลาดในการสร้างฐานข้อมูล ไม่สามารถสร้างฐานข้อมูลที่ระบุด้วยค่าที่ให้ไว้ได้';
$string['dbhost'] = 'โฮสต์เซิร์ฟเวอร์';
$string['dbpass'] = 'รหัสผ่าน';
$string['dbprefix'] = 'คำนำหน้าตาราง (Table Prefix)';
$string['dbtype'] = 'ประเภท';
$string['dbwrongencoding'] = 'ฐานข้อมูลที่เลือกกำลังทำงานด้วยการเข้ารหัส {$a} ซึ่งไม่แนะนำเป็นอย่างยิ่งแนะนำให้ใช้การเข้ารหัสแบบ unicode (UTF-8) ท่านสามารถเลือกที่จะข้ามการทดสอบได้โดยการเลือกที่ "ข้ามการทดสอบการเข้ารหัสของฐานข้อมูล" เช็คข้างล่างนี้แต่ท่านอาจพบปัญหาในอนาคต';
$string['dbwronghostserver'] = 'คุณต้องปฏิบัติตามกฎ "Host" อธิบายไว้ข้างต้น';
$string['dbwrongnlslang'] = 'ตัวแปรสภาพแวดล้อม NLS_LANG ในเว็บเซิร์ฟเวอร์ของคุณต้องใช้ charset AL32UTF8 ดูเอกสาร PHP เกี่ยวกับวิธีการกำหนดค่า oci8 อย่างถูกต้อง';
$string['dbwrongprefix'] = 'คุณต้องทำตาม "ตารางคำนำหน้า" กฎที่อธิบายไว้ข้างต้น';
$string['directorysettings'] = '<p>กรุณายืนยันที่ตั้งของการติดตั้ง  Moodle .</p>

<p><b>ที่อยู่ของเว็บ (Web Address):</b>

ระบุที่อยู่ของเว็บไซต์ที่คุณจะนำ Moodle ไปใช้ ถ้าหากเว็บของคุณเข้าผ่าน URLs หลายขั้นให้เลือกที่นักเรียนของคุณจะเข้าไปใช้ ไม่ต้องใส่เครื่องหมาย /  ปิดท้าย</p>

<p><b>ไดเรกทอรี moodle </b>

ระบุ path ของไดเรกทอรีเต็ม ๆ ที่ใช้ในการติดตั้ง ระวังเรื่องการใช้ชื่อตัวพิมพ์ใหญ่พิมพ์เล็กให้ดี ให้แน่ใจว่าถูกต้อง </p>

<p><b>ไดเรกทอรีข้อมูล:</b>

ไดเรกทอรีนี้จะเป็นที่เก็บไฟล์ที่ moodle จะทำการบันทึกไว้ เป็นข้อมูลของเว็บ ดังนั้นควรให้สิทธิ์ในการอ่าน และ เขียนลงไดเรกทอรีนี้  (ทั่วไปแล้ว \'nobody\' หรือ \'apache\') แต่ไม่ควรเข้าไปตรง ๆ ผ่านเว็บได้
</p>';
$string['directorysettingshead'] = 'กรุณายืนยันที่ตั้งของการติดตั้ง Moodle';
$string['directorysettingssub'] = '<p><b>ที่อยู่ของเว็บ (Web Address):</b>

ระบุที่อยู่ของเว็บไซต์ที่คุณจะนำ Moodle ไปใช้ ถ้าหากเว็บของคุณเข้าผ่าน URLs หลายขั้นให้เลือกที่นักเรียนของคุณจะเข้าไปใช้ ไม่ต้องใส่เครื่องหมาย /  ปิดท้าย</p>

<p><b>ไดเรกทอรี moodle </b>

ระบุ path ของไดเรกทอรีเต็ม ๆ ที่ใช้ในการติดตั้ง ระวังเรื่องการใช้ชื่อตัวพิมพ์ใหญ่พิมพ์เล็กให้ดี ให้แน่ใจว่าถูกต้อง </p>

<p><b>ไดเรกทอรีข้อมูล:</b>

ไดเรกทอรีนี้จะเป็นที่เก็บไฟล์ที่ moodle จะทำการบันทึกไว้ เป็นข้อมูลของเว็บ ดังนั้นควรให้สิทธิ์ในการอ่าน และ เขียนลงไดเรกทอรีนี้  (ทั่วไปแล้ว \'nobody\' หรือ \'apache\') แต่ไม่ควรเข้าไปตรง ๆ ผ่านเว็บได้
</p>';
$string['dirroot'] = 'Moodle ไดเรกทอรี';
$string['dirrooterror'] = 'การตั้งค่า ไดเรกทอรี moodle ไม่ถูกต้อง ไม่พบไฟล์ติดตั้งที่ระบุ  ระบบทำการรีเซ็ตค่าด้านล่างนี้';
$string['download'] = 'ดาวน์โหลด';
$string['downloadlanguagebutton'] = 'ดาวน์โหลด "{$a}" ไฟล์ภาษา';
$string['downloadlanguagehead'] = 'ดาวน์โหลดไฟล์ภาษา';
$string['downloadlanguagenotneeded'] = 'คุณสามารถดำเนินการติดตั้งโดยใช้ภาษาที่ตั้งค่าไว้ "{$a}"';
$string['downloadlanguagesub'] = 'คุณมีตัวเลือกในการดาวน์โหลดไฟล์ภาษาและดำเนินการติดตั้งด้วยภาษาดังกล่าว <br /><br /> ถ้าหากคุณไม่สามารถดาวน์โหลดภาษาได้การติดตั้งจะดำเนินการต่อด้วยภาษาอังกฤษ (หลังจากที่ติดตั้งสำเร็จแล้วท่านสามารถดาวน์โหลดภาษาได้ในภายหลัง)';
$string['doyouagree'] = 'คุณเห็น? (yes / no):';
$string['environmenthead'] = 'ตรวจสอบความพร้อมของระบบ';
$string['environmentsub'] = 'กำลังทำการตรวจสอบคอมโพเนนท์ต่าง ๆ ของระบบว่าตรงตามความต้องการของ Moodle หรือไม่';
$string['errorsinenvironment'] = 'ข้อผิดพลาดในสภาพแวดล้อม! n';
$string['fail'] = 'ล้มเหลว';
$string['fileuploads'] = 'ไฟล์อัพโหลด';
$string['fileuploadserror'] = 'ควรจะเปิด(on)';
$string['fileuploadshelp'] = '<p>เซิร์ฟเวอร์ไม่ให้ใช้ไฟล์อัพโหลด</p>

<p>คุณสามารถติดตั้ง Moodle ได้ถึงแม้ค่านี้จะยังไม่ได้มีการอนุญาตแต่จะไม่สามารถอัพโหลดไฟล์ในด ๆ หรือรูปภาพประกอบประวัติส่วนตัวของสมาชิกได้

<p>ให้ติดต่อเว็บเซิร์ฟเวอร์ของท่านเพื่อให้ทำการเปิดให้ใช้ ไฟล์อัพโหลดซึ่งปกติทำได้โดยแก้ไขไฟล์  php.ini โดยเปลี่ยนค่า <b>file_uploads</b> เป็น\'1\'.</p>';
$string['gdversion'] = 'GD  เวอร์ชัน';
$string['gdversionerror'] = 'เซิร์ฟเวอร์ควรมีการใช้ GD library เพื่อที่ใช้';
$string['gdversionhelp'] = '<p>เซิร์ฟเวอร์ของคุณยังไม่มีการติดตั้ง GD </p>

<p>GD เป็นส่วนที่จำเป็นในการช่วยในการแสดงและประมวลผลรูปภาพต่าง ๆ ภายใน Moodle อาทิเช่น ภาพไอคอนในประวัติส่วนตัว และการสร้างภาพใหม่เช่นการประมลวผลกราฟของบันทึกการใช้งานเว็บไซต์ต่างๆ  อย่างไรก็ตามคุณยังสามารถใช้ Moodle ได้ถึงแม้ไม่มี GD ติดตั้งแต่จะไม่สามารถใช้งานเกี่ยวกับการแสดงและประมวลผลภาพได้เท่านั้น</p>

<p> การติดตั้ง GD ใน PHP ภายใต้ยูนิกซ์เซิร์ฟเวอร์นั้น ใช้ตัวเปร  --with-gd</p>

<p>ส่วนภายใต้การใช้งานวินโดว์คุณสามารถติดตั้งโดยการแก้ไขไฟล์  php.ini และเอาเครื่องหมายคอมเมนต์ด้านหน้า php_gd2.dll ออก</p>';
$string['globalsquotes'] = 'การใช้งานแบบ Globals ยังไม่ปลอดภัย';
$string['globalsquoteserror'] = 'แก้ไขค่า PHP ของท่านโดยปิดการใช้งาน register_globals และ/หรือ เปิดการใช้งาน magic_quotes_gpc';
$string['globalsquoteshelp'] = '<p>ไม่แนะนำให้เปิดการใช้งาน Magic Quotes GPC และ  Register Globals  ในเวลาเดียวกัน</p>
<p>แนะนำให้ใช้ค่าต่อไปนี้ใน php.ini <b>magic_quotes_gpc = On</b> และ <b>register_globals = Off</b></p>
<p> ถ้าหากท่านไม่สามารถเข้าทำการแก้ไขไฟล์ php.ini ได้สามารถทำการสร้างไฟล์ .httaccess ขึ้นมาโดยสร้างไฟล์ดังนี้
<blockquote>php_value magic_quotes_gpc On</blockquote>
<blockquote>php_value register_globals Off</blockquote> แล้วอัพโหลดขึ้นไปไว้ในไดเรกทอรี moodle
</p>';
$string['inputdatadirectory'] = 'ไดเรกทอรีข้อมูล:';
$string['inputwebadress'] = 'ที่อยู่เว็บ:';
$string['inputwebdirectory'] = 'ไดเร็กทอรี Moodle:';
$string['installation'] = 'การติดตั้ง';
$string['langdownloaderror'] = 'ภาษา "{$a}" ไม่ได้รับการติดตั้ง กระบวนการติดตั้งจะดำเนินไปด้วยภาษาอังกฤษ';
$string['langdownloadok'] = 'ภาษา"{$a}" ได้รับการติดตั้งเรียบร้อยแล้ว กระบวนการติดตั้งจะดำเนินไปด้วยภาษานี้';
$string['magicquotesruntime'] = 'Magic Quotes Run Time';
$string['magicquotesruntimeerror'] = 'ควรจะปิด (off)';
$string['magicquotesruntimehelp'] = '<p>ควรทำการปิด Magic quotes runtime เพื่อให้ moodle ทำงานได้ถูกต้อง</p>

<p>โดยทั่วไปแล้วเซิร์ฟเวอร์จะทำการปิดค่านี้ไว้ก่อน โดยสามารถดูได้จากการตั้งค่าตัวแปร <b>magic_quotes_runtime</b> ในไฟล์ php.ini </p>

<p>ถ้าคุณไม่สามารถแก้ไขไฟล์ php.ini ได้ด้วยตนเองคุณสามารถทำการปิดฟังก์ชั่นนี้โดยการเพิ่มไฟล์ .htaccess ภายใต้ไดเรกทอรี moodle โดยสร้างไฟล์ที่มีการตั้งค่าดังนี้

<blockquote>php_value magic_quotes_runtime Off</blockquote>

</p>';
$string['memorylimit'] = 'ความจำสูงสุด (Memory Limit)';
$string['memorylimiterror'] = 'ความจำสูงสุดที่คุณตั้งไว้ค่อนข้างต่ำ อาจมีปัญหาในภายหลังค่ะ';
$string['memorylimithelp'] = '<p>ค่าความจำสูงสุดของเซิร์ฟเวอร์ของคุณตั้งไว้ที่  {$a}</p>

<p>ความจำดังกล่าวมีค่าน้อยไปค่ะอาจทำให้มีปัญหาในการใช้งาน moodle ในภายหลังโดยเฉพาะเมื่อคุณใช้โมดูลหลาย ๆ ตัวรวมไปถึงมีสมาชิกจำนวนมาก

<p>ค่าที่ตั้งไว้นี้ควรตั้งให้มากที่สุดเท่าที่จะมากได้ ค่าทั่วไปแนะนำไว้ที่ 40M มีอยู่หลายวิธีในการเพิ่มค่าความจำสูงสุด กล่าวคือ:

<ol>

<li>รีคอมไพล์ PHP ใหม่ โดยเพิ่มคำสั่ง <i>--enable-memory-limit</i> ซึ่งเป็นการตั้งค่าให้ moodle กำหนดขีดจำกัดค่าสูงสุดเอง

<li>ถ้าคุณสามารถแก้ไขไฟล์  php.ini ได้ด้วยตนเองก็สามารถเปลี่ยนค่า <b>memory_limit</b> ให้เป็นค่าอื่นได้เช่น  40M แต่ถ้าไม่สามารถเปลี่ยนค่านี้ได้ด้วยตนเองให้แจ้งผู้ดูแลระบบแก้ไข

<li>ในเซิร์ฟเวอร์ PHP บางตัวคุณสามารถสร้าง ไฟล์ .htaccess ภายใต้ไดเรกทอรี moodle ซึ่งมีบรรทัดต่อไปนี้อยู่:

<p><blockquote>php_value memory_limit 40M</blockquote></p>

<p>อย่างไรก็ตามในบางเซิร์ฟเวอร์คุณไม่สามารถใช้ วิธีนี้ได้ โดยจะมีการแสดง error ขึ้นมาคุณจำเป็นต้องลบไฟล์ดังกล่าวนี้ทิ้ง
</ol>';
$string['mssql'] = 'SQL*Server (mssql)';
$string['mssql_n'] = 'SQL*Server with UTF-8 support (mssql_n)';
$string['mssqlextensionisnotpresentinphp'] = 'PHP ไม่ได้รับการกำหนดค่าอย่างเหมาะสมที่มีนามสกุล MSSQL เพื่อที่จะสามารถสื่อสารกับเซิร์ฟเวอร์ SQL * กรุณาตรวจสอบไฟล์ php.ini หรือ recompile PHP ของคุณ';
$string['mysql'] = 'MySQL (mysql)';
$string['mysqlextensionisnotpresentinphp'] = 'การตั้งค่า  PHP ให้ใช้กับ MySQL ไม่ถูกต้องกรุณาตรวจสอบใน php.ini อีกครั้งหรือรีคอมไฟล์ php';
$string['mysqli'] = 'Improved MySQL (mysqli)';
$string['mysqliextensionisnotpresentinphp'] = 'PHP ไม่ได้รับการกำหนดค่าอย่างเหมาะสมกับการขยาย MySQLi เพื่อที่จะสามารถสื่อสารกับ MySQL กรุณาตรวจสอบไฟล์ php.ini หรือ recompile PHP ของคุณ ขยาย MySQLi จะไม่สามารถใช้ได้สำหรับ PHP 4';
$string['oci8po'] = 'Oracle (oci8po)';
$string['ociextensionisnotpresentinphp'] = 'PHP ไม่ได้รับการกำหนดค่าอย่างถูกต้องกับ oci8 ส่วนขยายเพื่อให้สามารถติดต่อสื่อสารกับ Oracle กรุณาตรวจสอบไฟล์ php.ini หรือ recompile PHP ของคุณ';
$string['odbc_mssql'] = 'SQL*Server over ODBC (odbc_mssql)';
$string['odbcextensionisnotpresentinphp'] = 'PHP ไม่ได้รับการกำหนดค่าอย่างเหมาะสมที่มีนามสกุล ODBC เพื่อที่จะสามารถสื่อสารกับเซิร์ฟเวอร์ SQL * กรุณาตรวจสอบไฟล์ php.ini หรือ recompile PHP ของคุณ';
$string['pass'] = 'สำเร็จ';
$string['pgsqlextensionisnotpresentinphp'] = 'PHP ไม่ได้รับการกำหนดค่าอย่างเหมาะสมที่มีนามสกุล pgsql เพื่อที่จะสามารถสื่อสารกับ PostgreSQL กรุณาตรวจสอบไฟล์ php.ini หรือ recompile PHP ของคุณ';
$string['phpversion'] = 'PHP เวอร์ชัน';
$string['phpversionhelp'] = '<p>Moodle จำเป็นต้องใช้ PHP เวอร์ชัน 4.1.0 เป็นอย่างน้อย</p>

<p>คุณกำลังใช้เวอร์ชัน {$a}</p>

<p>คุณต้องอัพเกรด  PHP หรือย้ายโฮสต์ใหม่ที่มี PHP เวอร์ชันใหม่กว่า</p>';
$string['postgres7'] = 'PostgreSQL (postgres7)';
$string['releasenoteslink'] = 'สำหรับข้อมูลเกี่ยวกับรุ่นของ Moodle นี้โปรดดูหมายเหตุที่วางจำหน่ายอยู่ที่ {$a}';
$string['safemode'] = 'Safe Mode';
$string['safemodeerror'] = 'moodle อาจมีปัญหาหาก safe mode on';
$string['safemodehelp'] = '<p>Moodle อาจมีปัญหาหาก safe mode on ซึ่งจะทำให้คุณไม่สามารถสร้างไฟล์ใหม่ได้</p>

<p>Safe mode โดยทั่วไปแล้วจะเปิดใช้ในบางเว็บโฮสติ้ง อาจจำเป็นต้องหาโฮสต์ใหม่ที่เหมาะสมสำหรับการใช้งาน Moodle </p>

<p>คุณสามารถเริ่มการติดตั้งในตอนนี้แต่อาจมีปัญหาตามมาภายหลัง</p>';
$string['sessionautostart'] = 'Session Auto Start';
$string['sessionautostarterror'] = 'ควรจะปิด (off)';
$string['sessionautostarthelp'] = '<p>Moodle จะทำงานก็ต่อเมื่อเซิร์ฟเวอร์สนับสนุน session </p>

<p>คุณสามารถทำให้ Sessions ทำงานได้โดยการแก้ไขไฟล์  php.ini ดูภายใต้ตัวแปร  session.auto_start </p>';
$string['skipdbencodingtest'] = 'ข้ามการทดสอบการเข้ารหัสของฐานข้อมูล';
$string['upgradingqtypeplugin'] = 'ปรับปรุง Question/type Plugin';
$string['welcomep10'] = '{$a->installername} ({$a->installerversion})';
$string['welcomep20'] = 'ท่านได้ทำการติดตั้ง<strong>{$a->packname} {$a->packversion}</strong> สำเร็จแล้ว';
$string['welcomep30'] = 'เวอร์ชั่น <strong>{$a->installername}</strong>รวมโปรแกรมสำหรับสร้างความให้กับระบบซึ่ง Moodle สามารถทำงานได้';
$string['welcomep40'] = 'แพ็กเกจนี้รวม <strong>Moodle {$a->moodlerelease} ({$a->moodleversion})</strong>.';
$string['welcomep50'] = 'การใช้งานโปรแกรมต่าง ๆ ในแพ็กเกจนี้สามารถทำได้โดยไม่ละเมิดสัญญานุญาตของแต่ละโปรแกรม  โปแกรม<strong>{$a->installername}</strong>เต็มรูปแบบนั้นจัดเป็นโปรแกรมประเภท
<a href="http://www.opensource.org/docs/definition_plain.html">โอเพ่นซอร์ส</a> และเผยแพร่ภายใต้สํญญานุญาต <a href="http://www.gnu.org/copyleft/gpl.html">GPL</a>';
$string['welcomep60'] = 'หน้าถัดจากนี้ไปจะเป็นการตั้งค่า Moodle บนคอมพิวเตอร์คุณสามารถยอมรับค่าที่ตั้งไว้ทั้งหมดหรือเปลี่ยนแปลงให้เหมาะกับความต้องการ';
$string['welcomep70'] = 'คลิกที่ "ต่อไป" เพื่อติดตั้ง Moodle ต่อไป';
$string['wwwroot'] = 'ที่อยู่ของเว็บ';
$string['wwwrooterror'] = 'ที่อยู่ของเว็บไม่ถูกต้อง ระบบไม่พบว่ามี Moodle อยู่ที่นั่น';
