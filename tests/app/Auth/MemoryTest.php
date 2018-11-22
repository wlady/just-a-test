<?php

namespace App\Tests;

use App\Auth\Memory;
use PHPUnit\Framework\TestCase;

class MemoryTest extends TestCase
{
    /**
     * @dataProvider loginDataProvider
     */
    public function testLogin($data, $expected)
    {
        $auth = Memory::getInstance();
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
