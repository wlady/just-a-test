<?php
/**
 * TCP port listener class
 *
 * Created by PhpStorm.
 * User: Vladimir Zabara <wlady2001@gmail.com>
 * Date: 21.11.2018
 * Time: 13:01
 */

namespace App\Server;

use App\Models\Navigator;
use App\Repositories\Navigators;

class Listener
{
    const LISTENER_ADDRESS = '127.0.0.1';
    const LISTENER_PORT = 5000;
    const LISTENER_DELAY = 500;
    const BUF_SIZE = 1024;

    private static $config = null;
    private static $socket = null;
    private static $listen = true;

    public function __construct(array $config = [])
    {
        self::$config = $config;
        if ((self::$socket = socket_create(AF_INET, SOCK_STREAM, 0)) < 0) {
            die('Socket creation error - ' . socket_strerror(self::$socket));
        }
        $cnf = $config['listener'];
        if (($ret = socket_bind(self::$socket, $cnf['address'] ?? self::LISTENER_ADDRESS, $cnf['port'] ?? self::LISTENER_PORT)) < 0) {
            die('Socket binding error - ' . socket_strerror(self::$socket));
        }
        if (($ret = socket_listen(self::$socket, 0)) < 0) {
            die('Socket listen error - ' . socket_strerror(self::$socket));
        }
        socket_set_nonblock(self::$socket);
    }

    /**
     * Main server listener loop
     */
    public function run()
    {
        while (self::$listen) {
            $connection = @socket_accept(self::$socket);
            if ($connection === false) {
                usleep(self::LISTENER_DELAY);
            } else if ($connection > 0) {
                $this->handleRequest($connection);
            } else {
                die('Socket error - ' . socket_strerror($connection));
            }
        }
    }

    /**
     * Create the new process or die
     *
     * @param $connection socket resource
     */
    private function handleRequest($connection)
    {
        $pid = pcntl_fork();

        if ($pid == -1) {
            die('Cannot fork process');
        } else if ($pid == 0) {
            // create alone process
            self::$listen = false;
            socket_close(self::$socket);
            $this->worker($connection);
            socket_close($connection);
        } else {
            socket_close($connection);
        }
    }

    /**
     * @param $connection socket resource
     */
    private function worker($connection)
    {
        $buf = $this->read($connection);
        if ($buf) {
            try {
                $navRepository = new Navigators(self::$config['db']);
                // parse lines
                $lines = explode(PHP_EOL, $buf);
                foreach ($lines as $line) {
                    if (trim($line)) {
                        $navRepository->save(new Navigator($line));
                    }
                }
            } catch (\Exception $e) {
                error_log($e->getMessage() . PHP_EOL);
            }
        }
    }

    /**
     * Read data from socket.
     *
     * @param $connection
     * @return string
     */
    private function read($connection)
    {
        while ($buf = @socket_read($connection, self::BUF_SIZE)) {
            if ($buf = trim($buf)) {
                break;
            }
        }

        return $buf;
    }
}
