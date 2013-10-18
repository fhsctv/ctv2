<?php

namespace Administration\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\Form\ElementInterface;
use Zend\Form\Element;

use Administration\Model\Mapper\ClassMethods as Hydrator;
use Administration\Model\Entity\Url          as Entity;

class Url extends Fieldset {
    
    //protected $id;
    protected $start;
    protected $ende;
    protected $url;
    protected $aktiv;

    
    public function __construct() {
        
        parent::__construct('url');
        
        $this->setHydrator(new Hydrator());
        $this->setObject(new Entity());
        
//        $this->add($this->getId());
        $this->add($this->getStart());
        $this->add($this->getEnde());
        $this->add($this->getUrl());
        $this->add($this->getAktiv());
    }
    
    
//    public function getId() {
//        
//        if(empty($this->id)){
//            
//            $id = new Element\Text('id');
//            $id->setLabel('Url Id: ');
//            
//            $this->setId($id);
//        }
//        
//        return $this->id;
//    }

//    public function setId(ElementInterface $id) {
//        $this->id = $id;
//        return $this;
//    }
    
    public function getStart() {
        
        if(empty($this->start)){
            
            $start = new Element\Date('start');
            $start->setLabel('Startdatum: ');
            
            $this->setStart($start);
        }
        
        return $this->start;
    }

    public function getEnde() {
        
        if(empty($this->ende)){
            
            $ende = new Element\Date('ende');
            $ende->setLabel('Enddatum: ');
            
            $this->setEnde($ende);
        }
        
        return $this->ende;
    }

    public function getUrl() {
        
        if(empty($this->url)){
            
            $url = new Element\Text('url');
            $url->setLabel('Url: ');
            
            $this->setUrl($url);
        }
        
        return $this->url;
    }

    public function getAktiv() {
        
        if(empty($this->aktiv)){
            
            $aktiv = new Element\Text('aktiv');
            $aktiv->setLabel('Aktiv: ');
            
            $this->setAktiv($aktiv);
        }
        
        return $this->aktiv;
    }

    

    public function setStart(ElementInterface $start) {
        $this->start = $start;
        return $this;
    }

    public function setEnde(ElementInterface $ende) {
        $this->ende = $ende;
        return $this;
    }

    public function setUrl(ElementInterface $url) {
        $this->url = $url;
        return $this;
    }

    public function setAktiv(ElementInterface $aktiv) {
        $this->aktiv = $aktiv;
        return $this;
    }
    
}

