package ar.org.dracul.dto;

import java.util.List;

public class FilePaginateDTO {

    private List<FileDTO> items;
    private Integer totalItems;
    private Integer page;

    public List<FileDTO> getItems() {
        return items;
    }

    public void setItems(List<FileDTO> items) {
        this.items = items;
    }

    public Integer getTotalItems() {
        return totalItems;
    }

    public void setTotalItems(Integer totalItems) {
        this.totalItems = totalItems;
    }

    public Integer getPage() {
        return page;
    }

    public void setPage(Integer page) {
        this.page = page;
    }
    
    public Boolean exists() {		
		return this.totalItems > 0;
	}


}
