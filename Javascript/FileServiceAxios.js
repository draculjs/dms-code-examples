const axios = require('axios')
const querystring = require('querystring')
const FormData = require('form-data')
const fs = require('fs')
const ObjectId = require('mongoose')

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
      if (params && typeof params != 'object') return reject(new Error("Params must be a Object"))

      const queryParams = '/?'.concat(querystring.stringify(params))

      axios.get(`${this.url}${queryParams}`, { headers: { "Authorization": `Bearer ${this.token}` } })
        .then(response => {
          return resolve(response.data)
        })
        .catch(error => {
          return reject(new Error(error.message))
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
      if (!ObjectId.isValidObjectId(id)) return reject(new Error('id must be of type ObjectId'))

      axios.get(`${this.url}/${id}`, { headers: { "Authorization": `Bearer ${this.token}` } })
        .then(response => {
          return resolve(response.data)
        })
        .catch(error => {
          return reject(new Error(error.message))
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

      const form = new FormData()
      const readStream = fs.createReadStream(filePath)

      form.append('file', readStream)
      const req = {
        headers: {
          'Authorization': `Bearer ${this.token}`,
          ...form.getHeaders()
        }
      }
      
      axios.post(this.url, form, req)
        .then(response => {
          return resolve({ message: `StatusCode: ${response.request.res.statusCode} - ${response.request.res.statusMessage}`})
        })
        .catch(error => {
          return reject(error.message)
        })
    })
  }
}

module.exports = FileService