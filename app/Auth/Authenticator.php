<?php
/**
 * Very primitive authenticate provider. Do not use it in real projects :)
 *
 * Created by PhpStorm.
 * User: Kate
 * Date: 21.11.2018
 * Time: 11:39
 */

namespace App\Auth;

/**
 * Class Memory
 * @package App\Auth
 */
abstract class Authenticator
{
    /**
     * Memory authenticator constructor.
     */
    public function __construct()
    {
        // suppress output to stderr to run unit tests correctly
        @session_start();
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

    /**
     * Track logged in status
     */
    protected function setLoggedIn($loggedIn = false)
    {
        $_SESSION['loggedIn'] = $loggedIn;
    }

    /**
     * @param $name
     * @param $password
     * @return bool True on success, False otherwise
     */
    abstract public function login($name, $password);

}
