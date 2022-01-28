<?php



class UserDTO {

    private String $_id;
    private String $id;
    private Bool $active;
    private String $username;
    private String $email;
    private Array $groups;
    private String $password;
    private String $name;
    private String $role;
    private String $createdAt;
    private String $updatedAt;
    private Bool $deleted;
    private String $deletedAt="";
    private Int $__v;

    function __construct(stdClass $data) {
        foreach($data as $key => $val) {
            if(property_exists(__CLASS__,$key) && $val) {
                $this->$key = $val;
            }
        }
    }

    public function get_Id() {
        return $this->_id;
    }

    public function set_Id( $_id) {
        $this->_id = $_id;
    }

    public function getId() {
        return $this->id;
    }

    public function setId( $id) {
        $this->id = $id;
    }

    public function getActive() {
        return $this->active;
    }

    public function setActive( $active) {
        $this->active = $active;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername( $username) {
        $this->username = $username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail( $email) {
        $this->email = $email;
    }

    public function getGroups() {
        return $this->groups;
    }

    public function setGroups($groups) {
        $this->groups = $groups;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword( $password) {
        $this->password = $password;
    }

    public function getName() {
        return $this->name;
    }

    public function setName( $name) {
        $this->name = $name;
    }

    public function getRole() {
        return $this->role;
    }

    public function setRole( $role) {
        $this->role = $role;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    public function setUpdatedAt($updatedAt) {
        $this->updatedAt = $updatedAt;
    }

    public function getDeleted() {
        return $this->deleted;
    }

    public function setDeleted( $deleted) {
        $this->deleted = $deleted;
    }

    public function getDeletedAt() {
        return $this->deletedAt;
    }

    public function setDeletedAt($deletedAt) {
        $this->deletedAt = $deletedAt;
    }

    public function getV() {
        return $this->__v;
    }

    public function setV($__v) {
        $this->__v = $__v;
    }

}
