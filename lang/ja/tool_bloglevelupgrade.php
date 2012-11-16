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
 * Strings for component 'tool_bloglevelupgrade', language 'ja', branch 'MOODLE_22_STABLE'
 *
 * @package   tool_bloglevelupgrade
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['bloglevelupgradedescription'] = '<p>このサイトはMoodle 2.0にアップグレードされました。</p><p>2.0にてブログ可視性は単純にされましたが、あなたのサイトはまだ古い可視性タイプを使用しています。</p><p>あなたのサイトのブログエントリに関してコースベースまたはグループベースの可視性を保持するには、それぞれのコースに受講登録したユーザが投稿したブログエントリをコピーするための特別な「ブログ」タイプのフォーラムを作成する以下のアップグレードスクリプトを実行する必要があります。</p><p>アップグレードスクリプトの実行後、ブログは完全にサイトレベルに移行されます。アップグレード処理によりブログエントリが削除されることはありません。</p><p>あなたは<a href="{$a->fixurl}">ブログレベルアップグレードページ</a>にてスクリプトを実行することができます。</p>';
$string['bloglevelupgradeinfo'] = '2.0にてブログ可視性は単純にされましたが、あなたのサイトはまだ古い可視性タイプを使用しています。あなたのサイトのブログエントリに関してコースベースまたはグループベースの可視性を保持するには、それぞれのコースに受講登録したユーザが投稿したブログエントリをコピーするための特別な「ブログ」タイプのフォーラムを作成する以下のアップグレードスクリプトを実行する必要があります。アップグレードスクリプトの実行後、ブログは完全にサイトレベルに移行されます。アップグレード処理によりブログエントリが削除されることはありません。';
$string['bloglevelupgradeprogress'] = 'コンバージョン進捗状況: レビュー済みユーザ = {$a->userscount} / コンバージョン済みエントリ数 = {$a->blogcount}';
$string['pluginname'] = 'ブログ可視性アップグレード';
