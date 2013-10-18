<?php

namespace Administration\Model\Mapper;


/**
 * Diese Klasse ändert das Standardverhalten des Zend- Hydrators \Zend\Stdlib\Hydrator\ClassMethods
 * Beim extrahieren, werden Werte, die null oder leere Strings sind, entfernt.
 * Dadurch soll verhindert werden, dass diese beim Einfügen der Daten in die Datenbank geschrieben werden.
 */
class ClassMethods extends \Zend\Stdlib\Hydrator\ClassMethods {

    protected $filterCallback;
    
    public function __construct() {
        parent::__construct();
        
        $this->filterCallback = function(&$value){
            return !(($value === null) || ($value === '')); //Werte dürfen nicht null oder leerer String sein
        };
    }


    public function extract($object) {

        return array_filter(parent::extract($object), $this->filterCallback);

    }
    
    public function hydrate(array $data, $object) {
        
        $emptyFilteredData = array_filter($data, $this->filterCallback);
        
        return parent::hydrate($emptyFilteredData, $object);
    }

}