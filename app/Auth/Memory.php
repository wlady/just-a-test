<?php
/**
 * Very primitive authenticate provider. Do not use it in real projects :)
 *
 * Usage example:
 *
 * $auth = new Auth\Memory();
 * $res = $auth->login($_POST['name'], $_POST['password']);
 *
 * Created by PhpStorm.
 * User: Kate
 * Date: 20.11.2018
 * Time: 21:38
 */

namespace App\Auth;

/**
 * Class Memory
 * @package App\Auth
 */
class Memory extends Authenticator
{
    /**
     * Local store
     */
    private static $store = [
        'admin' => 'admin123',
        'user'  => 'user123',
    ];

    /**
     * @inheritdoc
     */
    public function login($name, $password)
    {
        $loggedIn = array_key_exists($name, self::$store) && self::$store[$name] == $password;
        $this->setLoggedIn($loggedIn);

        return $loggedIn;
    }
}
