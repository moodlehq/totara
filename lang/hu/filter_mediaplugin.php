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
 * Strings for component 'filter_mediaplugin', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   filter_mediaplugin
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['fallbackaudio'] = 'Audió kapcsolása';
$string['fallbackvideo'] = 'Videó kapcsolása';
$string['filtername'] = 'Multimédia segédprogramok';
$string['flashanimation'] = 'Flash animáció';
$string['flashanimation_help'] = '*.swf kiterjesztésű fájlok. Biztonsági okokból ez a szűrő csak megbízható források esetén használható.';
$string['flashvideo'] = 'Flash videó';
$string['flashvideo_help'] = '*.flv és *.f4v kiterjesztésű fájlok. Videoklipek lejátszása Flowplayerrel, Flash segédprogram és javascript segítségével. HTML 5 alapvideót használ, ha több forrás van megadva.';
$string['html5audio'] = 'HTML 5 audio';
$string['html5audio_help'] = '*.ogg, *.acc és más kiterjesztésű hangállományok. Csak a legújabb böngészőkkel használható. Nincs olyan böngésző, amely minden formátumot támogat. Megoldás lehet, ha alapeseteket ad meg egymástól # jellel elválasztva (pl.: http://example.org/audio.acc#http://example.org/audio.acc#http://example.org/audio.mp3#). Régi böngészőknél az alapmegoldás a QuickTime lejátszó, amely bármilyen audiotípust kezel.';
$string['html5video'] = 'HTML 5 video';
$string['html5video_help'] = '*.webm, *.m4v, *.ogv, *.mp4 és más kiterjesztésű videoállományok. Csak a legújabb böngészőkkel használható. Nincs olyan böngésző, amely minden formátumot támogat. Megoldás lehet, ha alapeseteket ad meg egymástól # jellel elválasztva (pl.: http://example.org/video.m4v#http://example.org/video.acc#http://example.org/video.ogv#d=640x480). Régi böngészőknél az alapmegoldás a QuickTime player.';
$string['legacyheading'] = 'Korábbi médialejátszók';
$string['legacyheading_help'] = 'Az alábbi formátumok általános használata nem ajánlott, intranetes környezetben, központilag kezelt kliensgépek esetén lehet megfelelő.';
$string['legacyquicktime'] = 'QuickTime player';
$string['legacyquicktime_help'] = '*.mov, *.mp4, *.m4a, *.mp4 és *.mpg kiterjesztésű fájlok. A QuickTime player lejátszóra és kodekekre van szükség.';
$string['legacyreal'] = 'Real media player';
$string['legacyreal_help'] = '*.rm, *.ra, *.ram, *.rp, *.rv kiterjesztésű fájlok. A RealPlayer kell hozzá.';
$string['legacywmp'] = 'Windows media player';
$string['legacywmp_help'] = '*.avi és *.wmv kiterjesztésű fájlok. Teljesen kompatibilis az Internet Explorerrel Windows alatt, Más böngészők és iperációs rendszerek esetén gondot okozhat.';
$string['mp3audio'] = 'MP3 audió';
$string['mp3audio_help'] = '*.mp3 kiterjesztésű fájlok. Hangállományok lejátszása Flowplayerrel, kell hozzá a Flash segédprogram.';
$string['sitevimeo'] = 'Vimeo';
$string['sitevimeo_help'] = 'Vimeo videomegosztó portál.';
$string['siteyoutube'] = 'YouTube';
$string['siteyoutube_help'] = 'YouTube videomegosztó portál, lejátszási listák támogatása.';
