<?php

require __DIR__  . "./../FileService.php";
require __DIR__ . "./../DTO/CreatedByDTO.php";
require __DIR__ . "./../DTO/FileDTO.php";
require __DIR__ . "./../DTO/FilePaginateDTO.php";


class GUZZLEtest extends \PHPUnit\Framework\TestCase
{
    private $url = "http://192.168.10.33:7070/api/file/";
    private $token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSIsInVzZXJuYW1lIjoicm9vdCIsInJvbGUiOnsiaWQiOiI2MTIzY2YwYWQxMTNhNzAwMTFkMTcyNDUiLCJuYW1lIjoiYWRtaW4iLCJjaGlsZFJvbGVzIjpudWxsfSwiZ3JvdXBzIjpbXSwiaWRTZXNzaW9uIjoiNjFmM2VjNTg1YmFiY2UwMDExM2Y5Y2RjIiwiaWF0IjoxNjQzMzc1NzA0LCJleHAiOjE2NDM0NjIxMDQsImp0aSI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSJ9.zaPfdMNZEu5QFOwAmSnANZSJX-fhQ5wWMwesYWYlDlw";
    private $service;

    //PARA TODOS LOS TEST SE DEBE TENER CONFIGURADO DE ALGUNA FORMA EL TOKEN DE AUORIZACION EN LA FUNCION DE PRUEBA(CallAPIguzzle())
    public function testgetFiles()
    {
        $this->service = new FileService($this->token, $this->url);
        $response = $this->service->getFiles();
        $FilesRaw = $response;

        $Files = new FilePaginateDTO($FilesRaw);
        
        $this->assertEquals("root",$Files->getItems()[0]->getCreatedBy()->getUsername());  

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
        $FileRaw = $response;

        $File = new FileDTO($FileRaw);
        $this->assertEquals("root",$File->getCreatedBy()->getUsername());  

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
        $FileRaw = $response;

        $File = new FileDTO($FileRaw);
        $this->assertEquals("618aabf8fcce23001007d843", $File->getId());  

    }
    public function testgetFileBadId()
    {
        $this->service = new FileService($this->token, $this->url);
        $response = $this->service->getFile("618aabf8fccej3001007d849");
        $this->assertEquals(500, $response->getCode());  

    }
}