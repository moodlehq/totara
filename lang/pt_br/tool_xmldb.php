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
 * Strings for component 'tool_xmldb', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   tool_xmldb
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['actual'] = 'Real';
$string['aftertable'] = 'Depois da tabela:';
$string['back'] = 'Voltar';
$string['backtomainview'] = 'Voltar para principal';
$string['binaryincorrectlength'] = 'Tamanho incorreto para campo "binário"';
$string['cannotuseidfield'] = 'Não é possível inserir o campo "id". É uma  coluna auto-numérica';
$string['change'] = 'Mudar';
$string['charincorrectlength'] = 'Tamanho incorreto para campo "char"';
$string['checkbigints'] = 'Verificar bigints';
$string['check_bigints'] = 'Procurar "inteiros" incorretos no BD';
$string['checkdefaults'] = 'Verificar padrões';
$string['check_defaults'] = 'Procurar valores padrão inconsistentes';
$string['checkforeignkeys'] = 'Verificar chaves estrangeiras';
$string['check_foreign_keys'] = 'Verificar violações de chaves estrangeiras';
$string['checkindexes'] = 'Verificar índices';
$string['check_indexes'] = 'Procurar índices ausentes no BD';
$string['checkoraclesemantics'] = 'Verificação semântica';
$string['check_oracle_semantics'] = 'Procurar semânticas de comprimento incorretas';
$string['completelogbelow'] = '(veja abaixo o log completo da pesquisa)';
$string['confirmcheckbigints'] = 'Essa funcionalidade irá procurar <a href="http://tracker.moodle.org/browse/MDL-11038"> possíveis campos integrais errados</a>no servidor do seu Moodle, gerando (mas não executando) automaticamente as instruções SQL necessárias para ter todos os integrais propriamente definidos no seu BD.<br /><br />
Uma vez geradas você pode copiar tais instruções e executá-las com sua interface SQL favorita (não esqueça de fazer uma cópia de segurança dos seus dados antes de fazer isso).<br /><br />
É altamente recomendável a versão mais recente (+ versão) disponível do Moodle (1.8, 1.9, 2.x ...) antes de executar a busca por integrais errados.<br /><br />
Essa funcionalidade pode ser executada com segurança a qualquer momento e acessa o BD apenas em leitura.';
$string['confirmcheckdefaults'] = 'Essa funcionalidade procura valores padrão inconsistentes no seu Moodle, gerando (mas não executando!) automaticamente as instruções SQL para manter tudo atualizado.<br /><br />
Uma vez geradas você pode copiar tais instruções e executá-las com sua interface SQL favorita (não esqueça de fazer uma cópia de segurança dos seus dados antes de fazer isso).<br /><br />
É altamente recomendável a versão mais recente (+ versão) do Moodle (1.8, 1.9, 2.x ...) antes de executar a busca por integrais errados.<br /><br />
Essa funcionalidade pode ser executada com segurança a qualquer momento e acessa o BD apenas em leitura.';
$string['confirmcheckforeignkeys'] = 'Esta funcionalidade irá procurar por possíveis violações das chaves estrangeiras nas definições contidas em install.xml. ( o Moodle não geram restrições de chave estrangeira no banco de dados, razão pela qual os dados inválidos podem estar presentes.)<br /> <br />
É altamente recomendado a execução da versão mais recente (+ version) disponível no Moodle à partir de seu lançamento (1.8, 1.9, 2.x ...) antes de executar a busca de índices ausentes. <br /> <br />
Esta funcionalidade não execute qualquer ação contra o DB (somente efetua sua leitura), isso pode ser executado de forma segura a qualquer momento.';
$string['confirmcheckindexes'] = 'Essa funcionalidade procura possíveis índices que estejam faltando no seu Moodle, gerando (mas não executando!) automaticamente as instruções SQL para manter tudo atualizado.<br /><br />
Uma vez geradas você pode copiar tais instruções e executá-las com sua interface SQL favorita (não esqueça de fazer uma cópia de segurança dos seus dados antes de fazer isso).<br /><br />
É altamente recomendável a versão mais recente (+ versão) do Moodle (1.8, 1.9, 2.x ...) antes de executar a busca por índices ausentes.<br /><br />
Essa funcionalidade pode ser executada com segurança a qualquer momento e acessa o BD apenas em leitura.';
$string['confirmcheckoraclesemantics'] = 'Esta funcionalidade irá procurar por <a href="http://tracker.moodle.org/browse/MDL-29322">colunas VARCHAR2 no Oracle usando semântica BYTE</a> em seu servidor Moodle, gerando (mas não executar!) automaticamente as instruções necessárias SQL para que todas as colunas convertidos para usar semântica CHAR vez (melhor para cross-db compatibilidade e conteúdo aumento máximo . comprimento). <br /><br /> Uma vez gerado, você pode copiar tais declarações e executá-los de forma segura com sua interface SQL favorita (não se esqueça de fazer backup de seus dados antes de fazer isso). <br /><br /> É altamente recomendado para ser executado o mais recente (versão +) disponível de sua liberação Moodle (2,2, 2,3, 2.x ...) antes de executar a busca da semântica BYTE. <br /><br /> Esta funcionalidade não executar qualquer ação contra o banco de dados (apenas lê-la), então pode ser executado com segurança a qualquer momento.';
$string['confirmdeletefield'] = 'Você está certo de que quer excluir o campo:';
$string['confirmdeleteindex'] = 'Você está certo de que quer excluir o índice:';
$string['confirmdeletekey'] = 'Você está certo de que quer excluir a chave:';
$string['confirmdeletetable'] = 'Você está certo de que quer excluir a tabela:';
$string['confirmdeletexmlfile'] = 'Você está certo de que quer excluir o arquivo:';
$string['confirmrevertchanges'] = 'Você está absolutamente certo de que quer desfazer as mudanças feitas em:';
$string['create'] = 'Criar';
$string['createtable'] = 'Criar tabela:';
$string['defaultincorrect'] = 'Padrão incorreto';
$string['delete'] = 'Excluir';
$string['delete_field'] = 'Excluir campo';
$string['delete_index'] = 'Excluir índice';
$string['delete_key'] = 'Excluir chave';
$string['delete_table'] = 'Excluir tabela';
$string['delete_xml_file'] = 'Excluir arquivo XML';
$string['doc'] = 'Doc';
$string['docindex'] = 'Índice da documentação:';
$string['documentationintro'] = 'Esta documentação é gerada automaticamente a partir das definições de base de dados do  XMLDB. Ela está disponível somente em Inglês.';
$string['down'] = 'Abaixo';
$string['duplicate'] = 'Duplicar';
$string['duplicatefieldname'] = 'Existe outro campo com esse nome';
$string['duplicatefieldsused'] = 'Duplicar campos usados';
$string['duplicatekeyname'] = 'Existe outra chave com este nome';
$string['duplicatetablename'] = 'Existe outra table com este nome';
$string['edit'] = 'Editar';
$string['edit_field'] = 'Editar campo';
$string['edit_field_save'] = 'Salvar campo';
$string['edit_index'] = 'Editar índice';
$string['edit_index_save'] = 'Salvar índice';
$string['edit_key'] = 'Editar chave';
$string['edit_key_save'] = 'Salvar chave';
$string['edit_table'] = 'Editar tabela';
$string['edit_table_save'] = 'Salvar tabela';
$string['edit_xml_file'] = 'Editar arquivo XML';
$string['enumvaluesincorrect'] = 'Valores incorretos para o campo "enum"';
$string['expected'] = 'Esperado';
$string['extensionrequired'] = 'Desculpe - a extensão \'{$a}\' do PHP é necessária para esta ação. Por favor instale a extensão caso queira utilizar este recurso.';
$string['field'] = 'Campo';
$string['fieldnameempty'] = 'Campo "nome" vazio';
$string['fields'] = 'Campos';
$string['fieldsnotintable'] = 'Campo não existe na tabela';
$string['fieldsusedinindex'] = 'Este campo é utilizado como índice.';
$string['fieldsusedinkey'] = 'Este campo é utilizado como chave.';
$string['filenotwriteable'] = 'Arquivo não pode ser escrito';
$string['fkviolationdetails'] = 'A chave estrangeira {$a->keyname} na tabela {$a->tablename} foi violada por {$a->numviolations} de {$a->numrows} linhas.';
$string['float2numbernote'] = 'Aviso: Embora campos "float" sejam 100% suportados pelo XMLDB, é recomendável migrar para o campos "number".';
$string['floatincorrectdecimals'] = 'Número incorreto de decimais para campo "float"';
$string['floatincorrectlength'] = 'Tamanho incorreto para campo "float"';
$string['generate_all_documentation'] = 'Toda a documentação';
$string['generate_documentation'] = 'Documentação';
$string['gotolastused'] = 'Ir para último arquivo usado';
$string['incorrectfieldname'] = 'Nome incorreto';
$string['incorrectkeyname'] = 'Nome de chave incorreto';
$string['incorrecttablename'] = 'Nome de tabela incorreto';
$string['index'] = 'Índice';
$string['indexes'] = 'Índices';
$string['integerincorrectlength'] = 'Tamanho incorreto para campo "inteiro"';
$string['key'] = 'Chave';
$string['keynameempty'] = 'O nome da chave não pode ser vazio';
$string['keys'] = 'Chaves';
$string['listreservedwords'] = 'Lista de palavras reservadas<br/>(usada para manter <a href="http://docs.moodle.org/en/XMLDB_reserved_words" target="_blank">XMLDB_reserved_words</a> atualizado)';
$string['load'] = 'Carregar';
$string['main_view'] = 'Visão principal';
$string['masterprimaryuniqueordernomatch'] = 'Os campos em sua chave externa devem ser listadas na mesma ordem em que são listados na CHAVE ÚNICA na tabela referenciada.';
$string['missing'] = 'Faltando';
$string['missingindexes'] = 'Foram encontrados índices ausentes';
$string['mustselectonefield'] = 'Você deve selecionar um campo para visualizar ações relacionadas a campos!';
$string['mustselectoneindex'] = 'Você deve selecionar um índice para visualizar ações relacionadas a índices!';
$string['mustselectonekey'] = 'Você deve selecionar uma chave para visualizar ações relacionas a chaves!';
$string['mysqlextracheckbigints'] = 'Com MySQL, também procura por bigints assinalados incorretamente, gerando o SQL requerido para ser executado a fim de consertar todos eles.';
$string['newfield'] = 'Novo campo';
$string['newindex'] = 'Novo índice';
$string['newkey'] = 'Nova chave';
$string['newtable'] = 'Nova tabela';
$string['newtablefrommysql'] = 'Nova tabela do MySQL';
$string['new_table_from_mysql'] = 'Nova tabela do MySQL';
$string['nofieldsspecified'] = 'Nenhum campo especificado';
$string['nomasterprimaryuniquefound'] = 'A(s) coluna(s) que referenciadas pela sua chave externa deve ser incluída em uma chave primária ou exclusiva na tabela referenciada. Nota, a coluna estar em um índice exclusivo não é bom o suficiente.';
$string['nomissingindexesfound'] = 'Não foi encontrado nenhum índice ausente, seu BD não precisa de outras ações.';
$string['noreffieldsspecified'] = 'Nenhuma referência a campo especificada';
$string['noreftablespecified'] = 'Tabela de referências especificadas não encontrada';
$string['noviolatedforeignkeysfound'] = 'Nenhuma violação de chave estrangeira encontrada';
$string['nowrongdefaultsfound'] = 'Não foram encontrados valores padrão, o seu BD não requer outras ações.';
$string['nowrongintsfound'] = 'Não foi encontrado nenhum integral errado, seu BD não precisa de outras ações.';
$string['nowrongoraclesemanticsfound'] = 'Não há colunas Oracle usando semântica BYTE foram encontrados, a DB não precisa de novas acções.';
$string['numberincorrectdecimals'] = 'Número incorreto de decimais para campo "numérico"';
$string['numberincorrectlength'] = 'Tamanho incorreto para campo "numérico"';
$string['pendingchanges'] = 'Aviso: Você realizou alterações neste arquivo. Elas podem ser salvas a qualquer momento.';
$string['pendingchangescannotbesaved'] = 'Existem alterações neste arquivo, mas elas não puderam ser salvas! Por favor verifique se o arquivo "install.xml" e o diretório no qual ele está contido tem permissão de escrita para o servidor web';
$string['pendingchangescannotbesavedreload'] = 'Existem alterações neste arquivo, mas elas não puderam ser salvas! Por favor verifique se o arquivo "install.xml" e o diretório no qual ele está contido tem permissão de escrita para o servidor web. Então recarregue este página e você deverá ser capaz de salvar aquelas alterações.';
$string['pluginname'] = 'Editor XMLDB';
$string['primarykeyonlyallownotnullfields'] = 'Chaves primárias não podem ser nulas';
$string['reserved'] = 'Reservado';
$string['reservedwords'] = 'Palavras reservadas';
$string['revert'] = 'Desfazer';
$string['revert_changes'] = 'Desfazer mudanças';
$string['save'] = 'Salvar';
$string['searchresults'] = 'Resultados da busca';
$string['selectaction'] = 'Selecionar ação:';
$string['selectdb'] = 'Selecionar base de dados:';
$string['selectfieldkeyindex'] = 'Selecionar campo/chave/índice:';
$string['selectonecommand'] = 'Por favor, selecione uma ação da lista para visualizar o código PHP';
$string['selectonefieldkeyindex'] = 'Por favor, selecione um campo/chave/índice da lista para visualizar o código PHP';
$string['selecttable'] = 'Selecionar tabela:';
$string['table'] = 'Tabela';
$string['tablenameempty'] = 'O nome da tabela não pode ficar vazio.';
$string['tables'] = 'Tabelas';
$string['textincorrectlength'] = 'Tamanho incorreto para campo "texto"';
$string['unload'] = 'Descarregar';
$string['up'] = 'Acima';
$string['view'] = 'Ver';
$string['viewedited'] = 'Ver editado';
$string['vieworiginal'] = 'Ver original';
$string['viewphpcode'] = 'Ver código PHP';
$string['view_reserved_words'] = 'Ver palavras reservadas';
$string['viewsqlcode'] = 'Ver código SQL';
$string['view_structure_php'] = 'Ver estrutura PHP';
$string['view_structure_sql'] = 'Ver estrutura SQL';
$string['view_table_php'] = 'Ver tabela PHP';
$string['view_table_sql'] = 'Ver tabela SQL';
$string['viewxml'] = 'XML';
$string['violatedforeignkeys'] = 'Chaves estrangeiras violadas';
$string['violatedforeignkeysfound'] = 'Encontradas chaves estrangeiras violadas';
$string['violations'] = 'Violações';
$string['wrong'] = 'Errado';
$string['wrongdefaults'] = 'Encontrados padrões errados';
$string['wrongints'] = 'Encontrados inteiros errados';
$string['wronglengthforenum'] = 'Tamanho incorreto para campo enum';
$string['wrongnumberofreffields'] = 'Número errado de campos de referência';
$string['wrongoraclesemantics'] = 'Semântica BYTE erradas da Oracle encontrado';
$string['wrongreservedwords'] = 'Palavras reservadas usadas no momento<br />(note que os nomes das tabelas não são importantes se usar $CFG->prefix)';
$string['yesmissingindexesfound'] = 'Foram encontrados alguns índices faltando no seu BD. Aqui estão os seus detalhes e as instruções SQL necessárias a serem executadas com sua interface SQL favorita para criar todos eles (não esqueça de fazer uma cópia de segurança dos seus dados antes de fazer isso).<br /><br />Após fazer isso, é altamente recomendável executar essa utilidade novamente para verificar se outros índices ausentes são encontrados.';
$string['yeswrongdefaultsfound'] = 'Foram encontradas inconsistências padrão no seu BD. Estes são os detalhes e as instruções SQL necessárias a serem executadas com sua interface SQL favorita para criar todos eles (não esqueça de fazer uma cópia de segurança dos seus dados antes de fazer isso).<br /><br />Após fazer isso, é altamente recomendável executar essa utilidade novamente para verificar se outras inconsistências são encontradas.';
$string['yeswrongintsfound'] = 'Foram encontrados integrais errados no seu BD. Aqui estão os seus detalhes e as instruções SQL necessárias a serem executadas com sua interface SQL favorita para criar todos eles (não esqueça de fazer uma cópia de segurança dos seus dados antes de fazer isso).<br /><br />Após fazer isso, é altamente recomendável executar essa utilidade novamente para verificar se outras inconsistências são encontrados.';
$string['yeswrongoraclesemanticsfound'] = 'Algumas colunas Oracle usando semântica BYTE foram encontrados em seu banco de dados. Aqui estão os detalhes e as declarações necessárias SQL a serem executadas com sua interface favorita do SQL para criar todos eles (não se esqueça de fazer backup de seus dados antes de fazer isso). <br /><br /> Após fazer isso, é altamente recomendável para executar este utilitário novamente para verificar que não semântica mais errados são encontrados.';
