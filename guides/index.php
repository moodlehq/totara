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
//print_heading($strguidesinprogress);

if ($guideinstances) {
    //print '<div class="guideinstancewrapper">';
    foreach ($guideinstances as $guideid => $guideinstance) {
        $efforttotal = 0;
        $effortdone = 0;
        measure_gi_progress($guideinstance, array(), $efforttotal, $effortdone);
        $percentvalue = $effortdone / $efforttotal * 100;
        $pixelvalue = $effortdone / $efforttotal * 121;
        $pixeloffset = round($pixelvalue - 120);
        $percent = round($percentvalue);
        $guideinstances[$guideid]->progress = $percent;
        /*print '<div class="guideindexbody">';
        print '<form action="' . $CFG->wwwroot . '/guides/delete.php?gi=' . $guideinstance->giid . '" method="post">';
        print '<span class="guideindexindication">';
        print '</span>';
        print '<span class="guideindexnamecontrol">';
        print '<a href="' . $CFG->wwwroot . '/guides/view.php?gi=' . $guideinstance->giid .'">';
        print $guideinstance->name;
        print '</a>';
        print ' <input type="hidden" name="gi" value="' . $guideinstance->giid . '" />';
        print '<input type="image" src="' . $CFG->wwwroot . '/theme/' . $CFG->theme . '/pix/t/delete.gif" class="iconsmall" alt="delete guide progress" />';
        print '</span>';
        print '</form>';
        print '</div>';*/
    }
}

print_heading($strguidesavailable);

if ($guides) {
    print '<table class="generalbox guides boxaligncenter">';
    print '<tr class="header"><th class="name">'.get_string('guide', 'blocks/guides').'</th><th class="description">'.get_string('description').'</th><th class="status">'.get_string('status','blocks/guides').'</th><th class="options">'.get_string('options', 'blocks/guides').'</th></tr>';
    $rowcount = 0;
    foreach ($guides as $guide) {
        if (isset($guideinstances[$guide->id]))
            print '<tr class="r'.$rowcount.'">' . "\n" . '<td><span class="guideindextitle"><a href="' . $CFG->wwwroot . '/guides/view.php?gi=' . $guideinstances[$guide->id]->giid .'">'.$guide->name . '</a></span>';
        else
            print '<tr class="r'.$rowcount.'">' . "\n" . '<td><span class="guideindextitle">' . $guide->name . '</a></span>';
        print '<td><span class="guideindexdescription">' . $guide->description . '</span>';
        print '<td><span class="guideindexlink">';
        if (isset($guideinstances[$guide->id])) {
            print ' <a href="' . $CFG->wwwroot . '/guides/view.php?gi=' . $guideinstances[$guide->id]->giid . '">';
            if ($guideinstances[$guide->id]->progress == 100) {
                print $strviewguide;
                print '</td><td><a href="/guides/delete.php?gi=' . $guideinstances[$guide->id]->giid . '">';
                print '<img src="' . $CFG->wwwroot . '/theme/' . $CFG->theme . '/pix/t/delete.gif" class="iconsmall" alt="delete guide progress" />';
            } else {
                print '</a><img src="' . $CFG->wwwroot . '/guides/percentImage.png" alt="' . $guideinstances[$guide->id]->progress . '%" style="background: white url(/guides/percentImage_back.png) top left no-repeat;padding: 0;margin: 5px 0 0 0;background-position: ' . $pixeloffset . 'px 0pt;" /> ';
                print ' ' . $guideinstances[$guide->id]->progress. ' %<br/>';
                print '<td><a href="/guides/delete.php?gi=' . $guideinstances[$guide->id]->giid . '">';
                print '<img src="' . $CFG->wwwroot . '/theme/' . $CFG->theme . '/pix/t/delete.gif" class="iconsmall" alt="delete guide progress" />';
            }
        } else {
            print 'Not yet started' . '</td><td>';
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

