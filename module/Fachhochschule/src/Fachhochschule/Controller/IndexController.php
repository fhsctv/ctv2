<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Fachhochschule\Controller;

use Zend\View\Model\ViewModel;

use Base\Constants as C;

class IndexController extends AbstractController
{
    
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
    
    
    public function indexAction() {
       
        $userId = $this->zfcUserAuthentication()->getIdentity()->getId();
        
        $userMapper  = $this->getServiceLocator()->get(C::SM_MAPPER_FACHHOCHSCHULE);
        $infoService = $this->getServiceLocator()->get(C::SERVICE_INFOSCRIPT);
        
        $user = $userMapper->getById($userId);
        $info = $infoService->getByUserId($user->getUserId());
        
        $current  = new \Base\Service\Iterator\Filter\Url\Current($info);
        $future   = new \Base\Service\Iterator\Filter\Url\Future($info);
        $outdated = new \Base\Service\Iterator\Filter\Url\Outdated($info);
        
        $actionUrls = [
            'details' => $this->url()->fromRoute(self::ROUTE, array('controller' => self::CONTROLLER, 'action' => self::ACTION_DETAILS)),
            'create'  => $this->url()->fromRoute(self::ROUTE, array('controller' => self::CONTROLLER, 'action' => self::ACTION_CREATE)),
            'edit'    => $this->url()->fromRoute(self::ROUTE, array('controller' => self::CONTROLLER, 'action' => self::ACTION_EDIT)),
            'delete'  => $this->url()->fromRoute(self::ROUTE, array('controller' => self::CONTROLLER, 'action' => self::ACTION_DELETE)),
            
        ];
        
        return [
            'user' => $user,
            
            'actionUrls' => $actionUrls,

            'msgSuccess' => $this->flashMessenger()->getCurrentSuccessMessages(),
            'msgInfo'    => $this->flashMessenger()->getCurrentInfoMessages(),
            'msgError'   => $this->flashMessenger()->getCurrentErrorMessages(),
            
            'current'  => $current,
            'future'   => $future,
            'outdated' => $outdated,
        ];
    }

}
