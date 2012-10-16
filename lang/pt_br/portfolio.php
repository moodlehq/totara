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
 * Strings for component 'portfolio', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   portfolio
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['activeexport'] = 'Resolver exportação ativo';
$string['activeportfolios'] = 'Portfólios disponíveis';
$string['addalltoportfolio'] = 'Exportar tudo para portfólio';
$string['addnewportfolio'] = 'Adicionar um novo portfólio';
$string['addtoportfolio'] = 'Exportar para portfólio';
$string['alreadyalt'] = 'Já exportação - clique aqui para resolver essa transferência';
$string['alreadyexporting'] = 'Você já tem um portfólio de exportação ativo nesta sessão. Antes de continuar, você deve concluir esta exportação, ou cancelá-la. Gostaria de continuar? (Não irá cancelá-lo)';
$string['availableformats'] = 'Formatos de exportação disponíveis';
$string['callbackclassinvalid'] = 'A classe da "callback" especificada é inválida ou não faz parte da hierarquia de "portfolio_caller"';
$string['callercouldnotpackage'] = 'Falha ao empacotar seus dados para exportação: erro original foi {$a}';
$string['cannotsetvisible'] = 'Não é possível tornar isto visível - o plugin foi desabilitado completamente por problemas na configuração';
$string['commonportfoliosettings'] = 'Configurações comuns de portfolio';
$string['commonsettingsdesc'] = '<p>Quer uma transferência pode levar um tempo \'Moderado\' ou \'Alto\', quer o usuário está sujeito a esperar pela conclusão ou não de uma transferência.</p><p>Tamanhos até o limite de \'Moderado\' e \'Alto\' significam que é dada a opção mas alerta-se que pode levar algum tempo</p><p>Adicionalmente, alguns plugins de portfólios pode ignorar eta opção completamente e forçar todas transferências a serem postergadas</p>';
$string['configexport'] = 'Configure os dados a serem exportados';
$string['configplugin'] = 'Configure o plugin de portfólio';
$string['configure'] = 'Configurar';
$string['confirmcancel'] = 'Você está certo que deseja cancelar esta exportação?';
$string['confirmexport'] = 'Por favor confirme esta exportação';
$string['confirmsummary'] = 'Sumário de sua exportação';
$string['continuetoportfolio'] = 'Continua para seu portfolio';
$string['deleteportfolio'] = 'Excluir instância de portfolio';
$string['destination'] = 'Destino';
$string['disabled'] = 'Desculpe, mas exportação de portfolio não está habilitado neste site';
$string['disabledinstance'] = 'Desabilitado';
$string['displayarea'] = 'Área de exportação';
$string['displayexpiry'] = 'Tempo de expiração de transferência';
$string['displayinfo'] = 'Informações de exportação';
$string['dontwait'] = 'Não espere';
$string['enabled'] = 'Habilitar portifólios';
$string['enableddesc'] = 'Isso permitirá que os administradores configurem sistemas remotos para os usuários enviarem conteúdo';
$string['err_uniquename'] = 'O nome do portfólio deve ser único ( por plugin)';
$string['exportalreadyfinished'] = 'Exportação do portfólio concluída!';
$string['exportalreadyfinisheddesc'] = 'Exportação do portfólio concluída!';
$string['exportcomplete'] = 'Exportação do portfólio concluída!';
$string['exportedpreviously'] = 'Exportações anteriores';
$string['exportexceptionnoexporter'] = 'A portfolio_export_exception foi lançado com uma sessão ativa, mas nenhum objeto exportador';
$string['exportexpired'] = 'Exportação de portfólio expirada';
$string['exportexpireddesc'] = 'Você tentou repetir a exportação de alguma informação ou iniciar uma exportação sem conteúdo. Para realizar esta operação apropriadamente, você terá que voltar ao local original e começar novamente. Isto acontece algumas vezes se você usa o botão Voltar do seu navegador depois de uma exportação estar completa ou por visitar uma url inválida.';
$string['exporting'] = 'Exportando para portfólio';
$string['exportingcontentfrom'] = 'Exportando conteúdo de {$a}';
$string['exportingcontentto'] = 'Exportando conteúdo para {$a}';
$string['exportqueued'] = 'Exportação do portfólio foi agendada com sucesso para transferência';
$string['exportqueuedforced'] = 'Exportação do portfólio foi agendada com sucesso para transferência (o sistema remoto exigiu transferências agendadas)';
$string['failedtopackage'] = 'Não foi possível encontrar os arquivos para o pacote';
$string['failedtosendpackage'] = 'Falha ao enviar seus dados para o sistema de portfólio selecionado: erro original foi {$a}';
$string['filedenied'] = 'Acesso negado a este arquivo';
$string['filenotfound'] = 'Arquivo não encontrado';
$string['fileoutputnotsupported'] = 'Re-escrever arquivo de saída não é suportado para este formato';
$string['format_document'] = 'Documento';
$string['format_file'] = 'Arquivo';
$string['format_image'] = 'Imagem';
$string['format_leap2a'] = 'Formato de portfólio Leap2A';
$string['format_mbkp'] = 'Formato de backup Moodle';
$string['format_pdf'] = 'PDF';
$string['format_plainhtml'] = 'HTML';
$string['format_presentation'] = 'Apresentação';
$string['format_richhtml'] = 'HTML com anexos';
$string['format_spreadsheet'] = 'Planilha';
$string['format_text'] = 'Texto plano';
$string['format_video'] = 'Vídeo';
$string['hidden'] = 'Oculto';
$string['highdbsizethreshold'] = 'Limite de tamanho de base de dados';
$string['highdbsizethresholddesc'] = 'Número de registros da base de dados até o qual será possível cumprir o tempo máximo de transferência';
$string['highfilesizethreshold'] = 'Limite para tamanho de arquivo';
$string['highfilesizethresholddesc'] = 'Arquivos alem desse tamanho máximo serão considerados a levar um grande intervalo de tempo';
$string['insanebody'] = 'Olá! Você está recebendo esta mensagem com um adminsistrador do {$a->sitename}.

Algumas instâncias do plugin de portfólio foram automaticamente desabitadas por conta de problemas de configuração. Isto significa que usuário estão impedidos de exportar corretamente o conteúdo de seus portfólios.

A lista de instâncias do plugin de portfólio que foram desabilitadas é:

{$a->textlist}

Isso precisa ser corrigido o mais cedo possível visitando {$a->fixurl}.';
$string['insanebodyhtml'] = '<p>Olá! Você está recebendo esta mensagem com um adminsistrador do {$a->sitename}.</p>

<p>Algumas instâncias do plugin de portfólio foram automaticamente desabitadas por conta de problemas de configuração. Isto significa que usuário estão impedidos de exportar corretamente o conteúdo de seus portfólios.</p>

<p>A lista de instâncias do plugin de portfólio que foram desabilitadas é:</p>

{$a->textlist}

<p>Isso precisa ser corrigido o mais cedo possível visitando <a href="{$a->fixurl}">a página de configuração do portifólio</a>.</p>';
$string['insanebodysmall'] = 'Olá! Você está recebendo esta mensagem com um adminsistrador do {$a->sitename}. Algumas instâncias do plugin de portfólio foram automaticamente desabitadas por conta de problemas de configuração. Isso precisa ser corrigido o mais cedo possível visitando {$a->fixurl}.';
$string['insanesubject'] = 'Algumas instâncias do portfólio automaticamente dasabilitadas';
$string['instancedeleted'] = 'Portfólio excluído com sucesso';
$string['instanceismisconfigured'] = 'Instância do portfólio possui problemas de configuração. Os erros foram: {$a}';
$string['instancenotdelete'] = 'Falha ao excluir carteira';
$string['instancenotsaved'] = 'Falha ao salvar o portfólio';
$string['instancesaved'] = 'Portfólio salvo com sucesso';
$string['invalidaddformat'] = 'Formato inválido passado ao portfolio_add_button. ({$a}) precisa um dos PORTFOLIO_ADD_XXX';
$string['invalidbuttonproperty'] = 'Não foi possível encontrar esta propriedade ({$a}) de portfolio_button';
$string['invalidconfigproperty'] = 'Não foi possível encontrar esta propriedade de configuração  ({$a->property} em {$a->class})';
$string['invalidexportproperty'] = 'Não foi possível encontrar esta propriedade de configuração de exportação ({$a->property} em {$a->class})';
$string['invalidfileareaargs'] = 'Argumentos de área de arquivo inválidos passados paraset_file_and_format_data - precisam conter contextid, component, filearea e itemid';
$string['invalidformat'] = 'Algo está exportando um formato inválido, {$a}';
$string['invalidinstance'] = 'Não foi possível encontrar a instância do portfólio';
$string['invalidpreparepackagefile'] = 'Chamada inválida para prepare_package_file - ambos \'single\' e \'multifiles\' precisam estar setados';
$string['invalidproperty'] = 'Não foi possível encontrar a propriedade ({$a->property} of {$a->class})';
$string['invalidsha1file'] = 'Chamada inválida para get_sha1_file - ambos \'single\' e \'multifile\' precisam estar setados';
$string['invalidtempid'] = 'Id de exportação inválido. Talvez esteja expirado';
$string['invaliduserproperty'] = 'Não foi possível encontrar a propriedade de configuração ({$a->property} of {$a->class})';
$string['leap2a_emptyselection'] = 'Valor obrigatório não selecionado';
$string['leap2a_entryalreadyexists'] = 'Você tentou adiconar uma entrada Leap2A com id ({$a}) que já existe neste feed';
$string['leap2a_feedtitle'] = 'Leap2A exporta do Moodle para {$a}';
$string['leap2a_filecontent'] = 'Tentou setar o conteúdo de uma entrada Leap2A para um arquivo ao invés de usar a sub-classe do arquivo';
$string['leap2a_invalidentryfield'] = 'Você tentou setar uma campo de entrada que não existe ({$a}) ou você não pode fazê-lo diretamente';
$string['leap2a_invalidentryid'] = 'Você tentou acessar um registro com um id que não existe ({$a})';
$string['leap2a_missingfield'] = 'Campo da entrada Leap2A obrigatório {$a} faltante';
$string['leap2a_nonexistantlink'] = 'Uma entrada Leap2A ({$a->from}) tentou linkar a uma entrada que não existe ({$a->to}) com rel {$a->rel}';
$string['leap2a_overwritingselection'] = 'Sobrescrevendo o tipo original de uma entrada ({$a}) para selecionar em make_selection';
$string['leap2a_selflink'] = 'Uma entrada Leap2A ({$a->id}) tentou linkar a si própria com rel {$a->rel}';
$string['logs'] = 'Logs de transferência';
$string['logsummary'] = 'Transferências anteriores bem sucedidas';
$string['manageportfolios'] = 'Gerenciar portfólios';
$string['manageyourportfolios'] = 'Gerenciar os seus portfólios';
$string['mimecheckfail'] = 'O plugin de portfólio {$a->plugin} não suporta o mimetype {$a->mimetype}';
$string['missingcallbackarg'] = 'Argumento de callback ausente {$a->arg} para a classe {$a->class}';
$string['moderatedbsizethreshold'] = 'Tamanho de base de dados moderada';
$string['moderatedbsizethresholddesc'] = 'Número de registros na base de dados a partir do qual será esperado levar um intervalo de tempo moderado na trasnferência';
$string['moderatefilesizethreshold'] = 'Tamanho moderado de aquivo';
$string['moderatefilesizethresholddesc'] = 'Arquivos com tamanhos até esse limite levarão um tempo moderado para transferir';
$string['multipleinstancesdisallowed'] = 'Tentando criar outra instância de um plugin desabilitou diversas instancias ({$a})';
$string['mustsetcallbackoptions'] = 'Você precisa configurar as opções de callback no construtor no portfolio_add_button ou usando o método set_callback_options';
$string['noavailableplugins'] = 'Desculpe, mas não há portfólios disponíveis para exportação';
$string['nocallbackclass'] = 'Não foi possível encontrar a classe de callback para uso ({$a})';
$string['nocallbackfile'] = 'Alguma coisa no módulo que você está tentando exportar está quebrada - não foi possível encontrar o arquivo ({$a})';
$string['noclassbeforeformats'] = 'Você precisa configurar a classe de calback antes de chamarset_formats em portfolio_button';
$string['nocommonformats'] = 'Nenhum formato comum {$a->location} (caller supported {$a->formats})';
$string['noinstanceyet'] = 'Nada foi selecionado';
$string['nologs'] = 'Não existem logs para exibir!';
$string['nomultipleexports'] = 'Lamento, mas o destino do portfólio ({$a->plugin}) não suporta exportações múltimplas simultâneas. Por favor <a href="{$a->link}">termine a exportação corrente </a> e tente novamente';
$string['nonprimative'] = 'Um valor não primitivo passou um argumento de callback para portfolio_add_button. Recusando para contiuar. A chave foi  {$a->key} e os valores foram {$a->value}';
$string['nopermissions'] = 'Desculpe, mas você não tem as permissões necessárias para exportar arquivos desta área';
$string['notexportable'] = 'Desculpe, mas não é possível exportar este tipo de conteúdo.';
$string['notimplemented'] = 'Desculpe, mas você está tentando exportar o conteúdo em algum formato que ainda não está implementado ({$a})';
$string['notyetselected'] = 'Ainda não selecionado';
$string['notyours'] = 'Você está tentando retomar uma exportação de portfólio que não pertence a você!';
$string['nouploaddirectory'] = 'Não foi possível criar um diretório temporário para empacotar os dados em';
$string['off'] = 'Habilitado porém oculto';
$string['on'] = 'Habilitado e visível';
$string['plugin'] = 'Plugin portfolio';
$string['plugincouldnotpackage'] = 'Falha ao empacotar os dados para exportação: o erro original foi {$a}';
$string['pluginismisconfigured'] = 'O plugin de portifólio não esta configurado, saltando. O erro foi: {$a}';
$string['portfolio'] = 'Portfólio';
$string['portfolios'] = 'Portfólios';
$string['queuesummary'] = 'Transferências atualmente na fila';
$string['returntowhereyouwere'] = 'Retornar para onde você estava';
$string['save'] = 'Salvar';
$string['selectedformat'] = 'Formato de exportação selecionado';
$string['selectedwait'] = 'Selecionado para esperar?';
$string['selectplugin'] = 'Escolha o destino';
$string['singleinstancenomultiallowed'] = 'Somente uma única instância do plugin de portfólio está disponível. Esta não suporta múltiplas exportações por sessão e já existe uma exportação ativa na sessão usando este plugin!';
$string['somepluginsdisabled'] = 'Alguns plugins inteiros forma desabilitados por conta de erros de configuração ou por depender de outro componente que está:';
$string['sure'] = 'Tem certeza de que deseja excluir \'{$a}\'? Isso não poderá ser desfeito.';
$string['thirdpartyexception'] = 'Uma exceção foi enviada por um conponente externo durante a exportação ({$a}). A exceção foi interceptada e reenviada, mas isto precisa realmente ser consertado.';
$string['transfertime'] = 'Tempo de transferência';
$string['unknownplugin'] = 'Desconhecido (pode ter sido removido por um administrador)';
$string['wait'] = 'Espere';
$string['wanttowait_high'] = 'Não é recomendável que você aguarde esta transferência terminar, mas você pode se você estiver certo do que estiver fazendo';
$string['wanttowait_moderate'] = 'Você quer esperar por esta transferência? Isto pode levar alguns minutos';
