<?php

namespace Administration\Model\Mapper;


/**
 * Diese Klasse ändert das Standardverhalten des Zend- Hydrators \Zend\Stdlib\Hydrator\ClassMethods
 * Beim extrahieren, werden Werte, die null oder leere Strings sind, entfernt.
 * Dadurch soll verhindert werden, dass diese beim Einfügen der Daten in die Datenbank geschrieben werden.
 */
class ClassMethods extends \Zend\Stdlib\Hydrator\ClassMethods {

    public function extract($object) {

        $emptyFilter = function(&$value){
            return !(($value === null) || ($value === '')); //Werte dürfen nicht null oder leerer String sein
        };

        return array_filter(parent::extract($object), $emptyFilter);

    }

}

?>
