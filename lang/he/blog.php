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
 * Strings for component 'blog', language 'he', branch 'MOODLE_22_STABLE'
 *
 * @package   blog
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addnewentry'] = 'הוספת ידיעה חדשה';
$string['addnewexternalblog'] = 'רישום לבלוג חיצוני';
$string['assocdescription'] = 'הרשמה לבלוג חיצוני';
$string['associated'] = 'משוייך ל-{$a}';
$string['associatewithcourse'] = 'פרסום ידיעת בלוג המשוייכת לקורס זה {$a->coursename}';
$string['associatewithmodule'] = 'בלוג על
{$a->modtype}: {$a->modname}';
$string['association'] = 'ייחוס';
$string['associations'] = 'קורסים מקושרים';
$string['associationunviewable'] = 'ידיעה זו אינה ניתנת לצפיה על-ידי אחרים עד שהקורס יהיה מיוחס לו או ששדה ה-\'פרסם ל\' ישונה';
$string['autotags'] = 'הוסף תגיות אלו';
$string['autotags_help'] = 'הכנס תג אחד או יותר (מופרדים בפסיק) שתרצה להוסיף בצורה אוטומטית לכל ידיעה מועתק בבלוג מבלוג חיצוני לתוך הבלוג המקומי שלך.';
$string['backupblogshelp'] = 'אם מאופשר, בלוגים יכללו בגיבויים האוטומטים של האתר';
$string['blockexternalstitle'] = 'בלוגים חיצוניים';
$string['blocktitle'] = 'כותרת תגי הבלוג';
$string['blog'] = 'בלוג אישי';
$string['blogaboutthis'] = 'בלוג על {$a->type} זה';
$string['blogaboutthiscourse'] = 'הוספת ידיעה המשוייכת לקורס זה';
$string['blogaboutthismodule'] = 'הוספת פרסום {$a} המשויך לקורס זה';
$string['blogadministration'] = 'ניהול הבלוג';
$string['blogdeleteconfirm'] = 'למחוק בלוג זה?';
$string['blogdisable'] = 'בלוג לא מאופשר';
$string['blogentries'] = 'מונחי (ידיעות) הבלוג';
$string['blogentriesabout'] = 'ידיעות הבלוג השייכות ל {$a}';
$string['blogentriesbygroupaboutcourse'] = 'ידיעות הבלוג השייכות ל {$a->course} על-ידי
{$a->group}';
$string['blogentriesbygroupaboutmodule'] = 'ידיעות הבלוג השייכות ל {$a->mod} על-ידי
{$a->group}';
$string['blogentriesbyuseraboutcourse'] = 'ידיעות הבלוג השייכות ל{$a->course} על-ידי
{$a->user}';
$string['blogentriesbyuseraboutmodule'] = 'ידיעות  הבלוג על {$a->mod} זה על-ידי {$a->user}';
$string['blogentrybyuser'] = 'ידיעת הבלוג על-ידי {$a}';
$string['blogpreferences'] = 'קביעת העדפות הבלוג';
$string['blogs'] = 'בלוגים אישיים';
$string['blogscourse'] = 'בלוגי קורס';
$string['blogssite'] = 'בלוגי אתר';
$string['blogtags'] = 'תגי בלוגים';
$string['cannotviewcourseblog'] = 'אין לך מספיק הרשאות לצפות בבלוגים בקורס זה';
$string['cannotviewcourseorgroupblog'] = 'אין לך מספיק הרשאות לצפות בבלוגים בקורס/קבוצה זה';
$string['cannotviewsiteblog'] = 'אין לך מספיק הרשאות לצפות בבללוגים בכל האתר';
$string['cannotviewuserblog'] = 'אין לך מספיק הרשאות לקרוא בלוגים של משתמשים';
$string['configexternalblogcrontime'] = 'באיזו תדירות Moodle בודק את הבלוגים החיצוניים עבור ידיעות חדשות.';
$string['configmaxexternalblogsperuser'] = 'מספר הבלוגים החיצוניים שכל משתמש מורשה לשים קישור בבלוג שלהם באתר.';
$string['configuseblogassociations'] = 'מאפשר ייחוס (קישור) בין פרסום בבלוג האישי לרכיב או קורס אליו המשתמש רשום';
$string['configuseexternalblogs'] = 'מאפשר למשתמשים לציין הזנות בלוג חיצוניות. Moodle בודק הזנות אלו ומעתיק ידיעות חדשות לבלוג המקומי של משתמש זה.';
$string['courseblog'] = 'בלוג הקורס: {$a}';
$string['courseblogdisable'] = 'בלוגים של קורס לא מאופשרים';
$string['courseblogs'] = 'משתמשים יכולים לראות את הבלוגים של חבריהם לקורס בלבד';
$string['deleteblogassociations'] = 'מחק יחוסיי בלוג';
$string['deleteblogassociations_help'] = 'אם מסומן, ידיעות הבלוג לא תיוחסנה עם קורס זה או כל פעילות או משאב של קורס. ידיעות הבלוג עצמן לא תמחקנה.';
$string['deleteexternalblog'] = 'אל תרשום בלוג חיצוני זה';
$string['deleteotagswarn'] = 'האם אתה בטוח שברצונך להסיר את התג הזה (התגים הללו) <br /> מכל ההודעות שפורסמו בפורום ולהוציא אותו מתוך המערכת?';
$string['description'] = 'תיאור';
$string['description_help'] = 'הכנס משפט או שניים המסכם את תכני הבלוג החיצוני שלך. (אם לא יסופק תיאור, התיאור שנשמר בבלוג החיצוני שלך יועתק כאן)';
$string['disableblogs'] = 'מנע את מערכת הבלוגים לחלוטין';
$string['donothaveblog'] = 'בלוג אישי איננו קיים';
$string['editentry'] = 'ערוך את ידיעת הבלוג';
$string['editexternalblog'] = 'ערוך בלוג חיצוני';
$string['emptybody'] = 'אסור שגוף רשומת הבלוג יהיה ריק';
$string['emptyrssfeed'] = 'כתובת ה-URL שהכנסת לא מצביעה להזנת RSS תקינה';
$string['emptytitle'] = 'אסור שכותרת רשומת הבלוג תהיה ריקה';
$string['emptyurl'] = 'חובה לספק כתובת URL להזנת RSS תקינה';
$string['entrybody'] = 'גוף רשומת הבלוג';
$string['entrybodyonlydesc'] = 'תיאור הידיעה';
$string['entryerrornotyours'] = 'ידיעה זו איננה שלך';
$string['entrysaved'] = 'הידיעה שלך נשמרה';
$string['entrytitle'] = 'כותרת הידיעה';
$string['entryupdated'] = 'רשומת הבלוג עודכנה';
$string['externalblogcrontime'] = 'לוח זמנים של הבלוג החיצוני';
$string['externalblogdeleteconfirm'] = 'אל תרשום את הבלוג החיצוני הזה?';
$string['externalblogdeleted'] = 'הבלוג החיצוני לא נרשם';
$string['externalblogs'] = 'בלוגים חיצוניים';
$string['feedisinvalid'] = 'הזנה זו אינה תקינה';
$string['feedisvalid'] = 'הזנה זו תקינה';
$string['filterblogsby'] = 'ידיעות המסנן על-ידי...';
$string['filtertags'] = 'תגי מסנן';
$string['filtertags_help'] = 'תוכל להשתמש בתכונה זו לסנן את הידיעות שתרצה להשתמש. אם תציין תגים כאן (הפרד בפסיק) רק ידיעות עם תגים אלו יועתקו מהבלוג החיצוני.';
$string['groupblog'] = 'בלוג קבוצתי: {$a}';
$string['groupblogdisable'] = 'בלוג קבוצתי לא מאופשר';
$string['groupblogentries'] = 'ידיעות  לוג מיוחסים ל
{$a->coursename} על-ידי הקבוצה
{$a->groupname}';
$string['groupblogs'] = 'משתמשים יכולים לראות בלוגים של האנשים הנמצאים באותה קבוצה כמותם בלבד.';
$string['incorrectblogfilter'] = 'סוג מסנן בלוג שמצוייןו שגוי';
$string['intro'] = 'הזנת RSS זו נתחוללה אוטומטית על ידי בלוג אחד או יותר.';
$string['invalidgroupid'] = 'מספר זיהוי קבוצה שגוי';
$string['invalidurl'] = 'כתובת URL זו לא ניתנת להשגה';
$string['linktooriginalentry'] = 'קישור לידיעת בלוג מקורי';
$string['maxexternalblogsperuser'] = 'מספר מקסימלי של בלוגים חיצוניים עבור משתמש';
$string['mustassociatecourse'] = 'אם אתה מפרסם לקורס או לחברי הקבוצה. יש צורך לייחס קורס עם ידיעה זו';
$string['name'] = 'שם';
$string['name_help'] = 'הכנס שם תיאור עבור הבלוג החיצוני שלך (אם לא ניתן אף שם , הכותרת של הבלוג החיצוני שלך תופיע כאן).';
$string['noentriesyet'] = 'אין כאן ידיעות גלויות';
$string['noguestpost'] = 'אורחים לא יכולים לפרסם בלוגים!';
$string['nopermissionstodeleteentry'] = 'אין לך מספיק הרשאות למחיקת ידיעה בלוג זו';
$string['norighttodeletetag'] = 'אין לך אף זכות למחוק את התג הזה - {$a}';
$string['nosuchentry'] = 'אין ידיעת בלוג כזו';
$string['notallowedtoedit'] = 'אתה לא מורשה לערוך את הידיעה הזו';
$string['numberofentries'] = 'ידיעות: {$a}';
$string['numberoftags'] = 'מספר התגים להצגה';
$string['page-blog-edit'] = 'עמודי עריכת בלוג';
$string['page-blog-index'] = 'דפי רשומות הבלוג';
$string['page-blog-x'] = 'כל עמודי הבלוג';
$string['pagesize'] = 'מספר ידיעות הבלוגים שיופיעו בכל עמוד';
$string['permalink'] = 'קישור קבע';
$string['personalblogs'] = 'משתמשים יכולים לראות את הבלוג האישי שלהם בלבד';
$string['preferences'] = 'העדפות';
$string['publishto'] = 'הרשאות צפיה';
$string['publishto_help'] = 'יש כאן שלוש הגדרות אפשריות
**עצמכם (טיוטא)** - רק אתם וההנהלה יכולים לראות את הידיעה הזו.
**כל אחד שרשום לאתר הזה** - כל מי שרשום לאתר הזה יכול לקרוא את הידיעה הזו.
**כל אחד בעולם** - כולם, כולל אורחים, יכולים לקרוא את הידיעה הזו.';
$string['publishtocourse'] = 'משתמשים משתפים קורס איתך';
$string['publishtocourseassoc'] = 'חברים בקורס המיוחס';
$string['publishtocourseassocparam'] = 'משתמשים של {$a}';
$string['publishtogroup'] = 'משתמשים משתפים קבוצה איתך';
$string['publishtogroupassoc'] = 'חברי הקבוצה שלך עם הקורס המיוחס';
$string['publishtogroupassocparam'] = 'חברי הקבוצה שלך ב {$a}';
$string['publishtonoone'] = 'לעצמך בלבד';
$string['publishtosite'] = 'כל אחד באתר זה';
$string['publishtoworld'] = 'כל אחד בעולם (ציבורי)';
$string['readfirst'] = 'קרא זאת קודם לכן';
$string['relatedblogentries'] = 'ידיעות בלוג קשורות';
$string['retrievedfrom'] = 'חזר מ';
$string['rssfeed'] = 'הזנות RSS של הבלוג';
$string['searchterm'] = 'חיפוש: {$a}';
$string['settingsupdatederror'] = 'חלה שגיאה, לא ניתן היה לעדכן את הגדרת קביעת ההעדפה של הבלוג.';
$string['siteblog'] = 'בלוג האתר: {$a}';
$string['siteblogdisable'] = 'בלוג האתר לא מאופשר';
$string['siteblogs'] = 'כל המשתמשים באתר יכולים לראות את כל ידיעות הבלוגים';
$string['tagdatelastused'] = 'התאריך האחרון שבו נעשה שימוש בתג';
$string['tagparam'] = 'תגים: {$a}';
$string['tags'] = 'תגים';
$string['tagsort'] = 'מיין את תצוגת התגים לפי';
$string['tagtext'] = 'טקסט (תמליל) התג';
$string['timefetched'] = 'זמן סנכרון אחרון';
$string['timewithin'] = 'הצג את התגים שנעשה בהם שימוש בטווח זה של ימים';
$string['updateentrywithid'] = 'מעדכן את הידיעה';
$string['url'] = 'URL';
$string['url_help'] = 'הכנס כתובת הזנת RSS עבור הבלוג החיצוני שלך';
$string['useblogassociations'] = 'אפשר ייחוסי בלוג';
$string['useexternalblogs'] = 'אפשר בלוגים חיצוניים';
$string['userblog'] = 'בלוג משתמש: {$a}';
$string['userblogentries'] = 'ידיעות בלוג על-ידי {$a}';
$string['valid'] = 'בר-תוקף';
$string['viewallblogentries'] = 'כל הידיעות על {$a}  זה';
$string['viewallmodentries'] = 'צפה בכל הידיעות על {$a->type} זה';
$string['viewallmyentries'] = 'תצוגת כל הידיעות';
$string['viewblogentries'] = 'ידיעות בלוג על {$a->type} זה';
$string['viewblogsfor'] = 'צפה בכל ידיעות הבלוג ל...';
$string['viewcourseblogs'] = 'תצוגת ידיעות בלוגים המשויכות לקורס זה';
$string['viewentriesbyuseraboutcourse'] = 'צפה בידיעות בלוג על הקורס על-ידי {$a}';
$string['viewgroupblogs'] = 'צפה בידיעות בלוג עבור קבוצה...';
$string['viewgroupentries'] = 'ידיעות בלוג הקבוצה';
$string['viewmodblogs'] = 'צפה בידיעות בלוג עבור רכיבים';
$string['viewmodentries'] = 'ידיעות בלוג הרכיבים';
$string['viewmyentries'] = 'ראה את הידיעות שלי';
$string['viewmyentriesaboutcourse'] = 'ידיעות הבלוג שלי המשויכות לקורס זה';
$string['viewmyentriesaboutmodule'] = 'צפה בידיעות בלוג עבור {$a} זה';
$string['viewsiteentries'] = 'תצוגת ידיעות כל המשתמשים';
$string['viewuserentries'] = 'צפה בכל ידיעות הבלוג השייכות ל {$a}';
$string['worldblogs'] = 'העולם כולו יכול לקרוא את הידיעות שהוגדרו כ\'נגישות לעולם\'.';
$string['wrongpostid'] = 'מספר זהות הפרסום של הבלוג שגוי';
