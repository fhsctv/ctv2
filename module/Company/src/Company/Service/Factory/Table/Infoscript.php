<?php

namespace Company\Service\Factory\Table;

use Company\Model\Table\Infoscript as Table;

class Infoscript implements \Zend\ServiceManager\FactoryInterface {

    const GATEWAY = 'Company\TableGateway\Infoscript';

    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {
        $table = new Table();
        $table->setTableGateway($serviceLocator->get(self::GATEWAY));

        return $table;
    }

}


?>
