# PHP

Este proyecto incluye ejemplos de código para utilizar servicios de Dracul Media Storage en el lengauje PHP, utilizando las siguientes librerias:
- GUZZLE(incluye tests)
- CURL

## Instalación y pre requisitos

Para correr el servicio, es necesario descargar las librerías de GUZZLE o CURL, y conseguir el TOKEN personal para probar las pegadas correctamente.

Para correr los tests, es necesario descargar las librerías de PHPUnit.

## Funciones

Las funciones que se dejan de ejemplo son:
- getFiles(): Archivo "getFiles.GUZZLE.php" y "getFiles.CURL.php". La misma se utiliza para obtener todos los archivos que se encuentran subidos a la plataforma (por default solo devuelve los ultimos 5).
- getFile(): Archivo "getFile.GUZZLE.php" y "getFile.CURL.php". La misma se utiliza para obtener un archivo especifico pasando como parametro su Id.
- uploadFile(): Archivo "uploadFile.GUZZLE.php" y "uploadFile.CURL.php". La misma se utiliza para subir un archivo a la plataforma.

## Carpetas

Las carpetas contenidas en el codigo son:
- exampleFiles: Contiene dos archivos de distinto tipo y tamaño para utilizar de prueba en las funciones de subida de archivos.
- tests: Contiene los test de las pegadas.

## Tests

Existen tests para los tres servicios que ofrece DMS:
- getFiles()
- getFile()
- uploadFile()

Los tests corren con PHPUnit.
