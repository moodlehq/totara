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

$string['actauthhdr'] = 'plug in ของการพิสูจน์ตัวตนว่าคือใคร ทำงาน';
$string['alternatelogin'] = 'ใส่ url ของหน้าที่ต้องการใช้เป็นหน้าสำหรับเข้าสู่ระบบโดยหน้าดังกล่าวควรประกอบไปด้วย <strong>\'{$a}\'</strong> และมีฟิลด์ต่อไปนี้ <strong>ชื่อผู้ใช้</strong> และ <strong>รหัสผ่าน</strong> <br />  โปรดใช้ความระมัดระวังในการใส่ค่า url  เพราะการใส่ค่าที่ไม่ถูกต้องอาจทำให้ระบบนำคุณออกจากระบบ <br /> ทิ้งช่องนี้ให้ว่างไว้เพื่อใช้หน้าที่ระบบตั้งไว้';
$string['alternateloginurl'] = 'URL ของหน้าเข้าสู่ระบบที่ต้องการ';
$string['auth_changepasswordhelp'] = 'ช่วยเหลือการเปลี่ยนรหัสผ่าน';
$string['auth_changepasswordhelp_expl'] = 'แสดงการช่วยเหลือสำหรับสมาชิกที่ทำรหัสผ่านหาย หน้านี้จะเป็นการแสดงข้อมูล URL สำหรับเปลี่ยนรหัสผ่านหรือใช้งานการเปลี่ยนรหัสผ่านใน Moodle';
$string['auth_changepasswordurl'] = 'URL สำหรับเปลี่ยนรหัสผ่าน';
$string['auth_changepasswordurl_expl'] = 'ระบุ Url หน้าที่ต้องการให้สมาชิกที่ทำรหัสผ่านหาย โดยตั้งค่า <strong>ใช้หน้าการเปลี่ยนรหัสผ่านมาตรฐาน</strong> เป็น <strong>ไม่</strong>.';
$string['auth_changingemailaddress'] = 'คุณได้ร้องขอให้เปลี่ยน email address จาก {$a->oldemail} เป็น {$a->newemail} และด้วยเหตุผลทางด้านความปลอดภัยเราจะส่ง email ให้คุณโดยใช้ email address ใหม่ของคุณ ซึ่งจะอัพเดททันทีที่คุณใช้ URL ส่งข้อความร้องขอนี้';
$string['auth_common_settings'] = 'การตั้งค่าทั่วไป';
$string['auth_data_mapping'] = 'การจับคู่ข้อมูล';
$string['auth_fieldlock'] = 'ล็อคค่า';
$string['auth_fieldlock_expl'] = '<p><b>ล็อคค่า:</b> หากเปิดใช้งานจะทำให้สมาชิก Moodle และผู้ดูแลระบบไม่สามารถแก้ไขค่าในฟิลด์ต่าง ๆ ได้โดยตรง ให้เลือกใช้ค่านี้หากคุณต้องการเก็บข้อมูลต่าง ๆ ไว้ในฐานข้อมูลนอก </p>';
$string['auth_fieldlocks'] = 'ล็อคฟิลด์สมาชิก';
$string['auth_fieldlocks_help'] = 'คุณสามารถล็อคฟิลด์ข้อมูลสมาชิก มีประโยชน์สำหรับเว็บไซต์ที่เฉพาะผู้ดูแลระบบทำเท่านั้นที่จะทำหน้าที่แก้ไขข้อมูลของสมาชิกจากนั้นทำการอัพโหลดสมาชิกเข้าสู่ระบบ ถ้าหากมีการล็อกฟิลด์ให้ตรวจสอบให้ดีว่าได้ทำการเพิ่มข้อมูลที่จำเป็นสำหรับการสร้างบัญชีผู้ใช้ใน moodle เรียบร้อยแล้วมิเช่นนั้นบัญชีผู้ใช้จะไม่สามารถใช้การได้
หากต้องการหลีกเลี่ยงปัญหาดังกล่าวให้ตั้งค่าโหมดการล็อคไว้ที่ "เปิดล็อคหากไม่มีข้อมูล"';
$string['auth_invalidnewemailkey'] = 'ข้อผิดพลาด: ถ้าหากคุณพยายามที่จะยืนยันการเปลี่ยนที่อยู่อีเมล คุณจะทำผิดพลาดในการก๊อปปี้ URL ที่เราได้ส่งอีเมลหาคุณ โปรดก๊อปปี้อีเมลแล้วลองดูใหม่อีกครั้ง';
$string['auth_multiplehosts'] = 'สามารถใส่โฮสต์หลาย ๆ ตัวลงไป เช่น host1.com;host2.com;host3.com';
$string['auth_outofnewemailupdateattempts'] = 'คุณได้พยายามที่จะปรับปรุงที่อยู่อีเมลจนเกิดจำนวนครั้งที่ตั้งค่าอนุญาตไว้ การร้องขอของคุณจึงถูกยกเลิก';
$string['auth_passwordisexpired'] = 'รหัสผ่านของคุณกำลังจะหมดอายุต้องการเปลี่ยนหรือไม่คะ';
$string['auth_passwordwillexpire'] = 'รหัสผ่านของคุณจะหมดอายุในอีก {$a} วันต้องการเปลี่ยนรหัสผ่านตอนนี้หรือไม่คะ';
$string['auth_remove_delete'] = 'การลบภายในทั้งหมด';
$string['auth_remove_keep'] = 'เก็บค่าภายในไว้';
$string['auth_remove_suspend'] = 'หยุดภายในชั่วคราว';
$string['auth_remove_user'] = 'กำหนดว่าจะทำอะไรกับบัญชีผู้ใช้ภายในระหว่างที่ทำการถ่ายโอนข้อมูลให้เหมือนกัน เมื่อผู้ใช้ถูกย้ายออกไปจากแหล่งภายนอก มีเพียงผู้ใช้ที่ถูกหยุดการใช้งานชั่วคราวเท่านั้นที่ถูกดึงกลับมาใช้ใหม่โดยอัตโนมัติในแหล่งภายนอก';
$string['auth_remove_user_key'] = 'ย้ายผู้ใช้ภายนอกออกไป';
$string['auth_sync_script'] = 'สคริปการถ่ายโอนข้อมูล Cron';
$string['auth_updatelocal'] = 'อัพเดทข้อมูลภายใน';
$string['auth_updatelocal_expl'] = '<p><b>อัพเดทข้อมูลภายใน :</b> หากเปิดใช้งาน ฟิลด์ของตารางในฐานข้อมูลภายนอกจะมีการอัพเดททุกครั้งที่สมาชิกเข้าสู่ระบบหรือมีการ synchronise ฐานข้อมูลสมาชิก  ในกรณีที่เลือกให้อัพเดทข้อมูลภายในควรทำการล็อกฟิลด์เอาไว้</p>';
$string['auth_updateremote'] = 'อัพเดทข้อมูลภายนอก';
$string['auth_updateremote_expl'] = '<p><b>อัพเดทข้อมูลภายนอก:</b>หากเปิดใช้งานฐานข้อมูลภายนอกจะได้รับการอัพเดททุกครั้งที่สมาชิกทำการเปลี่ยนแปลงระเบียนประวัติ ควรทำการเปิดล็อคฟิลด์หากอนุญาตให้ทำการแก้ไข</p>';
$string['auth_updateremote_ldap'] = '<p><b>หมายเหตุ:</b> อัพเดทข้อมูล LDAP จากภายนอกจำเป็นต้องตั้งค่า binddn และ bindpw โดยให้สิทธิ์bind-user ในการแก้ไขระเบียนประวัติ ค่าปัจจุบันที่ตั้งไว้ไม่สามารถใช้แอตทริบิวต์หลายตัวและจะทำการทิ้งค่าที่เพิ่มขึ้นมาในการอัพเดท </p>';
$string['auth_user_create'] = 'อนุญาตให้เพิ่มสมาชิกได้';
$string['auth_user_creation'] = 'อนุญาตให้สมาชิกทั่วไปสามารถสร้างบัญชีสมาชิกและตอบยืนยันได้ ถ้าอนุญาต โปรดอย่าลืมไปปรับแก้ระบบ moodule-specific ตัวเลือก user creation ด้วย';
$string['auth_usernameexists'] = 'มีสมาชิกชื่อนี้ในระบบแล้ว กรุณาเลือกชื่อใหม่';
$string['authenticationoptions'] = 'วิธีการอนุมัติการเป็นสมาชิก';
$string['authinstructions'] = 'คุณสามารถให้ข้อมูลกับสมาชิก และแนะนำวิธีการใช้ ผ่านส่วนนี้ ทำให้สมาชิกทราบว่า username และ password ของตัวเองคืออะไร ข้อความที่คุณระบุในส่วนนี้จะปรากฎ ใน หน้าล็อกอิน  ถ้าหากคุณปล่อยว่างไว้ จะไม่มีวิธีการใช้ปรากฎ';
$string['auto_add_remote_users'] = 'เพิ่มบัญชีผู้ใช้ระยะไกลโดยอัตโนมัติ';
$string['changepassword'] = 'เปลี่ยนรหัส URL';
$string['changepasswordhelp'] = 'คุณสามารถระบุลิงก์ ที่สมาชิกสามารถจะเปลี่ยน หรือ หา ชื่อ และ passwordได้ เมื่อมีการลืม ลิงก์ดังกล่าวจะนำสมาชิกไปยังหน้า ล็อกอิน และหน้าข้อมูลส่วนตัว แต่หากไม่เติมอะไร ปุ่มดังกล่าวจะไม่ปรากฎ';
$string['chooseauthmethod'] = 'เลือกวิธีการอนุมัติ';
$string['createpasswordifneeded'] = 'สร้างรหัสผ่านหากต้องการ';
$string['enterthenumbersyouhear'] = 'ใสค่าหมายเลขของคุณที่นี่';
$string['enterthewordsabove'] = 'ใส่คำบน';
$string['errorminpassworddigits'] = 'รหัสผ่านจะต้องมีอย่างน้อย {$a} หลัก';
$string['errorminpasswordlength'] = 'รหัสผ่านจะต้องมีความยาวอย่างน้อย {$a} ตัว';
$string['errorminpasswordlower'] = 'รหัสผ่านจะต้องมีแบบพิมพ์เล็กอย่างน้อย {$a} ตัว';
$string['errorminpasswordnonalphanum'] = 'รหัสผ่านจะต้องไม่ใช่ตัวอักษรอย่างน้อย {$a} ตัว';
$string['errorminpasswordupper'] = 'รหัสผ่านจะต้องมีอย่างน้อย {$a} หลัก';
$string['errorpasswordupdate'] = 'ข้อผิดพลาดในการปรับปรุงรหัสผ่าน รหัสผ่านยังไม่ได้เปลี่ยนแปลง';
$string['forcechangepassword'] = 'บังคับให้เปลี่ยนรหัสผ่าน';
$string['forcechangepassword_help'] = 'บังคับสมาชิกให้เปลี่ยนรหัสผ่านในครั้งต่อไปที่เข้าสู่ระบบ';
$string['forcechangepasswordfirst_help'] = 'บังคับให้สมาชิกเปลี่ยนรหัสผ่านในครั้งแรกที่เข้าสู่ระบบ';
$string['forgottenpassword'] = 'ถ้าคุณใส่ค่า URL ที่นี่ มันจะถูกใช้เป็นรหัสที่หายไปสำหรับไซด์นี้ นี่คือความตั้งใจของไซค์ เมื่อรหัสผ่านถูกดูแลจากข้างนอกมูเดิ้ล ปล่อยค่าให้ว่างเพื่อใช้ ตัวกู้รหัสผ่าน';
$string['forgottenpasswordurl'] = 'รหัสผ่าน URL ที่ลืม';
$string['getanaudiocaptcha'] = 'ได้รับเสียงของ CAPTCHA';
$string['getanimagecaptcha'] = 'ได้รับภาพของ CAPTCHA';
$string['getanothercaptcha'] = 'ได้อีก CAPTCHA อื่น';
$string['guestloginbutton'] = 'ปุ่มล็อกอินในฐานะบุคคลทั่วไป';
$string['incorrectpleasetryagain'] = 'ไม่ถูกต้อง กรุณาทำใหม่อีกครั้ง';
$string['infilefield'] = 'ฟิลด์ที่ต้องการในไฟล์';
$string['informminpassworddigits'] = 'อย่างน้อยที่สุด {$a} ตำแหน่ง';
$string['informminpasswordlength'] = 'อย่างน้อยที่สุด {$a} ตัว';
$string['informminpasswordlower'] = 'อักษรตัวพิมพ์เล็กอย่างน้อยที่สุด {$a} ตัว';
$string['informminpasswordnonalphanum'] = 'ตัวอักษรพิเศษอย่างน้อยที่สุด {$a} ตัว';
$string['informminpasswordupper'] = 'อักษรตัวพิมพ์ใหญ่อย่างน้อยที่สุด {$a} ตัว';
$string['informpasswordpolicy'] = 'รหัสผ่านต้องมี {$a}';
$string['instructions'] = 'วิธีใช้';
$string['internal'] = 'ภายใน';
$string['locked'] = 'ล็อคไว้';
$string['md5'] = 'เข้ารหัสแบบ MD5';
$string['nopasswordchange'] = 'รหัสผ่านไม่สามารถเปลี่ยนได้';
$string['nopasswordchangeforced'] = 'คุณไม่สามารถดำเนินการโดยไม่เปลี่ยนรหัสผ่าน อย่างไรก็ตาม ไม่มีหน้าว่างสำหรับการเปลี่ยนมัน กรุณาติดต่อผู้ดูแลระบบมูเดิ้ลของคุณ';
$string['ntlmsso_attempting'] = 'พยายามทำ SSO ฝ่าน NTLM';
$string['ntlmsso_failed'] = 'เการข้าสู่ระบบอย่างอัตโนมัติล้มเหลว ทำอีกครั้งในหน้า login ปรกติ';
$string['ntlmsso_isdisabled'] = 'ไม่เปิดใช้งาน NTLM SSO';
$string['passwordhandling'] = 'การจัดการฟิลด์รหัสผ่าน';
$string['plaintext'] = 'ตัวหนังสือธรรมดา(Plain Text)';
$string['pluginnotenabled'] = 'ส่วนติดตั้งเพิ่ม Authentication {$a} ยังไม่เปิดใช้งาน';
$string['pluginnotinstalled'] = 'ส่วนติดตั้งเพิ่ม Authentication {$a} ยังไม่ได้ติดตั้ง';
$string['recaptcha'] = 'การตรวจสอบความเป็นมนุษย์';
$string['selfregistration'] = 'ลงทะเบียนเข้าใช้ระบบด้วยตัวเอง';
$string['selfregistration_help'] = 'ถ้าส่วนติดตั้งเพิ่มเติม authentication เช่น การลงทะเบียนเข้าใช้ระบบด้วยตัวเองทางอีเมลถูกเลือก มันจะเปิดให้ผู้ใข้ให้ลงทะเบียนตัวเองและสร้างบัญชีผู้ใช้ ผลก็คือสแปมสามารถสร้างบัญชีผู้ใช้ขึ้นมาเองเพื่อจะใช้ ฟอรั่มในการ โพสต์ เข้าไปใน blog ดังนั้นเพื่อหลีกเลี่ยงปัญหานี้ การลงทะเบียนด้วยตัวเองจะถูกปิดการใช้งานหรือจำกัดการใช้โดย\*โดเมนอีเมลที่ได้รับอนุญาต\* การตั้ง';
$string['sha1'] = 'ค่า SHA-1 hash';
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
