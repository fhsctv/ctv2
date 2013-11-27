<?php

namespace Base\Form\Hydrator;

use Zend\Stdlib\Hydrator\HydratorInterface;

use Base\Constants as C;

class Infoscript extends Inserat {
    
    public function extract($object) {
        
        $filter = function($value){
            return !$this->isEmpty($value);
        };
        
        $result = parent::extract($object);
        
        $result = array_filter($result, $filter);
        
//        var_dump(__METHOD__, 'EXT_OBJ', $object, 'EXT_RES', $result);
        return $result;
    }
    
    public function hydrate(array $data, $object) {
        
        $object = parent::hydrate($data, $object);
//        var_dump(__METHOD__, 'HYD_SRCDATA', $data, 'HYD_RES', $object);
        return $object;
    }
    
    private function isEmpty($value){
        
        return (($value === null) || ($value === ''));
        
    }
    
}