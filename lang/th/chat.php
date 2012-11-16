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
 * Strings for component 'chat', language 'th', branch 'MOODLE_22_STABLE'
 *
 * @package   chat
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['autoscroll'] = 'เลื่อนอัตโนมัต';
$string['beep'] = 'เรียก';
$string['chat:chat'] = 'เข้าห้องแชท
เข้าห้องแชท';
$string['chat:deletelog'] = 'ลบบันทึกการสนทนา';
$string['chat:readlog'] = 'อ่านบันทึกการสนทนา';
$string['chat:talk'] = 'พูดคุยในการแชท';
$string['chatintro'] = 'คำนำ';
$string['chatname'] = 'ชื่อห้อง';
$string['chatreport'] = 'กำหนดการสนทนา';
$string['chattime'] = 'เวลาสนทนาครั้งต่อไป';
$string['configmethod'] = 'โดยปกติแล้วในการดำเนินการสนทนา คอมพิวเตอร์ของผู้ใช้จะทำการติดต่อกับเซิร์ฟเวอร์ทุกครั้งที่มีการอัพเดท ไม่จำเป็นต้องตั้งค่าใด ๆ และจะทำงานในทุก ๆ ที่ แต่ทั้งนี้อาจจะเป็นการเพิ่มโหลดให้กับเซิร์ฟเวอร์ได้ในกรณีที่มีผู้สนทนาจำนวนมาก  การใช้แชทเซิร์ฟเวอร์อาศัยการใช้ shell access ไปยังระบบยูนิกซ์ แต่จะทำให้อัตราเร็วของการสนทนาเพิ่มขึ้น';
$string['confignormalupdatemode'] = 'ห้องสนทนาปกติจะมีการอัพเดท โดยใช้คุณสมบัติ
<em>Keep-Alive</em> ของ HTTP 1.1 แต่วิธีการนี้ทำให้เซิร์ฟเวอร์ทำงานหนัก ท่านสามารถเลือกใช้วิธีชั้นสูงกว่านี้โดยการเลือก
<em>Stream</em> วิธีการคือเซิร์ฟเวอร์จะทำการป้อนข้อมูลที่มีการอัพเดทให้แก่สมาชิกการใช้งาน<em>Stream</em> นั้นดีกว่าแบบแรกมากแต่เซิร์ฟเวอร์ของท่านอาจไม่สนับการใช้งานวิธีนี้';
$string['configoldping'] = 'สมาชิกหายไปกี่นาทีถึงจะถือว่าออกจากห้องสนทนาแล้ว';
$string['configrefreshroom'] = 'ควรรีเฟรชแชทรูมบ่อยขนาดไหน ถ้าตั้งค่าช้าจะทำให้ห้องสนทนาดูเร็วขึ้นแต่ว่าจะทำให้เว็บเซิร์ฟเวอร์ทำงานหนัก ถ้ามีคนสนทนาจำนวนมาก';
$string['configrefreshuserlist'] = 'ควรทำการรีเฟรชรายชื่อผู้ร่วมสนทนาบ่อยแค่ไหน (เป็นวินาที)';
$string['configserverhost'] = 'ชื่อของโฮสท์ของคอมพิวเตอร์ที่เป็นที่อยู่ของแชทเซิร์ฟเวอร์';
$string['configserverip'] = 'หมายเลขไอพีของเครื่องที่ระบุข้างบน';
$string['configservermax'] = 'จำนวนผู้สนทนาสูงสุด';
$string['configserverport'] = 'พอร์ทที่ใช้บนเซิร์ฟเวอร์';
$string['currentchats'] = 'การสนทนาที่มีอยู่ขณะนี้';
$string['currentusers'] = 'ผู้ที่กำลังสนทนา';
$string['deletesession'] = 'ลบการสนทนานี้';
$string['deletesessionsure'] = 'แน่ใจนะคะว่าต้องการลบการสนทนานี้';
$string['donotusechattime'] = 'ไม่ระบุเวลาสนทนา';
$string['enterchat'] = 'คลิกที่นี่เพื่อสนทนา';
$string['errornousers'] = 'ไม่พบสมาชิก';
$string['explaingeneralconfig'] = 'ใช้ค่านี้ตลอด';
$string['explainmethoddaemon'] = 'ใช้ค่านี้เมื่อมีการเลือก chatserver daemon เป็นวิธีการติดต่อกับเซิร์ฟเวอร์';
$string['explainmethodnormal'] = 'ใช้ค่านี้เมื่อเลือกวิธีปกติในการติดต่อกับเซิร์ฟเวอร์';
$string['generalconfig'] = 'การตั้งค่าทั่วไป';
$string['idle'] = 'นิ่ง';
$string['list_all_sessions'] = 'รายการการสนทนาทั้งหมด';
$string['list_complete_sessions'] = 'รายการสนทนาช่วงที่สมบูรณ์';
$string['listing_all_sessions'] = 'รายการการสนทนาทั้งหมด';
$string['messagebeepseveryone'] = '{$a} เรียกทุกคน';
$string['messagebeepsyou'] = '{$a} เรียกคุณ';
$string['messageenter'] = '{$a}  เข้าห้องสนทนา';
$string['messageexit'] = '{$a} ออกห้องสนทนา';
$string['messages'] = 'ข้อความ';
$string['method'] = 'วิธีการแชท';
$string['methoddaemon'] = 'แชทเซิร์ฟเวอร์';
$string['methodnormal'] = 'วิธีปกติ';
$string['modulename'] = 'ห้องสนทนา';
$string['modulenameplural'] = 'ห้องสนทนา';
$string['neverdeletemessages'] = 'ไม่มีการลบข้อความ';
$string['nextsession'] = 'ตารางการสนทนาครั้งต่อไป';
$string['no_complete_sessions_found'] = 'ไม่มีการสนทนาที่สมบูรณ์พบ';
$string['noguests'] = 'บุคคลทั่วไปไม่สามารถเข้าสนทนาได้';
$string['nomessages'] = 'ยังไม่มีข้อความ';
$string['normalkeepalive'] = 'รักษาสภาพออนไลน์';
$string['normalstream'] = 'Stream';
$string['noscheduledsession'] = 'ไม่มีตารางนัดหมาย';
$string['notallowenter'] = 'คุณไม่ได้รับอนุญาตให้เข้าสู่ห้องสนทนา';
$string['oldping'] = 'หมดเวลา';
$string['pastchats'] = 'การสนทนาที่ผ่านมา';
$string['pluginname'] = 'ห้องสนทนา';
$string['refreshroom'] = 'ห้องรีเฟรช';
$string['refreshuserlist'] = 'รายชื่อผู้ใช้ฟื้นฟู';
$string['removemessages'] = 'ลบออกทุกข้อความ';
$string['repeatdaily'] = 'เวลาเดียวกันนี้ทุกวัน';
$string['repeatnone'] = 'ไม่มีการซ้ำหัวข้อเสวนา  เฉพาะเวลาที่ระบุเท่านั้น';
$string['repeattimes'] = 'เสวนาเรื่องนี้ซ้ำ';
$string['repeatweekly'] = 'เวลาเดียวกันนี้ทุกสัปดาห์';
$string['savemessages'] = 'บันทึกการเสวนาครั้งที่ผ่านมา';
$string['seesession'] = 'ดูการเสวนาครั้งนี้';
$string['serverhost'] = 'ชื่อเซิร์ฟเวอร์';
$string['serverip'] = 'IP ของเซิร์ฟเวอร์';
$string['servermax'] = 'ผู้ใช้สูงสุด';
$string['serverport'] = 'พอร์ตของเซิร์ฟเวอร์';
$string['sessions'] = 'การเสวนา';
$string['strftimemessage'] = '%H:%M';
$string['studentseereports'] = 'ทุกคนสามารถดูการเสวนาครั้งที่ผ่านมาได้';
$string['updatemethod'] = 'ปรับปรุงวิธีการ';
$string['usingchat_help'] = 'แชทโมดูลประกอบด้วยหลายส่วนประกอบที่จะทำให้การแชทสนุกสนานขึ้น

**สไมลีส์**
: ใบหน้าสไมลีส์ (อีโมติคอน) ที่พิมพ์บนที่ใดๆ ใน Moodle สามารถพิมพ์และแสดงใบหน้าอย่างที่ต้องการในห้องแชทนี้ได้เช่นกัน
**ลิงค์**
: ที่อยู่อินเตอร์เน็ตต่างๆ สามารถเปลี่ยนเป็นลิงค์อัตโนมัติได้
**การแสดงอารมณ์**
: ขึ้นต้นบรรทัดด้วย "/me" หรือ ":" เพื่อแสดงอารมณ์ เช่น สมมติว่าคุณชื่อ คิ้ม เมื่อคุณพิมพ์ ":laughs!" หรือ "/me laughs!" ทุกคนในห้องแชทจะเห็น "คิ้ม หัวเราะ (Kim laughs)" เป็นต้น
**ส่งเสียง "บี๊ป"**
: You can send a sound to other people by hitting the "beep" link next to their name. A useful
shortcut to beep all the people in the chat at once is to type "beep all". จะส่งเป็นเสียงให้กับคนอื่นๆ ในห้องก็ได้ โดยการกดที่ลิงค์ "บี๊ป (Beep)" ซึ่งอยู่ถัดจากชื่อของคนอื่นๆ ทางลัดที่จะส่งเสียง "บี๊ป" ให้กับทุกคนในห้องแชทพร้อมๆ กันในครั้งเดียวคือการพิมพ์ "บี๊ปทุกคน (Beep All)"
**HTML**
: ถ้าพอรู้จักโค้ด HTML อยู่บ้าง ก็อาจใช้โค้ดในข้อความเพื่อแทรกรูปภาพ เล่นเสียง หรือ สร้างข้อความที่มีขนาดหรือสีแตกต่างกันไปก็ได้';
$string['viewreport'] = 'ดูการเสวนาครั้งที่ผ่านมา';
