<?php

namespace Administration\Controller;

use Zend\View\Model\ViewModel;

use Base\Constants as C;

class UserController extends AbstractController {

    public function indexAction() {
        
        $userMapper  = $this->getServiceLocator()->get(C::SM_MAPPER_FACHHOCHSCHULE);
        
        $actionUrls = [
            
            'details'  => $this->url()->fromRoute('administration/default', [ 'controller' => 'User', 'action' => 'details', ]),
        ];
        
        return 
        [
            'users'      => $userMapper->fetchAll()->buffer(),
            'actionUrls' => $actionUrls,
            'messages' => $this->flashMessenger(),
        ];
        
    }

    public function detailsAction() {
        
        $id = $this->params()->fromRoute('id', null);
        
        if(!$id){
            
            $this->flashMessenger()->addErrorMessage('Id fehlt! Bitte nutzen Sie die Schaltflächen in der Anwendung oder benachrichtigen den Administrator!');
            return $this->redirect()->toRoute('administration/default', ['controller' => 'User', 'action' => 'index']);
        }
        
        $user = $this->getServiceLocator()->get(C::SM_TABLE_USER)->getById($id);
        $info = $this->getServiceLocator()->get(C::SERVICE_INFOSCRIPT)->getByUserId($id);
        
        $actionUrls = 
        [
            'delete'  => $this->url()->fromRoute('administration/default', ['controller' => 'infoscript', 'action' => 'delete']),
            'edit'    => $this->url()->fromRoute('administration/default', ['controller' => 'infoscript', 'action' => 'edit']),
            'details' => $this->url()->fromRoute('administration/default', ['controller' => 'infoscript', 'action' => 'details']),
        ];
        
        
        
        $viewModel = new ViewModel(
            [
                'user' => $user,
                'current'    => new \Base\Service\Iterator\Filter\Inserat\Current($info),
                'future'     => new \Base\Service\Iterator\Filter\Inserat\Future($info),
                'outdated'   => new \Base\Service\Iterator\Filter\Inserat\Future($info),
                'inactive'   => new \Base\Service\Iterator\Filter\Inserat\Future($info),
                'actionUrls' => $actionUrls,
            ]
        );
        
        $detailsWidget = $this->forward()->dispatch('Administration/Controller/Infoscript', ['action' => 'show', 'id' => $id]);
        $viewModel->addChild($detailsWidget, 'details');
        
        return $viewModel;
        
        
        
    }


}
