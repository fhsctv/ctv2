<?php


namespace Administration\Model\Entity;

use Administration\Model\IEntity;

class Anzeige implements IEntity, IUrl {

    protected $id;
    protected $userId;
    protected $urlId;

    protected $url;



    public function getId() {

        return $this->id;
    }

    public function setId($id) {

        assert(is_numeric($id), "\$id muss ein Integer oder numerischer String sein!");

        $this->id = (int) $id;
        return $this;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function setUserId($userId) {

        assert(is_numeric($userId), "\$userId muss ein Integer oder numerischer String sein!");

        $this->userId = (int) $userId;
        return $this;
    }

    public function getUrlId() {

        return $this->urlId;

    }

    public function setUrlId($urlId) {

        assert(is_numeric($urlId), "\$urlId muss ein Integer oder numerischer String sein!");

        $this->urlId = (int) $urlId;
        return $this;
    }

    public function getUrl() {
        return $this->url;
    }

    public function setUrl(Url $url) {

        if($this->getUrlId() !== $url->getId()){
            throw new Exception\UrlIdMismach($this->getUrlId(), $url->getId()) ;
        }

        $url->setDependentEntity($this);

        $this->url = $url;
        return $this;
    }

}

?>
