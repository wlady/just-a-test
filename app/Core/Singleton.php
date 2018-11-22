<?php
/**
 * Created by PhpStorm.
 * User: Vladimir Zabara <wlady2001@gmail.com>
 * Date: 22.11.2018
 * Time: 09:30
 */

namespace App\Core;

trait Singleton
{
    private static $instance = [];

    final private function __construct()
    {
        $this->init(func_get_args() ? func_get_arg(0) : null);
    }

    final public static function getInstance()
    {

        self::$instance = self::$instance ?? new static(func_get_args() ? func_get_arg(0) : null);

        return self::$instance;
    }

    protected function init()
    {
    }
}
