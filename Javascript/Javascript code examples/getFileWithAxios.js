const axios = require('axios')

let webApiUrl = 'http://192.168.10.33:7070/api/file'
//let webApiUrl = 'http://localhost:7000/api/file'

let tokenStr = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjYxMjNjZjBhZDExM2E3MDAxMWQxNzI1OSIsInVzZXJuYW1lIjoicm9vdCIsInJvbGUiOnsibmFtZSI6ImFkbWluIn0sImlhdCI6MTYzNzY4MjEyNiwianRpIjoiNjEyM2NmMGFkMTEzYTcwMDExZDE3MjU5In0.YA3gaNcgGB2oCEnITXoE2mcsruNCtNZ-6bJw8fpReWI'

const getFile = async () => {
  console.log("ENTRAAAAAAAAAAAAAAAAA")
  try {
    const response = await axios.get(webApiUrl, { headers: {"Authorization" : `Bearer ${tokenStr}`} })
    
    console.log(response.data)
  } catch (error) {
    console.log("Error: ", error)
  }
}

getFile()