<?php

class Invoice_Model_DbTable_Categories extends Engine_Db_Table
{
  protected $_rowClass = 'Invoice_Model_Category';
  
  public function getCategoriesAssoc()
  {
    $stmt = $this->select()
        ->from($this, array('category_id', 'category_name'))
        ->order('category_name ASC')
        ->query();
    
    $data = array();
    foreach( $stmt->fetchAll() as $category ) {
      $data[$category['category_id']] = $category['category_name'];
    }
    
    return $data;
  }
  
  public function getUserCategoriesAssoc($user)
  {
    if( $user instanceof User_Model_User ) {
      $user = $user->getIdentity();
    } else if( !is_numeric($user) ) {
      return array();
    }
    
    $stmt = $this->getAdapter()
        ->select()
        ->from('engine4_invoice_categories', array('category_id', 'category_name'))
        ->joinLeft('engine4_invoice_invoices', "engine4_invoice_invoidces.category_id = engine4_invoice_categories.category_id")
        ->group("engine4_invoice_categories.category_id")
        ->where('engine4_invoice_invoices.owner_id = ?', $user)
        
        ->order('category_name ASC')
        ->query();
    
    $data = array();
    foreach( $stmt->fetchAll() as $category ) {
      $data[$category['category_id']] = $category['category_name'];
    }
    
    return $data;
  }
}
