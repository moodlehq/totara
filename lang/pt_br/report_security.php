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
 * Strings for component 'report_security', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   report_security
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['check_configrw_details'] = '<p>É recomendado que as permissões do arquivo config.php sejam alteradas após a instalação de forma que o arquivo não possa ser alterado pelo servidor web. Por favor, note que esta medida não aumenta a segurança do servidor significantemente, mas retarda ou limita exploits em geral.</p>';
$string['check_configrw_name'] = 'config.php gravável';
$string['check_configrw_ok'] = 'config.php não pode ser modificado por scripts PHP';
$string['check_configrw_warning'] = 'Scripts PHP podem modificar o arquivo config.php';
$string['check_cookiesecure_details'] = '<p>Se você habilitar a comunicação https é recomendado que você também habilite os cookies seguros. Você também deve adicionar um redirecionamento permanente de http para https.</p>';
$string['check_cookiesecure_error'] = 'Por favor, habilite os cookies seguros';
$string['check_cookiesecure_name'] = 'Cookies seguros';
$string['check_cookiesecure_ok'] = 'Cookies seguros habilitados.';
$string['check_defaultuserrole_details'] = '<p>Todos os usuários autenticados recebem as permissões do papel padrão. Por favor, certifique-se que nenhuma ação arriscada é permitida a este usuário.</p><p>O único papel legado suportado para esta função é <em>Usuário autenticado</em>. A ação de visualizar curso não deve estar habilitada.</p>';
$string['check_defaultuserrole_error'] = 'O papel padrão "{$a}" está definido incorretamente!';
$string['check_defaultuserrole_name'] = 'Papel padrão para todos usuários';
$string['check_defaultuserrole_notset'] = 'O papel padrão não está definido.';
$string['check_defaultuserrole_ok'] = 'A definição do papel padrão para todos usuários está OK.';
$string['check_displayerrors_details'] = '<p>Habilitar a configuração do PHP <code>display_errors</code> não é recomendável em sites em produção pois as mensagens de erro podem revelar informações sigilosas sobre seu servidor.</p>';
$string['check_displayerrors_error'] = 'A configuração do PHP para exibir os erros está habilitada. É recomendável que seja desabilitada.';
$string['check_displayerrors_name'] = 'Exibição de erros do PHP';
$string['check_displayerrors_ok'] = 'A exibição de erros do PHP está desabilitada';
$string['check_emailchangeconfirmation_details'] = '<p>É recomendado que seja exigido um passo de confirmação de email quando os usuários trocam seus emails no perfil. Se desabilitado, spammers podem tentar utilizar o servidor para enviar spam.</p><p>O campo de email também deve ser trancado para os plugins de autenticação, mas esta possibilidade não é considerada aqui.</p>';
$string['check_emailchangeconfirmation_error'] = 'Usuários podem inserir qualquer endereço de email.';
$string['check_emailchangeconfirmation_info'] = 'Usuários devem inserir endereços de email apenas dos domínios autorizados.';
$string['check_emailchangeconfirmation_name'] = 'Confirmação de alteração de email';
$string['check_emailchangeconfirmation_ok'] = 'Confirmação da alteração do endereço de email no perfil de usuário.';
$string['check_embed_details'] = '<p>A inclusão ilimitada de object é muito perigosa - qualquer usuário registrado pode lançar um ataque XSS contra outros usuários do servidor. Esta configuração deve ser desabilitada em servidores em produção.</p>';
$string['check_embed_error'] = 'Inclusão ilimitada de object está habilitada - isto é muito perigoso para a maioria dos servidores.';
$string['check_embed_name'] = 'Permitir EMBED e OBJECT';
$string['check_embed_ok'] = 'A inclusão ilimitada de object está desabilitada';
$string['check_frontpagerole_details'] = '<p>O papel padrão da página inicial é dado a todos os usuários registrados para atividades na página inicial.</p><p> É recomendado que um papel especial seja criado para este propósito e nenhum papel legado seja utilizado.</p>';
$string['check_frontpagerole_error'] = 'Encontrado papel da página inicial "{$a}" definido incorretamente!';
$string['check_frontpagerole_name'] = 'Papel da página inicial';
$string['check_frontpagerole_notset'] = 'O papel da página inicial não está definido.';
$string['check_frontpagerole_ok'] = 'A definição do papel da página inicial está OK.';
$string['check_globals_details'] = '<p>Register globals é considerado uma configuração do PHP altamente insegura.</p><p><code>register_globals=off</code> deve ser definido na configuração do PHP. Esta configuração é feita editando o seu arquivo <code>php.ini</code>, a configuração do Apache/IIS ou o arquivo <code>.htaccess</code>.</p>';
$string['check_globals_error'] = 'Register global DEVE estar desabilitado. Por favor, conserte as configurações do servidor PHP imediatamente!';
$string['check_globals_name'] = 'Register globals';
$string['check_globals_ok'] = 'Register globals está desabilitado';
$string['check_google_details'] = '<p>A configuração Aberto ao Google permite que motores de busca entrem nos cursos com visitantes. Não há razão para habilitar esta configuração caso o acesso a visitantes esteja desabilitado.</p>';
$string['check_google_error'] = 'O acesso aos motores de busca está habilitado mas o acesso de visitantes está desabilitado.';
$string['check_google_info'] = 'Os motores de busca devem entrar como visitantes.';
$string['check_google_name'] = 'Aberto ao Google';
$string['check_google_ok'] = 'O acesso pelos motores de busca está desabilitado.';
$string['check_guestrole_details'] = '<p>A função visitante é utilizada para visitantes, usuários não autenticados e acesso temporário aos cursos como visitante. Por favor, certifique-se que nenhuma ação arriscada é permitida a esta função.</p><p>A única função herdada permitida para a função de visitante é <em>Visitante</em>.</p>';
$string['check_guestrole_error'] = 'A função visitante "{$a}" está definida incorretamente';
$string['check_guestrole_name'] = 'Papel visitante';
$string['check_guestrole_notset'] = 'O papel visitante não está definida.';
$string['check_guestrole_ok'] = 'A definição do papel visitante está OK.';
$string['check_mediafilterswf_details'] = '<p>A inclusão automática de swf é muito perigosa - qualquer usuário registrado pode lançar um ataque XSS contra outros usuários do servidor. Esta configuração deve ser desabilitada em servidores em produção.</p>';
$string['check_mediafilterswf_error'] = 'O filtro de mídia Flash está habilitado - isto é muito perigoso para a maioria dos servidores.';
$string['check_mediafilterswf_name'] = 'Filtro de mídia .swf habilitado';
$string['check_mediafilterswf_ok'] = 'O filtro de mídia Flash está desabilitado.';
$string['check_noauth_details'] = '<p>O plugin <em>Nenhuma autenticação</em> não é destinado a sites em produção. Por favor, desabilite-o a menos que este seja um site de desenvolvimento ou testes.</p>';
$string['check_noauth_error'] = 'O plugin Nenhum autenticação não pode ser utilizado em sites em produção.';
$string['check_noauth_name'] = 'Nenhuma autenticação';
$string['check_noauth_ok'] = 'O plugin Nenhuma autenticação está desabilitado.';
$string['check_openprofiles_details'] = '<p>Perfis abertos de usuários podem ser abusados por spammers. É recomendado que <code>Forçar usuários a logar para perfil</code> ou <code>Forçar usuário a logar</code> estejam habilitadas.</p>';
$string['check_openprofiles_error'] = 'Qualquer um pode visualizar perfis de usuários sem autenticar-se.';
$string['check_openprofiles_name'] = 'Perfis abertos de usuários';
$string['check_openprofiles_ok'] = 'É exigido login para visualizar perfis de usuários.';
$string['check_passwordpolicy_details'] = '<p>É recomendado que uma política de senhas seja definida, uma vez que a adivinhação de senhas é geralmente a maneira mais fácil de ganhar acesso não autorizado. Apesar disso, não defina políticas muito estritas pois isso pode fazer com que os usuário não consigam memorizar suas senhas e as esqueçam ou as escrevam em algum lugar.</p>';
$string['check_passwordpolicy_error'] = 'A política de senhas não está definida.';
$string['check_passwordpolicy_name'] = 'Política de senhas';
$string['check_passwordpolicy_ok'] = 'A política de senhas está ativada.';
$string['check_passwordsaltmain_details'] = '<p>Definir um sal para as senhas reduz em muito o risco de roubo de senhas.</p><p>Para definir um sal para as senhas, adicione a seguinte linha ao seu código:</p><code>$CFG->passwordsaltmain = \'uma string aleatória com muitos caracteres\';</code><p>A string aleatória de caracteres deve ser uma mistura de letras, números e outros caracteres. Um tamanho mínimo recomendado é 40 caracteres.</p><p>Por favor, vá até <a href="{$a}" target="_blank">documentação sobre sal de senhas</a> se você deseja trocar seu sal de senhas. Uma vez definido, NÃO exclua seu sal de senha ou você não conseguirá mais autenticar-se no seu site!</p>';
$string['check_passwordsaltmain_name'] = 'Sal da senha';
$string['check_passwordsaltmain_ok'] = 'O sal da senha está OK';
$string['check_passwordsaltmain_warning'] = 'Nenhum sal foi definido para as senhas';
$string['check_passwordsaltmain_weak'] = 'O sal da senha é fraco';
$string['check_riskadmin_detailsok'] = '<p>Por favor, verifique a seguinte lista de administradores do sistema:</p> {$a}';
$string['check_riskadmin_detailswarning'] = 'Por favor, verifique a seguinte lista de administradores do sistema:</p> {$a->admins} <p>É recomendado que a função de administrador seja atribuído apenas no contexto do sistema. Os seguintes usuários tem atribuições (não suportadas) de função administrador em outros contextos:</p> {$a->unsupported}';
$string['check_riskadmin_name'] = 'Administradores';
$string['check_riskadmin_ok'] = 'Encontrados {$a} administrador(es).';
$string['check_riskadmin_unassign'] = '<a href="{$a->url}">{$a->fullname}  ({$a->email}) revisar atribuição de função</a>';
$string['check_riskadmin_warning'] = 'Encontrado {$a->admincount} administrador(es) do sistema e {$a->unsupcount} inscrições com função de administrador que não são suportadas.';
$string['check_riskbackup_detailsok'] = 'Nenhuma função permite explicitamente o backup de dados de usuários. Entretanto, note que administradores com a permissão "doanything" ainda podem ser capazes de fazer isso.';
$string['check_riskbackup_details_overriddenroles'] = '<p>Estas sobreposições ativas dão ao usuário a possibilidade de incluir dados de usuários nos backups. Por favor, certifique-se que esta permissão é necessária.</p> {$a}';
$string['check_riskbackup_details_systemroles'] = '<p>As seguintes funções do sistema atualmente permitem aos usuários incluir dados de usuários nos backups. Por favor, certifique-se que esta permissão é necessária.</p> {$a}';
$string['check_riskbackup_details_users'] = '<p>Em consequência dos papéis ou sobreposições locais acima, as seguintes contas de usuários tem permissão de fazer backups contendo dados pessoais de quaisquer usuários inscritos nos seus cursos. Certifique-se que eles são (a) confiáveis e (b) protegidos por senhas fortes:</p> {$a}';
$string['check_riskbackup_editoverride'] = '<a href="{$a->url}">{$a->name} em {$a->contextname}</a>';
$string['check_riskbackup_editrole'] = '<a href="{$a->url}">{$a->name}</a>';
$string['check_riskbackup_name'] = 'Backup de dados dos usuários';
$string['check_riskbackup_ok'] = 'Nenhuma função permite explicitamente o backup de dados de usuários';
$string['check_riskbackup_unassign'] = '<a href="{$a->url}">{$a->fullname} ({$a->email}) em {$a->contextname}</a>';
$string['check_riskbackup_warning'] = 'Encontradas {$a->rolecount} funções, {$a->overridecount} sobreposições e {$a->usercount} usuários com permissão para fazer backup de dados de usuários.';
$string['check_riskxss_details'] = '<p>RISK_XSS identifica todas as ações que apenas usuários confiáveis devem usar.</p><p>Por favor, verifique a seguinte lista de usuários e certifique-se que você confia plenamente neles neste servidor:</p><p>{$a}</p>';
$string['check_riskxss_name'] = 'Usuários confiáveis para XSS';
$string['check_riskxss_warning'] = 'RISK_XSS - encontrados {$a} usuários que precisam ser confiáveis.';
$string['check_unsecuredataroot_details'] = '<p>O diretório dataroot não deve ser acessível via web. A melhor maneira de garantir que este diretório não está acessível é utilizar um diretório fora do diretório público da web.</p> Se você mover o diretório, você deve atualizar a configuração <code>$CFG->dataroot</code> no arquivo <code>config.php</code> para ficar de acordo.';
$string['check_unsecuredataroot_error'] = 'Seu diretório dataroot <code>{$a}</code> está em um local errado está exposto à web!';
$string['check_unsecuredataroot_name'] = 'Dataroot inseguro';
$string['check_unsecuredataroot_ok'] = 'O diretório dataroot não é acessível via web.';
$string['check_unsecuredataroot_warning'] = 'Seu diretório dataroot <code>{$a}</code> está em um local errado e pode estar exposto à web.';
$string['configuration'] = 'Configuração';
$string['description'] = 'Descrição';
$string['details'] = 'Detalhes';
$string['issue'] = 'Item';
$string['pluginname'] = 'Visão geral da segurança';
$string['security:view'] = 'Visualizar relatório de segurança';
$string['status'] = 'Estado';
$string['statuscritical'] = 'Crítico';
$string['statusinfo'] = 'Informação';
$string['statusok'] = 'OK';
$string['statusserious'] = 'Sério';
$string['statuswarning'] = 'ATENÇÃO';
$string['timewarning'] = 'O processamento dos dados pode levar muito tempo, por favor, seja paciente';
