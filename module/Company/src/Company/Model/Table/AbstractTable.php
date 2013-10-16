<?php

namespace Company\Model\Table;

use Zend\Db\Sql\Select;

use Company\Model;

abstract class AbstractTable implements Model\ITable {


    protected $tableGateway;

    public function getTableGateway() {
        return $this->tableGateway;
    }

    public function setTableGateway($tableGateway) {
        $this->tableGateway = $tableGateway;
        return $this;
    }

    public function getHydrator() {
        return $this->getTableGateway()->getResultSetPrototype()->getHydrator();
    }


    /**
     * {@inheritDoc}
     */
    public function fetchAll() {

        return $this->getTableGateway()->select(
            function(Select $select) {
                $select =  $this->getColumns($select);
                return $this->getJoin($select);
            }
        );
    }

    /**
     * {@inheritDoc}
     */
    public function get($id) {

        $idKey = $this->getIdKey();

        $rowset = $this->getTableGateway()->select(
            function(Select $select) use ($id, $idKey) {
                $select = $this->getColumns($this->getJoin($select));
                $select->where($this->tableGateway->getTable() . "." . $idKey . '=' . (int) $id);
            }
        );

        $row = $rowset->current();

        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    /**
     * {@inheritDoc}
     */
    public function save(Model\IEntity $entity){

        $id = (int) $entity->getId();

        if ($id == 0) {
            $this->getTableGateway()->insert($this->getHydrator()->extract($entity));

            return $this->getTableGateway()->getLastInsertValue();
        }

        if ($this->get($id)) {
            $this->getTableGateway()->update($this->getHydrator()->extract($entity), array($this->getIdKey() => $id));
            return $id;
        }

        throw new \Exception('Form id does not exist');

    }

    /**
     * {@inheritDoc}
     */
    public function delete($id){

        assert(is_numeric($id));

        return $this->getTableGateway()->delete(array($this->getIdKey() => $id));
    }




    protected abstract function getColumns(Select $select);
    protected abstract function getJoin(Select $select);


    protected abstract function getIdKey();
}

?>
