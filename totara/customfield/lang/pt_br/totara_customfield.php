<?php

$string['category'] = 'Categoria';
$string['categorynamemustbeunique'] = 'Nome da categoria (deve ser exclusivo)';
$string['categorynamenotunique'] = 'Este nome de categoria já está em uso';
$string['confirmcategorydeletion'] = 'Existem {$a} campos nesta categoria que devem ser movidos para a categoria acima (ou abaixo, se estiverem na categoria do topo). <br />Ainda deseja excluir esta categoria?';
$string['commonsettings'] = 'Configurações comuns';
$string['confirmfielddeletion'] = 'Existem {$a} registros neste campo que serão excluídos. <br />Ainda deseja excluir este campo?';
$string['coursecustomfields'] = 'Campos personalizados do curso';
$string['createcustomfieldcategory'] = 'Criar categoria de campo personalizado';
$string['createnewcustomfield'] = 'Criar um novo campo personalizado';
$string['createnewfield'] = 'Criar um novo campo personalizado &quot;{$a}&quot;';
$string['createnewcategory'] = 'Criando uma nova categoria';
$string['customfieldtypecheckbox'] = 'Caixa de seleção';
$string['customfieldtypemenu'] = 'Menu de escolhas';
$string['customfieldtypetext'] = 'Entrada de texto';
$string['customfieldtypetextarea'] = 'Área de texto';
$string['customfieldtypefile'] = 'Arquivo';
$string['customfield'] = 'Campo personalizado';
$string['customfields'] = 'Campos personalizados';
$string['defaultdata'] = 'Valor padrão';
$string['deletecategory'] = 'Excluindo uma categoria';
$string['deletefield'] = 'Excluindo um campo';
$string['description'] = 'Descrição do campo';
$string['editcategory'] = 'Editando categoria de campo personalizado: {$a}';
$string['editfield'] = 'Editando campo personalizado: {$a}';
$string['fieldcolumns'] = 'Colunas';
$string['fieldrows'] = 'Linhas';
$string['fieldsize'] = 'Exibir tamanho';
$string['fieldmaxlength'] = 'Comprimento máximo';
$string['fieldispassword'] = 'Este é um campo de senha?';
$string['menuoptions'] = 'Opções do menu (uma por linha)';
$string['menunooptions'] = 'Nenhuma opção de menu fornecida';
$string['menutoofewoptions'] = 'Você deve fornecer pelo menos 2 opções';
$string['menudefaultnotinoptions'] = 'O valor padrão não é uma das opções';
$string['defaultchecked'] = 'Marcado por padrão';
$string['forceunique'] = 'Os dados devem ser exclusivos?';
$string['locked'] = 'Este campo está bloqueado?';
$string['nocustomfieldsdefined'] = 'Nenhum campo foi definido';
$string['shortname'] = 'Nome curto (deve ser exclusivo)';
$string['shortnamenotunique'] = 'Este nome curto já está em uso';
$string['specificsettings'] = 'Configurações específicas';
$string['customfieldrequired'] = 'Este campo é exigido?';
$string['visible'] = 'Ocultado na página de configurações?';
$string['nocustomfieldcategories'] = 'Para adicionar campos personalizados, crie primeiro uma categoria de campo personalizado';
$string['nocustomfieldcategoriesdefined'] = 'Nenhuma categoria de campo personalizado definida';
$string['customfieldcategories'] = 'Categorias de campo personalizado';
$string['returntocategories'] = 'Retornar às Categorias de campo personalizado';
$string['returntoframework'] = 'Retornar à Estrutura';
$string['customfieldhidden_help'] = '# Ocultado na página de configurações?

Quando configurado como Sim, o campo personalizado não será visível na página de configurações ou em outros lugares em que ele seria mostrado. Quando Não, o campo personalizado será visível.';
$string['customfieldfullname_help'] = '# Nome completo do campo personalizado

Nome completo do campo personalizado é o título completo desse campo.';
$string['customfieldforceunique_help'] = '# Os dados devem ser exclusivos?

Quando configurado como Sim, o campo personalizados só aceitará um valor exclusivo. Se um valor duplicado for usado neste campo, o sistema não permitirá que o item seja salvo.

Quando configurado como Não, o campo personalizado aceitará qualquer valor no campo.';
$string['customfieldlocked_help'] = '# Este campo está bloqueado?

Quando configurado como Sim, o campo personalizado só exibirá as informações configuradas quando o campo foi configurado. O campo não pode ser editado.';
$string['customfieldmenuoptions_help'] = '# Opções do menu (menu de opções)

Insira as opções do menu que serão exibidas na caixa suspensa.

Insira apenas uma opção por linha.';
$string['customfieldshortname_help'] = '# Nome curto do campo personalizado

O nome curto do campo personalizado é o nome abreviado do campo personalizado e pode ser usado para fins de exibição.

Os campos personalizados aparecem como opções na tela de edição do item, para os itens que estão no mesmo nível de profundidade ao qual este campo personalizado é atribuído.';
$string['customfieldrowstextarea_help'] = '# Linhas (área de texto)

Configure a altura da área do texto que estará disponível (número de linhas)';
$string['customfieldrequired_help'] = '# Este campo é exigido?

Este campo é exigido? Se configurado como Sim, este campo é compulsório ao criar novos itens neste nível de profundidade.

Se configurado como Não, ele é opcional ao criar novos itens neste nível de profundidade.';
$string['customfieldfieldsizetext_help'] = '# Tamanho da exibição (inserção de texto)

O tamanho da exibição configura o número de caracteres que serão exibidos no campo de texto.';
$string['customfieldmaxlengthtext_help'] = '# Comprimento máximo (inserção de texto)

O comprimento máximo configura o número máximo de caracteres que o campo de texto irá aceitar.';
$string['customfielddefaultdatatext_help'] = '# Valor padrão (inserção de texto)

Valor padrão é o texto que irá aparecer no campo do texto por padrão.

Deixe esse campo em branco se nenhum texto padrão for necessário.';
$string['customfieldcategory_help'] = '# Categoria

Uma **Categoria** é criada para agrupar campos personalizados adicionais em uma página, por exemplo, em uma página de competência, posições ou organizações.';
$string['customfieldcategories_help'] = '# Categorias de campo personalizado

**Categorias de campo personalizado** permitem configurar categorias personalizadas para conter campos personalizados em um nível de profundidade.

As categorias de campo personalizado e os campos personalizados são configurados para permitir que todas as informações relevantes dos itens da hierarquia sejam capturadas e exibidas nas páginas \'Adicionar/editar item de hierarquia\'.

Os nomes da categoria de campo personalizado devem ser exclusivos para o nível de profundidade. Você precisa ter pelo menos uma categoria de campo personalizado configurada para poder configurar os campos personalizados.

**Adicionando uma categoria personalizada: **Clique em **Criar categoria de campo personalizado** para adicionar uma nova categoria.

**Editar/excluir uma categoria personalizada: **Clique em **Ativar edição** para editar ou excluir uma categoria de campo personalizado existente.';
$string['customfielddefaultdatatextarea_help'] = '# Valor padrão (área de texto)

Valor padrão é o texto que irá aparecer na área do texto por padrão.

Deixe esse campo em branco se nenhum texto padrão for necessário.';
$string['customfieldcategoryname_help'] = '# Nome da categoria de campo personalizado

O nome da **Categoria do campo personalizado** ajuda a agrupar os tipos de campos personalizados necessários e deve ser exclusivo para o nível de profundidade no qual você está trabalhando 

Digite o nome e clique em **Salvar alterações**.';
$string['customfieldcolumnstextarea_help'] = '# Colunas (área de texto)

**Colunas** define a largura da área de texto que estará disponível.';
$string['customfielddefaultdatamenu_help'] = '# Valor padrão (menu de opções)

Configure um valor padrão que irá aparecer na caixa suspensa. O valor padrão deve aparecer nas opções do menu acima.

Deixe em branco se nenhuma inserção padrão for exigida.';
$string['customfielddefaultdatacheckbox_help'] = '# Marcada por padrão (caixa de seleção)

Quando configurada como Sim, a caixa de seleção do Campo personalizado será marcada por padrão.

Quando configurado como Não, a caixa de seleção do Campo personalizado será desmarcada por padrão.';

