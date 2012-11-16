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
 * Strings for component 'grading', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   grading
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['activemethodinfo'] = '\'{$a->method}\' on valittu arviointimenetelmäksi alueelle \'{$a->area}\'';
$string['activemethodinfonone'] = 'Alueelle \'{$a->area}\' ei ole valittu edistynyttä arviointimenetelmää. Menetelmänä on siksi Yksinkertainen suora arviointi.';
$string['changeactivemethod'] = 'Vaihda arviointimenetelmäksi';
$string['clicktoclose'] = 'napsauta sulkeaksesi';
$string['exc_gradingformelement'] = 'Arviointimatriisia ei voida luoda';
$string['formnotavailable'] = 'Valitsit käyttöön edistyneen arviointimenetelmän, mutta arviointimatriisi ei ole vielä saatavilla. Määrittele se ensin Asetukset-lohkon linkin Edistynyt arviointi kautta.';
$string['gradingformunavailable'] = 'Huomaa: edistynyt arviointimatriisi ei ole vielä valmis. Yksinkertaista arviointimenetelmää käytetään, kunnes matriisi on käytössä.';
$string['gradingmanagement'] = 'Edistynyt arviointi';
$string['gradingmanagementtitle'] = 'Edistynyt arviointi: {$a->component} ({$a->area})';
$string['gradingmethod'] = 'Arviointimenetelmä';
$string['gradingmethod_help'] = 'Valitse arviointimenetelmä, jota käytetään arvosanojen laskemiseen tässä kontekstissa.
Oletusarviointimenetelmä on \'Yksinkertainen suora arviointi\'. Valitse se, jos et halua monimutkaisempaa arviointimenetelmää.';
$string['gradingmethodnone'] = 'Yksinkertainen, suora arviointi';
$string['gradingmethods'] = 'Arviointimenetelmät';
$string['manageactionclone'] = 'Luo uusi arviointimatriisi mallista';
$string['manageactiondelete'] = 'Poista nykyinen arviointimatriisi';
$string['manageactiondeleteconfirm'] = 'Olet poistamassa arviointimatriisin \'{$a->formname}\' ja kaiken siihen liittyvän tiedon kohteesta \'{$a->component} ({$a->area})\'. Varmista että ymmärrät seuraavat seuraukset:

* Tätä toimenpidettä ei voida mitenkään peruuttaa.
* Voit vaihtaa toiseen arviointimenetelmään, joista yksi on \'Yksinkertainen suora arviointi\', poistamatta tätä matriisia.
* Kaikki ohjeet arvioinnin antamisesta häviävät.
* Tämä ei vaikuta arviointikirjaan tallennettuihin laskettuihin arvosanoihin. Selitykset arvosanojen laskuperusteista eivät kuitenkaan ole enää saatavilla.
* Tämä toimenpide ei vaikuta muissa aktiviteeteissa oleviin kopioihin tästä matriisista.';
$string['manageactiondeletedone'] = 'Arvointimatriisi poistettiin onnistuneesti';
$string['manageactionedit'] = 'Muokkaa käytössä olevaa arviointimatriisia';
$string['manageactionnew'] = 'Määrittele uusi arviointimatriisi';
$string['manageactionshare'] = 'Julkaise arviointimatriisi uutena mallipohjana';
$string['manageactionshareconfirm'] = 'Olet tallentamassa kopiota arviointimatriisista \'{$a}\' uutena julkisena matriisipohjana. Muut sivuston käyttäjät voivat luoda uusia arviointimatriiseja aktiviteetteihinsa tästä pohjasta.';
$string['manageactionsharedone'] = 'Matriisi tallennettiin onnistuneesti mallipohjaksi';
$string['noitemid'] = 'Arviointi ei ole mahdollista. Arvioitavaa kohdetta ei ole olemassa.';
$string['nosharedformfound'] = 'Mallipohjaa ei löytynyt';
$string['searchownforms'] = 'Sisällytä omat arviointimatriisini';
$string['searchtemplate'] = 'Arviointimatriisien haku';
$string['searchtemplate_help'] = 'Voit etsiä valmiista arviointimatriiseista ja käyttää löydettyä matriisia pohjana uudelle arviointimatriisille täällä. Voit etsiä sanoja matriisin nimessä, kuvauksessa tai sisällössä. Kirjoita etsittävä teksti lainausmerkkeihin ("etsittävä teksti").
Oletuksena vain ne arviointimatriisit, jotka on tallennettu jaettuina pohjina, ovat mukana hakutuloksissa. Voit myös sisällyttää omat arviointimatriisisi hakutuloksiin. Tällä tavalla voit käyttää arviointimatriisejasi uudelleen jakamatta niitä muille. Vain matriiseja, jotka on merkitty \'Valmis käyttöön\' voidaan käyttää uudelleen näin.';
$string['statusdraft'] = 'Luonnos';
$string['statusready'] = 'Valmis käyttöön';
$string['templatedelete'] = 'Poista';
$string['templatedeleteconfirm'] = 'Olet poistamassa matriisipohjan \'{$a}\'. Pohjan poistaminen ei vaikuta siitä luotuihin olemassa oleviin arviointimatriiseihin.';
$string['templateedit'] = 'Muokkaa';
$string['templatepick'] = 'Käytä tätä mallia';
$string['templatepickconfirm'] = 'Haluatko käyttää arviointimatriisia \'{$a->formname}\' pohjana uudelle arviointimatriisille \'{$a->component} ({$a->area})\'?';
$string['templatepickownform'] = 'Käytä tätä matriisia mallina';
$string['templatesource'] = 'Sijainti: {$a->component} ({$a->area})';
$string['templatetypeown'] = 'Oma arviointimatriisi';
$string['templatetypeshared'] = 'Jaettu mallipohja';
