<?php

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

class RedisConn
{
    private string $host;
    private string $port;
    public $conn;

    public function __construct()
    {
        $this->host = $_ENV['REDIS_HOST'];
        $this->port = $_ENV['REDIS_PORT'];
        $redis = null;
        try {
            $redis = new \Redis();
            $redis->connect($this->host, $this->port);

        } catch (Exception $ex) {
            echo $ex->getMessage();
        }

        $this->conn = $redis;
    }
}