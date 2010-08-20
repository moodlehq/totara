<?php

/**

This function returns the custom sticky blocks definition

todo: this could be written more elegantly, but no hurry...

**/


function get_custom_stickyblocks() {

    $blocks = array();

    $pinnedblock = new_stickyblock_def();
    $id = get_field('block', 'id', 'name', 'admin');
    $pinnedblock->pagetype ='Totara';
    $pinnedblock->position = 'l';
    $pinnedblock->weight = '0';
    $pinnedblock->blockid = $id;
    $blocks[] = $pinnedblock;

    $pinnedblock = new_stickyblock_def();
    $id = get_field('block', 'id', 'name', 'calendar_month');
    $pinnedblock->pagetype ='Totara';
    $pinnedblock->position = 'r';
    $pinnedblock->weight = '0';
    $pinnedblock->blockid = $id;
    $blocks[] = $pinnedblock;

    return $blocks;

}

/*
returns basic $pinnedblock object with parameters that don't change
*/

function new_stickyblock_def() {

    $obj = new stdclass();
    $obj->position='r';
    $obj->visible = '1';
    $obj->configdata = '';

    return $obj;

}

?>

