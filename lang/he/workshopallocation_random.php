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
 * Strings for component 'workshopallocation_random', language 'he', branch 'MOODLE_22_STABLE'
 *
 * @package   workshopallocation_random
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addselfassessment'] = 'הוסף ההערכות עצמיות';
$string['allocationaddeddetail'] = 'יש לבצע הערכה מחודשת:<strong>{$a->reviewername}</strong> הוא המעריך של <strong>{$a->authorname}</strong>';
$string['allocationdeallocategraded'] = 'לא ניתן לבטל הקצאה שכבר קבלה ציון: המעריך <strong>{$a->reviewername}</strong>,הגשהauthor: <strong>{$a->authorname}</strong>';
$string['allocationreuseddetail'] = 'השתמש שוב בהערכות:
<strong>{$a->reviewername}</strong> נשמר כנצפה של <strong>{$a->authorname}</strong>';
$string['allocationsettings'] = 'הדגרות ההקצאה';
$string['assessmentdeleteddetail'] = 'ביטול הקצאה ההערכה: <strong>{$a->reviewername}</strong> לא משמש יותר כמעריך של <strong>{$a->authorname}</strong>';
$string['assesswosubmission'] = 'המשתתפים יכולים לאמוד ללא כל הגשה';
$string['confignumofreviews'] = 'מספר ברירת-המחדל של הגשות שיוקצו אקראית';
$string['excludesamegroup'] = 'מניעת הערכות על-ידי עמיתי מאותה קבוצה';
$string['noallocationtoadd'] = 'אין הקצאות להוספה';
$string['nogroupusers'] = '<p>
אזהרה: אם \'הערכת העמיתיים\' במצב קבצות שבו הן גלויות או \'קבוצות נפרדות\' , על הסטודנטים להיות חלק מלפחותקבוצה אחת בכדי לקבל יכולת להעריך עמית המוקצת להם על-ידי אמצעי זה. משתמשים שאינם שייכים לקבוצה יכולים לקבל הערכת עמיתים עצמאית שלהם קיימים הערכות שהוסרו
</p> <p>משתמשים אלו כרגע אינם חברים בקבוצה: {$a}</p>';
$string['numofdeallocatedassessment'] = 'ביטול {$a} הקצאה(ות)';
$string['numofrandomlyallocatedsubmissions'] = 'הקצאה אקראית  {$a} הגשה(ות)';
$string['numofreviews'] = 'מספר המעריכים';
$string['numofselfallocatedsubmissions'] = 'הקצאה עצמית של  {$a} הגשה(ות)';
$string['numperauthor'] = 'לכל הגשה';
$string['numperreviewer'] = 'לכל מעריך';
$string['pluginname'] = 'הקצאה אקראית';
$string['randomallocationdone'] = 'הקצאה אקראית בוצעה';
$string['removecurrentallocations'] = 'הסר את ההקצאות הקיימות';
$string['resultnomorepeers'] = 'לא נמצאו עוד עמיתים';
$string['resultnomorepeersingroup'] = 'לא נמצאו עוד עמיתים בקבוצה מופרדת זו';
$string['resultnotenoughpeers'] = 'אין מספיק עמיתים זמינים';
$string['resultnumperauthor'] = 'מנסה להקצות {$a} סקירות עבור כל מחבר';
$string['resultnumperreviewer'] = 'מנסה להקצות {$a} סקירות עבור כל מבקר';
$string['stats'] = 'סטטיסטיקה של הקצאות נוכחיות';
