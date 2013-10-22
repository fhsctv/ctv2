<?php

namespace Administration\Service;

use Administration\Model\Entity;
use Administration\Form\Form;
use Administration\Model\Table;

class Infoscript {
    
    protected $table;
    
    public function createInfoscriptFromForm(\Base\Form\Infoscript $form, \Zend\Http\PhpEnvironment\Request $request) {
        
        if(!$request->isPost()){
            return false;
        }
        
        $form->setData($request->getPost());
        
        if(!$form->isValid()){
            assert($form->isValid(), "Eingetragene Daten ungültig");
            return false;
        }
        
        $infoscript = $form->getData();
        $infoscript->getUrl()->setDependant($infoscript);
        
        return $infoscript;
    }
    
    public function save(Entity\Infoscript $infoscript) {
        
        
        $iTable = $this->getTable();
        $iTable->save($infoscript);
        
        return true;
        
    }
    
    
    
    public function getTable() {
        return $this->table;
    }

    public function setTable(Table\Infoscript $table) {
        $this->table = $table;
        return $this;
    }


    
}

