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
        $content = __METHOD__;



        //beispiel infoscripte

        $infoscriptService = $this->getService(C::SERVICE_INFOSCRIPT);

        //hole nur 1 infoscript mit Id 1
        $infoscript = $infoscriptService->getById(3);

        $infoscript->setTitel('Mein toller InfoscriptTitel');

        $headline = "Liste Template";

        $titel = "Das ist der Titel";

        $text = "Hier kommt der Text <br> Text <br> Text";

        $liste = "<li>hier kommt eine liste von Daten</li>
          <li>nummer 2</li>
          <li>nummer 3</li>";

        return new ViewModel(
                array(
                  'content' => $content,
                  'infoscript' => $infoscript,
                  'headline' => $headline,
                  'titel' => $titel,
                  'text' => $text,
                  'liste' => $liste,
                ));
    }

    public function infoAction() {

        $infoscript = new \Base\Model\Entity\Infoscript();

        $infoscript
            ->setHeadLine("Info Headline")
            ->addColumn(new \Base\Model\Entity\Infoscript\Column("Info Title",
                      "<li>Zeile 1 Zeile 1 Zeile 1 Zeile 1 Zeile 1 Zeile 1 Zeile 1 Zeile 1 Zeile 1 Zeile </li>\n"
                    . "<li>Zeile 2  Zeile 2  Zeile 2  Zeile 2  Zeile 2  Zeile 2  Zeile 2  Zeile 2  Zeile 2 Zeile </li>\n"
                    . "<li>Zeile 3  Zeile 3  Zeile 3  Zeile 3  Zeile 3  Zeile 3  Zeile 3  Zeile 3  Zeile 3 Zeile </li>\n"
                    . "<li>Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4 Zeile </li>\n"
                    . "<li>Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4 Zeile </li>\n"
                    . "<li>Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4 Zeile </li>\n"
                    . "<li>Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4 Zeile </li>\n"
                    . "<li>Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4 Zeile </li>\n"
                    . "<li>Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4 Zeile </li>\n"
                    . "<li>Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4 Zeile </li>\n"
                    . "<li>Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4 Zeile </li>\n"
                    . "<li>Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4 Zeile </li>\n"

            )
        );

        return new ViewModel(
                [
                    'infoscript' => $infoscript,
                ]
            );
    }

    public function tabelleAction()
    {

//        $infoscript = new \Base\Model\Entity\Infoscript();
//
//        $infoscript
//            ->setHeadLine("Info Headline")
//            ->setDescription("Beschreibung Beschreibung Beschreibung Beschreibung Beschreibung Beschreibung "
//                    . "Beschreibung Beschreibung Beschreibung Beschreibung Beschreibung Beschreibung Beschreibung "
//                    . "Beschreibung Beschreibung Beschreibung Beschreibung Beschreibung Beschreibung Beschreibung "
//                    . "Beschreibung Beschreibung Beschreibung Beschreibung Beschreibung Beschreibung Beschreibung "
//                    . "Beschreibung Beschreibung Beschreibung Beschreibung Beschreibung Beschreibung Beschreibung "
//                    . "Beschreibung Beschreibung Beschreibung Beschreibung Beschreibung Beschreibung Beschreibung "
//                    . "Beschreibung Beschreibung Beschreibung Beschreibung Beschreibung Beschreibung Beschreibung "
//                    . "Beschreibung Beschreibung Beschreibung Beschreibung Beschreibung Beschreibung Beschreibung")
//            ->createColumn(
//                    "Info Title FIRST",
//
//                      "<li>Zeile 1 Zeile 1 Zeile 1 Zeile 1 Zeile 1 Zeile 1 Zeile 1 Zeile 1 Zeile 1 Zeile </li>\n"
//                    . "<li>Zeile 2  Zeile 2  Zeile 2  Zeile 2  Zeile 2  Zeile 2  Zeile 2  Zeile 2  Zeile 2 Zeile </li>\n"
//                    . "<li>Zeile 3  Zeile 3  Zeile 3  Zeile 3  Zeile 3  Zeile 3  Zeile 3  Zeile 3  Zeile 3 Zeile </li>\n"
//                    . "<li>Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4 Zeile </li>\n"
//                    . "<li>Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4 Zeile </li>\n",
//
//                  "Liste 1 Liste 1 Liste 1 Liste 1 Liste 1 Liste 1 Liste 1 Liste 1 Liste 1 Liste 1 Liste 1 Liste 1"
//                . " Liste 1 Liste 1 Liste 1 Liste 1 Liste 1 Liste 1 Liste 1 Liste 1 Liste 1 Liste 1 Liste 1 Liste 1"
//
//
//            )
//            ->createColumn(
//                    "Info Title SECOND",
//
//                      "<li>Zeile 1 Zeile 1 Zeile 1 Zeile 1 Zeile 1 Zeile 1 Zeile 1 Zeile 1 Zeile 1 Zeile </li>\n"
//                    . "<li>Zeile 2  Zeile 2  Zeile 2  Zeile 2  Zeile 2  Zeile 2  Zeile 2  Zeile 2  Zeile 2 Zeile </li>\n"
//                    . "<li>Zeile 3  Zeile 3  Zeile 3  Zeile 3  Zeile 3  Zeile 3  Zeile 3  Zeile 3  Zeile 3 Zeile </li>\n"
//                    . "<li>Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4 Zeile </li>\n"
//                    . "<li>Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4  Zeile 4 Zeile </li>\n",
//
//                      "Liste 1 Liste 1 Liste 1 Liste 1 Liste 1 Liste 1 Liste 1 Liste 1 Liste 1 Liste 1 Liste 1 Liste 1"
//                    . " Liste 1 Liste 1 Liste 1 Liste 1 Liste 1 Liste 1 Liste 1 Liste 1 Liste 1 Liste 1 Liste 1 Liste 1"
//
//            );

        $infoscript = $this->getServiceLocator()->get(C::SERVICE_INFOSCRIPT)->getById(2);


        return new ViewModel(
        [
            'infoscript' => $infoscript,
        ]);



    }
    public function bildAction()
    {
      $content = __METHOD__;

      $headline = "Bild Template";

      $bild = "http://press.tape.tv/wp-content/uploads/2013/02/Download.png";

      return new ViewModel(
              array(
                  'content' => $content,
                  'headline' => $headline,
                  'bild' => $bild,
              ));
    }

}
