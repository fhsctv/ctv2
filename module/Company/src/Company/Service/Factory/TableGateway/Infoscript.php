<?php

namespace Company\Service\Factory\TableGateway;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\HydratingResultSet;

use Company\Model\Mapper\Infoscript as Hydrator;
use Company\Model\Entity\Infoscript as Entity;

class Infoscript extends AbstractFactory {

    const ADAPTER  = 'Zend\Db\Adapter\Adapter';
    const TABLE    = 'infoscript';
    const ID       = 'id';
    const SEQUENCE = 'infoscript_id_seq';


    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {

        parent::createService($serviceLocator);

        $this->setHydrator(new Hydrator());
        $this->setEntity(new Entity);
        $this->setResultSetPrototype(new HydratingResultSet($this->getHydrator(), $this->getEntity()));

        return new TableGateway(
                $this->getTable(),
                $this->getAdapter(),
                $this->getFeature(),
                $this->getResultSetPrototype()
        );
    }

    protected function getIdName() {
        return self::ID;
    }

    protected function getSequenceName() {
        return self::SEQUENCE;
    }

    protected function getTableName() {
        return self::TABLE;
    }

}


?>
