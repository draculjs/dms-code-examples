# PHP

Este proyecto incluye ejemplos de código para utilizar servicios de Dracul Media Storage en el lengauje PHP, utilizando las siguientes librerias:
- GUZZLE(incluye tests)
- CURL

## Instalación y pre requisitos

Para correr el servicio, es necesario descargar las librerías de GUZZLE o CURL, y conseguir el TOKEN personal para probar las pegadas correctamente.

Para correr los tests, es necesario descargar las librerías de PHPUnit.

## Funciones

Las funciones que se dejan de ejemplo son:
- CallAPIcurl(): Archivo "CURL-ApiExample.php".La misma se utiliza para usar todos los servicios de DMS a traves de CURL, pasando los parametros corresponientes.
- CallAPIguzzle(): Archivo "GUZZLE-ApiExample.php".La misma se utiliza para usar todos los servicios de DMS a traves de GUZZLE, pasando los parametros corresponientes.

## Carpetas

Las carpetas contenidas en el codigo son:
- exampleFiles: Contiene dos archivos de distinto tipo y tamaño para utilizar de prueba en las funciones de subida de archivos.
- tests: Contiene los test de las pegadas.

## Tests

Existen tests para los tres servicios que ofrece DMS:
- testGetFileById()
- testGetFile()
- testPostFile()

Los tests corren con JUnit.
