package ar.org.dracul.wss.template;

import ar.org.dracul.wss.interceptor.RestTemplateErrorHandler;
import java.util.Map;
import javax.annotation.PostConstruct;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpEntity;
import org.springframework.http.HttpHeaders;
import org.springframework.http.HttpMethod;
import org.springframework.http.ResponseEntity;
import org.springframework.stereotype.Component;
import org.springframework.web.client.RestTemplate;

@Component
public class RestTemplateRequest extends RestTemplate {

    @Autowired
    RestTemplateErrorHandler restTemplateErrorHandler;

    @PostConstruct
    public void setErrorHandler() {
        this.setErrorHandler(restTemplateErrorHandler);
    }
    
    private HttpHeaders headers;

    public RestTemplateRequest addHeaders(Map<String, String> headers) {
        if (this.headers == null) {
            this.headers = new HttpHeaders();
        }
        headers.entrySet().forEach((entry) -> {
            String key = entry.getKey();
            String value = entry.getValue();
            addHeader(key, value);
        });
        return this;
    }

    public void addHeader(String key, String value) {
        if (this.headers == null) {
            this.headers = new HttpHeaders();
        }
        this.headers.set(key, value);;
    }

    public HttpHeaders getHeaders() {
        return this.headers;
    }

    public HttpEntity getEntity() {
        return new HttpEntity(this.headers);
    }

    public HttpEntity getEntity(Object body) {
        return new HttpEntity(body, this.headers);
    }

    public void resetRequest() {
        if (this.headers != null) {
            this.headers.clear();
        }
    }

    public <T> T get(String url, Class<?> responseClass, Map<String, String> vars) {
        ResponseEntity<?> responseEntity = this.exchange(url, HttpMethod.GET, this.getEntity(), responseClass, vars);

        T response = (T) responseEntity.getBody();
        return response;
    }

    public <T> T post(String url, Object body, Class<?> responseClass, Map<String, String> vars) {
        ResponseEntity<?> responseEntity;
        if (vars == null) {
            responseEntity = this.exchange(url, HttpMethod.POST, this.getEntity(body), responseClass);
        } else {
            responseEntity = this.exchange(url, HttpMethod.POST, this.getEntity(body), responseClass, vars);
        }
        T response = (T) responseEntity.getBody();

        return response;
    }

    public <T> T put(String url, Object body, Class<?> responseClass, Map<String, String> vars) {
        ResponseEntity<?> responseEntity;
        if (vars == null) {
            responseEntity = this.exchange(url, HttpMethod.PUT, this.getEntity(body), responseClass);
        } else {
            responseEntity = this.exchange(url, HttpMethod.PUT, this.getEntity(body), responseClass, vars);
        }
        T response = (T) responseEntity.getBody();

        return response;
    }
}
