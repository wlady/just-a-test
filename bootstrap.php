<?php

if ( ! defined( 'PATH_SEPARATOR' ) ) {
    define( 'PATH_SEPARATOR', getenv( 'COMSPEC' ) ? ';' : ':' );
}

include_once __DIR__ . '/vendor/autoload.php';
