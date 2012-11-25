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
 * Strings for component 'rating', language 'he', branch 'MOODLE_22_STABLE'
 *
 * @package   rating
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['aggregateavg'] = 'ממוצע דירוגים';
$string['aggregatecount'] = 'ספירת הדירוגים';
$string['aggregatemax'] = 'דירוג מירבי';
$string['aggregatemin'] = 'דירוג מזערי';
$string['aggregatenone'] = 'ללא דירוגים';
$string['aggregatesum'] = 'סיכום דירוגים';
$string['aggregatetype'] = 'סוג צבירה';
$string['aggregatetype_help'] = 'סוג הצבירה קובעת איך דירוגים משולבים ליצירה של הציון הסופי בגליון הציונים.
* ממוצע של דירוגים - ממוצע כל הדירוגים
* ספירת הדירוגים - מספר הפריטים שדורגו הופך להיות הציון הסופי. דעו כי סך-כל הציון אינו יכול לעבור את הציון המירבי עבור הפעילות.
* מקסימום - הדירוג הגבוה ביותר הופך להיות הציון הסופי.
* מינימום - הדירוג הנמוך ביותר הופך להיות הציון הסופי
* סכום - כל הדירוגים מסתכמים יחד, דעו כי סך-כל הציון אינו יכול לעבור את הציון המירבי של הפעילות.
אם נבחרה האפשרות " ללא דירוגים" הפעילות לא תופיע בגליון הציונים.';
$string['allowratings'] = 'האם לדרג את כל הפריטים?';
$string['allratingsforitem'] = 'כל הדירוגים שהוגשו';
$string['capabilitychecknotavailable'] = 'יכולת תאימות לא זמינה עד אשר הפעילות תשמר';
$string['couldnotdeleteratings'] = 'מצטערים, לא ניתן למחוק זאת מכוון ואנשים כבר דירגו זאת.';
$string['norate'] = 'דירוג פריטים לא מורשת!';
$string['noratings'] = 'לא הוגשו דירוגים';
$string['noviewanyrate'] = 'ניתן לצפות בתוצאות עבור פרסומים אשר אתה ביצעת בלבד.';
$string['noviewrate'] = 'אין לך הרשאה לצפיה בדירוגי פרסומים';
$string['rate'] = 'דרג';
$string['ratepermissiondenied'] = 'אין לך הרשאה לדרג פריט זה';
$string['rating'] = 'דירוג';
$string['ratinginvalid'] = 'דירוג לא חוקי';
$string['ratings'] = 'דירוגים';
$string['ratingtime'] = 'מנע דירוגים עבור פריטים עם תאריכים בטווח זה.';
$string['rolewarning'] = 'תפקידים בעלי הרשאות לדירוג';
$string['rolewarning_help'] = 'לביצוע דירוגים, צריך לאפשר את הרשאת "moodle/rating:rate" וכל יכולת הרשאת רכיבים ספציפית. משתמשים אשר מוקצה להם תפקיד זה יוכלו לדרג פריטים.
רשימת התפקידים תמצא דרך קישור הרשאות בהגדרות המשבצת.';
