<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010 - 2013 Totara Learning Solutions LTD
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
 * @author Valerii Kuznetsov <valerii.kuznetsov@totaralms.com>
 * @package totara
 * @subpackage dompdf
 */

/**
 * Custom configuration for moodle
 */

// TODO: Add dompdf sub folder to pathes below (need to be part of installation).
define("DOMPDF_FONT_CACHE", $CFG->cachedir);
define("DOMPDF_TEMP_DIR", $CFG->tempdir);
define("DOMPDF_LOG_OUTPUT_FILE", $CFG->tempdir."/dompdf.log");

define("DOMPDF_DEFAULT_MEDIA_TYPE", "pdf");
define("DOMPDF_ENABLE_JAVASCRIPT", true);
define("DOMPDF_ENABLE_REMOTE", true);
define("DOMPDF_DEFAULT_FONT", "serif");
define("DOMPDF_DPI", 125);
define("DOMPDF_ENABLE_FONTSUBSETTING", false);

//define("DOMPDF_DEFAULT_PAPER_SIZE", "letter");
//define("DOMPDF_ENABLE_PHP", false);
//define("DOMPDF_FONT_HEIGHT_RATIO", 1.1);
//define('DEBUGPNG', true);
//define('DEBUGKEEPTEMP', false);
//define('DEBUGCSS', true);
//define('DEBUG_LAYOUT', true);
//define('DEBUG_LAYOUT_LINES', true);
//define('DEBUG_LAYOUT_BLOCKS', true);
//define('DEBUG_LAYOUT_INLINE', true);
//define('DEBUG_LAYOUT_PADDINGBOX', true);
