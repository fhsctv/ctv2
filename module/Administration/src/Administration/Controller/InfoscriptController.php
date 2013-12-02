<?php

namespace Administration\Controller;

use Base\Constants as C;

class InfoscriptController extends AbstractController {

    const ROUTE                          = 'administration/default';
    const CONTROLLER                     = 'infoscript';
    const ACTION_SHOW                    = 'show';

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


    //:TODO Auslagern in eigenen Display- Controller mit redirect GET Parameter
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
                'headline' => 'Google News',
            ),
            array(
                'inserat_id'      => '',
                'fk_fh_id' => '1',
                'url'  => 'http://futhuer.de/ctv/live/infoscripte/sap2013/sap2013.html',
                'start'    => '2013-10-12',
                'ende'     => '2013-10-16',
                'aktiv'    => '1',
                'headline' => 'SAP',
            ),
            array(
                'inserat_id'      => '',
                'fk_fh_id' => '1',
                'url'  => 'http://futhuer.de/ctv/live/infoscripte/mensa/mensa_neu.php',
                'start'    => '2012-06-10',
                'ende'     => '2099-12-31',
                'aktiv'    => '1',
                'headline' => 'Mensa Heute',
            ),
            array(
                'inserat_id'      => '',
                'fk_fh_id' => '1',
                'url'  => 'http://futhuer.de/ctv/live/infoscripte/niederschlagsradar/wetter.php',
                'start'    => '2012-06-18',
                'ende'     => '2099-12-31',
                'aktiv'    => '1',
                'headline' => 'Niederschlagsradar',
            ),
            array(
                'inserat_id'      => '',
                'fk_fh_id' => '1',
                'url'  => 'http://futhuer.de/ctv/live/anzeigen/Willkommen/Willkommen.html',
                'start'    => '2013-10-07',
                'ende'     => '2013-10-16',
                'aktiv'    => '1',
                'headline' => 'Willkommen',
            ),
            array(
                'inserat_id'      => '',
                'fk_fh_id' => '1',
                'url'  => 'http://futhuer.de/ctv/live/infoscripte/HIT_2013/03.html',
                'start'    => '2013-06-15',
                'ende'     => '2013-06-15',
                'aktiv'    => '1',
                'headline' => 'Hochschul- Informationstag',
            ),
            array(
                'inserat_id'      => '',
                'fk_fh_id' => '1',
                'url'  => 'http://futhuer.de/ctv/live/infoscripte/HIT_2013/01.html',
                'start'    => '2013-06-15',
                'ende'     => '2013-06-15',
                'aktiv'    => '1',
                'headline' => 'Hochschul- Informationstag',
            ),
            array(
                'inserat_id'      => '',
                'fk_fh_id' => '1',
                'url'  => 'http://futhuer.de/ctv/live/infoscripte/HIT_2013/02.html',
                'start'    => '2013-06-15',
                'ende'     => '2013-06-15',
                'aktiv'    => '1',
                'headline' => 'Hochschul- Informationstag',
            ),
            array(
                'inserat_id'      => '',
                'fk_fh_id' => '1',
                'url'  => 'http://futhuer.de/ctv/live/infoscripte/HIT_2013/04.html',
                'start'    => '2013-06-15',
                'ende'     => '2013-06-15',
                'aktiv'    => '1',
                'headline' => 'Hochschul- Informationstag',
            ),
            array(
                'inserat_id'      => '',
                'fk_fh_id' => '1',
                'url'  => 'http://futhuer.de/ctv/live/infoscripte/HIT_2013/06.html',
                'start'    => '2013-06-15',
                'ende'     => '2013-06-15',
                'aktiv'    => '1',
                'headline' => 'Hochschul- Informationstag',
            ),
            array(
                'inserat_id'      => '',
                'fk_fh_id' => '1',
                'url'  => 'http://futhuer.de/ctv/live/infoscripte/HIT_2013/07.html',
                'start'    => '2013-06-15',
                'ende'     => '2013-06-15',
                'aktiv'    => '1',
                'headline' => 'Hochschul- Informationstag',
            ),
            array(
                'inserat_id'      => '',
                'fk_fh_id' => '1',

                'url'  => 'http://futhuer.de/ctv/live/infoscripte/HIT_2013/08.html',
                'start'    => '2013-06-15',
                'ende'     => '2013-06-15',
                'aktiv'    => '1',
                'headline' => 'Hochschul- Informationstag',
            ),
            array(
                'inserat_id'      => '',
                'fk_fh_id' => '1',
                'url'  => 'http://futhuer.de/ctv/live/infoscripte/fhs/fhs_news.php',
                'start'    => '2000-01-01',
                'ende'     => '2099-12-31',
                'aktiv'    => '1',
                'headline' => 'FHS News',
            ),
            array(
                'inserat_id'      => '',
                'fk_fh_id' => '1',
                'url'  => 'http://futhuer.de/ctv/live/infoscripte/Wetter/wetter.php',
                'start'    => '2013-10-14',
                'ende'     => '2099-10-14',
                'aktiv'    => '1',
                'headline' => 'Wetter',
            ),
            // </editor-fold>
        );

        $iHyd = $this->getService(C::SERVICE_HYDRATOR_MODEL_INFOSCRIPT);
        $iMapper = $this->getService(C::SERVICE_MAPPER_INFOSCRIPT);

        $displayTable     = $this->getServiceLocator()->get(C::SERVICE_TABLE_BILDSCHIRM);
        $displayResultSet = $displayTable->fetchAll()->buffer();

        foreach ($set as $infDataArr) {

            $infoscript = $iHyd->hydrate($infDataArr, $this->getService(C::SERVICE_ENTITY_INFOSCRIPT));

            //jedes infoscript bekommt alle bildschirme zugewiesen
            foreach ($displayResultSet as $display) {
                $infoscript->addBildschirm($display);
            }

            $infoscript->addColumn(new \Base\Model\Entity\Infoscript\Column($infoscript->getHeadLine() . ' Titel Col 1', $infoscript->getHeadLine() . ' Text Col 1'));
            $infoscript->addColumn(new \Base\Model\Entity\Infoscript\Column($infoscript->getHeadLine() . ' Titel Col 2', $infoscript->getHeadLine() . ' Text Col 2'));


            try {
                $info = $iMapper->save($infoscript);
                $id = $info->getInseratId();

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
