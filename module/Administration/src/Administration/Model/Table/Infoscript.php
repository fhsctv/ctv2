<?php

namespace Administration\Model\Table;

use Zend\Db\Sql\Select;

use Administration\Model\ITable;
use Administration\Model\Table\AbstractTable;

class Infoscript extends AbstractTable implements ITable {

    const ID_KEY = 'id';

    protected function getColumns(\Zend\Db\Sql\Select $select) {
        return $select;
    }

    protected function getJoin(Select $select) {

        $infTable = $this->getTableGateway()->getTable();
        $fk_url_id = 'fk_url_id';

        $urlTable = 'url';
        $urlId = "$urlTable . id";

        $condition = "$infTable . $fk_url_id". '=' . $urlId;


        return $select->join($urlTable,$condition,Select::SQL_STAR);
    }

    protected function getIdKey() {
        return self::ID_KEY;
    }

}


?>
