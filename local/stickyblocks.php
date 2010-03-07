<?php

/**

This function returns the custom sticky blocks definition

todo: this could be written more elegantly, but no hurry...

**/


function get_custom_stickyblocks() {

    $blocks = array();

    //Learning Path sticky blocks
    $pinnedblock = new_stickyblock_def();
    $id = get_field('block', 'id', 'name', 'mitms_my_learning_nav');
    $pinnedblock->pagetype ='MITMS';
    $pinnedblock->position = 'l';
    $pinnedblock->weight = '0';
    $pinnedblock->blockid = $id;
    $blocks[] = $pinnedblock;

    $pinnedblock = new_stickyblock_def();
    $id = get_field('block', 'id', 'name', 'admin');
    $pinnedblock->pagetype ='MITMS';
    $pinnedblock->position = 'l';
    $pinnedblock->weight = '1';
    $pinnedblock->blockid = $id;
    $blocks[] = $pinnedblock;

    $pinnedblock = new_stickyblock_def();
    $id = get_field('block', 'id', 'name', 'calendar');
    $pinnedblock->pagetype ='MITMS';
    $pinnedblock->position = 'r';
    $pinnedblock->weight = '0';
    $pinnedblock->blockid = $id;
    $blocks[] = $pinnedblock;

    $pinnedblock = new_stickyblock_def();
    $id = get_field('block', 'id', 'name', 'mitms_my_team_nav');
    $pinnedblock->pagetype ='MITMS';
    $pinnedblock->position = 'r';
    $pinnedblock->weight = '1';
    $pinnedblock->blockid = $id;
    $blocks[] = $pinnedblock;

    $pinnedblock = new_stickyblock_def();
    $id = get_field('block', 'id', 'name', 'mitms_report_manager');
    $pinnedblock->pagetype ='MITMS';
    $pinnedblock->position = 'r';
    $pinnedblock->weight = '2';
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

