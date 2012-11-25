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
 * Strings for component 'scorm', language 'he', branch 'MOODLE_22_STABLE'
 *
 * @package   scorm
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['activation'] = 'הפעלה';
$string['activityloading'] = 'תועבר חזרה אוטומטית לפעילות';
$string['activitypleasewait'] = 'הפעילות נטענת, אנא המתן...';
$string['adminsettings'] = 'הגדרות ניהוליות';
$string['advanced'] = 'פרמטרים';
$string['allowapidebug'] = 'הפעל את ניפוי ומעקב ה-API (הגדר את מסכת הלכידה עם apidebugmask)';
$string['allowtypeexternal'] = 'אפשר סוג חבילה חיצונית';
$string['allowtypeimsrepository'] = 'אפשר סוג חבילת IMS';
$string['allowtypelocalsync'] = 'אפשר בוג חבילות מורדות';
$string['apidebugmask'] = 'מסכת הלכידה של ניפוי API - השתמש בביטיים סדורים (regex) כל <שם_המשתמש>: <שם_הפעילות>  למשל admin:.* יאפשר ניפוי רק למשתמש המוגדר כמנהל';
$string['areacontent'] = 'קבצי תוכן';
$string['areapackage'] = 'קובץ חבילה';
$string['asset'] = 'נכס';
$string['assetlaunched'] = 'נכס - נצפה';
$string['attempt'] = 'ניסיון';
$string['attempt1'] = 'ניסיון 1';
$string['attempts'] = 'ניסיונות';
$string['attemptsx'] = '{$a} נסיונות';
$string['attr_error'] = 'ערך רע עבור התכונה ({$a->attr}) בתג {$a->tag}.';
$string['autocontinue'] = 'המשך אוטומטית';
$string['autocontinue_help'] = '**המשך באופן אוטומטי**
אם "המשך באופן אוטומטי" מוגדר כ-"כן", אז כאשר אובייקט למידה כלשהו קורא לשיטת "תקשורת קרובה", אז אובייקט הלמידה הזמין הבא מופעל אוטומטית.

אם זה מוגדר כ-"לא", אז על המשתמשים ללחוץ על כפתור ה-"המשך" כדי להמשיך הלאה.';
$string['autocontinuedesc'] = 'מאפיין זה מגדיר את ברירת המחדל האוטומטית עבור הפעילות';
$string['averageattempt'] = 'ניסיונות ממוצעים';
$string['badmanifest'] = 'כמה שגיאות גלויות: קרא את יומני המעקב אחר השגיאות';
$string['badpackage'] = 'החבילה/קובץ הגדרות imsmanifest.xml  איננה תקפה.יש לבדוק ולנסות שוב.';
$string['browse'] = 'תצוגה מקדימה';
$string['browsed'] = 'עויין';
$string['browsemode'] = 'מצב תצוגה מקדימה';
$string['browserepository'] = 'עיין בגנזך';
$string['cannotfindsco'] = 'SCO לא נמצא';
$string['chooseapacket'] = 'בחר או עדכן חבילה.';
$string['completed'] = 'הושלם';
$string['completionscorerequired'] = 'דרוש ציון מינימום';
$string['completionstatus_completed'] = 'השלים';
$string['completionstatus_failed'] = 'נכשל';
$string['completionstatus_passed'] = 'עבר';
$string['completionstatusrequired'] = 'דרוש סטטוס';
$string['confirmloosetracks'] = 'אזהרה: נראה שהחבילה עברה שינויים או התאמות כלשהן. אם שונה מבנה החבילה, יכול להיות שחלק מדוחות המעקב של המשתמשים יאבדו במהלך תהליך העדכון.';
$string['contents'] = 'תוכן';
$string['coursepacket'] = 'חבילת קורס';
$string['coursestruct'] = 'מבנה קורס';
$string['currentwindow'] = 'חלון נוכחי';
$string['datadir'] = 'שגיאה במערכת הקבצים: לא ניתן ליצור ספריה שתכיל את נתוני הקורס.';
$string['defaultdisplaysettings'] = 'הגדרות ברירת מחדל';
$string['defaultgradesettings'] = 'הגדרות ציון כברירת מחדל';
$string['defaultothersettings'] = 'הגדרות ברירת מחדל אחרות';
$string['deleteallattempts'] = 'מחק את כל נסיונות ה-SCROM';
$string['deleteattemptcheck'] = 'האם אתה בטוח לחלוטין שאתה רוצה למחוק את הנסיונות האלו כליל?';
$string['deleteuserattemptcheck'] = 'האם הינך בטוח כי ברצונך למחוק את כל נסיונות המענה לחלוטין?';
$string['details'] = 'פרטי דוח המעקב';
$string['directories'] = 'הראה את קישורי הנושאים';
$string['disabled'] = 'אל תאפשר';
$string['display'] = 'הצג את החבילה';
$string['displayattemptstatus'] = 'הצג את סטטוס הנסיונות';
$string['displayattemptstatus_help'] = 'כאשר מאופשר, תוצאות וציונים לנסיונות מוצגים בעמוד המתאר של SCORM';
$string['displayattemptstatusdesc'] = 'מאפיין זה קובע את ערך ברירית המחדל עבור הגדרת הסטטוס של נסיונות ההצגה';
$string['displaycoursestructure'] = 'הצג את מבנה הקורס בעמוד הכניסה';
$string['displaycoursestructure_help'] = 'כאשר מאופשר, תוכן הענינים מוצג על עמוד המתאר של SCORM';
$string['displaycoursestructuredesc'] = 'מאפיין זה קובע את ערך בררית המחדל עבור ההצגת מבנה הקורס על עמוד הכניסה';
$string['displaydesc'] = 'מאפיין זה מגדיר את ברירת המחדל של הצגה או אי הצגה של החבילה עבור פעילות';
$string['displaysettings'] = 'הגדרות תצוגה';
$string['domxml'] = 'סיפריית DOMXML חיצונית';
$string['duedate'] = 'תאריך יעד';
$string['element'] = 'רכיב';
$string['elementdefinition'] = 'הגדרת אלמנט';
$string['enter'] = 'הכנס/הפעל';
$string['entercourse'] = 'הכנס קורס';
$string['errorlogs'] = 'יומן מעקב אחר שגיאות';
$string['everyday'] = 'כל יום';
$string['everytime'] = 'בכל פעם שנעשה בו שימוש';
$string['exceededmaxattempts'] = 'הגעת למספר המירבי המותר של נסיונות.';
$string['exit'] = 'צא מהקורס';
$string['exitactivity'] = 'הפסק פעילות';
$string['expired'] = 'לצערנו הפעילות נסגרה ב- {$a} ואין היא זמינה יותר.';
$string['external'] = 'עדכן זמינות חבילות חיצוניות';
$string['failed'] = 'נכשל';
$string['finishscorm'] = 'אם סיימת לתפות במשאב זה, {$a}';
$string['finishscormlinkname'] = 'לחץ כאן לחזור לעמוד הקורס.';
$string['firstaccess'] = 'גישה ראשונה';
$string['firstattempt'] = 'ניסיון מענה ראשון';
$string['forcecompleted'] = 'האילוץ הושלם';
$string['forcecompleted_help'] = 'אם מאופשר, הסטטוס של הנסיון העכשווי נבפה להיות "הושלם". הגדרה זאת קבילה רק לחבילות SCORM 1.2 . הדבר שימושי אם חבילת ה-SCORM לא מטפלת נכונה בביקור מחודש של נסיון, בסקירה או בדפדוף, או מתריעה בצורה שגויה על סטטוס ההשלמה.';
$string['forcecompleteddesc'] = 'מאפיין זה קובע את ערך ברירת המחדל של הגדרות השלמת  האילוץ';
$string['forcejavascript'] = 'אלץ משתמשים לאפשר  JavaScript';
$string['forcejavascriptmessage'] = 'נדרש JavaScript לצפיה באובייקט זה,
אנא אפשר JavaScript בדפדפן שלך ונסה שנית';
$string['forcenewattempt'] = 'אלץ נסיון חדש';
$string['forcenewattempt_help'] = 'אם מאופשר, כל פעם שנגשים לחבילת SCORM הנסיון יספר כנסיון חדש.';
$string['forcenewattemptdesc'] = 'מאפיין זה קובע את ערך ברירת המחדל להגדרות כפיית נסיון מחודש';
$string['found'] = 'מצג גלוי';
$string['frameheight'] = 'הגדרה זו קובעת מהו גובה ברירת המחדל לשלב, מסגרת או חלון.';
$string['framewidth'] = 'הגדרה זו קובעת מהו רוחב ברירת המחדל לשלב, מסגרת או חלון.';
$string['fullscreen'] = 'מלא את המסך במלואו';
$string['general'] = 'נתונים כללים';
$string['gradeaverage'] = 'ציון ממוצע';
$string['gradeforattempt'] = 'הציון לנסיון';
$string['gradehighest'] = 'הציון הגבוה ביותר';
$string['grademethod'] = 'שיטת מתן ציון';
$string['grademethod_help'] = 'שיטות מתן הציון מגדירות כיצד נקבע הציון לניסיון בודד של הפעילות.
קיימות ארבע שיטות:
* עצמי למידה - מספר עצמי הלמידה שהושלמו/צלחו
* הציון הגבוה - התוצאה הגבוהה ביותר שהתקבלה לכל עצמי הלמידה שצלחו
* ציון ממוצע - הממצוע של התוצאות
* ציון מסוכם - הסיכום של כל הציונים';
$string['grademethoddesc'] = 'מאפיין זה מגדיר את ברירת מחדל שיטת הציונים עבור פעילות';
$string['gradereported'] = 'הציון נמסר';
$string['gradescoes'] = 'אובייקטי למידה';
$string['gradesettings'] = 'הגדרות ציון';
$string['gradesum'] = 'ציון סכום';
$string['height'] = 'גובה';
$string['hidden'] = 'מוחבא';
$string['hidebrowse'] = 'מנע את מצב התצוגה המקדימה';
$string['hidebrowse_help'] = 'צפיה מוקדמת מאשפרת לתלמיד לעלעל בפעילות לפני שהוא מנסה אותה. באם מאפיין הצפיה המוקדמת מנוטרל, לחתן הצפיה המוקדמת איננו מוצג.';
$string['hidebrowsedesc'] = 'מאפיין זה מגדיר את ברירת המחדל של איפשור או מניעת מצב "תצוגה מקדימה"';
$string['hideexit'] = 'הסתר את קישור היציאה';
$string['hidenav'] = 'הסתר את כפתורי הניווט';
$string['hidenavdesc'] = 'מאפיין זה מגדיר את ברירת המחדל של הצגה או הסתרת כפתורי הניווט.';
$string['hidereview'] = 'הסתר את הכפתור: \'עיין בתשובות\'';
$string['hidetoc'] = 'תצוגת מבנה הקורס';
$string['hidetoc_help'] = 'הגדרות אלו קובעות איך תוכן הענינים יוצג על ידי SCORM.';
$string['hidetocdesc'] = 'מאפיין זה מגדיר את ברירת המחדל להצגה או הסתרת את מבנה הקורס (TOC)';
$string['highestattempt'] = 'ניסיון המענה בעל התוצאה הגבוהה ביותר';
$string['identifier'] = 'מזהה שאלה';
$string['incomplete'] = 'לא גמור';
$string['info'] = 'מידע';
$string['interactions'] = 'הידברות';
$string['interactionscorrectcount'] = 'מספר תוצאות נכונות עבור השאלה';
$string['interactionsid'] = 'מספר זיהוי ID של האלמנט';
$string['interactionslearnerresponse'] = 'תגובות הלומד';
$string['interactionspattern'] = 'דפוס תגובה נכונה';
$string['interactionsresponse'] = 'תגובת הסטודנט';
$string['interactionsresult'] = 'התוצאה מסתמכת על תגובת הסטודנט ובנוסף <br /> תוצאה נכונה';
$string['interactionsscoremax'] = 'ערך מירבי בטווח עבור ניקוד השורה';
$string['interactionsscoremin'] = 'ערך מזערי בטווח עבורניקוד השורה';
$string['interactionsscoreraw'] = 'מספר המשפיע על הביצועים של הבודק <br /> יחסי לטוח המוגדר על-ידי ערכי המקסימום והמינימום.';
$string['interactionssuspenddata'] = 'מקנה מקום בכדי לשמור ולספק את המידע <br /> בין מושבי הזמן של הבודק';
$string['interactionstime'] = 'הזמן שנסיון המענה אותחל';
$string['interactionstype'] = 'סוג השאלה';
$string['interactionsweight'] = 'המשקל שהוקנה לאלמנט';
$string['invalidactivity'] = 'פעילות SCORM שגויה';
$string['invalidhacpsession'] = 'שגיאת HACP Session';
$string['invalidmanifestresource'] = 'אזהרה: המשאבים הבאים יוחסו בהצהרה שלך אך לא ניתן למצוא.';
$string['invalidurl'] = 'הוגדר קישור לא תקף לפעילות קישור ישיר';
$string['last'] = 'הושגה גישה בפעם האחרונה ב-';
$string['lastaccess'] = 'כניסה אחרונה';
$string['lastattempt'] = 'ניסיון מענה אחרון';
$string['lastattemptlock'] = 'נעל אחרי ניסיון אחרון';
$string['lastattemptlock_help'] = 'אם מאופשר, המנע מהתלמיד להפעיל את נגן ה-SCORM לאחר שהוא מיצה את כל הנסיונות שהוקצו לו';
$string['lastattemptlockdesc'] = 'מאפיין זה קובע את ערך ברירית המחדל הגדרת הנעילה לאחר הנסיון האחרון';
$string['location'] = 'הראה את סרגל המיקום';
$string['max'] = 'תוצאה מירבית';
$string['maximumattempts'] = 'מספר ניסיונות המענה';
$string['maximumattempts_help'] = 'הגדרה זו קובעת את מספר הנסיונות שהורשו למשתמשים.
הדבר פועל רק עם SCORM1.2 וחבילות AICC. ל-SCORM2004 קיים מספר מירבי של הגדרת נסיונות.';
$string['maximumattemptsdesc'] = 'מאפיין זה מגדיר את ברירת מחדל המספר המירבי של נסיונות עבור פעילות';
$string['maximumgradedesc'] = 'מאפיין זה מגדיר את ברירת המחדל של מקסימום ציון עבור פעילות';
$string['menubar'] = 'הראה את סרגל התפריט';
$string['min'] = 'תוצאה מינמלית';
$string['missing_attribute'] = 'בתג {$a->tag} חסרה התכונה {$a->attr}';
$string['missing_tag'] = 'תג {$a->tag} חסר';
$string['missingparam'] = 'פרמטר דרוש חסר או שגוי';
$string['mode'] = 'מצב';
$string['modulename'] = 'חבילת SCORM';
$string['modulename_help'] = 'SCORM ו-AICC הם אוספי מפרטים המאפשרים יכולת פעולה הדדית, נגישות ושימוש חוזר של תכני למידה מבוססי איטרנט. מודול ה-SCORM/AICC מאשפר לכלול חבילות של SCORM/AICC בקורס.';
$string['modulenameplural'] = 'חבילות SCORM';
$string['navigation'] = 'ניווט';
$string['newattempt'] = 'התחל בניסיון חדש לענות על הבוחן';
$string['next'] = 'המשך';
$string['no_attributes'] = 'לתג {$a->tag} חייבות להיות תכונות';
$string['no_children'] = 'לתג {$a->tag} חייבים להיות ילדים';
$string['noactivity'] = 'כלום לדווח';
$string['noattemptsallowed'] = 'מספר הנסיונות המותר';
$string['noattemptsmade'] = 'מספר הנסיונות שביצעת';
$string['nolimit'] = 'ניסיונות מענה בלתי מוגבלים';
$string['nomanifest'] = 'המניפסט לא נמצא';
$string['noprerequisites'] = 'סליחה, אבל לא הגעת למספיק תנאים מקדימים על מנת התתאפשר לך גישה לאובייקט למידה זה.';
$string['noreports'] = 'אין דוח להציג';
$string['normal'] = 'רגיל';
$string['noscriptnoscorm'] = 'הדפדפן שלך לא תומך ב-javascript, או שתמיכה זו נמנעה. לא ירשמו כל דוחות המעקב.';
$string['not_corr_type'] = 'חוסר התאמת סוג עבור תג {$a->tag}';
$string['notattempted'] = 'לא נוסה';
$string['notopenyet'] = 'לצערנו פעילות זאת איננה זמינה עד {$a}';
$string['objectives'] = 'מטרות';
$string['optallstudents'] = 'כל המשתמשים';
$string['optattemptsonly'] = 'רק משתמשים עם נסיונות';
$string['options'] = 'אפשרויות (לא זמינות במספר דפדפנים)';
$string['optionsadv'] = 'אפשרויות (מתקדם)';
$string['optionsadv_desc'] = 'אם מסומן, אפשרויות החלון יוגדרו כאפשרויות מתקדמות בטופס.';
$string['optnoattemptsonly'] = 'רק משתמשים ללא נסיונות';
$string['organization'] = 'ארגון';
$string['organizations'] = 'ארגונים';
$string['othersettings'] = 'הגדרות נוספות';
$string['othertracks'] = 'דוחות מעקב';
$string['package'] = 'קובץ דחוס';
$string['package_help'] = 'החבילה היא קובץ דחוס(zip או pif) המכיל קבצי הגדרת קורסים של SCORM/AICC';
$string['packagedir'] = 'שגיאה במערכת הקבצים: לא ניתן ליצור ספריית חבילה';
$string['packagefile'] = 'לא צויין קובץ חבילה';
$string['packageurl'] = 'כתובת איטרנט';
$string['packageurl_help'] = 'ניתן לציין כתובת אינטרנט עבור חבילת SCORM, או לבחור קובץ בחלונית בחירת הקבצים.';
$string['page-mod-scorm-x'] = 'עמוד רכיב SCORM  כלשהו';
$string['pagesize'] = 'גודל העמוד';
$string['passed'] = 'עבר';
$string['php5'] = 'PHP 5 (סיפרייה מקומית של DOMXML)';
$string['pluginadministration'] = 'ניהול SCORM/AICC';
$string['pluginname'] = 'חבילת SCORM';
$string['popup'] = 'חלון חדש';
$string['popupmenu'] = 'בתפריט הנפתח';
$string['popupopen'] = 'פתח חבילה בחלון חדש';
$string['popupsblocked'] = 'כנראה שהחלונות הקופצים נוטרלו, לפיכל נמנע מ-SCORM לפעול. בדוק את הגדרות הנדפדפן שלך לפני שאתה מנסה שנית.';
$string['position_error'] = 'התג {$a->tag} לא יכול להיות ילדו של {$a->parent} tag';
$string['preferencespage'] = 'מאפינים רק עבור עמוד זה';
$string['preferencesuser'] = 'מאפיני הדוח';
$string['prev'] = 'קודם';
$string['raw'] = 'תוצאה גולמית';
$string['regular'] = 'מניפסט רגיל';
$string['report'] = 'דוח';
$string['reportcountallattempts'] = '{$a->nbusers} נסיונות  עבור {$a->nbattempts} משתמשים מתוך {$a->nbresults} תוצאות';
$string['reportcountattempts'] = '{$a->nbresults} תוצאות ({$a->nbusers} משתמשים)';
$string['reports'] = 'דוחות';
$string['resizable'] = 'אפשר לשנות את הגודל של חלון זה';
$string['result'] = 'תוצאה';
$string['results'] = 'תוצאות';
$string['review'] = 'עיין בתשובות';
$string['reviewmode'] = 'מצב עיון בתשובות';
$string['scoes'] = 'אובייקטי למידה';
$string['score'] = 'תוצאה';
$string['scorm:deleteownresponses'] = 'מחק את נסיונות המענה שלך';
$string['scorm:deleteresponses'] = 'מחק נסיונות SCORM';
$string['scorm:savetrack'] = 'שמור דוח מעקב';
$string['scorm:skipview'] = 'פסח על הסקירה הכללית';
$string['scorm:viewreport'] = 'צפה בדוחות';
$string['scorm:viewscores'] = 'צפה בתוצאות';
$string['scormclose'] = 'עד';
$string['scormcourse'] = 'קורס למידה';
$string['scormloggingoff'] = 'כניסת API כבויה';
$string['scormloggingon'] = 'כניסת API פעילה';
$string['scormopen'] = 'פתח';
$string['scormresponsedeleted'] = 'מחק נסיונות משתמש';
$string['scormtype'] = 'סוג';
$string['scormtype_help'] = 'הגדרות אלו קובעות איך תכלל החבילה הקורס. יש 4 אפשרויות:
* חבילה מקומית (מתעדכנת) - מאשפר לחבילת SCORM להבחר באמצעות חיפוש בקבצים.
* קישור לחבילה חיצונית - מאשפר להגדיר כתובת אינטרנט לחבילה או לקובץ הגדרות: imsmanifest.xml. הערה: אם לכתובת האינטרנט יש שם מתחם השונה מהאתר שלך, אזי "חבילה מקומית" היא בחירה טובה יותר כיוון שאחרת הציונים לא ישמרו.
* קישור לקובץ imsmanifest.xml חיצוני - מאשפרת לציין כתובת אינטרנט של חבילה. החבילה תועתק מהשרת החיצוני למערכת מוודל זו ותשמר מקומית בקורס. החבילה המקומית תעודכן כאשר חבילת SCORM החיצונית תעודכן.
* קישור לחבילת AICC חיצונית - מאפשר לחבילה להבחר מתוך מאגר IMS חיצוני.';
$string['scrollbars'] = 'אפשר לגלול את החלון';
$string['selectall'] = 'בחר הכל';
$string['selectnone'] = 'בטל את כל הבחירה';
$string['show'] = 'הראה';
$string['sided'] = 'לצד';
$string['skipview'] = 'סטודנטים פוסחים על עמוד מבנה התוכן';
$string['skipview_help'] = 'מאפיין זה קובע באם ניתן, אי-פעם, לדלג על עמוד מבנה התוכן (כך שהוא לא יוצג). אם החבילה כוללת רק עצם למידה אחד, ניתן תציד לדלג על עמוד מבנה התוכן .';
$string['skipviewdesc'] = 'מאפיין זה מגדיר את ברירת המחדל באם לדלג על מבנה תוכן העמוד';
$string['slashargs'] = 'אזהרה: ארגומנטי לוכסנים מנוטרלים באתר זה, לכן אובייקטים מסויימים עלולים שלא לפעול כראוי.';
$string['stagesize'] = 'גודל הבמה';
$string['stagesize_help'] = 'שתי הגדרות אלו מגדירים את גובה ורוחב חלוןמסגרת אובייקטי הלמידה.';
$string['started'] = 'התחיל ב-';
$string['status'] = 'מצב';
$string['statusbar'] = 'הראה את סרגל המצב';
$string['student_response'] = 'תגובה';
$string['subplugintype_scormreport'] = 'דוח';
$string['subplugintype_scormreport_plural'] = 'דוחות';
$string['suspended'] = 'מושהה';
$string['syntax'] = 'טעות תחבירית';
$string['tag_error'] = 'תג לא ידוע ({$a->tag}) בעל התוכן: {$a->value}';
$string['time'] = 'זמן';
$string['timerestrict'] = 'הגבל את התשובות לפרק זמן זה';
$string['title'] = 'כותרת';
$string['toc'] = 'תוכן ענינים';
$string['too_many_attributes'] = 'לתג {$a->tag} יש יותר מתי תכונות';
$string['too_many_children'] = 'לתג {$a->tag} יש יותר מדי ילדים';
$string['toolbar'] = 'הראה את סרגל הכלים';
$string['totaltime'] = 'זמן';
$string['trackingloose'] = 'אזהרה: נתוני דוח המעקב של החבילה הזו יאבדו!';
$string['type'] = 'סוג';
$string['typeaiccurl'] = 'קישור לחבילת AICC חיצונית';
$string['typeexternal'] = 'קישור לקובץ IMSMANIFEST.XML חיצוני';
$string['typeimsrepository'] = 'מאגר תןכן פנימי של IMS';
$string['typelocal'] = 'חבילה מקומית';
$string['typelocalsync'] = 'חבילה מקומית (מתעדכנת)';
$string['unziperror'] = 'חלה טעות בעת פריסת הקובץ הדחוס';
$string['updatefreq'] = 'תדירות העידכון האוטומטי';
$string['updatefreq_help'] = 'הדבר מאפשר לחבילה החיצונית לרדת בצורה אוטומטית ולהיות מעודכנת';
$string['updatefreqdesc'] = 'מאפיין זה מגדיר את ברירת מחדל תכיפות העדכון אוטומטי של הפעילות';
$string['validateascorm'] = 'תן תוקף לחבילה';
$string['validation'] = 'תוצאת בדיקת התוקף';
$string['validationtype'] = 'הקשר זה מגדיר את ספרית ה-DOMXML המשמשת לאימות מניפסט ה-SCORM. אם אינך יודע על כך, השאר את המצב הקיים.';
$string['value'] = 'ערך';
$string['versionwarning'] = 'גירסת המניפסט ישנה יותר מההזהרה ב {$a->tag} תג 1.3';
$string['viewallreports'] = 'ראה את הדוחות עבור {$a} ניסיונות מענה';
$string['viewalluserreports'] = 'הראה דוחות עבור משתמשים {$a}';
$string['whatgrade'] = 'הציון של ניסיונות המענה';
$string['whatgrade_help'] = 'כאשר הינך מאפשר נסיונות כפולים למשתמשים, תוכל לבחור כיצד להשתמש בתוצאת הנסיונות בפנקס הציונים';
$string['whatgradedesc'] = 'מאפיין זה מגדיר את ברירת המחדל של ניסיונות המענה לבוחן';
$string['width'] = 'רוחב';
$string['window'] = 'חלון';
