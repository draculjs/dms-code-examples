<?php

function CallAPI($method, $url, $data = [])
{
    $curl = curl_init();
    $file_name_with_full_path = "/home/jiglesias/Pictures/Screenshot from 2021-10-27 19-26-24.png";
    $authorization = "Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSIsInVzZXJuYW1lIjoicm9vdCIsInJvbGUiOnsiaWQiOiI2MTIzY2YwYWQxMTNhNzAwMTFkMTcyNDUiLCJuYW1lIjoiYWRtaW4iLCJjaGlsZFJvbGVzIjpudWxsfSwiZ3JvdXBzIjpbXSwiaWRTZXNzaW9uIjoiNjE5NTVmNzNmY2NlMjMwMDEwMDdkYjA5IiwiaWF0IjoxNjM3MTc5MjUxLCJleHAiOjE2MzcyNjU2NTEsImp0aSI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSJ9.jAAoZt5jVrXHRCAq2apXY-lKPQnqYtxJ44Q9Miz93ts";
    $cFile = curl_file_create("./exampleFiles/Screenshot from 2021-02-08 11-29-11.png");
    // $urlWhitParam = $url . '?' . http_build_query($params);
    // $data = array('file_contents'=> $cFile);
    $data = array('file' => $cFile);

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
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data', $authorization ));
    curl_setopt($curl, CURLOPT_URL, $url);
    // curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);
    if (curl_errno($curl))
    {
        echo 'Error:' . curl_error($curl);
        exit();
    }

    echo $result;
    curl_close($curl);

    return $result;
};
echo "RESULTADOS: ";
CallAPI("POST", "http://192.168.10.33:7070/api/file/");

