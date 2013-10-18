<?php

namespace Administration\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\Form\ElementInterface;
use Zend\Form\Element;

use Administration\Model\Mapper\ClassMethods as Hydrator;
use Administration\Model\Entity\Infoscript   as Entity;

class Infoscript extends Fieldset {
    
    protected $id;
    protected $userId;
    protected $urlId;


    protected $url;


    public function __construct() {
        parent::__construct('infoscript');
        
        $this->setHydrator(new Hydrator());
        $this->setObject(new Entity());
        
        $this->add($this->getId());
        $this->add($this->getUserId());
        $this->add($this->getUrlId());
        $this->add($this->getUrl());
    }
    
    
    
    
    
    public function getId() {
        
        if(empty($this->id)){
            
            $id = new Element\Text('id');
            $id->setLabel('Infoscript Id: ');
            
            $this->setId($id);
        }
        
        return $this->id;
    }

    public function setId(ElementInterface $id) {
        $this->id = $id;
        return $this;
    }
    
    public function getUserId() {
        
        if(empty($this->userId)){
            
            $userId = new Element\Text('userId');
            $userId->setLabel('Benutzer Id: ');
            
            $this->setUserId($userId);
        }
        
        return $this->userId;
    }

    public function setUserId(ElementInterface $userId) {
        $this->userId = $userId;
        return $this;
    }
    
    public function getUrlId() {
        
        if(empty($this->urlId)){
            
            $urlId = new Element\Text('urlId');
            $urlId->setLabel('Url Id: ');
            
            $this->setUrlId($urlId);
        }
        
        return $this->urlId;
        
    }

    public function setUrlId($urlId) {
        $this->urlId = $urlId;
        return $this;
    }
    
    public function getUrl() {
        
        if(empty($this->url)){
            
            $url = new Url();
            
            $this->setUrl($url);
            
        }
        
        return $this->url;
    }

    public function setUrl($url) {
        $this->url = $url;
        return $this;
    }

    


    
}