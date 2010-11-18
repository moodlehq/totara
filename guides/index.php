<?php
require_once("../config.php");
require_once("lib.php");
require_login();
$uid = optional_param('uid', 0, PARAM_INT);
$context = get_context_instance(CONTEXT_SYSTEM);

$navlinks = array();
$strguides = get_string('guides','block/guides');
$strstartguide = get_string('startguide','block/guides');
$strcontinueguide = get_string('continueguide','block/guides');
$strrestartguide = get_string('restartguide', 'block/guides');
$strviewguide = get_string('viewguide','block/guides');
$strguidesinprogress = get_string('guidesinprogress','block/guides');
$strnoguidesinprogress = get_string('noguidesinprogress','block/guides');
$strnoguidesavailable = get_string('noguidesavailable','block/guides');
$strguidesavailable = get_string('guidesavailable','block/guides');
$navlinks[] = array('name' => $strguides, 'link' => null, 'type' => 'misc');
$navigation = build_navigation($navlinks);

if (empty($uid)) {
    $uid = $USER->id;
}
if ($uid != $USER->id) {
    if (!has_capability('block/guides:viewothersguide', $context)) {
        print_header(" ", " ", $navigation, "", "", true);
        error("You're not permitted to view the guides of other users");
        print_footer();
    }
} else {
    if (!has_capability('block/guides:viewownguide', $context)) {
        print_header(" ", " ", $navigation, "", "", true);
        error("There is no guide instance for you to see matching that id");
        print_footer();
    }
}

$gissql = 'SELECT g.id, gi.currentstep, gi.guide, gi.id as giid, g.steps, g.name, g.description ' .
            'FROM ' . $CFG->prefix . 'block_guides_guide g' .
            ' INNER JOIN ' . $CFG->prefix . 'block_guides_guide_instance gi ON gi.guide = g.id ' .
            'WHERE gi.deleted = 0 AND gi.userid = ' . $USER->id . ' ' .
            'ORDER by g.id asc';
$guideinstances = get_records_sql($gissql);
if (empty($guideinstances)) {
    $guideinstances = array();
}
$guides = get_records('block_guides_guide','deleted',0,'id asc');
if (empty($guides)) {
    $guides = array();
}

print_header($strguidesinprogress. ': ', $strguidesinprogress . ': ', $navigation, "", "", true);

if ($guideinstances) {
    foreach ($guideinstances as $guideid => $guideinstance) {
        $efforttotal = 0;
        $effortdone = 0;
        measure_gi_progress($guideinstance, array(), $efforttotal, $effortdone);
        $percentvalue = $effortdone / $efforttotal * 100;
        $pixelvalue = $effortdone / $efforttotal * 121;
        $guideinstances[$guideid]->pixeloffset = round($pixelvalue - 120);
        $guideinstances[$guideid]->progress = round($percentvalue);
    }
}

print_heading($strguidesavailable);

if ($guides) {
    print '<table class="generalbox guides boxaligncenter">';
    print '<tr class="header"><th class="header name">'.get_string('guide', 'blocks/guides').'</th><th class="header description">'.get_string('description').'</th><th class="header status">'.get_string('status','blocks/guides').'</th><th class="header options">'.get_string('options', 'blocks/guides').'</th></tr>';
    $rowcount = 0;
    foreach ($guides as $guide) {
        if (isset($guideinstances[$guide->id]))
            print '<tr class="r'.$rowcount.'">' . "\n" . '<td><span class="guideindextitle"><a href="' . $CFG->wwwroot . '/guides/view.php?gi=' . $guideinstances[$guide->id]->giid .'">'.$guide->name . '</a></span>';
        else
            print '<tr class="r'.$rowcount.'">' . "\n" . '<td><span class="guideindextitle">' . $guide->name . '</a></span>';
        print '<td class="cell"><span class="guideindexdescription">' . $guide->description . '</span>';
        print '<td class="cell"><span class="guideindexlink">';
        if (isset($guideinstances[$guide->id])) {
            print ' <a href="' . $CFG->wwwroot . '/guides/view.php?gi=' . $guideinstances[$guide->id]->giid . '">';
            if ($guideinstances[$guide->id]->progress == 100) {
                print $strviewguide;
                print '</td><td class="cell options"><a href="/guides/delete.php?gi=' . $guideinstances[$guide->id]->giid . '">';
                print '<img src="' . $CFG->wwwroot . '/theme/' . $CFG->theme . '/pix/t/delete.gif" class="iconsmall" alt="delete guide progress" />';
            } else {
                print '</a><img src="' . $CFG->wwwroot . '/guides/percentImage.png" alt="' . $guideinstances[$guide->id]->progress . '%" style="background: white url(' . $CFG->wwwroot . '/guides/percentImage_back.png) top left no-repeat;padding: 0;margin: 5px 0 0 0;background-position: ' . $guideinstances[$guide->id]->pixeloffset . 'px 0pt;" /> ';
                print ' ' . $guideinstances[$guide->id]->progress. ' %<br/>';
                print '<td class="cell options"><a href="/guides/delete.php?gi=' . $guideinstances[$guide->id]->giid . '">';
                print '<img src="' . $CFG->wwwroot . '/theme/' . $CFG->theme . '/pix/t/delete.gif" class="iconsmall" alt="delete guide progress" />';
            }
        } else {
            print 'Not yet started' . '</td><td class="cell options">';
            print ' <a href="' . $CFG->wwwroot . '/guides/view.php?startguide=' . $guide->id . '">';
            print '<img src="' . $CFG->wwwroot . '/theme/' . $CFG->theme . '/pix/t/add.gif" class="iconsmall" alt="delete guide progress" />';

        }
        print '</a></span></td></tr>' . "\n";
        $rowcount = ($rowcount + 1) % 2;
    }
    print "</table>\n";
} else {
    print_heading($strnoguidesavailable,'center',3);
}
print '<div class="clearer"></div>';
print_footer();

?>

