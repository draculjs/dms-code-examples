class FileService {
  constructor(token, url) {
    if (!token) throw new Error('Token must not be null or empty')
    if (!url) throw new Error('URL must not be null or empty')

    this.#token = token
    this.#url = url
  }
  get token() {
    return this.#token
  }
  get url() {
    return this.#url
  }
  set token(token) {
    this.#token = token
  }
  set url(url) {
    this.#url = url
  }

  getFiles() {
    return new Promise((resolve, reject) => {
      setTimeout(() => {
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

  getFile(id) {
    return new Promise((resolve, reject) => {
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

  createFile(filePath) {
    return new Promise((resolve, reject) => {
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
}