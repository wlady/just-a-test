<?php
/**
 * Very primitive authenticate provider. Do not use it in real projects :)
 *
 * Created by PhpStorm.
 * User: Vladimir Zabara <wlady2001@gmail.com>
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
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $cfg = $config['session'] ?? [];
        if (!session_id()) {
            if (isset($_REQUEST['sid'])) {
                @session_id(filter_var($_REQUEST['sid'], FILTER_SANITIZE_STRING));
            }
            if (isset($cfg['save_path'])) {
                @session_save_path($cfg['save_path']);
            }
        }
        // suppress output to stderr to run unit tests correctly
        @session_start($cfg);
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
     * @param bool $loggedIn
     */
    protected function setLoggedIn($loggedIn = false)
    {
        $_SESSION['loggedIn'] = $loggedIn;
    }

    /**
     * Simple CSRF token generator
     *
     * @return string
     */
    public function csrfGenerate() : string
    {
        $_SESSION['csrftoken'] = bin2hex(random_bytes(10));

        return $this->csrfGet();
    }

    /**
     * Get saved CSRF token
     *
     * @return string
     */
    public function csrfGet() : string
    {
        return $_SESSION['csrftoken'] ?? '';
    }

    /**
     * Reset old CSRF token
     */
    public function csrfReset()
    {
        $_SESSION['csrftoken'] = '';
    }

    /**
     * @param $name
     * @param $password
     * @return bool True on success, False otherwise
     */
    abstract public function login($name, $password);

}
