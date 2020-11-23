<?php

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

class RedisConn
{
    private string $host;
    private string $port;
    private string $ttl;
    public $conn;

    public function __construct()
    {
        $this->host = $_ENV['REDIS_HOST'];
        $this->port = $_ENV['REDIS_PORT'];
        $this->ttl = $_ENV['REDIS_EXPIRATION'];
        $redis = null;
        try {
            $redis = new \Redis();
            $redis->connect($this->host, $this->port, $this->ttl);

        } catch (Exception $ex) {
            echo $ex->getMessage();
        }

        $this->conn = $redis;
    }
}