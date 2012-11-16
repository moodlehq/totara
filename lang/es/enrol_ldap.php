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
 * Strings for component 'enrol_ldap', language 'es', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol_ldap
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['assignrole'] = 'Asignando rol
\'{$a->role_shortname}\' a Usuario
\'{$a->user_username}\' a Curso
\'{$a->course_shortname}\' (id
{$a->course_id})';
$string['assignrolefailed'] = 'Fallo al asignar rol
\'{$a->role_shortname}\' a Usuario
\'{$a->user_username}\' a Curso
\'{$a->course_shortname}\' (id
{$a->course_id})';
$string['autocreate'] = 'Los cursos pueden crearse automáticamente si existen matriculaciones en un curso que aún no existe en Moodle.';
$string['autocreate_key'] = 'Creación automática';
$string['autocreation_settings'] = 'Ajustes para la creación automática de cursos';
$string['bind_dn'] = 'Si desea usar \'bind-user\' para buscar usuarios, especifíquelo aquí. Algo como \'cn=ldapuser,ou=public,o=org\'';
$string['bind_dn_key'] = 'Enlazar nombre completo del usuario';
$string['bind_pw'] = 'Contraseña para \'bind-user\'.';
$string['bind_pw_key'] = 'Contraseña';
$string['bind_settings'] = 'Enlazar configuración';
$string['cannotcreatecourse'] = 'No se puede crear el curso: faltan datos necesarios del registro LDAP';
$string['category'] = 'Categoría para cursos auto-creados.';
$string['category_key'] = 'Categoría';
$string['contexts'] = 'Contextos LDAP';
$string['couldnotfinduser'] = 'No se pudo encontrar el usuario \'{$a}\', omitido';
$string['course_fullname'] = 'Opcional: campo LDAP del que conseguir el nombre completo.';
$string['course_fullname_key'] = 'Nombre completo';
$string['course_idnumber'] = 'Mapa del identificador único en LDAP, normalmente  <em>cn</em> or <em>uid</em>. Se recomienda bloquear el valor si se está utilizando la creación automática del curso.';
$string['course_idnumber_key'] = 'Número ID';
$string['course_search_sub'] = 'Buscar miembros del grupo a partir de los subcontextos';
$string['course_search_sub_key'] = 'Buscar subcontextos';
$string['course_settings'] = 'Ajustes de matriculación de Curso';
$string['course_shortname'] = 'Opcional: campo LDAP del que conseguir el nombre corto.';
$string['course_shortname_key'] = 'Nombre corto';
$string['course_summary'] = 'Opcional: campo LDAP del que conseguir el sumario.';
$string['course_summary_key'] = 'Resumen';
$string['editlock'] = 'Bloquear valor';
$string['enrolname'] = 'LDAP';
$string['enroluser'] = 'Matricular al usuario \'{$a->user_username}\' en el curso \'{$a->course_shortname}\' (id {$a->course_id})';
$string['extcourseidinvalid'] = 'La id del curso externo no es válido';
$string['extremovedunenrol'] = 'Dar de baja el usuario \'{$a->user_username}\' del curso \'{$a->course_shortname}\' (id {$a->course_id})';
$string['failed'] = 'Error';
$string['general_options'] = 'Opciones generales';
$string['group_memberofattribute'] = 'Nombre del atributo que especifica a qué grupos pertenece un determinado usuario o grupo (ejem. memberOf, groupMembership, etc.)';
$string['group_memberofattribute_key'] = 'Atributo \'Miembro de\'';
$string['host_url'] = 'Especifique el host LDAP en formato URL, e.g.,  \'ldap://ldap.myorg.com/\'
or \'ldaps://ldap.myorg.com/\'';
$string['host_url_key'] = 'URL del servidor';
$string['idnumber_attribute'] = 'Si la pertenencia al grupo contiene nombres distinguidos, especifique el mismo atributo que ha utilizado para el mapeo de "Número ID" del usuario en la configuración de autenticación LDAP';
$string['idnumber_attribute_key'] = 'Número ID del atributo';
$string['ldap:manage'] = 'Gestionar ejemplos de matriculación LDAP';
$string['ldap_encoding'] = 'Especifique la codificación usada por el serviodr LDAP. Probablemente, utf-8.
MS AD v2 utiliza como codificación de plataforma por defecto, cp1252, cp1250, etc.';
$string['ldap_encoding_key'] = 'Codificación LDAP';
$string['memberattribute'] = 'Atributo de miembro LDAP';
$string['memberattribute_isdn'] = 'Si la pertenencia al grupo contiene nombres distinguidos, es necesario que lo especifique aquí. Si lo hace, también es necesario configurar los parámetros restantes de esta sección';
$string['memberattribute_isdn_key'] = 'El atributo de miembro usa dn';
$string['nested_groups'] = '¿Desea usar grupos anidados (i.e., grupos de grupos) para la matriculación?';
$string['nested_groups_key'] = 'Grupos anidados';
$string['nested_groups_settings'] = 'Configuración de grupos anidados';
$string['nosuchrole'] = 'No existe ese rol: \'{$a}\'';
$string['objectclass'] = 'objectClass usada para buscar cursos. Normalmente
\'posixGroup\'.';
$string['objectclass_key'] = 'Clase del objeto';
$string['ok'] = 'Ok';
$string['opt_deref'] = 'Si la pertenencia al grupo contiene  nombres distinguidos, especificar cómo se manejan los alias durante la búsqueda. Seleccione uno de los siguientes valores: \'No\' (LDAP_DEREF_NEVER) o \'Sí\' (LDAP_DEREF_ALWAYS)';
$string['phpldap_noextension'] = '<em>El módulo PHP LDAP no parecen estar presente. Por favor, asegúrese de que está instalado y habilitado si desea utilizar este módulo de matriculación.</em>';
$string['pluginname'] = 'Inscripciones LDAP';
$string['pluginname_desc'] = '<p>Usted puede utilizar un servidor LDAP para coltrolar sus matriculaciones. Se asume que su árbol LDAP contiene grupos que apuntan a los cursos, y que cada uno de esos grupos o cursos contienen entradas de matriculación que hacen referencia a los estudiantes.</p>
<p>Se asume que los cursos están definidos como grupos en LDAP, de modo que cada grupo tiene múltiples campos de matriculación  (<em>member</em> or <em>memberUid</em>) que contienen una identificación única del usuario.</p>
<p>Para usar la matriculación LDAP, los usuarios <strong>deben</strong> tener un campo \'idnumber\' válido. Los grupos LDAP deben contener ese \'idnumber\' en los campos de membresía para que un usuario pueda matricularse en un curso. Esto normalmente funcionará bien si usted ya está usando la Identificación LDAP.</p>
<p>Las matriculaciones se actualizarán cuando el usuario se identifica. Consulte en <em>enrol/ldap/enrol_ldap_sync.php</em>.</p>
<p>Este plugin puede también ajustarse para crear nuevos cursos de forma automática cuando aparecen nuevos grupos en LDAP.</p>';
$string['pluginnotenabled'] = 'El plugin no está habilitado';
$string['role_mapping'] = '<p> Para cada rol que desee asignar a partir de LDAP, es necesario especificar la lista de contextos en los que se encuentran los grupos de roles de curso. Separes los diferentes contextos con\';\'.</p><p> También es necesario especificar el atributo que su servidor LDAP utiliza para mantener a los miembros de un grupo. Por lo general, \'member\' o \'memberUid\' </p>';
$string['role_mapping_key'] = 'Mapa de roles de LDAP';
$string['roles'] = 'Mapeo de roles';
$string['server_settings'] = 'Configuración del Servidor LDAP';
$string['template'] = 'Opcional: los cursos auto-creados pueden copiar sus ajustes a partir de una plantilla de curso.';
$string['template_key'] = 'Plantilla';
$string['updatelocal'] = 'Actualizar datos locales';
$string['user_attribute'] = 'Si la pertenencia al grupo contiene  nombres distinguidos, especifique el atributo utilizado para los usuarios nombre / búsqueda. Si está utilizando la autenticación LDAP, este valor debe coincidir con el atributo especificado en el mapeo del "Número ID" en la extensión de autenticación LDAP';
$string['user_attribute_key'] = 'ID de atributo de número';
$string['user_contexts'] = 'Si la pertenencia al grupo contiene nombres distinguidos, especifique la lista de los contextos en los que se encuentren los usuarios. Separe los diferentes contextos con \';\'. Por ejemplo: \'ou=users,o=org; ou=others,o=org\'';
$string['user_contexts_key'] = 'Contextos';
$string['user_search_sub'] = 'Si la pertenencia al grupo contiene nombres distinguidos, especifique si la búsqueda de los usuarios se realiza también en subcontextos';
$string['user_search_sub_key'] = 'Buscar subcontextos';
$string['user_settings'] = 'Configuración de búsqueda de usuario';
$string['user_type'] = 'Si la pertenencia al grupo contiene nombres distinguidos, especifique cómo se almacenan los usuarios en LDAP';
$string['user_type_key'] = 'Tipo de usuario';
$string['version'] = 'Versión del protocolo LDAP usado por el servidor.';
$string['version_key'] = 'Versión';
