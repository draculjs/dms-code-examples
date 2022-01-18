<?php
require 'vendor/autoload.php';
use GuzzleHttp\Client;

/**

 * Parametros usados para obtener info de archivos o subir archivos

 * @param string $url      (Req.)Url de la pegada ej: "http://ip:puerto/api/file/"
 * @param string $filePath (Op.)Path relativo del el archivo a subir respecto del archivo actual (Solo en POST) ej: "./exampleFiles/Screenshot.png"

 * @return mixed $response #(Body)Array de objectos con toda la info de los archivos encontrados o el archivo subido

 */

function uploadFile($url, $filePath)
{

    if (!$url) return "URL no definida";

    $client = new Client([
        // Base URI es usado para las pegadas relativas
        'base_uri' => $url,
        // Se peuden setear mas varibales para pegadas default.
    ]);


    $authHeader = ['Authorization' => 'bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSIsInVzZXJuYW1lIjoicm9vdCIsInJvbGUiOnsiaWQiOiI2MTIzY2YwYWQxMTNhNzAwMTFkMTcyNDUiLCJuYW1lIjoiYWRtaW4iLCJjaGlsZFJvbGVzIjpudWxsfSwiZ3JvdXBzIjpbXSwiaWRTZXNzaW9uIjoiNjFiMzljYmQ1MTVmNmUwMDEwZjBjN2IwIiwiaWF0IjoxNjM5MTYxMDIxLCJleHAiOjE2MzkyNDc0MjEsImp0aSI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSJ9.qD4WzsEbWX4ANpCcaWzJBHUcRsSwf1E2NDSf-SZEwqU'];

    if ($filePath){
        $data = [
            'multipart' => [
                [
                    'name'     => 'file',
                    'contents' => fopen($filePath, 'r'),
                    'headers'  => ['Content-Type' => mime_content_type($filePath)]
                ]
            ],
            'headers' => $authHeader
        ];
    }else{
        return "ERROR: filePath Requerido para subir archivos";
    }

    
    $response = $client->request("POST",'',$data);
    
    return $response;
};

//Llamada de ejemplo
//uploadFile("http://192.168.10.33:7070/api/file/","./exampleFiles/Screenshot.png");

