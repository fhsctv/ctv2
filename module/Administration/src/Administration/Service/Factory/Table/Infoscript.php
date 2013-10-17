<?php

namespace Administration\Service\Factory\Table;

use Administration\Model\Table\Infoscript as Table;

class Infoscript implements \Zend\ServiceManager\FactoryInterface {

    const GATEWAY = 'Administration\TableGateway\Infoscript';

    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {
        $table = new Table();
        $table->setTableGateway($serviceLocator->get(self::GATEWAY));

        return $table;
    }

}


?>
