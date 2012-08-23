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
 * Strings for component 'tool_uploaduser', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   tool_uploaduser
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['allowdeletes'] = 'Permitir remoções';
$string['allowrenames'] = 'Permitir renomeação';
$string['allowsuspends'] = 'Habilitar suspensão e ativação de contas';
$string['csvdelimiter'] = 'Delimitador CSV';
$string['defaultvalues'] = 'Valores padrões';
$string['deleteerrors'] = 'Excluir erros';
$string['encoding'] = 'Codificação';
$string['errors'] = 'Erros';
$string['nochanges'] = 'Nenhuma mudança';
$string['pluginname'] = 'Upload de usuário';
$string['renameerrors'] = 'Renomear erros';
$string['requiredtemplate'] = 'Necessário. Você deve usar sintaxe padrão aqui (%l = lastname, %f = firstname, %u = username). Veja ajuda para detalhes e exemplos.';
$string['rowpreviewnum'] = 'Mostrar colunas';
$string['uploadpicture_baduserfield'] = 'O atributo de usuário especificado não é válido. Favor tentar novamente.';
$string['uploadpicture_cannotmovezip'] = 'Não pode mover arquivo zip para o diretório temporário.';
$string['uploadpicture_cannotprocessdir'] = 'Não consegue processar arquivos unzipados';
$string['uploadpicture_cannotsave'] = 'Não pode salvar imagem para o usuário {$a}. Verifique o arquivo de imagem original.';
$string['uploadpicture_cannotunzip'] = 'Não consegue unzipar arquivos de imagens.';
$string['uploadpicture_invalidfilename'] = 'Arquivo de imagem {$a} tem caracteres inválidos em seu nome. Saltando.';
$string['uploadpicture_overwrite'] = 'Sobreescrever as imagens de usuários?';
$string['uploadpictures'] = 'Carregar imagens de usuários';
$string['uploadpictures_help'] = '<p>Imagens de usuários podem ser carregadas através de um arquivo compactado (zip) de arquivos de imagens. Os arquivos de imagens devem ter o nome na forma <i>atributo-do-usuário.extensão</i>. Por exemplo, se o atributo de usuário escolhido para identificar as imagens for o usuário (username) e o usuário for usuario1234, então o nome do arquivo deverá ser usuario1234.jpg.</p>
<p>Os tipos de arquivos de imagens aceitos são gif, jpg, e png.</p>
<p>Nome de arquivos de imagem não diferenciam maiúsculas de minúsculas.</p>';
$string['uploadpicture_userfield'] = 'Atributo de usuário a ser usado para comparar imagens';
$string['uploadpicture_usernotfound'] = 'Usuário com um \'{$a->userfield}\' com valor de \'{$a->uservalue}\'';
$string['uploadpicture_userskipped'] = 'Saltando usuário {$a} (já tem uma imagem)';
$string['uploadpicture_userupdated'] = 'Imagem atualizada para o usuário {$a}';
$string['uploadusers'] = 'Carregar lista de usuários';
$string['uploadusers_help'] = 'Usuários podem ser enviados (e opcionalmente inscritos em cursos) via arquivos de texto. O formato deste arquivo deve ser o seguinte:

* Cada linha do arquivo contém um registro
* cada registro é uma série de dados separados por vírgula (ou outros delimitadores)
* O primeiro registro contém a lista dos nomes de campos definindo o formato do resto do arquivo
* Os nomes de campos obrigatórios são username,password,firstname,lastname,email';
$string['uploaduserspreview'] = 'Carregar apresentações dos usuários';
$string['uploadusersresult'] = 'Carregar resultados dos usuários';
$string['useraccountupdated'] = 'Usuário atualizado';
$string['useraccountuptodate'] = 'Usuário atualizado';
$string['userdeleted'] = 'Usuário excluído';
$string['userrenamed'] = 'Usuário renomeado';
$string['userscreated'] = 'Usuários criados';
$string['usersdeleted'] = 'Usuários excluídos';
$string['usersrenamed'] = 'Usuários renomeados';
$string['usersskipped'] = 'Usuários saltados';
$string['usersupdated'] = 'Usuários atualizados';
$string['usersweakpassword'] = 'Usuários com senha fraca';
$string['uubulk'] = 'Selecionar operações em conjuntos';
$string['uubulkall'] = 'Todos usuários';
$string['uubulknew'] = 'Novos usuários';
$string['uubulkupdated'] = 'Atualizar usuários';
$string['uucsvline'] = 'Linha CSV';
$string['uulegacy1role'] = '(Estudante Original) tipoN=1';
$string['uulegacy2role'] = '(Professor Original) tipoN=2';
$string['uulegacy3role'] = '(Professor que não edita original) tipoN=3';
$string['uunoemailduplicates'] = 'Proibir duplicação de endereços de email';
$string['uuoptype'] = 'Tipo de transmissão';
$string['uuoptype_addinc'] = 'Adicionar todos, adicionando números aos nomes de usuário quando necessário';
$string['uuoptype_addnew'] = 'Adicionar somente novos, saltar usuários já existentes';
$string['uuoptype_addupdate'] = 'Adicionar novos e atualizar usuários já existentes';
$string['uuoptype_update'] = 'Somente atualizar usuários já existentes';
$string['uupasswordcron'] = 'Gerado no agendador de tarefas';
$string['uupasswordnew'] = 'Nova senha do usuário';
$string['uupasswordold'] = 'Senha de usuário já existente';
$string['uustandardusernames'] = 'Padronizar "usernames" de usuários';
$string['uuupdateall'] = 'Sobreponha com o arquivo e padrões';
$string['uuupdatefromfile'] = 'Sobreponha com o arquivo';
$string['uuupdatemissing'] = 'Preencher o que falta no arquivo e em padrões';
$string['uuupdatetype'] = 'Detalhes de usuário existente';
$string['uuusernametemplate'] = 'Modelo para usuário';
