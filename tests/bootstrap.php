<?php

if ( ! defined( 'PATH_SEPARATOR' ) ) {
    define( 'PATH_SEPARATOR', getenv( 'COMSPEC' ) ? ';' : ':' );
}

include_once __DIR__ . '/../vendor/autoload.php';

// save configuration to use in it tests
$GLOBALS['config'] = include __DIR__ . '/../config.php';
