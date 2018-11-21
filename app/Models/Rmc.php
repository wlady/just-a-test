<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 21.11.2018
 * Time: 13:45
 */

namespace App\Models;

class Rmc
{
    private $time = 0;
    private $status = 'A';
    private $latitude = 0.0;
    private $longitude = 0.0;

    public function __construct($rawData = '')
    {
        $this->parse($rawData);
    }

    /**
     * Parse raw data
     * Example: GPRMC,123347.000,A,4313.7477,N, 02752.4516,E,0.00,284.40,080811,,,D*63
     *
     * @param string $rawData
     */
    private function parse($rawData = '')
    {
        $parts = explode(',', $rawData);
        // naturally there are a few format
        if (strtoupper($parts[0]) != 'GPRMC') {
            return;
        }
        $this->time = $parts[1] ?? 0.0;
        $this->status = $parts[2] ?? 'A';
        $this->latitude = $parts[3] ?? 0.0;
        $this->longitude = $parts[5] ?? 0.0;
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return float
     */
    public function getTime(): float
    {
        return $this->time;
    }
}
