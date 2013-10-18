<?php

namespace Administration\Service\Factory\Table;

use Administration\Model\Table\Anzeige as Table;

class Anzeige implements \Zend\ServiceManager\FactoryInterface {

    const GATEWAY = 'Administration\TableGateway\Anzeige';

    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {
        $table = new Table();
        $table->setTableGateway($serviceLocator->get(self::GATEWAY));

        return $table;
    }

}


?>
