<?php

namespace Administration\Service\Iterator\Filter\Infoscript;

class Current extends \FilterIterator {

    public function accept() {

        $value = $this->current();

        assert(is_a($value, '\Administration\Model\Entity\Infoscript'));

        $today = date('Y-m-d');

        return (($value->getUrl()->getStart() <= $today) && ($value->getUrl()->getEnde() >= $today));

    }

}



?>
