<?php

namespace Fachhochschule\Controller;

use Zend\View\Model\ViewModel;

use Base\Service\Iterator\Filter\Inserat as Filter;

use Base\Constants as C;

class InfoscriptController extends AbstractController {

    const ROUTE                          = 'fachhochschule/default';
    const CONTROLLER                     = 'infoscript';
    const ACTION_INDEX                   = 'index';
    const ACTION_SHOW                    = 'show';
    const ACTION_DETAILS                 = 'details';
    const ACTION_CREATE                  = 'create';
    const ACTION_EDIT                    = 'edit';
    const ACTION_DELETE                  = 'delete';
    const ACTION_DELETE_DISPLAY          = 'delete-from-display';
    const ACTION_ADD_DISPLAY             = 'add-to-display';

    const TABLE_INFOSCRIPT               = 'Base\Table\Infoscript';

    const MESSAGE_CREATE_SUCCESS         = 'Das Infoscript wurde erfolgreich erstellt!';
    const FLASHMESSENGER_EDIT_SUCCESS    = 'Das Infoscript wurde erfolgreich bearbeitet!';

    public function indexAction() {


        return $this->forward()->dispatch($this->params('controller'),
                array('action' => self::ACTION_SHOW));


        // <editor-fold defaultstate="collapsed" desc="Beispiel für Weiterleitung mit Parametern">
        //        return $this->forward()->dispatch('Fachhochschule/Controller/Infoscript', array(
        //                'action' => 'index',
        //                'grml' => $infoscript
        //            )
        //        );
        // </editor-fold>

    }

    public function showAction() {

        $service = $this->getServiceLocator()->get(C::SERVICE_INFOSCRIPT);
        
        
        $infoscript = $service->getByUserId($this->zfcUserAuthentication()->getIdentity()->getId());

        
        $actionUrls = [
            'details' => $this->url()->fromRoute(self::ROUTE, array('controller' => self::CONTROLLER, 'action' => self::ACTION_DETAILS)),
            'create'  => $this->url()->fromRoute(self::ROUTE, array('controller' => self::CONTROLLER, 'action' => self::ACTION_CREATE)),
            'edit'    => $this->url()->fromRoute(self::ROUTE, array('controller' => self::CONTROLLER, 'action' => self::ACTION_EDIT)),
            'delete'  => $this->url()->fromRoute(self::ROUTE, array('controller' => self::CONTROLLER, 'action' => self::ACTION_DELETE)),
        ];
        
        $viewModel = new ViewModel(
                array(
                    'actionUrls' => $actionUrls,
                    
                    'msgSuccess' => $this->flashMessenger()->getCurrentSuccessMessages(),
                    'msgInfo'    => $this->flashMessenger()->getCurrentInfoMessages(),
                    'msgError'   => $this->flashMessenger()->getCurrentErrorMessages(),

                    'current'    => new Filter\Current($infoscript),
                    'outdated'   => new Filter\Outdated($infoscript),
                    'future'     => new Filter\Future($infoscript),
                    'inactive'   => new Filter\Inactive($infoscript),
                )
        );
        
        return $viewModel->setTemplate('/base/infoscript/show.phtml');
    }

    public function createAction() {

        $service = $this->getService(C::SERVICE_INFOSCRIPT);
        $form    = $this->getService(C::SERVICE_FORM_INFOSCRIPT);

        $userIdElement = $form->getUserId();
        $userIdElement->setValue($this->zfcUserAuthentication()->getIdentity()->getId());
        
        
        $infoscript = $service->createInfoscriptFromForm($form, $this->getRequest());

        if (!$infoscript) {
            $viewModel = new ViewModel(['form' => $form]);
            
            return $viewModel->setTemplate('/base/infoscript/create');
        }

        $service->save($infoscript);

        $this->flashMessenger()->addSuccessMessage(self::MESSAGE_CREATE_SUCCESS);
        return $this->simpleRedirectRoute(self::ROUTE, self::CONTROLLER, self::ACTION_SHOW);
    }

    public function editAction() {

        $id = $this->params('id');

        if(!$id) {
            return $this->simpleRedirectRoute(self::ROUTE, self::CONTROLLER, self::ACTION_INDEX);
        }

        $service  = $this->getService(C::SERVICE_INFOSCRIPT);
        $original = $service->getById($id);

        $form = $this->getServiceLocator()->get(C::SERVICE_FORM_INFOSCRIPT);
        $form->bind($original);

        $changed = $service->createInfoscriptFromForm($form, $this->getRequest());

        if (!$changed) {
            $viewModel = new ViewModel(array('form' => $form));
            
            return $viewModel->setTemplate('/base/infoscript/edit');
        }

        $service->save($changed);

        $this->flashMessenger()->addSuccessMessage(self::FLASHMESSENGER_EDIT_SUCCESS);
        return $this->redirect()->toRoute(self::ROUTE, array('controller' => self::CONTROLLER, 'action' => self::ACTION_DETAILS, 'id'=>$changed->getInseratId()));
    }

    public function deleteAction() {

        $id = $this->params()->fromRoute('id', null);

        if (!$id) {
            return $this->simpleRedirectRoute(self::ROUTE, self::CONTROLLER, self::ACTION_INDEX);
        }

        $infoscript = $this->getService(C::SERVICE_MAPPER_INFOSCRIPT)->getById($id);

        if(!$this->dataReceived()) {
                $viewModel = new ViewModel(
                    [
                        'form'       => $this->getService(C::SERVICE_FORM_DELETE),
                        'id'         => $id,
                        'urlDelete'  => $this->url()->fromRoute(self::ROUTE, array('controller' => self::CONTROLLER, 'action' => self::ACTION_DELETE, 'id' => $id)),
                        'infoscript' => $infoscript,
                    ]
                );
            
                return $viewModel->setTemplate('/base/infoscript/delete.phtml');
        }

        //TODO prüfen warum, er trotz drücken auf "Nein" das Infoscript löscht
        $this->getService(C::SERVICE_MAPPER_INFOSCRIPT)->delete($infoscript, $this->getRequest(), $this->flashMessenger());

        return $this->simpleRedirectRoute(self::ROUTE, self::CONTROLLER, self::ACTION_INDEX);
        
    }

    public function detailsAction() {

        $id = (int) $this->params('id', NULL);
        
        if(!$id){
            return $this->simpleRedirectRoute(self::ROUTE, self::CONTROLLER, self::ACTION_INDEX);
        }
        
        $infoscript  = $this->getService(C::SERVICE_INFOSCRIPT)->getById($id);
        
        $deleteUrl   = $this->url()->fromRoute(self::ROUTE, array('controller' => self::CONTROLLER, 'action' => self::ACTION_DELETE_DISPLAY));
        $addUrl      = $this->url()->fromRoute(self::ROUTE, array('controller' => self::CONTROLLER, 'action' => self::ACTION_ADD_DISPLAY));
        
        $bildschirmResultSet = $this->getServiceLocator()->get(C::SERVICE_TABLE_BILDSCHIRM)->fetchAll();
        
        $bildschirme = [];
        foreach ($bildschirmResultSet as $bildschirm) {
            array_push($bildschirme, $bildschirm);
        }
        
        $addBildschirme = array_diff($bildschirme, $infoscript->getBildschirme());


        $viewModel = new ViewModel(
            array(
                'infoscript'  => $infoscript,
                'deleteUrl'   => $deleteUrl,
                'bildschirme' => $addBildschirme,
                'addUrl'      => $addUrl,
                                
                'msgSuccess' => $this->flashMessenger()->getCurrentSuccessMessages(),
                'msgInfo'    => $this->flashMessenger()->getCurrentInfoMessages(),
                'msgError'   => $this->flashMessenger()->getCurrentErrorMessages(),
            )
        );
        
        return $viewModel->setTemplate('/base/infoscript/details.phtml');
    }

    
    //TODO Auslagern in eigenen Display- Controller
    public function deleteFromDisplayAction(){
        
        $inseratId    = (int) $this->params('id', null);
        $bildschirmId = (int) $this->params('display', null);
        
        if (!($inseratId && $bildschirmId)) {
            return $this->simpleRedirectRoute(self::ROUTE, self::CONTROLLER, self::ACTION_INDEX);
        }
        
        
        $this->getServiceLocator()->get(C::SERVICE_DISPLAYLINK)->delete($inseratId, $bildschirmId);
        
        $this->flashMessenger()->addSuccessMessage('Bildschirm erfolgreich entfernt!');

        return $this->redirect()->toRoute(self::ROUTE, array('controller' => self::CONTROLLER, 'action' => self::ACTION_DETAILS, 'id' => $inseratId));
    }
    
    public function addToDisplayAction(){
        
        $inseratId    = (int) $this->params('id', null);
        $bildschirmId = (int) $this->params('display', null);
        
        if (!($inseratId && $bildschirmId)) {
            return $this->simpleRedirectRoute(self::ROUTE, self::CONTROLLER, self::ACTION_INDEX);
        }
        
        $this->getService(C::SERVICE_DISPLAYLINK)->add($inseratId, $bildschirmId);
        
        $this->flashMessenger()->addSuccessMessage('Bildschirm erfolgreich hinzugefügt');
        
        return $this->redirect()->toRoute(self::ROUTE, array('controller' => self::CONTROLLER, 'action' => self::ACTION_DETAILS, 'id' => $inseratId));
    }
    //ENDTODO

}
