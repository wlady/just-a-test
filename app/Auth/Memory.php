<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 20.11.2018
 * Time: 21:38
 */

namespace App\Auth;


class Memory implements IAuth
{

    private static $store = [
        'admin' => 'admin123',
        'user'  => 'user123',
    ];

    public function __construct()
    {
        session_start();
    }

    public function login($name, $password)
    {
        $loggedId = array_key_exists($name, self::$store) && self::$store[$name] == $password;
        if ($loggedId) {
            $_SESSION['loggedIn'] = $loggedId;
        }

        return $loggedId;
    }

    public function logout()
    {
        $_SESSION['loggedIn'] = false;
    }

    public function check()
    {
        return $_SESSION['loggedIn'];
    }
}