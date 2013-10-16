<?php

namespace Company\Model\Table;

use Company\Model\ITable;
use Company\Model\Table\AbstractTable;

class User extends AbstractTable implements ITable {

    protected function getColumns(\Zend\Db\Sql\Select $select) {
        return $select;
    }

    protected function getJoin(\Zend\Db\Sql\Select $select) {
        return $select;
    }

    protected function getIdKey() {
        return 'user_id';
    }

}


?>
