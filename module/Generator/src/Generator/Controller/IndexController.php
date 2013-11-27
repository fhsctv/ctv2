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

class IndexController extends AbstractController
{
    public function indexAction()
    {
        $content = __METHOD__;


        
        //beispiel infoscripte
        
        $infoscriptService = $this->getService(C::SERVICE_INFOSCRIPT);
        
        //hole nur 1 infoscript mit Id 1
        $infoscript = $infoscriptService->getById(1);
        
        $infoscript->setTitel('Mein toller InfoscriptTitel');
        
        $headline = "Liste Template";
        
        $titel = "Das ist der Titel";
        
        $text = "Hier kommt der Text <br> Text <br> Text";
        
        $liste = "<li>hier kommt eine liste von Daten</li>
          <li>nummer 2</li>
          <li>nummer 3</li>";
        
        return $this->disableLayout( new ViewModel(
                array(
                  'content' => $content,
                  'infoscript' => $infoscript,
                  'headline' => $headline,
                  'titel' => $titel,
                  'text' => $text,
                  'liste' => $liste,
                )));
    }
    
    
    public function listeAction()
    {
        $content = __METHOD__;


        
        //beispiel infoscripte
        
        $infoscriptService = $this->getService(C::SERVICE_INFOSCRIPT);
        
        //hole nur 1 infoscript mit Id 1
        $infoscript = $infoscriptService->getById(1);
        
        $infoscript->setTitel('Mein toller InfoscriptTitel');
        
        $headline = "Liste Template";
        
        $titel = "Das ist der Titel";
        
        $text = "Hier kommt der Text <br> Text <br> Text";
        
        $liste = "<li>hier kommt eine liste von Daten</li>
          <li>nummer 2</li>
          <li>nummer 3</li>";
        
        return $this->disableLayout(new ViewModel(
                array(
                  'content' => $content,
                  'infoscript' => $infoscript,
                  'headline' => $headline,
                  'titel' => $titel,
                  'text' => $text,
                  'liste' => $liste,
                )));
    }
    
    public function infoAction()
    {
      
      $info_headline = "info Template";
      
      $info_titel = "Hier kommt der Titel";
      
      $info_text = "Hier kommt der Text <br> bla bla <br> text";
      
      return $this->disableLayout( new ViewModel(
              array(
                  'headline' => $info_headline,
                  'titel' => $info_titel,
                  'text'  => $info_text,
              )));
    }
    
    public function tabelleAction()
    {
      $content = __METHOD__;
      
      $headline = "Tabelle Template";
      
      $titel_left = "Hier kommt der Titel";
      
      $text_left = "Hier kommt der Text <br> bla bla <br> text";
      
      $titel_right = "Hier kommt der Titel";
      
      $text_right = "Hier kommt der Text <br> bla bla <br> text";
      
      $discription = "Hier steht die Beschreibung etz.";
      
      return $this->disableLayout( new ViewModel(
              array(
                  'content' => $content,
                  'headline' => $headline,
                  'titel_left' => $titel_left,
                  'text_left'  => $text_left,
                  'titel_right' => $titel_right,
                  'text_right'  => $text_right,
                  'discription' => $discription,
              )));
    }
    public function bildAction()
    {
      $content = __METHOD__;
      
      $headline = "Bild Template";
      
      $bild = "http://press.tape.tv/wp-content/uploads/2013/02/Download.png";
      
      return $this->disableLayout( new ViewModel(
              array(
                  'content' => $content,
                  'headline' => $headline,
                  'bild' => $bild,
              )));
    }

}
