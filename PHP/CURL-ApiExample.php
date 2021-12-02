<?php


/**

 * Parametros usados para obtener info de archivos o subir archivos

 * @param string $method   #Depende de la llamada "GET" o "POST" 
 * @param string $url      #Url de la pegada ej: "http://ip:puerto/api/file"
 * @param string $id       #Id de la imagen en mongo ej: "61954ca5fcce23001007da16" (Solo en GET)
 * @param array $params    #Parametros de la query paginada (Solo en GET) ej: array('pageNumber' => 1,
                                                                            *       'itemsPerPage'=> 5,
                                                                            *       'search'=> 'nombreImagen',
                                                                            *       'orderBy'=> 'campoDeBaseDeDatos',
                                                                            *       'orderDesc'=> null o True)
 * @param string $filePath #Path relativo del el archivo a subir respecto del archivo actual (Solo en POST) ej: "./exampleFiles/Screenshot.png"

 * @return mixed $result   #Array de objectos con toda la info de los archivos encontrados o el archivo subido

 */


function CallAPIcurl($method, $url, $id=null , $params=[], $filePath=null)
{
    if (!$url) return "URL no definida";
    $curl = curl_init();
    $authorization = "Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSIsInVzZXJuYW1lIjoicm9vdCIsInJvbGUiOnsiaWQiOiI2MTIzY2YwYWQxMTNhNzAwMTFkMTcyNDUiLCJuYW1lIjoiYWRtaW4iLCJjaGlsZFJvbGVzIjpudWxsfSwiZ3JvdXBzIjpbXSwiaWRTZXNzaW9uIjoiNjFhNjJhYjExNTdjMTcwMDEwZGIxNjE1IiwiaWF0IjoxNjM4Mjc5ODU3LCJleHAiOjE2MzgzNjYyNTcsImp0aSI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSJ9.1GHlUTYDEgwOyMBFnYcR-d3aLhS6gv64j-IK6fhTygQ";
    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($filePath){
                $cFile = curl_file_create($filePath);
                $file = array('file' => $cFile);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $file);
                curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type'=> mime_content_type($filePath) , $authorization ));                
            }else{
                return "ERROR: filePath Requerido para subir archivos";
            }
            break;

        case "GET":
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
            if ($id){
                $url = sprintf("%s/%s", $url, $id);
            }else if ($params) {
                $url = $url . '?' . http_build_query($params);
            }
            break;

        default:
            echo "method no definido, opcion default GET";
            
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
            if ($id){
                $url = sprintf("%s/%s", $url, $id);
            }else if ($params) {
                $url = $url . '?' . http_build_query($params);
            }
    }

    curl_setopt($curl, CURLOPT_URL, $url);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
};

//Llamada de ejemplo
// CallAPI("POST", "http://192.168.10.33:7070/api/file");

