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
 * Strings for component 'chat', language 'he', branch 'MOODLE_22_STABLE'
 *
 * @package   chat
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['ajax'] = 'מהדורה המשתמש ב-AJAX';
$string['autoscroll'] = 'גלילה אוטומטית';
$string['beep'] = 'ציפצוף';
$string['cantlogin'] = 'הכניסה לחדר השיחות נכשלה!!';
$string['chat:chat'] = 'דבר ברב-שיח';
$string['chat:deletelog'] = 'מחק את יומני המעקב של הרב-שיח';
$string['chat:exportparticipatedsession'] = 'ייצא את מושב הרב-שיח של השמתתף';
$string['chat:exportsession'] = 'ייצא את מושב הרב-שיח';
$string['chat:readlog'] = 'קרא את יומני המעקב של הרב-שיח';
$string['chat:talk'] = 'דבר ברב-שיח';
$string['chatintro'] = 'הנחייה לפעילות';
$string['chatname'] = 'שמו של חדר רב-שיח זה';
$string['chatreport'] = 'מפגש רב-שיח מקוון';
$string['chattime'] = 'זמן רב-השיח הבא';
$string['configmethod'] = 'רב-שיח העושה שימוש ב-AJAX מאשפר ממשק  המבוסס על AJAX המתקשר באופן בדיר עם השרת. בשיטה הרגילה לעריכת רבי-שיח, הלקוחות נדרשים ליצור קשר עם השרת כדי לקבל עדכונים על בסיס קבוע. שיטה זו לא דורשת הגדרת תצורה והיא עובדת בכל מקום, אבל היא עלולה לגרום עומס רב על השרת ברגע שיש מספר גדול של משתתפים. שימוש בתוכנת "daemon" דורשת גישת מעטפת (shell) ל-Unix, אבל התוצאה היא סביבת רב-השיח מהירה שניתן להתאים את גודלה לפי הנדרש.';
$string['confignormalupdatemode'] = 'לרוב, עידכונים לחדר הרב-שיח מוגשים ביעילות על ידי תכונת ה<em> (שמור בחיים)Keep-Alive</em> של HTTP 1.1, אבל הדבר עדיין גורם לעומס כבד על השרת. שיטה יותר מתקדמת היא להשתמש באזטרטגיית ה-<em>Stream</em> כדי להזין עדכונים מהמשתמשים. באמצעות <em>Stream</em> ניתן להתאים את הגודל באופו טוב יותר (בדומה לשיטת ה-chatd), אבל ישנה האפשרות שהשרת שלכם לא יתמוך בה.';
$string['configoldping'] = 'אחרי כמה זמן שלא שומעים ממשתמש צריך להחשיבו כמנותק (בשניות)? זהו רק גבול עליון, מפני שלרוב מבחינים בניתוקים מהר מאוד. ערכים נמוכים יהיו תובעניים יותר כלפי השרת שלכם. אם אתם משתמשים בשיטה הרגילה, <strong>לעולם</strong> אל תקבעו את הערך הזה מתחת ל-2 * chat_refresh_room.';
$string['configrefreshroom'] = 'כל כמה זמן חדר הרב-שיח עצמו צריך להתחדש? (בשניות). קביעת זמן קצר תגרום לחדר הרב-שיח להראות מהיר יותר, אך זה גם יכול להעמיס יותר על שרת האינטרנט שלך כאשר אנשים רבים מדברים ברב-שיח.';
$string['configrefreshuserlist'] = 'כל כמה זמן צריכה רשימת המשתמשים להתחדש? (בשניות)';
$string['configserverhost'] = 'שם המחשב המאחר בו נימצאת תוכנת "daemon".';
$string['configserverip'] = 'כתובת IP מספרית שתואמת לשם המחשב המארח לעיל.';
$string['configservermax'] = 'המספר המירבי המותר של לקוחות';
$string['configserverport'] = 'מספר ה־port בו "מאזינה" תוכנת הרב־שיח לבקשות התחברות חדשות';
$string['currentchats'] = 'אסיפות רב-שיח פעילות';
$string['currentusers'] = 'משתמשים נוכחיים';
$string['deletesession'] = 'מחק מפגש זה';
$string['deletesessionsure'] = 'האם אתה בטוח שאתה רוצה למחוק מפגש מקוון זה?';
$string['donotusechattime'] = 'אל תפרסם זמני רב-שיח כלשהם';
$string['enterchat'] = 'לחץ כאן כדי להיכנס לרב-שיח עכשיו';
$string['errornousers'] = 'לא יכול היה למצוא משתמשים!';
$string['explaingeneralconfig'] = 'הגדרות אלה <strong>תמיד</strong> משפיעות.';
$string['explainmethoddaemon'] = 'הגדרות אלה משפיעות <strong>רק </strong> אם בחרתם ב-"תוכנת "daemon" השוהה בשרת רב-שיח" ב-chat_method.';
$string['explainmethodnormal'] = 'הגדרות אלה משפיעות <strong>רק</strong> במידה ובחרתם ב"רב-שיח רגיל" ב-chat_method.';
$string['generalconfig'] = 'תצורה כללית';
$string['idle'] = 'ביטול';
$string['inputarea'] = 'אזור הקלט';
$string['invalidid'] = 'חדר הרב-שיח לא נמצא!!';
$string['list_all_sessions'] = 'רשימות כל המפגשים המקוונים';
$string['list_complete_sessions'] = 'רשימת המפגשים המקוונים שזה עתה הושלמו';
$string['listing_all_sessions'] = 'הרשמת כל המפגשים המקוונים';
$string['messagebeepseveryone'] = '{$a} ציפצף לכולם!';
$string['messagebeepsyou'] = '{$a} ציפצף לך הרגע!';
$string['messageenter'] = '{$a} כרגע נכנס לרב-שיח זה';
$string['messageexit'] = '{$a} עזב רב-שיח זה';
$string['messages'] = 'הודעות';
$string['messageyoubeep'] = 'צפצפת ל-{$a}';
$string['method'] = 'שיטת הרב-שיח';
$string['methodajax'] = 'שיטת AJAX';
$string['methoddaemon'] = 'שרת רב־שיח עצמאי';
$string['methodnormal'] = 'שיטה רגילה';
$string['modulename'] = 'רב-שיח';
$string['modulename_help'] = 'מודול הרב-שיח מרשה למשתתפים לקיים דיון סינכרוני בזמן אמת באמצעות הרשת. זאת היא דרך שימושית להבנת האחר ושל הנושא שעליו דנים. השימוש בחדרי רב-שיח שונה במאוד מפורומים אסינכרוניים.';
$string['modulenameplural'] = 'רבי-שיח';
$string['neverdeletemessages'] = 'לא למחוק תוכן';
$string['nextsession'] = 'המפגש המקוון המתוכן הבא';
$string['no_complete_sessions_found'] = 'לא נמצא אף מפגש מקוון שהושלם.';
$string['nochat'] = 'לא נמצא רב-שיח';
$string['noguests'] = 'רב-שיח זה לא פתוח לאורחים';
$string['nomessages'] = 'אין הודעות עדיין';
$string['nopermissiontoseethechatlog'] = 'אין לך ההרשאה לראות את יומן הרב-שיח';
$string['normalkeepalive'] = 'KeepAlive (שמור בחיים)';
$string['normalstream'] = 'זרם';
$string['noscheduledsession'] = 'אין מפגשים מקוונים מתוכננים';
$string['notallowenter'] = 'אינך רשאי להיכנס לחדר הרב-שיח';
$string['notlogged'] = 'לא מחובר!';
$string['oldping'] = 'פסק-זמן לניתוק';
$string['page-mod-chat-x'] = 'כל עמוד רכיב רב-שיח';
$string['pastchats'] = 'מפגשי הרב-שיח שעברו';
$string['pluginadministration'] = 'ניהול הרב-שיח';
$string['pluginname'] = 'רב-שיח';
$string['refreshroom'] = 'רענן חדר';
$string['refreshuserlist'] = 'רענן רשימת משתתפים';
$string['removemessages'] = 'הסר את כל ההודעות';
$string['repeatdaily'] = 'באותו זמן בכל יום';
$string['repeatnone'] = 'ללא חזרות - פרסם את הזמן המפורט בלבד';
$string['repeattimes'] = 'חזור על המפגשים המקוונים';
$string['repeatweekly'] = 'באותו הזמן בכל שבוע';
$string['saidto'] = 'אמר ל-';
$string['savemessages'] = 'שמור תוכן מפגשים מקוונים';
$string['seesession'] = 'הצג מפגש זה';
$string['send'] = 'שליחה';
$string['sending'] = 'שולחים';
$string['serverhost'] = 'שם השרת';
$string['serverip'] = 'ip השרת';
$string['servermax'] = 'מספר משתתפים מירבי';
$string['serverport'] = 'Port התוכנה בשרת';
$string['sessions'] = 'מפגשי רב-שיח';
$string['sessionstart'] = 'מושב הרב-שיח יתחיל ב: {$a}';
$string['strftimemessage'] = '%H:%M';
$string['studentseereports'] = 'כולם יכולים לראות מפגשים מקוונים ישנים';
$string['studentseereports_help'] = 'אם מוגדר כ"לא", אזי רק משתמשיםשיש להם יכולות לקרוא את הרב-שיח (mod/chat:readlog( יכולים לראות את היומן';
$string['talk'] = 'דבר';
$string['updatemethod'] = 'עדכן שיטה';
$string['updaterate'] = 'קצב העידכון:';
$string['userlist'] = 'רשימת המשתתפים';
$string['usingchat'] = 'משתמשים ברב-שיח';
$string['usingchat_help'] = 'פרק הרב-שיח כולל בחובו מספר מאפיינים כדי שהשימוש בו יהיה מעט נחמד יותר.
* סמיילים - כל פרצוף סמיילי (פרצופונים) שאתם יכולים להקליד בכל מקום אחר במוודל, אתם יכולים להקליד גם כאן והוא יוצג בצורה הנכונה, ללא שיבושים. לדוגמא (-:=
* קישורים - כתובות אינטרנט יהפכו לקישורים באופן אוטומטי.
* הבעת רגשות - אתם יכולים להתחיל שורה ברב-שיח עם המילה "אני/" או ":" כדי להביע רגשות. לדוגמא, נניח שהשם שלכם הוא קים, ואתם מקלידים ":צוחקת!" או "אני/ צוחקת!" אז כולם ייראו "קים צוחקת!".
* צפצופים - אתם יכולים לשלוח צלילים לאנשים אחרים על ידי לחיצה על קישור ה"צפצוף" שנמצא ליד השם שלהם. קיצור מועיל אם אתם רוצים לצפצף לכל האנשים שנמצאים ברב-שיח הוא להקליד : "צפצף לכולם".
* HTML - אם אתם יודעים אפילו מעט קוד של HTML, אתם יכולים להשתמש בו בטקסט שלכם כדי לעשות דברים כמו להוסיף תמונות, להשמיע צלילים או ליצור טקסט בצבעים וגדלים שונים.';
$string['viewreport'] = 'הצג מפגשי רב-שיח ישנים';
