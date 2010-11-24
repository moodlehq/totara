.block_flash_video .content {
	padding: 0 0 3px 0 !important;
}

.block_flash_video .content .flashvideoinner {
	margin: 0 1px;
	padding:3px;
	background: transparent url(<?php echo $CFG->wwwroot; ?>/blocks/flash_video/pix/bg_block.png) no-repeat scroll left top;
}


ul.videolist {
	list-style: none;
	padding: 4px 1px 0 1px;
	margin: 0;
}

ul.videolist li {
	margin:0.5em 0;
}

ul.videolist li a {
	background: transparent url(<?php echo $CFG->wwwroot; ?>/blocks/flash_video/pix/bg_button.png) no-repeat left top;
	display: block;
	width: 180px;
	height: 49px;
	color: #000;
}

ul.videolist li a:hover {
	text-decoration: none;
}

ul.videolist li a img{
	vertical-align: middle;
	margin: 2px;
	padding: 2px;
}