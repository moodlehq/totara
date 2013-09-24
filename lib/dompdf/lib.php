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
 * Dompdf wrapper class for moodle
 */
require_once($CFG->libdir.'/dompdf/moodle_config.php');
require_once($CFG->libdir.'/dompdf/dompdf_config.inc.php');

class totara_dompdf extends dompdf {

    /**
     * Get content of remote file with session support for local files
     *
     * @staticvar string $session_cookie_data
     * @param string $file
     * @return string | null
     */
    public static function file_get_contents($file) {
        global $CFG;
        static $session_cookie_data = '';
        if ($session_cookie_data == '') {
            $session_cookie_data = session_name().'='.session_id();
        }

        if (strpos($file, $CFG->wwwroot.'/pluginfile.php') !== false || strpos($file, $CFG->wwwroot.'/draftfile.php') !== false) {
            if (!function_exists('curl_init')) {
                return null;
            }
            session_get_instance()->write_close();
            $cs = curl_init();
            curl_setopt($cs, CURLOPT_URL, $file);
            curl_setopt($cs, CURLOPT_BINARYTRANSFER, true);
            curl_setopt($cs, CURLOPT_FAILONERROR, true);
            curl_setopt($cs, CURLOPT_RETURNTRANSFER, true);
            if ((ini_get('open_basedir') == '') AND (ini_get('safe_mode') == 'Off')) {
                curl_setopt($cs, CURLOPT_FOLLOWLOCATION, true);
            }
            curl_setopt($cs, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($cs, CURLOPT_TIMEOUT, 3);
            curl_setopt($cs, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($cs, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($cs, CURLOPT_USERAGENT, 'TCPDF');

            curl_setopt($cs, CURLOPT_VERBOSE, 1);
            $logfile = fopen('/tmp/curl.txt', 'w+');
            curl_setopt($cs, CURLOPT_STDERR, $logfile);
            curl_setopt($cs, CURLOPT_COOKIE, $session_cookie_data);
            $imgdata = curl_exec($cs);
            fclose($logfile);
            if (!$imgdata) {
                return;
            }
            curl_close($cs);

            return $imgdata;
        } else {
            return file_get_contents($file);
        }
    }
}