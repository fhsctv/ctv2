<?php

namespace Company\Service\Factory\TableGateway;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\HydratingResultSet;

use Company\Model\Mapper\User as Hydrator;
use Company\Model\Entity\User as Entity;

class User extends AbstractFactory {

    const TABLE    = 'user';
    const ID       = 'user_id';
    const SEQUENCE = 'user_user_id_seq';


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
