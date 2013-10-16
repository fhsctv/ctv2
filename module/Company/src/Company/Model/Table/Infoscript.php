<?php

namespace Company\Model\Table;

use Company\Model\ITable;
use Company\Model\Table\AbstractTable;

class Infoscript extends AbstractTable implements ITable {

    const ID_KEY = 'id';

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
