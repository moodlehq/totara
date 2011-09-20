<?php

// All of the language strings in this file should also exist in
// auth.php to ensure compatibility in all versions of Moodle.

$string['auth_dbdescription'] = 'Este método utiliza una tabla de una base de datos externa para comprobar si un determinado usuario y contraseña son válidos. Si la cuenta es nueva, la información de otros campos puede también ser copiada en Moodle.';
$string['auth_dbextrafields'] = 'Estos campos son opcionales. Usted puede elegir pre-rellenar algunos campos del usuario de Moodle con información desde los <strong>campos de la base de datos externa</strong> que especifique aquí. <p>Si deja esto en blanco, se tomarán los valores por defecto</p>.<p>En ambos casos, el usuario podrá editar todos estos campos después de entrar</p>.';
$string['auth_dbfieldpass'] = 'Nombre del campo que contiene las contraseñas';
$string['auth_dbfielduser'] = 'Nombre del campo que contiene los nombres de usuario';
$string['auth_dbhost'] = 'El ordenador que hospeda el servidor de la base de datos.';
$string['auth_dbname'] = 'Nombre de la base de datos';
$string['auth_dbpass'] = 'La contraseña correspondiente al nombre de usuario anterior';
$string['auth_dbpasstype'] = 'Especifique el formato que usa el campo de contraseña. La encriptación MD5 es útil para conectar con otras aplicaciones web como PostNuke.';
$string['auth_dbtable'] = 'Nombre de la tabla en la base de datos';
$string['auth_dbtitle'] = 'Usar una base de datos externa';
$string['auth_dbtype'] = 'El tipo de base de datos (Vea la <a href=\"../lib/adodb/readme.htm#drivers\">documentación de ADOdb</a> para obtener más detalles)';
$string['auth_dbuser'] = 'Usuario con acceso de lectura a la base de datos';