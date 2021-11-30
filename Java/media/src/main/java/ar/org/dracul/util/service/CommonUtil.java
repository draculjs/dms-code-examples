package ar.org.dracul.util.service;

import java.util.HashMap;
import java.util.Map;
import javax.servlet.http.HttpServletRequest;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.MediaType;

import static org.springframework.http.HttpHeaders.CONTENT_TYPE;
import org.springframework.stereotype.Component;

@Component
public final class CommonUtil {

    @Autowired
    HttpServletRequest sr;
    
    public Map<String, String> getHeaders(String token) {
        Map<String, String> headers = new HashMap<>();
        headers.put(CONTENT_TYPE, "application/json");
        headers.put("Authorization", token);
        return headers;
    }
    
    
    public Map<String, String> getHeadersPost(String token) {
        Map<String, String> headers = new HashMap<>();
        headers.put("Authorization", token);
        return headers;
    }

}
