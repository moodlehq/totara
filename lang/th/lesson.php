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
 * Strings for component 'lesson', language 'th', branch 'MOODLE_22_STABLE'
 *
 * @package   lesson
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['accesscontrol'] = 'ควบคุมการเข้าใข้';
$string['actionaftercorrectanswer'] = 'เมื่อตอบคำถามถูกให้';
$string['actionaftercorrectanswer_help'] = '<p>The usual action is to follow the jump as specified in the answer. In most cases
    this will probably show the Next Page of the lesson. The student is taken through 
    the lesson in a logical way, beginning at the start and ending at the end.</p>
    
<p>However, the lesson module can also be used as a type of <i>Flash Card</i> assignment.
    The student is shown some information (optional) and a question in basically a random 
    order. There is no set beginning and no set end. Just a set of <i>Cards</i> shown one after
    another in no particular order.</p>
    
<p>This option allows two very similar variants of Flash Card behaviour. The 
    option "Show an unseen page" never shows the same page twice (even if the student
    did <b>not</b> answer the question associated with the Card/Page correctly). The other 
    non-default option "Show an unanswered page" allows the student to see pages that 
    may have appeared before but only if they answered the associated question wrongly.</p>

<p>In either of these Flash Card-type lessons the teacher can decide to use either all the
    Cards/Pages in the lesson or just a (random) sub-set. This is done through the &quot;Number
    of Pages (Cards) to show&quot; parameter.</p>';
$string['activitylink'] = 'ลิงก์ไปยังกิจกรรม';
$string['activitylinkname'] = 'ไปยัง  {$a}';
$string['addabranchtable'] = 'เพิ่มสารบาญ';
$string['addanendofbranch'] = 'เพิ่มหน้าจบหัวข้อ';
$string['addaquestionpage'] = 'เพิ่มหน้าคำถาม';
$string['addcluster'] = 'เพิ่มบทใหม่';
$string['addedabranchtable'] = 'เพิ่มสารบาญแล้ว';
$string['addedanendofbranch'] = 'เพิ่มหน้าจบหัวข้อแล้ว';
$string['addedaquestionpage'] = 'เพิ่มหน้าคำถามแล้ว';
$string['addedcluster'] = 'เพิ่มบทใหม่แล้ว';
$string['addedendofcluster'] = 'เพิ่มหน้าจบบทแล้ว';
$string['addendofcluster'] = 'เพิ่มหน้าจบของบท';
$string['anchortitle'] = 'เริ่มเนื้อหาหลัก';
$string['and'] = 'และ';
$string['answer'] = 'ตัวเลือกที่';
$string['answeredcorrectly'] = 'ตอบได้ถูกต้อง';
$string['answersfornumerical'] = 'คำตอบที่เป็นตัวเลขควรอยู่ระหว่างค่าต่ำสุดและค่าสูงสุด';
$string['arrangebuttonshorizontally'] = 'จัดปุ่มสาขาให้อยู่ในแนวนอนเมื่ออยู่ในโหมดแสดงสไลด์';
$string['attempt'] = 'ครั้งที่ : {$a}';
$string['attempts'] = 'ครั้ง';
$string['attemptsremaining'] = 'คุณยังสามารถทำได้อีก  {$a} ครั้ง';
$string['available'] = 'เริ่มตั้งแต่';
$string['averagescore'] = 'คะแนนเฉลี่ย';
$string['averagetime'] = 'เวลาเฉลี่ย';
$string['branchtable'] = 'สารบาญ';
$string['cancel'] = 'ยกเลิก';
$string['canretake'] = '{$a} สามารถเรียนซ้ำ';
$string['casesensitive'] = 'ตัวพิมพ์ใหญ่และตัวพิมพ์เล็กถือว่าเป็นคนละตัว';
$string['casesensitive_help'] = '<p>A few of the Question Types have an option which is activated by clicking on
    the checkbox. The question types and the meaning of the options are 
    detailed below.

<ol>
<li><p><b>Multichoice</b> There is variant of Multichoice questions called 
    <b>&quot;Multichoice Multianswer&quot;</b> questions. If the Question 
    Option is selected then the student is required to select all the 
    correct answers from the set of answers. The question may or may not tell 
    the student <i>how many</i> correct answers there are. For example &quot;Which of the 
    following were US Presidents?&quot; does not, while "Select the two US 
    presidents from the following list." does. The actual number of correct 
    answers can be from <b>one</b> up to the number of choices. (A Multichoice 
    Multianswer question with one correct answer <b>is</b> different from a 
    Multichoice question as the former allows the student the possibility of 
    choosing more than one answer while the latter does not.)</p></li>

<li><p><b>Short Answer</b> By default the comparisons ignore the case of the 
    text. If the Question Option is selected then the comparisons are case 
    sensitive.</p></li>

<p>The other Question Types does not use the Question Option.</p>';
$string['checkbranchtable'] = 'ตรวจสอบสารบาญ';
$string['checkedthisone'] = 'ตรวจสอบหน้านี้';
$string['checknavigation'] = 'ตรวจสอบลิงก์';
$string['checkquestion'] = 'ตรวจสอบคำถาม';
$string['classstats'] = 'สถิติ';
$string['clicktopost'] = 'คลิกที่นี่เพื่อกรอกคะแนนของคุณลงในรายการคะแนนสูงสุด';
$string['clusterjump'] = 'คำถามที่ไม่ได้แสดงในบท';
$string['clustertitle'] = 'บท';
$string['collapsed'] = 'พับไว้';
$string['comments'] = 'ความคิดเห็น';
$string['completed'] = 'เสร็จสิ้น';
$string['completederror'] = 'จบบทเรียน';
$string['completethefollowingconditions'] = 'คุณต้องทำตามเงื่อนไขต่อไปนี้ในบทเรียน <b>{$a}</b> ก่อนที่จะไปต่อได้';
$string['conditionsfordependency'] = 'เงื่อนไข';
$string['confirmdeletionofthispage'] = 'ยืนยันการลบหน้านี้';
$string['congratulations'] = 'ยินดีด้วยค่ะ  คุณศึกษาจนจบบทเรียนแล้ว';
$string['continue'] = 'ต่อไป';
$string['continuetoanswer'] = 'ต่อไปเพื่อเปลี่ยนคำตอบ';
$string['correctanswerjump'] = 'ข้ามคำตอบถูก';
$string['correctanswerscore'] = 'คะแนนที่ได้';
$string['correctresponse'] = 'คำตอบที่ถูก';
$string['customscoring'] = 'ปรับเปลี่ยนการให้คะแนน';
$string['customscoring_help'] = 'Under Construction';
$string['deadline'] = 'หมดเขต';
$string['defaultessayresponse'] = 'อาจารย์จะเป็นผู้ตรวจความเรียงของคุณ';
$string['deletedefaults'] = 'ลบ  {$a}  บทเรียนที่ตั้งไว้';
$string['deletedpage'] = 'หน้าที่ลบแล้ว';
$string['deleting'] = 'กำลังลบ';
$string['deletingpage'] = 'ลบหน้า {$a}';
$string['dependencyon'] = 'ขึ้นอยู่กับ';
$string['description'] = 'คำอธิบาย';
$string['detailedstats'] = 'สถิติ';
$string['didnotanswerquestion'] = 'ยังไม่ได้ตอบคำถามนี้';
$string['didnotreceivecredit'] = 'ไม่ได้เครดิต';
$string['displayhighscores'] = 'แสดงคะแนนสูงสุด';
$string['displayinleftmenu'] = 'แสดงในเมนูซ้ายหรือไม่';
$string['displayleftif'] = 'และแสดงเฉพาะกรณีที่  {$a} ได้คะแนนมากกว่า';
$string['displayleftmenu'] = 'แสดงเมนูซ้าย';
$string['displayleftmenu_help'] = 'Under Construction';
$string['displayofgrade'] = 'แสดงคะแนน (สำหรับนักเรียน)';
$string['displayreview'] = 'แสดงปุ่มแสดงความเห็น';
$string['displayreview_help'] = 'Under Construction';
$string['displayscorewithessays'] = 'คะแนนที่ได้ {$a->score} จาก {$a->tempmaxgrade} สำหรับคำถามที่ให้คะแนนอัตโนมัติ<br>{$a->essayquestions} ซึ่งเป็นความเรียงจะมีการตรวจและให้คะแนนในภายหลัง<br>ระบบจะนำคะแนนดังกล่าวมารวมกับคะแนนปัจจุบันต่อไป<br><br>คะแนนที่ได้ตอนนี้ไม่รวมคำถามที่เป็นความเรียงคือ {$a->score} จากทั้งหมด {$a->grade}';
$string['displayscorewithoutessays'] = 'คะแนนที่ได้ {$a->score} (จากคะแนนเต็ม {$a->grade}).';
$string['editlessonsettings'] = 'แก้ไขการตั้งค่าบทเรียนสำเร็จรูปนี้';
$string['editpagecontent'] = 'แก้ไขเนื้อหาหน้านี้';
$string['email'] = 'อีเมล';
$string['emailallgradedessays'] = 'อีเมลทุกคน <br>ให้คะแนนความเรียง';
$string['emailgradedessays'] = 'อีเมลคะแนนที่ได้จากความเรียง';
$string['emailsuccess'] = 'อีเมลเรียบร้อยแล้ว';
$string['endofbranch'] = 'จบหัวข้อ';
$string['endofclustertitle'] = 'จบบท';
$string['endoflesson'] = 'จบบทเรียนสำเร็จรูป';
$string['enteredthis'] = 'ใส่ตรงนี้';
$string['entername'] = 'ใส่ชื่อเล่นสำหรับรายการคะแนนสูงสุด';
$string['enterpassword'] = 'กรุณาใส่รหัสผ่าน';
$string['eolstudentoutoftime'] = 'คำเตือน  เวลาในการทำบทเรียนสำเร็จรูปใกล้จะหมดแล้วคำตอบที่ทำหลังจากเวลานี้จะไม่มีคะแนนให้ค่ะ';
$string['eolstudentoutoftimenoanswers'] = 'คุณยังไม่ได้ตอบคำถามได้คะแนน 0 สำหรับบทเรียนสำเร็จรูปนี้';
$string['essay'] = 'ความเรียง';
$string['essayemailsubject'] = 'คะแนนสำหรับ {$a} คำถาม';
$string['essays'] = 'ความเรียง';
$string['essayscore'] = 'คะแนนความเรียง';
$string['fileformat'] = 'รูปแบบของไฟล์';
$string['firstanswershould'] = 'คำตอบแรกให้นำไปยังหน้าที่ตอบถูก';
$string['firstwrong'] = 'คุณไม่ได้คะแนนสำหรับข้อนี้เพราะตอบคำถามไม่ถูกต้อง คุณต้องการที่จะเดาคำตอบไปเรื่อย ๆ เพื่อความสนุกสนานหรือไม่ (แต่ไม่ได้คะแนนนะคะ)';
$string['flowcontrol'] = 'ควบคุมการใช้งานบทเรียนสำเร็จรูป';
$string['full'] = 'ขยาย';
$string['general'] = 'ทั่วไป';
$string['grade'] = 'คะแนน';
$string['gradebetterthan'] = 'คะแนนดีกว่า(%)';
$string['gradebetterthanerror'] = 'ได้คะแนนดีกว่า {$a} เปอร์เซ็นต์';
$string['gradeessay'] = 'ให้คะแนนคำถามความเรียง';
$string['gradeis'] = 'คะแนนที่ได้คือ {$a}';
$string['gradeoptions'] = 'ตัวเลือกการให้คะแนน';
$string['handlingofretakes'] = 'การคิดคะแนนการเรียนซ้ำ';
$string['handlingofretakes_help'] = '<p>When students are allowed to re-take the lesson, this option allows the 
    teacher to show the grade for the lesson in, for example, the Grades page,
    as either the <b>mean</b>, this is average, of the grades over the first 
    and subsequent tries or as the grade from the students\' <b>best</b> tries.</p>

<p>This option can be changed at any time.</p>';
$string['havenotgradedyet'] = 'ยังไม่ได้ให้คะแนน';
$string['here'] = 'ตรงนี้';
$string['highscore'] = 'คะแนนสูงสุด';
$string['highscores'] = 'คะแนนสูงสุด';
$string['hightime'] = 'ใช้เวลามากที่สุด';
$string['importcount'] = 'นำเข้า  {$a} คำถาม';
$string['importppt'] = 'นำเข้าพาวเวอร์พ้อยท์';
$string['importquestions'] = 'นำเข้าคำถาม';
$string['importquestions_help'] = '<p>This function allows you to import questions from 
   external text files, uploaded through a form.  

<p>A number of file formats are supported:

<p><b>GIFT format</b></p>
<ul>
<p>GIFT is the most comprehensive import format available for importing 
   Moodle quiz questions from a text file.  It was designed to be an easy 
   method for teachers writing questions as a text file. It supports Multiple-Choice, 
   True-False, Short Answer, Matching and Numerical questions, as well as insertion 
   of a _____ for the "missing word" format.  Various question-types can be 
   mixed in a single text file, and the format also supports line comments, question names, 
   feedback and percentage-weight grades.  Below are some examples:</p>
<pre>
Who\'s buried in Grant\'s tomb?{~Grant ~Jefferson =no one}

Grant is {~buried =entombed ~living} in Grant\'s tomb.

Grant is buried in Grant\'s tomb.{FALSE}

Who\'s buried in Grant\'s tomb?{=no one =nobody}

When was Ulysses S. Grant born?{#1822}
</pre>

<p align="right"><a href="help.php?file=formatgift.html&module=quiz">More info about the "GIFT" format</a></p>
</ul>

<p><b>Aiken format</b></p>
<ul>
<p>The Aiken format is a very simple way of creating multiple choice questions using a very clear human-readable format. Here is an example of the format:</p>
<pre>
What is the purpose of first aid?
A. To save life, prevent further injury, preserve good health
B. To provide medical treatment to any injured or wounded person
C. To prevent further injury
D. To aid victims who may be seeking help
ANSWER: A
</pre>

<p align="right"><a href="help.php?file=formataiken.html&module=quiz">More info about the "Aiken" format</a></p>
</ul>


<p><b>Missing Word</b></p>
<ul>
<p>This format only supports multiple choice questions.
Each answer is separated with a tilde (~), and the correct answer is 
prefixed with an equals sign (=).  Here is an example:

<blockquote>As soon as we begin to explore our body parts as infants
we become students of {=anatomy and physiology ~reflexology 
~science ~experiment}, and in a sense we remain students for life.
</blockquote>

<p align="right"><a href="help.php?file=formatmissingword.html&module=quiz">More info about the "Missing Word" format</a></p>
</ul>


<p><b>AON</b></p>
<ul>
<p>This is the same as Missing Word Format, except that after importing 
   the questions all Short-Answer questions are converted four at a time
   into Matching Questions.</p>
<p>Additionally, the answers of multiple-choice questions are randomly 
   shuffled during the import.
<p>It\'s named after an organisation that sponsored the development of many 
   quiz features</p>
</ul>


<p><b>Blackboard</b></p>
<ul>
<p>This module can import questions saved in Blackboard\'s export 
format.  It relies on XML functions being compiled into your PHP.</p>

<p align="right"><a href="help.php?file=formatblackboard.html&module=quiz">More info about the "Blackboard" format</a></p>
</ul>

<p><b>Course Test Manager</b></p>
<ul>
<p>This module can import questions saved in a Course Test Manager test bank.
It relies on different ways of accessing the test bank, which is in a Microsoft Access 
database, depending on whether Moodle is running on a Windows or Linux web server.</p>
<p>On Windows it lets you upload the access database just like any other data import file.</p>
<p>On Linux, you must set up a windows machine on the same network with the Course Test
Manager database and a piece of software called the ODBC Socket Server, which uses XML
to transfer data to moodle on the Linux server.</p>  <p>Please read the full help file below before
using this import class.</p>


<p align="right"><a href="help.php?file=formatctm.html&module=quiz">More info about the "CTM" format</a></p>
</ul>

<p><b>Custom</b></p>
<ul>
<p>If you have your own format that you need to import, you can 
   implement it yourself by editing mod/quiz/format/custom.php

<p>The amount of new code needed is quite small - just enough
   to parse a single question from given text.

<p align="right"><a href="help.php?file=formatcustom.html&module=quiz">More info about the "Custom" format</a></p>
</ul>


<p>More formats are yet to come, including WebCT, IMS QTI and whatever else
   Moodle users can contribute! </p>';
$string['insertedpage'] = 'หน้าที่แทรกเข้าไป';
$string['jump'] = 'ไป';
$string['jumps_help'] = '<p>Each answer has a Jump-to link. When this answer is chosen, the answer\'s response 
    is shown to the student. Atfer that the student sees the page given in the Jump-to 
    link. This link can be either relative or absolute. Relative links are <b>This 
    page</b> and <b>Next page</b>. <b>This page</b> means that the student sees the 
    current page again. <b>Next page</b> shows the page which follows this page in the
    logical order of pages. An absolute page link is specified by choosing the page\'s 
    <b>title</b>.</p>
<p>Note that a (relative) <b>Next page</b> Jump-to link may show a different page 
    after pages have been moved. Whereas Jump-to links which use page <b>titles</b>
    always show the same page after pages have been moved.</p>';
$string['leftduringtimed'] = 'คุณออกจากการทำบทเรียนสำเร็จรูปก่อนเวลาจะหมด กรุณาคลิกที่ "ต่อไป" เพื่อทำบทเรียนสำเร็จรูปนี้ใหม่';
$string['leftduringtimednoretake'] = 'คุณออกจากการทำบทเรียนสำเร็จรูปนี้แล้วและไม่ได้รับอนุญาตให้ทำบทเรียนสำเร็จรูปใหม่หรือทำบทเรียนสำเร็จรูปนี้ต่อไป';
$string['lessonclosed'] = 'หมดเวลาทำบทเรียนสำเร็จรูปใน {$a}';
$string['lessoncloses'] = 'ปิดการทำบทเรียนสำเร็จรูป';
$string['lessonformating'] = 'รูปแบบบทเรียนสำเร็จรูป';
$string['lessonmenu'] = 'เมนูบทเรียน';
$string['lessonnotready'] = 'ยังไม่สามารถทำบทเรียนนี้ได้ กรุณาติดต่อ {$a}';
$string['lessonopen'] = 'เปิดให้ทำบทเรียนใน {$a}';
$string['lessonopens'] = 'เปิดให้ทำบทเรียน';
$string['lessonpagelinkingbroken'] = 'ไม่พบหน้าแรกบทเรียนนี้ มีข้อผิดพลาดในการลิงก์กรุณาติดต่อผู้ดูแลระบบ';
$string['lessonstats'] = 'สถิติ';
$string['loginfail'] = 'เข้าสู่ระบบไม่ได้ กรุณาลองใหม่อีกครั้งค่ะ';
$string['lowscore'] = 'คะแนนต่ำสุด';
$string['lowtime'] = 'ใช้เวลาน้อยสุด';
$string['manualgrading'] = 'ให้คะแนนความเรียง';
$string['matchesanswer'] = 'จับคู่คำตอบ';
$string['maxgrade_help'] = '<p>This value determines the maximum grade which can be awarded in the lesson.	
    The range is 0 to 100%. This value can be changed at any time during the 
    lesson. Any change has an immediate effect in the Grades page and on the 
    grades shown to the students in various lists. If the grade is set to 0 
    the Lesson does not appear in any of the Grades pages.</p>';
$string['maxhighscores'] = 'จำนวนคะแนนสูงสุดที่ต้องการแสดง';
$string['maximumnumberofanswersbranches'] = 'จำนวนคำตอบ/ทางเลือกสูงสุด';
$string['maximumnumberofanswersbranches_help'] = '<p>This value determines the maximum number of answers the teacher can use.
    The default value is 4. If the lesson uses only, say, TRUE or FALSE
    questions throughout then it is sensible to set this value to 2.</p>
    
<p>This parameter also sets the maximum number of Branches that can be used in 
    a Branch Table.</p>
    
<p>It is safe to change the value of this parameter in a lesson with existing
    content. In fact if you want to add a question with many choices or a long
    Branch table changing this parameter will be necessary. After the (unusual)
    question or BranchTable has been added this parameter can be reduced to a 
    more &quot;standard&quot; value.</p>';
$string['maximumnumberofattempts'] = 'จำนวนครั้งที่ตอบสูงสุด';
$string['maximumnumberofattempts_help'] = '<p>This value determines the maximum number of attempts a Student has
    in aswering <b>any</b> of the questions in the lesson. In the case of questions
    which do not provide the answer, for example Short Answer
    and Numerical questions, this value provides a necessary <i>escape routine</i> to
    the next page in the lesson. </p>

<p>The default value is 5. Smaller values may discourage the student
    from thinking about the questions. Larger values may lead to more
    frustration.</p>

<p>Setting this value to one gives the students just one chance to answer each
    question. This gives a similar type of assignment to the Quiz module except
    that the questions are presented on individual pages.</p>

<p>Note that this value is global parameter and that it applies to all the
    questions in the lesson regardless of their type.</p>
    
<p>Note that this parameter does <b>not</b> apply to teachers checking
    of questions or navigating through the lesson. Checking the number of attempts
    relies on values stored in the database and question attempts by teachers are
    not recorded. The teacher should after all know the answers!</p>';
$string['maximumnumberofattemptsreached'] = 'จำนวนคำตอบ/ทางเลือกสูงสุด';
$string['maxtime'] = 'เวลาที่ใช้(นาที)';
$string['maxtimewarning'] = 'คุณเหลือเวลา {$a} นาทีในการทำบทเรียน';
$string['mediaclose'] = 'แสดงปุ่มปิด';
$string['mediafile'] = 'ไฟล์มีเดีย';
$string['mediafilepopup'] = 'คลิกที่นี่เมื่อดูไฟล์มีเดีย';
$string['mediaheight'] = 'ความสูงของหน้าต่าง';
$string['mediawidth'] = 'ความกว้าง';
$string['minimumnumberofquestions'] = 'จำนวนคำถามต่ำสุด';
$string['minimumnumberofquestions_help'] = '<p>When a lesson contains one or more Branch Tables the teacher should 
    normally set this parameter. Its value sets a lower limit on the number of
    quesions seen when a grade is calculated. It does <b>not</b> force students
    to answer that many questions in the lesson</p>

<p>For example, setting this parameter to, say, 20, will ensure that grades are
    given as though the students have seen <b>at least</b> this number of 
    questions. Take the case of a student who only looks at a single branch in
    a lesson with, say, 5 pages and answers all the associated questions 
    correctly. They then choose to end the lesson (assuming there is that option
    in the &quot;top level&quot;Branch Table, a reasonable enough assumption). 
    If this parameter were left unset their grade would be 5 out of 5, that is
    100%. However, with it set to 20 their grade would be reduced to 5 out of 
    20, that is 25%. In the case of another student who goes through all the 
    branches and sees, say, 25 pages and answers all but two of the questions
    correctly, then their grade would be 23 out of 25, that is 92%.</p>

<p>If this parameter is used, then the opening page of the lesson should say
    something like:<p>

<p><blockquote>In this lesson you are expected to attempt at least n questions.
    You can attempt more if you wish. However, if you attempt less than n 
    questions your grade will be calculated as though you attempted n.</blockquote></p>

<p>Where obviously &quot;n&quot; is replaced by the actual value this parameter
    has been given.</p>

<p>When this parameter is set students are told how many questions they
    have attempted and how many they are expected to attempt.';
$string['modattempts'] = 'อนุญาตให้นักเรียนแสดงความคิดเห็น';
$string['modattemptsnoteacher'] = 'นักเรียนสามารถให้ความเห็นเฉพาะงานสำหรับนักเรียน';
$string['modulename'] = 'บทเรียนสำเร็จรูป';
$string['modulename_help'] = '<img valign="middle" src="<?php echo $CFG->wwwroot?>/mod/lesson/icon.gif">&nbsp;<b>Lesson</b>

<ul>
<p>A lesson delivers content in an interesting and flexible way. It consists of a 
    number of pages. Each page normally ends with a question and a number of 
    possible answers. Depending on the student\'s choice of answer they either 
    progress to the next page or are taken back to a previous page. Navigation 
    through the lesson can be straight forward or complex, depending largely 
    on the structure of the material being presented.</p>
</ul>';
$string['modulenameplural'] = 'บทเรียนสำเร็จรูป';
$string['movedpage'] = 'ย้ายหน้า';
$string['movepagehere'] = 'ย้ายมาที่นี่';
$string['moving'] = 'ย้ายหน้า {$a}';
$string['multianswer'] = 'หลายคำตอบ';
$string['multianswer_help'] = '<p>A few of the Question Types have an option which is activated by clicking on
    the checkbox. The question types and the meaning of the options are 
    detailed below.

<ol>
<li><p><b>Multichoice</b> There is variant of Multichoice questions called 
    <b>&quot;Multichoice Multianswer&quot;</b> questions. If the Question 
    Option is selected then the student is required to select all the 
    correct answers from the set of answers. The question may or may not tell 
    the student <i>how many</i> correct answers there are. For example &quot;Which of the 
    following were US Presidents?&quot; does not, while "Select the two US 
    presidents from the following list." does. The actual number of correct 
    answers can be from <b>one</b> up to the number of choices. (A Multichoice 
    Multianswer question with one correct answer <b>is</b> different from a 
    Multichoice question as the former allows the student the possibility of 
    choosing more than one answer while the latter does not.)</p></li>

<li><p><b>Short Answer</b> By default the comparisons ignore the case of the 
    text. If the Question Option is selected then the comparisons are case 
    sensitive.</p></li>

<p>The other Question Types does not use the Question Option.</p>';
$string['multipleanswer'] = 'คำตอบมากกว่าหนึ่ง';
$string['nameapproved'] = 'อนุญาตให้ใช้ชื่อ';
$string['namereject'] = 'ขออภัยค่ะคุณไม่สามารถใช้ชื่อนี้ได้กรุณาเปลี่ยนชื่อใหม่';
$string['nextpage'] = 'หน้าต่อไป';
$string['noanswer'] = 'ไม่มีคำตอบ';
$string['noattemptrecordsfound'] = 'ไม่พบบันทึกการเข้าศึกษา ยังไม่มีคะแนน';
$string['nocommentyet'] = 'ยังไม่มีข้อเสนอแนะ';
$string['nocoursemods'] = 'ไม่พบกิจกรรม';
$string['noessayquestionsfound'] = 'ไม่พบคำถามประเภทความเรียงในบทเรียนสำเร็จรูปนี้';
$string['nohighscores'] = 'ยังไม่มีคะแนนสูง';
$string['nolessonattempts'] = 'ยังไม่มีการเข้าศึกษาบทเรียนสำเร็จรูปนี้';
$string['nooneansweredcorrectly'] = 'ยังไม่มีใครตอบคำถามถูก';
$string['nooneansweredthisquestion'] = 'ยังไม่ไม่ใครตอบคำถามข้อนี้';
$string['noonecheckedthis'] = 'ยังไม่มีใครเช็คข้อนี้';
$string['nooneenteredthis'] = 'ยังไม่มีใครเข้ามาตรงนี้';
$string['noonehasanswered'] = 'ยังไม่มีผู้ตอบคำถามประเภทความเรียง';
$string['noretake'] = 'คุณไม่สามารถทำบทเรียนสำเร็จรูปซ้ำได้';
$string['normal'] = 'ปกติ :: เรียนตามบทเรียนที่วางไว้';
$string['notcompleted'] = 'ยังไม่สมบูรณ์';
$string['notdefined'] = 'ไม่กำหนด';
$string['nothighscore'] = 'คุณไม่ได้อยู่ใน {$a} อันดับคะแนนสูงสุด';
$string['notitle'] = 'ไม่มีชื่อ';
$string['numberofcorrectanswers'] = 'ตอบถูก  {$a} ข้อ';
$string['numberofcorrectmatches'] = 'จับคู่ได้ถูก  {$a} ข้อ';
$string['numberofpagestoshow'] = 'จำนวนหน้าที่ต้องการแสดง';
$string['numberofpagestoshow_help'] = '<p>This parameter is only used in Flash Card type lessons. The default value is zero
    which means that all the Pages/Cards are shown in a lesson. Setting this parameter to
    a non-zero value shows that number of pages. After that number of Page/Cards have been
    shown the end of lesson is reached and the student is shown their grade.</p>
    
<p>If this parameter is set to a number greater than the number of pages in the lesson then
    the end of the lesson is reached when all the pages have been shown.</p>';
$string['numberofpagesviewed'] = 'เข้าชม  {$a}  หน้า';
$string['ongoing'] = 'แสดงคะแนนในระหว่างที่ทำบทเรียน';
$string['ongoingcustom'] = 'บทเรียนนี้มีคะแนนให้ {$a->score} คะแนน คะแนนที่คุณได้คือ {$a->score} คะแนนจาก {$a->currenthigh} คะแนน';
$string['ongoing_help'] = 'Under Construction';
$string['ongoingnormal'] = 'คุณตอบคำถามถูกต้อง {$a->correct} ข้อจากทั้งหมดที่ทำ {$a->viewed} ข้อ';
$string['or'] = 'หรือ';
$string['ordered'] = 'จัดเรียงแล้ว';
$string['other'] = 'อื่น ๆ';
$string['outof'] = 'จากทั้งหมด {$a}';
$string['overview'] = 'ภาพรวม';
$string['overview_help'] = '<ol>
<li>A lesson is made up of a number of <b>pages</b> and optionally <b>branch
    tables</b>.
<li>A page contains some <b>content</b> and it normally ends with a 
    <b>question</b>. Thus the term <b>Question Page</b>.
<li>Each page normally has a set of <b>answers</b>. 
<li>Each answer can have a short piece of text which is displayed if the answer is
    chosen. This piece of text is called the <b>response</b>.
<li>Also associated with each answer is a <b>jump</b>. The jump can be relative - 
    this page, next page - or absolute - specifying any one of the pages in the 
    lesson or the end of the lesson.
<li>By default, the first answer jumps to the <b>next page</b> in the lesson. 
    The subsequent answers jump to the same page. That is, the student is shown 
    the same page of the lesson again if they do not chose the first answer.
<li>The next page is determined by the lesson\'s <b>logical order</b>. This is 
    the order of the pages as seen by the teacher. This order can be altered 
    by moving pages within the lesson.
<li>The lesson also has a <b>navigation order</b>. This is the order of the 
    pages as seen by the students. This is determined by the jumps specified
    for individual answers and it can be very different from the logical order.
    (Although if the jumps are <i>not</i> changed from their default values
     the two are strongly related.) The teacher has the option to check the 
    navigation order.
<li>When displayed to the students, the answers are usually shuffled. That is, 
    the first answer from the teacher\'s point of view will not necessarily be 
    the first answer in the list shown to the students. (Further, each time the
    same set of answers is displayed they are likely to appear in a different
    order.) The exception is sets of answers for matching-type questions, here
    the answers are shown in the same order as input by the teacher. 
<li>The number of answers can vary from page to page. For example, it is allowed
    that some pages can end with a true/false question while others have questions
    with one correct answer and three, say, distractors. 
<li>It is possible to set up a page without any answers. The students are shown
    a <b>Continue</b> link instead of the set of shuffled answers.
<li>For the purposes of grading the lessons, <b>correct</b> answers are ones which 
    jump to a page which is further <i>down</i> the logical order than the current page. 
    <b>Wrong</b> answers are ones which either jump to the same page or to a page
    further <i>up</i> the logical order than the current page. Thus, if the jumps are
    <i>not</i> changed, the first answer is a correct answer and the other answers are 
    wrong answers.
<li>Questions can have more than one correct answer. For example, if two of the answers
    jump to the next page then either answer is taken as a correct answer. (Although
    the same destination page is shown to the students, the responses shown on the way 
    to that page may well be different for the two answers.)
<li>In the teacher\'s view of the lesson the correct answers have underlined Answer 
    Labels.
<li><b>Branch tables</b> are simply pages which have a set of links to other 
    pages in the lesson. Typically a lesson may start with a branch table which
    acts as a <b>Table of Contents</b>.
<li>Each link in a branch table has two components, a description and the title
    of the page to jump to.
<li>A branch table effectively divides the lesson into a number of 
    <b>branches</b> (or sections). Each branch can contain a number of pages 
    (probably all related to the same topic). The end of a branch is usually 
    marked by an <b>End of Branch</b> page. This is a special page which, by 
    default, returns the student back to the preceeding branch table. (The 
    &quot;return&quot; jump in an End of Branch page can be changed, if 
    required, by editing the page.) 
<li>There can be more than one branch table in a lesson. For example, a lesson
    might usefully be structured so that specialist points are sub-branches
    within the main subject branches.
<li>It is important to give students a means of ending the lesson. This might
    be done by including an &quot;End Lesson&quot; link in the main branch 
    table. This jumps to the (imaginary) <b>End of Lesson</b> page. Another
    option is for the last branch in the lesson (here &quot;last&quot; is used
    in the logical ordering sense) to simply continue to the end of the lesson,
    that is, it is <i>not</i> terminated by an End of Branch page.
<li>When a lesson includes one or more branch tables it is advisable to set the
    &quot;Minimum number of Questions&quot; parameter to some reasonable value.
    This sets a lower limit on the number of pages seen when the grade is 
    calculated. Without this parameter a student might visit a single branch
    in the lesson, answer all its questions correctly and leave the lesson 
    with the maximum grade.
<li>Further, when a branch table is present a student has the opportunity of
    re-visiting the same branch more than once. However, the grade is 
    calculated using the number of <i>unique</i> questions answered. So
    repeatedly answering the same set of questions does <i>not</i> increase
    the grade. (In fact, the reverse is true, it lowers the grade as the count
    of the number of pages seen is used in the denominator when calculating 
    grades does include repeats.) In order to give students a fair idea of 
    their progress in the lesson, they are shown details of how many questions
    they are answered correctly, number of pages seen, and their current grade
    on every branch table page.
<li>The <b>end of the lesson</b> is reached by either jumping to that location explicitly 
    or by jumping to the next page from the last (logical) page of the lesson. When the
    end of the lesson is reached, the student receives a congratulations message and is 
    shown their grade. The grade is (the number of questions correctly answered / number of 
    pages seen) * the grade of the lesson.
<li>If the end of the lesson is <i>not</i> reached and the student just leaves,
    when the student goes into the lesson again they are given the choice of 
    starting at the begining or picking up the lesson where they answered their
    last correct answer.
<li> For a lesson which allow re-takes, the teacher has the choice of using the
    best grade or the average of the grades as the &quot;final&quot; grade from
    the lesson. That grade is shown on the Grades page, for example.
</ol>';
$string['page'] = 'หน้า {$a}';
$string['pagecontents'] = 'เนื้อหา';
$string['pages'] = 'หน้า';
$string['pagetitle'] = 'หัวข้อ';
$string['password'] = 'รหัสผ่าน';
$string['passwordprotectedlesson'] = 'บทเรียน{$a} ต้องใช้รหัสผ่านในการเข้าไปทำ';
$string['pleasecheckoneanswer'] = 'ตรวจคำตอบ';
$string['pleasecheckoneormoreanswers'] = 'ตรวจคำตอบ';
$string['pleaseenteryouranswerinthebox'] = 'กรุณาใส่คำตอบในช่องว่าง';
$string['pleasematchtheabovepairs'] = 'ให้จับคู่ข้อด้านบนนี้';
$string['pluginname'] = 'บทเรียนสำเร็จรูป';
$string['pointsearned'] = 'คะแนนที่ได้';
$string['postsuccess'] = 'โพสต์สำเร็จแล้ว';
$string['practice'] = 'ทดลองทำบทเรียนสำเร็จรูป';
$string['practice_help'] = 'Under Construction';
$string['preview'] = 'ดูตัวอย่าง';
$string['previewlesson'] = 'ดูตัวอย่าง {$a}';
$string['previouspage'] = 'หน้าก่อน';
$string['progressbar'] = 'แถบแสดงความคืบหน้า';
$string['progressbarteacherwarning'] = 'แถบแสดงความคืบหน้าไม่แสดงสำหรับ  {$a}';
$string['question'] = 'คำถาม';
$string['questionoption'] = 'เช็คที่นี่สำหรับคำถามหลายคำตอบ/ ต้องการให้ระบบแยกตัวพิมพ์ใหญ่เล็กเป็นคนละตัว';
$string['questiontype'] = 'ประเภทของคำถาม';
$string['randombranch'] = 'สุ่มหน้าในแต่ละหัวข้อที่ทำ';
$string['randompageinbranch'] = 'สุ่มคำถามภายในหัวข้อ';
$string['rank'] = 'อันดัน';
$string['receivedcredit'] = 'ได้รับเครดิต';
$string['redisplaypage'] = 'แสดงข้อมูลเดิม';
$string['report'] = 'รายงาน';
$string['reports'] = 'รายงาน';
$string['response'] = 'เมื่อตอบข้อนี้ให้แสดงข้อความว่า..';
$string['retakesallowed_help'] = '<p>This setting determines whether the students can take the lesson more than once
    or only once. The teacher may decide that the lesson contains material which
    the students ought to know throughly. In which case repeated viewings of the 
    lesson should be allowed. If, however, the material is used more like an exam
    then the students should not be allowed to re-take the lesson.</p>

<p>When the students are allowed to re-take the lesson, the <b>grades</b> shown 
    in the Grades page are either their <b>average</b> grade over the re-takes 
    or their <b>best</b> grade for the lesson. The next parameter determines 
    which of these two grading alternatives is used.</p>
    
<p>Note that the <b>Question Analysis</b> always uses the answers from the 
    first tries of the lesson, subsequent re-takes by students are ignored.</p>

<p>By default this option is <b>Yes</b>, meaning that students are allowed to 
    re-take the lesson. It is expected that only in exceptional circumstances
    will this option be set to <b>No</b>.';
$string['returntocourse'] = 'กลับไปยังรายวิชา';
$string['review'] = 'Review';
$string['reviewlesson'] = 'ความเห็นเกี่ยวกับบทเรียนสำเร็จรูป';
$string['reviewquestionback'] = 'ใช่..ต้องการทำอีกครั้ง';
$string['reviewquestioncontinue'] = 'ไม่..ต้องการทำคำถามต่อไป';
$string['sanitycheckfailed'] = 'มีข้อผิดพลาด ยกเลิกการทำแบบทดสอบครั้งนี้';
$string['savechanges'] = 'บันทึกการเปลี่ยนแปลง';
$string['savechangesandeol'] = 'บันทึกการเปลี่ยนแปลงทั้งหมดแล้วจบบทเรียนสำเร็จรูป';
$string['savepage'] = 'บันทึก';
$string['score'] = 'คะแนน';
$string['scores'] = 'คะแนน';
$string['secondpluswrong'] = 'ยังไม่ถูกต้อง ต้องการทำอีกครั้งหรือเปล่าคะ';
$string['showanunansweredpage'] = 'แสดงหน้าที่ยังไม่ได้ตอบ';
$string['showanunseenpage'] = 'แสดงหน้าที่ยังไม่ได้เข้าไปศึกษา';
$string['singleanswer'] = 'คำตอบเดียว';
$string['skip'] = 'ข้าม navigation';
$string['slideshow'] = 'สไลด์โชว์';
$string['slideshowbgcolor'] = 'สีของสไลด์โชว์';
$string['slideshowheight'] = 'ความสูงของสไลด์';
$string['slideshow_help'] = 'Under Construction';
$string['slideshowwidth'] = 'ความกว้างของสไลด์';
$string['startlesson'] = 'เริ่มต้นบทเรียน';
$string['studentattemptlesson'] = '{$a->firstname} {$a->lastname} ทำครั้งที่ {$a->attempt}';
$string['studentname'] = 'ชื่อ{$a}';
$string['studentoneminwarning'] = 'คำเตือน คุณเหลือเวลา 1 นาทีหรือน้อยกว่าในการทำบทเรียน';
$string['studentresponse'] = 'คำตอบของ{$a}';
$string['submitname'] = 'ชื่อผู้ทำ';
$string['teacherjumpwarning'] = 'มีการใช้งานการกระโดดข้าม{$a->cluster} หรือข้าม{$a->unseen} ในบทเรียนนี้ ระบบจะใช้การข้ามไปหน้าต่อไปแทนการกระโดดข้ามดังกล่าว หากต้องการทดสอบการข้ามหน้าดังกล่าวให้เข้าสู่ระบบในฐานะนักเรียน';
$string['teacherongoingwarning'] = 'แสดงคะแนนในขณะที่ทำแบบทดสอบจะแสดงเฉพาะนักเรียนที่เข้าสู่ระบบในฐานะนักเรียนที่ทดสอบบทเรียน';
$string['teachertimerwarning'] = 'การจับเวลาจะใช้งานได้เฉพาะกับนักเรียนจะเห็นก็ต่อเมื่อเข้าสู่ระบบในฐานะนักเรียน';
$string['thatsthecorrectanswer'] = 'ถูกต้อง';
$string['thatsthewronganswer'] = 'ผิด';
$string['thefollowingpagesjumptothispage'] = 'หน้าถัดไปมายังหน้านี้';
$string['thispage'] = 'หน้านี้';
$string['timeremaining'] = 'เหลือเวลา';
$string['timespenterror'] = 'ใช้เวลาอย่างน้อย {$a} นาทีในบทเรียนนี้';
$string['timespentminutes'] = 'ใช้เวลาไป (นาที)';
$string['timetaken'] = 'เวลาที่ใช้';
$string['topscorestitle'] = 'คะแนนสูงสุด {$a} อันดับสำหรับบทเรียน';
$string['unseenpageinbranch'] = 'คำถามที่ยังไม่ได้ทำในหัวข้อนี้';
$string['unsupportedqtype'] = 'ไม่สนับสนุนการใช้งานคำถามประเภทนี้( {$a})';
$string['updatedpage'] = 'อัพเดทหน้านี้แล้ว';
$string['updatefailed'] = 'ไม่สามารถอัพเดทได้';
$string['usemaximum'] = 'ใช้ค่าสูงสุด';
$string['usemean'] = 'ใช้ค่าเฉลี่ย';
$string['usepassword'] = 'บทเรียนที่ต้องใช้รหัสผ่านในการเข้าทำ';
$string['usepassword_help'] = 'Under Construction';
$string['viewgrades'] = 'แสดงคะแนน';
$string['viewhighscores'] = 'แสดงรายการคะแนนสูงสุด';
$string['viewreports'] = 'ดูการทำแบบทดสอบที่เสร็จแล้วของ {$a->student} ทั้งหมด {$a->attempts} ครั้ง';
$string['welldone'] = 'เยี่ยมมากค่ะ';
$string['whatdofirst'] = 'ต้องการทำอะไรก่อนคะ';
$string['wronganswerjump'] = 'ข้ามคำตอบที่ผิด';
$string['wronganswerscore'] = 'คะแนนของคำตอบที่ผิด';
$string['wrongresponse'] = 'คำตอบที่ผิด';
$string['youhaveseen'] = 'คุณเข้าศึกษาบทเรียนนี้มามากกว่าหนึ่งหน้าแล้ว ต้องการกลับไปหน้าที่แล้วหรือเปล่า ?';
$string['youmadehighscore'] = 'เยี่ยมมากค่ะคุณอยู่ใน {$a}  อันดับคะแนนสูงสุด';
$string['youranswer'] = 'คำตอบของคุณ';
$string['yourcurrentgradeis'] = 'คะแนนที่ได้ {$a}  คะแนน';
$string['youshouldview'] = 'คุณควรเปิดดูอย่างน้อย {$a} ครั้ง';
