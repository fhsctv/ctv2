<?php

namespace Fachhochschule\Form;
use Zend\Form;

class Liste extends Form\Form {
  /**
   * @var \Zend\Form\Element\Text
   */
  
  protected $headline;
  protected $titel;
  protected $text;
  protected $liste;
  protected $submit;

  public function __construct() {
    parent::__construct('Liste');
    $this->setAttribute('method', 'post');
    $this->setAttributes(array(
        'class' => 'form-horizontal',
    ));
            
    $this->add($this->getHeadline());
    $this->add($this->getTitel());
    $this->add($this->getText());
    $this->add($this->getListe());
    $this->add($this->getSubmit());
  }
  
  public function getHeadline() {
    if(!$this->headline) {
      $headline = new Form\Element\text('headline');
      $headline->setLabel('Headline: ')
              ->setAttributes(array(
                  'class' => 'form-control col-sm-2',
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
  
  public function getTitel() {
    if(!$this->titel){
      $titel = new Form\Element\Text('titel');
      $titel->setLabel('Titel: ')
              ->setAttributes(array(
                  'class' => 'col-sm-10 form-control',
                  'placeholder' => 'Das ist der Titel',
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
                  'class' => 'form-control col-sm-2',
                  'placeholder' => 'Hier kommt der Text <br>Text<br>Text'
              ));
      
      $this->setText($text);
    }
    return $this->text;
  }
  
  public function setText(\Zend\Form\Element\Textarea $text) {
    $this->text = $text;
    return $this;
  }
  
  public function getListe() {
    if(!$this->liste) {
      $liste = new Form\Element\Textarea('liste');
      $liste->setLabel('Liste: ')
              ->setAttributes(array(
                  'class' => 'form-control',
                  'placeholder' => 
                  '<li>Hier kommt eine liste von Daten </li>                                  
                   <li>nummer 2</li>                                                                        
                   <li>nummer 3</li>',
                  'rows' => '5',
              ));
      
      $this->setListe($liste);
    }
    return $this->liste;
  }
  
  public function setListe(\Zend\Form\Element\Textarea $liste) {
    $this->liste = $liste;
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



?>