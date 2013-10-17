<?php

namespace Company\Model\Entity;

use Company\Model\IEntity;
use Company\Model\Entity\IUrl;

class Url implements IEntity {

    const TRUE = 1;
    const FALSE = 0;
    const DATEFORMAT = 'Y-m-d';

    protected $id;
    protected $url;
    protected $start;
    protected $ende;
    protected $aktiv;

    protected $dependentEntity;

    public function __construct() {

    }

    public function getId() {
        return $this-> id;
    }

    public function setId($id) {

        assert(is_numeric($id));

        $this->id = (int) $id;

        return $this;
    }

    public function getUrl(){
        return $this->url;
    }

    public function setUrl($url) {
        $this->url = $url;
        return $this;
    }

    public function getStart() {
        return $this->start;
    }

    public function setStart($start) {

        $this->start = \DateTime::createFromFormat(self::DATEFORMAT, $start)->format(self::DATEFORMAT);
        return $this;
    }

    public function getEnde() {
        return $this->ende;
    }

    public function setEnde($ende) {

        $this->ende = \DateTime::createFromFormat(self::DATEFORMAT, $ende)->format(self::DATEFORMAT);
        return $this;
    }

    public function getAktiv() {
        return $this->aktiv;
    }

    public function setAktiv($aktiv) {

        assert(in_array($aktiv, array(self::TRUE, self::FALSE)), "Aktivität darf nur die Werte 0 oder 1 annehmen, hat aber den Wert $aktiv");

        $this->aktiv = $aktiv;
        return $this;
    }


    public function getDependentEntity() {
        return $this->dependentEntity;
}

    public function setDependentEntity(IUrl $dependentEntity) {

        $this->dependentEntity = $dependentEntity;


        $this->setUrlIdForDependentEntity();

        return $this;
}

    private function setUrlIdForDependentEntity(){

        is_null($this->getId()) ? : $this->getDependentEntity()->setUrlId($this->getId());
    }


}

?>
