let tokenStr = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSIsInVzZXJuYW1lIjoicm9vdCIsInJvbGUiOnsiaWQiOiI2MTIzY2YwYWQxMTNhNzAwMTFkMTcyNDUiLCJuYW1lIjoiYWRtaW4iLCJjaGlsZFJvbGVzIjpudWxsfSwiZ3JvdXBzIjpbXSwiaWRTZXNzaW9uIjoiNjFhMGQ3ODIxNTdjMTcwMDEwZGIwZmE1IiwiaWF0IjoxNjM3OTMwODgyLCJleHAiOjE2MzgwMTcyODIsImp0aSI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSJ9.im7_HMP_r_uHQuudYGrz93kS-fNEb0QRpsvYpq4xl-E'

const FormData = require('form-data')
const { request } = require('http')
const { createReadStream } = require('fs')


const postFile = () => {

  array.forEach(element => {
    
  });

  array.map(() => {
    
  })

  const readStream = createReadStream('./prueba.txt')
  const form = new FormData()

  form.append('file', readStream);
  console.log(form.getHeaders())

  const req = request(
    {
      host: '192.168.10.33',
      port: '7070',
      path: '/api/file',
      method: 'POST',
      headers: {
        'Authorization': `Bearer ${tokenStr}`,
        ...form.getHeaders()
      }
    },
    response => {
      //console.log("RESPONSE", response.statusCode)
    }
  );

  try {
    form.pipe(req).on('error', (e) => console.log(e))
    
  } catch (error) {
    //console.log('e', error)
  }
}

postFile()