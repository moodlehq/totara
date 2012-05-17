<?php
// totara_cohort.php - created with Totara langimport script version 1.1

$string['abouttocreate'] = 'Esta por crear un nuevo cohorte llamado "{$a}"';
$string['addcohort'] = 'Crear un cohorte nuevo';
$string['anycohort'] = 'Cualquiera';
$string['assign'] = 'Asignar';
$string['assignmemberstocohort'] = 'Asignar miembros al cohorte';
$string['assignto'] = '\'{$a}\' miembros del cohorte';
$string['backtocohorts'] = 'Volver a los cohortes';
$string['cannoteditcohort'] = 'No se puede editar este cohorte luego de ser creado';
$string['childrenincluded'] = 'hijos incluidos';
$string['clear'] = 'Borrar';
$string['cohort'] = 'Cohorte';
$string['cohort:assign'] = 'Asignar miembros del cohorte';
$string['cohort:manage'] = 'Ajustar cohortes';
$string['cohort:view'] = 'Utilizar cohortes y ver miembros';
$string['cohortmembers'] = 'Miembros del cohorte';
$string['cohorts'] = 'Cohortes';
$string['cohortsin'] = 'Cohortes disponibles';
$string['component'] = 'Fuente';
$string['confirmdynamiccohortcreation'] = 'Confirmar la creación dinámica de cohortes';
$string['createdynamiccohort'] = 'Crear un cohorte dinámico';
$string['createnewcohort'] = 'Crear un nuevo cohorte';
$string['criteria'] = 'Criterios';
$string['criteriaoptional'] = 'Todos los criterios son opcionales pero debe seleccionar una opción al menos.';
$string['currentusers'] = 'Usuarios actuales';
$string['currentusersmatching'] = 'Los usuarios actuales que concuerdan';
$string['delcohort'] = 'Eliminar cohorte';
$string['delconfirm'] = '¿Realmente quiere eliminar el cohorte \'{$a}\'?';
$string['deletethiscohort'] = 'Eliminar este cohorte';
$string['description'] = 'Descripción';
$string['duplicateidnumber'] = 'Ya existe un cohorte con el mismo número ID';
$string['dynamic'] = 'Dinámico';
$string['dynamiccohortcriteria'] = 'Criterios Dinámicos del Cohorte';
$string['dynamiccohortcriterialower'] = 'Criterios dinámicos del cohorte';
$string['editcohort'] = 'Editar cohorte';
$string['editdetails'] = 'Editar detalles';
$string['editmembers'] = 'Editar miembros';
$string['failedtodeleted'] = 'No se pudo eliminar el cohorte';
$string['idnumber'] = 'ID';
$string['includechildren'] = 'Incluir hijos';
$string['members'] = 'Miembros';
$string['memberscount'] = 'Tamaño';
$string['mustselectonecriteria'] = 'Debe seleccionar al menos un criterio';
$string['name'] = 'Nombre';
$string['nocomponent'] = 'Creado manualmente';
$string['nocriteriaset'] = '(no se configuraron los criterios, elimine este cohorte)';
$string['notvalidprofilefield'] = 'Por favor seleccione un campo de perfil válido';
$string['organisation'] = 'Organización';
$string['overview'] = 'Panorama';
$string['pleasesearchmore'] = 'Por favor haga la búsqueda más específica';
$string['pleaseusesearch'] = 'Por favor utilice la búsqueda';
$string['position'] = 'Posición';
$string['potusers'] = 'Usuarios potenciales';
$string['potusersmatching'] = 'Usuarios potenciales que pueden concordar';
$string['role'] = 'Rol';
$string['selectfromcohort'] = 'Seleccionar miembros del cohorte';
$string['set'] = 'Activado';
$string['successfullyaddedcohort'] = 'Cohorte agregado exitosamente';
$string['successfullydeleted'] = 'Cohorte eliminado exitosamente';
$string['successfullyupdated'] = 'Cohorte actualizado exitosamente';
$string['thiscohortwillhave'] = 'Este cohorte tendrá {$a} miembros en este punto del tiempo';
$string['toomanyusersmatchsearch'] = 'Demasiados usuarios concuerdan con la búsqueda';
$string['toomanyuserstoshow'] = 'Hay demasiados usuarios para mostar';
$string['type'] = 'Tipo';
$string['userprofilefield'] = 'Utilizar el campo del usuario';
$string['values'] = 'valores';
$string['viewmembers'] = 'Ver miembros';
$string['type_help'] = '<h1>Tipo de cohortes</h1>

<p>El tipo de cohorte puede ser "configurado" o "dinámico"</p>
<p>Los cohortes configurados son una lista predeterminada de usuarios, manualmente diseñada por el creador del cohorte. El creador solo puede añadir o eliminar a los usuarios, el resto de las características son estáticas.</p>
<p>Los cohortes dinámicos están determinados por una regla o conjunto de ellas, y los usuarios incluidos en él podrán hacer actualizaciones dinámicas incluyendo a usuarios que concuerden con esas reglas (y eliminar a usuarios que ya no lo hagan).</p>
<p>Se pueden cambiar los miembros de un cohorte configurado cuando desee, pero las reglas que definen a un cohorte dinámico no pueden ser cambiadas una vez que el cohorte se ha guardado.</p>';
$string['profilefieldvalues_help'] = '<h1>Valores del campo del perfil del cohorte</h1>

<p>Si se selecciona, se podrán elegir los miembros del cohorte dinámico si tienen un perfil del usuario que concuerde con un valor particular.</p>
<p> Los valores pueden ser una cadena de texto simple, una lista separada por comas o varias cadenas de texto. SI se proporciona una lista separada por comas, se incluirán en el cohorte los usuarios que concuerden con cualquiera de las cadenas individuales.</p>';
$string['positionincludechildren_help'] = '<h1>Cohorte que incluye las posiciones hijas</h1>

<p>Si se selecciona la casilla de verificación de "Incluir hijos", se incluirán en este cohorte todos los usuarios en la posición seleccionada, y en cualquiera de las posiciones inferiores a la seleccionada en la jerarquía.</p>
<p>Si no se selecciona "Incluir hijos", solo se asignarán al cohorte los usuarios que formen parte de la misma posición seleccionada.</p>';
$string['orgincludechildren_help'] = '<h1>El cohorte incluye la organización hija</h1>

<p>Si se selecciona la casilla de verificación de "Incluir hijos", se incluirán en este cohorte todos los usuarios en la organización seleccionada, y en cualquiera de las organizaciones inferiores a la seleccionada en la jerarquía.</p>
<p>Si no se selecciona "Incluir hijos", solo se asignarán al cohorte los usuarios que formen parte de la misma organización seleccionada.</p>';

?>
