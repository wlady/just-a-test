<?php
/**
 * Very primitive authenticate provider. Do not use it in real projects :)
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
class Memory implements IAuth
{
    /**
     * Local store
     */
    private static $store = [
        'admin' => 'admin123',
        'user'  => 'user123',
    ];

    public function __construct()
    {
        session_start();
    }

    /**
     * @param $name
     * @param $password
     * @return bool True on success, False otherwise
     */
    public function login($name, $password)
    {
        $loggedId = array_key_exists($name, self::$store) && self::$store[$name] == $password;
        if ($loggedId) {
            $_SESSION['loggedIn'] = $loggedId;
        }

        return $loggedId;
    }

    /**
     * We could simply delete this flag
     */
    public function logout()
    {
        $_SESSION['loggedIn'] = false;
    }

    /**
     * Check if user is logged in
     *
     * @return bool
     */
    public function check()
    {
        return $_SESSION['loggedIn'] ?? false;
    }
}