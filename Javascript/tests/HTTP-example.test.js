//const callAPI = require('../HTTP-example')
const http = require('../HTTP-example')

describe("Tests API dracul media code example ", () => {
  
  test('getFiles without URL', async () => {
    try {
      await http.getFiles(null, [])
    } catch (error) {
      expect(error.message).toEqual('URL must not be null or empty')
    }
  }, 2000)

  test('getFile without URL', async () => {
    try {
      let file = await http.getFile(null, '618aabf8fcce23001007d843')
    } catch (error) {
      expect(error.message).toEqual('URL must not be null or empty')
    }
  }, 2000)
  
  test('createFile without URL', async () => {
    try {
      await http.createFile(null, './exampleFiles/prueba.txt')
    } catch (error) {
      expect(error.message).toEqual('URL must not be null or empty')
    }
  }, 2000)
  
  test('getFile without id', async () => {
    try {
      await http.getFile('http://192.168.10.33:7070/api/file')
    } catch (error) {
      expect(error.message).toEqual('id must not be null or empty')
    }
  }, 2000)

  test('getFile with wrong id', async () => {
    try {
      let file = await http.getFile('http://192.168.10.33:7070/api/file', '618aabf8001007d843')
    } catch (error) {
      expect(error).toThrow({ message: 'Cast to ObjectId failed for value "618aabf8001007d843" (type string) at path "_id" for model "File"' })
    }
  }, 2000)


  test('createFile without filePath', async () => {
    try {
      await http.createFile('http://192.168.10.33:7070/api/file', null)
    } catch (error) {
      expect(error.message).toEqual('filePath must not be null or empty')
    }
  }, 2000)

  test('getFiles successfully', async () => {
    try {
      let files = await http.getFiles('http://192.168.10.33:7070/api/file')
      expect(files).toMatchObject({ items: expect.any(Object) })
    } catch (error) {
      throw new Error(error.message)
    }
  }, 2000)

  test('getFile successfully', async () => {
    try {
      let file = await http.getFile('http://192.168.10.33:7070/api/file', '618aabf8fcce23001007d843')
      expect(file._id).toEqual('618aabf8fcce23001007d843')
    } catch (error) {
      throw new Error(error.message)
    }
  }, 2000)

  test('createFile successfully', async () => {
    try {
      let file = await http.createFile('http://192.168.10.33:7070/api/file', './exampleFiles/prueba.txt')
      expect(file).toEqual({ message: 'StatusCode: 201 - Created' })
    } catch (error) {
      throw new Error(error.message)
    }
  }, 4000)

})