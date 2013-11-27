<?php

namespace Administration\Controller;

use Zend\View\Model\ViewModel;

use Base\Constants as C;

class UserController extends AbstractController {

    public function indexAction() {
        
        $userMapper  = $this->getServiceLocator()->get(C::SM_MAPPER_FACHHOCHSCHULE);
        
        
        return ['users' => $userMapper->fetchAll()->buffer()];
        
    }



}
