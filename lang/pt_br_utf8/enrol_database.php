<?PHP // $Id$ 
      // enrol_database.php - created with Moodle 1.9.2+ (Build: 20080903) (2007101522)


$string['autocreate'] = 'Os cursos podem ser criados automaticamente se existem inscrições em um curso que ainda não existe no Moodle';
$string['autocreation_settings'] = 'Configurações de Auto-criação';
$string['category'] = 'Categoria de cursos auto-criados';
$string['course_fullname'] = 'O nome do campo que arquiva o nome completo do curso';
$string['course_id'] = 'O nome do campo em que o ID do curso é arquivado. Os valores deste campo são usados para preeencher o campo \"enrol_db_l_coursefield\" na tabela de curso do Moodle.';
$string['course_shortname'] = 'O nome do campo que arquiva o nome breve do curso';
$string['course_table'] = 'O nome da tabela que contém os detalhes do curso (nome breve, nome completo, ID, etc.)';
$string['dbhost'] = 'Nome ou número IP do servidor';
$string['dbname'] = 'Nome do banco de dados';
$string['dbpass'] = 'Senha do servidor';
$string['dbtable'] = 'Tabela do banco de dados';
$string['dbtype'] = 'Tipo do banco de dados';
$string['dbuser'] = 'Usuário do servidor';
$string['defaultcourseroleid'] = 'A função que será designada se nenhuma for especificada.';
$string['description'] = 'Você pode utilizar uma base de dados externa (de qualquer tipo) para controlar as inscrições nos cursos. É necessário prever na base de dados externa um campo correspondente a um course ID e um campo correspondente a user ID. Estes serão confrontados com os campos que você indicar nas tabelas locais de usuários de cursos.';
$string['disableunenrol'] = 'Se for selecionado o sim, usuários inscritos por um banco de dados externo não terão suas inscrições canceladas pelo mesmo independente do conteúdo do banco de dados.';
$string['enrol_database_autocreation_settings'] = 'Criação automática de novos cursos';
$string['enrolname'] = 'Base de dados externa';
$string['general_options'] = 'Opções Gerais';
$string['host'] = 'Hostname do servidor da base de dados';
$string['ignorehiddencourse'] = 'Se for selecionado o sim, usuários não serão inscritos em cursos que que são configurados para não aceitar estudantes.';
$string['local_fields_mapping'] = 'Campos da base de dados local do Moodle';
$string['localcoursefield'] = 'O nome do campo na tabela do curso que nós estamos usando para comparar com entradas do banco de dados remoto (p.ex. idnumber)';
$string['localrolefield'] = 'O nome do campo na tabela de funções que nós estamos usando para comparar com entradas no banco de dados remoto. (p.ex. shortname)';
$string['localuserfield'] = 'O nome do campo na tabela de usuários que nós estamos usando para comparar com entradas do banco de dados remoto (p.ex. idnumber).';
$string['name'] = 'Base de dados específica a ser utilizada';
$string['pass'] = 'Senha de acesso ao servidor';
$string['remote_fields_mapping'] = 'Campos da base de dados para inscrição remota';
$string['remotecoursefield'] = 'O nome do campo na tabela remota que nós estamos usando para comparar com entradas na tabela curso.';
$string['remoterolefield'] = 'O nome do campo na tabela remota que nós estamos usando para comparar com entradas na tabela funções.';
$string['remoteuserfield'] = 'O nome do campo na tabela remota que nós estamos usando para comparar com entradas na tabela usuários.';
$string['server_settings'] = 'Configuração do servidor da base de dados externa';
$string['student_coursefield'] = 'O nome do campo da tabela de inscrição dos alunos em que se encontra o ID do curso.';
$string['student_l_userfield'] = 'O nome do campo da tabela local de usuários a ser utilizado para inserir o registro remoto dos alunos (ex. idnumber)';
$string['student_r_userfield'] = 'O nome do campo da tabela remota de inscrição dos alunos em que se encontra o ID do usuário.';
$string['student_table'] = 'O nome da tabela em que as inscrições dos alunos são arquivadas.';
$string['teacher_coursefield'] = 'O nome do campo de inscrição do professor em que se encontra o ID do curso.';
$string['teacher_l_userfield'] = 'O nome do campo na tabela de usuários local usado para inserir o registro remoto de professores (ex. idnumber)';
$string['teacher_r_userfield'] = 'O nome do campo da tabela remota de inscrição de professores em que se encontra o ID do usuário.';
$string['teacher_table'] = 'O nome da tabela em que as inscrições de professores são arquivadas.';
$string['template'] = 'Opcional: cursos auto-criados podem copiar as configurações a partir de um modelo de curso. Inserir um nome breve deste modelo de curso.';
$string['type'] = 'Tipo de servidor de base de dados';
$string['user'] = 'Nome do usuário para acessar o servidor';

?>
