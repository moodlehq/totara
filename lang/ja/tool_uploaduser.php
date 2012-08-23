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
 * Strings for component 'tool_uploaduser', language 'ja', branch 'MOODLE_22_STABLE'
 *
 * @package   tool_uploaduser
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['allowdeletes'] = '削除を許可する';
$string['allowrenames'] = 'リネームを許可する';
$string['allowsuspends'] = 'アカウントの利用停止および利用停止解除を許可する';
$string['csvdelimiter'] = 'CSVデリミタ';
$string['defaultvalues'] = 'デフォルト値';
$string['deleteerrors'] = '削除エラー';
$string['encoding'] = 'エンコーディング';
$string['errors'] = 'エラー';
$string['nochanges'] = '変更なし';
$string['pluginname'] = 'ユーザアップロード';
$string['renameerrors'] = 'リネームエラー';
$string['requiredtemplate'] = '必須項目です。あなたはここでテンプレート構文 (%l = 姓、%f = 名、%u = ユーザ名) を使用することができます。詳細および例に関して、ヘルプをご覧ください。';
$string['rowpreviewnum'] = 'プレビュー行';
$string['uploadpicture_baduserfield'] = '指定されたユーザ属性は有効ではありません。もう一度お試しください。';
$string['uploadpicture_cannotmovezip'] = '一時ディレクトリにZIPファイルを移動できません。';
$string['uploadpicture_cannotprocessdir'] = 'ZIP解凍されたファイルを処理できません。';
$string['uploadpicture_cannotsave'] = 'ユーザ {$a} の画像を保存できません。画像ファイルを確認してください。';
$string['uploadpicture_cannotunzip'] = '画像ファイルを解凍できません。';
$string['uploadpicture_invalidfilename'] = '画像ファイル {$a} のファイル名に無効な文字があります。スキップします。';
$string['uploadpicture_overwrite'] = '既存のユーザ画像を上書きしますか?';
$string['uploadpictures'] = 'ユーザ画像をアップロードする';
$string['uploadpictures_help'] = 'ZIP圧縮したイメージファイルをユーザ画像としてアップロードすることができます。イメージファイルは、「選択されたユーザ属性.拡張子」という形で名前付けをする必要があります。例えば、「user1234.jpg」はusernameが「user1234」のユーザ用となります。';
$string['uploadpicture_userfield'] = '画像にマッチさせるユーザ属性';
$string['uploadpicture_usernotfound'] = '「 {$a->userfield} 」の値が「 {$a->uservalue} 」のユーザは存在しません。スキップします。';
$string['uploadpicture_userskipped'] = 'ユーザ {$a} をスキップします (画像登録済みです)。';
$string['uploadpicture_userupdated'] = 'ユーザ {$a} の画像が更新されました。';
$string['uploadusers'] = 'ユーザをアップロードする';
$string['uploadusers_help'] = '<p>最初に、<strong>通常は大量ユーザをインポートする必要はありません</strong> - あなたの保守作業を減らすため、外部データベースへの接続またはユーザに新しいアカウントを作成できるようにしている等、認証方法が手動メンテナンスを必要としないようになっているか調査してください。詳細は管理メニューの認証セクションをご覧ください。</p>
<p>あなたが本当にテキストファイルから複数のユーザアカウントをインポートしたい場合、テキストファイルを次のフォーマットにしてください:</p>

<ul>
  <li>ファイルの各行に1レコードを記述します。</li>
  <li>それぞれのレコードをカンマ (またはデリミタ) で区切ります。</li>
  <li>最初のレコードは特別な意味を持ち、フィールド名一覧を含みます。これは残りのファイルのフォーマットを定義します。
    <blockquote>
      <p><strong>必須フィールド名:</strong> これらのフィールドは最初のレコードに記述し、ユーザごとに定義する必要があります。</p>
      <p>追加時に<code>firstname、lastname</code>または更新時に<code>username</code>を記述してください。</p>
      <p><strong>オプションフィールド名: </strong> これらのフィールドすべては完全に任意です。フィールドの値がファイルに存在する場合、その値が使用されます。そうでない場合、フィールドのデフォルト値が使用されます。</p>
      <p><code>institution, department, city, country, lang, auth, ajax, timezone, idnumber, icq, phone1, phone2, address, url, description, mailformat, maildisplay, htmleditor, autosubscribe, emailstop</code></p>
      <p><strong>カスタムプロファイルフィールド名 (任意):</strong> xxxxx は実際のカスタムユーザプロファイルフィールド名です (例 ユニークな省略名)。</p>
      <p><code>profile_field_xxxxx</code></p>
      <p><strong>特別フィールド名:</strong> ユーザ名の変更またはユーザの削除に使用されます。下記をご覧ください。</p>
      <p><code>deleted, oldusername</code></p>
      <p><strong>登録フィールド名 (任意): </strong> courseはコースの「コース省略名」です - 記述されている場合、学生はこれらのコースに登録されます。groupは対応するcourseのグループに関連付ける必要があります。typeはコース登録時に関連付けられるロールのタイプです。設定値「1」はデフォルトのコースロール、「2」は教師のレガシーロール、「3」は編集権のない教師のレガシーロールです。ロールを直接指定する代わりに、ロールフィールドを使用することができます - ロール省略名またはIDを使用してください (ロールの数字名はサポートされません)。ユーザをコースのグループに割り当てることもできます (course1のgroup1、course2のgroup2等)。グループはグループ名またはIDで指定することもできます (グループの数字名はサポートされません)。それぞれのコースの利用有効期間を日数で設定することもできます (course1のenrolperiod1、course2のenrolperiod2等)。</p>
      <p><code>course1, type1, role1, group1, enrolperiod1, course2, type2, role2, group2, enrolperiod2, etc.</code></p>
    </blockquote>
    </li>
  <li>データ中のカンマは &amp;#44 にエンコードしてください - エンコードされたものをスクリプトが自動的にカンマにデコードします。</li>
  <li>論理型フィールドには、falseの場合「0」を、trueの場合「1」を設定してください。</li>
</ul>
<p>下記は有効なインポートファイルの例です:</p>
<p><code>username, password, firstname, lastname, email, lang, idnumber, maildisplay, course1, group1, type1, enrolperiod1<br />
jonest, verysecret, Tom, Jones, jonest@someplace.edu, en_utf8, 3663737, 1, Intro101, Section 1, 1, 30<br />
reznort, somesecret, Trent, Reznor, reznort@someplace.edu, ja_utf8, 6736733, 0, Advanced202, Section 3, 3, 90
</code></p>

<h2>テンプレート</h2>
<p>次のコードには、テンプレートとしてデフォルト値が適用されます:</p>
<ul>
<li><code>%l</code>は、lastnameと置換されます。</li>
<li><code>%f</code>は、firstnameと置換されます。</li>
<li><code>%u</code>は、usernameと置換されます。</li>
<li><code>%%</code>は、% と置換されます。</li>
</ul>
<p>パーセント (%) および文字 (l、f、u) の間には次の修飾語句を使用することができます:</p>
<ul>
<li>マイナスサイン (-) - このコード文字が付けられた情報は、小文字に変換されます。</li>
<li>プラスサイン (+) - このコード文字が付けられた情報は、大文字に変換されます。</li>
<li>(~) チルダサイン - このコード文字が付けられた情報は、タイトルケースに変換されます。</li>
<li>10進数 - このコード文字が付加された情報は、指定された文字数に切り詰められます。</li>

</ul>

<p>例えば、firstnameがJohn、そしてlastnameがDoeの場合、指定されたテンプレートで次の値を取得することができます:</p>
<ul>
<li>%l%f = DoeJohn</li>
<li>%l%1f = DoeJ</li>
<li>%-l%+f = doeJOHN</li>
<li>%-f_%-l = john_doe</li>
<li>http://www.example.com/~%u/ = http://www.example.com/~jdoe/ (ユーザ名: jdoe または %-1f%-l を使用する場合)</li>
</ul>
<p>テンプレートは、デフォルト値のみで処理され、CSVファイルから検索された値では処理されません。</p>
<p>正確なMoodleユーザ名を生成するため、usernameは常に小文字に変換されます。さらに、サイトポリシーページで「ユーザ名に拡張文字を許可する」が無効にされている場合、文字、数字、ダッシュ (-) およびドット (.) と異なる文字は取り除かれます。例えば、firstnameが「John Jr.」、lastnameが「Doe」で「ユーザ名に拡張文字を許可する」が有効にされている場合、username %-f_%-l は「john jr._doe」を生成し、「ユーザ名に拡張文字を許可する」が無効にされている場合、「johnjr.doe」を生成します。</p>
<p>「新しいユーザ名の重複取り扱い」で「カウンタを追加する」が設定されている場合、テンプレートで生成されたユーザ名と重複しているユーザ名にオートインクリメント (自動増加) のカウンタが追加されます。例えば、CSVファイルが明確なユーザ名を含まず、ユーザの氏名「John Doe」「Jane Doe」「Jenny Doe」を含んでいるとします。デフォルトユーザ名が「%-1f%-l」および「新しいユーザ名の重複取り扱い」で「カウンタを追加する」が設定されている場合、生成されるユーザ名は「jdoe」「jdoe2」「jdoe3」となります。</p>

<h2>既存アカウントの更新</h2>
<p>あなたが新しいアカウントを作成するとMoodleは想定して、デフォルトでは既存のアカウントとユーザ名が合致するレコードをスキップします。しかし、「既存のアカウントを更新する」オプションを<b>Yes</b>にした場合、既存のユーザアカウントは更新されます。</p>

<p>既存のアカウントを更新する場合、ユーザ名を更新することもできます。「リネームを許可する」を<b>Yes</b>に設定して、ファイルに<code class="example1">oldusername</code>フィールドを入れてください。</p>

<p><b>警告:</b> 既存のアカウント更新時に発生したエラーは、ユーザに悪い影響を及ぼします。既存のアカウントを更新するオプションを使用するときは注意してください。</p>

<h2>アカウントの削除</h2>
<p><code>deleted</code>フィールドが存在している場合、値「1」が設定されたユーザは削除されます。この場合、<code>username</code>以外のフィールドは省略されます。</p>
<p>アカウントの削除およびアップロードは、単一のCSVファイルで実行することができます。例えば、次のファイルはユーザ「Tom Jones」を追加し、ユーザ「reznort」を削除します:</p>

<p><code>username, firstname, lastname, deleted<br />
jonest, Tom, Jones, 0<br />
reznort, , , 1
</code></p>';
$string['uploaduserspreview'] = 'アップロードユーザプレビュー';
$string['uploadusersresult'] = 'アップロードユーザ結果';
$string['useraccountupdated'] = 'ユーザが更新されました。';
$string['useraccountuptodate'] = '最新ユーザ';
$string['userdeleted'] = 'ユーザが削除されました。';
$string['userrenamed'] = 'ユーザがリネームされました。';
$string['userscreated'] = 'ユーザが作成されました';
$string['usersdeleted'] = 'ユーザが削除されました';
$string['usersrenamed'] = 'ユーザがリネームされました';
$string['usersskipped'] = 'ユーザがスキップされました';
$string['usersupdated'] = 'ユーザが更新されました';
$string['usersweakpassword'] = '弱いパスワードを持ったユーザ';
$string['uubulk'] = 'バルク処理の選択';
$string['uubulkall'] = 'すべてのユーザ';
$string['uubulknew'] = '新しいユーザ';
$string['uubulkupdated'] = '更新されたユーザ';
$string['uucsvline'] = 'CSV行';
$string['uulegacy1role'] = '(オリジナルの学生) タイプ=1';
$string['uulegacy2role'] = '(オリジナルの教師) タイプ=2';
$string['uulegacy3role'] = '(オリジナルの編集権限のない教師) タイプ=3';
$string['uunoemailduplicates'] = 'メールアドレスの重複を避ける';
$string['uuoptype'] = 'アップロードタイプ';
$string['uuoptype_addinc'] = 'すべてを追加する、必要に応じてユーザ名に番号を付加する';
$string['uuoptype_addnew'] = '新しいユーザのみ、既存のユーザをスキップする';
$string['uuoptype_addupdate'] = '新しいユーザの追加および既存のユーザを更新する';
$string['uuoptype_update'] = '既存のユーザのみ更新する';
$string['uupasswordcron'] = 'cronにより生成';
$string['uupasswordnew'] = '新しいユーザパスワード';
$string['uupasswordold'] = '既存のユーザパスワード';
$string['uustandardusernames'] = 'ユーザ名を標準化する';
$string['uuupdateall'] = 'ファイルおよびデフォルトでオーバーライドする';
$string['uuupdatefromfile'] = 'ファイルでオーバライドする';
$string['uuupdatemissing'] = '欠けているデータをファイルおよびデフォルトで補填する';
$string['uuupdatetype'] = '既存のユーザ詳細';
$string['uuusernametemplate'] = 'ユーザ名テンプレート';
