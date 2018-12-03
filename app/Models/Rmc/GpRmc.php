<?php
/**
 * GPRMC model
 *
 * Created by PhpStorm.
 * User: Vladimir Zabara <wlady2001@gmail.com>
 * Date: 21.11.2018
 * Time: 15:45
 */

namespace App\Models\Rmc;

/**
 * Class GpRmc
 * @package App\Models
 */
class GpRmc extends RmcAbstract
{
    private $dirs = [
        'lat' => ['S', 'N'],
        'lng' => ['W', 'E'],
    ];

    /**
     * More info at https://ru.wikipedia.org/wiki/NMEA_0183
     *
     * GpRmc constructor.
     * @param array $fields
     */
    public function __construct(array $fields = [])
    {
        $this->setType('GP');
        $this->setTime($this->parseTime($fields[1], $fields[9]));
        $this->setStatus($fields[2] ?? 'A');
        $this->setLatitude($this->parseCoordinates($fields[3], $fields[4], 'lat'));
        $this->setLongitude($this->parseCoordinates($fields[5], $fields[6], 'lng'));
    }

    /**
     * @param string time
     * @param string date
     * @return string
     */
    private function parseTime($time, $date) : string
    {
        // drop microseconds
        $parts = explode('.', $time);
        // create timestamp from both fields
        $t = str_split($parts[0],  2);
        $d = str_split($date, 2);
        $timestamp = mktime($t[0], $t[1], $t[2], $d[1], $d[0], $d[2]);

        return date('Y-m-d H:i:s', $timestamp);
    }

    /**
     * @param $value
     * @param $dir
     * @param $type
     * @return float
     * @throws \Exception
     */
    private function parseCoordinates($value, $dir, $type) : float
    {
        $dir = strtoupper($dir);
        if (!in_array($dir, $this->dirs[$type])) {
            throw new \Exception('Wrong direction ' . $dir);
        }
        $value /= 100;

        return $dir == $this->dirs[$type][0] ? -$value : $value;
    }
}
