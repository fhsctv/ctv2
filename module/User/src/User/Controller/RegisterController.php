<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace User\Controller;

use Zend\View\Model\ViewModel;
use Base\Constants as C;

class RegisterController extends AbstractController {

    public function indexAction() {
        
        $form    = new \User\Form\Role();

        
        if(!$this->getRequest()->isPost()){
            return new ViewModel(['form' => $form]);
        }
        
        switch ($this->getRequest()->getPost('rolle')) {
            case 'unternehmen':
                return $this->forward()->dispatch($this->params('controller'), ['action' => 'register-unternehmen']);
            
            case 'student':
                return $this->forward()->dispatch($this->params('controller'), ['action' => 'register-student']);
            
            case 'fachhochschule':
                return $this->forward()->dispatch($this->params('controller'), ['action' => 'register-fachhochschule']);

            default:
                $this->flashMessenger()->addErrorMessage('Bitte wählen Sie eine Option!');
                return new ViewModel(['form' => $form, 'errorMessages' => $this->flashMessenger()->getErrorMessages()]);
        }

    }
    
    public function registerUnternehmenAction(){
        
        $form = new \Zend\Form\Form('unternehmen');

        return new ViewModel(['form' => $form]);
        
    }
    
    public function registerStudentAction(){
        
        $form = new \Zend\Form\Form('unternehmen');

        return new ViewModel(['form' => $form]);
        
    }
    
    public function registerFachhochschuleAction(){
        
        $form = new \Base\Form\Fachhochschule();
        $form->setAttribute('action', $this->url()->fromRoute('user/default', [
                    'controller' => 'register',
                    'action' => $this->params('action')
                ]
            )
        );
        

        
        return ['form' => $form];
        
    }

}
