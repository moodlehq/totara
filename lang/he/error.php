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
 * Strings for component 'error', language 'he', branch 'MOODLE_22_STABLE'
 *
 * @package   error
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['TODO'] = 'TODO';
$string['alreadyloggedin'] = 'אתה כבר מחובר כ {$a}, יש צורך בהתנתקות לפני התחברות כמשתמש אחר.';
$string['authnotexisting'] = 'תוסף אישור לא קיים';
$string['backupcontainexternal'] = 'קובץ גיבוי זה מכיל
Moodle Network Hosts
חיצוניים אשר לא מוגדרים באופן מקומי';
$string['backuptablefail'] = 'לא היה ניתן להגדיר כראוי את  טבלאות הגיבוי';
$string['blockcannotconfig'] = 'משבצת זו לא תומכת בהגדרות מערכתיות';
$string['blockcannotinistantiate'] = 'בעיה בהתקנת אובייקט משבצת';
$string['blockcannotread'] = 'לא ניתן היה לקרוא את המידע המשבצת ={$a}';
$string['blockdoesnotexist'] = 'משבצת זו איננה קיימת';
$string['blockdoesnotexistonpage'] = 'משבצת זו (id={$a->instanceid})
לא קיימת בעמוד זה
({$a->url}).';
$string['blocknameconflict'] = 'קונפליקט בשם: למשבצת {$a->name}
יש שם כותרת זהה עם שם משבצת הקיימת כבר: {$a->conflict}!';
$string['callbackrejectcomment'] = 'הרכיב מונע מלהוסיף הערכה';
$string['cannotaddcoursemodule'] = 'לא ניתן היה להוסיף רכיב קורס חדש';
$string['cannotaddcoursemoduletosection'] = 'לא ניתן היה להוסיף רכיב קורס חדש ליחידה זו';
$string['cannotaddmodule'] = 'לא היה ניתן להוסיף את רכיב {$a}
לרשימת הרכיבים';
$string['cannotaddnewmodule'] = 'לא ניתן להוסיף רכיב חדש של {$a}';
$string['cannotaddrss'] = 'אין לך מספיק הרשאות להוסיף הזנות RSS';
$string['cannotaddthisblocktype'] = 'אינך יכול להוסיף משבצת {$a} לעמוד זה';
$string['cannotassignrole'] = 'לא ניתן למנות תפקיד בקורס';
$string['cannotassignrolehere'] = 'אין לך הרשאה להקצות תפקיד זה
(id = {$a->roleid})
בהקשר זה
({$a->context})';
$string['cannotassignselfasparent'] = 'לא ניתן להקצות עצמך כ-אב';
$string['cannotcallscript'] = 'אינך יכול לקרוא לתסריט זה בשם זה';
$string['cannotcallusgetselecteduser'] = 'אינך יכול לקרוא
user_selector::get_selected_user
אם הבחירה המרובה בעלת ערך אמת';
$string['cannotcreatebackupdir'] = 'לא ניתן היה ליצור תיקיית backupdata.
מנהל האתר זקוק לתקן את הרשאות הקובץ';
$string['cannotcreatecategory'] = 'הקטגוריה לא הוכנסה';
$string['cannotcreategroup'] = 'שגיאה ביצירת הקבוצה';
$string['cannotcreatelangbase'] = 'שגיאה: לא ניתן ליצור ספריית שפת בסיס';
$string['cannotcreatelangdir'] = 'לא ניתן ליצור סיפריית שפה.';
$string['cannotcreateorfindstructs'] = 'שגיאה בחיפוש או מציאת מבני יחידה עבור קורס זה';
$string['cannotcreatepopupwin'] = 'מרכיב איננו מוגדר - לא ניתן ליצור חלון חופץ';
$string['cannotcreatesitedir'] = 'לא ניתן ליצור תיקייה לאתר. מנהל המערכת צריך לפתור את בעיית ההרשאות הקובץ.';
$string['cannotcreatetempdir'] = 'לא ניתן ליצור סיפרייה זמנית.';
$string['cannotcreateuploaddir'] = 'לאניתן ליצור תיקיית העלאת קבצים. מנהל המערכת צריך לפתור את בעיית הרשאות הקובץ.';
$string['cannotcustomisefiltersblockuser'] = 'לא ניתן להגדיר התאמת מסננים
בהקשרי משבצות או קורס.';
$string['cannotdeletebackupids'] = 'לא ניתן למחוק
backup ids
קודמים';
$string['cannotdeletecategorycourse'] = 'נכשל בנסיון למחוק את הקורס
\'{$a}\'';
$string['cannotdeletecategoryquestions'] = 'לא ניתן היה למחוק שאלות מהסיווג
\'{$a}\'';
$string['cannotdeletecourse'] = 'אין לך הרשאה למחוק קורס זה';
$string['cannotdeletecustomfield'] = 'שגיאה במחיקת מידע שדה מותאם';
$string['cannotdeletedir'] = 'לא ניתן למחוק ({$a})';
$string['cannotdeletefile'] = 'לא ניתן למחוק את קובץ זה';
$string['cannotdeleterole'] = 'לא היה ניתן למחוק את זה,
מהסיבה הזו: {$a}';
$string['cannotdeleterolewithid'] = 'לא ניתן למחוק תפקיד עם ID הזה
{$a}';
$string['cannotdeletethisrole'] = 'לא ניתן למחוק את התפקיד הזה מפני שהוא בשימוש על-ידי המערכת או מפני שהוא התפקיד האחרון בעל יכולות של מנהל.';
$string['cannotdownloadcomponents'] = 'לא ניתן להוריד רכיבים.';
$string['cannotdownloadlanguageupdatelist'] = 'לא ניתן להוריד רשימת שפות עדכנית מאתר moodle.org';
$string['cannotdownloadzipfile'] = 'לא ניתן להוריד קובץ ZIP.';
$string['cannoteditcomment'] = 'תגובה זו איננך שייכת לך בכדי שתערוך אותה.';
$string['cannoteditcommentexpired'] = 'לא ניתן לערוך זאת. פרק הזמן חלף!';
$string['cannoteditpostorblog'] = 'לא ניתן לפרסם או לערוך הודעות בלוג';
$string['cannoteditsiteform'] = 'לא ניתן לערוך את אתר הקורס בשימוש בטופס זה.';
$string['cannotedityourprofile'] = 'מצטערים, לא ניתן לערוך פרופיל אישי.';
$string['cannotfindcategory'] = 'לא ניתן למצוא את רשומת הקטגוריה ממסד הנתונים על-ידי ה-ID - {$a}';
$string['cannotfindcomponent'] = 'הרכיב לא נמצא.';
$string['cannotfindcontext'] = 'לא ניתן למצוא הקשר';
$string['cannotfindcourse'] = 'לא ניתן למצוא את הקורס';
$string['cannotfinddocs'] = 'לא ניתן למצוא  קבצי תיעוד שפה
"{$a}"';
$string['cannotfindgradeitem'] = 'לא ניתן למצוא
grade_item';
$string['cannotfindgroup'] = 'לא ניתן למצוא קבוצה';
$string['cannotfindhelp'] = 'לא ניתן למצוא  קבצי עזרה של השפה
"{$a}"';
$string['cannotfindinfo'] = 'לא ניתן למצוא מידע עבור : "{$a}"';
$string['cannotfindlang'] = 'לא ניתן למצוא חבילת שפה "{$a}" !';
$string['cannotfindteacher'] = 'לא ניתן למצוא מורה';
$string['cannotfinduser'] = 'לא ניתן למצוא משתמש בשם "{$a}"';
$string['cannotgetblock'] = 'לא ניתן לאחזר משבצות ממסד הנתונים.';
$string['cannotgetcats'] = 'לא ניתן לקבל רשומת קטגוריה';
$string['cannotgetdata'] = 'לא ניתן לקבל נתונים';
$string['cannotgradeuser'] = 'לא ניתן לתת ציון למשתמש זה';
$string['cannothaveparentcate'] = 'אין לקטגורית קורס זה אב';
$string['cannotimport'] = 'יבוא שגיאה';
$string['cannotimportformat'] = 'מצטערים, יבוא תסדיר זה לא הושם עדיים';
$string['cannotimportgrade'] = 'שגיאה ביבוא הציון';
$string['cannotinsertgrade'] = 'לא ניתן להכניס פריט ציון ללא מספר זיהוי של הקורס';
$string['cannotinsertrate'] = 'לא ניתן להכניס דירוג חדש
({$a->id} = {$a->rating})';
$string['cannotinsertrecord'] = 'לא ניתן להכניס רשומת זיהוי {$a}';
$string['cannotmailconfirm'] = 'שגיאה בשליחת דוא"ל אישור לשינוי הסיסמה';
$string['cannotmanualctrack'] = 'הפעילות איננה מספקת מעקב השלמה ידני';
$string['cannotmapfield'] = 'נתגלתה התנגשות במיפוי - שני שדות ממופים לאותו פריט ציון
{$a}';
$string['cannotmarktopic'] = 'לא ניתן לסמן את נושא זה עבור קורס זה.';
$string['cannotmigratedatacomments'] = 'לא ניתן להמיר את הערות רכיב מסד הנתונים';
$string['cannotmodulename'] = 'לא ניתן לקבל את שם הרכיב בניווט הבנייה';
$string['cannotmoduletype'] = 'לא ניתן לקבל את סוג הרכיב בניווט הבנייה';
$string['cannotmoverolewithid'] = 'לא ניתן להזיז תפקיד עם ID
{$a}';
$string['cannotnetgeo'] = 'לא ניתן להתחבר ל שרת NetGeo
בכתובת http://netgeo.caida.org אנא בדוק את הגדרות ה-proxy או התקן את
MaxMind GeoLite City data file';
$string['cannotopencsv'] = 'לא ניתן לפתוח קובץ CSV';
$string['cannotopenfile'] = 'לא ניתן לפתוח קובץ ({$a})';
$string['cannotopenforwrit'] = 'לא ניתן לפתוח לכתיבה: ({$a})';
$string['cannotopentemplate'] = 'לא ניתן לפתוח קובץ תבנית ({$a})';
$string['cannotopenzip'] = 'לא ניתן לפתוח קובץ zip כנראה שגיאת סיומת בקובץ במערכת הפעלה 64 ביט.';
$string['cannotoverridebaserole'] = 'לא ניתן לעקוף יכולות תפקיד בסיסיות';
$string['cannotoverriderolehere'] = 'אין לך הרשאה לעקוף תפקיד זה
(id = {$a->roleid})
בהקשר זה:
({$a->context})';
$string['cannotreadfile'] = 'לא ניתן לקרוא קובץ ({$a})';
$string['cannotreadtmpfile'] = 'שגיאה בקריאת קובץ זמני';
$string['cannotreaduploadfile'] = 'לא ניתן לקרוא את הקובץ שהועלה';
$string['cannotremovefrommeta'] = 'לא ניתן להסיר את הקורס הנבחר מקורס מטה זה.';
$string['cannotresetguestpwd'] = 'לא ניתן לאפס את סיסמת האורח';
$string['cannotresetmail'] = 'שגיאה באיפוס סיסמה ושליחת דוא"ל';
$string['cannotresetthisrole'] = 'לא ניתן לאפס את תפקיד זה';
$string['cannotrestore'] = 'שגיאה התרחשה ולכן לא ניתן היה להשלים את השחזור';
$string['cannotrestoreadminorcreator'] = 'יש צורך להיות יוצר קורסים או מנהל מערכת בכדי לשחזר לקורסים חדשים!';
$string['cannotrestoreadminoredit'] = 'יש צורך להיות מורה או מנהל מערכת בכדי לשחזר לקורסים הנבחרים!';
$string['cannotsaveagreement'] = 'לא ניתן היה לשמור את ההסכם שלך';
$string['cannotsaveblock'] = 'שגיאה בשמירת הגדרות המשבצת';
$string['cannotsavecomment'] = 'לא ניתן לשמור הערה';
$string['cannotsavedata'] = 'לא ניתן לשמור נתונים';
$string['cannotsavefile'] = 'לא ניתן לשמור קובץ "{$a}"!';
$string['cannotsavemd5file'] = 'לא ניתן לשמור קובץ md5.';
$string['cannotsavezipfile'] = 'לא ניתן לשמור קובץ ZIP.';
$string['cannotservefile'] = 'לא ניתן להגיש קובץ.ישנה בעיה בהגדרות השרת.';
$string['cannotsetparentforcatoritem'] = 'לא ניתן להגדיר אב עבור הקטגוריה או פריט הקורס!';
$string['cannotsetpassword'] = 'לא ניתן לקבוע את הסיסמה שלך!';
$string['cannotsetprefgrade'] = 'לא ניתן לקבוע (להגדיר) צפיית מאפייני צבירה ל {$a}
עבור קטגוריית ציון זו';
$string['cannotsettheme'] = 'לא ניתן לקבוע את ערכת הנושא!';
$string['cannotsetupblock'] = 'טבלאות המשבצות נכשלו בהתקנתן!';
$string['cannotsetupcapformod'] = 'לא ניתן לקבוע את יכולות מתן הרשאה עבור {$a}';
$string['cannotsetupcapforplugin'] = 'לא ניתן לקבוע את יכולות מתן הרשאה עבור {$a}';
$string['cannotshowhidecoursesincategory'] = 'לא ניתן להסתיר/לגלות את הקורסים בקטגורה {$a}.';
$string['cannotunassigncap'] = 'לא ניתן להסיר מרישום יכולות שלא בשימוש
{$a->cap} מתפקיד
{$a->role}';
$string['cannotunassignrolefrom'] = 'לא ניתן להסיר משתמש זה מתפקיד :
{$a}';
$string['cannotunzipfile'] = 'לא ניתן לפתוח את קובץ ה-ZIP.';
$string['cannotupdatemod'] = 'לא ניתן לעדכן {$a}';
$string['cannotupdatepasswordonextauth'] = 'נכשל בנסיון לעדכן סיסמה באימות חיצוני: {$a}. ראה פרטים נוספים בדוחות השרת';
$string['cannotupdateprofile'] = 'שגיאה בעדכון רשומת המשתמש';
$string['cannotupdaterecord'] = 'לא ניתן לעדכן רשומת זיהוי {$a}';
$string['cannotupdaterss'] = 'לא ניתן לעדכן RSS';
$string['cannotupdatesubcourse'] = 'לא ניתן לעדכן קורס בן';
$string['cannotupdateusermsgpref'] = 'לא ניתן לעדכן העדפות מסרי המשתמש';
$string['cannotupdateuseronexauth'] = 'נכשל בנסיון לעדכן נתוני משתמש באימות חיצוני : {$a} בדוק את דוחות השרת עבור פרטים אלו.';
$string['cannotuploadfile'] = 'שגיאה בתהליך העלאת הקובץ';
$string['cannotuseadmin'] = 'יש צורך להתחבר כמנהל מערכת בכדי להשתמש בעמוד זה';
$string['cannotuseadminadminorteacher'] = 'יש צורך להתחבר כמנהל מערכת או מורה בכדי להשתמש בעמוד זה';
$string['cannotusepage'] = 'רק מנהלים ומורים יכולים להשתמש בעמוד זה';
$string['cannotusepage2'] = 'מצטערים, לא ניתן להשתמש בעמוד זה';
$string['cannotviewprofile'] = 'אינך רשאי לראות את הפרופיל של משתמש זה.';
$string['cannotviewreport'] = 'לא ניתן לצפות בדוח זה';
$string['cannotwritefile'] = 'לא ניתן לכתוב לקובץ ({$a})';
$string['commentmisconf'] = 'ID הערות לא מוגדר נכון';
$string['componentisuptodate'] = 'הרכיב מעודכן.';
$string['confirmsesskeybad'] = 'הפעולה בוטלה. לא היה ניתן לאשר את זהות המשתמש שלך כדי לבצע פעולה זו. מנגנון אבטחה זה מונע ביצוע של פעולות מערכת חשובות בשימך, בין אם בזדון ובין אם בטעות. אנא הזדהה שוב למערכת, במידה ואתה מעוניין לבצע פעולה זו.';
$string['couldnotassignrole'] = 'חלה שגיאה רצינית אך לא מוגדרת במהלך הניסיון למנות אותך לתפקיד.';
$string['couldnotupdatenoexistinguser'] = 'לא ניתן לעדכן את המשתמש - המשתמש לא קיים';
$string['countriesphpempty'] = 'שגיאה: קובץ countries.php בחבילת השפה {$a} חסרה או ריקה.';
$string['coursedoesnotbelongtocategory'] = 'הקורס לא שייך לקטגוריה זו';
$string['courseformatnotfound'] = 'תצורת הקורס \'{$a}\'  איננה קיימת או מזוהה.';
$string['coursegroupunknown'] = 'לא מפורט קורס התואם את קבוצה {$a}.';
$string['courseidnotfound'] = 'ID הקורס לא קיים';
$string['coursemisconf'] = 'הקורס מוגדר בצורה שגויה';
$string['courserequestdisabled'] = 'מצטערים, בקשות קורסים אינן מאופשרות';
$string['csvcolumnduplicates'] = 'התגלו עמודות כפולות.';
$string['csvemptyfile'] = 'קובץ ה-CSVריק.';
$string['csvfewcolumns'] = 'אין מספיק עמודות, אנא וודא את הגדרת התוחם.';
$string['csvinvalidcols'] = '<b>קובץ CSV לא תקף:</b>
השורה הראשונה חייבת להכליל "שדות כותרת עליונה" הקובץ צריך להיות מסוג של <br />
"Expanded Fields/Comma Separated"
או
"Expanded Fields with CAVV Result Code/Comma Separated"';
$string['csvinvalidcolsnum'] = 'קובץ CSV שגוי - כל שורה צריכה להכיל 49-70 שדות';
$string['csvloaderror'] = 'שגיאה התרחשה בזמן טעינת קובץ CSV!';
$string['csvweirdcolumns'] = 'תסדיר קובץ CSV פגום מספר העמודות לא קבוע';
$string['dbconnectionfailed'] = '<p>שגיאה: חיבור מסד נתונים נכשל
</p>
יתכן כי מסד הנתונים הגיע למכסתו או שאינו רץ כהלכה. </p> <p>
מנהל מערכת האתר יוכל לבדוק אם שפרטי מסד הנתונים תקינים  בקובץ ה-
config.php</p>';
$string['dbdriverproblem'] = '<p>שגיאה: ישנה בעיה בהתקן מסד הנתונים </p> <p>יש לבדוק את הגדרות השרת על-ידי מנהל המערכת</p><p>{$a}</p>';
$string['dbsessionbroken'] = 'התגלתה בעיית מושב חמורה של מסד הנתונים.
<br /><br />נא לעדכן את מנהל המערכת.';
$string['dbsessionhandlerproblem'] = 'הגדרת מושב מסד הנתונים נכשלה.
<br /><br />נא לעדכן את מנהל המערכת.';
$string['dbsessionmysqlpacketsize'] = 'התגלתה שגיאה רצינית במושב
<br /><br />נא לעדכן את מנהל המערכת.
בעיה זו כנראה נגרמה מהשמת ערך קטן בהגדרת
max_allowed_packet MySQL';
$string['dbupdatefailed'] = 'עדכון מסד הנתונים כשל.';
$string['ddldependencyerror'] = 'לא ניתן לשנות את
{$a->targettype} "{$a->targetname}"
נמצאה תלות ב- {$a->offendingtype} "{$a->offendingname}"';
$string['ddlexecuteerror'] = 'שגיאת סיומת DLL sql';
$string['ddlfieldalreadyexists'] = 'שדה "{$a}" כבר קיים';
$string['ddlfieldnotexist'] = 'שדה "{$a->fieldname}"  לא קיים בטבלה
"{$a->tablename}"';
$string['ddltablealreadyexists'] = 'טבלת "{$a}" כבר קיימת';
$string['ddltablenotexist'] = 'טבלת "{$a}" איננה קיימת';
$string['ddlunknownerror'] = 'שגיאת  DDL library לא ידועה';
$string['ddlxmlfileerror'] = 'נמצאו שגיאות קובץ
XML database';
$string['ddsequenceerror'] = 'הגדרת טבלת "{$a}"  שגויה.
רק עמודה אוטומטית אחת צריכה להיות וחייבת להיות מוגדרת עם מפתח.';
$string['destinationcmnotexit'] = 'יעד רכיב  הקורס לא קיים';
$string['detectedbrokenplugin'] = 'תוסף "{$a}" פגום או שאינו תקף.
לא ניתן להמשיך.';
$string['dmlreadexception'] = 'שגיאה בקריאה ממסד הנתונים';
$string['dmltransactionexception'] = 'שגיאת ביצוע מסד הנתונים';
$string['dmlwriteexception'] = 'שגיאה בכתיבה למסד הנתונים';
$string['downgradedcore'] = 'שגיאה!! קוד הליבה של מערכת מוודל בו אתם משתמשים ישן מהגרסה הנדרשת לשימוש על ידי מסד-הנתונים הנוכחי. אנא שדרגו את ליבת מערכת המוודל שלכם.';
$string['downloadedfilecheckfailed'] = 'נכשלה בדיקת הקובץ המורד.';
$string['duplicatefieldname'] = 'שם שדה כפול "{$a}" נמצא';
$string['duplicateparaminsql'] = 'שגיאה: שם פרמטר כפול בשאילתה';
$string['duplicaterolename'] = 'כבר ישנו תפקיד עם שם זה!';
$string['duplicateroleshortname'] = 'כבר ישנו תפקיד עם שם מקוצר זה!';
$string['duplicateusername'] = 'שם משתמש כפול - מדלג על הרשומה';
$string['emailfail'] = 'שליחת דוא"לים נכשלה';
$string['error'] = 'שגיאה התרחשה';
$string['errorcleaningdirectory'] = 'שגיאה בניקיון ספריית "{$a}".';
$string['errorcopyingfiles'] = 'שגיאה בהעתקת הקבצים.';
$string['errorcreatingdirectory'] = 'שגיאה ביצירת ספריית "{$a}"';
$string['errorcreatingfile'] = 'שגיאה ביצירת קובץ "{$a}"';
$string['errorcreatingrole'] = 'שגיאה ביצירת תפקיד';
$string['errorfetchingrssfeed'] = 'שגיאה במשיכת הזנות RSS';
$string['erroronline'] = 'טעות בקו {$a}';
$string['errorparsingxml'] = 'שגיאה ב
XML: {$a->errorstring} בשורה {$a->errorline},
תו {$a->errorchar}';
$string['errorreadingfile'] = 'שגיאה בקריאת קובץ "{$a}"';
$string['errorsavingrequest'] = 'שגיאה התרחשה כאשר ניסו לשמור את הבקשה שלך.';
$string['errorsettinguserpref'] = 'שגיאה בקביעת העדפות משתמש';
$string['errorunzippingfiles'] = 'שגיאה בפתיחת קבצי ZIP';
$string['expiredkey'] = 'מפתח איננו תקף';
$string['externalauthpassworderror'] = 'סיסמה שאיננה ריק עבור אימות חיצוני';
$string['failtoloadblocks'] = 'משבצת אחת או יותר רשומות במסד הנתונים, אך כולן נכשלו בטעינתן!';
$string['fieldrequired'] = '"{$a}" הוא שדה נדרש';
$string['fileexists'] = 'קובץ קיים';
$string['filemismatch'] = 'חוסר התאמה בשם קובץ שלא שייך לליבה
Non-core
. הקובץ "{$a->current}" צריך להיות
{$a->file}';
$string['filenotfound'] = 'סליחה, לא ניתן היה למצוא את הקובץ המבוקש';
$string['filenotreadable'] = 'הקובץ לא ניתן לקריאה';
$string['filterdoesnothavelocalconfig'] = 'המסנן {$a} לא מאפשר הגדרות מקומיות';
$string['filternotactive'] = 'המסנן {$a} לא פעיל כרגע';
$string['filternotenabled'] = 'המסנן איננו מאופשר';
$string['filternotinstalled'] = 'המסנן {$a} איננו מותקן כרגע';
$string['forumblockingtoomanyposts'] = 'עברת את סף הפירסומים שנקבע לפורום זה.';
$string['generalexceptionmessage'] = '{$a}  הודעת שגיאה חריגה';
$string['gradepubdisable'] = 'פרסום ציון לא מאופשר';
$string['groupalready'] = 'המשתמש כבר משתייך לקבוצה {$a}';
$string['groupexistforcourse'] = 'קבוצה "{$a}" כבר קיימת לקורס זה';
$string['groupnotaddederror'] = 'קבוצה "{$a}" לא נוספה';
$string['groupunknown'] = 'קבוצה {$a} אינה שייכת לקורס המצוין';
$string['groupusernotmember'] = 'המשתמש אינו חבר בקבוצה זו.';
$string['guestnocomment'] = 'אורחים אינם רשאים לפרסם הערות!';
$string['guestnoeditprofile'] = 'המשתמש האורח לא יכול לערוך את הפרופיל שלו';
$string['guestnoeditprofileother'] = 'לא ניתן לערוך את פרופיל המשתמש האורח';
$string['guestnorate'] = 'אורחים אינם רשאים לדרג ערכים';
$string['guestsarenotallowed'] = 'משתמש האורח לא ראשי לעשות זאת';
$string['hackdetected'] = 'התגלתה התקפת האקרים';
$string['hashpoolproblem'] = 'תוכן קובץ סקר לא תקין {$a}';
$string['headersent'] = 'כותרות עליונות נשלחו כבר';
$string['idnumbertaken'] = 'מספר זיהוי ID בשימוש כבר לקורס אחר';
$string['importformatnotimplement'] = 'מצטערים, יבוא תסדיר זה לא הושם עדיין!';
$string['incorrectext'] = 'לקובץ זה קיימת סיומת שגויה';
$string['installproblem'] = 'בדרך-כלל לא ניתן להתאושש משגיאות כאלו, יש ליצור מסד-נתונים חדש או להשתמש בתחילית שונה אם תרצה להמשיך בהתקנה.';
$string['internalauthpassworderror'] = 'חסרה סיסמה או מדיניות סיסמה איננה תקינה
עבור אימותים פנימיים';
$string['invalidaccess'] = 'לא ניתן לגשת לעמוד זה';
$string['invalidaccessparameter'] = 'משתנה גישה שגוי';
$string['invalidaction'] = 'משתנה פעולה שגוי';
$string['invalidactivityid'] = 'מספר זיהוי ID של הפעילות שגוי';
$string['invalidadminsettingname'] = 'הגדרות מנהל אינם חוקיות ({$a})';
$string['invalidargorconf'] = 'לא סופקו ארגומנטים תקינים  או הגדרת שרת שגויה';
$string['invalidarguments'] = 'לא סופקו ארגומנטים תקינים';
$string['invalidblockinstance'] = 'מופע משבצת איננו תקף עבור {$a}';
$string['invalidbulkenrolop'] = 'התבקשה פעולת רישום חתך שגויה';
$string['invalidcategory'] = 'קטגוריה איננה תקינה!';
$string['invalidcategoryid'] = 'ID הקטגוריה איננה תקינה';
$string['invalidcomment'] = 'הערה לא תקינה';
$string['invalidcommentarea'] = 'איזור הערה לא חוקי';
$string['invalidcommentid'] = 'id הערה לא חוקי';
$string['invalidcommentitemid'] = 'itemid הערה לא חוקי';
$string['invalidcommentparam'] = 'פרמטרים של הערה לא חוקיים';
$string['invalidcomponent'] = 'שם רכיב לא חוקי';
$string['invalidconfirmdata'] = 'נתוני הגדרות שגויים';
$string['invalidcontext'] = 'הקשר לא חוקי';
$string['invalidcourse'] = 'קורס לא חוקי';
$string['invalidcourseid'] = 'אתה מנסה להשתמש במספר ID של קורס לא חוקי';
$string['invalidcourselevel'] = 'context level שגוי';
$string['invalidcoursemodule'] = 'רכיב ID של קורס לא חוקי';
$string['invalidcoursenameshort'] = 'שם מקוצר של הקורס שגוי';
$string['invaliddata'] = 'הנתונים שהוכנסו שגויים';
$string['invaliddatarootpermissions'] = 'הרשאות שגויות נמצאו בספריית
$CFG->dataroot,
מנהל המערכת נדרש לתקן הרשאות אלו.';
$string['invaliddevicetype'] = 'סוג התקן אינו תקף';
$string['invalidelementid'] = 'element id! שגוי';
$string['invalidentry'] = 'ערך זה איננו תקף!';
$string['invalidevent'] = 'אירוע אינו תקף';
$string['invalidfieldname'] = '"{$a}" אינו שם תקף לשדה';
$string['invalidfiletype'] = '"{$a}" אינו סוג קובץ תקף';
$string['invalidformatpara'] = 'הפרמטר שנבחר לתצורת הקורס שגוי';
$string['invalidformdata'] = 'נתון הטופס שגוי';
$string['invalidfunction'] = 'מתודה שגוייה';
$string['invalidgradeitemid'] = 'ID פריט הציון שגוי';
$string['invalidgradeitmeid'] = 'ID פריט הציון שגוי';
$string['invalidgroupid'] = 'מספר זיהוי קבוצה שצויים איננו תקין';
$string['invalidipformat'] = 'תסדיר כתובת IP שגויה.';
$string['invaliditemid'] = 'מספר זיהוי פריט item id אינו תקין';
$string['invalidkey'] = 'מפתח אינו תקין';
$string['invalidlegacy'] = 'הגדרת תפקיד מורש לא תקינה  עבור סוג תפקיד: {$a}';
$string['invalidmd5'] = 'md5 לא חוקי';
$string['invalidmode'] = 'מצב ({$a}) אינו תקין';
$string['invalidmodule'] = 'רכיב אינו תקין';
$string['invalidmoduleid'] = 'מספר זיהוי הרכיב: {$a}  אינו תקין';
$string['invalidmodulename'] = 'שם הרכיב: {$a}  אינו תקין';
$string['invalidnum'] = 'ערך מספרי לא תקין';
$string['invalidnumkey'] = '$conditions array
עלול שלא להכיל מפתחות מספריים
אנא תקן את הקוד!';
$string['invalidoutcome'] = 'מספר זיהוי תוצאות אינו תקין';
$string['invalidpagesize'] = 'גודל עמוד איננו תקין';
$string['invalidpasswordpolicy'] = 'מדיניות סיסמה איננה תקינה';
$string['invalidpaymentmethod'] = 'שיטת התשלום: {$a} אינה תקינה';
$string['invalidqueryparam'] = 'שגיאה: פרמטרים של השאילת אינם תקנים. צפוי {$a->expected},
אך יש {$a->actual}.';
$string['invalidratingarea'] = 'איזור דירוג אינו תקף';
$string['invalidrecord'] = 'לא ניתן למצוא את רשומת הנתון בטבלה
{$a} במסד הנתונים.';
$string['invalidrecordunknown'] = 'לא ניתן למצוא את הרשומה ממסד הנתונים';
$string['invalidrequest'] = 'בקשה לא חוקית';
$string['invalidrole'] = 'תפקיד לא חוקי';
$string['invalidroleid'] = 'מספר זיהוי התפקיד שגוי';
$string['invalidscaleid'] = 'מספר זיהוי המשקל אינו תקין';
$string['invalidsection'] = 'רשומת רכיב הקורס מכיל יחידה שגויה';
$string['invalidsesskey'] = 'מפתח מושב שמוטען שגוי, לא ניתן לקבלו!';
$string['invalidshortname'] = 'זהו שם מקוצר לקורס ששגוי';
$string['invalidstatedetected'] = 'משהו השתבש: {$a} תהליך זה בדרך-כלל לא אמור לקרות.';
$string['invalidurl'] = 'URL לא חוקי';
$string['invaliduser'] = 'משתמש שגוי';
$string['invaliduserfield'] = 'שדה משתמש לא תקף: {$a}';
$string['invaliduserid'] = 'מספר זיהוי משתמש שגוי';
$string['invalidxmlfile'] = '"{$a}" אינו קובץ XML תקף';
$string['iplookupfailed'] = 'לא ניתן למצוא מידע הנוגע למיקום של כתובת IP זו לשם תצוגת המיקום של המשתמש על המפה הגאוגרפית העולמית.';
$string['iplookupprivate'] = 'לא ניתן להציג כתובת IP פרטית';
$string['ipmismatch'] = 'כתובת Client IP לא מתאים';
$string['listcantmovedown'] = 'כשלון בהעברת הפריט למטה משום שהוא האחרון ברשימה.';
$string['listcantmoveleft'] = 'כשלון בתזוזות הפריט שמאלה משום שאין לו אב.';
$string['listcantmoveright'] = 'כשלון בתזוזת הפריט ימינה. אין שום
שרת זמין  שניתן להופכו לבן. הזז אותו מתחת לשרת זהה עמדה אחר ואז תוכל להזזיזו ימינה.';
$string['listcantmoveup'] = 'כשלון בהעברת הפריט למעלה, משום שהוא הראשון ברשימה.';
$string['listnochildren'] = 'לא נמצאו הבנים של הפריט';
$string['listnoitem'] = 'הפריט לא נמצא';
$string['listnopeers'] = 'לא נמצאו שרתים מרוחקים עבור הפריט שנבחר';
$string['listupdatefail'] = 'פעולת מסד הנתונים נכשלה בעת עריכת ההירהרכיה.';
$string['logfilenotavailable'] = 'דוחות אינם זמינים';
$string['loginasnoenrol'] = 'אינך יכול להשתמש ב\'הירשם\' או \'בטל הרשמה\' כשאתה נמצא במושב "היכנסות למערכת" של הקורס.';
$string['loginasonecourse'] = 'כניסה לקורס זה אינה אפשרית<br />הינך מחובר כמשתמש אחר, עליך לסיים את פעילות ה"התחבר כ:" לפני שתוכל להיכנס לכל קורס אחר.';
$string['maxbytes'] = 'קובץ זה גדול מהגודל המירבי';
$string['messagingdisable'] = 'מסרים אינם מאופשרים באתר זה';
$string['mimetexisnotexist'] = 'המערכת שלך אינה מוגדרת כך שתוכל להריץ mimeTeX.
יש צורך להוריד את הגרסה המתאימה בכדי שהיא תרוץ בפלטפורמה PHP_OS
מאתר - <a href="http://moodle.org/download/mimetex/">http://moodle.org/download/mimetex/</a>,
או להשיג את קוד C מאתר -
<a href="http://www.forkosh.com/mimetex.zip"> http://www.forkosh.com/mimetex.zip</a>,
בצע קומפילציה ושים את קובץ ההרצה בספריית
moodle/filter/tex/.';
$string['mimetexnotexecutable'] = 'mimetex מותאם אישית אינו בר ביצוע';
$string['missing_moodle_backup_xml_file'] = 'חסר לגיבוי קובץ XML : {$a}';
$string['missingfield'] = 'שדה "{$a}" חסר';
$string['missingkeyinsql'] = 'שגיאה: חסר משתנה "{$a}" בשאילתה';
$string['missingparam'] = 'פרמטר שהיה נדרש ({$a}) חסר';
$string['missingparameter'] = 'פרמטר חסר';
$string['missingrequiredfield'] = 'חסר שדה נדרש כלשהו';
$string['missinguseranditemid'] = 'חסרים: userid ו- itemid';
$string['missingvarname'] = 'שם המשתנה הנדרש חסר!';
$string['mixedtypesqlparam'] = 'שגיאה: סוגים מעורבבים של פרמטרים משאילתת SQL';
$string['mnetdisable'] = 'MNET  לא מאופשר';
$string['mnetlocal'] = 'משתמשי MNET  מרוחקים לא יכולים להתחבר מקומית';
$string['moduledisable'] = 'רכיב זה ({$a}) לא מאופשר עבור קורס זה';
$string['moduledoesnotexist'] = 'רכיב זה איננו קיים';
$string['moduleinstancedoesnotexist'] = 'המופע של רכיב זה איננו קיים';
$string['modulemissingcode'] = 'ברכיב {$a} חסר הקוד הנדרש כדי לבצע פעולה זו';
$string['multiplerecordsfound'] = 'נמצאו רשומות כפולות , רק רשומה אחת מתקבלת.';
$string['multiplerestorenotallow'] = 'ביצוע של שחזורים מרובים איננו מאופשר!';
$string['mustbeloggedin'] = 'עליך להיות מחובר בכדי להמשיך לבצע פעולה זו';
$string['mustbeteacher'] = 'חובה עליך להיות מורה כדי לראות את עמוד זה';
$string['myisamproblem'] = 'טבלאות מסד הנתונים משתמשות במנוע מסד MyISAM, מומלץ להשתמש במנוע תואם של ACID  בעל תמיכה מלאה של עסקאות (transaction) כמו
InnoDB.';
$string['needcopy'] = 'עליך להעתיק משהו קודם לכן!';
$string['needcoursecategroyid'] = 'חובה לציין מספר קורס או קטגוריה';
$string['needphpext'] = 'עליך להוסיף תמיכת {$a}  עבור התקנת ה-PHP שלך';
$string['noadmins'] = 'לא נמצאו מנהלים';
$string['noblocks'] = 'לא נמצאו משבצות';
$string['nocapabilitytousethisservice'] = 'למשתמש אין מספיק יכולות נדרשות לצורך שימוש בשירות  זה';
$string['nocategorydelete'] = 'קטגורית \'{$a}\' לא ניתנת למחיקה!';
$string['nocontext'] = 'סליחה, אבל הקורס ההוא איננו הקשר תקף';
$string['nodata'] = 'לא נמצאו נתונים';
$string['noexistingcategory'] = 'לא נמצאו קטגוריות קיימות';
$string['nofile'] = 'הקובץ לא צויין';
$string['nofiltersenabled'] = 'אין מסננים מאופשרים';
$string['nofolder'] = 'תיקיות מבוקשות אינן קיימות';
$string['noformdesc'] = 'לא נמצא קובץ תיאור טופס  formslib
עבור פעילות זו.';
$string['noguest'] = 'לא נמצאו אורחים כאן!';
$string['noinstances'] = 'אין מופעים של {$a} בקורס זה!';
$string['nologinas'] = 'אינך מורשה להתחבר כמשתמש ההוא.';
$string['nonmeaningfulcontent'] = 'אינו תוכן בעל משמעות';
$string['noparticipants'] = 'לא נמצאו משתתפים עבור קורס זה';
$string['noparticipatorycms'] = 'סליחה, אבל אין לך רכיבי קורס שדורשים השתתפות לדווח עליהם.';
$string['nopermissions'] = 'פעולה זו אינה זמינה ללא הרשאות מתאימות ({$a})';
$string['nopermissiontocomment'] = 'לא ניתן להוסיף הערות';
$string['nopermissiontodelentry'] = 'לא ניתן למחוק רשומות של אנשים אחרים!';
$string['nopermissiontoeditcomment'] = 'לא ניתן לערוך הערות של אנשים אחרים!';
$string['nopermissiontohide'] = 'אין הרשאות להסתיר!';
$string['nopermissiontoimportact'] = 'אין לך הרשאות מתאימות לייבא פעילויות לקורס זה';
$string['nopermissiontolock'] = 'אין הרשאות לנעילה!';
$string['nopermissiontomanagegroup'] = 'אין לך הרשאות מתאימות לנהל קבוצות';
$string['nopermissiontorate'] = 'דירוגים של פריטים אינם מאופשרים!';
$string['nopermissiontoshow'] = 'אין מספיק הרשאות בכדי לצפות בזה!';
$string['nopermissiontounlock'] = 'אין מספיק הרשאות לבטל את הנעילה!';
$string['nopermissiontoupdatecalendar'] = 'לצערנו אין לך הרשאות מתאימות בכדי לעדכן אירוע יומן זה';
$string['nopermissiontoviewgrades'] = 'לא ניתן לצפות בציונים.';
$string['nopermissiontoviewletergrade'] = 'חסרות הרשאות לצפיה באותיות הציונים';
$string['nopermissiontoviewpage'] = 'יש לך הרשאה לצפות בעמוד זה';
$string['nosite'] = 'לא ניתן למצוא קורס הנמצא בראש הרשימה';
$string['nositeid'] = 'לא קיים ID של האתר';
$string['nostatstodisplay'] = 'מצטערים, אין מידע זמין להציג';
$string['notallowedtoupdateprefremotely'] = 'יש לך הרשאה לעדכן את מאפיני המשתמש מרחוק';
$string['notavailable'] = 'כרגע זה לא זמין';
$string['notlocalisederrormessage'] = '{$a}';
$string['notmemberofgroup'] = 'אינך חבר בקבוצת קורס זו';
$string['notownerofkey'] = 'אינך בעל מפתח זה';
$string['nousers'] = 'לא קיים משתמש כזה!';
$string['onlyadmins'] = 'רק מנהלים יכולים לעשות את זה';
$string['onlyeditingteachers'] = 'רק מורים עורכים יכולים לעשות את זה';
$string['onlyeditown'] = 'אתה יכול לערוך את המידע שלך בלבד';
$string['orderidnotfound'] = 'ID ההזמנה {$a} לא נמצאה';
$string['pagenotexist'] = 'חלה שגיאה לא רגילה (ניסה להגיע לעמוד שלא קיים)';
$string['pathdoesnotstartslash'] = 'לא סופקו ערכי משתנה תקניים, הנתיב אינו מתחיל בלוכסן!';
$string['pleasereport'] = 'אם יש לך זמן, אנא הודע לנו מה ניסית לעשות כאשר חלה השגיאה:';
$string['pluginrequirementsnotmet'] = 'לא ניתן היה להתקין את התוסף "{$a->pluginname}" ({$a->pluginversion}). התקנתו דורשת גירסה עדכנית יותר של מוודל (כרגע אתה משתמש ב- {$a->currentmoodle}, אתה צריך את {$a->requiremoodle}).';
$string['prefixcannotbeempty'] = '<p> שגיאה: קידומת טבלת המסד נתונים לא יכולה להיות ריקה
({$a})</p> <p> על מנהל המערכת לתקן זאת. <p>';
$string['prefixtoolong'] = '<p> שגיאה: קידומת טבלת המסד נתונים ארוכה מידי
({$a})</p> <p> על מנהל המערכת לתקן זאת. <p>
האורך המירבי של הקידומת מוכרח להיות
{$a->dbfamily} is {$a->maxlength} characters.</p>';
$string['processingstops'] = 'עיבוד נגמר כאן, תוך התעלמות מהרשומות הנותרות.';
$string['protected_cc_not_supported'] = 'מחסניות שמורות לא נתמכות';
$string['redirecterrordetected'] = 'התגלתה שיטת הפניית דף אינטרנט שאינה תקינה, הפועלה בוטלה';
$string['refoundto'] = 'ניתן לקבל זיכוי ל {$a}';
$string['refoundtoorigi'] = 'ניתן זיכוי לסכום המקורי: {$a}';
$string['remotedownloaderror'] = 'הורדת הרכיב לשרת שלך כשלה, אנא וודא את הגדרות ה-proxy שלך. תוספת PHP cURL מומלצת מאוד להתקנה.
<br /><br />
הינך צריך להוריד את קובץ ההדרכה <a href="{$a->url}">{$a->url}</a> ולהעתיק אותו ל "{$a->dest}"
בשרת שלך ולכווץ אותו שם.';
$string['remotedownloadnotallowed'] = 'לא מורשה הורדה של רכיבים לשרת שלך (פונקצייתallow_url_fopen מנוטרלת).<br /><br />עליך להוריד את קובץ ה<a href="{$a->url}">{$a->url}</a> באופן ידני, להעתיק אותו לתוך "{$a->dest}" בשרת שלך, ולפתוח אותו שם.';
$string['reportnotavailable'] = 'סוג דוח מידע זה זמין אך ורק לאתר הקורס';
$string['requireloginerror'] = 'לא ניתן לגשת לקורס או לפעילות';
$string['restore_path_element_missingmethod'] = 'שיטת שחזור {$a} חסרה. עליה להיות מוגדרת על-ידי מפתח האתר.';
$string['restore_path_element_noobject'] = 'אובייקט שחזור {$a} איננו אובייקט';
$string['restorechecksumfailed'] = 'כמה בעיות התגלו עם המידע ששוחזר באחסון המושב שלך (session). אנא בדוק את זיכרון ה-PHP שלך או הגבלות גודל חבילת  מסד הנתונים שלך. השחזור הופסק.';
$string['restrictedcontextexception'] = 'מצטערים, ביצוע מתודות חיצוניות גורם להגבלת ההקשר
ה- context';
$string['restricteduser'] = 'מצטערים אבל חשבונך הנוכחי "{$a}" מוגבל מלעשות זאת.';
$string['reverseproxyabused'] = 'שירות Reverse Proxy פעיל,
לא ניתן לגשת לשרת באופן ישיר.
<br />
אנא צרו קשר עם מנהל המערכת.';
$string['rpcerror'] = 'אופס! תקשורת ה-MNET שלך נכשלה!
להלן הודעת השגיאה שעליך להעביר למנהל המערכת :
{$a}';
$string['scheduledbackupsdisabled'] = 'גיבויים מתוכננים נוטרלו ע"י מנהל המערכת';
$string['secretalreadyused'] = 'שינוי קישור אישור הסיסמה כבר נעשה, הסיסמה לא שונתה';
$string['sectionnotexist'] = 'יחידה זו איננה קיימת';
$string['sendmessage'] = 'שלח הודעה';
$string['servicedonotexist'] = 'השירות איננו קיים';
$string['sessioncookiesdisable'] = 'שימוש לא נכון ב- require_key_login() עוגיות המושב חייבות להיות מנוטרלות';
$string['sessiondiskfull'] = 'מקום האחסון בדיסק מלא! ולכן לא ניתן להתחבר למערכת. יש לפנות למנהל המערכת.';
$string['sessionerroruser'] = 'לא הייתם פעילים במערכת מזה זמן רב, אנא התחברו למערכת שוב';
$string['sessionerroruser2'] = 'נתגלתה שגיאה של השרת שמשפיעה של מושב ההתחברות שלך. אנא התחבר שוב, או התחל מחדש את השרת שלך.';
$string['sessionipnomatch'] = 'סליחה, אבל נראה כי מספר ה-IP שלך השתנה מאז הפעם הראשונה שהתחברת למערכת. תכונת אבטחה זו מונעת מהאקרים לגנוב את הזהות שלך בזמן שאתה מחובר לאתר. משתמשים רגילים לא אמורים לראות את ההודעה הזו - אנא בקש עזרה ממנהל האתר שלך.';
$string['sessionipnomatch2'] = 'מצטערים, מספר ה-IP שלך כנראה השתנה מהפעם הראשונה שהתחברת. מאפיין אבטחה זה מונע מנוכלים להשתלט על זהותך בהתחברות לאתר. יתכן כי תראה את הודעה זו בעת גלישה ממקומות ציבוריים או בתקשורת אלחוטית. אנא בקש עזרה ממנהל המערכת.
<br /><br /> אם תרצה להמשיך אנא לחץ על מקש ה-F5  לרענן את עמוד זה.';
$string['sessionwaiterr'] = 'פסק הזמן בעת המתנה למושב (session). <br /> המתן בקשות הנוכחיות בכדי לסיים אותו ולנסות שוב מאוחר יותר.';
$string['shortnametaken'] = 'השם המקוצר נמצא כבר בשימוש לקורס אחר';
$string['socksnotsupported'] = 'SOCKS5 proxy לא נתמך ב-PHP4';
$string['spellcheckernotconf'] = 'בדיקת האיות לא הוגדרה';
$string['sslonlyaccess'] = 'מטעמי אבטחה רק קידומות חיבור של https מאופשרות.';
$string['statscatchupmode'] = 'נכון לעכשיו הסטטיסטיקה נמצאת באופן פעולה catchup. עד כה {$a->daysdone} ימים עובדו ו- {$a->dayspending} עומדים להיות מעובדים. בידקו שוב בקרוב!';
$string['statsdisable'] = 'סטטיסטיקות אינן מאופשרות';
$string['statsnodata'] = 'לא קיים מידע זמין עבור שילוב של הקורס ותקופת הזמן .';
$string['storedfilecannotcreatefiledirs'] = 'לא ניתן לייצר ליכוד של ספריות, אנא בדוק את הרשאות בספריית ה-
dataroot';
$string['storedfilecannotread'] = 'לא ניתן לקרוא את הקובץ, כנראה שהקובץ לא קיים או שקיימת בעיית הרשאות.';
$string['storedfilenotcreated'] = 'לא ניתן ליצור את הקובץ
"{$a->contextid}/{$a->component}/{$a->filearea}/{$a->itemid}/{$a->filepath}/{$a->filename}"';
$string['storedfileproblem'] = 'תקלה לא ברורה הקשורה לקבצים מקומיים
({$a})';
$string['tagdisabled'] = 'תגים ותחומי העניין
אינם מאופשרים';
$string['tagnotfound'] = 'התג המתואר לא נמצא במסד הנתונים';
$string['targetdatabasenotempty'] = 'מסד הנתונים המיועד אינו ריק.
ההעברה הופסקה מסיבות אבטחה';
$string['textconditionsnotallowed'] = 'השוואת תנאי עמודות טקסט לא מאופשרת. אנא השתמש ב-
sql_compare_text() בשאילתה שלך';
$string['themenotinstall'] = 'ערכת נושא זו איננה מותקנת';
$string['tokengenerationfailed'] = 'לא ניתן ליצור אסימון חדש';
$string['transactionvoid'] = 'העסקה לא יכולה להיות מבוטלת מפני שהיא כבר בוטלה';
$string['unenrolerror'] = 'חלה שגיאה בזמן נסיון הסרת רישום של משתמש זה';
$string['unicodeupgradeerror'] = 'אנו מצטערים אך בסיס הנתונים שלך עדיין לא כתוב ב- Unicode, וגירסה זו של מוודל לא מסוגלת להמיר את בסיס הנתונים שלך ל-Unicode. אנא שדרג למוודל 1.7.x תחילה ובצא את ההמרה ל-Unicode מעמוד ההנהלה. לאחר שזה נעשה, לא אמורה להיות לך כל בעיה בהמרה למוודל Moodle {$a}.';
$string['unknowaction'] = 'פעולה לא ידועה!';
$string['unknowcategory'] = 'קטגוריה לא ידועה!';
$string['unknowcontext'] = 'זהו הקשר לא ידועה ({$a})
ב
get_child_contexts!';
$string['unknowformat'] = 'תסדיר אינו ידועה ({$a})';
$string['unknownbackupexporterror'] = 'שגיאה לא ידועה, מכין מידע עבור יבוא';
$string['unknownblockregion'] = 'תחום משבצת \'{$a}\'  לא מוכר בעמוד זה';
$string['unknowncontext'] = 'זהו הקשר לא ידוע';
$string['unknowncourse'] = 'קורס לא ידוע בשם "{$a}"';
$string['unknowncourseidnumber'] = 'מספר זהות הקורס "{$a}" לא ידוע';
$string['unknowncourserequest'] = 'בקשת קורס לא ידועה';
$string['unknownfiletype'] = 'שגיאה בסוג קובץ filtertype  שאינו ידוע';
$string['unknowngroup'] = 'קבוצת "{$a}" לא ידועה';
$string['unknownhelp'] = 'נושא עזרה לא ידוע
{$a}';
$string['unknownjsinrequirejs'] = 'לא ניתן למצוא את סיפריית ה-JS :
{$a}';
$string['unknownmodulename'] = 'שם רכיב אינו ידוע עבור הטופס';
$string['unknownrole'] = 'תפקיד "{$a}" לא ידוע';
$string['unknownsortcolumn'] = 'עמודת סידור אינה ידועה
{$a}';
$string['unknownuseraction'] = 'סליחה, אני לא מבין את הפעולה של המשתמש הזה.';
$string['unknownuserselector'] = 'בורר המשתמשים לא ידוע';
$string['unknoworder'] = 'סידור לא ידוע';
$string['unknowparamtype'] = 'סוג ערך המשתנה לא ידוע:
{$a}';
$string['unknowquestiontype'] = 'סוג שאלה לא נתמך
{$a}';
$string['unknowuploadaction'] = 'שגיאה: פעולת העלאת קובץ אינה ידועה ({$a})';
$string['unspecifycourseid'] = 'חובה לציין מספר זיהוי ID של הקורס, שם מקוצר או
idnumber';
$string['unsupportedevent'] = 'סוג האירוע אינו נתמך';
$string['unsupportedstate'] = 'מצב ההשלמה אינו ידוע';
$string['unsupportedwebserver'] = 'תוכנת ה-  Web server
({$a})
איננה נתמכת';
$string['upgraderequires19'] = 'שגיאה:
גרסת Moodle חדשה הותקנה בשרת,  אך למרבה הצער שדרוג מהגירסה הקודמת לא נתמך.
<br />
אנא שדרך קודם כל לגרסת  1.9.x .
תוכל לחזור לגירסה הקודמת עלידי תקנה מחדש של הקבצים המקוריים.';
$string['upgraderunning'] = 'האתר נמצא בשדרוג,
אנא נסה שנית מאוחר יותר.';
$string['urlnotdefinerss'] = 'כתובת האינטרנט איננה מוגדרת להזנת RSS';
$string['useradmineditadmin'] = 'רק מנהלי המערכת יכולים לשנות משתמשים אחרים המוגדרים כמנהלי מערכת';
$string['useradminodelete'] = 'לא ניתן למחוק את משתמש מנהל המערכת';
$string['userautherror'] = 'התקן אוטומטי לא ידוע';
$string['userauthunsupported'] = 'התקן אוטומטי לא נתמך';
$string['useremailduplicate'] = 'כתובת קיימת';
$string['usermustbemnet'] = 'משתמשים ברשימת שליטת גישה של MNET חייבים להיות משתמשי MNET';
$string['usernotaddederror'] = 'משתמש "{$a}" לא התווסף - טעות';
$string['usernotaddedregistered'] = 'משתמש "{$a}" לא התווסף - כבר רשום';
$string['usernotavailable'] = 'הפרטים של משתמש זה לא זמינים לך.';
$string['usernotdeletedadmin'] = 'המשתמש לא נמחק, אין אפשרות למחוק מנהלים';
$string['usernotdeletederror'] = 'משתמש לא ימחק - שגיאה.';
$string['usernotdeletedmissing'] = 'משתמש לא נמחק - מחיקה איננה מורשית.';
$string['usernotdeletedoff'] = 'משתמש לא נמחק - מחיקה איננה מורשית.';
$string['usernotincourse'] = 'משתמש זה לא רשום לקורס זה!';
$string['usernotrenamedadmin'] = 'לא ניתן לשנות שם חשבון מנהל המערכת.';
$string['usernotrenamedexists'] = 'שם המשתמש לא שונה -- שם המשתמש החדש כבר נמצא בשימוש.';
$string['usernotrenamedmissing'] = 'שם המשתמש לא שונה -- שם המשתמש הישן לא נמצא.';
$string['usernotrenamedoff'] = 'לא שונה שם המשתמש  - שינוי שם לא מורשה.';
$string['usernotupdatedadmin'] = 'לא ניתן לעדכון חשבונות מנהלי מערכת.';
$string['usernotupdatederror'] = 'משתמש לא עודכן - שגיאה.';
$string['usernotupdatednotexists'] = 'משתמש לא עודכן - לא קיים.';
$string['userquotalimit'] = 'הגעת לגבול המירבי של הקצאת גודל הקובץ שלך.';
$string['userselectortoomany'] = 'user_selector קיבל יותר ממשתמש נבחר  אחד, למרות זאת בחירה מרובה היא בעלת ערך false.';
$string['wrongcall'] = 'תסריט זה נקרא בצורה שגויה';
$string['wrongcontextid'] = 'Context ID אינו תקין
(לא ניתן למצוא אותו)';
$string['wrongdestpath'] = 'נתיב יעד שגוי.';
$string['wrongroleid'] = 'מספר זיהוי rol id  אינו תקין';
$string['wrongsourcebase'] = 'מקור בסיס URL שגוי';
$string['wrongusernamepassword'] = 'שם משתמש/סיסמה שגויה';
$string['wrongzipfilename'] = 'שם קובץ ZIP שגוי.';
$string['wscouldnotcreateecoursenopermission'] = 'WS- לא ניתן ליצור את הקורס
אין הרשאות לכך.';
$string['wwwrootmismatch'] = 'התגלתה גישה שגויה, שרת זה יכול לגשת רק באמצעות כתובת "{$a}" .

<br />
אנא דווחו למנהל המערכת.';
$string['wwwrootslash'] = 'נמצא כי  המשתנה
$CFG->wwwroot בקובץ  config.php
איננו תקין. אסור לו להכיל  לוכסן עוקב.
<br />
אנא דווחו למנהל המערכת.';
$string['xmldberror'] = 'שגיאת XMLDB';
$string['youcannotdeletecategory'] = 'לא ניתן למחוק את קטגוריית \'{$a}\' מפני שאינך יכול למחוק תכנים או להזיזם למקום אחר.';
