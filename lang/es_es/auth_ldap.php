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
 * Strings for component 'auth_ldap', language 'es_es', branch 'MOODLE_22_STABLE'
 *
 * @package   auth_ldap
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['auth_ldap_bind_dn'] = 'Si quiere usar \'bind-user\' para buscar usuarios, especifíquelo aquí. Algo como \'cn=ldapuser,ou=public,o=org\'';
$string['auth_ldap_bind_pw'] = 'Contraseña para bind-user.';
$string['auth_ldap_contexts'] = 'Lista de contextos donde están localizados los usuarios. Separar contextos diferentes con \';\'. Por ejemplo: \'ou=usuarios,o=org; ou=otros,o=org\'';
$string['auth_ldap_create_context'] = 'Si habilita la creación de usuario con confirmación por medio de correo electrónico, especifique el contexto en el que se crean los usuarios. Este contexto debe ser diferente de otros usuarios para prevenir problemas de seguridad. No es necesario añadir este contexto a ldap_context-variable, Moodle buscará automáticamente los usuarios de este contexto.';
$string['auth_ldap_creators'] = 'Lista de grupos cuyos miembros están autorizados para crear nuevos cursos. Pueden separarse varios grupos con \';\'. Normalmente así: \'cn=teachers,ou=staff,o=myorg\'';
$string['auth_ldap_host_url'] = 'Especificar el host LDAP en forma de URL como \'ldap://ldap.myorg.com/\' o \'ldaps://ldap.myorg.com/\'';
$string['auth_ldap_memberattribute'] = 'Especificar el atributo para nombre de usuario, cuando los usuarios se integran en un grupo. Normalmente \'miembro\'';
$string['auth_ldap_search_sub'] = 'Ponga el valor &lt;&gt; 0 si quiere buscar usuarios desde subcontextos.';
$string['auth_ldap_update_userinfo'] = 'Actualizar información del usuario (nombre, apellido, dirección..) desde LDAP a Moodle. Mire en /auth/ldap/attr_mappings.php para información de mapeado';
$string['auth_ldap_user_attribute'] = 'El atributo usado para nombrar/buscar usuarios. Normalmente \'cn\'.';
$string['auth_ldapdescription'] = 'Este método proporciona autenticación contra un servidor LDAP externo.
Si el nombre de usuario y contraseña facilitados son válidos, Moodle crea una nueva entrada para el usuario en su base de datos. Este módulo puede leer atributos de usuario desde LDAP y prerrellenar los campos requeridos en Moodle. Para las entradas sucesivas sólo se comprueba el usuario y la contraseña.';
$string['auth_ldapextrafields'] = 'Estos campos son opcionales. Usted puede elegir pre-rellenar algunos campos de usuario en Moodle con información de los <strong>campos LDAP</strong> que especifique aquí. <p>Si deja estos campos en blanco, entonces no se transferirá nada desde LDAP y se usará el sistema predeterminado en Moodle.</p><p>En ambos casos, los usuarios podrán editar todos estos campos después de entrar.</p>';
