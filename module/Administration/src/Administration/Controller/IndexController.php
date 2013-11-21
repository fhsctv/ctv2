<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Administration\Controller;

use Zend\View\Model\ViewModel;

use Base\Constants as C;

class IndexController extends AbstractController
{
    public function indexAction()
    {
        $content = __METHOD__;

        
        
        $hasFilter = new \Zend\Stdlib\Hydrator\Filter\HasFilter();
        
        var_dump($hasFilter->filter('hash_tag'));
        
        
        
        
        
        $table = $this->getService(C::SERVICE_TABLE_BILDSCHIRM);
        
        $resultSet = $table->fetchAll();
        
        foreach ($resultSet as $value) {
            var_dump($value);
        }
        
        return new ViewModel(array('content' => $content));
    }

}
