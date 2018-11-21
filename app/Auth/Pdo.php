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

    /**
     * Pdo authenticator constructor.
     * @param array $config
     * @throws \PDOException
     */
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
     * @inheritdoc
     */
    public function login($name, $password)
    {
        $stmt = self::$db->prepare('SELECT id FROM `users` WHERE `name`=? AND `password`=?');
        $stmt->execute([
            $name, $password
        ]);
        $id = $stmt->fetchColumn();
        $this->setLoggedIn($loggedId = $id > 0);

        return $loggedId;
    }
}
