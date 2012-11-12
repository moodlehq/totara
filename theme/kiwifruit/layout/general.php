<?php

/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2012 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Paul Walker <paul.walker@catalyst-eu.net>
 * @package totara
 * @subpackage theme
 *
 * @copyright Totara Learning Solutions Ltd
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$hasheading = $PAGE->heading;
$hasnavbar = (empty($PAGE->layout_options['nonavbar']) && $PAGE->has_navbar());
$hasfooter = (empty($PAGE->layout_options['nofooter']));
$haslogininfo = (empty($PAGE->layout_options['nologininfo']));

$hassidepre = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('side-pre', $OUTPUT));
$hassidepost = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('side-post', $OUTPUT));

$showsidepre = $hassidepre && !$PAGE->blocks->region_completely_docked('side-pre', $OUTPUT);
$showsidepost = $hassidepost && !$PAGE->blocks->region_completely_docked('side-post', $OUTPUT);

$showmenu = empty($PAGE->layout_options['nocustommenu']);

// if the site has defined a custom menu we display that,
// otherwise we show the totara menu. This allows sites to
// replace the totara menu with their own custom navigation
// easily
$custommenu = $OUTPUT->custom_menu();
$hascustommenu = !empty($custommenu);

if ($showmenu && !$hascustommenu) {
    // load totara menu
    $menudata = totara_build_menu();
    $totara_core_renderer = $PAGE->get_renderer('totara_core');
    $totaramenu = $totara_core_renderer->print_totara_menu($menudata);
}

$displaylogo = !isset($PAGE->theme->settings->displaylogo) || $PAGE->theme->settings->displaylogo;

$bodyclasses = array();
if ($showsidepre && !$showsidepost) {
    $bodyclasses[] = 'side-pre-only';
} else if ($showsidepost && !$showsidepre) {
    $bodyclasses[] = 'side-post-only';
} else if (!$showsidepost && !$showsidepre) {
    $bodyclasses[] = 'content-only';
}

if (!empty($PAGE->theme->settings->frontpagelogo)) {
    $logourl = $PAGE->theme->settings->frontpagelogo;
} else if (!empty($PAGE->theme->settings->logo)) {
    $logourl = $PAGE->theme->settings->logo;
} else {
    $logourl = $OUTPUT->pix_url('logo', 'theme');
}

if (!empty($PAGE->theme->settings->favicon)) {
    $faviconurl = $PAGE->theme->settings->favicon;
} else {
    $faviconurl = $OUTPUT->pix_url('favicon', 'theme');
}

$hasframe = !isset($PAGE->theme->settings->noframe) || !$PAGE->theme->settings->noframe;

echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes() ?>>
<head>
<title><?php echo $PAGE->title ?></title>
<meta name="description" content="<?php p(strip_tags(format_text($SITE->summary, FORMAT_HTML))) ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="generator" content="<?php echo get_string('poweredby', 'totara_core'); ?>" />
<link rel="shortcut icon" href="<?php echo $faviconurl; ?>" />
<?php echo $OUTPUT->standard_head_html() ?>
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans|Open+Sans:300|Open+Sans:400|Open+Sans:700">
</head>
<body id="<?php p($PAGE->bodyid) ?>" class="<?php p($PAGE->bodyclasses.' '.join(' ', $bodyclasses)) ?>">
<?php echo $OUTPUT->standard_top_of_body_html() ?>
<div id="page">
  <div id="wrapper" class="clearfix">

<!-- START OF HEADER -->

    <div id="page-header" class="clearfix">
      <div class="page-header-inner">
        <div id="page-header-wrapper" class="clearfix">
          <?php if ($logourl == NULL) { ?>
          <div id="logo"><a href="<?php echo $CFG->wwwroot; ?>">&nbsp;</a></div>
          <?php } else { ?>
          <div id="logo" class="custom"><a href="<?php echo $CFG->wwwroot; ?>"><img class="logo" src="<?php echo $logourl;?>" alt="Logo" /></a></div>
          <?php } ?>
          <div class="headermenu">
            <?php
            if (!empty($PAGE->layout_options['langmenu'])) {
                echo $OUTPUT->lang_menu();
            } ?>
            <?php if ($haslogininfo) { ?>
                <div id="profileblock">
                <?php echo $OUTPUT->login_info(); ?>
                </div>
            <?php } ?>
          </div>
        <?php if ($showmenu) { ?>
        <div id="main_menu" class="clearfix">
          <?php if ($hascustommenu) { ?>
          <div id="custommenu"><?php echo $custommenu; ?></div>
          <?php } else { ?>
          <div id="totaramenu"><?php echo $totaramenu; ?></div>
          <?php } ?>
        </div>
        <?php } ?>
        </div>
      </div>
    </div>

<!-- END OF HEADER -->

<!-- START OF CONTENT -->
    <div id="page-content-wrapper">
      <div id="page-content">
        <div class="navbar clearfix">
          <?php if ($hasnavbar) { ?>
          <div class="breadcrumb"><?php echo $OUTPUT->navbar(); ?></div>
          <div class="navbutton"> <?php echo $PAGE->button; ?></div>
          <?php } ?>
        </div>
        <div id="region-main-box">
          <div id="region-post-box">
            <div id="region-main-wrap">
              <div id="region-main">
                <div class="region-content"> <?php echo core_renderer::MAIN_CONTENT_TOKEN ?> </div>
              </div>
            </div>
            <?php if ($hassidepre) { ?>
            <div id="region-pre" class="block-region">
              <div class="region-content"> <?php echo $OUTPUT->blocks_for_region('side-pre') ?> </div>
            </div>
            <?php } ?>
            <?php if ($hassidepost) { ?>
            <div id="region-post" class="block-region">
              <div class="region-content"> <?php echo $OUTPUT->blocks_for_region('side-post') ?> </div>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
    <div class="clear"></div>
    </div>

<!-- END OF CONTENT -->
  </div>
  <div class="push"></div>
</div>
<!-- START OF FOOTER -->
    <?php if ($hasfooter) { ?>

      <div id="page-footer">
        <div class="footer-content">
          <?php if ($hascustommenu) { ?>
          <div id="custommenu"><?php echo $custommenu; ?></div>
          <?php } else { ?>
          <div id="totaramenu"><?php echo $totaramenu; ?>
      <div class="clear"></div>
      </div>
          <?php } ?>
          <div class="footer-powered"><a href="http://www.totaralms.com/" target="_blank"><img class="logo" src="<?php echo $CFG->wwwroot.'/theme/'.$PAGE->theme->name ?>/pix/logo-ftr.png" alt="Logo" /></a></div>
        <div class="footer-backtotop"><a href="#">Back to top</a></div>
          <div class="footnote">
            <div class="footer-links">
            </div>
          </div>
          <?php
          echo $OUTPUT->standard_footer_html();
          ?>
        </div>
      <div class="clear"></div>
      </div>
    <?php } ?>

<!-- END OF FOOTER -->
<?php echo $OUTPUT->standard_end_of_body_html() ?>
</body>
</html>
