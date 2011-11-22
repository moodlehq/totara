<?php
// enrol_dbpositions.php - created with Totara langimport script version 1.1

$string['dbhost'] = 'Nombre o número IP del servidor';
$string['dbname'] = 'Nombre de la base de datos';
$string['dbpass'] = 'Contraseña del servidor';
$string['dbtable'] = 'Tabla de la base de datos';
$string['dbtype'] = 'Tipo de base de datos';
$string['dbuser'] = 'Usuario del servidor';
$string['description'] = 'Puede utilizar una base de datos externa (de casi cualquier tipo) para llevar el control de las relaciones entre usuarios. Se asume que su base de datos externa contiene un campo con dos ID de usuario y un ID de función. Estos se comparan con los campos que usted elija en las tablas de usuario y función locales';
$string['enrolname'] = 'Base de datos externa (Relaciones entre usuarios)';
$string['localobjectuserfield'] = 'El nombre del campo en la tabla de usuario que estamos utilizando para buscar coincidencias de entradas en la base de datos remota (p. ej. númerodeid) para la asignación de función de <i>objeto</i>.';
$string['localorgfield'] = 'El nombre del campo en la tabla de la organización que utilizamos para hacer concordar las entradas en la base de datos remota (p. ej. número de id).';
$string['localposfield'] = 'El nombre del campo en la tabla de posición que estamos usando para hacer concordar las entradas en la base de datos remota (p. ej. número de id).';
$string['localrolefield'] = 'El nombre del campo en la tabla de funciones que estamos utilizando para buscar coincidencias de entradas en la base de datos remota (p. ej. nombrecorto).';
$string['localsubjectuserfield'] = 'El nombre del campo en la tabla de usuario que estamos utilizando para buscar coincidencias de entradas en la base de datos remota (p. ej. númerodeid) para la asignación de función de <i>sujeto</i>.';
$string['postypefield'] = 'Campo tipo de posición - El nombre del campo en la tabla externa que describe qué tipo de posición ha de crearse - primaria/secundaria/ideal. Si no se especifica, se asumirá que todas las filas se relacionarán con las relaciones primarias entre usuarios .';
$string['remote_fields_mapping'] = 'Mapeo de campos de la base de datos';
$string['remoteobjectuserfield'] = 'El nombre del campo en la tabla remota que estamos utilizando para buscar coincidencias de entradas en la tabla de usuario para la asignación de función de <i>objeto</i>';
$string['remoteorgfield'] = 'El nombre del campo en la tabla remota que utilizamos para hacer concordar las entradas en las organizaciones de la base de datos (p. ej. equipo).';
$string['remoteposfield'] = 'El nombre del campo en la tabla remota que utilizamos para hacer concordar las entradas en la tabla de posición (p. ej. posición) .';
$string['remoterolefield'] = 'El nombre del campo en la tabla remota que estamos utilizando para buscar coincidencias de entradas en la tabla de funciones.';
$string['remotesubjectuserfield'] = 'El nombre del campo en la tabla remota que estamos utilizando para buscar coincidencias de entradas en la tabla de usuario para la asignación de función de <i>sujeto</i>';
$string['roleshortname'] = 'El nombre corto del rol que debe asignarse al gestor en el contexto del miembro del personal.';
$string['server_settings'] = 'Configuración del servidor de la base de datos externa';
$string['shortnamefield'] = 'El nombre del campo en la tabla remota que ha de utilizarse como el nombre corto de las relaciones entre usuarios.';
$string['useauthdb'] = 'Utilice la misma configuración para la conexión a la base de datos que utiliza el plugin de autenticación de la base de datos (todavía tendrá que especificar el nombre de la tabla)';
$string['useenroldatabase'] = 'Utilice la misma configuración para la conexión a la base de datos que utiliza el plugin de inscripción de la base de datos (todavía tendrá que especificar el nombre de la tabla)';

?>
