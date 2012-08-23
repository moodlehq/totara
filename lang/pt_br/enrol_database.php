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
 * Strings for component 'enrol_database', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol_database
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['dbencoding'] = 'Codificação do banco de dados';
$string['dbhost'] = 'Nome ou número IP do servidor';
$string['dbhost_desc'] = 'Tipo do servidor do Banco de Dados ou hostname';
$string['dbname'] = 'Nome do banco de dados';
$string['dbpass'] = 'Senha do banco de dados';
$string['dbsetupsql'] = 'Linha de comando do banco de dados.';
$string['dbsetupsql_desc'] = 'Comando SQL para configuração especial de banco de dados, geralmente usado para configurar a codificação da comunicação - por exemplo para o MySQL e PostgreSQL: <em> SET NAMES \'utf8\' </ em>';
$string['dbsybasequoting'] = 'Usar notação Sybase';
$string['dbsybasequoting_desc'] = '"Escape" de aspas simples estilo Sybase - necessário para Oracle, MS SQL e alguns outros bancos de dados. Não use para MySQL!';
$string['dbtype'] = 'Driver do banco de dados';
$string['dbtype_desc'] = 'Nome do driver de base de dados ADOdb, tipo da base de dados externa.';
$string['dbuser'] = 'Usuário do banco de dados';
$string['debugdb'] = 'Debug ADOdb';
$string['debugdb_desc'] = 'Depurar a conexão do ADOdb à base de dados externa - usar quando retornada uma página em branco durante o login. Não é adequado para ambientes de produção!';
$string['defaultcategory'] = 'Categoria padrão de cursos novos';
$string['defaultcategory_desc'] = 'Categoria padrão para cursos auto-criados. Usado quando não é especificada a categoria ou a mesma não é encontrada.';
$string['defaultrole'] = 'Papel padrão';
$string['defaultrole_desc'] = 'A função que será atribuída por padrão, se nenhuma outra for especificada na tabela externa.';
$string['ignorehiddencourses'] = 'Ignorar cursos ocultos';
$string['ignorehiddencourses_desc'] = 'Se habilitado, os usuários não  serão inscritos em cursos que estão definidos como não disponíveis para os alunos.';
$string['localcoursefield'] = 'O nome do campo na tabela do curso que nós estamos usando para comparar com entradas do banco de dados remoto (p.ex. idnumber)';
$string['localrolefield'] = 'O nome do campo na tabela de funções que nós estamos usando para comparar com entradas no banco de dados remoto. (p.ex. shortname)';
$string['localuserfield'] = 'O nome do campo na tabela de usuários que nós estamos usando para comparar com entradas do banco de dados remoto (p.ex. idnumber).';
$string['newcoursecategory'] = 'Campo de identificação de nova categoria de cursos';
$string['newcoursefullname'] = 'Campo nome completo do novo curso';
$string['newcourseidnumber'] = 'Campo de identificação do número do novo curso';
$string['newcourseshortname'] = 'Campo de nome curto do novo curso';
$string['newcoursetable'] = 'Tabela de novos cursos remotos';
$string['newcoursetable_desc'] = 'Especifique o nome da tabela que contém a lista dos cursos que devem ser criados automaticamente. Se estiver vazio, significa não criar cursos.';
$string['pluginname'] = 'Banco de Dados Externo';
$string['pluginname_desc'] = 'Você pode usar um banco de dados externo (de quase todo tipo) para controlar a sua matrícula. Presume-se que o seu banco de dados externo contém pelo menos um campo com a identificação do curso, e outro com a identificação de usuário. Estes serão comparados com os campos que você escolher do curso e as tabelas de usuário locais.';
$string['remotecoursefield'] = 'O nome do campo na tabela remota que nós estamos usando para comparar com entradas na tabela curso.';
$string['remotecoursefield_desc'] = 'O nome do campo na tabela remota que estamos usando para associar com as entradas na tabela do curso.';
$string['remoteenroltable'] = 'Tabela de inscrição de usuários remotos ';
$string['remoteenroltable_desc'] = 'Especifique o nome da tabela que contém a lista de usuários a serem inscritos. Se vazio significa que não há inscrições de usuários para sincronizar.';
$string['remoterolefield'] = 'O nome do campo na tabela remota que nós estamos usando para comparar com entradas na tabela funções.';
$string['remoterolefield_desc'] = 'O nome do campo na tabela remota que estamos usando para associar com as entradas na tabela de funções.';
$string['remoteuserfield'] = 'Campo "user" remoto';
$string['remoteuserfield_desc'] = 'O nome do campo na tabela remota que nós estamos usando para comparar com entradas na tabela usuários.';
$string['settingsheaderdb'] = 'Conexão externa do banco de dados';
$string['settingsheaderlocal'] = 'Mapeamento de campo Local';
$string['settingsheadernewcourses'] = 'Criação de novos cursos';
$string['settingsheaderremote'] = 'Sincronização de inscrição remota ';
$string['templatecourse'] = 'Novo modelo de curso';
$string['templatecourse_desc'] = 'Opcional: cursos auto-criados podem copiar as configurações de um curso modelo. Digite aqui o nome abreviado do curso modelo.';
