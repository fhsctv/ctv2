<?php

namespace Administration\Controller;

use Zend\View\Model\ViewModel;

use Base\Service\Iterator\Filter\Inserat as Filter;

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
                array('action' => self::ACTION_SHOW, 'id' => $this->params()->fromRoute('id', null)));


        // <editor-fold defaultstate="collapsed" desc="Beispiel für Weiterleitung mit Parametern">
        //        return $this->forward()->dispatch('Administration/Controller/Infoscript', array(
        //                'action' => 'index',
        //                'grml' => $infoscript
        //            )
        //        );
        // </editor-fold>
    }

    public function showAction() {

        $id = $this->params()->fromRoute('id', null);


        $service = $this->getServiceLocator()->get(C::SERVICE_INFOSCRIPT);

        $infoscript = null;

        if($id){
            $infoscript =  $service->getByUserId($id);
        } else {
            $infoscript = $service->fetchAll();
        }

        $actionUrls = [
            'details' => $this->url()->fromRoute(self::ROUTE, array('controller' => self::CONTROLLER, 'action' => self::ACTION_DETAILS)),
            'create'  => $this->url()->fromRoute(self::ROUTE, array('controller' => self::CONTROLLER, 'action' => self::ACTION_CREATE)),
            'edit'    => $this->url()->fromRoute(self::ROUTE, array('controller' => self::CONTROLLER, 'action' => self::ACTION_EDIT)),
            'delete'  => $this->url()->fromRoute(self::ROUTE, array('controller' => self::CONTROLLER, 'action' => self::ACTION_DELETE)),
        ];

        $viewModel = new ViewModel(
                array(
                    'actionUrls' => $actionUrls,

                    'messages'   => $this->flashMessenger(),

                    'current'    => new Filter\Current($infoscript),
                    'outdated'   => new Filter\Outdated($infoscript),
                    'future'     => new Filter\Future($infoscript),
                    'inactive'   => new Filter\Inactive($infoscript),
                )
        );

        $viewModel->setTemplate('/base/infoscript/show.phtml');

        return $viewModel;
    }

    public function createAction() {

        $service = $this->getService(C::SERVICE_INFOSCRIPT);
        $form    = $this->getService(C::SERVICE_FORM_INFOSCRIPT);

        $infoscript = $service->createInfoscriptFromForm($form, $this->getRequest());

        if (!$infoscript) {
            $viewModel = new ViewModel(['form' => $form]);

            return $viewModel->setTemplate('/base/infoscript/create');
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
            $viewModel = new ViewModel(array('form' => $form));

            return $viewModel->setTemplate('/base/infoscript/edit');
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

            $viewModel = new ViewModel (
                [
                    'form'       => $this->getService(C::SERVICE_FORM_DELETE),
                    'id'         => $id,
                    'urlDelete'  => $this->url()->fromRoute(self::ROUTE, array('controller' => self::CONTROLLER, 'action' => self::ACTION_DELETE, 'id' => $id)),
                    'infoscript' => $infoscript,
                ]
            );

            return $viewModel->setTemplate('/base/infoscript/delete.phtml');
        }

        $this->getService(C::SERVICE_INFOSCRIPT)->delete($infoscript, $this->getRequest(), $this->flashMessenger());

        return $this->simpleRedirectRoute(self::ROUTE, self::CONTROLLER, self::ACTION_INDEX);

    }

    public function detailsAction() {

        $id = (int) $this->params('id', NULL);

        if(!$id){
            return $this->simpleRedirectRoute(self::ROUTE, self::CONTROLLER, self::ACTION_INDEX);
        }

        $infoscript  = $this->getService(C::SERVICE_INFOSCRIPT)->getById($id);

        $bildschirmResultSet = $this->getServiceLocator()->get(C::SERVICE_TABLE_BILDSCHIRM)->fetchAll();

        $bildschirme = [];
        foreach ($bildschirmResultSet as $bildschirm) {
            array_push($bildschirme, $bildschirm);
        }

        /**
         * array
         */
        $addBildschirme = array_diff($bildschirme, $infoscript->getBildschirme());


        $actionUrls =
        [
            'delete' => $this->url()->fromRoute(self::ROUTE, ['controller' => self::CONTROLLER, 'action' => self::ACTION_DELETE_DISPLAY]),
            'add'    => $this->url()->fromRoute(self::ROUTE, ['controller' => self::CONTROLLER, 'action' => self::ACTION_ADD_DISPLAY]),
        ];

        $viewModel = new ViewModel(
            [
                'infoscript'  => $infoscript,
                'bildschirme' => $addBildschirme,

                'actionUrls'  => $actionUrls,

                'messages'   => $this->flashMessenger(),
            ]
        );

        return $viewModel->setTemplate('/base/infoscript/details.phtml');
    }


    //:TODO Auslagern in eigenen Display- Controller mit redirect GET Parameter
    public function deleteFromDisplayAction(){

        $inseratId    = (int) $this->params('id', null);
        $bildschirmId = (int) $this->params('display', null);

        if (!($inseratId && $bildschirmId)) {
            return $this->simpleRedirectRoute(self::ROUTE, self::CONTROLLER, self::ACTION_INDEX);
        }


        $this->getServiceLocator()->get(C::SERVICE_DISPLAYLINK)->delete($inseratId, $bildschirmId);

        $this->flashMessenger()->addSuccessMessage('Bildschirm erfolgreich entfernt!');

        return $this->redirect()->toRoute(self::ROUTE, ['controller' => self::CONTROLLER, 'action' => self::ACTION_DETAILS, 'id' => $inseratId]);
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

            //:FIXME Mapper anpassen, und mit Bilschirmobjekten arbeiten
            $ifScr->addBildschirm(1)->addBildschirm(2)->addBildschirm(3)->addBildschirm(4);

            try {
                $id = $iMapper->save($ifScr);
                $id = $id->getInseratId();

                $this->flashMessenger()->addSuccessMessage("Infoscript mit der Id $id erfolgreich importiert");
            }
            catch (\Exception $e) {

                if($e->getPrevious()->getCode() === '23505') {
                    $this->flashMessenger()->addErrorMessage("Das Infoscript ist bereits vorhanden");
                } else {
                    $this->flashMessenger()->addErrorMessage($e->getPrevious()->getMessage());
                }

            }
        }

        return $this->redirect()->toRoute(self::ROUTE, ['controller' => self::CONTROLLER, 'action' => self::ACTION_SHOW] );
    }
}
