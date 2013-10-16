<?php

namespace Company\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

abstract class AbstractController extends AbstractActionController {

    public function disableLayout(ViewModel $viewModel){
        return $viewModel->setTerminal(true);
    }
}

?>
