<?php
require 'vendor/autoload.php';
use GuzzleHttp\Client;

/**

 * Parametros usados para obtener info de archivos o subir archivos

 * @param string $url      (Req.)Url de la pegada ej: "http://ip:puerto/api/file/"
 * @param array $params    (Op.)Parametros de la query paginada ej: array('pageNumber' => 1,
                                                                            *       'itemsPerPage'=> 5,
                                                                            *       'search'=> 'textoDeBusqueda',
                                                                            *       'orderBy'=> 'campoDeBaseDeDatos',
                                                                            *       'orderDesc'=> null o True)

 * @return mixed $response #(Body)Array de objectos con toda la info de los archivos encontrados
 */

function getFiles($url, $params=[])
{
    if (!$url) return "URL no definida";

    $client = new Client([
        // Base URI es usado para las pegadas relativas
        'base_uri' => $url,
        // Se peuden setear mas varibales para pegadas default.
    ]);

    $authHeader = ['Authorization' => 'bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSIsInVzZXJuYW1lIjoicm9vdCIsInJvbGUiOnsiaWQiOiI2MTIzY2YwYWQxMTNhNzAwMTFkMTcyNDUiLCJuYW1lIjoiYWRtaW4iLCJjaGlsZFJvbGVzIjpudWxsfSwiZ3JvdXBzIjpbXSwiaWRTZXNzaW9uIjoiNjFiMzljYmQ1MTVmNmUwMDEwZjBjN2IwIiwiaWF0IjoxNjM5MTYxMDIxLCJleHAiOjE2MzkyNDc0MjEsImp0aSI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSJ9.qD4WzsEbWX4ANpCcaWzJBHUcRsSwf1E2NDSf-SZEwqU'];

    if($params){
        $data = [
            'headers' => $authHeader,
            'query' => $params
        ];
    }else{
        $data = ['headers' => $authHeader];
    }

    $response = $client->request("GET",'',$data);

    //$response->getStatusCode() ;
    // "200"
    //$response->getBody();
    // {"type":"User"...'

    return $response;
};
//Llamada de ejemplo
//getFiles("http://192.168.10.33:7070/api/file/", array('pageNumber' => 1,'itemsPerPage'=> 5,'search'=> 'nombreImagen','orderBy'=> 'campoDeBaseDeDatos','orderDesc'=> null));
