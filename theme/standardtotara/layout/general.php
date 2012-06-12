<?php

defined('MOODLE_INTERNAL') || die();

$hasheading = $PAGE->heading;
$hasnavbar = (empty($PAGE->layout_options['nonavbar']) && $PAGE->has_navbar());
$hasfooter = (empty($PAGE->layout_options['nofooter']));

$hassidepre = $PAGE->blocks->region_has_content('side-pre', $OUTPUT);
$hassidepost = $PAGE->blocks->region_has_content('side-post', $OUTPUT);

$showsidepre = $hassidepre && !$PAGE->blocks->region_completely_docked('side-pre', $OUTPUT);
$showsidepost = $hassidepost && !$PAGE->blocks->region_completely_docked('side-post', $OUTPUT);

$custommenu = $OUTPUT->custom_menu();
$hascustommenu = (empty($PAGE->layout_options['nocustommenu']) && !empty($custommenu));

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

$hasframe = !isset($PAGE->theme->settings->noframe) || !$PAGE->theme->settings->noframe;


if (!$hascustommenu) {
    $menudata = totara_build_menu();
    $totara_core_renderer = $PAGE->get_renderer('totara_core');
    $totaramenu = $totara_core_renderer->print_totara_menu($menudata);
}

echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes() ?>>
<head>
<title><?php echo $PAGE->title ?></title>
<link rel="shortcut icon" href="<?php echo $OUTPUT->pix_url('favicon', 'theme')?>" />
<meta name="description" content="<?php p(strip_tags(format_text($SITE->summary, FORMAT_HTML))) ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<?php echo $OUTPUT->standard_head_html() ?>
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
            <div class="profileblock">
              <?php { include('profileblock.php'); } ?>
            </div>
          </div>
        </div>
        <div id="main_menu" class="clearfix">
          <?php if ($hascustommenu) { ?>
          <div id="custommenu"><?php echo $custommenu; ?></div>
          <?php } else { ?>
          <div id="totaramenu"><?php echo $totaramenu; ?></div>
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
    </div>

<!-- END OF CONTENT -->

<!-- START OF FOOTER -->

    <div id="page-footer">
      <div class="footer-content">
        <div class="footer-powered">Powered by <a href="http://www.totaralms.com/" target="_blank">TotaraLMS</a></div>
        <div class="footnote">
          <div class="footer-links">
          </div>
        </div>
        <?php
        echo $OUTPUT->standard_footer_html();
        ?>
      </div>
    </div>

<!-- END OF FOOTER -->
  </div>
</div>
<?php echo $OUTPUT->standard_end_of_body_html() ?>
</body>
</html>
