<?php

require __DIR__ . './../GUZZLE-ApiExample.php';
class GUZZLEtest extends \PHPUnit\Framework\TestCase
{
    //PARA TODOS LOS TEST SE DEBE TENER CONFIGURADO DE ALGUNA FORMA EL TOKEN DE AUORIZACION EN LA FUNCION DE PRUEBA(CallAPIguzzle())
    public function testGUZZLEgetFiles_1()
    {
        $response = CallAPIguzzle("GET", "http://192.168.10.33:7070/api/file");
        $this->assertGreaterThanOrEqual(0,json_decode($response->getBody())->totalItems);  

    }
    public function testGUZZLEgetFiles_2()
    {
        $response = CallAPIguzzle("", "http://192.168.10.33:7070/api/file");
        $this->assertGreaterThanOrEqual(0,json_decode($response->getBody())->totalItems); 

    }
    public function testGUZZLEgetFiles_3()
    {
        $response = CallAPIguzzle("GET",null);
        $this->assertEquals("URL no definida", $response);  

    }
    public function testGUZZLEpostFile_1()
    {
        $response = CallAPIguzzle("POST", "http://192.168.10.33:7070/api/file");
        $this->assertEquals("ERROR: filePath Requerido para subir archivos", $response);  

    }
    public function testGUZZLEpostFile_2()
    {
        $response = CallAPIguzzle("POST", "http://192.168.10.33:7070/api/file",null,null,'./exampleFiles/hola.txt');
        $this->assertEquals(".txt",json_decode($response->getBody())->extension);  
        $this->assertEquals(201,$response->getStatusCode());  

    }
    public function testGUZZLEgetById_1()
    {
        $response = CallAPIguzzle("GET", "http://192.168.10.33:7070/api/file/", "618aabf8fcce23001007d848");
        $this->assertEquals(404, $response->getCode());  

    }public function testGUZZLEgetById_2()
    {
        $response = CallAPIguzzle("GET", "http://192.168.10.33:7070/api/file/", "cualquiercosa");
        $this->assertEquals(500, $response->getCode());  

    }
}