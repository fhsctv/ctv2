<?php

namespace Fachhochschule\Form;
use Zend\Form;

class Tabelle extends Form\Form {
  /**
   * @var \Zend\Form\Element\Text
   */
  
  protected $headline;
  protected $titel_left;
  protected $titel_right;
  protected $text_left;
  protected $text_right;
  protected $submit;


  public function __construct() {
    parent::__construct('Tabelle');
    $this->setAttributes(array(
        'method' => 'post',
        'class' => 'form-horizontal',
    ));
    
    
    $this->add($this->getHeadline());
    $this->add($this->getTitel_left());
    $this->add($this->getTitel_right());
    $this->add($this->getText_left());
    $this->add($this->getText_right());
    $this->add($this->getSubmit());
  }
  
    /**
   * @return \Zend\Form\Element\Text
   */
  
  public function getHeadline() {
    if(!$this->headline) {
      $headline = new Form\Element\text('headline');
      $headline->setLabel('Headline: ')
              ->setAttributes(array(
                  'class' => 'form-control',
                  'placeholder' => 'Liste Template',
              ));
      
      $this->setHeadline($headline);
    }
    return $this->headline;
  }
  
  public function setHeadline(\Zend\Form\Element\Text $headline) {
    $this->headline = $headline;
    return $this;
  }
  
  public function getTitel_left() {
    if(!$this->titel_left){
      $titel_left = new Form\Element\Text('titel_left');
      $titel_left->setLabel('Titel Links: ')
              ->setAttributes(array(
                  'class' => 'form-control',
                  'placeholder' => 'Linker Titel',
              ));
      
      $this->setTitel_left($titel_left);
    }
    return $this->titel_left;
  }
  
  public function setTitel_left(\Zend\Form\Element\Text $titel_left) {
    $this->titel_left = $titel_left;
    return $this;
  }
  
  public function getTitel_right() {
    
    if(!$this->titel_right){
      $titel_right = new Form\Element\Text('titel_right');
      $titel_right->setLabel('Titel Rechts: ')
              ->setAttributes(array(
                  'class' => 'form-control',
                  'placeholder' => 'Rechter Titel',
              ));
      
      $this->setTitel_right($titel_right);
    }
    return $this->titel_right;
  }
  
  public function setTitel_right(\Zend\Form\Element\Text $titel_right) {
    $this->titel_right = $titel_right;
    return $this;
  }
  
  public function getText_left() {
    if(!$this->text_left){
      $text_left = new Form\Element\Textarea('text_left');
      $text_left->setLabel('Text Links: ')
              ->setAttributes(array(
                  'class' => 'form-control',
                  'placeholder' => 'Linker Text <br> neue Zeile',
              ));
      
      $this->setText_left($text_left);
    }
    return $this->text_left;
  }
  
  public function setText_left(\Zend\Form\Element\Textarea $text_left) {
    $this->text_left = $text_left;
    return $this;
  }
  
  public function getText_right() {
    
    if(!$this->text_right){
      $text_right = new Form\Element\Textarea('text_right');
      $text_right->setLabel('Text Rechts: ')
              ->setAttributes(array(
                  'class' => 'form-control',
                  'placeholder' => 'Rechter Text <br> neue Zeile',
              ));
      
      $this->setText_right($text_right);
    }
    return $this->text_right;
  }
  
  public function setText_right(\Zend\Form\Element\Textarea $text_right) {
    $this->text_right = $text_right;
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



