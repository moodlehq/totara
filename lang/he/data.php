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
 * Strings for component 'data', language 'he', branch 'MOODLE_22_STABLE'
 *
 * @package   data
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['action'] = 'פעולה';
$string['add'] = 'הוספת רשומה';
$string['addcomment'] = 'הוסף הערה';
$string['addentries'] = 'הוסף רשומות';
$string['addtemplate'] = 'תבנית הוספת רשומה';
$string['advancedsearch'] = 'חיפוש מורחב';
$string['alttext'] = 'טקסט חלופי';
$string['approve'] = 'אשר';
$string['approved'] = 'מאושר';
$string['ascending'] = 'בסדר עולה';
$string['asearchtemplate'] = 'תבנית חיפוש';
$string['atmaxentry'] = 'הכנסת מירב הרשומות המותרות!';
$string['authorfirstname'] = 'שם פרטי של המחבר';
$string['authorlastname'] = 'שם משפחה של המחבר';
$string['autogenallforms'] = 'צור את כל תבניות ברירת המחדל';
$string['autolinkurl'] = 'צור קישור באופן אוטומטי לכתובת ה-URL (אינטרנט)';
$string['availablefromdate'] = 'זמין כפעילות מ';
$string['availabletags'] = 'תגים זמינים';
$string['availabletags_help'] = 'תגים הם מסמני מקום בתוך התבנית, הם מוחלפים על ידי שדות או כפתורים כשהרשומות נצפות או עוברות עריכה.
לשדות יש את התסדיר הבא: [[fieldname]]
לכפתורים יש את התסדיר הבא: ##somebutton##
בשביל התבנית הנוכחית אפשר להשתמש רק בתגים הנמצאים ברשימת התגים זמינים.';
$string['availabletodate'] = 'זמין כפעילות עד';
$string['blank'] = 'ריק';
$string['buttons'] = 'כפתורים';
$string['bynameondate'] = 'על ידי {$a->name} - {$a->date}';
$string['cancel'] = 'ביטול';
$string['cannotaccesspresentsother'] = 'אין לך הרשאה לגשת לניהול התבניות והשדות ממשתמשים אחרים';
$string['cannotadd'] = 'לא ניתן להוסיף רשומות';
$string['cannotdeletepreset'] = 'שגיאה במחיקת ניהול התבניות והשדות';
$string['cannotoverwritepreset'] = 'שגיאה בשכתוב הגדשות קבועות מראש';
$string['cannotunziptopreset'] = 'לא ניתן לחלץ קובץ ארכיב לתיקיית הניהול של התבניות והשדות';
$string['checkbox'] = 'רב-ברירה';
$string['chooseexportfields'] = 'בחר את השדות אותם תרצה לייצא';
$string['chooseexportformat'] = 'בחר את התסדיר אותו תרצה לייצא עבור:';
$string['chooseorupload'] = 'בחירת קובץ';
$string['columns'] = 'עמודות';
$string['comment'] = 'הערה';
$string['commentdeleted'] = 'הערה נמחקה';
$string['commentempty'] = 'ההערה היתה ריקה';
$string['comments'] = 'הערות';
$string['commentsaved'] = 'ההערה נשמרה';
$string['commentsn'] = '{$a} הערה(רות)';
$string['commentsoff'] = 'תכונת ההערות לא מאופשר';
$string['configenablerssfeeds'] = 'מתג זה יתיר את האפשרות של הזנות RSS לכל בסיסי הנתונים. עדיין תצתרך להפעיל את ההזנות באופן ידני בהגדרות של כל בסיס נתונים.';
$string['confirmdeletefield'] = 'אתה עומד למחוק את השדה הזה, האם אתה בטוח?';
$string['confirmdeleterecord'] = 'האם אתה בטוח שאתה רוצה למחוק את הרשומה הזו?';
$string['csstemplate'] = 'תבנית CSS';
$string['csvfailed'] = 'לא ניתן לקרוא את מידע השורה מקובץ CSV';
$string['csvfile'] = 'קובץ CSV';
$string['csvimport'] = 'ייבוא קובץ CSV';
$string['csvimport_help'] = 'CSVהוא תסדיר נפוץ לחליפין של טקסט, ופירושו: ערכים המופרדים על ידי פסיקים (Comma-Separated-Values).
תסדיר הקובץ הצפוי הוא תסדיר טקסט פשוט (plain text) כאשר ברשומה הראשונה ישנה רשימת שמות של שדות. הנתונים באים לאחר מכן, לכל שורה רשומה אחת.
תוחם השדות חוזר לברירת המחדל שהיא תו של פסיק. סוגר שטח השדה לא נקבע על ידי ברירת מחדל (סוגרי השטח של השדות הם תווים שמקיפים כל שדה בכל רשומה).
רשומות צריכות להיות מופרדות על ידי קווים חדשים (שלרוב מחוללים על ידי לחיצה על כפתור ה ENTER או ה RETURN בעורך הטקסט שלכם). בטאבים (Tabs) אפשר לנקוב באמצעות t ובשורות חדשות באמצעות n.
קובץ לדוגמא:
name,height,weight
Kai,180cm,80kg
Kim,170cm,60kg
Koo,190cm,20kg
אזהרה: יכול להיות שאין תמיכה מלאה לכל סוגי השדות.';
$string['csvwithselecteddelimiter'] = '<acronym title="Comma Separated Values">CSV</acronym > - רשימת נתונים המופרדים ב:';
$string['data:approve'] = 'אשר את הרשומות המאושרות';
$string['data:comment'] = 'כתוב הערות';
$string['data:exportallentries'] = 'יצוא כל רשומות בסיס-הנתונים';
$string['data:exportentry'] = 'יצוא רשומת בסיס-נתונים';
$string['data:exportownentry'] = 'יצוא רשומת בסיס-הנתונים שלך';
$string['data:managecomments'] = 'נהל הערות';
$string['data:manageentries'] = 'נהל רשומות';
$string['data:managetemplates'] = 'נהל תבניות';
$string['data:manageuserpresets'] = 'נהל את כל הגדרות התבנית שנקבעו מראש';
$string['data:rate'] = 'דרג את הרשומות';
$string['data:readentry'] = 'קרא את הרשומות';
$string['data:viewallratings'] = 'צפיה בכל השורות הדירוגים הניתנים על-ידי כל אחד';
$string['data:viewalluserpresets'] = 'ראה את ניהול התבניות והשדות של כל המשתמשים';
$string['data:viewanyrating'] = 'צפיה בדירוגים הכוללים אשר כל אחד קיבל';
$string['data:viewentry'] = 'ראה את הרשומות';
$string['data:viewrating'] = 'ראה את הדירוגים';
$string['data:writeentry'] = 'כתוב רשומות';
$string['date'] = 'תאריך';
$string['dateentered'] = 'התאריך שהוזן';
$string['defaultfielddelimiter'] = '(ברירת המחדל הינה תו הפסיק)';
$string['defaultfieldenclosure'] = '(ברירת המחדל היא כלום)';
$string['defaultsortfield'] = 'סוג שדה המשמש כברירת המחדל';
$string['delete'] = 'מחק';
$string['deleteallentries'] = 'מחק את כל הכניסות';
$string['deletecomment'] = 'האם אתה בטוח שאתה רוצה למחוק את ההערה הזו?';
$string['deleted'] = 'נמחקה';
$string['deletefield'] = 'מחק שדה קיים';
$string['deletenotenrolled'] = 'מחק כניסות משתמשים אשר לא נרשמו';
$string['deletewarning'] = 'האם אתה בטוח שאתה רוצה למחוק את הגדרה זו שנקבעה מראש?';
$string['descending'] = 'בסדר יורד';
$string['directorynotapreset'] = '{$a->directory} איננה הגדרה קבועה מראש: קבצים חסרים: {$a->missing_files}';
$string['download'] = 'הורדה';
$string['edit'] = 'ערוך';
$string['editcomment'] = 'ערוך הערה';
$string['editentry'] = 'ערוך רשומה';
$string['editordisable'] = 'עורך פשוט';
$string['editorenable'] = 'עורך מעוצב';
$string['emptyadd'] = 'תיקיית הוספת תבניות ריקה, מחולל תצורת ברירת מחדל...';
$string['emptyaddform'] = 'לא מילאת אף שדה!';
$string['entries'] = 'רשומות';
$string['entrieslefttoadd'] = 'הינך מוכרח להוסיף {$a->entriesleft} יותר רשומהרשומות בכדי להשלים את פעילות זו.';
$string['entrieslefttoaddtoview'] = 'הינך מוכרח להוסיף {$a->entrieslefttoview} יותר רשומהרשומות לפני שתוכל לראות רשומות של משתתפים אחרים.';
$string['entry'] = 'רשומה';
$string['entrysaved'] = 'הרשומה שלך נשמרה';
$string['errormustbeteacher'] = 'בכדי להשתמש בעמוד זה אתה חייב להיות מורה!';
$string['errorpresetexists'] = 'זוהי כבר תבנית ושדה עם שם שנבחר';
$string['example'] = 'דוגמאת רכיב בסיס נתונים';
$string['excel'] = 'גליון אקסל Excel';
$string['expired'] = 'מצטערים, פעילות זו נסגרה ב  {$a}  ואיננה זמינה יותר.';
$string['export'] = 'יצוא';
$string['exportaszip'] = 'יצוא כקובץ ZIP';
$string['exportaszip_help'] = 'הדבר מאפשר לכם להוריד את התבניות למחשב האישי שלכם. לאחר מכן, תוכלו העלות אותם לבסיס נתונים אחר, באמצעות אופציית הייבוא של Zip.';
$string['exportedtozip'] = 'יוצא לקובץ ZIP זמני';
$string['exportentries'] = 'יצוא רשומות';
$string['exportownentries'] = 'האם לייצא את הרשומות שלך בלבד?
({$a->mine}/{$a->all})';
$string['failedpresetdelete'] = 'חלה שגיאה במהלך מחיקה של הגדרה קבועה מראש!';
$string['fieldadded'] = 'השדה התווסף';
$string['fieldallowautolink'] = 'אפשר יצירת קישורים אוטומטיים';
$string['fielddeleted'] = 'השדה נמחק';
$string['fielddelimiter'] = 'תוחם השדה';
$string['fielddescription'] = 'תיאור השדה';
$string['fieldenclosure'] = 'סגירת שטח השדה';
$string['fieldheight'] = 'גובה';
$string['fieldheightlistview'] = 'גובה בתצוגת רשימה';
$string['fieldheightsingleview'] = 'גובה בתצוגת רשומה';
$string['fieldids'] = 'מספרי זיהוי השדה';
$string['fieldmappings'] = 'מיפויי השדה';
$string['fieldmappings_help'] = 'התפריט הזה מאפשר לכם לשמור את הנתונים הקיימים בבסיס הנתונים הנוכחי. כדי לשמר את הנתונים האלה בתוך שדה, אתם חייבים למפות אותו לשדה חדש שם יופיעו הנתונים. אתם יכולים גם להשאיר שדות ריקים, מבלי להעתיק לתוכם נתונים. שדה ישן שלא מיפיתם אותו לשדה חדש ייאבד וכל הנתונים שלו יימחקו.
אתם יכולים למפות רק שדות מאותו הסוג, כך שכל תפריט הנפתח יכלול בתוכו שדות שונים. בנוסף לכך, אתם צריכים להיזהר ולא למפות שדה ישן אחד לתוך יותר משדה חדש אחד.';
$string['fieldname'] = 'שם השדה';
$string['fieldnotmatched'] = 'השדות הבאים בקובץ שלך לא ידועים בבסיס-הנתונים: {$a}';
$string['fieldoptions'] = 'אפשרויות (אחת לכל שורה)';
$string['fields'] = 'שדות';
$string['fieldupdated'] = 'שדה מעודכן';
$string['fieldwidth'] = 'רוחב';
$string['fieldwidthlistview'] = 'רוחב בתצוגת רשימה';
$string['fieldwidthsingleview'] = 'רוחב בתצוגת רשומה';
$string['file'] = 'קובץ';
$string['fileencoding'] = 'קידוד';
$string['filesnotgenerated'] = 'לא כל הקבצים חוללו: {$a}';
$string['filtername'] = 'יצירת קישורים אוטומטיים לבסיס הנתונים';
$string['footer'] = 'כותרת תחתונה';
$string['forcelinkname'] = 'מילה לתצוגה במקום כתובת הקישור';
$string['foundnorecords'] = 'לא נמצאו רשומות (<a href="{$a->reseturl}">איפוס מסננים</a>)';
$string['foundrecords'] = 'נמצאו רשומות: {$a->num}/{$a->max} (<a href="{$a->reseturl}">איפוס מסננים</a>)';
$string['fromfile'] = 'יבוא מקובץ ZIP';
$string['fromfile_help'] = 'השתמשו בזה כדי להעלות הגדרות קבועות מראש שנשמרו על המחשב שלכם באמצעות תכונת היצוא.';
$string['generateerror'] = 'לא כל הקבצים נוצרו!';
$string['header'] = 'כותרת עליונה';
$string['headeraddtemplate'] = 'מגדיר את הממשק בזמן עריכת רשומות';
$string['headerasearchtemplate'] = 'מגדיר את הממשק עבור חיפוש מורחב';
$string['headercsstemplate'] = 'מגדיר סגנונות CSS מקומיים בשביל התבניות האחרות';
$string['headerjstemplate'] = 'מגדיר Javascript מותאם אישית בשביל התבניות האחרות';
$string['headerlisttemplate'] = 'מגדיר את ממשק הדפדפן לרשומות כפולות';
$string['headerrsstemplate'] = 'מגדיר את מראה הרשומות בהזנות RSS';
$string['headersingletemplate'] = 'מגדיר את ממשק הדפדפן לרשומה יחידה';
$string['importentries'] = 'יבוא רשומות';
$string['importsuccess'] = 'התבנית והשדה הושמה בהצלחה.';
$string['insufficiententries'] = 'כדי שיהיה אפשרי לצפות את בסיס נתונים זה נדרשות רשומות נוספות';
$string['intro'] = 'הנחייה לפעילות';
$string['invalidaccess'] = 'לא ניתן היה לגשת לעמוד זה בצורה נכונה';
$string['invalidfieldid'] = 'מספר זיהוי השדה שגוי';
$string['invalidfieldname'] = 'אנא בחר שם אחר לשדה זה';
$string['invalidfieldtype'] = 'סוג השדה שגוי';
$string['invalidid'] = 'מספר זיהוי המידע שגוי';
$string['invalidpreset'] = '{$a} זוהי אינה תבנית ושדה';
$string['invalidrecord'] = 'רשומה שגויה';
$string['invalidurl'] = 'כתובת ה-URL (אינטרנט) שהזנת כרגע לא תקפה.';
$string['jstemplate'] = 'תבנית Javascript';
$string['latitude'] = 'קו-רוחב';
$string['latlong'] = 'מיקום גאוגרפי';
$string['latlongdownloadallhint'] = 'הורד את הקישור לכל הרשומות כ-KML';
$string['latlongkmllabelling'] = '(Google Earth) כיצד לתייג פריטים בקבצי KML';
$string['latlonglinkservicesdisplayed'] = 'בחר שירות מפות חיצוני אחד';
$string['latlongotherfields'] = 'שדות אחרים';
$string['list'] = 'הראה רשימה';
$string['listtemplate'] = 'תבנית הרשימה';
$string['longitude'] = 'קו-אורך';
$string['mapexistingfield'] = 'מפה ל {$a}';
$string['mapnewfield'] = 'צור שדה חדש';
$string['mappingwarning'] = 'כל השדות הישנים שלא עברו מיפוי לשדה חדש יאבדו וכל הנתונים בשדות הנל יימחקו.';
$string['maxentries'] = 'מספר מרבי של רשומות';
$string['maxentries_help'] = 'מספר הרשומות המירבי שמשתתף יכול להגיש לפעילות זו.';
$string['maxsize'] = 'גודל מרבי';
$string['menu'] = 'תפריט';
$string['menuchoose'] = 'בחר...';
$string['missingdata'] = 'מספר זיהוי המידע או האובייקט חייב להיות מסופק ל-field class.';
$string['missingfield'] = 'שגיאה תכנותית:
חובה לציין שדה  ו/או מידע כשמגדירים את
field class';
$string['modulename'] = 'בסיס נתונים';
$string['modulename_help'] = 'רכיב פעילות בסיס-נתונים זה מאפשר למשתתפים ליצור, לנהל ולחפש מאגר של ערכי רשומה. תסדיר ומבנה ערכי הרשומה האלו יכול להיות בלתי מוגבל כמעט, בנוסף יכול להכליל תמונות, קבצים, כתובות אינטרנט, מספרים וטקסט פשוט לצד דברים אחרים.';
$string['modulenameplural'] = 'בסיסי נתונים';
$string['more'] = 'עוד';
$string['moreurl'] = 'עוד כתובות URL (אינטרנט)';
$string['movezipfailed'] = 'לא ניתן להזיז קובץ zip';
$string['multientry'] = 'תבנית רשומה - תציג רשימת רשומות אחת אחר השניה בין הכותרת לתחתית';
$string['multimenu'] = 'תפריט (רב-ברירה)';
$string['multipletags'] = 'נמצאו תגים כפולים! התבנית לא נשמרה';
$string['namecheckbox'] = 'שדה רב-ברירה';
$string['namedate'] = 'שדה תאריך';
$string['namefile'] = 'שדה קובץ';
$string['namelatlong'] = 'שדה מיקום גאוגרפי';
$string['namemenu'] = 'שדה תפריט';
$string['namemultimenu'] = 'שדה תפריט רב-ברירה';
$string['namenumber'] = 'שדה מספר';
$string['namepicture'] = 'שדה תמונה';
$string['nameradiobutton'] = 'שדה חד-ברירה';
$string['nametext'] = 'שדה טקסט';
$string['nametextarea'] = 'שדה טקסט';
$string['nameurl'] = 'שדה כתובת URL (אינטרנט)';
$string['newentry'] = 'רשומה חדשה';
$string['newfield'] = 'צור שדה חדש';
$string['newfield_help'] = 'במסך הזה אתם יכולים ליצור את השדות שיהוו חלק מבסיס הנתונים שלכם.
כל שדה מאפשר סוגי נתונים שונים, עם ממשקים שונים.';
$string['noaccess'] = 'אין לך גישה לעמוד זה';
$string['nodefinedfields'] = 'להגדרה הקבועה מראש החדשה אין שדות מוגדרים!';
$string['nofieldcontent'] = 'תכולת השדה לא נמצאה';
$string['nofieldindatabase'] = 'לבסיס נתונים זה אין שדות מוגדרים.';
$string['nolisttemplate'] = 'עוד לא הוגדרה תבנית רשימה';
$string['nomatch'] = 'לא נמצאו רשומות מתאימות!';
$string['nomaximum'] = 'אין גבול מרבי';
$string['norecords'] = 'אין רשומות בבסיס הנתונים';
$string['nosingletemplate'] = 'עוד לא הוגדרה תבנית רשומה';
$string['notapproved'] = 'הרשומה עדיין לא אושרה.';
$string['notinjectivemap'] = 'לא מהווה מיפוי חודרני';
$string['notopenyet'] = 'מצטערים, פעילות זו איננה זמינה עד  {$a} .';
$string['number'] = 'מספר';
$string['numberrssarticles'] = 'מאמרי RSS';
$string['numnotapproved'] = 'עומד להתרחש';
$string['numrecords'] = '{$a} רשומות';
$string['ods'] = '<acronym title="OpenDocument Spreadsheet">אופן אופיס</acronym>';
$string['optionaldescription'] = 'תיאור קצר (לבחירתכם)';
$string['optionalfilename'] = 'שם הקובץ (לבחירתכם)';
$string['other'] = 'אחר';
$string['overrwritedesc'] = 'החלפת הגדרות קיימות בהגדרות חדשות, במידה וקיימת תבנית־שדות בעלת שם זהה.';
$string['overwrite'] = 'עדכון תבנית־שדות קיימת';
$string['overwritesettings'] = 'כתוב שוב את ההגדרות';
$string['page-mod-data-x'] = 'כל עמוד רכיב פעילות בסיס-נתונים';
$string['pagesize'] = 'מספר הרשומות בכל עמוד';
$string['participants'] = 'משתתפים';
$string['picture'] = 'תמונה';
$string['pleaseaddsome'] = 'אנא צרו להלן כמה שדות או <a href="{$a}">ביחרו במבנה אשר הוגדר מראש</a> בכדי להתחיל.';
$string['pluginadministration'] = 'ניהול פעילות בסיס-נתונים';
$string['pluginname'] = 'בסיס נתונים';
$string['portfolionotfile'] = 'יצוא לתיק עבודות מאשר לקובץ
(csv ו- leap2a בלבד)';
$string['presetinfo'] = 'שמירת התבנית כברירת מחדל תהפוך אותה לזמינה עבור כל המשתמשים.';
$string['presets'] = 'ניהול תבניות ושדות';
$string['radiobutton'] = 'חד-ברירה';
$string['recordapproved'] = 'הרשומה אושרה';
$string['recorddeleted'] = 'הרשומה נמחקה';
$string['recordsnotsaved'] = 'לא נשמרה כל רשומה. אנא בדוק את תסדיר הקובץ שהועלה.';
$string['recordssaved'] = 'רשומות נשמרו';
$string['requireapproval'] = 'נדרש אישור?';
$string['requireapproval_help'] = 'האם רשומות צריכות לעבור אישור של מורה לפני שהן מוצגות בפני הסטודנטים? האפשרות הזו מועילה למיתון תוכן שיכול להיות פוגעני או לא הולם.';
$string['requiredentries'] = 'מספר הרשומות הנדרשות';
$string['requiredentries_help'] = 'מספר הרשומות שמשתתף נדרש להגיש. בפני משתתפים שעדיין לא הגישו את מספר הרשומות הנדרשות, תופיע הודעה שנועדה להזכיר להם את חובת ההגשה שלהם.
עד שהמשתמש יגיש את כל הרשומות הנדרשות, הפעילות לא תיחשב כגמורה.';
$string['requiredentriestoview'] = 'מספר הרשומות הנדרשות לפני שתתאפשר צפיה';
$string['requiredentriestoview_help'] = 'מספר הרשומות שמשתתף מחוייב להגיש לפני שהוא מורשה לצפות ברשומות הקיימות בבסיס הנתונים של פעילות זו.
הערה: לא ניתן להשתמש באפשרות זו יחד עם מסנן הקישורים האוטומטי של מסד הנתונים, מפני שעבור מסנן הקישורים האוטומטי של מסד הנתונים אין אפשרות לקבוע האם משתמש הגיש את מספר נדרש של רשומות.';
$string['resetsettings'] = 'איפוס שדות';
$string['resettemplate'] = 'אפס את התבנית';
$string['resizingimages'] = 'משנה את גודל דוגמיות התמונות....';
$string['rows'] = 'שורות';
$string['rssglobaldisabled'] = 'מנוטרל. ראה משתני הגדרות התצורה של האתר.';
$string['rsstemplate'] = 'תבנית RSS';
$string['rsstitletemplate'] = 'תבנית כותרת ה-RSS';
$string['save'] = 'שמור';
$string['saveandadd'] = 'שמירה והוספת רשומה חדשה';
$string['saveandview'] = 'שמור וראה';
$string['saveaspreset'] = 'שמירת תבנית־שדות';
$string['saveaspreset_help'] = 'זה מפרסם את התבניות הנוכחיות כהגדרות קבועות מראש וכל מי שנמצא באתר יכול לראות אותן ולעשות בהם שימוש. הן יופיעו ברשימת ההגדרות הקבועות מראש, אתם תוכלו להסיר אותן בכל עת.';
$string['savesettings'] = 'שמור הגדרות';
$string['savesuccess'] = 'נשמרה בהצלחה. ההגדרה ששמרתם כהגדרה קבועה מראש תהיה נגישה מעכשיו באתר כולו.';
$string['savetemplate'] = 'שמור תבנית';
$string['search'] = 'חיפוש';
$string['selectedrequired'] = 'כל הנבחרים דרושים';
$string['showall'] = 'הראה את כל הרשומות';
$string['single'] = 'הראה רשומה';
$string['singletemplate'] = 'תבנית רשומה';
$string['subplugintype_datafield'] = 'סוג שדה של בסיס הנתונים';
$string['subplugintype_datafield_plural'] = 'סוגי השדות של בסיס הנתונים';
$string['subplugintype_datapreset'] = 'קבוע מראש';
$string['subplugintype_datapreset_plural'] = 'ניהול תבניות ושדות';
$string['teachersandstudents'] = '{$a->teachers} מורים ו {$a->students} תלמידים';
$string['templates'] = 'תבניות';
$string['templatesaved'] = 'התבנית נשמרה';
$string['text'] = 'שורת מלל (טקסט)';
$string['textarea'] = 'שדה טקסט';
$string['timeadded'] = 'זמן הוספה';
$string['timemodified'] = 'זמן עדכון';
$string['todatabase'] = 'לבסיס נתונים זה.';
$string['type'] = 'סוג שדה';
$string['undefinedprocessactionmethod'] = 'לא הוגדרה שיטת פעולה ב- Data_Preset שיכולה להתמודד עם הפעולה: "{$a}".';
$string['unsupportedexport'] = '({$a->fieldtype}) לא ניתן לייצא';
$string['updatefield'] = 'עדכן שדה קיים';
$string['uploadfile'] = 'העלה קובץ';
$string['uploadrecords'] = 'העלה רשומות מתוך קובץ';
$string['uploadrecords_help'] = 'ניתן להעלות רשומות דרך קובץ טקסט. התסדיר של הקובץ אומר להיות באופן הבא:
* כל שורה בקובץ מכילה רשומה אחת של מסד הנתונים
* כל רשומה במסד הנתונים היא סדרה של מידע המופרד בפסיק או תוחם אחר
* הרשומה הראשונה מכילה רשימת שמות שדה המגדירות את התסדירשל שאר הקובץ.
סגירת שטח השדה הינה תו אשר מקיף כל שדה בכל רשומה. ניתן להשאיר ריק.';
$string['url'] = 'כתובת URL (אינטרנט)';
$string['usestandard'] = 'תבניות־שדות זמינות';
$string['usestandard_help'] = 'משתמש בתבנית שזמינה לאתר כולו.
בנוסף לכך, אם הוספתם את ההגדרה הקבועה מראש לסיפריה באמצעות תכונת ה\'שמור הגדרה קבועה מראש\', תוכלו גם למחוק אותה.';
$string['viewfromdate'] = 'נגיש לצפיה מ';
$string['viewtodate'] = 'נגיש לצפיה עד';
$string['wrongdataid'] = 'סופקו נתוני מספר זיהוי שגויים';
