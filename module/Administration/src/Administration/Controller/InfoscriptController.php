<?php

namespace Administration\Controller;

use Zend\View\Model\ViewModel;

use Base\Service\Iterator\Filter\Url as Filter;

use Base\Constants as C;

class InfoscriptController extends AbstractController {

    const ROUTE                          = 'administration/default';
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
        //        return $this->forward()->dispatch('Administration/Controller/Infoscript', array(
        //                'action' => 'index',
        //                'grml' => $infoscript
        //            )
        //        );
        // </editor-fold>

    }

    public function showAction() {

        $service = $this->getServiceLocator()->get(C::SERVICE_INFOSCRIPT);

        $infoscript = $service->fetchAll();

        return new ViewModel(
                array(
                    'urlDetails' => $this->url()->fromRoute(self::ROUTE, array('controller' => self::CONTROLLER, 'action' => self::ACTION_DETAILS)),
                    'urlCreate'  => $this->url()->fromRoute(self::ROUTE, array('controller' => self::CONTROLLER, 'action' => self::ACTION_CREATE)),
                    'urlEdit'    => $this->url()->fromRoute(self::ROUTE, array('controller' => self::CONTROLLER, 'action' => self::ACTION_EDIT)),
                    'urlDelete'  => $this->url()->fromRoute(self::ROUTE, array('controller' => self::CONTROLLER, 'action' => self::ACTION_DELETE)),

                    'msgSuccess' => $this->flashMessenger()->getCurrentSuccessMessages(),
                    'msgInfo'    => $this->flashMessenger()->getCurrentInfoMessages(),
                    'msgError'   => $this->flashMessenger()->getCurrentErrorMessages(),

                    'current'    => new Filter\Current($infoscript),
                    'outdated'   => new Filter\Outdated($infoscript),
                    'future'     => new Filter\Future($infoscript),
                )
        );
    }

    public function createAction() {

        $service = $this->getService(C::SERVICE_INFOSCRIPT);
        $form    = $this->getService(C::SERVICE_FORM_INFOSCRIPT);

        $infoscript = $service->createInfoscriptFromForm($form, $this->getRequest());

        if (!$infoscript) {
            return new ViewModel(array('form' => $form));
        }


        $service->save($infoscript);

        $this->flashMessenger()->addSuccessMessage(self::MESSAGE_CREATE_SUCCESS);
        return $this->simpleRedirectRoute(self::ROUTE, self::CONTROLLER, self::ACTION_SHOW);
    }

    public function editAction() {

        $id = $this->params('id');

        if(!$id) {
            return $this->simpleRedirectRoute(self::ROUTE, self::CONTROLLER, self::ACTION_INDEX);
        }

        $service  = $this->getService(C::SERVICE_INFOSCRIPT);
        $original = $service->getById($id);

        $form = $this->getServiceLocator()->get(C::SERVICE_FORM_INFOSCRIPT);
        $form->bind($original);

        $changed = $service->createInfoscriptFromForm($form, $this->getRequest());

        if (!$changed) {
            return new ViewModel(array('form' => $form));
        }

        $service->save($changed);

        $this->flashMessenger()->addSuccessMessage(self::FLASHMESSENGER_EDIT_SUCCESS);
        return $this->redirect()->toRoute(self::ROUTE, array('controller' => self::CONTROLLER, 'action' => self::ACTION_DETAILS, 'id'=>$changed->getInseratId()));
    }

    public function deleteAction() {

        $id = $this->params()->fromRoute('id', null);

        if (!$id) {
            return $this->simpleRedirectRoute(self::ROUTE, self::CONTROLLER, self::ACTION_INDEX);
        }

        $infoscript = $this->getService(C::SERVICE_MAPPER_INFOSCRIPT)->getById($id);

        if(!$this->dataReceived()) {
            return new ViewModel(
                array(
                    'form'       => $this->getService(C::SERVICE_FORM_DELETE),
                    'id'         => $id,
                    'urlDelete'  => $this->url()->fromRoute(self::ROUTE, array('controller' => self::CONTROLLER, 'action' => self::ACTION_DELETE, 'id' => $id)),
                    'infoscript' => $infoscript,));
        }

        $this->getService(C::SERVICE_MAPPER_INFOSCRIPT)->delete($infoscript, $this->getRequest(), $this->flashMessenger());

        return $this->simpleRedirectRoute(self::ROUTE, self::CONTROLLER, self::ACTION_INDEX);
        
    }

    public function detailsAction() {

        $id = (int) $this->params('id', NULL);
        
        if(!$id){
            return $this->simpleRedirectRoute(self::ROUTE, self::CONTROLLER, self::ACTION_INDEX);
        }
        
        $infoscript  = $this->getService(C::SERVICE_INFOSCRIPT)->getById($id);
        
        $deleteUrl   = $this->url()->fromRoute(self::ROUTE, array('controller' => self::CONTROLLER, 'action' => self::ACTION_DELETE_DISPLAY));
        $addUrl      = $this->url()->fromRoute(self::ROUTE, array('controller' => self::CONTROLLER, 'action' => self::ACTION_ADD_DISPLAY));
        
        //TODO von Datenbank holen
        $bildschirme = array(1, 2, 3, 4);
        
        $addBildschirme = array_diff($bildschirme, $infoscript->getBildschirme());


        return new ViewModel(
            array(
                'infoscript'  => $infoscript,
                'deleteUrl'   => $deleteUrl,
                'bildschirme' => $addBildschirme,
                'addUrl'      => $addUrl,
                
                'msgSuccess' => $this->flashMessenger()->getCurrentSuccessMessages(),
                'msgInfo'    => $this->flashMessenger()->getCurrentInfoMessages(),
                'msgError'   => $this->flashMessenger()->getCurrentErrorMessages(),
            )
        );
    }

    
    //TODO Auslagern in eigenen Display- Controller mit redirect GET Parameter
    public function deleteFromDisplayAction(){
        
        $inseratId    = (int) $this->params('id', null);
        $bildschirmId = (int) $this->params('display', null);
        
        if (!($inseratId && $bildschirmId)) {
            return $this->simpleRedirectRoute(self::ROUTE, self::CONTROLLER, self::ACTION_INDEX);
        }
        
        
        $this->getServiceLocator()->get(C::SERVICE_DISPLAYLINK)->delete($inseratId, $bildschirmId);
        
        $this->flashMessenger()->addSuccessMessage('Bildschirm erfolgreich entfernt!');

        return $this->redirect()->toRoute(self::ROUTE, array('controller' => self::CONTROLLER, 'action' => self::ACTION_DETAILS, 'id' => $inseratId));
        
        
        
    }
    
    public function addToDisplayAction(){
        
        $inseratId    = (int) $this->params('id', null);
        $bildschirmId = (int) $this->params('display', null);
        
        if (!($inseratId && $bildschirmId)) {
            return $this->simpleRedirectRoute(self::ROUTE, self::CONTROLLER, self::ACTION_INDEX);
        }
        
        $this->getService(C::SERVICE_DISPLAYLINK)->add($inseratId, $bildschirmId);
        
        $this->flashMessenger()->addSuccessMessage('Bildschirm erfolgreich hinzugefügt');
        
        return $this->redirect()->toRoute(self::ROUTE, array('controller' => self::CONTROLLER, 'action' => self::ACTION_DETAILS, 'id' => $inseratId));
        
    }
    //ENDTODO

    public function importAction() {

        $set = array(
            // <editor-fold defaultstate="collapsed" desc="set">
            array(
                'inserat_id'      => '',
                'fk_fh_id' => '1',
                'url'  => 'http://futhuer.de/ctv/live/infoscripte/googlenews/news_check.php',
                'start'    => '2012-06-18',
                'ende'     => '2099-12-31',
                'aktiv'    => '1',
            ),
            array(
                'inserat_id'      => '',
                'fk_fh_id' => '1',
                'url'  => 'http://futhuer.de/ctv/live/infoscripte/sap2013/sap2013.html',
                'start'    => '2013-10-12',
                'ende'     => '2013-10-16',
                'aktiv'    => '1',
            ),
            array(
                'inserat_id'      => '',
                'fk_fh_id' => '1',
                'url'  => 'http://futhuer.de/ctv/live/infoscripte/mensa/mensa_neu.php',
                'start'    => '2012-06-10',
                'ende'     => '2099-12-31',
                'aktiv'    => '1',
            ),
            array(
                'inserat_id'      => '',
                'fk_fh_id' => '1',
                'url'  => 'http://futhuer.de/ctv/live/infoscripte/niederschlagsradar/wetter.php',
                'start'    => '2012-06-18',
                'ende'     => '2099-12-31',
                'aktiv'    => '1',
            ),
            array(
                'inserat_id'      => '',
                'fk_fh_id' => '1',
                'url'  => 'http://futhuer.de/ctv/live/anzeigen/Willkommen/Willkommen.html',
                'start'    => '2013-10-07',
                'ende'     => '2013-10-16',
                'aktiv'    => '1',
            ),
            array(
                'inserat_id'      => '',
                'fk_fh_id' => '1',
                'url'  => 'http://futhuer.de/ctv/live/infoscripte/HIT_2013/03.html',
                'start'    => '2013-06-15',
                'ende'     => '2013-06-15',
                'aktiv'    => '1',
            ),
            array(
                'inserat_id'      => '',
                'fk_fh_id' => '1',
                'url'  => 'http://futhuer.de/ctv/live/infoscripte/HIT_2013/01.html',
                'start'    => '2013-06-15',
                'ende'     => '2013-06-15',
                'aktiv'    => '1',
            ),
            array(
                'inserat_id'      => '',
                'fk_fh_id' => '1',
                'url'  => 'http://futhuer.de/ctv/live/infoscripte/HIT_2013/02.html',
                'start'    => '2013-06-15',
                'ende'     => '2013-06-15',
                'aktiv'    => '1',
            ),
            array(
                'inserat_id'      => '',
                'fk_fh_id' => '1',
                'url'  => 'http://futhuer.de/ctv/live/infoscripte/HIT_2013/04.html',
                'start'    => '2013-06-15',
                'ende'     => '2013-06-15',
                'aktiv'    => '1',
            ),
            array(
                'inserat_id'      => '',
                'fk_fh_id' => '1',
                'url'  => 'http://futhuer.de/ctv/live/infoscripte/HIT_2013/06.html',
                'start'    => '2013-06-15',
                'ende'     => '2013-06-15',
                'aktiv'    => '1',
            ),
            array(
                'inserat_id'      => '',
                'fk_fh_id' => '1',
                'url'  => 'http://futhuer.de/ctv/live/infoscripte/HIT_2013/07.html',
                'start'    => '2013-06-15',
                'ende'     => '2013-06-15',
                'aktiv'    => '1',
            ),
            array(
                'inserat_id'      => '',
                'fk_fh_id' => '1',

                'url'  => 'http://futhuer.de/ctv/live/infoscripte/HIT_2013/08.html',
                'start'    => '2013-06-15',
                'ende'     => '2013-06-15',
                'aktiv'    => '1',
            ),
            array(
                'inserat_id'      => '',
                'fk_fh_id' => '1',
                'url'  => 'http://futhuer.de/ctv/live/infoscripte/fhs/fhs_news.php',
                'start'    => '2000-01-01',
                'ende'     => '2099-12-31',
                'aktiv'    => '1',
            ),
            array(
                'inserat_id'      => '',
                'fk_fh_id' => '1',
                'url'  => 'http://futhuer.de/ctv/live/infoscripte/Wetter/wetter.php',
                'start'    => '2013-10-14',
                'ende'     => '2099-10-14',
                'aktiv'    => '1',
            ),
            // </editor-fold>
        );

        $iHyd = $this->getService(C::SERVICE_HYDRATOR_MODEL_INFOSCRIPT);
        $iMapper = $this->getService(C::SERVICE_MAPPER_INFOSCRIPT);
        
        foreach ($set as $infArr) {

            $ifScr = $iHyd->hydrate($infArr, $this->getService(C::SERVICE_ENTITY_INFOSCRIPT));
            $ifScr->addBildschirm(1)->addBildschirm(2)->addBildschirm(3)->addBildschirm(4);
            
            $iMapper->save($ifScr);

            var_dump($ifScr);

        }

        return new ViewModel(array('content' => __METHOD__));
    }

}
