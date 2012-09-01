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
 * Strings for component 'install', language 'es_es', branch 'MOODLE_22_STABLE'
 *
 * @package   install
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['aborting'] = 'nAborting ...n';
$string['admindirerror'] = 'El directorio especificado para admin es incorrecto';
$string['admindirname'] = 'Directorio Admin';
$string['admindirsetting'] = '<p>Muy pocos servidores web usan /admin como URL especial para permitirle acceder a un panel de control o similar. Desgraciadamente, esto entra en conflicto con la ubicación estándar de las páginas de administración de Moodle Usted puede corregir esto renombrando el directorio admin en su instalación, y poniendo aquí ese nuevo nombre. Por ejemplo: <blockquote> moodleadmin</blockquote>.\nAsí se corregirán los enlaces admin en Moodle.</p>';
$string['admindirsettinghead'] = 'Seleccionar el directorio admin...';
$string['admindirsettingsub'] = 'Muy pocos servidores web usan /admin como URL especial para permitirle acceder\na un panel de control o similar. Desgraciadamente, esto entra en conflicto con la ubicación estándar\nde las páginas de administración de Moodle. Usted puede corregir esto renombrando el directorio admin\nen su instalación, y poniendo aquí ese nuevo nombre. Por ejemplo: <br /> <br /><b>moodleadmin</b><br /> <br />\nAsí se corregirán los enlaces admin en Moodle.';
$string['adminemail'] = 'Email:';
$string['adminfirstname'] = 'Nombre:';
$string['admininfo'] = 'Detalles del administrador:';
$string['adminlastname'] = 'Apellidos:';
$string['adminpassword'] = 'Contraseña:';
$string['adminusername'] = 'Nombre de usuario:';
$string['askcontinue'] = 'Continuar (sí/no):';
$string['availabledbtypes'] = 'nAvailable db types n';
$string['availablelangs'] = 'Lista de idiomas disponibles';
$string['caution'] = 'Precaución';
$string['chooselanguage'] = 'Seleccionar idioma';
$string['chooselanguagehead'] = 'Seleccionar idioma';
$string['chooselanguagesub'] = 'Por favor, seleccione un idioma para el proceso de instalación.';
$string['cliadminpassword'] = 'Nueva contraseña de usuario admin';
$string['clialreadyinstalled'] = 'El archivo config.php ya existe, por favor, utilice admin/cli/upgrade.php si desea actualizar su sitio web.';
$string['cliinstallfinished'] = 'La instalación se completo exitosamente.';
$string['cliinstallheader'] = 'Programa de instalación Moodle de línea de comando {$a}';
$string['climustagreelicense'] = 'En modo no interactivo debe aceptar la licencia especificando la opción -acuerdo de licencia-';
$string['clitablesexist'] = 'Tablas de base de datos ya existentes, la instalación CLI no puede continuar.';
$string['compatibilitysettings'] = 'Comprobando sus ajustes PHP...';
$string['compatibilitysettingshead'] = 'Comprobando sus ajustes PHP...';
$string['compatibilitysettingssub'] = 'Su servidor debería pasar todos estas comprobaciones para que Moodle pueda funcionar correctamente.';
$string['configfiledoesnotexist'] = '¡El archivo de configuración no existe!';
$string['configfilenotwritten'] = 'El script de instalación no ha podido crear automáticamente un archivo config.php con las especificaciones elegidas. Por favor, copie el siguiente código en un archivo llamado config.php y coloque ese archivo en el directorio raíz de Moodle.';
$string['configfilewritten'] = 'config.php se ha creado con éxito';
$string['configurationcomplete'] = 'Configuración completa';
$string['configurationcompletehead'] = 'Configuración completa';
$string['configurationcompletesub'] = 'Moodle ha creado su fichero de configuración';
$string['creatingconfigfile'] = 'Crear el archivo de configuración ...n';
$string['database'] = 'Base de datos';
$string['databasecreationsettings'] = 'Ahora necesita configurar los ajustes de la base de datos donde se almacenarán la mayoría de los datos de Moodle. El instalador creará la base de datos con los ajustes especificados más abajo.<br />\n<br /> <br />\n<b>Tipo:</b> el valor por defecto es "mysql"<br />\n<b>Servidor:</b> el valor por defecto es "localhost"<br />\n<b>Nombre:</b> nombre de la base de datos, e.g., moodle<br />\n<b>Usuario:</b> el valor por defecto es "root"<br />\n<b>Contraseña:</b> contraseña de la base de datos<br />\n<b>Prefijo de tablas:</b> prefijo opcional para todas las tablas';
$string['databasecreationsettingshead'] = 'Ahora necesita configurar los ajustes de la base de datos donde se almacenarán la mayoría de los datos de Moodle. El instalador creará la base de datos con los ajustes especificados más abajo.';
$string['databasecreationsettingssub'] = '<b>Tipo:</b> fijado a "mysql" por el instalador<br />\n<b>Host:</b> fijado a "localhost" por el instalador<br />\n<b>Nombre:</b> nombre de la base de datos, e.g., moodle<br />\n<b>Usuario:</b> el valor por defecto es "root"<br />\n<b>Contraseña:</b> contraseña de la base de datos<br />\n<b>Prefijo de Tablas:</b> prefijo opcional utilizado por todos los nombres de las tablas';
$string['databasecreationsettingssub2'] = '<b>Tipo:</b> fijado a "mysqli" por el instalador<br />\n<b>Host:</b> fijado a "localhost" por el instalador<br />\n<b>Nombre:</b> nombre de la base de datos, ej. moodle<br />\n<b>Contraseña:</b> contraseña de su base de datos\n<b>Prefijo de Tablas:</b> prefijo opcional utilizado por todos los nombres de las tablas';
$string['databasehead'] = 'Ajustes de base de datos';
$string['databasehost'] = 'Servidor de la base de datos';
$string['databasename'] = 'Nombre de la base de datos';
$string['databasepass'] = 'Contraseña de la base de datos';
$string['databasesettings'] = 'Ahora necesita configurar la base de datos en la que se almacenará la mayor parte de datos de Moodle. Esta base de datos debe haber sido ya creada, y disponer de un nombre de usuario y de una contraseña de acceso.<br />\n<br /> <br />\n<b>Tipo:</b> mysql o postgres7<br />\n<b>Servidor:</b> e.g., localhost or db.isp.com<br />\n<b>Nombre:</b> Nombre de la base de datos, e.g., moodle<br />\n<b>Usuario:</b> nombre de usuario de la base de datos<br />\n<b>Contraseña:</b> contraseña de la base de datos<br />\n<b>Prefijo de tablas:</b> prefijo a utilizar en todos los nombres de tabla';
$string['databasesettingshead'] = 'Ahora necesita configurar la base de datos en la que se almacenarán la mayor parte de los datos de Moodle. Esta base de datos debe haber sido ya creada y disponer de un nombre de usuario y una contraseña de acceso.';
$string['databasesettingssub'] = '<b>Tipo:</b> mysql o postgres7<br />\n<b>Servidor:</b> p.ej.: localhost o db.tudominio.com<br />\n<b>Usuario:</b> el usuario propietario de tu base de datos<br />\n<b>Contraseña:</b> la contraseña del usuario de la base de datos<br />\n<b>Prefijo de tablas:</b> prefijo opcional a usar en los nombres de las tablas';
$string['databasesettingssub_mssql'] = '<b>Tipo:</b> SQL*Server (no UTF-8) <b><font color="red">Experimental! (no usar en modo de producción)</font></b><br />\n<b>Servidor:</b> eg localhost o db.isp.com<br />\n<b>Nombre:</b> nombre de la base de datos, eg moodle<br />\n<b>Usuario:</b> usuario de la base de datos<br />\n<b>Contraseña:</b> contraseña de la base de datos<br />\n<b>Prefijo de tablas:</b> prefijo a usar en los nombres de las tablas (obligatorio)';
$string['databasesettingssub_mssql_n'] = '<b>Tipo:</b> SQL*Server (UTF-8 habilitado)<br />\n<b>Servidor:</b> eg localhost o db.isp.com<br />\n<b>Nombre:</b> nombre de la base de datos, eg moodle<br />\n<b>Usuario:</b> usuario de la base de datos<br />\n<b>Contraseña:</b> contraseña de la base de datos<br />\n<b>Prefijo de tablas:</b> prefijo a usar en los nombres de las tablas (obligatorio)';
$string['databasesettingssub_mysql'] = '<b>Tipo:</b> MySQL<br />\n<b>Servidor:</b> eg localhost o db.isp.com<br />\n<b>Nombre:</b> nombre de la base de datos, eg moodle<br />\n<b>Usuario:</b> usuario de la base de datos<br />\n<b>Contraseña:</b> contraseña de la base de datos<br />\n<b>Prefijo de tablas:</b> prefijo a usar en los nombres de las tablas (opcional)';
$string['databasesettingssub_mysqli'] = '<b>Tipo:</b> MySQL Mejorado<br />\n<b>Host:</b> e.g., localhost o db.isp.com<br />\n<b>Nombre:</b> nombre de la base de datos, e.g., moodle<br />\n<b>Usuario:</b> nombre de usuario de su base de datos<br />\n<b>Contraseña:</b> contraseña de su base de datos<br />\n<b>Prefijo de Tablas:</b> prefijo a usar en los nombres de las tablas (opcional)';
$string['databasesettingssub_oci8po'] = '<b>Tipo:</b> Oracle<br />\n<b>Servidor:</b> no usado, puede dejarse en blanco<br />\n<b>Nombre:</b> nombre de la conexión tnsnames.ora<br />\n<b>Usuario:</b> usuario de la base de datos<br />\n<b>Contraseña:</b> contraseña de la base de datos<br />\n<b>Prefijo de tablas:</b> prefijo para usar con todas las tablas (obligatorio, máx. 2cc.)';
$string['databasesettingssub_odbc_mssql'] = '<b>Tipo:</b> SQL*Server (sobre ODBC) <b><font color="red">Experimental! (no usar en modo de producción)</font></b><br />\n<b>Servidor:</b> nombre del DSN en el panel de control ODBC<br />\n<b>Nombre:</b> nombre de la base de datos, eg moodle<br />\n<b>Usuario:</b> usuario de la base de datos<br />\n<b>Contraseña:</b> contraseña de la base de datos<br />\n<b>Prefijo de tablas:</b> prefijo para usar con todas las tablas (obligatorio)';
$string['databasesettingssub_postgres7'] = '<b>Tipo:</b> PostgreSQL<br />\n<b>Servidor:</b> eg localhost o db.isp.com<br />\n<b>Nombre:</b> nombre de la base de datos, eg moodle<br />\n<b>Usuario:</b> usuario de la base de datos<br />\n<b>Contraseña:</b> contraseña de la base de datos<br />\n<b>Prefijo de tablas:</b> prefijo para usar con todas las tablas (obligatorio)';
$string['databasesettingswillbecreated'] = '<b>Nota:</> el instalador tratará de crear la base de datos en el caso de que no exista.';
$string['databasetypehead'] = 'Seleccione el controlador de la base de datos';
$string['databasetypesub'] = 'Moodle soporta varios tipos de servidores de base de datos. Por favor, póngase en contacto con el administrador del servidor si no sabe qué tipo usar.';
$string['databaseuser'] = 'Usuario de la base de datos';
$string['dataroot'] = 'Directorio de Datos';
$string['datarooterror'] = 'El \'Directorio de Datos\' no pudo ser encontrado o creado. Corrija la ruta o cree el directorio manualmente.';
$string['datarootpublicerror'] = 'El \'Directorio de datos\' que ha especificado es directamente accesible vía web: debe utilizar un directorio diferente.';
$string['dbconnectionerror'] = 'Error de conexión con la base de datos. Por favor, compruebe los ajustes de la base de datos.';
$string['dbcreationerror'] = 'Error al crear la base de datos. No se ha podido crear la base de datos con el nombre y ajustes suministrados';
$string['dbhost'] = 'Servidor';
$string['dbpass'] = 'Contraseña';
$string['dbprefix'] = 'Prefijo de tablas';
$string['dbtype'] = 'Tipo';
$string['dbwrongencoding'] = 'La base de datos seleccionada está ejecutándose bajo una codificación no recomendada ({$a}). Convendría usar en su lugar una base de datos con codificación Unicode (UTF-8). En cualquier caso, usted puede pasar por alto esta prueba seleccionando "Pasar por alto la prueba de codificación BD", si bien tal vez tenga problemas en el futuro.';
$string['dbwronghostserver'] = 'Debe seguir las reglas "Host" tal como se explicó más arriba.';
$string['dbwrongnlslang'] = 'La variable contextual NLS_LANG de su servidor web debe usar el conjunto de caracteres AL32UTF8. Revise la documentación PHP para ver cómo se configura adecuadamente OCI8.';
$string['dbwrongprefix'] = 'Debe seguir las reglas "Prefijo de Tablas" como se explicó más arriba.';
$string['directorysettings'] = '<p>Por favor, confirme las direcciones de la instalación de Moodle.</p>\n\n<p><b>Dirección Web:</b>\nEspecifique la dirección web completa en la que se accederá a Moodle. Si su sitio web es accesible a través de varias URLs, seleccione la que resulte de acceso más natural a sus estudiantes. No incluya la diagonal invertida final ().</p>\n<p><b>Directorio de Moodle:</b>\nEspecifique la ruta completa de esta instalación. Asegúrese de que las mayúsculas/minúsculas son correctas.\n<p><b>Directorio de datos:</b>\nUsted necesita un lugar en el que Moodle pueda guardar los archivos subidos. Este directorio debe ser leible Y ESCRIBIBLE por el usuario del servidor web (normalmente \'nobody\', \'apache\', \'www-data\'), pero no debería ser directamente accesible desde la web. El instalador tratará crearlo si no existe.</p>';
$string['directorysettingshead'] = 'Por favor, confirme las siguientes direcciones de la instalación de Moodle';
$string['directorysettingssub'] = '<b>Dirección Web:</b>\nEspecifique la dirección web completa en la que se accederá a Moodle.\nSi su sitio es accesible desde diferentes URLs entonces elija\nla más natural que sus estudiantes deberían utilizar. No incluya la diagonal invertida final ().\n<br />\n<br />\n<b>Directorio Moodle:</b>\nEspecifique la ruta completa de esta instalación. Asegúrese de que las mayúsculas/minúsculas son correctas.\n<br />\n<br />\n<b>Directorio de Datos:</b>\nUsted necesita un lugar donde Moodle puede guardar los archivos subidos. Este directorio debe ser leíble Y ESCRIBIBLE por el usuario del servidor web (por lo general \'nobody\', \'apache\' o \'www-data\'), pero este lugar no debe ser accesible directamente a través de la web. El instalador tratará crearlo si no existe.';
$string['dirroot'] = 'Directorio Moodle';
$string['dirrooterror'] = 'El \'Directorio de Moodle\' parece incorrecto. No se puede encontrar una instalación de Moodle. El valor ha sido restablecido.';
$string['download'] = 'Descargar';
$string['downloadlanguagebutton'] = 'Descargar el paquete de idioma "{$a}"';
$string['downloadlanguagehead'] = 'Descargar paquete de idioma';
$string['downloadlanguagenotneeded'] = 'Puede continuar el proceso de instalación con el idioma por defecto, "{$a}".';
$string['downloadlanguagesub'] = 'Ahora tiene la opción de descargar su paquete de idioma y continuar con el proceso de instalación en ese idioma.<br /><br />Si no es posible la descarga el proceso de instalación continuará en inglés (una vez que la instalación haya finalizado, tendrá la oportunidad de descargar e instalar otros idiomas adicionales).';
$string['downloadsuccess'] = 'Language Pack descargado con éxito';
$string['doyouagree'] = '¿Está de acuerdo? (sí/no):';
$string['environmenthead'] = 'Comprobando su entorno';
$string['invalidemail'] = 'Email no válido';
$string['invalidhost'] = 'Host no válido';
$string['invalidpath'] = 'Ruta no válida';
$string['invalidtextvalue'] = 'Valor no válido de texto';
$string['invalidurl'] = 'URL no válida';
$string['selectlanguage'] = 'nnSelecionando un idioma para instalación';
$string['sessionautostarthelp'] = '<p>Moodle requiere apoyo de sesión y no funcionará sin él.</p>\n\n<p>Las sesiones deben estar activadas en el archivo php.ini para el parámetro session.auto_start.</p>';
$string['sitefullname'] = 'Nombre completo del sito:';
$string['siteinfo'] = 'Detalles del sitio:';
$string['sitenewsitems'] = 'Nuevos datos:';
$string['siteshortname'] = 'Nombre corto del sitio:';
$string['sitesummary'] = 'Resumen del sitio:';
