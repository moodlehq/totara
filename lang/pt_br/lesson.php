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
 * Strings for component 'lesson', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   lesson
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['accesscontrol'] = 'Controle de acesso';
$string['actionaftercorrectanswer'] = 'Ação após uma Resposta Correta';
$string['actionaftercorrectanswer_help'] = '<p>A ação padrão é seguir conforme especificado na resposta. Na maioria dos casos isso provavelmente mostrará a pŕoxima página da lição. O estudante passa pela lição de maneira linear, começando no ínicio e terminando no final.</p>

<p>Entretanto, o módulo de lição também pode ser usado como uma tipo de tarefa <if>Flash Card</i> .
    É mostrada alguma informação (opcional) e uma questão em ordem aleatória. Não há início nem final definidos. Apenas um conjunto de <i>Cards</i> (fichas) é mostrado um após outro sem uma ordem particular.</p>

<p>Essa opção permite duas variantes similares de comportamento Flash Card. A opção "Mostrar uma página nunca vista" nunca permite que a mesma página seja mostrada duas vezes (mesmo se o estudante <b>não</b> responder a questão associada com o Card/Página corretamente). A outra opção não-padrão é "Mostrar uma página não respondida", que permite que os estudantes vejam páginas já navegadas, caso não as questões não tenham sido respondidas corretamente.</p>

<p>Em cada tipo de lições Flash Card, o professor pode decidir usar todos os Cards/Páginas na lição ou escolher um subconjunto (aleatório). Isso pode ser definido no parâmetro &quot;Número de Páginas (fichas) a serem mostradas&quot; .</p>';
$string['actions'] = 'Ações';
$string['activitylink'] = 'Link a uma atividade';
$string['activitylink_help'] = '<p>A caixa de selação contém todas as atividades deste curso. Se uma estiver selecionada, então um link para esta atividade aparecerá no final da Lição.</p>';
$string['activitylinkname'] = 'Vai a {$a}';
$string['addabranchtable'] = 'Inserir página com painel de navegação';
$string['addanendofbranch'] = 'Inserir Fim de seção';
$string['addanewpage'] = 'Adicionar uma nova página';
$string['addaquestionpage'] = 'Inserir página com questões';
$string['addaquestionpagehere'] = 'Adicionar página de questões aqui';
$string['addbranchtable'] = 'Adicionar uma página de conteúdo';
$string['addcluster'] = 'Inserir Grupamento';
$string['addedabranchtable'] = 'Painel de Navegação adicionado';
$string['addedanendofbranch'] = 'Fim de seção adicionado';
$string['addedaquestionpage'] = 'Página de Questões adicionada';
$string['addedcluster'] = 'Grupamento adicionado';
$string['addedendofcluster'] = 'Fim de Grupamento adicionado';
$string['addendofcluster'] = 'Inserir Fim de Grupamento';
$string['addpage'] = 'Adicionar página';
$string['anchortitle'] = 'Início do conteúdo principal';
$string['and'] = 'E';
$string['answer'] = 'Resposta';
$string['answeredcorrectly'] = 'respondidas corretamente.';
$string['answersfornumerical'] = 'As respostas para questões numéricas devem ser pares de valores Máximos e Mínimos';
$string['arrangebuttonshorizontally'] = 'Ordenar os botões das seções horizontalmente?';
$string['attempt'] = 'Tentativa: {$a}';
$string['attempts'] = 'Tentativas';
$string['attemptsdeleted'] = 'Tentativas apagadas';
$string['attemptsremaining'] = 'Você tem ainda {$a} tentativas';
$string['available'] = 'Disponível a partir de';
$string['averagescore'] = 'Pontuação média';
$string['averagetime'] = 'Tempo médio';
$string['branch'] = 'Conteúdo';
$string['branchtable'] = 'Painel de Navegação';
$string['cancel'] = 'Cancelar';
$string['cannotfindanswer'] = 'Erro: não foi possível encontrar a resposta';
$string['cannotfindattempt'] = 'Erro: não foi possível encontrar a tentativa';
$string['cannotfindessay'] = 'Erro: não pôde achar ensaio';
$string['cannotfindfirstgrade'] = 'Erro: não foi possível encontrar as avaliações';
$string['cannotfindfirstpage'] = 'Não foi possível encontrar a orimeira página';
$string['cannotfindgrade'] = 'Erro: não foi possível encontrar as avaliações';
$string['cannotfindnewestgrade'] = 'Erro: não foi possível encontrar a nova avaliação';
$string['cannotfindnextpage'] = 'Backup da Lição: Próxima página não encontrada!';
$string['cannotfindpagerecord'] = 'Adicionar final do ramo: registro de página não encontrada';
$string['cannotfindpages'] = 'Não foi possível encontrar as páginas da lição';
$string['cannotfindpagetitle'] = 'Confirmar exlusão: título da página não encontrado';
$string['cannotfindpreattempt'] = 'O registro da tentativa anterior não foi encontrado!';
$string['cannotfindrecords'] = 'Erro: não foi possível encontrar os registros da lição.';
$string['cannotfindtimer'] = 'Erro: não foi possível encontrar os registros lesson_timer';
$string['cannotfinduser'] = 'Erro: não foi possível encontrar os usuários';
$string['canretake'] = '{$a} pode tentar novamente';
$string['casesensitive'] = 'Usar expressões regulares';
$string['casesensitive_help'] = '<p>Alguns tipos de questão têm uma opção que pode ser ativada clicando na caixa. Os tipos e o significado das opções são detalhados a seguir:</p>

<ol>
<li><p><b>Múltipla escolha</b> Há uma variante das questões de múltipla escolha chamadas questões de    <b>&quot;Múltipla escolha Multi-resposta&quot;</b>. Se essa opção for escolhida, então o estudante deve marcar todas as respostas corretas em um conjunto de respostas. A questão pode ou não dizer <i>quantas</i> respostas corretas existem. Por exemplo, &quot;Quais desses foram presidentes dos Estados Unidos?&quot; não diz, mas "Selecione dois presidentes dos Estados Unidos na lista a seguir." o faz. O número de respostas corretas pode variar de <b>um</b> até o número de alternativas. (Uma questão de Resposta Múltipla com uma resposta correta <b>é</b> diferente de uma questão Múltipla Escolha, já que a anterior permite que o estudante escolha mais de uma resposta.)</p></li>

<li>
  <p><b>Resposta Curta</b> Há dois tipos diferentes de sistemas de comparação para o tipo de questão de Resposta Curta: o mais simples é utilizado por padrão;
      o sistema de &quot;Expressões Regulares&quot; é utilizado caso a opção &quot;Usar Expressões Regulares&quot; estiver marcada. Para mais informações, leia o arquivo de ajuda dos tipos de questões da Lição.</p>
</li>
</ol>
<p>Os outros tipos de questão não utilizam opções de questão.</p>';
$string['checkbranchtable'] = 'Testar painel de navegação';
$string['checkedthisone'] = 'Selecionado este.';
$string['checknavigation'] = 'Testar navegação';
$string['checkquestion'] = 'Testar questão';
$string['classstats'] = 'Estatísticas da classe';
$string['clicktodownload'] = 'Clique no seguinte link para baixar o arquivo.';
$string['clicktopost'] = 'Clique aqui para adicionar a sua nota à lista dos Melhores Resultados';
$string['cluster'] = 'Agrupamento';
$string['clusterjump'] = 'Questão não vista em um grupamento';
$string['clustertitle'] = 'Grupamento';
$string['collapsed'] = 'Colapsado';
$string['comments'] = 'Seus comentários';
$string['completed'] = 'Completado';
$string['completederror'] = 'Completar a lição';
$string['completethefollowingconditions'] = 'Você deve atingir os seguintes objetivos na lição <b>{$a}</b> antes de prosseguir.';
$string['conditionsfordependency'] = 'Condições de dependência';
$string['configactionaftercorrectanswer'] = 'Ação padrão para ser executada depois de uma resposta correta';
$string['configmaxanswers'] = 'Valor padrão máximo de respostas por páginas';
$string['configmaxhighscores'] = 'Mostrado númeor dos resultados mais elevados';
$string['configmediaclose'] = 'Exibe um botão \'fechar\', como parte do <em>popup</em> gerado para um arquivo de mídia vinculado.';
$string['configmediaheight'] = 'Define a altura do <em>popup</em> exibido para um arquivo de mídia vinculado.';
$string['configmediawidth'] = 'Define a largura do <em>popup</em> exibido para um arquivo de mídia vinculado.';
$string['configslideshowbgcolor'] = 'Cor de fundo da apresentação de slides se estiver habilitada';
$string['configslideshowheight'] = 'Configura a altura da apresentação de slides se estiver habilitada';
$string['configslideshowwidth'] = 'Configura a largura da apresentação de slides se estiver habilitada';
$string['confirmdelete'] = 'Excluir página';
$string['confirmdeletionofthispage'] = 'Confirmar exclusão desta página';
$string['congratulations'] = 'Você chegou ao fim desta lição';
$string['continue'] = 'Continuar';
$string['continuetoanswer'] = 'Continuar a mudar as respostas.';
$string['continuetonextpage'] = 'Continuar para a próxima página';
$string['correctanswerjump'] = 'Destino da resposta correta';
$string['correctanswerscore'] = 'Pontuação da resposta correta';
$string['correctresponse'] = 'Resposta correta';
$string['credit'] = 'Crédito';
$string['customscoring'] = 'Pontuação personalizada';
$string['customscoring_help'] = '<p>Isto permitirá que você coloque um valor de pontuação numérica em cada resposta. As respostas podem ter valores negativos ou positivos. Questões importadas terão atribuídos, automaticamente,
1 ponto para respostas corretas e 0 para incorretas, embora você possa mudar isto
após a importação.</p>';
$string['deadline'] = 'Prazo final';
$string['defaultessayresponse'] = 'O seu trabalho vai ser avaliado pelo docente do curso.';
$string['deleteallattempts'] = 'Excluir todas as tentativas da lição';
$string['deletedefaults'] = 'Excluir {$a} x padrão';
$string['deletedpage'] = 'Página excluída';
$string['deleting'] = 'Excluindo';
$string['deletingpage'] = 'Excluindo página: {$a}';
$string['dependencyon'] = 'Dependente de';
$string['dependencyon_help'] = '<p>Este parâmetro possibilita que esta lição dependa do desempenho do aluno em outra
lição do mesmo curso. Se as exigências de desempenho não forem atingidas, o aluno
não terá acesso a esta lição.</p>

<p>As condições para a dependência incluem:
    <ul>
        <li><b>Tempo Gasto:</b> o aluno deve gastar esta quantidade de tempo estabelecida na lição requerida.</li>
        <li><b>Completada:</b> o aluno deve completar a lição requerida.</li>
        <li><b>Nota melhor que:</b> o aluno deve obter uma nota na lição requerida maior que a especificada aqui.</li>
    </ul></p>
  <p>  Qualquer combinação das opções acima pode ser usada, se necessário.
</p>';
$string['description'] = 'Texto do link';
$string['detailedstats'] = 'Estatísticas detalhadas';
$string['didnotanswerquestion'] = 'Não respondeu esta questão';
$string['didnotreceivecredit'] = 'Não recebeu nenhum crédito';
$string['displaydefaultfeedback'] = 'Mostrar o feedback padrão';
$string['displaydefaultfeedback_help'] = '<p align="center"><strong>Mostrar Feedback Padrão</strong></p>

<p>Se configurado com <strong>Sim</strong>, quando uma resposta não é encontrada para uma questão específica, a resposta padrão "Esta é a resposta correta" ou "Esta é a resposta errada" será usada.</p>
<p>Se configurado com <strong>Não</strong>, quando uma resposta não é encontrada para uma questão específica, então nenhum feedback é mostrado. O usuário fazendo a lição será automaticamente transferido para a próxima página da Lição.</p>';
$string['displayhighscores'] = 'Mostrar pontuações altas';
$string['displayinleftmenu'] = 'Mostrar no menu à esquerda?';
$string['displayleftif'] = 'Mostre apenas se {$a} tiver a nota maior que:';
$string['displayleftif_help'] = 'Esta configuração determina se um estudante deve obter uma certa nota antes de visualizar o menu à esquerda. Isso força o aluno a percorrer toda a lição na sua primeira tentativa e, depois de obter a nota exigida, ele pode usar o menu à esquerda para a revisão.';
$string['displayleftmenu'] = 'Mostrar menu à esquerda';
$string['displayleftmenu_help'] = 'Se habilitado, uma lista de páginas é mostrada.';
$string['displayofgrade'] = 'Visualização das notas (apenas para estudantes)';
$string['displayreview'] = 'Fornecer uma opção para tentar uma nova questão denovo';
$string['displayreview_help'] = '<p>Isto irá mostrar um botão depois de uma questão respondida incorretamente, permitindo que um estudante tente novamente. Não é compatível com questões dissertativas, então deixe isto desativado se você estiver usando questões dissertativas.</p>';
$string['displayscorewithessays'] = 'Você recebeu {$a->score} de um total de {$a->tempmaxgrade} nas questões avaliadas automaticamente.<br /> A(s) sua(s) {$a->essayquestions} questão(ões) dissertativa(s) será(ão) avaliada(s) depois.<br /><br />A sua nota parcial é {$a->score} de um total de {$a->grade}';
$string['displayscorewithoutessays'] = 'A sua pontuação é {$a->score} (de {$a->grade}).';
$string['edit'] = 'Editar';
$string['editingquestionpage'] = 'Editando página de questão {$a}';
$string['editlessonsettings'] = 'Editar as configurações desta lição';
$string['editpage'] = 'Editar conteúdo de página';
$string['editpagecontent'] = 'Editar o conteúdo desta página';
$string['email'] = 'Email';
$string['emailallgradedessays'] = 'Enviar email de todas as dissertações avaliadas ';
$string['emailgradedessays'] = 'Enviar email das dissertações avaliadas';
$string['emailsuccess'] = 'Envio de email bem sucedido';
$string['emptypassword'] = 'Senha não pode ser vazia';
$string['endofbranch'] = 'Fim de seção';
$string['endofcluster'] = 'Final do agrupamento';
$string['endofclustertitle'] = 'Fim do grupamento';
$string['endoflesson'] = 'Fim da lição';
$string['enteredthis'] = 'inserido este.';
$string['entername'] = 'Inserir um apelido para a lista de pontuações altas';
$string['enterpassword'] = 'Inserir a senha';
$string['eolstudentoutoftime'] = 'Atenção: O tempo para terminar esta lição acabou. Se a sua última resposta foi enviada quando o tempo de duração já tinha sido superado, ela não será considerada.';
$string['eolstudentoutoftimenoanswers'] = 'Você não respondeu nenhuma questão. A nota atribuída foi igual a 0 .';
$string['essay'] = 'Dissertação';
$string['essayemailmessage'] = '<p>Dissertação:<blockquote>{$a->question}</blockquote></p><p>Resposta:<blockquote><em>{$a->response}</em></blockquote></p><p>{$a->comment}:<blockquote><em>{$a->comment}</em></blockquote></p><p>Nota igual a {$a->earned} sobre {$a->outof} .</p><p>A sua nota foi modificada para {$a->newgrade}&#37;.</p>';
$string['essayemailmessage2'] = '<p>Questão Ensaio:<blockquote>{$a->question}</blockquote></p><p>Sua resposta:<blockquote><em>{$a->response}</em></blockquote></p><p>Comentário do avaliador:<blockquote><em>{$a->comment}</em></blockquote></p><p>Você recebeu {$a->earned} por {$a->outof} por esta questão de ensaio.</p><p>Sua avaliação para a lição foi modificada para {$a->newgrade}%.</p>';
$string['essayemailsubject'] = 'A sua nota da questão {$a}';
$string['essays'] = 'Dissertações';
$string['essayscore'] = 'Nota da dissertação';
$string['fileformat'] = 'Formato do documento';
$string['finish'] = 'Finalizado';
$string['firstanswershould'] = 'A primeira resposta deve ter como destinação a página correta';
$string['firstwrong'] = 'Infelizmente esta resposta não é correta e portanto não aumentará a sua pontuação. Você gostaria de continuar tentando para conhecer a resposta certa (mas sem direito à revisão da pontuação)?';
$string['flowcontrol'] = 'Controle de fluxo';
$string['full'] = 'Expandido';
$string['general'] = 'Geral';
$string['gotoendoflesson'] = 'Ir para o final da lição';
$string['grade'] = 'Avaliação';
$string['gradebetterthan'] = 'Avaliação melhor que (%)';
$string['gradebetterthanerror'] = 'Tem nota superior a {$a} por cento';
$string['gradeessay'] = 'Avaliar dissertações';
$string['gradeis'] = 'Resultado: {$a}';
$string['gradeoptions'] = 'Opções de avaliação';
$string['handlingofretakes'] = 'Calculando o resultado das tentativas';
$string['handlingofretakes_help'] = '<p>Quando são habilitadas novas tentativas na lição, esta opção permite que
    o professor mostre a nota para a lição, por exemplo, na página de Notas,
    tanto como a <b>média</b>, isto é, média aritmética das notas da primeira
    tentativa e subsequentes, ou como a nota obtida nas <b>melhores</b> tentativas dos alunos.</p>

<p>Esta opção pode ser mudada a qualquer momento.</p>';
$string['havenotgradedyet'] = 'Ainda não foi avaliado';
$string['here'] = 'aqui';
$string['highscore'] = 'Pontuação alta';
$string['highscores'] = 'Pontuações altas';
$string['hightime'] = 'Tempo alto';
$string['importcount'] = 'Importando {$a} questões';
$string['importppt'] = 'Importar PowerPoint';
$string['importppt_help'] = '<p>COMO USAR</p>

<p>Todos as transparências do Powerpoint são importadas como Painel de navegação com as respostas Prévias e Posteriores.</p>

<p>
<ol>
<li>Abra sua apresentação em Powerpoint.</li>
<li>Salve-a como uma Página Web (sem opções especiais)</li>
<li>O resultado do passo 3 deve ser um arquivo htm e uma pasta com todas as transparências convertidas para páginas web.<br />

  COMPACTE (ZIP) apenas A PASTA.</li>

<li>Vá até o curso no Moodle a adicione uma nova lição.</li>
<li>Após salvar as configurações da lição você poderá ver 4 opções sob o título "O que você deseja fazer primeiro?" Clique em "Importar Powerpoint"</li>
<li>Use o botão "Procurar..." para encontrar seu arquivo .zip do passo 3. Então clique em "Enviar este arquivo"</li>
<li>Se tudo funcionou, a próxima tela deverá mostrar apenas um botão de continuar.</li>
</ol>
</p>
<p>Se seu Powerpoint contiver imagens, elas terão sido salvas como arquivos do curso em moddata/XY onde X é o nome da sua lição e Y é um número (geralmente 0). Também, durante o processo de importação, são criados arquivos no diretório de dados do Moodle, dentro de temp/lesson. Esses arquivos ainda não são apagados por importppt.php.</p>';
$string['importquestions'] = 'Importar questões';
$string['importquestions_help'] = '<p>Isto permite que você importe questões de arquivos de texto
   externos, enviados através de um formulário.</p>

<p>Os arquivos podem ser enviados em vários formatos:</p>

<h2>Formato GIFT</h2>
<div class="indent">
<p>GIFT é o formato de importação mais abrangente para a importação de
   questões de questionário do Moodle, de um arquivo texto. Ele foi desenhado para ser um método fácil
   para os professores escreverem questões como arquivos de texto. Ele suporta questões de Múltipla
   Escolha, Verdadeiro-Falso, Resposta Breve, de Associação e Numéricas, bem como para o formato
   inserção de _____ para a "palavra que está faltando". Vários tipos de questões podem ser
   misturados em um único arquivo texto, e o formato também permite linhas de comentarios, nomes das questões,
   retornos e notas com pesos percentuais. Seguem alguns exemplos:</p>
<pre>
Quem está enterrado na tumba de Grant?{~Grant ~Jefferson =ninguém}

Grant está {~enterrado =sepultado ~vivendo} na tumba de Grant.

Grant está enterrado na tumba de Grant.{FALSO}

Quem está enterrado na tumba de Grant?{=nenhum =ninguém}

Quando nasceu Ulysses S. Grant?{#1822}
</pre>

<p class="moreinfo"><a href="help.php?file=formatgift.html&module=quiz">Mais informações sobre o formato "GIFT"</a></p>
</div>

<h2>Formato Aiken</h2>
<div class="indent">
<p>O formato Aiken é um meio muito simples de criar questões de múltipla escolha usando um formato de fácil leitura. Eis um exemplo do formato:</p>
<pre>
Qual é o propósito dos primeiros socorros?
A. Salvar vidas, prevenir mais ferimentos, preservar a boa saúde.
B. Providenciar tratamento médico para qualquer pessoa ferida ou machucada.
C. Prevenir mais ferimentos.
D. Auxiliar vítimas que possam estar procurando ajuda.
RESPOSTA: A
</pre>

<p class="moreinfo"><a href="help.php?file=formataiken.html&module=quiz">Mais informações sobre o formato "Aiken"</a></p>
</div>

<h2>Complete com a palavra que falta</h2>
<div class="indent">
<p>Este formato só permite questões de múltipla escolha.
Cada resposta é separada com um til (~), e a resposta correta é
assinalada com um sinal de igual (=). Eis um exemplo:</p>

<blockquote>Tão logo começamos a explorar as partes de nosso corpo, quando crianças,
nos tornamos estudantes de {=anatomia e fisiologia ~reflexologia
~ciência ~experimentação}, e em certo sentido permanecemos estudantes de por vida.
</blockquote>

<p class="moreinfo"><a href="help.php?file=formatmissingword.html&module=quiz">Mais informações sobre o formato "Complete com a palavra que falta"</a></p>
</div>

<h2>AON</h2>
<div class="indent">
<p>Este é o mesmo formato que "Complete com a palavra que falta", exceto que após importar
   as questões, todas as questões de resposta breve são convertidas, quatro de cada vez,
   em Questões de Associação.</p>
<p>Além disso, as respostas das questões de múltipla escolha são misturadas
   aleatoriamente durante a importação.</p>
<p>Recebeu este nome de uma organização que patrocinou o desenvolvimento de muitas
   funcionalidade para os questionários</p>
</div>

<h2>Blackboard</h2>
<div class="indent">
<p>Este módulo pode importar questões salvas no formato de exportação do Blackboard.
Ele se baseia em funções XML que são compiladas dentro do seu PHP.</p>

<p align="right"><a href="help.php?file=formatblackboard.html&module=quiz">Mais informações sobre o formato "Blackboard"</a></p>
</div>

<h2>Teste de gerenciamento do curso</h2>
<div class="indent">
<p>Este módulo pode importar questões salvas em um banco de testes do Teste de gerenciamento do Curso.
Ele se baseia em diferentes modos de acessar o banco de testes, que está em uma base de dados do Microsof
Access, dependendo se o Moodle está rodando em um servidor web Windows ou Linux.</p>
<p>Em Windows ele permite que você envie a base de dados do Access da mesma forma que qualquer outro arquivo de importação de dados.</p>
<p>Em Linux, você deve instalar uma máquina Windows na mesma rede que está a base de dados do
Teste de gerenciamento do curso e um pacote chamado de ODBC Socket Server, que usa XML
para transferir dados para o Moodle no servidor Linux.</p>

<p>Favor ler o arquivo de ajuda completo abaixo, antes
de usar esta classe de importação.</p>

<p align="right"><a href="help.php?file=formatctm.html&module=quiz">Mais informações sobre o formato "CTM" (Teste de gerenciamento do curso)</a></p>
</div>

<h2>Personalizar</h2>
<div class="indent">
<p>Se você tiver seu próprio formato que precisa importar, pode
   implementá-lo por conta própria, editando mod/quiz/format/custom.php</p>

<p>A quantidade necessária de código novo é bem pequena - apenas o suficiente
   para analisar uma única questão de um texto dado.</p>

<p align="right"><a href="help.php?file=formatcustom.html&module=quiz">Mais informação sobr o formato "Personalizado"</a></p>
</div>

<p>Mais formatos virão, incluindo WebCT, IMS QTI e qualquer outro que os usuários do
   Moodle possam contribuir! </p>';
$string['insertedpage'] = 'Página inserida';
$string['invalidfile'] = 'Arquivo inválido';
$string['invalidid'] = 'Nenhuma identificação de módulo ou de lição foi informada.';
$string['invalidlessonid'] = 'O ID desta lição está incorreto';
$string['invalidpageid'] = 'Identificação de página inválido';
$string['jump'] = 'Destinação';
$string['jumps'] = 'Destinações';
$string['jumps_help'] = '<p>Cada Resposta (para questões) ou Descrição (para páginas de ramificação) tem um link
   Saltar-para. Quando esta opção é escolhida, a resposta para a pergunta
    é mostrada ao aluno. Depois disso o aluno vê a página que aparece no link Saltar-para.
    Esse link pode ser relativo ou absoluto. Links relativos são <b>Esta
    página</b> e <b>Próxima página</b>. <b>Esta página</b> significa que o aluno vê a
    página corrente novamente. <b>Próxima página</b> mostra a página seguinte a esta página na
    ordem lógica das páginas. Um link absoluto para a página é especificado pela escolha do
    <b>título</b> da página.</p>
<p>Note que um link Saltar-para <b>Próxima página</b> (relativo) pode mostrar uma página
   diferente se as páginas forem movidas. Por outro lado, links Saltar-para que usam <b>títulos</b> de páginas sempre mostram a mesma página mesmo que páginas sejam movidas.</p>
<p>Saltos Especiais</p>
<p>Questão não vista dentro de uma Seção</p>
<p>Isto apontará para uma questão não vista (pelo aluno, nesta tentativa) escolhida aleatoriamente
	entre esta tabela de ramificação e o Fim da Lição ou o próximo Fim de Ramificação.</p>

<p>Questão aleatória dentro de uma Seção</p>
<p>Isto apontará para uma questão escolhida aleatoriamente entre a tabela de ramificação corrente e
	o Fim da Lição ou o próximo Fim da Ramificação. Se o aluno já viu a
	questão e as tentativas são maiores que 1, ele terá outra chance de ganhar
	os pontos para esta questão. Se as tentativas forem fixadas em 1, a questão será pulada
	e outra questão aleatória será mostrada.</p>

<p>Painel de Navegação Aleatória</p>
<p>Isto pulará para uma Painel de Navegação aleatória entre o Painel de Navegação corrente e o Fim
	da Lição ou o próximo Fim da Seção.</p>';
$string['jumpsto'] = 'Destinações para <em>{$a}</em>';
$string['leftduringtimed'] = 'Você interrompeu uma lição com tempo de duração definido.<br />Por favor clique em Continuar para recomeçar a lição.';
$string['leftduringtimednoretake'] = 'Você interrompeu uma lição com tempo de duração definido.<br />Não será possível continuar ou recomeçar.';
$string['lessonattempted'] = 'Tentativa da Lição';
$string['lessonclosed'] = 'Esta lição foi fechada em {$a}.';
$string['lessoncloses'] = 'A lição termina';
$string['lessoncloseson'] = 'Lição termina em {$a}';
$string['lesson:edit'] = 'Editar uma lição';
$string['lessonformating'] = 'Formatação da lição';
$string['lesson:manage'] = 'Gerenciar uma lição';
$string['lessonmenu'] = 'Menu da lição';
$string['lessonnotready'] = 'Esta lição ainda não pode ser acessada. Contate o seu {$a}.';
$string['lessonnotready2'] = 'Esta lição não está pronta para ser utilizada.';
$string['lessonopen'] = 'Esta lição será acessível a partir de {$a}.';
$string['lessonopens'] = 'A lição inicia';
$string['lessonpagelinkingbroken'] = 'A página inicial não foi encontrada. Os links entre as páginas da lição podem estar com problemas. Contate um administrador.';
$string['lessonstats'] = 'Estatísticas da Lição';
$string['linkedmedia'] = 'Arquivo multimídia linkado';
$string['loginfail'] = 'Erro de login, por favor tente novamente';
$string['lowscore'] = 'Pontuação baixa';
$string['lowtime'] = 'Tempo breve';
$string['manualgrading'] = 'Avaliar dissertações';
$string['matchesanswer'] = 'Corresponde à resposta';
$string['matching'] = 'Associando';
$string['matchingpair'] = 'Associando par {$a}';
$string['maxgrade'] = 'Avaliação máxima';
$string['maxgrade_help'] = '<p>Este valor determina a nota máxima que pode ser obtida na Lição.
    O intervalo é de 0 a 100%. Este valor pode ser mudado a qualquer momento durante a
lição. Qualquer mudança tem um efeito imediato na página de Notas e nas
notas mostradas aos alunos em várias listas. Se a nota for fixada em 0
a Lição não aparece em nenhum dos relatórios de Notas.</p>';
$string['maxhighscores'] = 'Número de pontuações altas visualizado';
$string['maximumnumberofanswersbranches'] = 'Número máximo de respostas/seções';
$string['maximumnumberofanswersbranches_help'] = '<p>Este valor determina o número máximo de respostas que o professor pode usar.
    O valor padrão é 4. Por exemplo, se a lição usar sempre questões VERDADEIRO ou FALSO,
    é recomendável que este valor seja 2.</p>

<p>Este parâmetro também define o número máximo de seções que pode ser usado em
    uma Painel de Navegação</p>

<p>É seguro mudar o valor deste parâmetro em uma lição que já tem conteúdo.
    Na realidade, se você quiser acrescentar uma questão com muitas alternativas ou uma
    Painel de Navegação longa, será necessário mudar este parâmetro. Depois que a
    questão ou Painel de Navegação pouco comum tiver sido acrescentada, este parâmetro
    pode ser reduzido para valores mais comuns.</p>';
$string['maximumnumberofattempts'] = 'Número máximo de tentativas';
$string['maximumnumberofattempts_help'] = '<p>Este valor determina o número máximo de tentativas que um Aluno tem
    para responder <b>qualquer</b> uma das questões da lição. No caso de questões
    que não fornecem a resposta, por exemplo questões de Resposta Breve
    e questões Numéricas, este valor fornece uma necessária <i>via de fuga</i> para
    a próxima página da lição. </p>

<p>O valor padrão é 5. Valores menores podem desencorajar o aluno
    a pensar sobre as questões. Valores maiores podem levar a mais
    frustração.</p>

<p>Fixar este valor em 1 dá ao aluno apenas uma chance para responder cada
    questão. Isto dá um tipo de tarefa parecida com o módulo Questionário, exceto
    que as questões são apresentadas em páginas individuais.</p>

<p>Note que esse valor é um parâmetro global e que ele se aplica a todas as
    questões da lição, independentemente do seu tipo.</p>

<p>Note que este parâmetro <b>não</b> se aplica ao professor quando estiver verificando as
    questões ou navegando através da lição. A verificação do número de tentativas
    baseia-se em valores armazenados na base de dados e as tentativas feitas pelos professores
    não são registradas. Afinal de contas, o professor deve conhecer as respostas!</p>';
$string['maximumnumberofattemptsreached'] = 'Número máximo de tentativas atingido - indo para a próxima página';
$string['maxtime'] = 'Limite de tempo (minutos)';
$string['maxtimewarning'] = 'Você tem {$a} minuto(s) para terminar esta lição.';
$string['mediaclose'] = 'Mostrar botão de encerramento:';
$string['mediafile'] = 'Arquivo ou página web em janela pop-up';
$string['mediafile_help'] = '<p>Isto abre, no início de uma lição, uma nova janela (pop-up) para uma página web ou um arquivo (por exemplo, um arquivo mp3).
Além disso, um link que reabre a nova janela, se necessário, será adicionado a cada página da lição.</p>

<p>Opcionalmente, a altura e largura da nova janela podem ser definidas e um botão "Fechar Janela" pode ser colocado na parte inferior.</p>

<p>Tipos de arquivo suportados:</p>
    <ul>
        <li>MP3</li>
        <li>Media Player</li>
        <li>Quicktime</li>
        <li>Realmedia</li>
        <li>HTML</li>
        <li>Plain Text</li>
        <li>GIF</li>
        <li>JPEG</li>
        <li>PNG</li>
    </ul>
<p>Outros tipo de formato serão indicados como links para download.</p>';
$string['mediafilepopup'] = 'Clique aqui para ver o arquivo multimídia desta lição';
$string['mediaheight'] = 'Altura da janela <em>popup</em>:';
$string['mediawidth'] = 'Largura da janela <em>popup</em>:';
$string['messageprovider:graded_essay'] = 'Notificação da avaliação do Ensaio';
$string['minimumnumberofquestions'] = 'Número mínimo  de questões';
$string['minimumnumberofquestions_help'] = '<p>Quando uma lição contém um ou mais Painéis de Navegação o professor normalmente deve ativar esse parâmetro. O seu valor determina um limite mínimo do número de questões analisadas quando uma média é calculada, mas <b>sem</b> forçar os estudantes a responderem essa quantidade na lição</p>

<p>Por exemplo, alterando esse parâmetro para, digamos, 20, certificaremos que as notas serão dadas como se os alunos tivessem visto <b>no mínimo</b> esse número de questões. Tomemos o caso de um estudante que só viu uma única ramificação na lição, com 5 páginas, e respondeu corretamente todas as questões associadas a ela. Eles podem preferir terminar a lição (assumindo que haja essa opção no  "topo" dos Painéis de Navegação, uma suposição razoável). Se esse parâmetro estiver desmarcado, a nota dele poderia ser 5 de 5, que é 100%. Entretanto, definido para 20, sua nota cairia para 5 de 20, que é 25%. No caso de outro aluno que passa por todas as seções e lê, digamos, 25 páginas e deixa em branco apenas 2 questões, a nota dele seria 23 de 25, ou seja, 92%.</p>

<p>Se esse parâmetro for usado, a página inicial da lição será mais ou menos assim:</p>

<blockquote><p>Nessa lição esperamos que você responda pelo menos n questões. Você pode tentar mais, se quiser. Entretanto, se você responder menos de n questões, sua nota será calculada como se houvesse n.</p></blockquote>

<p>Obviamente, "n" é substituído pelo valor real do parâmetro dado.</p>

<p>Quando este parâmetro estiver definido, os estudantes verão a quantidade de questões respondidas por eles, e a quantidade esperada pelos professores.</p>';
$string['missingname'] = 'Inserir apelido';
$string['modattempts'] = 'Permitir revisão pelo estudante';
$string['modattempts_help'] = '<p>Isto permitirá que o estudante volte atrás na lição, caso queira mudar suas respostas.</p>';
$string['modattemptsnoteacher'] = 'A revisão dos estudantes só é ativa para eles.';
$string['modulename'] = 'Lição';
$string['modulename_help'] = '<p><img alt="" src="<?php echo $CFG->wwwroot?>/mod/lesson/icon.gif" />&nbsp;<b>Lição</b></p>

<div class="indent">
Uma lição publica o conteúdo em um modo interessante e flexível. Ela consiste em um certo
número de páginas. Cada página, normalmente, termina com uma questão e uma série de
possíveis respostas. Dependendo da resposta escolhida pelo aluno, ou ele
passa para a próxima página ou é levado de volta para uma página anterior. A navegação
através da lição pode ser direta ou complexa, dependendo em grande parte
da estrutura do material que está sendo apresentado.
</div>';
$string['modulenameplural'] = 'Lições';
$string['move'] = 'Mais páginas';
$string['movedpage'] = 'Página transferida';
$string['movepagehere'] = 'Mover página para cá';
$string['moving'] = 'Movendo página: {$a}';
$string['multianswer'] = 'Multiresposta';
$string['multianswer_help'] = '<p>Alguns tipos de questão têm uma opção que pode ser ativada clicando na caixa. Os tipos e o significado das opções são detalhados a seguir:</p>

<ol>
<li><p><b>Múltipla escolha</b> Há uma variante das questões de múltipla escolha chamadas questões de    <b>&quot;Múltipla escolha Multi-resposta&quot;</b>. Se essa opção for escolhida, então o estudante deve marcar todas as respostas corretas em um conjunto de respostas. A questão pode ou não dizer <i>quantas</i> respostas corretas existem. Por exemplo, &quot;Quais desses foram presidentes dos Estados Unidos?&quot; não diz, mas "Selecione dois presidentes dos Estados Unidos na lista a seguir." o faz. O número de respostas corretas pode variar de <b>um</b> até o número de alternativas. (Uma questão de Resposta Múltipla com uma resposta correta <b>é</b> diferente de uma questão Múltipla Escolha, já que a anterior permite que o estudante escolha mais de uma resposta.)</p></li>

<li>
  <p><b>Resposta Curta</b> Há dois tipos diferentes de sistemas de comparação para o tipo de questão de Resposta Curta: o mais simples é utilizado por padrão;
      o sistema de &quot;Expressões Regulares&quot; é utilizado caso a opção &quot;Usar Expressões Regulares&quot; estiver marcada. Para mais informações, leia o arquivo de ajuda dos tipos de questões da Lição.</p>
</li>
</ol>
<p>Os outros tipos de questão não utilizam opções de questão.</p>';
$string['multichoice'] = 'Múltipla escolha';
$string['multipleanswer'] = 'Resposta múltipla';
$string['nameapproved'] = 'Nome aprovado';
$string['namereject'] = 'Sinto muito, o seu nome não foi aceito pelo filtro.<br />Por favor use um outro nome.';
$string['new'] = 'novo';
$string['nextpage'] = 'Próxima página';
$string['noanswer'] = 'Não foi dada nenhuma resposta.Por favor, volte e submeta uma resposta.';
$string['noattemptrecordsfound'] = 'Não foram encontrados registros de tentativas para esta lição: não foi definido nenhum resultado';
$string['nobranchtablefound'] = 'Nenhum Painel de Navegação encontrado';
$string['nocommentyet'] = 'Nenhum comentário ainda';
$string['nocoursemods'] = 'Nenhuma atividade encontrada';
$string['nocredit'] = 'Nenhum crédito';
$string['nodeadline'] = 'Nenhum Limite de tempo';
$string['noessayquestionsfound'] = 'Nenhuma tarefa de dissertação encontrada nesta lição.';
$string['nohighscores'] = 'Nenhuma pontuação alta';
$string['nolessonattempts'] = 'Nenhuma tentativa feita nesta lição';
$string['nooneansweredcorrectly'] = 'Ninguém respondeu corretamente.';
$string['nooneansweredthisquestion'] = 'Ninguém respondeu esta questão';
$string['noonecheckedthis'] = 'Ninguém controlou isto.';
$string['nooneenteredthis'] = 'Ninguém inseriu isto.';
$string['noonehasanswered'] = 'Ninguém respondeu ainda as questões de dissertação';
$string['noretake'] = 'Não é permitido refazer esta lição';
$string['normal'] = 'Normal - seguir percurso da lição';
$string['notcompleted'] = 'Não completado';
$string['notdefined'] = 'Não definido';
$string['nothighscore'] = 'O seu resultado não está incluído entre os melhores {$a} da lista.';
$string['notitle'] = 'Nenhum título';
$string['numberofcorrectanswers'] = 'Número de respostas corretas: {$a}';
$string['numberofcorrectmatches'] = 'Número de associações corretas';
$string['numberofpagestoshow'] = 'Número  de páginas (fichas) a serem mostradas';
$string['numberofpagestoshow_help'] = '<p>Este parâmetro somente é usado em lições do tipo Fichas "Resumo" (Flash cards). O valor padrão é zero, o que significa que todas as Páginas/Fichas são mostradas em uma lição. Fixando o parâmetro com um valor diferente de zero mostra esse número de páginas. Após esse número de Páginas/Fichas terem sido mostradas, o fim da lição é alcançado e a nota é mostrada ao aluno.</p>

<p>Se este parâmetro for fixado em um valor maior que o número de páginas na lição, então o final da lição é atingido quando todas as páginas tiverem sido mostradas.</p>';
$string['numberofpagesviewed'] = 'Número de páginas vistas: {$a}';
$string['numberofpagesviewednotice'] = 'Número de questões respondidas {$a->nquestions}; (Você deve responder pelo menos: {$a->minquestions})';
$string['numerical'] = 'Numérico';
$string['ongoing'] = 'Visualizar pontuação corrente';
$string['ongoingcustom'] = 'Esta lição corresponde a {$a->score} pontos. Você recebeu {$a->score} ponto(s) de um total de {$a->currenthigh} pontos até agora.';
$string['ongoing_help'] = '<p>Com isto ativado, cada página mostrará os pontos acumulados até este momento pelo aluno,
    em relação ao total possível ao final. Por exemplo: um aluno respondeu quatro questões de
    5 pontos e respondeu uma incorretamente. Na Pontuação Atual aparecerá que ele ganhou
    até o momento 15/20 pontos.</p>';
$string['ongoingnormal'] = 'Você respondeu corretamente {$a->correct} questões de um total de {$a->viewed} .';
$string['onpostperpage'] = 'Apenas uma mensagem por avaliação';
$string['options'] = 'Opções';
$string['or'] = 'OU';
$string['ordered'] = 'Ordenada';
$string['other'] = 'Outro';
$string['outof'] = 'de {$a}';
$string['overview'] = 'Visão geral';
$string['overview_help'] = '<ol>
<li>Uma lição é constituída por um número de <b>páginas</b> e opcionalmente de <b>Painéis de Navegação</b>.</li>
<li>Uma página contém algum <b>conteúdo</b> e normalmente termina com uma <b>questão</b>. Por isso o termo <b>Página de Questão</b>.</li>
<li>Para Questões Dissertativas , não existe resposta, só uma nota, um feedback, e um desvio de página.</li>
<li>Cada resposta pode ter um pequeno texto que será mostrado se a resposta é escolhida. Este pequeno texto é chamado de <b>retorno</b>.</li>
<li>Também está associado com cada resposta um <b>desvio</b>. O desvio pode ser relativo - esta página, próxima página - ou absoluto - especificando qualquer página na lição ou o fim da lição.</li>
<li>Por padrão, a primeira resposta desvia para a <b>próxima página</b> na lição. As respostas subsequentes desviam para a mesma página. Isto é, a mesma página da lição é mostrada para o estudante se ele não escolher a primeira resposta. Se você já tinha criado um agrupamento com um fim de agrupamento, e a questão está dentro deste agrupamento, você pode também escolher para desviar para uma Questão ainda não vista dentro do agrupamento. Você pode colecionar algumas questões como agrupamento e fim de agrupamento a qualquer momento.</li>
<li>A próxima página é determinada pela <b>ordem lógica</b> da lição. Isto é a ordem das páginas como são vistas pelo professor. Esta ordem pode ser alterada movendo-se  as páginas dentro da lição.</li>
<li>A lição também tem uma <b>ordem de navegação</b>. Esta é a ordem das páginas vista pelo estudante. Isto é determinado pelos desvios especificados para respostas individuais e pode ser bem diferente da ordem lógica. (Embora se os desvios <i>não</i> são alterados de seus valores padrão as duas ordem são muito parecidas.) O professor tem a opção de verificar a ordem de navegação.</li>
<li>Quando apresentada para os estudantes, as respostas são normalmente embaralhadas. Isto é a primeira resposta do ponto de vista do professor não será necessariamente a primeira resposta na lista mostrada para o estudante. (Além disto, cada vez que o mesmo conjunto de respostas é mostrado elas provavelmente aparecerão em uma ordem diferente.) A exceção é o conjunto de respostas para questões do tipo casadas, aqui as respostas são mostradas na mesma ordem que foram fornecidas pelo professor.</li>
<li>O número de respostas pode variar de página para página. Por exemplo, é permitido que algumas páginas terminem com uma questão verdadeiro/falso enquanto outras tem questões com uma resposta correta e três, digamos, distrações. </li>
<li>É possível configurar uma página sem respostas. É mostrado para o estudante um link <b>Continuar</b> ao invés do conjunto de respostas embaralhadas.</li>
<li>Se a Pontuação personalizada está desligada: para o propósito de avaliação de lições, respostas <b>certas</b> são aquelas que desviam para uma página que está mais <i>abaixo</i> na ordem lógica que a página atual.
Respostas <b>erradas</b> são aquelas que desviam ou para a mesma página ou para uma página mais  <i>acima</i> na ordem lógica do que a página atual. Assim, se os desvios <i>não</i> são alterados, a primeira resposta é uma resposta correta e as outras respostas são erradas.
    <br /><br />
Se a Pontuação personalizada está ligada: avaliação de uma resposta é determinada pelo valor em pontos da resposta, o total de pontos ganhos serve como uma fração do valor total de pontos da lição, até 100%.</li>
<li>Questões podem ter mais de uma resposta correta. Por exemplo, se duas das respostas desviam para a próxima página então ambas respostas são consideradas corretas. (Embora a mesma página de destino seja mostrada para o estudante, as respostas mostradas no caminho para aquela página podem ainda ser diferentes das duas respostas.)</li>
<li>Na visão do professor da lição as repostas certas tem Rótulos de Respostas sublinhados.</li>
<li><b>Painéis de Navegação</b> são simplesmente páginas que tem um conjunto de links para outras páginas na lição. Normalmente uma lição pode começar com uma Painel de Navegação que funciona como um <b>Sumário</b>.</li>
<li>Cada link em um Painel de Navegação tem dois componentes, uma descrição e o título da página para a qual deve ser desviado.</li>
<li>Um Painel de Navegação efetivamente divide a lição em um número de <b>ramos</b> (ou seções). Cada ramo pode conter algumas páginas ( provavelmente todas relacionadas com o mesmo tópico). O fim de um ramo é normalmente marcado por uma página <b>Fim de Seção</b>. Esta é uma página especial que, por padrão, retorna o estudante para o Painel de Navegação anterior. (O desvio "retornar" em uma página Fim de Seção pode ser trocado, se necessário, concluindo a página.) </li>
<li>Pode haver mais de um Painel de Navegação em uma lição. Por exemplo, uma lição pode ser estruturada de forma que assuntos especializados são sub-ramos dentro de ramos de assuntos principais.</li>
<li>É importante dar aos estudantes uma forma de terminar a lição. Isto pode ser feito incluindo um link "Fim de Lição" no Painel de Navegação principal. Este desvia para a página (imaginária) <b>Fim de Lição</b>. Outra opção é no último ramo da lição (aqui "último" no sentido da ordem lógica) simplesmente continuar para o fim da lição, isto é, <i>não</i> é encerrada por uma página Fim de Lição.</li>
<li>Com pontuação personalizada desligada, quando uma lição inclui um ou mais Painéis de Navegação é aconselhável configurar o parâmetro "Número Minimo de Questões" para algum valor razoável. Isto coloca um limite inferior no número de páginas vistas quando a nota é calculada. Sem este parametro o estudante poderá visitar um único ramo na lição, responder todas as suas questões corretamente e deixar a lição com nota máxima.
    <br /><br />
    Com pontuação personalizada ligada, um estudante é avaliado baseado no número de pontos que ele ganhou como uma porcentagem do total de pontos para a lição.</li>
<li>Além disto, com a pontuação personalizada desligada, quando existe um Painel de Navegação um estudante tem a oportunidade de re-visitar o mesmo ramo mais de uma vez. Entretanto, a nota é calculada usando o número de questões <i>únicas</i> respondidas. Assim respondendo repetidamente o mesmo conjunto de questões <i>não</i> aumenta a nota. (De fato, o inverso acontece, a nota diminui porque o contador do número de páginas vistas é usado no denominador quando o calculo da nota inclui repetições.) A fim de dar aos estudantes uma boa idéia de seus progressos na lição, é mostrado quantas questões eles responderam corretamente, o número de páginas vistas, e suas notas atuais em cada página de Painel de navegação.
    <br /> <br />
    Com a pontuação personalizada ligada, um estudante pode rever uma questão se o caminho de navegação permitir, e ganhar novamente os pontos para aquela questão, se tentativas é maior que 1. Para não permitir isto, coloque tentativas igual a 1.</li>
<li>O <b>fim da lição</b> é alcançado ou desviando para aquela localização explicitamente ou desviando para a próxima página a partir da última (ordem lógica) página da lição. Com a pontuação personalizada desligada, quando o fim da lição é alcançado, o estudante recebe uma mensagem de congratulações e é mostrada a sua nota. A nota é (o número de questões respondidas corretamente / número de páginas vistas) x a nota da lição. Com a pontuação personalizada ligada, a nota é os pontos ganhos em percentual do total de pontos (p.ex. 3 pontos ganhos para uma lição de 3 pontos = 100% de 3 pontos.</li>
<li>Se o fim da lição <i>não</i> é alcançado e o estudante simplesmente sai, quando ele retorna na lição tem a chance de escolher entre começar do início ou a partir da última questão que ele respondeu corretamente.</li>
<li>Para uma lição que permite repetição, o professor tem a escolha de usar a melhor nota ou a média das notas como nota "final" da lição. Esta nota é mostrada na página Notas, por exemplo.</li>
<li>Página de Agrupamento: um agrupamento representa um conjunto de questões do qual uma ou mais podem ser escolhidas aleatoriamente. Agrupamentos devem ser terminados com uma página de Fim de Agrupamento para melhor funcionamento (Senão o Fim da Lição é tratado como o Fim de Agrupamento). Questões em um agrupamento são selecionadas aleatoriamente escolhendo "Questão Aleatória dentro de um Agrupamento" como um desvio. Questões em um agrupamento podem ou ligar ao Fim de Agrupamento para sair do agrupamento, ou desviar para uma questão não vista dentro do agrupamento, ou desviar para qualquer outra página na lição. Isto também permite a criação de cenários com um elemento aleatório usando o módulo lição.</li>
</ol>';
$string['page'] = 'Página: {$a}';
$string['pagecontents'] = 'Conteúdo da página';
$string['page-mod-lesson-edit'] = 'Editar página da Lição';
$string['page-mod-lesson-view'] = 'Visualizar ou pré-visualizar página da lição';
$string['page-mod-lesson-x'] = 'Qualquer página da lição';
$string['pages'] = 'Páginas';
$string['pagetitle'] = 'Título da página';
$string['password'] = 'Senha';
$string['passwordprotectedlesson'] = '{$a} é uma atividade protegida por senha';
$string['pleasecheckoneanswer'] = 'Salvar a resposta selecionada';
$string['pleasecheckoneormoreanswers'] = 'Salvar as respostas selecionadas';
$string['pleaseenteryouranswerinthebox'] = 'Salvar a resposta escrita no box';
$string['pleasematchtheabovepairs'] = 'Salvar os pares associados acima';
$string['pluginadministration'] = 'Administração de Lição';
$string['pluginname'] = 'Lição';
$string['pointsearned'] = 'Pontos recebidos';
$string['postprocesserror'] = 'Ocorreu um erro durante o processamento da mensagem';
$string['postsuccess'] = 'Envio bem sucedido';
$string['pptsuccessfullimport'] = 'Importação de páginas da apresentação do Powerpoint realizada com sucesso';
$string['practice'] = 'Exercício';
$string['practice_help'] = '<p>Uma lição prática não publica notas de avaliação.</p>';
$string['preprocesserror'] = 'Ocorreu um erro durante o pré-processamento!';
$string['preview'] = 'Visualizar';
$string['previewlesson'] = 'Visualizar {$a}';
$string['previouspage'] = 'Página anterior';
$string['processerror'] = 'Ocorreu um erro durante o processamento!';
$string['progressbar'] = 'Barra de progresso';
$string['progressbar_help'] = '<p>Exibe uma barra de progresso na parte de baixo da Lição.
   Atualmente, a barra de progresso é mais precisa com uma Lição linear.</p>

<p>No cálculo da percentagem completada, Painéis de Navegação e páginas de Questões
   que foram respondidas corretamente contam para o progresso da Lição. No cálculo do
   número total de páginas na lição, agrupamentos e páginas dentro de agrupamentos são
   contadas como páginas simples e páginas de Fim de Agrupamento e Fim do Painel de Navegação são excluídas. Todas as outras páginas contam para o número total
   de páginas na Lição.</p>

<p>Nota: os estilos padrão para a barra de progresso não são espetaculares ;)
   Tudo pode ser modificado nos estilos da barra de progresso (exm.: cores, imagens de fundo,
   etc.) em mod/lição/estilos.php.';
$string['progressbarteacherwarning'] = 'Barra de progresso não é mostrada para {$a}';
$string['progressbarteacherwarning2'] = 'Você não verá a barra de progresso porque você pode editar esta lição.';
$string['progresscompleted'] = 'Você completou {$a}% da lição';
$string['qtype'] = 'Tipo de página';
$string['question'] = 'Questão';
$string['questionoption'] = 'Modalidade opcional';
$string['questiontype'] = 'Tipo de questão';
$string['randombranch'] = 'Página de seção aleatória';
$string['randompageinbranch'] = 'Questão aleatória de uma seção';
$string['rank'] = 'Classificação';
$string['rawgrade'] = 'Nota não ponderada';
$string['receivedcredit'] = 'Créditos recebidos';
$string['redisplaypage'] = 'Mostrar página de novo';
$string['report'] = 'Relatório';
$string['reports'] = 'Relatórios';
$string['response'] = 'Retorno';
$string['retakesallowed'] = 'Permite-se retomar a lição.';
$string['retakesallowed_help'] = '<p>Esta configuração determina se os estudantes poderão fazer a lição mais de uma vez ou sómente uma vez. O professor pode decidir que a lição contém material que o estudante deve aprender inteiramente. Neste caso repetir a lição deve ser permitido. Entretanto, se o material é usado mais como um exame então os estudantes não podem ter permissão para repetir a lição</p>

<p>Quando os estudantes tem permissão para refazer a lição, as <b>notas</b> mostradas na página de Notas ou são sua <b>média</b> das repetições ou sua <b>melhor</b> nota para a lição. O parametro seguinte determina qual destas duas alternativas de avaliação é usada.</p>

<p>Note que a <b>A Análise da Questão</b> sempre usa as resposta da primeira tentativa da lição, tentativas seguintes são ignoradas.</p>

<p>O valor padrão desta opção é <b>Não</b>, significando que estudantes não tem permissão para refazer a lição. É esperado que sómente em circunstancias excepcionais esta opção seja configurada para o valor <b>Sim</b>.</p>';
$string['returnto'] = 'Voltar para {$a}';
$string['returntocourse'] = 'Voltar ao curso';
$string['review'] = 'Revisão';
$string['reviewlesson'] = 'Rever Lição';
$string['reviewquestionback'] = 'Sim, eu gostaria de tentar novamente';
$string['reviewquestioncontinue'] = 'Não, quero continuar com a próxima questão';
$string['sanitycheckfailed'] = 'O controle dos dados falhou: Esta tentativa foi cancelada';
$string['savechanges'] = 'Salvar mudanças';
$string['savechangesandeol'] = 'Salvar todas as mudanças e ir para o fim da lição';
$string['savepage'] = 'Salvar página';
$string['score'] = 'Pontuação';
$string['scores'] = 'Pontuações';
$string['secondpluswrong'] = 'Não é exato. Você quer tentar novamente?';
$string['selectaqtype'] = 'Escolha um tipo de pergunta';
$string['shortanswer'] = 'Resposta curta';
$string['showanunansweredpage'] = 'Mostrar uma página que ainda não foi respondida';
$string['showanunseenpage'] = 'Mostrar uma página que ainda não foi visitada';
$string['singleanswer'] = 'Resposta única';
$string['skip'] = 'Avançar navegação';
$string['slideshow'] = 'Apresentação de Slides';
$string['slideshowbgcolor'] = 'Cor do fundo da página da Apresentação de Slides';
$string['slideshowheight'] = 'Altura da Apresentação de Slides';
$string['slideshow_help'] = '<p>Isso permite a exibição das lições como uma apresentação de slide, com largura e altura fixas e cor do plano de fundo alterável. Uma barra de rolagem em CSS será mostrada se o conteúdo do slide exceder o tamanho da página. Quando aparecer questões, a tela sairá do modo de slides, somente páginas (tabelas ramificadas) serão mostradas em um slide por padrão. Botões de Ir e Voltar, já traduzidos no idioma padrão, serão mostrados nas extremas direita e esquerda se essa opção for ativada. Outros botões serão centralizados abaixo do slide.</p>';
$string['slideshowwidth'] = 'Largura da Apresentação de Slides';
$string['startlesson'] = 'Iniciar Lição';
$string['studentattemptlesson'] = 'número da tentativa {$a->attempt} de {$a->lastname}, {$a->firstname}';
$string['studentname'] = '{$a} Nome';
$string['studentoneminwarning'] = 'Atenção: Você tem menos de 1 minuto para acabar a lição.';
$string['studentresponse'] = 'resposta de {$a}';
$string['submit'] = 'Enviar';
$string['submitname'] = 'Enviar nome';
$string['teacherjumpwarning'] = 'Um destino {$a->cluster} ou um destino {$a->unseen} está sendo usado nesta lição. O destino Próxima Página substituirá o anterior. Faça o login como estudante para testar estes destinos.';
$string['teacherongoingwarning'] = 'Para testar a pontuação corrente é necessário fazer o login como estudante.';
$string['teachertimerwarning'] = 'Para testar o timer é necessário fazer o login como estudante.';
$string['thatsthecorrectanswer'] = 'Esta é a resposta correta';
$string['thatsthewronganswer'] = 'Esta é a resposta errada';
$string['thefollowingpagesjumptothispage'] = 'As seguintes páginas tem como destino esta página';
$string['thispage'] = 'Esta página';
$string['timeremaining'] = 'Tempo restante';
$string['timespenterror'] = 'Dedica pelo menos {$a}  a esta lição';
$string['timespentminutes'] = 'Tempo dedicado (em minutos)';
$string['timetaken'] = 'Tempo utilizado';
$string['topscorestitle'] = '{$a} melhores pontuações da lição.';
$string['truefalse'] = 'Verdadeiro/Falso';
$string['unabledtosavefile'] = 'O arquivo que você fez upload não pode ser salvo';
$string['unknownqtypesnotimported'] = '{$a} questões com tipos de perguntas não suportadas não foram importadas.';
$string['unseenpageinbranch'] = 'Questão não vista de uma seção';
$string['unsupportedqtype'] = 'Tipo de questão incompatível  ({$a})!';
$string['updatedpage'] = 'Página atualizada';
$string['updatefailed'] = 'Erro na atualização';
$string['usemaximum'] = 'Usar melhor resultado entre as tentativas';
$string['usemean'] = 'Usar média das tentativas';
$string['usepassword'] = 'Lição protegida por senha';
$string['usepassword_help'] = '<p>Isto bloqueará o acesso dos estudantes à lição a menos que digitem a senha..</p>';
$string['viewgrades'] = 'Ver notas';
$string['viewhighscores'] = 'Ver lista dos melhores resultados';
$string['viewreports'] = 'Ver {$a->attempts} {$a->student} tentativas completas';
$string['viewreports2'] = 'Ver {$a} tentativas completas';
$string['welldone'] = 'Muito bem!';
$string['whatdofirst'] = 'O que você gostaria de fazer primeiro?';
$string['wronganswerjump'] = 'Destino da resposta errada';
$string['wronganswerscore'] = 'Pontuação da resposta errada';
$string['wrongresponse'] = 'Resposta errada';
$string['xattempts'] = '{$a} tentativas';
$string['youhaveseen'] = 'Você já visitou algumas páginas desta lição.<br />Você quer iniciar a partir da última página visitada?';
$string['youmadehighscore'] = 'O seu resultado está incluído entre os melhores {$a}.';
$string['youranswer'] = 'A sua resposta';
$string['yourcurrentgradeis'] = 'A sua avaliação atual é {$a}';
$string['yourcurrentgradeisoutof'] = 'A sua nota atual é {$a->grade} sobre {$a->total}';
$string['youshouldview'] = 'Você deve visitar pelo menos: {$a}';
