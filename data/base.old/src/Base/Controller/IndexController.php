<?php

namespace Base\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Base\Entity;
use Base\Form;

class IndexController extends AbstractActionController {
    
    public function indexAction(){

        $infoscript = new Entity\Infoscript(new Entity\Url());
        $infoscript->setId(1)->setUrlId(2)->setUserId(3);
        $infoscript->getUrl()->setAdress('http://')->setStart('2013-01-01')
                ->setEnde('2013-02-03')->setAktiv(0);



        $form = new Form\Infoscript($infoscript);
        $form->bind($infoscript);

        $form->setData($this->getRequest()->getPost());



        $form->isValid();

//        $form->getData();

        var_dump('---------------POST---------------' , $this->getRequest()->getPost());

        var_dump('-------------GET-DATA-------------' , $form->getData());
        return new ViewModel(
            array(
                'form' => $form,
            )
        );
    }
}
