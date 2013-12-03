<?php

namespace Fachhochschule\Controller;

use Zend\View\Model\ViewModel;

use Base\Service\Iterator\Filter\Inserat as Filter;

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

        $actionUrls = new \ArrayObject(
        [
            'create' => new \ArrayObject(
            [
              'info'   => $this->url()->fromRoute('fachhochschule/default', ['controller' => 'create', 'action' => 'create-info']),
              'table'  => $this->url()->fromRoute('fachhochschule/default', ['controller' => 'create', 'action' => 'create-table']),
              'list'   => $this->url()->fromRoute('fachhochschule/default', ['controller' => 'create', 'action' => 'create-list']),
              'bild'   => $this->url()->fromRoute('fachhochschule/default', ['controller' => 'create', 'action' => 'create-bild']),
            ], \ArrayObject::ARRAY_AS_PROPS),
        ], \ArrayObject::ARRAY_AS_PROPS);

        return [

            'actionUrls' => $actionUrls,

        ];
    }

    public function createInfoAction() {


        $previewWidget = $this->forward()->dispatch('Generator\Controller\Infoscript', ['action' => 'info']);

        $viewModel = new ViewModel();
        $viewModel->addChild($previewWidget, 'previewWidget');

        return $viewModel;
    }

    public function createListAction() {

        var_dump('createList');
    }

    public function createImageAction() {

        var_dump('createImage');
    }

    public function createTableAction() {

        $previewWidget = $this->forward()->dispatch('Generator\Controller\Infoscript', ['action' => 'tabelle']);

        $viewModel = new ViewModel();
        $viewModel->addChild($previewWidget, 'previewWidget');

        return $viewModel;
    }

}
