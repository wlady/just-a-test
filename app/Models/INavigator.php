<?php
/**
 * Created by PhpStorm.
 * User: Vladimir Zabara <wlady2001@gmail.com>
 * Date: 21.11.2018
 * Time: 20:36
 */

namespace App\Models;

interface INavigator
{
    public function getNId();
    public function getAlias();
    public function getRmc();
}
