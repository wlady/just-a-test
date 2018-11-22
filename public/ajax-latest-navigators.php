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

$navRepository = new Navigators($config['db']);
$recs = $navRepository->get([
    'limit' => 10,
    'order' => 'DESC',
    'orderBy' => 'time',
]);

header('Content-Type: application/json');
if ($recs === false) {
    echo json_encode([
        'success' => false,
    ]);
} else {
    echo json_encode([
        'data' => $recs,
        'success' => true,
    ]);
}
die();