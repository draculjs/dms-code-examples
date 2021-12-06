let webApiUrl = '192.168.10.33';
let fileId = '618aabf8fcce23001007d843'
let tokenStr = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSIsInVzZXJuYW1lIjoicm9vdCIsInJvbGUiOnsibmFtZSI6ImFkbWluIn0sImlhdCI6MTYzNzI2MzAzNywianRpIjoiNjEyM2NmMGFkMTEzYTcwMDExZDE3MjU5In0.D8TxiNOdpJdfqM4UFc6ZP1Xt1n1UVCnXyGeyyf2M8V4'

const https = require('http')

var options = {
  host: webApiUrl,
  port: 7070,
  path: '/api/file/'+fileId,
  headers: {
    "Authorization" : `Bearer ${tokenStr}`
  }   
};

https.get(options, (res) => {
  var body = ""
   res.on('data', function(data) {
      body += data
   })
   res.on('end', function() {
    //here we have the full response, html or json object
      //console.log(body)
   })
   res.on('error', function(e) {
      //console.log("Got error: " + e.message)
   })
})