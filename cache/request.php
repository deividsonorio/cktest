<?php

include_once __DIR__ . '/vendor/autoload.php';
include_once __DIR__ . './redis_conn.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

class SimpleJsonRequest
{
    /**
     * @param string $method
     * @param string $url
     * @param array|null $parameters
     * @param array|null $data
     * @return mixed|bool|string
     */
    private static function makeRequest(string $method, string $url, array $parameters = null, array $data = null)
    {
        $opts = [
            'http' => [
                'method' => $method,
                'header' => 'Content-type: application/json',
                'content' => $data ? json_encode($data) : null
            ]
        ];

        $url .= ($parameters ? '?' . http_build_query($parameters) : '');

        // HTTP Verbs to cache
        $cachedVerbs = explode(',', $_ENV['CACHED_VERBS']);
        // Verify verbs to cache
        $needsCache = in_array($method, $cachedVerbs);
        // Generate request Redis key
        $redisKey = self::generateRedisKey($url, $opts);
        // Get Redis key value
        $cachedValue = self::getRedisValue($redisKey);

        // If there's a cached request response
        if ($cachedValue)
            return $cachedValue;

        $response = file_get_contents($url, false, stream_context_create($opts));
        // If the request needs to be cached
        if ($needsCache)
            self::setRedisKey($redisKey, $response);

        return $response;
    }

    public static function get(string $url, array $parameters = null)
    {
        return json_decode(self::makeRequest('GET', $url, $parameters));
    }

    public static function post(string $url, array $parameters = null, array $data)
    {
        return json_decode(self::makeRequest('POST', $url, $parameters, $data));
    }

    public static function put(string $url, array $parameters = null, array $data)
    {
        return json_decode(self::makeRequest('PUT', $url, $parameters, $data));
    }

    public static function patch(string $url, array $parameters = null, array $data)
    {
        return json_decode(self::makeRequest('PATCH', $url, $parameters, $data));
    }

    public static function delete(string $url, array $parameters = null, array $data = null)
    {
        return json_decode(self::makeRequest('DELETE', $url, $parameters, $data));
    }

    /**
     * Get Value from Redis key
     *
     * @param string $key
     * @return bool|mixed|string
     */
    public function getRedisValue(string $key)
    {
        $redis = new RedisConn();
        $value = $redis->conn->get($key);

        return $value;
    }

    /**
     * Set Redis key=>value
     *
     * @param string $key
     * @param string $value
     */
    public function setRedisKey(string $key, string $value)
    {
        $redis = new RedisConn();
        $redis->conn->set($key, $value);
    }

    /**
     * Generate Redis Key based on request
     *
     * @param string $url
     * @param array|null $data
     * @return string
     */
    public function generateRedisKey(string $url, array $data = null)
    {
        $url = md5(serialize($url));

        if (!is_null($data))
            $data = md5(serialize($data));

        return "$url$data";
    }
}