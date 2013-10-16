<?php

namespace Company\Model\Mapper;


/**
 * Diese Klasse ändert das Standardverhalten des Zend- Hydrators \Zend\Stdlib\Hydrator\ClassMethods
 * Beim extrahieren, werden leere oder nicht gesetzte Werte entfernt.
 * Dadurch soll verhindert werden, dass beim Einfügen der Daten in die Datenbank, null- Werte eingefügt werden.
 */
class User extends ClassMethods {

    public function hydrate(array $data, $object) {

        parent::hydrate($data, $object);

        //setze UserId, wenn vorhanden
        //ClassMethods kann dies deshalb nicht selbst machen,
        //weil sich die Bezeichnungen für die Id's in der Datenbank (user_id)
        //und in der Anwendung unterscheiden
        empty($data['user_id']) ? : $object->setId($data['user_id']);

        return $object;
    }

}

?>
