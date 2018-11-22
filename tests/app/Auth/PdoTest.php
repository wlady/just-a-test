<?php

namespace App\Tests;

use App\Auth\Pdo;
use PHPUnit\Framework\TestCase;

class PdoTest extends TestCase
{
    private static $config = [];

    public function setUp()
    {
        self::$config = $GLOBALS['config'];
    }

    /**
     * @dataProvider loginDataProvider
     * @param $data
     * @param $expected
     */
    public function testLogin($data, $expected)
    {
        $auth = new Pdo(self::$config);
        $res = $auth->login($data['name'], $data['password']);
        $this->assertEquals($res, $expected);
        // test user is logged in
        $this->assertEquals($auth->check(), $expected);
        if ($expected) {
            $auth->logout();
            $this->assertFalse($auth->check());
        }
    }

    public function loginDataProvider()
    {
        return [
            [
                //  incorrect name
                [
                    'name' => 'admin123',
                    'password' => 'admin123',
                ],
                // excpected
                false,
            ],
            [
                //  incorrect password
                [
                    'name' => 'admin',
                    'password' => 'admin',
                ],
                // excpected
                false,
            ],
            [
                // correct data
                [
                    'name' => 'admin',
                    'password' => 'admin123',
                ],
                // expected
                true,
            ],
        ];
    }
}
