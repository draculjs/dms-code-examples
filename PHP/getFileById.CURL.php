<?php


/**

 * Parametros usados para obtener info de archivos o subir archivos

 * @param string $url      #Url de la pegada ej: "http://ip:puerto/api/file"
 * @param string $id       #Id de la imagen en mongo ej: "61954ca5fcce23001007da16"

 * @return mixed $result   #Objeto con toda la info de el archivo encontrado

 */


function getFileById($url, $id)
{
    if (!$url) return "URL no definida";

    $curl = curl_init();
    $authorization = "Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSIsInVzZXJuYW1lIjoicm9vdCIsInJvbGUiOnsiaWQiOiI2MTIzY2YwYWQxMTNhNzAwMTFkMTcyNDUiLCJuYW1lIjoiYWRtaW4iLCJjaGlsZFJvbGVzIjpudWxsfSwiZ3JvdXBzIjpbXSwiaWRTZXNzaW9uIjoiNjE5NTRhZjRmY2NlMjMwMDEwMDdkOThlIiwiaWF0IjoxNjM3MTc0MDA0LCJleHAiOjE2MzcyNjA0MDQsImp0aSI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSJ9.SZrRK-YHk-5SDvaIoYfjtSSdlN0ldF2abcrXe1mqSlI";
    
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
    
    if ($id){
        $url = sprintf("%s/%s", $url, $id);
    }else {
        return "Id no definido";
    }

    curl_setopt($curl, CURLOPT_URL, $url);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
};

//Llamada de ejemplo
// getFileById("http://192.168.10.33:7070/api/file", "61954ca5fcce23001007da16");
