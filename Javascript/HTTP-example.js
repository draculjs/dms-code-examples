const callAPI = async (method, host, port, path, id = null, params = [], filePath = null, result) => {
  if (!host || !port || !path) return { errorMessage: 'undefined host, port or path.' }

  let tokenStr = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSIsInVzZXJuYW1lIjoicm9vdCIsInJvbGUiOnsiaWQiOiI2MTIzY2YwYWQxMTNhNzAwMTFkMTcyNDUiLCJuYW1lIjoiYWRtaW4iLCJjaGlsZFJvbGVzIjpudWxsfSwiZ3JvdXBzIjpbXSwiaWRTZXNzaW9uIjoiNjFhZWU0YzcxNTdjMTcwMDEwZGIyNDZkIiwiaWF0IjoxNjM4ODUxNzgzLCJleHAiOjE2Mzg5MzgxODMsImp0aSI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSJ9.lx_Gp41tu_yY_smcA78lunCo9fYneKRYAFqRzOmE4bE'
  let options = {
    host,
    port,
    path,
    headers: {
      "Authorization": `Bearer ${tokenStr}`
    }
  };

  switch (method) {
    case 'POST':
      const FormData = require('form-data')
      const { request } = require('http')
      const { createReadStream } = require('fs')

      const readStream = createReadStream('./exampleFiles/prueba.txt')
      const form = new FormData()

      form.append('file', readStream);

      const req = request(
        {
          host,
          port,
          path,
          method,
          headers: {
            'Authorization': `Bearer ${tokenStr}`,
            ...form.getHeaders()
          }
        },
        response => {
          return (response.statusCode)
        }
      );

      try {
        form.pipe(req).on('error', (e) => console.log(e))
      } catch (error) {
        console.log('e', error)
      }
      break;
    case 'GET':
      const https = require('http')

      if (id) options.path = `${path}/${id}`

      let body = ""
      https.get(options, (res) => {
        res.on('data', (data) => { body += data })

        // Si se ejecutó correctamente devuelvo el objeto con todos los archivos que encontró, dentro de la propiedad items
        res.on('end', () => { return body })

        // Si hubo algún error devuelvo el mensaje de error
        res.on('error', (e) => { return `Error: ${e.message}` })
      })

      break;
    default:
      break;
  }
}

//method, host, port, path, id = null, params = [], filePath = null, result
//const prueba = callAPI('POST', '192.168.10.33', 7070, '/api/file')

module.exports = callAPI