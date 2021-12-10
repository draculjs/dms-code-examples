<?php
require 'vendor/autoload.php';
use GuzzleHttp\Client;

/**

 * Parametros usados para obtener info de archivos o subir archivos

 * @param string $url      (Req.)Url de la pegada ej: "http://ip:puerto/api/file/"
 * @param string $id       (Req.)Id de la imagen en mongo ej: "61954ca5fcce23001007da16" (Solo en GET)

 * @return mixed $response #(Body)Objecto con toda la info del archivo encontrado

 */

function getFileById($url, $id)
{
    if (!$url) return "URL no definida";

    $client = new Client([
        // Base URI es usado para las pegadas relativas
        'base_uri' => 'http://192.168.10.33:7070/api/file/',
        // Se peuden setear mas varibales para pegadas default.
    ]);
    $authHeader = ['Authorization' => 'bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSIsInVzZXJuYW1lIjoicm9vdCIsInJvbGUiOnsiaWQiOiI2MTIzY2YwYWQxMTNhNzAwMTFkMTcyNDUiLCJuYW1lIjoiYWRtaW4iLCJjaGlsZFJvbGVzIjpudWxsfSwiZ3JvdXBzIjpbXSwiaWRTZXNzaW9uIjoiNjFiMzljYmQ1MTVmNmUwMDEwZjBjN2IwIiwiaWF0IjoxNjM5MTYxMDIxLCJleHAiOjE2MzkyNDc0MjEsImp0aSI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSJ9.qD4WzsEbWX4ANpCcaWzJBHUcRsSwf1E2NDSf-SZEwqU'];
    $data = ['headers' => $authHeader];

    try {
        $response = $client->request("GET", $id, $data);
    } catch (\Throwable $th) {
        return $th;
    }

    // $response->getStatusCode() ;
    // "200"
    // $response->getBody();
    // {"type":"User"...'
    return $response;
};

//Llamada de ejemplo
//getFileById("http://192.168.10.33:7070/api/file/","61a67ec1730e6565a60cb7e6");
