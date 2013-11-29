<?php

namespace Fachhochschule\Controller;

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

        return $this->forward()->dispatch('Base\Controller\Infoscript',
            [
                'controller' => 'infoscript',
                'action'     => 'show',
                'id'         => $this->params()->fromRoute('id'),
            ]
        );
    }

    public function createAction() {

        return $this->forward()->dispatch('Base\Controller\Infoscript',
            [
                'controller' => 'infoscript',
                'action'     => 'create',
            ]
        );
    }

    public function editAction() {

        return $this->forward()->dispatch('Base\Controller\Infoscript',
            [
                'controller' => 'infoscript',
                'action'     => 'edit',
                'id'         => $this->params()->fromRoute('id', null),
            ]
        );
    }

    public function deleteAction() {

        return $this->forward()->dispatch('Base\Controller\Infoscript',
            [
                'controller' => 'infoscript',
                'action'     => 'delete',
                'id'         => $this->params()->fromRoute('id', null),
            ]
        );
    }

    public function detailsAction() {

        return $this->forward()->dispatch('Base\Controller\Infoscript',
            [
                'controller' => 'infoscript',
                'action'     => 'details',
                'id'         => $this->params()->fromRoute('id', null),
            ]
        );
    }


    //:TODO Auslagern in eigenen Display- Controller
    public function deleteFromDisplayAction(){

        return $this->forward()->dispatch('Base\Controller\Infoscript',
            [
                'controller' => 'infoscript',
                'action'     => 'delete-from-display',
                'id'         => $this->params()->fromRoute('id', null),
                'display'    => $this->params()->fromRoute('display', null),
            ]
        );
    }

    public function addToDisplayAction(){

        return $this->forward()->dispatch('Base\Controller\Infoscript',
            [
                'controller' => 'infoscript',
                'action'     => 'add-to-display',
                'id'         => $this->params()->fromRoute('id', null),
                'display'    => $this->params()->fromRoute('display', null),
            ]
        );
    }
    //ENDTODO

}
