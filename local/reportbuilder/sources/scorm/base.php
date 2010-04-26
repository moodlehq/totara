<?php
// define the base table that query is based on
// This is the table that all the others are joined to
// In the case of SCORM, this table is actually a query, in order
// to get list of distinct events from scorm's crazy db design
// this is sloooooow...
$base = "(SELECT max(id) as id, userid, scormid, scoid, attempt from {$CFG->prefix}scorm_scoes_track GROUP BY userid, scormid, scoid, attempt) base";

