<?php

// All of the language strings in this file should also exist in
// auth.php to ensure compatibility in all versions of Moodle.

$string['auth_shib_changepasswordurl'] = 'Página de mudança de senha';
$string['auth_shib_convert_data'] = 'API de modificação dos dados';
$string['auth_shib_convert_data_description'] = 'Você pode usar este API para modificar os dados fornecidos por Shibboleth. Leia <a href=\"../auth/shibboleth/README.txt\" target=\"_blank\">README</a> para maiores detalhes.';
$string['auth_shib_convert_data_warning'] = 'Este campo não existe ou não é legível com o processo do servidor web!';
$string['auth_shib_instructions'] = 'Use o <a href=\"$a\">login Shibboleth</a> para acessar por Shibboleth quando a sua instituição suporta isto.<br />Em caso contrário, utilize o método normal indicado aqui.';
$string['auth_shib_instructions_help'] = 'Explique o uso de Shibboleth aos seus usuários. Este texto será publicado na página de login. É necessário incluir um link a um recurso protegido pelo Shibboleth que faça o endereçamento a \"<b>$a</b>\" em modo que os usuários de Shibboleth possam fazer o login no Moodle. Deixando este campo vazio, serão utilizadas as instruções padrão.';
$string['auth_shib_no_organizations_warning'] = 'Se quiser usar o serviço WAYF integrado, faça uma lista separada por vírgulas do entityIDSs do provedor de identificação, com seus nomes e opcionalmente um iniciador de sessão.';
$string['auth_shib_only'] = 'Apenas Shibboleth';
$string['auth_shib_only_description'] = 'Selecionar esta opção para utilizar uma autenticação Shibboleth';
$string['auth_shib_username_description'] = 'Nome da variável do servidor Shibboleth que deve ser usada come nome de usuário no Moodle';
$string['auth_shibboleth_contact_administrator'] = 'Caso você não esteja associado com as organizações fornecidas e precise de acesso a um curso nesse servidor, por favor, contate o';
$string['auth_shibboleth_errormsg'] = 'Por favor, selecione a organização da qual você é membro.';
$string['auth_shibboleth_login'] = 'Login Shibboleth';
$string['auth_shibboleth_login_long'] = 'Logar-se ao Moodle através de Shibboleth';
$string['auth_shibboleth_manual_login'] = 'Login manual';
$string['auth_shibboleth_select_member'] = 'Eu sou membro de...';
$string['auth_shibboleth_select_organization'] = 'Para autenticação via Shibboleth, por favor, selecione sua organização na lista abaixo:';
$string['auth_shibbolethdescription'] = 'Com este método os usuários são criados e autenticados utilizando <a href=\"http://shibboleth.internet2.edu/\" target=\"_blank\">Shibboleth</a>.<br>Leia o <a href=\"../auth/shibboleth/README.txt\" target=\"_blank\">README</a> de Shibboleth para instruções sobre a configuração do Moodle com Shibboleth';
$string['auth_shibbolethtitle'] = 'Shibboleth';
$string['shib_no_attributes_error'] = 'Você usa autenticação Shibboleth mas o Moodle não recebeu os atributos do usuário. Controle o provedor da Identidade para a comunicação dos atributos ($a)necessários, ao provedor em que Moodle está instalado ou informe o webmaster deste servidor.';
$string['shib_not_all_attributes_error'] = 'O Moodle precisa de alguns atributos Shibboleth que não foram fornecidos no seu caso. Os atributos são: $a<br /> Contate o webmaster deste servidor ou o Provedor da sua Identidade.';
$string['shib_not_set_up_error'] = 'A autenticação Shibboleth não está configurada corretamente pois as variáveis de ambiente não estão presentes nesta página. Consulte o <a href=\"README.txt\">README</a> para melhores explicações sobre a configuração da autenticação Shibboleth ou contate o webmaster.';