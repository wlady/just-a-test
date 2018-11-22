<?php
/**
 * Primitive AJAX controller. The latest 10 records will be shown.
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

$navRepository = new Navigators($config['db']);
$recs = $navRepository->get([
    'fields' => '*, IF(DATE(`time`)=DATE(NOW()-INTERVAL 1 DAY), true, false) active',
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
    /*
    // GeoJSON format
    $data = [];
    foreach ($recs as $rec) {
        $data[] = [
            'type' => 'Feature',
            'geometry' => [
                'type' => 'Point',
                'coordinates' => [
                    $rec->latitude,
                    $rec->longitude,
                ]
            ],
            'properties' => [
                'name' => $rec->alias ?? $rec->nId,
            ]
        ];
    }
    */
    echo json_encode([
        'data' => $recs,
        'success' => true,
    ]);
}
die();