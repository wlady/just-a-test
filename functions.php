<?php

function _var_dump($var)
{
    ob_start();
    print_r($var);
    $v = ob_get_contents();
    ob_end_clean();

    return $v . PHP_EOL;
}

function flog($fileName, $var)
{
    file_put_contents($fileName, '+---+ ' . date( 'H:i:s d-m-Y' ) . ' +-----+' . PHP_EOL . _var_dump($var) . PHP_EOL, FILE_APPEND);
}
