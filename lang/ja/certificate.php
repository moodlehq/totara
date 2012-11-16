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
 * Strings for component 'certificate', language 'ja', branch 'MOODLE_22_STABLE'
 *
 * @package   certificate
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addlinklabel'] = '別のリンクされた活動オプションを追加する';
$string['addlinktitle'] = '別のリンクされた活動オプションを追加するにはクリックしてください';
$string['awarded'] = '授与されました';
$string['awardedto'] = '次に授与されました';
$string['back'] = '戻る';
$string['border'] = 'ボーダー';
$string['borderblack'] = '黒';
$string['borderblue'] = '青';
$string['borderbrown'] = '茶色';
$string['bordercolor'] = 'ボーダーライン';
$string['bordergreen'] = '緑';
$string['borderlines'] = 'ライン';
$string['borderstyle'] = 'ボーダーイメージ';
$string['certificate'] = '修了証書コードの検証：';
$string['certificate:manage'] = '修了証書を管理する';
$string['certificate:printteacher'] = '教師を記載する';
$string['certificate:student'] = '修了証書を取得する';
$string['certificate:view'] = '修了証書を表示する';
$string['certificatename'] = '修了証書名';
$string['certificatereport'] = '修了証書レポート';
$string['certificatesfor'] = '次の修了証書';
$string['certificatetype'] = '修了証書タイプ';
$string['code'] = 'コード';
$string['course'] = '次のため';
$string['coursegrade'] = 'コース評定';
$string['coursename'] = 'コース';
$string['credithours'] = '単位時間';
$string['customtext'] = 'カスタムテキスト';
$string['date'] = 'オン';
$string['datefmt_help'] = '**日付の記載**

修了証書に日付を記載するには日付のフォーマットを選択してください。';
$string['datehelp'] = '日付';
$string['delivery_help'] = '**配信**

ここでは学生への修了証書の配信方法を選択します。
**ブラウザで開く：**修了証書をブラウザの新しいウィンドウで開きます。
**ダウンロード：**ブラウザのダウンロードウィンドウが開いてファイルをダウンロードします。**（注意：**Internet Explorer はこのオプションをサポートしていません。最初に保存オプションを選択する必要があります。）
**Eメールに添付：**Eメールの添付文書として学生に修了証書を送信します。
学生が修了証書を受け取った後で修了証書へのリンクを再度クリックすると、修了証書受領の日付を表示できます。また受け取った修了証書を見直すこともできます。';
$string['designoptions'] = 'デザインオプション';
$string['download'] = 'ダウンロードを強制する';
$string['emailcertificate'] = 'Eメール（保存も選択してください！）';
$string['emailothers'] = '他の人にEメールする';
$string['emailothers_help'] = '**他の人へのメール通知**

学生が修了証書を受け取ったことを簡潔なメッセージで他の人にも通知したい場合は、その人たちのEメールアドレスをここに入力してください。アドレスとアドレスの間はカンマ（,）で区切ってください。';
$string['emailstudenttext'] = '添付文書は{$a->course}の修了証書です。';
$string['emailteachermail'] = '{$a->student}が次の修了証書を受信しました：{$a->course}の\'{$a->certificate}\'

この修了証書は以下の場所で確認できます：

{$a->url}';
$string['emailteachermailhtml'] = '{$a->student}が次の修了証書を受信しました：{$a->course}の\'<i>{$a->certificate}</i>\'

この修了証書は以下の場所で確認できます：

<a href="{$a->url}">Certificate Report</a>';
$string['emailteachers'] = '教師にメールを送信する';
$string['emailteachers_help'] = '**教師へのメール通知**

これを有効にすると、学生が修了証書を受け取った時に教師にも簡潔な通知メールが送られます。';
$string['entercode'] = '検証する修了証書コードを入力してください：';
$string['getcertificate'] = '修了証書を取得する';
$string['grade'] = '評定';
$string['gradedate'] = '評定の日付';
$string['gradefmt_help'] = '**評定のフォーマット**

修了証書に評定を記載する場合、利用できるフォーマットには3種類あります：

**パーセンテージ評定：**評定をパーセンテージで記載します。**
ポイント評定：**評定をポイント数で記載します。
**文字評定：**パーセンテージ評定を文字で記載します。文字評定の値はtype/certificate.phpでカスタマイズできます。';
$string['gradeletter'] = '文字評定';
$string['gradepercent'] = 'パーセンテージ評定';
$string['gradepoints'] = 'ポイント評定';
$string['incompletemessage'] = '修了証書をダウンロードするには、まず必要な活動をすべて完了する必要があります。コースに戻りコースワークを完了してください。';
$string['intro'] = 'イントロダクション';
$string['issued'] = '発行されました';
$string['issueoptions'] = '発行オプション';
$string['lockingoptions'] = 'ロックのオプション';
$string['modulename'] = '修了証書';
$string['modulenameplural'] = '修了証書';
$string['mycertificates'] = 'マイ修了証書';
$string['nocertificatesreceived'] = 'はコースいかなる修了証書も受信していません。';
$string['nogrades'] = '取得できる評定はありません';
$string['notapplicable'] = 'N/A';
$string['notfound'] = '修了証書番号を認証できませんでした。';
$string['notissued'] = '受信されていません';
$string['notissuedyet'] = 'まだ発行されていません';
$string['notreceived'] = 'あなたはこの修了証書を受信していません';
$string['openbrowser'] = '新しいウィンドウで開く';
$string['opendownload'] = 'あなたの修了証書をコンピュータに保存するには下にあるボタンをクリックしてください。';
$string['openemail'] = '下にあるボタンをクリックすると、あなたの修了証書がEメールの添付文書としてあなたに送信されます。';
$string['openwindow'] = '修了証書をブラウザの新しいウィンドウで開くには、下にあるボタンをクリックしてください。';
$string['printdate'] = '日付を記載する';
$string['printdate_help'] = '**日付の記載**

「日付を記載する」を選択するとこの日付が記載されます。コース終了日を選択する場合は、コース設定で日付の幅を有効にしコース終了日を指定する必要があります。コース終了日を選択しない場合は、受け取りの日付が記載されます。また、活動が評定された日付を記載するという選択もできます。ただし修了証書の発行が活動の評定日よりも前になる場合は、受け取りの日付が記載されます。
修了証書にいったん日付が記載されると、type/certificate.phpファイルを自分でカスタマイズした場合を除きこの日付を変更することはできなくなりますのでご注意ください。';
$string['printerfriendly'] = '印刷用ページ';
$string['printgrade'] = '評定を記載する';
$string['printhours'] = '単位時間を記載する';
$string['printhours_help'] = '**単位時間の記載**

ここには修了証書に記載する単位時間を入力してください。';
$string['printnumber_help'] = '**コード番号の記載**

修了証書には任意の文字と番号からなるユニークな10桁のコードを記載することができます。その場合、教師の"発行された修了証書を表示する"レポートに表示されるコード番号に対して、この番号を照合することができます。';
$string['printoutcome'] = '結果を記載する';
$string['printseal'] = '標章またはロゴイメージ';
$string['printsignature'] = '署名イメージ';
$string['printteacher'] = '教師の名前を記載する';
$string['printteacher_help'] = '**教師の記載**

修了証書に教師の名前を記載するには、モジュールレベルで教師のロールをセットしてください。この操作が必要なのは、例えば、コースに複数の教師がいる場合や、1つのコースで複数の修了証書をもらうにあたりそれぞれの修了証書に違う教師の名前を記載したい場合などです。修了証書の編集ページを開き「ローカルに割り当てるロール」タブをクリックします。そこで（教師の編集のセクションで）修了証書に教師のロールを割り当ててください（これはコースの教師でなくてもかまいません。誰でもこのロールに割り当てることができます）。修了証書にはここで入力した名前が記載されます。';
$string['printwmark'] = '透かし模様イメージ';
$string['receivedcerts'] = '修了証書を受信しました';
$string['receiveddate'] = '受信日';
$string['report'] = 'レポート';
$string['reportcert_help'] = '**レポート修了証書**

ここで「はい」を選択すると、この修了証書の受け取りの日付、コード番号、コース名がユーザの修了証書レポートに表示されます。この修了証書に評定を記載する選択をすると、評定も修了証書レポートに表示されます。';
$string['reviewcertificate'] = 'あなたの修了証書をもう一度見る';
$string['sigline'] = 'ライン';
$string['textoptions'] = 'テキストオプション';
$string['to'] = '授与される者';
$string['validate'] = '検証する';
$string['verifycertificate'] = '修了証書を検証する';
$string['viewcertificateviews'] = '{$a} 発行の修了証書を表示する';
$string['viewed'] = 'この修了証書の受信日：';
$string['viewtranscript'] = '修了証書を表示する';
