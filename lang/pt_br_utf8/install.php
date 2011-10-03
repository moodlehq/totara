<?PHP // $Id$ 
      // install.php - created with Moodle 1.9.5+ (Build: 20091007) (2007101553)


$string['admindirerror'] = 'O diretório  admin indicado não é correto';
$string['admindirname'] = 'Diretório Admin';
$string['admindirsetting'] = 'Alguns provedores usam /admin como uma URL especial para o acesso ao painel de administração do site. Infelizmente isto entra em conflito com o percurso de acesso predefinido para as páginas de administração do Moodle. Você pode superar este problema mudando o nome do diretório de administração da sua instalação e inserindo este nome aqui. Por exemplo:
<br/> <br /><b>moodleadmin</b><br /> <br />Isto resolve os problemas dos links da página de administração de Moodle';
$string['admindirsettinghead'] = 'Criando o diretório admin ...';
$string['admindirsettingsub'] = 'Alguns serviços de hospedagem de sites web usam  /admin como URL especial para acessar o painel de controle. Isto cria conflitos com os diretórios das páginas de administração de Moodle. para resolver este problema é necessário mudar o nome do diretório admin da sua instalação, e indicar este nome aqui. Por exemplo: <br /> <br /><b>moodleadmin</b><br /> <br />
Isto resolve os eventuais problemas com links do painel de administração de Moodle.';
$string['caution'] = 'Atenção';
$string['chooselanguage'] = 'Escolha um idioma';
$string['chooselanguagehead'] = 'Escolha um idioma';
$string['chooselanguagesub'] = 'Escolha um idioma a ser usado durante a instalação. Após a instalação você pode definir o idioma principal do site e outros idiomas a serem utilizados pelos usuários.';
$string['compatibilitysettings'] = 'Controlando configurações do PHP ...';
$string['compatibilitysettingshead'] = 'Controlando configurações do PHP ...';
$string['compatibilitysettingssub'] = 'O seu servidor deve ser compatível com este teste para que o Moodle funcione apropriadamente';
$string['configfilenotwritten'] = 'O script do instalador não conseguiu criar o arquivo config.php com as configurações que você definiu, provavelmente o diretório não está protegido e não aceita modificações. Você pode copiar o seguinte código manualmente em um arquivo de texto com o nome config.php e carregar este arquivo no diretório principal do Moodle.';
$string['configfilewritten'] = 'config.php foi criado com sucesso';
$string['configurationcomplete'] = 'Configuração completada';
$string['configurationcompletehead'] = 'Configuração completada';
$string['configurationcompletesub'] = 'Moodle tentou salvar a sua configuração em um arquivo na área principal (root) da sua instalação do Moodle';
$string['database'] = 'Base de dados';
$string['databasecreationsettings'] = 'Agora é necessário configurar a base de dados que vai arquivar os dados do Moodle. Esta base de dados vai ser criada automaticamente pelo instalador Moodle4Windows com as opções definidas abaixo.<br />
<br /> <br />
<b>Tipo:</b> definido como \"mysql\" pelo instalador<br />
<b>Host:</b> definido como \"localhost\" pelo instalador<br />
<b>Nome:</b> nome da base de dados, ex. moodle<br />
<b>Usuário:</b> definido como \"root\" pelo instalador<br />
<b>Senha:</b> a senha da sua base de dados<br />
<b>Prefixo das tabelas:</b> prefixo opcional a ser usado no nome de todas as tabelas';
$string['databasecreationsettingshead'] = 'Agora você precisa configurar a base de dados que será criada automaticamente pelo instalador com os valores especificados abaixo.';
$string['databasecreationsettingssub'] = '<b>Tipo:</b> definido como \"mysql\" pelo instalador<br />
<b>Host:</b> definido como \"localhost\" pelo instalador<br />
<b>Nome:</b> nome da base de dados, por exemplo moodle<br />
<b>Usuário:</b> definido como \"root\" pelo instalador<br />
<b>Senha:</b> a senha de acesso à base de dados<br />
<b>Prefixo das Tabelas:</b> prefixo opcional usaado no nome das tabelas';
$string['databasesettings'] = 'Agora você precisa configurar a base de dados em que os dados de Moodle serão conservados. Esta base de dados deve ter sido criada anteriormente bem como o nome de usuário e a senha necessários ao acesso..<br />
<br /> <br />
<b>Tipo:</b> mysql ou postgres7<br />
<b>Host:</b> ex. localhost ou db.isp.com<br />
<b>Nome:</b> nome da base de dados, ex. moodle<br />
<b>Usuário:</b> nome do usuário da sua base de dados<br />
<b>Senha:</b> a senha da sua base de dados<br />
<b>Prefixo das tabelas:</b> prefixo opcional a ser utilizado no nome das tabelas';
$string['databasesettingshead'] = 'Agora você precisa configurar a base de dados. Esta base de dados deve ter sido criada e configurada com uma senha e um nome de usuário.';
$string['databasesettingssub'] = '<b>Tipo:</b> mysql ou postgres7<br />
<b>Host:</b> ex. localhost ou db.isp.com<br />
<b>Nome:</b> nome da base de dados, ex. moodle<br />
<b>Usuário:</b> nome de usuário da base de dados<br />
<b>Senha:</b> senha da base de dados<br />
<b>Prefixo das tabelas:</b> prefixo opcional a ser utilizado no nome das tabelas';
$string['databasesettingssub_mssql'] = '<b>Tipo:</b> Servidor SQL (não UTF-8) <b><font color=\"red\">Experimental! (não deve ser usado em produção)</font></b><br />
<b>Host:</b> ex. localhost ou db.isp.com<br />
<b>Nome:</b> nome da base de dados, ex. moodle<br />
<b>Usuário:</b> nome de usuário da base de dados<br />
<b>Senha:</b> senha da base de dados<br />
<b>Prefixo das tabelas:</b> prefixo a ser utilizado no nome das tabelas (obrigatório)';
$string['databasesettingssub_mssql_n'] = '<b>Tipo:</b> Servidor SQL (UTF-8 habilitado)<br />
<b>Host:</b> ex. localhost ou db.isp.com<br />
<b>Nome:</b> nome da base de dados, ex. moodle<br />
<b>Usuário:</b> nome de usuário da base de dados<br />
<b>Senha:</b> senha da base de dados<br />
<b>Prefixo das tabelas:</b> prefixo a ser utilizado no nome das tabelas (obrigatório)';
$string['databasesettingssub_mysql'] = '<b>Tipo:</b> MySQL <br />
<b>Host:</b> ex. localhost ou db.isp.com<br />
<b>Nome:</b> nome da base de dados, ex. moodle<br />
<b>Usuário:</b> nome de usuário da base de dados<br />
<b>Senha:</b> senha da base de dados<br />
<b>Prefixo das tabelas:</b> prefixo a ser utilizado no nome das tabelas (opcional)';
$string['databasesettingssub_mysqli'] = '<b>Tipo:</b> MySQL aperfeiçoado <br />
<b>Host:</b> ex. localhost ou db.isp.com<br />
<b>Nome:</b> nome da base de dados, ex. moodle<br />
<b>Usuário:</b> nome de usuário da base de dados<br />
<b>Senha:</b> senha da base de dados<br />
<b>Prefixo das tabelas:</b> prefixo a ser utilizado no nome das tabelas (opcional)';
$string['databasesettingssub_oci8po'] = '<b>Tipo:</b> Oracle<br />
<b>Host:</b> não é utilizado, deve ser deixado em branco<br />
<b>Nome:</b> nome da conexão tnsnames.ora<br />
<b>Usuário:</b> nome de usuário da base de dados<br />
<b>Senha:</b> senha da base de dados<br />
<b>Prefixo das tabelas:</b> prefixo a ser utilizado no nome das tabelas (opcional)';
$string['databasesettingssub_odbc_mssql'] = '<b>Tipo:</b> Servidor SQL (em ODBC) <b><font color=\"red\">Experimental! (não use em produção)</font></b><br/>
<b>Host:</b> nome do DSN no painel de controle do ODBC<br/>
<b>Nome:</b> nome da base de dados, ex. moodle<br />
<b>Usuário:</b> nome de usuário da base de dados<br />
<b>Senha:</b> senha da base de dados<br />
<b>Prefixo das tabelas:</b> prefixo a ser utilizado no nome das tabelas (obrigatório)';
$string['databasesettingssub_postgres7'] = '<b>Tipo:</b> PostgreSQL <br />
<b>Host:</b> ex. localhost ou db.isp.com<br />
<b>Nome:</b> nome da base de dados, ex. moodle<br />
<b>Usuário:</b> nome de usuário da base de dados<br />
<b>Senha:</b> senha da base de dados<br />
<b>Prefixo das tabelas:</b> prefixo a ser utilizado no nome das tabelas (obrigatório)';
$string['databasesettingswillbecreated'] = '<b>Nota:</b> O instalador tentará criar o banco de dados automaticamente se não existir.';
$string['dataroot'] = 'Diretório Data';
$string['datarooterror'] = 'O \'Diretório Data\' indicado não foi encontrado e não foi possível criar um novo diretório. Corrija a indicação do percurso ou crie o diretório manualmente.';
$string['datarootpublicerror'] = 'O diretório de dados que você indicou é acessível no web, è melhor escolher um outro diretório.';
$string['dbconnectionerror'] = 'Não foi possível fazer a conexão com a base de dados indicada. Controle as configurações da base de dados.';
$string['dbcreationerror'] = 'Erro de ciação de base de dados. Não foi possível criar o nome da base de dados indicado com os parâmetros fornecidos.';
$string['dbhost'] = 'Servidor hospedeiro';
$string['dbpass'] = 'Senha';
$string['dbprefix'] = 'Prefixo das tabelas';
$string['dbtype'] = 'Tipo';
$string['dbwrongencoding'] = 'A base de dados selecionada usa uma codificação que não é recomendável($a). É melhor usar uma codificação Unicode (UTF-8). Você pode saltar este teste clicando \"Saltar teste de codificação da base de dados\", mas é possível que se apresentem problemas no futuro.';
$string['dbwronghostserver'] = 'Você deve seguir regras de host como explicado acima.';
$string['dbwrongnlslang'] = 'A variável de ambiente NLS_LANG em seu servidor web deve usar o conjunto de caracteres AL32UTF8. Veja a documentação do PHP sobre como configurar OCI8.';
$string['dbwrongprefix'] = 'Você deve seguir regras de prefixos de tabela como explicado acima.';
$string['directorysettings'] = '<p>Por favor confirme os endereços desta instalação.</p>

<p><b>Endereço Web:</b>
Indique o endereço web completo para o acesso a Moodle. Se o seu site pode ser acessado por URLs múltiplas, escolha o endereço que pode ser mais intuitivo para os seus estudantes. Não adicione uma barra (slash) ao final do endereço.</p>

<p><b>Diretório de Moodle:</b>
Indique o endereço completo do diretório de instalação, prestando muita atenção quanto ao uso de maiúsculas e minúsculas.</p>

<p><b>Diretório Data:</b>
Indique um diretório para o arquivamento de documentos carregados no servidor. Este diretório deve ter as autorizações de acesso configuradas para que o Usuário do Servidor (ex. \'nobody\' ou \'apache\') possa acessar e criar novos arquivos. Atenção, este diretório não deve ter o acesso via web autorizado.</p>';
$string['directorysettingshead'] = 'Confirme os percursos de acesso desta instalação de Moodle';
$string['directorysettingssub'] = '<b>Endereço Web:</b>
Especifique o endereço web completo em que Moodle pode ser acessado. Se o acesso é múltiplo, escolha o endereço mais fácil para os alunos. Não inclua uma barra final no endereço.
br />
<br />
<b>Diretório Moodle:</b>
Especifique o percurso completo de acesso ao diretório de instalação. Atenção ao uso de maiúsculas e minúsculas.
<br />
<br />
<b>Diretório de dados:</b>
Especifique um diretório para que o Moodle possa salvar arquivos carregados no servidor. Este diretório deve ter permissões de leitura e escrita pelo usuário do servidor web (normalmente \'nobody\' ou \'apache\'), mas não deve ter acesso livre via web.';
$string['dirroot'] = 'Diretório Moodle';
$string['dirrooterror'] = 'A configuração do percurso de acesso ao Diretório Moodle parece errada - não foi possível encontrar uma instalação de Moodle neste endereço. O valor abaixo foi reconfigurado.';
$string['download'] = 'Download';
$string['downloadlanguagebutton'] = 'Baixar o Pacote de Idioma \"$a\"';
$string['downloadlanguagehead'] = 'Baixar Pacote de Idioma';
$string['downloadlanguagenotneeded'] = 'Você pode continuar a instalação usando o idioma padrão \"$a\".';
$string['downloadlanguagesub'] = 'Você pode indicar um idioma a ser instalado para que o processo continue com o uso deste idioma.<br /><br /> Se não for possível baixar o pacote do idioma, a instalação vai continuar em Inglês. (Depois da instalação é possível acrescentar outros pacotes de idioma)';
$string['environmenthead'] = 'Verificando o ambiente ...';
$string['environmentsub'] = 'Verificando se componentes do seu sistema são compatíveis com os requisitos de sistema';
$string['fail'] = 'Erro';
$string['fileuploads'] = 'Carregamento de arquivos';
$string['fileuploadserror'] = 'Isto deve estar ativado';
$string['fileuploadshelp'] = '<p>Parece que o envio de documentos a este servidor não está habilitado.</p>
<p>Moodle pode ser instalado, mas não será possível carregar arquivos ou imagens nos cursos.</p>
<p>para habilitar o envio de arquivos é necessário editar o arquivo php.ini do sistema e mudar a configuração de  
<b>file_uploads</b> para \'1\'.</p>';
$string['gdversion'] = 'Versão do gd';
$string['gdversionerror'] = 'A library GD';
$string['gdversionhelp'] = '<p>Parece que o seu servidor não tem o GD instalado.</p>
<p>GD é uma biblioteca de PHP necessária à elaboração de imagens como as fotos do perfil do usuário e os gráficos de estatísticas. O Moodle funciona sem o GD mas a elaboração de imagens não será possível.</p>
<p>Para adicionar o GD ao PHP em Unix, compile o PHP usando o parâmetro --with-gd .</p>
<p>Em Windows edite php.ini and cancele o comentário à linha que se refere a php_gd2.dll.</p>';
$string['globalsquotes'] = 'Tratamento de Globais sem Segurança';
$string['globalsquoteserror'] = 'Corrija a configuração do seu PHP: desabilitar register_globals e/ou habilitar magic_quotes_gpc';
$string['globalsquoteshelp'] = '<p>Não é aconselhável habilitar Register Globals e desabilitar Magic Quotes GPC ao mesmo tempo.</p>

<p>A configuração aconselhada é
<b>magic_quotes_gpc = On</b> e
<b>register_globals = Off</b> no seu php.ini</p>

<p>Se você não tem acesso ao seu php.ini, adicione a seguinte linha de código no arquivo .htaccess do diretório principal do seu Moodle:
<blockquote>php_value magic_quotes_gpc On</blockquote>
<blockquote>php_value register_globals Off</blockquote>
</p>';
$string['installation'] = 'Instalação';
$string['langdownloaderror'] = 'Infelizmente o idioma \"$a\" não foi instalado. A instalação vai continuar em Inglês.';
$string['langdownloadok'] = 'Idioma \"$a\" instalado com sucesso. O processo de instalação vai continuar neste idioma.';
$string['magicquotesruntime'] = 'Magic Quotes Run Time';
$string['magicquotesruntimeerror'] = 'Isto deveria estar desativado';
$string['magicquotesruntimehelp'] = '<p> A runtime Magic Quotes  deve ser desativada para que Moodle funcione corretamente.</p>

<p>Normalmente esta runtime já é desativada... controle o parâmetro <b>magic_quotes_runtime</b> no seu arquivo php.ini .</p>

<p>Se você não tem acesso ao arquivo php.ini , adicione a seguinte linha no código de um arquivo chamado .htaccess no diretório Moodle:
<blockquote>php_value magic_quotes_runtime Off</blockquote>
</p>';
$string['memorylimit'] = 'Limite de Memória';
$string['memorylimiterror'] = 'A configuração do limite da memória do PHP está muito baixa ... isto pode causar problemas no futuro.';
$string['memorylimithelp'] = '<p>O limite de memória do PHP configurado atualmente no seu servidor é de $a.</p>

<p>Este limite pode causar problemas no futuro, especialmente quando muitos módulos estiverem ativados ou em caso de um número elevado de usuários.</p>

<p>É aconselhável a configuração do limite de memória com o valor mais alto possível, como 40M. Você pode tentar um dos seguintes caminhos:</p>
<ol>
<li>Se você puder, recompile o PHP com <i>--enable-memory-limit</i>.
Com esta operação Moodle será capaz de configurar o limite de memória sózinho.</li>
<li>Se você tiver acesso ao arquivo php.ini, você pode mudar o parâmetro <b>memory_limit</b> para um valor próximo a 40M. Se você não tiver acesso direto, peça ao administrador do sistema para fazer esta operação.</li>
<li>Em alguns servidores é possível fazer esta mudança criando um arquivo .htaccess no diretório Moodle. O arquivo deve conter a seguinte expressão:
<p><blockquote>php_value memory_limit 40M</blockquote></p>
<p>Alguns servidores não aceitam este procedimento e <b>todas</b> as páginas PHP do servidor ficam bloqueadas ou imprimem mensagens de erro. Neste caso será necessário excluir o arquivo .htaccess .</p>
</li></ol>';
$string['mssql'] = 'Servidor SQL (mssql)';
$string['mssql_n'] = 'Servidor SQL com suporte a UTF-8 (mssql_n)';
$string['mssqlextensionisnotpresentinphp'] = 'O PHP não foi configurado corretamente com a extensão MSSQL para que possa se comunicar com o servidor SQL. Por favor, verifique o seu arquivo php.ini ou faça a recompilação do PHP.';
$string['mysql'] = 'MySQL (mysql)';
$string['mysqlextensionisnotpresentinphp'] = 'O PHP não foi configurado corretamente com a extensão MySQL para que possa se comunicar com MySQL. Por favor, verifique o seu arquivo php.ini ou faça a recompilação do PHP.';
$string['mysqli'] = 'MySQL aperfeiçoado (mysqli)';
$string['mysqliextensionisnotpresentinphp'] = 'O PHP não foi configurado corretamente com a extensão MySQLi para que possa se comunicar com MySQL. Por favor, verifique o seu arquivo php.ini ou faça a recompilação do PHP. A extensão MySQL não está disponível para PHP 4.';
$string['oci8po'] = 'Oracle (oci8po)';
$string['ociextensionisnotpresentinphp'] = 'O PHP não foi configurado corretamente com a extensão OCI8 para que possa se comunicar com Oracle. Por favor, verifique o seu arquivo php.ini ou faça a recompilação do PHP.';
$string['odbc_mssql'] = 'Servidor SQL em ODBC (odbc_mssql)';
$string['odbcextensionisnotpresentinphp'] = 'O PHP não foi configurado corretamente com a extensão ODBC para que possa se comunicar com o servidor SQL. Por favor, verifique o seu arquivo php.ini ou faça a recompilação do PHP.';
$string['pass'] = 'OK';
$string['pgsqlextensionisnotpresentinphp'] = 'O PHP não foi configurado corretamente com a extensão PGSQL para que possa se comunicar com PstgreSQL. Por favor, verifique o seu arquivo php.ini ou faça a recompilação do PHP.';
$string['phpversion'] = 'Versão do PHP';
$string['phpversionerror'] = 'A versão do PHP não deve ser inferior a 4.1.0';
$string['phpversionhelp'] = '<p>Moodle requer a versão 4.1.0 de PHP ou posterior.</p>
<p>A sua versão é $a</p>
<p>Atualize a versão do PHP!</p>';
$string['postgres7'] = '<p>Moodle requer a versão 4.1.0 de PHP ou posterior.</p> <p>A sua versão é $a</p> <p>Atualize a versão do PHP!</p> PostgreSQL (postgres7)';
$string['postgresqlwarning'] = '<strong>Nota:</strong> Em caso de problemas de conexão, tente configurar o campo Host Server assim: 
Servidor hospedeiro=\'postgresql_host\' porta=\'5432\' nome do db=\'postgresql_database_name\' usuário=\'postgresql_user\' senha=\'postgresql_user_password\'
e deixe vazios os campos Database, Usuário e Senha. Leia também <a href=\"http://docs.moodle.org/en/Installing_Postgres_for_PHP\">Moodle Docs</a>';
$string['safemode'] = 'Modalidade segura';
$string['safemodeerror'] = 'Moodle pode ter problemas se a modalidade segura estiver ativa';
$string['safemodehelp'] = '<p>Moodle pode ter alguns problemas quando o safe mode está ativado. Provavelmente não será possível criar novos arquivos.</p>
<p>O safe mode normalmente é ativado apenas por serviços de web hosting públicos paranóicos por segurança, é possível que você tenha que escolher um outro serviço de webhosting para o seu site.</p>
<p>Você pode continuar a instalação mas provavelmente outros problemas surgirão.</p>';
$string['sessionautostart'] = 'Início da sessão automático';
$string['sessionautostarterror'] = 'Isto deve estar ativado';
$string['sessionautostarthelp'] = '<p>Moodle requer o suporte a sessões e não funciona sem isto.</p>
<p>As sessões podem se habilitadas no arquivo php.ini ... controle o parâmetro session.auto_start .</p>';
$string['skipdbencodingtest'] = 'Saltar Teste de Codificação da Base de Dados';
$string['welcomep10'] = '$a->installername ($a->installerversion)';
$string['welcomep20'] = 'Se você chegou nesta página, o pacote <strong>$a->packname $a->packversion</strong> foi instalado. Parabéns!';
$string['welcomep30'] = 'Esta versão do <strong>$a->installername</strong> inclui as aplicações para a criação de um ambiente em que <strong>Moodle</strong> possa operar:';
$string['welcomep40'] = 'O pacote inclui também o <strong>Moodle $a->moodlerelease ($a->moodleversion)</strong>.';
$string['welcomep50'] = 'O uso das aplicações incluídas neste pacote é regulamentado pelas respectivas licenças. O instalador completo <strong>$a->installername</strong> é <a href=\"http://www.opensource.org/docs/definition_plain.html\">open source</a> e é distribuído com uma licença <a href=\"http://www.gnu.org/copyleft/gpl.html\">GPL</a>.';
$string['welcomep60'] = 'As seguinte páginas guiam passo a passo a configuração de <strong>Moodle</strong> no seu computador. Você pode usar a configuração padrão ou alterá-las de acordo com as suas necessidades.';
$string['welcomep70'] = 'Clicar o botão \"Próxima\" abaixo para continuar a configuração de <strong>Moodle</strong>.';
$string['wwwroot'] = 'Endereço web';
$string['wwwrooterror'] = 'Este endereço web não está correto - a instalação do Moodle não foi encontrada.';

?>
