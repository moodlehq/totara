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
 * Strings for component 'enrol_imsenterprise', language 'he', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol_imsenterprise
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['aftersaving...'] = 'מרגע ששמרת את ההגדרות שלך, יכול להיות שתרצה ל-';
$string['allowunenrol'] = 'אפשר לנתוני ה- IMS <strong>לבטל את הרשמות</strong> התלמידים או המורים.';
$string['allowunenrol_desc'] = '<p align="center"><b>הוצאה של סטודנטיםמורים מהרשימה</b></p>

<p>נתוני ה Enterprise יכולים להוסיף וכמו גם להוציא למרשימות קורסים סטודנטים ומורים כאחד. אם ההגדרה הזו מופעלת, אזי מוודל יבצע הוצאות מרשימות (הקורסים) לפי מה שמצוין בנתונים.
</p>

<p>ישנן שלוש דרכים בנתוני ה IMS בהן ניתן להוציא סטודנטים מרשימה (של קורס):</p>

<ul><li>אלמנט &lt;חבר&gt; שמציין את הסטודנט והקורס הנתונים, ביחד עם תכונת ה"recstatus" של אלמנט הlt;תפקיד&gt; כאשר היא מכוונת ל 3 (שמשמעותו "מחק"). שימו לב שאפשרות זו עדיין לא ניתנת ליישום בתוך התקן התקע מוודל!! </li>

<li>אלמנט &lt;חבר&gt; שמציין את הסטודנט והקורס הנתונים, ביחד עם אלמנט ה&lt;מצב&gt; כשהוא מכוון ל 0 (שמשמעותו "לא פעיל").</li></ul>

<p>השיטה השלישית שונה במעט. היא לא דורשת הפעלה של הגדרת התצורה הזו, ואפשר להגדיר אותה הרבה לפני תאריך ההוצאה מהרשימה: </p>

<ul><li> אלמנט ה<חבר> שמציין <מסגרת זמן> להרשמה (הכנסה לרשימה), יכול גם לציין את תאריכי ההתחלה ואו הסיום של היות הסטודנט המסויים הזה בתוך הרשימה. תאריכים אלה נטענים לתוך טבלת נתוני ההרשמה של מוודל אם היא נוכחת, כך שלאחר תאריך הסיום, תימנע מהסטודנט גישה לקורס המסויים ההוא. </li></ul>';
$string['basicsettings'] = 'הגדרות בסיסיות';
$string['coursesettings'] = 'אפשרויות נתוני קורס';
$string['createnewcategories'] = 'אם הן לא נמצאות במוודל, צור קטגוריות קורס חדשות (מוסתרות).';
$string['createnewcategories_desc'] = '<p align="center"><b>חלוקה אוטומטית לקטגוריות</b></p>

<p>אם מאפיין ה&lt;org&gt;&lt;orgunit&gt; קיים בתוך הנתונים הנכנסים לקורס, אזי התוכן שלו ישמש לציון של קטגוריה, אם על הקורס להיבנות מאפס, מההתחלה.
</p>

<p>התקן התקע לא יחלק מחדש לקטגוריות קורסים קיימים.</p>

<p>במקרה שלא קיימת קטגוריה בעלת השם הרצוי, תיווצר קטגוריה מוסתרת.</p>';
$string['createnewcourses'] = 'אם הם לא נמצאים במוודל, צור קורסים חדשים (מוסתרים).';
$string['createnewcourses_desc'] = '<div DIR=RTL LANG=HE>
<p align="center"><b>יצירה אוטומטית של קורסים</b></p>

<p>אם אפשרות זו נבחרה, התקן הרישום IMS Enterprise יכול ליצור קורסים חדשים לכל הנמצא בנתוני ה-IMS אך לא במסד הנתונים של Moodle.</p>

<p>ראשית כל הקורסים נסקרים ע"י מסדר זיהוי שלהם - שדה אלפאנומרי בטבלת הקורסים של Moodleהיכולה לציין את הקוד אשר מזהה את הקורס במערכת מידע לסטודנט (לדוגמה). אם ערך זה לא נמצא, מחפשים בטבלת הקורסים - "תיאור קצר" המהווה זיהוי קצר של מערכת Moodle המוצג באיזור "מסלול ההצבעה" (בכמה מערכות 2 שדות אלו יכולים להיות זהים). רק כאשר חיפוש זה נכשל יכול ההתקן באופן אופציונאלי ליצור קורסים חדשים.

<p>כל הקורסים החדשים מוסתרים כאשר נוצרו. זאת בכדי למנוע מסטודנטים להגיע לקורסים ריקים לגמרי כאשר המרצה שלהם עלול לא להיות מודע לכך</p>
</div>';
$string['createnewusers'] = 'צור חשבונות משתמשים עבור משתמשים שעדיין לא נרשמו למוודל.';
$string['createnewusers_desc'] = '<div DIR=RTL LANG=HE>
<p align="center"><b>יצירה אוטומטית של חשבונות משתמש</b></p>

<p>נתוני רישום של IMS Enterprise מתאר בצורה אופיינית מערך של משתמשים. אם הגדרה זו פעילה, חשבונות עשויים להיווצר לכל משתמש שהו אשר לא נמצא במסד הנתונים של Moodle.</p>

<p>ניתן לחפש משתמשים לראשונה ע"י מספר זיהוי, וברמה השנייה ע"י שם המשתמש שלהם ב-Moodle. </p>

<p align="center"><b>סיסמאות</b></p>
<p>סיסמאות לא ניתנים לייבוא מהתקן ה-IMS Enterprise. אנו ממליצים להשתמש במערכת התקני האימותים של Moodle בכדי לאמת משתמשים.</p>
</div>';
$string['cronfrequency'] = 'התדירות של העיבוד';
$string['deleteusers'] = 'מחק חשבונות משתמשים כאשר מצוין לעשות כך בנתוני ה-IMS';
$string['deleteusers_desc'] = '<div DIR=RTL LANG=HE>
<p align="center"><b>מחיקה אוטומטית של חשבונות משתמש</b></p>

<p>נתוני רישום IMS Enterprise יכולים לציין את מחיקת חשבונות המשתמש (אם דגל ה-"recstatus" מוגדר ל 3, אשר מציין מחיקת חשבון) אם הגדרה זו פעילה. </p>

<p>כמקובל ב-Moodle, רשומת המשתמש לא לגמרי נמחקת ממסד הנתונים של Moodle , אלא דגל מוגדר ומסומן כך שחשבון זה נמחק </p>
</div>';
$string['doitnow'] = 'בצא ייבוא IMS Enterprise ברגע זה';
$string['filelockedmail'] = 'לא ניתן היה למחוק באמצעות תהליך ה-cron את קובץ הטקסט בו אתה משתמש בשביל הרשמות המבוססות על קבצי IMS ({$a}). לרוב הדבר אומר שההיתרים עליו שגויים.
אנא תקן את ההיתרים כדי שמוודל יוכל למחוק את הקובץ הנל, אחרת, יכול להיות שהוא יעובד שוב ושוב.';
$string['filelockedmailsubject'] = 'שגיאה חשובה: קובץ הרשמה';
$string['fixcasepersonalnames'] = 'שנה את השמות הפרטיים לאותיות רישיות';
$string['fixcaseusernames'] = 'שנה את שמות המשתמשים לאותיות קטנות';
$string['ignore'] = 'התעלם';
$string['importimsfile'] = 'קובץ יבוא של IMS Enterprise';
$string['imsrolesdescription'] = 'פירוט ההוראות של IMS Enterprise כולל בחובו 8 סוגי תפקידים ברורים ונפרדים. אנא בחר באיזה אופן אלה ימונו במוודל ואם יש להתעלם מחלק מהם.';
$string['location'] = 'מיקום הקובץ';
$string['logtolocation'] = 'מיקום הפלט מקובץ יומן המעקב (ריק אם אין יומני מעקב)';
$string['mailadmins'] = 'הודע למנהל על ידי דוא"ל';
$string['mailusers'] = 'הודע למשתמשים על ידי דוא"ל';
$string['miscsettings'] = 'שונות';
$string['pluginname'] = 'קובץ IMS Enterprise';
$string['pluginname_desc'] = 'שיטה זו תבדוק באופן תמידי תהליך תבניתי של קובץ טקסט במיקום שתגדיר לו. הקובץ מוכרח לאפשר מפרטים של IMS Enterprise המכילים אישיות, קבוצה ומרכיבים של
membership XML.';
$string['processphoto'] = 'הוסף לפרופיל את נתון תמונת המשתמש';
$string['processphotowarning'] = 'אזהרה: סביר להניח שתהליך עיבוד התמונות יוסיף עומס משמעותי על השרת. מומלץ שלא להפעיל את אפשרות זו אם תלמידים רבים צפויים לעבור עיבוד.';
$string['restricttarget'] = 'עבד את הנתונים רק כאשר מפורטת המטרה הבאה';
$string['restricttarget_desc'] = '<div DIR=RTL LANG=HE>
<p align="center"><b>מטרות</b></p>
<p>קובץ נתונים של IMS Enterprise, יכול לשרת מספר "מטרות" - כגון מערכות ניהול למידה, או מערכות אחרות של מוסד הלימודים. ניתן לציין בקובץ ה-Enterprise שהנתונים מיועדים למערכת אחת או למספר מערכות נושאות שם, ע"י ציון שם בתגי &lt;target&gt; שהם תגים המוכלים בתג &lt;target&gt;   </p>

<p>במקרים רבים לתצטרך לדאוג לכך. השאר את הגדרה זו ריקה ומערכת Moodle תמיד תעבד את קובץ הנתונים, אין זה משנה אם שם המטרה צויין או לא. אחרת, השלם את השם המדוייק אשר יהווה פלט בתוך תג ה-&lt;target&gt;. </p>
</div>';
$string['roles'] = 'תפקידים';
$string['sourcedidfallback'] = 'השתמש ב-&quot;sourcedid&quot בשביל מספר הזיהוי של אדם כלשהו במקרה ששדה ה-&quot;userid&quot; לא נמצא.';
$string['truncatecoursecodes'] = 'קצץ את הקודים של הקורס לאורך הזה';
$string['truncatecoursecodes_desc'] = '<p align="center"><b>קצץ את הקודים של הקורס</b></p>
<p>במצבים מסויימים יכול להיות שתרצו לקצץ קודים של קורסים לאורך מסויים, לפני שאתם מעבדים אותם. אם זהו המצב, הכניסו את מספר התווים בקופסא זו. אחרת, השאירו את הקופסה הזו <strong>ריקה</strong>, כך שלא יתרחש כל קיצוץ.
</p>';
$string['usecapitafix'] = 'סמן את קופסא זו אם אתה משתמש ב-"Capita" ( תסדיר ה-XML שגוי מעט)';
$string['usecapitafix_desc'] = '<div DIR=RTL LANG=HE>
<p align="center"><b>Capita</b></p>
<p>במערכת המידע של הסטודנט אשר נוצרה ע"י Capita נמצאה שגיאה קלה בפלט ה-XML שלה. אם הינך משתמש ב-Capita כדאי שתאפשר את הפעלת אפשרות זו - אחרת השאר אותה לא מסומנת</p>
</div>';
$string['usersettings'] = 'אפשרויות נתוני משתמשים';
$string['zeroisnotruncation'] = '0 מראה על כך שאין קיצוץ';
