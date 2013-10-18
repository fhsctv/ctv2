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

use Administration\Model\Entity;
use Administration\Service\Iterator\Filter\Url as Filter;

class AnzeigeController extends AbstractController {

    public function indexAction(){

        $content = __METHOD__;

        return new ViewModel(array('content' => $content));
    }


    public function showAction(){

        $anzeige = $this->getServiceLocator()->get('Administration\Table\Anzeige')->fetchAll(); //nur 1x iterierbar
        $anzeige->buffer(); //hole alle Anzeigee mit Hilfe des internen Cursors und puffere sie: heißt: mehrmals iterierbar

        return new ViewModel(
                array(
                    'current'  => new Filter\Current($anzeige),
                    'outdated' => new Filter\Outdated($anzeige),
                    'future'   => new Filter\Future($anzeige),
                )
        );

    }

    public function createAction(){

        $content = __METHOD__;


        $anzeigeArray = array(
            'fk_user_id' => 1,
            'url'        => 'http://hydr2.de',
            'start'      => '2013-10-01',
            'ende'       => '2013-10-10',
            'aktiv'      => '1',

        );



        $anzeigeHydrator = $this->getServiceLocator()->get('Administration\Mapper\Anzeige');
        $urlHydrator        = $this->getServiceLocator()->get('Administration\Mapper\Url');

        $anzeigeTable = $this->getServiceLocator()->get('Administration\Table\Anzeige');
        $urlTable        = $this->getServiceLocator()->get('Administration\Table\Url');

        $anzeige = $anzeigeHydrator->hydrate($anzeigeArray, new Entity\Anzeige());
        $url        = $urlHydrator->hydrate($anzeigeArray, new Entity\Url());

        $anzeige->setUrl($url);

        $urlId = $urlTable->save($url);
        $anzeige->setUrlId($urlId);

        $anzeigeTable->save($anzeige);

        var_dump($anzeige);

        return new ViewModel(array('content' => $content));

    }

    public function importAction(){

        $content = __METHOD__;

        $set = array (
            array(
                  'fk_user_id' => '1',
                  'start' => '2012-07-09',
                  'ende' => '2012-10-30',
                  'url' => 'http://futhuer.de/ctv/live/anzeigen/marcapoGmbH4ff43695d5d7d.html',
                  'aktiv' => '1',
                ),
            array(
                  'fk_user_id' => '1',
                  'start' => '2012-07-17',
                  'ende' => '2012-08-13',
                  'url' => 'http://futhuer.de/ctv/live/anzeigen/DatabaseCompetenceCenter50018bdeb1ac2.html',
                  'aktiv' => '1',
                ),
            array(
                  'fk_user_id' => '1',
                  'start' => '2012-07-30',
                  'ende' => '2012-08-26',
                  'url' => 'http://futhuer.de/ctv/live/anzeigen/JaussHRConsultingGmbH&Co.KG500ffedb0b1a0.html',
                  'aktiv' => '1',
                ),
            array(
                  'fk_user_id' => '1',
                  'start' => '2013-01-07',
                  'ende' => '2013-01-07',
                  'url' => 'http://futhuer.de/ctv/live/anzeigen/MAXIMATORGmbH50d0455ddd71d.html',
                  'aktiv' => '1',
                ),
            array(
                  'fk_user_id' => '1',
                  'start' => '2013-04-01',
                  'ende' => '2013-04-28',
                  'url' => 'http://futhuer.de/ctv/live/anzeigen/IngenieurbueroBauundAusruestungenGmbH5142f91de7167.html',
                  'aktiv' => '1',
                ),
            array(
                  'fk_user_id' => '1',
                  'start' => '2013-04-01',
                  'ende' => '2013-04-28',
                  'url' => 'http://futhuer.de/ctv/live/anzeigen/IngenieurbueroBauundAusruestungenGmbH5142fbd696591.html',
                  'aktiv' => '1',
                ),
            array(
                  'fk_user_id' => '1',
                  'start' => '2013-04-25',
                  'ende' => '2013-05-01',
                  'url' => 'http://futhuer.de/ctv/live/anzeigen/MAXIMATORGmbH5174ff58221f4.html',
                  'aktiv' => '1',
                ),
            array(
                  'fk_user_id' => '1',
                  'start' => '2013-07-24',
                  'ende' => '2013-09-18',
                  'url' => 'http://futhuer.de/ctv/live/anzeigen/FuThuer4ff4579e62128.html',
                  'aktiv' => '1',
                ),
        );

        $aHyd = $this->getServiceLocator()->get('Administration\Mapper\Anzeige');

        $aTbl = $this->getServiceLocator()->get('Administration\Table\Anzeige');
        $uTbl = $this->getServiceLocator()->get('Administration\Table\Url');

        foreach ($set as $anzArr) {

            $anzeige = $aHyd->hydrate($anzArr, new Entity\Anzeige());

            $uId = $uTbl->save($anzeige->getUrl());
            $anzeige->getUrl()->setId($uId);
            $iId = $aTbl->save($anzeige);

            var_dump($anzeige->getUrlId(), $uId, $iId);

        }






        return new ViewModel(array('content' => $content));

    }

}
