<?php
/**
 * Created by PhpStorm.
 * User: Vladimir Zabara <wlady2001@gmail.com>
 * Date: 21.11.2018
 * Time: 20:36
 */

namespace App\Models;

use App\Models\Rmc\RmcAbstract;

interface INavigator
{
    public function getNId() : string;
    public function getAlias() : string;
    public function getRmc() : RmcAbstract;
}
