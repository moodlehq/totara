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
 * Strings for component 'feedback', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   feedback
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['add_item'] = 'Kérdés hozzáadása tevékenységhez';
$string['add_items'] = 'Kérdés hozzáadása tevékenységhez';
$string['add_pagebreak'] = 'Oldaltörés hozzáadása';
$string['adjustment'] = 'Igazítás';
$string['after_submit'] = 'Leadás után';
$string['allowfullanonymous'] = 'Teljes névtelenség engedélyezése';
$string['analysis'] = 'Elemzés';
$string['anonymous'] = 'Névtelen';
$string['anonymous_edit'] = 'Felhasználónevek rögzítése';
$string['anonymous_entries'] = 'Névtelen bejegyzések';
$string['anonymous_user'] = 'Névtelen felhasználó';
$string['append_new_items'] = 'Új tételek hozzáfűzése';
$string['autonumbering'] = 'Automatikus számok';
$string['autonumbering_help'] = 'Ki- és bekapcsolja automatikus számok használatát az egyes kérdésekhez';
$string['average'] = 'Átlag';
$string['bold'] = 'Félkövér';
$string['cancel_moving'] = 'Áthelyezés visszavonása';
$string['cannotmapfeedback'] = 'Hiba az adatbázisban, a visszajelzés nem kapcsolható hozzá a kurzushoz.';
$string['cannotsavetempl'] = 'sablonok mentése nem engedélyezett';
$string['cannotunmap'] = 'Hiba az adatbázisban, a kapcsolat bontása nem lehetséges.';
$string['captcha'] = 'Vizuális kód';
$string['captchanotset'] = 'Nincs beállítva vizuális kód.';
$string['check'] = 'Feleletválasztós - több válasz';
$string['check_values'] = 'Tanuló által adott lehetséges válaszok';
$string['checkbox'] = 'Feleletválasztós - több válasz lehetséges (jelölőnégyzetek)';
$string['choosefile'] = 'Válasszon állományt';
$string['chosen_feedback_response'] = 'kiválasztott válasz a visszajelzéshez';
$string['complete_the_form'] = 'Válaszoljon a kérdésekre...';
$string['completed'] = 'kész';
$string['completed_feedbacks'] = 'Leadott válaszok';
$string['completionsubmit'] = 'Visszajelzés leadása esetén tekintse befejezettnek';
$string['configallowfullanonymous'] = 'Igenre állítás esetén a visszajelzés belépés nélkül kitölthető. Csak a honlapon lévő visszajelzéseket érinti.';
$string['confirmdeleteentry'] = 'Biztosan törli ezt a bejegyzést?';
$string['confirmdeleteitem'] = 'Biztosan törli ezt az elemet?';
$string['confirmdeletetemplate'] = 'Biztosan törli ezt a sablont?';
$string['confirmusetemplate'] = 'Biztosan ezt a sablont akarja használni?';
$string['continue_the_form'] = 'Űrlap folytatása';
$string['count_of_nums'] = 'Számok összesen';
$string['courseid'] = 'kurzusazonosító';
$string['creating_templates'] = 'Kérdések elmentése új sablonként';
$string['delete_entry'] = 'Bejegyzés törlése';
$string['delete_item'] = 'Kérdés törlése';
$string['delete_old_items'] = 'Régi tételek törlése';
$string['delete_template'] = 'Sablon törlése';
$string['delete_templates'] = 'Sablon törlése...';
$string['depending'] = 'függő tételek';
$string['depending_help'] = 'A függő tételekkel megtekintheti a más tételek értékétől függő tételeket.
**Íme egy szemléltető példa:**
* Először hozzon létre egy tételt, melynek értékétől egyéb tételek függnek.
* Ezután szúrjon be egy oldaltörést.
* Ezután adjon hozzá tételeket, melyek az előző tétel értékétől függnek
A tételkészítő űrlapon lévő listáról válassza ki a "függő tétel"-t és a "függő érték" szövegmezőbe írja be a szükséges értéket.
**A szerkezet ekként néz ki:**
1. Tételkérdés: van autója? V: van/nincs
2. Oldaltörés
3. Tételkérdés: milyen színű az autója?
(ez a tétel az első = igen értékétől függ)
4. Tételkérdés: miért nincs autója?
(ez a tétel az első = nem értékétől függ)
5. ... további tételek

Ennyi az egész. Sok sikert!';
$string['dependitem'] = 'függő tétel';
$string['dependvalue'] = 'függő érték';
$string['description'] = 'Leírás';
$string['do_not_analyse_empty_submits'] = 'Az üres leadásokat ne elemezze';
$string['drop_feedback'] = 'Törlés a kurzusból';
$string['dropdown'] = 'Feleletválasztós - egyetlen válasz lehetséges (lenyíló lista)';
$string['dropdown_values'] = 'Válaszok';
$string['dropdownlist'] = 'Feleletválasztós - egyetlen válasz (lenyíló lista)';
$string['dropdownrated'] = 'Lenyíló lista (pontozott)';
$string['edit_item'] = 'Kérdés szerkesztése';
$string['edit_items'] = 'Kérdések szerkesztése';
$string['email_notification'] = 'Értesítések küldése e-mailben';
$string['emailnotification'] = 'értesítések e-mailben';
$string['emailnotification_help'] = 'Bekapcsolása esetén a rendszergazdák értesítést kapnak a visszajelzések beérkezéséről';
$string['emailteachermail'] = '{$a->username} befejezte a visszajelzési tevékenységet : \'{$a->feedback}\'. Itt megtekintheti: {$a->url}';
$string['emailteachermailhtml'] = '{$a->username} befejezte a visszajelzési tevékenységet : <i>\'{$a->feedback}\'</i><br /><br />Itt <a href="{$a->url}">megtekintheti</a>.';
$string['entries_saved'] = 'Válaszait a rendszer elmentette. Köszönet!';
$string['export_questions'] = 'Kérdések exportálása';
$string['export_to_excel'] = 'Exportálás Excelbe';
$string['feedback:complete'] = 'Visszajelzés kitöltése';
$string['feedback:createprivatetemplate'] = 'Saját sablon létrehozása';
$string['feedback:createpublictemplate'] = 'Közös sablon létrehozása';
$string['feedback:deletesubmissions'] = 'Kitöltött leadások törlése';
$string['feedback:deletetemplate'] = 'Sablon törlése';
$string['feedback:edititems'] = 'Tételek szerkesztése';
$string['feedback:mapcourse'] = 'Kurzusok és globális visszajelzések összeillesztése';
$string['feedback:receivemail'] = 'Értesítés átvétele e-mailben';
$string['feedback:view'] = 'Visszajelzés megtekintése';
$string['feedback:viewanalysepage'] = 'Az elemzési oldal megtekintése leadás után';
$string['feedback:viewreports'] = 'Jelentések megtekintése';
$string['feedback_is_not_for_anonymous'] = 'A visszajelzés nem lehetséges névtelen felhasználó esetén.';
$string['feedback_is_not_open'] = 'A visszajelzés nincs nyitva';
$string['feedback_options'] = 'Visszajelzési lehetőségek';
$string['feedbackclose'] = 'A visszajelzés lezárásának időpontja';
$string['feedbackcloses'] = 'A visszajelzés lezáródik';
$string['feedbackopen'] = 'A visszajelzés megnyitásának időpontja';
$string['feedbackopens'] = 'A visszajelzés megnyílik';
$string['file'] = 'Állomány';
$string['filter_by_course'] = 'Szűrés kurzus szerint';
$string['handling_error'] = 'Hiba történt a visszajelzési modul tevékenységkezelése közben';
$string['hide_no_select_option'] = 'A "Nincs kiválasztva" lehetőség elrejtése';
$string['horizontal'] = 'vízszintes';
$string['import_questions'] = 'Kérdések importálása';
$string['import_successfully'] = 'Az importálás sikerült';
$string['importfromthisfile'] = 'Importálás ebből az állományból';
$string['info'] = 'Információk';
$string['infotype'] = 'Információk típusa';
$string['insufficient_responses'] = 'kevés válasz';
$string['insufficient_responses_for_this_group'] = 'A csoporthoz nincs elég tanulói válasz';
$string['insufficient_responses_help'] = 'A csoport esetén kevés a válasz.
A visszajelzés névtelenségének megőrzéséhez legalább 2 válaszra van szükség.';
$string['item_label'] = 'Címke';
$string['item_name'] = 'Kérdés';
$string['items_are_required'] = 'A csillaggal ellátott kérdések választ igényelnek.';
$string['label'] = 'Címke';
$string['line_values'] = 'Osztályozás';
$string['mapcourse'] = 'Visszajelzés kapcsolása kurzusokhoz';
$string['mapcourse_help'] = 'Alapesetben a honlapján létrehozott visszajelzési űrlapok az egész portálon elérhetők és minden visszajelzési blokkot használó kurzusban megjelennek. A visszajelzési űrlap megjelenését elérheti, ha jegyzetblokká alakítja át, vagy korlátozhatja a visszajelzési űrlap megjelenését konkrét kurzusokra.';
$string['mapcourseinfo'] = 'Ez az egész portálra érvényes visszajelzés, amely a visszajelzési blokkot használja az összes kurzus esetén. A kurzusok illesztésével korlátozhatja, mely kurzusok esetén jelenjen meg a visszajelzés. Keresse ki a kurzust és illessze ehhez a visszajelzéshez.';
$string['mapcoursenone'] = 'Nincs illesztett kurzus. A visszajelzés minden kurzusra érvényes.';
$string['mapcourses'] = 'A visszajelzés illesztése kurzusokhoz.';
$string['mapcourses_help'] = 'Ha kikereste a megfelelő kurzus(oka)t, a kurzus(ok) illesztésével összekapcsolhatja őket ezzel a visszajelzéssel. Egyszerre több kurzust az Apple vagy Ctrl billentyű nyomva tartása közben a kurzusok nevére kattintva választhat ki. A visszajelzés és valamely kurzus között a kapcsolatot bármikor törölheti.';
$string['mappedcourses'] = 'Illesztett kurzusok';
$string['max_args_exceeded'] = 'Legfeljebb 6 argumentum kezelhető, túl sokat adott meg';
$string['maximal'] = 'maximum';
$string['messageprovider:message'] = 'Visszajelzésre emlékeztető';
$string['messageprovider:submission'] = 'Értesítések visszajelzésekről';
$string['mode'] = 'Mód';
$string['modulename'] = 'Visszajelzés';
$string['modulename_help'] = 'A visszajelzési modullal egyedi felméréseket hozhat létre.';
$string['modulenameplural'] = 'Visszajelzések';
$string['move_here'] = 'Áthelyezés ide';
$string['move_item'] = 'A kérdés áthelyezése';
$string['movedown_item'] = 'A kérdés lentebbre helyezése';
$string['moveup_item'] = 'A kérdés fentebbre helyezése';
$string['multichoice'] = 'Feleletválasztós';
$string['multichoice_values'] = 'Feleletválasztós értékek';
$string['multichoicerated'] = 'Feleletválasztós (osztályozott)';
$string['multichoicetype'] = 'Feleletválasztós típusa';
$string['multiple_submit'] = 'Több leadás';
$string['multiplesubmit'] = 'Több leadás';
$string['multiplesubmit_help'] = 'Ha névtelen felmérésekhez be van kapcsolva, a felhasználók korlátlan számú visszajelzést adhatnak le.';
$string['name'] = 'Név';
$string['name_required'] = 'Név megadása kötelező';
$string['next_page'] = 'Következő oldal';
$string['no_handler'] = 'Nincs tevékenységkezelő ehhez:';
$string['no_itemlabel'] = 'Nincs címke';
$string['no_itemname'] = 'Nincs tételnév';
$string['no_items_available_yet'] = 'Még nincs beállítva kérdés';
$string['no_templates_available_yet'] = 'Még nincs sablon';
$string['non_anonymous'] = 'A felhasználó nevét a rendszer naplózza és a válaszok mellett megjeleníti';
$string['non_anonymous_entries'] = 'nem névtelen bejegyzések';
$string['non_respondents_students'] = 'nem válaszoló tanulók';
$string['not_completed_yet'] = 'Még nincs kész';
$string['not_selected'] = 'Nincs kiválasztva';
$string['not_started'] = 'nem kezdődött el';
$string['notavailable'] = 'a visszajelzés nem érhető el';
$string['numeric'] = 'Számjegyes válasz';
$string['numeric_range_from'] = 'Tartomány kezdete';
$string['numeric_range_to'] = 'Tartomány vége';
$string['of'] = '/';
$string['oldvaluespreserved'] = 'Minden régi kérdés és hozzárendelt érték megőrződik';
$string['oldvalueswillbedeleted'] = 'A jelenlegi kérdések és minden felhasználók által adott válasz törlődik.';
$string['only_one_captcha_allowed'] = 'A visszajelzésben csak egy vizuális kód szerepelhet.';
$string['overview'] = 'Áttekintés';
$string['page'] = 'Oldal';
$string['page-mod-feedback-x'] = 'Bármely visszajelzési moduloldal';
$string['page_after_submit'] = 'Leadás utáni oldal';
$string['pagebreak'] = 'Oldaltörés';
$string['parameters_missing'] = 'Hiányzó paraméterek:';
$string['picture'] = 'Kép';
$string['picture_file_list'] = 'Képek listája';
$string['picture_values'] = 'Válasszon képe(ke)t<br />a listáról:';
$string['pluginadministration'] = 'Visszajelzések kezelése';
$string['pluginname'] = 'Visszajelzés';
$string['position'] = 'Helyzet';
$string['preview'] = 'Előkép';
$string['preview_help'] = 'Előnézetben módosíthat a kérdések sorrendjén.';
$string['previous_page'] = 'Előző oldal';
$string['public'] = 'Nyilvános';
$string['question'] = 'Kérdés';
$string['questions'] = 'Kérdések';
$string['radio'] = 'Feleletválasztós - egy válasz';
$string['radio_values'] = 'Tanuló válaszai';
$string['radiobutton'] = 'Feleletválasztós - egy válasz lehetséges (választógombok)';
$string['radiobutton_rated'] = 'Választógomb (osztályozott)';
$string['radiorated'] = 'Választógomb (osztályozott)';
$string['ready_feedbacks'] = 'Kész visszajelzések';
$string['relateditemsdeleted'] = 'A kérdésre vonatkozó összes felhasználók által adott válasz is törlődik.';
$string['required'] = 'Kitöltendő';
$string['resetting_data'] = 'Visszajelzésekhez kapcsolódó válaszok visszaállítása';
$string['resetting_feedbacks'] = 'Visszajelzések visszaállítása';
$string['response_nr'] = 'Válasz száma:';
$string['responses'] = 'Tanuló válaszai';
$string['responsetime'] = 'Tanuló válaszainak ideje';
$string['save_as_new_item'] = 'Mentés új kérdésként';
$string['save_as_new_template'] = 'Mentés új sablonként';
$string['save_entries'] = 'Válaszainak leadása';
$string['save_item'] = 'Kérdés mentése';
$string['saving_failed'] = 'A mentés nem sikerült!';
$string['saving_failed_because_missing_or_false_values'] = 'A mentés hiányzó vagy hibás értékek miatt nem sikerült.';
$string['search_course'] = 'Kurzus keresése';
$string['searchcourses'] = 'Keresés a kurzusokban';
$string['searchcourses_help'] = 'Azon kurzus(ok) kódjának vagy nevének kikeresése, amelyet a visszajelzéssel össze kíván kapcsolni.';
$string['selected_dump'] = 'A $SESSION változó kiválasztott indexeinek előállítását lásd alább:';
$string['send'] = 'küldés';
$string['send_message'] = 'üzenet küldése';
$string['separator_decimal'] = ',';
$string['separator_thousand'] = '.';
$string['show_all'] = 'Mindet mutatja';
$string['show_analysepage_after_submit'] = 'Elemzési oldal megjelenítése leadás után';
$string['show_entries'] = 'Tanuló válaszainak megjelenítése';
$string['show_entry'] = 'Tanuló válaszának megjelenítése';
$string['show_nonrespondents'] = 'Nem válaszolók megjelenítése';
$string['site_after_submit'] = 'A portál a leadás után';
$string['sort_by_course'] = 'Rendezés kurzusok szerint';
$string['start'] = 'Kezdés';
$string['started'] = 'elkezdődött';
$string['stop'] = 'Befejezés';
$string['subject'] = 'Tárgy';
$string['switch_group'] = 'Váltás csoportok között';
$string['switch_item_to_not_required'] = 'váltás: válasz nem szükséges';
$string['switch_item_to_required'] = 'váltás: válasz szükséges';
$string['template'] = 'Sablon';
$string['template_saved'] = 'Sablon elmentve';
$string['templates'] = 'Sablonok';
$string['textarea'] = 'Hosszabb szöveges válasz';
$string['textarea_height'] = 'Sorok száma';
$string['textarea_width'] = 'Szélesség';
$string['textfield'] = 'Rövid szöveges válasz';
$string['textfield_maxlength'] = 'Elfogadott maximális karakterszám';
$string['textfield_size'] = 'Szövegmező szélessége';
$string['there_are_no_settings_for_recaptcha'] = 'Nincs beállítás a vizuális kódhoz';
$string['this_feedback_is_already_submitted'] = 'Ezt a tevékenységet már befejezte.';
$string['timeclose'] = 'Lezárás időpontja';
$string['timeclose_help'] = 'Megadhatja, mikor legyen a visszajelzés elérhető a kérdést megválaszolók számára. Ha nincs bejelölve, nincs időkorlát.';
$string['timeopen'] = 'Megnyitás időpontja';
$string['timeopen_help'] = 'Megadhatja, mikor legyen a visszajelzés elérhető a kérdést megválaszolók számára. Ha nincs bejelölve, nincs időkorlát.';
$string['typemissing'] = 'hiányzik a "típus" érték';
$string['update_item'] = 'Kérdés módosításainak elmentése';
$string['url_for_continue'] = 'URL a Tovább gombhoz';
$string['url_for_continue_button'] = 'URL a Tovább gombhoz';
$string['url_for_continue_help'] = 'Alapesetben a visszajelzés leadása után a Tovább gombbal a kurzusoldalra kerül. Itt megadhat egy másik URL-t a továbblépéshez.';
$string['use_one_line_for_each_value'] = '<br />Minden válaszhoz egy-egy sort használjon!';
$string['use_this_template'] = 'Ezen sablon használata';
$string['using_templates'] = 'Sablon használata';
$string['vertical'] = 'függőleges';
$string['viewcompleted'] = 'kitöltött visszajelzések';
$string['viewcompleted_help'] = 'Megtekintheti a kitöltött visszajelzési űrlapokat, melyek között kurzusonként és/vagy kérdésenként kereshet.
A visszajelzések válaszait Excelbe exportálhatja.';
