const http = require('http')
const FormData = require('form-data')
const { createReadStream } = require('fs')

let tokenStr = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSIsInVzZXJuYW1lIjoicm9vdCIsInJvbGUiOnsiaWQiOiI2MTIzY2YwYWQxMTNhNzAwMTFkMTcyNDUiLCJuYW1lIjoiYWRtaW4iLCJjaGlsZFJvbGVzIjpudWxsfSwiZ3JvdXBzIjpbXSwiaWRTZXNzaW9uIjoiNjFkNDgzZmY1MTVmNmUwMDEwZjBkZTJmIiwiaWF0IjoxNjQxMzE3Mzc1LCJleHAiOjE2NDE0MDM3NzUsImp0aSI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSJ9.j3kQqJb_VwsO0zH-nUyFTYDGR1RkZzO961-EDVoNghM'
/**
 * Service to get all files
 * 
 * @param {String} url      example: 'http://192.168.10.33:7070/api/file'
 * @param {Array} params    paginated query parameters example: array(
 *    'pageNumber' => 1,
 *    'itemsPerPage'=> 5,
 *    'search'=> 'nombreImagen',
 *    'orderBy'=> 'campoDeBaseDeDatos',
 *    'orderDesc'=> null o True
 * )
 */
const getFiles = async (url, params) => {
  return new Promise((resolve, reject) => {
    setTimeout(() => {
      if (!url) reject(new Error('URL must not be null or empty'))

      const newUrl = new URL(url)
      console.log(newUrl)
      
      let options = {
        host: newUrl.hostname,
        port: newUrl.port,
        path: newUrl.pathname,
        headers: {
          "Authorization": `Bearer ${tokenStr}`
        }
      }

      http.get(options, async (res) => {
        let body = ""
        res.on('data', (data) => {
          body += data
        })
        res.on('end', () => {
          // Si se ejecutó correctamente devuelvo el objeto con todos los archivos que encontró, dentro de la propiedad items
          resolve(JSON.parse(body))
        })
        res.on('error', (error) => {
          // Si hubo algún error devuelvo el mensaje de error
          reject(new Error(error.message))
        })
      })
    }, 2000);
  })
}

/**
 * Service to get a file by id
 * 
 * @param {String} url      example: 'http://192.168.10.33:7070/api/file'
 * @param {String} id       mongoDB registry id exampĺe: "61954ca5fcce23001007da16"
 */
const getFile = (url, id) => {
  return new Promise((resolve, reject) => {
    if (!url) reject(new Error('URL must not be null or empty'))
    if (!id) reject(new Error('id must not be null or empty'))

    const newUrl = new URL(url)

    let options = {
      host: newUrl.hostname,
      port: newUrl.port,
      path: `${newUrl.pathname}/${id}`,
      headers: {
        "Authorization": `Bearer ${tokenStr}`
      }
    }

    http.get(options, (res) => {
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
        reject(new Error(e.message))
      })
    })
  })
}

/**
 * Service to upload a file
 * 
 * @param {String} url        example: 'http://192.168.10.33:7070/api/file'
 * @param {String} filePath   relative location of the file to upload example: './exampleFiles/prueba.txt'
*/
const createFile = (url, filePath) => {
  return new Promise((resolve, reject) => {

    if (!url) reject(new Error('URL must not be null or empty'))
    if (!filePath) reject(new Error('filePath must not be null or empty'))

    const readStream = createReadStream(filePath)
    const form = new FormData()

    form.append('file', readStream);
    const newUrl = new URL(url)
    const req = http.request({
      host: newUrl.hostname,
      port: newUrl.port,
      path: newUrl.pathname,
      method: 'POST',
      headers: {
        'Authorization': `Bearer ${tokenStr}`,
        ...form.getHeaders()
      }
    },
      response => {
        resolve({
          message: `StatusCode: ${response.statusCode} - ${response.statusMessage}`
        })
      }
    );

    form.pipe(req).on('error', (error) => reject(error))
  })

}

getFiles('http://192.168.10.33:7070/api/file/', [{ name: 'pageNumber', value: 1 }, { name: 'itemsPerPage', value: 3 }]).then(val => console.log(val))
//getFile('http://192.168.10.33:7070/api/file', '618aabf8fcce23001007d843').then(val => console.log(val))
//createFile('http://192.168.10.33:7070/api/file', './exampleFiles/prueba.txt').then(val => console.log(val))


module.exports = {
  getFiles,
  getFile,
  createFile
};