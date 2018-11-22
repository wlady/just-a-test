<?php

$ver = (float)phpversion();
if ($ver < 7.1) {
    die('Min PHP version to run is 7.1');
}

if ( ! defined( 'PATH_SEPARATOR' ) ) {
    define( 'PATH_SEPARATOR', getenv( 'COMSPEC' ) ? ';' : ':' );
}

include_once 'functions.php';

include_once 'vendor/autoload.php';
