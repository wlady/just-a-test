<?php
/**
 * Created by PhpStorm.
 * User: Vladimir Zabara <wlady2001@gmail.com>
 * Date: 21.11.2018
 * Time: 15:45
 */

namespace App\Models\Rmc;

abstract class RmcAbstract
{
    private $type = '';
    private $time = 'NOW()';
    private $status = '';
    private $latitude = 0.0;
    private $longitude = 0.0;

    /**
     * @param string $time
     */
    public function setTime(string $time)
    {
        $this->time = $time;
    }

    /**
     * @param float $latitude
     */
    public function setLatitude(float $latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @param float $longitude
     */
    public function setLongitude(float $longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getTime(): string
    {
        return $this->time;
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
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }
}
