<?php

namespace Base\Service\Iterator\Filter\Url;

class Current extends \FilterIterator {

    public function accept() {

        $value = $this->current();

        assert($value instanceof \Base\Model\Entity\Inserat);

        $today = date('Y-m-d');

        return (($value->getStart() <= $today) && ($value->getEnde() >= $today));

    }

}
