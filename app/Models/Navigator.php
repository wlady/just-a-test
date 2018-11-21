<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 21.11.2018
 * Time: 13:43
 */

namespace App\Models;


class Navigator
{
    // navigator ID
    private $nId = '';
    // custom name
    private $alias = '';
    // associated Rmc record
    private $rmc = null;

    public function __construct($rawData = '')
    {
        $this->parse($rawData);
    }

    /**
     * Parse raw data
     * Example: #357671030507872#user#4444#AUTOLOW#1#14508989$GPRMC,123347.000,A,4313.7477,N, 02752.4516,E,0.00,284.40,080811,,,D*63##
     *
     * @param string $rawData
     */
    private function parse($rawData = '')
    {
        $parts = explode('$', $rawData);
        if (count($parts) != 2) {
            throw new \Exception('Wrong packet format');
        }
        $navParts = explode('#', $parts[0]);
        // for test purposes we interested only to the first field
        if (!is_numeric($navParts[1])) {
            throw new \Exception('Wrong navigator format');
        }
        $this->nId = $navParts[1];
        $this->rmc = new Rmc($parts[1]);
    }

    /**
     * @return string
     */
    public function getNId(): string
    {
        return $this->nId;
    }

    /**
     * @return string
     */
    public function getAlias(): string
    {
        return $this->alias;
    }

    /**
     * @return Rmc
     */
    public function getRmc() : Rmc
    {
        return $this->rmc;
    }
}
