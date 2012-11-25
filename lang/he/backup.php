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
 * Strings for component 'backup', language 'he', branch 'MOODLE_22_STABLE'
 *
 * @package   backup
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['autoactivedescription'] = 'בחר האם להפעיל גיבויים אוטומטיים או לא. אם נעשת בחירה ידנית, גיבויים אוטומטיים יאופשרו רק דרך הגיבויים האוטומטיים של תסריט CLI.
הדב ניתן לביצוע באופן ידני דרך שורת הפקודה או דרך cron.';
$string['autoactivedisabled'] = 'מנע';
$string['autoactiveenabled'] = 'אפשר';
$string['autoactivemanual'] = 'ידני';
$string['automatedbackupschedule'] = 'לוח זמנים';
$string['automatedbackupschedulehelp'] = 'בחר באיזה יום בשבוע תרצה להפעיל את הגיבוי האוטומטי';
$string['automatedbackupsinactive'] = 'גיבויים מתוכננים לא ניתנים לאפשור ע"י מנהל המערכת';
$string['automatedbackupstatus'] = 'מצב גיבוי מתוכנן';
$string['automatedsettings'] = 'הגדרות גיבוי אוטומטיות';
$string['automatedsetup'] = 'הגדרת גיבוי אוטומטית';
$string['automatedstorage'] = 'אחסון גיבוי אוטומטי';
$string['automatedstoragehelp'] = 'בחר את המיקום בו יאוחסנו הגיבויים כאשר יווצרו בצורה אוטומטית.';
$string['backupactivity'] = 'פעילות גיבוי: {$a}';
$string['backupcourse'] = 'קורס גיבוי {$a}';
$string['backupcoursedetails'] = 'פרטי הקורס';
$string['backupcoursesection'] = 'יחידה: {$a}';
$string['backupcoursesections'] = 'יחידות הקורס';
$string['backupdate'] = 'תאריך תחילת הגיבוי';
$string['backupdetails'] = 'פרטי הגיבוי';
$string['backupdetailsnonstandardinfo'] = 'קובץ הגיבוי שנבחר נוצר בגרסה קודמת של מערכת מוודל Moodle. תהליך השחזור ינסה להמיר את קובץ גיבוי זה לקובץ גיבוי תקני (MBZ) ולאחר מכן ינסה לשחזרו.';
$string['backupformat'] = 'תבנית';
$string['backupformatimscc1'] = 'IMS Common Cartridge 1.0';
$string['backupformatimscc11'] = 'IMS Common Cartridge 1.1';
$string['backupformatmoodle1'] = 'Moodle 1';
$string['backupformatmoodle2'] = 'Moodle 2';
$string['backupformatunknown'] = 'תסדיר לא ידוע';
$string['backupmode'] = 'מצב';
$string['backupmode10'] = 'כללי';
$string['backupmode20'] = 'יבוא';
$string['backupmode30'] = 'Hub';
$string['backupmode40'] = 'שם האתר';
$string['backupmode50'] = 'אוטומטי';
$string['backupmode60'] = 'הומר';
$string['backupsection'] = 'יחידת קורס הגיבוי: {$a}';
$string['backupsettings'] = 'הגדרות הגיבוי';
$string['backupsitedetails'] = 'פרטי האתר';
$string['backupstage16action'] = 'המשך';
$string['backupstage1action'] = 'הבא';
$string['backupstage2action'] = 'הבא';
$string['backupstage4action'] = 'ביצוע הגיבוי';
$string['backupstage8action'] = 'המשך';
$string['backuptype'] = 'סוג';
$string['backuptypeactivity'] = 'פעילות';
$string['backuptypecourse'] = 'קורס';
$string['backuptypesection'] = 'יחידה';
$string['backupversion'] = 'גרסת הגיבוי';
$string['cannotfindassignablerole'] = 'תפקיד ה-{$a} בקובץ הגיבוי לא יכול להיות ממופה לכל אחד מהתפקידים שאתה יכול להקצות.';
$string['choosefilefromactivitybackup'] = 'איזור גיבוי הפעילות';
$string['choosefilefromactivitybackup_help'] = 'כאשר משתמשים בגיבוי פעילויות כברירת מחדל, קבצי הגיבוי יאוחסנו כאן.';
$string['choosefilefromautomatedbackup'] = 'גיבויים אוטומטיים';
$string['choosefilefromautomatedbackup_help'] = 'מכיל גיבויים שנוצרו בצורה אוטומטית.';
$string['choosefilefromcoursebackup'] = 'איזור גיבוי הקורס';
$string['choosefilefromcoursebackup_help'] = 'כאשר משתמשים בגיבוי קורסים כברירת מחדל, קבצי הגיבוי יאוחסנו כאן.';
$string['choosefilefromuserbackup'] = 'מאגר הגיבויים אישי שלך';
$string['choosefilefromuserbackup_help'] = 'כאשר גיבויי הקורסים בעלי אפשור הגדרת "המרת פרטי מידע המשתמש לאנונימי" , קבצי הגיבוי יאוחסנו כאן.';
$string['configgeneralactivities'] = 'הגדרת ברירת מחדל עבור הכללת פעילויות בגיבוי.';
$string['configgeneralanonymize'] = 'אם מאפשרים , כל המידע הקשור למשתמשים יהפוך לאנונימי כברירת מחדל.';
$string['configgeneralblocks'] = 'הגדרות ברירת מחדל לכלול משבצות (בלוקים) בגיבוי.';
$string['configgeneralcomments'] = 'הגדרות ברירת מחדל לכלול הערות בגיבוי.';
$string['configgeneralfilters'] = 'הגדרות ברירת מחדל לכלול מסננים בגיבוי.';
$string['configgeneralhistories'] = 'הגדרות ברירת מחדל לכלול היסטורית משתמש בגיבוי.';
$string['configgenerallogs'] = 'אם דוחות מעקב מאופשרים הם יכללו בגיבויים כברירת מחדל';
$string['configgeneralroleassignments'] = 'אם מאפשרים כברירת מחדל, גם מינויי תפקידים יכללו בגיבויים';
$string['configgeneralusers'] = 'הגדרות ברירת מחדל לכלול משתמשים בגיבוי';
$string['configgeneraluserscompletion'] = 'אם מאפשרים, המידע הסופי של המשתמשים יכלל בגיבויים כברירת מחדל.';
$string['configloglifetime'] = 'הדבר יגדיר  את משך הזמן שתרצה לשמור את מידע יומני המעקב של הגיבויים. יומי מעקב ישנים יותר ימחקו באופן אוטומטי. מומלץ לשמור את ערך זה נמוך, מכיוון שגודלם  של יומני המעקב של הגיבויים עלולים להיות גדולים מאוד.';
$string['confirmcancel'] = 'בטל גיבוי';
$string['confirmcancelno'] = 'הישאר';
$string['confirmcancelquestion'] = 'האם אתה בטוח כי ברצונך לבטל? כל מידע שהכנסת כאן  לא ישמר.';
$string['confirmcancelyes'] = 'בטל';
$string['confirmnewcoursecontinue'] = 'אזהרת קורס חדשה';
$string['confirmnewcoursecontinuequestion'] = 'קורס זמני ( מוסתר) יווצר על-ידי תהליך השחזור של הקורס. בכדי לבטל שחזור זה יש ללחוץ על ביטול. נא לא לצאת מהדפדפן בזמן השחזור.';
$string['coursecategory'] = 'הקטגוריה בה הקורס יהיה ממוקם';
$string['courseid'] = 'ID מקורי';
$string['coursesettings'] = 'הגדרות קורס';
$string['coursetitle'] = 'כותרת';
$string['currentstage1'] = 'הגדרות תחיליות';
$string['currentstage16'] = 'הושלם';
$string['currentstage2'] = 'הגדרות סכמה';
$string['currentstage4'] = 'הגדרות תצורה וסקירה';
$string['currentstage8'] = 'בצע גיבוי';
$string['dependenciesenforced'] = 'ההגדרות שלך שונו בעקבות תלות ה-unmet';
$string['enterasearch'] = 'הכנס חיפוש';
$string['errorfilenamemustbezip'] = 'שם הקובץ שהכנסת חייב להיות קובץ ZIP וחייבת להיות לו תוספת mbz.';
$string['errorfilenamerequired'] = 'חובה להזין שם קובץ תקין  עבור הגיבוי הזה';
$string['errorinvalidformat'] = 'תסדיר קובץ הגיבוי אינו תקין';
$string['errorinvalidformatinfo'] = 'קובץ הגיבוי שנבחר אינו קובץ תקין של מערכת Moodle ולכן לא ניתן לשחזר אותו';
$string['errorminbackup20version'] = 'קובץ גיבוי זה נוצר עם גרסת פיתוח אחת של Moodle ({$a->backup}).
דרישות מינימליות הן {$a->min}. לא ניתר לשחזר';
$string['errorrestorefrontpage'] = 'שדרוג על-גבי העמוד הראשי לא אפשרי.';
$string['executionsuccess'] = 'קובץ הגיבוי נוצר בהצלחה';
$string['filename'] = 'שם הקובץ';
$string['generalactivities'] = 'כלול פעילויות';
$string['generalanonymize'] = 'מידע אנונימי';
$string['generalbackdefaults'] = 'ברירות מחדל לגיבוי ידני של קורס';
$string['generalblocks'] = 'כלול משבצות (בלוקים)';
$string['generalcomments'] = 'כלול הערות';
$string['generalfilters'] = 'כלול מסננים';
$string['generalgradehistories'] = 'כלול היסטוריות';
$string['generalhistories'] = 'כלול היסטוריות';
$string['generallogs'] = 'כלול דוחות מעקב';
$string['generalroleassignments'] = 'כלול מינויי תפקידים';
$string['generalsettings'] = 'הגדרות גיבוי כלליות';
$string['generalusers'] = 'כלול משתמשים';
$string['generaluserscompletion'] = 'הכללת מידע משתמש שהושלם';
$string['importbackupstage16action'] = 'המשך';
$string['importbackupstage1action'] = 'הבא';
$string['importbackupstage2action'] = 'הבא';
$string['importbackupstage4action'] = 'בצע יבוא';
$string['importbackupstage8action'] = 'המשך';
$string['importcurrentstage0'] = 'בחירת קורס';
$string['importcurrentstage1'] = 'הגדרות התחלתיות';
$string['importcurrentstage16'] = 'הושלם';
$string['importcurrentstage2'] = 'הגדרות סכמה';
$string['importcurrentstage4'] = 'אישור ותצוגה';
$string['importcurrentstage8'] = 'ביצוע יבוא';
$string['importfile'] = 'יבוא קובץ גיבוי';
$string['importsuccess'] = 'היבוא הושלם. לחץ המשך לחזור לקורס';
$string['includeactivities'] = 'כלול:';
$string['includeditems'] = 'פריטים כלולים:';
$string['includesection'] = 'יחידה {$a}';
$string['includeuserinfo'] = 'מידע המשתמש';
$string['locked'] = 'האם לאלץ?';
$string['lockedbyconfig'] = 'הגדרה זו ננעלה ע"י הגדרות ברירות המחדל של הגיבוי';
$string['lockedbyhierarchy'] = 'ננעל כתוצאה מתלות בהגדרה קודמת';
$string['lockedbypermission'] = 'אין לך הרשאות מתאימות כדי לשנות הגדרה זו';
$string['loglifetime'] = 'שמור יומני מעקב למשך';
$string['managefiles'] = 'ניהול קבצי הגיבוי';
$string['moodleversion'] = 'גרסת Moodle';
$string['moreresults'] = 'קיימות במערכת קטגוריות נוספות, ניתן לאחזר אותן על ידי חיפוש...';
$string['nomatchingcourses'] = 'אין קורסים להצגה';
$string['norestoreoptions'] = 'לא נמצאו קטגוריות או קורסים קיימים אשר ניתן לשחזר אליהם';
$string['originalwwwroot'] = 'גיבוי ה-URL';
$string['previousstage'] = 'קודם';
$string['qcategory2coursefallback'] = 'קטגוריית השאלות "{$a->name}"
במקור בהקשר קטגוריה
system/course בקובץ הגיבוי, תיווצר בהקשר הקורס על-ידי השחזור';
$string['qcategorycannotberestored'] = 'קטגוריית השאלות "{$a->name}" לא ניתנת ליצירה על-ידי השחזור';
$string['question2coursefallback'] = 'קטגוריית השאלות "{$a->name}"
במקור בהקשר קטגוריה
system/course בקובץ הגיבוי, תיווצר בהקשר הקורס על-ידי השחזור';
$string['questionegorycannotberestored'] = 'השאלות "{$a->name}" לא יכולות להיווצר על-ידי השחזור';
$string['restoreactivity'] = 'שחזור פעילות';
$string['restorecourse'] = 'שחזור קורס';
$string['restorecoursesettings'] = 'הגדרות קורס';
$string['restoreexecutionsuccess'] = 'הקורס שוחזר בהצלחה, לחיצה על קישור "המשך" תוביל אותך לצפיה בקורס שזה הרגע שחזרת.';
$string['restorenewcoursefullname'] = 'שם קורס חדש';
$string['restorenewcourseshortname'] = 'שם קצר חדש לקורס';
$string['restorenewcoursestartdate'] = 'תאריך התחלה חדש';
$string['restorerolemappings'] = 'שחזור מיפוי תפקיד';
$string['restorerootsettings'] = 'הגדרות שחזור';
$string['restoresection'] = 'יחידת שחזור';
$string['restorestage1'] = 'אישור';
$string['restorestage16'] = 'סקירה';
$string['restorestage16action'] = 'בצע שחזור';
$string['restorestage1action'] = 'הבא';
$string['restorestage2'] = 'יעד';
$string['restorestage2action'] = 'הבא';
$string['restorestage32'] = 'תהליך';
$string['restorestage32action'] = 'המשך';
$string['restorestage4'] = 'הגדרות';
$string['restorestage4action'] = 'הבא';
$string['restorestage64'] = 'הושלם';
$string['restorestage64action'] = 'המשך';
$string['restorestage8'] = 'סכמה';
$string['restorestage8action'] = 'הבא';
$string['restoretarget'] = 'יעד השחזור';
$string['restoretocourse'] = 'שחזר לקורס:';
$string['restoretocurrentcourse'] = 'שחזר לקורס זה';
$string['restoretocurrentcourseadding'] = 'מזג את גיבוי הקורס אל תוך קורס זה';
$string['restoretocurrentcoursedeleting'] = 'מחק את התכנים של קורס זה ולאחר מכן שחזר';
$string['restoretoexistingcourse'] = 'שחזר לתוך קורס קיים';
$string['restoretoexistingcourseadding'] = 'מזג את גיבוי הקורס אל תוך הקורס הקיים';
$string['restoretoexistingcoursedeleting'] = 'מחק את התכין של הקורס הקיים ולאחר מכן שחזר';
$string['restoretonewcourse'] = 'שחזר כקורס חדש';
$string['restoringcourse'] = 'שחזור הקורס מתבצע';
$string['restoringcourseshortname'] = 'משחזר';
$string['rootsettingactivities'] = 'כלול פעילויות';
$string['rootsettinganonymize'] = 'המרת פרטי מידע המשתמש לאנונימי';
$string['rootsettingblocks'] = 'כלול משבצות (בלוקים)';
$string['rootsettingcalendarevents'] = 'הכללת אירועי לוח-שנה';
$string['rootsettingcomments'] = 'כלול הערות';
$string['rootsettingfilters'] = 'כלול מסננים';
$string['rootsettinggradehistories'] = 'כלול היסטוריית ציונים';
$string['rootsettingimscc1'] = 'המר ל-IMS Common Cartridge 1.0';
$string['rootsettingimscc11'] = 'המר ל-IMS Common Cartridge 1.1';
$string['rootsettinglogs'] = 'כלול יומני מעקב של הקורס';
$string['rootsettingroleassignments'] = 'כלול מנויי תפקידים של המשתמש';
$string['rootsettings'] = 'הגדרות גיבוי';
$string['rootsettingusers'] = 'כלול משתמשים  רשומים';
$string['rootsettinguserscompletion'] = 'הכללת פרטי המשתמש שהושלם';
$string['sectionactivities'] = 'פעילויות';
$string['sectioninc'] = 'נכלל בגיבוי (ללא מידע משתמש)';
$string['sectionincanduser'] = 'נכלל בגיבוי יחד עם מידע המשתמש';
$string['selectacategory'] = 'בחר קטגוריה';
$string['selectacourse'] = 'בחר קורס';
$string['setting_course_fullname'] = 'שם קורס';
$string['setting_course_shortname'] = 'שם קצר לקורס';
$string['setting_course_startdate'] = 'תאריך תחילת הקורס';
$string['setting_keep_groups_and_groupings'] = 'השאר את הקבוצות ואוספי הקבוצות הנוכחיים';
$string['setting_keep_roles_and_enrolments'] = 'השאר את התפקידים וההרשמות הנוכחיים';
$string['setting_overwriteconf'] = 'עקיפת תצורת הקורס';
$string['storagecourseandexternal'] = 'איזור קובץ גיבוי הקורס ונתיב הספרייה המצויינת';
$string['storagecourseonly'] = 'איזור קבצי גיבוי הקורס';
$string['storageexternalonly'] = 'ציין מיקום ספרייה עבור גיבויים אוטומטיים';
$string['totalcategorysearchresults'] = 'סך-כל קטגוריות {$a}';
$string['totalcoursesearchresults'] = 'קורסים {$a}';
