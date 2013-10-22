<?php

namespace Administration\Service\Factory\Service;

use Zend\ServiceManager\FactoryInterface;

use Administration\Service\Infoscript as Service;


class Infoscript implements FactoryInterface {
    
    
    const TABLE = 'Administration\Table\Infoscript';
    
    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {
        
        $service = new Service();
        $service->setTable($serviceLocator->get(self::TABLE));

        return $service;
    }
    
}
