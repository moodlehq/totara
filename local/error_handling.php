<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
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
 * @author Aaron Barnes <aaron.barnes@totaralms.com>
 * @package totara
 * @subpackage local
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

require_once("{$CFG->dirroot}/version.php");

/**
 * Setup error/exception handlers for Totara
 *
 * @access  public
 * @return  void
 */
function totara_setup_error_handlers() {
    set_error_handler('totara_error_handler');
    set_exception_handler('totara_exception_handler');
}


/**
 * Totara error handler
 *
 * @access  public
 * @param   $errno      int     Error number
 * @param   $errstr     string  Error message
 * @param   $errfile    string  File error occured in (optional)
 * @param   $errline    int     Line in file error occured in (optional)
 * @param   $errcontext array   Array of variable in errors context (optional)
 * @return  bool
 */
function totara_error_handler($errno, $errstr, $errfile = '', $errline = 0, $errcontext = array()) {
    global $TOTARA;

    // Restore old error handler to prevent loop
    restore_error_handler();

    // Respond to error appropriately
    if (!(error_reporting() & $errno)) {
        // This error code is not included in error_reporting
        // Restore this error handler
        set_error_handler('totara_error_handler');
        return false;
    }

    // Record error
    $error = new object();
    $error->timeoccured = time();
    $error->version = addslashes($TOTARA->version);
    $error->build = addslashes($TOTARA->build);
    $error->details = addslashes(serialize(array($errno, $errstr, $errfile, $errline)));
    insert_record('errorlog', $error);

    switch ($errno) {
        case E_NOTICE:
        case E_USER_NOTICE:
            $errors = "Notice";
            break;
        case E_WARNING:
        case E_USER_WARNING:
            $errors = "Warning";
            break;
        case E_ERROR:
        case E_USER_ERROR:
            $errors = "Fatal Error";
            break;
        case E_STRICT:
            $errors = "Strict";
            break;
        default:
            $errors = "Unknown";
            break;
    }

    // Print/log message just as PHP normally would
    if (ini_get("display_errors")) {
        printf("<br />\n<b>%s</b>: %s in <b>%s</b> on line <b>%d</b><br /><br />\n", $errors, $errstr, $errfile, $errline);
    }

    if (ini_get('log_errors')) {
        error_log(sprintf("PHP %s: %s in %s on line %d", $errors, $errstr, $errfile, $errline));
    }

    // If a fatal error, exit
    if (in_array($errno, array(E_ERROR, E_USER_ERROR))) {
        exit(1);
    }

    // Restore this error handler
    set_error_handler('totara_error_handler');
    return true;
}


/**
 * Totara exception handler
 *
 * @access  public
 * @param   $exception  Exception
 * @return  bool
 */
function totara_exception_handler($exception) {
    // Restore default exception handler to prevent a loop
    restore_exception_handler();

    // Extract error details from exception
    $errno = E_ERROR;
    $errstr = get_class($exception).': ['.$exception->getCode().']: '.$exception->getMessage();
    $errfile = $exception->getFile();
    $errline = $exception->getLine();

    $result = totara_error_handler($errno, $errstr, $errfile, $errline);

    // Restore this exception handler
    set_exception_handler('totara_exception_handler');
    return $result;
}
