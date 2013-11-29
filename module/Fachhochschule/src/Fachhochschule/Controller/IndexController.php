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
use Base\Service\Iterator\Filter\Inserat as Filter;

class IndexController extends AbstractController {

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

        $user = $userMapper->getById($userId);

        $infoWidget = $this->forward()->dispatch('Base\Controller\Infoscript', ['controller' => 'infoscript', 'action' => 'show', 'id' => $userId]);

        $actionUrls = [
            'changeMail'     => $this->url()->fromRoute('zfcuser/changeemail'),
            'changePassword' => $this->url()->fromRoute('zfcuser/changepassword'),
        ];

        $viewModel = new ViewModel(
            [
                'user' => $user,

                'actionUrls' => $actionUrls,

                'messages'   => $this->flashMessenger(),
            ]
        );

        $viewModel->addChild($infoWidget, 'infoWidget');

        return $viewModel;
    }

}
