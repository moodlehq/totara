<?PHP // $Id: enrol_imsenterprise.php,v 1.7 2010/03/18 20:40:56 danielneis Exp $ 
      // enrol_imsenterprise.php - created with Moodle 1.9.2+ (Build: 20080903) (2007101522)


$string['aftersaving...'] = 'Depois de salvar as suas opções, é possível que você queira';
$string['allowunenrol'] = 'Permitir que o IMS data <strong>cancele a inscrição</strong> de alunos e professores';
$string['basicsettings'] = 'Configuração básica';
$string['coursesettings'] = 'Opções de dados do curso';
$string['createnewcategories'] = 'Criar novas categorias de cursos (ocultas) se não forem encontradas no Moodle';
$string['createnewcourses'] = 'Criar novos cursos (ocultos) se não forem encontrados no Moodle';
$string['createnewusers'] = 'Criar novas contas de usuários se ainda não forem registrados no Moodle';
$string['cronfrequency'] = 'Freqüência de processamento';
$string['deleteusers'] = 'Cancelar contas de usuários quando especificado em IMS data';
$string['description'] = 'Este método controla repetidamente e processa textos com formatação especial no endereço que você indicar. O arquivo deve seguir as <a href=\'../help.php?module=enrol/imsenterprise&file=formatoverview.html\' target=\'_blank\'>IMS Enterprise specifications</a> e conter elemento XML relativos às pessoas, grupos e associações.';
$string['doitnow'] = 'fazer importação IMS Enterprise imediatamente';
$string['enrolname'] = 'Arquivo IMS Enterprise';
$string['filelockedmail'] = 'O arquivo de texto que você está usando para inscrições baseadas em IMS ($a) não pode ser excluído pelo processo cron. Isto significa que as autorizações do arquivo estão configuradas em modo errado. Por favor, corrija as permissões para que o Moodle possa excluir arquivo. Assim você evita que o arquivo seja processado repetidamente.';
$string['filelockedmailsubject'] = 'Erro importante no arquivo de inscrição';
$string['fixcasepersonalnames'] = 'Mudar primeira letra de nomes pessoais para maiúsculas';
$string['fixcaseusernames'] = 'Mudar nomes de usuários para minúsculas';
$string['imsrolesdescription'] = 'A especificação IMS Enterprise include 8 tipos de funções/papéis. Escolha o modo em que são designadas em Moodle, inclusive a possibilidade que alguma destas funções seja ignorada.';
$string['location'] = 'Endereço do arquivo';
$string['logtolocation'] = 'Endereço do arquivo log output (deixar em branco se não há arquivo de log)';
$string['mailadmins'] = 'Notificar administradores por email';
$string['mailusers'] = 'Notificar usuários por email';
$string['miscsettings'] = 'Miscelânea';
$string['processphoto'] = 'Acrescentar imagem do usuário ao perfil';
$string['processphotowarning'] = 'Aviso: O processamento de imagens pode causar empenho exagerado do servidor. Não ative esta opção quando processar um número muito grande de usuários.';
$string['restricttarget'] = 'Processar os dados apenas se o seguinte objetivo for especificado';
$string['sourcedidfallback'] = 'Use \"sourcedid\" para o id pessoal de um usuário se o campo \"userid\" não for encontrado';
$string['truncatecoursecodes'] = 'Reduzir códigos de curso para este tamanho';
$string['usecapitafix'] = 'Selecione este box se usar \"Capita\" (o formato XML deles é um pouco defeituoso)';
$string['usersettings'] = 'Opções de dados de usuários';
$string['zeroisnotruncation'] = '0 (zero) indica ausência de redução';

?>
