const getFiles = require('../Javascript code examples/getFiles')
const getFileById = require('../Javascript code examples/getFileById')
const postFile = require('../Javascript code examples/postFile')

describe("Tests API dracul media code example ", () => {
  test('getFileById', async () => {
    let file = await getFileById
      expect (file).toEqual({})
  }, 2000)

  test('getFiles', async () => {
    let files = await getFiles
      expect (files).toEqual({})
  }, 2000)

  test('postFile', async () => {
    let file = await postFile
      expect (file).toEqual({})
  }, 2000)
  
})