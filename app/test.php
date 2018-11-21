<?php

namespace App;

require_once __DIR__ . '/bootstrap.php';

$config = include __DIR__ . '/config.php';

$auth = new Auth\Pdo($config['db']);

$res = $auth->login('admin', 'admin');
var_dump($res);

$res = $auth->login('admin', 'admin123');
var_dump($res);

var_dump($auth->check());

$auth->logout();

var_dump($auth->check());
