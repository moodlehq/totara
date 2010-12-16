<?php // $Id: version.php,v 1.1.4.10 2008/05/14 21:33:44 agrabs Exp $
/**
* Code fragment to define the version of feedback
* This fragment is called by moodle_needs_upgrading() and /admin/index.php
*
* @version $Id: version.php,v 1.1.4.10 2008/05/14 21:33:44 agrabs Exp $
* @author Andreas Grabs
* @license http://www.gnu.org/copyleft/gpl.html GNU Public License
* @package feedback
*/

    $module->version = 2008073101; // The current module version (Date: YYYYMMDDXX)
    $module->requires = 2007021532;  // Requires this Moodle version
    $feedback_version_intern = 1; //this version is used for restore older backups
    $module->cron = 0; // Period for cron to check this module (secs)

?>
