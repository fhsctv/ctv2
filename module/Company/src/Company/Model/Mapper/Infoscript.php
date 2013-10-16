<?php

namespace Company\Model\Mapper;


/**
 * Diese Klasse ändert das Standardverhalten des Zend- Hydrators \Zend\Stdlib\Hydrator\ClassMethods
 * Beim extrahieren, werden leere oder nicht gesetzte Werte entfernt.
 * Dadurch soll verhindert werden, dass beim Einfügen der Daten in die Datenbank, null- Werte eingefügt werden.
 */
class Infoscript extends ClassMethods {

    public function hydrate(array $data, $object) {

        parent::hydrate($data, $object);

        //setze UserId und UrlId, wenn vorhanden
        //ClassMethods kann dies deshalb nicht selbst machen,
        //weil sich die Bezeichnungen für die Id's in der Datenbank
        //und in der Anwendung unterscheiden
        empty($data['fk_user_id']) ? : $object->setUserId($data['fk_user_id']);
        empty($data['fk_url_id'])  ? : $object->setUrlId($data['fk_url_id']);

        return $object;
    }





}

?>
