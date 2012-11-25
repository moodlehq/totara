<?php

/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2012 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * Strings for component 'totara_program', language 'es', branch 'totara-2.2'
 * @package totara
 * @subpackage totara_program
 */

$string['action'] = 'Acción';
$string['addcohortstoprogram'] = 'Añadir cohortes al programa';
$string['addcohorttoprogram'] = 'Añadir cohorte al programa';
$string['addcompetency'] = 'Añadir competencia';
$string['addcourse'] = 'Añadir curso';
$string['addcourses'] = 'Añadir cursos';
$string['addindividualstoprogram'] = 'Añadir individuos al programa';
$string['addindividualtoprogram'] = 'Añadir individuo al programa';
$string['addmanagerstoprogram'] = 'Añadir gestores al programa';
$string['addmanagertoprogram'] = 'Añadir gestor al programa';
$string['addnew'] = 'Añadir uno nuevo';
$string['addnewprogram'] = 'Añadir un programa nuevo';
$string['addorganisationstoprogram'] = 'Añadir organizaciones al programa';
$string['addorganisationtoprogram'] = 'Añadir organización al programa';
$string['addorremovecourses'] = 'Añadir/eliminar cursos';
$string['addpositiontoprogram'] = 'Añadir posición al programa';
$string['addprogramcontent_help'] = '# Añadir el contenido del programa
Agregando conjuntos de cursos, puede abrirse camino en la ruta del aprendizaje del programa. Una vez que los conjuntos se añadieron, se pueden definir las relaciones entre ellos. Se pueden crear los conjuntos añadiéndolos manualmente, seleccionando una competencia predefinida o configurando un curso sencillo con recurrencia.
Una vez que una cantidad de conjuntos se haya creado, se utilizarán los divisores del conjunto para permitir la creación de secuencias (es decir, dependencias) entre cada conjunto. Un ejemplo del programa con cuatro conjunto de cursos definidos, podría tener las siguientes dependencias:
* Desde el conjunto uno, el aprendiz debe completar un curso (cursoA o cursoB) antes de proceder al conjunto dos.
* Desde el conjunto dos, el aprendiz debe completar todos los cursos (cursoC, cursoD y cursoE) antes de proceder al conjunto tres o cuatro.
* Desde el congunto tres, el aprendiz debe completar un curso (cursoE) o todos los cursos del conjunto cuatro (cursoF y cursoG).
Una vez que la ruta del aprendizaje está completada, el aprendiz ha terminado el programa.
Se pueden crear conjuntos añadiendo:
## Conjuntos de cursos
Permite la creación de conjuntos múltiples de cursos con dependencias.
## Competencia
Permite la creación de conjuntos múltiples de cursos desde una evidencia de competencias predefinida. Cuando una competencia es utilizada para crear un conjunto, ésta se transforma en rígida y no puede ser cambiada.
## Curso sencillo
Obliga la asignación de un curso sencillo con recurrencia.
Una vez que se selecciona un conjunto de cursos o una competencia, el curso sencillo con recurrencia es eliminado de la lista.';
$string['affectedusercount'] = 'Número de alumnoS afectados por este cambio:';
$string['allbelow'] = 'Todos los de abajo';
$string['allbelowlower'] = 'todos los de abajo';
$string['allcompletiontimeunknownissues'] = 'Todos los problemas desconocidos de tiempo de realización';
$string['allcourses'] = 'Todos los cursos';
$string['allcoursesfrom'] = 'todos los cursos desde';
$string['allcurrentlyassignedissues'] = 'Todos los problemas actualmente asignados';
$string['allextensionrequestissues'] = 'Todos los problemas de extensión requeridas';
$string['alllearners'] = 'Todos los alumnos';
$string['allowedtimeforprogramaslearner'] = 'Tiene permiso {$a->num} {$a->periodstr} para completar este programa.';
$string['allowedtimeforprogramasmanager'] = '{$a->fullname} tiene permiso {$a->num} {$a->periodstr} para completar este programa.';
$string['allowedtimeforprogramviewing'] = 'Un alumno tiene permiso {$a->num} {$a->periodstr} para completar este programa.';
$string['allowtimeforprogram'] = 'Permita a {$a->num} {$a->periodstr} completar este programa.';
$string['allowtimeforset'] = 'Permita a {$a->num} {$a->periodstr} completar este conjunto.';
$string['alltimeallowanceissues'] = 'Todos los problemas de asignación de tiempo';
$string['and'] = 'y';
$string['anothercourse'] = 'otro curso';
$string['areyousuredeletemessage'] = '¿Está seguro de que quiere eliminar este mensaje?';
$string['assignmentcriterialearner'] = 'Debe completar este programa siguiendo los siguientes criterios:';
$string['assignmentcriteriamanager'] = 'El alumno debe completar este programa siguiendo los siguientes criterios:';
$string['assignments'] = 'Tareas';
$string['availability'] = 'Disponibilidad';
$string['availablefrom'] = 'Disponible desde';
$string['availabletostudents'] = 'Disponible para estudiantes';
$string['availabletostudentsnot'] = 'No está disponible para estudiantes';
$string['availableuntil'] = 'Disponible hasta';
$string['backtoallextrequests'] = 'Volver a las todas solicitudes de extensión';
$string['beforecourseends'] = 'antes de que termine el curso';
$string['browsecategories'] = 'Buscar categorías';
$string['cancel'] = 'Cancelar';
$string['cancelprogramblurb'] = 'Cancelar eliminará cualquier cambio no guardado';
$string['cancelprogrammanagement'] = 'Borrar cambios no guardados';
$string['category'] = 'Categoría';
$string['changecourse'] = 'Cambiar el curso';
$string['checkprogramdelete'] = '¿Está seguro de que quiere eliminar este programa y todos sus elementos relacionados?';
$string['chooseicon'] = 'Seleccione un icono para insertar';
$string['chooseitem'] = 'Seleccionar elemento';
$string['choseautomaticallydetermine'] = 'Ha seleccionado permitir que el sistema determine automáticamente un límite de tiempo realista para la realización de este programa';
$string['chosedenyextensionexception'] = 'Ha seleccionado denegar la(s) solicitud(es) de extensión seleccionadas';
$string['chosedismissexception'] = 'Ha seleccionado descartar esta excepción';
$string['chosegrantextensionexception'] = 'Ha seleccionado otorgar la(s) solicitud(es) de extensión seleccionadas';
$string['choseoverrideexception'] = 'Ha seleccionado pasar por alto la excepción y continuar con la tarea';
$string['cohort'] = 'Cohorte';
$string['cohortname'] = 'Nombre del cohorte';
$string['cohorts'] = 'Cohortes';
$string['cohorts_category'] = 'cohort(es)';
$string['competency'] = 'Competencia';
$string['competencycourseset_help'] = '# Conjunto de curso de competencia
Se ha creado este conjunto desde una competencia predefinida.
Cuando se usa una competencia para crear un conjunto, se transforma en rígida y no puede ser cambiada. No se pueden editar los cursos dentro del conjunto. Si los cursos dentro de este conjunto necesitan ser modificados, se debe crear un conjunto manual de cursos, donde los cursos se añadirán individualmente.
Las opciones del operador dentro de un conjunto de curso de competencia ("un curso" o "todos los cursos") son determinadas por una configuración de competencia predefinida.';
$string['complete'] = 'Completar';
$string['completeallcourses'] = 'Todos los cursos en este conjunto deben ser completados (a menos que sea un conjunto opcional).';
$string['completeanycourse'] = 'Cualquier curso en este conjunto debe ser completado.';
$string['completeby'] = 'Completar cerca del';
$string['completebytime'] = 'Completar cerca del {$a}';
$string['completewithin'] = 'Completar dentro de';
$string['completewithinevent'] = 'Completar dentro  {$a->num} {$a->period} de {$a->event} {$a->instance}';
$string['completioncriteria'] = 'Criterios de realización';
$string['completiondate'] = 'Fecha de realización';
$string['completionstatus'] = 'Estado';
$string['completiontimeunknown'] = 'Tiempo de realización desconocido';
$string['completiontype_help'] = '# Tipo de competencia
Las opciones del operador ("El aprendiz debe estar completo") dentro de un conjunto son "un curso", que significa O, o "todos los cursos", que significa Y. La idea es mantener el flujo lo más legible posible. Dependiendo en la opción que se seleccione, el texto adelante de los cursos cambia automáticamente.';
$string['confirmassignmentchanges'] = 'Confirmar cambios de tarea';
$string['confirmcontentchanges'] = 'Confirmar cambios de contenido';
$string['confirmmessagechanges'] = 'Confirmar cambios de mensaje';
$string['confirmresolution'] = 'Confirmar resolución del problema';
$string['content'] = 'Contenido';
$string['contentupdatednotsaved'] = 'Se actualizó el contenido del programa (aún no está guardado)';
$string['continue'] = 'Continuar';
$string['couldnotinsertnewrecord'] = 'No se puede insertar el registro nuevo';
$string['course'] = 'Curso';
$string['coursecompletion'] = 'Realización del curso';
$string['coursecreation_help'] = '# Creación del curso
La creación del curso define cuándo se debe copiar y recrear el curso.
Se basa en la fecha de inicio y finalización especificada en la configuración del curso.';
$string['coursename'] = 'Nombre del curso';
$string['coursenamelink'] = 'Nombre del curso';
$string['courses'] = 'Cursos';
$string['coursesetcompleted'] = 'Conjunto del curso completado';
$string['coursesetcompletedmessage_help'] = '# Mensaje de realización del conjunto del curso
Se enviará este mensaje siempre que se complete un conjunto del curso.';
$string['coursesetdue'] = 'Conjunto del curso caducado';
$string['coursesetduemessage_help'] = '# Mensaje de caducidad del conjunto del curso
Se enviará este mensaje a una hora especificada antes de la caducidad de un conjunto del curso.';
$string['coursesetoverdue'] = 'Conjunto del curso retrasado';
$string['coursesetoverduemessage_help'] = '# Mensaje de retraso del conjunto del curso
Se enviará este mensaje a una hora especificada luego de la caducidad de un conjunto del curso.';
$string['createandnext'] = 'Crear e ir al siguiente paso';
$string['createandreturn'] = 'Crear y regresar a panorama';
$string['createcourse'] = 'Crear curso';
$string['createnewprogram'] = 'Crear programa nuevo';
$string['createprogram'] = 'Crear programa';
$string['currentduedate'] = 'Fecha actual de caducidad';
$string['currenticon'] = 'Ícono actual';
$string['currentlyassigned'] = 'ASignado actualmente';
$string['days'] = 'Día(s)';
$string['daysremaining'] = 'Quedan {$a} días';
$string['defaultenrolmentmessage_message'] = 'ahora está alistado en el programa %programfullname%.';
$string['defaultenrolmentmessage_subject'] = 'Ha sido alistado en el programa %programfullname%';
$string['defaultexceptionreportmessage_message'] = 'Hay excepciones en el programa %programfullname% que necesitan ser resueltas';
$string['defaultexceptionreportmessage_subject'] = 'Se necesita atención para las excepciones en el programa %programfullname%';
$string['defaultprogramfullname'] = 'Nombrecompleto del programa 101';
$string['defaultprogramshortname'] = 'P101';
$string['delete'] = 'Eliminar';
$string['deletecourse'] = 'Eliminar curso';
$string['deleteprogram'] = 'Eliminar programa "{$a}"';
$string['deleteprogrambutton'] = 'Eliminar programa';
$string['deny'] = 'Denegar';
$string['denyextensionrequest'] = 'Denegar solicitud de extensión';
$string['description'] = 'Descripción';
$string['details'] = 'Detalles';
$string['directteam'] = 'equipo directo';
$string['dismissandtakenoaction'] = 'Descartar y no tomar medidas';
$string['duedate'] = 'Fecha de caducidad';
$string['duedatenotset'] = 'No se ha configurado la fecha de caducidad';
$string['duestatus'] = 'Caducidad/Estado';
$string['editassignments'] = 'Editar tareas';
$string['editcontent'] = 'Editar contenido';
$string['editmessages'] = 'Editar mensajes';
$string['editprogramassignments'] = 'Editar tareas del programa';
$string['editprogramcontent'] = 'Editar contenido del programa';
$string['editprogramdetails'] = 'Editar detalles del programa';
$string['editprogrammessages'] = 'Editar mensajes del programa';
$string['editprogramroleassignments'] = 'Editar tareas del rol del programa';
$string['editprograms'] = 'Añadir/editar programas';
$string['endnote'] = 'Nota de final de programa';
$string['enrolmentmessage_help'] = '# Mensaje de inscripción
Se enviará este mensaje siempre que un usuario sea asignado automáticamente a un programa.';
$string['error:availibileuntilearlierthanfrom'] = 'Disponible hasta la fecha. No puede ser anterior que desde la fecha';
$string['error:badcheckvariable'] = 'La variable de revisión era incorrecta - inténtelo nuevamente';
$string['error:cannotrequestextnotuser'] = 'No puede solicitar una extensión para otro usuario';
$string['error:couldnotloadextension'] = 'Error, no se puede cargar la extensión.';
$string['error:coursecreation_nonzero'] = 'La creación del curso debe ser mayor a cero días antes de que termine el curso';
$string['error:courses_endenroldate'] = 'Debe configurar una fecha de finalización de inscripción para este curso si desea que se repita';
$string['error:courses_nocourses'] = 'Los conjuntos del curso deben tener al menos un curso.';
$string['error:deleteset'] = 'No se pudo eliminar el conjunto. Conjunto no encontrado.';
$string['error:failedsendextensiondenyalert'] = 'Error, no se pudo alertar al usuario de la extensión denegada';
$string['error:failedsendextensiongrantalert'] = 'Error, no se pudo alertar al usuario de la extensión otorgada';
$string['error:failedtofindmanagerrole'] = 'No se pudo encontrar el rol con el gestor nombrecorto';
$string['error:failedtofindstudentrole'] = 'No se pudo encontrar el rol con el estudiante nombrecorto';
$string['error:failedtofinduser'] = 'Error al encontrar el usuario con id {$a}';
$string['error:failedupdateextension'] = 'Error al actualizar el programa con la nueva fecha de caducidad';
$string['error:inaccessible'] = 'Actualmente no puede acceder a este programa';
$string['error:invaliddate'] = 'la fecha es inválida';
$string['error:invalidid'] = 'Ése es un id de programa inválido';
$string['error:invalidshortname'] = 'Ése es un nombre corto inválido de programa';
$string['error:mainmessage_empty'] = 'Se requiere un mensaje';
$string['error:messagesubject_empty'] = 'Se requiere un asunto para el mensaje';
$string['error:nopermissions'] = 'No tiene el permiso necesario para realizar esta operación';
$string['error:noprogramcompletionfound'] = 'No se encontró ningún registro de realización del programa';
$string['error:notusersmanager'] = 'No es el gestor del usuario que solicitó esta extensión';
$string['error:processingextrequest'] = 'Ocurrió un error cuando se procesó la solicitud de extensión';
$string['error:recurrence_nonzero'] = 'La recurrencia debe ser mayor a cero';
$string['error:setunableaddcompetency'] = 'No se pudo añadir la competencia al conjunto. Conjunto o competencia no encontrados.';
$string['error:setunabletoaddcourse'] = 'No se pudo añadir el curso al conjunto. Conjunto o curso no encontrados.';
$string['error:setunabletodeletecourse'] = 'No se pudo eliminar el curso del conjunto {$a}';
$string['error:setupprogcontent'] = 'No se pudo configurar el contenido del programa.';
$string['error:timeallowednum_nonzero'] = 'La asignación del tiempo debe ser mayor a cero';
$string['error:unabletoaddset'] = 'No se puede añadir un conjunto nuevo. El tipo del conjunto no se reconoce.';
$string['error:unabletosetupprogcontent'] = 'No se puede configurar el contenido del programa.';
$string['error:updateextensionstatus'] = 'Error al actualizar el estado de la extensión';
$string['errorsinform'] = 'Hay errores en este formulario. Por favor revea la lista de abajo y corrija cualquier error antes de guardar.';
$string['eventnotfound'] = 'No se pudo encontrar el evento de la tarea del programa con el id {$a}';
$string['exceptionreportmessage_help'] = '# Mensaje de informe de excepción
Se enviará este mensaje al administrador del sitio siempre que se añadan nuevas excepciones al informe de excepción del programa.';
$string['exceptions'] = 'Informe de excepción ({$a})';
$string['exceptionsreport'] = 'Informe de excepciones';
$string['extenduntil'] = 'Extendido hasta';
$string['extensionbeforenow'] = 'No se puede solicitar una extensión anterior a la fecha actual';
$string['extensiondate'] = 'Fecha de extensión';
$string['extensiondenied'] = 'Extensión denegada';
$string['extensiondeniedmessage'] = 'Su solicitud por una extensión fue rechazada.';
$string['extensionearlierthanduedate'] = 'No se puede solicitar una extensión anterior a la fecha de caducidad actual del programa';
$string['extensiongranted'] = 'Extensión otorgada';
$string['extensiongrantedmessage'] = 'Se le ha otorgado una extensión hasta {$a}.';
$string['extensionrequest'] = 'Solicitud de extensión';
$string['extensionrequestfailed'] = 'La solicitud de extensión falló. Por favor inténtelo nuevamente.';
$string['extensionrequestfailed:nomanager'] = 'La solicitud de extensión no fue enviada. No se encontró el gestor';
$string['extensionrequestmessage'] = '<p>Un usuario solicitó una extensión para el programa <em>{$a->programfullname}</em>. Los detalles de la solicitud son:</p><ul><li>Fecha: {$a->extensiondatestr}</li><li>Razón: {$a->extensionreason}</li></ul>';
$string['extensionrequestmessage_help'] = '# Mensaje de solicitud de extensión
Se enviará este mensaje al gestor del estudiante siempre que se solicite una extensión del programa.';
$string['extensionrequestnotsent'] = 'La solicitud de extensión NO se pudo enviar. Por favor inténtelo nuevamente.';
$string['extensionrequestsent'] = 'La solicitud de extensión se envió correctamente';
$string['extensions'] = 'Extensiones';
$string['failedtoresolve'] = 'Error al resolver las siguientes excepciones';
$string['findprograms'] = 'Encontrar programas';
$string['firstlogin'] = 'Primer acceso';
$string['for'] = 'Para';
$string['fullname'] = 'Nombre completo';
$string['grant'] = 'Otorgar';
$string['grantdeny'] = 'Otorgar / Denegar';
$string['grantextensionrequest'] = 'Otorgar la solicitud de extensión';
$string['header:hash'] = '#';
$string['header:id'] = 'ID';
$string['header:issue'] = 'Problema';
$string['header:learners'] = 'Alumnos';
$string['hours'] = 'Hora(s)';
$string['icon'] = 'Ícono';
$string['idnumberprogram'] = 'ID';
$string['incomplete'] = 'No está completo';
$string['individualname'] = 'Nombre individual';
$string['individuals'] = 'Individuos';
$string['individuals_category'] = 'individuo(s)';
$string['instructions:assignments1'] = 'Se puede utilizar las categorías para que el programa sea asignado a un conjunto de alumnos.';
$string['instructions:messages1'] = 'Configure el evento y las señales de aviso asociadas con el programa.';
$string['instructions:programassignments'] = 'Asigne a los alumnos en masa y configure criterios de realización fijos o relativos <br />(Asigne a los aprendices en organización, posición, cohorte, jerarquía o individuo)';
$string['instructions:programcontent'] = 'Defina el contenido del programa añadiendo conjuntos de cursos y / o competencias';
$string['instructions:programdetails'] = 'Defina el nombre del programa, disponibilidad y descripción';
$string['instructions:programexceptions'] = 'Resuelva rápidamente los problemas de tareas seleccionando "tipo" y aplicando una "medida"';
$string['instructions:programmessages'] = 'Defina los mensajes del programa y avisos tal como sea requerido';
$string['label:competencyname'] = 'Nombre de la competencia';
$string['label:coursecreation'] = 'Cuándo crear un curso nuevo';
$string['label:learnermustcomplete'] = 'El alumnos debe completar';
$string['label:message'] = 'Mensaje';
$string['label:nextsetoperator'] = 'Próximo operador de conjunto';
$string['label:noticeformanager'] = 'Preaviso para el gestor';
$string['label:recurcreation'] = 'Creación del curso';
$string['label:recurrence'] = 'Recurrencia';
$string['label:sendnoticetomanager'] = 'Enviar preaviso al gestor';
$string['label:setname'] = 'Fijar nombre';
$string['label:subject'] = 'Asunto';
$string['label:timeallowance'] = 'Asignación de tiempo';
$string['label:trigger'] = 'Señal';
$string['launchcourse'] = 'Inicializar curso';
$string['launchprogram'] = 'Inicializar programa';
$string['learnerenrolled'] = 'Alumno inscrito';
$string['learnerfollowup'] = 'Seguimiento del aprendiz';
$string['learnerfollowupmessage_help'] = '# Mensaje de seguimiento
Se enviará este mensaje al estudiante a una hora especificada luego de que se haya completado el programa.';
$string['learnersassigned'] = '{$a->total} de aprendices asignados. {$a->assignments} aprendices están activos, {$a->exceptions} con excepcion(es)';
$string['learnersselected'] = 'aprendices seleccionados';
$string['learnerunenrolled'] = 'Aprendiz desvinculado';
$string['legend:courseset'] = 'Conjunto del curso {$a}';
$string['legend:coursesetcompletedmessage'] = 'MENSAJE DE COMPLETADO DEL CONJUNTO DEL CURSO';
$string['legend:coursesetduemessage'] = 'MENSAJE DE CADUCIDAD DEL CONJUNTO DEL CURSO';
$string['legend:coursesetoverduemessage'] = 'MENSAJE DE RETRASO DEL CONJUNTO DEL CURSO';
$string['legend:enrolmentmessage'] = 'MENSAJE DE INSCRIPCIÓN';
$string['legend:exceptionreportmessage'] = 'MENSAJE DE INFORME DE EXCEPCIÓN';
$string['legend:extensionrequestmessage'] = 'MENSAJE DE SOLICITUD DE EXTENSIÓN';
$string['legend:learnerfollowupmessage'] = 'MENSAJE DE SEGUIMIENTO DEL ALUMNO';
$string['legend:programcompletedmessage'] = 'MENSAJE DE PROGRAMA COMPLETADO';
$string['legend:programduemessage'] = 'MENSAJE DE CADUCIDAD DE PROGRAMA';
$string['legend:programoverduemessage'] = 'MENSAJE DE RETRASO DE PROGRAMA';
$string['legend:recurringcourseset'] = 'Conjunto recurrente del curso';
$string['legend:unenrolmentmessage'] = 'MENSAJE DE DESCVINCULAMIENTO';
$string['mainmessage_help'] = '# Cuerpo del mensaje
Se mostrará el cuerpo del mensaje a sus receptores en sus tableros de control.
El cuerpo del mensaje puede contener variables que serán remplazadas cuando el mensaje sea enviado.';
$string['manageextensionrequests'] = 'Ver el informe de excepción para otorgar o denegar las solicitudes de extensión';
$string['manageextensions'] = 'Ajustar extensiones';
$string['managementhierarchy'] = 'Ajustar jerarquía';
$string['managermessage_help'] = '# Aviso para el gestor
Si se selecciona la casilla de "Enviar aviso al gestor". el gestor del receptor del mensaje también recibirá una notificación que puede ser especificada en este campo.
El aviso para el gestor puede contener variables que pueden ser reemplazadas cuando el mensaje es enviado.';
$string['managername'] = 'Ajustar nombre';
$string['managers_category'] = 'equipo(s) de gestoría';
$string['mandatory'] = 'Obligatorio';
$string['messages'] = 'Mensajes';
$string['messagesubject_help'] = '# Asunto del mensaje
Se mostrará el asunto del mensaje a sus receptores en su tablero de control. Máx de 255 caracteres.
El asunto puede contener variables que pueden ser reemplazadas cuando el mensaje es enviado.';
$string['missingshortname'] = 'El nombre corto no se encuentra';
$string['months'] = 'Mes(es)';
$string['movedown'] = 'Mover hacia abajo';
$string['moveselectedprogramsto'] = 'Mover los programas seleccionados a...';
$string['moveup'] = 'Mover hacia arriba';
$string['multicourseset_help'] = '# Conjunto de cursos
Esto es un conjunto de cursos seleccionados individualmente para el catálogo del curso.
Puede definir el nombre del conjunto, ya sea que el Aprendiz deba completar uno o todos los cursos y la asignación de tiempo general para completar el conjunto.';
$string['nocourses'] = 'No hay cursos';
$string['noduedate'] = 'No hay fecha de caducidad';
$string['noextensions'] = 'No tiene personal que tenga solicitudes pendientes de extensión';
$string['noprogramassignments'] = 'El programa no contiene ninguna tarea';
$string['noprogramcontent'] = 'El programa no tiene ningún contenido';
$string['noprogramexceptions'] = 'No hay excepciones';
$string['noprogrammessages'] = 'El programa no contiene ningún mensaje';
$string['noprograms'] = 'No hay programas';
$string['noprogramsfound'] = 'No se encontraron programas con las palabras \'{$a}\'';
$string['noprogramsyet'] = 'No hay programas en esta categoría';
$string['norequiredlearning'] = 'No se requiere aprendizaje';
$string['notavailable'] = 'No está disponible';
$string['notifymanager_help'] = '# Enviar aviso al gestor
Seleccione esta casilla si también quiere mandar un aviso al gestor del receptor del mensaje.';
$string['notmanager'] = 'No es un gestor';
$string['nouserextensions'] = '{$a} no tiene ninguna solicitud pendiente de extensión';
$string['novalidprograms'] = 'No hay programas válidos';
$string['numlearners'] = '# de alumnos';
$string['of'] = 'de';
$string['ok'] = 'Ok';
$string['onecourse'] = 'Un curso';
$string['onecoursesfrom'] = 'un curso desde';
$string['onedayremaining'] = 'Queda 1 día';
$string['or'] = 'o';
$string['organisationname'] = 'Nombre de la organización';
$string['organisations'] = 'Organizaciones';
$string['organisations_category'] = 'Organizacion(es)';
$string['orviewprograms'] = 'o vea los programas en esta categoría ({$a})';
$string['overrideandaddprogram'] = 'Pasar por alto y añadir programa';
$string['overview'] = 'Panorama';
$string['pendingextension'] = 'Actualmente tiene una solicitud pendiente de extensión';
$string['pleaseentervaliddate'] = 'Por favor ingrese una fecha válida del formato {$a}.';
$string['pleaseentervalidreason'] = 'Por favor ingrese una razón válida';
$string['pleaseentervalidunit'] = 'Por favor ingrese una unidad válida entre 0 y 99';
$string['pleasepickaninstance'] = 'Por favor seleccione un elemento';
$string['pleasesetcompletiontimes'] = 'Por favor configure los tiempos de realización para todos los elementos';
$string['positions'] = 'Posiciones';
$string['positions_category'] = 'posicion(es)';
$string['positionsname'] = 'Nombre de las posiciones';
$string['positionstartdate'] = 'Fecha de inicio de la posición';
$string['profilefielddate'] = 'Fecha del campo del perfil';
$string['prog_courseset_completed_message'] = 'Mensaje de completado del conjunto del curso';
$string['prog_courseset_due_message'] = 'Mensaje de caducidad del conjunto del curso';
$string['prog_courseset_overdue_message'] = 'Mensaje de retraso del conjunto del curso';
$string['prog_enrolment_message'] = 'Mensaje de inscripción';
$string['prog_exception_report_message'] = 'Mensaje de informe de excepción';
$string['prog_extension_request_message'] = 'Mensaje de solicitud de extensión';
$string['prog_learner_followup_message'] = 'Mensaje de seguimiento del alumno';
$string['prog_program_completed_message'] = 'Mensaje de programa completado';
$string['prog_program_due_message'] = 'Mensaje de caducidad de programa';
$string['prog_program_overdue_message'] = 'Mensaje de retraso del programa';
$string['prog_unenrolment_message'] = 'Mensaje de desvinculación';
$string['prognamelinkedicon'] = 'Nombre de programa e ícono del enlace';
$string['program'] = 'Programa';
$string['program:accessanyprogram'] = 'Acceder a cualquier programa';
$string['program:configureassignments'] = 'Configurar tareas del programa';
$string['program:configurecontent'] = 'Configurar contenido del programa';
$string['program:configuremessages'] = 'Configurar mensajes del programa';
$string['program:configureprogram'] = 'Configurar programas';
$string['program:createprogram'] = 'Crear programas';
$string['program:handleexceptions'] = 'Manejar excepciones del programa';
$string['program:manageextensions'] = 'Ajustar extensiones';
$string['program:viewhiddenprograms'] = 'Ver programas ocultos';
$string['program:viewprogram'] = 'Ver programas';
$string['programassignments'] = 'Tareas del programa';
$string['programassignmentssaved'] = 'Las tareas del programa se guardaron exitosamente';
$string['programavailability_help'] = '# Disponibilidad del programa
Esta opción le permite "ocultar" completamente su programa.
No aparecerá en el listado de ningún programa, excepto a los administradores.
Incluso si los estudiantes intentan acceder a la URL del programa directamente, no tendrán permiso para entrar.';
$string['programcategory_help'] = '# Categorías del programa/curso
Su administrador Moodle puede tener varias categorías de programas/cursos configuradas.
Por ejemplo, "Ciencias", "Humanidades", "Salud pública", etc
Seleccione el que más se ajuste a su programa. Esta selección modificará el lugar donde se muestre el programa en el listado de programas y puede ayudar a los estudiantes a encontrarlo más fácilmente.';
$string['programcompleted'] = 'Programa completado';
$string['programcompletedmessage_help'] = '# Mensaje de realización del programa
Se enviará este mensaje siempre que se complete un programa.';
$string['programcompletion'] = 'Realización del programa';
$string['programcontent'] = 'Contenido del programa';
$string['programcontentsaved'] = 'Contenido del programa guardado exitosamente';
$string['programcreatefail'] = 'No se pudo crear el programa. Razón: "{$a}"';
$string['programcreatesuccess'] = 'Creación exitosa del programa';
$string['programdeletefail'] = 'No se pudo eliminar el programa "{$a}"';
$string['programdeletesuccess'] = 'El programa "{$a}" se eliminó exitosamente';
$string['programdetails'] = 'Detalles del programa';
$string['programdetailssaved'] = 'Los detalles del programa se guardaron exitosamente';
$string['programdue'] = 'Caducidad del programa';
$string['programduedate'] = 'Fecha de caducidad del programa';
$string['programduemessage_help'] = '# Mensaje de caducidad de programa
Se enviará este mensaje a la hora especificada antes de la caducidad de un programa.';
$string['programends'] = 'El programa ha finalizado';
$string['programexceptions'] = 'Excepciones del programa';
$string['programfullname_help'] = '# Nombre completo del programa
Se mostrará el nombre completo del programa en la sección superior de la pantalla y en el listado de prgramas.';
$string['programicon'] = 'Ícono del programa';
$string['programid'] = 'Id del programa';
$string['programidnotfound'] = 'El programa no existe para el ID: {$a}';
$string['programidnumber'] = 'Número Id del programa';
$string['programidnumber_help'] = '# Número de ID del programa
El número ID de un programa solo se utiliza cuando se debe hacer concordar este curso con sistemas externos - nunca se mostrará dentro de Moodle. Si tiene un nombre oficial de código para este programa, entonces utilícelo aquí... Caso contrario, puede dejarlo en blanco.';
$string['programlive'] = 'Precaución: El programa está en vivo';
$string['programmandatory'] = 'Programa obligatorio';
$string['programmessages'] = 'Mensajes del programa';
$string['programmessagessaved'] = 'Mensajes del programa guardados';
$string['programmessagessavedsuccessfully'] = 'Mensajes del programa guardados exitosamente';
$string['programname'] = 'Nombre del programa';
$string['programnotavailable'] = 'El programa no está disponible para estudiantes';
$string['programnotcurrentlyavailable'] = 'Actualmente, este programa no está disponible para estudiantes';
$string['programnotlive'] = 'El programa no está en vivo';
$string['programoverdue'] = 'Programa retrasado';
$string['programoverduemessage_help'] = '# Mensaje de programa retrasado
Se enviará este mensaje a una hora especificada luego de la caducidad de un programa.';
$string['programrecurring'] = 'Programa recurrente';
$string['programs'] = 'Programas';
$string['programscomplete'] = 'Programas completos';
$string['programshortname'] = 'Nombre corto del programa';
$string['programshortname_help'] = '# Nombre corto del programa
Se utilizará el nombre corto del programa en varios sitios cuando el nombre completo es inapropiado (como en el asunto de un mensaje de alerta).';
$string['programsinthiscategory'] = 'Programas en esta categoría ({$a})';
$string['programsmovedout'] = 'Programas movidos fuera de {$a}';
$string['programupdatecancelled'] = 'Actualización del programa cancelada';
$string['programupdatefail'] = 'Error en la actualización del programa';
$string['programupdatesuccess'] = 'Actualización exitosa del programa';
$string['programvisibility_help'] = '# visibilidad del programa
Si el programa es visible, aparecerá en el listado de programas y en los resultados de búsquedas, donde los estudiantes podrán ver el contenido del programa.
Si el programa no es visible, no aparecerá en el listado de programas o en los resultados de búsquedas, pero sí será mostrado en los planes de aprendizaje de cualquier estudiante que esté asignado a tal programa. Los estudiantes podrán acceder al programa si conocen su URL.';
$string['progress'] = 'Progreso';
$string['reason'] = 'Razón de la extensión';
$string['reasonforextension'] = 'Razón de la extensión';
$string['recurrence_help'] = '# Recurrencia
La recurrencia define el período de tiempo en el que el curso recurrente debe ser repetido. Se puede especificar la recurrencia con cualquier cantidad de días, semanas o meses.';
$string['recurring'] = 'Recurrente';
$string['recurringcourse'] = 'Curso recurrente';
$string['recurringcourse_help'] = '# Curso recurrente
Muestra el curso recurrente seleccionado.
Se puede seleccionar solo un curso como recurrente. Para cambiar el curso, seleccione uno nuevo de la lista desplegable y cliquee "Cambiar curso" para guardar los cambios.';
$string['recurringcourseset_help'] = '# Conjunto de cursos recurrentes
Un conjunto de cursos recurrentes solo permite la selección de un curso sencillo. No se pueden definir los cursos múltiples de las competencias y de los conjuntos de cursos.';
$string['recurringprogramhistory'] = 'Registro del historial para los programas recurrentes {$a}';
$string['recurringprogramhistoryfor'] = 'Registro del historial para {$a->username} para el programa recurrente {$a->progname}';
$string['recurringprograms'] = 'Programas recurrentes';
$string['repeatevery'] = 'Repetir cada';
$string['requestextension'] = 'Solicitar una extensión';
$string['requiredlearning'] = 'Aprendizaje requerido';
$string['requiredlearninginstructions'] = 'Su aprendizaje requerido se muestra abajo.';
$string['requiredlearninginstructionsuser'] = 'El aprendizaje requerido para {$a} se muestra abajo.';
$string['returntoprogram'] = 'Regresar al programa';
$string['rolprogramsourcename'] = 'Registro de aprendizaje: Programas';
$string['saveallchanges'] = 'Guardar todos los cambios';
$string['saveprogram'] = 'Guardar el programa';
$string['searchforindividual'] = 'Buscar individuos por nombre o ID';
$string['searchprograms'] = 'Buscar programas';
$string['select'] = 'Seleccionar';
$string['selectcompetency'] = 'Seleccionar una competencia...';
$string['selectcourse'] = 'Seleccionar un curso...';
$string['setcompletion'] = 'Configurar realización';
$string['setfixedcompletiondate'] = 'Configurar fecha de realización';
$string['setlabel_help'] = '# Etiqueta de conjunto del curso
Utilice la etiqueta de conjunto del curso para describir el agrupamiento de los cursos dentro de un conjunto.
La finalidad es que cada uno de los conjuntos sea más legible, así como ayudar a los Aprendices a entender la ruta del aprendizaje. Por ejemplo, el primer conjunto de cursos puede ser llamado "Fase uno - Introducción" y el segundo "Fase dos - Salud &amp: Seguridad".';
$string['setofcourses'] = 'Conjunto de cursos';
$string['setrealistictimeallowance'] = 'Configurar una asignación temporal realista';
$string['settimerelativetoevent'] = 'Configurar tiempo de acuerdo con el evento';
$string['shortname'] = 'Nombre corto';
$string['showingresults'] = 'Mostrando resultados {$a->from} - {$a->to} de {$a->total}';
$string['source'] = 'Fuente';
$string['startdate'] = 'Fecha de inicio';
$string['status'] = 'Estado';
$string['successfullyresolvedexceptions'] = 'Excepciones resueltas exitosamente';
$string['summary'] = 'Resumen';
$string['then'] = 'luego';
$string['therearenoprogramstodisplay'] = 'No hay programas para mostrar.';
$string['thisactioncannotbeundone'] = 'Esta operación no puede deshacerse';
$string['thiswillaffect'] = 'Esto afectará a {$a} alumnos';
$string['timeallowance'] = 'Asignación de tiempo';
$string['timeallowance_help'] = '# Asignación de tiempo
Configura la cantidad de tiempo asignado para completar los cursos dentro del conjunto. Ésta es una indicación general del tiempo transcurrido para completar el conjunto, no el tiempo real que lleva completar el curso. El tiempo real para completar el curso se puede configurar en el nivel del curso.';
$string['toprogram'] = 'al programa';
$string['tosaveassignments'] = 'Para guardar todos los cambios en las tareas, haga clic en "Guardar todos los cambios". Para editar los cambios haga clic en "Editar tareas". Las tareas guardadas no pueden deshacerse.';
$string['tosavecontent'] = 'Para guardar cambios en el contenido haga clic en "guardar todos los cambios". Para editar los cambios en el contenido haga clic en "Editar contenido". Los cambios guardados en el contenido no pueden deshacerse.';
$string['tosavemessages'] = 'Para guardar todos los cambios en los mensajes, haga clic en "Guardar todos los cambios". Para editar los cambios en los mensajes haga clic en "Editar mensajes". Los cambios guardados en los mensajes no pueden deshacerse.';
$string['total'] = 'Total';
$string['totalassignments'] = 'Total de tareas potenciales';
$string['totalassignments_help'] = '# Tareas totales
La cantidad total de tareas que se muestra en la página de tareas del programa y en la página de panorama/visión general representa el número total de aprendices en todas las categorías asignadas, y no la cantidad de aprendices que están actualmente asignados al programa.
Si un aprendiz pertenece a una organización que está asignada al programa y también tiene una posición asignada al mismo, entonces se contará al aprendiz en cada categoría (pero será asignado al programa sólo una vez).';
$string['trigger_help'] = '# Señal
La señal de tiempo determina cuándo un mensaje será enviado en relación con el evento descrito (p. ej. cuatro semanas luego de que el programa fue completado).';
$string['type'] = 'Tipo';
$string['unenrolment'] = 'Desvinculación';
$string['unenrolmentmessage_help'] = '# Mensaje de desvinculación
Se enviará este mensaje siempre que un usuario sea desvinculado de un programa.';
$string['unknownexception'] = 'Excepción desconocida';
$string['unknownusersrequiredlearning'] = 'No se conoce el aprendizaje requerido del usuario';
$string['unresolvedexceptions'] = '{$a} problema(s) sin resolver';
$string['untitledset'] = 'Conjunto sin título';
$string['update'] = 'Actualización';
$string['updateextensionfailall'] = 'Error al actualizar todas las extensiones';
$string['updateextensionfailcount'] = 'Error al actualizar {$a} estension(es)';
$string['updateextensions'] = 'Actualizar extensiones';
$string['updateextensionsuccess'] = 'Todas las extensiones fueron exitosamente actualizadas';
$string['userid'] = 'ID del usuario';
$string['variablesubstitution_help'] = '# Sustitución de variables
En los mensajes de programas, ciertas variables pueden ser insertadas en el asunto y/o en el cuerpo del mensaje, para que sean reemplazadas con valores reales cuando el mensaje es enviado. Las variables deben ser insertadas en el texto exactamente como se muestran a continuación. Se puede utilizar las siguientes variables:
%programfullname%
: Esto será reemplazado por el nombre completo del programa
%setlabel%
: Esto será reemplazado por la etiqueta del conjunto del curso (sólo será reemplazado si el mensaje está relacionado a un conjunto del curso).';
$string['viewallprograms'] = 'Ver todos los programas';
$string['viewallrequiredlearning'] = 'Ver todo';
$string['viewexceptions'] = 'Ver el informe de excepción para resolver problema(s).';
$string['viewinguserextrequests'] = 'Viendo las solicitudes de extensión de {$a}';
$string['viewingxusersprogram'] = 'Está viendo <a href="{$a->wwwroot}/user/view.php?id={$a->id}">{$a->fullname}\'s</a> progreso en este programa.';
$string['viewprogram'] = 'Ver programa';
$string['viewprogramassignments'] = 'Ver tareas del programa';
$string['viewprogramdetails'] = 'Ver detalles del programa';
$string['viewrecurringprogramhistory'] = 'Ver historial';
$string['visible'] = 'Visible';
$string['weeks'] = 'Semana(s)';
$string['xlearnerscurrentlyenrolled'] = 'Actualmente hay {$a} alumnos inscritos en este programa.';
$string['xsrequiredlearning'] = 'El aprendizaje requerido de {$a}';
$string['years'] = 'Año(s)';
$string['youareviewingxsrequiredlearning'] = 'Está viendo <a href="{$a->site}/user/view.php?id={$a->userid}">{$a->name}\'s</a> aprendizaje requerido.';
$string['youhaveadded'] = 'Ha añadido {$a->itemnames} a este programa<br />
<br />
<strong>Esto asignará a {$a->affectedusers} usuarios al programa </strong><br />
<br />
Este cambio se aplicará una vez que se haga clic en el botón de "Guardar todos los cambios" en la pantalla principal de tareas del Programa';
$string['youhavemadefollowingchanges'] = 'Ha realizado los siguientes cambios en este programa';
$string['youhaveremoved'] = 'Ha eliminado  {$a->itemname} de este programa<br />
<br />
<strong>Esto le quitará la asignación del programa a {$a->affectedusers} usuarios
</strong><br />
<br />
Este cambio se aplicará una vez que se haga clic en el botón de "Guardar todos los cambios" en la pantalla principal de tareas del Programa';
$string['youhaveunsavedchanges'] = 'Tiene cambios sin guardar';
$string['youmustcompletebeforeproceedingtolearner'] = 'Debe completar {$a->mustcomplete} antes de proceder a completar {$a->proceedto}';
$string['youmustcompletebeforeproceedingtomanager'] = 'debe completar {$a->mustcomplete} antes de proceder a completar {$a->proceedto}';
$string['youmustcompletebeforeproceedingtoviewing'] = 'Un alumno debe completar {$a->mustcomplete} antes de proceder a completar {$a->proceedto}';
$string['youmustcompleteorlearner'] = 'Debe completar {$a}';
$string['youmustcompleteormanager'] = 'debe completar {$a}';
$string['youmustcompleteorviewing'] = 'Un alumno debe completar {$a}';
$string['z:incompleterecurringprogrammessage'] = 'Un curso en un programa recurrente en el que está alistado ha llegado a su fecha de finalización, pero usted no ha completado el curso. El mismo debe completarse para alcanzar los requisitos del programa.';
$string['z:incompleterecurringprogramsubject'] = 'Curso recurrente incompleto';
