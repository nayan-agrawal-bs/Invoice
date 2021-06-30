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



    $this->addElement('Text', 'invoice_bname', array(
      'label' => 'Bank Name',
      'value' => Engine_Api::_()->getApi('settings', 'core')->getSetting('invoice.bname', "HDFC"),
    ));

    $this->addElement('Text', 'invoice_baddress', array(
      'label' => 'Bank Address',
      'value' => Engine_Api::_()->getApi('settings', 'core')->getSetting('invoice.baddress', "C&&"),
    ));

    $this->addElement('Text', 'invoice_baccnumber', array(
      'label' => 'Bank Acc. No.',
      'value' => Engine_Api::_()->getApi('settings', 'core')->getSetting('invoice.baccnumber', 9887954625),
    ));

    $this->addElement('Text', 'invoice_baccname', array(
      'label' => 'Bank Acc. Name',
      'value' => Engine_Api::_()->getApi('settings', 'core')->getSetting('invoice.baccname', "bstep"),
    ));

    $this->addElement('Text', 'invoice_ifsc', array(
      'label' => 'Bank IFSC code',
      'value' => Engine_Api::_()->getApi('settings', 'core')->getSetting('invoice.ifsc', 'HDFC0088'),
    ));

    $this->addElement('Text', 'invoice_cname', array(
      'label' => 'Company Name',
      'value' => Engine_Api::_()->getApi('settings', 'core')->getSetting('invoice.cname', "BIG STEP"),
    ));

    $this->addElement('Text', 'invoice_cnum', array(
      'label' => 'Company Contact No.',
      'value' => Engine_Api::_()->getApi('settings', 'core')->getSetting('invoice.cnum', 1234569870),
    ));

    $this->addElement('Text', 'invoice_caddress', array(
      'label' => 'Company Address',
      'value' => Engine_Api::_()->getApi('settings', 'core')->getSetting('invoice.caddress', "XYZ"),
    ));


    $this->addElement('Text', 'invoice_gstno', array(
      'label' => 'GST No.',
      'value' => Engine_Api::_()->getApi('settings', 'core')->getSetting('invoice.gstno', 434343434),
    ));

    // Add submit button
    $this->addElement('Button', 'submit', array(
      'label' => 'Save Changes',
      'type' => 'submit',
      'ignore' => true
    ));
  }
}
