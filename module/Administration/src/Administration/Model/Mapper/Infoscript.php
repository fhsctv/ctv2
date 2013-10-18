<?php

namespace Administration\Model\Mapper;

//use Zend\Stdlib\Hydrator\Filter;
use Administration\Model\Entity\Url as UrlEntity;

class Infoscript extends ClassMethods {

    protected $urlMapper;


    public function hydrate(array $data, $object) {

//        var_dump(__METHOD__, $data);
        
        $object->setId($data['id']);
        $object->setUserId($data['userId']);
        $object->setUrlId($data['urlId']);
        $object->setUrl($this->getUrlMapper()->hydrate($data, new UrlEntity()));

        return $object;
    }

    public function extract($object) {

        var_dump(__METHOD__, $object);


        return parent::extract($object);
    }

    public function getUrlMapper() {

        if (empty($this->urlMapper)) {
            $this->setUrlMapper(new Url());
        }

        return $this->urlMapper;
    }

    public function setUrlMapper($urlMapper) {
        $this->urlMapper = $urlMapper;
        return $this;
    }

}
