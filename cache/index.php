<?php

include_once __DIR__ . './request.php';
//$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
//$dotenv->load();
//
//var_dump(getenv('PROJECT_NAME'));
//var_dump($_ENV['PROJECT_NAME']);

$urlGet = "https://httpbin.org/get";
$urlPost = "https://httpbin.org/post";
$urlPut = "https://httpbin.org/put";
$parameters = [1, 2, 3, 4, 5222416];

//$teste = SimpleJsonRequest::get($urlGet);
//$teste = SimpleJsonRequest::get($urlGet, $parameters);
$teste = SimpleJsonRequest::post($urlPost, $parameters, ['edfxxxgXXZZw']);

//$teste = SimpleJsonRequest::put($urlPut, $parameters, ['edafgxzssszzdw']);


print_r($teste);




