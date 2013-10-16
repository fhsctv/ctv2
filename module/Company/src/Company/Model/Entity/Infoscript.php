<?php


namespace Company\Model\Entity;

class Infoscript implements \Company\Model\IEntity, UrlInterface {

    protected $id;
    protected $userId;
    protected $urlId;

    public function getId() {

        return $this->id;
    }

    public function setId($id) {

        assert(is_numeric($id));

        $this->id = (int) $id;
        return $this;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function setUserId($userId) {

        assert(is_numeric($userId));

        $this->userId = (int) $userId;
        return $this;
    }

    public function getUrlId() {

        return is_null($this->getUrl()) ? null : $this->getUrl()->getId();

    }

    public function setUrlId($urlId) {

        assert(is_numeric($urlId));

        $this->urlId = (int) $urlId;
        return $this;
    }

}

?>
