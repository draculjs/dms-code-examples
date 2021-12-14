const { get, request } = require('http')
const FormData = require('form-data')
const { createReadStream } = require('fs')

let tokenStr = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSIsInVzZXJuYW1lIjoicm9vdCIsInJvbGUiOnsiaWQiOiI2MTIzY2YwYWQxMTNhNzAwMTFkMTcyNDUiLCJuYW1lIjoiYWRtaW4iLCJjaGlsZFJvbGVzIjpudWxsfSwiZ3JvdXBzIjpbXSwiaWRTZXNzaW9uIjoiNjFiODk0Mzc1MTVmNmUwMDEwZjBjZDIzIiwiaWF0IjoxNjM5NDg2NTE5LCJleHAiOjE2Mzk1NzI5MTksImp0aSI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSJ9.X7Lx4R1pAzWjVtcyeislvpgw_aiRtl-VnEsXDWAbojU'
/**
 * 
 * Parametros usados para obtener info de archivos o subir archivos
 * URL = http://host:port+path
 * @param {String} host   Host ej: '192.168.10.33'
 * @param {Number} port   Puerto ej: 7070
 * @param {String} path   Path ej: '/api/file'
 * @param {Array} params  Parametros de la query paginada ej: array(
 *    'pageNumber' => 1,
 *    'itemsPerPage'=> 5,
 *    'search'=> 'nombreImagen',
 *    'orderBy'=> 'campoDeBaseDeDatos',
 *    'orderDesc'=> null o True
 * )
*/
const getFiles = async (host, port, path, params = []) => {
  if (!host || !port || !path) return [{ errorMessage: 'undefined host, port or path' }]

  let options = {
    host,
    port,
    path,
    headers: {
      "Authorization": `Bearer ${tokenStr}`
    }
  };

  return new Promise((resolve, reject) => {

    get(options, (res) => {
      let body = ""
      res.on('data', function (data) {
        body += data
      })
      res.on('end', function () {
        // Si se ejecutó correctamente devuelvo el objeto con todos los archivos que encontró, dentro de la propiedad items
        resolve(JSON.parse(body))
      })
      res.on('error', function (e) {
        // Si hubo algún error devuelvo el mensaje de error
        reject([{ errorMessage: e.message }])
      })
    })
  })
}

/**
  * 
  * Parametros usados para obtener info de archivos o subir archivos
  * URL = http://host:port+path+id
  * @param {String} host   Host ej: '192.168.10.33'
  * @param {Number} port   Puerto ej: 7070
  * @param {String} path   Path ej: '/api/file'
  * @param {String} id     Id del archivo en mongo ej: "61954ca5fcce23001007da16"
*/
const getFile = async (host, port, path, id) => {
  if (!host || !port || !path) return [{ errorMessage: 'undefined host, port or path' }]

  if (id) {

    let options = {
      host,
      port,
      path: `${path}/${id}`,
      headers: {
        "Authorization": `Bearer ${tokenStr}`
      }
    }

    return new Promise((resolve, reject) => {

      get(options, (res) => {
        let body = ""
        res.on('data', function (data) {
          body += data
        })
        res.on('end', function () {
          // Si se ejecutó correctamente devuelvo el objeto con todos los archivos que encontró, dentro de la propiedad items
          resolve(JSON.parse(body))
        })
        res.on('error', function (e) {
          // Si hubo algún error devuelvo el mensaje de error
          reject([{ errorMessage: e.message }])
        })
      })
    })
  } else {
    return [{ errorMessage: 'id cannot be empty or null' }]
  }
}

/**
 
 * Parametros usados para obtener info de archivos o subir archivos
 * URL = http://host:port+path+filePath
 * @param {String} host     Host ej: '192.168.10.33'
 * @param {Number} port     Puerto ej: 7070
 * @param {String} path     Path ej: '/api/file'
 * @param {String} filePath Path relativo del el archivo a subir respecto del archivo actual ej: "./exampleFiles/prueba.txt"
 
 * @return {Array}          Array de objetos con toda la info de los archivos encontrados, el archivo subido o el error
*/
const createFile = async (host, port, path, filePath = null) => {
  if (!host || !port || !path) return [{ errorMessage: 'undefined host, port or path' }]

  if (filePath) {
    const readStream = createReadStream(filePath)
    const form = new FormData()

    form.append('file', readStream);

    return new Promise((resolve, reject) => {

      const req = request(
        {
          host,
          port,
          path,
          method: 'POST',
          headers: {
            'Authorization': `Bearer ${tokenStr}`,
            ...form.getHeaders()
          }
        },
        response => {
          resolve([{ message: `StatusCode: ${response.statusCode} - ${response.statusMessage}` }])
        }
      );

      try {
        form.pipe(req).on('error', (e) => { reject([{ errorMessage: e.message }]) })
      } catch (error) {
        reject([{ errorMessage: error.message }])
      }
    })
  } else {
    return [{ errorMessage: 'filePath cannot be empty or null' }]
  }
}

module.exports = {
  getFiles,
  getFile,
  createFile
};