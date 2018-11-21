<?php
/**
 * Very primitive authenticate provider. Do not use it in real projects :)
 *
 * Usage:
 *
 * $auth = new Auth\Pdo([
 *   'dsn' => 'mysql:host=localhost;dbname=db_name;charset=utf8',
 *   'user' => 'db_user',
 *   'password' => 'db_password',
 * ]);
 * $res = $auth->login('name', 'password');
 *
 * Created by PhpStorm.
 * User: Kate
 * Date: 20.11.2018
 * Time: 21:38
 */

namespace App\Auth;

/**
 * Class Pdo
 * @package App\Auth
 */
class Pdo extends Authenticator
{
    private static $db = null;

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
        parent::__construct();
    }

    /**
     * @param $name
     * @param $password
     * @return bool True on success, False otherwise
     */
    public function login($name, $password)
    {
        $this->setLoggedIn($loggedId = true);

        return $loggedId;
    }
}
