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
 * Strings for component 'question', language 'es', branch 'MOODLE_22_STABLE'
 *
 * @package   question
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['action'] = 'Acción';
$string['addanotherhint'] = 'Añadir otro pista';
$string['addcategory'] = 'Añadir Categoría';
$string['adminreport'] = 'Informe sobre posibles problemas en su base de datos de preguntas.';
$string['answer'] = 'Respuesta';
$string['answersaved'] = 'Respuesta guardada';
$string['attemptfinished'] = 'Intento finalizado';
$string['attemptfinishedsubmitting'] = 'Presentado intento finalizado:';
$string['availableq'] = '¿Disponible?';
$string['badbase'] = 'Base errónea antes de **: {$a}**';
$string['behaviour'] = 'Comportamiento';
$string['behaviourbeingused'] = 'Comportamiento utilizado: {$a}';
$string['broken'] = 'Éste es un enlace roto: apunta a un archivo inexistente.';
$string['byandon'] = 'por <em>{$a->user}</em> en <em>{$a->time}</em>';
$string['cannotcopybackup'] = 'No se ha podido copiar el archivo de copia de seguridad';
$string['cannotcreate'] = 'No se ha podido crear una nueva entrada en la tabla question_attempts';
$string['cannotcreatepath'] = 'No se puede crear la ruta: {$a}';
$string['cannotdeletebehaviourinuse'] = 'No puede eliminar el comportamiento \'{$a}\'. Está en uso en los inentos de pregunta';
$string['cannotdeletecate'] = 'No puede eliminar la categoría porque es la categoría por defecto para este contexto.';
$string['cannotdeletemissingbehaviour'] = 'No puede desinstalar el comportamiento que falta. Lo requiere el sistema.';
$string['cannotdeletemissingqtype'] = 'No puede eliminar el tipo de pregunta que falta. El sistema la necesita.';
$string['cannotdeleteneededbehaviour'] = 'No puede eliminar el comportamiento de pregunta \'{$a}\'. Hay otros comportamientos instalados que dependen de él.';
$string['cannotdeleteqtypeinuse'] = 'No puede eliminar la pregunta de tipo \'{$a}\'. Hay preguntas de ese tipo en el banco de preguntas.';
$string['cannotdeleteqtypeneeded'] = 'No puede eliminar la pregunta de tipo \'{$a}\'. Hay otros tipos de preguntas que dependen de ella.';
$string['cannotenable'] = 'El tipo de pregunta {$a} no se puede crear directamente';
$string['cannotenablebehaviour'] = 'El comportamiento de pregunta {$a} no puede usarase directamente. Es para uso interno.';
$string['cannotfindcate'] = 'No se ha podido encontrar el registro de la categoría';
$string['cannotfindquestionfile'] = 'No se ha podido encontrar el archivo de preguntas en el zip';
$string['cannotgetdsfordependent'] = 'No se puede conseguir el conjunto de datos especificado para la pregunta dependiente (pregunta: {$a->id}, datasetitem: {$a->item})';
$string['cannotgetdsforquestion'] = 'No se puede conseguir el conjunto de datos para una pregunta calculada (pregunta: {$a})';
$string['cannothidequestion'] = 'No se ha podido ocultar la pregunta';
$string['cannotimportformat'] = 'Lo sentimos, aún no está implementada la importación en este formato.';
$string['cannotinsertquestion'] = 'No se ha podido insertar una nueva pregunta';
$string['cannotinsertquestioncatecontext'] = 'No se ha podido insertar la nueva categoría de preguntas {$a->cat} illegal contextid {$a->ctx}';
$string['cannotloadquestion'] = 'No se ha podido cargar la pregunta';
$string['cannotmovequestion'] = 'No puede usar este script para trasladar preguntas que tienen archivos asociados provenientes de distintas áreas.';
$string['cannotopenforwriting'] = 'Noi se puede abrir para escritura: {$a}';
$string['cannotpreview'] = 'No puede previsualizar estas preguntas.';
$string['cannotread'] = 'No se puede leer el archivo importado (o está vacío)';
$string['cannotretrieveqcat'] = 'No se ha podido recuperar la categoría de preguntas';
$string['cannotunhidequestion'] = 'Error al descubrir la pregunta.';
$string['cannotunzip'] = 'No se ha podido descomprimir el archivo.';
$string['cannotwriteto'] = 'No se puede escribir las preguntas exportadas a {$a}';
$string['category'] = 'Categoría';
$string['categorycurrent'] = 'Categoría actual';
$string['categorycurrentuse'] = 'Usar esta categoría';
$string['categorydoesnotexist'] = 'Esta categoría no existe';
$string['categoryinfo'] = 'Información sobre la categoría';
$string['categorymove'] = 'La categoría \'{$a->name}\' contiene {$a->count} preguntas (algunas pueden ser preguntas antiguas, ocultas, que estan todavía en uso en algunos cuestionarios existentes). Por favor elija otra categoría donde moverlas.';
$string['categorymoveto'] = 'Guardar en categoría';
$string['categorynamecantbeblank'] = 'El nombre de la categoría no puede estar en blanco';
$string['changeoptions'] = 'Cambiar opciones';
$string['changepublishstatuscat'] = '<a href="{$a->caturl}">La categoría "{$a->name}"</a> en curso "{$a->coursename}" cambiará su estatus de intercambio <strong>{$a->changefrom} a {$a->changeto}</strong>.';
$string['check'] = 'Comprobar';
$string['chooseqtypetoadd'] = 'Elija un tipo de pregunta a agregar';
$string['clearwrongparts'] = 'Borrar respuestas incorrectas';
$string['clickflag'] = 'Marcar pregunta';
$string['clicktoflag'] = 'Marcar esta pregunta para futuras consultas';
$string['clicktounflag'] = 'Desmarcar';
$string['clickunflag'] = 'Desmarcar';
$string['closepreview'] = 'Cerrar vista previa';
$string['combinedfeedback'] = 'Retroalimentación combinada';
$string['comment'] = 'Comentario';
$string['commented'] = 'Comentado: {$a}';
$string['commentormark'] = 'Comentar o anular la puntuación';
$string['comments'] = 'Comentarios';
$string['commentx'] = 'Comentario: {$a}';
$string['complete'] = 'Finalizar';
$string['contexterror'] = 'No debería estar aquí si no está moviendo una categoría a otro contexto.';
$string['copy'] = 'Copiar de {$a} y cambiar los enlaces.';
$string['correct'] = 'Correcta';
$string['correctfeedback'] = 'Para cualquier respuesta correctra';
$string['created'] = 'Creado';
$string['createdby'] = 'Creado por';
$string['createdmodifiedheader'] = 'Creado / Último guardado';
$string['createnewquestion'] = 'Crear una nueva pregunta...';
$string['cwrqpfs'] = 'Preguntas aleatorias seleccionando preguntas de sub-categorías.';
$string['cwrqpfsinfo'] = '<p>Durante la actualización a Moodle 1.9 separaremos las categorías de pregunta en diferentes contextos. Algunas categorías y preguntas de su sitio verán su estatus de intercambio modificado. Esto es necesario en los raros casos en que una o más preguntas aleatorias se seleccionan a partir de una mezcla de categorías compartidas y no compartidas (como sucede en el caso de este sitio). Esto sucede cuando una pregunta aleatoria se ajusta para seleccionar a partir de subcategorías, y una o más subcategorías tienen diferente estatus de intercambio con la categoría padre en la que se crea la pregunta aleatoria.</p>
<p>Las siguientes categorías, de las cuales las preguntas aleatorias de las categorías superiores seleccionan las preguntas, tendrán -en la actualización a Moodle 1.9- su estatus de intercambio modificado al mismo estatus que la categoría que contiene la pregunta aleatoria. Las categorías que aparecen a continuación tendrán su estatus de intercambio modificado. Las preguntas afectadas continuarán funcionando en todos los cuestionarios existentes hasta que usted las elimine de tales cuestionarios.';
$string['cwrqpfsnoprob'] = 'No existen categorías en su sitio afectadas por la opción \'Preguntas aleatorias seleccionando preguntas de subcategorías\'.';
$string['decimalplacesingrades'] = 'Decimales en las calificaciones';
$string['defaultfor'] = 'Por defecto en {$a}';
$string['defaultinfofor'] = 'Categoría por defecto para preguntas compartidas en el contexto {$a}.';
$string['defaultmark'] = 'Puntuación por defecto';
$string['deletebehaviourareyousure'] = 'Eliminar comportamiento {$a}: ¿está seguro?';
$string['deletebehaviourareyousuremessage'] = 'Está a punto de eliminar por completo el comportamiento de la pregunta {$a}. Esta acción eliminará de la base de datos todo aquello asociado al comportamiento de esta pregunta . ¿Seguro de que desea continuar?';
$string['deletecoursecategorywithquestions'] = 'Hay preguntas en el banco de preguntas asociadas con esta categoría de curso. Si continúa, serán eliminadas. Quizás quiera trasladarlas primero, usando la interfaz del banco de preguntas.';
$string['deleteqtypeareyousure'] = '¿Está seguro que desea eliminar el tipo de pregunta \'{$a} "';
$string['deleteqtypeareyousuremessage'] = 'Usted está a punto de eliminar por completo el tipo de pregunta \'{$a}\'. ¿Desea continuar?';
$string['deletequestioncheck'] = '¿Está totalmente seguro que quiere borrar \'{$a}\'?';
$string['deletequestionscheck'] = '¿Está totalmente seguro que quiere borrar las siguientes preguntas?<br /><br />{$a}';
$string['deletingbehaviour'] = 'Eliminando comportamiento de pregunta \'{$a}\'';
$string['deletingqtype'] = 'Eliminando el tipo de pregunta \'{$a} "';
$string['didnotmatchanyanswer'] = '[No se ha encontrado ninguna respuesta]';
$string['disabled'] = 'Desactivado';
$string['disterror'] = 'La distribución {$a} ha causado problemas';
$string['donothing'] = 'No copie o mueva archivos ni cambie enlaces.';
$string['editcategories'] = 'Editar categorías';
$string['editcategories_help'] = 'En lugar de guardar todas sus preguntas en una lista, puede crear categorías para distribuirlas mejor.
Las categorías pueden crearse o eliminarse a voluntad. Pero:
* Debe haber al menos una categoría en cada contexto. De este modo, usted no puede eliminar la última categoría de un contexto.
* Cuando intente eliminar una categoría que contiene preguntas, se le pedirá que especifique otra categoría a la que trasladarlas.
Usted puede ordenar sus categorías en una jerarquía de modo que resulten de fácil manejo. La edición de categorías se hace en la pestaña \'Categorías\' en el banco de preguntas.
* En la página principal bajo la pestaña \'Categorías\' en el banco de preguntas:
* las flechas arriba y abajo cambian el orden en que se listan las categorías que pertenecen al mismo nivel.
* En la pestaña \'Categorías\' del banco de preguntas, podrá asimismo trasladar una categoría a un nuevo contexto mediante las flechas arriba y abajo.
* Las flechas izquierda y derecha se usan para cambiar la categoría padre de una categoría determinada.
* Tal vez una forma más rápida de mover las categorías sea pulsar en el icono de edición de la pestaña \'Categorías\' del banco de preguntas y usar seguidamente la casilla de selección para seleccionar una nueva categoría padre.
Vea también:

* [Ayuda sobre categorías de preguntas en Moodle Docs](http://docs.moodle.org/en/Question_categories)';
$string['editcategory'] = 'Ediar categoría';
$string['editingcategory'] = 'Edición de una categoría';
$string['editingquestion'] = 'Edición de una pregunta';
$string['editquestion'] = 'Editar pregunta';
$string['editquestions'] = 'Editar pregunta';
$string['editthiscategory'] = 'Editar esta categoría';
$string['emptyxml'] = 'Error desconocido - imsmanifest.xml vacío';
$string['enabled'] = 'Activado';
$string['erroraccessingcontext'] = 'No se puede acceder al contexto';
$string['errordeletingquestionsfromcategory'] = 'Error al eliminar preguntas de la categoría {$a}.';
$string['errorduringpost'] = 'Ha ocurrido un error durante el post-procesamiento';
$string['errorduringpre'] = 'Ha ocurrido un error durante el pre-procesamiento';
$string['errorduringproc'] = 'Ha ocurrido un error durante el procesamiento';
$string['errorduringregrade'] = 'No se ha podido recalificar la pregunta {$a->qid}, se va al estado {$a->stateid}.';
$string['errorfilecannotbecopied'] = 'Error: no se puede copiar el archivo {$a}.';
$string['errorfilecannotbemoved'] = 'Error: no se puede mover el archivo {$a}.';
$string['errorfileschanged'] = 'Los archivos de error enlazados desde preguntas han cambiado desde que se ha mostrado el formulario.';
$string['errormanualgradeoutofrange'] = 'La calificación {$a->grade} no está entre 0 y {$a->maxgrade} para la pregunta {$a->name}. La puntuación y el comentario no se han guardado.';
$string['errormovingquestions'] = 'Error al trasladar preguntas con IDs {$a}.';
$string['errorpostprocess'] = 'Ha ocurrido un error durante el post-procesamiento';
$string['errorpreprocess'] = 'Ha ocurrido un error durante el pre-procesamiento';
$string['errorprocess'] = 'Ha ocurrido un error durante el procesamiento';
$string['errorprocessingresponses'] = 'Ha ocurrido un error al procesar sus respuestas {$a}. Haga clic para volver a la página anterior e intentarlo de nuevo.';
$string['errorsavingcomment'] = 'Error al guardar el comentario para la pregunta {$a->name} en la base de datos.';
$string['errorsavingflags'] = 'Error al guardar el estado';
$string['errorupdatingattempt'] = 'Error al actualizar el intento {$a->id} en la base de datos.';
$string['exportcategory'] = 'Exportar categoría';
$string['exportcategory_help'] = '**Categoría de exportación**
Se utiliza el menú emergente **Categoría:** para seleccionar la categoría de la que se tomarán las preguntas exportadas.
Algunos formatos de importación (GIFT y XML) permiten incluir la categoría en el archivo escrito, posibilitando así que las categorías puedan opcionalmente ser recreadas al importarlas. Para que esto suceda, es preciso marcar la casilla **Escribir categoría a un archivo**.';
$string['exporterror'] = 'Ha ocurrido un error durante la exportación';
$string['exportfilename'] = 'preguntas';
$string['exportnameformat'] = '%Y%m%d-%H%M';
$string['exportquestions'] = 'Exportar preguntas a un archivo';
$string['exportquestions_help'] = 'Esta función permite exportar una categoría completa de preguntas a un
archivo de texto.
Por favor, advierta que en muchos formatos de archivo se pierde alguna
información cuando se exportan las preguntas. Esto se debe a que muchos
formatos no poseen todas las características existentes en las preguntas
de Moodle. No puede esperarse exportar preguntas y luego importarlas de
modo que ambas sean idénticas. Asimismo, algunos tipos de preguntas no
pueden exportarse en absoluto. Compruebe los datos exportados antes de
usarlos en un contexto de producción.
Los formatos posibles actualmente son:
**Formato GIFT**
GIFT es el formato de importación/exportación más comprensivo de que se
dispone para exportar preguntas Moodle a un archivo de texto. Fue diseñado
para que los profesores escribieran fácilmente preguntas en un archivo de
texto. Soporta los formatos de elección múltiple, verdadero-falso, respuesta
corta, emparejamiento, preguntas numéricas, así como la inserción de \_\_\_|\_\_\_|\_
en el formato de "palabra perdida". Advierta que las preguntas incrustadas
("cloze") no se incluyen por el momento. En un archivo de texto pueden
mezclarse preguntas de distinto tipo, y el formato soporta asimismo comentarios,
nombres de las preguntas, retroalimentación y calificaciones ponderadas (en
porcentajes). He aquí algunos ejemplos:
¿En qué mes de 1492 Colón descubrió América?{~Noviembre ~Septiembre =Octubre}
Colón descubrió América el 12 de {~noviembre =octubre ~septiembre} de 1492.
Colón descubrió América el 12 de noviembre de 1492.{FALSE}
¿Quién descubrió América el 12 de octubre de 1492?{=Colón =Cristóbal Colón}
¿En qué año llegó Colón a América?{#1492}

[Más sobre el formato "GIFT"](help.php?file=formatgift.html&module=quiz)

**Formato XML Moodle XML**
Este formato específico de Moodle exporta preguntas en formato simple XML. Esas preguntas pueden
luego importarse a cualquier categoría del cuestionario, o usarse en cualquier otro proceso, tal como
una transformación XSLT.

**IMS QTI 2.0**
Las preguntas se exportan en el formato IMS QTI estándar (version 2.0) format. Note que este modo de
exportación genera un grupo de archivos dentro de un único archivo \'zip\'.
[Más información sobre el sitio IMS QTI](http://www.imsglobal.org/question/)
(sitio externo en una ventana nueva)

**XHTML**
Exporta la categoría en una única página de XHTML \'estricto\'. Cada una de las preguntas es ubicada en su propia marca
. Si desea usar esta página tal cual, necesitará al menos editar la marca al comienzo de la
secciónpara posibilitar acciones tales como \'mailto\'.

¡Pronto se dispondrá de más formatos, incluyendo WebCT y cualesquiera otros
que los usuarios de Moodle quieran incorporar!';
$string['feedback'] = 'Retroalimentación';
$string['filecantmovefrom'] = 'Los archivos de preguntas no se pueden mover porque usted no tiene permiso para trasladar archivos del lugar desde el que está intentando hacerlo.';
$string['filecantmoveto'] = 'Los archivos de preguntas no se pueden mover o copiar porque usted no tiene permiso para añadir archivos del lugar al que está intentando hacerlo.';
$string['fileformat'] = 'Formato de archivo';
$string['filesareacourse'] = 'área de archivos del curso';
$string['filesareasite'] = 'área de archivos del sitio';
$string['filestomove'] = '¿Mover / copiar archivos a {$a}?';
$string['fillincorrect'] = 'Rellenar respuestas correctas';
$string['flagged'] = 'Marcadas';
$string['flagthisquestion'] = 'Marcar esta pregunta';
$string['formquestionnotinids'] = 'Pregunta contenida en formulario que no está en questionids.';
$string['fractionsnomax'] = 'Una de las respuestas debería tener una puntuación del 100% de modo que sea posible conseguir la calificación máxima en esta pregunta.';
$string['generalfeedback'] = 'Retroalimentación general';
$string['generalfeedback_help'] = 'La retroalimentación general se muestra al estudiante después de haber respondido a la pregunta. A diferencia de la retroalimentación, que depende del tipo de pregunta y de la respuesta dada por el estudiante, aquí se muestra siempre el mismo texto en todos los casos.
Se puede utilizar la retroalimentación general para proporcionar a los estudiantes información complementaria sobre el tema sobre el que trata la pregunta, o información que puedan utilizar en el caso de no hubieran entendido bien la pregunta.';
$string['getcategoryfromfile'] = 'Obtener categoría de archivo';
$string['getcontextfromfile'] = 'Obtener contexto de archivo';
$string['hidden'] = 'Oculto';
$string['hintn'] = 'Pista {no}';
$string['hinttext'] = 'Texto de la pista';
$string['howquestionsbehave'] = 'Comportamiento de las preguntas';
$string['howquestionsbehave_help'] = 'Los estudiantes pueden interactuar con las preguntas en el cuestionario de varias maneras diferentes. Por ejemplo, usted puede desear que los estudiantes introduzcan una respuesta a cada pregunta y posteriormente envien el cuestionario completo, antes de que se realice ninguna calificación o de que se envíe ninguna retroalimentación. Ese sería el modo de \'retroalimentación diferida\'. En otra situación, usted puede desear que los estudiantes respondan una pregunta y sobre la marcha obtengan retroalimentación inmediata, y si la respuesta no es correcta, tengan otra otra oportunidad con menor puntuación. Este modo sería \'interactivo con varios intentos\' .';
$string['ignorebroken'] = 'Pasar por alto enlaces rotos';
$string['importcategory'] = 'Importar categoría';
$string['importcategory_help'] = 'Se utiliza el menú emergente **Categoría:** para seleccionar la categoría en la que irán las preguntas importadas.
Algunos formatos de importación (GIFT y XML) permiten especificar la categoría dentro del archivo de importación. Para que esto suceda, debe estar marcada la casilla **desde archivo**. En caso contrario, la pregunta irá a la categoría seleccionada independientemente de las instrucciones del archivo.
Cuando se especifican las categorías dentro de un archivo de importación, se crearán en el caso de que no existan.';
$string['importerror'] = 'HA habido un error durante el proceso de importación';
$string['importerrorquestion'] = 'Error al importar pregunta';
$string['importfromcoursefiles'] = '...o elija un formato de archivo para importar.';
$string['importfromupload'] = 'Selecciona un archivo para actualizar...';
$string['importingquestions'] = 'Importando {$a} preguntas desde archivo';
$string['importparseerror'] = 'Error(es) encontrado(s) al analizar el archivo de importación. No se han importado preguntas. Para importar todas las preguntas correctas vuelva a intentarlo con el parámetro  \'Parar en caso de error\' en \'No\'';
$string['importquestions'] = 'Importar preguntas de un archivo';
$string['importquestions_help'] = 'Esta función posibilita la importación de preguntas en distintos formatos por medio de un archivo de texto. Advierta que el archivo debe tener la codificación UTF-8.';
$string['importwrongfiletype'] = 'El tipo de archivo seleccionado ({$a->actualtype}) no coincide con el tipo esperado por este formato de importación ({$a->expectedtype}).';
$string['impossiblechar'] = 'Se ha detectado un carácter imposible {$a} como carácter de paréntesis';
$string['includesubcategories'] = 'Mostrar también preguntas de las sub-categorías';
$string['incorrect'] = 'Incorrecta';
$string['incorrectfeedback'] = 'Para cualquier respuesta incorrecta';
$string['information'] = 'Información';
$string['invalidanswer'] = 'Respuesta incompleta';
$string['invalidarg'] = 'No se han suministrado argumentos válidos, o la configuración del servidor es incorrecta';
$string['invalidcategoryidforparent'] = 'El ID de la categoría padre no es válido.';
$string['invalidcategoryidtomove'] = 'El ID de la categoría a mover no es válido.';
$string['invalidconfirm'] = 'La cadena de confirmación es incorrecta';
$string['invalidcontextinhasanyquestions'] = 'Contexto no válido pasado a question_context_has_any_questions.';
$string['invalidpenalty'] = 'Penalización no válida';
$string['invalidwizardpage'] = 'La página asistente es incorrecta o no está especificada.';
$string['lastmodifiedby'] = 'Última modificación por';
$string['linkedfiledoesntexist'] = 'El archivo enlazado {$a} no existe';
$string['makechildof'] = 'Crear una categoría "hija" de \'{$a}\'';
$string['makecopy'] = 'Crear copia';
$string['maketoplevelitem'] = 'Mover al nivel superior';
$string['manualgradeoutofrange'] = 'Esta calificación está fuera del rango válido.';
$string['manuallygraded'] = 'Calificación manual {$a->mark} con comentario: {$a->comment}';
$string['mark'] = 'Puntuación';
$string['markedoutof'] = 'Puntúa como';
$string['markedoutofmax'] = 'Puntúa como {$a}';
$string['markoutofmax'] = 'Puntúa {$a->mark} sobre {$a->max}';
$string['marks'] = 'Puntos';
$string['matcherror'] = 'Las calificaciones no corresponden con las opciones de calificación - preguntas saltadas';
$string['matchgrades'] = 'Emparejar calificaciones';
$string['matchgrades_help'] = 'Las calificaciones importadas **deben** corresponderse con alguna de las que figuran en la lista fija de calificaciones válidas, de este modo:

* 100%
* 90%
* 80%
* 75%
* 70%
* 66.666%
* 60%
* 50%
* 40%
* 33.333
* 30%
* 25%
* 20%
* 16.666%
* 14.2857
* 12.5%
* 11.111%
* 10%
* 5%
* 0%

se admiten asimismo los valores negativos de la lista anterior.
Esta opción tiene dos posibilidades, que afectan a la forma en que la rutina de importación trata los valores que no se corresponden **exactamente** con cualquiera de los valores de la lista

\* **|Error si la calificación no está en la lista**
Si una pregunta contiene cualesquiera calificaciones que no se correspondan con los valores de la lista, se mostrará un mensaje de error y esa pregunta no se importará.
\* **|Calificación más próxima si no está en la lista**
Si se encuentra una calificación que no se corresponde con uno de los valores de la lista, se toma el valor más próximo de la lista

*Nota: algunos formatos de importación personalizados pueden escribir directamente en la base de datos y no quedar afectados por esta comprobación*';
$string['matchgradeserror'] = 'Error si la calificación no está en la lista';
$string['matchgradesnearest'] = 'Calificación más próxima si no está en lista';
$string['missingcourseorcmid'] = 'Es necesario proporcionar courseid o cmid a print_question';
$string['missingcourseorcmidtolink'] = 'Es necesario proporcionar courseid o cmid a get_question_edit_link';
$string['missingimportantcode'] = 'Este tipo de pregunta carece de un código importante: {$a}.';
$string['missingoption'] = 'La pregunta de cierre {$a} no tiene las opciones necesarias';
$string['modified'] = 'Último guardado';
$string['move'] = 'Mover desde {$a} y cambiar enlaces.';
$string['movecategory'] = 'Mover categoría';
$string['movedquestionsandcategories'] = 'Trasladadas preguntas y categorías de preguntas de {$a->oldplace} a {$a->newplace}.';
$string['movelinksonly'] = 'Limitarse a cambiar el lugar al que apuntan los enlaces, no mover ni copiar archivos.';
$string['moveq'] = 'Mover pregunta(a)';
$string['moveqtoanothercontext'] = 'Mover pregunta a otro contexto.';
$string['moveto'] = 'Mover a >>';
$string['movingcategory'] = 'Moviendo categoría';
$string['movingcategoryandfiles'] = '¿Está seguro de que quiere mover la categoría {$a->name} y todas sus categorías subordinadas al contexto de "{$a->contextto}"?<br /> Hemos detectado {$a->urlcount} archivos enlazados desde preguntas en {$a->fromareaname}; ¿desea copiarlas o moverlas a {$a->toareaname}?';
$string['movingcategorynofiles'] = '¿Está seguro de que quiere mover la categoría "{$a->name}" y todas sus categorías subordinadas al contexto para "{$a->contextto}"?';
$string['movingquestions'] = 'Moviendo preguntas y cualquier archivo';
$string['movingquestionsandfiles'] = '¿Está seguro de que quiere mover la(s) pregunta(s) {$a->questions} al contexto de <strong>"{$a->tocontext}"</strong>?<br /> Hemos detectado <strong>{$a->urlcount} archivos</strong> enlazados con esta(s) pregunta(s) en {$a->fromareaname}; ¿desea copiarlos o moverlos a {$a->toareaname}?';
$string['movingquestionsnofiles'] = '¿Está seguro de que quiere mover la(s) pregunta(s) {$a->questions} al contexto de <strong>"{$a->tocontext}"</strong>?<br /> No hay <strong>ningún archivo</strong> enlazado desde esta(s) pregunta(s) en {$a->fromareaname}.';
$string['needtochoosecat'] = 'Necesita elegir una categoría para mover esta pregunta o presionar \'cancelar\'.';
$string['nocate'] = 'No existe esa categoría {$a}';
$string['nopermissionadd'] = 'No tiene permiso para agregar preguntas aquí.';
$string['nopermissionmove'] = 'Usted no tiene permiso para trasladar preguntas desde este lugar. Debe guardar la pregunta en esta categoría o guardarla como pregunta nueva.';
$string['noprobs'] = 'No se han encontrado problemas en su base de datos de preguntas.';
$string['noquestions'] = 'No se encontraron preguntas que podrían ser exportados. Asegúrese de que ha seleccionado una categoría para la exportación que contiene preguntas.';
$string['noquestionsinfile'] = 'No hay preguntas en el archivo de importación';
$string['noresponse'] = '[No hay respuesta]';
$string['notanswered'] = 'Sin contestar';
$string['notenoughanswers'] = 'Este tipo de pregunta requiere al menos {$a} respuestas';
$string['notenoughdatatoeditaquestion'] = 'No se ha especificado ni el id de la pregunta ni el de la categoría y tipo de pregunta.';
$string['notenoughdatatomovequestions'] = 'Necesita proporcionar los ids de las preguntas que quiere mover.';
$string['notflagged'] = 'No marcadas';
$string['notgraded'] = 'Sin calificar';
$string['notshown'] = 'No se muestra';
$string['notyetanswered'] = 'Sin responder aún';
$string['notyourpreview'] = 'Esta vista previa no le pertenece';
$string['novirtualquestiontype'] = 'No existe un tipo de pregunta virtual para el tipo de pregunta {$a}';
$string['numqas'] = 'Sin intentos';
$string['numquestions'] = 'Número de preguntas';
$string['numquestionsandhidden'] = '{$a->numquestions} (+{$a->numhidden} ocultas)';
$string['options'] = 'Opciones';
$string['page-question-category'] = 'Página de categorías de pregunta';
$string['page-question-edit'] = 'Página de edición de preguntas';
$string['page-question-export'] = 'Página de exportación de preguntas';
$string['page-question-import'] = 'Página de importación de preguntas';
$string['page-question-x'] = 'Cualquier página de pregun tas';
$string['parent'] = 'Padre';
$string['parentcategory'] = 'Categoría padre';
$string['parentcategory_help'] = '## Padre
Categoría en la que se colocará. \'Superior\' significa que esta categoría no está contenida en ninguna otra categoría.
Normalmente verá algunos \'contextos\' de categoría en negrita; advierta que cada contexto contiene la jerarquía de su propia categoría. Más abajo hay más información sobre los contextos. Si usted no ve varios contextos, puede deberse a que no tiene permiso para acceder a otros contextos.
Si en un contexto hay una sola categoría, no podrá mover dicha categoría, toda vez que debe haber al menos una categoría en cada contexto.
Vea también:
* [Categorías de pregunta](help.php?module=question&file=categories.html)
* [Contextos de categorías](help.php?module=question&file=categorycontexts.html)
* [Permisos (preguntas)](help.php?module=question&file=permissions.html)';
$string['parenthesisinproperclose'] = 'El paréntesis antes de ** no se ha cerrado correctamente en {$a}**';
$string['parenthesisinproperstart'] = 'El paréntesis antes de ** no se ha abierto correctamente en {$a}**';
$string['parsingquestions'] = 'Análizando las preguntas del archivo de importación.';
$string['partiallycorrect'] = 'Parcialmente correcta';
$string['partiallycorrectfeedback'] = 'Para cualquier respuesta parcialmente correcta';
$string['penaltyfactor'] = 'Factor de penalización';
$string['penaltyfactor_help'] = 'Puede especificar qué fracción de la puntuación obtenida debería substraerse por cada respuesta errónea. Esto sólo resulta relevante si el cuestionario de ejecuta en modo adaptativo, de forma que se permite al estudiante repetir las respuestas a la pregunta. El factor de penalización debería ser un número entre 0 y 1. Un factor de penalización de 1 significa que el estudiante ha de dar la respuesta correcta al primer intento para conseguir la calificación máxima. Un factor de penalización de 0 significa que el estudiante puede intentar responder cuantas veces quiera y aun así puede conseguir la calificación máxima.';
$string['penaltyforeachincorrecttry'] = 'Penalización por cada intento incorrecto';
$string['penaltyforeachincorrecttry_help'] = 'Cuando se responden preguntas configuradas con "Intentos múltiples" o en "Modo adpatativo", de manera que el alumno puede realizar varios intentos para responder a la pregunta de forma correcta, esta opción define el valor de la penalización que se aplica por cada intento incorrecto.
La penalización es proporcional a la calificación total de la pregunta, así, si la pregunta vale tres puntos, y la penaliación es de 0.3333333 (33,33%), el estudiante obtiene los 3 puntos si responde correctamente al primer intento, 2 si lo hacen en un segundo intento, y 1 si lo hace en el tercero.';
$string['permissionedit'] = 'Editar esta pregunta';
$string['permissionmove'] = 'Mover esta pregunta';
$string['permissionsaveasnew'] = 'Guardarla como pregunta nueva';
$string['permissionto'] = 'Usted tiene permiso para:';
$string['previewquestion'] = 'Vista previa de la pregunta';
$string['published'] = 'publicado';
$string['qtypedeletefiles'] = 'Todos los datos relacionados con el tipo de pregunta \'{$a->qtype}\' han sido borrados de la base de datos. Para completar la eliminación (y para evitar el tipo de pregunta se vuelva a reinstalar por sí misma), debería eliminar ahora este directorio de su servidor: {$a->directory}';
$string['qtypeveryshort'] = 'T';
$string['questionaffected'] = '<a href="{$a->qurl}">La pregunta "{$a->name}" ({$a->qtype})</a> está en esta categoría, pero está también siendo usada en <a href="{$a->qurl}">el cuestionario "{$a->quizname}"</a> en otro curso "{$a->coursename}".';
$string['questionbank'] = 'Banco de preguntas';
$string['questionbehaviouradminsetting'] = '';
$string['questioncategory'] = 'Categoría de pregunta';
$string['questioncatsfor'] = 'Categorías de pregunta para \'{$a}\'';
$string['questiondoesnotexist'] = 'Esta pregunta no existe.';
$string['questionidmismatch'] = 'Error en los IDs de las preguntas';
$string['questionname'] = 'Nombre de la pregunta';
$string['questionno'] = 'Pregunta {$a}';
$string['questions'] = 'Preguntas';
$string['questionsaveerror'] = 'Se han producido errores al guardar la pregunta - ({$a})';
$string['questionsinuse'] = '{*Las preguntas marcadas con un asterisco ya están en uso en algún cuestionario. Estas preguntas no serán borradas de estos cuestionarios, solo de la lista de la categoría}';
$string['questionsmovedto'] = 'Preguntas aún en uso trasladadas a "{$a}" en la categoría de curso padre.';
$string['questionsrescuedfrom'] = 'Preguntas guardadas del contexto {$a}.';
$string['questionsrescuedfrominfo'] = 'Estas preguntas (alguna de las cuales puede estar oculta) se han guardado cuando el contexto {$a} fue eliminado debido a que aún están siendo utilizadas por algún cuestionario o por otras actividades.';
$string['questiontext'] = 'Texto de la pregunta';
$string['questiontype'] = 'Tipo de pregunta';
$string['questionuse'] = 'Usar pregunta en esta actividad';
$string['questionvariant'] = 'Variante de la pregunta';
$string['questionx'] = 'Pregunta {$a}';
$string['requiresgrading'] = 'Requiere calificación';
$string['responsehistory'] = 'Historial de respuestas';
$string['restart'] = 'Comenzar de nuevo';
$string['restartwiththeseoptions'] = 'Comenzar de nuevo con estas opciones';
$string['reviewresponse'] = 'Revisar respuesta';
$string['rightanswer'] = 'Respuesta correcta';
$string['saved'] = 'Guardadas: {$a}';
$string['saveflags'] = 'Guardar el estado en las marcas';
$string['selectacategory'] = 'Seleccionar una categoría:';
$string['selectaqtypefordescription'] = 'Seleccionar un tipo de pregunta para ver su descripción.';
$string['selectcategoryabove'] = 'Seleccione una categoría';
$string['selectquestionsforbulk'] = 'Seleccionar preguntas de acciones en masa';
$string['settingsformultipletries'] = 'Configuración para múltiples intentos';
$string['shareincontext'] = 'Compartir en contexto para {$a}';
$string['showhidden'] = 'Mostrar también preguntas antiguas';
$string['showmarkandmax'] = 'Mostrar puntuacion y máximo';
$string['showmaxmarkonly'] = 'Mostrar solo puntuación máxima';
$string['shown'] = 'Se muestra';
$string['shownumpartscorrect'] = 'Mostrar el número de respuestas correctas';
$string['shownumpartscorrectwhenfinished'] = 'Mostrar el número de respuestas correctas';
$string['showquestiontext'] = 'Mostrar el texto de la pregunta en la lista de preguntas';
$string['specificfeedback'] = 'Retroalimentación específica';
$string['started'] = 'Iniciado';
$string['state'] = 'Estado';
$string['step'] = 'Paso';
$string['stoponerror'] = 'Detenerse si se produce un error';
$string['stoponerror_help'] = 'Esta opción determina si el proceso de importación se detiene cuando se detecta un error (lo que resulta en que no se importan preguntas), o si cualesquiera preguntas que contengan errores se pasen por alto y se importen sólo preguntas válidas.';
$string['submissionoutofsequence'] = 'Acceso fuera de secuencia. Por favor, no haga clic en el botón de retroceso cuando este trabajando en las preguntas del cuestionario.';
$string['submissionoutofsequencefriendlymessage'] = 'Ha introducido datos fuera de la secuencia normal. Esto puede ocurrir si utiliza los botones Atrás o Adelante de su navegador; por favor no utilice estos durante la prueba. También puede ocurrir si hace clic en mientras se carga una página. Haga clic en <strong>Continuar</strong> para <strong>seguir.</strong>';
$string['submit'] = 'Entregado';
$string['submitandfinish'] = 'Entregar y terminar';
$string['submitted'] = 'Entregados: {$a}';
$string['tofilecategory'] = 'Escribir categoría a archivo';
$string['tofilecontext'] = 'Escribir contexto a archivo';
$string['uninstallqtype'] = 'Desinstalar este tipo de pregunta';
$string['unknown'] = 'Desconocido';
$string['unknownbehaviour'] = 'Comportamiento desconocido: {$a}';
$string['unknownquestion'] = 'Preguta desconocida: {$a}';
$string['unknownquestioncatregory'] = 'Categoría de pregunta descopnocida: {$a}';
$string['unknownquestiontype'] = 'Tipo de pregunta desconocido: {$a}.';
$string['unknowntolerance'] = 'Tipo de tolerancia desconocido: {$a}.';
$string['unpublished'] = 'sin publicar';
$string['upgradeproblemcategoryloop'] = 'Se ha detectado un problema al actualizar las categorías de preguntas. Hay un bucle (\'loop\') en el árbol de categorías. Las IDs de categorías afectadas son {$a}.';
$string['upgradeproblemcouldnotupdatecategory'] = 'No se ha podido actualizar la categoría de pregunta {$a->name} ({$a->id}).';
$string['upgradeproblemunknowncategory'] = 'Se ha detectado un problema al actualizar las categorías de preguntas. La catogoría {$a->id} se refiere al padre {$a->parent}, que no existe. Se ha cambiado el padre para solucionar el problema.';
$string['whethercorrect'] = 'Si es correcta';
$string['withselected'] = 'Con seleccionadas';
$string['wrongprefix'] = 'Prefino de nombre formateado erróneamente {$a}.';
$string['xoutofmax'] = '{$a->mark} sobre {$a->max}';
$string['yougotnright'] = 'Ha seleccionado correctamente {$a->num}';
$string['youmustselectaqtype'] = 'Debe seleccionar un tipo de pregunta';
$string['yourfileshoulddownload'] = 'Su archivo de exportación debería comenzar a descargarse en seguida. De no ser así, por favor <a href="{$a}">haga clic aquí</a>. Se ha cambiado el padre para solucionar el problema.';
