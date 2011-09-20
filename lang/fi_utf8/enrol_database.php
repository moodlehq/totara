<?PHP // $Id$ 
      // enrol_database.php - created with Moodle 1.9.13 (Build: 20110801) (2007101591.04)


$string['autocreate'] = 'Kurssit voidaan luoda automaattisesti, jos rekisteröitymisiä tulee kurssille, jota ei ole olemassa.';
$string['autocreation_settings'] = 'Automaattisen luonnin asetukset';
$string['category'] = 'Automaattisesti luotujen kurssien kategoria';
$string['course_fullname'] = 'Kurssin kokonimen sisältävä kenttä.';
$string['course_id'] = 'Kurssin ID:n sisältävä kenttä. Tämän kentän arvot vastaavat kentän \"enrol_db_l_coursefield\" arvoja Moodlen kurssit taulussa.';
$string['course_shortname'] = 'Kurssin lyhytnimen sisältävä kenttä';
$string['course_table'] = 'Taulun nimi, jossa ovat kurssin tiedot (lyhytnimi, kokonimi, ID, jne.).';
$string['dbhost'] = 'Tietokantapalvelimen nimi';
$string['dbname'] = 'Käytettävä tietokanta';
$string['dbpass'] = 'Salasana';
$string['dbtable'] = 'Tietokannan taulu';
$string['dbtype'] = 'Tietokantapalvelimen tyyppi';
$string['dbuser'] = 'Käyttäjätunnus';
$string['defaultcourseroleid'] = 'Annettava rooli, jos muuta ei ole määritelty.';
$string['description'] = 'Voit käyttää ulkoista tietokantaa hallitaksesi kurseille rekisteröitymisiä. Ulkoisessa tietokanassa tulee olla sarakkeet kurssin id numerolle ja käyttäjän ID-numerolle, näitä arvoja verrataan moodlen tietokantaan.';
$string['disableunenrol'] = 'Jos tämä asetus on käytössä, ulkoisesta tieokannasta rekisteröityjä käyttäjiä ei poisteta kurssilta tietokannan sisällöstä huolimatta.';
$string['enrol_database_autocreation_settings'] = 'Kurssien automaattien luominen';
$string['enrolname'] = 'Ulkoinen tietokanta';
$string['general_options'] = 'Yleiset asetukset';
$string['host'] = 'Tietokantapalvelimen nimi.';
$string['ignorehiddencourse'] = 'Jo tämä asetus on päällä, käyttäjiä ei rekisteröidä kursseille, jotka on piilotettu opiskelijoilta.';
$string['local_fields_mapping'] = 'Moodlen (local) tietokannan kentät';
$string['localcoursefield'] = 'Mitä Moodlen tietoa käytetään kurssitietojen linkittämiseen (esim. idnumber)';
$string['localrolefield'] = 'Roolit-taulun kentän nimi, joka vastaa ulkopuolisen tietokannan kenttää.';
$string['localuserfield'] = 'Mitä Moodlen tietoa käytetään käyttäjätietojen linkittämiseen (esim. idnumber)';
$string['name'] = 'Käytettävä tietokanta';
$string['pass'] = 'Salasana';
$string['remote_fields_mapping'] = 'Ulkoisen tietokannan rekisteröitymisen kentät';
$string['remotecoursefield'] = 'Ulkoisen tietokannan course id sarakkeen nimi';
$string['remoterolefield'] = 'Ulkoisen taulun kentän nimi, joka vastaa rollit-taulun kenttää.';
$string['remoteuserfield'] = 'Ulkoisen tietokannan userid sarakkeen nimi';
$string['server_settings'] = 'Ulkoisen tietokannan serveriasetukset';
$string['student_coursefield'] = 'Sen kentän nimi oppijan ilmoittautumistalukossa, jossa on kurssin tunnus.';
$string['student_l_userfield'] = 'Sen kentän nimi lokaalissa käyttäjätaulukossa, jonka mukaan käyttäjä tunnistetaan etärekisterissä (esim. tunnus).';
$string['student_r_userfield'] = 'Sen kentän nimi etäilmoittautumistaulukossa, jossa on käyttäjätunnus.';
$string['student_table'] = 'Sen taulukon nimi, jossa oppijoiden ilmoittautumiset ovat.';
$string['teacher_coursefield'] = 'Sen kentän nimi kouluttajan ilmoittautumistaulukossa, jossa on kurssin tunnus.';
$string['teacher_l_userfield'] = 'Sen kentän nimi lokaalissa käyttäjätaulukossa, jonka mukaan käyttäjä tunnistetaan opettajien käytössä olevassa etärekisterissä (esim. tunnus).';
$string['teacher_r_userfield'] = 'Sen kentän nimi kouluttajan etäilmoittautumistaulukossa, jossa on käyttäjätunnus.';
$string['teacher_table'] = 'Sen taulukon nimi, jossa kouluttajan ilmoittautumiset ovat.';
$string['template'] = 'Vapaaehtoinen: automaattisesti luotujen kurssien asetukset voidaan kopioida kurssimallipohjasta.';
$string['type'] = 'Tietokannan serverityyppi';
$string['user'] = 'Serverin käyttäjätunnus';

?>
