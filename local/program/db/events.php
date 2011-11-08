<?php

$handlers = array (
    'program_assigned' => array (
         'handlerfile'      => '/local/program/lib.php',
         'handlerfunction'  => 'prog_eventhandler_program_assigned',
         'schedule'         => 'instant'
     ),
    'program_unassigned' => array (
         'handlerfile'      => '/local/program/lib.php',
         'handlerfunction'  => 'prog_eventhandler_program_unassigned',
         'schedule'         => 'instant'
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
);
