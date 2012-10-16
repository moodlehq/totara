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
 * Strings for component 'filter_mediaplugin', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   filter_mediaplugin
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['fallbackaudio'] = 'Audiolinkki';
$string['fallbackvideo'] = 'Videolinkki';
$string['filtername'] = 'Multimediapluginit';
$string['flashanimation'] = 'Flash-animaatio';
$string['flashanimation_help'] = 'Tiedostot, joissa on pääte *.swf. Tietoturvasyistä tätä suodatinta käytetään vain luotetuissa teksteissä.';
$string['flashvideo'] = 'Flash-video';
$string['flashvideo_help'] = 'Tiedostot, joissa on pääte *.flv and *.f4v. Toistaa videoita käyttäen Flowplayeria, vaatii Flash pluginin ja javascriptin. Käyttää HTML 5 videota jos on määritelty useampia lähteitä.';
$string['html5audio'] = 'HTML 5 audio';
$string['html5audio_help'] = 'Äänitiedostot päättellä *.ogg, *.aac ja muut. Yhteensopiva vain uusimpien selainten kanssa, valitettavasti ei ole formaattia, jota kaikki selaimet tukisivat. Puutteen voi kiertää määrittämällä varasuunnitelmia risuaidalla # erotettuna (esim: http://example.org/audio.aac#http://example.org/audio.aac#http://example.org/audio.mp3#), QuickTime playeria käytetään varasuunnitelmana vanhoille selaimille, varasuunnitelma voi olla mikä tahansa äänitiedostotyyppi.';
$string['html5video'] = 'HTML 5 video';
$string['html5video_help'] = 'Videotiedostot päätteellä *.webm, *.m4v, *.ogv, *.mp4 sekä muut. Yhteensopiva vain uusimpien selainten kanssa, valitettavasti ei ole formaattia, jota kaikki selaimet tukisivat. Puutteen voi kiertää määrittämällä varasuunnitelmien lähteet risuaidalla # erotettuna (esim: http://example.org/video.m4v#http://example.org/video.aac#http://example.org/video.ogv#d=640x480), QuickTime playeria käytetään varasuunnitelmana vanhoille selaimille.';
$string['legacyheading'] = 'Legacy mediasoittimet';
$string['legacyheading_help'] = 'Seuraavia formaatteja ei suositella yleiseen käyttöön, niitä käytetään yleensä intranetasennuksissa, joissa on keskitetysti hallittavat asiakasohjelmat.';
$string['legacyquicktime'] = 'QuickTime soitin';
$string['legacyquicktime_help'] = 'Tiedostot, joissa on pääte *.mov, *.mp4, *.m4a, *.mp4 tai *.mpg. Vaativat QuickTime soittimen tai kodekit.';
$string['legacyreal'] = 'Real media player';
$string['legacyreal_help'] = 'Tiedostot, joissa on pääte *.rm, *.ra, *.ram, *.rp, *.rv. vaativat RealPlayerin.';
$string['legacywmp'] = 'Windows media player';
$string['legacywmp_help'] = 'Tiedostot, joissa on pääte *.avi ja *.wmv. Täysin yhteensopiva Internet Explorerin kanssa Windowsissa, ongelmia saattaa tulla muissa selaimissa tai käyttöjärjestelmissä.';
$string['mp3audio'] = 'MP3 audio';
$string['mp3audio_help'] = 'Tiedostot, joissa on pääte *.mp3. Toistaa audion käyttäen Flowplayeria, vaatii Flash pluginin.';
$string['sitevimeo'] = 'Vimeo';
$string['sitevimeo_help'] = 'Vimeo videonjakosivusto.';
$string['siteyoutube'] = 'YouTube';
$string['siteyoutube_help'] = 'YouTube videonjakosivusto, tuetaan video- ja soittolistalinkkejä.';
