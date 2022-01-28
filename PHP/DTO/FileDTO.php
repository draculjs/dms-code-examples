<?php

class FileDTO {

    private CreatedByDTO $createdBy;
    private Array $tags;
    private String $_id;
    private String $filename;
    private String $mimetype;
    private String $type;
    private String $extension;
    private String $relativePath;
    private String $absolutePath;
    private Float $size;
    private String $url;
    private String $lastAccess;
    private String $createdAt;
    private String $deletedAt;
    private Int $__v;

    function __construct(stdClass $data) {
        foreach($data as $key => $val) {
            if(property_exists(__CLASS__,$key)) {
                if($key == "createdBy"){
                    $this->createdBy = new CreatedByDTO($val);
                }else{
                    $this->$key = $val;
                }
            }
        }
    }

    public function getCreatedBy() {
        return $this->createdBy;
    }

    public function setCreatedBy(CreatedByDTO $createdBy) {
        $this->createdBy = $createdBy;
    }

    public function getTags() {
        return $this->tags;
    }

    public function setTags($tags) {
        $this->tags = $tags;
    }

    public function getId() {
        return $this->_id;
    }

    public function setId($_id) {
        $this->_id = $_id;
    }

    public function getFilename() {
        return $this->filename;
    }

    public function setFilename($filename) {
        $this->filename = $filename;
    }

    public function getMimetype() {
        return $this->mimetype;
    }

    public function setMimetype($mimetype) {
        $this->mimetype = $mimetype;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getExtension() {
        return $this->extension;
    }

    public function setExtension($extension) {
        $this->extension = $extension;
    }

    public function getRelativePath() {
        return $this->relativePath;
    }

    public function setRelativePath($relativePath) {
        $this->relativePath = $relativePath;
    }

    public function getAbsolutePath() {
        return $this->absolutePath;
    }

    public function setAbsolutePath($absolutePath) {
        $this->absolutePath = $absolutePath;
    }

    public function getSize() {
        return $this->size;
    }

    public function setSize($size) {
        $this->size = $size;
    }

    public function getUrl() {
        return $this->url;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function getLastAccess() {
        return $this->lastAccess;
    }

    public function setLastAccess($lastAccess) {
        $this->lastAccess = $lastAccess;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
    }

    public function getV() {
        return $this->__v;
    }

    public function setV($__v) {
        $this->__v = $__v;
    }

    public function getDeletedAt() {
        return $this->deletedAt;
    }

    public function setDeletedAt($deletedAt) {
        $this->deletedAt = $deletedAt;
    }

	public function exists() {		
		return $this->getId() != null;
	}

}
