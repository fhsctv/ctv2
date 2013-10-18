<?php

use Zend\Form\Form;

namespace Administration\Form\Form;

use Zend\Form\Form;
use Zend\Form\ElementInterface;
use Zend\Form\Element;

use Administration\Form\Fieldset;

class Infoscript extends Form {
    
    //fieldset
    protected $infoscript;
    
    protected $submit;
    
    public function __construct() {
        
        parent::__construct();

        $this->setAttribute('method', 'post');
        $this->setAttribute('action', '/administration/infoscript/create');
        
        $this->add($this->getInfoscript());
        
        $this->add($this->getSubmit());        

    }
    
    
    public function getInfoscript() {
        
        if(empty($this->infoscript)){
            
            $infoscript = new Fieldset\Infoscript();
            $infoscript->setUseAsBaseFieldset(true);
            
            $this->setInfoscript($infoscript);
        }
        
        return $this->infoscript;
    }
    
    public function setInfoscript(ElementInterface $infoscript) {
        $this->infoscript = $infoscript;
        return $this;
    }
    
    public function getSubmit() {
        
        if(empty($this->submit)){
            
            $submit = new Element\Submit('submit');
            $submit->setValue('speichern');
            
            $this->setSubmit($submit);
            
        }
        
        return $this->submit;
    }

    public function setSubmit(ElementInterface $submit) {
        $this->submit = $submit;
        return $this;
    }



}
