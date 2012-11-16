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
 * Strings for component 'quiz_statistics', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   quiz_statistics
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['actualresponse'] = 'Konkrét válasz';
$string['allattempts'] = 'az összes próbálkozás';
$string['allattemptsavg'] = 'Az összes próbálkozás átlagos pontszáma';
$string['allattemptscount'] = 'Összes pontozott próbálkozás száma';
$string['analysisofresponses'] = 'Válaszok elemzése';
$string['analysisofresponsesfor'] = '{$a} válaszainak elemzése';
$string['attempts'] = 'Próbálkozások';
$string['attemptsall'] = 'az összes próbálkozás';
$string['attemptsfirst'] = 'az első próbálkozás';
$string['backtoquizreport'] = 'Vissza a fő statisztikai jelentés oldalára.';
$string['calculatefrom'] = 'Statisztika számítása ebből';
$string['cic'] = 'Belső konzisztencia együtthatója ({$a} esetén)';
$string['completestatsfilename'] = 'befejezett_statisztika';
$string['count'] = 'Darabszám';
$string['coursename'] = 'Kurzus neve';
$string['detailedanalysis'] = 'A kérdésre adott válaszok részletesebb elemzése';
$string['discrimination_index'] = 'Diszkriminációs index';
$string['discriminative_efficiency'] = 'Diszkriminációs hatékonyság';
$string['downloadeverything'] = 'A teljes jelentés letöltése mint';
$string['duration'] = 'Nyitva eddig';
$string['effective_weight'] = 'Tényleges súly';
$string['errordeleting'] = 'Hiba a régi {$a} rekordok törlése közben.';
$string['erroritemappearsmorethanoncewithdifferentweight'] = 'A kérdés ({$a}) a tesztben több helyen és eltérő súlyokkal szerepel. Ezt a statisztikai jelentés jelenleg nem támogatja, ezért az eredmény megbízhatatlan lehet.';
$string['errormedian'] = 'Hiba a medián kiszámítása közben.';
$string['errorpowerquestions'] = 'Hiba a kérdéspontokhoz tartozó variancia kiszámításához való adatok kinyerése   közben.';
$string['errorpowers'] = 'Hiba a tesztpontokhoz tartozó variancia kiszámításához való adatok kinyerése   közben.';
$string['errorrandom'] = 'Hiba a tétel alatti adatok kinyerése közben.';
$string['errorratio'] = 'Hibaarány ({$a} esetén)';
$string['errorstatisticsquestions'] = 'Hiba a kérdéspontokhoz statisztikájának kiszámításához való adatok kinyerése   közben.';
$string['facility'] = 'Eszközmutató';
$string['firstattempts'] = 'első próbálkozások';
$string['firstattemptsavg'] = 'Az első próbálkozások átlagos pontszáma';
$string['firstattemptscount'] = 'Befejezett  pontozott első próbálkozások száma';
$string['frequency'] = 'Gyakoriság';
$string['intended_weight'] = 'Tervezett súly';
$string['kurtosis'] = 'Pontszámeloszláshoz tartozó csúcsosság ({$a} esetén)';
$string['lastcalculated'] = 'Utolsó számítás {$a->lastcalculated} óta {$a->count} próbálkozás történt.';
$string['median'] = 'Medián pont ({$a} esetén)';
$string['modelresponse'] = 'Válaszminta';
$string['negcovar'] = 'A pont negatív kovarianciája az összes próbálkozás pontjával.';
$string['negcovar_help'] = 'A kérdésre adott pontszám a teszten végrehajtott próbálkozásokat illetően az összes próbálkozásra adott pontszámmal ellentétesen módosul. Vagyis az összes próbálkozásra adott pontszám rendszerint az átlag alatt marad, ha a kérdésre adott pontszám meghaladja az átlagot, és megfordítva.
Ez esetben a konkrét kérdés súlyának egyenlete nem számítható ki. A konkrét kérdés súlyának a teszt többi kérdéséhez viszonyított kiszámítása a kérdések tényleges kérdéssúlya, ha a negatív kovarianciájú kijelölt kérdések nulla maximális pontszámot kapnak.
Amikor tesztet szerkeszt és ezen negatív kovarianciájú kérdés(ek)nek nulla maximális pontszámot ad, akkor a kérdések tényleges kérdéssúlya nulla, a többi kérdés tényleges kérdéssúlya pedig a most kiszámított lesz.';
$string['nostudentsingroup'] = 'A csoportban még nincsenek tanulók.';
$string['optiongrade'] = 'Részkredit';
$string['pluginname'] = 'Statisztika';
$string['position'] = 'Helyzet';
$string['positions'] = 'Helyzet(ek)';
$string['questioninformation'] = 'Kérdés adatai';
$string['questionname'] = 'Kérdés neve';
$string['questionnumber'] = 'Kérdésszám';
$string['questionstatistics'] = 'Kérdésre vonatkozó statisztika';
$string['questionstatsfilename'] = 'kérdés_statisztika';
$string['questiontype'] = 'Kérdés típusa';
$string['quizinformation'] = 'Teszt adatai';
$string['quizname'] = 'Teszt neve';
$string['quizoverallstatistics'] = 'Tesztre vonatkozó átfogó statisztika';
$string['quizstructureanalysis'] = 'Tesztszerkezet elemzése';
$string['random_guess_score'] = 'Véletlen találgatás pontszáma';
$string['recalculatenow'] = 'Újraszámítás most';
$string['response'] = 'Válasz';
$string['skewness'] = 'Pontszámeloszláshoz tartozó aszimmetria ({$a} esetén)';
$string['standarddeviation'] = 'Szórás ({$a} esetén)';
$string['standarddeviationq'] = 'Szórás';
$string['standarderror'] = 'Standard hiba ({$a} esetén)';
$string['statistics'] = 'Statisztika';
$string['statistics:componentname'] = 'Statisztikai jelentés a tesztről';
$string['statistics:view'] = 'Statisztikai jelentés megtekintése';
$string['statisticsreport'] = 'Statisztikai jelentés';
$string['statisticsreportgraph'] = 'Kérdéshelyzetek statisztikája';
$string['statsfor'] = 'Tesztstatisztika ({$a} esetén)';
