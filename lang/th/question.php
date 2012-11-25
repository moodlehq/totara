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
 * Strings for component 'question', language 'th', branch 'MOODLE_22_STABLE'
 *
 * @package   question
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['adminreport'] = 'รายงานเกี่ยวกับปัญหาที่เป็นไปในฐานข้อมูลคำถามของคุณ';
$string['broken'] = 'นี่คือ "ลิ้งค์เสีย" ก็ชี้ไปยังแฟ้มที่ไม่มีอยู่';
$string['byandon'] = 'โดย <em>{$a->user}</em> บน <em>{$a->time}</em>';
$string['cannotdeletemissingqtype'] = 'ไม่สามารถลบประเภทของคำถามที่หายไปได้ เพราะยังมีการใช้งานอยู่ในระบบ';
$string['cannotdeleteqtypeinuse'] = 'ไม่สามารถลบประเภทของคำถาม \'{$a}\' นี้ได้เพราะยังมีคำถามอยู่ในคลังข้อสอบ';
$string['cannotdeleteqtypeneeded'] = 'ไม่สามารถลบประเภทของคำถาม \'{$a}\' นี้ได้ ยังมีการใช้งานคำถามประเภทอื่นที่ยังใช้งานเกี่ยวเนื่องกันอยู่';
$string['cannotread'] = 'ไม่สามารถอ่านไฟล์นำเข้า (หรือไฟล์ไม่มีเนื้อหาใด)';
$string['categorycurrent'] = 'หมวดหมู่ปัจจุบัน';
$string['categorycurrentuse'] = 'ใช้หมวดนี้';
$string['categorydoesnotexist'] = 'ประเภทนี้ไม่ได้อยู่';
$string['categorymove'] = 'ประเภท \'{$a->name}\' contains {$a->count} questions.  กรุณาเลือกประเภทอื่นที่ต้องการย้ายไป';
$string['categorymoveto'] = 'บันทึกในหมวดหมู่';
$string['changepublishstatuscat'] = '<a href="{$a->caturl}"> หมวดหมู่ "{$a->name}"</a> ในหลักสูตร "{$a->coursename}" จะมีสถานะใช้งานร่วมกันของการเปลี่ยนแปลงจาก <strong> {$a->changefrom} ถึง {$a->changeto} </strong>';
$string['copy'] = 'คัดลอกจาก {$a} และเปลี่ยนแปลงการเชื่อมโยง';
$string['created'] = 'ที่สร้างไว้';
$string['createdmodifiedheader'] = 'ที่สร้าง / บันทึกครั้งสุดท้าย';
$string['cwrqpfs'] = 'คำถามสุ่มเลือกคำถามจากหมวดหมู่ย่อย';
$string['cwrqpfsinfo'] = '<p> ในระหว่างการปรับ Moodle 1.9 เราจะแยกหมวดหมู่ของคำถามเป็น\nบริบทที่แตกต่างกัน บางประเภทคำถามและคำถามเกี่ยวกับเว็บไซต์ของคุณจะต้องมีการใช้ร่วมกันของพวกเขา\nเปลี่ยนสถานะ นี้เป็นสิ่งจำเป็นในกรณีที่หายากที่หนึ่งหรือมากกว่าหนึ่งคำถาม \'สุ่ม\' ในแบบทดสอบจะถูกตั้งขึ้นเพื่อเลือกจากส่วนผสมของ\nประเภทที่ใช้ร่วมกันและ unshared (เป็นกรณีที่เกี่ยวกับเว็บไซต์นี้) นี้เกิดขึ้นเมื่อคำถาม \'สุ่ม\' ถูกตั้งค่าให้เลือก\nจากหมวดหมู่ย่อยและหนึ่งหรือหลายหมวดหมู่ย่อยมีสถานะที่แตกต่างกันร่วมกันกับประเภทของผู้ปกครองในการที่\nคำถามแบบสุ่มจะถูกสร้างขึ้น. </p>\n<p> ประเภทคำถามต่อไปนี้จากที่คำถาม \'สุ่ม\' ในประเภทผู้ปกครองเลือกคำถามจาก,\nจะมีสถานะใช้งานร่วมกันของพวกเขาเปลี่ยนไปเป็นสถานะที่ใช้ร่วมกันเช่นเดียวกับประเภทที่มีคำถาม \'สุ่ม\' ใน\nในการอัพเกรดไป Moodle 1.9ประเภทต่อไปนี้จะมีสถานะใช้งานร่วมกันของพวกเขาเปลี่ยนไป คำถามที่มี\nได้รับผลกระทบจะยังคงทำงานในแบบทดสอบที่มีอยู่ทั้งหมดจนกว่าคุณจะลบออกจากแบบทดสอบเหล่านี้. </p>';
$string['cwrqpfsnoprob'] = 'ไม่มีหมวดหมู่ของคำถามในไซต์ของคุณได้รับผลจาก \'คำถามสุ่มเลือกคำถามจากหมวดหมู่ย่อย\' ปัญหา';
$string['defaultfor'] = 'เริ่มต้นสำหรับ {$a}';
$string['defaultinfofor'] = 'หมวดหมู่เริ่มต้นสำหรับคำถามที่ใช้ร่วมกันในบริบท \'{$a}\'';
$string['deletecoursecategorywithquestions'] = 'มีคำถามในธนาคารคำถามที่เกี่ยวข้องกับประเภทของวิชานี้อยู่ ถ้าคุณดำเนินการที่พวกเขาจะถูกลบออก คุณอาจต้องการย้ายไปก่อนโดยใช้อินเตอร์เฟซที่ธนาคารคำถาม';
$string['deleteqtypeareyousure'] = 'แน่ในนะคะว่าต้องการลบคำถามประเภท  \'{$a}\' ?';
$string['deleteqtypeareyousuremessage'] = 'คุณกำลังจะลบคำถามประเภท  \'{$a}\' ออกจากระบบ แน่ใจนะคะว่าต้องการลบ ?';
$string['deletingqtype'] = 'กำลังลบประเภทคำถาม \'{$a}\'';
$string['donothing'] = 'อย่าคัดลอกหรือย้ายแฟ้มหรือการเชื่อมโยงการเปลี่ยนแปลง';
$string['editingcategory'] = 'การแก้ไขหมวดหมู่';
$string['editingquestion'] = 'แก้ไขคำถาม';
$string['editthiscategory'] = 'แก้ไขหมวดหมู่นี้';
$string['erroraccessingcontext'] = 'ไม่สามารถเข้าถึงบริบท';
$string['errordeletingquestionsfromcategory'] = 'ข้อผิดพลาดในการลบคำถามจากหมวดหมู่ {$a}';
$string['errorfilecannotbecopied'] = 'ข้อผิดพลาดไม่สามารถคัดลอกไฟล์ {$a}';
$string['errorfilecannotbemoved'] = 'ข้อผิดพลาดไม่สามารถย้ายไฟล์ {$a}';
$string['errorfileschanged'] = 'ไฟล์ที่เชื่อมโยงกับข้อผิดพลาดจากคำถามที่มีการเปลี่ยนแปลงตั้งแต่รูปแบบที่ถูกแสดงขึ้นมา';
$string['errormanualgradeoutofrange'] = 'เกรด {$a->grade} ไม่ได้อยู่ระหว่าง 0 กับ {$a->maxgrade} สำหรับคำถาม {$a->name}. คะแนนและข้อเสนอแนะยังไม่ได้รับการเซฟเก็บไว้';
$string['errormovingquestions'] = 'ข้อผิดพลาดขณะย้ายคำถามที่มี เลขหมาย {$a}';
$string['errorprocessingresponses'] = 'เกิดข้อผิดพลาดระหว่างการประมวลผลการตอบสนองของคุณ';
$string['errorsavingcomment'] = 'เกิดความผิดพลาดในการเก็บข้อเสนอแนะของคำถาม {$a->name} ในฐานข้อมูล';
$string['errorupdatingattempt'] = 'ข้อผิดพลาดพยายามปรับปรุง {$a->id} ในฐานข้อมูล';
$string['exportcategory'] = 'หมวดหมู่การส่งออก';
$string['exportfilename'] = 'แบบทดสอบ';
$string['exportnameformat'] = '%Y%m%d-%H%M';
$string['filecantmovefrom'] = 'ไฟล์คำถามที่ไม่สามารถย้ายเพราะคุณไม่ได้รับสิทธิ์ในการลบไฟล์จากสถานที่ที่คุณกำลังพยายามที่จะย้ายคำถามจาก';
$string['filecantmoveto'] = 'ไฟล์คำถามที่ไม่สามารถย้ายหรือคัดลอก becuase คุณไม่ได้รับอนุญาตให้เพิ่มไฟล์ไปยังสถานที่ที่คุณกำลังพยายามที่จะย้ายคำถามไปที่';
$string['filesareacourse'] = 'แน่นอนพื้นที่ไฟล์';
$string['filesareasite'] = 'เว็บไซต์พื้นที่ไฟล์';
$string['filestomove'] = 'ย้าย / คัดลอกไฟล์ไป {$a}?';
$string['fractionsnomax'] = 'หนึ่งในคำตอบที่ควรจะมีคะแนนจาก 100%% ดังนั้นจึงเป็นไปได้ที่จะได้รับคะแนนเต็มสำหรับคำถามนี้';
$string['getcategoryfromfile'] = 'หมวดหมู่รับจากแฟ้ม';
$string['getcontextfromfile'] = 'รับบริบทจากแฟ้ม';
$string['ignorebroken'] = 'ละเว้นการเชื่อมโยงเสีย';
$string['invalidcontextinhasanyquestions'] = 'บริบทที่ไม่ถูกต้องส่งผ่านไปยัง question_context_has_any_questions';
$string['linkedfiledoesntexist'] = 'แฟ้มที่เชื่อมโยง {$a} ไม่อยู่';
$string['makechildof'] = 'ทำให้ครอบครัวที่มีเด็กจาก \'{$a}\'';
$string['maketoplevelitem'] = 'ย้ายไปที่ระดับบนสุด';
$string['missingimportantcode'] = 'ประเภทของคำถามนี้จะหายไปรหัสที่สำคัญ: {$a}';
$string['modified'] = 'ที่บันทึกไว้ครั้งสุดท้าย';
$string['move'] = 'ย้ายจาก {$a} และเปลี่ยนแปลงการเชื่อมโยง';
$string['movecategory'] = 'ย้ายหมวดหมู่';
$string['movedquestionsandcategories'] = 'คำถามเคลื่อนย้ายและหมวดหมู่ของคำถามจาก {$a->oldplace} to {$a->newplace}.';
$string['movelinksonly'] = 'เพียงแค่เปลี่ยนที่ลิงก์ชี้ไปยังไม่ได้ย้ายหรือคัดลอกไฟล์';
$string['moveq'] = 'คำถามย้าย (s)';
$string['moveqtoanothercontext'] = 'ย้ายคำถามไปยังบริบทอื่น';
$string['movingcategory'] = 'การย้ายหมวดหมู่';
$string['movingcategoryandfiles'] = 'คุณแน่ใจหรือว่าต้องการย้ายหมวดหมู่ {$a->name} และทุกประเภทเด็กกับบริบทสำหรับ "{$a->contextto}"? <br /> เราได้ตรวจพบ {$a->urlcount} แฟ้มที่เชื่อมโยงจากคำถาม ใน {$a->fromareaname}, คุณต้องการจะคัดลอกหรือย้ายเหล่านี้ไปยัง {$a->toareaname}?';
$string['movingcategorynofiles'] = 'คุณแน่ใจหรือว่าต้องการย้ายหมวดหมู่ "{$a->name}" และทุกประเภทเด็กกับบริบทสำหรับ "{$a->contextto}"?';
$string['movingquestions'] = 'การย้ายคำถามและไฟล์ใด ๆ';
$string['movingquestionsandfiles'] = 'คุณแน่ใจหรือว่าต้องการจะย้ายคำถาม {$a->questions}คำถามกับบริบทสำหรับ <strong>"{$a->tocontext}"</strong>?<br /> เราได้ตรวจพบ <strong>{$a->urlcount} files</strong> ที่เชื่อมโยงจากคำถามเหล่านี้ใน {$a->fromareaname}, คุณต้องการจะคัดลอกหรือย้ายเหล่านี้ไปยัง {$a->toareaname}?';
$string['movingquestionsnofiles'] = 'คุณแน่ใจหรือว่าต้องการจะย้ายคำถาม {$a->questions}คำถามกับบริบทสำหรับ <strong>"{$a->tocontext}"</strong>?<br /> มี <strong>no files</strong> ที่เชื่อมโยงจากคำถามเหล่านี้ใน {$a->fromareaname}';
$string['needtochoosecat'] = 'คุณต้องเลือกประเภทที่จะย้ายคำถามนี้ไปหรือกด \'ยกเลิก\'';
$string['nopermissionadd'] = 'คุณไม่ได้รับสิทธิ์ในการเพิ่มคำถามที่นี่';
$string['nopermissionmove'] = 'คุณไม่ได้รับอนุญาตให้ย้ายคำถามจากที่นี่ คุณต้องบันทึกคำถามในประเภทนี้หรือบันทึกเป็นคำถามใหม่';
$string['noprobs'] = 'ไม่พบปัญหาในฐานข้อมูลคำถามของคุณ';
$string['noquestionsinfile'] = 'ไม่มีคำถามในไฟล์ที่นำเข้า';
$string['notenoughdatatoeditaquestion'] = 'ทั้ง id คำถามหรือ ID ประเภทและชนิดของคำถามที่ถูกระบุไว้';
$string['notenoughdatatomovequestions'] = 'คุณจำเป็นต้องให้รหัสคำถามจากคำถามที่คุณต้องการย้าย';
$string['numquestions'] = 'จำนวนคำถาม';
$string['numquestionsandhidden'] = '{$a->numquestions} (+{$a->numhidden} ซ่อนอยู่)';
$string['penaltyfactor'] = 'องค์ประกอบสำหรับการหักคะแนน';
$string['permissionedit'] = 'แก้ไขคำถามนี้';
$string['permissionmove'] = 'ย้ายคำถามนี้';
$string['permissionsaveasnew'] = 'บันทึกนี้เป็นคำถามใหม่';
$string['permissionto'] = 'คุณมีสิทธิ์ในการ:';
$string['published'] = 'ที่ใช้ร่วมกัน';
$string['qtypedeletefiles'] = 'ข้อมูลทั้งหมดที่เกี่ยวข้องกับประเภทคำถาม  \'{$a->qtype}\'  ได้ถูกลบจากฐานข้อมูลแล้ว เพื่อป้องกันไม่ให้คำถามประเภทนี้ติดตั้งตัวเองขึ้นใหม่ในระบบควรทำการลบไดเรกทอรีต่อไปนี้จากเซิร์ฟเวอร์ {$a->directory}';
$string['questionaffected'] = '<a href="{$a->qurl}">ตำถาม "{$a->name}" ({$a->qtype})</a> ที่อยู่ในหมวดคำถามนี้และถูกใช้ใน<a href="{$a->qurl}">quiz "{$a->quizname}"</a> ในหลักสูตรอื่น "{$a->coursename}".';
$string['questionbank'] = 'ธนาคารคำถาม';
$string['questioncategory'] = 'หมวดหมู่คำถาม';
$string['questioncatsfor'] = 'หมวดหมู่คำถามสำหรับ \'{$a}\'';
$string['questiondoesnotexist'] = 'คำถามนี้ไม่ได้อยู่';
$string['questionsmovedto'] = 'คำถามที่ยังใช้งานได้ย้ายไป "{$a}" ในหมวดหมู่นี้แน่นอนผู้ปกครอง';
$string['questionsrescuedfrom'] = 'คำถามที่บันทึกไว้จากบริบท {$a}';
$string['questionsrescuedfrominfo'] = 'คำถามเหล่านี้ (บางที่อาจถูกซ่อน) ถูกบันทึกไว้เมื่อบริบท {$a} ถูกลบเพราะพวกเขาจะยังคงใช้โดยบางส่วนแบบทดสอบหรือกิจกรรมอื่น ๆ';
$string['questionuse'] = 'ใช้คำถามในกิจกรรมนี้';
$string['selectcategoryabove'] = 'เลือกประเภทข้างบน';
$string['shareincontext'] = 'ร่วมกันในบริบทสำหรับ {$a}';
$string['tofilecategory'] = 'เขียนหมวดหมู่ไฟล์';
$string['tofilecontext'] = 'เขียนบริบทที่จะยื่น';
$string['uninstallqtype'] = 'นำคำประเภทคำถามนี้ออกจากระบบ';
$string['unknown'] = 'ไม่ทราบ';
$string['unknownquestiontype'] = 'ประเภทของคำถามที่ไม่รู้จัก: {$a}';
$string['unpublished'] = 'ที่ใช้ร่วมกันยกเลิก';
$string['upgradeproblemcategoryloop'] = 'ปัญหาที่ตรวจพบเมื่ออัพเกรดประเภทคำถาม มีวงในต้นไม้ประเภทคือรหัสหมวดหมู่ได้รับผลกระทบเป็น {$a}';
$string['upgradeproblemcouldnotupdatecategory'] = 'ไม่สามารถปรับปรุงหมวดหมู่คำถาม {$a->name} ({$a->id})';
$string['upgradeproblemunknowncategory'] = 'เจอปัญหาเมื่อปรับปรุงหมวดคำถาม Category {$a->id} refers to parent {$a->parent}, ซึ่งไม่มีอยู่ จำเป็นต้องเปลี่ยน Parent เพื่อแก้ไขปัญหา';
$string['yourfileshoulddownload'] = 'แฟ้มส่งออกของคุณควรเริ่มต้นการดาวน์โหลดเร็ว ถ้าไม่โปรด <a href="{$a}">คลิกที่นี่</a> ผู้ปกครองมีการเปลี่ยนแปลงเพื่อแก้ไขปัญหาที่เกิดขึ้น';
