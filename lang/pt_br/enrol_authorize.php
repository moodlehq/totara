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
 * Strings for component 'enrol_authorize', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol_authorize
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['adminacceptccs'] = 'Que tipos de cartão de crédito são aceitos?';
$string['adminaccepts'] = 'Selecionar os métodos os tipos de pagamento autorizados';
$string['adminauthorizeccapture'] = 'Configurações de revisão de encomenda & Auto-Capture';
$string['adminauthorizeemail'] = 'Configurações de envio de e-mail';
$string['adminauthorizesettings'] = 'Configurações da conta de "merchant" do Authorize.net';
$string['adminauthorizewide'] = 'Configurações gerais';
$string['adminconfighttps'] = 'Controle se o "<a href="{$a->url}"> loginhttps está habilitado</a>" para usar este plugin<br />em Admin >> Variáveis >> Segurança >> Segurança HTTP.';
$string['adminconfighttpsgo'] = 'Vai à <a href="{$a->url}">página segura</a> para configurar este plugin.';
$string['admincronsetup'] = 'O script de manutenção cron.php não foi executado nas últimas 24 horas.<br /> O Cron deve estar habilitado para utilizar autocapture.<br />Cron precisa estar habilitado para usar o recurso de Configure o cron em modo correto ou desmarque novamente an_review.<br />Se você desabilitar autocapture, as transações que não forem controladas em 30 dias, serão canceladas.<br />Selecionar an_review e inserir \'0\' no campo an_capture_day <br />se você quiser aceitar e recusar manualmente os pagamentos em 30 dias.';
$string['adminemailexpiredsort'] = 'Quando o número de pedidos pendentes que estão expirando é enviado aos professores por email, qual é importante?';
$string['adminemailexpiredsortcount'] = 'O número de encomendas';
$string['adminemailexpiredsortsum'] = 'O valor total';
$string['adminemailexpsetting'] = '(0=desabilitar envio de email, padrão=2, max=5)<br />(Opções de captura manual para envio de email: cron=habilitado, an_review=selecionado, an_capture_day=0, an_emailexpired=1-5)';
$string['adminhelpcapturetitle'] = 'Dia de Auto-Capture';
$string['adminhelpreviewtitle'] = 'Revisão de Pedido';
$string['adminneworder'] = 'Prezado Admin,

Você recebeu um novo pedido pendente:

Pedido ID: {$a->orderid}
Transação ID: {$a->transid}
Usuário: {$a->user}
Curso: {$a->course}
Valôr: {$a->amount}

AUTO-CAPTURE ATIVADO?: {$a->acstatus}

Se auto-capture é ativo o cartão de crédito será capturado em {$a->captureon}
e o aluno será inscrito no curso, em caso contrário expira em {$a->expireon} e não pode ser capturado em data posterior.
Você também pode aceitar ou recusar o pagamento e inscrever o aluno imediatamente seguindo este link :
{$a->url}';
$string['adminnewordersubject'] = '{$a->course}: Novo pedido pendente({$a->orderid})';
$string['adminpendingorders'] = 'Você desabilitou a auto-captura.<br />As transações totais {$a->count} com status AN_STATUS_AUTH serão canceladas a menos que você as selecione.<br />Para aceitar/recusar pagamentos vá ao <a href=\'{$a->url}\'>painel de gestão de pagamentos</a>';
$string['adminteachermanagepay'] = 'Professores podem administrar os pagamentos do curso';
$string['allpendingorders'] = 'Todos os pedidos pendentes';
$string['amount'] = 'Valor';
$string['anauthcode'] = 'Obter código de autenticação';
$string['anauthcodedesc'] = 'Se seu cartão de crédito não pode ser utilizado diretamente via internet, sugerimos que procure o serviço de atendimento ao cliente de seu banco.';
$string['anavs'] = 'Verificação de segurança do sistema';
$string['anavsdesc'] = 'Marque esta opção se você tiver ativado Sistema de Verificação de Endereços (AVS) em sua conta comercial authorize.Net. Isso exige endereço de campos como rua, estado, zip país e quando o usuário preenche o formulário de pagamento.';
$string['ancaptureday'] = 'Dia de fatura';
$string['ancapturedaydesc'] = 'Fature o cartão de crédito automaticamente a menos que um professor ou administrador do sistema negue a ordem. O CRON precisa estar habilitado. <br/>( Se estiver marcado 0(zero) dias este recurso será removido da cobrança programada, e o professor ou administrador do sistema terá que rever a ordem de pagamento manualmente. Se a cobrança programada for desativada a transação será cancelada, a menos que você retroceda esta operação em até trinta dias).';
$string['anemailexpired'] = 'Aviso de expiração';
$string['anemailexpireddesc'] = 'Isto é útil para o "Manual-Capture". Os administradores do sistema serão notificados do montante especificado dias antes das ordens pendentes expirarem.';
$string['anemailexpiredteacher'] = 'Aviso de expiração - Professor';
$string['anemailexpiredteacherdesc'] = 'Se você habilitou a manual-capture (veja acima) e os professores podem gerenciar o pagament, eles também poderão ser notificados de ordens de pagamento pendentes prestes a expirar. Este recurso enviará um e-mail para os professores do curso sobre as ordens pendentes.';
$string['anlogin'] = 'Authorize.net: Nome para Login';
$string['anpassword'] = 'Authorize.net: Senha';
$string['anreferer'] = 'Referer';
$string['anrefererdesc'] = 'Definir a URL de referência se você configurou isto na tua conta authorize.net. Isto incluirá uma linha "Referer: URL" na solicitação.';
$string['anreview'] = 'Revisão';
$string['anreviewdesc'] = 'Confira a ordem de pagamento antes de autorizar a cobrança no cartão de crédito.';
$string['antestmode'] = 'Executar transações apenas em modalidade de teste (não serão feitas transações monetárias reais)';
$string['antestmodedesc'] = 'Efetuando transações em modo de teste (nenhuma quantia será cobrada).';
$string['antrankey'] = 'Authorize.net: Chave para transação';
$string['approvedreview'] = 'Revisão aprovada';
$string['authcaptured'] = 'Autorizado/ Capturado';
$string['authcode'] = 'Código de autorização';
$string['authorize:config'] = 'configurar instâncias de inscrição em Authorize.Net';
$string['authorizedpendingcapture'] = 'Autorizado/ Captura pendente';
$string['authorizeerror'] = 'Erro Authorize.Net: {$a}';
$string['authorize:manage'] = 'Gerenciar usuários inscritos';
$string['authorize:managepayments'] = 'Gerenciar pagamentos';
$string['authorize:unenrol'] = 'Desinscrever usuários deste curso';
$string['authorize:unenrolself'] = 'Cancelar inscrição em curso';
$string['authorize:uploadcsv'] = 'Enviar arquivo CSV';
$string['avsa'] = 'Endereço (rua) corresponde, mas código postal não';
$string['avsb'] = 'Endereço não foi fornecido';
$string['avse'] = 'Erro de controle do endereço';
$string['avsg'] = 'Banco emissor do cartão não é Americano';
$string['avsn'] = 'Nenhuma correspondência com endereço e código postal';
$string['avsp'] = 'Sistema de Controle de Pagamentos não é aplicável';
$string['avsr'] = 'Retry - System não disponível';
$string['avsresult'] = 'Resultado AVS: {$a}';
$string['avss'] = 'Serviço não suportado pelo emissor';
$string['avsu'] = 'Informações sobre o endereço não disponível';
$string['avsw'] = 'Código postal de 9 dígitos corresponde, mas endereço (rua) não';
$string['avsx'] = 'Endereço (rua) e código postal de 9 dígitos correspondem';
$string['avsy'] = 'Endereço (rua) e código postal de 5 dígitos correspondem';
$string['avsz'] = 'Código postal de 5 dígitos corresponde, endereço (rua)não';
$string['canbecredit'] = 'Pode ser restituído a {$a->upto}';
$string['cancelled'] = 'Cancelado';
$string['capture'] = 'Captura';
$string['capturedpendingsettle'] = 'Capturado/ estabelecimento pendente';
$string['capturedsettled'] = 'Capturado/ estabelecido';
$string['captureyes'] = 'O cartão de crédito vai ser capturado e o aluno vai ser inscrito no curso. Proceder?';
$string['cccity'] = 'Cidade';
$string['ccexpire'] = 'Data de expiração';
$string['ccexpired'] = 'O cartão de crédito expirou';
$string['ccinvalid'] = 'Número de cartão não válido';
$string['cclastfour'] = 'Últimos 4 digitos do Cartão de Crédito';
$string['ccno'] = 'Número do cartão de crédito';
$string['ccstate'] = 'Estado';
$string['cctype'] = 'Tipo de cartão de crédito';
$string['ccvv'] = 'Número de verificação do cartão';
$string['ccvvhelp'] = 'Olhe na parte de trás do cartão (últimos 3 dígitos)';
$string['choosemethod'] = 'Insira o código de inscrição do curso. Se você ainda não tem este código, é necessário fazer a inscrição (e pagar) para poder obtê-lo.';
$string['chooseone'] = 'Complete um ou dois dos campos abaixo. A senha é secreta.';
$string['cost'] = 'Custo';
$string['costdefaultdesc'] = '<strong>Na configuração do curso, inserir -1</strong> no campo de preço para usar este preço padrão.';
$string['currency'] = 'Moeda';
$string['cutofftime'] = 'Tempo de Cut-Off ';
$string['cutofftimedesc'] = 'Hora limite de transação bancária. Quando será recolhida para liquidação a última transação?';
$string['dataentered'] = 'Dados inseridos';
$string['delete'] = 'Destruir';
$string['description'] = 'O módulo Authorize.Net permite criar cursos pagos através de provedores de pagamento. Existem duas formas de definir o custo do curso (1) um custo padrão para todo o site ou (2) uma configuração do curso onde você define um custo para cada curso individualmente. O valor do curso substitui o valor do site.
';
$string['echeckabacode'] = 'Número do banco ABA';
$string['echeckaccnum'] = 'Número de conta bancária';
$string['echeckacctype'] = 'Tipo de conta bancária';
$string['echeckbankname'] = 'Nome do banco';
$string['echeckbusinesschecking'] = 'Controle de business';
$string['echeckchecking'] = 'Controle';
$string['echeckfirslasttname'] = 'Proprietário da conta bancária';
$string['echecksavings'] = 'Economias';
$string['enrolenddate'] = 'Data final';
$string['enrolenddaterror'] = 'Data final de inscrições não pode ser anterior a data de ínicio';
$string['enrolname'] = 'Gateway de pagamento Authorize.net';
$string['enrolperiod'] = 'Duração da inscrições';
$string['enrolstartdate'] = 'Data de início';
$string['expired'] = 'Extinto';
$string['expiremonth'] = 'Mês de vencimento';
$string['expireyear'] = 'Ano de vencimento';
$string['firstnameoncard'] = 'Primeiro nome no cartão';
$string['haveauthcode'] = 'Já tenho um código de autorização';
$string['howmuch'] = 'Quanto?';
$string['httpsrequired'] = 'Lamentamos informar que seu não foi possível processar sua requisição agora. Esta configuração do site não foi aplicada corretamente.<br /><br />Por favor, não insira o seu número de cartão de crédito a menos que você veja um cadeado amarelo na parte inferior do navegador. Se o símbolo aparecer, significa que a página criptografa todos os dados enviados entre o cliente e o servidor. Assim, as informações durante a transação entre os dois computadores estão protegidas, portanto o número de seu cartão de crédito não pode ser capturado através da internet.';
$string['invalidaba'] = 'Número ABA não válido';
$string['invalidaccnum'] = 'Número de conta não válido';
$string['invalidacctype'] = 'Tipo de conta não válido';
$string['isbusinesschecking'] = 'É  verificação de negócio?';
$string['lastnameoncard'] = 'Sobrenome no cartão';
$string['logindesc'] = 'Esta opção deve estar ativa.
<br /><br />
Você pode configurar a opção <a href="{$a->url}">loginhttps</a> na seção Variáveis/Segurança.
<br /><br />
Com esta opção ativada Moodle usa o https seguro na hora do login e na página de pagamentos.';
$string['logininfo'] = 'Quando configurar sua conta no Autohorize.Net, seu login é obrigatório e você precisa inserir <strong>ambos</strong> a chave de transação <strong>ou</strong> a senha na caixa apropriada. Recomendamos que você insira a chave de transação por medida de segurança.';
$string['messageprovider:authorize_enrolment'] = 'Mensagens de inscrição Authorize.Net';
$string['methodcc'] = 'Cartão de crédito';
$string['methodccdesc'] = 'Escolha o cartão de crédito entre os modelos e clique log abaixo';
$string['methodecheck'] = 'eCheck (ACH)';
$string['methodecheckdesc'] = 'Selecione um dos métodos de pagamento e clique abaixo';
$string['missingaba'] = 'Falta o número ABA';
$string['missingaddress'] = 'Falta o endereço';
$string['missingbankname'] = 'Falta o nome do banco';
$string['missingcc'] = 'Falta o número do cartão';
$string['missingccauthcode'] = 'Falta o código de autorização';
$string['missingccexpiremonth'] = 'Faltando o mês da validade';
$string['missingccexpireyear'] = 'Faltando o ano da validade';
$string['missingcctype'] = 'Falta o tipo do cartão';
$string['missingcvv'] = 'Falta o número de controle';
$string['missingzip'] = 'Falta o código postal';
$string['mypaymentsonly'] = 'Mostrar apenas os pagamentos';
$string['nameoncard'] = 'Nome no cartão';
$string['new'] = 'Novo';
$string['nocost'] = 'Não há custo relacionado com a inscrição neste curso via Authorize.Net!';
$string['noreturns'] = 'Nenhum retorno!';
$string['notsettled'] = 'Não estabelecido';
$string['orderdetails'] = 'Detalhes do pedido';
$string['orderid'] = 'ID do pedido';
$string['paymentmanagement'] = 'Gestão de pagamentos';
$string['paymentmethod'] = 'Método de pagamento';
$string['paymentpending'] = 'O seu pagamento está pendente para o curso com o seguinte número de pedido {$a->orderid}. Veja <a href=\'{$a->url}\'>Detalhes do pedido</a>.';
$string['pendingecheckemail'] = 'Ao administrador:

Há {$a->count} echecks pendentes e você tem que carregar um arquivo CSV no server para inscrever os usuários.

Clique o link e leia o arquivo de ajuda: {$a->url}';
$string['pendingechecksubject'] = '{$a->course}: eChecks pendentes({$a->count})';
$string['pendingordersemail'] = 'Prezado administrador,

{$a->pending} transações expiram a menos que você aceite o pagamento em {$a->days} dias.

Este é um aviso enviado porque você não habilitou autocapture. Isto significa que você tem que aceitar ou recusar pagamentos manualmente.

Para aceitar ou recusar pagamentos pendentes vá a {$a->url}

Para ativar o autocapture e evitar o recebimento de avisos, vá a {$a->enrolurl}';
$string['pendingordersemailteacher'] = 'Prezado professor,

a->pending transações com valor de {$a->currency} {$a->sumcost} relativas ao curso "{$a->course}"
serão expiradas se você não confirmar a aceitação do pagamento em  {$a->days} dias.

Você tem que aceitar ou recusar o pagamento manualmente porque a captura programada não foi habilitada no sistema.

{$a->url}';
$string['pendingorderssubject'] = 'Atenção: {$a->course}, {$a->pending} pedido(s) estão por expirar em {$a->days} dia(s).';
$string['pluginname'] = 'Authorize.Net';
$string['reason11'] = 'Uma transação duplicada foi enviada.';
$string['reason13'] = 'O ID de login do comerciante não é valido ou a conta não está ativa.';
$string['reason16'] = 'A transação não foi encontrada';
$string['reason17'] = 'O negociante não aceita este tipo de cartão de crédito.';
$string['reason245'] = 'Este tipo de eCheck não é admitido quando o form de entrada do pagamento é hospedado.';
$string['reason246'] = 'Este tipo de eCheck não é admitido.';
$string['reason27'] = 'A transação resultou em confusão de AVS. O endereço fornecido não corresponde ao endereço do proprietário do cartão.';
$string['reason28'] = 'O negociante não aceita este tipo de cartão de crédito.';
$string['reason30'] = 'A configuração do processador não é válida. Chame o provedor do serviço.';
$string['reason39'] = 'O código da moeda não é válido, suportado ou permitido pelo negociante ou não tem taxa de câmbio definida.';
$string['reason43'] = 'O comerciante foi definido em modo incorreto pelo processador. Chame o provedor do serviço.';
$string['reason44'] = 'Esta transação foi recusada. Erro de filtro de código do cartão!';
$string['reason45'] = 'Esta transação foi recusada. Erro de filtro de código do cartão/AVS!';
$string['reason47'] = 'O valor pedido não pode ser superior ao valor inicial autorizado.';
$string['reason5'] = 'Um valor válido é necessário.';
$string['reason50'] = 'Esta transação está esperando o acerto e não pode ser restituída.';
$string['reason51'] = 'A soma dos créditos em relação à transação é maior que o valor da transação original.';
$string['reason54'] = 'A transação em questão não corresponde aos requisitos para emissão de crédito.';
$string['reason55'] = 'A soma dos créditos em relação à transação em questão superaria o valor inicial do débito.';
$string['reason56'] = 'Este negociante aceita apenas eCheck (ACH); não é possível pagar com cartão de crédito.';
$string['refund'] = 'Restituir';
$string['refunded'] = 'Restituído';
$string['returns'] = 'Devolve';
$string['reviewfailed'] = 'Revisão falhou';
$string['reviewnotify'] = 'O seu pagamento vai ser controlado. Você receberá um email do seu professor nos próximos dias.';
$string['sendpaymentbutton'] = 'Enviar pagamento';
$string['settled'] = 'Definido';
$string['settlementdate'] = 'Data de definição';
$string['shopper'] = 'Cliente';
$string['status'] = 'Permitir inscrições de Authorize.net';
$string['subvoidyes'] = 'A transação restituída( {$a->transid} )vai ser cancelada e o valor de {$a->amount} vai ser acreditado na sua conta. Proceder?';
$string['tested'] = 'Testado';
$string['testmode'] = '[TEST MODE]';
$string['testwarning'] = 'Captura/Anulamento/Crédito parece funcionar sem problemas em modalidade de teste mas nenhum registro foi atualizado ou inserido na base de dados.';
$string['transid'] = 'ID da transação';
$string['underreview'] = 'Em revisão';
$string['unenrolselfconfirm'] = 'Você realmente quer cancelar sua inscrição no curso "{$a}"?';
$string['unenrolstudent'] = 'Desinscrever aluno?';
$string['uploadcsv'] = 'Carregar arquivo CSV';
$string['usingccmethod'] = 'Fazer inscrição usando <a href="{$a->url}"><strong>Cartão de crédito</strong></a>';
$string['usingecheckmethod'] = 'Fazer inscrição usando <a href="{$a->url}"><strong>eCheck</strong></a>';
$string['verifyaccount'] = 'Verifique sua conta Authorize.net ';
$string['verifyaccountresult'] = '<b>Resultado da verificação:</b> {$a}';
$string['void'] = 'Nulo';
$string['voidyes'] = 'A transação vai ser cancelada. Proceder?';
$string['welcometocoursesemail'] = 'Prezado {$a->name},

Agradecemos pelo seu pagamento. Você foi inscrito no(s) seguinte(s) curso(s):

{$a->courses}

Você pode consultar os dados do pagamento ou editar os dados do seu perfil:
{$a->paymenturl}
{$a->profileurl}


';
$string['youcantdo'] = 'Você não pode fazer isto: {$a->action}';
$string['zipcode'] = 'Código postal';
