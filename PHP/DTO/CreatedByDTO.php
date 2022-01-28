<?php

require __DIR__ . "./../DTO/UserDTO.php";

class CreatedByDTO {

    private UserDTO $user;
    private String $username;

    function __construct(stdClass $data) {
        foreach($data as $key => $val) {
            if(property_exists(__CLASS__,$key)) {
                if($key == "user"){
                    $this->user = new UserDTO($val);
                }else{
                    $this->$key = $val;
                }
            }
        }
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser(UserDTO $user) {
        $this->user = $user;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

}
