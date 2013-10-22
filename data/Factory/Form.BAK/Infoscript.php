<?php

namespace Administration\Service\Factory\Form;

use Zend\ServiceManager\FactoryInterface;

use Administration\Form\Form\Infoscript as Form;
use Administration\Model\Entity\Infoscript as Entity;

class Form implements FactoryInterface {

    protected $form;

    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {

        $this->initForm();

        $this->getForm()->bind(new Entity());

        return $this; //liefert die Factory, nicht das Formular

    }

    public function getForm() {
        return $this->form;
    }

    public function setForm($form) {
        $this->form = $form;
        return $this;
    }

    public function initForm() {

        return $this->setForm(new Form());

    }




}

?>
