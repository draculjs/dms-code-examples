package ar.org.dracul.wss.service;

import ar.org.dracul.dto.FileDTO;
import ar.org.dracul.dto.FilePaginateDTO;
import ar.org.dracul.dto.FileParamsDTO;
import ar.org.dracul.exception.FileException;

import org.springframework.beans.factory.annotation.Value;
import org.springframework.core.io.FileSystemResource;
import org.springframework.core.io.Resource;

import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.Paths;
import java.util.HashMap;
import java.util.Map;

import org.springframework.stereotype.Service;
import org.springframework.util.LinkedMultiValueMap;
import org.springframework.util.MultiValueMap;

@Service
public class FileService extends GenericService {

	@Value("${DRACUL_MEDIA_ENDPOINT}")
    private String DRACUL_MEDIA_ENDPOINT;
	
	@Value("${AUTH_TOKEN}")
    private String token;

    public FilePaginateDTO getFiles(FileParamsDTO fileParams) throws FileException {
        FilePaginateDTO filePaginateDTO = null;
        try {
            String url = DRACUL_MEDIA_ENDPOINT + "/file";

            Map<String, String> vars = new HashMap<>();
            vars.put("pageNumber", fileParams.getPageNumber());
            vars.put("itemsPerPage", fileParams.getItemsPerPage());
            vars.put("search", fileParams.getSearch());
            vars.put("orderBy", fileParams.getOrderBy());
            vars.put("orderDesc", fileParams.getOrderDesc());

            filePaginateDTO = initRequest(commonUtil.getHeaders(token)).get(url, FilePaginateDTO.class, vars);
        } catch (Exception e) {
             throw new FileException(e.getMessage());
        }
        return filePaginateDTO;
    }

    public FileDTO getFile(String id) throws FileException {
    	FileDTO fileDTO = null;
        
        try {
            String url = DRACUL_MEDIA_ENDPOINT + "/file/{id}";

            Map<String, String> vars = new HashMap<>();
            vars.put("id", id);

            fileDTO = initRequest(commonUtil.getHeaders(token)).get(url, FileDTO.class, vars);
        } catch (Exception e) {
             throw new FileException(e.getMessage());
        }
        return fileDTO;
    }
    
    public FileDTO createFile(String filePath) throws FileException {
    	
        FileDTO fileOutputDTO = null;
        try {
            String url = DRACUL_MEDIA_ENDPOINT + "/file";
            
            Resource file = getFileFromPath(filePath);
            
            MultiValueMap<String, Object> body = new LinkedMultiValueMap<>();
        	body.add("file", file);
        	        	
            fileOutputDTO = initRequest(commonUtil.getHeadersPost(token)).post(url, body, FileDTO.class, null);
        } catch (Exception e) {
            throw new FileException(e.getMessage());
        }
        return fileOutputDTO;
    }
    
    private Resource getFileFromPath(String filePath) throws IOException {
        Path path = Paths.get(filePath);
        return new FileSystemResource(path.toFile());
    }

}
