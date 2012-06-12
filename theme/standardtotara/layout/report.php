<?php

$hassidepre = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('side-pre', $OUTPUT));
$hasnavbar = (empty($PAGE->layout_options['nonavbar']) && $PAGE->has_navbar());
$showsidepre = ($hassidepre && !$PAGE->blocks->region_completely_docked('side-pre', $OUTPUT));

$custommenu = $OUTPUT->custom_menu();
$hascustommenu = (empty($PAGE->layout_options['nocustommenu']) && !empty($custommenu));

$displaylogo = !isset($PAGE->theme->settings->displaylogo) || $PAGE->theme->settings->displaylogo;

$bodyclasses = array();
if (!$showsidepre) {
    $bodyclasses[] = 'content-only';
}
if ($hassidepre) {
    $bodyclasses[] = 'background';
}

if (!empty($PAGE->theme->settings->logo)) {
    $logourl = $PAGE->theme->settings->logo;
} else {
    $logourl = NULL;
}

if (!empty($PAGE->theme->settings->footnote)) {
    $footnote = $PAGE->theme->settings->footnote;
} else {
    $footnote = '<!-- There was no custom footnote set -->';
}

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
    <?php echo $OUTPUT->standard_head_html() ?>
</head>
<body id="<?php p($PAGE->bodyid) ?>" class="<?php p($PAGE->bodyclasses.' '.join(' ', $bodyclasses)) ?>">
<?php echo $OUTPUT->standard_top_of_body_html() ?>

<div id="page">
    <div id="wrapper" class="clearfix">

<!-- START OF HEADER -->

    <div id="page-header" class="clearfix">
        <div class="page-header-inner">
        <div id="page-header-wrapper">
                <div class="headermenu">
                        <div class="profileblock">
                        <?php { include('profileblock.php'); } ?>
                        </div>
                </div>
        </div>

        <?php if ($logourl == NULL) { ?>
        <div id="logo"><a href="<?php echo $CFG->wwwroot; ?>">&nbsp;</a></div>
            <?php } else { ?>
            <div id="logo" class="custom"><a href="<?php echo $CFG->wwwroot; ?>"><img class="logo" src="<?php echo $logourl;?>" alt="Logo" /></a></div>
            <?php } ?>

            <div id="main_menu">
                <?php if ($hascustommenu) { ?>
                    <div id="custommenu"><?php echo $custommenu; ?></div>
                <?php } else { ?>
                    <div id="totaramenu"><?php echo $totaramenu; ?></div>
                <?php } ?>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>

<!-- END OF HEADER -->

<!-- START OF CONTENT -->
<div id="page-content-wrapper">
    <div id="page-content">
        <div class="navbar clearfix">
            <?php if ($hasnavbar) { ?>
            <div class="youarehere">You are here:</div>
            <div class="breadcrumb"><?php echo $OUTPUT->navbar(); ?></div>
            <div class="navbutton"> <?php echo $PAGE->button; ?></div>
            <?php } ?>
        </div>
        <div id="region-main-box">
            <div id="region-post-box">
                <div id="region-main-wrap">
                    <div id="region-main">
                        <div class="region-content">
                            <?php echo core_renderer::MAIN_CONTENT_TOKEN ?>
                        </div>
                    </div>
                </div>

                <?php if ($hassidepre) { ?>
                <div id="region-pre" class="block-region">
                    <div class="region-content">
                        <?php echo $OUTPUT->blocks_for_region('side-pre') ?>
                    </div>
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
