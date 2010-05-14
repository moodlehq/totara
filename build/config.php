<?php  /// Moodle Configuration File

$ROOT = '/var/lib/hudson/jobs/Totara';

$CFG            = new stdClass();
$CFG->dbtype    = 'postgres7';
$CFG->dbhost    = 'user=\'hudson\' password=\'password\' dbname=\'mdl19-hudsontesting\'';
$CFG->dbpersist =  false;
$CFG->prefix    = 'mdl_';

$CFG->wwwroot   = 'http://'.$_SERVER['SERVER_NAME'];
$CFG->dirroot   = $ROOT.'/workspace';
$CFG->dataroot  = $ROOT.'/moodledata/';
$CFG->admin     = 'admin';

$CFG->directorypermissions = 00777;  // try 02777 on a server in Safe Mode

$CFG->debug = 38911;
$CFG->debugdisplay = 0;
#$CFG->perfdebug = 1;

if (!empty($_GET['magicponies'])) {
    echo '<pre>';
    var_dump($CFG);
    die();
}

unset($ROOT);

require_once("$CFG->dirroot/lib/setup.php");
