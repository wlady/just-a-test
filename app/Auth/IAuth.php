<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 20.11.2018
 * Time: 21:36
 */

namespace Auth;

interface IAuth
{
    public function login($name, $password);
    public function logout();
    public function check();
}