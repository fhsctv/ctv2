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

class CtvuserController extends AbstractController
{
    public function indexAction()
    {
        

        
        return new ViewModel(array());
    }

}
