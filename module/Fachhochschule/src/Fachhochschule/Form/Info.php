<?php

namespace Fachhochschule\Form;

use Zend\Form;

class Info extends Form\Form {
  
  /**
   *
   * @var \Zend\Form\Element\Text
   */
  protected $titel;
  protected $headline;
  protected $text;
  protected $submit;
  
  public function __construct() {
    
    parent::__construct('Info');
    $this->setAttributes(array(
            'method'=> 'post',
            'class' => 'form-horizontal',));
    
    $this->add($this->getHeadline());
    $this->add($this->getTitel());
    $this->add($this->getText());
    $this->add($this->getSubmit());
    
  }
  
  //autogenerierung von gettern und settern mit tastenkombi alt + einfg
  //besser geht die autogenerierung noch, wenn man vorher doku geschrieben hat
  //die doc- blocks helfen netbeans bei der autovervollständigung
  
  
  
  /**
   * 
   * @return \Zend\Form\Element\Text
   */
  
  public function getHeadline() {
    if(!$this->headline) {
      $headline = new Form\Element\Text('headline');
      $headline->setLabel('Headline: ')
              ->setAttributes(array(
                  'class' => 'form-control',
                  'placeholder' => 'info Template',
              ));
      
      $this->setHeadline($headline);
    }
    return $this->headline;
  }
  
  public function setHeadline(\Zend\Form\Element\Text $headline) {
    $this->headline = $headline;
    return $this;
  }
  
  public function getTitel() {
    
    if(!$this->titel){
      $titel = new Form\Element\Text('titel');
      $titel->setLabel('Titel: ')
              ->setAttributes(array(
                  'class' => 'form-control',
                  'placeholder' => 'Hier komt der Titel',
              ));
      
      $this->setTitel($titel);
      
    }
    
    return $this->titel;
  }
  
  public function setTitel(\Zend\Form\Element\Text $titel) {
    $this->titel = $titel;
    return $this;
  }
  
  public function getText() {
    if(!$this->text) {
      $text = new Form\Element\Textarea('text');
      $text->setLabel('Text: ')
              ->setAttributes(array(
                  'class' => 'form-control',
                  'rows' => '6',
                  'placeholder' => 'Hier kommt der Text<br>nächste zeile',
              ));
      
      $this->setText($text);
    }
    return $this->text;
  }
  
  public function setText(\Zend\Form\Element\Textarea $text) {
    $this->text = $text;
    return $this;
  }
  
  public function getSubmit() {
    if(!$this->submit) {
      $submit = new Form\Element\Submit('submit');
      $submit->setValue('Speichern')
              ->setAttributes(array(
                  'class' => 'btn btn-default',
              ))
              ->setLabel(' ');
              $this->setSubmit($submit);
    }
    return $this->submit;
  }
  
  public function setSubmit(\Zend\Form\Element\Submit $submit) {
    $this->submit = $submit;
    return $this;
  }


  
}