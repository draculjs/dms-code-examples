package ar.org.dracul.comun;

import java.util.Date;

public class ErrorResponse {

    private String message;
    private Date timestamp;

    public ErrorResponse() {

    }

    public ErrorResponse(String message) {
        this.message = message;
        this.timestamp = new java.util.Date();
    }

    public String getMessage() {
        return message;
    }

    public Date getTimestamp() {
        return timestamp;
    }
}
