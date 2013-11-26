<?php

namespace Fachhochschule\Controller;

use Zend\View\Model\ViewModel;

use Base\Service\Iterator\Filter\Url as Filter;

use Base\Constants as C;

class CreateController extends AbstractController {



    public function indexAction() {


//        return $this->forward()->dispatch($this->params('controller'),
//                array('action' => self::ACTION_SHOW));


        // <editor-fold defaultstate="collapsed" desc="Beispiel für Weiterleitung mit Parametern">
        //        return $this->forward()->dispatch('Fachhochschule/Controller/Infoscript', array(
        //                'action' => 'index',
        //                'grml' => $infoscript
        //            )
        //        );
        // </editor-fold>

    }

    public function selectTemplateAction() {
        
        return [];      
    }

}
