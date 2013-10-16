<?php

namespace Company\Service\Factory\Table;

use Company\Model\Table\User as Table;

class User implements \Zend\ServiceManager\FactoryInterface {

    const GATEWAY = 'Company\TableGateway\User';

    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {
        $table = new Table();
        $table->setTableGateway($serviceLocator->get(self::GATEWAY));

        return $table;
    }

}


?>
