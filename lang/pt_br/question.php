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
 * Strings for component 'question', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   question
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['action'] = 'Ação';
$string['addanotherhint'] = 'Adicionar outra dica';
$string['addcategory'] = 'Adicionar categoria';
$string['adminreport'] = 'Reportar possíveis problemas no banco de questões.';
$string['answer'] = 'Resposta';
$string['answersaved'] = 'Resposta salva';
$string['attemptfinished'] = 'Tentativa finalizada';
$string['attemptfinishedsubmitting'] = 'Envio de tentativa finalizada:';
$string['availableq'] = 'Disponível?';
$string['badbase'] = 'Base erradas abtes de **: {$a}**';
$string['behaviour'] = 'Comportamento';
$string['behaviourbeingused'] = 'Comportamento utilizado: {$a}';
$string['broken'] = 'Este é um "link quebrado", ele aponta para um arquivo inexistente.';
$string['byandon'] = 'por <em>{$a->user}</em> em <em>{$a->time}</em>';
$string['cannotcopybackup'] = 'Não foi possível copiar o arquivo de backup';
$string['cannotcreate'] = 'Não foi possível criar uma nova entrada na tabela question_attempts';
$string['cannotcreatepath'] = 'Não se pode criar o caminho: {$a}';
$string['cannotdeletebehaviourinuse'] = 'Você não pode apagar o comportamento \'{$a}\'. Ele está sendo usado em tentativas.';
$string['cannotdeletecate'] = 'Não se pode eliminar a categoría por ser a categoría padrão para este contexto.';
$string['cannotdeletemissingbehaviour'] = 'Você não pode desinstalar o comportamento faltante. Ele é requerido pelo sistema.';
$string['cannotdeletemissingqtype'] = 'Você não pode excluir o tipo de questão que está faltando. Ele é necessário para o sistema.';
$string['cannotdeleteneededbehaviour'] = 'Impossível apagar o comportamento de questão \'{$a}\'. Há outros comportamentos instalados que dependem deste.';
$string['cannotdeleteqtypeinuse'] = 'Você não pode apagar o tipo de questão \'{$a}\'. Existem questões desse tipo no banco de questões.';
$string['cannotdeleteqtypeneeded'] = 'Você não pode excluir o tipo de questão \'{$a}\'. Existem outros tipos de questão instalados que dependem dele.';
$string['cannotenable'] = 'O tipo de pergunta {$a} não pode ser criado diretamente.';
$string['cannotenablebehaviour'] = 'O comportamento de questão {$a} não pode ser usado diretamente. Ele é somente para uso interno.';
$string['cannotfindcate'] = 'Não foi possível encontrar o registro da categoría.';
$string['cannotfindquestionfile'] = 'Não foi possível encontrar o arquivo de perguntas no zip';
$string['cannotgetdsfordependent'] = 'Não foi possível obter o conjunto de dados especificado para uma pergunta dependente de conjunto de dados! (pergunta: {$a->id}, datasetitem: {$a->item})';
$string['cannotgetdsforquestion'] = 'Não foi possível obter o conjunto de dados para uma pergunta calculada! (pergunta: {$a})';
$string['cannothidequestion'] = 'Não foi capaz de esconder a pergunta';
$string['cannotimportformat'] = 'Desculpe, a importação deste formato ainda não foi desenvolvida!';
$string['cannotinsertquestion'] = 'Não foi possível inserir nova questão!';
$string['cannotinsertquestioncatecontext'] = 'Não foi possível inserir a nova categoría de perguntas {$a->cat} contextid ilegal {$a->ctx}';
$string['cannotloadquestion'] = 'Não foi possível carregar questão';
$string['cannotmovequestion'] = 'Você não pode utilizar este script para mover questões que têm arquivos associados de diferentes áreas.';
$string['cannotopenforwriting'] = 'Impossível abrir para escrever: {$a}';
$string['cannotpreview'] = 'Você não pode pré-visualizar estas questões!';
$string['cannotread'] = 'Impossível ler arquivo de importação (ou o arquivo é vazio)';
$string['cannotretrieveqcat'] = 'Não foi possível recuperar a categoria de pergunta';
$string['cannotunhidequestion'] = 'Falha ao exibir a pergunta.';
$string['cannotunzip'] = 'Não foi possível descompactar o arquivo.';
$string['cannotwriteto'] = 'Não foi possível escrever perguntas exportadas para {$a}';
$string['category'] = 'Categoria';
$string['categorycurrent'] = 'Categoria atual';
$string['categorycurrentuse'] = 'Usar essa categoria';
$string['categorydoesnotexist'] = 'Esta categoria não existe';
$string['categoryinfo'] = 'Informações da categoria';
$string['categorymove'] = 'A categoria \'{$a->name}\' contém {$a->count} perguntas.  Por favor transfira as perguntas para outra categoria.';
$string['categorymoveto'] = 'Gravar na categoria';
$string['categorynamecantbeblank'] = 'O nome da categoria não pode ser deixado em branco.';
$string['changeoptions'] = 'Alterar opções';
$string['changepublishstatuscat'] = '<a href="{$a->caturl}">A categoria "{$a->name}"</a> no curso "{$a->coursename}" terá seu status de compartilhamento trocado de <strong>{$a->changefrom} para {$a->changeto}</strong>.';
$string['check'] = 'Verificar';
$string['chooseqtypetoadd'] = 'Escolha um tipo de questão para adicionar';
$string['clearwrongparts'] = 'Limpar repostas incorretas';
$string['clickflag'] = 'Marcar questão';
$string['clicktoflag'] = 'Marcar questão para referência futura';
$string['clicktounflag'] = 'Remover marcação';
$string['clickunflag'] = 'Remover rótulo';
$string['closepreview'] = 'Fechar preview';
$string['combinedfeedback'] = 'Feedback combinado';
$string['comment'] = 'Comentário';
$string['commented'] = 'Comentado : {$a}';
$string['commentormark'] = 'Faça um comentário ou modifique a avaliação';
$string['comments'] = 'Comentários';
$string['commentx'] = 'Comentário: {$a}';
$string['complete'] = 'Completo';
$string['contexterror'] = 'Você não devería estar aqui se você não está movendo uma categoría para outro contexto.';
$string['copy'] = 'Copiar de {$a} e mudar links.';
$string['correct'] = 'Correto';
$string['correctfeedback'] = 'Para cada resposta correta';
$string['created'] = 'Criado';
$string['createdby'] = 'Criado por';
$string['createdmodifiedheader'] = 'Criado/modificado';
$string['createnewquestion'] = 'Criar uma nova questão ...';
$string['cwrqpfs'] = 'Questões aleatórias selecionando questões de sub categorias.';
$string['cwrqpfsinfo'] = '<p>Durante a migração para o Moodle 1.9 iremos separar categorias de questões em diferentes contextos. Algumas categorias de questões e algumas questões terão seu status de compartilhamento alterado. Isto é necessário em um caso raro quando uma ou mais questões \'aleatória\' em um questionário são configuradas para selecionar de uma mistura de categorias compartilhadas e não compartilhadas(como é o caso neste site).Isto acontece quando uma questão \'aleatória\' é configurada para selecionar de subcategorias e uma ou mais subcategorias tem status diferentes de compartilhamento com a categoria ascendente na qual a questão \'aleatória\' é criada.</p><p>As categorias de questões seguintes, das quais as questões \'aleatórias\' em categorias ascendentes são selecionadas, terão o seu status de compartilhamento alterado para o mesmo status de compartilhamento da categoria que contém a questão \'aleatória\' quando da migração para o Moodle 1.9. As categorias seguintes terão seus status de compartilhamento alterado. Questões que são afetadas continuarão a funcionar em todos os questionários até que você as remova destes questionários.</p>';
$string['cwrqpfsnoprob'] = 'Nenhuma categoria de questões no seu site é afetada pelo problema de \'Selecionar questões aleatórias de subcategorias\'';
$string['decimalplacesingrades'] = 'Casas decimais no avaliação';
$string['defaultfor'] = 'Padrão para {$a}';
$string['defaultinfofor'] = 'A categoria padrão para as questões compartilhadas no contexto \'{$a}\'.';
$string['defaultmark'] = 'Marcação padrão';
$string['deletebehaviourareyousure'] = 'Eliminar comportamento {$a} : você tem certeza ?';
$string['deletebehaviourareyousuremessage'] = 'Você está prestes a apagar completamente o comportamento de questão {$a}. Isso irá apagar completamente da base de dados tudo associado a este comportamento de questão. Você está CERTO de que quer continuar?';
$string['deletecoursecategorywithquestions'] = 'Existem questões deste banco associadas à esta categoria de curso. Se você continuar, serão apagadas. Use a interface de administração do banco de questões para transferir as questões.';
$string['deleteqtypeareyousure'] = 'Você tem certeza que quer excluir o tipo de questão \'{$a}\' ?';
$string['deleteqtypeareyousuremessage'] = 'Você está prestes a excluir completamente o tipo de questão \'{$a}\'. Você tem certeza que quer desinstalá-lo?';
$string['deletequestioncheck'] = 'Você tem absoluta certeza que deseja excluir \'{$a}\'';
$string['deletequestionscheck'] = 'Você está absolutamente certo que quer excluir as seguintes questões?<br /><br />{$a}';
$string['deletingbehaviour'] = 'Eliminando comportamento da questão \'{$a}\'';
$string['deletingqtype'] = 'Excluindo tipo de questão \'{$a}\'';
$string['didnotmatchanyanswer'] = '[Não confere com nenhuma resposta ]';
$string['disabled'] = 'Desativado';
$string['disterror'] = 'A distribuição {$a} causou problemas';
$string['donothing'] = 'Não copie, mova arquivos ou mude os links.';
$string['editcategories'] = 'Editar categorias';
$string['editcategories_help'] = 'Em vez de manter todas as questões em uma lista grande, você pode criar categorias e sub-categorias.
Cada categoria possui um contexto que determina onde a questão pode ser usada:
*Contexto da atividade - Questões somente disponíveis no módulo da atividade
*Contexto do curso - Questões disponíveis em todos os módulos de atividade daquele curso
*Contexto da categoria de curso - Questões disponíveis em todos os módulos de atividade de todos os cursos daquela categoria
Categorias também são utilizadas em questionários com questões randômicas que são selecionadas de uma categoria particular.';
$string['editcategory'] = 'Editar categoria';
$string['editingcategory'] = 'Editando a categoria';
$string['editingquestion'] = 'Editando uma questão';
$string['editquestion'] = 'Editar questão';
$string['editquestions'] = 'Editar questões';
$string['editthiscategory'] = 'Editar esta categoria';
$string['emptyxml'] = 'Erro desconhecido - imsmanifest.xm vazio';
$string['enabled'] = 'Ativado';
$string['erroraccessingcontext'] = 'Não pode acessar o contexto';
$string['errordeletingquestionsfromcategory'] = 'Erro excluindo questões da categoria {$a}.';
$string['errorduringpost'] = 'Erro ocorreu durante o pós-processamento!';
$string['errorduringpre'] = 'Erro ocorreu durante o pré-processamento!';
$string['errorduringproc'] = 'Erro ocorreu durante o processamento!';
$string['errorduringregrade'] = 'Não foi possível reavaliar a pergunta {$a->qid}, indo para o estado {$a->stateid}.';
$string['errorfilecannotbecopied'] = 'Erro, impossível copiar arquivo {$a}.';
$string['errorfilecannotbemoved'] = 'Erro, impossível mover arquivo {$a}.';
$string['errorfileschanged'] = 'Erro, os arquivos ligados às questões foram mudados depois que o formulário foi mostrado.';
$string['errormanualgradeoutofrange'] = 'A nota {$a->grade} não está entre 0 e {$a->maxgrade} na questão {$a->name}. A pontuação e o comentário não foram salvos.';
$string['errormovingquestions'] = 'Erro movendo as questões com id {$a}.';
$string['errorpostprocess'] = 'Erro ocorreu durante o pós-processamento!';
$string['errorpreprocess'] = 'Erro ocorreu durante o pré-processamento!';
$string['errorprocess'] = 'Erro ocorreu durante o processamento!';
$string['errorprocessingresponses'] = 'Um erro ocorreu durante o processamento das suas respotas ({$a}). Clique em Continuar para retornar à página em que você estava para tentar novamente.';
$string['errorsavingcomment'] = 'Erro salvando o comentário da questão {$a->name}.';
$string['errorsavingflags'] = 'Erro ao salvar o estado da marcação.';
$string['errorupdatingattempt'] = 'Erro atualizando a tentativa {$a->id}.';
$string['exportcategory'] = 'Exportar categoria';
$string['exportcategory_help'] = '## Categoria de Exportação
A lista **Categoria:** que se abre é usada para selocionar a categoria da qual as questões para exportação serão tiradas.
Alguns formatos de importação (GIFT e Formato XML) permitem a categoria ser incluída no arquivo gravado, possibilitando que as categorias (opcionalmente) sejam recriadas na importação. Para que esta informação seja incluída a caixa **para o arquivo** deve ser marcada.';
$string['exporterror'] = 'Erros ocorreram durante a exportação!';
$string['exportfilename'] = 'questionario';
$string['exportnameformat'] = '%Y%m%d-%H%M';
$string['exportquestions'] = 'Exportar questões para o arquivo';
$string['exportquestions_help'] = 'Esta função permite exportar completamente uma categoria (e quaisquer subcategorias) de questões para um arquivo. Por favor, note que, dependendo do tipo de arquivo selecionado, alguns tipos de questões e alguns dados das questões podem não ser exportados.';
$string['feedback'] = 'Feedback';
$string['filecantmovefrom'] = 'Os arquivos de perguntas não podem ser movidos porque você não tem permissão para remover arquivos do local que você está trazendo as questões.';
$string['filecantmoveto'] = 'Os arquivos de perguntas não podem ser movidos ou copiados porque você não tem permissão para adicionar arquivos no local para onde está levando as questões.';
$string['fileformat'] = 'Formato de aquivo';
$string['filesareacourse'] = 'a área de arquivos do curso';
$string['filesareasite'] = 'a área de arquivos do site';
$string['filestomove'] = 'Mover / copiar arquivos para {$a}?';
$string['fillincorrect'] = 'Preencher com respostas corretas';
$string['flagged'] = 'Marcada';
$string['flagthisquestion'] = 'Marcar esta pergunta';
$string['formquestionnotinids'] = 'O formulário continha questões que não estavam entre os questionids';
$string['fractionsnomax'] = 'Uma das respostas deve ter valor de 100% para que seja possível obter a nota total.';
$string['generalfeedback'] = 'Feedback geral';
$string['generalfeedback_help'] = 'Feedback geral é mostrado ao aluno após ele completar a tentativa da. Diferentemente do feedback, que depende do tipo de questão e da resposta que o aluno deu, o mesmo feedback geral aparece para todos os alunos.
Você pode usar o feedback geral para dar aos alunos algumas informações sobre o tipo de conhecimento que a questão está testando, ou dá-los um link com mais informações que eles possam usar caso não tenham entendido a questão.';
$string['getcategoryfromfile'] = 'Tirar categoria do arquivo';
$string['getcontextfromfile'] = 'Tirar contexto do arquivo';
$string['hidden'] = 'Escondido';
$string['hintn'] = 'Dica {no}';
$string['hinttext'] = 'Texto da dica';
$string['howquestionsbehave'] = 'Como se comportam as questões';
$string['howquestionsbehave_help'] = 'Alunos podem interagir com as questões no questionário de várias formas. Por exemplo, você pode querer que os alunos dêem uma resposta para todas as questões e depois submetam o questionário inteiro, antes de ser avaliado ou receber qualquer feedback. Esse é o modo \'Feedbak adiado\'. Alternativamente, você pode querer que seus alunos submetam cada questão à medida que eles avançam para receber feedback imediato, e se eles não acertarem de primeira, tenham outra chance por uma pontuação menor. Esse é o modo \'Interativo com múltiplas tentativas\'.';
$string['ignorebroken'] = 'Ignorar links quebrados';
$string['importcategory'] = 'Importar categoria';
$string['importcategory_help'] = 'A lista **Categoria:** que se abre é usada para selecionar a categoria na qual as questões da Importação serão colocadas.
Alguns formatos de importação (GIFT e Formato XML) permitem que a categoria seja específicada no arquivo de importação. Para que isto aconteça a caixa **vindo do arquivo** deve ser marcada. Se não for, as questões irão para as categorias selecionadas independente de qualquer instrução dentro do arquivo.
Quando categorias são especificadas dentro do arquivo de importação e não existem, elas são criadas automáticamente.';
$string['importerror'] = 'Ocorreu um erro durante o processo de importação';
$string['importerrorquestion'] = 'Erro importando questão';
$string['importfromcoursefiles'] = '...ou escolha um arquivo de curso para importar.';
$string['importfromupload'] = 'Selecione um arquivo para enviar...';
$string['importingquestions'] = 'Importando {$a} questões do arquivo';
$string['importparseerror'] = 'Um ou mais erros foram encontrados ao ler o arquivo de importação. Nenhuma questão foi importada. Para importar as questões em bom estado tente novamente com a configuração "Parar se houver erro" definida como "Não".';
$string['importquestions'] = 'Importar questões do arquivo';
$string['importquestions_help'] = 'Esta funcão possibilita a importação de perguntas em distintos formatos por meio de um arquivo de texto. Observe que o arquivo deve ter a codificação UTF-8.';
$string['importwrongfiletype'] = 'O tipo do arquivo selecionado ({$a->actualtype}) não corresponde ao tipo de arquivo esperado para o formato de importação ({$a->expectedtype}).';
$string['impossiblechar'] = 'Detectado o caractere impossível {$a} como parênteses';
$string['includesubcategories'] = 'Também mostrar questões de sub-categorias';
$string['incorrect'] = 'Incorreto';
$string['incorrectfeedback'] = 'Para qualquer resposta incorreta';
$string['information'] = 'Informação';
$string['invalidanswer'] = 'Resposta incompleta';
$string['invalidarg'] = 'Nenhum argumento válido fornecido ou configuração incorreta do servidor';
$string['invalidcategoryidforparent'] = 'Id inválido para categoria pai!';
$string['invalidcategoryidtomove'] = 'Id inválido da categoria a mover!';
$string['invalidconfirm'] = 'String de confirmação estava incorreta';
$string['invalidcontextinhasanyquestions'] = 'Contexto inválido para question_context_has_any_questions.';
$string['invalidpenalty'] = 'Penalidade inválida';
$string['invalidwizardpage'] = 'A página de ajuda é incorreta ou não está especificada.';
$string['lastmodifiedby'] = 'Última modificação por';
$string['linkedfiledoesntexist'] = 'Arquivo associado {$a} não existe';
$string['makechildof'] = 'Criar descendente de \'{$a}\'';
$string['makecopy'] = 'Criar cópia';
$string['maketoplevelitem'] = 'Mover para o nível mais alto';
$string['manualgradeoutofrange'] = 'Esta nota está fora do intervalo válida.';
$string['manuallygraded'] = 'Avaliado manualmente com {$a->mark} e comentário:';
$string['mark'] = 'Nota';
$string['markedoutof'] = 'Valor da questão';
$string['markedoutofmax'] = 'Vale {$a} ponto(s).';
$string['markoutofmax'] = 'Atingiu {$a->mark} de {$a->max}';
$string['marks'] = 'Pontos';
$string['matcherror'] = 'Avaliações não correspondem às opções de avaliação -';
$string['matchgrades'] = 'Avaliações associadas';
$string['matchgrades_help'] = 'As notas importadas **devem** coincidir com uma das notas
válidas da lista predeterminada, como abaixo...

* 100%
* 90%
* 80%
* 75%
* 70%
* 66.666%
* 60%
* 50%
* 40%
* 33.333
* 30%
* 25%
* 20%
* 16.666%
* 14.2857
* 12.5%
* 11.111%
* 10%
* 5%
* 0%

Valores negativos da lista também são
permitidos.
Há duas configurações para esta chave. Elas afetam como
a rotina de importação trata os valores que não coincidem **exatamente**
com um dos valores da lista acima.

\* **|Erro se a nota não está na lista**
Se a pergunta contem qualquer nota não encontrada na lista um erro é mostrado
e a pergunta não será importada.
\* **|Nota mais próxima se não está na lista**
Se a nota não coincide com um valor da lista, a nota é alterada
para o valor mais próximo da lista.

*Nota: alguns formatos personalizados de importação escrevem diretamente no banco de dados e podem ignorar esta checagem.*';
$string['matchgradeserror'] = 'Erro caso notas não estejam listadas';
$string['matchgradesnearest'] = 'Nota mais próxima, se não listada';
$string['missingcourseorcmid'] = 'É necessário fornecer o courseid ou cmid para print_question.';
$string['missingcourseorcmidtolink'] = 'É necessário fornecer o courseid ou cmid para get_question_edit_link.';
$string['missingimportantcode'] = 'Neste tipo de questão falta código importante: {$a}.';
$string['missingoption'] = 'A questão {$a} cloze está faltando suas opções';
$string['modified'] = 'Último salvo';
$string['move'] = 'Mover de {$a} e mudar links';
$string['movecategory'] = 'Mover Categoria';
$string['movedquestionsandcategories'] = 'Questões e categorias movidas de {$a->oldplace} para {$a->newplace}.';
$string['movelinksonly'] = 'Apenas mudar para onde os links apontam, não mover ou copiar arquivos.';
$string['moveq'] = 'Mover pergunta(s)';
$string['moveqtoanothercontext'] = 'Mover pergunta para outro contexto';
$string['moveto'] = 'Mover para >>';
$string['movingcategory'] = 'Movendo categoria';
$string['movingcategoryandfiles'] = 'Você tem certeza que deseja mover a categoria {$a->name} e todas as categorias descendentes para o contexto "{$a->contextto}"?<br /> Foram detectados {$a->urlcount} arquivos ligados a questões em {$a->fromareaname}, você gostaria de copiar ou mover isto para {$a->toareaname}?';
$string['movingcategorynofiles'] = 'Você tem certeza que deseja mover a categoria "{$a->name}" e todas as categorias descendentes para o contexto "{$a->contextto}"?';
$string['movingquestions'] = 'Movendo perguntas e todos os arquivos';
$string['movingquestionsandfiles'] = 'Você tem certeza que deseja mover a(s) questõe(s) {$a->questions} para o contexto de <strong>"{$a->tocontext}"</strong>?<br /> Foram detectados <strong>{$a->urlcount} arquivos</strong> ligados a esta(s) questão(s) em {$a->fromareaname}, você quer copiar ou mover isto para {$a->toareaname}?';
$string['movingquestionsnofiles'] = 'Você tem certeza que deseja mudar as questões {$a->questions} para o contexto <strong>"{$a->tocontext}"</strong>?<br />  <strong>Não existem arquivos</strong> ligados a estas questões em {$a->fromareaname}.';
$string['needtochoosecat'] = 'Você precisa escolher uma categoria para mover as questões, ou então clicar em \'cancelar\'.';
$string['nocate'] = 'Categoría {$a} inexistente!';
$string['nopermissionadd'] = 'Você não tem permissão para adicionar questões aqui.';
$string['nopermissionmove'] = 'Você não tem permissão para remover estas questões. Você pode salvar a questão nesta categoria ou salvá-la como nova pergunta.';
$string['noprobs'] = 'Nenhum problema encontrado no banco de dados da sua pergunta.';
$string['noquestions'] = 'Nenhuma questão encontrada pode ser exportada. Certifique-se de que você selecionou uma categoria que contem questões para exportar.';
$string['noquestionsinfile'] = 'Nenhuma questão presente no arquivo importado';
$string['noresponse'] = '[Não há resposta]';
$string['notanswered'] = 'Não respondido';
$string['notenoughanswers'] = 'Este tipo de questão requer pelo menos {$a} respostas';
$string['notenoughdatatoeditaquestion'] = 'Não foram especificados: id da questão, id da categoria e tipo de questão.';
$string['notenoughdatatomovequestions'] = 'Você precisa fornecer os ids das questões que você quer mover.';
$string['notflagged'] = 'Não marcada';
$string['notgraded'] = 'Não avaliada';
$string['notshown'] = 'Não exibido';
$string['notyetanswered'] = 'Ainda não respondida';
$string['notyourpreview'] = 'Esta pré-visualização não pertence a você';
$string['novirtualquestiontype'] = 'Nenhum tipo de questão virtual para o tipo de pergunta {$a}';
$string['numqas'] = 'Sem tentativas de questão';
$string['numquestions'] = 'Número de questões';
$string['numquestionsandhidden'] = '{$a->numquestions} (+{$a->numhidden} ocultas)';
$string['options'] = 'Opções';
$string['orphanedquestionscategory'] = 'Questões salvas de categorias excluídas';
$string['orphanedquestionscategoryinfo'] = 'Ocasionalmente, tipicamente devido a erros antigos de software, questões podem permanecer na base de dados mesmo quando a categoria correspondente da questão tenha sido excluída. É claro que isto não deveria acontecer, isto deve ter acontecido no passado neste site. Esta categoria foi criada automaticamente, e as questões órfãs foram movidas para cá, assim você pode gerenciá-las. Observe que qualquer imagem ou arquivos de mídia utilizados por estas questões provavelmente devem ter sido perdidos.';
$string['page-question-category'] = 'Página de categorias de questionário';
$string['page-question-edit'] = 'Página de edição de questões';
$string['page-question-export'] = 'Página de exportação de questões';
$string['page-question-import'] = 'Página de importação de questões';
$string['page-question-x'] = 'Página de qualquer questão';
$string['parent'] = 'Nível superior';
$string['parentcategory'] = 'Categoria pai';
$string['parentcategory_help'] = '## Categoria Pai
A categoria na qual um item deve ser incluído. \'Topo\' significa que essa categoria não estará contida em nenhuma outra.
Normalmente você verá vários \'contextos\' de categoria, que estão em negrito. Perceba que cada contexto tem sua própria hierarquia de categorias. Vá até o final da página para mais informações sobre contextos. Se você não vir esses contextos pode ser que você não tenha permissão para acessar outros contextos.
Se há somente uma categoria no contexto, você não poderá movê-la, já que é necessário que haja ao menos uma em cada um deles.';
$string['parenthesisinproperclose'] = 'Os parênteses antes de ** não foram fechados corretamente em {$a}**';
$string['parenthesisinproperstart'] = 'Os parênteses antes de ** não foram abertos corretamente em {$a}**';
$string['parsingquestions'] = 'Processando questões do arquivo de importação.';
$string['partiallycorrect'] = 'Parcialmente correto';
$string['partiallycorrectfeedback'] = 'Para qualquer resposta parcialmente correta';
$string['penaltyfactor'] = 'Fator de penalidade';
$string['penaltyfactor_help'] = 'Pode-se especificar qual a fração da nota obtida deverá ser subtraída para
cada resposta errada. Isto somente é relevante se o questionário estiver rodando no modo adaptativo
onde o estudante pode fazer repetidas respostas à pergunta. O fator de
penalidade deverá ser um número entre 0 e 1. Um fator de penalidade de 1 significa
que o estudante tem que conseguir a resposta correta na primeira resposta para obter qualquer
crédito por isso no total. Um fator de penalidade de 0 significa que o estudante pode tentar tantas vezes quantas desejar e ainda obter as marcas totais.';
$string['penaltyforeachincorrecttry'] = 'Penalidade para cada tentativa incorreta';
$string['penaltyforeachincorrecttry_help'] = 'Quando empregar suas questões utilizando os comportamentos \'Interativa com múltiplas tentativas\' ou \'Modo adaptativo\', possibilitando que o estudante tenha várias tentativas para acertar a questão, então esta opção controlará o quanto eles serão penalizados para cada tentativa incorreta. O pênalti é uma proporção do total da grade de questões, causando para uma questão que vale três marcas, e o pênalti é 0.3333333, então o estudante irá receber uma nota 3 caso ele responda corretamente pela primeira vez, 2 caso ele rersponda corretamente na segunda tentativa, e um caso responda certo na terceira tentativa.';
$string['permissionedit'] = 'Editar essa questão';
$string['permissionmove'] = 'Mover essa questão';
$string['permissionsaveasnew'] = 'Salvar essa como uma nova questão';
$string['permissionto'] = 'Você tem permissão para:';
$string['previewquestion'] = 'Pré-visualizar questão: {$a}';
$string['published'] = 'compartilhado';
$string['qbehaviourdeletefiles'] = 'Todos os dados associados a este comportamento de questão \'{$a->behaviour}\' foi deletado da base de dados. Para completar a deleção (e impedir que o comportamento seja instalado novamente), você deve apagar este diretório do servidor: {$a->directory}';
$string['qtypedeletefiles'] = 'Todos os dados associados com questões do tipo \'{$a->qtype}\' foram excluídas do banco de dados. Para completar essa exclusão (e evitar que esse tipo de questão se reinstale), você deve agora excluir esse diretório do seu servidor: {$a->directory}';
$string['qtypeveryshort'] = 'T';
$string['questionaffected'] = '<a href="{$a->qurl}">Questão "{$a->name}" ({$a->qtype})</a> está nesta categoria de questão mas também está na <a href="{$a->qurl}">questão "{$a->quizname}"</a> no curso "{$a->coursename}".';
$string['questionbank'] = 'Banco de questões';
$string['questionbehaviouradminsetting'] = 'Configurações de comportamento de questão';
$string['questionbehavioursdisabled'] = 'Comportamentos de questão para desabilitar';
$string['questionbehavioursdisabledexplained'] = 'Digite uma lista, separada por vírgulas, dos comportamentos que você quer que apareçam no menu';
$string['questionbehavioursorder'] = 'Ordem dos comportamentos de questão';
$string['questionbehavioursorderexplained'] = 'Digite uma lista ordenada, separada por vírgulas, dos comportamentos que você quer que apareçam no menu';
$string['questioncategory'] = 'Categoria de questões';
$string['questioncatsfor'] = 'Categorias de questão para \'{$a}\'';
$string['questiondoesnotexist'] = 'Esta questão não existe';
$string['questionidmismatch'] = 'Ids de questão não conferem';
$string['questionname'] = 'Nome da pergunta';
$string['questionno'] = 'Questão {$a}';
$string['questions'] = 'Questões';
$string['questionsaveerror'] = 'Ocorrerem erros durante salvar questão - ({$a})';
$string['questionsinuse'] = '(*Questões marcadas com um asterisco já estão em uso em alguns questionários. Estas questões não serão apagadas dos questionários, mas somente da lista da categoria.)';
$string['questionsmovedto'] = 'Questões ainda utilizadas movidas para "{$a}" na categoria de curso correspondente.';
$string['questionsrescuedfrom'] = 'Questões copiadas do contexto {$a}.';
$string['questionsrescuedfrominfo'] = 'Estas questões (algumas podem estar escondidas) foram salvas quando o contexto {$a} foi apagado pois ainda eram utilizadas.';
$string['questiontext'] = 'Texto da questão';
$string['questiontype'] = 'Tipo de pergunta';
$string['questionuse'] = 'Usar questão nessa atividade';
$string['questionvariant'] = 'Variante de questão';
$string['questionx'] = 'Questão {$a}';
$string['requiresgrading'] = 'Requer avaliação';
$string['responsehistory'] = 'Histórico de respostas';
$string['restart'] = 'Começar de novo';
$string['restartwiththeseoptions'] = 'Comece novamente com estas opções';
$string['reviewresponse'] = 'Revisão da resposta';
$string['rightanswer'] = 'Reposta correta';
$string['saved'] = 'Salvou: {$a}';
$string['saveflags'] = 'Gravar o estado das marcas';
$string['selectacategory'] = 'Selecione uma categoria:';
$string['selectaqtypefordescription'] = 'Selecione um tipo de pergunta para ver a sua descrição.';
$string['selectcategoryabove'] = 'Selecione uma categoria acima';
$string['selectquestionsforbulk'] = 'Selecionar perguntas para ações em massa';
$string['settingsformultipletries'] = 'Definição para múltiplas tentativas';
$string['shareincontext'] = 'Compartilhar o contexto com {$a}';
$string['showhidden'] = 'Também exibir questões antigas';
$string['showmarkandmax'] = 'Exibir marcação e máximo';
$string['showmaxmarkonly'] = 'Exibir marcação máxima apenas';
$string['shown'] = 'Exibir';
$string['shownumpartscorrect'] = 'Mostrar o número de respostas corretas';
$string['shownumpartscorrectwhenfinished'] = 'Mostrar o número de respostas corretas uma vez terminada a questão';
$string['showquestiontext'] = 'Mostrar texto da questão na lista de questões';
$string['specificfeedback'] = 'Feedback específico';
$string['started'] = 'Iniciada';
$string['state'] = 'Estado';
$string['step'] = 'Passo';
$string['stoponerror'] = 'Parar se houver erro';
$string['stoponerror_help'] = 'Esta opção determina se o processo de importação deve parar quando um erro é detectado, resultando em nenhuma questão importada, ou se quaisquer perguntas que contenham erros sejam ignoradas e somente perguntas válidas sejam importadas.';
$string['submissionoutofsequence'] = 'Acesso fora da sequência. Por favor não clique no botão voltar do seu navegador enquanto responde às questões.';
$string['submissionoutofsequencefriendlymessage'] = 'Você enviou dados fora da sequencia normal. Isso pode acontecer se você usar o botão voltar ou avançar do seu navegador; por favor não os utilize durante a tentativa. Isso também pode acontecer se você clicar em algo durante o carregamento da página. Clique em <strong>Continuar </strong>para retomar.';
$string['submit'] = 'Enviar';
$string['submitandfinish'] = 'Enviar e finalizar';
$string['submitted'] = 'Enviar: {$a}';
$string['tofilecategory'] = 'Escrever categoria em arquivo';
$string['tofilecontext'] = 'Escrever contexto em arquivo';
$string['uninstallbehaviour'] = 'Desinstalar este comportamento do questionário';
$string['uninstallqtype'] = 'Desinstalar este tipo de questão.';
$string['unknown'] = 'Desconhecido';
$string['unknownbehaviour'] = 'Comportamento desconhecido: {$a}';
$string['unknownquestion'] = 'Questão desconhecida: {$a}';
$string['unknownquestioncatregory'] = 'Categoria de questão desconhecida: {$a}';
$string['unknownquestiontype'] = 'Tipo de questão desconhecido: {$a}.';
$string['unknowntolerance'] = 'Tipo de tolerância desconhecido {$a}';
$string['unpublished'] = 'Não-compartilhado';
$string['upgradeproblemcategoryloop'] = 'Problema atualizando categorias de questões. Loop na árvore de categorias. O id da categoria com problemas é {$a}.';
$string['upgradeproblemcouldnotupdatecategory'] = 'Não foi possível modificar a categoria {$a->name} ({$a->id}).';
$string['upgradeproblemunknowncategory'] = 'Problema atualizando categorias de questões. A categoria {$a->id} aponta para {$a->parent},que não existe. O problema foi resolvido apontando para uma categoria existente.';
$string['whethercorrect'] = 'Acertos/Erros';
$string['withselected'] = 'Com as questões selecionadas:';
$string['wrongprefix'] = 'Injustamente formatado nameprefix {$a}';
$string['xoutofmax'] = '{$a->mark} de {$a->max}';
$string['yougotnright'] = 'Você selecionou corretamente {$a->num}.';
$string['youmustselectaqtype'] = 'Você deve selecionar um tipo de pergunta.';
$string['yourfileshoulddownload'] = 'O download do seu arquivo deve começar automaticamente, caso contrário <a href="{$a}">clique aqui</a>.';
