<?php

// Code to generate the data to be downloaded
//
// Called from download.php
//

// build the header column from depth information
$myhead = array();
foreach($depths as $depth) {
    $row = new object();
    $row->type = 'depth';
    $row->value = $depth;
    $myhead[] = $row;
    foreach ($customfields AS $customfield) {
        if ($depth->id == $customfield->depthid) {
            $row = new object();
            $row->type = 'custom';
            $row->value = $customfield;
            $myhead[] = $row;
        }
    }
}

if (!empty($hierarchy->extrafield)) {
    $row = new object();
    $row->type = $hierarchy->extrafield;
    $row->value->fullname = get_string($hierarchy->extrafield, $type);
    $myhead[] = $row;
}

// query to get the items
$select = "SELECT id, depthid, shortname, fullname, visible";
if (!empty($hierarchy->extrafield)) {
    $select .= ', '.$hierarchy->extrafield;
}
$from   = " FROM {$CFG->prefix}{$type}";
$where  = " WHERE frameworkid={$framework->id} {$extrasql}";
$order  = " ORDER BY sortorder";
$myitemlist = get_records_sql($select.$from.$where.$order);

// query to get custom fields
$sql = "SELECT cdd.id,c.id as itemid, cdf.depthid, cdf.id as fieldid, cdd.data
            FROM {$CFG->prefix}{$type} c
            LEFT OUTER JOIN {$CFG->prefix}{$type}_depth_info_field cdf
            ON cdf.depthid=c.depthid
            LEFT OUTER JOIN {$CFG->prefix}{$type}_depth_info_data cdd
            ON cdd.fieldid=cdf.id AND cdd.{$type}id=c.id
            WHERE c.frameworkid=$framework->id AND cdf.hidden=0
            ORDER BY c.sortorder, cdf.categoryid, cdf.sortorder";
$mycustomfields = get_records_sql($sql);
// remove any records with no cdd.id set (fields without values)
unset($mycustomfields['']);

// display options
$displaydepth = ($framework->showdepthfullname) ? 'fullname' : 'shortname';
$displayitem = ($framework->showitemfullname) ? 'fullname' : 'shortname';

$download_cols = array();
$download_data = array();

// build header row
foreach($myhead AS $head) {
    if ($head->type == 'depth' || $head->type == 'custom') {
        $download_cols[] = $head->value->$displaydepth;
    } else {
        $download_cols[] = $head->value->fullname;
    }
}
// loop round data rows
$i = 0;
foreach($myitemlist AS $rowid => $item) {
    $download_data[$i] = array();
    // loop round columns
    $j = 0;
    foreach($myhead AS $head) {
        if ($head->type == 'depth') {
            if ($item->depthid == $head->value->depthlevel) {
                $download_data[$i][$j] = $item->$displayitem;
            }
        }
        if ($head->type == 'custom') {
            // check each custom field
            foreach($mycustomfields AS $unused => $mycustomfield) {
                if ($mycustomfield->fieldid == $head->value->id && $mycustomfield->itemid == $rowid) {
                    $download_data[$i][$j] = $mycustomfield->data;
                }
            }
        }
        if (!empty($hierarchy->extrafield)) {
            if ($head->type == $hierarchy->extrafield) {
                if($item->id == $rowid) {
                    $download_data[$i][$j] = $item->{$hierarchy->extrafield};
                }
            }
        }
        $j++;
    }
    $i++;
}

// save data to session for use on download page
$SESSION->download_cols = $download_cols;
$SESSION->download_data = $download_data;

