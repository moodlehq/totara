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
 * Strings for component 'glossary', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   glossary
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addcomment'] = 'Inserir comentário';
$string['addentry'] = 'Inserir novo item';
$string['addingcomment'] = 'Inserir um comentário';
$string['alias'] = 'Palavra chave';
$string['aliases'] = 'Outras palavras que serão linkadas ao mesmo item';
$string['aliases_help'] = '<p>Cada item do glossário pode ser associado a uma lista de palavras-chave (ou aliases).
<p><b>Escreva cada alias em uma nova linha</b> (sem separar com vírgulas).</p>
<p>Estas palavras-chave podem ser usadas como referências alternativas ao item associado. Por exemplo, todas estas palavras chave serão linkadas automaticamente ao mesmo item do glossário em caso de criação automática de links (filtro auto-linking).</p>';
$string['allcategories'] = 'Todas as categorias';
$string['allentries'] = 'Todos';
$string['allowcomments'] = 'Permitir comentários';
$string['allowcomments_help'] = '<p>É possível permitir que sejam acrescentados comentários aos itens do glossário.</p>

<p>Você pode escolher se habilitar ou não esta função.</p>

<p>Os professores sempre podem acrescentar comentários aos itens do glossário.</p>';
$string['allowduplicatedentries'] = 'Permitir itens repetidos';
$string['allowduplicatedentries_help'] = '<p>Se você habilitar esta opção, poderão ser criados diversos itens com o mesmo nome.</p>';
$string['allowprintview'] = 'Permitir versão para impressão';
$string['allowprintview_help'] = '<p>Pode-se permitir aos estudantes a visualização de uma versão do glossário otimizada para a impressão.</p>

<p>Você pode escolher se habilitar ou não esta função.</p>

<p>Os professores sempre podem usar a versão de visualização para impressão.</p>';
$string['andmorenewentries'] = 'e mais {$a} entradas novas';
$string['answer'] = 'Resposta';
$string['approve'] = 'Aprovar';
$string['areyousuredelete'] = 'Tem certeza que quer excluir este item?';
$string['areyousuredeletecomment'] = 'Tem certeza que quer excluir este comentário?';
$string['areyousureexport'] = 'Tem certeza que quer exportar este item para';
$string['ascending'] = 'crescente';
$string['attachment'] = 'Anexo';
$string['attachment_help'] = '<p>Você tem a opção de anexar um arquivo do seu computador a um item do glossário. Este arquivo é carregado no servidor e anexado ao item correspondente.</p>

<p>Isto é útil, por exemplo, quando você quer disponibilizar uma imagem ou um documento Word.</p>

<p>Todos os formatos de arquivos são permitidos, mas preste atenção no nome dado ao arquivo. Estes nomes devem conter as 3 letras finais que definem o formato como .doc em um documento Word, .jpg ou .png em imagens, etc. Isto facilita a visualização dos documentos nos navegadores dos outros usuários.</p>

<p>Se você modificar um item e substituir o anexo, os documentos anteriores serão cancelados.</p>

<p>Se você modificar um item que contém um anexo, deixe o campo do anexo em branco para conservar o anexo original.</p>';
$string['author'] = 'autor';
$string['authorview'] = 'Por autor';
$string['back'] = 'Voltar';
$string['cantinsertcat'] = 'Não é possível inserir uma categoria';
$string['cantinsertrec'] = 'Não é possível inserir um registro';
$string['cantinsertrel'] = 'Não é possível inserir uma relação categoria-item';
$string['casesensitive'] = 'Item sensível à distinção entre maiúsculas e minúsculas';
$string['casesensitive_help'] = '<P>Esta opção define se a criação automática de links a estes itens do glossário deve estabelecer uma correspondência exata entre as palavras, considerando as diferenças entre maiúsculas e minúsculas.</p>

<p>Por exemplo: se esta opção for habilitada, uma palavra como "html" em uma mensagem do fórum
   NÃO será linkada a um item do glossário chamado "HTML".</p>';
$string['cat'] = 'cat';
$string['categories'] = 'Categorias';
$string['category'] = 'Categoria';
$string['categorydeleted'] = 'Categoria cancelada';
$string['categoryview'] = 'Por categoria';
$string['changeto'] = 'Mude para {$a}';
$string['cnfallowcomments'] = 'Indicar como padrão a aceitação de comentários aos itens do glossário';
$string['cnfallowdupentries'] = 'Indicar como padrão a aceitação de itens duplicados';
$string['cnfapprovalstatus'] = 'Indicar como padrão a aprovação de um item enviado por um estudante';
$string['cnfcasesensitive'] = 'Definir se a distinção entre maiúsculas e minúsculas ´o padrão dos itens linkados';
$string['cnfdefaulthook'] = 'Escolher o formato de visualização padrão';
$string['cnfdefaultmode'] = 'Escolher o frame de visualização padrão';
$string['cnffullmatch'] = 'Definir se um item tem como opção predefinida do link, a exata correspondência com maiúsculas ou minúsculas no texto destinatário';
$string['cnflinkentry'] = 'Indicar como opção padrão o link automático de um item';
$string['cnflinkglossaries'] = 'Indicar como opção predefinida o link automático de um glossário';
$string['cnfrelatedview'] = 'Selecionar o formato de visualização dos links automáticos e dos itens';
$string['cnfshowgroup'] = 'Definir se a separação de grupos deve ser mostrada ou não';
$string['cnfsortkey'] = 'Escolher o critério de ordenação padrão';
$string['cnfsortorder'] = 'Escolher a sequência de ordenação padrão';
$string['cnfstudentcanpost'] = 'Definir a opção padrão para que os estudantes possam ou não possam criar novos itens';
$string['comment'] = 'Comentário';
$string['commentdeleted'] = 'O comentário foi cancelado';
$string['comments'] = 'Comentários';
$string['commentson'] = 'Comentários sobre';
$string['commentupdated'] = 'O comentário foi atualizado';
$string['completionentries'] = 'Estudante deve criar entradas';
$string['completionentriesgroup'] = 'Requer entradas';
$string['concept'] = 'Conceito';
$string['concepts'] = 'Conceitos';
$string['configenablerssfeeds'] = 'Este parâmetro autoriza a criação de feeds RSS em todos os glossários. É necessário configurar cada glossário para que sejam criados os feeds RSS.';
$string['current'] = 'Critério de ordenação atual: {$a}';
$string['currentglossary'] = 'Este glossário';
$string['date'] = 'data';
$string['dateview'] = 'por data de inserção';
$string['defaultapproval'] = 'Aprovação imediata de novos itens';
$string['defaultapproval_help'] = '<p>Esta configuração permite que o professor defina se novos itens acrescentados pelos estudantes serão automaticamente disponibilizados para todos, ou se é necessária a aprovação do professor para a publicação de cada item.</p>';
$string['defaulthook'] = 'Gancho padrão';
$string['defaultmode'] = 'Modo padrão';
$string['defaultsortkey'] = 'Critério padrão';
$string['defaultsortorder'] = 'Ordem padrão';
$string['definition'] = 'Definição';
$string['definitions'] = 'Definições';
$string['deleteentry'] = 'Excluir item';
$string['deletenotenrolled'] = 'Excluir os itens criados por usuários não inscritos';
$string['deletingcomment'] = 'Excluindo comentário';
$string['deletingnoneemptycategory'] = 'O cancelamento desta categoria não provoca o cancelamento dos itens que ela contém. Estes serão classificados como não incluídos em nenhuma categoria';
$string['descending'] = 'decrescente';
$string['destination'] = 'Destino das entradas importadas';
$string['destination_help'] = '<P>Você pode especificar para onde quer importar os itens:</p>
<ul>
<li><strong>Glossário Ativo:</strong> Agrega os itens importados ao glossário que está aberto.</li>
<li><strong>Novo Glossário:</strong> Cria um novo glossário baseado nas informação contidas no arquivo que está sendo importado e insere os itens importados neste novo glossário.</li>
</ul>';
$string['displayformat'] = 'Formato de visualização';
$string['displayformatcontinuous'] = 'Contínuo sem autor';
$string['displayformatdictionary'] = 'Simples, estilo dicionário';
$string['displayformatencyclopedia'] = 'Enciclopédia';
$string['displayformatentrylist'] = 'Lista de itens';
$string['displayformatfaq'] = 'FAQ';
$string['displayformatfullwithauthor'] = 'Completo com autor';
$string['displayformatfullwithoutauthor'] = 'Completo sem autor';
$string['displayformat_help'] = '<P>Esta configuração define o modo em que cada item será visualizado no glossário. Os formatos predefinidos são:</p>

<dl>
<dt><b>Dicionário simples</b>:</dt>
<dd>Um dicionário convencional com os itens separados; os autores não são indicados e os anexos são mostrados como links.</dd>
<dt><b>Contínuo sem autor</b>:</dt>
<dd>Mostra os itens um após o outro sem qualquer tipo de separação além dos ícones de edição.</dd>
<dt><b>Completo com Autor</b>:</dt>
<dd>Visualiza os itens com o mesmo formato de um fórum, incluindo os dados do autor; os anexos são mostrados como links.</dd>
<dt><b>Completo sem Autor</b>:</dt>
<dd>Visualiza os itens com o mesmo formato de um fórum, sem os dados do autor; os anexos são mostrados como links.</dd>
<dt><b>Enciclopédia</b>:</dt>
<dd>Mesmas características do formato \'Completo com Autor\' mas as imagens anexadas são visualizadas no texto.</dd>
<dt><b>Lista de itens</b>:</dt>
<dd>Lista os conceitos como links.</dd>
<dt><b>FAQ</b>:</dt>
<dd>Edita items como listas de Perguntas Frequentes (FAQ) e anexa as palavras PERGUNTA e RESPOSTA respectivamente ao conceito e à definição.</dd>
</dl>

<hr />
<p>Os Administradores podem criar novos formatos de visualização seguindo as instruções presentes no arquivo <b>mod/glossary/formats/README.txt</b>.</p>';
$string['displayformats'] = 'Mostrar formatos';
$string['displayformatssetup'] = 'Mostrar configuração de formatos';
$string['duplicatecategory'] = 'Duplicar categoria';
$string['duplicateentry'] = 'Duplicar item';
$string['editalways'] = 'Editar sempre';
$string['editalways_help'] = '<P>Esta opção define se os estudantes são autorizados a editar os seus itens a qualquer momento os textos.

<P>Você pode selecionar:

<UL>
<LI><B>Sim:</B> Os itens sempre são editáveis.

<LI><B>Não:</B> Os itens só são editáveis durante o período definido.
</UL>';
$string['editcategories'] = 'Editar categorias';
$string['editentry'] = 'Editar item';
$string['editingcomment'] = 'Editando comentário';
$string['entbypage'] = 'Número de itens mostrados em cada página';
$string['entries'] = 'Itens';
$string['entrieswithoutcategory'] = 'Itens não catalogados';
$string['entry'] = 'Item';
$string['entryalreadyexist'] = 'Este item já existe';
$string['entryapproved'] = 'Este item foi aprovado';
$string['entrydeleted'] = 'Item cancelado';
$string['entryexported'] = 'Item exportado com sucesso';
$string['entryishidden'] = '(este item está escondido)';
$string['entryleveldefaultsettings'] = 'Configurações predefinidas';
$string['entrysaved'] = 'Este item foi salvo';
$string['entryupdated'] = 'Este item foi atualizado';
$string['entryusedynalink'] = 'Link automático';
$string['entryusedynalink_help'] = '<p>Quando esta função está ativada é possível criar links automáticos aos itens do glossário toda vez que o conceito/título aparecer em textos do mesmo curso. Isto inclui mensagens em fóruns, materiais, sumários, etc. </p>

<p>Para evitar que sejam criados links em um texto específico é necessário adicionar as tags  &lt;nolink&gt; e &lt;/nolink&gt; antes e depois do texto em questão.</p>

<p>Esta função só é aplicada quando a criação automática de links é ativada no painel de configuração do glossário respectivo.</p>';
$string['errcannoteditothers'] = 'Você não pode editar itens criados por outras pessoas.';
$string['errconceptalreadyexists'] = 'Este conceito já existe. Não é permitida a criação de outras versões.';
$string['errdeltimeexpired'] = 'Você não pode excluir isto. Tempo expirou!';
$string['erredittimeexpired'] = 'O tempo de edição deste conceito terminou.';
$string['errorparsingxml'] = 'Ocorreram erros: verifique o código do arquivo XML.';
$string['explainaddentry'] = 'Adicionar um novo item.<br />Conceito e definição são campos obrigatórios.';
$string['explainall'] = 'Mostrar todos os itens em uma página';
$string['explainalphabet'] = 'Navegar usando este índice';
$string['explainexport'] = 'Foi criado um novo arquivo.<br /> Baixe o arquivo em um espaço seguro. Você pode importar este arquivo neste curso ou em um outro curso quando você quiser.';
$string['explainimport'] = 'Você deve definir o arquivo a ser importado e os critérios de importação.<br /> Faça o envio e controle os resultados.';
$string['explainspecial'] = 'Mostrar itens que não iniciam com letras';
$string['exportedentry'] = 'Exportar item';
$string['exportentries'] = 'Exportar itens';
$string['exportentriestoxml'] = 'Exportar itens em formato XML';
$string['exportfile'] = 'Exportar itens';
$string['exportglossary'] = 'Exportar glossário';
$string['exporttomainglossary'] = 'Exportar glossário principal';
$string['filetoimport'] = 'Arquivo a ser importado';
$string['filetoimport_help'] = '<P>Selecione no seu computador o arquivo XML que contém os itens que você quer importar.</p>';
$string['fillfields'] = 'Conceito e definição são campos obrigatórios';
$string['filtername'] = 'Links automáticos ao glossário';
$string['fullmatch'] = 'Criar links apenas a partir de palavras inteiras';
$string['fullmatch_help'] = '<p>Se ativada, esta opção estabelece que os links criados automaticamente devem ser associados apenas a palavras inteiras

<p>Por exemplo: um item chamado "carro" não dará origem a um link incluído na palavra "carroça".</p>';
$string['glossary:approve'] = 'Aprovar itens pendentes';
$string['glossary:comment'] = 'Criar comentários';
$string['glossary:export'] = 'Exportar itens';
$string['glossary:exportentry'] = 'Exportar única entrada';
$string['glossary:exportownentry'] = 'Exportar suas entradas únicas';
$string['glossary:import'] = 'Importar itens';
$string['glossaryleveldefaultsettings'] = 'Configurações predefinidas do glossário';
$string['glossary:managecategories'] = 'Gerenciar categorias';
$string['glossary:managecomments'] = 'Gerenciar comentários';
$string['glossary:manageentries'] = 'Gerenciar itens';
$string['glossary:rate'] = 'Avaliar itens';
$string['glossarytype'] = 'Tipo de glossário';
$string['glossarytype_help'] = '<P>O sistema de glossários permite que você exporte itens a partir de qualquer glossário secundário para o glossário principal do curso. Para tal, você deve definir um dos glossários do curso como glossário principal.</p>

<p>Nota: cada curso pode ter apenas um glossário principal.</p>

<p>Antes do Moodle 1.7, apenas os professores podiam editar o glossário principal. A partir do Moodle 1.7, se você desejar controlar quem pode editar qualquer glossário (incluindo o principal) você precisa usar a interface de funções de Sobreposição.</p>';
$string['glossary:view'] = 'Ver glossário';
$string['glossary:viewallratings'] = 'Visualizar todas as avaliações enviadas por indivíduos';
$string['glossary:viewanyrating'] = 'Ver avaliação total que todos receberam';
$string['glossary:viewrating'] = 'Ver as suas avaliações';
$string['glossary:write'] = 'Criar novos itens';
$string['guestnoedit'] = 'Visitantes não tem permissão para editar glossários';
$string['importcategories'] = 'Importar categorias';
$string['importedcategories'] = 'Categorias importadas';
$string['importedentries'] = 'Itens importados';
$string['importentries'] = 'Importar itens';
$string['importentriesfromxml'] = 'Importar itens do arquivo XML';
$string['includegroupbreaks'] = 'Incluir separação de grupos';
$string['isglobal'] = 'Selecionar o box para definir o glossário como glossário global';
$string['isglobal_help'] = '<p>Apenas os Administradores e usuários com capacidades ilimitadas no site podem configurar um glossário como global.</p>

<p>Estes glossários podem ser utilizados em todos os cursos.</p>

<p>Os links automáticos criados a partir dos itens de um glossário global incluem todas as páginas do site enquanto os links automáticos criados a partir de um glossário normal são presentes apenas nas páginas do curso específico associado àquele glossário</p>';
$string['letter'] = 'letra';
$string['linkcategory'] = 'Fazer o link automático desta categoria';
$string['linkcategory_help'] = '<P>Você pode definir se os nomes das categorias, como os itens, geram links automaticamente ou não.</p>

<p>Os links que levam às categorias são sensíveis às diferenças entre maiúsculas e minúsculas, e consideram apenas palavras inteiras.</p>';
$string['linking'] = 'Auto-link';
$string['mainglossary'] = 'Glossário principal';
$string['maxtimehaspassed'] = 'Sinto muito, mas o período de edição deste comentário ({$a}) terminou';
$string['modulename'] = 'Glossário';
$string['modulename_help'] = 'O glossary module permite que os membros do fórum criem e manteham uma lista de termos, como um dicionário.
As entradas no glossário podem ser linkadas automaticamente a quqlauqer palavra ou frase.';
$string['modulenameplural'] = 'Glossários';
$string['newentries'] = 'Novos itens';
$string['newglossary'] = 'Novo glossário';
$string['newglossarycreated'] = 'Novo glossário criado';
$string['newglossaryentries'] = 'Novos itens:';
$string['nocomment'] = 'Nenhum comentário disponível';
$string['nocomments'] = '(Nenhum comentário a este item)';
$string['noconceptfound'] = 'Nenhum conceito ou definição encontrados';
$string['noentries'] = 'Nenhum item disponível nesta seção';
$string['noentry'] = 'Nenhum item disponível';
$string['nopermissiontodelcomment'] = 'Você não pode excluir comentários de outras pessoas!';
$string['nopermissiontodelinglossary'] = 'Você não tem permissão para comentar neste glossário';
$string['nopermissiontoviewresult'] = 'Você só pode pesquisar resultados de seus próprios registros';
$string['notapproved'] = 'Entrada no glossário não está ainda aprovada.';
$string['notcategorised'] = 'Não catalogados';
$string['numberofentries'] = 'Número de itens';
$string['onebyline'] = '(um por linha)';
$string['page-mod-glossary-edit'] = 'Página de entrada para adicionar/editar Glossário';
$string['page-mod-glossary-view'] = 'Visualizar página de edição do glossário';
$string['page-mod-glossary-x'] = 'Qualquer página de módulo do glossário';
$string['pluginadministration'] = 'Administração do glossário';
$string['pluginname'] = 'Glossário';
$string['popupformat'] = 'Formato popup';
$string['printerfriendly'] = 'Versão para impressão';
$string['printviewnotallowed'] = 'A versão para impressão não é permitida';
$string['question'] = 'Questão';
$string['rejectedentries'] = 'Itens rejeitados';
$string['rejectionrpt'] = 'Relatório de rejeição';
$string['resetglossaries'] = 'Cancele itens de';
$string['resetglossariesall'] = 'Cancele itens de todos os glossários';
$string['rssarticles'] = 'Número de artigos RSS recentes';
$string['rssarticles_help'] = '<P>Esta configuração permite que você selecione o número de artigos
   a serem incluídos no feed RSS.</p>

<P>Um número entre 5 e 20 é considerado apropriado para a maioria dos
   glossários. Aumente este número se o glossário for constantemente atualizado.</p>';
$string['rsssubscriberss'] = 'Mostrar \'{$a}\' conceitos no feed RSS';
$string['rsstype'] = 'RSS feed para esta atividade';
$string['rsstype_help'] = '<P>Esta opção permite que sejam criados alimentadores RSS neste glossário.

<P>Você pode escolher dois tipos de Feeds:

<UL>
<LI><B>Com autor -</B> os alimentadores criados incluem
       o nome do autor em cada artigo.</li>

<LI><B>Sem autor -</B> os alimentadores criados não incluem
       o nome do autor em nenhum artigo.</li>
</UL>';
$string['searchindefinition'] = 'Buscar em todo o texto';
$string['secondaryglossary'] = 'Glossário secundário';
$string['showall'] = 'Mostrar o link \'TODOS\'';
$string['showall_help'] = '<P>A navegação e a pesquisa estão sempre disponíveis em um glossário. Para configurar as características de navegação do glossário, é possível definir os seguintes parâmetros:</p>

<p><b>Mostrar \'ESPECIAL\' :</b> Habilita ou desabilita o menu de navegação por caracteres especiais tais como @, #, etc.</p>

<p><b>Mostrar \'ALFABETO\':</b> Habilita ou desabilita o menu de navegação por letras do alfabeto.</p>

<p><b>Mostrar \'TODOS\' :</b> Habilita ou desabilita a navegação de todos os itens de uma só vez.</p>';
$string['showalphabet'] = 'Mostrar alfabeto';
$string['showalphabet_help'] = '<P>A navegação e a pesquisa estão sempre disponíveis em um glossário. Para configurar as características de navegação do glossário, é possível definir os seguintes parâmetros:</p>

<p><b>Mostrar \'ESPECIAL\' :</b> Habilita ou desabilita o menu de navegação por caracteres especiais tais como @, #, etc.</p>

<p><b>Mostrar \'ALFABETO\':</b> Habilita ou desabilita o menu de navegação por letras do alfabeto.</p>

<p><b>Mostrar \'TODOS\' :</b> Habilita ou desabilita a navegação de todos os itens de uma só vez.</p>';
$string['showspecial'] = 'Mostrar link \'ESPECIAL\'';
$string['showspecial_help'] = '<P>A navegação e a pesquisa estão sempre disponíveis em um glossário. Para configurar as características de navegação do glossário, é possível definir os seguintes parâmetros:</p>

<p><b>Mostrar \'ESPECIAL\' :</b> Habilita ou desabilita o menu de navegação por caracteres especiais tais como @, #, etc.</p>

<p><b>Mostrar \'ALFABETO\':</b> Habilita ou desabilita o menu de navegação por letras do alfabeto.</p>

<p><b>Mostrar \'TODOS\' :</b> Habilita ou desabilita a navegação de todos os itens de uma só vez.</p>';
$string['sortby'] = 'Ordenar por';
$string['sortbycreation'] = 'Por data de criação';
$string['sortbylastupdate'] = 'Por data de atualização';
$string['sortchronogically'] = 'Por ordem cronológica';
$string['special'] = 'Especial';
$string['standardview'] = 'Por ordem alfabética';
$string['studentcanpost'] = 'Estudantes podem adicionar itens';
$string['totalentries'] = 'Total de itens';
$string['usedynalink'] = 'Fazer o link automático dos itens';
$string['usedynalink_help'] = '<P>Esta opção habilita a criação automática de links que levam aos itens do glossário sempre que
   as palavras ou frases definidas como itens estiverem presentes nos textos do curso. Isto inclui as mensagens do fórum, materiais do curso, sumários das semanas, diários, etc.</p>

<p>Se você não quiser que um texto tenha links, você deve adicionar os tags  &lt;nolink> e &lt;/nolink> ao redor do texto.</p>

<p>Os nomes das categorias também dão origem a links nos textos.</p>';
$string['waitingapproval'] = 'Itens pendentes';
$string['warningstudentcapost'] = '(Não é aplicável ao glossário principal)';
$string['withauthor'] = 'Conceitos com autor';
$string['withoutauthor'] = 'Conceitos sem autor';
$string['writtenby'] = 'por';
$string['youarenottheauthor'] = 'Apenas o autor do comentário pode editá-lo';
