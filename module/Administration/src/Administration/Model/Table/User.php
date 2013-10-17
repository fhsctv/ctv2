<?php

namespace Administration\Model\Table;

use Administration\Model\ITable;
use Administration\Model\Table\AbstractTable;

class User extends AbstractTable implements ITable {

    const ID_KEY = 'user_id';

    protected function getColumns(\Zend\Db\Sql\Select $select) {
        return $select;
    }

    protected function getJoin(\Zend\Db\Sql\Select $select) {
        return $select;
    }

    protected function getIdKey() {
        return self::ID_KEY;
    }

}


?>
