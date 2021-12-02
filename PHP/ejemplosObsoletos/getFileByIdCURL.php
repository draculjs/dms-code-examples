<?php

function CallAPI($method, $url, $data = [])
{
    $curl = curl_init();
    $authorization = "Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSIsInVzZXJuYW1lIjoicm9vdCIsInJvbGUiOnsiaWQiOiI2MTIzY2YwYWQxMTNhNzAwMTFkMTcyNDUiLCJuYW1lIjoiYWRtaW4iLCJjaGlsZFJvbGVzIjpudWxsfSwiZ3JvdXBzIjpbXSwiaWRTZXNzaW9uIjoiNjE5NTRhZjRmY2NlMjMwMDEwMDdkOThlIiwiaWF0IjoxNjM3MTc0MDA0LCJleHAiOjE2MzcyNjA0MDQsImp0aSI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSJ9.SZrRK-YHk-5SDvaIoYfjtSSdlN0ldF2abcrXe1mqSlI";
    $data =  '61954ca5fcce23001007da16';
    // $urlWhitParam = $url . '?' . http_build_query($params);
    
    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s/%s", $url, $data);
    }
    echo $url;
    // Optional Authentication:
    // curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    // curl_setopt($curl, CURLOPT_USERPWD, "username:password");
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
    curl_setopt($curl, CURLOPT_URL, $url);
    // curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    echo $result;
    curl_close($curl);

    return $result;
};
echo "RESULTADOS: ";
CallAPI("GET", "http://192.168.10.33:7070/api/file");

