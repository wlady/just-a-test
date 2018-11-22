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

$loader = new \Twig_Loader_Filesystem($config['twig']['templates'] ?? __DIR__);
$twig = new \Twig_Environment($loader);

$auth = new Auth\Pdo($config);

// check login/logout requests
if (isset($_POST['logout'])) {
    $auth->logout();
} else if (isset($_POST['csrf']) && $_POST['csrf'] == $auth->csrfGet()) {
    $auth->login($_POST['name'], $_POST['password']);
}
$auth->csrfReset();

if ($auth->check()) {
    // user is logged in
    $navRepository = new Navigators($config['db']);
    echo $twig->render('index.twig', [
        'points' => $navRepository->get([
            'limit' => 10,
            'order' => 'DESC',
            'orderBy' => 'time',
        ]),
    ]);
} else {
    echo $twig->render('login.twig', [
        'csrftoken' => $auth->csrfGenerate(),
    ]);
}
flog('/tmp/flog.txt', session_save_path());
