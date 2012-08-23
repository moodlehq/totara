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
 * Strings for component 'webservice', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   webservice
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['accessexception'] = 'Exceção de controle de acesso';
$string['accesstofunctionnotallowed'] = 'O acesso à função {$a}() não é permitido. Por favor, verifique se um serviço que contém a função estiver ativada. Nas definições de serviço: se o serviço é restrito verificar se o usuário está listado. Ainda as definições de serviço para verificar restrição de IP ou se o serviço exige uma capacidade';
$string['actwebserviceshhdr'] = 'Protocolos ativos para web services';
$string['addaservice'] = 'Adicionar serviço';
$string['addcapabilitytousers'] = 'Verificar capacidades do usuário';
$string['addcapabilitytousersdescription'] = 'Usuários devem possuir duas capacidades - webservice:createtoken e uma capacidade englobando os protocolos utilizados, por exemplo webservice/rest:use, webservice/soap:use. Para alcançar isto, crie um papel web services com as capacidades permitidas e associe ao usuário com papel web services como um papel de sistema';
$string['addfunction'] = 'Adicionar função';
$string['addfunctionhelp'] = 'Selecione a função para adicionar ao serviço';
$string['addfunctions'] = 'Adicionar funções';
$string['addfunctionsdescription'] = 'Selecionar funções necessárias para o novo serviço criado';
$string['addrequiredcapability'] = 'Associar/desassociar a capacidade requerida';
$string['addservice'] = 'Adicionar um novo serviço: {$a->name} (id: {$a->id})';
$string['addservicefunction'] = 'Adicione funções ao serviço "{$a}"';
$string['allusers'] = 'Todos usuários';
$string['amftestclient'] = 'Cliente de teste AMF';
$string['apiexplorer'] = 'Explorador da API';
$string['apiexplorernotavalaible'] = 'API explorador ainda não disponível.';
$string['arguments'] = 'Argumentos';
$string['authmethod'] = 'Método de autenticação';
$string['cannotcreatetoken'] = 'Sem permissão para criar um token de web service para o serviço {$a}.';
$string['cannotgetcoursecontents'] = 'Impossível obter conteúdos do curso';
$string['checkusercapability'] = 'Verificar capacidade do usuário';
$string['checkusercapabilitydescription'] = 'O usuário precisa ter as permissões apropriadas de acordo com os protocolos usados, por exemplo, webservice/rest:use, webservice/soap:use. Para conseguir isto, cria um papel para o web service com permissões sobre o protocolo e atribua-o  para o web service no nível do site.';
$string['configwebserviceplugins'] = 'Por questões de segurança, apenas protocolos que estão em uso devem ser habilitados';
$string['context'] = 'Contexto';
$string['createservicedescription'] = 'Um serviço é um conjunto de funções web service. Você irá permitir a usuários acessar o novo serviço. Na página <strong>Adicionar serviço</strong> marque \'Habilitar\' e \'Usuários autorizados\'. Selecione \'Não exigir permissão\'.';
$string['createserviceforusersdescription'] = 'Um serviço é um conjunto de funções web service. Você irá permitir a usuários acessar o novo serviço. Na página <strong>Adicionar serviço</strong> marque \'Habilitar\' e \'Usuários autorizados\'. Selecione \'Não exigir permissão\'.';
$string['createtoken'] = 'Criar token';
$string['createtokenforuser'] = 'Criar um token para um usuário';
$string['createtokenforuserauto'] = 'Criar um token automaticamente  para um usuário';
$string['createtokenforuserdescription'] = 'Criar um token para o usuário do web service';
$string['createuser'] = 'Crie um usuário específico';
$string['createuserdescription'] = 'Um usuário Web Services é necessário para representar o sistema controlando o Moodle';
$string['default'] = 'Padrão para "{$a}"';
$string['deleteaservice'] = 'Excluir serviço';
$string['deleteservice'] = 'Excluir o serviço: {$a->name} (id: {$a->id})';
$string['deleteserviceconfirm'] = 'Apagar um serviço irá também apagar os tokes relacionados a este serviço. Você realmente quer apagar o serviço externo "{$a}"?';
$string['deletetokenconfirm'] = 'Você realmente quer apagar este token do web service <strong>{$a->user}</strong> no serviço <strong>{$a->service}</strong>?';
$string['disabledwarning'] = 'Todos os protocolos para web service estão desabilitados. A configuração "Habilitar web services" pode ser encontrada em Características avançadas';
$string['doc'] = 'Documentação';
$string['docaccessrefused'] = 'Você não tem permissão para visualizar a documentação para este token';
$string['documentation'] = 'documentação do web service';
$string['downloadfiles'] = 'Pode baixar os arquivos';
$string['downloadfiles_help'] = 'Se habilitado, qualquer usuário pode baixar arquivos com suas chaves de segurança. Certamente eles estarão restritos aos arquivos que tem permissão para baixar no site.';
$string['editaservice'] = 'Editar serviço';
$string['editservice'] = 'Editar o serviço: {$a->name} (id: {$a->id})';
$string['enabled'] = 'Ativado';
$string['enabledirectdownload'] = 'Download de arquivos via Web Services deve ser habilitado em configurações de serviços externos.';
$string['enabledocumentation'] = 'Ativar documentação do desenvolvedor';
$string['enabledocumentationdescription'] = 'Documentação detalhada dos web services está disponível para protocolos habilitados.';
$string['enablemobilewsoverview'] = 'Vá para a página de administração {$a->manageservicelink}, verifique a configuração "{$a->enablemobileservice}" e salve. Tudo será configurado para e todos os usuários do site serão capazes de usar o aplicativo oficial do Moodle. Status atual: {$a->wsmobilestatus}';
$string['enableprotocols'] = 'Ativar protocolos';
$string['enableprotocolsdescription'] = 'Ao menos um protocolo deve estar habilitado. Por razões de segurança, apenas protocolos utilizados devem estar habilitados.';
$string['enablews'] = 'Habilitar web services';
$string['enablewsdescription'] = 'Web services devem ser habilitados em Características avançadas';
$string['entertoken'] = 'Digite uma chave de segurança / token:';
$string['error'] = 'Erro: {$a}';
$string['errorcatcontextnotvalid'] = 'Você não pode executar funções no contexto da categoria (Id da categoria: {$a->catid}). O erro de contexto foi: {$a->message}';
$string['errorcodes'] = 'Mensagem de erro';
$string['errorcoursecontextnotvalid'] = 'Você não pode executar funções no contexto do curso (Id do curso: {$a->courseid}). O erro de contexto foi: {$a->message}';
$string['errorinvalidparam'] = 'O parâmetro "{$a}" é inválido.';
$string['errornotemptydefaultparamarray'] = 'O parâmetro de descrição do web service chamado \'{$a}\' é uma estrutura singular ou múltipla. O padrão só pode ser um vetor vazio. Verifique a descrição do web service.';
$string['erroroptionalparamarray'] = 'O parâmetro de descrição do web service chamado \'{$a}\' é uma estrutura singular ou múltipla. Este não pode ser declarado com VALUE_OPTIONAL. Verifique a descrição do web service.';
$string['execute'] = 'Executar';
$string['executewarnign'] = 'Aviso: Caso pressionar executar sua base de dados será modificada e mudanças não poderão ser revertidas automaticamente! Se não tem certeza não faça.';
$string['externalservice'] = 'Serviço externo';
$string['externalservicefunctions'] = 'Funções de serviço externo';
$string['externalservices'] = 'Serviços externos';
$string['externalserviceusers'] = 'Usuários de serviço externo';
$string['failedtolog'] = 'Falhou ao logar';
$string['filenameexist'] = 'Nome de arquivo já existe: {$a}';
$string['forbiddenwsuser'] = 'Não é possível criar token para usuários não confirmados, excluídos, suspensos ou visitantes.';
$string['function'] = 'Função';
$string['functions'] = 'Funções';
$string['generalstructure'] = 'Estrutura geral';
$string['information'] = 'Informação';
$string['installexistingserviceshortnameerror'] = 'Um web service com nome curto "{$a}" já existe. Não é possível instalar/atualizar um outro web service com o mesmo nome curto.';
$string['installserviceshortnameerror'] = 'Erro de codificação: o nome curto do web service "{$a}" deve conter número, letras e _-.. somente.';
$string['invalidextparam'] = 'Parâmetro inválido api externa:{$a}';
$string['invalidextresponse'] = 'Resposta externa da api inválida : {$a}';
$string['invalidiptoken'] = 'Token inválido - seu IP não é suportado';
$string['invalidtimedtoken'] = 'Token inválido - token expirado';
$string['invalidtoken'] = 'Token inválido - token não encontrado';
$string['invalidtokensession'] = 'Sessão baseada em token inválida - sessão não encontrada ou expirada';
$string['iprestriction'] = 'Restrição de IP';
$string['iprestriction_help'] = 'O usuário terá que chamar o web service a partir dos IPs listados.';
$string['key'] = 'Chave';
$string['keyshelp'] = 'As chaves são usadas para acessar sua conta Moodle a partir de aplicações externas.';
$string['manageprotocols'] = 'Gerenciar protocolos';
$string['managetokens'] = 'Gerenciar tokens';
$string['missingcaps'] = 'Faltando capacidades';
$string['missingcaps_help'] = 'Lista das permissões obrigatória para o serviço que cada um dos usuários selecionados não tem. As permissões faltantes devem ser adicionadas aos papeis dos usuários para que estes possam usar o serviço.';
$string['missingpassword'] = 'Faltando senha';
$string['missingrequiredcapability'] = 'A permissão {$a} é obrigatória';
$string['missingusername'] = 'Faltando usuário';
$string['missingversionfile'] = 'Erro de codificação: arquivo version.php está ausente para o componente {$a}';
$string['mobilewsdisabled'] = 'Desabilitado';
$string['mobilewsenabled'] = 'Habilitado';
$string['nofunctions'] = 'Não há funções para esse serviço';
$string['norequiredcapability'] = 'Capacidade não exigida';
$string['notoken'] = 'O token está vazio';
$string['onesystemcontrolling'] = 'Permitir um sistema externo para controlar o Moodle';
$string['onesystemcontrollingdescription'] = 'Os passos seguintes ajudam você a configurar os serviços web do Moodle para permitir que um sistema externo interaja com Moodle. Isso inclui a criação de um método de autenticação do token (chave de segurança).';
$string['operation'] = 'Operação';
$string['optional'] = 'Opcional';
$string['passwordisexpired'] = 'Senha expirada.';
$string['phpparam'] = 'XML-RPC (Estrutura PHP)';
$string['phpresponse'] = 'XML-RPC (Estrutura PHP)';
$string['postrestparam'] = 'Código PHP para REST (Requisição POST)';
$string['potusers'] = 'Usuários não autorizados';
$string['potusersmatching'] = 'Não há usuários autorizados conferindo';
$string['print'] = 'Imprimir todos';
$string['protocol'] = 'Protocolo';
$string['protocolnotallowed'] = 'Você não tem permissão para utilizar o protocolo {$a} (falta capacidade: webservice/ {$a}:use)';
$string['removefunction'] = 'Remover';
$string['removefunctionconfirm'] = 'Você deseja remover a função "{$a->function}" do serviço "{$a->service}"?';
$string['requireauthentication'] = 'Este método requer autenticação com permissão xxx.';
$string['required'] = 'Obrigatório';
$string['requiredcapability'] = 'Capacidade exigida';
$string['requiredcapability_help'] = 'Se definido, somente usuários com a capability exigida poderá acessar o serviço.';
$string['requiredcaps'] = 'Capacidades exigidas';
$string['resettokenconfirm'] = 'Você realmente quer reiniciar esta chave do web service para  <strong>{$a->user}</strong> no serviço <strong>{$a->service}</strong>?';
$string['resettokenconfirmsimple'] = 'Você realmente que reiniciar esta chave? Qualquer links salvos contendo a chave antiga não funcionarão mais.';
$string['response'] = 'Resposta';
$string['restcode'] = 'REST';
$string['restexception'] = 'REST';
$string['restoredaccountresetpassword'] = 'Conta restaurada precisa reiniciar a senha antes de obter um token.';
$string['restparam'] = 'REST (parâmetros POST)';
$string['restrictedusers'] = 'Apenas usuários autorizados';
$string['restrictedusers_help'] = 'Esta configuração determina se todos os usuários com permissões para criar token para "web services" podem gerar um token para este serviço através das suas páginas de chaves de segurança ou se apenas usuários autorizados podem realizar esta ação.';
$string['securitykey'] = 'Chave de segurança (token)';
$string['securitykeys'] = 'Chaves de segurança';
$string['selectauthorisedusers'] = 'Selecione usuários autorizados';
$string['selectedcapability'] = 'Selecionado';
$string['selectedcapabilitydoesntexit'] = 'A configuração atual exige a permissão ({$a}) não existe mais. Por favor altere-a e salve as alterações.';
$string['selectservice'] = 'Selecione um serviço';
$string['selectspecificuser'] = 'Selecione um usuário específico';
$string['selectspecificuserdescription'] = 'Adicionar o usuário do web services como um usuário autorizado';
$string['service'] = 'Serviço';
$string['servicehelpexplanation'] = 'Um serviço é um conjunto de funções. Um serviço pode ser acessado por todos os usuários ou apenas usuários específicos';
$string['servicename'] = 'Nome do serviço';
$string['servicenotavailable'] = 'Web service não disponível (não existe ou talvez esteja desabilitado)';
$string['servicesbuiltin'] = 'Serviços construídos';
$string['servicescustom'] = 'Serviços personalizados';
$string['serviceusers'] = 'Usuários autorizados';
$string['serviceusersettings'] = 'Configurações de usuário';
$string['serviceusersmatching'] = 'Usuários autorizados que conferem';
$string['serviceuserssettings'] = 'Alterar configurações para os usuários autorizados';
$string['simpleauthlog'] = 'Login de autenticação simples';
$string['step'] = 'Etapa';
$string['testauserwithtestclientdescription'] = 'Simula acesso externo ao usando o cliente de teste do web service. Antes de fazer isso, faça login com o um usuário que possua a permissão moodle/webservice:createtoken e obtenha uma chave de segurança (token) via configurações de perfil. No cliente de teste, escolha e habilite o protocolo com autenticação via token.<strong>AVISO: As funções testadas SERÃO EXECUTADAS para esse usuário, portanto seja cuidadoso ao escolher o que testar!</strong>';
$string['testclient'] = 'Cliente de testes do web service';
$string['testclientdescription'] = '* O cliente de teste para web services <strong>executa</strong> a função <strong>REALMENTE</strong>. Não teste funções que você não conhece. <br/>* Todas as funções  web service existentes  não são ainda implementadas no cliente de teste. <br/>* Para verificar se um usuário não pode acessar algumas, funções, você pode testar algumas funções não permitidas.<br/>* Para ver mensagens de erro mais significativas configure o debug para <strong>{$a->mode}</strong> em {$a->atag}<br/>* Acesso a {$a->amfatag}.';
$string['testwithtestclient'] = 'Teste o serviço';
$string['testwithtestclientdescription'] = 'Simula acesso externo ao usando o cliente de teste do web service. Use um protocolo habilitado com autenticação via token.<strong>AVISO: As funções testadas SERÃO EXECUTADAS para esse usuário, portanto seja cuidadoso ao escolher o que testar!</strong>';
$string['token'] = 'Token';
$string['tokenauthlog'] = 'Autenticação com token';
$string['tokencreatedbyadmin'] = 'Só pode ser reajustado pelo administrador (*)';
$string['tokencreator'] = 'Criador';
$string['unknownoptionkey'] = 'Chave de opção desconhecida ({$a})';
$string['updateusersettings'] = 'Atualizar';
$string['userasclients'] = 'Usuários como clientes com tokens';
$string['userasclientsdescription'] = 'Os passos a seguir ajudam você a configurar o web serviced o Moodle para usuários como clientes. Estes passos também ajudam a configurar o método de autenticação recomendado, token (chaves seguras). Neste caso, o usuário gerará seu token a partir da página de chaves seguras via "Minhas configurações de perfil"';
$string['usermissingcaps'] = 'Faltando capacidades: {$a}';
$string['usernameorid'] = 'Usuário / Id de usuário';
$string['usernameorid_help'] = 'Informe um usuário ou id de usuário';
$string['usernameoridnousererror'] = 'Não foram encontrados usuários com este usuário/id de usuário';
$string['usernameoridoccurenceerror'] = 'Mais do que um usuário encontrado, por favor insira o id do usuário.';
$string['usernotallowed'] = 'O usuário não tem permissão para este serviço. Primeiro você necessita permitir este usuário na página de administração de usuários {$a}';
$string['usersettingssaved'] = 'As configurações do usuário salvas';
$string['validuntil'] = 'Válido até';
$string['validuntil_help'] = 'Se definido, o serviço será inativado após esta data para este usuário.';
$string['webservice'] = 'Serviço da Web';
$string['webservices'] = 'Web services';
$string['webservicesoverview'] = 'Resumo';
$string['webservicetokens'] = 'Tokens para web service';
$string['wrongusernamepassword'] = 'Usuário ou senha incorretos';
$string['wsaccessuserdeleted'] = 'Acesso recusado ao web service para usuário excluído: {$a}';
$string['wsaccessuserexpired'] = 'Acesso recusado ao web service para usuário';
$string['wsaccessusernologin'] = 'Acesso recusado ao web service para usuário com autenticação "nenhum login": {$a}';
$string['wsaccessusersuspended'] = 'Acesso recusado ao web service para usuário suspenso: {$a}';
$string['wsaccessuserunconfirmed'] = 'Acesso recusado ao web service para usuário não confirmado: {$a}';
$string['wsauthmissing'] = 'Plugin de autenticação web service não encontrado.';
$string['wsauthnotenabled'] = 'Plugin de autenticação web service está desativado.';
$string['wsclientdoc'] = 'Documentação do cliente de web service do Moodle';
$string['wsdocapi'] = 'Documentação da API';
$string['wsdocumentation'] = 'Web documentação de serviço';
$string['wsdocumentationdisable'] = 'Documentação do web service desativada.';
$string['wsdocumentationintro'] = 'Para criar um cliente sugerimos que você leia o {$a->doclink}';
$string['wsdocumentationlogin'] = 'ou insira seu usuário e senha do web service:';
$string['wspassword'] = 'Senha do web service';
$string['wsusername'] = 'Usuário do web service';
