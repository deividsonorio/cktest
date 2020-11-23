# Technical challenge

The files for each challenge are located in the corresponding folders.

# Challenges

## 1. Cache function

**/cache**

The Cache uses the Redis module (https://github.com/phpredis/phpredis). 
The tests were made with Redis running in Windows and Apache with Redis dll enabled.
The "index.php" file is only an example.

**Requirements**:
* PHP 7
* Redis instaled
* Apache or another with Redis
* Composer (composer.json)
* **vlucas/phpdotenv** for environment variables

**Environment file:**

Default environment variables in an environment file named .env

```sh
PROJECT_NAME="CrossKnowledge Test"
REDIS_HOST=LOCALHOST
REDIS_PORT=6379
REDIS_KEY_TIMEOUT=3600
CACHED_VERBS=GET,POST
```

**REDIS*** variables: Connection with Redis.

**REDIS_KEY_TIMEOUT**: Set a timeout (in seconds) on created key. After the timeout has expired, the key will automatically be deleted.

**CACHED_VERBS**: HTTP verbs to be cached.

## 2. Date formatting

**/date-formatting**

Simple Javascript "started ago" code, with the required behavior. 

## 3. Apply style
**/style**

* CSS style using [BEM](http://getbem.com/introduction/).
* **SASS file available.**