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
 * Strings for component 'oublog', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   oublog
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['accessdenied'] = 'Az oldalt Ön nem tekintheti meg.';
$string['addcomment'] = 'Megjegyzés hozzáadása';
$string['addlink'] = 'Ugrópont hozzáadása';
$string['addpost'] = 'Blogbejegyzés  hozzáadása';
$string['allowcomments'] = 'Megjegyzések engedélyezése';
$string['allowcomments_help'] = '"Belépett felhasználóktól" - a bloghoz hozzáférő felhasználóktól fogad el megjegyzéseket.
"Mindenkitől" - a bloghoz hozzáférő felhasználóktól és másoktól egyaránt fogad el megjegyzéseket.. Kap majd egy e-mailt, mely alapján jóváhagyhatja vagy elutasíthatja a nem belépett felhasználóktól érkező megjegyzéseket.
"Nem" - megakadályozza, hogy bárki megjegyzést fűzzön ehhez a bejegyzéshez.';
$string['allowcommentsmax'] = 'Megjegyzések engedélyezése (ha a bejegyzéshez kapcsolódik)';
$string['atom'] = 'Atom';
$string['atomfeed'] = 'Atomhír';
$string['attachments'] = 'Mellékletek';
$string['blogfeed'] = 'Bloghírek';
$string['bloginfo'] = 'Blogadatok';
$string['blogname'] = 'Blog címe';
$string['blogoptions'] = 'Blog beállításai';
$string['blogsummary'] = 'Blog összegzése';
$string['comment'] = 'Megjegyzés hozzáadása';
$string['commentonby'] = 'Megjegyzés <u>{$a->author}</u> <u>{$a->title}</u> blogjához';
$string['comments'] = 'Megjegyzések';
$string['commentsby'] = '{$a} megjegyzései';
$string['commentsfeed'] = 'Csak megjegyzések';
$string['commentsnotallowed'] = 'Nem fűzhetők hozzá megjegyzések';
$string['completioncomments'] = 'A felhasználó köteles a blogbejegyzésekhez megjegyzéseket hozzáfűzni';
$string['completioncommentsgroup'] = 'Megjegyzések előírása';
$string['completioncommentsgroup_help'] = 'Bekapcsolása esetén a blog akkor kap egy tanuló esetén "teljesített" megjelölést, amikor a megadott számú megjegyzést hozzáfűzte.';
$string['completionposts'] = 'A felhasználó köteles blogbejegyzéseket készíteni:';
$string['completionpostsgroup'] = 'Blogbejegyzések előírása';
$string['completionpostsgroup_help'] = 'Bekapcsolása esetén a blog akkor kap egy tanuló esetén "teljesített" megjelölést, amikor a megadott számú bejegyzést elkészítette.';
$string['computingguide'] = 'Útmutató OU-blogokhoz';
$string['computingguideurl'] = 'Számítástechnikai útmutató URL-je';
$string['computingguideurlexplained'] = 'Adja meg az OU-blogok számítástechnikai útmutatójának URL-jét.';
$string['confirmdeletecomment'] = 'Biztosan törli ezt a megjegyzést?';
$string['confirmdeletelink'] = 'Biztosan törli ezt az ugrópontot?';
$string['confirmdeletepost'] = 'Biztosan törli ezt a blogbejegyzést?';
$string['couldnotaddcomment'] = 'A megjegyzést nem sikerült hozzáadni.';
$string['couldnotaddlink'] = 'Az ugrópontot nem sikerült hozzáadni.';
$string['defaultpersonalblogname'] = '{$a} blogja';
$string['delete'] = 'Törlés';
$string['deletedby'] = '{$a->timedeleted} időpontban törölte {$a->fullname},';
$string['deleteglobalblog'] = 'A globális blogot nem törölheti.';
$string['details'] = 'Részletek';
$string['displayversion'] = 'OU-blog verziója: <strong>{$a}</strong>';
$string['downloadas'] = 'Adatletöltés módja';
$string['edit'] = 'Szerkesztés';
$string['editlink'] = 'Ugrópont szerkesztése';
$string['editonsummary'] = 'Szerkesztés ideje: {$a->editdate}';
$string['editpost'] = 'Blogbejegyzés frissítése';
$string['editsummary'] = '{$a->editdate} időpontban szerkesztette {$a->editby}';
$string['error_alreadyapproved'] = 'A megjegyzés jóváhagyása/elutasítása már megtörtént';
$string['error_grouppubliccomments'] = 'Nyilvános megjegyzéseket csoportos üzemmódú blog esetén nem engedélyezhet.';
$string['error_moderatednotallowed'] = 'Moderált megjegyzésekre ezen a blogon vagy blogbejegyzésen már nincs lehetőség.';
$string['error_noconfirm'] = 'Írja be a fenti félkövér szöveget a szövegmezőbe, pontosan a megadott alakban.';
$string['error_toomanycomments'] = 'Túl sok blogmegjegyzést írt az elmúlt órában erről az internetes címről. ÍVárjon egy kicsit, majd próbálja újra.';
$string['error_unspecified'] = 'A rendszer nem tudja teljesíteni ezt a kérést, mert hiba történt ({$a})';
$string['error_wrongkey'] = 'A megjegyzés kulcsa hibás.';
$string['externaldashboardadd'] = 'Blog hozzáadása a műszerfalhoz';
$string['externaldashboardremove'] = 'Blog eltávolítása a műszerfalról';
$string['extranavolderposts'] = 'Korábbi bejegyzések: {$a->from}-{$a->to}';
$string['extranavtag'] = 'Címke: {$a}';
$string['feedhelp'] = 'Hírek';
$string['feedhelp_help'] = 'Ha híreket használ felvehet ugrópontokat az Atomhoz vagy az RSS-hez annak érdekében, hogy naprakész legyen a blogot illetően. A legtöbb hírolvasó támogatja az RSS és az Atom használatát. Ha a blog megengedi a megjegyzések használatát, akkor használhat "Csak megjegyzések" számára szóló híreket..';
$string['feeds'] = 'Hírek';
$string['feedsnotenabled'] = 'A Hírek nincs bekapcsolva';
$string['foruser'] = '{$a} részére';
$string['globalblogmissing'] = 'Nincs globális blog';
$string['gradesupdated'] = 'Osztályozás frissítve';
$string['guestblog'] = 'Ha van fiókja, <a href=\'{$a}\'>jelentkezzen be a blog használatához</a>.';
$string['individualblogs'] = 'Egyedi blogok';
$string['individualblogs_help'] = '**Nem (blog együtt vagy csoportosan):** *Egyedi blogok nem használatosak* - nincs beállítva egyedi blog, mindenki része egy nagyobb közösségnek (a "Csoportos üzemmód" beállításától függően).
** Külön egyedi blogok:** *Az egyedi blogok magánhasználatban vannak* - Az egyes felhasználók csak küldhetnek bejegyzéseket és saját blogjaikat tekinthetik meg, kivéve, ha rendelkeznek ("viewindividual") engedéllyel más egyedi blogok megtekintéséhez.
** Látható egyedi blogok:** *Az egyedi blogok nyilvánosak* - az egyes felhasználók csak saját blogjaikba küldhetnek bejegyzést, de megtekinthetnek egyéb egyedi blogbejegyzéseket.';
$string['invalidblog'] = 'Egyedi blog azonosítója';
$string['invalidblogdetails'] = 'A(z)  {$a} blogbejegyzés részletei nem találhatók.';
$string['invalidcomment'] = 'Érvénytelen azonosító a megjegyzéshez';
$string['invalidedit'] = 'Érvénytelen azonosító a szerkesztéshez';
$string['invalidformat'] = 'A formátumnak atomnak vagy rss-nek kell lenni.';
$string['invalidlink'] = 'A formátumnak atomnak vagy rss-nek kell lenni.';
$string['invalidpost'] = 'Érvénytelen bejegyzés-azonosító';
$string['invalidpostid'] = 'Érvénytelen bejegyzés-azonosító';
$string['invalidvisbilitylevel'] = 'Érvénytelen {$a} láthatósági szint';
$string['invalidvisibility'] = 'Érvénytelen láthatósági szint';
$string['lastcomment'] = '(legfrissebb beküldője {$a->fullname}, {$a->timeposted})';
$string['links'] = 'Kapcsolódó ugrópontok';
$string['logincomments'] = 'Igen, bejelentkezett felhasználóktól';
$string['maxvisibility'] = 'Maximális láthatóság';
$string['maxvisibility_help'] = '*Személyes blog esetén:* **Csak a blog tulajdonosa számára látható (magán)** - senki más nem tekintheti meg a bejegyzést.
*Kurzusblog esetén:* **A kurzus résztvevői számára látható** -, a bejegyzés megtekintéséhez hozzáféréssel kell rendelkezni a bloghoz, ami általában úgy érhető el, hogy felveszi a hozzá kapcsolódó kurzust.
**Bejelentkezettek számára látható** - mindenki, aki bejelentkezett, megtekintheti a bejegyzést, még akkor is, ha nem vette föl a kurzust.
**Mindenki számára látható** - bármely internet-felhasználó megtekintheti a bejegyzést, ha ismeri a blog címét.
Ez választható a teljes blogra vagy az egyedi bejegyzésekre. Ha a teljes blogra van beállítva, akkor az lesz a maximum. Például ha a teljes blog az első szintre van beállítva, akor az egyedi bejegyzés szintjét egyáltalán nem tudja megváltoztatni.';
$string['maybehiddenposts'] = 'A blog tartalmazhat csak bejelentkezett felhasználók számára látható, vagy általuk kommentálható bejegyzéseket. Ha van fiókja, <a href=\'{$a}\'>jelentkezzen be a blog teljes eléréséhez</a>.';
$string['message'] = 'Üzenet';
$string['moderated_addedcomment'] = 'Köszönjük a megjegyzést, amely csak akkor jelenik meg, ha a bejegyzés szerzője jóváhagyta.';
$string['moderated_approve'] = 'Megjegyzés jóváhagyása';
$string['moderated_authorname'] = 'Neve';
$string['moderated_awaiting'] = 'Jóváhagyásra váró megjegyzések';
$string['moderated_confirm'] = 'Megerősítés';
$string['moderated_confirmvalue'] = 'igen';
$string['searchthisblog_help'] = 'Írja be a keresendő kifejezést és nyomja meg az Entert vagy kattintson a gombra. Pontos kifejezésre idézőjelekkel kereshet. A keresésből egy szót kötőjel szó elé írásával zárhat ki.
Példa: a Picasso -szobor "korai munkái" kereső kifejezés "Picasso" vagy a "korai munkái" találatait adja vissza, de kizárja a "szobor" szót tartalmazó kifejezéseket.';
$string['unsupportedbrowser'] = '<p> Az Ön böngészője nem tudja megjeleníteni az Atom vagy az RSS híreit. </p><p> A hírek külön számítógépes programok vagy weboldalak esetén hasznosak. Ha a hírt ilyen programban szeretné használni, másolja be a címet a böngésző címsorába. </p>';
$string['visibility_help'] = '**Kurzusrésztvevők számára látható** - az üzenet megtekintéséhez a bloghoz hozzáféréssel kell rendelkeznie, ami általában biztosítható azzal, hogy felvette a bloghoz kapcsolódó kruzust.
**Bejelentkezettek számára látható** - Mindenki, aki bejelentkezett, megtekintheti az üzenetet, akkor is, ha nem vette fel a kurzust.
**MIndenki számára látható** - Bármely internet-felhasználó láthatja az üzenetet, ha tudja a blog címét.';
