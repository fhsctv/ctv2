<?php

namespace Administration\Model\Entity;

class Infoscript implements IUrl {
    
    protected $id;
    protected $userId;
    protected $urlId;




    protected $url;
    
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }
    
    public function getUserId() {
        return $this->userId;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
        return $this;
    }
    
    public function getUrlId() {
        return $this->urlId;
    }

    public function setUrlId($urlId) {
        $this->urlId = $urlId;
        return $this;
    }

        
    public function getUrl() {
        
        if(empty($this->url)) {
            $this->setUrl(new Url());
        }
        
        return $this->url;
    }

    public function setUrl(Url $url) {
        $this->url = $url;
        return $this;
    }


}

