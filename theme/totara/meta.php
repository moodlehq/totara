<!--[if IE 6]>
    <link rel="stylesheet" type="text/css" href="<?php echo $CFG->httpsthemewww ?>/totara/styles_ie6.css" />
<![endif]-->
<!--[if IE 7]>
    <link rel="stylesheet" type="text/css" href="<?php echo $CFG->httpsthemewww ?>/totara/styles_ie7.css" />
<![endif]-->

<link rel="stylesheet" type="text/css" href="<?php echo $CFG->wwwroot ?>/local/js/lib/ui-lightness/jquery-ui-1.7.2.custom.css" />

<?php

    require_js(
        array(
            $CFG->wwwroot.'/local/js/lib/jquery-1.3.2.min.js',
	    $CFG->wwwroot.'/local/js/lib/jquery-ui-1.7.2.custom.min.js',
            $CFG->wwwroot.'/local/js/global.js',
	    $CFG->wwwroot.'/local/js/dialog.notifications.js.php'
        )
    );

?>
