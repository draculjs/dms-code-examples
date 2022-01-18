<?php

class FilePaginateDTO {

    public array $items;
    public int $totalItems;
    public int $page;

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
