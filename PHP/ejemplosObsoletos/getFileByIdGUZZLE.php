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
    $headers = ['Authorization' => 'bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSIsInVzZXJuYW1lIjoicm9vdCIsInJvbGUiOnsiaWQiOiI2MTIzY2YwYWQxMTNhNzAwMTFkMTcyNDUiLCJuYW1lIjoiYWRtaW4iLCJjaGlsZFJvbGVzIjpudWxsfSwiZ3JvdXBzIjpbXSwiaWRTZXNzaW9uIjoiNjE5NmE2OTlmY2NlMjMwMDEwMDdkZDRkIiwiaWF0IjoxNjM3MjYzMDAyLCJleHAiOjE2MzczNDk0MDIsImp0aSI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSJ9.KzQbcsO_i78Knenon8cW6We_tVk-wt8AAKRGUrk65PE'];
    $data =  '618aabf8fcce23001007d843';
    $id = "";

    if ($data)
    $id = $data;

    $response = $client->request('GET',$id,['headers' => $headers]);

    echo $response->getStatusCode() ;
    // "200"
    echo $response->getBody();
    // {"type":"User"...'
    return $response;
};
echo "RESULTADOS: ";
CallAPI();

