<?php
/**
 * Very primitive authenticate provider. Do not use it in real projects :)
 *
 * Usage:
 *
 * $auth = new Auth\Memory();
 * $res = $auth->login('name', 'password');
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
     * @param $name
     * @param $password
     * @return bool True on success, False otherwise
     */
    public function login($name, $password)
    {
        $loggedIn = array_key_exists($name, self::$store) && self::$store[$name] == $password;
        $this->setLoggedIn($loggedIn);

        return $loggedIn;
    }
}
