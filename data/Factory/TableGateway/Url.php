<?php

namespace Administration\Service\Factory\TableGateway;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\HydratingResultSet;

use Administration\Model\Mapper\Url as Hydrator;
use Administration\Model\Entity\Url as Entity;

class Url extends AbstractFactory {

    const ADAPTER  = 'Zend\Db\Adapter\Adapter';
    const TABLE    = 'url';
    const ID       = 'id';
    const SEQUENCE = 'url_id_seq';


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
