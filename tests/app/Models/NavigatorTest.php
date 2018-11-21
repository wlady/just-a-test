<?php

namespace App\Tests;

use App\Models\Navigator;
use App\Models\Rmc\GpRmc;
use PHPUnit\Framework\TestCase;

class NavigatorTest extends TestCase
{
    /**
     * @dataProvider packetsDataProvider
     * @param $data
     * @param $expected
     */
    public function testNavigatorParser($data, $expected)
    {
        try {
            $nav = new Navigator($data['packet']);
            $this->assertInstanceOf(GpRmc::class, $nav->getRmc());
        } catch (\Exception $e) {
            $this->assertFalse($expected);
        }
    }

    public function packetsDataProvider()
    {
        return [
            [
                //  incorrect packet format
                [
                    'packet' => '357671030507872#user#4444#AUTOLOW#1#14508989 GPRMC,123347.000,A,4313.7477,N, 02752.4516,E,0.00,284.40,080811,,,D*63##',
                ],
                // excpected
                false,
            ],
            [
                //  incorrect nav format
                [
                    'packet' => '357671030507872#user#4444#AUTOLOW#1#14508989$GPRMC,123347.000,A,4313.7477,N, 02752.4516,E,0.00,284.40,080811,,,D*63##',
                ],
                // excpected
                false,
            ],
            [
                //  incorrect nav format
                [
                    'packet' => '#navigator#user#4444#AUTOLOW#1#14508989$GPRMC,123347.000,A,4313.7477,N, 02752.4516,E,0.00,284.40,080811,,,D*63##',
                ],
                // excpected
                false,
            ],
            [
                //  incorrect RMC format (GXRMC)
                [
                    'packet' => '#navigator#user#4444#AUTOLOW#1#14508989$GXRMC,123347.000,A,4313.7477,N, 02752.4516,E,0.00,284.40,080811,,,D*63##',
                ],
                // excpected
                false,
            ],
            [
                // correct data
                [
                    'packet' => '#357671030507872#user#4444#AUTOLOW#1#14508989$GPRMC,123347.000,A,4313.7477,N, 02752.4516,E,0.00,284.40,080811,,,D*63##',
                ],
                // expected
                true,
            ],
        ];
    }
}
