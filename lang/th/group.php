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
 * Strings for component 'group', language 'th', branch 'MOODLE_22_STABLE'
 *
 * @package   group
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['groupmode_help'] = '<p>สามารถแบ่งกลุ่มออกเป็นสามแบบ :
   <ul>
      <li>No groups ไม่มีการแบ่งกลุ่ม - ทุกคนอยู่รวมกันในกลุ่มใหญ่กลุ่มเดียว</li>
      <li>Separate groups แยกกลุ่มกัน - คนในกลุ่มจะสามารถมองเห็นกันเอง แต่จะไม่เห็นคนที่อยู่ในกลุ่มอื่น</li>
      <li>Visible groups กลุ่มที่มองเห็น - คนแต่ละกลุ่มทำงานอยู่ในกลุ่มของตัวเอง แต่สามารถมองเห็นคนกลุ่มอื่น ๆได้</li>
   </ul>
</p>

<p>การแบ่งกลุ่มกำหนดได้สองระดับ</p>

<dl>
   <dt><b>1. Course level ระดับรายวิชา</b></dt>
   <dd>การแบ่งระดับรายวิชาเป็นค่าตั้งต้นของกิจกรรมทั้งหมดในรายวิชานั้น<br /><br /></dd>
   <dt><b>2. Activity level ระดับกิจกรรม</b></dt>
   <dd>ในแต่ละกิจกรรมที่สนับสนุนกลุ่ม สามารถกำหนดการแบ่งกลุ่มเองได้ ถ้ารายวิชาตั้งค่าไว้ " <a href="help.php?module=moodle&file=groupmodeforce.html">force group mode</a>" 
	   การกำหนดค่าสำหรับแต่ละกิจกรรมจะไม่ทำงาน</dd>
</dl>

<p>';
$string['importgroups'] = 'นำเข้ากลุ่ม';
$string['newpicture_help'] = '<P ALIGN=CENTER><B>การอัพโหลดรูป</B></P>

<P>คุณสามารถอัพโหลดรูปภาพจากคอมพิวเตอร์ขึ้นบนเซิร์ฟเวอร์ เพื่อใช้แสดงตัวคุณเอง 
<P>ภาพนี้ควรจะเป็นภาพที่เห็นหน้าคุณชัดๆ และควรมีนามสกุล เช่น .png .jpg  คุณอาจ
จะหารูปมาใช้ ได้ด้วยวิธีการดังต่อไปนี้

<OL>
<LI>ใช้กล้องถ่ายรูปดิจิตอล
<LI>สแกนภาพจากรูปที่มีอยู่แล้ว 
<LI>วาดภาพจากโปรแกรมเพนท์ 
<LI>ท้ายสุด อาจจะใช้ภาพจากเว็บ แต่ไม่แนะนำค่ะ เอารูปคุณดีกว่า 
</OL>

<P>ในการอัพโหลดภาพ คลิกที่คำว่า  Browse  จากนั้นเลือกภาพ จากฮาร์ดดิสก์ของคุณ 
<P>หมายเหตุ:  ตรวจสอบให้แน่ใจว่าไฟล์ที่อัพโหลดนั้นมีขนาดน้อยกว่า ขนาดที่จำกัดไว้ 
<P>จากนั้นคลิกที่ ปุ่ม "อัพเดทประวัติ" ภาพดังกล่าวจะถูกลดขนาดให้เหลือ 100x100 pixels.
<P>หากคุณคลิกดูใน หน้าประวัติของตัวเอง แล้วรูปยังไม่เปลี่ยนให้กด Reload /Refresh';
