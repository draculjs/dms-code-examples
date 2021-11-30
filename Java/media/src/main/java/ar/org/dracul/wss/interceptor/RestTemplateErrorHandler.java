/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package ar.org.dracul.wss.interceptor;

import ar.org.dracul.comun.ErrorResponse;
import com.fasterxml.jackson.core.JsonGenerator;
import com.fasterxml.jackson.databind.ObjectMapper;
import java.io.IOException;
import java.nio.charset.Charset;
import org.apache.commons.io.IOUtils;
import org.springframework.http.client.ClientHttpResponse;
import org.springframework.stereotype.Component;
import org.springframework.web.client.DefaultResponseErrorHandler;

@Component
public class RestTemplateErrorHandler extends DefaultResponseErrorHandler {

    @Override
    public void handleError(ClientHttpResponse response) throws IOException {
        ObjectMapper mapper = new ObjectMapper();
        mapper.configure(JsonGenerator.Feature.ESCAPE_NON_ASCII, true);
        String toStr = new String(IOUtils.toByteArray(response.getBody()), Charset.forName("UTF-8"));

        ErrorResponse error = new ErrorResponse();
        try {
            error = mapper.readValue(toStr, ErrorResponse.class);
        } catch (IOException iOException) {
            throw new IOException(toStr);
        }
        throw new IOException(error.getMessage());
    }

}
