package ar.org.dracul.wss.service;

import ar.org.dracul.util.service.CommonUtil;
import ar.org.dracul.wss.template.RestTemplateRequest;
import java.util.Map;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

@Service
public class GenericService {

    @Autowired
    protected CommonUtil commonUtil;

    @Autowired
    protected RestTemplateRequest restTemplateRequest;

    protected RestTemplateRequest initRequest(Map<String, String> mapaDeHeaders) {
        resetRequest();
        return restTemplateRequest.addHeaders(mapaDeHeaders);
    }

    protected RestTemplateRequest resetRequest() {
        if (restTemplateRequest.getHeaders() != null) {
            restTemplateRequest.getHeaders().clear();
        }
        return restTemplateRequest;
    }

}
