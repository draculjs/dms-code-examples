<?php

require __DIR__  . "./../FileService.php";
require __DIR__ . "./../FilePaginateDTO.php";
require __DIR__ . "./../FileDTO.php";


class GUZZLEtest extends \PHPUnit\Framework\TestCase
{
    private $url = "http://192.168.10.33:7070/api/file/";
    private $token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSIsInVzZXJuYW1lIjoicm9vdCIsInJvbGUiOnsiaWQiOiI2MTIzY2YwYWQxMTNhNzAwMTFkMTcyNDUiLCJuYW1lIjoiYWRtaW4iLCJjaGlsZFJvbGVzIjpudWxsfSwiZ3JvdXBzIjpbXSwiaWRTZXNzaW9uIjoiNjFlNTgyYzY1MTVmNmUwMDEwZjBlNDgxIiwiaWF0IjoxNjQyNDMxMTc1LCJleHAiOjE2NDI1MTc1NzUsImp0aSI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSJ9.gl9h9S0hnHP7Nl6sYaC6ha2TPx25azCPAGkfuLC-6Mo";
    private $service;

    //PARA TODOS LOS TEST SE DEBE TENER CONFIGURADO DE ALGUNA FORMA EL TOKEN DE AUORIZACION EN LA FUNCION DE PRUEBA(CallAPIguzzle())
    public function testgetFiles()
    {
        $this->service = new FileService($this->token, $this->url);
        $response = $this->service->getFiles();
        $FilesRaw = json_decode($response->getBody());

        $Files = new FilePaginateDTO();
        $Files->setItems($FilesRaw->items);
        $Files->setTotalItems($FilesRaw->totalItems);
        $Files->setPage($FilesRaw->page);
        
        $this->assertGreaterThanOrEqual(0,$Files->totalItems);  

    }
    public function testcreateFileNoFilepath()
    {
        $this->service = new FileService($this->token, $this->url);
        $this->expectExceptionMessage("filePath no definido");
        $this->service->createFile(null);

    }
    public function testpostFile()
    {
        $this->service = new FileService($this->token, $this->url);
        $response = $this->service->createFile('./exampleFiles/hola.txt');
        $FileRaw = json_decode($response->getBody());

        $File = new FileDTO();
        $File->setExtension($FileRaw->extension);
        $this->assertEquals(".txt",$File->getExtension());  
        $this->assertEquals(201,$response->getStatusCode());  

    }
    public function testgetFileNotFound()
    {
        $this->service = new FileService($this->token, $this->url);
        $response = $this->service->getFile("618aabf8fcce23001007d848");
        $this->assertEquals(404, $response->getCode());  

    }
    public function testgetFile()
    {
        $this->service = new FileService($this->token, $this->url);
        $response = $this->service->getFile("618aabf8fcce23001007d843");
        $FileRaw = json_decode($response->getBody());

        $File = new FileDTO();
        $File->set_id($FileRaw->_id);
        $this->assertEquals("618aabf8fcce23001007d843", $File->get_id());  

    }
    public function testgetFileBadId()
    {
        $this->service = new FileService($this->token, $this->url);
        $response = $this->service->getFile("618aabf8fccej3001007d849");
        $this->assertEquals(500, $response->getCode());  

    }
}