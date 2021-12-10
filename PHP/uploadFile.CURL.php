<?php


/**

 * Parametros usados para obtener info de archivos o subir archivos

 * @param string $url      #Url de la pegada ej: "http://ip:puerto/api/file"
 * @param string $filePath #Path relativo del el archivo a subir respecto del archivo actual (Solo en POST) ej: "./exampleFiles/Screenshot.png"

 * @return mixed $result   #Objecto con toda la info del archivo subido

 */


function uploadFile($url, $filePath)
{
    if (!$url) return "URL no definida";
    $curl = curl_init();
    $authorization = "Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSIsInVzZXJuYW1lIjoicm9vdCIsInJvbGUiOnsiaWQiOiI2MTIzY2YwYWQxMTNhNzAwMTFkMTcyNDUiLCJuYW1lIjoiYWRtaW4iLCJjaGlsZFJvbGVzIjpudWxsfSwiZ3JvdXBzIjpbXSwiaWRTZXNzaW9uIjoiNjFhNjJhYjExNTdjMTcwMDEwZGIxNjE1IiwiaWF0IjoxNjM4Mjc5ODU3LCJleHAiOjE2MzgzNjYyNTcsImp0aSI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSJ9.1GHlUTYDEgwOyMBFnYcR-d3aLhS6gv64j-IK6fhTygQ";

    curl_setopt($curl, CURLOPT_POST, 1);

    if ($filePath){
        $cFile = curl_file_create($filePath);
        $file = array('file' => $cFile);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $file);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type'=> mime_content_type($filePath) , $authorization ));                
    }else{
        return "ERROR: filePath Requerido para subir archivos";
    }


    curl_setopt($curl, CURLOPT_URL, $url);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
};

//Llamada de ejemplo
// uploadFile("http://192.168.10.33:7070/api/file","./exampleFiles/Screenshot.png");

