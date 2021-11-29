package ar.org.dracul.dto;

public class CreatedByDTO {

    private UserDTO user;
    private String username;

    public UserDTO getUser() {
        return user;
    }

    public void setUser(UserDTO user) {
        this.user = user;
    }

    public String getUsername() {
        return username;
    }

    public void setUsername(String username) {
        this.username = username;
    }

}
