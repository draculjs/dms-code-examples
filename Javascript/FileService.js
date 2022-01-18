const http = require('http')
const querystring = require('querystring')
const FormData = require('form-data')
const { createReadStream } = require('fs')

class FileService {

  /** @constructor */
  constructor(url, token) {
    if (!url) throw new Error('URL must not be null or empty')
    if (!token) throw new Error('Token must not be null or empty')

    this.url = url
    this.token = token
  }

  /**
    * Service to get all files
    * 
    * @param {Object} params    paginated query parameters example: {
    *    pageNumber: 1,
    *    itemsPerPage: 5,
    *    search: 'nombreImagen',
    *    orderBy: 'campoDeBaseDeDatos',
    *    orderDesc: null
    * }
    * @return {Array}
  */
  getFiles(params) {
    return new Promise((resolve, reject) => {
      const newUrl = new URL(this.url)
      const queryParams = querystring.stringify(params)

      let options = {
        host: newUrl.hostname,
        port: newUrl.port,
        path: `${newUrl.pathname}/?${queryParams}`,
        headers: {
          "Authorization": `Bearer ${this.token}`
        }
      }

      http.get(options, async (res) => {
        let body = ""
        res.on('data', (data) => {
          body += data
        })
        res.on('end', () => {
          return resolve(JSON.parse(body))
        })
        res.on('error', (error) => {
          return reject(new Error(error.message))
        })
      })
    })
  }

  /**
    * Service to get a file by id
    * 
    * @param {String} id       mongoDB registry id exampĺe: "61954ca5fcce23001007da16"
    * @return {Object}
  */
  getFile(id) {
    return new Promise((resolve, reject) => {
      if (!id) reject(new Error('id must not be null or empty'))
      const newUrl = new URL(this.url)

      let options = {
        host: newUrl.hostname,
        port: newUrl.port,
        path: `${newUrl.pathname}/${id}`,
        headers: {
          "Authorization": `Bearer ${this.token}`
        }
      }

      http.get(options, (res) => {
        let body = ""
        res.on('data', function (data) {
          body += data
        })
        res.on('end', function () {
          return resolve(JSON.parse(body))
        })
        res.on('error', function (e) {
          return reject(new Error(e.message))
        })
      })
    })
  }

  /**
    * Service to upload a file
    * 
    * @param {String} filePath   relative location of the file to upload example: './exampleFiles/prueba.txt'
    * @return {Object}
  */
  createFile(filePath) {
    return new Promise((resolve, reject) => {
      if (!filePath) reject(new Error('filePath must not be null or empty'))

      const readStream = createReadStream(filePath)
      const form = new FormData()

      form.append('file', readStream);
      const newUrl = new URL(this.url)
      const req = http.request({
        host: newUrl.hostname,
        port: newUrl.port,
        path: newUrl.pathname,
        method: 'POST',
        headers: {
          'Authorization': `Bearer ${this.token}`,
          ...form.getHeaders()
        }
      },
        response => {
          return resolve({
            message: `StatusCode: ${response.statusCode} - ${response.statusMessage}`
          })
        }
      )

      form.pipe(req).on('error', (error) => reject(error))
    })
  }
}

module.exports = FileService