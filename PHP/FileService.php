<?php
require 'vendor/autoload.php';
use GuzzleHttp\Client;

class FileService
{
    // @param string $url      (Req.)Url de la pegada ej: "http://ip:puerto/api/file/"
    // @param string $token    (Req.)Token de sesion ej: "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjYxMjNjZjBhZDExM2E3MDBxMWQxNzI1OSIsInVzZXJuYW1lIjoicm9vdCIsInJvbGUiOnsiaWQiOiI2MTIzY2YwYWQxMTNhNzAwMTFkMTcyNDUiLCJuYW1lIjoiYWRtaW4iLCJjaGlsZFJvbGVzIjpudWxsfSwiZ3JvdXBzIjpbXSwiaWRTZXNzaW9uIjoiNjFiMzljYmQ1MTVmNmUwMDEwZjBjN2IwIiwiaWF0IjoxNjM5MTYxMDIxLCJleHAiOjE2MzkyNDc0MjEsImp0aSI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSJ9.qD4WzsEbWX4ANpCcaWzJBHUcRsSwf1E2NDSf-SZEwqU"
    private string $token;
    private string $url;

    public function __construct(string $token, string $url) 
    {
        if(!$token || !$url){
            throw New Exception("Missing url or token");
        };
        
        $this->token = $token;
        $this->url = $url;
    }

    /**
    * Parametros usados para obtener info de archivos o subir archivos
    * @param string $id       (Req.)Id de la imagen en mongo ej: "61954ca5fcce23001007da16" (Solo en GET)
    * @return mixed $response #(Body)Objecto con toda la info del archivo encontrado
    */
    public function getFile($id)
    {
        if (!$id) throw new Exception("Id no definido");

        $client = new Client([
            // Base URI es usado para las pegadas relativas
            'base_uri' => $this->url,
            // Se peuden setear mas varibales para pegadas default.
        ]);

        $authToken = "bearer " . $this->token;
        $authHeader = ['Authorization' => $authToken];
        $data = ['headers' => $authHeader];

        try {
            $response = $client->request("GET", $id, $data);
            $responseBody = json_decode($response->getBody());
        } catch (\Throwable $th) {
            return $th;
        }
        // $response->getStatusCode() ;
        // "200"
        // $response->getBody();
        // {"type":"User"...'
        return $responseBody;
    }
    //Llamada de ejemplo
    //getFile("http://192.168.10.33:7070/api/file/",token, "61a67ec1730e6565a60cb7e6");


    /**
    * Parametros usados para obtener info de archivos o subir archivos
    * @param array $params    (Op.)Parametros de la query paginada ej: array('pageNumber' => 1,
                                                                                *       'itemsPerPage'=> 5,
                                                                                *       'search'=> 'textoDeBusqueda',
                                                                                *       'orderBy'=> 'campoDeBaseDeDatos',
                                                                                *       'orderDesc'=> null o True)
    * @return mixed $response #(Body)Array de objectos con toda la info de los archivos encontrados
    */
    public function getFiles($params=[])
    {
        $client = new Client([
            // Base URI es usado para las pegadas relativas
            'base_uri' => $this->url,
            // Se peuden setear mas varibales para pegadas default.
        ]);
        $authToken = "bearer " . $this->token;
        $authHeader = ['Authorization' => $authToken];

        if($params){
            $data = [
                'headers' => $authHeader,
                'query' => $params
            ];
        }else{
            $data = ['headers' => $authHeader];
        }

        try {
            //code...
            $response = $client->request("GET",'',$data);
            $responseBody = json_decode($response->getBody());
        } catch (\Throwable $th) {
            throw $th;
        }

        //$response->getStatusCode() ;
        // "200"
        //$response->getBody();
        // {"type":"User"...'

        return $responseBody;
    }
    //Llamada de ejemplo
    //getFiles("http://192.168.10.33:7070/api/file/",token, array('pageNumber' => 1,'itemsPerPage'=> 5,'search'=> 'nombreImagen','orderBy'=> 'campoDeBaseDeDatos','orderDesc'=> null));


    /**
    * Parametros usados para obtener info de archivos o subir archivos
    * @param string $filePath (Op.)Path relativo del el archivo a subir respecto del archivo actual (Solo en POST) ej: "./exampleFiles/Screenshot.png"
    * @return mixed $response #(Body)Array de objectos con toda la info de los archivos encontrados o el archivo subido
    */
    public function createFile($filePath)
    {

        if (!$filePath) throw new Exception("filePath no definido");

        $client = new Client([
            // Base URI es usado para las pegadas relativas
            'base_uri' => $this->url,
            // Se peuden setear mas varibales para pegadas default.
        ]);

        $authToken = "bearer " . $this->token;
        $authHeader = ['Authorization' => $authToken];

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
        

        try {
            //code...
            $response = $client->request("POST",'',$data);
            $responseBody = json_decode($response->getBody());
        } catch (\Throwable $th) {
            throw $th;
        }
        
        return $responseBody;
    }
    //Llamada de ejemplo
    //uploadFile("http://192.168.10.33:7070/api/file/",token,"./exampleFiles/Screenshot.png");

}
