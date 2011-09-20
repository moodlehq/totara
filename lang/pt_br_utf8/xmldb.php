<?PHP // $Id: xmldb.php,v 1.3 2010/03/17 13:52:33 danielneis Exp $ 
      // xmldb.php - created with Moodle 1.9.2+ (Build: 20080903) (2007101522)


$string['aftertable'] = 'Depois da tabela:';
$string['back'] = 'Voltar';
$string['backtomainview'] = 'Voltar para principal';
$string['binaryincorrectlength'] = 'Tamanho incorreto para o campo \"binário\"';
$string['butis'] = 'mas é';
$string['cannotuseidfield'] = 'Não é possível inserir o campo \"id\". É uma  coluna auto-numérica';
$string['change'] = 'Mudar';
$string['charincorrectlength'] = 'Tamanho incorreto para o campo \"char\"';
$string['check_bigints'] = 'Procurar integrais incorretas no BD';
$string['check_defaults'] = 'Procurar valores padrão inconsistentes';
$string['check_indexes'] = 'Procurar índices ausentes no BD';
$string['checkbigints'] = 'Verificar bigints';
$string['checkdefaults'] = 'Verificar padrões';
$string['checkindexes'] = 'Verificar índices';
$string['completelogbelow'] = '(veja o registro completo da pesquisa abaixo)';
$string['confirmcheckbigints'] = 'Essa funcionalidade irá procurar <a href=\"http://tracker.moodle.org/browse/MDL-11038\"> possíveis campos integrais errados</a>no servidor do seu Moodle, gerando (mas não executando) automaticamente as instruções SQL necessárias para ter todos os integrais propriamente definidos no seu BD.<br /><br />
Uma vez geradas você pode copiar tais instruções e executá-las com sua interface SQL favorita (não esqueça de fazer uma cópia de segurança dos seus dados antes de fazer isso).<br /><br />
É altamente recomendável a versão mais recente (+ versão) disponível do Moodle (1.8, 1.9, 2.x ...) antes de executar a busca por integrais errados.<br /><br />
Essa funcionalidade pode ser executada com segurança a qualquer momento e acessa o BD apenas em leitura.';
$string['confirmcheckdefaults'] = 'Essa funcionalidade procura valores padrão inconsistentes no seu Moodle, gerando (mas não executando!) automaticamente as instruções SQL para manter tudo atualizado.<br /><br />
Uma vez geradas você pode copiar tais instruções e executá-las com sua interface SQL favorita (não esqueça de fazer uma cópia de segurança dos seus dados antes de fazer isso).<br /><br />
É altamente recomendável a versão mais recente (+ versão) do Moodle (1.8, 1.9, 2.x ...) antes de executar a busca por integrais errados.<br /><br />
Essa funcionalidade pode ser executada com segurança a qualquer momento e acessa o BD apenas em leitura.';
$string['confirmcheckindexes'] = 'Essa funcionalidade procura possíveis índices que estejam faltando no seu Moodle, gerando (mas não executando!) automaticamente as instruções SQL para manter tudo atualizado.<br /><br />
Uma vez geradas você pode copiar tais instruções e executá-las com sua interface SQL favorita (não esqueça de fazer uma cópia de segurança dos seus dados antes de fazer isso).<br /><br />
É altamente recomendável a versão mais recente (+ versão) do Moodle (1.8, 1.9, 2.x ...) antes de executar a busca por índices ausentes.<br /><br />
Essa funcionalidade pode ser executada com segurança a qualquer momento e acessa o BD apenas em leitura.';
$string['confirmdeletefield'] = 'Você está certo de que quer deletar esse campo:';
$string['confirmdeleteindex'] = 'Você está certo de que quer deletar o índice:';
$string['confirmdeletekey'] = 'Você está certo de que quer deletar essa chave:';
$string['confirmdeletesentence'] = 'Você está certo de que quer deletar a sentença:';
$string['confirmdeletestatement'] = 'Você está certo de que quer deletar a instrução e todas as suas sentenças:';
$string['confirmdeletetable'] = 'Você está certo de que quer deletar a tabela:';
$string['confirmdeletexmlfile'] = 'Você está certo de que quer deletar o arquivo:';
$string['confirmrevertchanges'] = 'Você está certo de que quer desfazer as mudanças feitas em:';
$string['create'] = 'Criar';
$string['createtable'] = 'Criar tabela';
$string['defaultincorrect'] = 'Padrão incorreto';
$string['delete'] = 'Excluir';
$string['delete_field'] = 'Excluir campo';
$string['delete_index'] = 'Excluir índice';
$string['delete_key'] = 'Excluir chave';
$string['delete_sentence'] = 'Excluir sentença';
$string['delete_statement'] = 'Excluir instrução';
$string['delete_table'] = 'Excluir tabela';
$string['delete_xml_file'] = 'Excluir arquivo XML';
$string['down'] = 'Abaixo';
$string['duplicate'] = 'Duplicar';
$string['duplicatefieldname'] = 'Existe outro campo com esse nome';
$string['edit'] = 'Editar';
$string['edit_field'] = 'Editar campo';
$string['edit_index'] = 'Editar índice';
$string['edit_key'] = 'Editar chave';
$string['edit_sentence'] = 'Editar sentença';
$string['edit_statement'] = 'Editar instrução';
$string['edit_table'] = 'Editar tabela';
$string['edit_xml_file'] = 'Editar arquivo XML';
$string['enumvaluesincorrect'] = 'Valores incorretos para o campo \"enum\"';
$string['field'] = 'Campo';
$string['fieldnameempty'] = 'Campo Nome vazio';
$string['fields'] = 'Campos';
$string['filenotwriteable'] = 'Arquivo não pode ser escrito';
$string['floatincorrectdecimals'] = 'Número incorreto de decimais para o campo float';
$string['floatincorrectlength'] = 'Tamanho incorreto para o campo float';
$string['gotolastused'] = 'Ir para o último arquivo usado';
$string['incorrectfieldname'] = 'Nome incorreto';
$string['index'] = 'Índice';
$string['indexes'] = 'Índices';
$string['integerincorrectlength'] = 'Tamanho incorreto para o campo integral';
$string['key'] = 'Chave';
$string['keys'] = 'Chaves';
$string['listreservedwords'] = 'Lista de palavras reservadas<br/>(usada para manter <a href=\"http://docs.moodle.org/en/XMLDB_reserved_words\" target=\"_blank\">XMLDB_reserved_words</a> atualizado)';
$string['load'] = 'Carregar';
$string['main_view'] = 'Vista principal';
$string['missing'] = 'Faltando';
$string['missingfieldsinsentence'] = 'Campos faltando na sentença';
$string['missingindexes'] = 'Foram encontrados índices ausentes';
$string['missingvaluesinsentence'] = 'Valores faltando na sentença';
$string['mustselectonefield'] = 'Você deve selecionar um campo para visualizar ações relacionadas a campos!';
$string['mustselectoneindex'] = 'Você deve selecionar um índice para visualizar ações relacionadas a índices!';
$string['mustselectonekey'] = 'Você deve selecionar uma chave para visualizar ações relacionas a chaves!';
$string['mysqlextracheckbigints'] = 'Com MySQL, também procura por bigints assinalados incorretamente, gerando o SQL requerido para ser executado a fim de consertar todos eles.';
$string['new_statement'] = 'Nova instrução';
$string['new_table_from_mysql'] = 'Nova tabela do MySQL';
$string['newfield'] = 'Novo campo';
$string['newindex'] = 'Novo índice';
$string['newkey'] = 'Nova chave';
$string['newsentence'] = 'Nova sentença';
$string['newstatement'] = 'Nova instrução';
$string['newtable'] = 'Nova tabela';
$string['newtablefrommysql'] = 'Nova tabela do MySQL';
$string['nomissingindexesfound'] = 'Não foi encontrado nenhum índice ausente, seu BD não precisa de outras ações.';
$string['nowrongdefaultsfound'] = 'Não foram encontrados valores padrão, o seu BD não requer outras ações.';
$string['nowrongintsfound'] = 'Não foi encontrado nenhum integral errado, seu BD não precisa de outras ações.';
$string['numberincorrectdecimals'] = 'Número incorreto de decimais para o campo número';
$string['numberincorrectlength'] = 'Tamanho incorreto para o campo número';
$string['reserved'] = 'Reservado';
$string['reservedwords'] = 'Palavras reservadas';
$string['revert'] = 'Desfazer';
$string['revert_changes'] = 'Desfazer mudanças';
$string['save'] = 'Salvar';
$string['searchresults'] = 'Procurar resultados';
$string['selectaction'] = 'Selecionar ação:';
$string['selectdb'] = 'Selecionar banco de dados:';
$string['selectfieldkeyindex'] = 'Selecionar Campo/Chave/Índice;';
$string['selectonecommand'] = 'Por favor, selecionar uma ação da lista para visualizar o código PHP';
$string['selectonefieldkeyindex'] = 'Por favor, selecione um Campo/Chave/Índice da lista para visualizar o código PHP';
$string['selecttable'] = 'Selecionar tabela';
$string['sentences'] = 'Sentenças';
$string['shouldbe'] = 'deve ser';
$string['statements'] = 'Instruções';
$string['statementtable'] = 'Tabela de instrução:';
$string['statementtype'] = 'Tipo e instrução:';
$string['table'] = 'Tabela';
$string['tables'] = 'Tabelas';
$string['test'] = 'Teste';
$string['textincorrectlength'] = 'Tamanho incorreto para o campo texto';
$string['unload'] = 'Descarregar';
$string['up'] = 'Acima';
$string['view'] = 'Ver';
$string['view_reserved_words'] = 'Ver palavras reservadas';
$string['view_structure_php'] = 'Ver estrutura PHP';
$string['view_structure_sql'] = 'Ver estrutura SQL';
$string['view_table_php'] = 'Ver tabela PHP';
$string['view_table_sql'] = 'Ver tabela SQL';
$string['viewedited'] = 'Ver editados';
$string['vieworiginal'] = 'Ver original';
$string['viewphpcode'] = 'Ver código PHP';
$string['viewsqlcode'] = 'Ver código SQL';
$string['wrong'] = 'Errado';
$string['wrongdefaults'] = 'Encontrados padrões errados';
$string['wrongints'] = 'Integrais errados encontrados';
$string['wronglengthforenum'] = 'Tamanho incorreto para o campo enum';
$string['wrongnumberoffieldsorvalues'] = 'Número incorreto de campos ou valores na sentença';
$string['wrongreservedwords'] = 'Palavras reservadas usadas no momento<br />(note que os nomes das tabelas não são importantes se usar \$CFG->prefix)';
$string['yesmissingindexesfound'] = 'Foram encontrados alguns índices faltando no seu BD. Aqui estão os seus detalhes e as instruções SQL necessárias a serem executadas com sua interface SQL favorita para criar todos eles (não esqueça de fazer uma cópia de segurança dos seus dados antes de fazer isso).<br /><br />Após fazer isso, é altamente recomendável executar essa utilidade novamente para verificar se outros índices ausentes são encontrados.';
$string['yeswrongdefaultsfound'] = 'Foram encontradas inconsistências padrão no seu BD. Estes são os detalhes e as instruções SQL necessárias a serem executadas com sua interface SQL favorita para criar todos eles (não esqueça de fazer uma cópia de segurança dos seus dados antes de fazer isso).<br /><br />Após fazer isso, é altamente recomendável executar essa utilidade novamente para verificar se outros inconsistências são encontradas.';
$string['yeswrongintsfound'] = 'Foram encontrados integrais errados no seu BD. Aqui estão os seus detalhes e as instruções SQL necessárias a serem executadas com sua interface SQL favorita para criar todos eles (não esqueça de fazer uma cópia de segurança dos seus dados antes de fazer isso).<br /><br />Após fazer isso, é altamente recomendável executar essa utilidade novamente para verificar se outras inconsistências são encontrados.';

?>
