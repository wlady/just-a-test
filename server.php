<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 21.11.2018
 * Time: 13:28
 */

namespace App;

use App\Server\Listener;

require_once __DIR__ . '/bootstrap.php';

$config = include __DIR__ . '/config.php';

$server = new Listener($config['listener']);

$server->run();