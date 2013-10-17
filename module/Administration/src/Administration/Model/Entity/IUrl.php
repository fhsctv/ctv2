<?php

namespace Administration\Model\Entity;

/**
 * Das ist ein Interface für alle Entitäten, welche eine Abhängigkeit zur Url-
 * Entität besitzen.
 */
interface IUrl {

    public function getUrlId();
    public function setUrlId($id);

}

?>
