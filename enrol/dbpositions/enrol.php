<?php  // $Id$

// dbpositions enrollment plugin is based on the contrib/dbuserrel
// plugin, with the addition of syncing position assignments

require_once($CFG->dirroot.'/enrol/enrol.class.php');

class enrolment_plugin_dbpositions {

    var $log;

/*
 * For the given user, let's go out and look in an external database
 * for an authoritative list of relationships, and then adjust the
 * local Moodle assignments to match.
 */
function setup_enrolments(&$user=null) {
    global $CFG;

    // Store the field values in some shorter variable names to ease reading of the code.
    $flocalsubject  = $CFG->enrol_dbpositions_localsubjectuserfield;
    $flocalobject   = $CFG->enrol_dbpositions_localobjectuserfield;
    $flocalrole     = $CFG->enrol_dbpositions_localrolefield;
    $fremotesubject = $CFG->enrol_dbpositions_remotesubjectuserfield;
    $fremoteobject  = $CFG->enrol_dbpositions_remoteobjectuserfield;
    $fremoterole    = $CFG->enrol_dbpositions_remoterolefield;
    $dbtable        = $CFG->enrol_dbpositions_table;

    // NOTE: if $this->enrol_connect() succeeds you MUST remember to call
    // $this->enrol_disconnect() as it is doing some nasty vodoo with $CFG->prefix
    $enroldb = $this->enrol_connect();
    if (!$enroldb) {
        error_log('Error: [ENROL_DBPOSITIONS] Could not make a connection');
        return;
    }


    if ($user) {
        $subjectfield = $enroldb->quote($user->{$flocalsubject});
        $objectfield = $enroldb->quote($user->{$flocalobject});

        $sql = "SELECT * FROM {$dbtable}
            WHERE {$fremotesubject} = $subjectfield
            OR {$fremoteobject} = $objectfield";
    } else {
        $sql = "SELECT * FROM {$dbtable}";
    }

    if ($rs = $enroldb->Execute($sql)) {


        $sql = "SELECT r.{$flocalrole} || '|' || u1.{$flocalsubject} || '|' || u2.{$flocalobject} AS unique,
            ra.*, r.{$flocalrole} ,
            u1.{$flocalsubject} AS subjectid,
            u2.{$flocalobject} AS objectid
            FROM {$CFG->prefix}role_assignments ra
            JOIN {$CFG->prefix}role r ON ra.roleid = r.id
            JOIN {$CFG->prefix}context c ON c.id = ra.contextid
            JOIN {$CFG->prefix}user u1 ON ra.userid = u1.id
            JOIN {$CFG->prefix}user u2 ON c.instanceid = u2.id
            WHERE c.contextlevel = " . CONTEXT_USER .
            (!empty($user) ?  " AND c.instanceid = {$user->id} OR ra.userid = {$user->id}" : '');

        if (!$existing = get_records_sql($sql)) {
            $existing = array();
        }

        if (!$rs->EOF) {

            $roles = get_records('role', '', '', '', $flocalrole . ",*");
            $subjectusers = array(); // cache of mapping of localsubjectuserfield to mdl_user.id (for get_context_instance)
            $objectusers = array(); // cache of mapping of localobjectuserfield to mdl_user.id (for get_context_instance)
            $contexts = array(); // cache

            $rels = array();
            while ($row = rs_fetch_next_record($rs)) {
                // either we're assigning ON the current user, or TO the current user
                $key = $row->{$fremoterole} . '|' . $row->{$fremotesubject} . '|' . $row->{$fremoteobject};
                if (array_key_exists($key, $existing)) {
                    // exists in moodle db already, unset it (so we can delete everything left)
                    unset($existing[$key]);
                    error_log("Warning: [$key] exists in moodle already");
                    continue;
                }

                if (!array_key_exists($row->{$fremoterole}, $roles)) {
                    // role doesn't exist in moodle. skip.
                    error_log("Warning: role " . $row->{$fremoterole} . " wasn't found in moodle.  skipping $key");
                    continue;
                }
                if (!array_key_exists($row->{$fremotesubject}, $subjectusers)) {
                    $subjectusers[$row->{$fremotesubject}] = get_field('user', 'id', $flocalsubject, $row->{$fremotesubject});
                }
                if ($subjectusers[$row->{$fremotesubject}] == false) {
                    error_log("Warning: [" . $row->{$fremotesubject} . "] couldn't find subject user -- skipping $key");
                    // couldn't find user, skip
                    continue;
                }

                if (!array_key_exists($row->{$fremoteobject}, $objectusers)) {
                    $objectusers[$row->{$fremoteobject}] = get_field('user', 'id', $flocalobject, $row->{$fremoteobject});
                }
                if ($objectusers[$row->{$fremoteobject}] == false) {
                    // couldn't find user, skip
                    error_log("Warning: [" . $row->{$fremoteobject} . "] couldn't find object user --  skipping $key");
                    continue;
                }
                $context = get_context_instance(CONTEXT_USER, $objectusers[$row->{$fremoteobject}]);
                error_log("Information: [" . $row->{$fremotesubject} . "] assigning " . $row->{$fremoterole} . " to " . $row->{$fremotesubject}
                   . " on " . $row->{$fremoteobject});
                role_assign($roles[$row->{$fremoterole}]->id, $subjectusers[$row->{$fremotesubject}], 0, $context->id, 0, 0, 0, 'dbpositions');
            }

            // delete everything left in existing
            foreach ($existing as $key => $assignment) {
                if ($assignment->enrol == 'dbpositions') {
                    error_log("Information: [$key] unassigning $key");
                    role_unassign($assignment->roleid, $assignment->userid, 0, $assignment->contextid);
                }
            }
        } else {
            error_log('Warning: [ENROL_DBPOSITIONS] Couldn\'t get rows from external db: '.$enroldb->ErrorMsg(). ' -- no relationships to assign');
        }
    }
    $this->enrol_disconnect($enroldb);
}


/// Overide the get_access_icons() function
function get_access_icons($course) {
}


/// Overide the base config_form() function
function config_form($frm) {
    global $CFG;

    $vars = array(
        'type', 'host', 'user', 'pass', 'name', 'userenroldatabase',
        'useauthdb', 'table', 'localsubjectuserfield', 'localobjectuserfield',
        'remotesubjectuserfield', 'remoteobjectuserfield', 'remoterolefield', 'localrolefield',
        'useauthdb', 'useenroldatabase',
        );

    foreach ($vars as $var) {
        $var = 'enrol_dbpositions_' . $var;
        if (!isset($frm->$var)) {
            $frm->$var = '';
        }
    }
    include("$CFG->dirroot/enrol/dbpositions/config.html");
}

/// Override the base process_config() function
function process_config($config) {
    foreach ((array)$config as $key => $value) {
        if (strpos($key, 'enrol_dbpositions_') !== 0) {
            continue;
        }
        set_config($key, $value);
    }

    return true;
}

function enrol_connect() {
    global $CFG;

    // make up settings!
    $type = '';
    $host = '';
    $user = '';
    $pass = '';
    $name = '';
    $copyobj = $CFG;
    $copyprefix = 'enrol_dbpositions_';
    if (!empty($CFG->enrol_dbpositions_userenroldatabase)) {
        $copyprefix = 'enrol_db';
    }
    else if (!empty($CFG->enrol_dbpositions_useauthdb)) {
        $copyobj = get_config('auth/db');
        $copyprefix = '';
    }
    foreach (array('type', 'host', 'user', 'pass', 'name') as $setting) {
        $$setting = $copyobj->{$copyprefix . $setting};
    }
    // Try to connect to the external database (forcing new connection)
    $enroldb = &ADONewConnection($type);
    if ($enroldb->Connect($host, $user, $pass, $name, true)) {
        $enroldb->SetFetchMode(ADODB_FETCH_ASSOC); ///Set Assoc mode always after DB connection
        return $enroldb;
    } else {
        trigger_error("Error connecting to enrolment DB backend with: "
                      . "$host,$user,$pass,$name");
        return false;
    }
}

/// DB Disconnect
function enrol_disconnect($enroldb) {
    global $CFG;

    $enroldb->Close();
}

} // end of class


?>
