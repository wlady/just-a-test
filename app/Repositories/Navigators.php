<?php
/**
 * Created by PhpStorm.
 * User: Vladimir Zabara <wlady2001@gmail.com>
 * Date: 21.11.2018
 * Time: 20:33
 */

namespace App\Repositories;

use App\Models\INavigator;

class Navigators extends Repository
{
    /**
     * Save navigator data
     *
     * @param INavigator $navigator
     */
    public function save(INavigator $navigator)
    {
        $stmt = self::$db->prepare('INSERT INTO `navigators` SET `nId`=?, `alias`="", `type`=?, `latitude`=?, `longitude`=?, `time`=? ON DUPLICATE KEY UPDATE `latitude`=?, `longitude`=?, `time`=?');
        $stmt->execute([
            $navigator->getNId(),
            $navigator->getRmc()->getType(),
            $navigator->getRmc()->getLatitude(),
            $navigator->getRmc()->getLongitude(),
            $navigator->getRmc()->getTime(),
            $navigator->getRmc()->getLatitude(),
            $navigator->getRmc()->getLongitude(),
            $navigator->getRmc()->getTime(),
        ]);
    }

    /**
     * Get navigators by criteria
     *
     * @param array $criteria
     * @return array
     */
    public function get(array $criteria = [])
    {
        $query = 'SELECT * FROM `navigators` WHERE 1';
        // some criteria can add variables to params (currently not used)
        $params = [];
        $keys = array_keys($criteria);
        if (in_array('orderBy', $keys)) {
            $query .= " ORDER BY `{$criteria['orderBy']}` ";
        }
        if (in_array('order', $keys)) {
            $query .= " {$criteria['order']} ";
        }
        if (in_array('limit', $keys)) {
            $query .= " LIMIT {$criteria['limit']} ";
        }
        $stmt = self::$db->prepare($query);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }
}
