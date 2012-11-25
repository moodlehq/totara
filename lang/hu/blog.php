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
 * Strings for component 'blog', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   blog
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addnewentry'] = 'Új üzenet hozzáadása';
$string['addnewexternalblog'] = 'Külső blog regisztrálása...';
$string['assocdescription'] = 'Ha egy kurzusról és/vagy tevékenységmodulokról ír, itt válassza ki őket.';
$string['associated'] = 'Kapcsolódó {$a}';
$string['associatewithcourse'] = '{$a->coursename} kurzusról szóló blog';
$string['associatewithmodule'] = 'Blog {$a->modtype}: {$a->modname} témakörben';
$string['association'] = 'Kapcsolódás';
$string['associations'] = 'Kapcsolódások';
$string['associationunviewable'] = 'Az üzenetet mások csak akkor tekinthetik meg, ha kurzust kapcsol hozzá vagy módosítja az \'Értesítendő\' mezőt.';
$string['autotags'] = 'Címkék hozzáadása';
$string['autotags_help'] = 'A külső blogjából ezen portálra másolandó blogüzenetekhez automatikusan kapcsolódó címkék vesszővel elválasztott felsorolása. A címkékkel szűrheti a blogüzeneteket és fellelheti azokat, amelyek a külső bloghoz kapcsolódnak.';
$string['backupblogshelp'] = 'Bekapcsolásakor a blogok bekerülnek a PORTÁL automatikusan mentett állományai közé';
$string['blockexternalstitle'] = 'Külső blogok';
$string['blocktitle'] = 'Blogcímkék blokkcíme';
$string['blog'] = 'Blog';
$string['blogaboutthis'] = 'Blog {$a->type} témakörben';
$string['blogaboutthiscourse'] = 'Üzenet hozzáadása a kurzusról';
$string['blogaboutthismodule'] = 'Üzenet hozzáadása erről {$a}';
$string['blogadministration'] = 'Blog kezelése';
$string['blogdeleteconfirm'] = 'Törli ezt a blogot?';
$string['blogdisable'] = 'A blogolás ki van kapcsolva!';
$string['blogentries'] = 'Blogüzenetek';
$string['blogentriesabout'] = 'Blogüzenetek {$a} témakörben';
$string['blogentriesbygroupaboutcourse'] = 'Blogüzenetek {$a->course} témakörben  {$a->group} részéről';
$string['blogentriesbygroupaboutmodule'] = 'Blogüzenetek {$a->mod} témakörben  {$a->group} részéről';
$string['blogentriesbyuseraboutcourse'] = 'Blogüzenetek {$a->course} témakörben  {$a->user} részéről';
$string['blogentriesbyuseraboutmodule'] = 'Blogüzenetek {$a->mod} témakörben {$a->user} részéről';
$string['blogentrybyuser'] = '{$} blogüzenete';
$string['blogpreferences'] = 'Blogbeállítások';
$string['blogs'] = 'Blogok';
$string['blogscourse'] = 'Kurzusblogok';
$string['blogssite'] = 'Portálblogok';
$string['blogtags'] = 'Blogcímkék';
$string['cannotviewcourseblog'] = 'Nincs engedélye a kurzus blogjainak megtekintéséhez';
$string['cannotviewcourseorgroupblog'] = 'Nincs engedélye a kurzus/csoport blogjainak megtekintéséhez';
$string['cannotviewsiteblog'] = 'Nincs engedélye a portál összes blogjának a megtekintéséhez';
$string['cannotviewuserblog'] = 'Nincs engedélye felhasználói blogok olvasáshoz';
$string['configexternalblogcrontime'] = 'Milyen gyakran ellenőrzi a Moodle, hogy érkeztek-e új külső blogüzenetek?';
$string['configmaxexternalblogsperuser'] = 'Egy felhasználó ennyi külső blogüzenetet kapcsolhat Moodle-blogjához.';
$string['configuseblogassociations'] = 'Blogüzenetek kurzusokhoz vagy kurzusmodulokhoz kapcsolásának engedélyezése';
$string['configuseexternalblogs'] = 'Bekapcsolja külső blogüzenetek felhasználói hozzáadását. A Moodle rendszeresen ellenőrzi ezeket az üzeneteket, az újakat pedig a felhasználó helyi blogjába másolja át.';
$string['courseblog'] = '{$a} kurzusblog';
$string['courseblogdisable'] = 'A kurzusblog nincs bekapcsolva';
$string['courseblogs'] = 'A felhasználók csak a kurzusban részt vevők számára írt blogüzeneteket láthatják';
$string['deleteblogassociations'] = 'Blogkapcsolatok törlése';
$string['deleteblogassociations_help'] = 'A blogüzenetek megmaradnak, de már nem kapcsolódnak a kurzushoz vagy annak tevékenységeihez és forrásaihoz.';
$string['deleteexternalblog'] = 'A külső blog törlése a bejegyzésből';
$string['deleteotagswarn'] = 'Biztosan eltávolítja ez(eke)t a címké(ke)t minden blogüzenetből és törli a rendszerből?';
$string['description'] = 'Leírás';
$string['description_help'] = 'Külső blogját összegző egy-két mondatos leírás. Ha üresen hagyja, a külső blogban meglévő leírás jelenik meg helyette.';
$string['disableblogs'] = 'A blogrendszer teljes kikapcsolása';
$string['donothaveblog'] = 'Önnek nincs saját blogja.';
$string['editentry'] = 'Blogüzenet szerkesztése';
$string['editexternalblog'] = 'A külső blogüzenet szerkesztése';
$string['emptybody'] = 'A blogüzenet törzse nem lehet üres';
$string['emptyrssfeed'] = 'A megadott URL nem mutat érvényes RSS-hírre.';
$string['emptytitle'] = 'A blogüzenet címe nem lehet üres';
$string['emptyurl'] = 'URL-t kell megadnia egy érvényes RSS-hírhez';
$string['entrybody'] = 'Blogüzenet törzse';
$string['entrybodyonlydesc'] = 'Üzenet leírása';
$string['entryerrornotyours'] = 'Ez nem az Ön üzenete';
$string['entrysaved'] = 'Az üzenet elmentése megtörtént';
$string['entrytitle'] = 'Üzenet címe';
$string['entryupdated'] = 'Blogüzenet frissítve';
$string['externalblogcrontime'] = 'Külső blog cronjának ütemezése';
$string['externalblogdeleteconfirm'] = 'Lekapcsolja ezt a külső blogot?';
$string['externalblogdeleted'] = 'Külső blog lekapcsolva';
$string['externalblogs'] = 'Külső blogok';
$string['feedisinvalid'] = 'A hír érvénytelen';
$string['feedisvalid'] = 'A hír érvényes';
$string['filterblogsby'] = 'Üzenetek szűrési szempontja...';
$string['filtertags'] = 'Címkék szűrése';
$string['filtertags_help'] = 'Ezzel szűrheti a használni kívánt üzeneteket. A külső blogból csak az itt megadott (vesszővel elválasztott) címkéknek megfelelő üzenetek átmásolására kerül sor.';
$string['groupblog'] = 'Csoportblog: {$a}';
$string['groupblogdisable'] = 'A csoportblog nincs bekapcsolva';
$string['groupblogentries'] = '{$a->coursename} témakörben {$a->groupname}
csoporthoz kapcsolódó blogüzenetek';
$string['groupblogs'] = 'A felhasználók csak a csoportban részt vevők blogüzeneteit láthatják';
$string['incorrectblogfilter'] = 'A megadott blogszűrő típusa hibás';
$string['intro'] = 'Az RSS-üzenet egy vagy több blogból automatikusan állt elő.';
$string['invalidgroupid'] = 'Érvénytelen csoportazonosító';
$string['invalidurl'] = 'Az URL-t nem lehet elérni.';
$string['linktooriginalentry'] = 'Kapcsolás az eredeti blogüzenethez';
$string['maxexternalblogsperuser'] = 'Külső blogok felhasználónkénti maximális száma';
$string['mustassociatecourse'] = 'Ha kurzus vagy csoporttagok számára teszi elérhetővé, az üzenethez kurzust kell kapcsolnia.';
$string['name'] = 'Név';
$string['name_help'] = 'Külső blogját leíró név. Ha üres, a külső blog címe jelenik meg.';
$string['noentriesyet'] = 'Itt nincsenek látható üzenetek';
$string['noguestpost'] = 'Vendégek nem írhatnak blogüzeneteket!';
$string['nopermissionstodeleteentry'] = 'Nincs engedélye a blogüzenet törléséhez.';
$string['norighttodeletetag'] = 'Ezt a címkét Ön nem törölheti: {$a}';
$string['nosuchentry'] = 'Nincs ilyen blogüzenet';
$string['notallowedtoedit'] = 'Ezt az üzenetet Ön nem szerkesztheti';
$string['numberofentries'] = 'Üzenetek: {$a}';
$string['numberoftags'] = 'Megjelenítendő címkék száma';
$string['page-blog-edit'] = 'Blogszerkesztő oldalak';
$string['page-blog-index'] = 'Bloglistázó oldalak';
$string['page-blog-x'] = 'Minden blogoldal';
$string['pagesize'] = 'Oldalankénti blogüzenetek száma';
$string['permalink'] = 'Permalink';
$string['personalblogs'] = 'A felhasználók csak saját blogjaikat láthatják';
$string['preferences'] = 'Beállítások';
$string['publishto'] = 'Közzéteendő itt';
$string['publishto_help'] = 'Három beállítás közül választhat:
**Csak én (piszkozat)** - A bejegyzést Önön kívül csak a rendszergazdák láthatják.
**A portálon bárki** - A bejegyzést minden portálra feliratkozott láthatja.
**A világon bárki** - A bejegyzést bárki, akár vendégek is láthatják.';
$string['publishtocourse'] = 'Kurzustársai';
$string['publishtocourseassoc'] = 'Kapcsolódó kurzustársak';
$string['publishtocourseassocparam'] = '{$a} kurzustársai';
$string['publishtogroup'] = 'Csoporttársai';
$string['publishtogroupassoc'] = 'Kapcsolódó kurzusbeli csoporttársak';
$string['publishtogroupassocparam'] = '{$a} csoporttársai';
$string['publishtonoone'] = 'Csak én (piszkozat)';
$string['publishtosite'] = 'A portálon bárki';
$string['publishtoworld'] = 'A világon bárki';
$string['readfirst'] = 'Olvassa el!';
$string['relatedblogentries'] = 'Kapcsolódó blogüzenetek';
$string['retrievedfrom'] = 'Forrás helye';
$string['rssfeed'] = 'RSS-hír blogja';
$string['searchterm'] = 'Keresés itt: {$a}';
$string['settingsupdatederror'] = 'Hiba történt, a blog beállításait nem lehetett frissíteni';
$string['siteblog'] = 'Portálblog: {$a}';
$string['siteblogdisable'] = 'A portálblog nincs bekapcsolva';
$string['siteblogs'] = 'A portál minden felhasználója minden blogüzenetet láthat';
$string['tagdatelastused'] = 'Címke utolsó használatának dátuma';
$string['tagparam'] = 'Címke: {$a}';
$string['tags'] = 'Címkék';
$string['tagsort'] = 'Címkék megjelenítésének rendezési szempontja';
$string['tagtext'] = 'Címkeszöveg';
$string['timefetched'] = 'Utolsó szinkronizálás időpontja';
$string['timewithin'] = 'Ennyi napon belül használt címkék megjelenítése';
$string['updateentrywithid'] = 'Üzenet frissítése';
$string['url'] = 'URL';
$string['url_help'] = 'Adja meg külső blogja RSS-hírének URL-jét.';
$string['useblogassociations'] = 'Blogkapcsolások engedélyezése';
$string['useexternalblogs'] = 'Külső blogok bekapcsolása';
$string['userblog'] = '{$a} felhasználói blog';
$string['userblogentries'] = '{$a} blogüzenetei';
$string['valid'] = 'Érvényes';
$string['viewallblogentries'] = '{$a} témakörben írt összes üzenet';
$string['viewallmodentries'] = '{$a->type} témakörben írt összes üzenet megtekintése';
$string['viewallmyentries'] = 'Összes üzenetem megtekintése';
$string['viewblogentries'] = '{$a->type} témakörben írt üzenetek';
$string['viewblogsfor'] = 'Összes ilyen üzenet megtekintése...';
$string['viewcourseblogs'] = 'Összes kurzusüzenet megtekintése';
$string['viewentriesbyuseraboutcourse'] = '{$a} összes kurzusüzenetének megtekintése';
$string['viewgroupblogs'] = 'Összes ilyen csoport üzenetének megtekintése...';
$string['viewgroupentries'] = 'Csoportüzenet';
$string['viewmodblogs'] = 'Összes ilyen modulüzenet megtekintése...';
$string['viewmodentries'] = 'Modulüzenetek';
$string['viewmyentries'] = 'Üzeneteim';
$string['viewmyentriesaboutcourse'] = 'Kurzusüzeneteim megtekintése';
$string['viewmyentriesaboutmodule'] = 'Üzeneteim megtekintése erről: {$a}';
$string['viewsiteentries'] = 'Összes üzenet megtekintése';
$string['viewuserentries'] = '{$a} összes üzenetének megtekintése';
$string['worldblogs'] = 'A bárki számára elérhetőként megjelölt blogüzeneteket mindenki elolvashatja';
$string['wrongpostid'] = 'Hibás blogüzenet-azonosító';
