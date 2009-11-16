<?php

function position_backup($bf, $frameworks, $options) {
     fwrite($bf,start_tag('HIERARCHY',2,true));
    fwrite($bf,full_tag('NAME', 3, false, 'position'));
    // only backup frameworks if at least one is selected
    if(is_array($frameworks) && array_keys($frameworks, '1')) {
        print '<li>Backing up frameworks</li>';
        fwrite($bf,start_tag('FRAMEWORKS',3, true));
        foreach($frameworks AS $fwid => $include) {
            if($include) {
                position_backup_framework($bf, $fwid, $options);
            }
        }
        fwrite($bf,end_tag('FRAMEWORKS', 3, true));
    }
    fwrite($bf,end_tag('HIERARCHY',2, true));
    return true;
}

function position_backup_framework($bf, $fwid, $options) {
     if(is_numeric($fwid)) {
        $framework = get_record('position_framework','id',$fwid);
    }

    $status = true;

    fwrite($bf, start_tag('FRAMEWORK', 4, true));
    fwrite($bf, full_tag('ID', 5, false, $framework->id));
    fwrite($bf, full_tag('FULLNAME', 5, false, $framework->fullname));
    fwrite($bf, full_tag('SHORTNAME', 5, false, $framework->shortname));
    fwrite($bf, full_tag('IDNUMBER', 5, false, $framework->idnumber));
    fwrite($bf, full_tag('DESCRIPTION', 5, false, $framework->description));
    fwrite($bf, full_tag('ISDEFAULT', 5, false, $framework->isdefault));
    fwrite($bf, full_tag('SORTORDER', 5, false, $framework->sortorder));
    fwrite($bf, full_tag('TIMECREATED', 5, false, $framework->timecreated));
    fwrite($bf, full_tag('TIMEMODIFIED', 5, false, $framework->timemodified));
    fwrite($bf, full_tag('USERMODIFIED', 5, false, $framework->usermodified));
    fwrite($bf, full_tag('VISIBLE', 5, false, $framework->visible));
    fwrite($bf, full_tag('HIDECUSTOMFIELDS', 5, false, $framework->hidecustomfields));
    fwrite($bf, full_tag('SHOWITEMFULLNAME', 5, false, $framework->showitemfullname));
    fwrite($bf, full_tag('SHOWDEPTHFULLNAME', 5, false, $framework->showdepthfullname));

    position_backup_position($bf, $framework->id, $options);

    fwrite($bf, end_tag('FRAMEWORK', 4, true));
}

function position_backup_position($bf, $fwid, $options) {
    if(is_numeric($fwid)) {
        $positions = get_records('position', 'frameworkid', $fwid);
    }
    if($positions) {
        fwrite($bf, start_tag('POSITIONS', 5, true));
        foreach($positions AS $position) {
            fwrite($bf, start_tag('POSITION', 6, true));
            fwrite($bf, full_tag('ID', 7, false, $position->id));
            fwrite($bf, full_tag('FULLNAME', 7, false, $position->fullname));
            fwrite($bf, full_tag('SHORTNAME', 7, false, $position->shortname));
            fwrite($bf, full_tag('IDNUMBER', 7, false, $position->idnumber));
            fwrite($bf, full_tag('DESCRIPTION', 7, false, $position->description));
            fwrite($bf, full_tag('FRAMEWORKID', 7, false, $position->frameworkid));
            fwrite($bf, full_tag('PATH', 7, false, $position->path));
            fwrite($bf, full_tag('DEPTHID', 7, false, $position->depthid));
            fwrite($bf, full_tag('PARENTID', 7, false, $position->parentid));
            fwrite($bf, full_tag('SORTORDER', 7, false, $position->sortorder));
            fwrite($bf, full_tag('VISIBLE', 7, false, $position->visible));
            fwrite($bf, full_tag('TIMEVALIDFROM', 7, false, $position->timevalidfrom));
            fwrite($bf, full_tag('TIMEVALIDTO', 7, false, $position->timevalidto));
            fwrite($bf, full_tag('TIMECREATED', 7, false, $position->timecreated));
            fwrite($bf, full_tag('TIMEMODIFIED', 7, false, $position->timemodified));
            fwrite($bf, full_tag('USERMODIFIED', 7, false, $position->usermodified));

            fwrite($bf, end_tag('POSITION', 6, true));
        }
        fwrite($bf, end_tag('POSITIONS', 5, true));
    }
}

