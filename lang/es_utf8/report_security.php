<?PHP // $Id$ 
      // report_security.php - created with Moodle 1.9.14 (Build: 20111010) (2007101591.06)


$string['check_configrw_details'] = '<p>Se recomienda cambiar los permisos del archivo config.php luego de la instalación para que éste no pueda ser modificado por el servidor de Internet. 
Por favor tenga en cuenta que esta medida no mejora significativamente la seguridad del servidor, aunque sí podría ralentizar o limitar el rendimiento de la computadora.</p>';
$string['check_configrw_name'] = 'config.php se puede escribir';
$string['check_configrw_ok'] = 'config.php no puede ser modificado por las secuencias de comando PHP.';
$string['check_configrw_warning'] = 'Las secuencias de comando de PHP pueden modificar a config.php';
$string['check_cookiesecure_details'] = '<p>Si habilita la comunicación https, se recomienda habilitar las cookies seguras. También debería agregar un redireccionamiento permanente de http a https.</p>';
$string['check_cookiesecure_error'] = 'Por favor habilite las cookies seguras';
$string['check_cookiesecure_name'] = 'Cookies seguras';
$string['check_cookiesecure_ok'] = 'Cookies seguras habilitadas';
$string['check_courserole_anything'] = 'La capacidad de \"hacerlo todo\" no debe permitirse en este <a href=\"$a\">context</a>.';
$string['check_courserole_details'] = '<p>Cada curso tiene un rol específico por defecto al apuntarse. Por favor asegúrese que no se permitirán capacidades riesgosas para este rol.</p>
</p>El único tipo de legado que es compatible con el rol de curso por defecto es <em>Student</em>.</p>';
$string['check_courserole_error'] = '¡Se detectaron roles de curso por defecto que están incorrectamente definidos!';
$string['check_courserole_name'] = 'Roles por defecto (cursos)';
$string['check_courserole_ok'] = 'Las definiciones del rol del curso por defecto están bien.';
$string['check_courserole_risky'] = 'Capacidades riesgosas detectadas en <a href=\"$a\">context</a>.';
$string['check_courserole_riskylegacy'] = 'Tipo de legado riesgoso detectado en <a href=\"$a->url\">$a->shortname</a>.';
$string['check_defaultcourserole_anything'] = 'No se debe permitir la capacidad de \"hacerlo todo\" en este <a href=\"$a\">context</a>.';
$string['check_defaultcourserole_details'] = '<p> El rol del estudiante por defecto para apuntarse en el curso especifica el rol por defecto para los cursos. Por favor asegúrese que no se permitirá ninguna capacidad riesgosa en este rol.</p>
<p>El único tipo de legado que es compatible para el rol por defecto es <em>Student</em>.</p>';
$string['check_defaultcourserole_error'] = '¡Se detectó el rol de curso por defecto \"$a\" que está incorrectamente definido!';
$string['check_defaultcourserole_legacy'] = 'Se detectó un tipo de legado riesgoso.';
$string['check_defaultcourserole_name'] = 'Rol del curso por defecto (global)';
$string['check_defaultcourserole_notset'] = 'No está configurado el rol por defecto.';
$string['check_defaultcourserole_ok'] = 'La definición del rol por defecto del sitio está bien.';
$string['check_defaultcourserole_risky'] = 'Se detectaron capacidades riesgosas en <a href=\"$a\">context</a>.';
$string['check_defaultuserrole_details'] = '<p>Todos los usuarios que han accesado son capacidades dadas del rol del usuario por defecto. Por favor asegúrese de no permitir capacidades riesgosas en este rol.</p>
<p>El único tipo de legado que es compatible para el rol del usuario por defecto es <em>Authenticated user</em>. No se debe habilitar ver capacidad del curso.';
$string['check_defaultuserrole_error'] = '¡El rol del usuario por defecto $a está incorrectamente definido!';
$string['check_defaultuserrole_name'] = 'Rol por defecto para todos los usuarios';
$string['check_defaultuserrole_notset'] = 'Rol por defecto no está configurado.';
$string['check_defaultuserrole_ok'] = 'La definición del rol por defecto para todos los usuarios está bien.';
$string['check_displayerrors_details'] = '<p>No se recomienda habilitar la configuración PHP <code>display_errors</code> en los sitios de producción porque los mensajes de error pueden revelar información delicada de su servidor.</p>';
$string['check_displayerrors_error'] = 'Se habilitó la configuración PHP para mostrar los errores. Se recomienda dejarla deshabilitada.';
$string['check_displayerrors_name'] = 'Mostrar los errores de PHP';
$string['check_displayerrors_ok'] = 'Mostrar los errores de PHP desactivado';
$string['check_emailchangeconfirmation_details'] = 'Se recomienda configurar el email cuando los usuarios lo cambian en su perfil. Si se deshabilita, los spammers intentarán hacer uso del servidor para mandar correo basura.</p>
<p> También debe bloquear el campo del email contra los plugins de autentificación. Aquí no se contempla esta posibilidad.</p>';
$string['check_emailchangeconfirmation_error'] = 'Los usuarios pueden ingresar cualquier dirección de email.';
$string['check_emailchangeconfirmation_info'] = 'Los usuarios pueden ingresar direcciones de emails sólo de dominios autorizados.';
$string['check_emailchangeconfirmation_name'] = 'Confirmación de cambio de email';
$string['check_emailchangeconfirmation_ok'] = 'Confirmación de cambio de la dirección del email en el perfil del usuario';
$string['check_embed_details'] = '<p>Es muy peligroso la incrustación ilimitada de objetos - cualquier usuario registrado puede lanzar un ataque XSS contra otros usuarios del servidor. Esta configuración debe deshabilitarse en los servidores de producción.</p>';
$string['check_embed_error'] = 'Se habilitó la incrustación de objetos ilimitada - esto es muy peligros para la mayoría de los servidores.';
$string['check_embed_name'] = 'Permitir INCRUST y OBJETO';
$string['check_embed_ok'] = 'La incrustación de objetos ilimitados no está permitida.';
$string['check_frontpagerole_details'] = '<p>EL rol de la página de portada es dado a todos los usuarios registrados para las actividades de la página de portada. Por favor asegúrese de no permitir capacidades riesgosas para este rol.</p>
<p>Se recomienda que se cree un rol especial para este propósito y que no se use un rol del tipo de legado.</p>';
$string['check_frontpagerole_error'] = '¡Se detectó el rol \"$a\" de la página de portada que está incorrectamente definido!';
$string['check_frontpagerole_name'] = 'Rol de la página de portada';
$string['check_frontpagerole_notset'] = 'El rol de la página de portada no está configurado.';
$string['check_frontpagerole_ok'] = 'La definición del rol de la página de portada está bien.';
$string['check_globals_details'] = '<p>Se considera que \"register globals\" es una configuración PHP altamente insegura.</p>
<p><code>register_globals=off</code> debe seleccionarse en la configuración de PHP. Esta opción se controla editando su <code>php.ini</code>, Apache/IIS configuration o <code>.htaccess</code> file.</p>';
$string['check_globals_error'] = '¡\"Register globals\" DEBE estar desactivado. Por favor corrija la configuración PHP del servidor inmediatamente!';
$string['check_globals_name'] = 'Register globals';
$string['check_globals_ok'] = 'Register globals está desactivado';
$string['check_google_details'] = '<p> La configuración Abierto a Google permite que los motores de búsqueda entren a cursos sin ser usuarios registrados. No tiene sentido habilitar esta configuración si el acceso del huésped no está permitido.</p>';
$string['check_google_error'] = 'Se permite el acceso de los motores de búsqueda pero se deshabilita el acceso de huéspedes.';
$string['check_google_info'] = 'Los motores de búsqueda pueden ingresar como huéspedes.';
$string['check_google_name'] = 'Abierto a Google';
$string['check_google_ok'] = 'El acceso de los motores de búsqueda no está habilitado.';
$string['check_guestrole_details'] = '<p> El rol del huésped se usa para huéspedes, no pra usuarios que han accesado o acceso al curso como huésped temporario. Por favor asegúrese no permitir capacidades riesgosas en este rol.</p>
<p>El único tipo de legado compatible par el rol del huésped es <em>Guest</em>.</p>';
$string['check_guestrole_error'] = '¡El rol de huésped \"$a\" está incorrectamente definido!';
$string['check_guestrole_name'] = 'Rol de huésped';
$string['check_guestrole_notset'] = 'El rol de huésped no está configurado.';
$string['check_guestrole_ok'] = 'La definición del rol de huésped está bien.';
$string['check_mediafilterswf_details'] = '<p>La inscrustación automática swf es muy peligrosa - cualquier usuario registrado puede lanzar un ataque XSS contra otros usuarios del servidor. Por favor deshabilítela en los servidores de producción.</p>';
$string['check_mediafilterswf_error'] = 'Se habilitó el filtro de media Flash - esto es muy peligros para la mayoría de los servidores.';
$string['check_mediafilterswf_name'] = 'El filtro media .swf está habilitado';
$string['check_mediafilterswf_ok'] = 'El filtro media Flash no está habilitado.';
$string['check_noauth_details'] = '<p>El plugin <em>No authentication</em> no está pensado para sitios de producción. Por favor deshabilítelo a menos que éste sea un sitio de prueba.</p>';
$string['check_noauth_error'] = 'El plugin de No autentificación no puede ser utilizado en sitios de producción.';
$string['check_noauth_name'] = 'No hay autentificación';
$string['check_noauth_ok'] = 'El plugin de No autentificación está deshabilitado.';
$string['check_openprofiles_details'] = '<p>Los perfiles abiertos de usuarios pueden sufrir abuso de los spammers. Se recomienda que se habiliten tanto el <code>Force users to login for profiles</code> o <code>Force users to login</code>.</p>';
$string['check_openprofiles_error'] = 'Cualquiera puede ver los perfiles de los usuarios sin acceder.';
$string['check_openprofiles_name'] = 'Abrir los perfiles de los usuarios';
$string['check_openprofiles_ok'] = 'Se requiere acceder antes de ve los perfiles de los usuarios.';
$string['check_passwordpolicy_details'] = '<p>Se recomienda fijar una política de contraseñas, ya que adivinar contraseñas es generalmente la forma más fácil de conseguir el acceso sin autorización. Tampoco sea muy estricto con los requisitos, ya que los usuarios pueden olvidar sus contraseñas o escribirlas.';
$string['check_passwordpolicy_error'] = 'La política de contraseñas no está activada.';
$string['check_passwordpolicy_name'] = 'Política de contraseñas';
$string['check_passwordpolicy_ok'] = 'Política de contraseñas habilitada';
$string['check_passwordsaltmain_details'] = '<p>Configurar la sal de una contraseña reduce enormemente el riesgo de robo de contraseñas.</p>
<p>Para configurar una sal, agregue la siguiente línea a su archivo config.php:
</p>
<code>\$CFG->passwordsaltmain = \'some long random string here with lots of characters\';</code>
<p>La cadena al azar de caracteres debe ser una mezcla de letras, números y otros caracteres. Se recomienda de una longitud de al menos 40 caracteres.</p>
<p>Por favor consulte el <a href=\"$a\" target=\"_blank\">la documentación para salar la contraseña</a> si desea cambiar la sal de al contraseña. Una vez configurada, NO borre la sal de la contraseña, ¡de lo contrario no podrá  acceder más a su sitio!</p>';
$string['check_passwordsaltmain_name'] = 'Sal de la contraseña';
$string['check_passwordsaltmain_ok'] = 'La sal de la contraseña está bien';
$string['check_passwordsaltmain_warning'] = 'No se ha configurado ninguna sal de la contraseña';
$string['check_passwordsaltmain_weak'] = 'La sal de la contraseña es débil';
$string['check_riskadmin_detailsok'] = '<p>Por favor verifique que la siguiente lista de administradores del sistema:</p>$a';
$string['check_riskadmin_detailswarning'] = '<p>Por favor verifique la siguiente lista de administradores del sistema:</p>$a->admins
<p>Se recomienda asignar el rol de administrador solo en el contexto del sistema. Los siguientes usuarios tienen tareas de rol de admin no compatibles en otros contextos:</p>$a->unsupported';
$string['check_riskadmin_name'] = 'Administradores';
$string['check_riskadmin_ok'] = 'Se encontró $a administrador(es) del sistema.';
$string['check_riskadmin_unassign'] = '<a href=\"$a->url\">$a->fullname ($a->email) review role assignment</a>';
$string['check_riskadmin_warning'] = 'Se encontró $a->admincount administradores del sistema y $a->unsupcount tareas del rol de admin no compatible.';

?>
