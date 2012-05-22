<?php
// hierarchy.php - created with Totara langimport script version 1.1

$string['additionaloptions'] = 'Lisävalinnat';
$string['allframeworks'] = 'Kaikki rakenteet';
$string['alltypes'] = 'Kaikki tyypit';
$string['assign'] = 'Aseta';
$string['availablex'] = 'Saatavilla olevat ({$a})';
$string['bulkactions'] = 'Massaoperaatiot';
$string['bulkaddfailed'] = 'Näitä kohteita hierarkiaan lisätessä tapahtui virhe';
$string['bulkaddsuccess'] = '{$a} kohdetta lisättiin hierarkiaan';
$string['bulktypechanges'] = 'Massaluokittelu';
$string['bulktypechangesdesc'] = 'Luokittele uudestaan kaikki tämän tyypin kohteet:';
$string['cancelwithoutassigning'] = 'Peruuta asettamatta';
$string['changetype'] = 'Muuta tyyppiä';
$string['child'] = 'lapsi';
$string['children'] = 'lapset';
$string['choosewhattodowithdata'] = 'Valitse, mitä haluat tehdä lisäkenttätiedoilla:';
$string['clearsearch'] = 'Tyhjennä haku';
$string['clearselection'] = 'Poista valinta';
$string['confirmmoveitems'] = 'Oletko varma, että haluat siirtää kohteet {$a->num} {$a->items} tänne "{$a->parentname}"?<br /><br />Kaikki objektin {$a->items} lapsiobjektit siirretään samalla.';
$string['confirmproceed'] = 'Oletko varma, että haluat jatkaa?';
$string['confirmtypechange'] = 'Luokittele kohteet uudestaan ja siirrä/poista tiedot';
$string['currenttype'] = 'Nykyinen tyyppi';
$string['customfields'] = 'Lisäkentät';
$string['datainx'] = 'Tiedot sijainnissa {$a}:';
$string['deletecheckdepth'] = 'Oletko varma, että haluat lopullisesti poistaa tämän tason?';
$string['deletechecktype'] = 'Oletko täysin varma, että haluat poistaa tämän tyypin?';
$string['deletedataconfirmproceed'] = 'Koska uudessa luokittelussa ei ole lisäkenttiä, seuraavien lisäkenttien tiedot poistetaan: {$a}. Mikäli haluar siirtää kyseiset tiedot uuteen luokitteluun, luo vastaavat lisäkentät uuteen luokitteluun ennen uudelleen luokittelua. Oletko varma, että haluat jatkaa?';
$string['deleteddepth'] = 'Taso {$a} on poistettu.';
$string['deletedepthhaschildren'] = 'Tätä tasoa ei voida poistaa koska tasolla on objekteja.';
$string['deletedepthnosuchdepth'] = 'Väärä tason id. Kokeile uudestaan.';
$string['deletedepthnotdeepest'] = 'Tätä tasoa ei voida poistaa koska sen alla on muita tasoja tässä rakenteessa.';
$string['deletedtype'] = 'Tyyppi "{$a}" on poistettu.';
$string['deleteselectedx'] = 'Poista valittu {$a}';
$string['deletethisdata'] = 'Poista nämä tiedot';
$string['deletetypenosuchtype'] = 'Virheellinen id-tyyppi';
$string['depth'] = 'Taso {$a}';
$string['depths'] = 'Tasot';
$string['displayoptions'] = 'Näyttövalinnat';
$string['enternamesoneperline'] = 'Syötä {$a} nimet (yksi nimi per rivi)';
$string['error:alreadyassigned'] = 'Olet jo syöttänyt tietoa tähän kenttään.';
$string['error:badsortorder'] = 'Objektin {$a} siirto ei onnistunut, lajittelujärjestyksessä on jokin virhe.';
$string['error:cannotconvertfieldfromxtoy'] = '"{$a->from}" -kenttiä ei voida muuttaa "{$a->to}" -kentiksi.';
$string['error:cannotmoveparentintochild'] = 'Et voi siirtää kohdetta "{$a->item}" sen omaan lapsiobjektiin "{$a->newparent}"';
$string['error:checkvariable'] = 'Väärä muuttuja - yritä uudelleen';
$string['error:couldnotmoveitem'] = 'Objektin {$a} siirto ei onnistunut. Tietokannan päivityksessä tapahtui virhe.';
$string['error:couldnotmoveitemnopeer'] = 'Objektin {$a} siirto ei onnistunut, samalla tasolla ei ole rinnakkaisobjektia, jonka kanssa tehdä vaihtoa.';
$string['error:couldnotreclassifybulk'] = 'Kohteiden uudelleen luokittelussa luokasta "{$a->from}" luokkaan "{$a->to}" tapahtui virhe';
$string['error:couldnotreclassifyitem'] = 'Kohteen uudelleen luokittelussa luokasta "{$a->from}" luokkaan "{$a->to}" tapahtui virhe';
$string['error:couldnotupgradehierarchyduetobaddata'] = 'Hierarkiaa ei voitu päivittää vääärän tiedon vuoksi ({$a})';
$string['error:deletedepthcheckvariable'] = 'Tarkastusmuuttuja oli väärä, yritä uudelleen';
$string['error:deletetypecheckvariable'] = 'Väärä muuttuja - yritä uudelleen';
$string['error:failedbulkmove'] = 'Näiden kohteiden siirtämisessä tapahtui virhe';
$string['error:hierarchyprefixnotfound'] = 'Hierarkiaetuliitettä {$a} ei löytynyt';
$string['error:hierarchytypenotfound'] = 'Hierarkiatyyppiä {$a} ei löydy.';
$string['error:invaliditemid'] = 'Kalpaamaton kohteen id';
$string['error:invalidparentformove'] = 'Sijaintia, johon olet siirtämässä kohteita, ei ole olemassa';
$string['error:nodeletescaleinuse'] = 'Et voi poistaa asteikkoa, joka on käytössä. Voit poistaa asteikon kun se ei ole käytössä missään rakenteessa.';
$string['error:nodeletescalevalueinuse'] = 'Et voi poistaa arvoja asteikosta, joka on käytössä. Voit poistaa tämän arvon kun asteikko ei ole käytössä missään rakenteessa.';
$string['error:noframeworksfound'] = 'Ei löytynyt rakanteita {$a}, joissa olisi yksi tai useampi taso.';
$string['error:noitemsselected'] = 'Yhtään kohdetta ei ole valittuna';
$string['error:nonedeleted'] = 'Yhtään valituista kohteista {$a} ei voitu poistaa';
$string['error:nonefoundbulk'] = 'Tämän tyypin konvertoitavia kohteita ei löydy';
$string['error:nonefounditem'] = 'Kohde ei kuuluu määriteltyyn tyyppiin';
$string['error:noreorderscaleinuse'] = 'Et voi järjestää asteikkoa uudelleen koska se on käytössä. Voit järjestää asteikon uudelleen kun se ei ole käytössä missään rakenteessa.';
$string['error:norestorefiles'] = 'Palautukseen tarvittavia tiedostoja ei löytynyt. {$a}';
$string['error:restoreerror'] = 'Palautusprosessissa tapahtui virhe: {$a}';
$string['error:somedeleted'] = 'Vain osa {$a->actually_deleted} kaikista poistettaviksi merkityistä {$a->marked_for_deletion} {$a->items} voitiin poistaa';
$string['error:typenotfound'] = 'Tyyppiä {$a} ei löydy';
$string['error:unknownaction'] = 'Ei käytössä';
$string['export'] = 'Vie';
$string['exportcsv'] = 'Vie CSV-tiedostoksi';
$string['exportexcel'] = 'Vie Excel-tiedostoksi';
$string['exportods'] = 'Vie ODS-tiedostoksi';
$string['exporttext'] = 'Vie tekstitiedostoksi';
$string['exportxls'] = 'Vie Excel-tiedostoksi';
$string['filterframework'] = 'Suodata runkorakenteen mukaan:';
$string['frameworkdoesntexist'] = 'Rakennetta {$a} ei ole.';
$string['hidden'] = 'Piilotettu';
$string['hidecustomfields'] = 'Piilota lisäkentät';
$string['hidedetails'] = 'Piilota tiedot';
$string['hierarchybackup'] = 'Hierarkian varmuuskopionti';
$string['hierarchyrestore'] = 'Hierarkia palautus';
$string['mandatory'] = 'Pakollinen';
$string['missingframeworkname'] = 'Puuttuva rakenteen nimi';
$string['missingtypename'] = 'Puuttuva tyypin nimi';
$string['moveselectedxto'] = 'Siirä valitut kohteet {$a} tänne:';
$string['newtype'] = 'Uusi tyyppi';
$string['nocustomfields'] = 'Ei lisäkenttiä';
$string['nodata'] = 'Ei tietoa lisäkentissä';
$string['nopathfoundforid'] = 'Polkua {$a->prefix} id {$a->id} ei löytynyt';
$string['nopermviewhiddenframeworks'] = 'Sinulla ei ole oikeuksia tarkastella piilotettuja rakenteita';
$string['noresultsfor'] = 'Ei tuloksia haulle "{$a->query}".';
$string['noresultsforinframework'] = 'Ei tuloksia haulle "{$a->query}" rakenteessa "{$a->framework}".';
$string['noresultsforsearchx'] = 'Termillä "{$a}" ei hakutuloksia';
$string['noxfound'] = 'Termillä {$a} ei hakutuloksia';
$string['optional'] = 'Valinnainen';
$string['parentchildselectedwarningdelete'] = 'Huomio: olet valinnut kohteen ja samalla yhden sen lapsiobjekteista. Kohteen poistaminen automaattisesti poistaa myös kaikki sen lapsiobjektit. Jos haluat säilyttää jonkin kohteen lapsiobjektit, siirrä ne ennen kohteen poistamista.';
$string['parentchildselectedwarningmove'] = 'Varoitus: olet valinnut kohteen ja yhden tai useamman sen lapsiobjekteista siirrettäväksi. Kun siirrät jonkin kohteen, sen lapsiobjektit siirretään automaattisesti sen mukana.';
$string['pickaframework'] = 'Valitse rakenne';
$string['pickfilehelp'] = 'Jos tiedosto, jonka haluat palauttaa, ei ole saatavissa, varmista, että hierkian varmuuskopio on tallennettu oikeaan paikkaan ({$a}) ja että oikeudet ovat oikein asetettu.';
$string['pickfilemultiple'] = 'Valitse palautettava tiedosto';
$string['pickfileone'] = 'Yksi tiedosto löytyi. Haluatko palauttaa tiedoston {$a}?';
$string['queryerror'] = 'Hakuvirhe. Ei hakutuloksia.';
$string['reclassify1of2bulk'] = 'Luokitellaan uudelleen kohteita {$a->num} {$a->items} - vaihe 1/2';
$string['reclassify1of2desc'] = 'Valitse uusi tyyppi';
$string['reclassify1of2item'] = 'Luokitellaan uudelleen kohteita {$a->num} {$a->items} - vaihe 1/2';
$string['reclassifyingfromxtoybulk'] = 'Luokitellaan kohteet {$a->num} {$a->items} uudelleen: "{$a->from}" > "{$a->to}"';
$string['reclassifyingfromxtoyitem'] = 'Luokitellaan kohteet "{$a->name}" uudelleen: "{$a->from}" > "{$a->to}"';
$string['reclassifyitems'] = 'Luokittele kohteet uudelleen';
$string['reclassifyitemsanddelete'] = 'Luokittele kohteet uudelleen ja poista tiedot';
$string['reclassifyitemsandtransfer'] = 'Luokittele kohteet uudelleen ja siirrä/poista tiedot';
$string['reclassifysuccessbulk'] = 'Kohteet {$a->num} {$a->items} luokiteltu uudelleen > "{$a->from}" to "{$a->to}"';
$string['reclassifysuccessitem'] = '"{$a->name}" on luokiteltu uudelleen: "{$a->from}" > "{$a->to}"';
$string['reclassifytransferdata'] = 'Sinulla on mahdollisuus siirtää lisäkenttien tiedot kohdassa 2.';
$string['restore'] = 'Palauta';
$string['restorenousers'] = 'Palautettavia käyttäjiä ei löytynyt.';
$string['restoreusers'] = '{$a} Palautettavia käyttäjiä löytyi.';
$string['restoreusersanddata'] = 'Palauta käyttäjiä ja käyttäjätietoja.';
$string['searchavailable'] = 'Etsi saatavilla olevista kohteista';
$string['selected'] = 'Valittu';
$string['selecteditems'] = 'Valitut objektit';
$string['selectedx'] = 'Valitut {$a}';
$string['selectframeworks'] = 'Valitse palautettavat rakenteet';
$string['showdepthfullname'] = 'Näytä tason koko nimi';
$string['showdetails'] = 'Näytä tiedot';
$string['showdisplayoptions'] = 'Näytä näyttövalinnat';
$string['showingxofyforsearchz'] = 'Hausta "{$a->query}" näytetään koko tuloksesta {$a->allcount} osa {$a->filteredcount}';
$string['showitemfullname'] = 'Näytä kohteen koko nimi';
$string['showtypefullname'] = 'Näytä tyypin koko nimi';
$string['switchframework'] = 'Vaihda rakennetta:';
$string['top'] = 'Ylös';
$string['transfertox'] = 'Siirrä tänne: {$a}';
$string['type'] = 'Tyyppi';
$string['unclassified'] = 'Luokittelematon';
$string['xandychild'] = '{$a->item} (ja {$a->num} lapsiobjekti)';
$string['xandychildren'] = '{$a->item} (ja {$a->num} lapsiobjektit)';
$string['xitemsdeleted'] = '{$a->num} {$a->items} ja kaikki lapsiobjektit on poistettu';
$string['xitemsmoved'] = '{$a->num} {$a->items} ja kaikki lapsiobjektit on siirretty';
$string['achieved'] = 'Saavutettu';
$string['addassignedcompetencies'] = 'Valitse kompetensseja';
$string['addassignedcompetencytemplates'] = 'Valitse kompetenssimallipohja';
$string['addcourseevidencetocompetencies'] = 'Lisää suoritusmerkintöjä kompetensseihin';
$string['addcourseevidencetocompetency'] = 'Lisää suoritusmerkintöjä kompetenssiin';
$string['adddepthlevel'] = 'Lisää uusi taso';
$string['addedcompetency'] = 'Kompetenssi "{$a}" on lisätty';
$string['competencyaddedframework'] = 'Kompetenssirakenne "{$a}" on lisätty';
$string['addmultiplenewcompetency'] = 'Lisää kompetensseja';
$string['addnewcompetency'] = 'Lisää uusi kompetenssi';
$string['competencyaddnewframework'] = 'Lisää uusi kompetenssirakenne';
$string['addnewscalevalue'] = 'Lisää uusi arvo asteikkoon';
$string['addnewtemplate'] = 'Lisää uusi kompetenssimallipohja';
$string['addtype'] = 'Lisää uusi tyyppi';
$string['aggregationmethod'] = 'Kompetenssin saavuttaminen';
$string['aggregationmethod1'] = 'Kaikki alakompetenssit suoritettava';
$string['aggregationmethod2'] = 'Mikä tahansa alakompetensseista suoritettava';
$string['aggregationmethod3'] = 'Toiminto ei käytössä';
$string['aggregationmethod4'] = 'Mittayksikkö';
$string['aggregationmethod5'] = 'Murto-osa';
$string['aggregationmethod6'] = 'Summa';
$string['aggregationmethod7'] = 'Keskiarvo';
$string['aggregationmethodview'] = 'Koostamistapa {$a}';
$string['allcompetencyscales'] = 'Kaikki kompetenssiasteikot';
$string['assigncompetencies'] = 'Valitse kompetensseja';
$string['assigncompetency'] = 'Osoita kompetenssi';
$string['assigncompetencytemplate'] = 'Osoita kompetenssimallipohja';
$string['assigncompetencytemplates'] = 'Osoita kompetenssimallipohjia';
$string['assigncoursecompletion'] = 'Valitse kurssin suoritusmerkinnän tekijä';
$string['assigncoursecompletions'] = 'Linkitä kurssin suoritukset';
$string['assigncoursecompletiontocompetencies'] = 'Linkitä kurssin suoritukset kompetenseihin';
$string['assigncoursecompletiontocompetency'] = 'Linkitä kurssin suoritus kompetenssiin';
$string['assignedcompetencies'] = 'Osoitetut kompetenssit';
$string['assignedcompetenciesandtemplates'] = 'Jaetut kompetenssit ja kompetenssimallipohjat';
$string['assignedcompetencytemplates'] = 'Jaetut kompetenssimallipohjat';
$string['assignedonly'] = 'Osoitetut, käyttämättömät kompetenssimallipohjat';
$string['assignnewcompetency'] = 'Osoita uusi kompetenssi';
$string['assignnewevidenceitem'] = 'Osoita uusi todiste';
$string['assignrelatedcompetencies'] = 'Lisää yhteenkuuluva kompetenssi';
$string['competencybacktoallframeworks'] = 'Takaisin kompetenssirakenteisiin';
$string['bulkdeletecompetency'] = 'Poista kompetensseja';
$string['bulkmovecompetency'] = 'Siirrä kompetensseja';
$string['cannotupdatedisplaysettings'] = 'Esitysasetuksia ei päivitetty';
$string['changeto'] = 'Vaihda';
$string['clickfornonjsform'] = 'Klikkaa tästä päästäksesi sellaiseen versioon tästä lomakkeesta, jossa ei käytetä javascript:iä.';
$string['clicktoassign'] = 'Klikkaa Osoita-painiketta valitaksesi kompetenssin.';
$string['clicktoassigntemplate'] = 'Klikkaa Osoita-painiketta valitaksesi kompetenssitemplaatin.';
$string['clicktoviewchildren'] = 'Klikkaa kompetenssin nimeä nähdäksesi sen lapsikompetenssit (jos niitä on olemassa).';
$string['competencies'] = 'Kompetenssit';
$string['competenciesusedincourse'] = 'Kurssilla käytettävät kompetenssit';
$string['competency'] = 'Kompetenssi';
$string['competencyaddnew'] = 'Lisää uusi kompetenssi';
$string['competencycustomfields'] = 'Kentät';
$string['competencydepthcustomfields'] = 'Kompetenssitason kentät';
$string['competencydepthlevelview'] = 'Kompetenssitason näkymä';
$string['competencyevidence'] = 'Kompetenssitodisteet';
$string['competencyframework'] = 'Kompetenssirakenne';
$string['competencyframeworkmanage'] = 'Hallinnoi rakenteita';
$string['competencyframeworks'] = 'Kompetenssirakenteet';
$string['competencyframeworkview'] = 'Tarkastele rakennetta';
$string['competencymanage'] = 'Hallinnoi kompetensseja';
$string['competencyplural'] = 'Kompetenssit';
$string['competencyscale'] = 'Kompetenssiasteikko';
$string['competencyscaleassign'] = 'Kompetenssiasteikko';
$string['competencyscaleinuse'] = 'Tämä asteikko on käytössä (eli käyttäjien kompetenssit määräytyvät tämän asteikon mukaan). Asteikon arvoja ei voida luoda, järjestää uudestaan tai poistaa, jotta tietojen yhtenäisyys säilyy. Voit nimetä asteikon arvoja uudelleen mutta tämä saattaa hämmentää käyttäjiä koska heidän pätevyystietonsa muuttuvat ilmoittamatta.';
$string['competencyscales'] = 'Kompetenssiasteikot';
$string['competencytemplatemanage'] = 'Hallinnoi mallipohjia';
$string['competencytemplates'] = 'Kompetenssimallipohjat';
$string['competencytypecustomfields'] = 'Kompetenssityypin lisäkentät';
$string['competencytypes'] = 'Kompetenssityypit';
$string['competencytypeview'] = 'Kompetenssityyppinäkymä';
$string['competent'] = 'Pätevä';
$string['competentwithsupervision'] = 'Pätevä valvottuna';
$string['couldnotdeletescalevalue'] = 'Asteikon arvon poistamisessa tapahtui virhe';
$string['createdon'] = 'Luotu';
$string['createnewcompetency'] = 'Luo uusi kompetenssi';
$string['competencycreatetype'] = 'Kompetenssityyppi "{$a}" luotiin';
$string['currentlyselected'] = 'Valittuna';
$string['defaultvalue'] = 'Oletusarvo';
$string['competencydeletecheck'] = 'Oletko aivan varma, että haluat poistaa tämän kompetenssin, kaikki sen lapsiobjektit ja kaiken niiden sisältämän tiedon?';
$string['competencydeletecheck11'] = 'Oletko varma, että haluat poistaa kompetenssin "{$a}"?';
$string['deletecheckframework'] = 'Oletko varma, että haluat poistaa rakenteen "{$a}"?';
$string['deletecheckscale'] = 'Oletko aivan varma, että haluat poistaa tämän kompetenssiasteikon?';
$string['deletecheckscalevalue'] = 'Oletko aivan varma, että haluat poistaa tämän kompetenssiasteikon arvon?';
$string['deletechecktemplate'] = 'Oletko aivan varma, että haluat poistaa tämän kompetenssimallipohjan?';
$string['competencydeletecheckwithchildren'] = 'Oletko varma, että haluat poistaa kompetenssin "{$a->itemname}" ja sen alla olevan {$a->children_string}:n? <br /><br /> Tämä poistaa seuraavat tiedot: <br /> - Kompetenssin "{$a->itemname}" ja {$a->childcount} {$a->children_string}';
$string['deletecompetency'] = 'Poista kompetenssi';
$string['deletedcompetency'] = 'Kompetenssi {$a} ja kaikki sen lapsiobjektit on poistettu.';
$string['deletedcompetencyscale'] = 'Kompetenssiasteikko "{$a}" on poistettu.';
$string['deletedcompetencyscalevalue'] = 'Kompetenssiasteikon arvo "{$a}" on poistettu.';
$string['deletedepth'] = 'Poista {$a}';
$string['competencydeletedframework'] = 'Kompetenssirakenne {$a} ja sen sisältämät tiedot on poistettu.';
$string['deletedtemplate'] = 'Kompetenssimallipohja {$a} ja sen sisältämät tiedot on poistettu.';
$string['competencydeletedtype'] = 'Kompetenssityyppi "{$a}" on poistettu.';
$string['deleteframework'] = 'Poista {$a}';
$string['deleteincludexcustomfields'] = '- {$a} lisäkenttä(ä)';
$string['deleteincludexevidence'] = '- {$a} todiste(tta)';
$string['deleteincludexrelatedcompetencies'] = '- {$a} linkki(ä) liittyviin kompetensseihin';
$string['deleteincludexuserstatusrecords'] = '- {$a} käyttäjän tilatietoja';
$string['competencydeletemulticheckwithchildren'] = 'Oletko varma, että haluat poistaa {$a->num} kompetenssin/kompetenssit ja sen {$a->childcount} {$a->children_string}:n? <br /><br /> Tämä poistaa seuraavat tiedot: <br /> - Kompetenssin/kompetenssit {$a->num} ja sen {$a->childcount} {$a->children_string}';
$string['deletetype'] = 'Poista tyyppi "{$a}"';
$string['depthlevel'] = 'Taso';
$string['depthlevels'] = 'Tasot';
$string['descriptionview'] = 'Kohteen {$a} kuvaus';
$string['editcompetency'] = 'Muokkaa kompetenssia';
$string['editdepthlevel'] = 'Muokkaa tasoa';
$string['competencyeditframework'] = 'Muokkaa kompetenssirakennetta';
$string['editgeneric'] = 'Muokkaa kohdetta {$a}';
$string['editscalevalue'] = 'Muokkaa asteikon arvoa';
$string['edittemplate'] = 'Muokkaa kompetenssimallipohjaa';
$string['edittype'] = 'Muokkaa tyyppiä';
$string['error:addcompetency'] = 'Ongelma kompetenssin "{$a}" lisäämisessä';
$string['error:compevidencealreadyexists'] = 'Tällä käyttäjällä on jo suoritusmerkintä valitulle kompetenssille. Voit <a href=\'edit.php?id={$a}\'>muokata olemassaolevaa kompetenssia</a>, tai lisätä toisen.';
$string['error:couldnotdeletescale'] = 'Kompetenssiasteikon "{$a}" poistamisessa tapahtui virhe';
$string['competencyerror:createtype'] = 'Kompetenssityyppiä "{$a}" luodessa tapahtui virhe';
$string['competencyerror:deletedframework'] = 'Kompetenssirakenteen {$a} ja sen sisältämien tietojen poistamisessa tapahtui virhe.';
$string['competencyerror:deletedtype'] = 'Kompetenssityyppiä "{$a}" poistettaessa tapahtui virhe.';
$string['error:dialognolinkedcourseitems'] = 'Tässä rakenteessa ei ole kompetensseja, joihin on liitetty kursseja';
$string['competencyerror:dialognotreeitems'] = 'Tässä rakenteessa ei ole kompetensseja';
$string['error:evidencealreadyexists'] = 'Uutta suoritusmerkintää ei voitu luoda koska rekisterissä on jo merkintä samalle käyttäjälle ja kompetenssille';
$string['error:nodeletecompetencyscaleassigned'] = 'Tätä kompetenssiasteikkoa ei voida poistaa koska se on lisätty yhteen tai useampaan rakenteeseen';
$string['error:nodeletecompetencyscaleinuse'] = 'Tätä kompetenssiasteikkoa ei voida poistaa koska se on käytössä';
$string['error:nodeletecompetencyscalevaluedefault'] = 'Tätä asteikon arvoa ei voida poistaa koska se on oletusarvo';
$string['error:nodeletecompetencyscalevalueonlyprof'] = 'Tätä asteikon arvoa ei voida poistaa koska se on asteikon ainoa pätevyyttä vastaava arvo. Valitse jokin muu arvo pätevyyttä vastaavaksi ennen kuin voit poistaa tämän';
$string['error:onescalevaluemustbeproficient'] = 'Vähintään yhden arvon on aina vastattava pätevyyttä. Valitse jokin muu arvo ennen kuin poistat valinnan tästä arvosta.';
$string['error:scaledetails'] = 'Asteikon tietoja hakiessa tapahtui virhe';
$string['error:updatecompetency'] = 'Ongelma kompetenssin "{$a}" päivittämisessä';
$string['competencyerror:updatetype'] = 'Kompetenssityyppiä "{$a}" päivitettäessä tapahtui virhe';
$string['evidence'] = 'Suoritusmerkintä';
$string['evidenceactivitycompletion'] = 'aktiviteetin valmius';
$string['evidencecount'] = 'Suoritusmerkinnät';
$string['evidencecoursecompletion'] = 'kurssin valmius';
$string['evidencecoursegrade'] = 'kurssiarvosana';
$string['evidenceitemremovecheck'] = 'Oletko aivan varma, että haluat poistaa todistusmerkinnän kohteesta "{$a}"?';
$string['evidenceitems'] = 'Suoritusmerkinnät';
$string['competencyfeatureplural'] = 'Kompetenssit';
$string['competencyframework'] = 'Kompetenssirakenne';
$string['competencyframeworks'] = 'Kompetenssirakenteet';
$string['competencyfullname'] = 'Kompetenssin koko nimi';
$string['fullnamedepth'] = 'Tason koko nimi';
$string['fullnameframework'] = 'Koko nimi';
$string['fullnametemplate'] = 'Mallipohjan koko nimi';
$string['fullnametype'] = 'Syötä koko nimi';
$string['fullnameview'] = 'Koko nimi kohteelle {$a}';
$string['globalsettings'] = 'Yleiset asetukset';
$string['competencyidnumber'] = 'Kompetenssin ID';
$string['idnumberframework'] = 'ID';
$string['idnumberview'] = '{$a} id';
$string['includecompetencyevidence'] = 'Ota mukaan suoritusmerkintä';
$string['invalidevidencetype'] = 'Suoritusmerkintä ei kelpaa';
$string['invalidnumeric'] = 'Vain numero kelpaa (tai ei lainkaan merkintää)';
$string['itemstoadd'] = 'Lisättävät kohteet';
$string['linkcourses'] = 'Linkitä kurssit';
$string['linktoscalevalues'] = 'Tarkastele/muokkaa <a href="view.php?id={$a}&amp;type=competency">tästä</a> tämän kompetenssiasteikon arvoja.';
$string['linktoscalevalues11'] = '<a href="view.php?id={$a}&amp;prefix=competency">Klikkaa tätä linkkiä</a> nähdäksesi/muokataksesi tämän kompetenssiasteikon arvoja.';
$string['locatecompetency'] = 'Etsi kompetenssi';
$string['locatecompetencytemplate'] = 'Etsi kompetenssimallipohja';
$string['managecompetencies'] = 'Hallinnoi kompetensseja';
$string['managecompetency'] = 'Hallinnoi kompetensseja';
$string['managecompetencytypes'] = 'Hallinnoi tyyppejä';
$string['missingfullname'] = 'Kompetenssilta puuttuu nimi';
$string['missingfullnamedepth'] = 'Tasolta puuttuu nimi';
$string['missingfullnameframework'] = 'Rakenteelta puuttuu nimi';
$string['missingfullnametemplate'] = 'Mallipohjalta puuttuu nimi';
$string['missingfullnametype'] = 'Tyypin koko nimi puuttuu';
$string['competencymissingname'] = 'Kompetenssin nimi puuttuu';
$string['competencymissingnameframework'] = 'Kompetenssirakenteen nimi puuttuu';
$string['missingnametemplate'] = 'Templaatin nimi puuttuu';
$string['competencymissingnametype'] = 'Kompetenssityypin nimi puuttuu';
$string['missingscale'] = 'Asteikko puuttuu';
$string['missingscalevaluename'] = 'Asteikon arvolta puuttuu nimi';
$string['competencymissingshortname'] = 'Kompetenssilta puuttuu lyhenne';
$string['missingshortnamedepth'] = 'Tasolta puuttuu lyhenne';
$string['missingshortnameframework'] = 'Rakenteelta puuttuu lyhenne';
$string['missingshortnametemplate'] = 'Mallipohjalta puuttuu lyhenne';
$string['missingshortnametype'] = 'Lyhenne puuttuu';
$string['name'] = 'Nimi';
$string['noassignedcompetencies'] = 'Kompetensseja ei ole lisätty';
$string['noassignedcompetenciestotemplate'] = 'Kompetensseja ei ole lisätty tähän mallipohjaan';
$string['noassignedcompetencytemplates'] = 'Kompetenssimallipohjia ei ole lisätty';
$string['nochildcompetencies'] = 'Lapsikompetensseja ei ole';
$string['nochildcompetenciesfound'] = 'Lapsikompetensseja ei löytynyt';
$string['nocompetenciesinframework'] = 'Tässä rakenteessa ei ole kompetensseja';
$string['nocompetency'] = 'Kompetensseja ei ole määritelty';
$string['nocompetencyscales'] = 'Vähintään yksi kompetenssiasteikko arvoineen on määriteltävä ennen kuin kompetenssirakenne voidaan määritellä.';
$string['nocoursecompetencies'] = 'Kurssikompetensseja ei ole';
$string['nocoursesincat'] = 'Tästä kategoriasta ei löytynyt kursseja';
$string['nodepthlevels'] = 'Tässä rakenteessa ei ole tasoja';
$string['noevidenceitems'] = 'Tälle kompetenssille ei ole määritelty suoritusmerkintöjä';
$string['noevidencetypesavailable'] = 'Tälle kurssille ei ole määritelty kurssimerkintätyyppejä';
$string['competencynoframeworks'] = 'Kompetenssirakenteita ei ole määritelty';
$string['competencynoframeworkssetup'] = 'Tälle sivustolle ei ole määritelty kompetenssirakenteita.';
$string['nonsensicalproficientvalues'] = 'Varoitus: Asteikossa on pätevyyteen oikeuttavia arvoja sellaisten arvojen alapuolella, jotka eivät pätevöitä. Muista järjestää asteikko niin, että ylimmäiseksi tulevat pätevyyteen oikeuttavat arvot.';
$string['norelatedcompetencies'] = 'Ei yhteenkuuluvia kompetensseja';
$string['noscalesdefined'] = 'Asteikkoja ei ole määritelty';
$string['noscalevalues'] = 'Tälle asteikolle ei ole määritelty arvoja';
$string['notcompetent'] = 'Ei pätevä';
$string['notemplate'] = 'Kompetenssimallipohjaa ei ole määritelty';
$string['notemplateinframework'] = 'Tässä rakenteessa ei ole määritelty kompetenssimallipohjia';
$string['notescalevalueentry'] = 'Yksi arvo riville - pätevimmästä vähiten pätevään';
$string['notypelevels'] = 'Tässä rakenteessa ei ole määritelty tyyppejä';
$string['competencynotypes'] = 'Ei kompetenssityyppejä';
$string['numericalvalue'] = 'Numero';
$string['options'] = 'Valinnat';
$string['parent'] = 'Yläkompetenssi';
$string['positions'] = 'Asemat';
$string['proficiency'] = 'Pätevyys';
$string['competencyscaleproficient'] = 'Pätevyyden arvo numerolla';
$string['proficientvaluefrozen'] = 'Tätä asetusta ei voida muuttaa koska asteikko on käytössä';
$string['proficientvaluefrozenonlyprof'] = 'Et voi muuttaa tätä asetusta sillä asteikossa pitää aina olla vähintään yksi pätevyyttä merkitsevä arvo';
$string['relatedcompetencies'] = 'Yhteenkuuluvat kompetenssit';
$string['relateditemremovecheck'] = 'Olet aivan varma, että haluat poistaa tämän kompetenssisuhteen?';
$string['removedcompetencyevidenceitem'] = 'Suoritusmerkintä <i>{$a}</i> ja sen tiedot on poistettu';
$string['removedcompetencyrelateditem'] = 'Kompetenssi <i>{$a}</i> ei ole enää liitettynä tähän kompetenssiin';
$string['removedcompetencytemplatecompetency'] = 'Kompetenssi <i>{$a}</i> ei ole enää liitettynä tähän mallipohjaan';
$string['competencyreturntoframework'] = 'Palaa kompetenssirakenteeseen';
$string['scaleadded'] = 'Kompetenssiasteikko "{$a}" lisättiin';
$string['scaledefaultupdated'] = 'Asteikon oletusarvo on päivitetty';
$string['scaledeleted'] = 'Kompetenssiasteikko "{$a}" on poistettu';
$string['scales'] = 'Asteikot';
$string['scaleupdated'] = 'Kompetenssiasteikko "{$a}" on päivitetty';
$string['scalevalueadded'] = 'Kompetenssi asteikkoon on lisätty arvo "{$a}"';
$string['competencyscalevalueidnumber'] = 'Asteikon arvon ID';
$string['competencyscalevaluename'] = 'Asteikon arvon nimi';
$string['competencyscalevaluenumericalvalue'] = 'Asteikon arvo numerona';
$string['scalevalues'] = 'Asteikon arvot';
$string['scalevalueupdated'] = 'Kompetenssiasteikon arvo "{$a}" on päivitetty';
$string['scalex'] = 'Asteikko "{$a}"';
$string['selectacompetencyframework'] = 'Valitse kompetenssirakenne';
$string['selectcategoryandcourse'] = 'Valitse kurssikategoria ja sen jälkeen kurssi, josta haluat hakea suoritusmerkinnän:';
$string['selectedcompetencies'] = 'Valitut kompetenssit:';
$string['selectedcompetencytemplates'] = 'Valitut kompetenssimallipohjat:';
$string['set'] = 'Aseta';
$string['competencyshortname'] = 'Kompetenssin lyhenne';
$string['shortnamedepth'] = 'Tason lyhenne';
$string['shortnameframework'] = 'Lyhenne';
$string['shortnametemplate'] = 'Mallipohjan lyhenne';
$string['shortnametype'] = 'Tyypin lyhenne';
$string['shortnameview'] = 'Kohteen {$a} lyhenne';
$string['template'] = 'Kompetenssimallipohja';
$string['templatecompetencyremovecheck'] = 'Oletko aivan varma, että haluat irroittaa tämän kompetenssin tästä mallipohjasta?';
$string['types'] = 'Tyypit';
$string['unknownbuttonclicked'] = 'Tuntematon painike';
$string['updatedcompetency'] = 'Kompetenssi "{$a}" on päivitetty';
$string['competencyupdatedframework'] = 'Kompetenssirakenne "{$a}" on päivitetty';
$string['competencyupdatetype'] = 'Kompetenssityyppi "{$a}" on päivitetty';
$string['useresourcelevelevidence'] = 'Käytä resurssitason todisteita';
$string['weight'] = 'Painotus';
$string['organisationaddedframework'] = 'Organisaatiorakenne "{$a}" on lisätty';
$string['addedorganisation'] = 'Organisaatio "{$a}" on lisätty';
$string['addmultipleneworganisation'] = 'Lisää organisaatioita';
$string['organisationaddnewframework'] = 'Lisää uusi organisaatiorakenne';
$string['addneworganisation'] = 'Lisää uusi organisaatio';
$string['organisationbacktoallframeworks'] = 'Takaisin organisaatiorakenteisiin';
$string['bulkdeleteorganisation'] = 'Poista organisaatioita';
$string['bulkmoveorganisation'] = 'Siirrä organisaatioita';
$string['chooseorganisation'] = 'Valitse organisaatio';
$string['competencyassigndeletecheck'] = 'Oletko varma, että haluat poistaa tämän kompetenssitehtävän?';
$string['organisationcreatetype'] = 'Organisaatiotyyppi "{$a}" on luotu';
$string['organisationdeletecheck'] = 'Oletko varma, että haluat poistaa tämän organisaation, kaikki sen lapsiobjektit ja tiedon mitä niissä saattaa olla?';
$string['organisationdeletecheck11'] = 'Oletko varma, että haluat poistaa organisaation "{$a}"?
Tällöin poistuu seuraavat kohteet:<br />
- organisaatio "{$a}"';
$string['organisationdeletecheckwithchildren'] = 'Oletko varma, että haluat poistaa tämän organisaation "{$a->itemname}" ja sen {$a->children_string}:n?
<br /><br />
Tämä poistaa seuraavat tiedot <br />- Organisaatiot {$a->num} ja sen {$a->childcount} {$a->children_string}.';
$string['organisationdeletedassignedcompetency'] = 'Kompetenssi on poistettu tältä organisaatiolta';
$string['organisationdeletedframework'] = 'Organisaatiorakenne "{$a}" ja kaikki sen sisältämän tieto on poistettu.';
$string['deletedorganisation'] = 'Organisaaatio {$a} ja kaikki sen lapsiobjektit on lopullisesti poistettu';
$string['organisationdeletedtype'] = 'Organisaatiotyyppi "{$a}" on poistettu lopullisesti';
$string['organisationdeleteincludexlinkedcompetencies'] = '- {$a} linkki(ä) kompetensseihin';
$string['organisationdeleteincludexposassignments'] = '- {$a} tehtävä(ä) tälle organisaatiolle (tähän organisaatioon liitetyt käyttäjät poistetaan organisaatiosta)';
$string['organisationdeletemulticheckwithchildren'] = 'Oletko varma, että haluat poistaa organisaatiot {$a->num} ja sen {$a->childcount} {$a->children_string}?
Tämä poistaa seuraavat tiedot: <br />- Organisaatiot {$a->num} ja sen {$a->childcount} {$a->children_string}.';
$string['deleteorganisation'] = 'Poista organisaatio';
$string['organisationeditframework'] = 'Muokkaa organisaatiorakennetta';
$string['editorganisation'] = 'Muokkaa organisaatiota';
$string['edittypelevel'] = 'Muokkaa tyyppiä';
$string['error:addorganisation'] = 'Ongelma organisaatiota "{$a}" lisättäessä';
$string['organisationerror:createtype'] = 'Organisaatiotyyppiä "{$a}" luotaessa tapahtui virhe';
$string['organisationerror:deleteassignedcompetency'] = 'Kompetensseja ei voitu poistaa tästä organisaatiosta';
$string['organisationerror:deletedframework'] = 'Organisaatiorakennetta {$a} ja sen tietoja poistettaessa tapahtui virhe';
$string['organisationerror:deletedtype'] = 'Organisaatiotyyppiä "{$a}" poistettaessa tapahtui virhe.';
$string['organisationerror:dialognotreeitems'] = 'Tässä rakenteessa ei ole organisaatioita';
$string['error:updateorganisation'] = 'Ongelma organisaatiota "{$a}" päivitettäessä';
$string['organisationerror:updatetype'] = 'Organisaatiotyyppiä "{$a}" päivitettäessä tapahtui virhe';
$string['organisationfeatureplural'] = 'Organisaatiot';
$string['organisationframework'] = 'Organisaatiorakenne';
$string['organisationframeworks'] = 'Organisaatiorakenteet';
$string['organisationfullname'] = 'Organisaation koko nimi';
$string['organisationidnumber'] = 'Organisaation id-numero';
$string['manageorganisation'] = 'Hallinnoi organisaatioita';
$string['manageorganisations'] = 'Hallinnoi organisaatioita';
$string['manageorganisationtypes'] = 'Hallinnoi tyyppejä';
$string['missingfullname'] = 'Organisaatiolta puuttuu täydellinen nimi';
$string['organisationmissingname'] = 'Organisaation nimi puuttuu';
$string['organisationmissingnameframework'] = 'Organisaatiorakenne puuttuu';
$string['organisationmissingnametype'] = 'Organisaatiotyypin nimi puuttuu';
$string['organisationmissingshortname'] = 'Organisaatiolta puuttuu lyhenne';
$string['nochildorganisations'] = 'Lapsiorganisaatioita ei ole määritelty';
$string['organisationnoframeworks'] = 'Organisaatiorakenteita ei ole';
$string['organisationnoframeworkssetup'] = 'Tällä sivustolla ei ole vielä organisaatiorakenteita.';
$string['noorganisation'] = 'Yhtään organisaatiota ei ole määritelty';
$string['noorganisationsinframework'] = 'Tässä rakenteessa ei ole yhtään organisaatiota';
$string['organisationnotypes'] = 'Ei organisaatiotyyppejä';
$string['nounassignedcompetencies'] = 'Jakamattomia kompetensseja ei löydy';
$string['nounassignedcompetencytemplates'] = 'Jakamattomia kompetenssimallipohjia ei löydy';
$string['organisation'] = 'Organisaatio';
$string['organisationaddnew'] = 'Lisää uusi organisaatio';
$string['organisationbulkaction'] = 'Massatoimenpiteet';
$string['organisationcustomfields'] = 'Lisäkentät';
$string['organisationdepthcustomfields'] = 'Organisaatiotasojen lisäkentät';
$string['organisationframework'] = 'Organisaatiorakenne';
$string['organisationframeworkmanage'] = 'Hallinnoi rakenteita';
$string['organisationframeworks'] = 'Organisaatiorakenteet';
$string['organisationmanage'] = 'Hallinnoi organisaatioita';
$string['organisationplural'] = 'Organisaatiot';
$string['organisations'] = 'Organisaatiot';
$string['organisationtypecustomfields'] = 'Organisaatiotyypin lisäkentät';
$string['organisationtypes'] = 'Organisaatiotyypit';
$string['organisationreturntoframework'] = 'Palaa organisaatiorakenteeseen';
$string['organisationshortname'] = 'Organisaation lyhenne';
$string['organisationupdatedframework'] = 'Organisaatiorakenne "{$a}" on päivitetty';
$string['updatedorganisation'] = 'Organisaatio "{$a}" on päivitetty';
$string['organisationupdatetype'] = 'Organisaatiotyyppi "{$a}" on päivitetty';
$string['positionaddedframework'] = 'Asemarakenne "{$a}" on lisätty';
$string['addedposition'] = 'Asema "{$a}" on lisätty';
$string['addmultiplenewposition'] = 'Lisää asemia';
$string['positionaddnewframework'] = 'Lisää uusi asemarakenne';
$string['addnewposition'] = 'Lisää uusi asema';
$string['positionbacktoallframeworks'] = 'Takaisin asemarakenteisiin';
$string['bulkdeleteposition'] = 'Poista asemia';
$string['bulkmoveposition'] = 'Siirrä asemia';
$string['choosemanager'] = 'Valitse esimies';
$string['chooseposition'] = 'Valitse asema';
$string['positioncreatetype'] = 'Asematyyppi "{$a}" on luotu';
$string['positiondeletecheck'] = 'Oletko varma, että haluat poistaa tämän aseman, sen kaikki lapsiobjektit ja kaikki niiden tiedot?';
$string['positiondeletecheck11'] = 'Oletko varma, että haluat poistaa aseman "{$a}"?
<br /><br />
Samalla hävitetään seuraavat tiedot: <br />
- asema "{$a}"';
$string['positiondeletecheckwithchildren'] = 'Oletko varma, että haluat poistaa tämän aseman "{$a->itemname}" ja sen {$a->children_string}:n?
<br /><br />
Tämä poistaa seuraavat tiedot <br />- aseman "{$a->itemname}" ja sen {$a->childcount} {$a->children_string}.';
$string['positiondeletedassignedcompetency'] = 'Kompetenssi poistettu tästä asemasta';
$string['positiondeletedframework'] = 'Asemarakenne {$a} ja kaikki sen tiedot on poistettu';
$string['deletedposition'] = 'Asema {$a} ja sen lapsiobjektit on poistettu';
$string['positiondeletedtype'] = 'Asematyyppi "{$a}" on poistettu lopullisesti';
$string['positiondeleteincludexlinkedcompetencies'] = '- {$a} linkki(ä) kompetensseihin';
$string['positiondeleteincludexposassignments'] = '- {$a} tehtävä(ä) tälle asemalle (tähän asemaan liitetyt käyttäjät poistetaan asemasta)';
$string['positiondeletemulticheckwithchildren'] = 'Oletko varma, että haluat poistaa asemat {$a->num} ja sen {$a->children_string}:n?
<br /><br />
Tämä poistaa seuraavat tiedot <br />- asemat {$a->num} ja sen {$a->childcount} {$a->children_string}:n.';
$string['deleteposition'] = 'Poista asema';
$string['positioneditframework'] = 'Muokkaa asemarakennetta';
$string['editposition'] = 'Muokkaa asemaa';
$string['entervaliddate'] = 'Syötä käypä päivämäärä';
$string['error:addposition'] = 'Ongelma asemaa "{$a}" lisättäessä';
$string['positionerror:createtype'] = 'Asematyyppiä "{$a}" luodessa tapahtui virhe';
$string['error:dateformat'] = 'Syötä päivämäärä muodossa {$a}.';
$string['positionerror:deleteassignedcompetency'] = 'Kompetenssin irroittaminen tästä asemasta epäonnistui';
$string['positionerror:deletedframework'] = 'Asemarakenteen {$a} ja sen tietojen poistamisessa tapahtui virhe.';
$string['positionerror:deletedtype'] = 'Asematyyppiä "{$a}" poistettaessa tapahtui virhe';
$string['positionerror:dialognotreeitems'] = 'Tässä rakenteessa ei ole asemia';
$string['error:positionnotset'] = 'Tälle käyttäjälle ei ole määritelty asemaa';
$string['error:startafterfinish'] = 'Aloituspäivämäärä ei voi olla lopetuspäivämäärän jälkeen';
$string['error:updateposition'] = 'Ongelma asemaa "{$a}" päivitettäessä';
$string['positionerror:updatetype'] = 'Asematyyppiä "{$a}" päivitettäessä tapahtui virhe';
$string['error:userownmanager'] = 'Käyttäjää ei voida määritellä omaksi esimiehekseen';
$string['positionfeatureplural'] = 'Asemat';
$string['finishdate'] = 'Lopetuspäivämäärä';
$string['finishdatehint'] = '&nbsp;<b>Muoto:</b>pp/kk/vvvv';
$string['positionframework'] = 'Asemarakenne';
$string['positionframeworks'] = 'Rakenteet';
$string['positionfullname'] = 'Aseman koko nimi';
$string['positionidnumber'] = 'Aseman ID-mumero';
$string['manageposition'] = 'Hallinnoi asemia';
$string['managepositions'] = 'Hallinnoi asemia';
$string['managepositiontypes'] = 'Hallinnoi tyyppejä';
$string['manager'] = 'Esimies';
$string['missingfullname'] = 'Asemalta puuttuu täydellinen nimi';
$string['positionmissingname'] = 'Puuttuva aseman nimi';
$string['positionmissingnameframework'] = 'Puuttuva asemarakenteen nimi';
$string['positionmissingnametype'] = 'Puuttuva asematyypin nimi';
$string['positionmissingshortname'] = 'Asemalta puuttuu lyhenne';
$string['nocompetenciesassignedtoposition'] = 'Tälle asemalle ei ole määritelty kompetensseja';
$string['positionnoframeworks'] = 'Asemarakenteita ei löytynyt';
$string['positionnoframeworkssetup'] = 'Tällä sivustolla ei ole yhtään asemarakennetta.';
$string['noposition'] = 'Asemia ei ole määritelty';
$string['nopositionsassigned'] = 'Tälle käyttäjälle ei ole määritelty asemia';
$string['nopositionset'] = 'Asemaa ei ole määritelty';
$string['nopositionsinframework'] = 'Tässä rakenteessa ei ole asemia';
$string['positionnotypes'] = 'Ei asematyyppejä';
$string['position'] = 'Asema';
$string['positionaddnew'] = 'Lisää uusi asema';
$string['positionbulkaction'] = 'Massatoimenpiteet';
$string['positioncustomfields'] = 'Lisäkentät';
$string['positiondepthcustomfields'] = 'Asematason lisäkentät';
$string['positionframework'] = 'Asemarakenne';
$string['positionframeworkmanage'] = 'Hallinnoi rakenteita';
$string['positionframeworks'] = 'Asemarakenteet';
$string['positionhistory'] = 'Asemahistoria';
$string['positionmanage'] = 'Hallinnoi asemia';
$string['positionplural'] = 'Asemat';
$string['positionsaved'] = 'Asema tallennettu.';
$string['positiontypecustomfields'] = 'Asematyypin lisäkentät';
$string['positiontypes'] = 'Asematyypit';
$string['positionreturntoframework'] = 'Palaa asemarakenteeseen';
$string['positionshortname'] = 'Aseman lyhenne';
$string['startdate'] = 'Aloituspäivämäärä';
$string['startdatehint'] = '&nbsp;<b>Muoto:</b>pp/kk/vvvv';
$string['titlefullname'] = 'Nimike (koko)';
$string['titleshortname'] = 'Nimike (lyhenne)';
$string['typeaspirational'] = 'Tavoiteasema';
$string['typeprimary'] = 'Ensisijainen asema';
$string['typesecondary'] = 'Toissijainen asema';
$string['positionupdatedframework'] = 'Asemarakenne "{$a}" on päivitetty';
$string['updatedposition'] = 'Asema "{$a}" on päivitetty';
$string['updateposition'] = 'Päivitä asema';
$string['positionupdatetype'] = 'Asematyypi "{$a}" on päivitetty';
$string['addcompetencyevidence'] = 'Lisää kompetenssitodisteiden rekisteri';
$string['addforthisuser'] = 'Lisää tälle käyttäjälle kompetenssitodiste';
$string['confirmdeletece'] = 'Oletko varma, että haluat poistaa tämän kompetenssitodisteen?';
$string['couldnotdeletece'] = 'Kompetenssitodistetta ei voitu poistaa.';
$string['deletecompetencyevidence'] = 'Poista kompetenssitodiste';
$string['editcompetencyevidence'] = 'Muokkaa kompetenssitodisteiden rekisteriä';
$string['firstselectcompetency'] = 'Valitse ensin kompetenssi';
$string['selectcompetency'] = 'Valitse kompetenssi';


$string['organisationframeworkfullname_help'] = 'Määrittele rakenteen täydellinen nimi.';
$string['organisationframeworkdescription_help'] = 'Rakenteen kuvaus- kentässä voit antaa mahdollisia lisätietoja rakenteesta. Se näytetään organisaation hallinnointisivulla, organisaatiotaulukon yläpuoella.';
$string['organisationframeworkidnumber_help'] = 'Rakenteen tunnus on yksilöllinen numero, joka edustaa rakennetta.</h1>';
$string['organisationframeworkshortname_help'] = 'Rakenteen lyhenne toimii käyttöä nopeuttavana viittauksena rakenteen koko nimeen.';
$string['organisationfullname_help'] = 'Tämä on organisaation täydellinen nimi.';
$string['organisationframework_help'] = '**Organisaatiorakenne** on sen rakenteen nimi, jossa määrittelet organisaatiotasi.';
$string['organisationframeworks_help'] = '**Organisaatiorakenne** rakennetaan kuvaamaan sitä millainen organisaatiosi on.

Voit luoda useita rakenteita. Voit esimerkiksi luoda rakenteet yrityksen alaosastoille tai tytäryhtiöille.';
$string['competencytype_help'] = 'Hallinnoijat voivat luoda ja määritellä kompetenssien tyyppejä. Jos kompetenssille on määritelty tyyppi, kaikki tyyppiin liitetyt lisäkentät periytyvät kompetenssille. Näin voit hallinnoida kompetenssien metatietoja ja laittaa näkyviin vain tarvittavia tietoja kustakin kompetenssista.';
$string['competencyshortname_help'] = 'Kompetenssin lyhenne helpottaa kompetenssin löytämistä joissakin näkymissä.';
$string['competencyscalevaluenumericalvalue_help'] = 'Asteikon numeerinen arvo.';
$string['competencytemplatefullname_help'] = 'Mallipohjan täydellinen nimi.';
$string['competencytemplategeneral_help'] = '**Kompetenssimallipohjan** avulla voit ryhmitellä saman kompetenssirakenteen kompetensseja yhteen.

Kun rakennat koulutusta, esim. työhöntulokurssia, voit linkittää sen kompetenssimallipohjaan nimeltään \'uuden työntekijän kompetenssit\' sen sijaan, että valitsisit kompetenssit yksitellen.';
$string['organisationidnumber_help'] = 'Organisaation tunnus on yksilöllinen numero, joka edustaa organisaatiota.';
$string['competencytemplateshortname_help'] = 'Mallipohjan nimen lyhenne nopeuttaa mallipohjan löytämistä joissakin näkymissä.';
$string['organisationdescription_help'] = 'Vapaa tekstikenttä, jossa voidaan antaa lisätietoa tästä organisaatiosta. Tämä tieto näytetään hierakialistausta katsottaessa ja organisaatiosivulla.';
$string['organisationparent_help'] = '**Yläorganisaatio** mahdollistaa ylä- ja alaorganisaatioiden suhteiden hallinnoimisen.

Valitse **yläorganisaatio** alasvetovalikosta. Valitse **Ylin** , jos haluat organisaation olevan hiearkian huipulla.

Jos muutat jonkin kohteen yläorganisaatiota, se siirtyy uuden yläorganisaationsa alle ottaen mukaansa allaolevat kohteet.

**Huomaa:** Jotta voit luoda näitä suhteita, sinulla tulee olla vähintään kaksi kohdetta rakenteessa. Muutoin tätä vaihtoehtoa ei ole saatavilla.';
$string['positionfullname_help'] = '**Aseman täydellinen nimi** on työtehtävän nimi.';
$string['positionframeworkshortname_help'] = 'Rakenteen lyhenne on helppo tapa viitata rakenteen koko nimeen ja sitä voidaan käyttää eri näkymissä.';
$string['positionidnumber_help'] = '**Aseman tunnusnumero** on yksilöllinen numero, joka edustaa tiettyä asemaa. Tämä on vaihtoehtoinen kenttä.';
$string['positionparent_help'] = '**Ylempi asema** -toiminnon avulla voit hallinnoida asemien hierarkisia suhteita.

Valitse **Ylempi asema** alasvetovalikosta. Valitse **Ylin**, jos haluat aseman sijoittuvan hierarkian ylimmälle tasolle.

Jos muutat jonkin aseman yläasemaa, se siirtyy tämän uuden aseman alle ja kaikki sen alla olevat asemat siirtyvät mukana.

**Huomio:** Jotta voit luoda hierkisia suhteita, sinulla tulee olla vähintään kaksi kohdetta rakenteessa. Muussa tapauksessa tämä vaihtoehto ei ole käytettävissä.';
$string['positiontype_help'] = '# Hallinnoijat voivat luoda ja määritellä erityyppisiä asemia. Mikäli asemalle on määritelty tyyppi, asema perii kaikki lisäkentät, jotka on tälle tyypille määritelty. Tämän toiminnon avulla voidaan liittää asemiin metatietoa ja näyttää asemien yhteydessä vain tarvittavat tiedot.';
$string['positionshortname_help'] = '**Aseman lyhenne**ttä käytetään eri näkymissä viittaamaan asemaan.';
$string['positionframeworks_help'] = 'A **Asemarakenne** on kehikko, joka kuvastaa eri asemien paikkaa organisaatiossa.

Voit luoda useita asemien luokittelutapoja (rakenteita) yhdessä organisaatiossa.';
$string['positionframeworkidnumber_help'] = 'Rakenteen tunnusnumero on yksilöllinen numero, joka edustaa rakennetta.';
$string['organisationtype_help'] = 'Hallinnoijat voivat luoda ja määritellä organisaatioiden tyyppejä. Jos organisaatiolle on määritelty tyyppi, kaikki tyyppiin liitetyt lisäkentät periytyvät organisaatiolle. Näin voit hallinnoida organisaatioiden metatietoja ja laittaa näkyviin vain tarvittavia tietoja kustakin organisaatiosta.';
$string['organisationshortname_help'] = 'Organsaation lyhenteen käyttö helpottaa organisaation löytämistä joissakin näkymissä.';
$string['positiondescription_help'] = 'Vapaa tekstikenttä, jota voidaan käyttää lisätietojen antamiseen kyseisestä asemasta. Tämä teksti näytetään hierarkialistausta tarkasteltaessa ja asemaa käsittelelvällä sivulla.';
$string['positionframework_help'] = '**Asemarakenne** on runko, johon asemat (työtehtävät) asetellaan. Asemarakenteita (listoja) voi olla useita.';
$string['positionframeworkfullname_help'] = 'Tämä on rakenteen koko nimi.';
$string['positionframeworkdescription_help'] = 'Rakenteen kuvaus on tekstikenttä, johon voidaan syöttää lisätietoja rakenteesta. Tämä teksti näkyy asemien hallinnointisivulla, asemataulukon yläpuolella.';
$string['competencyscalevaluename_help'] = '**Asteikon arvon nimi** on sen kompetenssiasteikon arvon nimi, jota olet lisäämässä tai muokkaamassa.

Arvolla mitataan oppijan edistymistä kompetenssin osalta. Voit lisätä niin monta arvoa kuin on tarpeellista.

**Huomio: **Muista asettaa oletus- ja pätevyysarvot.';
$string['competencyscalesgeneral_help'] = '**Kompetenssiasteikkojen **avulla voit määritellä sen millä kriteereillä kompetenssia arvotetaan. Esimekiksi, asteikossa voi olla kolme arvoa: \'pätevä, pätevä valvonnassa, ei pätevä\'.

Sinun tulee määritellä ensin kompetenssiasteikko, jotta voit rakentaa kompetenssirakenteen ja määritellä kompetenssit.';
$string['competencyevidenceproficiency_help'] = 'Tämä kenttä määrittää pidetäänkö käyttäjää pätevänä hänelle määrätyssä kompetenssissa. Alasvetovalikon valinnat riippuvat kompetenssille asetetusta arviointiasteikosta, joten kompetenssi tulee olla valittuna ennenkuin tätä kenttää voi muokata. Pätevyys on valittava, jotta kompetenssin näyttötietoja voi lisätä tai päivittää.';
$string['competencyevidenceposition_help'] = 'Tämä valinnainen kenttä näyttää missä asemassa käyttäjä oli saadessaan kompetenssinäytön valmiiksi. Useimmissa tapauksissa tämä on sama kuin käyttäjän nykyinen rooli. Koska monet ihmiset siirtyvät asemasta toiseen ajan kuluessa, tämän toiminnon avulla asematietojen historiaa voi seurata.';
$string['competencyevidencetimecompleted_help'] = 'Kenttä osoittaa, milloin kompetenssinäyttö oli suoritettu.';
$string['competencyevidenceuser_help'] = 'Käyttäjä, jolle tämä kompetenssinäyttö on osoitettu. Näyttöä ei ole mahdollista siirtää toiselle käyttäjälle. Jos käyttöoikeutesi riittävät, voit luoda käyttäjälle uuden näyttö-nimikkeen. The user whom this item of competency evidence is assigned. It is not possible to reassign an item of competency evidence to a different user. If you have sufficient permissions you can create a new item of competency evidence for a user by clicking the button on the user\'s My Records page. You can also edit evidence for that user by finding the record in the report and clicking the edit icon.';
$string['competencyframeworkdescription_help'] = 'Rakenteen kuvaus -tekstikenttään voidaan syöttää lisätietoja rakenteesta. Kenttä näkyy kompetenssien hallinnointisivulla, kompetenssitaulukon yläpuolella.';
$string['competencyframework_help'] = 'Kompetensseja ryhmitellään, luokitellaan ja talletetaan kompetenssirakenteissa. Kun rakenne on ensin luotu, kompetenssit lisätään sen sisälle.';
$string['competencyevidenceorganisation_help'] = 'Tämä valinnainen kenttä näyttää missä organisaatiossa käyttäjä oli saadessaan kompetenssinäytön valmiiksi. Useimmissa tapauksissa tämä on sama kuin käyttäjän nykyinen organisaatio. Koska monet ihmiset siirtyvät organisaatioiden välillä ajan kuluessa, tämän toiminnon avulla suoritusten historiaa voi seurata.';
$string['competencyevidencecompetency_help'] = 'Käyttäjälle määritettävä kompetenssi, jota ei voi muuttaa, jos siihen on jo liitetty kompetenssitodiste. Jos käyttäjäoikeutesi sallivat, voit luoda käyttäjälle uuden todiste-nimikkeen hänen profiilinsa välilehdeltä **Omat suoritukset**, klikkaamalla painiketta **Lisää kompetenssitodiste**.

Uutta todiste-nimikettä luodessasi voit valita lisäätkö todisteen olemassaolevaan kompetenssiin vai luotko kokonaan uuden. Jos valitset ensimmäisen vaihtoehdon, voit valita haluamasi kompetenssin ponnahdusikkunan listalta. Jos valitset jälkimmäisen vaihtoehdon, voit luoda uuden kompetenssin haluaamasi rakenteeseen.

Huomaa, että yhdelle käyttäjälle ei voi olla määritettynä kahta eri todistetta yhtä kompetenssia kohden. Tällöin joudut joko muokkaamaan alkuperäistä suoritusta tai valitsemaan eri kompetenssin.';
$string['competencydescription_help'] = 'Vapaa tekstikenttä, jossa voit antaa lisätietoja ja kuvauksen kompetenssista. Tieto näytetään hierarkialistauksessa ja kompetenssin omalla sivulla.';
$string['competencyaggregationmethod_help'] = 'Yhteenvetomenetelmä on tapa, jolla järjestelmä laskee onko kompetenssi saavutettu vai ei.

Jos valittuna on Kaikki, kaikkien alakompetenssien tulee täyttyä, jotta yläkompetenssi voidaan merkitä suoritetuksi.

Jos valittuna on Mikä tahansa, yhden alakompetensseista riittää täyttyä, jotta yläkompetenssi (ja siihen liittyvät muut alikompetenssit) voidaan merkitä suoritetuiksi.

Jos toimintoa ei ole valittu käytettäväksi, järjestelmä ei kerää tälle kompetenssille automaattisia yhteenvetotietoja, mutta suoritusmerkinnät voidaan silti antaa käsin.';
$string['competencyevidenceassessmenttype_help'] = 'Vapaa tekstikenttä, johon voit halutessasi syöttää lisätietoa tämän kompetenssin arviointitavasta.';
$string['competencyevidenceassessor_help'] = 'Valitse henkilö, joka arvioi käyttäjän pätevyyden tässä kompetenssissa. Arvioijan määrittäminen on valinnaista, joten voit jättää tämän kohdan myös tyhjäksi.

Alavetovalikko näyttää kaikki käyttäjät, jotka on määritetty olemaan \'Arvioijan\' roolissa. Jos etsimäsi käyttäjä puuttuu listalta tai yhtään vaihtoehtoa ei ole määritetty, käänny järjestelmän hallinnoijan puoleen.';
$string['competencyevidenceassessorname_help'] = 'Tässä kentässä näkyy sen organisaation nimi, jota teki käyttäjästä arvioinnin tätä kompetenssia varten. Kenttä on vapaaehtoinen ja sen voi jättää tyhjäksi.';
$string['competencyscalevalueidnumber_help'] = 'Asteikon arvon tunnus on yksilöllinen numero, joka edustaa asteikon arvoa.';
$string['competencyframeworkfullname_help'] = 'Tämä on rakenteen täydellinen nimi.';
$string['competencyscaleassign_help'] = 'Kompetenssiasteikko määrittelee sen, millä kriteereillä kompetenssia mitataan. Tämä on sen asteikon nimi, johon arvoa ollaan lisäämässä.';
$string['competencyscale_help'] = '**Asteikko** on sen kompetenssiasteikon nimi, jota käytetään kompetenssirakenteessa.

Kompetenssiasteikko määritellään kompetenssirakenteessa. Vain yhtä asteikkoa voidaan käyttää yhdessä rakenteessa.

Uuden kompetenssiasteikon voi määritellä täällä: Hierarkiat/Kompetenssit/Hallinnoi rakenteita hallinnointivalikossa vasemmalla.';
$string['competencyscaledefault_help'] = '**Oletusarvo** annetaan automaattisesti käyttäjälle, joka ei ole vielä suorittanut kaikkia osaamiseen vaadittuja näyttöjä (kurssin/aktiviteetin suorittaminen, tai kurssin/aktiviteetin arvosanan saaminen).';
$string['competencyscaleproficient_help'] = 'Pätevyyden arvo osoittaa onko käyttäjä pätevä tietyssä osaamisalueessa. Tämän arvon perusteella voidaan seurata oppimissuunnitelmien etenemistä ja näyttää myöhästymishuomautuksia puutteellisesta osaamisesta.

Asteikossa voi olla useita arvoja, mutta vähintään yhden niistä tulee olla valittuna hyväksytyksi pätevyydeksi. Tätä asetusta voit muuttaa asteikon arvon muokkaustilassa.

Asteikon alin pätevyyden arvo annetaan automaattisesti käyttäjälle, joka on saavuttanut kompetenssiin vaaditut näytöt (esim. kurssin/aktiviteetin suorittaminen, kurssista/aktiviteetista arvosanan saaminen).';
$string['competencyscalescalevalues_help'] = 'Syötä kompetenssiasteikon arvot (yksi per rivi) järjestyksessä kaikkein pätevimmästä vähiten pätevään. Esimerkiksi:

<p class="indent">
  <i> Pätevä<br /> Ohjausta vaativa<br /> Ei osaamista<br /> </i>
</p>';
$string['competencyscalescalename_help'] = 'Kompetenssiasteikon nimi, jota käytetään kompetenssihierarkioissa.';
$string['competencyframeworkgeneral_help'] = '**Kompetenssirakenteet **luodaan tukemaan henkilöstöltä vaadittavien taitojen, tiedon ja kompetenssien verkostoa.

Kompetenssit voidaan ryhmitellä erilaisten rakenteiden alle. Esimerkiksi yhdessä rakenteessa voi olla kaikki alan kansallisen tason standardikompetenssit (virallisista lähteistä) ja toisessa rakenteessa voi olla yrityksen sisäiset kompetenssit.

Ennenkuin voit rakentaa kompetenssirakenteen, **kompetenssiasteikko** tulee olla luotuna.';
$string['competencyparent_help'] = '**Yläkompetenssi** mahdollistaa kompetenssienvälisten suhteiden hallinnoimisen.

Valitse **yläkompetenssi** alasvetovalikosta. from the dropdown menu. Valitse **Ylin** mikäli haluast kompetenssin olevan ylimpänä koko hierarkiassa.

Jos muutat jonkin kohteen toisen yläkompetenssin alle, kaikki sen allaolevat kohteet siirtyvät mukana.

**Huomio:** Jotta voit hallinnoida kompetenssienvälisiä suhteita, rakenteessa tulee olla vähintään kaksi kohdetta. Muussa tapauksessa hallinnointimahdollisuutta ei näytetä.';
$string['competencyframeworks_help'] = '**Kompetenssirakenteet **luodaan tukemaan henkilöstöltä vaadittavien taitojen, tiedon ja kompetenssien verkostoa.

Kompetenssit voidaan ryhmitellä erilaisten rakenteiden alle. Esimerkiksi yhdessä rakenteessa voi olla kaikki alan kansallisen tason standardikompetenssit (virallisista lähteistä) ja toisessa rakenteessa voi olla yrityksen sisäiset kompetenssit.

Ennenkuin voit rakentaa kompetenssirakenteen, **kompetenssiasteikko** tulee olla luotuna.';
$string['competencyframeworkidnumber_help'] = 'Rakenteen tunnus on yksilöllinen numero, joka edustaa kyseistä rakennetta.</h1>';
$string['competencyidnumber_help'] = 'Kompetenssin tunnus on yksilöllinen numero, joka edustaa tätä kompetenssia.';
$string['competencyframeworkscale_help'] = 'Kompetenssiasteikkojen avulla voit määritellä sen millä kriteereillä kompetenssia arvotetaan. Esimekiksi, asteikossa voi olla kolme arvoa: \'pätevä, pätevä valvonnassa, ei pätevä\'.

Ensimmäisenä sinun tulee lisätä uusi asteikko, sen jälkeen asteikon arvot, joilla mitataan oppijan edistymistä kompetenssin suhteen. Voit lisätä niin monta arvoa kuin haluat. Huomaa myös oletus- ja pätevyysarvojen asetukset.';
$string['competencyframeworkshortname_help'] = 'Rakenteen lyhenne helpottaa rakenteen löytämistä joissakin näkymissä.';
$string['competencyfullname_help'] = 'Kompetenssin täydellinen nimi.';

$string['hierarchy:assignselfposition'] = 'Määrittele oma rooli';
$string['hierarchy:assignuserposition'] = 'Määrittele käyttäjän rooli';
$string['hierarchy:createcompetency'] = 'Luo kompetenssi';
$string['hierarchy:createcompetencycustomfield'] = 'Luo kompetenssikenttä';
$string['hierarchy:createcompetencydepth'] = 'Luo kompetenssitaso';
$string['hierarchy:createcompetencyframeworks'] = 'Luo kompetenssirakenne';
$string['hierarchy:createcompetencytemplate'] = 'Luo kompetenssimallipohja';
$string['hierarchy:createcompetencytype'] = 'Luo kompetenssityyppi';
$string['hierarchy:createcoursecustomfield'] = 'Luo kurssikenttä';
$string['hierarchy:createorganisation'] = 'Luo organisaatio';
$string['hierarchy:createorganisationcustomfield'] = 'Luo organisaatiokenttä';
$string['hierarchy:createorganisationdepth'] = 'Luo oganisaatiotaso';
$string['hierarchy:createorganisationframeworks'] = 'Luo oganisaatiorakenne';
$string['hierarchy:createorganisationtype'] = 'Luo organisaatiotyyppi';
$string['hierarchy:createposition'] = 'Luo rooli';
$string['hierarchy:createpositioncustomfield'] = 'Luo roolikenttä';
$string['hierarchy:createpositiondepth'] = 'Luo roolitaso';
$string['hierarchy:createpositionframeworks'] = 'Luo roolirakenne';
$string['hierarchy:createpositiontype'] = 'Luo asematyyppi';
$string['hierarchy:deletecompetency'] = 'Poista kompetenssi';
$string['hierarchy:deletecompetencycustomfield'] = 'Poista kompetenssikenttä';
$string['hierarchy:deletecompetencydepth'] = 'Poista kompetenssitaso';
$string['hierarchy:deletecompetencyframeworks'] = 'Poista kompetenssirakenne';
$string['hierarchy:deletecompetencytemplate'] = 'Poista kompetenssimallipohja';
$string['hierarchy:deletecompetencytype'] = 'Poista kompetenssityyppi';
$string['hierarchy:deletecoursecustomfield'] = 'Poista kurssikenttä';
$string['hierarchy:deleteorganisation'] = 'Poista organisaatio';
$string['hierarchy:deleteorganisationcustomfield'] = 'Poista organisaatiokenttä';
$string['hierarchy:deleteorganisationdepth'] = 'Poista organisaatiotaso';
$string['hierarchy:deleteorganisationframeworks'] = 'Poista organisaatiorakenne';
$string['hierarchy:deleteorganisationtype'] = 'Poista organisaatiotyyppi';
$string['hierarchy:deleteposition'] = 'Poista rooli';
$string['hierarchy:deletepositioncustomfield'] = 'Poista roolikenttä';
$string['hierarchy:deletepositiondepth'] = 'Poista roolitaso';
$string['hierarchy:deletepositionframeworks'] = 'Poista roolirakenne';
$string['hierarchy:deletepositiontype'] = 'Poista asematyypppi';
$string['hierarchy:editclassifications'] = 'Muokkaa kurssiluokitteluja';
$string['hierarchy:editcourseclassification'] = 'Muokkaa kurssin luokittelua';

$string['hierarchy:searchclassifications'] = 'Hakuluokittelut';
$string['hierarchy:updatecompetency'] = 'Päivitä kompetenssi';
$string['hierarchy:updatecompetencycustomfield'] = 'Päivitä kompetenssikenttä';
$string['hierarchy:updatecompetencydepth'] = 'Päivitä kompetenssitaso';
$string['hierarchy:updatecompetencyframeworks'] = 'Päivitä kompetenssirakenne';
$string['hierarchy:updatecompetencytemplate'] = 'Päivitä kompetenssimallipohja';
$string['hierarchy:updatecompetencytype'] = 'Päivitä kompetenssityyppi';
$string['hierarchy:updatecoursecustomfield'] = 'Päivitä kurssikenttä';
$string['hierarchy:updateorganisation'] = 'Päivitä organisaatio';
$string['hierarchy:updateorganisationcustomfield'] = 'Päivitä organisaatiokenttä';
$string['hierarchy:updateorganisationdepth'] = 'Päivitä organisaatiotaso';
$string['hierarchy:updateorganisationframeworks'] = 'Päivitä organisaatiorakenne';
$string['hierarchy:updateorganisationtype'] = 'Päivitä organisaatiotyyppi';
$string['hierarchy:updateposition'] = 'Päivitä rooli';
$string['hierarchy:updatepositioncustomfield'] = 'Päivitä roolikenttä';
$string['hierarchy:updatepositiondepth'] = 'Päivitä roolitaso';
$string['hierarchy:updatepositionframeworks'] = 'Päivitä roolirakenne';
$string['hierarchy:updatepositiontype'] = 'Päivitä asematyyppi';
$string['hierarchy:viewcompetency'] = 'Tarkastele kompetenssia';
$string['hierarchy:vieworganisation'] = 'Tarkastele organisaatiota';
$string['hierarchy:viewposition'] = 'Tarkastele roolia';
