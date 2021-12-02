<?php
require 'vendor/autoload.php';
use GuzzleHttp\Client;
use PhpParser\Node\Stmt\TryCatch;

/**

 * Parametros usados para obtener info de archivos o subir archivos

 * @param string $method   (Req.)Depende de la llamada "GET" o "POST" 
 * @param string $url      (Req.)Url de la pegada ej: "http://ip:puerto/api/file/"
 * @param string $id       (Op.)Id de la imagen en mongo ej: "61954ca5fcce23001007da16" (Solo en GET)
 * @param array $params    (Op.)Parametros de la query paginada (Solo en GET) ej: array('pageNumber' => 1,
                                                                            *       'itemsPerPage'=> 5,
                                                                            *       'search'=> 'textoDeBusqueda',
                                                                            *       'orderBy'=> 'campoDeBaseDeDatos',
                                                                            *       'orderDesc'=> null o True)
 * @param string $filePath (Op.)Path relativo del el archivo a subir respecto del archivo actual (Solo en POST) ej: "./exampleFiles/Screenshot.png"

 * @return mixed $response #(Body)Array de objectos con toda la info de los archivos encontrados o el archivo subido

 */

function CallAPIguzzle($method, $url, $id=null , $params=[], $filePath=null)
{

    if (!$url) return "URL no definida";

    $client = new Client([
        // Base URI es usado para las pegadas relativas
        'base_uri' => $url,
        // Se peuden setear mas varibales para pegadas default.
    ]);


    $authHeader = ['Authorization' => 'bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSIsInVzZXJuYW1lIjoicm9vdCIsInJvbGUiOnsiaWQiOiI2MTIzY2YwYWQxMTNhNzAwMTFkMTcyNDUiLCJuYW1lIjoiYWRtaW4iLCJjaGlsZFJvbGVzIjpudWxsfSwiZ3JvdXBzIjpbXSwiaWRTZXNzaW9uIjoiNjFhNjJhYjExNTdjMTcwMDEwZGIxNjE1IiwiaWF0IjoxNjM4Mjc5ODU3LCJleHAiOjE2MzgzNjYyNTcsImp0aSI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSJ9.1GHlUTYDEgwOyMBFnYcR-d3aLhS6gv64j-IK6fhTygQ'];

    switch ($method)
    {
        case "POST":
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
            break;

        case "GET":
            if($params){
                $data = [
                    'headers' => $authHeader,
                    'query' => $params
                ];
            }else{
                $data = ['headers' => $authHeader];
            }
            break;

        default:
            echo "method no definido, opcion default GET";
            $method = "GET";
            if($params){
                $data = [
                    'headers' => $authHeader,
                    'query' => $params
                ];
            }else{
                $data = ['headers' => $authHeader];
            }
            break;
    }

    if($id){
        try {
            $response = $client->request($method, $id, $data);
        } catch (\Throwable $th) {
            return $th;
        }
    }else{
        echo $method;
        $response = $client->request($method,'',$data);
    }
    
    echo $response->getStatusCode();
    return $response;
};

//Llamada de ejemplo
//CallAPIguzzle(null, "http://192.168.10.33:7070/api/file/","61a67ec1730e6565a60cb7e6");

