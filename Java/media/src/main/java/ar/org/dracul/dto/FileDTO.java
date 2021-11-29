package ar.org.dracul.dto;

import java.time.LocalDateTime;
import java.util.List;

public class FileDTO {

    private CreatedByDTO createdBy;
    private List<String> tags;
    private String _id;
    private String filename;
    private String mimetype;
    private String type;
    private String extension;
    private String relativePath;
    private String absolutePath;
    private Float size;
    private String url;
    private LocalDateTime lastAccess;
    private LocalDateTime createdAt;
    private LocalDateTime deletedAt;
    private Integer __v;

    public CreatedByDTO getCreatedBy() {
        return createdBy;
    }

    public void setCreatedBy(CreatedByDTO createdBy) {
        this.createdBy = createdBy;
    }

    public List<String> getTags() {
        return tags;
    }

    public void setTags(List<String> tags) {
        this.tags = tags;
    }

    public String get_id() {
        return _id;
    }

    public void set_id(String _id) {
        this._id = _id;
    }

    public String getFilename() {
        return filename;
    }

    public void setFilename(String filename) {
        this.filename = filename;
    }

    public String getMimetype() {
        return mimetype;
    }

    public void setMimetype(String mimetype) {
        this.mimetype = mimetype;
    }

    public String getType() {
        return type;
    }

    public void setType(String type) {
        this.type = type;
    }

    public String getExtension() {
        return extension;
    }

    public void setExtension(String extension) {
        this.extension = extension;
    }

    public String getRelativePath() {
        return relativePath;
    }

    public void setRelativePath(String relativePath) {
        this.relativePath = relativePath;
    }

    public String getAbsolutePath() {
        return absolutePath;
    }

    public void setAbsolutePath(String absolutePath) {
        this.absolutePath = absolutePath;
    }

    public Float getSize() {
        return size;
    }

    public void setSize(Float size) {
        this.size = size;
    }

    public String getUrl() {
        return url;
    }

    public void setUrl(String url) {
        this.url = url;
    }

    public LocalDateTime getLastAccess() {
        return lastAccess;
    }

    public void setLastAccess(LocalDateTime lastAccess) {
        this.lastAccess = lastAccess;
    }

    public LocalDateTime getCreatedAt() {
        return createdAt;
    }

    public void setCreatedAt(LocalDateTime createdAt) {
        this.createdAt = createdAt;
    }

    public Integer getV() {
        return __v;
    }

    public void setV(Integer __v) {
        this.__v = __v;
    }

    public LocalDateTime getDeletedAt() {
        return deletedAt;
    }

    public void setDeletedAt(LocalDateTime deletedAt) {
        this.deletedAt = deletedAt;
    }

	public Boolean exists() {		
		return this.get_id() != null;
	}

}
