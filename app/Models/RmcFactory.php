<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 21.11.2018
 * Time: 15:39
 */

namespace App\Models;

/**
 * Class RmcFactory
 * @package App\Models
 */
class RmcFactory
{
    /**
     * @param string $rawData
     * @return GpRmc
     * @throws \Exception
     */
    public static function create($rawData = '')
    {
        if (!trim($rawData)) {
            throw new \Exception('Empty RMC string');
        }
        $parts = explode(',', $rawData);
        if (strtoupper(substr($parts[0], 2)) != 'RMC') {
            throw new \Exception('Wrong RMC format');
        }
        // supported RMC formats
        switch ($parts[0]) {
            case 'GPRMC':
                return new GpRmc($parts);
                break;
        /*
            case 'GARMC':
                return new GaRmc($parts);
                break;
            case 'GNRMC':
                return new GnRmc($parts);
                break;
        */
        }
        throw new \Exception('Unrecognized RMC format ' . $parts[0]);
    }
}
