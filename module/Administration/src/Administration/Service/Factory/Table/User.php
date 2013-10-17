<?php

namespace Administration\Service\Factory\Table;

use Administration\Model\Table\User as Table;

class User implements \Zend\ServiceManager\FactoryInterface {

    const GATEWAY = 'Administration\TableGateway\User';

    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {
        $table = new Table();
        $table->setTableGateway($serviceLocator->get(self::GATEWAY));

        return $table;
    }

}


?>
