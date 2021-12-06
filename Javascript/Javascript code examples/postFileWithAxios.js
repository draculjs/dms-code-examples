const axios = require('axios')
const FormData = require('form-data')
const fs = require('fs')

let webApiUrl = 'http://192.168.10.33:7070/api/file'
let tokenStr = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSIsInVzZXJuYW1lIjoicm9vdCIsInJvbGUiOnsibmFtZSI6ImFkbWluIn0sImlhdCI6MTYzNzI2MzAzNywianRpIjoiNjEyM2NmMGFkMTEzYTcwMDExZDE3MjU5In0.D8TxiNOdpJdfqM4UFc6ZP1Xt1n1UVCnXyGeyyf2M8V4'




const form = new FormData();
form.append('file', fs.createReadStream('../prueba.txt'))

const request_config = {
  headers: {
    'Authorization': `Bearer ${tokenStr}`,
    ...form.getHeaders()
  }
};

return axios.post(webApiUrl, form, request_config)