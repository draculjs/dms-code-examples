<?php

class FilePaginateDTO {

    private array $items=[];
    private int $totalItems;
    private int $page;

    function __construct(stdClass $data) {
        foreach($data as $key => $val) {
            if(property_exists(__CLASS__,$key)) {
                if($key == "items"){
                    foreach($val as $arrayVal) {
                        $file = new FileDTO($arrayVal);
                        array_push($this->items,$file);
                    }
                }else{
                    $this->$key = $val;
                }
            }
        }
    }

    public function getItems() {
        return $this->items;
    }

    public function setItems($items) {
        $this->items = $items;
    }

    public function getTotalItems() {
        return $this->totalItems;
    }

    public function setTotalItems($totalItems) {
        $this->totalItems = $totalItems;
    }

    public function getPage() {
        return $this->page;
    }

    public function setPage($page) {
        $this->page = $page;
    }
    
    public function exists() {		
		return $this->totalItems > 0;
	}


}
