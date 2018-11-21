<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 21.11.2018
 * Time: 15:45
 */

namespace App\Models;

/**
 * Class GpRmc
 * @package App\Models
 */
class GpRmc extends RmcAbstract
{
    /**
     * More info at https://ru.wikipedia.org/wiki/NMEA_0183
     *
     * GpRmc constructor.
     * @param array $fields
     */
    public function __construct(array $fields = [])
    {
        $this->setType('GP');
        $this->setTime($fields[1] ?? 0.0);
        $this->setStatus($fields[2] ?? 'A');
        $this->setLatitude(substr($fields[3], 2) ?? 0.0);
        $this->setLongitude(substr($fields[5], 2) ?? 0.0);
    }
}
