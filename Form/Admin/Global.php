<?php

class Invoice_Form_Admin_Global extends Engine_Form
{
  public function init()
  {

    $this
      ->setTitle('Global Settings')
      ->setDescription('These settings affect all members in your community.');
/*
    $this->addElement('Radio', 'blog_public', array(
      'label' => 'Public Permissions',
      'description' => "BLOG_FORM_ADMIN_GLOBAL_BLOGPUBLIC_DESCRIPTION",
      'multiOptions' => array(
        1 => 'Yes, the public can view blogs unless they are made private.',
        0 => 'No, the public cannot view blogs.'
      ),
      'value' => Engine_Api::_()->getApi('settings', 'core')->getSetting('blog.public', 1),
    ));
*/
    $this->addElement('Text', 'invoice_page', array(
      'label' => 'Entries Per Page',
      'description' => 'How many invoice entries will be shown per page? (Enter a number between 1 and 999)',
      'value' => Engine_Api::_()->getApi('settings', 'core')->getSetting('invoice.page', 10),
    ));

    $this->addElement('Text', 'invoice_SGST', array(
      'label' => 'SGST %',
      'value' => Engine_Api::_()->getApi('settings', 'core')->getSetting('invoice.SGST', 9),
    ));
    
    $this->addElement('Text', 'invoice_CGST', array(
      'label' => 'SGST %',
      'value' => Engine_Api::_()->getApi('settings', 'core')->getSetting('invoice.CGST', 9),
    ));


    $this->addElement('Text', 'invoice_IGST', array(
      'label' => 'IGST %',
      'value' => Engine_Api::_()->getApi('settings', 'core')->getSetting('invoice.IGST', 18),
    ));

    $this->addElement('Text', 'invoice_USDtoINR', array(
      'label' => 'USDtoINR',
      'description' => 'Enter the conversion rate of 1 USD to INR',
      'value' => Engine_Api::_()->getApi('settings', 'core')->getSetting('invoice.USDtoINR', 75),
    ));



    // Add submit button
    $this->addElement('Button', 'submit', array(
      'label' => 'Save Changes',
      'type' => 'submit',
      'ignore' => true
    ));
  }
}
