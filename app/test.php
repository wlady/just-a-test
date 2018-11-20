<?php

namespace App;

require_once __DIR__ . '/../vendor/autoload.php';

$auth = new Auth\Memory();

$res = $auth->login('admin', 'admin');
var_dump($res);

$res = $auth->login('admin', 'admin123');
var_dump($res);

var_dump($auth->check());

$auth->logout();

var_dump($auth->check());

