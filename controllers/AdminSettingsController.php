<?php

class Invoice_AdminSettingsController extends Core_Controller_Action_Admin
{
  public function indexAction()
  {
    $this->view->navigation = $navigation = Engine_Api::_()->getApi('menus', 'core')
      ->getNavigation('invoice_admin_main', array(), 'invoice_admin_main_settings');

    $this->view->form  = $form = new Invoice_Form_Admin_Global();
    
    if( $this->getRequest()->isPost() && $form->isValid($this->_getAllParams()) )
    {
      $values = $form->getValues();

      foreach ($values as $key => $value){
        Engine_Api::_()->getApi('settings', 'core')->setSetting($key, $value);
      }
      $form->addNotice('Your changes have been saved.');
    }
  }

  public function categoriesAction()
  {
    $this->view->navigation = $navigation = Engine_Api::_()->getApi('menus', 'core')
      ->getNavigation('invoice_admin_main', array(), 'invoice_admin_main_categories');

    $this->view->categories = Engine_Api::_()->getItemTable('invoice_category')->fetchAll();
  }

  

  
  public function addCategoryAction()
  {
    // In smoothbox
    $this->_helper->layout->setLayout('admin-simple');

    // Generate and assign form
    $form = $this->view->form = new Invoice_Form_Admin_Category();
    $form->setAction($this->view->url(array()));
    
    
    
    // Check post
    if( !$this->getRequest()->isPost() ) {
      $this->renderScript('admin-settings/form.tpl');
      return;
    }
    if( !$form->isValid($this->getRequest()->getPost()) ) {
      $this->renderScript('admin-settings/form.tpl');
      return;
    }
    
    
    // Process
    $values = $form->getValues();

    $categoryTable = Engine_Api::_()->getItemTable('invoice_category');
    $db = $categoryTable->getAdapter();
    $db->beginTransaction();

    $viewer = Engine_Api::_()->user()->getViewer();
    
    try {
      $categoryTable->insert(array(
        'user_id' => $viewer->getIdentity(),
        'category_name' => $values['label'],
      ));

      $db->commit();
    } catch( Exception $e ) {
      $db->rollBack();
      throw $e;
    }

    return $this->_forward('success', 'utility', 'core', array(
      'smoothboxClose' => 10,
      'parentRefresh'=> 10,
      'messages' => array('')
    ));
  }

  public function deleteCategoryAction()
  {
    // In smoothbox
    $this->_helper->layout->setLayout('admin-simple');
    $category_id = $this->_getParam('id');
    $this->view->invoice_id = $this->view->category_id = $category_id;
    $categoriesTable = Engine_Api::_()->getDbtable('categories', 'invoice');
    $category = $categoriesTable->find($category_id)->current();
    
    if( !$category ) {
      return $this->_forward('success', 'utility', 'core', array(
        'smoothboxClose' => 10,
        'parentRefresh'=> 10,
        'messages' => array('')
      ));
    } else {
      $category_id = $category->getIdentity();
    }
    
    if( !$this->getRequest()->isPost() ) {
      // Output
      $this->renderScript('admin-settings/delete.tpl');
      return;
    }
    
    // Process
    $db = $categoriesTable->getAdapter();
    $db->beginTransaction();
    
    try {
      
      $category->delete();
      
      $invoiceTable = Engine_Api::_()->getDbtable('invoices', 'invoice');
      $invoiceTable->update(array(
        'category_id' => 0,
      ), array(
        'category_id = ?' => $category_id,
      ));
      
      $db->commit();
    } catch( Exception $e ) {
      $db->rollBack();
      throw $e;
    }
    
    return $this->_forward('success', 'utility', 'core', array(
      'smoothboxClose' => 10,
      'parentRefresh'=> 10,
      'messages' => array('')
    ));
  }

  public function editCategoryAction()
  {
    // In smoothbox
    $this->_helper->layout->setLayout('admin-simple');
    $category_id = $this->_getParam('id');
    $this->view->invoice_id = $this->view->category_id = $category_id;
    $categoriesTable = Engine_Api::_()->getDbtable('categories', 'invoice');
    $category = $categoriesTable->find($category_id)->current();
    
    if( !$category ) {
      return $this->_forward('success', 'utility', 'core', array(
        'smoothboxClose' => 10,
        'parentRefresh'=> 10,
        'messages' => array('')
      ));
    } else {
      $category_id = $category->getIdentity();
    }
    
    $form = $this->view->form = new Invoice_Form_Admin_Category();
    $form->setAction($this->getFrontController()->getRouter()->assemble(array()));
    $form->setField($category);
    
    if( !$this->getRequest()->isPost() ) {
      // Output
      $this->renderScript('admin-settings/form.tpl');
      return;
    }
    
    if( !$form->isValid($this->getRequest()->getPost()) ) {
      // Output
      $this->renderScript('admin-settings/form.tpl');
      return;
    }
    
    // Process
    $values = $form->getValues();
    
    $db = $categoriesTable->getAdapter();
    $db->beginTransaction();
    
    try {
      $category->category_name = $values['label'];
      $category->save();
      
      $db->commit();
    } catch( Exception $e ) {
      $db->rollBack();
      throw $e;
    }

    return $this->_forward('success', 'utility', 'core', array(
      'smoothboxClose' => 10,
      'parentRefresh'=> 10,
      'messages' => array('')
    ));
  }


  public function productsAction()
  {
    $this->view->navigation = $navigation = Engine_Api::_()->getApi('menus', 'core')
      ->getNavigation('invoice_admin_main', array(), 'invoice_admin_main_products');

    $this->view->products = Engine_Api::_()->getItemTable('invoice_product')->fetchAll();
  }


  public function addProductAction()
  {
    // In smoothbox
    $this->_helper->layout->setLayout('admin-simple');

    // Generate and assign form
    $form = $this->view->form = new Invoice_Form_Admin_Product();
    $form->setAction($this->view->url(array()));
    
    
    
    // Check post
    if( !$this->getRequest()->isPost() ) {
      $this->renderScript('admin-settings/form.tpl');
      return;
    }
    if( !$form->isValid($this->getRequest()->getPost()) ) {
      $this->renderScript('admin-settings/form.tpl');
      return;
    }
    
    
    // Process
    $values = $form->getValues();
    
    // if (!is_numeric($values['price'])) {
    //   return $form->addError('Please enter');
    // }
    // $product_id = $this->_getAllParams();
    // //$this->view->product_id = $product_id;
    // $productsTable = Engine_Api::_()->getDbtable('products', 'invoice');
    // $product = $productsTable->find($product_id);

    $table = Engine_Api::_()->getDbtable('products', 'invoice');
    $rName = $table->info('name');
    $stmt = $table->select()->where($rName.'.category_id = ?', $values['category_id'])
    ->where($rName.'.product_name = ?', $values['label'])->query()->fetch();
    
    


    //  print_r();
    //   die;

    if($stmt){
      // print_r($stmt);
      // die;
      return $this->_forward('success', 'utility', 'core', array(
        'smoothboxClose' => 1000,
        'parentRefresh'=> 100,
        'messages' => array('Product Already Exists')
      ));
    }

    
  
    $productTable = Engine_Api::_()->getItemTable('invoice_product');
    $db = $productTable->getAdapter();
    $db->beginTransaction();

    $viewer = Engine_Api::_()->user()->getViewer();
    
    try {

      $productTable->insert(array(
        'user_id' => $viewer->getIdentity(),
        'product_name' => $values['label'],
        'category_id' => $values['category_id'],
        'product_price' => $values['price']
      ));

      $db->commit();
    } catch( Exception $e ) {
      $db->rollBack();
      throw $e;
    }

    return $this->_forward('success', 'utility', 'core', array(
      'smoothboxClose' => 1000,
      'parentRefresh'=> 100,
      'messages' => array('Success')
    ));
  }


  public function deleteProductAction()
  {
    // In smoothbox
    $this->_helper->layout->setLayout('admin-simple');
    $product_id = $this->_getParam('id');
    
    $this->view->product_id = $product_id;
    $productsTable = Engine_Api::_()->getDbtable('products', 'invoice');
    $product = $productsTable->find($product_id)->current();
    
    if( !$product ) {
     
      return $this->_forward('success', 'utility', 'core', array(
        'smoothboxClose' => 10,
        'parentRefresh'=> 10,
        'messages' => array('')
      ));
    } else {
      $product_id = $product->getIdentity();
    }
    
    if( !$this->getRequest()->isPost() ) {
      // Output
      
      $this->renderScript('admin-settings/deleteproduct.tpl');
      return;
    }
    
    // Process
    $db = $productsTable->getAdapter();
    $db->beginTransaction();
    
    try {
      
      $product->delete();
      
      //to be done when making purchases
      // $invoiceTable = Engine_Api::_()->getDbtable('invoices', 'invoice');
      // $invoiceTable->update(array(
      //   'product_id' => 0,
      // ), array(
      //   'product_id = ?' => $product_id,
      // ));
      
      $db->commit();
    } catch( Exception $e ) {
      $db->rollBack();
      throw $e;
    }
    
    return $this->_forward('success', 'utility', 'core', array(
      'smoothboxClose' => 10,
      'parentRefresh'=> 10,
      'messages' => array('')
    ));
  }



  public function editProductAction()
  {
    // In smoothbox
    $this->_helper->layout->setLayout('admin-simple');
    $product_id = $this->_getParam('id');
    $this->view->product_id = $product_id;
    $productsTable = Engine_Api::_()->getDbtable('products', 'invoice');
    $product = $productsTable->find($product_id)->current();
    
    if( !$product ) {
      return $this->_forward('success', 'utility', 'core', array(
        'smoothboxClose' => 10,
        'parentRefresh'=> 10,
        'messages' => array('')
      ));
    } else {
      $product_id = $product->getIdentity();
    }
    
   

    $form = $this->view->form = new Invoice_Form_Admin_Product();
    $form->setAction($this->getFrontController()->getRouter()->assemble(array()));
    $form->setField($product);
    
    if( !$this->getRequest()->isPost() ) {
      // Output
      $this->renderScript('admin-settings/form.tpl');
      return;
    }
    
    if( !$form->isValid($this->getRequest()->getPost()) ) {
      // Output
      $this->renderScript('admin-settings/form.tpl');
      return;
    }
    
    // Process
    $values = $form->getValues();
    
    $db = $productsTable->getAdapter();
    $db->beginTransaction();
    
    try {
      $product->product_name = $values['label'];
      $product->product_price = $values['price'];
      $product->category_id = $values['category_id'];
      $product->save();
      
      $db->commit();
    } catch( Exception $e ) {
      $db->rollBack();
      throw $e;
    }

    return $this->_forward('success', 'utility', 'core', array(
      'smoothboxClose' => 10,
      'parentRefresh'=> 10,
      'messages' => array('')
    ));
  }




 






}
