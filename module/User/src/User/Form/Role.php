<?php

namespace User\Form;

use Zend\Form;

class Role extends Form\Form {
    
    /**
     * Auswahl der Benutzerrolle bei der Registrierung
     * @var \Zend\Form\Element\Radio
     */
    protected $choice;
    
    /**
     * Auswahl senden
     * @var \Zend\Form\Element\Submit
     */
    protected $submit;
    
    public function __construct() {
        
        parent::__construct('Rolle');
        
        $this->add($this->getChoice());
        $this->add($this->getSubmit());
    }
    
    public function getChoice() {
        
        if(!$this->choice) {
            
            $choice = new Form\Element\Radio('rolle');
            $choice->setLabel('Ihre Rolle');
            $choice->setValueOptions([
                'unternehmen' => 'Unternehmen', 
                'student' => 'Student der FH Schmalkalden', #
                'fachhochschule' => 'Organisation der FH Schmalkalden', 
            ]);
            
            $this->setChoice($choice);
        }
        
        return $this->choice;
    }

    public function setChoice($choice) {
        $this->choice = $choice;
        return $this;
    }

    public function getSubmit() {
        
        if(!$this->submit) {
            
            $submit = new Form\Element\Submit('submit');
            $submit->setValue('Weiter');
            
            $this->setSubmit($submit);
        }
        
        return $this->submit;
    }

    public function setSubmit($submit) {
        $this->submit = $submit;
        return $this;
    }
    
}
