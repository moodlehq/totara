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
 * Strings for component 'filter_mediaplugin', language 'nl', branch 'MOODLE_22_STABLE'
 *
 * @package   filter_mediaplugin
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['fallbackaudio'] = 'Audio-link';
$string['fallbackvideo'] = 'Video-link';
$string['filtername'] = 'Multimedia plugins';
$string['flashanimation'] = 'Flash animatie';
$string['flashanimation_help'] = 'Bestanden met de extentie *.swf. Voor veiligheidsredenen zal deze filter enkel in vertrouwde teksten kunnen gebruikt worden.';
$string['flashvideo'] = 'Flash video';
$string['flashvideo_help'] = 'Bestanden met de extentie *.flv en *.f4v. Toont videoclips door Flowplayer te gebruiken. Dit vereist een Flash plugin en javascript. Gebruikt HTML5 video als meerdere bronnen opgegeven worden.';
$string['html5audio'] = 'HTML 5 audio';
$string['html5audio_help'] = 'Audiobestanden met de extentie *.ogg, *.aac en andere. Enkel compatibel met recente browsers. Er is jammer genoeg geen bestandsformaat dat ondersteund wordt door alle browsers.
Dit kan omzeilt worden door meerdere bestanden op te geven, gescheiden door een # (vb: http://example.org/audio.aac#http://example.org/audio.mp3#), QuickTime player wordt gebruikt voor oude browsers.';
$string['html5video'] = 'HTML 5 video';
$string['html5video_help'] = 'Videobestanden met extentie *.webm, *.m4v, *.ogv, *.mp4 en andere. Dit is enkel compatibel met recente browsers. Er is jammer genoeg geen bestandsformaat dat ondersteund wordt door alle browsers.
Dit kan omzeilt worden door meerdere bestanden op te geven, gescheiden door een # (vb: http://example.org/audio.m4v#http://example.org/audio.ogv#d=640x480), QuickTime player wordt gebruikt voor oude browsers.';
$string['legacyheading'] = 'Verouderde mediaspelers';
$string['legacyheading_help'] = 'Volgende bestandsformaten worden niet aangeraden voor algemeen gebruik. Ze worden meestal gebruikt in intranetinstallaties met centraal beheerde clients.';
$string['legacyquicktime'] = 'QuickTime player';
$string['legacyquicktime_help'] = 'Bestanden met extentie *.mov, *.mp4, *.m4a, *.mp4 and *.mpg. Vereist QuickTime player of codecs.';
$string['legacyreal'] = 'Real media player';
$string['legacyreal_help'] = 'Bestanden met extentie *.rm, *.ra, *.ram, *.rp, *.rv. Vereist RealPlayer.';
$string['legacywmp'] = 'Windows media player';
$string['legacywmp_help'] = 'Bestanden met extentie *.avi en *.wmv. Volledig compatibel met Internet Explorer in Windows, kan problematisch zijn in andere browsers of besturingssystemen.';
$string['mp3audio'] = 'MP3 audio';
$string['mp3audio_help'] = 'Bestanden met extentie *.mp3. Speelt audio via Flowplayer. Flash plugin vereist.';
$string['sitevimeo'] = 'Vimeo';
$string['sitevimeo_help'] = 'Vimeo site voor video delen.';
$string['siteyoutube'] = 'YouTube';
$string['siteyoutube_help'] = 'YouTube site voor video delen. Links naar video en afspeellijsten ondersteund.';
