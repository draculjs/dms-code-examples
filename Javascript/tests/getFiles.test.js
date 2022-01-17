//const callAPI = require('../HTTP-example')
const http = require('../HTTP-example')

describe("Tests API dracul media code example ", () => {

  test('getFilesWithoutHost', async () => {
    let file = await http.getFiles(null, 7070, '/api/file', [])
    expect (file).toEqual([{errorMessage: 'undefined host, port or path'}])
  }, 200)
  
  test('getFileWithoutPath', async () => {
    let file = await http.getFile('192.168.10.33', 7070, null, '618aabf8fcce23001007d843')
    expect (file).toEqual([{errorMessage: 'undefined host, port or path'}])
  }, 200)

  /* test('getFile', async () => {
    let file = await callAPI('GET', '192.168.10.33', 7070, '/api/file', '618aabf8fcce23001007d843')
    expect (file).toEqual({})
  }, 2000)
  test('getFileWithoutId', async() => {
    try {
      let file = await http.getFile('192.168.10.33', 7070, '/api/file')
    } catch (error) {
      expect(error).toThrow({errorMessage: 'id cannot be empty or null'})
    } 
  }, 200)

  test('getFileWithWrongId', async() => {
    try {
      let file = await http.getFile('192.168.10.33', 7070, '/api/file', '618aabf8001007d843')
    } catch (error) {
      expect(error).toThrow({message: 'Cast to ObjectId failed for value "618aabf8001007d843" (type string) at path "_id" for model "File"'})
    } 
  }, 200)
  
  test('createFileWithoutPath', async () => {
    let file = await http.createFile('192.168.10.33', 7070, null)
    expect (file).toEqual([{errorMessage: 'undefined host, port or path'}])
  }, 200)
  
  test('createFileWithoutFilePath', async () => {
    let file = await http.createFile('192.168.10.33', 7070, '/api/file', null)
    expect (file).toEqual([{errorMessage: 'filePath cannot be empty or null'}])
  }, 200)
  
  test('createFileWithoutPathWithPath', async () => {
    let file = await http.createFile('192.168.10.33', 7070, null, './exampleFiles/prueba.txt')
    expect (file).toEqual([{errorMessage: 'undefined host, port or path'}])
  }, 200)

  test('getFiles', async() => {
    try {
      let files = await http.getFiles('192.168.10.33', 7070, '/api/file')
      expect(files).toMatchObject({items: expect.any(Object)})
    } catch (error) {
      throw new Error(error.message)
    } 
  }, 200) 

  test('getFile', async() => {
    try {
      let file = await http.getFile('192.168.10.33', 7070, '/api/file', '618aabf8fcce23001007d843')
      expect(file._id).toEqual('618aabf8fcce23001007d843')
    } catch (error) {
      throw new Error(error.message)
    } 
  }, 200) 

  test('createFile', async () => {
    try {
      let file = await http.createFile('192.168.10.33', 7070, '/api/file', './exampleFiles/prueba.txt')
      expect (file).toEqual([{message: 'StatusCode: 201 - Created'}])
    } catch (error) {
      throw new Error(error.message)
    }
  }, 500)
  
})