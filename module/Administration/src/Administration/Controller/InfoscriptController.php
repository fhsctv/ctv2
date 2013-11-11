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
        
        if(empty($id)) {
            return $this->simpleRedirectRoute(self::ROUTE, self::CONTROLLER, self::ACTION_INDEX);
        }
        
        $service  = $this->getService(C::SERVICE_INFOSCRIPT);
        $original = $service->get($id);
        
        $form = $this->getServiceLocator()->get(C::SERVICE_FORM_INFOSCRIPT);
        $form->bind($original);

        $changed = $service->createInfoscriptFromForm($form, $this->getRequest());

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
            return $this->simpleRedirectRoute(self::ROUTE, self::CONTROLLER, self::ACTION_INDEX);
        }
        
        $infoscript = $this->getService(C::SERVICE_INFOSCRIPT)->get($id);
        
        if(!$this->dataReceived()) {
            return new ViewModel(
                array(
                    'form'       => $this->getService(C::SERVICE_FORM_DELETE),
                    'id'         => $id,
                    'urlDelete'  => $this->url()->fromRoute(self::ROUTE, array('controller' => self::CONTROLLER, 'action' => self::ACTION_DELETE, 'id' => $id)),
                    'infoscript' => $infoscript,));
        }
        
        $this->getService(C::SERVICE_INFOSCRIPT)->delete($infoscript, $this->getRequest(), $this->flashMessenger());
        
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
                C::INFO_ID      => '',
                C::INFO_USER_ID => '1',
                C::INFO_URL_ID  => '',
                C::URL_ADRESSE  => 'http://futhuer.de/ctv/live/infoscripte/googlenews/news_check.php',
                C::URL_START    => '2012-06-18',
                C::URL_ENDE     => '2099-12-31',
                C::URL_AKTIV    => '1',
            ),
            array(
                C::INFO_ID      => '',
                C::INFO_USER_ID => '1',
                C::INFO_URL_ID  => '',
                C::URL_ADRESSE  => 'http://futhuer.de/ctv/live/infoscripte/sap2013/sap2013.html',
                C::URL_START    => '2013-10-12',
                C::URL_ENDE     => '2013-10-16',
                C::URL_AKTIV    => '1',
            ),
            array(
                C::INFO_ID      => '',
                C::INFO_USER_ID => '1',
                C::INFO_URL_ID  => '',
                C::URL_ADRESSE  => 'http://futhuer.de/ctv/live/infoscripte/mensa/mensa_neu.php',
                C::URL_START    => '2012-06-10',
                C::URL_ENDE     => '2099-12-31',
                C::URL_AKTIV    => '1',
            ),
            array(
                C::INFO_ID      => '',
                C::INFO_USER_ID => '1',
                C::INFO_URL_ID  => '',
                C::URL_ADRESSE  => 'http://futhuer.de/ctv/live/infoscripte/niederschlagsradar/wetter.php',
                C::URL_START    => '2012-06-18',
                C::URL_ENDE     => '2099-12-31',
                C::URL_AKTIV    => '1',
            ),
            array(
                C::INFO_ID      => '',
                C::INFO_USER_ID => '1',
                C::INFO_URL_ID  => '',
                C::URL_ADRESSE  => 'http://futhuer.de/ctv/live/anzeigen/Willkommen/Willkommen.html',
                C::URL_START    => '2013-10-07',
                C::URL_ENDE     => '2013-10-16',
                C::URL_AKTIV    => '1',
            ),
            array(
                C::INFO_ID      => '',
                C::INFO_USER_ID => '1',
                C::INFO_URL_ID  => '',
                C::URL_ADRESSE  => 'http://futhuer.de/ctv/live/infoscripte/HIT_2013/03.html',
                C::URL_START    => '2013-06-15',
                C::URL_ENDE     => '2013-06-15',
                C::URL_AKTIV    => '1',
            ),
            array(
                C::INFO_ID      => '',
                C::INFO_USER_ID => '1',
                C::INFO_URL_ID  => '',
                C::URL_ADRESSE  => 'http://futhuer.de/ctv/live/infoscripte/HIT_2013/01.html',
                C::URL_START    => '2013-06-15',
                C::URL_ENDE     => '2013-06-15',
                C::URL_AKTIV    => '1',
            ),
            array(
                C::INFO_ID      => '',
                C::INFO_USER_ID => '1',
                C::INFO_URL_ID  => '',
                C::URL_ADRESSE  => 'http://futhuer.de/ctv/live/infoscripte/HIT_2013/02.html',
                C::URL_START    => '2013-06-15',
                C::URL_ENDE     => '2013-06-15',
                C::URL_AKTIV    => '1',
            ),
            array(
                C::INFO_ID      => '',
                C::INFO_USER_ID => '1',
                C::INFO_URL_ID  => '',
                C::URL_ADRESSE  => 'http://futhuer.de/ctv/live/infoscripte/HIT_2013/04.html',
                C::URL_START    => '2013-06-15',
                C::URL_ENDE     => '2013-06-15',
                C::URL_AKTIV    => '1',
            ),
            array(
                C::INFO_ID      => '',
                C::INFO_USER_ID => '1',
                C::INFO_URL_ID  => '',
                C::URL_ADRESSE  => 'http://futhuer.de/ctv/live/infoscripte/HIT_2013/06.html',
                C::URL_START    => '2013-06-15',
                C::URL_ENDE     => '2013-06-15',
                C::URL_AKTIV    => '1',
            ),
            array(
                C::INFO_ID      => '',
                C::INFO_USER_ID => '1',
                C::INFO_URL_ID  => '',
                C::URL_ADRESSE  => 'http://futhuer.de/ctv/live/infoscripte/HIT_2013/07.html',
                C::URL_START    => '2013-06-15',
                C::URL_ENDE     => '2013-06-15',
                C::URL_AKTIV    => '1',
            ),
            array(
                C::INFO_ID      => '',
                C::INFO_USER_ID => '1',
                C::INFO_URL_ID  => '',
                C::URL_ADRESSE  => 'http://futhuer.de/ctv/live/infoscripte/HIT_2013/08.html',
                C::URL_START    => '2013-06-15',
                C::URL_ENDE     => '2013-06-15',
                C::URL_AKTIV    => '1',
            ),
            array(
                C::INFO_ID      => '',
                C::INFO_USER_ID => '1',
                C::INFO_URL_ID  => '',
                C::URL_ADRESSE  => 'http://futhuer.de/ctv/live/infoscripte/fhs/fhs_news.php',
                C::URL_START    => '2000-01-01',
                C::URL_ENDE     => '2099-12-31',
                C::URL_AKTIV    => '1',
            ),
            array(
                C::INFO_ID      => '',
                C::INFO_USER_ID => '1',
                C::INFO_URL_ID  => '',
                C::URL_ADRESSE  => 'http://futhuer.de/ctv/live/infoscripte/Wetter/wetter.php',
                C::URL_START    => '2013-10-14',
                C::URL_ENDE     => '2099-10-14',
                C::URL_AKTIV    => '1',
            ),
                // </editor-fold>
        );

        $iHyd = $this->getService(C::SERVICE_HYDRATOR_MODEL_INFOSCRIPT);
        $uHyd = $this->getService(C::SERVICE_HYDRATOR_MODEL_URL);

        foreach ($set as $infArr) {

            $ifScr = $iHyd->hydrate($infArr, $this->getService(C::SERVICE_ENTITY_INFOSCRIPT));
            $ifScr->setUrl($uHyd->hydrate($infArr, $this->getService(C::SERVICE_ENTITY_URL)));
            
            $this->getService(C::SERVICE_INFOSCRIPT)->save($ifScr);
        }

        return new ViewModel(array('content' => __METHOD__));
    }

}
