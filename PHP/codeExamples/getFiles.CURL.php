<?php



/**

 * Parametros usados para obtener info de archivos o subir archivos

 * @param string $url      #Url de la pegada ej: "http://ip:puerto/api/file"
 * @param array $params    #Parametros de la query paginada ej: array('pageNumber' => 1,
                                                                *       'itemsPerPage'=> 5,
                                                                *       'search'=> 'nombreImagen',
                                                                *       'orderBy'=> 'campoDeBaseDeDatos',
                                                                *       'orderDesc'=> null o True)

 * @return mixed $result   #Array de objectos con toda la info de los archivos encontrados

 */

function getFiles($url, $params = [])
{
    if (!$url) return "URL no definida";

    $curl = curl_init();
    $authorization = "Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSIsInVzZXJuYW1lIjoicm9vdCIsInJvbGUiOnsiaWQiOiI2MTIzY2YwYWQxMTNhNzAwMTFkMTcyNDUiLCJuYW1lIjoiYWRtaW4iLCJjaGlsZFJvbGVzIjpudWxsfSwiZ3JvdXBzIjpbXSwiaWRTZXNzaW9uIjoiNjE5NTRhZjRmY2NlMjMwMDEwMDdkOThlIiwiaWF0IjoxNjM3MTc0MDA0LCJleHAiOjE2MzcyNjA0MDQsImp0aSI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSJ9.SZrRK-YHk-5SDvaIoYfjtSSdlN0ldF2abcrXe1mqSlI";
    
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
    
    if ($params) {
        $url = $url . '?' . http_build_query($params);
    }

   
    curl_setopt($curl, CURLOPT_URL, $url);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
};

//Llamada de ejemplo
// getFiles("http://192.168.10.33:7070/api/file", array('pageNumber' => 1,'itemsPerPage'=> 5,'search'=> 'nombreImagen','orderBy'=> 'campoDeBaseDeDatos','orderDesc'=> null));
