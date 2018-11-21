<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 21.11.2018
 * Time: 13:28
 */

namespace App;

use App\Repositories\Navigators;

require_once __DIR__ . '/../bootstrap.php';

$config = include __DIR__ . '/../config.php';

//$loader = new Twig_Loader_Filesystem($config['twig']['templates'] ?? __DIR__);
//$twig = new Twig_Environment($loader);

$auth = new Auth\Pdo($config['db']);
if ($auth->check()) {
    // user is logged in
    $navRepository = new Navigators($config['db']);
    var_dump($navRepository->get([
        'limit' => 10,
        'order' => 'DESC',
        'orderBy' => 'time',
    ]));
//    echo $twig->render('index.twig', [
//        'points' => $navRepository->get([
//            'limit' => 10,
//            'order' => 'DESC',
//            'orderBy' => 'time',
//        ]),
//    ]);
} else {
//    echo $twig->render('login.twig');
}
