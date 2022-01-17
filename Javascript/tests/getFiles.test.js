//const callAPI = require('../HTTP-example')
let callAPI = require('../HTTP-example')

describe("Tests API dracul media code example ", () => {

  test('getFileWithoutHost', async () => {
    let file = await callAPI('GET', null, 7070, '/api/file')
      expect (file).toEqual({errorMessage: 'undefined host, port or path.'})
  }, 2000)

  test('getFileWithoutPort', async () => {
    let file = await callAPI('GET', '192.168.10.33', null, '/api/file')
      expect (file).toEqual({errorMessage: 'undefined host, port or path.'})
  }, 2000) 

  test('getFileWithoutPath', async () => {
    let file = await callAPI('GET', '192.168.10.33', 7070, null)
      expect (file).toEqual({errorMessage: 'undefined host, port or path.'})
  }, 2000) 

  /* test('getFile', async () => {
    let file = await callAPI('GET', '192.168.10.33', 7070, '/api/file', '618aabf8fcce23001007d843')
    expect (file).toEqual({})
  }, 2000)
  
  test('getFiles', async () => {
    let files = await callAPI('GET', '192.168.10.33', 7070, '/api/file')
      expect (files).toEqual({})
  }, 2000)

  test('postFile', async () => {
    let file = callAPI('POST', '192.168.10.33', 7070, '/api/file', null, null, './exampleFiles/prueba.txt')
      expect (file).toEqual({})
  }, 2000) */
})