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
 * Strings for component 'feedback', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   feedback
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['add_item'] = 'Lisää aktiviteettiin kysymys';
$string['add_items'] = 'Lisää aktiviteettiin kysymys';
$string['add_pagebreak'] = 'Lisää sivunvaihto';
$string['adjustment'] = 'Säätö';
$string['after_submit'] = 'Lähettämisen jälkeen';
$string['allowfullanonymous'] = 'Salli anonymiteetti';
$string['analysis'] = 'Analyysi';
$string['anonymous'] = 'Anonyymi';
$string['anonymous_edit'] = 'Tallenna osallistujien nimet';
$string['anonymous_entries'] = 'Anonyymit palautteet';
$string['anonymous_user'] = 'Anonyymi vastaaja';
$string['append_new_items'] = 'Lisää uudet kysymykset';
$string['autonumbering'] = 'Kysymysten automaattinen numerointi';
$string['autonumbering_help'] = 'Ottaa käyttöön / poistaa käytöstä kysymysten automaattisen numeroinnin';
$string['average'] = 'Keskiarvo';
$string['bold'] = 'Lihavoitu teksti';
$string['cancel_moving'] = 'Peruuta siirto';
$string['cannotmapfeedback'] = 'Tietokantaongelma, ei voida yhdistää palautetta kurssiin';
$string['cannotsavetempl'] = 'mallipohjien tallentaminen ei ole sallittu';
$string['cannotunmap'] = 'Tietokantaongelma, ei voida poistaa yhdistettä';
$string['captcha'] = 'Roskapostivarmenne';
$string['captchanotset'] = 'Roskapostivarmennetta ei ole asetettu';
$string['check'] = 'Monivalinta - monta vastausta';
$string['check_values'] = 'Mahdolliset vastaukset';
$string['checkbox'] = 'Monivalinta - monta vastausta sallittu (valintaruudut)';
$string['choosefile'] = 'Valitse tiedosto';
$string['chosen_feedback_response'] = 'valittu palautevastaus';
$string['complete_the_form'] = 'Vastaa kysymyksiin';
$string['completed'] = 'valmis';
$string['completed_feedbacks'] = 'Lähetetyt vastaukset';
$string['completionsubmit'] = 'Näytä valmiina jos palaute on lähetetty';
$string['configallowfullanonymous'] = 'Jos tämä asetus on kyllä, palaute voidaan antaa ilman sisäänkirjautumista. Tämä vaikuttaa vain kotisivun palautteisiin.';
$string['confirmdeleteentry'] = 'Haluatko poistaa tämän palautteen?';
$string['confirmdeleteitem'] = 'Haluatko poistaa tämän elementin?';
$string['confirmdeletetemplate'] = 'Haluatko poistaa tämän mallin?';
$string['confirmusetemplate'] = 'Haluatko käyttää tätä mallia?';
$string['continue_the_form'] = 'Jatka lomaketta';
$string['count_of_nums'] = 'Numeroiden lukumäärä';
$string['courseid'] = 'kurssinid';
$string['creating_templates'] = 'Tallenna kysymykset uutena mallipohjana';
$string['delete_entry'] = 'Poista palaute';
$string['delete_item'] = 'Poista kysymys';
$string['delete_old_items'] = 'Poista vanhat palautteet';
$string['delete_template'] = 'Poista mallipohja';
$string['delete_templates'] = 'Poista mallipohja...';
$string['depending'] = 'Riippuvuudet';
$string['depending_help'] = 'Riippuvuuksilla määrittelet aiemmista kysymyksistä riippuvia jatkokysymyksiä. Tee näin:
* Luo ensin kysymys, jonka vastausvaihtoehtojen arvoista muut kysymykset riippuvat. Tähän kannattaa käyttää monivalintakysymysvaihtoehtoja mieluummin kuin avoimia tekstikenttiä.
* **|Lisää sitten sivunvaihto.**
* Lisää sitten kysymykset, jotka riippuvat aiemmasta kysymyksestä. Valitse riippuvuuden lähdekysymys kohdasta "Tämä kysymys riippuu kysymyksestä" ja lisää tekstikenttään "Riippuvuuden arvo" lähdekysymyksen vastausvaihtoehto, joka pitää olla valittuna.

**Tässä on käytännön esimerkki:**
1. Kohde Q: onko sinulla auto? A: kyllä/ei
2. Sivunvaihto
3. Kohde Q: minkä värinen autosi on?
(tämä kohde riippuu kohteesta 1 arvolla = kyllä)
4. Kohde Q: miksi sinulla ei ole autoa?
(tämä kohde riippuu kohteesta 1 arvolla = ei)
5. ... muut kohteet

Siinä kaikki. Pidä hauskaa!';
$string['dependitem'] = 'Tämä kysymys riippuu kysymyksestä';
$string['dependvalue'] = 'Riippuvuuden arvo';
$string['description'] = 'Kuvaus';
$string['do_not_analyse_empty_submits'] = 'Älä analysoi tyhjiä vastauksia';
$string['drop_feedback'] = 'Poista tämä kurssi';
$string['dropdown'] = 'Monivalinta, vain yksi vastaus (pudotusvalikko)';
$string['dropdown_values'] = 'Vastaukset';
$string['dropdownlist'] = 'Monivalinta - yksi vastaus (pudotusvalikko)';
$string['dropdownrated'] = 'Pudotusvalikko';
$string['edit_item'] = 'Muokkaa kysymystä';
$string['edit_items'] = 'Muokkaa kysymyksiä';
$string['email_notification'] = 'Lähetä sähköposti-ilmoituksia';
$string['emailnotification'] = 'sähköposti-ilmoitukset';
$string['emailnotification_help'] = 'Jos kyllä, ylläpitäjät saavat sähköposti-ilmoituksen lähetetyistä palautteista.';
$string['emailteachermail'] = '{$a->username} on vastannut Palaute-aktiviteettiin \'{$a->feedback}\'

Voit katsoa sen täältä:

{$a->url}';
$string['emailteachermailhtml'] = '{$a->username} on vastannut Palaute-aktiviteettiin <i>\'{$a->feedback}\'</i><br /><br /> Voit katsoa sen <a href="{$a->url}">täältä</a>.';
$string['entries_saved'] = 'Vastauksesi on tallennettu. Kiitos.';
$string['export_questions'] = 'Vie kysymykset';
$string['export_to_excel'] = 'Vie Exceliin';
$string['feedback:complete'] = 'Anna palaute';
$string['feedback:createprivatetemplate'] = 'Luo yksityinen mallipohja';
$string['feedback:createpublictemplate'] = 'Luo julkinen mallipohja';
$string['feedback:deletesubmissions'] = 'Poista annetut palautteet';
$string['feedback:deletetemplate'] = 'Poista mallipohja';
$string['feedback:edititems'] = 'Muokkaa kysymyksiä';
$string['feedback:mapcourse'] = 'Yhdistä kurssit yleisiin palautteisiin';
$string['feedback:receivemail'] = 'Vastaanota sähköposti-ilmoituksia';
$string['feedback:view'] = 'Näytä palaute';
$string['feedback:viewanalysepage'] = 'Näytä analyysisivu vastaamisen jälkeen';
$string['feedback:viewreports'] = 'Näytä rapotit';
$string['feedback_is_not_for_anonymous'] = 'palaute ei ole anonyymeille';
$string['feedback_is_not_open'] = 'Palaute ei ole auki';
$string['feedback_options'] = 'Palautteen asetukset';
$string['feedbackclose'] = 'Sulje palaute';
$string['feedbackcloses'] = 'Palaute sulkeutuu';
$string['feedbackopen'] = 'Avaa palaute';
$string['feedbackopens'] = 'Palaute avautuu';
$string['file'] = 'Tiedosto';
$string['filter_by_course'] = 'Suodata kurssin mukaan';
$string['generategrade'] = 'Luo arvosana';
$string['handling_error'] = 'Palautemoduulin toiminnan käsittelyssä tapahtui virhe.';
$string['hide_no_select_option'] = 'Piilota "Ei valittu" vaihtoehto';
$string['horizontal'] = 'vaakasuora';
$string['import_questions'] = 'Tuo kysymykset';
$string['import_successfully'] = 'Tuo onnistuneesti';
$string['importfromthisfile'] = 'Tuo tästä tiedostosta';
$string['info'] = 'Taustatieto';
$string['infotype'] = 'Taustatiedon tyyppi';
$string['insufficient_responses'] = 'riittämättömät vastaukset';
$string['insufficient_responses_for_this_group'] = 'Tällä ryhmällä on riittämättömiä vastauksia';
$string['insufficient_responses_help'] = 'Tällä ryhmällä on riittämättömiä vastauksia.
Vähintään 2 vastausta tarvitaan, jotta palaute voidaan pitää anonyyminä.';
$string['item_label'] = 'Kysymyksen tunniste';
$string['item_name'] = 'Kysymys';
$string['items_are_required'] = 'Tähdellä merkityt kysymykset ovat pakollisia';
$string['label'] = 'Ohjeteksti';
$string['line_values'] = 'Arvio';
$string['mapcourse'] = 'Yhdistä palaute kursseihin';
$string['mapcourse_help'] = 'Etusivulla tehdyt palautelomakkeet ovat oletuksena saatavilla sivustonlaajuisesti ja näkyvät kaikilla palautelohkoa käyttävillä kursseilla. Voit pakottaa palautelomakkeen näkymisen tekemällä palautelohkosta pakotetun, tai rajoittaa kursseja, joilla palautelomake näkyy, yhdistämällä lomake vain tiettyihin kursseihin.';
$string['mapcourseinfo'] = 'Tämä on sivustonlaajuinen palaute, joka on saatavilla kaikilla kursseilla, joissa on käytössä palautelohko. Voit kuitenkin rajoittaa kursseja, joilla palaute näkyy, yhdistämällä ne palautteeseen. Etsi kurssi ja yhdistä se tähän palautteeseen.';
$string['mapcoursenone'] = 'Ei yhdistettyjä kursseja. Palaute on saatavilla kaikilla kursseilla';
$string['mapcourses'] = 'Yhdistä palaute kursseihin';
$string['mapcourses_help'] = 'Kun olet valinnut oleelliset kurssit haustasi, voit yhdistää ne tähän palautteeseen käyttämällä \'yhdistä kurssi(t)\' -toimintoa. Voit valita useita kursseja pitämällä pohjassa Apple- tai Ctrl-näppäintä kun klikkaat kurssien nimiä. Kurssin linkitys palautteeseen voidaan poistaa koska vain.';
$string['mappedcourses'] = 'Yhdistetyt kurssit';
$string['max_args_exceeded'] = 'Korkeintaan 6 argumenttia voidaan käsitellä, liian paljon argumentteja kohteelle';
$string['maximal'] = 'maksimaalinen';
$string['messageprovider:message'] = 'Muistutus palautteeseen vastaamisesta';
$string['messageprovider:submission'] = 'Palautteen ilmoitukset';
$string['mode'] = 'Tila';
$string['modulename'] = 'Palaute';
$string['modulename_help'] = 'Palaute-aktiviteetilla voit tehdä omia kyselyjä. Tarjolla on monivalinta-, kyllä/ei- ja avointen tekstikysymystyyppien lisäksi ohjeteksti väliohjeita varten, sivunvaihto ja sekä taustatietoja. Lisäksi voit rakentaa riippuvuuksia kysymysten välille.
Palautteen vastaukset ovat halutessasi anonyymejä, ja voit valita näyttää vastausten yhteenvedon kaikille osallistujille tai rajata vain opettajien näkyville. Moodlen pääsivulle voi myös lisätä Palaute-aktiviteetteja, joihin myös kirjautumattomat käyttäjät voivat tällöin vastata (tällaisen voi lisätä vain Moodlen pääkäyttäjä).
Palaute-aktiviteettia voi käyttää esimerkiksi
* kesken kurssin osallistujien jatkotarpeiden ja -toiveiden esittämiseen
* kurssin lopussa kurssipalautteen kieräämiseen (paitsi jos organisaatiossasi on käytössä muu kurssipalautteen keruutapa)
* oman opetuksen kyselytutkimukseen';
$string['modulenameplural'] = 'Palaute';
$string['move_here'] = 'Siirrä tähän';
$string['move_item'] = 'Siirrä tämä kysymys';
$string['movedown_item'] = 'Siirrä tämä kysymys alemmas';
$string['moveup_item'] = 'Siirrä tämä kysymys ylemmäs';
$string['multichoice'] = 'Monivalinta';
$string['multichoice_values'] = 'Monivalinnan arvot';
$string['multichoicerated'] = 'Monivalinta (suhteutettu)';
$string['multichoicetype'] = 'Monivalintatyyppi';
$string['multiple_submit'] = 'Useita palautuksia';
$string['multiplesubmit'] = 'Useita palautuksia';
$string['multiplesubmit_help'] = 'Jos kysely on anonyymi, osallistujat voivat vastata niin monesti kuin haluavat.';
$string['name'] = 'Nimi';
$string['name_required'] = 'Nimi vaadittu';
$string['next_page'] = 'Seuraava sivu';
$string['no_handler'] = 'Ei toiminnon käsittelyä';
$string['no_itemlabel'] = 'Kysymyksen tunniste puuttuu';
$string['no_itemname'] = 'Kysymyksen nimi puuttuu';
$string['no_items_available_yet'] = 'Ei vielä kysymyksiä';
$string['no_templates_available_yet'] = 'Ei saatavilla olevia mallipohjia';
$string['non_anonymous'] = 'Vastaajien nimet tallennetaan ja näytetään vastausten kanssa';
$string['non_anonymous_entries'] = 'vastaukset nimillä';
$string['non_respondents_students'] = 'vastaamattomat opiskelijat';
$string['not_completed_yet'] = 'Keskeneräinen';
$string['not_selected'] = 'Ei valittu';
$string['not_started'] = 'ei aloitettu';
$string['notavailable'] = 'tämä palaute ei ole saatavilla';
$string['numeric'] = 'Numeerinen vastaus';
$string['numeric_range_from'] = 'Vaihteluvälin ala-arvo';
$string['numeric_range_to'] = 'Vaihteluvälin yläarvo';
$string['of'] = '-sta';
$string['oldvaluespreserved'] = 'Kaikki vanhat kysymykset ja annetut arvot säilytetään';
$string['oldvalueswillbedeleted'] = 'Nykyiset kysymykset ja kaikki käyttäjäsi vastaukset poistetaan';
$string['only_one_captcha_allowed'] = 'Palautteessa sallitaan vain yksi roskapostivarmenne';
$string['overview'] = 'Yleiskatsaus';
$string['page'] = 'Sivu';
$string['page-mod-feedback-x'] = 'Kaikki palautemoduulisivut';
$string['page_after_submit'] = 'Palautuksen jälkeinen sivu';
$string['pagebreak'] = 'Sivunvaihto';
$string['parameters_missing'] = 'Parametrit puuttuvat';
$string['picture'] = 'Kuva';
$string['picture_file_list'] = 'Lista kuvista';
$string['picture_values'] = 'Valitse yksi tai useampi<br />kuvatiedosto listasta:';
$string['pluginadministration'] = 'Palautteen asetukset';
$string['pluginname'] = 'Palaute';
$string['position'] = 'Sijainti';
$string['preview'] = 'Esikatselu';
$string['preview_help'] = 'Esikatselussa voit muuttaa kysymysten järjestystä.';
$string['previous_page'] = 'Edellinen sivu';
$string['public'] = 'Julkinen';
$string['question'] = 'Kysymys';
$string['questions'] = 'Kysymykset';
$string['radio'] = 'Monivalinta - yksi vastaus';
$string['radio_values'] = 'Vastaukset';
$string['radiobutton'] = 'Monivalinta - yksi vastaus sallittu (radionapit)';
$string['radiobutton_rated'] = 'Radionapit (suhteutettu)';
$string['radiorated'] = 'Radionapit (suhteutettu)';
$string['ready_feedbacks'] = 'Valmiit palautteet';
$string['relateditemsdeleted'] = 'Myös kaikki käyttäjäsi vastaukset tähän kysymykseen poistetaan';
$string['required'] = 'Vaadittu';
$string['resetting_data'] = 'Resetoi palautteen vastaukset';
$string['resetting_feedbacks'] = 'Resetoidaan palautteet';
$string['response_nr'] = 'Vastaus numero';
$string['responses'] = 'Vastaukset';
$string['responsetime'] = 'Vastausaika';
$string['save_as_new_item'] = 'Tallenna uutena kysymyksenä';
$string['save_as_new_template'] = 'Tallenna uutena mallipohjana';
$string['save_entries'] = 'Lähetä vastauksesi';
$string['save_item'] = 'Tallenna kysymys';
$string['saving_failed'] = 'Tallennus epäonnistui';
$string['saving_failed_because_missing_or_false_values'] = 'Tallennus epäonnistui puuttuvien tai väärien arvojen takia';
$string['search_course'] = 'Etsi kurssilta';
$string['searchcourses'] = 'Etsi kursseilta';
$string['searchcourses_help'] = 'Etsi kurssi(e)n koodia tai nimeä, jonka haluat liittää tähän palautteeseen.';
$string['selected_dump'] = 'Valitut indeksit muuttujasta $SESSION ovat alla:';
$string['send'] = 'lähetä';
$string['send_message'] = 'lähetä viesti';
$string['separator_decimal'] = '.';
$string['separator_thousand'] = ',';
$string['show_all'] = 'Näytä kaikki';
$string['show_analysepage_after_submit'] = 'Näytä analyysisivu lähetyksen jälkeen';
$string['show_entries'] = 'Näytä vastaukset';
$string['show_entry'] = 'Näytä vastaus';
$string['show_nonrespondents'] = 'Näytä vastaamattomat';
$string['site_after_submit'] = 'Sivu, joka näytetään palautuksen jälkeen';
$string['sort_by_course'] = 'Järjestä kurssin mukaan';
$string['start'] = 'Aloita';
$string['started'] = 'aloitettu';
$string['stop'] = 'Lopeta';
$string['subject'] = 'Aihe';
$string['switch_group'] = 'Vaihda ryhmä';
$string['switch_item_to_not_required'] = 'vaihda asetukseksi: vastausta ei vaadita';
$string['switch_item_to_required'] = 'vaihda asetukseksi: vastaus vaaditaan';
$string['template'] = 'Mallipohja';
$string['template_saved'] = 'Mallipohja tallennettu';
$string['templates'] = 'Mallipohjat';
$string['textarea'] = 'Monirivinen tekstivastaus';
$string['textarea_height'] = 'Rivien määrä';
$string['textarea_width'] = 'Leveys';
$string['textfield'] = 'Yksirivinen tekstivastaus';
$string['textfield_maxlength'] = 'Suurin sallittu merkkien määrä';
$string['textfield_size'] = 'Tekstikentän leveys';
$string['there_are_no_settings_for_recaptcha'] = 'Roskapostivarmenteelle ei ole asetuksia';
$string['this_feedback_is_already_submitted'] = 'Olet jo tehnyt tämän aktiviteetin.';
$string['timeclose'] = 'Sulkeutumisaika';
$string['timeclose_help'] = 'Voit määrittää ajan koska ihmiset voivat vastata palautteeseen. Jos valintaruutua ei ole valittu, aikarajoitus ei ole päällä.';
$string['timeopen'] = 'Avautumisaika';
$string['timeopen_help'] = 'Voit määrittää ajan koska ihmiset voivat vastata palautteeseen. Jos valintaruutua ei ole valittu, aikarajoitus ei ole päällä.';
$string['typemissing'] = 'puuttuva arvo "tyyppi"';
$string['update_item'] = 'Tallenna muutokset kysymykseen';
$string['url_for_continue'] = 'Jatka-painikkeen web-osoite';
$string['url_for_continue_button'] = 'Jatka-painikkeen web-osoite';
$string['url_for_continue_help'] = 'Vastauksen lähettämisen jälkeinen oletuskohde on kurssisivu. Tässä voit määrittää tilalle muun verkko-osoitteen.';
$string['use_one_line_for_each_value'] = '<br />Käytä yksi rivi joka vastausvaihtoehdolle!';
$string['use_this_template'] = 'Käytä tätä mallipohjaa';
$string['using_templates'] = 'Käytä mallipohjaa';
$string['vertical'] = 'pystysuora';
$string['viewcompleted'] = 'valmiit vastaukset';
$string['viewcompleted_help'] = 'Voit katsella palautettuja vastauksia, joita voidaan hakea kurssin ja/tai kysymyksen mukaan. Vastaukset voidaan myös viedä Exceliin.';
