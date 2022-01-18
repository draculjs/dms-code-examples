package ar.org.dracul.media;

import static org.junit.Assert.assertNotNull;
import static org.junit.jupiter.api.Assertions.assertEquals;
import static org.junit.jupiter.api.Assertions.assertTrue;

import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Path;

import org.junit.jupiter.api.Test;
import org.junit.runner.RunWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.core.io.FileSystemResource;
import org.springframework.core.io.Resource;
import org.springframework.test.context.junit4.SpringRunner;

import ar.org.dracul.dto.FileDTO;
import ar.org.dracul.dto.FilePaginateDTO;
import ar.org.dracul.dto.FileParamsDTO;
import ar.org.dracul.exception.FileException;
import ar.org.dracul.wss.service.FileService;

@SpringBootTest
@RunWith(SpringRunner.class)
public class FileServiceTests {

	@Autowired
	private FileService fileService;
	
	@Test
	public void testGetFileById() throws FileException {
		
		FileDTO fileDto = fileService.getFile("618aabf8fcce23001007d843");
		
		assertTrue(fileDto.exists());
		
		assertEquals("618aabf8fcce23001007d843", fileDto.get_id());
		
	}
	
	@Test
	public void testGetFile() throws FileException {
		
		FileParamsDTO fileParams = new FileParamsDTO();
		fileParams.setItemsPerPage("5");
		
		FilePaginateDTO filePaginatedDto = fileService.getFiles(fileParams);
		
		assertTrue(filePaginatedDto.exists());
		
		assertNotNull(filePaginatedDto.getItems());
		
	}
	
	@Test
	public void testPostFile() throws FileException, IOException {
		
		FileDTO fileOutputDTO  = fileService.createFile("src/main/resources/HelloWorld.txt");
		
		assertTrue(fileOutputDTO.exists());
		
	}

}
