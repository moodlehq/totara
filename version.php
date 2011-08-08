<?php

// MOODLE VERSION INFORMATION

// This file defines the current version of the core Moodle code being used.
// This is compared against the values stored in the database to determine
// whether upgrades should be performed (see lib/db/*.php)

    $version = 2007101591.04; // YYYYMMDD      = date of the 1.9 branch (don't change)
                              //         X     = release number 1.9.[0,1,2,3,4,5...]
                              //          Y.YY = micro-increments between releases

    $release = '1.9.13 (Build: 20110801)';     // Human-friendly version name


// TOTARA VERSION INFORMATION

// This file defines the current version of the core Totara code being used.
// This can be used for modules to set a minimum functionality requirement.

    $TOTARA = new object();
    $TOTARA->version    = '1.1.0b+';            # Please keep as string
    $TOTARA->build      = '20110726.00';        # Please keep as string
    $TOTARA->release    = "{$TOTARA->version} (Build: {$TOTARA->build})";

