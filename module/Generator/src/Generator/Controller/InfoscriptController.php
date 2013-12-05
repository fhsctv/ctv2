<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Generator\Controller;

use Zend\View\Model\ViewModel;

use Base\Constants as C;

class InfoscriptController extends AbstractController
{
    public function indexAction()
    {
        $id = $this->params()->fromRoute('id', null);

        if($id) {
            $infoscript = $this->getServiceLocator()->get(C::SERVICE_INFOSCRIPT)->getById($id);
        }
        else {
            $infoscript = $this->getServiceLocator()->get(C::SM_ENTITY_INFOSCRIPT);
            $infoscript->setHeadline('Kopfzeile');

            $text = 'Was bin ich eigentlich? Warum bin ich in der Index action? '
                    . 'bitte gebt mir einen namen und eine persönlichkeit ore magna '
                    . 'aliquyam erat, sed diam voluptua. At vero eos et accusam et '
                    . 'justo duo dolores et ea rebum. Stet clita kasd gubergren, no '
                    . 'sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem '
                    . 'sanctus est Lorem ipsum dolor sit amet. a met? klingt iwie bayrisch.'
                    . 'wurst leberkäs und aaa met';

            $list = '<li> das ist ein langer zweizeiliger listenpunkt, der voll der platzhirsch ist. '
                    . 'ganz schön lange stichpunkte müssen das sein.</li>'
                  . '<li> listenpunkt 2 </li>';

            $infoscript->createColumn('Komisch.. Der Text unter mir ist größer als '
                    . 'ich! Ich bin doch hier der Supertitel!', $text, $list);
        }


        return $this->disableLayout(new ViewModel(
        [
            'infoscript' => $infoscript,
        ]));
    }

    public function infoAction() {

        $id = $this->params()->fromRoute('id', null);

        if($id) {
            $infoscript = $this->getServiceLocator()->get(C::SERVICE_INFOSCRIPT)->getById($id);
        }
        else {
            $infoscript = $this->getServiceLocator()->get(C::SM_ENTITY_INFOSCRIPT);
            $infoscript->setHeadline('Kopfzeile');

            $text = 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed '
                    . 'diam nonumy eirmod tempor invidunt ut labore et dolore magna '
                    . 'aliquyam erat, sed diam voluptua. At vero eos et accusam et '
                    . 'justo duo dolores et ea rebum. Stet clita kasd gubergren, no '
                    . 'sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem '
                    . 'ipsum dolor sit amet, consetetur sadipscing elitr, sed diam '
                    . 'nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam '
                    . 'erat, sed diam voluptua. At vero eos et accusam et justo duo '
                    . 'dolores et ea rebum. Stet clita kasd gubergren, no sea takimata '
                    . 'sanctus est Lorem ipsum dolor sit amet.';
            $infoscript->createColumn('Titel des Infoscripts', $text);
        }


        return $this->disableLayout(new ViewModel(
        [
            'infoscript' => $infoscript,
        ]));
    }

    public function tabelleAction()
    {

        $id = $this->params()->fromRoute('id', null);

        if($id) {
            $infoscript = $this->getServiceLocator()->get(C::SERVICE_INFOSCRIPT)->getById($id);
        }
        else {
            $infoscript = $this->getServiceLocator()->get(C::SM_ENTITY_INFOSCRIPT);
            $infoscript->setHeadline('Kopfzeile');
            $infoscript->setDescription('Beschreibung Beschreibung Beschreibung '
                    . 'Beschreibung Beschreibung Beschreibung Beschreibung '
                    . 'Beschreibung Beschreibung Beschreibung Beschreibung Beschreibung');

            $text = 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed ' ;

            $list = '<li>da passen nur 2 einzeiler</li>'
                  . '<li>oder ein zweizeiler rein </li>'
                  . '<li>Box- Ende weg! </li>';

            $infoscript->createColumn('Titel Spalte 1', $text, $list);

            $infoscript->createColumn('Titel Spalte 2', $text, $list);
        }


        return $this->disableLayout(new ViewModel(
        [
            'infoscript' => $infoscript,
        ]));

    }

    public function bildAction()
    {
        $infoscript = new \Base\Model\Entity\Infoscript();
        $infoscript->setHeadLine('Bild Template');
        $infoscript->addPicture('http://press.tape.tv/wp-content/uploads/2013/02/Download.png');


        return $this->disableLayout(new ViewModel(
        [
            'infoscript' => $infoscript,
        ]));
    }

}
