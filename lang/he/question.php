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
 * Strings for component 'question', language 'he', branch 'MOODLE_22_STABLE'
 *
 * @package   question
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['action'] = 'פעולה';
$string['addanotherhint'] = 'הוספת רמז חדש';
$string['addcategory'] = 'הוסף קטגוריה';
$string['adminreport'] = 'דווח על בעיות אפשריות במסד הנתונים של שאלותיך';
$string['answer'] = 'תשובה';
$string['answersaved'] = 'תשובה נשמרה';
$string['attemptfinished'] = 'נסיון המענה הסתיים';
$string['attemptfinishedsubmitting'] = 'נסיון המענה נשלח והסתיים:';
$string['availableq'] = 'האם זמין?';
$string['badbase'] = 'מסד גרוע לפני  **: {$a}**';
$string['behaviour'] = 'התנהגות';
$string['behaviourbeingused'] = 'התנהגות בשימוש : {$a}';
$string['broken'] = 'זהו "קישור שבור" - הוא מצביע על קובץ שאיננו קיים';
$string['byandon'] = 'על ידי <em>{$a->user}</em> ב <em>{$a->time}</em';
$string['cannotcopybackup'] = 'לא ניתן להעתיק את קובץ הגיבוי';
$string['cannotcreate'] = 'לא ניתן ליצור ערך חדש בטבלת
question_attempts';
$string['cannotcreatepath'] = 'לא ניתן ליצור נתיב: {$a}';
$string['cannotdeletebehaviourinuse'] = 'לא ניתן למחוק את התנהגות  \'{$a}\'. היא נמצאת בשימוש על0ידי נסיונות מענה השאלה.';
$string['cannotdeletecate'] = 'לא ניתן למחוק את קטגוריה זו , זוהי קטגוריה קטגוריית ברירת המחדל עבור הקשר זה.';
$string['cannotdeletemissingbehaviour'] = 'לא ניתן להסיר את התקנת ההתנהגות החסרה. היא נדרשת על-ידי המערכת.';
$string['cannotdeletemissingqtype'] = 'לא ניתן למחוק את סוג השאלה החסר. הדבר דרוש למערכת.';
$string['cannotdeleteneededbehaviour'] = 'לא ניתן למחוק את התנהגות השאלה \'{$a}\'. ישנן התנהגויות אחרות אשר מותקנות ומסתמכות עליהן.';
$string['cannotdeleteqtypeinuse'] = 'לא ניתן למחוק את סוג השאלה \'{$a}\'.
ישנם שאלות מסוג זה במאגר השאלות.';
$string['cannotdeleteqtypeneeded'] = 'לא ניתן למחוק את סוג השאלה \'{$a}\'. ישנם סוגי שאלות אחרים מותקנים אשרמסתמכים על סוג זה של שאלה.';
$string['cannotenable'] = 'סוג שאלה {$a} לא ניתנת ליצירה ישירות';
$string['cannotenablebehaviour'] = 'התנהגות שאלה {$a}  לא יכולה להיות בשימוש ישירות . לשימוש פנימי בלבד.';
$string['cannotfindcate'] = 'לא ניתן למצוא את רשומת הקטגוריה';
$string['cannotfindquestionfile'] = 'לא ניתן למצוא את  קובץ מידע השאלה בארכיב ה-zip';
$string['cannotgetdsfordependent'] = 'לא ניתן לקבל את מערך הנתונים (dataset) המצויין עבור  dataset dependent שאלת!
(question: {$a->id}, datasetitem: {$a->item})';
$string['cannotgetdsforquestion'] = 'לא ניתן לקבל את מערך הנתונים  (dataset) המצויין עבור שאלת חישוב
(question: {$a})';
$string['cannothidequestion'] = 'לא היה ניתן להסתיר שאלה';
$string['cannotimportformat'] = 'סליחה, יבוא תסדיר זה לא מיושם עדיין!';
$string['cannotinsertquestion'] = 'לא ניתן להכניס שאלה חדשה!';
$string['cannotinsertquestioncatecontext'] = 'לא ניתן היה להכניס את השאלת הקטגוריה החדשה
{$a->cat} לא חוקי contextid {$a->ctx}';
$string['cannotloadquestion'] = 'לא ניתן היה להטעין שאלה';
$string['cannotmovequestion'] = 'לא ניתן להשתמש בתסריט זה בכדי להעביר שאלות שלהן  קבצים המשוייכים להן מאיזורים שונים.';
$string['cannotopenforwriting'] = 'לא ניתן לפתוח לכתיבה: {$a}';
$string['cannotpreview'] = 'לא ניתן לצפות בתצוגה מקדימה בשאלות אלו!';
$string['cannotread'] = 'לא ניתן לקרוא את הקובץ המיובא (או שהקובץ ריק)';
$string['cannotretrieveqcat'] = 'לא ניתן לקבל את קטגוריית השאלה';
$string['cannotunhidequestion'] = 'נכשל בנסיון להציג את השאלה';
$string['cannotunzip'] = 'לא ניתן היה לחלץ את קובץ הארכיב unzip';
$string['cannotwriteto'] = 'לא ניתן היה לכתוב שאלות אשר יוצאו ל {$a}';
$string['category'] = 'קטגוריה';
$string['categorycurrent'] = 'קטגוריה נוכחית';
$string['categorycurrentuse'] = 'השתמש בקטגוריה זאת';
$string['categorydoesnotexist'] = 'קטגוריה זו לא קיימת';
$string['categoryinfo'] = 'מידע הקטגוריה';
$string['categorymove'] = 'הקטגוריה \'{$a->name}\' מכילה {$a->count} שאלות (חלק מהן עלולות להיות ישנות, מוסתרות, או שאלות שעדיין בשימוש בבחנים קיימים).<br />אנא בחר קטגוריה אחרת אליה ניתן להעביר אותם.';
$string['categorymoveto'] = 'שמירה בקטגוריה';
$string['categorynamecantbeblank'] = 'שם הקטגוריה אינו יכול להיות ריק';
$string['changeoptions'] = 'שינוי אפשרויות';
$string['changepublishstatuscat'] = '<a href="{$a->caturl}">לקטגוריה "{$a->name}"</a>בקורס "{$a->coursename}" יהיה מצב שיתופי שישונה מ<strong>{$a->changefrom} ל{$a->changeto} </strong>';
$string['check'] = 'בדוק';
$string['chooseqtypetoadd'] = 'בחר סוג שאלה להוספה';
$string['clearwrongparts'] = 'אפס תגובות שגויות';
$string['clickflag'] = 'סמן את השאלות';
$string['clicktoflag'] = 'סמן שאלה זו עבור התייחסות עתידית';
$string['clicktounflag'] = 'לחץ בכדי להסיר את הסימון שאלה זו';
$string['clickunflag'] = 'הסר סימון';
$string['closepreview'] = 'סגירת התצוגה המקדימה';
$string['combinedfeedback'] = 'משובים מורכבים';
$string['comment'] = 'הערה';
$string['commented'] = 'העירו : {$a}';
$string['commentormark'] = 'רשום הערה או עקוף ניקוד';
$string['comments'] = 'הערות';
$string['commentx'] = 'הערה: {$a}';
$string['complete'] = 'השלמה';
$string['contexterror'] = 'לא היית צריך להגיע לכאן אם אינך מעביר קטגוריה להקשר אחר.';
$string['copy'] = 'העתק מ {$a} ושנה את הקישורים';
$string['correct'] = 'נכון';
$string['correctfeedback'] = 'עבור כל תגובה נכונה';
$string['created'] = 'נוצר ב-';
$string['createdby'] = 'נוצר על-ידי';
$string['createdmodifiedheader'] = 'נוצר/עודכן';
$string['createnewquestion'] = 'יצירת שאלה חדשה...';
$string['cwrqpfs'] = 'בחירה של שאלות אקראיות מתת-קטגוריות.';
$string['cwrqpfsinfo'] = '<p>
בעת העידכון למוודל 1.9 אנו נפריד את קטגוריות השאלה להקשרים שונים. מספר קטגוריות של שאלות ושאלות באתר שלכם יצטרכו לעבור שינוי במצב השיתוף שלהן. הדבר הכרחי במקרים הבודדים שאחת או יותר מהשאלות ה\'אקראיות\' בבוחן הוגדרו שהן נבחרות מתערובת של קטגוריות משותפות וקטגוריות לא משותפות (שזה המצב באתר זה). זה מתרחש כאשר הוחלט לבחור שאלה \'אקראית\' מתת-קטגוריות, ולאחת או יותר תת-הקטגוריות יש מצב שיתוף שונה מקטגורית ה\'אב\' שבה נוצרה השאלה האקראית.
</p>
<p>
בקטגוריות השאלה הבאות, שמהן נבחרו שאלות \'אקראיות\' מקטגוריות ה\'אבות\', יחול שיוני במצב לאותו מצב שיתוף כמו הקטגוריה של השאלה ה\'אקראית\' בעת העידכון למהדורה 1.9. לקטגוריות הבאות ישתנה מצב השיתוף. השאלות שדבר זה יכול עליהן ימשיכו לעבוד בכל הבחנים הקיימים עד שתסירו אותם מבחנים אלו.';
$string['cwrqpfsnoprob'] = 'שום קטגוריות שאלות באתר שלכם איננה מושפעת על ידי השאלות ה\'אקראיות\' הבוחדרות שאלות מתת-קטגוריות.';
$string['decimalplacesingrades'] = 'מקומות דצימלים בציונים';
$string['defaultfor'] = 'ברירת המחדל עבור {$a}';
$string['defaultinfofor'] = 'קטגוריית ברירת המחדל המשותפת לשאלות בהקשר  \'{$a}\'.';
$string['defaultmark'] = 'ניקוד ברירת מחדל';
$string['deletebehaviourareyousure'] = 'מחק התנהגות {$a}: האם אתה בטוח?';
$string['deletebehaviourareyousuremessage'] = 'הינך עומד למחוק לחלוטין את התנהגות השאלה {$a}. הדבר עלול למחוק כל מה שקשור במסד הנתונים עם התנהגות השאלה. האם אתה בטוח בכך?';
$string['deletecoursecategorywithquestions'] = 'קיימות שאלות במאגר השאלות המשוייכות לקטגוריית קורס זה. אם תמשיך, הן תימחקנה. תוכל להעבירם למקום אחר באמצעות שימוש בבנק השאלות';
$string['deleteqtypeareyousure'] = 'האם אתה בטוח כי ברצונך למחוק את סוג השאלה \'{$a}\' ?';
$string['deleteqtypeareyousuremessage'] = 'הינך עומד למחוק לחלוטין את סוג השאלה
\'{$a}\'.
האם אתה בטוח בהסרתו?';
$string['deletequestioncheck'] = 'האם הינך בטוח כי ברצונך למחוק  את \'{$a}\' לחלוטין?';
$string['deletequestionscheck'] = 'האם הינך בטוח כי ברצונך למחוק את השאלה הבאה?
<br /><br />{$a}';
$string['deletingbehaviour'] = 'מחיקת התנהגות השאלה
\'{$a}\'';
$string['deletingqtype'] = 'מוחק את סוג השאלה \'{$a}\'';
$string['disabled'] = 'כבוי';
$string['disterror'] = 'תפוצת ה {$a} גרמה לבעיות';
$string['donothing'] = 'אל תעתיק או תזיז קבצים או שנה קישורים';
$string['editcategories'] = 'ערוך קטגוריות';
$string['editcategories_help'] = 'במקום להחזיר את כל השאלות ברשימה אחת ארוכה, השאלות יכולות להיות מסודרות בקטגוריות ותתי-קטגוריות.
לכל קטגוריה ישנו הקשר אשר קובע היכן ניתן להשתמש בשאלות מהקטגוריה:
* בהקשר של פעילות - שאלות תיהינה זמינות ברכיב הפעילות בלבד.
* הקשר הקורס - שאלות תיהינה זמינות בכל רכיב פעילות בקורס.
* הקשר קטגורית הקורס - שאלות תיהינה זמינות בכל רכיבי פעילות ובקורסים בקטגורית הקורס.
* הקשר המערכת - שאלות תיהינה זמינות בכל הקורסים והפעילויות באתר כולו.
ניתן להשתמש בקטגוריות עבור שאלות אקראיות , כאשר שאלות נבחרות מקטגוריה מסויימת.';
$string['editcategory'] = 'עריכת קטגוריה';
$string['editingcategory'] = 'עריכת קטגוריה';
$string['editingquestion'] = 'עריכת שאלה';
$string['editquestion'] = 'עריכת שאלה';
$string['editquestions'] = 'עריכת שאלות';
$string['editthiscategory'] = 'עדכן קטגוריה זו';
$string['emptyxml'] = 'שגיאה לא מוכרת - רוקן את קובץ
imsmanifest.xml';
$string['enabled'] = 'מאופשר';
$string['erroraccessingcontext'] = 'לא מסוגל להתחבר להקשרים';
$string['errordeletingquestionsfromcategory'] = 'שגיאה במחיקת שאלות מקטגוריה {$a}.';
$string['errorduringpost'] = 'שגיאה התרחשה לאחר העיבוד!';
$string['errorduringpre'] = 'שגיאה התרחשה לפני העיבוד!';
$string['errorduringproc'] = 'שגיאה התרחשה בזמן העיבוד!';
$string['errorduringregrade'] = 'לא ניתן לתת ציון מחדש לשאלה {$a->qid}, מגיע למצב {$a->stateid}.';
$string['errorfilecannotbecopied'] = 'שגיאה - לא ניתן להעתיק את קובץ {$a}';
$string['errorfilecannotbemoved'] = 'שגיאה - לא ניתן להזיז את קובץ {$a}';
$string['errorfileschanged'] = 'קבצי שגיאה שקושרו משאלות שונו מבעת האחרונה שהטופס הוצג.';
$string['errormanualgradeoutofrange'] = 'הציון {$a->grade}  לא בין 0 ו- {$a->maxgrade} עבור השאלה {$a->name}. הציון והמשום לא נשמרו.';
$string['errormovingquestions'] = 'שגיאה כאשר מעבירים שאלות עם מספרי זהוי הבאים {$a}.';
$string['errorpostprocess'] = 'שגיאה התרחשה לאחר העיבוד!';
$string['errorpreprocess'] = 'שגיאה התרחשה לפני העיבוד!';
$string['errorprocess'] = 'שגיאה התרחשה בזמן העיבוד!';
$string['errorprocessingresponses'] = 'שגיאה חלה כאשר נעבדו התגובות  ({$a}).
לחץ "המשך" בכדי לחזור לדף הקודם ונסה שנית.';
$string['errorsavingcomment'] = 'שגיאה בשמירת תגובה לשאלה {$a->name} במסד נתונים זה.';
$string['errorsavingflags'] = 'שגיאה בעת שמירת מצב הדגל.';
$string['errorupdatingattempt'] = 'שגיאה בעדכון נסיון {$a->id} במסד נתונים זה.';
$string['exportcategory'] = 'ייצא קטגוריה';
$string['exportcategory_help'] = '**יצוא קטגוריה**
**קטגוריית** התפריט הנפתח ניתנת לשימוש לבחירת הקטגוריה מהיכן שהשאלות המיוצאת ילקחו.
כמה תסדירים מיובאים (gifs ותסדיריXML) מרשים לקטגוריה להיכלל בקובץ הניתן לכתיבה, מאפשרים לקטגוריות (בצורה אופציונלית) להיווצר מחדש כאשר מייבאים. על מנת שמידע זה יכלל תיבת ה**"לקובץ" (to file)** חייבת להיות מסומנת';
$string['exporterror'] = 'שגיאה התרחשה בזמן היצוא!';
$string['exportfilename'] = 'בוחן';
$string['exportnameformat'] = '%Y%m%d-%H%M';
$string['exportquestions'] = 'יצוא שאלות לקובץ';
$string['exportquestions_help'] = '**ייצוא שאלות מקטגוריה**
פונקציה זו מאפשרת לכם לייצא קטגורית שאלות שלמה (בנוסף לכל התת-קטגוריות שלה) לתוך קובץ טקסט.

אנא שימו לב שבתסדירים רבים של קבצים נאבד מידע כלשהוא בתהליך ייצוא השאלות.
הדבר קורה מפני שתסדירים רבים לא מכילים את כל התכונות שקיימות בשאלות מוודל. אל תצפו שתוכלו לייבא ולייצא שאלות ושהן יישארו זהות. בנוסף קיימת האפשרות שחלק מסוגי השאלות לא יהיה ניתן לייצא.
מומלץ שתבדקו נתונים מיוצאים לפני שתשתמשו בהם בסביבת ייצור.

התסדירים שנתמכים נכון לעכשיו הם:
**תסדיר GIFT**
GIFT הינו תסדיר קובץ הייבוא הכי מקיף שבאמצעותו ניתן לייבא שאלות לבחנים של מוודל מתוך קבצי טקסט. הוא תוכנן להיות שיטה פשוטה למורים שכותבים את שאלותיהם בתוך קבצי טקסט. GIFT תומך בשאלות נכון/לא-נכון, שאלות אמריקאיות, שאלות תשובה-קצרה, שאלות התאמה ושאלות בעלות תשובות מספריות, בנוסף לשאלות בתסדיר "המילה החסרה", בהם מחדירים \_\_\_|\_\__| . בקובץ טקסט יחיד ניתן לערבב מספר סוגים שונים של שאלות, ובנוסף לכך, התסדיר תומך בהערות, נתינת שמות לשאלות, משוב וציונים המבוססים על אחוזים והמשקל שניתן להם. הנה כמה דוגמאות:
מי קבור בקבר של גראנט?{~גראנט ~ג\'פרסון =אף אחד}
גראנט{~קבור =לקבור ~חי} בקבר של גראנט.
גראנט קבור בקבר של גראנט.{לא נכון}
מי קבור בקבר של גראנט?{=אף אחד =אף אחד לא}
מתי נולד יוליסס ס. גרנט (Ulysses S. Grant) ?{#

**תסדיר Moodle XML**
תסדיר זה הספציפי למוודל מייצא שאלות של בחנים בתוך תסדיר XML פשוט. לאחר מכן ניתן לייבא אותן לתוך קטגוריית בחנים אחרת או להשתמש בהן בתהליכים אחים כמו טרנספורמציית XSLT. תסדיר ה-XML ייצא תמונות המצורפות לשאלות (קידוד base64).

**IMS QTI 2.0**

מייצא בתסדיר IMS QTI (version 2.0) סטנדרטי. שימו לב שתהליך זה מחולל קבוצה של קבצים בתוך קובץ \'zip\' יחיד.
[מידע נוסף באתר ה- IMS QTI ](http://www.imsglobal.org/question)
(אתר חיצוני בחלון חדש)

**XHTML**
מייצא את הקטגוריה כעמוד יחיד של XHTML \'קפדן\'. כל שאלה ממוקמת בבהירות בתוך תג
משלה. אם אתם רוצים להשתמש בעמוד זה כמו שהוא, תצטרכו, לפחות, לערוך את תג ה-<צורה> שנמצא בתחילת קטע ה-<גוף> כדי לספק פעולה מתאימה (לדוגמא \'שלח ל\').

בעתיד יתווסו תסדירים נוספים, כולל WebCT וכל דבר אחר.
משתמשי מוודל יכולים לתרום!
';
$string['feedback'] = 'משוב';
$string['filecantmovefrom'] = 'קבצי השאלות לא ניתנות להעברה מפני שאין לך הרשאות להעברת קבצים מהמקום שהינך מנסה להעביר את השאלות.';
$string['filecantmoveto'] = 'קבצי השאלות לא ניתנות להעברה או להעתקה מפני שאין לך הרשאות ללהוספת קבצים אל המקום שהינך מנסה להעביר את השאלות.';
$string['fileformat'] = 'תסדיר הקובץ';
$string['filesareacourse'] = 'אזור הקבצים של הקורס';
$string['filesareasite'] = 'אזור הקבצים של האתר';
$string['filestomove'] = 'העתק/הסט קבצים ל-{$a}?';
$string['fillincorrect'] = 'מלא תגובות נכונות.';
$string['flagged'] = 'סומן';
$string['flagthisquestion'] = 'סמן את השאלה הזו';
$string['formquestionnotinids'] = 'הטופס מכיל שאלות אשר אינם ב
questionids';
$string['fractionsnomax'] = 'על אחת מהתשובות להיות בעלת תוצאה של 100%, כך שזה יהיה אפשרי לקבל את מלוא הנקודות עבור שאלה זו.';
$string['generalfeedback'] = 'משוב כללי';
$string['generalfeedback_help'] = 'המשוב הכללי נראה לסטודנט לאחר נסיון המענה שלהם לשאלה. בניגוד למשוב רגיל, אשר תלוי בסוג השאלה ותגובת הסטודנט לשאלה, המצב הזה יהיה גלוי לכל הסטודנטים.
ניתן להשתמש במשוב הכללי לתת לסטודנטים קצת רקע ומידע על השאלה, או לתת להם קישור למידע נוסף שיוכלו להשתמש בו אם לא הבינו את השאלות';
$string['getcategoryfromfile'] = 'קבל קטגוריה מהקובץ';
$string['getcontextfromfile'] = 'קבל הקשר מהקובץ';
$string['hidden'] = 'מוסתר';
$string['hintn'] = 'רמז  {no}';
$string['hinttext'] = 'תוכן הרמז';
$string['howquestionsbehave'] = 'כיצד מתנהגות שאלות.';
$string['ignorebroken'] = 'התעלם מקישורים שבורים';
$string['importcategory'] = 'יבוא קטגוריה';
$string['importcategory_help'] = '**יבוא קטגוריה**
ה**קטגוריה:**תפריט נפתח משמשת על מנת שתבחרו מתוכה את הקטגוריה בה ימוקמו השאלות המיובאות.

תסדירי יבוא מסויימים (תסדיר GIFT ו-XML) מאפשרים לפרט את הקטגוריה בתוך קובץ הייבוא. כדי שזה יקרה, צריך לסמן את קופסאת **מקובץ**. אם היא לא מסומנת השאלות ישלחו לקטגוריה המסומנת ללא כל התחשבות בהוראות כלשהן שיופיעו בקובץ.

כשמפרטים קטגוריות בתוך קובץ יבוא, במידה והן לא קיימות, הן יווצרו.';
$string['importerror'] = 'התגלתה שגיאה בתהליך היבוא.';
$string['importerrorquestion'] = 'שגיאה במהלך היבוא';
$string['importfromcoursefiles'] = '... או בחר קובץ קורס ליבוא';
$string['importfromupload'] = 'בחירת קובץ להעלאה...';
$string['importingquestions'] = 'יבוא  שאלות {$a} מהקובץ';
$string['importquestions'] = 'יבוא שאלות מקובץ';
$string['importquestions_help'] = 'הפונקציה מאפשרת לייבא שאלות מסויגים שונים של תסדיטרים דרך קובץ טקסט, שים לב כי עליך להגדירו תומך ב קידוד
UTF-8';
$string['impossiblechar'] = 'התו {$a} הזה איננו אפשרי
והוא נמצא בסוגריים';
$string['includesubcategories'] = 'הצגת שאלות מתתי-קטגוריה';
$string['incorrect'] = 'שגוי';
$string['incorrectfeedback'] = 'עבור כל תשובה שגויה';
$string['information'] = 'מידע';
$string['invalidanswer'] = 'שאלה לא גמורה';
$string['invalidarg'] = 'לא סופקו ערכים תקינים למשתנה או שהגדרות השרת אינן תקינות';
$string['invalidcategoryidforparent'] = 'מספר זיהוי ID של הקטגוריה עבור האב איננו תקין';
$string['invalidcategoryidtomove'] = 'מספר זיהוי ID של הקטגוריה לא תקין להעברה';
$string['invalidconfirm'] = 'מחרוזת האישור לא נכונה';
$string['invalidcontextinhasanyquestions'] = 'מועבר הקשר לא חוקי question_context_has_any_questions.';
$string['invalidpenalty'] = 'קנס לא תקין';
$string['invalidwizardpage'] = 'לא נכון או שלא צויין גף אשף';
$string['lastmodifiedby'] = 'שונה לאחרונה על-ידי';
$string['linkedfiledoesntexist'] = 'הקובץ המקuשר {$a} לא קים';
$string['makechildof'] = 'צור תת־קטגוריה  {$a}';
$string['makecopy'] = 'צור העתק';
$string['maketoplevelitem'] = 'הסט לרמה עליונה';
$string['manualgradeoutofrange'] = 'ציון זה מחוץ לטווח תקין';
$string['manuallygraded'] = 'ניקוד ידני {$a->mark} עם הערה: {$a->comment}';
$string['mark'] = 'ניקוד';
$string['markedoutof'] = 'ניקוד השאלה';
$string['markedoutofmax'] = 'ניקוד השאלה: {$a}';
$string['markoutofmax'] = '{$a->mark} נקודות מתוך {$a->max}';
$string['marks'] = 'נקודות';
$string['matcherror'] = 'הציונים אינם תואמים את אפשרויות הציון - השאלה דולגה';
$string['matchgrades'] = 'ציונים מתאימים';
$string['matchgrades_help'] = '**התאם ציונים**
**חובה ** שהציונים המיובאים יתאימו לאחת מהרשימות הקבועות של הציונים התקפים, כדלקהמן....

* 100%
* 90%
* 80%
* 75%
* 70%
* 66.666%
* 60%
* 50%
* 40%
* 33.333
* 30%
* 25%
* 20%
* 16.666%
* 14.2857
* 12.5%
* 11.111%
* 10%
* 5%
* 0%

גם ערכים שליליים מותרים עבור הרשימה לעיל.

ישנן שתי הגדרות עבור מתג זה. הן משפיעות על האופן שבו נוהל היבוא מטפל בערכים שלא מתאימים
**לחלוטין** לאחד הערכים ברשימה לעיל.

\* **|שגיאה אם הציון לא רשום**
אם השאלה מכילה ציונים כלשהם שלא נמצאים ברשימה מוצגת הודעת שגיאה והשאלה המסויימת ההיא לא תיובא.
\* **|הציון הקרוב ביותר, במידה ולא רשום**
אם נמצא ציון שלא תואם ערך כלשהו ברשימה, הציון ישונה לערך המתאים הקרוב ביותר ברשימה.

*הערה: חלק מתסדירי הייבוא המותאימים אישית מייבאים ישירות לתוך בסיס הנתונים ובכך עלולים לעקוף את הבדיקה הזו.
*';
$string['matchgradeserror'] = 'שגיאה אם ציון לא ברשימה';
$string['matchgradesnearest'] = 'ציון קרוב ביותר אם לא נמצא ברשימה';
$string['missingcourseorcmid'] = 'יש צורך לספק  courseid  או
cmid
עבור
print_question.';
$string['missingcourseorcmidtolink'] = 'יש צורך לספק  courseid  או
cmid
עבור
get_question_edit_link.';
$string['missingimportantcode'] = 'לסוג שאלה זה חסר קוד חשוב: {$a}.';
$string['missingoption'] = 'שאלה משובצת cloze
{$a} הגדרותיה חסרות לה';
$string['modified'] = 'שונה';
$string['move'] = 'הסט מ-{$a} ושנה את הקישורים';
$string['movecategory'] = 'הסט קטגוריה';
$string['movedquestionsandcategories'] = 'שאלות וקטגוריית שאלות מועברים מ{$a->oldplace} to {$a->newplace}.';
$string['movelinksonly'] = 'שנה את ההצבעה של הקישורים, אלח תזיז או תעתיק את הקבצים';
$string['moveq'] = 'שאלות נוספות';
$string['moveqtoanothercontext'] = 'הסט השאלה להקשר';
$string['moveto'] = 'העברה ל >>';
$string['movingcategory'] = 'הסטת קטגוריה';
$string['movingcategoryandfiles'] = 'האם אתה בטוח שאתה רוצה להעביר את הקטגוריה  {$a->name} וכל צאצאי הקטגוריה לקונטקסט עבור "{$a->contextto}"?<br/> הבחנו {$a->urlcount} בקבצים המקושרים משאלות ב{$a-fromareaname}, האם תרצה להעתיק או להעביר אותם ל{$a->toareaname?';
$string['movingcategorynofiles'] = 'האם אתה בטוח שאתה רוצה להזיז את קטגוריה "{$a->name}" וכל צאצאי הקטגוריות להקשר עבור "{$a->contextto}?';
$string['movingquestions'] = 'הסטת שאלות וכל קובץ שהוא';
$string['movingquestionsandfiles'] = 'האם אתה בטוח שאתה רוצה להעביר שאלות {$a->questions} לקונטקסט עבור <strong>"{$a->tocontext}"</strong>?<br /> הבחנו <strong>{$a->urlcount} בקבצים </strong> המקושרים משאלות אלו ב{$a->fromareaname}, האם תרצה להעתיק רו להעביר אותם ל{$a->toareaname}?';
$string['movingquestionsnofiles'] = 'האם אתה בטוח שאתה רוצה להעביר שאלהות {$a->questions} לקונטקסט עבור <strong>"{$a->tocontext}"</strong>?<br/> לא נמצאו <strong> כל קבצים</strong> המקושרים משאלות אלו ב{$a->fromareaname}';
$string['needtochoosecat'] = 'עליך לבחור קטגוריה להזיז זאלה זאת אליה או לחץ על \'בטל\'';
$string['nocate'] = 'לא נמצאה קטגוריה זו {$a}';
$string['nopermissionadd'] = 'אין לך רשות להוסיף שאלות במקום זה';
$string['nopermissionmove'] = 'אין לך הרשאות להעביר שאלות מכאן. אתה מוכרח לשמור את השאלה בקטגוריה זו או לשמור אותה כשאלה חדשה.';
$string['noprobs'] = 'לא נמצאו בעיות כלשהן עם מסד הנתונים של שאלותיך';
$string['noquestionsinfile'] = 'אין שאלות בקובץ היבוא.';
$string['noresponse'] = '[אין תגובה]';
$string['notanswered'] = 'אין תשובות שנענו';
$string['notenoughanswers'] = 'סוג זה של שאלות מצריך  לפחות  {$a} תשובות';
$string['notenoughdatatoeditaquestion'] = 'לא פורטו, לא מספר זיהוי השאלה, לא מספר זיהוי הקטגוריה ולא סוג השאלה.';
$string['notenoughdatatomovequestions'] = 'עליך לספק את מספרי הזיהוי של השאלות שאתה רוצה להזיז';
$string['notflagged'] = 'לא סומן';
$string['notgraded'] = 'לא ניתן ציון';
$string['notshown'] = 'לא נראה';
$string['notyetanswered'] = 'שאלה זו טרם נענתה';
$string['notyourpreview'] = 'תצוגה מקדימה זו איננה שייכת לך';
$string['novirtualquestiontype'] = 'לא קיים סוג שאלה וירטואלי עבור סוג השאלה
{$a}';
$string['numqas'] = 'אין נסיונות לשאלה';
$string['numquestions'] = 'אין שאלות';
$string['numquestionsandhidden'] = '{$a->numquestions} (+{$a->numhidden} מוסתר)';
$string['options'] = 'אפשרויות';
$string['page-question-category'] = 'עמוד קטגורית השאלה';
$string['page-question-edit'] = 'עמוד עריכת השאלה';
$string['page-question-export'] = 'עמוד יצוא השאלה';
$string['page-question-import'] = 'עמוד יבוא השאלה';
$string['page-question-x'] = 'כל עמוד שאלה';
$string['parent'] = 'אב';
$string['parentcategory'] = 'קטגוריית אב';
$string['parentcategory_help'] = '## אב
הקטגוריה שבה זה יוצב. "למעלה" כלומר, זו קטגוריה זו לא מוכלת באף קטגוריה אחרת.
בדר"כ תבחין בהקשרי קטגוריה אשר תראה באופן מודגש, שים לב כי כל הקשר מכיל את היררכיית הקטגוריה שלו. ראה למטה עוד פרטים על כך. אם אינך רואה כמה הקשרי קטגוריות, זאת מפני שאין לך הרשאה לגשת להקשרים אלו.
אם יש רק קטגוריה אחת בהקשר, לא תוכל להעביר את הקטגוריה כפי שחייבת להיות לפחות קטגוריה אחת בהקשר זה.
ראה גם:
* \[קטגוריות שאלה\]\[1\]
* \[הקשרי קטגוריה\]\[2\]
* \[הרשאות שאלה\]\[3\]
[1]: help.php?module=question&file=categories.html
[2]: help.php?module=question&file=categorycontexts.html
[3]: help.php?module=question&file=permissions.html';
$string['parenthesisinproperclose'] = 'סוגריים לפני ** לא נסגר בצורה תקינה ב-
{$a}**';
$string['parenthesisinproperstart'] = 'סוגריים לפני ** לא נפתח בצורה תקינה ב-
{$a}**';
$string['parsingquestions'] = 'ניתוח שאלות מקובץ היבוא';
$string['partiallycorrect'] = 'נכון חלקית';
$string['partiallycorrectfeedback'] = 'עבור תגובה הנכונה באופן חלקי';
$string['penaltyfactor'] = 'גורם הקנס עבור תשובה שגויה';
$string['penaltyfactor_help'] = '**פקטור הקנס**
בידיכם האפשרות לבחור איזה אחוז מהתוצאה שהושגה יש להוריד עבור כל תגובה שגויה. אפשרות זו רלוונטית רק במידה והבוחן שלכם מורץ במצב מסתגל בו מתאפשר לסטודנט לעשות ניסיונות חוזרים כדי לענות על השאלה. על פקטור הקנס להיות מספר אחד בין 0 ל-1. פקטור קנס של 1 משמעותו שהסטודנט חייב לענות על התשובה נכון בתגובה הראשונה שלו כדי לקבל נקודות כלשהן. פקטור קנס של 0 משמעותו שהסטודנט יכול לענות על כל שאלה כמה פעמים שהוא רק רוצה ועדיין לקבל עליה את מלוא הנקודות.';
$string['penaltyforeachincorrecttry'] = 'קנס בעת נסיון מענה שגוי';
$string['permissionedit'] = 'ערוך שאלה זאת';
$string['permissionmove'] = 'הסט שאלה זאת';
$string['permissionsaveasnew'] = 'שמירת שאלה זו כחדשה';
$string['permissionto'] = 'יש לך רשות:';
$string['previewquestion'] = 'שאלת תצוגה מקדימה:  {$a}';
$string['published'] = 'פורסם';
$string['qtypeveryshort'] = 'T';
$string['questionaffected'] = '<a href="{$a->qurl}">שאלה "{$a->name}" ({$a->qtype})</a> בקטגורית שאלה זו אך היא גם נלקחת בשימוש ב<a href="{$a->qurl}"> בוחן "{$a->quizname}"</a> בקורס אחר "{$a->coursename}';
$string['questionbank'] = 'מאגר שאלות';
$string['questionbehaviouradminsetting'] = 'הגדרות התנהגות שאלה';
$string['questionbehavioursdisabled'] = 'מניעת התנהגויות השאלה';
$string['questionbehavioursorder'] = 'סדר התנהגויות השאלה';
$string['questioncategory'] = 'קטגוריית שאלה';
$string['questioncatsfor'] = 'קטגוריות שאלה עבור \'{$a}\'';
$string['questiondoesnotexist'] = 'שאלה זו לא קיימת.';
$string['questionname'] = 'שם השאלה';
$string['questionno'] = 'שאלה {$a}';
$string['questions'] = 'שאלות';
$string['questionsaveerror'] = 'שגיאות נמצאו בזמן שמירת השאלה - ({$a})';
$string['questionsmovedto'] = 'שאלות שבשימוש הועברו ל"{$a}" בקטגוריית קורס האב.';
$string['questionsrescuedfrom'] = 'שאלות נשמרו מקונטקסט {$a}.';
$string['questionsrescuedfrominfo'] = 'שאלות אלו (כאלו שכנראה הוסתרו) נשמרו כאשר קונטקסט {$a} נמחקו מפני שהם עדיין בשימוש ע"י בחנים ופעילויות מסויימות.';
$string['questiontext'] = 'שאלת טקסט';
$string['questiontype'] = 'סוג השאלה';
$string['questionuse'] = 'השתמש בשאלה בפעילות זאת';
$string['questionvariant'] = 'סוג שאלה';
$string['questionx'] = 'שאלת {$a}';
$string['requiresgrading'] = 'נדרש מתן ציון';
$string['responsehistory'] = 'היסטורית תגובות';
$string['restart'] = 'התחל שוב';
$string['restartwiththeseoptions'] = 'התחל שוב עם הגדרות אלו';
$string['reviewresponse'] = 'תצוגת תגובה';
$string['rightanswer'] = 'תשובה נכונה';
$string['saved'] = 'נשמר: {$a}';
$string['saveflags'] = 'שמירת מצב הסמנים';
$string['selectacategory'] = 'בחר קטגוריה:';
$string['selectaqtypefordescription'] = 'בחר סוג שאלה בכדי לראות את התיאור שלה.';
$string['selectcategoryabove'] = 'בחר בקטגוריה שמופיעה לעיל';
$string['selectquestionsforbulk'] = 'בחר שאלות עבור פעולות חתך';
$string['settingsformultipletries'] = 'הגדרות עבור נסיונות מרובים';
$string['shareincontext'] = 'העבר לקטגוריה {$a}';
$string['showhidden'] = 'הצגת שאלות ישנות (אשר קיימות בבחנים אך נמחקו מהמאגר)';
$string['showmarkandmax'] = 'הצגת ניקוד וניקוד מירבי';
$string['showmaxmarkonly'] = 'הצגת ניקוד מירבי בלבד';
$string['shown'] = 'הוצג';
$string['shownumpartscorrect'] = 'הצג את מספר התגובות הנכונות';
$string['shownumpartscorrectwhenfinished'] = 'הצג את מספר התגובות הנכונות';
$string['showquestiontext'] = 'הצגת תוכן השאלה תחת שם השאלה';
$string['specificfeedback'] = 'משוב עבור כל מסיח';
$string['started'] = 'התחיל';
$string['state'] = 'מצב';
$string['step'] = 'צעד';
$string['stoponerror'] = 'עצור בשגיאה';
$string['stoponerror_help'] = 'הגדרה זו קובעת אם תהליך היבוא נעצר כאשר שגיאה מתרחשת, כתוצאה מכך אף שאלה לא תיובא, או שאם ישנן שאלות המכילות שגיאות, הן תתעלמנה וכל שאלה תקינה שתיהיה תיובא.';
$string['submit'] = 'שליחה';
$string['submitandfinish'] = 'שליחה וסיום';
$string['submitted'] = 'שליחה:  {$a}';
$string['tofilecategory'] = 'כתוב את הקטגוריה לקובץ';
$string['tofilecontext'] = 'כתוב את ההקשר לקובץ';
$string['uninstallbehaviour'] = 'הסרת התקנת התנהגות שאלה זו.';
$string['uninstallqtype'] = 'הסרת סוג שאלה זה';
$string['unknown'] = 'לא ידוע';
$string['unknownbehaviour'] = 'התנהגות לא ידועה:  {$a}.';
$string['unknownquestion'] = 'שאלה לא ידועה:  {$a}.';
$string['unknownquestioncatregory'] = 'קטגורית שאלות לא ידועה:  {$a}.';
$string['unknownquestiontype'] = 'סוג שאלה לא ידוע: {$a}.';
$string['unknowntolerance'] = 'סוג מרווח סבילות {$a} לא ידוע';
$string['unpublished'] = 'לא פורסם';
$string['upgradeproblemcategoryloop'] = 'בעיה הובחנה כאשר עודכנה קטגוריית שאלות. קיימת לולאה בעץ הקטגוריה. מספרי זיהוי הקטגוריה המושפעים הם {$a}.';
$string['upgradeproblemcouldnotupdatecategory'] = 'לא ניתן היה לעדכן את קטגוריית השאלה {$a->name} ({$a->id}).';
$string['upgradeproblemunknowncategory'] = 'בעיה הובחנה כאשר עודכנה קטגוריית שאלות. קטגוריית  {$a->id} מתייחסת לאב {$a->parent} אשר איננו קיים. האב שונה לתקן את המצב הנ"ל.';
$string['whethercorrect'] = 'האם התשובה נכונה';
$string['withselected'] = 'עם הנבחר';
$string['wrongprefix'] = 'nameprefix {$a} כתוב מבצורה שגויה';
$string['xoutofmax'] = '{$a->mark} מתוך {$a->max}';
$string['yougotnright'] = 'בחרת ב-  {$a->num}.';
$string['youmustselectaqtype'] = 'חובה לבחור סוג שאלה.';
$string['yourfileshoulddownload'] = 'קובץ היצוא אמור להתחיל לרדת מייד. אם איננו יורד , אנא לחצו <a href="{$a}">כאן </a>.';
