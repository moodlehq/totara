<?php

$handlers = array (
    'program_assigned' => array (
         'handlerfile'      => '/local/program/lib.php',
         'handlerfunction'  => 'prog_eventhandler_program_assigned',
         'schedule'         => 'cron'
     ),
    'program_unassigned' => array (
         'handlerfile'      => '/local/program/lib.php',
         'handlerfunction'  => 'prog_eventhandler_program_unassigned',
         'schedule'         => 'cron'
     ),
    'program_extension_granted' => array (
         'handlerfile'      => '/local/program/lib.php',
         'handlerfunction'  => 'prog_eventhandler_extension_granted',
         'schedule'         => 'cron'
     ),
    'program_completed' => array (
         'handlerfile'      => '/local/program/lib.php',
         'handlerfunction'  => 'prog_eventhandler_program_completed',
         'schedule'         => 'instant'
     ),
    'program_courseset_completed' => array (
         'handlerfile'      => '/local/program/lib.php',
         'handlerfunction'  => 'prog_eventhandler_courseset_completed',
         'schedule'         => 'instant'
     ),
    'program_extension_denied' => array (
         'handlerfile'      => '/local/program/lib.php',
         'handlerfunction'  => 'prog_eventhandler_extension_denied',
         'schedule'         => 'cron'
     )
);
