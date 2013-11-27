<?php

namespace Fachhochschule\Form;

use Zend\Form;

class Info extends Form\Form {
  
  /**
   *
   * @var \Zend\Form\Element\Text
   */
  protected $titel;
  
  public function __construct() {
    
    parent::__construct('Info');
    
    $this->add($this->getTitel());
  }
  
  //autogenerierung von gettern und settern mit tastenkombi alt + einfg
  //besser geht die autogenerierung noch, wenn man vorher doku geschrieben hat
  //die doc- blocks helfen netbeans bei der autovervollständigung
  
  
  
  /**
   * 
   * @return \Zend\Form\Element\Text
   */
  public function getTitel() {
    
    if(!$this->titel){
      $titel = new Form\Element\Text('titel');
      $titel->setLabel('Titel: ');
      
      $this->setTitel($titel);
      
    }
    
    return $this->titel;
  }

  public function setTitel(\Zend\Form\Element\Text $titel) {
    $this->titel = $titel;
    return $this;
  }




  
}