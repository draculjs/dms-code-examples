let tokenStr = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSIsInVzZXJuYW1lIjoicm9vdCIsInJvbGUiOnsiaWQiOiI2MTIzY2YwYWQxMTNhNzAwMTFkMTcyNDUiLCJuYW1lIjoiYWRtaW4iLCJjaGlsZFJvbGVzIjpudWxsfSwiZ3JvdXBzIjpbXSwiaWRTZXNzaW9uIjoiNjFhMGQ3ODIxNTdjMTcwMDEwZGIwZmE1IiwiaWF0IjoxNjM3OTMwODgyLCJleHAiOjE2MzgwMTcyODIsImp0aSI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSJ9.im7_HMP_r_uHQuudYGrz93kS-fNEb0QRpsvYpq4xl-E'
const https = require('http')

let options = {
  host: '192.168.10.33',
  port: 7070,
  path: '/api/file',
  headers: {
    "Authorization": `Bearer ${tokenStr}`
  }
};

const getFiles = () => {
  https.get(options, (res) => {
    let body = ""
    res.on('data', function (data) {
      body += data
    })
    res.on('end', function () {
      // Si se ejecutó correctamente devuelvo el objeto con todos los archivos que encontró, dentro de la propiedad items
      return body
    })
    res.on('error', function (e) {
      // Si hubo algún error devuelvo el mensaje de error
      return `Error: ${e.message}`
    })
  })
}

getFiles()