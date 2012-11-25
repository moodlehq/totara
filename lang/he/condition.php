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
 * Strings for component 'condition', language 'he', branch 'MOODLE_22_STABLE'
 *
 * @package   condition
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addcompletions'] = 'הוספת {no} התניות פעילות לטופס';
$string['addgrades'] = 'הוספת {no} התניות ציונים לטופס';
$string['availabilityconditions'] = 'הגבלת גישה';
$string['availablefrom'] = 'אפשר גישה מ-';
$string['availableuntil'] = 'אפשר גישה עד';
$string['badavailabledates'] = 'התאריכים אינם תקינים, אם תגדיר את התאריכים הגדרת תאריך \'אפשר גישה מ-\' צריכה להיות לפני הגדרת ה\'עד\' תאריך';
$string['badgradelimits'] = 'אם תבחר בגבול ציון עליון ותחתון, הגבול העליון חייב להיות גדול מהגבול התחתון.';
$string['completion_complete'] = 'חייב להיות מסומן כהושלם';
$string['completion_fail'] = 'חייב להשלים עם ציון נכשל';
$string['completion_incomplete'] = 'חייב לא להיות מסומן כ\'הושלם\'';
$string['completion_pass'] = 'חייב להשלים עם ציון עובר';
$string['completioncondition'] = 'תנאי השלמת הפעילות';
$string['completioncondition_help'] = 'הגדרות אלו קובעות תנאי השלמת פעילות שחייבים להתקיים בכדי לאפשר גישה ליחידת לימוד זו.יש לשים לב כי מעקב ההשלמה מוגדר קודם לכן לפני שמוגדרים תנאי השלמת הפעילות.
ניתן גם להגדיר תנאי השלמת פעילות מרובים ועל תנאים אלו להתקיים בכדי לאפשר גישה זו.';
$string['configenableavailability'] = 'כאשר מאופשר,ניתן להגדיר תנאי הגבלת גישה (מבוסס על תאריך , ציון או השלמה) שקובעים האם פעילות או משאב ניתנים לגישה.';
$string['enableavailability'] = 'שימוש במנגנון "תנאי גישה"';
$string['grade_atleast'] = 'חייב להיות לפחות';
$string['grade_upto'] = 'ופחות מ-';
$string['gradecondition'] = 'תנאי ציון';
$string['gradecondition_help'] = 'ההגדרה קובעת תנאי ציון שחייב להיות תואם בכדי לגשת לכל פעילות.
תנאי ציון רבים יכולים להיות מוגדרים כאן כפי שתרצה. אם תגדיר כמה תנאים, הפעילות תאפשר גישה אך ורק אם כל תנאי הציון מותאמים.';
$string['gradeitembutnolimits'] = 'חובה להכניס גבול תחתון, גבול תחתון או שניהם.';
$string['gradelimitsbutnoitem'] = 'חובה לבחור פריט ציון';
$string['gradesmustbenumeric'] = 'הציון המירבי והמזערי חייבים להיות מספריים או ריקים.';
$string['none'] = '(אף אחד)';
$string['notavailableyet'] = 'לא זמין עדיין';
$string['requires_completion_0'] = 'לא זמין אלא אם כן הפעילות <strong>{$a}</strong> לא הושלמה';
$string['requires_completion_1'] = 'לא זמין עד שהפעילות <strong>{$a}</strong> תסומן כהושלמה';
$string['requires_completion_2'] = 'לא זמין עד שהפעילות  <strong>{$a}</strong> הושלמה ועברה';
$string['requires_completion_3'] = 'לא זמין עד שהפעילות  <strong>{$a}</strong> הושלמה ונכשלה';
$string['requires_date'] = 'זמין מ {$a}.';
$string['requires_date_before'] = 'זמין עד {$a}.';
$string['requires_date_both'] = 'זמין מ {$a->from} עד {$a->until}.';
$string['requires_date_both_single_day'] = 'זמין ב {$a}.';
$string['requires_grade_any'] = 'לא זמין עד אשר יש לך ציון ב-<strong>{$a}</strong>.';
$string['requires_grade_max'] = 'לא זמין אלא אם כן יש לך ציון מתאים ב <strong>{$a}</strong>.';
$string['requires_grade_min'] = 'לא זמין עד לאחר שתשיג ציון שנדרש ב- <strong>{$a}</strong>.';
$string['requires_grade_range'] = 'לא זמין אלא אם כן תקבל ציון מיוחד ב-<strong>{$a}</strong>.';
$string['showavailability'] = 'לפני שניתן לגשת לפעילות';
$string['showavailability_hide'] = 'הסתרת הפעילות';
$string['showavailability_show'] = 'הראה את הפעילות באפור (לא זמינה), עם מידע על הגבלת גישה';
$string['userrestriction_hidden'] = 'הוגבל (מוסתר לחלוטין, אין הודעות): &lsquo;{$a}&rsquo;';
$string['userrestriction_visible'] = 'הוגבל: &lsquo;{$a}&rsquo;';
