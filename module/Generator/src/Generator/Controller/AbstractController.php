<?php

namespace Generator\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

abstract class AbstractController extends AbstractActionController {

    public function disableLayout(ViewModel $viewModel){
        return $viewModel->setTerminal(true);
    }
    
    public function simpleRedirectRoute($route, $controller = null, $action = null) {
        
        return parent::redirect()
                ->toRoute($route, array('controller' => $controller
                                       , 'action' => $action
                                  )
                );
        
    }
    
    public function dataReceived(){
        
        return $this->getRequest()->isPost();
    }
    
    public function getService($name){
        
        return $this->getServiceLocator()->get($name);
    }
}