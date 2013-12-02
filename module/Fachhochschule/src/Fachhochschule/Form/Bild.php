<?php

namespace Fachhochschule\Form;
use Zend\Form;

class Bild extends Form\Form {
  /**
   * @var \Zend\Form\Element\Text
   */
  
  protected $headline;
  protected $bild;
  protected $submit;


  public function __construct() {
    parent::__construct('Bild');
    
    $this->setAttributes(array(
        'method' => 'post',
        'class' => 'form-horizontal',
    ));
    
    $this->add($this->getHeadline());
    $this->add($this->getBild());
    $this->add($this->getSubmit());
  }
  
  public function getHeadline() {
    if(!$this->headline) {
      $headline = new Form\Element\text('headline');
      $headline->setLabel('Headline: ')
              ->setAttributes(array(
                  'class' => 'form-control',
                  'placeholder' => 'Bild Template',
              ));
      
      $this->setHeadline($headline);
    }
    return $this->headline;
  }
  
  public function setHeadline(\Zend\Form\Element\Text $headline) {
    $this->headline = $headline;
    return $this;
  }
  
  public function getBild() {
    if(!$this->bild) {
      $bild = new Form\Element\text('bild');
      $bild->setLabel('Bild Url: ')
              ->setAttributes(array(
                  'class' => 'form-control',
                  'placeholder' => 'http://link.de/Bild.jpg',
              ));
      
      $this->setBild($bild);
    }
    return $this->bild;
  }
  
  public function setBild(\Zend\Form\Element\Text $bild) {
    $this->bild = $bild;
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



?>