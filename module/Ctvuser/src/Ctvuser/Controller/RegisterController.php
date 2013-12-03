<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Ctvuser\Controller;

use Zend\View\Model\ViewModel;
use Base\Constants as C;

class RegisterController extends  \ZfcUser\Controller\UserController {

    public function indexAction() {
        
        $form    = new \Ctvuser\Form\Role();

        
        if(!$this->getRequest()->isPost()){
            return new ViewModel(['form' => $form]);
        }
        
        switch ($this->getRequest()->getPost('rolle')) {
            case 'unternehmen':
                return $this->redirect()->toRoute('ctvuser/default', ['controller' => 'register', 'action' => 'register-unternehmen',]);
                //return $this->forward()->dispatch($this->params('controller'), ['action' => 'register-unternehmen']);
            
            case 'student':
                return $this->redirect()->toRoute('ctvuser/default', ['controller' => 'register', 'action' => 'register-student',]);
                //return $this->forward()->dispatch($this->params('controller'), ['action' => 'register-student']);
            
            case 'fachhochschule':
                return $this->redirect()->toRoute('ctvuser/default', ['controller' => 'register', 'action' => 'register-fachhochschule',]);
                //return $this->forward()->dispatch($this->params('controller'), ['action' => 'register-fachhochschule']);

            default:
                $this->flashMessenger()->addErrorMessage('Bitte wählen Sie eine Option!');
                return new ViewModel(['form' => $form, 'errorMessages' => $this->flashMessenger()->getErrorMessages()]);
        }

    }
    
    public function registerUnternehmenAction(){
        
        throw new \Exception('Not implemented yet!');
        
        $form = new \Zend\Form\Form('unternehmen');

        return new ViewModel(['form' => $form]);
    }
    
    public function registerStudentAction(){
        
        throw new \Exception('Not implemented yet!');
        
        $form = new \Zend\Form\Form('unternehmen');

        return new ViewModel(['form' => $form]);
    }
    
    public function registerFachhochschuleAction(){
        
        $form = new \Base\Form\Fachhochschule();
        $form->setAttribute('action', $this->url()->fromRoute('ctvuser/default', [
                    'controller' => 'register',
                    'action' => $this->params('action')
                ]
            )
        );
        
        if(!$this->getRequest()->isPost()){
            return ['form' => $form];
        }
        
        $form->setData($this->getRequest()->getPost());
        
        if(!$form->isValid()){
            return ['form' => $form];
        }
        
        $fachhochschule = $form->getData();
        
        //Passwort verschlüsseln
        $crypt = new \Zend\Crypt\Password\Bcrypt();
        $crypt->setCost(14);
        $fachhochschule->setPassword($crypt->create($fachhochschule->getPassword()));
        
        
        
        $mapper = $this->getServiceLocator()->get(C::SM_MAP_FACHHOCHSCHULE);
        $mapper->save($fachhochschule);
        
        
        return $this->redirect()->toRoute('zfcuser/login');
        
    }

}
