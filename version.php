<?php

// MOODLE VERSION INFORMATION

// This file defines the current version of the core Moodle code being used.
// This is compared against the values stored in the database to determine
// whether upgrades should be performed (see lib/db/*.php)

    $version = 2007101591.02; // YYYYMMDD      = date of the 1.9 branch (don't change)
                              //         X     = release number 1.9.[0,1,2,3,4,5...]
                              //          Y.YY = micro-increments between releases

    $release = '1.9.11 (Build: 20110221)';     // Human-friendly version name


// TOTARA VERSION INFORMATION

// This file defines the current version of the core Totara code being used.
// This can be used for modules to set a minimum functionality requirement.

    $TOTARA = new object();
    $TOTARA->version    = '1.0.10';             # Please keep as string
    $TOTARA->build      = '20110510.00';        # Please keep as string
    $TOTARA->release    = "{$TOTARA->version} (Build: {$TOTARA->build})";

