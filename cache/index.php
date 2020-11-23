<?php

include_once __DIR__ . './request.php';

$urlGet = "https://httpbin.org/get";
$urlPost = "https://httpbin.org/post";
$urlPut = "https://httpbin.org/put";
$urlPatch = "https://httpbin.org/patch";
$urlDelete = "https://httpbin.org/delete";
$parameters = [1, 2, 3, 'test'];
$data = $parameters;

//$request = SimpleJsonRequest::get($urlGet);
$request = SimpleJsonRequest::get($urlGet, $parameters);
//$request = SimpleJsonRequest::post($urlPost, $parameters, $data);
//$request = SimpleJsonRequest::put($urlPut, $parameters, $data);
//$request = SimpleJsonRequest::patch($urlPatch, $parameters, $data);
//$request = SimpleJsonRequest::delete($urlDelete, $parameters, $data);

print_r($request);




