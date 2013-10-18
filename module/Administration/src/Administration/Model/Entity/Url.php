<?php

namespace Administration\Model\Entity;

class Url {
    
    //protected $id;
    protected $start;
    protected $ende;
    protected $url;
    protected $aktiv;
    
    
    
    
    
//    public function getId() {
//        return $this->id;
//    }

    public function getStart() {
        return $this->start;
    }

    public function getEnde() {
        return $this->ende;
    }

    public function getUrl() {
        return $this->url;
    }

    public function getAktiv() {
        return $this->aktiv;
    }

//    public function setId($id) {
//        $this->id = $id;
//        return $this;
//    }

    public function setStart($start) {
        $this->start = $start;
        return $this;
    }

    public function setEnde($ende) {
        $this->ende = $ende;
        return $this;
    }

    public function setUrl($url) {
        $this->url = $url;
        return $this;
    }

    public function setAktiv($aktiv) {
        $this->aktiv = $aktiv;
        return $this;
    }
    
}


?>