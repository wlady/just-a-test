<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 20.11.2018
 * Time: 21:36
 */

namespace App\Auth;

interface IAuth
{
    public function login($name, $password);
}
