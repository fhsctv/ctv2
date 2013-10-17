<?php

namespace Administration\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

abstract class AbstractController extends AbstractActionController {

    public function disableLayout(ViewModel $viewModel){
        return $viewModel->setTerminal(true);
    }
}

?>
