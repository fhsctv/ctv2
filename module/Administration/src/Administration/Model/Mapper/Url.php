<?php

namespace Administration\Model\Mapper;


/**
 * Diese Klasse ändert das Standardverhalten des Zend- Hydrators \Zend\Stdlib\Hydrator\ClassMethods
 * Beim extrahieren, werden leere oder nicht gesetzte Werte entfernt.
 * Dadurch soll verhindert werden, dass beim Einfügen der Daten in die Datenbank, null- Werte eingefügt werden.
 */
class Url implements \Zend\Stdlib\Hydrator\HydratorInterface {

    public function hydrate(array $data, $object) {

        assert(is_a($object, 'Administration\Model\Entity\Url'), '\$objekt muss eine Url- Entitaet sein, ist aber ' . get_class($object));

//        var_dump("...", $data, $object, "...");

        $this->exclude($this->getValue($data, 'id'))         ? : $object->setId($data['id']);
        $this->exclude($this->getValue($data, 'url'))        ? : $object->setUrl($data['url']);
        $this->exclude($this->getValue($data, 'start'))      ? : $object->setStart($data['start']);
        $this->exclude($this->getValue($data, 'ende'))       ? : $object->setEnde($data['ende']);
        $this->exclude($this->getValue($data, 'aktiv'))      ? : $object->setAktiv($data['aktiv']);

        return $object;
    }

    public function extract($object) {

        assert(is_a($object, 'Administration\Model\Entity\Url'));

//        var_dump("...", $object, "...");

        $result = array();

        $this->exclude($object->getId())     ? : ($result['id']         = $object->getId());
        $this->exclude($object->getUrl())    ? : ($result['url']        = $object->getUrl());
        $this->exclude($object->getStart())  ? : ($result['start']      = $object->getStart());
        $this->exclude($object->getEnde())   ? : ($result['ende']       = $object->getEnde());
        $this->exclude($object->getAktiv())  ? : ($result['aktiv']      = $object->getAktiv());


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


}

?>
