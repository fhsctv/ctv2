<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Administration\Controller;

use Base\Constants as C;

class IndexController extends AbstractController
{
    public function indexAction() {

        $users     = $this->forward()->dispatch('Administration\Controller\User', ['action' => 'index',]);
        $displays  = $this->forward()->dispatch('Administration\Controller\Display', ['action' => 'index',]);
        $info      = $this->forward()->dispatch('Administration\Controller\Infoscript', ['action' => 'show',]);

        $viewModel = new \Zend\View\Model\ViewModel();
        $viewModel->addChild($users, 'users');
        $viewModel->addChild($displays, 'displays');
        $viewModel->addChild($info, 'info');

        return $viewModel;

    }
}
