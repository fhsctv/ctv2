<?php

namespace Company\Model\Entity\Exception;

class InfoscriptUrlIdMismachException extends \Exception {

    public function __construct($infoscriptId, $urlId) {

        $message = 'Die $urlId des Infoscripts und die $id der Url müssen gleich sein'
                    . "\n" . "Das heißt: Die Url mit der id "  .  $urlId
                    . " gehört nicht zum Infoscript mit der id " . $infoscriptId
                ;


        parent::__construct($message);
    }

}


?>
