<?php
/**
 * Primitive front-end controller
 *
 * Created by PhpStorm.
 * User: Vladimir Zabara <wlady2001@gmail.com>
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

// check incoming requests
if (isset($_POST['logout'])) {
    // logout request
    $auth->logout();
} else if (isset($_POST['csrf']) && $_POST['csrf'] == $auth->csrfGet()) {
    // login request
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $auth->login($name, $password);
} else if (isset($_POST['rename'])) {
    // new alias name request
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $alias = filter_var($_POST['alias'], FILTER_SANITIZE_STRING);
    header('Content-Type: application/json');
    echo json_encode([
        'success' => (new Navigators($config['db']))->rename($id, $alias),
    ]);
    die;
}
$auth->csrfReset();

// render login/index template
if ($auth->check()) {
    // user is logged in
    echo $twig->render('index.twig', [
        'config' => $config,
    ]);
} else {
    echo $twig->render('login.twig', [
        'csrftoken' => $auth->csrfGenerate(),
    ]);
}
