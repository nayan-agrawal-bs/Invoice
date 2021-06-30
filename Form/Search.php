<?php

class Invoice_Form_Search extends Engine_Form
{
  public function init()
  {
    $this
      ->setAttribs(array(
        'id' => 'filter_form',
        'class' => 'global_form_box',
      ))
      ->setAction(Zend_Controller_Front::getInstance()->getRouter()->assemble(array()))
      ->setMethod('GET')
      ;
    
    $this->addElement('Text', 'search', array(
      'label' => 'Invoice Number',
    ));

    $this->addElement('Text', 'email', array(
      'label' => 'Customer Email',
    ));

    $this->addElement('Select', 'category', array(
      'label' => 'Domain',
      'multiOptions' => array(
        '0' => 'All Categories',
      ),
      'onchange' => 'this.form.submit();',
    ));

    $this->addElement('Select', 'status', array(
      'label' => 'Payment Status',
      'multiOptions' => array(
        '0' => 'Pending',
        '1' => 'Paid',
      ),
      'onchange' => 'this.form.submit();',
    ));

    $this->addElement('Button', 'find', array(
      'type' => 'submit',
      'label' => 'Search',
      'ignore' => true,
      'order' => 10000001,
    ));


    // Populate category
    $categories = Engine_Api::_()->getDbtable('categories', 'invoice')->getCategoriesAssoc();
    if( !empty($categories) && is_array($categories) ) {
      $this->category->addMultiOptions($categories);
    }
    
  }
}
