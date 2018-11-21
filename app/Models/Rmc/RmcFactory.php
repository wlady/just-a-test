<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 21.11.2018
 * Time: 15:39
 */

namespace App\Models\Rmc;

/**
 * Class RmcFactory
 * @package App\Models
 */
class RmcFactory
{
    /**
     * @param string $rawData
     * @return Rmc
     * @throws \Exception
     */
    public static function create($rawData = '')
    {
        if (!trim($rawData)) {
            throw new \Exception('Empty RMC string');
        }
        // explode raw data into fields
        $fields = explode(',', $rawData);
        if (strtoupper(substr($fields[0], 2)) != 'RMC') {
            throw new \Exception('Wrong RMC format');
        }
        // supported RMC formats
        switch ($fields[0]) {
            case 'GPRMC':
                return new GpRmc($fields);
                break;
        /*
            case 'GARMC':
                return new GaRmc($fields);
                break;
            case 'GNRMC':
                return new GnRmc($fields);
                break;
        */
        }
        throw new \Exception('Unrecognized RMC format ' . $fields[0]);
    }
}
