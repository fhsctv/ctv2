<?php

namespace Administration\Controller;

use Zend\View\Model\ViewModel;

use Administration\Model\Entity;
use Administration\Form\Form;
use Administration\Service\Iterator\Filter\Url as Filter;

class InfoscriptController extends AbstractController {

    public function indexAction(){

        $content = __METHOD__;

        $iTgw = $this->getServiceLocator()->get('Administration\Table\Infoscript');
        var_dump($iTgw->fetchAll()->toArray());
        
        
        
        return new ViewModel(array('content' => $content));
    }


    public function showAction(){

        $infoscript = $this->getServiceLocator()->get('Administration\Table\Infoscript')->fetchAll(); //nur 1x iterierbar
        $infoscript->buffer(); //hole alle Infoscripte mit Hilfe des internen Cursors und puffere sie: heißt: mehrmals iterierbar

        
        return new ViewModel(
                array(
                    'current'  => new Filter\Current($infoscript),
                    'outdated' => new Filter\Outdated($infoscript),
                    'future'   => new Filter\Future($infoscript),
                )
        );

    }

    public function createAction(){

        $content = __METHOD__;

        $form = new Form\Infoscript();
        
        var_dump('Post', $this->getRequest()->getPost());
        
        var_dump('$form->setData()');        
        $form->setData($this->getRequest()->getPost());
        
        $form->isValid();
        
        var_dump('$form->getData()', $form->getData());
        
        return new ViewModel(array(
                'content' => $content,
                'form' => $form,
            )
        );

    }

    public function importAction(){

        $content = __METHOD__;

        $set = array(
            // <editor-fold defaultstate="collapsed" desc="set">
            array(
                'fk_user_id' => '1'
                , 'url' => 'http://futhuer.de/ctv/live/infoscripte/googlenews/news_check.php'
                , 'start' => '2012-06-18'
                , 'ende' => '2099-12-31'
                , 'aktiv' => '1'
            ),
            array(
                'fk_user_id' => '1'
                , 'url' => 'http://futhuer.de/ctv/live/infoscripte/sap2013/sap2013.html'
                , 'start' => '2013-10-12'
                , 'ende' => '2013-10-16'
                , 'aktiv' => '1'
            ),
            array(
                'fk_user_id' => '1'
                , 'url' => 'http://futhuer.de/ctv/live/infoscripte/mensa/mensa_neu.php'
                , 'start' => '2012-06-10'
                , 'ende' => '2099-12-31'
                , 'aktiv' => '1'
            ),
            array(
                'fk_user_id' => '1'
                , 'url' => 'http://futhuer.de/ctv/live/infoscripte/niederschlagsradar/wetter.php'
                , 'start' => '2012-06-18'
                , 'ende' => '2099-12-31'
                , 'aktiv' => '1'
            ),
            array(
                'fk_user_id' => '1'
                , 'url' => 'http://futhuer.de/ctv/live/anzeigen/Willkommen/Willkommen.html'
                , 'start' => '2013-10-07'
                , 'ende' => '2013-10-16'
                , 'aktiv' => '1'
            ),
            array(
                'fk_user_id' => '1'
                , 'url' => 'http://futhuer.de/ctv/live/infoscripte/HIT_2013/03.html'
                , 'start' => '2013-06-15'
                , 'ende' => '2013-06-15'
                , 'aktiv' => '1'
            ),
            array(
                'fk_user_id' => '1'
                , 'url' => 'http://futhuer.de/ctv/live/infoscripte/HIT_2013/01.html'
                , 'start' => '2013-06-15'
                , 'ende' => '2013-06-15'
                , 'aktiv' => '1'
            ),
            array(
                'fk_user_id' => '1'
                , 'url' => 'http://futhuer.de/ctv/live/infoscripte/HIT_2013/02.html'
                , 'start' => '2013-06-15'
                , 'ende' => '2013-06-15'
                , 'aktiv' => '1'
            ),
            array(
                'fk_user_id' => '1'
                , 'url' => 'http://futhuer.de/ctv/live/infoscripte/HIT_2013/04.html'
                , 'start' => '2013-06-15'
                , 'ende' => '2013-06-15'
                , 'aktiv' => '1'
            ),
            array(
                'fk_user_id' => '1'
                , 'url' => 'http://futhuer.de/ctv/live/infoscripte/HIT_2013/06.html'
                , 'start' => '2013-06-15'
                , 'ende' => '2013-06-15'
                , 'aktiv' => '1'
            ),
            array(
                'fk_user_id' => '1'
                , 'url' => 'http://futhuer.de/ctv/live/infoscripte/HIT_2013/07.html'
                , 'start' => '2013-06-15'
                , 'ende' => '2013-06-15'
                , 'aktiv' => '1'
            ),
            array(
                'fk_user_id' => '1'
                , 'url' => 'http://futhuer.de/ctv/live/infoscripte/HIT_2013/08.html'
                , 'start' => '2013-06-15'
                , 'ende' => '2013-06-15'
                , 'aktiv' => '1'
            ),
            array(
                'fk_user_id' => '1'
                , 'url' => 'http://futhuer.de/ctv/live/infoscripte/fhs/fhs_news.php'
                , 'start' => '2000-01-01'
                , 'ende' => '2099-12-31'
                , 'aktiv' => '1'
            ),
            array(
                'fk_user_id' => '1'
                , 'url' => 'http://futhuer.de/ctv/live/infoscripte/Wetter/wetter.php'
                , 'start' => '2013-10-14'
                , 'ende' => '2099-10-14'
                , 'aktiv' => '1'
            )// </editor-fold>
        );

        $iHyd = $this->getServiceLocator()->get('Administration\Mapper\Infoscript');

        $iTbl = $this->getServiceLocator()->get('Administration\Table\Infoscript');
        $uTbl = $this->getServiceLocator()->get('Administration\Table\Url');

        foreach ($set as $infArr) {

            $ifScr = $iHyd->hydrate($infArr, new Entity\Infoscript());

            $uId = $uTbl->save($ifScr->getUrl());
            $ifScr->getUrl()->setId($uId);
            $iId = $iTbl->save($ifScr);

            var_dump($ifScr->getUrlId(), $uId, $iId);

        }

        return new ViewModel(array('content' => $content));

    }

}
