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
 * Strings for component 'feedback', language 'he', branch 'MOODLE_22_STABLE'
 *
 * @package   feedback
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['add_item'] = 'הוספת שאלה לפעילות';
$string['add_items'] = 'הוספת שאלה לפעילות';
$string['add_pagebreak'] = 'הוסף שבירת עמוד';
$string['adjustment'] = 'התאמה';
$string['after_submit'] = 'לאחר הגשה';
$string['allowfullanonymous'] = 'אפשר אנונימיות מלאה';
$string['analysis'] = 'ניתוח';
$string['anonymous'] = 'אנונימי';
$string['anonymous_edit'] = 'רשומת שמות משתמש';
$string['anonymous_entries'] = 'רשומות אנונימיות';
$string['anonymous_user'] = 'משתמש אנונימי';
$string['append_new_items'] = 'צרוף פריטים חדשים';
$string['autonumbering'] = 'מספרים אוטומטיים';
$string['autonumbering_help'] = 'אפשר או בטל שימוש במספרים אוטומטיים לכל שאלה';
$string['average'] = 'ממוצע';
$string['bold'] = 'בולט';
$string['cancel_moving'] = 'ביטול הזזה';
$string['cannotmapfeedback'] = 'בעיה במסד הנתונים, לא ניתן למפות סקר לקורס';
$string['cannotsavetempl'] = 'שמירת תבניות לא מאופשרת';
$string['cannotunmap'] = 'בעיה במסד הנתונים, אין אפשרות לא למפות';
$string['captcha'] = 'Captcha';
$string['captchanotset'] = 'לא הוגדר Captcha';
$string['check'] = 'רב ברירה - תשובות מרובות';
$string['check_values'] = 'תגובות מאופשרות';
$string['checkbox'] = 'רב ברירה - תשובות מרובות מאופשרות (סימון תיבות)';
$string['choosefile'] = 'בחירת קובץ';
$string['chosen_feedback_response'] = 'בחירת תגובת סקר';
$string['complete_the_form'] = 'ענה על השאלות';
$string['completed'] = 'הושלם';
$string['completed_feedbacks'] = 'תשובות אשר הוגשו';
$string['completionsubmit'] = 'הצג כהושלם אם הסקר הוגש';
$string['configallowfullanonymous'] = 'אם אפשרות זו מאופשרת הסקר יכול להיות מושלם ללא חלון התחברות. הדבר משפיע רק על סקרים בעמוד הבית.';
$string['confirmdeleteentry'] = 'האם ברצונך למחוק את רשומה זו?';
$string['confirmdeleteitem'] = 'האם ברצונך למחוק את מרכיב זה?';
$string['confirmdeletetemplate'] = 'האם ברצונך למחוק את תבנית זו?';
$string['confirmusetemplate'] = 'האם הינך בטח כיברצונך להשתמש בתבנית זו?';
$string['continue_the_form'] = 'המשך בטופס';
$string['count_of_nums'] = 'ספירת מספרים';
$string['courseid'] = 'courseid';
$string['creating_templates'] = 'שמירת שאלות אלו כתבנית חדשה';
$string['delete_entry'] = 'מחק ערך';
$string['delete_item'] = 'מחק שאלה';
$string['delete_old_items'] = 'מחק פריטים ישנים';
$string['delete_template'] = 'מחק תבנית';
$string['delete_templates'] = 'מחק תבנית...';
$string['depending'] = 'פריטים תלויים';
$string['depending_help'] = 'פריטים תלויים מאפשרים לך להציג פריטים התלויים בערכים מפריטים אחרים.
** להלן דוגמה לשימוש זה**
* ראשית, צור פריט אשר לכל ערך פריטים אחרים תלויים בו.
* שנית, הוסף שבירת עמוד.
* לאחר מכן הוסף את הפריטים תלויים בערך הפריט שלפניהם.
בחר את טופס יצירת הפריט ,את הפריט שברשימה פריט תלוי""
והכנס את הערך הרצוי לתוך תיבת הטקסט ה"ערך התלוי"
**המבנה אמור להיות כך:**
1. Item Q: do you have a car? A: yes/no
2. Pagebreak
3. Item Q: what color has your car?
(this item depends on item 1 with value = yes)
4. Item Q: why you have not a car?
(this item depends on item 1 with value = no)
5. ... other items

זה הכל - בהצלחה!';
$string['dependitem'] = 'פריט תלוי';
$string['dependvalue'] = 'ערך תלוי';
$string['description'] = 'תיאור (הנחייה)';
$string['do_not_analyse_empty_submits'] = 'האם הינך מנתח הגשות ריקות';
$string['drop_feedback'] = 'הסר מקורס זה';
$string['dropdown'] = 'רב ברירה - תשובה יחידה מאופשרת  (מתוך הרשימה של התפריט הנפתח)';
$string['dropdown_values'] = 'תשובות';
$string['dropdownlist'] = 'רב ברירה - תשובה יחידה מאופשרת  (מתוך התפריט הנפתח)';
$string['dropdownrated'] = 'תפריט נפתח  (מדורג)';
$string['edit_item'] = 'עריכת שאלה';
$string['edit_items'] = 'עריכת שאלות';
$string['email_notification'] = 'שליחת הודעות בדוא"ל';
$string['emailnotification'] = 'הודעות בדוא"ל';
$string['emailnotification_help'] = 'אם מאופשר, מנהלי מערכת מקבלים הודעות בדוא"ל של סקרים אשר נשלחו.';
$string['emailteachermail'] = 'המשתמש {$a->username} השלים את פעילות הסקר \'{$a->feedback}\'
ניתן לצפות בו כאן:
{$a->url}';
$string['emailteachermailhtml'] = 'המשתמש {$a->username} השלים את פעילות הסקר :
<i>\'{$a->feedback}\'</i><br /><br />
ניתן לצפות בו <a href="{$a->url}">כאן</a>.';
$string['entries_saved'] = 'התשובה שלך נשמרה. תודה רבה';
$string['export_questions'] = 'יצוא שאלות';
$string['export_to_excel'] = 'יצוא ל-Excel';
$string['feedback:complete'] = 'השלם את הסקר';
$string['feedback:createprivatetemplate'] = 'יצירת תבניות פרטיות';
$string['feedback:createpublictemplate'] = 'יצירת תבניות ציבוריות';
$string['feedback:deletesubmissions'] = 'מחיקת הגשות שהושלמו';
$string['feedback:deletetemplate'] = 'מחיקת תבנית';
$string['feedback:edititems'] = 'עריכת פריטים';
$string['feedback:mapcourse'] = 'מיפוי קורסים לסקרים מערכתיים';
$string['feedback:receivemail'] = 'קבלת הודעות דוא"ל';
$string['feedback:view'] = 'צפיה בסקרים';
$string['feedback:viewanalysepage'] = 'צפיה בעמוד ניתוח הסקרים לאחר ההגשה';
$string['feedback:viewreports'] = 'צפה בדוחות';
$string['feedback_is_not_for_anonymous'] = 'הסקר לא ניתן לביצוע עבור משתמשים אנונימיים';
$string['feedback_is_not_open'] = 'הסקר איננו פתוח';
$string['feedback_options'] = 'אפשרויות הסקר';
$string['feedbackclose'] = 'סגור את הסקר ב';
$string['feedbackcloses'] = 'הסקר נסגר';
$string['feedbackopen'] = 'פתח את הסקר ב';
$string['feedbackopens'] = 'הסקר נפתח';
$string['file'] = 'קובץ';
$string['filter_by_course'] = 'סנון לפי קורס';
$string['generategrade'] = 'צור ציון';
$string['handling_error'] = 'שגיאה חלה בטיפול פעולת רכיב הסקר';
$string['hide_no_select_option'] = 'הסתר את אפשרות "לא נבחר"';
$string['horizontal'] = 'אופקי';
$string['import_questions'] = 'יבוא שאלות';
$string['import_successfully'] = 'היבוא התבצע בהצלחה';
$string['importfromthisfile'] = 'יבוא מקובץ זה';
$string['info'] = 'מידע';
$string['infotype'] = 'סוג-מידע';
$string['insufficient_responses'] = 'תגובות אשר אינן מספיקות';
$string['insufficient_responses_for_this_group'] = 'ישנם תגובות אשר אינן מספיקות עבור קבוצה זו.';
$string['insufficient_responses_help'] = 'ישנם תגובות אשר אינן מספיקות עבור קבוצה זו.
בכדי להשאיר סקר למשתמשים אנונימים יש צורך לפרסם לפחות 2 תגובות.';
$string['item_label'] = 'תווית';
$string['item_name'] = 'שאלה';
$string['items_are_required'] = 'תשובות נדרשות לצורך סימון שאלות בכוכבית.';
$string['label'] = 'תווית';
$string['line_values'] = 'דירוג';
$string['mapcourse'] = 'מיפוי סקר עבור הקורסים';
$string['mapcourse_help'] = 'כברירת מחדל, טפסי הסקרים שנבנו בדף הבית שלך זמינים בכל רוחב האתר ויופיעו בקורסים באמצעות משבצת הסקר. ניתן להכריח את טופס הסקר להופיע על-ידי הפיכתו למשבצת דביקה או על-ידי הגבלת הקורסים כך שטפסי סקרים יופיעו על-ידי מיפוי שלהם לקורס מסויים.';
$string['mapcourseinfo'] = 'זהו סקר אשר זמין לרוחב האתר כולו הזמין לכל הקורסים על-ידי שימוש במשבצת סקר. ניתן להגביל את הקורסים ולקבוע מי יופיע  בה על-ידי מיפוי הסקרים. חפש את הקורס ומפה אותו לסקר זה.';
$string['mapcoursenone'] = 'לא מופו קורסים. הסקר זמין לכל הקורסים';
$string['mapcourses'] = 'מיפוי סקר עבור הקורסים';
$string['mapcourses_help'] = 'ברגע בחירת הקורס(ים) הרלוונטים מהחיפוש שלך. ניתן לשייך אותם עם סקר זה על-ידי מיפוי קורסים.קורסים מרובים ניתנים לבחירה על-ידי החזקת מקש ה-Apple או ה-Ctrl ברשימה והקלקה על השמות לבחירה. יתכן כי קורס ינותק מהסקר בכל זמן נתון.';
$string['mappedcourses'] = 'קורסים אשר מופו';
$string['max_args_exceeded'] = 'ניתן לטפל ב6 משתנים  לכל היותר, יותר מידי משתנים עבור.';
$string['maximal'] = 'מירבי';
$string['messageprovider:message'] = 'הודעות תזכורת להזנת משוב';
$string['messageprovider:submission'] = 'הודעות פעילות "סקר"';
$string['mode'] = 'מצב';
$string['modulename'] = 'סקר';
$string['modulename_help'] = 'תוסף הסקר מאפשר יצירת סקרים המותאמים אישית.';
$string['modulenameplural'] = 'סקר';
$string['move_here'] = 'העבר לכאן';
$string['move_item'] = 'הזז את שאלה זו';
$string['movedown_item'] = 'הזז את שאלה זו למטה';
$string['moveup_item'] = 'הזז את שאלה זו למעלה';
$string['multichoice'] = 'רב ברירה';
$string['multichoice_values'] = 'ערכי רב ברירה';
$string['multichoicerated'] = 'רב ברירה (מדורג)';
$string['multichoicetype'] = 'סוג רב ברירה';
$string['multiple_submit'] = 'הגשות מרובות';
$string['multiplesubmit'] = 'הגשות מרובות';
$string['multiplesubmit_help'] = 'אם מאופשר לסקרים אנונימיים, מתמשים יכולים להגיש את הסקר';
$string['name'] = 'שם';
$string['name_required'] = 'נדרש שם';
$string['next_page'] = 'עמוד הבא';
$string['no_handler'] = 'אין טיפול פעולה עבור';
$string['no_itemlabel'] = 'אין תווית';
$string['no_itemname'] = 'אין שם פריט';
$string['no_items_available_yet'] = 'לא נקבעו עדיין שאלות';
$string['no_templates_available_yet'] = 'עדיין אין תבניות זמינות';
$string['non_anonymous'] = 'שמות המשתמשים יחוברו ויוצגו יחד עם התשובות';
$string['non_anonymous_entries'] = 'לא ניתן להכניס אונונימים';
$string['non_respondents_students'] = 'לא היו תגובות של סטודנטים';
$string['not_completed_yet'] = 'עדיין לא הושלם';
$string['not_selected'] = 'לא נבחר';
$string['not_started'] = 'לא התחיל';
$string['notavailable'] = 'סקר זה איננו זמין';
$string['numeric'] = 'תשובה מספרית';
$string['numeric_range_from'] = 'טווח החל מ';
$string['numeric_range_to'] = 'טווח ל';
$string['of'] = 'של (מן)';
$string['oldvaluespreserved'] = 'כל השאלות הישנות והערכים אשר הוקצו ישמרו';
$string['oldvalueswillbedeleted'] = 'השאלות הנוכחיות וכל תגובות המשתמש שלך ימחקו';
$string['only_one_captcha_allowed'] = 'רק captcha  אחת מותרת בסקר זה';
$string['overview'] = 'סקירה';
$string['page'] = 'עמוד';
$string['page-mod-feedback-x'] = 'עמוד רכיב סקר כלשהו';
$string['page_after_submit'] = 'עמוד לאחר ההגשה';
$string['pagebreak'] = 'שבירת עמוד';
$string['parameters_missing'] = 'פרמטרים חסרים מ';
$string['picture'] = 'תמונ';
$string['picture_file_list'] = 'רשימת תמונות';
$string['picture_values'] = 'בחר אחד או יותר <br />
קבצי תמונה מהרשימה:';
$string['pluginadministration'] = 'ניהול סקר';
$string['pluginname'] = 'סקר';
$string['position'] = 'מיקום';
$string['preview'] = 'תצוגה מקדימה';
$string['preview_help'] = 'בתצוגה המקדימה תוכל לשנות את סדר השאלות';
$string['previous_page'] = 'העמוד הקודם';
$string['public'] = 'ציבורי';
$string['question'] = 'שאלה';
$string['questions'] = 'שאלות';
$string['radio'] = 'רב ברירה - שאלה יחידה';
$string['radio_values'] = 'תגובות';
$string['radiobutton'] = 'רב ברירה - שאלה יחידה מאופשרת
(כפתורי בחירה)';
$string['radiobutton_rated'] = 'כפתורי חד-ברירה (דורגו)';
$string['radiorated'] = 'כפתורי חד-ברירה (דורגו)';
$string['ready_feedbacks'] = 'סקרים מוכנים';
$string['relateditemsdeleted'] = 'כל תגובות המשתמש שלך עבור שאלה זו גם ימחקו';
$string['required'] = 'נדרש';
$string['resetting_data'] = 'איפוס סקר';
$string['resetting_feedbacks'] = 'מאפס';
$string['response_nr'] = 'מספר תגובה';
$string['responses'] = 'תגובות';
$string['responsetime'] = 'זמן תגובה';
$string['save_as_new_item'] = 'שמירה כשאלה חדשה';
$string['save_as_new_template'] = 'שמירת תבנית חדשה';
$string['save_entries'] = 'הגש את תשובותיך';
$string['save_item'] = 'שמירת שאלה';
$string['saving_failed'] = 'השמירה נכשלה';
$string['saving_failed_because_missing_or_false_values'] = 'השמירה נכשלה מפני שהערכים היו חסרים או ערכי שקר.';
$string['search_course'] = 'חיפוש קורס';
$string['searchcourses'] = 'חיפוש קורסים';
$string['searchcourses_help'] = 'חפש שם או קוד של הקורס(ים) אשר תרצה לקשרו עם הסקר הזה.';
$string['selected_dump'] = 'בחירת אינדקסים של משתני $SESSION
אשר מרוקנים למטה';
$string['send'] = 'שליחה';
$string['send_message'] = 'שלח הודעה';
$string['separator_decimal'] = '.';
$string['separator_thousand'] = ',';
$string['show_all'] = 'הצג הכל';
$string['show_analysepage_after_submit'] = 'הצג עמוד ניתוח לאחר שליחה';
$string['show_entries'] = 'הצג תגובות';
$string['show_entry'] = 'הצג תגובה';
$string['show_nonrespondents'] = 'הצג את אלו ללא התגובות';
$string['site_after_submit'] = 'אתר לאחר ההגשה';
$string['sort_by_course'] = 'סנן לפי קורס';
$string['start'] = 'התחלה';
$string['started'] = 'התחיל';
$string['stop'] = 'סיום';
$string['subject'] = 'נושא';
$string['switch_group'] = 'החלף קבוצה';
$string['switch_item_to_not_required'] = 'החלף ל: תשובה איננה נדרשת';
$string['switch_item_to_required'] = 'החלף ל: תשובה נדרשת';
$string['template'] = 'תבנית';
$string['template_saved'] = 'תבנית נשמרה';
$string['templates'] = 'תבניות';
$string['textarea'] = 'תשובת טקסט ארוכה';
$string['textarea_height'] = 'מספר שורות';
$string['textarea_width'] = 'רוחב';
$string['textfield'] = 'תשובת טקסט קצרה';
$string['textfield_maxlength'] = 'מספר מירבי של תווים המתקבלים';
$string['textfield_size'] = 'רוחב שדה הטקסט';
$string['there_are_no_settings_for_recaptcha'] = 'לא נמצאו הגדרות עבור
captcha';
$string['this_feedback_is_already_submitted'] = 'השלמת כבר את פעילות זו.';
$string['timeclose'] = 'זמן לסגירה';
$string['timeclose_help'] = 'ניתן לציין זמנים בהם הסקר זמין עבור משתמשים לענות על השאלות. אם תיבת הסימון איננה מסומנת - אין גבול המוגדר לכך.';
$string['timeopen'] = 'זמן לפתיחה';
$string['timeopen_help'] = 'ניתן לציין זמנים בהם הסקר זמין עבור משתמשים לענות על השאלות. אם תיבת הסימון איננה מסומנת - אין גבול המוגדר לכך.';
$string['typemissing'] = 'חסר ערך "סוג"';
$string['update_item'] = 'שמירת שינויים עבור השאלה';
$string['url_for_continue'] = 'כתובת אינטרנט עבור  כפתור - ה"המשך"';
$string['url_for_continue_button'] = 'כתובת אינטרנט עבור  כפתור ה"המשך"';
$string['url_for_continue_help'] = 'כברירת מחדל, לאחר שהסקר הוגש המטרה של כפתור ה"המשך" היא עמוד הקורס.
תוכל להגדיר כאן עוד אתר אינטרנט כמטרה עבור כפתור ההמשך הזה.';
$string['use_one_line_for_each_value'] = '<br />
השתמש בשורה אחת עבור כל תשובה';
$string['use_this_template'] = 'השתמש בתבנית זו';
$string['using_templates'] = 'השתמש בתבנית';
$string['vertical'] = 'אנכי';
$string['viewcompleted'] = 'סקרים שהושלמו';
$string['viewcompleted_help'] = 'ניתן לצפות בטפסי הסקרים שהושלמו, ניתנים לחיפוש על-ידי הקורס או/ו השאלה.
תגובות הסקר ניתנים ליצוא עבור קובץ
Excel.';
