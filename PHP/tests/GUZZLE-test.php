<?php

require __DIR__ . './../getFileById.GUZZLE.php';
require __DIR__ . './../getFiles.GUZZLE.php';
require __DIR__ . './../uploadFile.GUZZLE.php';
class GUZZLEtest extends \PHPUnit\Framework\TestCase
{
    //PARA TODOS LOS TEST SE DEBE TENER CONFIGURADO DE ALGUNA FORMA EL TOKEN DE AUORIZACION EN LA FUNCION DE PRUEBA(CallAPIguzzle())
    public function testgetFiles()
    {
        $response = getFiles("http://192.168.10.33:7070/api/file");
        $this->assertGreaterThanOrEqual(0,json_decode($response->getBody())->totalItems);  

    }
    public function testgetFilesNoURL()
    {
        $response = getFiles(null);
        $this->assertEquals("URL no definida", $response);  

    }
    public function testuploadFileNoFilepath()
    {
        $response = uploadFile("http://192.168.10.33:7070/api/file", null);
        $this->assertEquals("ERROR: filePath Requerido para subir archivos", $response);  

    }
    public function testpostFile()
    {
        $response = uploadFile("http://192.168.10.33:7070/api/file",'./exampleFiles/hola.txt');
        $this->assertEquals(".txt",json_decode($response->getBody())->extension);  
        $this->assertEquals(201,$response->getStatusCode());  

    }
    public function testgetFileByIdNotFound()
    {
        $response = getFileById("http://192.168.10.33:7070/api/file/", "618aabf8fcce23001007d848");
        $this->assertEquals(404, $response->getCode());  

    }public function testgetFileByIdBadId()
    {
        $response = getFileById("http://192.168.10.33:7070/api/file/", "618aabf8fccej3001007d849");
        $this->assertEquals(500, $response->getCode());  

    }
}