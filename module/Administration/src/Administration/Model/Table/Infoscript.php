<?php

namespace Administration\Model\Table;

use Zend\Db\Sql\Select;

use Administration\Model\ITable;
use Administration\Model\Table\AbstractTable;

class Infoscript extends AbstractTable implements ITable {

    const ID_KEY = 'id';
    
    protected $urlTable;
    
    public function getUrlTable() {
        return $this->urlTable;
    }

    public function setUrlTable(UrlTable $urlTable) {
        $this->urlTable = $urlTable;
        return $this;
    }
    

    protected function getColumns(\Zend\Db\Sql\Select $select) {

        $columns = array(
            'id'     => 'id',
            'userId' => 'fk_user_id',
            'urlId'  => 'fk_url_id'
        );

        return $select->columns($columns);

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
