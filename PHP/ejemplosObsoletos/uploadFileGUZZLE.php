<?php
require 'vendor/autoload.php';
use GuzzleHttp\Client;

function CallAPI()
{

    $client = new Client([
        // Base URI is used with relative requests
        'base_uri' => 'http://192.168.10.33:7070/api/file/',
        // You can set any number of default request options.
    ]);
    $headers = ['Authorization' => 'bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSIsInVzZXJuYW1lIjoicm9vdCIsInJvbGUiOnsiaWQiOiI2MTIzY2YwYWQxMTNhNzAwMTFkMTcyNDUiLCJuYW1lIjoiYWRtaW4iLCJjaGlsZFJvbGVzIjpudWxsfSwiZ3JvdXBzIjpbXSwiaWRTZXNzaW9uIjoiNjFhMGUwOTYxNTdjMTcwMDEwZGIxMTViIiwiaWF0IjoxNjM3OTMzMjA2LCJleHAiOjE2MzgwMTk2MDYsImp0aSI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSJ9.2zl9GRJiXpH-R5ulD5cKsD95ep5dhfQ5v24Av8ReQoU'];


    $response = $client->request('POST','',[
        'multipart' => [
            [
                'name'     => 'file',
                'contents' => fopen("./exampleFiles/hola.txt", 'r'),
                'headers'  => ['Content-Type' => mime_content_type("./exampleFiles/hola.txt")]
            ]
        ],
        'headers' => $headers
    ]);

    echo $response->getStatusCode() ;
    // "200"
    echo $response->getBody();
    // {"type":"User"...'
    return $response;
};

CallAPI();

