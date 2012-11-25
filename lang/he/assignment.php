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
 * Strings for component 'assignment', language 'he', branch 'MOODLE_22_STABLE'
 *
 * @package   assignment
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addsubmission'] = 'הוספת הגשה';
$string['allowdeleting'] = 'אפשר מחיקה';
$string['allowdeleting_help'] = '**אפשר מחיקה**
אם מאפשרים את האפשרות הזו, משתתפים יכולים למחוק קבצים שהועלו לאתר בכל זמן, כל עוד הם עדיין לא נבדקו ולא ניתן להם ציון.';
$string['allowmaxfiles'] = 'מספר הקבצים המירבי שניתן להעלות';
$string['allowmaxfiles_help'] = '**מספר מירבי של קבצים שאפשר להעלות**
מספר מירבי של קבצים אותם יכול כל משתתף להעלות. המספר הזה לא גלוי בפני הסטודנטים, אנא כיתבו את המספר הממשי של הקבצים הנדרשים בתיאור המטלה.';
$string['allownotes'] = 'אפשר הערות תלמידים';
$string['allownotes_help'] = '**אפשר הערות סטודנטים**
אם מאפשרים את האפשרות הזו, המשתתפים יכולים להוסיף הערות לתוך איזורי טקסט. הדבר דומה למטלות טקסט מקוונות.
תיבת הטקסט הזו יכולה לשמש לתקשורת עם האדם הבודק את המטלה, תיאור התקדמות או לכל פעילות כתובה אחרת.';
$string['allowresubmit'] = 'הרשה הגשה מחדש';
$string['allowresubmit_help'] = '**הגשה מחדש של מטלות**
על פי ברירת מחדל, סטודנטים לא יכולים להגיש מחדש מטלות מהרגע שהמורה נתן להם ציון.
אם תבחרו להפעיל את האפשרות הזאת, אז סטודנטים יוכלו להגיש מחדש מטלות לאחר שהמורה נתן להם ציון (כדי שהמורה יבדוק אותן מחדש ובתקווה שישנה להן את הציון). הדבר יכול להיות מועיל עם המורה רוצה לעודד את הסטודנטים לעשות עבודה טובה יותר על ידי תהליך חוזר ונשנה של הגשה ומשוב.
כמובן שאפשרות זו לא רלוונטית למשימות הנעשות כשהמחשב לא מקוון (אוף-ליין).';
$string['alreadygraded'] = 'למטלה שלך כבר ניתן ציון והגשה מחדש איננה אפשרית.';
$string['assignment:exportownsubmission'] = 'יצא את ההגשה שלך';
$string['assignment:exportsubmission'] = 'יצוא הגשה';
$string['assignment:grade'] = 'בדוק ותן ציון למטלה';
$string['assignment:submit'] = 'הגשת המטלה';
$string['assignment:view'] = 'ראה מטלה';
$string['assignmentdetails'] = 'פרטי תרגיל';
$string['assignmentmail'] = '{$a->teacher} פרסם משוב על התרגיל שהגשת עבור \'{$a->assignment}\'

אתה יכול לראות את זה כנספח לתרגיל שהגשת:

{$a->url}';
$string['assignmentmailhtml'] = '{$a->teacher} שלח משוב על התרגיל שהגשת עבור \'<i>{$a->assignment}</i>\'<br /><br />

אתה יכול לראות את זה כנספח ל<a href="{$a->url}">מטלה שהגשת</a>.';
$string['assignmentmailsmall'] = '{$a->teacher} פרסם כמה משובים על המטלה שהגשת - \'{$a->assignment}\' . תוכל לראות מסופח להגשה שלך.';
$string['assignmentname'] = 'שם המטלה';
$string['assignmentsubmission'] = 'הגשות המטלה';
$string['assignmenttype'] = 'סוג המטלה';
$string['availabledate'] = 'הגשה אפשרית מתאריך';
$string['cannotdeletefiles'] = 'שגיאה התרחשה וקבצים אינם ניתנים למחיקה';
$string['cannotviewassignment'] = 'לא ניתן לצפות במטלה זו';
$string['comment'] = 'הערה';
$string['commentinline'] = 'הערה פנימית';
$string['commentinline_help'] = '**הערות מורים בתוך הטקסט**
אם האפשרות הזאת נבחרה, אז ההגשה המקורית של הסטודנט תועתק לתוך שדה הערות המשוב בזמן תהליך הבדיקה ונתינת הציון. דבר זה יהפוך את כתיבת ההערות לתוך הטקסט למשימה פשוטה יותר (תוך כדי שימוש בצבע אחר, אולי), בנוסף לעריכה של הטקסט המקורי.';
$string['configitemstocount'] = 'טבע הפריטים שנספרים כהגשות תלמידים במטלות מקוונות';
$string['configmaxbytes'] = 'ברירת מחדל לגודל המירבי של כל התרגילים באתר זה (כפוף להגבלות הקורס ולשאר הגדרות מקומיות)';
$string['configshowrecentsubmissions'] = 'כולם יכולים לראות את הודעות ההגשות בדוחות הפעילות האחרונים.';
$string['confirmdeletefile'] = 'האם אתה בטוח לחלוטין שאתה רוצה למחוק קובץ זה?
?<br /><strong>{$a}</strong>';
$string['coursemisconf'] = 'הקורס איננו מוגדר באופן מלא';
$string['currentgrade'] = 'הציון הנוכחי בגליון הציונים';
$string['deleteallsubmissions'] = 'מחק את כל ההגשות';
$string['deletefilefailed'] = 'מחיקת הקובץ נכשלה';
$string['description'] = 'הנחייה למטלה';
$string['downloadall'] = 'הורדת כל המטלות בקובץ ארכיב (zip)';
$string['draft'] = 'טיוטא';
$string['due'] = 'מטלה חלה ב-';
$string['duedate'] = 'עד לתאריך';
$string['duedateno'] = 'אין תאריך הגשה';
$string['early'] = '{$a} מוקדם';
$string['editmysubmission'] = 'עריכת ההגשה שלי';
$string['editthesefiles'] = 'ערוך קבצים אלו';
$string['editthisfile'] = 'העלאה קובץ זה';
$string['emailstudents'] = 'התראות בדוא"ל לתלמידים';
$string['emailteachermail'] = 'המשתמש {$a->username} עדכן את ההגשת התרגיל שלו עבור \'{$a->assignment}\'

ההגשה אפשרית כאן:

{$a->url}';
$string['emailteachermailhtml'] = 'המשתמש {$a->username} עדכן את הגשת התרגיל עבור <i>\'{$a->assignment}\'</i><br /><br />
היא <a href="{$a->url}">זמינה באתר</a>.';
$string['emailteachers'] = 'הודעת התראה למורים בדוא"ל';
$string['emailteachers_help'] = '**אתראות למורים בדואר האלקטרוני**
אם מאפשרים את האפשרות הזו, אז המורים מקבלים התראה קצרה בדואר האלקטרוני בכל פעם שסטודנט מוסיף או מעדכן הגשת מטלה.
רק מורים שמאושרים לבדוק ולתת ציון למטלה המדוברת מקבלים התראה. כך שלדוגמא, אם הקורס משתמש בקבוצות שונות, אז מורים המוגבלים לקבוצות מסויימות לא יקבלו אתראה על הגשות של הסטודנטים בקבוצות האחרות.
כמובן שבשביל פעילויות המתרחשות כשהמחשב לא מקוון (אוף-ליין), מעולם לא נשלח דואר אלקטרוני כי הסטודנטים מעולם לא מגישים מטלות.';
$string['emptysubmission'] = 'לא הגשת עדיין שום תרגיל';
$string['enablenotification'] = 'שליחת הודעות דוא"ל';
$string['enablenotification_help'] = 'אם תאפשר זאת, ישלח לסטודנטים הודעה בדוא"ל על ציוניהם והמשובים.
המאפיינים האישיים שלך נשמרים ויוגשו לכל מטלות הגשת הציון.';
$string['errornosubmissions'] = 'לא נמצאו הגשות להורדה';
$string['existingfiledeleted'] = 'הקובץ הקיים {$a} נמחק';
$string['failedupdatefeedback'] = 'כשל בעדכון משוב ההגשה למשתמש {$a}';
$string['feedback'] = 'משוב';
$string['feedbackfromteacher'] = 'משוב מה{$a}';
$string['feedbackupdated'] = 'הגשת עדכון משוב בשביל {$a} אנשים';
$string['finalize'] = 'נעילת קבצים להגשה';
$string['finalizeerror'] = 'שגיאה התרחשה והגשה זו לא הושלמה';
$string['graded'] = 'בדוק';
$string['guestnosubmit'] = 'אנו מצטערים, אבל אורחים לא מורשים להגיש מטלה. אתה חייב להירשם או להתחבר למערכת כדי להגיש את התשובה שלך.';
$string['guestnoupload'] = 'אנו מצטערים, אבל אורחים לא מורשים להעלות קבצים.';
$string['helpoffline'] = '<p>הגדרה זו שימושית כאשר המטלה מבוצעת מחוץ למוודל. היא יכולה להיות במקום אחר ברשת או בהגשה פנים-אל-פנים.</p><p>תלמידים יכולים לראות את הגדרת התרגיל, אבל לא יכולים להעלות קבצים או לערוך את התרגיל באופן מקוון. מתן ציונים עובד כרגיל, ותלמידים יקבלו הודעה כאשר הציון שלהם נקבע.</p>';
$string['helponline'] = '<p>סוג תרגיל זה מבקש מהמשתמשים לערוך טקסט, בעזרת כלי העריכה הרגילים. המורים יכולים להעניק ציון באופן מקוון, ואפילו לבצע תיקונים או לרשום הערות בגוף הטקסט.</p>
<p>(אם השתמשת בגרסאות קודמות של מוודל, סוג מטלה זה דומה להתנהגות של מודול ה-Journal הישן.)</p>';
$string['helpupload'] = '<p>סוג מטלה זה מאפשר לכל משתתף להעלות קובץ אחד, או יותר, מכל תסדיר שהוא. קבצים אלה יכולים להיות מסמכי Word, תמונות, אתרים המכווצים באמצעות תוכנת ZIP או כל דבר אחר שתבקשו מהמשתתפים להעלות.</p>
<p>בנוסף, סוג זה של מטלה מאפשר לכם להעלות קבצי תגובה רבים. את קיבצי התגובה ניתן להעלות גם לפני ההגשה, וכך ניתן להשתמש בהם כדי לתת לכל משתתף קובץ אחר לעבוד איתו.
</p>
<p>בנוסף המשתתפים יכולים להוסיף הערות שמתארות את הקבצים שהם הגישו, מצב התקדמות העבודה או כל מידע כתוב אחר. </p>
<p>את ההגשות לסוג זה של מטלה חייבים התלמידים לסיים בעצמם, באופן ידני. אתם יכולים לראות את המצב הנוכחי שלהם בכל עת, מטלות לא גמורות מסומנות כ\'טיוטא\'. בידיכם האפשרות להחזיר כל מטלה שעדיין לא ניתן לה ציון למצב של טיוטא.
</p>';
$string['helpuploadsingle'] = '<p>סוג תרגיל זה מאפשר לכל משתתף להעלות קובץ בודד, מכל סוג שהוא.</p> <p>הקובץ יכול להיות מסמך שנכתב במעבד תמלילים, תמונה,
חבילת ארכיב מכווצת, או כל סוג קובץ אחר הנדרש ע"י התרגיל.</p>';
$string['hideintro'] = 'הסתרת ההנחייה עד תאריך תחילת המטלה';
$string['hideintro_help'] = '**הסתר את התיאור לפני התאריך המתאים**
אם מאפשרים את האפשרות הזו, תיאור המטלה מוסתר לפני תאריך הפתיחה.';
$string['invalidassignment'] = 'מטלה שגויה';
$string['invalidfileandsubmissionid'] = 'קובץ או מספר הגשה חסר';
$string['invalidid'] = 'מספר זיהוי המטלה שגוי';
$string['invalidsubmissionid'] = 'מספר זיהוי ההגשה שגוי';
$string['invalidtype'] = 'סוג המטלה שגויה';
$string['invaliduserid'] = 'מספר זיהוי משתמש  אינו בתוקף';
$string['itemstocount'] = 'ספירה';
$string['lastgrade'] = 'ציון אחרון';
$string['late'] = '{$a} מאוחר';
$string['maximumgrade'] = 'ציון מירבי';
$string['maximumsize'] = 'גודל מירבי';
$string['maxpublishstate'] = 'צפיה מירבית לערך בלוג לפני המועד הסופי.';
$string['messageprovider:assignment_updates'] = 'הודעות מפעילות "מטלה"';
$string['modulename'] = 'מטלה';
$string['modulename_help'] = 'משימות מאפשרות למורה להגדיר מטלה שדורשת מהסטודנטים להכין תוכן דיגיטלי (בכל תסדיר) ולהגיש אותו על ידי העלאתו לשרת. מטלות טיפוסית כוללות מאמרים, פרוייקטים, דוחות וכדומה. הפרק הזה כולל בחובו אמצעי בדיקה ונתינת ציון.';
$string['modulenameplural'] = 'מטלות';
$string['newsubmissions'] = 'המטלות שהוגשו';
$string['noassignments'] = 'עדיין אין מטלות';
$string['noattempts'] = 'עדיין לא נעשו נסיונות לפתור את מטלה זו';
$string['noblogs'] = 'לא קיימים ערכי בלוג להגיש!';
$string['nofiles'] = 'לא הוגשו קבצים';
$string['nofilesyet'] = 'עדיין לא הוגשו קבצים';
$string['nomoresubmissions'] = 'לא ניתן להגיש יותר.';
$string['norequiregrading'] = 'לא נמצאו מטלות אשר דורשות מתן ציון';
$string['nosubmisson'] = 'לא הוגשה אף מטלה';
$string['notavailableyet'] = 'מצטערים, מטלה זו עדיין אינה זמינה<br />
הוראות למילוי המטלה, יוצגו כאן בתאריך המופיע למטה.';
$string['notes'] = 'הערות';
$string['notesempty'] = 'אין רשומה';
$string['notesupdateerror'] = 'חלה שגיאה בזמן עידכון ההערות';
$string['notgradedyet'] = 'עדיין לא הוערך';
$string['notsubmittedyet'] = 'לא הוגש עדיין';
$string['onceassignmentsent'] = 'מהרגע שהמטלה נשלחת לבדיקה, לא תוכל למחוק או להוסיף קבצים. האם אתה רוצה להמשיך?';
$string['operation'] = 'פעולה';
$string['optionalsettings'] = 'הגדרות נוספות';
$string['overwritewarning'] = 'אזהרה: העלאה מחדש תחליף את ההגשה הנוכחית שלך';
$string['page-mod-assignment-submissions'] = 'עמוד הגשות רכיב מטלה';
$string['page-mod-assignment-view'] = 'עמוד ראשי של רכיב מטלה';
$string['page-mod-assignment-x'] = 'כל עמוד רכיב מטלה';
$string['pagesize'] = 'מספר ההגשות שמוצגות בכל עמוד';
$string['pluginadministration'] = 'ניהול מטלה';
$string['pluginname'] = 'מטלה';
$string['popupinnewwindow'] = 'פתח בחלון חדש';
$string['preventlate'] = 'מנע שליחת תרגילים באיחור';
$string['quickgrade'] = 'מתן הערה וציון באופן מהיר';
$string['quickgrade_help'] = '**נתינת ציון במהירות**
אם אתם מאפשרים את האפשרות של בדיקה מהירה, אתם יכולים לבדוק ולתת ציון במהירות לכמה מטלות באותו העמוד.
פשוט שנו את הציונים ואת ההערות ותשתמשו בכפתור ה"שמור" שנמצא בתחתית העמוד כדי לשמור בבת אחת את כל השינויים שערכתם באותו עמוד.
הכפתורים הרגילים לבדיקה וציון שנמצאים בתד ימין עדיין עובדים במקרה שאתם זקוקים ליותר מקום. העדיפות שלכם לתהליך בדיקה מהיר תישמר, ותיושם על כל המטלות בכל הקורסים.';
$string['requiregrading'] = 'נדרש מתן ציון';
$string['responsefiles'] = 'קבצי תגובות';
$string['reviewed'] = 'נבדק';
$string['saveallfeedback'] = 'שמירת כל המשובים שלי';
$string['selectblog'] = 'בחר איזה ערך בלוג תרצה להגיש';
$string['sendformarking'] = 'שליחה סופית וקבלת ציון';
$string['showrecentsubmissions'] = 'הראה הגשות אחרונות';
$string['submission'] = 'הגשה';
$string['submissiondraft'] = 'טיוטא של הגשה';
$string['submissionfeedback'] = 'משוב על ההגשה';
$string['submissions'] = 'הגשות';
$string['submissionsaved'] = 'השינויים שלך נשמרו';
$string['submissionsnotgraded'] = '{$a} הגשות ממתינות להערכה';
$string['submitassignment'] = 'הגש את המטלה שלך באמצעות טופס זה';
$string['submitedformarking'] = 'המטלה הוגשה להערכה ולא ניתן לעדכן אותה';
$string['submitformarking'] = 'הגשה סופית וקבלת ציון מהמרצה';
$string['submitted'] = 'הוגש';
$string['submittedfiles'] = 'קבצים שהוגשו';
$string['subplugintype_assignment'] = 'סוג המטלה';
$string['subplugintype_assignment_plural'] = 'סוגי מטלה';
$string['trackdrafts'] = 'מנגנון ל:"שליחה סופית וקבלת ציון"';
$string['trackdrafts_help'] = 'כפתור "שליחה סופית" מאפשר למשתמשים לציין לנותני הציונים שהם סיימו לעבוד על המטלה. נותני הציונים יכולים לבחור אם לחזור למטלה למצב של טיוטה (אם המטלה מצריכה עוד זמן עבודה).';
$string['typeblog'] = 'פרסום בלוג';
$string['typeoffline'] = 'הגשה לא מקוונת';
$string['typeonline'] = 'הגשת טקסט מקוון';
$string['typeupload'] = 'הגשת מספר קבצים';
$string['typeuploadsingle'] = 'הגשת קובץ אחד';
$string['unfinalize'] = 'חזרה למצב טיוטא';
$string['unfinalize_help'] = 'חזרה למצב טויוטה מאפשר לסטודנט לערוך עדכונים נוספים להגשת המטלה זלו';
$string['unfinalizeerror'] = 'שגיאה התרחשה ולא ניתן להחזיר הגשה זו חזרה לטיוטא';
$string['uploadafile'] = 'העלאת קובץ';
$string['uploadbadname'] = 'שם קובץ זה הכיל תווים אסורים ואי אפשר היה להעלותו';
$string['uploadedfiles'] = 'קבצים שהועלו';
$string['uploaderror'] = 'חלה שגיאה בעת שמירת הקובץ על השרת';
$string['uploadfailnoupdate'] = 'הקובץ הועלה באופן תקין אבל אי אפשר היה לעדכן את הגשתך!';
$string['uploadfiles'] = 'העלאת קבצים';
$string['uploadfiletoobig'] = 'סליחה, אבל הקובץ גדול מדי (הגבול הוא {$a} ביטים)';
$string['uploadnofilefound'] = 'לא נמצא קובץ - האם אתה בטוח שבחרת קובץ להעלאה?';
$string['uploadnotregistered'] = '\'{$a}\' הועלה באופן תקין אבל ההגשה לא נרשמה!';
$string['uploadsuccess'] = '\'{$a}\' הועלה בהצלחה';
$string['usermisconf'] = 'משתמש לא מוגדר בצורה נכונה';
$string['usernosubmit'] = 'מצטערים, אין לך הרשאה להגיש מטלה זו';
$string['viewfeedback'] = 'ראה ציוני ומשובי תרגילים';
$string['viewmysubmission'] = 'צפה בהגשה שלי';
$string['viewsubmissions'] = 'הצגת {$a} תרגילים שהוגשו';
$string['yoursubmission'] = 'ההגשה שלך';
