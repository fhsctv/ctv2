<?php

namespace Company\Service\Factory\Table;

use Company\Model\Table\Url as Table;

class Url implements \Zend\ServiceManager\FactoryInterface {

    const GATEWAY = 'Company\TableGateway\Url';

    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {
        $table = new Table();
        $table->setTableGateway($serviceLocator->get(self::GATEWAY));

        return $table;
    }

}


?>
