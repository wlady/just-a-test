<?php
/**
 * Very primitive authenticate provider. Do not use it in real projects :)
 *
 * Usage example:
 *
 * $auth = new Auth\Pdo([
 *   'dsn' => 'mysql:host=localhost;dbname=db_name;charset=utf8',
 *   'user' => 'db_user',
 *   'password' => 'db_password',
 * ]);
 * $res = $auth->login($_POST['name'], $_POST['password']);
 *
 * Created by PhpStorm.
 * User: Vladimir Zabara <wlady2001@gmail.com>
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
    protected function init(array $config = [])
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

    /**
     * @inheritdoc
     */
    public function login($name, $password)
    {
        $loggedIn = false;
        $stmt = self::$db->prepare('SELECT * FROM `users` WHERE `name`=?');
        $stmt->execute([$name]);
        $row = $stmt->fetch();
        if ($row && password_verify($password, $row->password)) {
            $this->setLoggedIn($loggedIn = true);
        }

        return $loggedIn;
    }
}
