<?php

function xmldb_lplan_upgrade($oldversion=0) {

    global $CFG, $THEME, $db;

    $result = true;

    if ($result and $oldversion < 2008021200) {
        $table = new XMLDBTable('lplan_plan');

        $field1 = new XMLDBField('startdate');
        $field1->setAttributes(XMLDB_TYPE_INTEGER, 20, XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, 0);
        $result = $result && add_field($table, $field1);

        $field2 = new XMLDBField('enddate');
        $field2->setAttributes(XMLDB_TYPE_INTEGER, 20, XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, 0);
        $result = $result && add_field($table, $field2);
    }

    if ($result and $oldversion < 2008021300) {
        $table = new XMLDBTable('lplan');

        $field1 = new XMLDBField('enablefavourites');
        $field1->setAttributes(XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, 1);
        $result = $result && add_field($table, $field1);

        $field2 = new XMLDBField('enablesearch');
        $field2->setAttributes(XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, 1);

        $result = $result && add_field($table, $field2);
    }

    // New fields for the self-evaluation additions
    if ($result and $oldversion < 2008051200) {
        $table1 = new XMLDBTable('lplan_revision');
        $field1 = new XMLDBField('evaluatedtime');
        $field1->setAttributes(XMLDB_TYPE_INTEGER, '20', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0', 'visible');
        $result = $result && add_field($table1, $field1);

        $table2 = new XMLDBTable('lplan_revision');
        $field2 = new XMLDBField('evaluationcomment');
        $field2->setAttributes(XMLDB_TYPE_TEXT, 'medium', null, null, null, null, null, null, 'evaluatedtime');
        $result = $result && add_field($table2, $field2);

        $table3 = new XMLDBTable('lplan_revision_objective');
        $field3 = new XMLDBField('grade');
        $field3->setAttributes(XMLDB_TYPE_INTEGER, '8', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0', 'ctime');
        $result = $result && add_field($table3, $field3);

        $table4 = new XMLDBTable('lplan_revision_objective');
        $field4 = new XMLDBField('postapproval');
        $field4->setAttributes(XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, '0', 'grade');
        $result = $result && add_field($table4, $field4);
    }

    // Now use a NULL grade for ungraded objectives
    if ($result and $oldversion < 2008081600) {
        $table = new XMLDBTable('lplan_revision_objective');
        $field = new XMLDBField('grade');
        $field->setAttributes(XMLDB_TYPE_INTEGER, '8', XMLDB_UNSIGNED, null, null, null, null, null, 'ctime');

        $result = $result && change_field_notnull($table, $field); // Now nullable
        $result = $result && change_field_default($table, $field); // No longer has a default of 0
    }

    return $result;
}

?>
