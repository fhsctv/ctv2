<?php

namespace Administration\Model\Mapper;


/**
 * Diese Klasse ändert das Standardverhalten des Zend- Hydrators \Zend\Stdlib\Hydrator\ClassMethods
 * Beim extrahieren, werden leere oder nicht gesetzte Werte entfernt.
 * Dadurch soll verhindert werden, dass beim Einfügen der Daten in die Datenbank, null- Werte eingefügt werden.
 */
class Infoscript implements \Zend\Stdlib\Hydrator\HydratorInterface {

    protected $urlMapper;

    public function __construct() {
        $this->setUrlMapper(new \Administration\Model\Mapper\Url());
    }

    public function hydrate(array $data, $object) {

        $url = $this->getUrlMapper()->hydrate($data, new \Administration\Model\Entity\Url());


        assert(is_a($object, 'Administration\Model\Entity\Infoscript'));


        $this->exclude($this->getValue($data, 'id'))         ? : $object->setId($data['id']);
        $this->exclude($this->getValue($data, 'fk_user_id')) ? : $object->setUserId($data['fk_user_id']);
        $this->exclude($this->getValue($data, 'fk_url_id'))  ? : $object->setUrlId($data['fk_url_id']);

        $url->setDependentEntity($object);
        $object->setUrl($url);

//        var_dump("...", $data, $object, "...");
        return $object;
    }

    public function extract($object) {

        assert(is_a($object, 'Administration\Model\Entity\Infoscript'));

//        var_dump("...", $object, "...");

        $result = array();

        $this->exclude($object->getId())     ? : ($result['id']         = $object->getId());
        $this->exclude($object->getUserId()) ? : ($result['fk_user_id'] = $object->getUserId());
        $this->exclude($object->getUrlId())  ? : ($result['fk_url_id']  = $object->getUrlId());

        return $result;

    }


    /**
     * exclude prüft, ob ein Wert NULL ist, oder einen leeren String enthält.
     * Diese Methode wird dafür verwendet, um solche Werte beim hydrieren und extrahieren
     * auszuschließen.
     * Damit wird verhindert dass solche Werte beim Speichern an die Datenbank gesendet werden.
     * @param mixed $value Wert, der auf NULL- Wert oder leeren String geprüft wird.
     * @return boolean
     */
    private function exclude($value){
        return (($value === null) || ($value === ''));
    }

    /**
     * getValue prüft, ob ein Wert in einem array existiert und gibt diesen zurück, ansonsten null
     * @param array $data
     * @param string $key
     * @return mixed | null
     */
    private function getValue(array $data, $key){

        assert(is_string($key), __METHOD__ . '$key muss ein String sein');

        return isset($data[$key]) ? $data[$key] : null;

    }


    public function getUrlMapper() {
        return $this->urlMapper;
    }

    public function setUrlMapper($urlMapper) {
        $this->urlMapper = $urlMapper;
        return $this;
    }


}

?>
