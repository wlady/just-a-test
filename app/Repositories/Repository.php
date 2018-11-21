<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 21.11.2018
 * Time: 20:34
 */

namespace App\Repositories;

class Repository
{
    protected static $db = null;

    public function __construct(array $config = [])
    {
        try {
            self::$db = new \PDO($config['dsn'] ?? '', $config['user'] ?? '', $config['password'] ?? '');
            self::$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            self::$db->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
        } catch (\PDOException $e) {
            // for simplicity we die here with PDO message
            die($e->getMessage());
        }
    }
}