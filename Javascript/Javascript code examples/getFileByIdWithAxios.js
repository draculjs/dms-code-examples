const axios = require('axios')

let webApiUrl = 'http://192.168.10.33:7070/api/file/618aabf8fcce23001007d843'
let tokenStr = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSIsInVzZXJuYW1lIjoicm9vdCIsInJvbGUiOnsibmFtZSI6ImFkbWluIn0sImlhdCI6MTYzNzY3MzE2OCwianRpIjoiNjEyM2NmMGFkMTEzYTcwMDExZDE3MjU5In0.wC_nc95dXu-GWGoLIgePWgo1C7_YcSZowN2_NJtQHu4'

const getFile = async () => {
  try {
    const response = await axios.get(webApiUrl, { headers: {"Authorization" : `Bearer ${tokenStr}`} })
    console.log(response.data)
  } catch (error) {
    console.log("Error: ", error)
  }
}

getFile()