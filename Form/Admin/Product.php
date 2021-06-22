<?php

class Invoice_Form_Admin_Product extends Engine_Form
{
  protected $_field;

  public function init()
  {
    $this
      ->setMethod('post')
      ->setAttrib('class', 'global_form_box')
      ;

    /*
    $type = new Zend_Form_Element_Hidden('type');
    $type->setValue('heading');
    */

    $label = new Zend_Form_Element_Text('label');
    $label->setLabel('Product Name')
      ->addValidator('NotEmpty')
      ->setRequired(true)
      ->setAttrib('class', 'text');

    $price = new Zend_Form_Element_Text('price');
    $price->setLabel('Price')
      ->addValidator('NotEmpty')
      ->setRequired(true)
      ->setAttrib('class', 'numer');

    $id = new Zend_Form_Element_Hidden('id');

    $categories = Engine_Api::_()->getDbtable('categories', 'invoice')->getCategoriesAssoc();
    $categoryMultiOptions = array(0 => ' ');
    foreach ($categories as $key => $value) {
      $categoryMultiOptions[$key] = $value;
    }

    $category_id = new Zend_Form_Element_Select('category_id');
    $category_id
      ->setLabel('Domain')
      ->setMultiOptions($categoryMultiOptions)
      ->addValidator('NotEmpty')
      ->setRequired(true);

    

    $this->addElements(array(
      //$type,
      $label,
      $price,
      $category_id,
      $id
    ));
    
    // Buttons
    $this->addElement('Button', 'submit', array(
      'label' => 'Add Product',
      'type' => 'submit',
      'ignore' => true,
      'decorators' => array('ViewHelper')
    ));

    $this->addElement('Cancel', 'cancel', array(
      'label' => 'cancel',
      'link' => true,
      'prependText' => ' or ',
      'href' => '',
      'onClick'=> 'javascript:parent.Smoothbox.close();',
      'decorators' => array(
        'ViewHelper'
      )
    ));
    $this->addDisplayGroup(array('submit', 'cancel'), 'buttons');
    $button_group = $this->getDisplayGroup('buttons');


  }

  public function setField($product)
  {
    $this->_field = $product;

    // Set up elements
    //$this->removeElement('type');
    $this->label->setValue($product->product_name);
    $this->price->setValue($product->product_price);
    $this->category_id->setValue($product->category_id);
    $this->id->setValue($product->product_id);
    $this->submit->setLabel('Edit Category');

    // @todo add the rest of the parameters
  }
}
