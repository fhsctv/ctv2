<?php

namespace Administration\Model\Table;

use Zend\Db\Sql\Select;

use Administration\Constants as C;

use Administration\Model\IEntity;
use Administration\Model\ITable;
use Administration\Model\Table\AbstractTable;
use Administration\Model\Table\Url as UrlTable;

class Infoscript extends AbstractTable implements ITable {

    const ID_KEY = 'id';
    
    protected $urlTable;
    
    
    public function save(IEntity $infoscript){
        
        $urlId = null;
        
//        $connection = $this->getTableGateway()->getAdapter()->getDriver()->getConnection(); //funktioniert derzeit nicht
        
        try {
            
//            $connection->beginTransaction();  //funktioniert derzeit nicht
            
            $urlId = $this->getUrlTable()->save($infoscript->getUrl());

            $infoscript->setUrlId($urlId);
        
//        var_dump(__METHOD__ , $infoscript);
            
//            $connection->commit();  //funktioniert derzeit nicht
            return parent::save($infoscript);
            
            
        } catch (\Exception $ex) {

//            $connection->rollback();  //funktioniert derzeit nicht
            
            //alternative: manuell löschen
            $this->getUrlTable()->delete($urlId);
            
            throw $ex;
        }
        
    }
    
    
    
    
    
    public function getUrlTable() {
        return $this->urlTable;
    }

    public function setUrlTable(UrlTable $urlTable) {
        $this->urlTable = $urlTable;
        return $this;
    }
    

    protected function getColumns(\Zend\Db\Sql\Select $select) {

        $columns = array(
            C::INFO_TBLCOL_ID => C::INFO_TBLCOL_ID,
            C::INFO_TBLCOL_USERID => C::INFO_TBLCOL_USERID,
            C::INFO_TBLCOL_URLID => C::INFO_TBLCOL_URLID,
        );

        return $select->columns($columns);

    }

    protected function getJoin(Select $select) {

        $infTable = $this->getTableGateway()->getTable();

        $urlTable = $this->getUrlTable()->getTableGateway()->getTable();
        $urlId = "$urlTable . id";

        $condition = $infTable . '.' . C::INFO_TBLCOL_URLID . '=' . $urlId;


        return $select->join($urlTable,$condition,Select::SQL_STAR);
        
    }

    protected function getIdKey() {
        return self::ID_KEY;
    }

}
