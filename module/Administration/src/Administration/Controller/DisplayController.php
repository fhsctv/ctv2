<?php

namespace Administration\Controller;

use Zend\View\Model\ViewModel;

use Base\Constants as C;

class DisplayController extends AbstractController {

    public function indexAction() {

        $displayTable  = $this->getServiceLocator()->get(C::SM_TBL_BILDSCHIRM);

        $actionUrls = [

            'details'  => $this->url()->fromRoute('administration/default', [ 'controller' => 'display', 'action' => 'details', ]),
            'delete'   => $this->url()->fromRoute('administration/default', [ 'controller' => 'display', 'action' => 'delete', ]),
            'create'   => $this->url()->fromRoute('administration/default', [ 'controller' => 'display', 'action' => 'create', ]),
        ];

        return
        [
            'displays'   => $displayTable->fetchAll()->buffer(),
            'actionUrls' => $actionUrls,
            'messages'   => $this->flashMessenger(),
        ];

    }

    public function detailsAction() {

        throw new \Exception('NOT IMPLEMENTED YET!');


        $id = $this->params()->fromRoute('id', null);

        if(!$id){

            $this->flashMessenger()->addErrorMessage('Id fehlt! Bitte nutzen Sie die Schaltflächen in der Anwendung oder benachrichtigen den Administrator!');
            return $this->redirect()->toRoute('administration/default', ['controller' => 'User', 'action' => 'index']);
        }

        $user = $this->getServiceLocator()->get(C::SM_TBL_USER)->getById($id);
        $info = $this->getServiceLocator()->get(C::SERVICE_INFOSCRIPT)->findByUserId($id);

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

    public function deleteAction() {

        throw new \Exception('NOT IMPLEMENTED YET!');

        $id = $this->params()->fromRoute('id', null);

        if(!$id) {
            $this->flashMessenger()->addErrorMessage('Keine Id angegeben! Bitte verwenden Sie die Schaltflächen in der Anwendung!');
            return $this->redirect()->toRoute('administration/default', ['controller' => 'user', 'action' => 'index']);
        }

        $mapper = $this->getServiceLocator()->get(C::SM_MAP_FACHHOCHSCHULE);
        $fhUser = $mapper->findById($id);

        $form = $this->getServiceLocator()->get(C::SM_FORM_DELETE);
        $form->setAttribute('action', $this->url()->fromRoute('administration/default', ['controller' => 'user', 'action' => 'delete', 'id' => $id]));

        if(!$this->getRequest()->isPost()) {
            return [
                'form'       => $form,
                'id'         => $fhUser->getUserId(),
                'user'       => $fhUser,
            ];
        }

        if($this->getRequest()->getPost('delete') !== 'Ja') {
            $this->flashMessenger()->addInfoMessage('Löschen wurde abgebrochen!');
            return $this->redirect()->toRoute('administration/default', ['controller' => 'user', 'action' => 'index']);
        }

        $mapper->delete($fhUser);
        $this->flashMessenger()->addSuccessMessage('Benutzer wurde erfolgreich gelöscht!');
        return $this->redirect()->toRoute('administration/default', ['controller' => 'user', 'action' => 'index']);
    }

    public function createAction() {

        throw new \Exception('NOT IMPLEMENTED YET!');

    }
}
