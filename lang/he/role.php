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
 * Strings for component 'role', language 'he', branch 'MOODLE_22_STABLE'
 *
 * @package   role
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addinganewrole'] = 'הוספת תפקיד חדש';
$string['addingrolebycopying'] = 'הוספת תפקיד חדש מבוסס על {$a}';
$string['addrole'] = 'הוסף  תפקיד חדש';
$string['advancedoverride'] = 'עקיפת תפקיד מתקדם';
$string['allow'] = 'אפשר';
$string['allowassign'] = 'ניהול הקצאת תפקידים';
$string['allowed'] = 'מותר';
$string['allowoverride'] = 'ניהול עקיפת תפקידים';
$string['allowroletoassign'] = 'אפשר משתמשים עם תפקיד {$a->fromrole}
להקצות לתפקיד
{$a->targetrole}';
$string['allowroletooverride'] = 'אפשר למשתמשים עם תפקיד
{$a->fromrole}
לעקוף את התפקיד
{$a->targetrole}';
$string['allowroletoswitch'] = 'אפשר למשתמשים עם תפקיד
{$a->fromrole} להחליף  תפקידים לתפקיד
{$a->targetrole}';
$string['allowswitch'] = 'ניהול החלפת תפקידים';
$string['allsiteusers'] = 'כל משתמשי האתר';
$string['archetype'] = 'אב טיפוס לתפקידים';
$string['archetype_help'] = 'ה-archetype של התפקיד קובע את ההרשאות כאשר התפקיד מאופס לברירת המחדר.
זה גם קובע כל הרשאה חדשה עבור התפקיד כאשר האתר בשדרוג.';
$string['archetypecoursecreator'] = 'אב טיפוס: יוצר קורסים';
$string['archetypeeditingteacher'] = 'אב טיפוס: מורה (עורך)';
$string['archetypefrontpage'] = 'אב טיפוס: יוצר קורסיםמשתמש מאומת על הדף הראשון';
$string['archetypeguest'] = 'אב טיפוס: אורח';
$string['archetypemanager'] = 'אב טיפוס: מנהל';
$string['archetypestudent'] = 'אב טיפוס: תלמיד';
$string['archetypeteacher'] = 'אב טיפוס: מורה (לא עורך)';
$string['archetypeuser'] = 'אב טיפוס: משתמש מאומת';
$string['assignanotherrole'] = 'הקצא תפקיד נוסף';
$string['assignedroles'] = 'תפקידים מוקצים';
$string['assignerror'] = 'שגיאה בעת הקצאה לתפקיד {$a->role}
עבור המשתמש
{$a->user}';
$string['assignglobalroles'] = 'הקצאת תפקידים מערכתיים';
$string['assignmentcontext'] = 'הקשר ההקצאה';
$string['assignmentoptions'] = 'אפשרויות ההקצאה';
$string['assignrole'] = 'הקצא תפקיד';
$string['assignrolenameincontext'] = 'הקצה תפקיד \'{$a->role}\' ב- {$a->context}';
$string['assignroles'] = 'תפקידים והרשאות';
$string['assignroles_help'] = '**מינוי אנשים לתפקידים**

על ידי כך שאתם ממנים משתמש לתפקיד בתוך הקשר מסויים, אתם מעניקים לו את ההרשאות לגשת למשאבים שמגיעים עם התפקיד בהקשר הנוכחי, ובכל ההקשרים ה"נמוכים יותר".

הקשרים:
1.אתרמערכת
2.קטגוריות של קורסים
3.קורסים
4.משבצות ופעילויות


למשל, אם תעניקו למשתמש כלשהו את תפקיד הסטודנט בקורס מסויים, התפקיד יחול עליו בתוך הקורס, וגם בכל הפעילויות והבלוקים שמתקיימים באותו הקורס. אבל יכול להיות, שהרשאות הגישה שלו יהיו תלויות בתפקידים וסמכויות אחרות שכבר הוגדרו מראש.
';
$string['assignrolesin'] = 'הקצאת תפקידים ב {$a}';
$string['assignrolesrelativetothisuser'] = 'הקצה תפקידים הקשורים למשתמש זה';
$string['backtoallroles'] = 'החזרה לרשימת התפקידים';
$string['backup:anonymise'] = 'נתוני משתמש אנונימי  על הגיבוי';
$string['backup:backupactivity'] = 'פעיליות גיבוי';
$string['backup:backupcourse'] = 'גבה קורסים';
$string['backup:backupsection'] = 'יחידות גבויי';
$string['backup:backuptargethub'] = 'גיבוי עבור שרת Hub';
$string['backup:backuptargetimport'] = 'גבה בעבור יצוא';
$string['backup:configure'] = 'הגדר אפשרויות הגיבוי';
$string['backup:downloadfile'] = 'הורדת קבצים מאיזור הגיבוי';
$string['backup:userinfo'] = 'גיבוי מידע המשתמש';
$string['block:edit'] = 'עריכת הגדרות משבצות';
$string['block:view'] = 'צפה במשבצת־ניהול';
$string['blog:associatecourse'] = 'ידיעות בלוג המקושרות לקורסים';
$string['blog:associatemodule'] = 'ידיעות בלוג המקושרות לרכיבי פעילות';
$string['blog:create'] = 'צור רשומות חדשות בבלוג';
$string['blog:manageentries'] = 'ערוך ונהל את הרשומות';
$string['blog:manageexternal'] = 'עריכה וניהול בלוגים חיצוניים';
$string['blog:manageofficialtags'] = 'ניהול תגים מערכתיים';
$string['blog:managepersonaltags'] = 'נהל תגים אישיים';
$string['blog:search'] = 'חיפוש ידיעות בלוג';
$string['blog:view'] = 'צפה ברשומות בלוג';
$string['blog:viewdrafts'] = 'צפיה בטיוטות של ידיעות הבלוג';
$string['calendar:manageentries'] = 'נהל כל רשומות בלוח-השנה';
$string['calendar:managegroupentries'] = 'נהל רשומות קבוצה בלוח-השנה';
$string['calendar:manageownentries'] = 'נהל את רשומותי בלוח-שנה';
$string['capabilities'] = 'יכולות';
$string['capability'] = 'יכולת:';
$string['category:create'] = 'צור קטגוריות';
$string['category:delete'] = 'מחק קטגוריות';
$string['category:manage'] = 'נהל קטגוריות';
$string['category:update'] = 'עדכן קטגוריות';
$string['category:viewhiddencategories'] = 'הראה קטגוריות נסתרות';
$string['category:visibility'] = 'ראה קטגוריות מוסתרות';
$string['checkglobalpermissions'] = 'בדיקת הרשאות המערכת';
$string['checkpermissions'] = 'בדיקת הרשאות';
$string['checkpermissionsin'] = 'בדיקת הרשאות ב {$a}';
$string['checksystempermissionsfor'] = 'בדיקת הרשאות מערכת ב {$a}';
$string['checkuserspermissionshere'] = 'בדיקת הרשאות עבור {$a->fullname}
כשהוא ב- {$a->contextlevel}';
$string['chooseroletoassign'] = 'אנא בחרו תפקיד להקצאה';
$string['cohort:assign'] = 'הוסף והסר חברים בקבוצה מערכתית';
$string['cohort:manage'] = 'צור, מחק והזז קבוצות מערכתיות';
$string['cohort:view'] = 'צפה בקבוצות מערכתיות המתפרסות על כל האתר';
$string['comment:delete'] = 'מחק הערות';
$string['comment:post'] = 'שלח הערות';
$string['comment:view'] = 'קרא הערות';
$string['community:add'] = 'השתמשו במשבצת חיפוש שרתי קורסים hubs ציבוריים לחיפוש קורסים';
$string['community:download'] = 'הורדת קורס בעזרת משבצת קורסים ציבוריים';
$string['confirmaddadmin'] = 'האם ברצונך להוסיף את המשתמש
<strong>{$a}</strong>
כמנהל מערכת חדש?';
$string['confirmdeladmin'] = 'האם ברצונך להסיר את המשתמש
<strong>{$a}</strong>  מרשימת מנהלי
מערכת האתר';
$string['confirmroleprevent'] = 'האם הינך בטוח כי ברצונך להסיר
<strong>{$a->role}</strong>
מרשימת התפקידים המאושרים ליכולת {$a->cap} בהקשר
{$a->context}?';
$string['confirmroleunprohibit'] = 'האם הינך בטוח כי ברצונך להסיר
<strong>{$a->role}</strong>
מרשימת התפקידים החסומים ליכולת {$a->cap} בהקשר
{$a->context}?';
$string['confirmunassign'] = 'האם הינך בטוח כי ברצונך להסיר את תפקיד זה ממשתמש זה?';
$string['confirmunassignno'] = 'בטל';
$string['confirmunassigntitle'] = 'אישור שינוי תפקיד';
$string['confirmunassignyes'] = 'הסר';
$string['context'] = 'הקשר';
$string['course:activityvisibility'] = 'הסתר או הראה פעילויות';
$string['course:bulkmessaging'] = 'שלח הודעה לאנשים רבים';
$string['course:changecategory'] = 'שנה קטגוריית קורס';
$string['course:changefullname'] = 'שנה את השם המלא של הקורס';
$string['course:changeidnumber'] = 'שנה את מספר הזיהוי של הקורס';
$string['course:changeshortname'] = 'שנה את השם המקוצר של הקורס';
$string['course:changesummary'] = 'שנה תקציר קורס';
$string['course:create'] = 'צור קורסים';
$string['course:delete'] = 'מחק קורסים';
$string['course:enrolconfig'] = 'הגדרת מופעי רישום בקורסים';
$string['course:enrolreview'] = 'סקירת הרשמות הקורס';
$string['course:manageactivities'] = 'נהל פעילויות';
$string['course:managefiles'] = 'נהל קבצים';
$string['course:managegrades'] = 'נהל ציונים';
$string['course:managegroups'] = 'נהל קבוצות';
$string['course:managescales'] = 'נהל את סולמות הציונים';
$string['course:markcomplete'] = 'סמן משתמשים כ"הושלם" בהשלמת הקורס';
$string['course:publish'] = 'פרסם קורס לשרת קורסים (hub)';
$string['course:request'] = 'בקש קורסים חדשים';
$string['course:reset'] = 'אפס קורס';
$string['course:sectionvisibility'] = 'ראות של קטע בקרה';
$string['course:setcurrentsection'] = 'קבע את הקטע הנוכחי';
$string['course:update'] = 'עדכן הגדרות קורס';
$string['course:useremail'] = 'הפעל או מנע כתובות דוא"ל';
$string['course:view'] = 'צפה בקורסים ללא השתתפותך';
$string['course:viewcoursegrades'] = 'ראה ציוני קורסים';
$string['course:viewhiddenactivities'] = 'ראה פעילויות מוסתרות';
$string['course:viewhiddencourses'] = 'ראה קורסים מוסתרים';
$string['course:viewhiddensections'] = 'ראה קטעים מוסתרים';
$string['course:viewhiddenuserfields'] = 'ראה שדות משתמשים מוסתרים';
$string['course:viewparticipants'] = 'ראה משתתפים';
$string['course:viewscales'] = 'ראה את סולמות הציונים';
$string['course:visibility'] = 'הסתר או הראה קורסים';
$string['createrolebycopying'] = 'צור תפקיד חדש על-ידי העתקת {$a}';
$string['createthisrole'] = 'צור את התפקיד הזה';
$string['currentcontext'] = 'הקשר נוכחי';
$string['currentrole'] = 'תפקיד נוכחי';
$string['defaultrole'] = 'תפקיד ברירת המחדל';
$string['defaultx'] = 'ברירת מחדל: {$a}';
$string['defineroles'] = 'הגדרת תפקידים';
$string['deletecourseoverrides'] = 'מחק את כל הקצאות התפקידים המקומיות בקורס';
$string['deletelocalroles'] = 'מחק את כל הקצאות התפקידים המקומיות';
$string['deleterolesure'] = 'האם אתה בטוח שאתה רוצה למחוק את התפקיד "{$a->name} ({$a->shortname})"?</p><p>) נכון לרגע זה, {$a->count} משתמשים ממונים לתפקיד זה.';
$string['deletexrole'] = 'מחק תפקיד {$a}';
$string['duplicaterole'] = 'תפקיד כפול';
$string['duplicaterolesure'] = 'האם אתה בטוח שברצונך  לשכפל את התפקיד "{$a->name} ({$a->shortname})"?</p>';
$string['editingrolex'] = 'עריכת תפקיד \'{$a}\'';
$string['editrole'] = 'עריכת תפקיד';
$string['editxrole'] = 'עריכת תפקיד {$a}';
$string['errorbadrolename'] = 'שם תפקיד שגוי';
$string['errorbadroleshortname'] = 'שם תפקיד שגוי';
$string['errorexistsrolename'] = 'שם התפקיד כבר קיים';
$string['errorexistsroleshortname'] = 'שם התפקיד כבר קיים';
$string['existingadmins'] = 'מנהלי מערכת האתר הנוכחיים';
$string['existingusers'] = '{$a} משתמשים קיימים';
$string['explanation'] = 'הסבר';
$string['extusers'] = 'משתמשים קיימים';
$string['extusersmatching'] = 'משתמשים קיימים שנמצאו \'{$a}\'';
$string['filter:manage'] = 'ניהול הגדרות מסנן מקומיות';
$string['frontpageuser'] = 'משתמש מאומת בעמוד הבית';
$string['frontpageuserdescription'] = 'כל המשתמשים המחוברים בעמוד הבית של הקורס';
$string['globalrole'] = 'תפקיד מערכתי';
$string['globalroleswarning'] = 'אזהרה! כל התפקידים שתחלק מעמוד זה יהיו תקפים לגבי המשתמשים בכל רחבי האתר, כולל בעמוד הראשי וכל הקורסים.';
$string['gotoassignroles'] = 'גש ל הקצאת תפקידים עבור
{$a->contextlevel}';
$string['gotoassignsystemroles'] = 'גש להקצאת תפקידי מערכת';
$string['grade:edit'] = 'עריכת ציונים';
$string['grade:export'] = 'יצא ציונים';
$string['grade:hide'] = 'הסתר/גלה ציונים או פריטים';
$string['grade:import'] = 'יבא ציונים';
$string['grade:lock'] = 'נעל ציונים או פריטים';
$string['grade:manage'] = 'נהל פריטי ציון';
$string['grade:managegradingforms'] = 'ניהול שיטות מתן ציון מתקדמות בעזרת מחוונים';
$string['grade:manageletters'] = 'נהל ציוני אותיות';
$string['grade:manageoutcomes'] = 'נהל תוצאות ציונים';
$string['grade:managesharedforms'] = 'ניהול תבניות טפסים מתקדות של מתן ציון';
$string['grade:override'] = 'עקיפת ציונים';
$string['grade:sharegradingforms'] = 'שיתוף טופס מתן ציון מתקדם כתבנית';
$string['grade:unlock'] = 'הסר נעילת ציונים או פריטים';
$string['grade:view'] = 'צפה בציונים שלך';
$string['grade:viewall'] = 'צפה בציונים של משתמשים אחרים';
$string['grade:viewhidden'] = 'צפה בציונים מוסתרים של';
$string['hidden'] = 'נסתר';
$string['highlightedcellsshowdefault'] = 'ההרשאות המסומנות בטבלה למטה הן ברירת המחדל המסתמכים על סוג תפקיד הנבחר  למעלה.';
$string['highlightedcellsshowinherit'] = 'התאים המסומנים בטבלה למטה מציגים את ההרשאות (אם ישנן) אשר ינתנו בירושה. מעבר ליכולות של אלו הרשאות תרצו לשנות, יש צורך להשאיר הכל בהגדרת ירושה.';
$string['inactiveformorethan'] = 'בטל פעילות עבור יותר מ {$a->timeperiod}';
$string['ingroup'] = 'בקבוצה "{$a->group}"';
$string['inherit'] = 'לרשת';
$string['legacy:admin'] = 'תפקיד מורש: מנהל';
$string['legacy:coursecreator'] = 'תפקיד מורש: יוצר קורס';
$string['legacy:editingteacher'] = 'תפקיד מורש: מורה (עורך)';
$string['legacy:guest'] = 'תפקיד מורש: אורח';
$string['legacy:student'] = 'תפקיד מורש: סטודנט';
$string['legacy:teacher'] = 'תפקיד מורש: מורה (לא עורך)';
$string['legacy:user'] = 'תפקיד מורש: משתמש מאומת';
$string['legacytype'] = 'סוג תפקיד מורש';
$string['listallroles'] = 'רשום ברשימה את כל התפקידים';
$string['localroles'] = 'הקצאת תפקידים';
$string['mainadmin'] = 'ניהול מערכת ראשי';
$string['mainadminset'] = 'הגדרת ניהול מערכת ראשי';
$string['manageadmins'] = 'ניהול מנהלי המערכת';
$string['manager'] = 'מנהל';
$string['managerdescription'] = 'מנהלים יכולים לגשת לקורס ולשנות אותו , בדרך-כלל הם אינם משתתפים בקורס.';
$string['manageroles'] = 'ניהול תפקידים';
$string['maybeassignedin'] = 'סוגי הקשר כאשר תפקיד זה יכול להיות מוקצה';
$string['morethan'] = 'יותר מ{$a}';
$string['multipleroles'] = 'קבוצות מרובות';
$string['my:configsyspages'] = 'הגדר תבניות מערכת עבור דפי
ה-Moodle שלי';
$string['my:manageblocks'] = 'נהל את';
$string['neededroles'] = 'תפקידים בעלי הרשאות';
$string['nocapabilitiesincontext'] = 'אין יכולות זמינות בהקשר זה.';
$string['noneinthisx'] = 'אף אחד כאן {$a}';
$string['noneinthisxmatching'] = 'לא נמצאו תוצאות  משתמשים
\'{$a->search}\'
ב-
{$a->contexttype}';
$string['noroleassignments'] = 'למשתמש זה אין אף הקצאת תפקיד באתר כולו.';
$string['noroles'] = 'אין תפקידים';
$string['notabletoassignroleshere'] = 'אין באפשרותך להקצות תפקידים';
$string['notabletooverrideroleshere'] = 'אין באפשרותך לערוף הרשאות באף תפקיד כאן';
$string['notes:manage'] = 'נהל מסרים';
$string['notes:view'] = 'צפה במסרים';
$string['notset'] = 'לא מוגדר';
$string['overrideanotherrole'] = 'עקיפת תפקיד נוסף';
$string['overridecontext'] = 'עקיפת הקשר';
$string['overridepermissions'] = 'עקוף הרשאות';
$string['overridepermissions_help'] = '**עקיפות**
עקיפות הן למעשה הרשאות מסוימות שמתוכננות לעקוף תפקיד כלשהוא בהקשר מסוים ובכך מאפשרות לכם להתאים ולכוון את ההרשאות שלך.

לדוגמא: נניח שמשתמשים בעלי תפקיד של סטודנט בקורס שלכם יכולים, בדרך כלל, לפתוח בדיונים חדשים בפורומים וישנו פורום אחד בו הייתם רוצים להגביל את היכולת הזו. במצב כזה אתם יכולים להגדיר \'עקיפה\' שלוקחת מהסטודנטים את היכולת "לפתוח בדיונים חדשים".
ניתן להשתמש בעקיפות גם כדי \'לפתוח\' איזורים באתר ובקורסים שלכם במטרה לתת למשתמשים היתרים נוספים. לדוגמא, יכול להיות שתירצו להתנסות ולתת לסטודנטים את היכולת לבדוק, להעריך ולתת ציון למטלות מסויימות.

ממשק זה דומה לממשק המשמש להגדרת התפקידים מלבד העובדה שלפעמים מוצגות בו רק יכולות רלוונטיות. בנוסף כמה מהיכולות יופיעו כאשר הן מודגשות וזאת כדי להראות לכם מה תהיה ההרשאה של התפקיד המדובר ללא עקיפה פעילה (כלומר, כאשר העקיפה מכוונת ל"לרשת").
';
$string['overridepermissionsforrole'] = 'עקיפת הרשאות עבור תפקיד
\'{$a->role}\' ב- {$a->context}';
$string['overridepermissionsin'] = 'עקוף הרשאות ב{$a}';
$string['overrideroles'] = 'עקוף את התפקידים';
$string['overriderolesin'] = 'עקוף תפקידים ב{$a}';
$string['overrides'] = 'עקיפות';
$string['overridesbycontext'] = 'עוקף (על-ידי הקשר)';
$string['permission'] = 'הרשאה';
$string['permission_help'] = '**הרשאות**
הרשאות הן ההגדרות שאתם מעניקים ליכולות מסויימות.

לדוגמא, יכולת אחת היא "פתח בדיונים חדשים" (בפורומים).

בכל תפקיד אתם יכולים להחליט להגדיר את ההרשאה (ליכולת) כערך אחד מתוך ארבעת הערכים הבאים:
לרשת
: לרוב זוהי ההגדרה שמשמשת כברירת המחדל. זוהי הגדרה ניטרלית שמשמעותה "השתמש בכל הגדרה שכבר יש למשתמש". אם משתמש כלשהוא ממונה לתפקיד (למשל בקורס) בעל הרשאה זו ליכולת כלשהיא, אז ההרשאה הממשית שלו פשוט תהיה זהה להרשאה שכבר יש לו ברמות הגבוהות יותר (למשל קטגוריות או רמת האתר). בסופו של דבר, אם בשום רמה לא ניתנת למשתמש הרשאה אז לא תהיה לו שום הרשאה ליכולת ההיא.
אפשר
: כשאתם בוחרים בזה, אתם למעשה נותנים לאנשים שממונים לתפקיד זה הרשאה ליכולת זו.
הרשאה זו תקפה להקשר שתפקיד זה מקבל בנוסף לכל ההקשרים ה"נמוכים יותר".
לדוגמא, אם תפקיד זה הוא תפקיד של תלמיד המוקצה לקורס, אז תלמידים יוכלו "להתחיל דיונים חדשים" בכל הפרומים בקורס המדובר, אלא אם כן פורומים מסויימים מכילים עקיפות סמכות או מטלות חדשות עם ערך \'מנע\' או \'אסור\' בנוגע ליכולת זו.
מנע
: אם אתם בוחרים בזה, אתם מסירים את כל ההרשאות ליכולת זו גם במידה ולמשתמשים שנמצאים בתפקיד זה הורשתה הרשאה זו בהקשר גבוה יותר.
לאסור
: ערך זה נדרש לעתים רחוקות אבל יכול להיות שלעתים תרצו למנוע לחלוטין הרשאות לתפקיד בדרך שלא יהיה ניתן לעקוף אותה בכל הקשר נמוך יותר. דוגמא טובה לאפשרות שבה תזדקקו לזה היא כאשר מנהל רוצה לאסור על אדם אחד להתחיל בדיונים חדשים בכל פורום בכל האתר. במקרה זה הוא יכול ליצור תפקיד בו יכולות זו (לפתוח בדיונים חדשים) מוגדרת כ-\'אסור\' ואז למנות את המשתמש לתפקיד זה בתוך ההקשר של האתר.


**פתרון קונפליקטים בין הרשאות**
הרשאות בהקשרים "נמוכים" יותר לרוב יעקפו כל דבר בהקשר "גבוה" יותר (הדבר תקף לעקיפות ומינויי תפקידים). היוצא מן הכלל הוא \'לאסור\', אותו אי אפשר לעקוף ברמות נמוכות יותר.

אם לאותו אדם ממונים שני תפקידים באותו ההקשר, אחד אם \'אפשר\' ואחד עם \'מנע\', איזה מהם מנצח? במקרה זה מוודל יערוך חיפוש בעץ ההקשרים אחר "מחליט".

לדוגמא, לתלמיד יש שני תפקידים בקורס, אחד שמאפשר לו לפתוח בדיונים חדשים ואחד שמונע זאת ממנו.
במקרה זה נבדוק את הקשרי הקטגוריות והאתר, כאשר אנו מחפשים אחר הרשאה מוגדרת אחרת שתעזור לנו להחליט.
אם לא נמצא אחת, אז לפי ברירת המחדל ההרשאה תהיה \'מנע\' (וזאת מפני ששתי ההגדרות ביטלו אחת את השניה ונשארנו ללא הרשאה.

**יוצאים מן הכלל**
שימו לב שלרוב חשבון משתמש אורח לא יוכל לפרסם תוכן (לדוגמא פורומים, רשומות בלוח השנה, בלוגים) אפילו אם ניתנת לו היכולת לעשות זאת.

';
$string['permissions'] = 'הרשאות';
$string['permissionsforuser'] = 'הרשאות עבור משתמש
{$a}';
$string['permissionsincontext'] = 'הרשאות ב {$a}';
$string['portfolio:export'] = 'יצוא לתיקי עבודות';
$string['potentialusers'] = '{$a} משתמשים זמינים';
$string['potusers'] = 'משתמשים זמינים';
$string['potusersmatching'] = 'משתמשים זמינים המכילים את  \'{$a}\'';
$string['prevent'] = 'מנע';
$string['prohibit'] = 'אסור';
$string['prohibitedroles'] = 'אסור';
$string['question:add'] = 'הוספת שאלה חדשה';
$string['question:config'] = 'צור סוגי שאלה';
$string['question:editall'] = 'ערוך את כל השאלות';
$string['question:editmine'] = 'ערוך את השאלות שלך';
$string['question:flag'] = 'סמן את השאלות בעת הנסיון לפותרן';
$string['question:managecategory'] = 'נהל קטגוריות של שאלות';
$string['question:moveall'] = 'הסט את כל השאלות';
$string['question:movemine'] = 'הסט את השאלות שלך';
$string['question:useall'] = 'השתמש בכל השאלות';
$string['question:usemine'] = 'השתמש בשאלות שלך';
$string['question:viewall'] = 'הראה את כל השאלות';
$string['question:viewmine'] = 'הראה את השאלות שלך';
$string['rating:rate'] = 'הוסף דירוגים עבור פריטים';
$string['rating:view'] = 'צפה בסך-כל הדירוגים שנתנו על-ידי משתמשים';
$string['rating:viewall'] = 'צפה בשורת הדירוגים שנתנה על-ידי משתמשים';
$string['rating:viewany'] = 'צפה בסך-כל הדירוגים שכל אחד קיבל';
$string['resetrole'] = 'אתחל מחדש לברירות המחדל';
$string['resetrolenolegacy'] = 'נקה את ההרשאות';
$string['resetrolesure'] = 'האם אתה בטוח שברצונך לאתחל לברירות המחדל את התפקיד "{$a->name} ({$a->shortname})" ?<p></p> ברירות המחדל נלקחות מיכולות הירושה הנבחרת ({$a->legacytype}).';
$string['resetrolesurenolegacy'] = 'האם אתה בטוח שברצונך לנקות את כל ההרשאות שמוגדרות לתפקיד זה תפקיד "{$a->name} ({$a->shortname})"?';
$string['restore:configure'] = 'הגדר אפשרויות שחזור';
$string['restore:createuser'] = 'יצירת משתמשים בשחזור';
$string['restore:restoreactivity'] = 'שחזר פעילויות';
$string['restore:restorecourse'] = 'שחזר קורסים';
$string['restore:restoresection'] = 'שחזר יחידות';
$string['restore:restoretargethub'] = 'שחזר מקבצים אשר מיועדים עבור שרת קורסים (hub)';
$string['restore:restoretargetimport'] = 'שחזר מקבצים אשר מיועדים ליבוא';
$string['restore:rolldates'] = 'מאפשר לגלול תאריכי הגדרת פעילות בשחזור';
$string['restore:uploadfile'] = 'העלה קבצים לאיזור הגיבויים';
$string['restore:userinfo'] = 'שחזר מידע משתמש';
$string['restore:viewautomatedfilearea'] = 'שחזר קורסים מהגיבויים האוטומטיים';
$string['risks'] = 'סיכונים';
$string['role:assign'] = 'הקצאת תפקידים למשתמשים';
$string['role:manage'] = 'יצירה וניהול תפקידים';
$string['role:override'] = 'עקוף את הרשאות המשתמשים';
$string['role:review'] = 'סקירת הרשאות עבור אחרים';
$string['role:safeoverride'] = 'עקוף הרשאות מוגנות עבור אחרים';
$string['role:switchroles'] = 'החלף לתפקידים אחרים';
$string['roleallowheader'] = 'אפשר תפקיד:';
$string['roleallowinfo'] = 'בחר בתפקיד שאותו תרצה להוסיף לרשימת התפקידים המאושרים בהקשר {$a->context},
וביכולת {$a->cap}:';
$string['roleassignments'] = 'הקצאות התפקידים';
$string['roledefinitions'] = 'הגדרות תפקיד';
$string['rolefullname'] = 'שם';
$string['roleincontext'] = '{$a->role} ב- {$a->context}';
$string['roleprohibitheader'] = 'אסור תפקיד';
$string['roleprohibitinfo'] = 'בחר בתפקיד שאותו תרצה להוסיף לרשימת התפקידים החסומים בהקשר {$a->context},
וביכולת {$a->cap}:';
$string['roles'] = 'תפקידים';
$string['roles_help'] = '**תפקידים**
תפקיד הוא אוסף של הרשאות שמוגדרות עבור האתר בכללותו, אותן אתם יכולים להעניק למשתמשים מסויימים בהקשרים מסויימים.

לדוגמא, יכול להיות לכם תפקיד שנקרא "מורה" שמוגדר כדי לאפשר למורים לעשות דברים מסויימים (ולא לאחרים). ברגע שתפקיד זה קיים, אתם יכולים להעניק אותו למישהו בקורס ובכך להפוך אותו ל"מורה" עבור אותו הקורס. בנוסף, אתם יכולים למנות לתפקיד הזה משתמש שנמצא בקטגוריית הקורס, ובכך להפוך אותו למורה עבור כל הקורסים שנמצאים באותה קטגוריה. או, למנות לתפקיד משתמש בתוך פורום יחידי, ובכך להעניק למשתמש הנ"ל את היכולות הללו רק במסגרת אותו הפורום.
חובה שיהיה לתפקיד **שם**. אם אתם צריכים לתת לתפקיד שם עבור מספר שפות שונות, אם אתם רוצים בכך אתם יכולים להשתמש בתחביר רב-שפות (multilang), לדוגמא:
Teacher
Profesor
אם אתם בוחרים לעשות זאת, וודאו שההגדרה "לסנן מחרוזות" מופעלת עבור ההתקנה שלכם.

**השם הקצר** הוא הכרחי עבור התקני תקע אחרים במוודל, שיכול להיות ויצטרכו להתייחס לתפקידים שלכם (למשל: בזמן העלאת משתמשים מתוך קובץ או הגדרת הרשמות דרך התקן תקע שמשמש להרשמה).
**התיאור** משמעותו פשוט לתאר את התפקיד במילים שלכם, כך שלכולם תהיה הבנה משותפת של אותו התפקיד.
';
$string['roleselect'] = 'בחירת תפקיד';
$string['rolesforuser'] = 'תפקידים עבור   {$a}';
$string['roleshortname'] = 'שם מקוצר (באנגלית!)';
$string['roletoassign'] = 'תפקיד שיש למנות אליו';
$string['roletooverride'] = 'תפקיד שיש לעקוף אותו';
$string['safeoverridenotice'] = 'הערה: יכולות עם סיכונים גבוהים נעולים מיכוון שאתה רשאי לעקוף רק יכולות מוגנות.';
$string['selectanotheruser'] = 'בחר משתמש אחר';
$string['selectauser'] = 'בחר משתמש';
$string['selectrole'] = 'בחר בתפקיד';
$string['showallroles'] = 'הראה את כל התפקידים';
$string['showthisuserspermissions'] = 'הצג הרשאות משתמש זה';
$string['site:accessallgroups'] = 'גש לכל הקבוצות';
$string['site:approvecourse'] = 'אשר יצירת קורס';
$string['site:backup'] = 'גבה את הקורס';
$string['site:config'] = 'שנה את הגדרות התצורה של האתר';
$string['site:doanything'] = 'מורשה לעשות הכל';
$string['site:doclinks'] = 'הראה קישורים למסמכים הנמצאים מחוץ לאתר';
$string['site:import'] = 'יבוא לתוך קורס קורסים אחרים';
$string['site:manageblocks'] = 'נהל את המשבצות ברמת האתר';
$string['site:mnetloginfromremote'] = 'התחבר למערכת מ-Moodle מרוחק';
$string['site:mnetlogintoremote'] = 'שוטט ל-Moodle מרוחק';
$string['site:readallmessages'] = 'קרא את כל ההודעות באתר';
$string['site:restore'] = 'שחזר קורסים';
$string['site:sendmessage'] = 'שליחת הודעות לכל משתמש';
$string['site:trustcontent'] = 'בטח בתוכן שהוגש';
$string['site:uploadusers'] = 'העלה מקובץ משתמשים חדשים';
$string['site:viewfullnames'] = 'תמיד ראה את שמם המלא של המשתמשים';
$string['site:viewparticipants'] = 'ראה משתתפים';
$string['site:viewreports'] = 'ראה דוחות';
$string['site:viewuseridentity'] = 'הצג זיהוי משתמש מלא ברשימות';
$string['siteadministrators'] = 'מנהלי המערכת';
$string['tag:create'] = 'צור תוויות חדשות';
$string['tag:edit'] = 'ערוך תוויות קיימות';
$string['tag:editblocks'] = 'ערוך משבצות־ניהול בדפי תוויות';
$string['tag:manage'] = 'נהל את כל התוויות';
$string['thisusersroles'] = 'הקצאת התפקיד של משתמש זה';
$string['unassignarole'] = 'הסרת הקצאת פקיד  {$a}';
$string['unassignconfirm'] = 'האם הינך בטוח כי ברצונך להסיר את הקצאת תפקיד  "{$a->role}" מהמשתמש
"{$a->user}"?';
$string['unassignerror'] = 'שגיאה בעת הסרת הקצאת תפקיד
{$a->role}
מהמשתמש
{$a->user}.';
$string['user:changeownpassword'] = 'שנה את הסיסמה שלך';
$string['user:create'] = 'צור משתמשים';
$string['user:delete'] = 'מחק משתמשים';
$string['user:editmessageprofile'] = 'ערוך פרופיל הודעות משתמש';
$string['user:editownmessageprofile'] = 'ערוך פרופיל הודעות של המשתמש שלך';
$string['user:editownprofile'] = 'ערוך את הפרופיל שלך';
$string['user:editprofile'] = 'ערוך פרופיל משתמש';
$string['user:loginas'] = 'התחבר כמשתמשים אחרים';
$string['user:manageblocks'] = 'נהל משבצות בפרופיל המשתמש של משתמשים אחרים';
$string['user:manageownblocks'] = 'נהל משבצות  בפרופיל המשתמש הציבורי שלך';
$string['user:manageownfiles'] = 'נהל קבצים באיזורי הקובץ הפרטי שלך';
$string['user:managesyspages'] = 'הגדר את תצורת העמוד כברירת המחדל עבור פרופילים של משתמשים ציבוריים';
$string['user:readuserblogs'] = 'ראה את כל הבלוגים של כל המשתמשים';
$string['user:readuserposts'] = 'ראה את כל הפירסומים של כל המשתמשים';
$string['user:update'] = 'עדכן את פרופילי משתמשים';
$string['user:viewalldetails'] = 'צפיה במידע המלא של המשתמש';
$string['user:viewdetails'] = 'ראה את פרופילי משתמשים';
$string['user:viewhiddendetails'] = 'ראה פרטי משתמשים מוסתרים';
$string['user:viewuseractivitiesreport'] = 'ראה את דוחות פעילות המשתמשים';
$string['user:viewusergrades'] = 'ראה את ציוני המשתמשים';
$string['usersfrom'] = 'משתמשים מ {$a}';
$string['usersfrommatching'] = 'משתמשים מ {$a->contextname} המתאימים
\'{$a->search}\'';
$string['usersinthisx'] = 'משתמשים ב {$a} זה';
$string['usersinthisxmatching'] = 'משתמשים ב {$a->contexttype}  זה המתאימים ל
\'{$a->search}\'';
$string['userswithrole'] = 'כל המשתמשים עם תפקיד';
$string['userswiththisrole'] = 'משתמשים בעלי תפקידים';
$string['useshowadvancedtochange'] = 'השתמש ב"הצג הגדרות מתקדמות" לשינוי';
$string['viewingdefinitionofrolex'] = 'צפיה בהגדרת תפקיד
\'{$a}\'';
$string['viewrole'] = 'ראה את פרטי התפקיד';
$string['webservice:createmobiletoken'] = 'יצירת אסימון web service עבור גישת ניידים';
$string['webservice:createtoken'] = 'יצירת אסימון web service';
$string['whydoesuserhavecap'] = 'מדוע ל {$a->fullname}
יש יכולת {$a->capability} בהקשר
{$a->context}?';
$string['whydoesusernothavecap'] = 'מדוע ל {$a->fullname} אין יכולת
{$a->capability} בהקשר {$a->context}?';
$string['xroleassignments'] = 'הקצאות תפקיד של
{$a}';
$string['xuserswiththerole'] = 'משתמשים שממונים לתפקיד "{$a->role}": {$a->number}';
