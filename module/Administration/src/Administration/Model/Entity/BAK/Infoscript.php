<?php


namespace Administration\Model\Entity;

use Administration\Model\IEntity;

class Infoscript implements IEntity, IUrl {

    protected $id;
    protected $userId;

    protected $user;    //Aggregation
    protected $url;     //Komposition

    public function __construct() {
        $this->setUrl(new Url());
    }

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

        assert(!is_null($this->getUrl()), "Url im Infoscript ist nicht gesetzt!");

        $this->getUrl()->getId();

    }

    public function setUrlId($urlId) {

        assert(is_numeric($urlId), "\$urlId muss ein Integer oder numerischer String sein!");
        assert(!is_null($this->getUrl()), "Url im Infoscript ist nicht gesetzt!");

        $this->getUrl()->setId((int) $urlId);
        return $this;
    }

    public function getUser() {

        if(is_null($this->user)){
            $this->setUser(new User());
        }

        return $this->user;
    }

    public function setUser(User $user) {
        $this->user = $user;
        return $this;
    }

    public function getUrl() {

        assert(!is_null($this->url), "Url im Infoscript ist nicht gesetzt!");

        return $this->url;
    }

    public function setUrl(Url $url) {

        $this->url = $url;
        return $this;
    }

}

?>
