<?php

// Code to generate the data to be downloaded
//
// Called from download.php
//

// query to get the items (no pagination this time)
$exportitemlist = get_records_sql($select.$from.$where.$extrasql.$order);

$download_cols = array();
$download_data = array();
// build header row (use existing info)
foreach($myhead AS $head) {
    // print all headings except settings
    if ($head->type == 'depth' || ($head->type == 'custom' && !$framework->hidecustomfields)) {
        $download_cols[] = $head->value->$displaydepth;
        //TODO get ride of settings column in export without breaking
        // evidence count or other columns
    } else { // if ($head->type == 'extrafield') {
        $download_cols[] = $head->value->fullname;
    }
}
// loop round data rows
$i = 0;
foreach($exportitemlist AS $rowid => $item) {
    $download_data[$i] = array();
    // loop round columns
    $j = 0;
    foreach($myhead AS $head) {
        if ($head->type == 'depth') {
            if ($item->depthid == $head->value->id) {
                $download_data[$i][$j] = $item->$displayitem;
            }
        }
        if ($head->type == 'custom') {
            // check each custom field
            foreach($customfielddata AS $customfield) {
                if ($customfield->fieldid == $head->value->fieldid && $customfield->itemid == $rowid) {
                    $download_data[$i][$j] = $customfield->data;
                }
            }
        }
        if ($head->type == 'extrafield') {
            foreach($hierarchy->extrafields as $extrafield) {
                if($head->extrafield == $extrafield) {
                    $download_data[$i][$j] = $item->$extrafield;
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

