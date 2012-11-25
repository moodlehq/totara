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
 * Strings for component 'filter_mediaplugin', language 'ja', branch 'MOODLE_22_STABLE'
 *
 * @package   filter_mediaplugin
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['fallbackaudio'] = 'オートリンク';
$string['fallbackvideo'] = 'ビデオリンク';
$string['filtername'] = 'マルチメディアプラグイン';
$string['flashanimation'] = 'Flahsアニメーション';
$string['flashanimation_help'] = '拡張子 *.swf のファイルです。セキュリティ上の理由から、このフィルタは信用されるテキストのみに使用されます。';
$string['flashvideo'] = 'Flashビデオ';
$string['flashvideo_help'] = '拡張子 *.flv および *.f4v のファイルです。Flowplayerを使用してビデオクリップを再生します。FlashプラグインおよびJavaスクリプトが必要です。複数ソースが指定された場合、HTML 5ビデオフォールバックが使用されます。';
$string['html5audio'] = 'HTML 5オーディオ';
$string['html5audio_help'] = '拡張子 \*.ogg、\*.acc等のオーディオファイルです。最新のブラウザのみに互換性があります。残念ですが、すべてのブラウザでサポートされるわけではありません。代替策として、# で区切ったフォールバックを指定することができます (例: http://example.org/audio.acc#http://example.org/audio.acc#http://example.org/audio.mp3#)。古いブラウザのフォールバックとして、QuickTimeプレイヤーが使用されます。フォールバックにはすべてのオーディオタイプを指定することができます。';
$string['html5video'] = 'HTML 5ビデオ';
$string['html5video_help'] = '拡張子 \*.webm、\*.m4v、\*.ogv、\*.mp4等のオーディオファイルです。最新のブラウザのみに互換性があります。残念ですが、すべてのブラウザでサポートされるわけではありません。代替策として、# で区切ったフォールバックを指定することができます (例: http://example.org/video.m4v#http://example.org/video.acc#http://example.org/video.ogv#d=640x480)。古いブラウザのフォールバックとして、QuickTimeプレイヤーが使用されます。';
$string['legacyheading'] = 'レガシーメディアプレイヤー';
$string['legacyheading_help'] = '一般的な使用に対して、次のフォーマットは推奨されません。これらのフォーマットは、イントラネット内に設置された中央で管理されたクライアントに使用されます。';
$string['legacyquicktime'] = 'QuickTimeプレイヤー';
$string['legacyquicktime_help'] = '拡張子 \*.mov、\*.mp4、\*.m4a、\*.mp4 および *.mpg のファイルです。 QuickTimeプレイヤーまたはコーデックを必要とします。';
$string['legacyreal'] = 'Realメディアプレイヤー';
$string['legacyreal_help'] = '拡張子 *.rm, \*.ra、\*.ram、\*.rp、\*.rv のファイルです。 Realプレイヤーを必要とします。';
$string['legacywmp'] = 'Windowsメディアプレイヤー';
$string['legacywmp_help'] = '拡張子 *.avi および *.wmv のファイルです。WindowsのInternet Explorerに完全互換します。恐らく、他のブラウザまたはオペレーティングシステムにおいて、問題が生じる可能性があります。';
$string['mp3audio'] = 'MP3オーディオ';
$string['mp3audio_help'] = '拡張子 *.mp3 のファイルです。Flowplayerを使用して再生します。Flashプラグインを必要とします。';
$string['sitevimeo'] = 'Vimeo';
$string['sitevimeo_help'] = 'Vimeoビデオ共有サイトです。';
$string['siteyoutube'] = 'YouTube';
$string['siteyoutube_help'] = 'YouTubeビデオ共有サイトです。ビデオおよびプレイリストリンクがサポートされています。';
