<?php

class Invoice_AdminManageController extends Core_Controller_Action_Admin
{
  public function indexAction()
  {
    $this->view->navigation = $navigation = Engine_Api::_()->getApi('menus', 'core')
      ->getNavigation('invoice_admin_main', array(), 'invoice_admin_main_manage');

    if ($this->getRequest()->isPost()) {
      $values = $this->getRequest()->getPost();
      foreach ($values as $key => $value) {
        if ($key == 'delete_' . $value) {
          $invoice = Engine_Api::_()->getItem('invoice', $value);
          $invoice->delete();
        }
      }
    }
    
    $paginator = Engine_Api::_()->getItemTable('invoice')->getInvoicePaginator($values);

    $items_per_page = Engine_Api::_()->getApi('settings', 'core')->getSetting('invoice.page', 10);
    $paginator->setItemCountPerPage($items_per_page);

    $this->view->paginator = $paginator->setCurrentPageNumber($this->_getParam('page'));
  }

  public function deleteAction()
  {
    // In smoothbox
    $this->_helper->layout->setLayout('admin-simple');
    $id = $this->_getParam('id');
    $this->view->invoice_id=$id;
   
   
    // Check post

    $table = Engine_Api::_()->getDbtable('purchases', 'invoice');
   

    if( $this->getRequest()->isPost() )
    { 
      $db2 =$table->getAdapter();
      $db2->beginTransaction();
      $db = Engine_Db_Table::getDefaultAdapter();
      $db->beginTransaction();

      try
      {
        $invoice = Engine_Api::_()->getItem('invoice', $id);
        $invoice_number=$invoice['invoice_number'];
        print_r($invoice_number);

        $table->delete(array(
          'invoice_number = ?' => $invoice_number,
        ));
        // delete the invoice entry into the database
        $invoice->delete();
        $db->commit();
        $db2->commit();
      }

      catch( Exception $e )
      {
        $db->rollBack();
        $db2->rollBack();
        throw $e;
      }

      $this->_forward('success', 'utility', 'core', array(
          'smoothboxClose' => 10,
          'parentRefresh'=> 10,
          'messages' => array('')
      ));
    }

    // Output
    $this->renderScript('admin-manage/delete.tpl');
  }
}
