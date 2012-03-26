<?php
// hierarchy.php - created with Totara langimport script version 1.1

$string['additionaloptions'] = '追加オプション';
$string['allframeworks'] = 'すべてのフレームワーク';
$string['alltypes'] = 'すべてのタイプ';
$string['assign'] = '割り当てる';
$string['availablex'] = '利用可能 {$a}';
$string['bulkactions'] = 'バルク処理';
$string['bulkaddfailed'] = 'それらのアイテムを階層に追加している間に問題が発生しました';
$string['bulkaddsuccess'] = '{$a} アイテムが階層に正常に追加されました';
$string['bulktypechanges'] = 'バルク再分類';
$string['bulktypechangesdesc'] = '次のタイプのすべてのアイテムを再分類する：';
$string['cancelwithoutassigning'] = '割り当てせずに取り消す';
$string['changetype'] = 'タイプを変更する';
$string['child'] = '子';
$string['children'] = '子';
$string['choosewhattodowithdata'] = 'カスタムフィールドデータの扱い方を選択してください：';
$string['clearsearch'] = '検索を消去する';
$string['clearselection'] = '選択を消去する';
$string['confirmmoveitems'] = '{$a->num} {$a->items}を"{$a->parentname}"に移動してもよろしいですか?<br /><br />{$a->items}を移動すると、そのどの子も同時に移動されます。';
$string['confirmproceed'] = '続行しますか？';
$string['confirmtypechange'] = 'アイテムを再分類しデータを移動／削除する';
$string['currenttype'] = '現在のタイプ';
$string['customfields'] = 'カスタムフィールド';
$string['datainx'] = '{$a}のデータ:';
$string['deletecheckdepth'] = 'この深さレベルを完全に削除しても本当によろしいですか？';
$string['deletechecktype'] = 'このタイプを削除しても本当によろしいですか？';
$string['deletedataconfirmproceed'] = '新規クラスにはカスタムフィールドがないため、これにより以下のカスタムフィールド:{$a}に関係するすべてのデータが削除されます。データを新規タイプに移転したい場合は、再分類する前に新規タイプに適切なカスタムフィールドを作成してください。続行してもよろしいですか？';
$string['deleteddepth'] = '深さレベル{$a} が削除されました。';
$string['deletedepthhaschildren'] = 'この深さレベルにはアイテムがあるため、削除できません。';
$string['deletedepthnosuchdepth'] = '不良の深さレベルIDです。もう一度お試しください。';
$string['deletedepthnotdeepest'] = 'この深さレベルは、このフレームワークにそれより下の深さレベルがあるため、削除できません。';
$string['deletedtype'] = 'タイプ"{$a}"が削除されました。';
$string['deleteselectedx'] = '選択した{$a}を削除する';
$string['deletethisdata'] = 'このデータを削除する';
$string['deletetypenosuchtype'] = '不良のタイプIDです。もう一度お試しください。';
$string['depth'] = '深さ{$a}';
$string['depths'] = '深さ';
$string['displayoptions'] = '表示オプション';
$string['enternamesoneperline'] = '{$a} の名前を入力する（列ごとに1つ）';
$string['error:alreadyassigned'] = 'あなたは既にこのフィールドにデータを割り当てています。';
$string['error:badsortorder'] = 'その{$a} を移動できませんでした。ソート順序に問題があります。';
$string['error:cannotconvertfieldfromxtoy'] = '"{$a->from}"フィールドは"{$a->to}"フィールドに変換できません。';
$string['error:cannotmoveparentintochild'] = '"{$a->item}"をそのチャイルドである"{$a->newparent}"に移動することはできません';
$string['error:checkvariable'] = 'チェック変数が間違っています。もう一度お試しください';
$string['error:couldnotmoveitem'] = 'その{$a} を移動することができませんでした。データベースのアップデート中にエラーが発生しました。';
$string['error:couldnotmoveitemnopeer'] = 'その{$a} を移動することができませんでした。同じ深さレベルにある隣接アイテムは交換できません。';
$string['error:couldnotreclassifybulk'] = 'アイテムを"{$a->from}"から"{$a->to}"に再分類している間に問題が発生しました。';
$string['error:couldnotreclassifyitem'] = 'そのアイテムを"{$a->from}"から"{$a->to}"に再分類している間に問題が発生しました。';
$string['error:couldnotupgradehierarchyduetobaddata'] = '不良なデータ({$a})のために階層をアップグレードすることができませんでした';
$string['error:deletedepthcheckvariable'] = 'チェック変数が間違っています。もう一度お試しください';
$string['error:deletetypecheckvariable'] = 'チェック変数が間違っています。もう一度お試しください';
$string['error:failedbulkmove'] = 'それらのアイテムの移動中に問題が発生しました';
$string['error:hierarchyprefixnotfound'] = '階層接頭辞{$a} が見つかりませんでした';
$string['error:hierarchytypenotfound'] = '階層タイプ{$a} が見つかりませんでした';
$string['error:invaliditemid'] = '無効なアイテムID';
$string['error:invalidparentformove'] = 'アイテムを移動しようとしている場所は存在しません';
$string['error:nodeletescaleinuse'] = '使用中の尺度を削除することはできません。この尺度を削除するには、いかなるフレームワークにも割り当てられていてはいけません。';
$string['error:nodeletescalevalueinuse'] = '使用中の尺度の尺度値を削除することはできません。この尺度値を削除するには、尺度がいかなるフレームワークにも割り当てられていてはいけません。';
$string['error:noframeworksfound'] = '1つまたは複数の深さレベルを持つ{$a} フレームワークが見つかりません。';
$string['error:noitemsselected'] = '選択されたアイテムがありません';
$string['error:nonedeleted'] = '選択された{$a}のどれも削除することができませんでした';
$string['error:nonefoundbulk'] = '変換するそのタイプのアイテムはありません';
$string['error:nonefounditem'] = 'アイテムは指定されたタイプに属してはいないようです';
$string['error:noreorderscaleinuse'] = '使用中の尺度を並べ替えることはできません。この尺度を並べ替えるには、いかなるフレームワークにも割り当てられていてはいけません。';
$string['error:norestorefiles'] = '{$a}から復元するファイルは見つかりません';
$string['error:restoreerror'] = '次の復元プロセスの実行中にエラーが発生しました: {$a}';
$string['error:somedeleted'] = '可能性のある{$a->marked_for_deletion} {$a->items}のうち唯一{$a->actually_deleted}のみ削除することができました';
$string['error:typenotfound'] = '{$a} タイプが見つかりませんでした';
$string['error:unknownaction'] = '不明な操作';
$string['export'] = 'エクスポート';
$string['exportcsv'] = 'CSVフォーマットでエクスポートする';
$string['exportexcel'] = 'Excelフォーマットでエクスポートする';
$string['exportods'] = 'ODSフォーマットでエクスポートする';
$string['exporttext'] = 'テキストフォーマットでエクスポートする';
$string['exportxls'] = 'Excelフォーマットでエクスポートする';
$string['filterframework'] = 'フレームワークによるフィルタ：';
$string['frameworkdoesntexist'] = '{$a} フレームワークは存在しません';
$string['hidden'] = '非表示';
$string['hidecustomfields'] = 'カスタムフィールドを非表示にする';
$string['hidedetails'] = '詳細を非表示にする';
$string['hierarchybackup'] = '階層バックアップ';
$string['hierarchyrestore'] = '階層復元';
$string['mandatory'] = '強制';
$string['missingframeworkname'] = 'フレームワーク名が欠けています';
$string['missingtypename'] = 'タイプ名が欠けています';
$string['moveselectedxto'] = '選択した{$a}を次へ移動する:';
$string['newtype'] = '新しいタイプ';
$string['nocustomfields'] = 'カスタムフィールドがありません';
$string['nodata'] = 'カスタムフィールドデータがありません';
$string['nopathfoundforid'] = '{$a->prefix}ID{$a->id}のパスが見つかりません';
$string['nopermviewhiddenframeworks'] = '隠しフレームワークを表示する権限がありません';
$string['noresultsfor'] = '"{$a->query}"の結果は見つかりませんでした。';
$string['noresultsforinframework'] = 'フレームワーク"{$a->framework}"に"{$a->query}"の結果は見つかりませんでした。';
$string['noresultsforsearchx'] = '検索"{$a}"の結果は見つかりませんでした';
$string['noxfound'] = '{$a}は見つかりませんでした';
$string['optional'] = '任意';
$string['parentchildselectedwarningdelete'] = '注意：あなたはアイテムを選択し、またそのアイテムの子も1つ選択しました。アイテムを削除すると、そのどの子もすべて自動的に削除されます。アイテムの子を保持したい場合は、アイテムを削除する前にそれを移動してください。';
$string['parentchildselectedwarningmove'] = '警告：あなたはアイテムとともにそのアイテムの子も移動する選択をしました。アイテムを移動すると、その子もすべて自動的に移動されます。';
$string['pickaframework'] = 'フレームワークを選ぶ';
$string['pickfilehelp'] = '復元したいファイルが利用可能でない場合は、階層バックアップの.zipファイルが{$a}に保存されているかどうか、また権限が正しく設定されているかどうかを確認してください。';
$string['pickfilemultiple'] = '復元するファイルを選ぶ';
$string['pickfileone'] = 'ファイルが1つ見つかりました。ファイル{$a}を復元したいですか？';
$string['queryerror'] = 'クエリのエラーが発生しました。結果は見つかりませんでした。';
$string['reclassify1of2bulk'] = '{$a->num} {$a->items}の再分類 - 手順全2中の1';
$string['reclassify1of2desc'] = '新規タイプを選択する';
$string['reclassify1of2item'] = '{$a->name}の再分類 - 手順全2中の1';
$string['reclassifyingfromxtoybulk'] = '{$a->num} {$a->items}を"{$a->from}"から"{$a->to}"へ再分類';
$string['reclassifyingfromxtoyitem'] = '"{$a->name}"を"{$a->from}"から"{$a->to}"へ再分類';
$string['reclassifyitems'] = 'アイテムを再分類する';
$string['reclassifyitemsanddelete'] = 'アイテムを再分類してデータを削除する';
$string['reclassifyitemsandtransfer'] = 'アイテムを再分類してデータを移転／削除する';
$string['reclassifysuccessbulk'] = '{$a->num} {$a->items} が"{$a->from}"から"{$a->to}"へ再分類されました';
$string['reclassifysuccessitem'] = '"{$a->name}"が"{$a->from}"から"{$a->to}"へ再分類されました';
$string['reclassifytransferdata'] = '手順2ではカスタムフィールドデータを移転する機会があります。';
$string['restore'] = 'リストア';
$string['restorenousers'] = '復元するユーザが見つかりませんでした。';
$string['restoreusers'] = '復元する{$a}ユーザが見つかりました。';
$string['restoreusersanddata'] = 'ユーザとユーザデータを復元する';
$string['searchavailable'] = '利用可能なアイテムを検索する';
$string['selected'] = '選択されました';
$string['selecteditems'] = '選択されたアイテム';
$string['selectedx'] = '選択された{$a}';
$string['selectframeworks'] = '復元したいフレームワークを選択する';
$string['showdepthfullname'] = '深さの正式名を表示する';
$string['showdetails'] = '詳細を表示する';
$string['showdisplayoptions'] = '表示オプションを表示する';
$string['showingxofyforsearchz'] = '{$a->allcount}の{$a->filteredcount}を検索"{$a->query}"のために表示。';
$string['showitemfullname'] = 'アイテムの正式名を表示する';
$string['showtypefullname'] = 'タイプの正式名を表示する';
$string['switchframework'] = 'フレームワークを切り替える：';
$string['top'] = 'トップ';
$string['transfertox'] = '{$a} に移転する';
$string['type'] = 'タイプ';
$string['unclassified'] = '未分類';
$string['xandychild'] = '{$a->item} (および {$a->num} 子)';
$string['xandychildren'] = '{$a->item} (および {$a->num} 子)';
$string['xitemsdeleted'] = '{$a->num} {$a->items} およびすべての子が削除されました';
$string['xitemsmoved'] = '{$a->num} {$a->items} およびすべての子が移動しました';
$string['achieved'] = '達成しました';
$string['addassignedcompetencies'] = 'コンピテンシーを割り当てる';
$string['addassignedcompetencytemplates'] = 'コンピテンシーテンプレートを割り当てる';
$string['addcourseevidencetocompetencies'] = 'コンピテンシーにコースエビデンスを追加する';
$string['addcourseevidencetocompetency'] = 'コンピテンシーにコースエビデンスを追加する';
$string['adddepthlevel'] = '新規深さレベルの追加';
$string['addedcompetency'] = 'コンピテンシー"{$a}"が追加されました';
$string['competencyaddedframework'] = 'コンピテンシーフレームワーク"{$a}"が追加されました';
$string['addmultiplenewcompetency'] = '複数コンピテンシーを追加する';
$string['addnewcompetency'] = '新しいコンピテンシーを追加する';
$string['competencyaddnewframework'] = '新しいコンピテンシーフレームワークを追加する';
$string['addnewscalevalue'] = '新しい尺度値を追加する';
$string['addnewtemplate'] = '新しいコンピテンシーテンプレートを追加する';
$string['addtype'] = '新しいタイプを追加する';
$string['aggregationmethod'] = '集約方法';
$string['aggregationmethod1'] = 'すべて';
$string['aggregationmethod2'] = 'いかなる';
$string['aggregationmethod3'] = 'オフ';
$string['aggregationmethod4'] = 'ユニット';
$string['aggregationmethod5'] = 'フラクション';
$string['aggregationmethod6'] = '加重されたものの合計';
$string['aggregationmethod7'] = '加重されたものの平均';
$string['aggregationmethodview'] = '{$a} 集約方法';
$string['allcompetencyscales'] = 'すべてのコンピテンシー尺度';
$string['assigncompetencies'] = 'コンピテンシーを割り当てる';
$string['assigncompetency'] = 'コンピテンシーを割り当てる';
$string['assigncompetencytemplate'] = 'コンピテンシーテンプレートを割り当てる';
$string['assigncompetencytemplates'] = 'コンピテンシーテンプレートを割り当てる';
$string['assigncoursecompletion'] = 'コース完了を割り当てる';
$string['assigncoursecompletions'] = 'コース完了を割り当てる';
$string['assigncoursecompletiontocompetencies'] = 'コース完了をコンピテンシーに割り当てる';
$string['assigncoursecompletiontocompetency'] = 'コース完了をコンピテンシーに割り当てる';
$string['assignedcompetencies'] = '割り当てられたコンピテンシー';
$string['assignedcompetenciesandtemplates'] = '割り当てられたコンピテンシーおよびコンピテンシーテンプレート';
$string['assignedcompetencytemplates'] = '割り当てられたコンピテンシーテンプレート';
$string['assignedonly'] = '割り当てられましたが使用されていません';
$string['assignnewcompetency'] = '新しいコンピテンシーを割り当てる';
$string['assignnewevidenceitem'] = '新しいエビデンスアイテムを追加する';
$string['assignrelatedcompetencies'] = '関連するコンピテンシーを割り当てる';
$string['competencybacktoallframeworks'] = 'すべてのコンピテンシーフレームワークに戻る';
$string['bulkdeletecompetency'] = 'コンピテンシーの一括削除';
$string['bulkmovecompetency'] = 'コンピテンシーの一括移動';
$string['cannotupdatedisplaysettings'] = '表示設定をアップデートできませんでした';
$string['changeto'] = '変更先';
$string['clickfornonjsform'] = 'このフォームのJavaスクリプト以外のバージョンはここをクリックしてください';
$string['clicktoassign'] = 'コンピテンシーを選択するには割り当てボタンをクリックしてください。';
$string['clicktoassigntemplate'] = 'コンピテンシーテンプレートを選択するには割り当てボタンをクリックしてください。';
$string['clicktoviewchildren'] = '子コンピテンシーを表示するには（該当する場合）、コンピテンシー名をクリックしてください';
$string['competencies'] = 'コンピテンシー';
$string['competenciesusedincourse'] = 'コースで使用されているコンピテンシー';
$string['competency'] = 'コンピテンシー';
$string['competencyaddnew'] = '新しいコンピテンシーを追加する';
$string['competencycustomfields'] = 'カスタムフィールド';
$string['competencydepthcustomfields'] = 'コンピテンシーの深さカスタムフィールド';
$string['competencydepthlevelview'] = 'コンピテンシーの深さレベル表示';
$string['competencyevidence'] = 'コンピテンシーエビデンス';
$string['competencyframework'] = 'コンピテンシーフレームワーク';
$string['competencyframeworkmanage'] = 'フレームワークを管理する';
$string['competencyframeworks'] = 'コンピテンシーフレームワーク';
$string['competencyframeworkview'] = 'フレームワークを表示する';
$string['competencymanage'] = 'コンピテンシーを管理する';
$string['competencyplural'] = 'コンピテンシー';
$string['competencyscale'] = 'コンピテンシー尺度';
$string['competencyscaleassign'] = 'コンピテンシー尺度';
$string['competencyscaleinuse'] = 'この尺度は使用中です（つまり、ユーザがこの尺度の値でマークされたコンピテンシーをもっています）。尺度値はデータの整合性を保つため作成、再整理、削除することはできません。尺度値の名前を変えることはできますが、警告なしにその熟達度を変更した場合、ユーザを混乱させる恐れがあります。';
$string['competencyscales'] = 'コンピテンシー尺度';
$string['competencytemplatemanage'] = 'テンプレートを管理する';
$string['competencytemplates'] = 'コンピテンシーテンプレート';
$string['competencytypecustomfields'] = 'コンピテンシータイプカスタムフィールド';
$string['competencytypes'] = 'コンピテンシータイプ';
$string['competencytypeview'] = 'コンピテンシータイプの表示';
$string['competent'] = 'コンポーネント';
$string['competentwithsupervision'] = '監督付きでコンピテント';
$string['couldnotdeletescalevalue'] = 'その尺度値の削除中に問題が発生しました';
$string['createdon'] = '作成日';
$string['createnewcompetency'] = '新しいコンピテンシーを作成する';
$string['competencycreatetype'] = 'コンピテンシータイプ「 {$a} 」が作成されました。';
$string['currentlyselected'] = '現在選択されています';
$string['defaultvalue'] = 'デフォルト値';
$string['competencydeletecheck'] = 'このコンピテンシーとそのすべての子コンピテンシー、およびそこに含まれるデータを完全に削除しても本当によろしいですか？';
$string['competencydeletecheck11'] = 'コンピテンシー"{$a}"を削除してもよろしいですか?
<br /><br />
これにより以下のデータが削除されます:<br />
- "{$a}"コンピテンシー';
$string['deletecheckframework'] = 'フレームワーク"{$a}"を削除してもよろしいですか?';
$string['deletecheckscale'] = 'このコンピテンシー尺度を完全に削除しても本当によろしいですか?';
$string['deletecheckscalevalue'] = 'このコンピテンシー尺度値を削除しても本当によろしいですか?';
$string['deletechecktemplate'] = 'このコンピテンシーテンプレートを削除しても本当によろしいですか?';
$string['competencydeletecheckwithchildren'] = 'コンピテンシー"{$a->itemname}"およびその{$a->children_string}を削除してもよろしいですか?<br /><br />
これにより以下のデータが削除されます: <br />
- "{$a->itemname}"コンピテンシーおよびその{$a->childcount} {$a->children_string}';
$string['deletecompetency'] = 'コンピテンシーを削除する';
$string['deletedcompetency'] = 'コンピテンシー{$a} およびその子が完全に削除されました。';
$string['deletedcompetencyscale'] = 'コンピテンシー尺度"{$a}"が完全に削除されました。';
$string['deletedcompetencyscalevalue'] = 'コンピテンシー尺度値"{$a}"が削除されました。';
$string['deletedepth'] = '{$a} を削除する';
$string['competencydeletedframework'] = 'コンピテンシーフレームワーク"{$a}"およびそのデータが完全に削除されました。';
$string['deletedtemplate'] = 'コンピテンシーテンプレート{$a} およびそのデータが完全に削除されました。';
$string['competencydeletedtype'] = 'コンピテンシータイプ"{$a}"が完全に削除されました。';
$string['deleteframework'] = '{$a} を削除する';
$string['deleteincludexcustomfields'] = '- {$a} カスタムフィールドレコード';
$string['deleteincludexevidence'] = '- {$a} アイテムのエビデンス';
$string['deleteincludexrelatedcompetencies'] = '- 関連するコンピテンシーへの{$a} リンク';
$string['deleteincludexuserstatusrecords'] = '- {$a} ユーザのステータスレコード';
$string['competencydeletemulticheckwithchildren'] = '{$a->num} competency/competenciesおよび{$a->childcount} {$a->children_string}を削除してもよろしいですか?
<br /><br />
これにより以下のデータが削除されます: <br />
- The {$a->num} competency/competenciesおよび{$a->childcount} {$a->children_string}';
$string['deletetype'] = 'タイプ"{$a}"を削除する';
$string['depthlevel'] = '深さレベル';
$string['depthlevels'] = '深さレベル';
$string['descriptionview'] = '説明';
$string['editcompetency'] = 'コンピテンシーを編集する';
$string['editdepthlevel'] = '深さレベルを編集する';
$string['competencyeditframework'] = 'コンピテンシーフレームワークを編集する';
$string['editgeneric'] = '{$a} を編集する';
$string['editscalevalue'] = '尺度値を編集する';
$string['edittemplate'] = 'コンピテンシーテンプレートを編集する';
$string['edittype'] = 'タイプを編集する';
$string['error:addcompetency'] = 'コンピテンシー"{$a}"の追加中に問題が発生しました';
$string['error:compevidencealreadyexists'] = 'このユーザは選択されたコンピテンシーのためのコンピテンシーエビデンスを既にもっています。あなたは<a href=\'edit.php?id={$a}\'>既存のコンピテンシーを編集する</a>か、または別のコンピテンシーを追加することができます。';
$string['error:couldnotdeletescale'] = 'コンピテンシー尺度「 {$a} 」の削除中に問題が発生しました。';
$string['competencyerror:createtype'] = 'コンピテンシータイプ「 {$a} 」の作成中にエラーが発生しました。';
$string['competencyerror:deletedframework'] = 'コンピテンシーフレームワーク「 {$a} 」およびデータの削除中にエラーが発生しました。';
$string['competencyerror:deletedtype'] = 'コンピテンシータイプ「 {$a} 」の削除中にエラーが発生しました。';
$string['error:dialognolinkedcourseitems'] = 'このフレームワークには、リンクされたコースが割り当てられているコンピテンシーはありません';
$string['competencyerror:dialognotreeitems'] = 'このフレームワークにコンピテンシーはありません';
$string['error:evidencealreadyexists'] = 'そのユーザとコンピテンシーには既にレコードが存在するため、新規コンピテンシーエビデンスを作成できませんでした';
$string['error:nodeletecompetencyscaleassigned'] = 'そのコンピテンシー尺度は既に1つまたは複数のフレームワークに割り当てられているため、削除することはできません';
$string['error:nodeletecompetencyscaleinuse'] = 'そのコンピテンシー尺度は使用中であるため、削除することはできません';
$string['error:nodeletecompetencyscalevaluedefault'] = 'その尺度値はデフォルトであるため、削除することはできません';
$string['error:nodeletecompetencyscalevalueonlyprof'] = 'その尺度値はこの尺度における唯一の熟達値であるため、削除することはできません。別の値を熟達値としてマークしてから削除してください';
$string['error:onescalevaluemustbeproficient'] = 'いつでも少なくとも1つの尺度値が熟達としてマークされていなければなりません。この値のチェックを外す前に別の尺度値を熟達に設定してください。';
$string['error:scaledetails'] = '尺度の詳細を取得中にエラーが発生しました。';
$string['error:updatecompetency'] = 'コンピテンシー"{$a}"をアップデート中に問題が発生しました';
$string['competencyerror:updatetype'] = 'コンピテンシータイプ"{$a}"をアップデート中にエラーが発生しました';
$string['evidence'] = 'エビデンス';
$string['evidenceactivitycompletion'] = '活動の完了';
$string['evidencecount'] = 'エビデンスアイテム';
$string['evidencecoursecompletion'] = 'コースの完了';
$string['evidencecoursegrade'] = 'コース評定';
$string['evidenceitemremovecheck'] = 'このエビデンスアイテムを"{$a}"から削除しても本当によろしいですか?';
$string['evidenceitems'] = 'エビデンスアイテム';
$string['competencyfeatureplural'] = 'コンピテンシー';
$string['competencyframework'] = 'コンピテンシーフレームワーク';
$string['competencyframeworks'] = 'コンピテンシーフレームワーク';
$string['competencyfullname'] = 'コンピテンシーの正式名';
$string['fullnamedepth'] = '深さレベルの正式名';
$string['fullnameframework'] = '正式名';
$string['fullnametemplate'] = 'テンプレートの正式名';
$string['fullnametype'] = 'タイプの正式名';
$string['fullnameview'] = '正式名';
$string['globalsettings'] = 'グローバル設定';
$string['competencyidnumber'] = 'コンピテンシーのIDナンバー';
$string['idnumberframework'] = 'IDナンバー';
$string['idnumberview'] = 'IDナンバー';
$string['includecompetencyevidence'] = 'コンピテンシーエビデンスを含める';
$string['invalidevidencetype'] = '無効なエビデンスタイプ';
$string['invalidnumeric'] = '数値は数（またはセットでない）でなければなりません';
$string['itemstoadd'] = '追加するアイテム';
$string['linkcourses'] = 'コースをリンクする';
$string['linktoscalevalues'] = 'このコンピテンシー尺度の尺度値を表示／編集するには、<a href="view.php?id={$a}&amp;type=competency">ここをクリック</a>してください。';
$string['linktoscalevalues11'] = 'このコンピテンシー尺度の尺度値を表示／編集するには、<a href="view.php?id={$a}&amp;prefix=competency">ここをクリック</a>してください。';
$string['locatecompetency'] = 'コンピテンシーを位置づける';
$string['locatecompetencytemplate'] = 'コンピテンシーテンプレートを位置づける';
$string['managecompetencies'] = 'コンピテンシーを管理する';
$string['managecompetency'] = 'コンピテンシーを管理する';
$string['managecompetencytypes'] = 'タイプを管理する';
$string['missingfullname'] = 'コンピテンシーの正式名が欠けています';
$string['missingfullnamedepth'] = '深さレベルの正式名が欠けています';
$string['missingfullnameframework'] = 'フレームワークの正式名が欠けています';
$string['missingfullnametemplate'] = 'テンプレートの正式名が欠けています';
$string['missingfullnametype'] = 'タイプの正式名が欠けています';
$string['competencymissingname'] = 'コンピテンシー名が欠けています';
$string['competencymissingnameframework'] = 'コンピテンシーフレームワーク名が欠けています';
$string['missingnametemplate'] = 'テンプレート名が欠けています';
$string['competencymissingnametype'] = 'コンピテンシータイプ名が欠けています';
$string['missingscale'] = '尺度が欠けています';
$string['missingscalevaluename'] = '尺度値名が欠けています';
$string['competencymissingshortname'] = 'コンピテンシーの省略名が欠けています';
$string['missingshortnamedepth'] = '深さレベルの省略名が欠けています';
$string['missingshortnameframework'] = 'フレームワークの省略名が欠けています';
$string['missingshortnametemplate'] = 'テンプレートの省略名が欠けています';
$string['missingshortnametype'] = 'タイプの省略名が欠けています';
$string['name'] = '名前';
$string['noassignedcompetencies'] = '割り当てられたコンピテンシーはありません';
$string['noassignedcompetenciestotemplate'] = 'このテンプレートに割り当てられたコンピテンシーはありません';
$string['noassignedcompetencytemplates'] = '割り当てられたコンピテンシーテンプレートはありません';
$string['nochildcompetencies'] = '子コンピテンシーはありません';
$string['nochildcompetenciesfound'] = '子コンピテンシーが見つかりません';
$string['nocompetenciesinframework'] = 'このフレームワークにコンピテンシーはありません';
$string['nocompetency'] = '定義されたコンピテンシーはありません';
$string['nocompetencyscales'] = 'コンピテンシーフレームワークを定義するには、まず値をもつコンピテンシー尺度を少なくとも1つ定義しなければなりません。';
$string['nocoursecompetencies'] = 'コースコンピテンシーはありません';
$string['nocoursesincat'] = 'そのカテゴリーにコースは見つかりません';
$string['nodepthlevels'] = 'このフレームワークに深さレベルはありません';
$string['noevidenceitems'] = 'このコンピテンシーにセットアップされたエビデンスアイテムはありません';
$string['noevidencetypesavailable'] = 'このコースに利用可能なエビデンスタイプはありません';
$string['competencynoframeworks'] = '定義されたコンピテンシーフレームワークはありません';
$string['competencynoframeworkssetup'] = 'このサイトにセットアップされたコンピテンシーフレームワークはありません　';
$string['nonsensicalproficientvalues'] = '警告：あなたはこの尺度で熟達値を非熟達値の下に置いています。尺度は熟達度の最も高いものをトップに、最も低いものをボトムに順序づけられている必要があります。';
$string['norelatedcompetencies'] = '関連するコンピテンシーはありません';
$string['noscalesdefined'] = '定義された尺度はありません';
$string['noscalevalues'] = 'この尺度に定義された尺度値はありません';
$string['notcompetent'] = 'コンピテントではありません';
$string['notemplate'] = '定義されたコンピテンシーテンプレートはありません';
$string['notemplateinframework'] = 'このフレームワークに定義されたコンピテンシーテンプレートはありません';
$string['notescalevalueentry'] = '列ごとに1つの値－最もコンピテントなものから最もそうでないものへ';
$string['notypelevels'] = 'このフレームワークにタイプはありません';
$string['competencynotypes'] = 'コンピテンシータイプはありません';
$string['numericalvalue'] = '数値';
$string['options'] = 'オプション';
$string['parent'] = '親';
$string['positions'] = 'ポジション';
$string['proficiency'] = '熟達度';
$string['competencyscaleproficient'] = '熟達値';
$string['proficientvaluefrozen'] = '尺度が使用中であるためこの設定を変更することはできません';
$string['proficientvaluefrozenonlyprof'] = '尺度には常に少なくとも1つの熟達値がなければならないため、この設定を変更することはできません';
$string['relatedcompetencies'] = '関連するコンピテンシー';
$string['relateditemremovecheck'] = 'このコンピテンシー関係を削除しても本当によろしいですか？';
$string['removedcompetencyevidenceitem'] = '<i>{$a}</i>エビデンスアイテムおよびそのデータが削除されました';
$string['removedcompetencyrelateditem'] = 'コンピテンシー<i>{$a}</i>はもはやこのコンピテンシーに関係していません';
$string['removedcompetencytemplatecompetency'] = 'コンピテンシー<i>{$a}</i>はもはやこのテンプレートに割り当てられていません';
$string['competencyreturntoframework'] = 'コンピテンシーフレームワークに戻る';
$string['scaleadded'] = 'コンピテンシー尺度"{$a}"が追加されました';
$string['scaledefaultupdated'] = '尺度のデフォルト値がアップデートされました';
$string['scaledeleted'] = 'コンピテンシー尺度"{$a}"が削除されました';
$string['scales'] = '尺度';
$string['scaleupdated'] = 'コンピテンシー尺度"{$a}"がアップデートされました';
$string['scalevalueadded'] = 'コンピテンシー尺度値"{$a}"が追加されました';
$string['competencyscalevalueidnumber'] = '尺度値のID番号';
$string['competencyscalevaluename'] = '尺度値の名前';
$string['competencyscalevaluenumericalvalue'] = '尺度意の数値';
$string['scalevalues'] = '尺度値';
$string['scalevalueupdated'] = 'コンピテンシー尺度値"{$a}"がアップデートされました';
$string['scalex'] = '尺度"{$a}"';
$string['selectacompetencyframework'] = 'コンピテンシーフレームワークを選択する';
$string['selectcategoryandcourse'] = 'コースのカテゴリーを選択し、エビデンスアイテムを選ぶコースを選択してください';
$string['selectedcompetencies'] = '選択されたコンピテンシー：';
$string['selectedcompetencytemplates'] = '選択されたコンピテンシーテンプレート：';
$string['set'] = 'セット';
$string['competencyshortname'] = 'コンピテンシー省略名';
$string['shortnamedepth'] = '深さレベルの省略名';
$string['shortnameframework'] = '省略名';
$string['shortnametemplate'] = 'テンプレート省略名';
$string['shortnametype'] = 'タイプ省略名';
$string['shortnameview'] = '省略名';
$string['template'] = 'コンピテンシーテンプレート';
$string['templatecompetencyremovecheck'] = 'このテンプレートからこのコンピテンシーの割り当てを解除しても本当によろしいですか？';
$string['types'] = 'タイプ';
$string['unknownbuttonclicked'] = '不明なボタンがクリックされました。';
$string['updatedcompetency'] = 'コンピテンシー"{$a}"がアップデートされました';
$string['competencyupdatedframework'] = 'コンピテンシーフレームワーク"{$a}"がアップデートされました';
$string['competencyupdatetype'] = 'コンピテンシータイプ"{$a}"がアップデートされました';
$string['useresourcelevelevidence'] = 'リソースレベルのエビデンスを使用する';
$string['weight'] = '重さ';
$string['organisationaddedframework'] = '組織フレームワーク"{$a}"が追加されました';
$string['addedorganisation'] = '組織"{$a}"が追加されました';
$string['addmultipleneworganisation'] = '多数の組織を追加する';
$string['organisationaddnewframework'] = '新規組織フレームワークを追加する';
$string['addneworganisation'] = '新規組織を追加する';
$string['organisationbacktoallframeworks'] = 'すべての組織フレームワークに戻る';
$string['bulkdeleteorganisation'] = '組織を一括削除する';
$string['bulkmoveorganisation'] = '組織を一括移動する';
$string['chooseorganisation'] = '組織を選択する';
$string['competencyassigndeletecheck'] = 'このコンピテンシー割り当てを削除してもよろしいですか？';
$string['organisationcreatetype'] = '組織タイプ"{$a}"が作成されました';
$string['organisationdeletecheck'] = 'この組織、そのすべての子組織、そこに含まれるデータを削除してもよろしいですか？';
$string['organisationdeletecheck11'] = '組織"{$a}"を削除してもよろしいですか?
<br /><br />
これにより以下のデータが削除されます:<br />
-"{$a}"組織';
$string['organisationdeletecheckwithchildren'] = '組織"{$a->itemname}"およびその{$a->children_string}を削除してもよろしいですか?
<br /><br />
これにより以下のデータが削除されます: <br />
-"{$a->itemname}"組織およびその{$a->childcount} {$a->children_string}';
$string['organisationdeletedassignedcompetency'] = 'コンピテンシーがこの組織から正常に割り当てを解除されました';
$string['organisationdeletedframework'] = '組織フレームワーク"{$a}"とそのデータが完全に削除されました';
$string['deletedorganisation'] = '組織"{$a}"とその子組織が完全に削除されました';
$string['organisationdeletedtype'] = '組織タイプ"{$a}"が完全に削除されました';
$string['organisationdeleteincludexlinkedcompetencies'] = '- コンピテンシーへの{$a} リンク';
$string['organisationdeleteincludexposassignments'] = '- この組織への{$a} 割り当て（この組織に割り当てられたユーザは割り当てを解除されます）';
$string['organisationdeletemulticheckwithchildren'] = '{$a->num}組織および{$a->childcount} {$a->children_string}を削除してもよろしいですか?
<br /><br />
これにより以下のデータが削除されます: <br />
- The {$a->num}組織および{$a->childcount} {$a->children_string}';
$string['deleteorganisation'] = '組織を削除する';
$string['organisationeditframework'] = '組織フレームワークを編集する';
$string['editorganisation'] = '組織を編集する';
$string['edittypelevel'] = 'タイプを編集する';
$string['error:addorganisation'] = '組織"{$a}"を追加中に問題が発生しました';
$string['organisationerror:createtype'] = '組織タイプ"{$a}"を作成中にエラーが発生しました';
$string['organisationerror:deleteassignedcompetency'] = 'この組織からコンピテンシーの割り当てを解除している間にエラーが発生しました';
$string['organisationerror:deletedframework'] = '組織フレームワーク"{$a}"およびそのデータを削除中にエラーが発生しました';
$string['organisationerror:deletedtype'] = '組織タイプ"{$a}"の削除中にエラーが発生しました';
$string['organisationerror:dialognotreeitems'] = 'このフレームワークに組織はありません';
$string['error:updateorganisation'] = '組織"{$a}"のアップデート中に問題が発生しました';
$string['organisationerror:updatetype'] = '組織タイプ"{$a}"のアップデート中にエラーが発生しました';
$string['organisationfeatureplural'] = '組織';
$string['organisationframework'] = '組織フレームワーク';
$string['organisationframeworks'] = '組織フレームワーク';
$string['organisationfullname'] = '組織の正式名';
$string['organisationidnumber'] = '組織のID番号';
$string['manageorganisation'] = '組織を管理する';
$string['manageorganisations'] = '組織を管理する';
$string['manageorganisationtypes'] = 'タイプを管理する';
$string['missingfullname'] = '組織の正式名が欠けています';
$string['organisationmissingname'] = '組織名が欠けています';
$string['organisationmissingnameframework'] = '組織フレームワークの名前が欠けています';
$string['organisationmissingnametype'] = '組織タイプの名前が欠けています';
$string['organisationmissingshortname'] = '組織の省略名が欠けています';
$string['nochildorganisations'] = '子組織が定義されていません';
$string['organisationnoframeworks'] = '利用できる組織フレームワークがありません';
$string['organisationnoframeworkssetup'] = 'このサイトにセットアップされた組織フレームワークはありません';
$string['noorganisation'] = '定義された組織はありません';
$string['noorganisationsinframework'] = 'このフレームワークに組織はありません';
$string['organisationnotypes'] = '組織タイプがありません';
$string['nounassignedcompetencies'] = '割り当てられていないコンピテンシーはありません';
$string['nounassignedcompetencytemplates'] = '割り当てられていないコンピテンシーテンプレートはありません';
$string['organisation'] = '組織';
$string['organisationaddnew'] = '新規組織を追加する';
$string['organisationcustomfields'] = 'カスタムフィールド';
$string['organisationdepthcustomfields'] = '組織の深さカスタムフィールド';
$string['organisationframework'] = '組織フレームワーク';
$string['organisationframeworkmanage'] = 'フレームワークを管理する';
$string['organisationframeworks'] = '組織フレームワーク';
$string['organisationmanage'] = '組織を管理する';
$string['organisationplural'] = '組織';
$string['organisations'] = '組織';
$string['organisationtypecustomfields'] = '組織タイプカスタムフィールド';
$string['organisationtypes'] = '組織タイプ';
$string['organisationreturntoframework'] = '組織フレームワークに戻る';
$string['organisationshortname'] = '組織の省略名';
$string['organisationupdatedframework'] = '組織フレームワーク"{$a}"がアップデートされました';
$string['updatedorganisation'] = '組織"{$a}"がアップデートされました';
$string['organisationupdatetype'] = '組織タイプ"{$a}"がアップデートされました';
$string['positionaddedframework'] = 'ポジションフレームワーク"{$a}"が追加されました';
$string['addedposition'] = 'ポジション"{$a}"が追加されました';
$string['addmultiplenewposition'] = '複数のポジションを追加する';
$string['positionaddnewframework'] = '新規ポジションフレームワークを追加する';
$string['addnewposition'] = '新規ポジションを追加する';
$string['positionbacktoallframeworks'] = 'すべてのポジションフレームワークに戻る';
$string['bulkdeleteposition'] = 'ポジションを一括削除する';
$string['bulkmoveposition'] = 'ポジションを一括移動する';
$string['choosemanager'] = 'マネージャーを選ぶ';
$string['chooseposition'] = 'ポジションを選ぶ';
$string['positioncreatetype'] = 'ポジションタイプ"{$a}"が作成されました';
$string['positiondeletecheck'] = 'このポジション、そのすべての子、およびそこに含まれるデータを削除してもよろしいですか？';
$string['positiondeletecheck11'] = 'ポジション"{$a}"を削除してもよろしいですか?
<br /><br />
これにより以下のデータが削除されます:<br />
- "{$a}"ポジション';
$string['positiondeletecheckwithchildren'] = 'ポジション"{$a->itemname}"およびその{$a->children_string}を削除してもよろしいですか?
<br /><br />
これにより以下のデータが削除されます: <br />
- "{$a->itemname}"ポジションおよびその{$a->childcount} {$a->children_string}';
$string['positiondeletedassignedcompetency'] = 'コンピテンシーがこのポジションから正常に割り当てを解除されました';
$string['positiondeletedframework'] = 'ポジションフレームワーク"{$a}"とそのデータが完全に削除されました';
$string['deletedposition'] = 'ポジション{$a} とその子が完全に削除されました';
$string['positiondeletedtype'] = 'ポジションタイプ"{$a}"が完全に削除されました';
$string['positiondeleteincludexlinkedcompetencies'] = '- コンピテンシーへの{$a} リンク';
$string['positiondeleteincludexposassignments'] = '- このポジションへの{$a} 割り当て（このポジションに割り当てられたユーザは割り当てが解除されます）';
$string['positiondeletemulticheckwithchildren'] = '{$a->num}ポジションおよび{$a->childcount} {$a->children_string}を削除してもよろしいですか?
<br /><br />
これにより以下のデータが削除されます: <br />
- {$a->num}ポジションおよび{$a->childcount} {$a->children_string}';
$string['deleteposition'] = 'ポジションを削除する';
$string['positioneditframework'] = 'ポジションフレームワークを編集する';
$string['editposition'] = 'ポジションを編集する';
$string['entervaliddate'] = '有効な日付を入力する';
$string['error:addposition'] = 'ポジション"{$a}"の追加中に問題が発生しました';
$string['positionerror:createtype'] = 'ポジションタイプ"{$a}"の作成中にエラーが発生しました';
$string['error:dateformat'] = '日付を日/月/年（dd/mm/yyyy）の形式で入力してください';
$string['positionerror:deleteassignedcompetency'] = 'このポジションからコンピテンシーの割り当てを解除している間にエラーが発生しました';
$string['positionerror:deletedframework'] = 'ポジションフレームワーク"{$a}"とそのデータを削除している間にエラーが発生しました';
$string['positionerror:deletedtype'] = 'ポジションタイプ"{$a}"の削除中にエラーが発生しました';
$string['positionerror:dialognotreeitems'] = 'このフレームワークにポジションはありません';
$string['error:positionnotset'] = 'このユーザにポジションは設定されていません';
$string['error:startafterfinish'] = '開始日が終了日より後になってはいけません';
$string['error:updateposition'] = 'ポジション"{$a}"のアップデート中に問題が発生しました';
$string['positionerror:updatetype'] = 'ポジションタイプ"{$a}"のアップデート中にエラーが発生しました';
$string['error:userownmanager'] = 'ユーザをユーザ自身のマネージャーに割り当てることはできません';
$string['positionfeatureplural'] = 'ポジション';
$string['finishdate'] = '終了日';
$string['finishdatehint'] = '&nbsp;<b>形式:</b>日/月/年（dd/mm/yyyy）';
$string['positionframework'] = 'ポジションフレームワーク';
$string['positionframeworks'] = 'フレームワーク';
$string['positionfullname'] = 'ポジションの正式名';
$string['positionidnumber'] = 'ポジションID番号';
$string['manageposition'] = 'ポジションを管理する';
$string['managepositions'] = 'ポジションを管理する';
$string['managepositiontypes'] = 'タイプを管理する';
$string['manager'] = 'マネージャー';
$string['missingfullname'] = 'ポジションの正式名が欠けています';
$string['positionmissingname'] = 'ポジション名が欠けています';
$string['positionmissingnameframework'] = 'ポジションフレームワークの名前が欠けています';
$string['positionmissingnametype'] = 'ポジションタイプの名前が欠けています';
$string['positionmissingshortname'] = 'ポジションの省略名が欠けています';
$string['nocompetenciesassignedtoposition'] = 'ポジションに割り当てられたコンピテンシーはありません';
$string['positionnoframeworks'] = '利用できるポジションフレームワークはありません';
$string['positionnoframeworkssetup'] = 'このサイトにセットアップされたポジションフレームワークはありません';
$string['noposition'] = '定義されたポジションはありません';
$string['nopositionsassigned'] = 'このユーザに現在割り当てられているポジションはありません';
$string['nopositionset'] = '設定されたポジションはありません';
$string['nopositionsinframework'] = 'このフレームワークにポジションはありません';
$string['positionnotypes'] = 'ポジションタイプはありません';
$string['position'] = 'ポジション';
$string['positionaddnew'] = '新規ポジションを追加する';
$string['positionbulkaction'] = 'バルクアクション';
$string['positioncustomfields'] = 'カスタムフィールド';
$string['positiondepthcustomfields'] = 'ポジション深さカスタムフィールド';
$string['positionframework'] = 'ポジションフレームワーク';
$string['positionframeworkmanage'] = 'フレームワークを管理する';
$string['positionframeworks'] = 'ポジションフレームワーク';
$string['positionhistory'] = 'ポジション履歴';
$string['positionmanage'] = 'ポジションを管理する';
$string['positionplural'] = 'ポジション';
$string['positionsaved'] = 'ポジションが保存されました';
$string['positiontypecustomfields'] = 'ポジションタイプカスタムフィールド';
$string['positiontypes'] = 'ポジションタイプ';
$string['positionreturntoframework'] = 'ポジションフレームワークに戻る';
$string['positionshortname'] = 'ポジションの省略名';
$string['startdate'] = '開始日';
$string['startdatehint'] = '&nbsp;<b>形式:</b>日/月/年（dd/mm/yyyy）';
$string['titlefullname'] = 'タイトル（正式名）';
$string['titleshortname'] = 'タイトル（省略名）';
$string['typeaspirational'] = 'アスピレーショナルポジション';
$string['typeprimary'] = 'プライマリーポジション';
$string['typesecondary'] = 'セカンダリーポジション';
$string['positionupdatedframework'] = 'ポジションフレームワーク"{$a}"がアップデートされました';
$string['updatedposition'] = 'ポジション"{$a}"がアップデートされました';
$string['updateposition'] = 'ポジションをアップデートする';
$string['positionupdatetype'] = 'ポジションタイプ"{$a}"がアップデートされました';
$string['addcompetencyevidence'] = 'コンピテンシーエビデンスレコードを追加する';
$string['addforthisuser'] = 'このユーザに新規コンピテンシーエビデンスを追加する';
$string['confirmdeletece'] = 'このコンピテンシーエビデンスレコードを削除してもよろしいですか？';
$string['couldnotdeletece'] = 'そのコンピテンシーエビデンスレコードを削除できませんでした。';
$string['deletecompetencyevidence'] = 'コンピテンシーエビデンスを削除する';
$string['editcompetencyevidence'] = 'コンピテンシーエビデンスレコードを編集する';
$string['firstselectcompetency'] = '最初にコンピテンシーを選択してください';
$string['selectcompetency'] = 'コンピテンシーを選択する';


$string['organisationframeworkfullname_help'] = 'フレームワーク正式名はフレームワークの正式な名称です。';
$string['organisationframeworkdescription_help'] = 'フレームワークの説明はフレームワークについての追加的情報を保存するためのテキストフィールドです。「組織の管理」ページ内、組織テーブルのすぐ上に表示されます。';
$string['organisationframeworkidnumber_help'] = 'フレームワークID番号はフレームワークを表すために使用するユニークな番号です。</h1>';
$string['organisationframeworkshortname_help'] = 'フレームワーク省略名はフレームワーク正式名の略称で、表示用に使用することができます。';
$string['organisationfullname_help'] = '組織正式名は組織の正式な名称です。';
$string['organisationframework_help'] = '**組織フレームワーク**は組織の定義に使用するフレームワークの名前です。';
$string['organisationframeworks_help'] = '**組織フレームワーク**をセットアップすると、あなたの組織の組織構造を保持することができます。

多重組織フレームワークもセットアップが可能です。例えば、ビジネスの下位部門または子会社のフレームワークのセットアップなどです。';
$string['competencytype_help'] = '管理者はコンピテンシーのタイプを作成し割り当てることができます。コンピテンシーにあるタイプが割り当てられると、そのタイプに割り当てられているカスタムフィールドがいずれも引き継がれます。これにより、コンピテンシーに関係しているメタデータをオーガナイズし、また各種のコンピテンシーが必要とするフィールドのみを表示することができるようになります。';
$string['competencyshortname_help'] = 'コンピテンシー省略名はコンピテンシーの簡便な参照名で、表示用に使うことができます。';
$string['competencyscalevaluenumericalvalue_help'] = '尺度値数値は尺度値に関連付けられた数値です。';
$string['competencytemplatefullname_help'] = 'テンプレート正式名は、セットアップ中のコンピテンシーテンプレートの正式な名称です。';
$string['competencytemplategeneral_help'] = '**コンピテンシーテンプレート**を使用すると、1つのコンピテンシーフレームワークにあるコンピテンシーをグループにまとめることができます。

トレーニングイベント、例えば導入コースをセットアップする時に、これを「新規従業員コンピテンシー」という名前のコンピテンシーテンプレートにリンクさせると、多数のコンピテンシーを自動的に利用していくことができ、1つずつ選択を繰り返していく必要がありません。';
$string['organisationidnumber_help'] = '組織ID番号は組織を表すために使用するユニークな番号です。';
$string['competencytemplateshortname_help'] = 'テンプレート省略名はコンピテンシーテンプレートの簡便な参照名で、表示用に使うことができます。';
$string['organisationdescription_help'] = 'この組織についての詳細を入力する自由テキストフィールドです。このデータは階層リストの閲覧中、およびそれぞれの組織ページで表示されます。';
$string['organisationparent_help'] = '**親組織**を使うと組織間の親／子関係を管理することができます。

ドロップダウンメニューから**親組織**を選択します。この組織を階層の最上位に置きたい場合は**トップ**を選択してください。

アイテムの親組織を変更すると、元の親組織は新しい親組織の下に移動します。その際、子組織もすべて一緒に移動します。

**注意：**親／子関係をセットアップするには、フレームワークに少なくとも1つのアイテムがある必要があります。そうでない場合このオプションは表示されません。';
$string['positionfullname_help'] = '**ポジション正式名**はポジションの正式な名称です。';
$string['positionframeworkshortname_help'] = 'フレームワーク省略名はフレームワーク正式名の略称で、表示用に使うことができます。';
$string['positionidnumber_help'] = '**ポジションID番号**はポジションを表すためのユニークな番号です。これは任意のフィールドです。';
$string['positionparent_help'] = '**親ポジション**では、ポジション間の親／子関係を管理することができます。

ドロップダウンメニューから**親ポジション**を選択してください。そのポジションを階層の最上位に置きたい場合は**トップ**を選択します。

アイテムの親ポジションを変更すると、元の親ポジションは新しい親ポジションの下位に移動します。その際、子ポジションもすべて一緒に移動します。

**注意：**親／子関係をセットアップするには、フレームワークに少なくとももう1つのアイテムがある必要があります。そうでない場合このオプションは表示されません。';
$string['positiontype_help'] = '管理者はポジションのタイプを作成し割り当てることができます。ポジションにタイプを割り当てると、そのタイプに既に割り当てられているカスタムフィールドもすべてポジションに引き継がれます。これにより、そのポジションに関係するメタデータを組織化することができ、また各種のポジションが必要とするフィールドのみを表示できます。';
$string['positionshortname_help'] = '**ポジション省略名**は職名の略称で、表示用に使うことができます。';
$string['positionframeworks_help'] = '**ポジションフレームワーク**をセットアップすると、様々なポジションを組織内に保持できます。

多重のポジション分類（フレームワーク）を組織内にセットアップすることもできます。';
$string['positionframeworkidnumber_help'] = 'フレームワークID番号はフレームワークを表すために使用するユニークな番号です。';
$string['organisationtype_help'] = '管理者は組織のタイプを作成し割り当てることができます。組織にタイプを割り当てると、そのタイプに既に割り当てられているカスタムフィールドもすべて組織に引き継がれます。これにより、その組織に関係するメタデータを組織化することができ、また各種の組織が必要とするフィールドのみを表示できます。';
$string['organisationshortname_help'] = '組織省略名は組織の略称であり、表示用に使用することができます。';
$string['positiondescription_help'] = 'このポジションに関して、さらに詳細情報を提供するためのフリーテキストフィールドです。このデータは組織階層一覧を閲覧、および個々のポジションページを閲覧するときに表示されます。';
$string['positionframework_help'] = '**ポジションフレームワーク**はポジション（ジョブロール）のリストをセットアップするための固有のフレームワークです。多重ポジションフレームワーク（リスト）を作成することもできます。';
$string['positionframeworkfullname_help'] = 'フレームワーク正式名はフレームワークの正式な名称です。';
$string['positionframeworkdescription_help'] = 'フレームワークの説明はフレームワークについての追加的情報を保存するテキストフィールドです。「ポジションの管理」ページ、ポジションリストのすぐ上に表示されます。';
$string['competencyscalevaluename_help'] = '**尺度値名**は、追加・編集しているコンピテンシー尺度値の名称です。

尺度値は学習者のコンピテンシーの進捗状況を定義するために使います。尺度値は必要に応じいくつでも追加することができます。

**注意：**デフォルト値および熟達値の設定も必ず行ってください。';
$string['competencyscalesgeneral_help'] = '**コンピテンシー尺度**はコンピテンシーの測定基準を定義するために使用します。例えば尺度には「コンピテント、監督付きでコンピテント、コンピテントでない」の3つの値を設定することができます。

コンピテンシーフレームワークまたはどのようなコンピテンシーのセットアップにも、それに先立ってコンピテンシー尺度をセットアップしておく必要があります。';
$string['competencyevidenceproficiency_help'] = 'このフィールドでは、ユーザが割り当てられたコンピテンシーについて熟達していると見なされるかどうかが記録されます。プルダウンメニューに表示されるオプションは、選択されたコンピテンシーに割り当てられたコンピテンシー尺度によって異なります。したがってこのフィールドを変更する場合は、まず先にコンピテンシーを選択してください。コンピテンシーエビデンスレコードを追加またはアップデートするには、熟達度を設定しなければいけません。';
$string['competencyevidenceposition_help'] = 'このオプションでは、ユーザがコンピテンシーエビデンスのアイテムを完了した時に就いていたポジションが記録されます。ほとんどの場合、これはユーザの現在の役割と同一です。 しかし時間が経過してユーザが役割を変更した場合に備え、この設定によって完了時の役割を記録しておくことができるようになります。 これは任意のフィールドです。';
$string['competencyevidencetimecompleted_help'] = 'コンピテンシーエビデンスが完了した時を記録します。';
$string['competencyevidenceuser_help'] = 'このコンピテンシーエビデンスアイテムが割り当てられているユーザ。コンピテンシーエビデンスのアイテムを別のユーザに割り当てし直すことはできません。ただし十分な権限がある場合には、ユーザの新規コンピテンシーエビデンスアイテムを作成することができます。その場合は、ユーザのマイレコードページにある該当するボタンをクリックしてください。またユーザのエビデンスを編集するには、レポート内のレコードを探して編集アイコンをクリックしてください。';
$string['competencyframeworkdescription_help'] = 'フレームワークの説明は、フレームワークに関する追加的情報を保管するためのテキストフィールドです。コンピテンシーを管理するページの、コンピテンシーテーブルのすぐ上に表示されています。';
$string['competencyframework_help'] = 'コンピテンシーはグループ分けまたはカテゴリ分けされて、「コンピテンシーフレームワーク」内に保存されます。コンピテンシーフレームワークが作成された場合、その中にコンピテンシーを設定することができます。';
$string['competencyevidenceorganisation_help'] = 'このオプションでは、ユーザがコンピテンシーエビデンスのアイテムを完了した時に所属していた組織が記録されます。ほとんどの場合、これはユーザの現在の組織と同一です。 しかし時間が経過してユーザが組織を変更した場合に備え、この設定によって完了時の組織を記録しておくことができるようになります。 これは任意のフィールドです。';
$string['competencyevidencecompetency_help'] = 'ユーザに割り当てられるコンピテンシー。コンピテンシーエビデンスの既存のアイテムを編集している場合、これを変更することはできません。 ただしコンピテンシーエビデンスの新規アイテムは（その権限がある場合に限り）作成することができます。ユーザのマイレコード・ページで、「コンピテンシーエビデンスを追加する」ボタンをクリックしてください。

新規コンピテンシーエビデンスアイテムを作成する時に、既存のコンピテンシーにエビデンスを追加するか、または新規コンピテンシーを作成するかのどちらかを選択します。「コンピテンシーを選択する」を選ぶと、ポップアップ画面が開き、そこで既存のコンピテンシーを選択できます。「新規コンピテンシーを作成する」を選ぶと、フォームが開きますので、フレームワークを選択して新規コンピテンシーを定義してください。

同一のユーザとコンピテンシーについて2つのコンピテンシーエビデンスアイテムを作成することはできないのでご注意ください。もしこれを試みた場合は、オリジナルのレコードの編集、または別のコンピテンシーを選択するためのリンクが表示されます。';
$string['competencydescription_help'] = 'このコンピテンシーに関する詳細を表示する自由記入フィールド。このデータは階層リストおよび個々のコンピテンシーページを閲覧すると表示されます。';
$string['competencyaggregationmethod_help'] = '集約方法は、システムがコンピテンシーの達成を産出する方法を設定します。

集約方法が「すべて」に設定された場合は、親コンピテンシーの達成が宣言されるには、すべての子コンピテンシーを達成することが条件となります。

集約方法が「いずれか」に設定された場合は、親コンピテンシーの達成にはどれか1つの子コンピテンシーのみを達成すればよいことになります。

集約方法が「オフ」に設定された場合は、そのコンピテンシーの自動達成は非アクティブとなります。（ただし達成を手動でマークすることは可能です。）';
$string['competencyevidenceassessmenttype_help'] = 'アセスメントタイプ・フィールドは、このコンピテンシーのアセスメントに関する追加的情報のための自由記入フィールドです。 コンテンツは様々であり、このフィールドは任意です。';
$string['competencyevidenceassessor_help'] = 'アセッサーを選択すると、現在のユーザの現在のコンピテンシーに関する熟達度についてアセスメントを行います。アセッサーは任意のフィールドですので、アセッサーを必要としない場合は「アセッサーを選択する」オプションのプルダウンメニューをそのままにしてください。

プルダウンメニューにはアセッサーのロールをもつすべてのmoodleユーザがリストアップされています。アセッサーに追加したいユーザが見当たらない、またはオプションが何も表示されない場合は、そのユーザをアセッサーのロールに追加するよう管理者に要請する必要があります。';
$string['competencyevidenceassessorname_help'] = 'アセッサー名フィールドには、このコンピテンシーについてユーザのアセスメントを行った組織の名前を入力します。任意のフィールドですので空白のままにすることもできます。';
$string['competencyscalevalueidnumber_help'] = '尺度値ID番号はその尺度値を表すユニークな番号です。';
$string['competencyframeworkfullname_help'] = 'フレームワークの正式名はフレームワークの正式な名称のことです。';
$string['competencyscaleassign_help'] = 'コンピテンシー尺度はコンピテンシーの測定基準を定義します。これは値を追加する尺度の名称です。';
$string['competencyscale_help'] = '**尺度**はコンピテンシーフレームワークで使用されるコンピテンシー尺度を指します。

コンピテンシー尺度はコンピテンシーフレームワークで設定します。コンピテンシー尺度はフレームワークごとに1つのみ使用できます。

新規コンピテンシー尺度は、「サイト管理者」メニューにある階層／コンピテンシー／フレームワークの管理でセットアップすることができます。';
$string['competencyscaledefault_help'] = '**デフォルト値**は、コンピテンシーで指定されたエビデンスアイテム (「コース/活動の完了する」または「コース/活動の評点に合格する」) により要求される熟達度を明示していないユーザに対して、自動的に割り当てられます。';
$string['competencyscaleproficient_help'] = '熟達値は、ユーザが特定のコンピテンシーに関して「コンピテント」であるかどうかをシステムが測定する方法です。学習プランの進捗状況を示すために使われ、未完了のコンピテンシーについては期限切れの通知のみを表示します。
尺度値で「熟達」がチェックされると、ユーザは「コンピテント」とみなされます。複数の尺度値を熟達として設定できますが、少なくとも必ず1つの尺度値を熟達としてマークしてください。熟達値は尺度値の編集を通じて編集できます。

熟達としてマークされた最小の尺度値は、コンピテンシーの特定のエビデンスアイテムで要求される熟達度（例えばコース／活動の完了、コース／活動の合格評定など）を実証したユーザに自動的に与えられます。';
$string['competencyscalescalevalues_help'] = 'コンピテンシー尺度にコンピテントが最も高いものから低いものへという順番で値を入力します（ラインごとに1つ入力してください）。例えば次の通りです:

<p class="indent">
  <i> コンピテント<br /> 監督付きでコンピテント<br /> コンピテントでない<br /> </i>
</p>';
$string['competencyscalescalename_help'] = 'コンピテンシーフレームワークで使用されるコンピテンシー尺度の名称です。';
$string['competencyframeworkgeneral_help'] = '**コンピテンシーフレームワーク**はスタッフに達成してほしいスキル、知識、行動に関するコンピテンシーをまとめるためにセットアップします。

コンピテンシーは様々な種類のフレームワークのもとにグループ化することができます。例えば、1つのフレームワークには当該国の全産業に関わるコンピテンシー標準（関係機関の情報に基づくもの）を含める一方、別のフレームワークには自社設定の特定コンピテンシーのみを含める、といったことができます。

コンピテンシーフレームワークをセットアップする前に、**コンピテンシー尺度**をセットアップする必要があります。';
$string['competencyparent_help'] = '**親コンピテンシー**ではコンピテンシー間の親／子関係を管理することができます。

ドロップダウンメニューから**親コンピテンシー**を選択してください。当該コンピテンシーを階層のトップに置きたい場合は、**トップ**を選択します。

アイテムの親コンピテンシーを変更すると、新しい親コンピテンシーの下部に移動します。この時、その子もすべて一緒に移動します。

**注意：**親／子関係をセットアップするには、フレームワークに少なくとももう1つのアイテムがなければいけません。そうでない場合、このオプションは表示されません。';
$string['competencyframeworks_help'] = '**コンピテンシーフレームワーク**はスタッフに達成してほしいスキル、知識、行動に関するコンピテンシーをまとめるためにセットアップします。

コンピテンシーは様々な種類のフレームワークのもとにグループ化することができます。例えば、1つのフレームワークには当該国の全産業に関わるコンピテンシー標準（関係機関の情報に基づくもの）を含める一方、別のフレームワークには自社設定の特定コンピテンシーのみを含める、といったことができます。

コンピテンシーフレームワークをセットアップする前に、**コンピテンシー尺度**をセットアップする必要があります。';
$string['competencyframeworkidnumber_help'] = 'フレームワークID番号はそのフレームワークを表すユニークな番号です。</h1>';
$string['competencyidnumber_help'] = 'コンピテンシーID番号はそのコンピテンシーを表すユニークな番号です。</h1>';
$string['competencyframeworkscale_help'] = 'コンピテンシー尺度はコンピテンシーの測定基準を定義するために使用します。例えば尺度には「コンピテント、監督付きでコンピテント、コンピテントでない」の3つの値を設定することができます。

まずコンピテンシー尺度オプションを使って新規尺度を追加し、その尺度に学習者のコンピテンシーの進捗状況を定義する値を追加します。値はいくつでも追加できます。その際、デフォルト値と熟達値の設定についても注意してください。';
$string['competencyframeworkshortname_help'] = 'フレームワーク省略名はフレームワーク正式名を簡便に表記したもので、表示用に使うことができます。';
$string['competencyfullname_help'] = 'コンピテンシー正式名はコンピテンシーの正式な名称です。';
