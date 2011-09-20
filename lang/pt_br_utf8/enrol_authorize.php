<?PHP // $Id$ 
      // enrol_authorize.php - created with Moodle 1.9.2+ (Build: 20080903) (2007101522)


$string['adminacceptccs'] = 'Que tipos de cartão de crédito são aceitos?';
$string['adminaccepts'] = 'Selecionar os métodos os tipos de pagamento autorizados';
$string['adminauthcode'] = 'Se o cartão de um usuário não puder se capturado diretamente no internet, obter código de autorização por telefone chamando o banco do usuário.';
$string['adminauthorizeccapture'] = 'Configurações de revisão de encomenda & Auto-Capture';
$string['adminauthorizeemail'] = 'Configurações de Email';
$string['adminauthorizesettings'] = 'Configurações Authorize.net';
$string['adminauthorizewide'] = 'Configurações para todo o site';
$string['adminavs'] = 'Selecione isto se você ativou Address Verification System (AVS) na sua conta authorize.net. Isto requer campos de endereço como rua, estado, país, código postal quando o usuário completa o formulário de pagamento.';
$string['adminconfighttps'] = 'Controle se o \"<a href=\"$a->url\"> loginhttps está habilitado</a>\" para usar este plugin<br />em Admin >> Variáveis >> Segurança >> Segurança HTTP.';
$string['adminconfighttpsgo'] = 'Vai à <a href=\"$a->url\">página segura</a> para configurar este plugin.';
$string['admincronsetup'] = 'O script cron de manutenção não foi executado nas últimas 24 horas.<br /> O Cron deve estar habilitado para utilizar autocapture.<br />Configure o cron em modo correto ou desmarque novamente an_review.<br />Se você desabilitar autocapture, as transações que não forem controladas em 30 dias, serão canceladas.<br />Selecionar an_review e inserir \'0\' no campo an_capture_day <br />se você quiser aceitar e recusar manualmente os pagamentos em 30 dias.';
$string['adminemailexpired'] = 'Mandar avisos aos admins por email <b>$a</b> dias passados quantos alunos status de capturas autorizadas/pendentes, antes que a transação expire.(0=disabilita envio email, padrão=2, max=5)<br />';
$string['adminemailexpiredsort'] = 'Quando o número de pedidos pendentes que estão expirando é enviado aos professores por email, qual é importante?';
$string['adminemailexpiredsortcount'] = 'O número de encomendas';
$string['adminemailexpiredsortsum'] = 'O valor total';
$string['adminemailexpiredteacher'] = 'Se você habilitou a captura manual (veja acima)e os professores podem administrar os pagamentos, eles também devem receber avisos sobre os pedidos pendentes que estão expirando. Isto manda um aviso por email para cada professor do curso.';
$string['adminemailexpsetting'] = '(0=desabilitar envio de email, padrão=2, max=5)<br />(Opções de captura manual para envio de email: cron=habilitado, an_review=selecionado, an_capture_day=0, an_emailexpired=1-5)';
$string['adminhelpcapturetitle'] = 'Dia de Auto-Capture';
$string['adminhelpreviewtitle'] = 'Revisão de Pedido';
$string['adminneworder'] = 'Prezado Admin,

Você recebeu um novo pedido pendente:

Pedido ID: $a->orderid
Transação ID: $a->transid
Usuário: $a->user
Curso: $a->course
Valôr: $a->amount

AUTO-CAPTURE ATIVADO?: $a->acstatus

Se auto-capture é ativo o cartão de crédito será capturado em $a->captureon
e o aluno será inscrito no curso, em caso contrário expira em $a->expireon e não pode ser capturado em data posterior.
Você também pode aceitar ou recusar o pagamento e inscrever o aluno imediatamente seguindo este link :
$a->url';
$string['adminnewordersubject'] = '$a->course: Novo pedido pendente($a->orderid)';
$string['adminpendingorders'] = 'Você desabilitou a auto-captura.<br />As transações totais $a->count com status AN_STATUS_AUTH serão canceladas a menos que você as selecione.<br />Para aceitar/recusar pagamentos vá ao <a href=\'$a->url\'>painel de gestão de pagamentos</a>';
$string['adminreview'] = 'Controlar a encomenda antes de completar a transação com o cartão de crédito';
$string['adminteachermanagepay'] = 'Professores podem administrar os pagamentos do curso';
$string['allpendingorders'] = 'Todos os pedidos pendentes';
$string['amount'] = 'Valor';
$string['anlogin'] = 'Authorize.net: Nome para Login';
$string['anpassword'] = 'Authorize.net: Senha';
$string['anreferer'] = 'Definir a URL de referência se você configurou isto na tua conta authorize.net. Isto incluirá uma linha \"Referer: URL\" na solicitação.';
$string['antestmode'] = 'Executar transações apenas em modalidade de teste (não serão feitas transações monetárias reais)';
$string['antrankey'] = 'Authorize.net: Chave para transação';
$string['approvedreview'] = 'Revisão autorizada';
$string['authcaptured'] = 'Autorizado/ Capturado';
$string['authcode'] = 'Código de autorização';
$string['authorize:managepayments'] = 'Gerenciar pagamentos';
$string['authorize:uploadcsv'] = 'Enviar arquivo CSV';
$string['authorizedpendingcapture'] = 'Autorizado/ Captura pendente';
$string['avsa'] = 'Endereço (rua) corresponde, mas código postal não';
$string['avsb'] = 'Endereço não foi fornecido';
$string['avse'] = 'Erro de controle do endereço';
$string['avsg'] = 'Banco emissor do cartão não é Americano';
$string['avsn'] = 'Nenhuma correspondência com endereço e código postal';
$string['avsp'] = 'Sistema de Controle de Pagamentos não é aplicável';
$string['avsr'] = 'Retry - System não disponível';
$string['avsresult'] = 'Resultado AVS:';
$string['avss'] = 'Serviço não suportado pelo emissor';
$string['avsu'] = 'Informações sobre o endereço não disponível';
$string['avsw'] = 'Código postal de 9 dígitos corresponde, mas endereço (rua) não';
$string['avsx'] = 'Endereço (rua) e código postal de 9 dígitos correspondem';
$string['avsy'] = 'Endereço (rua) e código postal de 5 dígitos correspondem';
$string['avsz'] = 'Código postal de 5 dígitos corresponde, endereço (rua)não';
$string['canbecredit'] = 'Pode ser restituído a $a->upto';
$string['cancelled'] = 'Cancelado';
$string['capture'] = 'Captura';
$string['capturedpendingsettle'] = 'Capturado/ estabelecimento pendente';
$string['capturedsettled'] = 'Capturado/ estabelecido';
$string['captureyes'] = 'O cartão de crédito vai ser capturado e o aluno vai ser inscrito no curso. Proceder?';
$string['ccexpire'] = 'Data de expiração';
$string['ccexpired'] = 'O cartão de crédito expirou';
$string['ccinvalid'] = 'Número de cartão não válido';
$string['ccno'] = 'Número do cartão de crédito';
$string['cctype'] = 'Tipo de cartão de crédito';
$string['ccvv'] = 'CV2';
$string['ccvvhelp'] = 'Olhe na parte de trás do cartão (últimos 3 dígitos)';
$string['choosemethod'] = 'Insira o código de inscrição do curso. Se você ainda não tem este código, é necessário fazer a inscrição (e pagar) para poder obtê-lo.';
$string['chooseone'] = 'Complete um ou dois dos campos abaixo';
$string['costdefaultdesc'] = '<strong>Na configuração do curso, inserir -1</strong> no campo de preço para usar este preço padrão.';
$string['cutofftime'] = 'Cut-Off Time da transação. Quando a próxima transação será selecionada para estabelecimento?';
$string['dataentered'] = 'Dados inseridos';
$string['delete'] = 'Destruir';
$string['description'] = 'O módulo Authorize.net permite a configuração do pagamento de cursos utilizando providers CC. Se o valor da inscrição for zero, o pedido de pagamento não será apresentado ao aluno. Você deve configurar um preço predefinido para todo o site e um preço determinado para cada curso. O preço do curso tem prioridade sobre o preço predefinido para o site.';
$string['echeckabacode'] = 'Número ABA do banco';
$string['echeckaccnum'] = 'Número de conta bancária';
$string['echeckacctype'] = 'Tipo de conta bancária';
$string['echeckbankname'] = 'Nome do banco';
$string['echeckbusinesschecking'] = 'Controle de business';
$string['echeckchecking'] = 'Controle';
$string['echeckfirslasttname'] = 'Proprietário da conta bancária';
$string['echecksavings'] = 'Economias';
$string['enrolname'] = 'Gateway Authorize.net do Cartão de Crédito';
$string['expired'] = 'Extinto';
$string['haveauthcode'] = 'Já tenho um código de autorização';
$string['howmuch'] = 'Quanto?';
$string['httpsrequired'] = 'Infelizmente não foi possível processar o seu pedido em razão de problemas de configuração deste site. <br /><br />
Antes de inserir o número do seu cartão de crédito verifique se na barra inferior do seu navegador foi visualizada a imagem de um cadeado amarelo (isto indica que a transação é segura e que você não corre o risco de ter os dados roubados por terceiros durante a operação).';
$string['invalidaba'] = 'Número ABA não válido';
$string['invalidaccnum'] = 'Número de conta não válido';
$string['invalidacctype'] = 'Tipo de conta não válido';
$string['logindesc'] = 'Esta opção deve estar ativa.
<br /><br />
Você pode configurar a opção <a href=\"$a->url\">loginhttps</a> na seção Variáveis/Segurança.
<br /><br />
Com esta opção ativada Moodle usa o https seguro no hora do login e na página de pagamentos.';
$string['logininfo'] = 'Nome de usuário, senha e código de transação não são visualizados como precaução de segurança. Não é necessário inserir de novo os dados se já foram configurados antes. Neste caso, ao lado dos campos é visualizado um bloco verde. Se esta é a primeira vez que você está inserindo estes dados, o nome de usuário (*) é obrigatório assim como o código da transação (#1) ou a senha (#2). Inserir o código da transação é a opção mais segura. Para cancelar a senha atual, selecione a caixa de opção correspondente.';
$string['methodcc'] = 'Cartão de crédito';
$string['methodecheck'] = 'eCheck (ACH)';
$string['missingaba'] = 'Falta o número ABA';
$string['missingaddress'] = 'Falta o endereço';
$string['missingbankname'] = 'Falta o nome do banco';
$string['missingcc'] = 'Falta o número do cartão';
$string['missingccauthcode'] = 'Falta o código de autorização';
$string['missingccexpire'] = 'Falta a data de extinção';
$string['missingcctype'] = 'Falta o tipo do cartão';
$string['missingcvv'] = 'Falta o número de controle';
$string['missingzip'] = 'Falta o código postal';
$string['mypaymentsonly'] = 'Mostrar apenas os pagamentos';
$string['nameoncard'] = 'Nome no cartão';
$string['new'] = 'Novo';
$string['noreturns'] = 'Nenhum retorno!';
$string['notsettled'] = 'Não estabelecido';
$string['orderid'] = 'ID do pedido';
$string['paymentmanagement'] = 'Gestão de pagamentos';
$string['paymentmethod'] = 'Método de pagamento';
$string['paymentpending'] = 'O seu pagamento está pendente para o curso com o seguinte número de pedido $a->orderid. Veja <a href=\'$a->url\'>Detalhes do pedido</a>.';
$string['pendingecheckemail'] = 'Ao administrador:

Há $a->count echecks pendentes e você tem que carregar um arquivo CSV no server para inscrever os usuários.

Clique o link e leia o arquivo de ajuda: $a->url';
$string['pendingechecksubject'] = '$a->course: eChecks pendentes($a->count)';
$string['pendingordersemail'] = 'Prezado administrador,

$a->pending transações expiram a menos que você aceite o pagamento em $a->days dias.

Este é um aviso enviado porque você não habilitou autocapture. Isto significa que você tem que aceitar ou recusar pagamentos manualmente.

Para aceitar ou recusar pagamentos pendentes vá a $a->url

Para ativar o autocapture e evitar o recebimento de avisos, vá a $a->enrolurl';
$string['pendingordersemailteacher'] = 'Prezado professor,

a->pending transações com valor de $a->currency $a->sumcost relativas ao curso \"$a->course\"
serão expiradas se você não confirmar a aceitação do pagamento em  $a->days dias.

Você tem que aceitar ou recusar o pagamento manualmente porque a captura programada não foi habilitada no sistema.

$a->url';
$string['pendingorderssubject'] = 'Atenção: $a->course, $a->pending pedido(s) estão por expirar em $a->days dia(s).';
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
$string['reviewday'] = 'Completar a transação do cartão de crédito automaticamente a menos que um administrador ou professor não faça o controle da encomenda em <b>$a</b> dias. O CRON DEVE ESTAR ATIVADO. .<br />( 0 dias = desativar transação automatica = prof. o admin. controlam a operação manualmente. A transação será cancelada quando a modalidade autocapture for desativada a menos que você não controle a operação em 30 dias.)';
$string['reviewfailed'] = 'Revisão falida';
$string['reviewnotify'] = 'O seu pagamento vai ser controlado. Você receberá um email do seu professor nos próximos dias.';
$string['sendpaymentbutton'] = 'Enviar Pagamento';
$string['settled'] = 'Definido';
$string['settlementdate'] = 'Data de definição';
$string['subvoidyes'] = 'A transação restituída $a->transid vai ser cancelada e o valor de $a->amount vai ser acreditado na sua conta. Proceder?';
$string['tested'] = 'Testado';
$string['testmode'] = '[TEST MODE]';
$string['testwarning'] = 'Captura/Anulamento/Crédito parece funcionar sem problemas em modalidade de teste mas nenhum registro foi atualizado ou inserido na base de dados.';
$string['transid'] = 'ID da transação';
$string['underreview'] = 'Em revisão';
$string['unenrolstudent'] = 'Desinscrever aluno?';
$string['uploadcsv'] = 'Carregar arquivo CSV';
$string['usingccmethod'] = 'Fazer inscrição usando <a href=\"$a->url\"><strong>Cartão de crédito</strong></a>';
$string['usingecheckmethod'] = 'Fazer inscrição usando <a href=\"$a->url\"><strong>eCheck</strong></a>';
$string['void'] = 'Nulo';
$string['voidyes'] = 'A transação vai ser cancelada. Proceder?';
$string['welcometocoursesemail'] = 'Prezado cursista,

O pagamento foi recebido, muito obrigado. Você foi inscrito nos seguintes cursos:

a->courses

Você pode editar os dados do seu perfil :
$a->profileurl

Você pode consultar os dados do pagamento:
$a->paymenturl';
$string['youcantdo'] = 'Você não pode fazer isto: $a->action';
$string['zipcode'] = 'Código Postal';

?>
