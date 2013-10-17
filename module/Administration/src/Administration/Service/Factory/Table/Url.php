<?php

namespace Administration\Service\Factory\Table;

use Administration\Model\Table\Url as Table;

class Url implements \Zend\ServiceManager\FactoryInterface {

    const GATEWAY = 'Administration\TableGateway\Url';

    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {
        $table = new Table();
        $table->setTableGateway($serviceLocator->get(self::GATEWAY));

        return $table;
    }

}


?>
