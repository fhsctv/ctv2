<?php

namespace Administration\Controller;

use Zend\View\Model\ViewModel;

use Base\Service\Iterator\Filter\Url as Filter;

use Base\Constants as C;

class AnzeigeController extends AbstractController {

    const ROUTE                          = 'administration/default';
    const CONTROLLER                     = 'anzeige';
    const ACTION_INDEX                   = 'index';
    const ACTION_SHOW                    = 'show';
    const ACTION_DETAILS                 = 'details';
    const ACTION_CREATE                  = 'create';
    const ACTION_EDIT                    = 'edit';
    const ACTION_DELETE                  = 'delete';
    
    const TABLE_ANZEIGE               = 'Base\Table\Anzeige';

    const MESSAGE_CREATE_SUCCESS         = 'Das Anzeige wurde erfolgreich erstellt!';
    const FLASHMESSENGER_EDIT_SUCCESS    = 'Das Anzeige wurde erfolgreich bearbeitet!';

    public function indexAction() {
        
        
        return $this->forward()->dispatch($this->params('controller'), 
                array('action' => self::ACTION_SHOW));

        
        // <editor-fold defaultstate="collapsed" desc="Beispiel für Weiterleitung mit Parametern">
        //        return $this->forward()->dispatch('Administration/Controller/Anzeige', array(
        //                'action' => 'index',
        //                'grml' => $anzeige
        //            )
        //        );
        // </editor-fold>

    }

    public function showAction() {

        $service = $this->getServiceLocator()->get(C::SERVICE_ANZEIGE);
        
        $anzeige = $service->fetchAll();
        
        return new ViewModel(
                array(
                    'urlDetails' => $this->url()->fromRoute(self::ROUTE, array('controller' => self::CONTROLLER, 'action' => self::ACTION_DETAILS)),
                    'urlCreate'  => $this->url()->fromRoute(self::ROUTE, array('controller' => self::CONTROLLER, 'action' => self::ACTION_CREATE)),
                    'urlEdit'    => $this->url()->fromRoute(self::ROUTE, array('controller' => self::CONTROLLER, 'action' => self::ACTION_EDIT)),
                    'urlDelete'  => $this->url()->fromRoute(self::ROUTE, array('controller' => self::CONTROLLER, 'action' => self::ACTION_DELETE)),
                    
                    'msgSuccess' => $this->flashMessenger()->getCurrentSuccessMessages(),
                    'msgInfo'    => $this->flashMessenger()->getCurrentInfoMessages(),
                    'msgError'   => $this->flashMessenger()->getCurrentErrorMessages(),
                    
                    'current'    => new Filter\Current($anzeige),
                    'outdated'   => new Filter\Outdated($anzeige),
                    'future'     => new Filter\Future($anzeige),
                )
        );
    }

    public function createAction() {

        $service = $this->getService(C::SERVICE_ANZEIGE);
        $form    = $this->getService(C::SERVICE_FORM_ANZEIGE);

        $anzeige = $service->createAnzeigeFromForm($form, $this->getRequest());

        if (!$anzeige) {
            return new ViewModel(array('form' => $form));
        }
        
        
        $service->save($anzeige);

        $this->flashMessenger()->addSuccessMessage(self::MESSAGE_CREATE_SUCCESS);
        return $this->simpleRedirectRoute(self::ROUTE, self::CONTROLLER, self::ACTION_SHOW);
    }
    
    public function editAction() {

        $id = $this->params('id');
        
        if(empty($id)) {
            return $this->redirect()->toRoute(self::ROUTE, array(
                'controller' => self::CONTROLLER, 
                'action' => self::ACTION_INDEX));
        }
        
        $service = $this->getService(C::SERVICE_ANZEIGE);
        $original = $service->get($id);
        
        $form = $this->getServiceLocator()->get(C::SERVICE_FORM_ANZEIGE);
        $form->bind($original);

        $changed = $service->createAnzeigeFromForm($form, $this->getRequest());

        if (!$changed) {
            return new ViewModel(array('form' => $form));
        }

        $service->save($changed);

        $this->flashMessenger()->addSuccessMessage(self::FLASHMESSENGER_EDIT_SUCCESS);
        return $this->simpleRedirectRoute(self::ROUTE, self::CONTROLLER, self::ACTION_INDEX);
    }
    
    public function deleteAction() {
        
        $id = $this->params()->fromRoute('id', null);

        if (!$id) {
            return $this->redirect()->toRoute(self::ROUTE, array(
                'action' => self::ACTION_INDEX
            ));
        }
        
        $anzeige = $this->getService(C::SERVICE_ANZEIGE)->get($id);
        
        if(!$this->dataReceived()) {
            return new ViewModel(
                array(
                    'form'       => $this->getService(C::SERVICE_FORM_DELETE),
                    'id'         => $id,
                    'urlDelete'  => $this->url()->fromRoute(self::ROUTE, array('controller' => self::CONTROLLER, 'action' => self::ACTION_DELETE, 'id' => $id)),
                    'anzeige' => $anzeige,));
        }
        
        $this->getService(C::SERVICE_ANZEIGE)->delete($anzeige, $this->getRequest(), $this->flashMessenger());
        
        return $this->simpleRedirectRoute(self::ROUTE, self::CONTROLLER, self::ACTION_INDEX);
    }
    
    

    public function detailsAction() {
        
        $content = __METHOD__;
        
        return new ViewModel(
            array(
                'content' => $content
            )
        );
    }

    

    public function importAction() {
        
        $set = array(
            // <editor-fold defaultstate="collapsed" desc="set">
            array(
                C::ANZEIGE_ID      => '',
                C::ANZEIGE_USER_ID => '1',
                C::ANZEIGE_URL_ID  => '',
                C::URL_ADRESSE  => 'http://futhuer.de/ctv/live/anzeigee/googlenews/news_check.php',
                C::URL_START    => '2012-06-18',
                C::URL_ENDE     => '2099-12-31',
                C::URL_AKTIV    => '1',
            ),
            array(
                C::ANZEIGE_ID      => '',
                C::ANZEIGE_USER_ID => '1',
                C::ANZEIGE_URL_ID  => '',
                C::URL_ADRESSE  => 'http://futhuer.de/ctv/live/anzeigee/sap2013/sap2013.html',
                C::URL_START    => '2013-10-12',
                C::URL_ENDE     => '2013-10-16',
                C::URL_AKTIV    => '1',
            ),
            array(
                C::ANZEIGE_ID      => '',
                C::ANZEIGE_USER_ID => '1',
                C::ANZEIGE_URL_ID  => '',
                C::URL_ADRESSE  => 'http://futhuer.de/ctv/live/anzeigee/mensa/mensa_neu.php',
                C::URL_START    => '2012-06-10',
                C::URL_ENDE     => '2099-12-31',
                C::URL_AKTIV    => '1',
            ),
            array(
                C::ANZEIGE_ID      => '',
                C::ANZEIGE_USER_ID => '1',
                C::ANZEIGE_URL_ID  => '',
                C::URL_ADRESSE  => 'http://futhuer.de/ctv/live/anzeigee/niederschlagsradar/wetter.php',
                C::URL_START    => '2012-06-18',
                C::URL_ENDE     => '2099-12-31',
                C::URL_AKTIV    => '1',
            ),
            array(
                C::ANZEIGE_ID      => '',
                C::ANZEIGE_USER_ID => '1',
                C::ANZEIGE_URL_ID  => '',
                C::URL_ADRESSE  => 'http://futhuer.de/ctv/live/anzeigen/Willkommen/Willkommen.html',
                C::URL_START    => '2013-10-07',
                C::URL_ENDE     => '2013-10-16',
                C::URL_AKTIV    => '1',
            ),
            array(
                C::ANZEIGE_ID      => '',
                C::ANZEIGE_USER_ID => '1',
                C::ANZEIGE_URL_ID  => '',
                C::URL_ADRESSE  => 'http://futhuer.de/ctv/live/anzeigee/HIT_2013/03.html',
                C::URL_START    => '2013-06-15',
                C::URL_ENDE     => '2013-06-15',
                C::URL_AKTIV    => '1',
            ),
            array(
                C::ANZEIGE_ID      => '',
                C::ANZEIGE_USER_ID => '1',
                C::ANZEIGE_URL_ID  => '',
                C::URL_ADRESSE  => 'http://futhuer.de/ctv/live/anzeigee/HIT_2013/01.html',
                C::URL_START    => '2013-06-15',
                C::URL_ENDE     => '2013-06-15',
                C::URL_AKTIV    => '1',
            ),
            array(
                C::ANZEIGE_ID      => '',
                C::ANZEIGE_USER_ID => '1',
                C::ANZEIGE_URL_ID  => '',
                C::URL_ADRESSE  => 'http://futhuer.de/ctv/live/anzeigee/HIT_2013/02.html',
                C::URL_START    => '2013-06-15',
                C::URL_ENDE     => '2013-06-15',
                C::URL_AKTIV    => '1',
            ),
            array(
                C::ANZEIGE_ID      => '',
                C::ANZEIGE_USER_ID => '1',
                C::ANZEIGE_URL_ID  => '',
                C::URL_ADRESSE  => 'http://futhuer.de/ctv/live/anzeigee/HIT_2013/04.html',
                C::URL_START    => '2013-06-15',
                C::URL_ENDE     => '2013-06-15',
                C::URL_AKTIV    => '1',
            ),
            array(
                C::ANZEIGE_ID      => '',
                C::ANZEIGE_USER_ID => '1',
                C::ANZEIGE_URL_ID  => '',
                C::URL_ADRESSE  => 'http://futhuer.de/ctv/live/anzeigee/HIT_2013/06.html',
                C::URL_START    => '2013-06-15',
                C::URL_ENDE     => '2013-06-15',
                C::URL_AKTIV    => '1',
            ),
            array(
                C::ANZEIGE_ID      => '',
                C::ANZEIGE_USER_ID => '1',
                C::ANZEIGE_URL_ID  => '',
                C::URL_ADRESSE  => 'http://futhuer.de/ctv/live/anzeigee/HIT_2013/07.html',
                C::URL_START    => '2013-06-15',
                C::URL_ENDE     => '2013-06-15',
                C::URL_AKTIV    => '1',
            ),
            array(
                C::ANZEIGE_ID      => '',
                C::ANZEIGE_USER_ID => '1',
                C::ANZEIGE_URL_ID  => '',
                C::URL_ADRESSE  => 'http://futhuer.de/ctv/live/anzeigee/HIT_2013/08.html',
                C::URL_START    => '2013-06-15',
                C::URL_ENDE     => '2013-06-15',
                C::URL_AKTIV    => '1',
            ),
            array(
                C::ANZEIGE_ID      => '',
                C::ANZEIGE_USER_ID => '1',
                C::ANZEIGE_URL_ID  => '',
                C::URL_ADRESSE  => 'http://futhuer.de/ctv/live/anzeigee/fhs/fhs_news.php',
                C::URL_START    => '2000-01-01',
                C::URL_ENDE     => '2099-12-31',
                C::URL_AKTIV    => '1',
            ),
            array(
                C::ANZEIGE_ID      => '',
                C::ANZEIGE_USER_ID => '1',
                C::ANZEIGE_URL_ID  => '',
                C::URL_ADRESSE  => 'http://futhuer.de/ctv/live/anzeigee/Wetter/wetter.php',
                C::URL_START    => '2013-10-14',
                C::URL_ENDE     => '2099-10-14',
                C::URL_AKTIV    => '1',
            ),
                // </editor-fold>
        );

        $iHyd = $this->getService(C::SERVICE_HYDRATOR_MODEL_ANZEIGE);
        $uHyd = $this->getService(C::SERVICE_HYDRATOR_MODEL_URL);

        foreach ($set as $infArr) {

            $ifScr = $iHyd->hydrate($infArr, $this->getService(C::SERVICE_ENTITY_ANZEIGE));
            $ifScr->setUrl($uHyd->hydrate($infArr, $this->getService(C::SERVICE_ENTITY_URL)));
            
            $this->getService(C::SERVICE_ANZEIGE)->save($ifScr);
        }

        return new ViewModel(array('content' => __METHOD__));
    }

}
