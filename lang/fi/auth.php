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
 * Strings for component 'auth', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   auth
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['actauthhdr'] = 'Asennetut käyttäjätunnistusmoduulit';
$string['alternatelogin'] = 'Jos kirjoitat tähän web-osoitteen, sitä käytetään kirjautumissivuna tälle sivustolle. Sivun pitäisi sisältää lomake, jonak ominaisuudet on asetettu <strong>\'{$a}\'</strong> ja joko antaa paluukentät <strong>käyttäjänimi</strong> and <strong>salasana</strong>.<br />

Ole varovainen, ettet syötä virheellistä osoitetta, koska siten voit lukita itsesi ulos sivustoltasi.<br />

Jätä tämä kohta tyhjäksi käyttääksesi oletuskirjautumissivua.';
$string['alternateloginurl'] = 'Vaihtoehtoinen kirjautumisosoite';
$string['auth_changepasswordhelp'] = 'Salasanan vaihto-ohjeet';
$string['auth_changepasswordhelp_expl'] = 'Näytä ohjeet hukkuneen salasanan löytämiseksi niille, jotka ovat sen {$a} hukanneet. Tämä näytetään <strong> Vaihda salasana -osoite</strong> tai Moodlen sisältä vaihdettavan salasanan yhteydessä.';
$string['auth_changepasswordurl'] = 'Salasanan vaihdon web-osoite';
$string['auth_changepasswordurl_expl'] = 'Määrittele se web-osoite, joka lähetetään käyttäjälle hänen hukattuaan salasanansa. Määritä <strong>Aseta standardi salasanan
vaihtamissivu</strong> kohdaksi <strong>EI</strong>.';
$string['auth_changingemailaddress'] = 'Olet vaihtamassa sähköpostiosoitettasi osoitteesta {$a->oldemail} osoitteeseen {$a->newemail}. Turvallisuuden takia uuteen osoitteeseen lähetetään varmistusviesti, jotta voit osoittaa sen kuuluvan sinulle. Osoitteesi päivitetään heti kun avaat viestissä olevan linkin.';
$string['auth_common_settings'] = 'Yleiset asetukset';
$string['auth_data_mapping'] = 'Tietojen yhdistäminen';
$string['auth_fieldlock'] = 'Lukitse arvo';
$string['auth_fieldlock_expl'] = '<p><b>Lukitse arvo:</b>Päällä ollessaan tämä asetus estää Moodlen käyttäjiä ja ylläpitäjiä muokkaamasta kenttää suoraan. Käytä täta asetusta, jos hallinnoit tätä tietoa ulkoisesta järjestelmästä.</p>';
$string['auth_fieldlocks'] = 'Lukitse käyttäjien kentät';
$string['auth_fieldlocks_help'] = 'Voit lukita käyttäjien tietokentät. Tämä on hyödyllistä sivustoilla, joilla ylläpitäjät hallinnoivat käyttäjätietoja käsin muokkaamalla käyttäjärekistereitä tai kopioimalla palvelimelle käyttäen ´Lähetä käyttäjät´-toimintoa. Jos lukitset kenttiä joita Moodle tarvitsee, varmista että annat kenttien tiedot luodessasi käyttäjiä tai muuten käyttäjätilit ovat käyttökelvottomia.
Harkitse ´Lukitsematon, jos tyhjä´-asetuksen käyttöä välttääksesi tämän ongelman.';
$string['auth_invalidnewemailkey'] = 'Virhe: jos yrität vahvistaa sähköpostiosoitteen vaihtamisen, olet tehnyt virheen kopioidessasi web-osoitteen saamastasi sähköpostiviestistä. Kopioi osoite toisen kerran www-selaimeesi ja yritä uudelleen.';
$string['auth_multiplehosts'] = 'Voit määritellä useita osoitteita ( joku.jossain.com;joku.toinen.com;... )';
$string['auth_outofnewemailupdateattempts'] = 'Olet yrittänyt vaihtaa sähköpostiosoitetta liian monta kertaa. Pyyntösi on peruutettu.';
$string['auth_passwordisexpired'] = 'Salasanasi on vanhentunut. Haluatko vaihtaa salasanasi nyt?';
$string['auth_passwordwillexpire'] = 'Salasanasi vanhentuu {$a} päivässä. Haluatko vaihtaa salasanasi nyt?';
$string['auth_remove_delete'] = 'Sisäisen autentikoinnin poisto';
$string['auth_remove_keep'] = 'Säilytä sisäinen autentikointi';
$string['auth_remove_suspend'] = 'Hyllytä sisäinen autentikointi';
$string['auth_remove_user'] = 'Määrittele toimenpiteet mitä tehdään sisäiselle käyttäjätilille kun se poistetaan ulkoisesta lähteestä (LDAP) massasyknronoinnin yhteydessä. Vain hyllytetyt käyttäjät palautetaan jos ne esiintyvät ulkoisessa lähteessä.';
$string['auth_remove_user_key'] = 'Poistettu ulkoinen käyttäjä';
$string['auth_sync_script'] = 'Cronin syknkronointiscripti';
$string['auth_updatelocal'] = 'Päivitä sisäinen arvo';
$string['auth_updatelocal_expl'] = '<p><b>Päivitä sisäinen arvo:</b> Jos ei onnistu, kenttä päivittyy joka kerta käyttäjän kirjautuessa tai käyttäjäsynkronoinnin yhteydessä. Kentät jotka on asetettu päivittymään paikallisesti tulisi lukita.</p>';
$string['auth_updateremote'] = 'Päivitä ulkoinen arvo';
$string['auth_updateremote_expl'] = '<p><b>Päivitä ulkoinen tieto:</b> Jos tämä ei onnistu, ulkoinen tieto päivitetään samalla kun käyttäjärekisteri päivitetään. Kenttien pitäisi olla lukitsemattomia, jotta editointi sallitaan.</p>';
$string['auth_updateremote_ldap'] = '<p><b>Huomautus:</b> Ulkoisen LDAP -tiedon päivitys vaatii, että asetetaan binddn ja bindpw
kaikille sidoskäyttäjille muotoiluoikeus kaikkiin käyttäjärekistereihin. Se ei tällä hetkellä säilytä moniarvoisia määreitä, eikä poista ylimääräisiä arvoja päivityksessä. </p>';
$string['auth_user_create'] = 'Käyttäjän luonti';
$string['auth_user_creation'] = 'Käyttäjät voivat itse luoda tunnuksensa. Käyttäjätiedot tarkistetaan sähköpostin avulla. Jos aktivoit tämän vaihtoehdon, muista myös määritellä kayttäjäntunnistuksen muut tähän liittyvät asetukset.';
$string['auth_usernameexists'] = 'Käyttäjätunnus on jo käytössä. Valitse joku toinen.';
$string['authenticationoptions'] = 'Käyttäjätunnistuksen asetukset';
$string['authinstructions'] = 'Tähän voi kirjoittaa ohjeet opiskelijoille, mitä tunnusta ja salasanaa heidän tulisi käyttää. Tämä teksti näkyy kirjautumissivulla.';
$string['auto_add_remote_users'] = 'Lisää automaattisesti etäkäyttäjät';
$string['changepassword'] = 'Salasanan vaihto -osoite';
$string['changepasswordhelp'] = 'Voit määritellä osoitteen jossa käyttäjät voivat vaihtaa unohtamansa salasanan. Käyttäjille tämä näkyy painikkeena kirjautumissivulla ja heidän käyttäjätietosivullaan. Jos jätät kentän tyhjäksi, painiketta ei näytetä.';
$string['chooseauthmethod'] = 'Valitse käyttäjäntunnistusmetodi:';
$string['chooseauthmethod_help'] = 'Tämä asetus määrittelee autentikointimetodin käyttäjän kirjautuessa sisään. Vain määriteltyjä autentikointimalleja tulisi käyttää, sillä muuten käyttäjä ei kykene kirjautumaan. Estääksesi käyttäjää kirjautumasta valitse "Ei kirjautumista".';
$string['createpasswordifneeded'] = 'Luo salasana tarvittaessa';
$string['emailchangecancel'] = 'Peruuta sähköpostiosoitteen muuttaminen';
$string['emailchangepending'] = 'Vaihda avoimet. Avaa sinulle lähetetty linkkit {$a->preference_newemail}.';
$string['emailnowexists'] = 'Sähköpostiosoite, jota koitit määritellä omaan profiiliisi on jo jonkun muun käytössä. Pyyntösi muuttaa sähköpostiosoitetta on siis peruttu. Koita uudelleen jollakin toisella osoitteella.';
$string['emailupdate'] = 'Sähköpostiosoitteen muuttaminen';
$string['emailupdatemessage'] = '{$a->fullname},

Olet pyytänyt sähköpostiosoiteen muutosta moodle sivustolla {$a->site}. Osoitteesi päivitetään heti, kun käyt web-selaimella seuraavassa osoitteessa.

{$a->url}';
$string['emailupdatesuccess'] = 'Käyttäjän <em>{$->fullname}</em> sähköpostiosoite päivitettiin onnistuneesti osoitteeksi <em>{$->email}</em>.';
$string['emailupdatetitle'] = 'Vahvista salasanan vaihto sivustolla {$a->site}';
$string['enterthenumbersyouhear'] = 'Syötä kuulemasi numerot';
$string['enterthewordsabove'] = 'Kirjoita ylläolevat sanat';
$string['errormaxconsecutiveidentchars'] = 'Salasanassa saa olla korkeintaan {$a} peräkkäistä samaa merkkiä.';
$string['errorminpassworddigits'] = 'Salasanassa tulee olla vähintään {$a} numero(a).';
$string['errorminpasswordlength'] = 'Salasanan tulee olla vähintään {$a} merkkiä pitkä.';
$string['errorminpasswordlower'] = 'Salasanassa tulee olla vähintään {$a} pientä kirjainta.';
$string['errorminpasswordnonalphanum'] = 'Salasanassa tulee olla vähintään {$a} erikoismerkki(ä) (muu kuin kirjain tai numero).';
$string['errorminpasswordupper'] = 'Salasanan tulee olla vähintään {$a} ISO kirjain(ta).';
$string['errorpasswordupdate'] = 'Virhe päivitettäessä salasanaa, salasanaa ei muutettu';
$string['forcechangepassword'] = 'Pakota salasanan vaihto';
$string['forcechangepassword_help'] = 'Pakota käyttäjät vaihtamaan salasanaa heidän seuraavalla Moodleen kirjautumiskerrallaan.';
$string['forcechangepasswordfirst_help'] = 'Pakota käyttäjät vaihtamaan salasanaa heidän ensimmäisellä Moodleen kirjautumiskerrallaan.';
$string['forgottenpassword'] = 'Jos kirjoitat tähän web-osoitteen, sitä käytetään uuden salasanan tilausosoitteena tällä sivustolla. Tämä asetus on tarkoitettu tilanteisiin, joissa salasanoja käsitellään täysin Moodlen ulkopuolella. Jätä tämä tyhjäksi, kun haluat käyttää Moodlen oletustoimintoa uuden salasanan tilaamiseen.';
$string['forgottenpasswordurl'] = 'Unohtuneen salasanan web-osoite';
$string['getanaudiocaptcha'] = 'Hae äänivarmenne.';
$string['getanimagecaptcha'] = 'Hae kuvavarmenne';
$string['getanothercaptcha'] = 'Hae uusi varmenne';
$string['guestloginbutton'] = 'Kirjaudu vierailijana -painike';
$string['incorrectpleasetryagain'] = 'Väärin. Yritä uudelleen.';
$string['infilefield'] = 'Salasana on tiedostossa';
$string['informminpassworddigits'] = 'ainakin {$a} numero(a)';
$string['informminpasswordlength'] = 'ainakin {$a} merkkiä';
$string['informminpasswordlower'] = 'ainakin {$a} pientä kirjainta';
$string['informminpasswordnonalphanum'] = 'ainakin {$a} erikoismerkkiä';
$string['informminpasswordupper'] = 'ainakin {$a} ISO kirjain(ta)';
$string['informpasswordpolicy'] = 'Salasanassa tulee olla {$a}';
$string['instructions'] = 'Ohjeet';
$string['internal'] = 'Sisäinen';
$string['locked'] = 'Lukittu';
$string['md5'] = 'MD5-tiiviste';
$string['nopasswordchange'] = 'Salasanaa ei voi muuttaa';
$string['nopasswordchangeforced'] = 'Sinun täytyy muuttaa salasanaasi jatkaaksesi. Salasanan muuttamiseen ei kuitenkaan ole sivua, joten ota yhteyttä Moodlen ylläpitäjään.';
$string['noprofileedit'] = 'Profiilia ei voi muokata';
$string['ntlmsso_attempting'] = 'Yritetään SSO-kirjautumista NTLM:n kautta...';
$string['ntlmsso_failed'] = 'Automaattinen kirjatutuminen ei onnistunut, yritä normaalia kirjautumissivua...';
$string['ntlmsso_isdisabled'] = 'NTLM SSO on estetty.';
$string['passwordhandling'] = 'Salasanakentän käsittely';
$string['plaintext'] = 'Selväkielinen teksti';
$string['pluginnotenabled'] = 'Autentikointimoduuli \'{$a}\' ei ole käytössä.';
$string['pluginnotinstalled'] = 'Autentikointimoduulia \'{$a}\' ei ole asennettu.';
$string['potentialidps'] = 'Kirjaudu sisään käyttäen tiliäsi kohteessa:';
$string['recaptcha'] = 'reCAPTCHA';
$string['recaptcha_help'] = 'Roskapostivarmennetta (captcha tai reCaptcha) käytetään postiautomaattien häirinnän estämiseen. Kirjoita laatikossa olevat sanat järjestyksessä ja välillä erotettuina.
Jos et saa sanoista selvää, voit vaihtaa varmenteen tai kokeilla äänivarmennetta.';
$string['selfregistration'] = 'Itserekisteröityminen';
$string['selfregistration_help'] = 'Jos autentikointimoduuli, kuten sähköpostivarmistus, on valittu, se antaa mahdollisten käyttäjien rekisteröidä itsensä ja luoda tilejä. Tämä saattaa johtaa roskapostittajien tilien luomiseen, käyttääkseen keskustelualueita, blogeja jne. roskapostin levittämiseen. Tätä riskiä estääkseen, itsekirjautuminen pitäisi estää tai sitä pitäisi rajoittaa *Sallitut sähköpostitoimialueet* -asetuksella.';
$string['sha1'] = 'SHA-1 -tiiviste';
$string['showguestlogin'] = 'Voit näyttää tai piilottaa Kirjaudu vierailijana -painikkeen kirjautumissivulla.';
$string['stdchangepassword'] = 'Käytä normaalia Vaihda salasana -sivua';
$string['stdchangepassword_expl'] = 'Jos ulkoinen oikeuksien tarkistaminen sallii salasanojen vaihdot Moodlen kautta, vaihda tämä muotoon kyllä. Tämä asetus syrjäyttää "Vaihda salasana -osoite".';
$string['stdchangepassword_explldap'] = 'HUOMAUTUS: On suositeltavaa, että käytetään ennemmin LDAP- kuin SSL-salakirjoitettua tunnelia (ldaps://), jos LDAP-palvelin on etäkäytössä.';
$string['suspended'] = 'Estetty käyttäjätili';
$string['suspended_help'] = 'Estetyt käyttäjät eivät voi kirjautua sisään tai käyttää web services -palveluja. Myös kaikki lähetetyt viestit jätetään huomioimatta.';
$string['unlocked'] = 'Lukitsematon';
$string['unlockedifempty'] = 'Lukitsematon, jos tyhjä';
$string['update_never'] = 'Ei koskaan';
$string['update_oncreate'] = 'Luotaessa';
$string['update_onlogin'] = 'Jokaisella kirjautumisella';
$string['update_onupdate'] = 'Päivitettäessä';
$string['user_activatenotsupportusertype'] = 'auth: ldap user_activate() ei tue valittua käyttäjätyyppiä: {$a}';
$string['user_disablenotsupportusertype'] = 'auth: ldap user_disable() ei tue valittua käyttäjätyyppiä (..vielä)';
