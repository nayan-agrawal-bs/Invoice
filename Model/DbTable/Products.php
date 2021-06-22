<?php

class Invoice_Model_DbTable_Products extends Engine_Db_Table
{
  protected $_rowClass = 'Invoice_Model_Product';
  
  public function getProductsAssoc()
  {
    $stmt = $this->select()
        ->from($this, array('product_id', 'product_name','product_price','category_id'))
        //->where('category_id = ?',$categoryId)
        ->order('product_name ASC')
        ->query();
    
    $data = array();
    foreach( $stmt->fetchAll() as $product ) {
      $data[$product['product_id']] = $product['product_name'];
    }
    
    return $data;
  }

  public function getProducts(){
    $stmt = $this->select()
        ->from($this, array('product_id', 'product_name','product_price','category_id'))
        //->where('product_id = ?',$product_id)
        ->order('product_name ASC')
        ->query();

    return $stmt;
  }
 
  
  
  
  
  
  public function ifProductExists($param =array()){


    $table = Engine_Api::_()->getDbtable('products', 'invoice');
    $rName = $table->info('name');
    $stmt = $table->select()->where($rName.'.category_id = ?', $param['category_id'])
    ->where($rName.'.product_name = ?', $param['label'])->query()->fetchAll();
    
   
    return $this->fetchAll($stmt);
  }
  
  public function getUserProductsAssoc($user)
  {
    if( $user instanceof User_Model_User ) {
      $user = $user->getIdentity();
    } else if( !is_numeric($user) ) {
      return array();
    }
    
    $stmt = $this->getAdapter()
        ->select()
        ->from('engine4_invoice_products', array('product_id', 'product_name'))
        ->joinLeft('engine4_invoice_invoices', "engine4_invoice_invoices.product_id = engine4_invoice_products.product_id")
        ->group("engine4_invoice_products.product_id")
        ->where('engine4_invoice_invoices.owner_id = ?', $user)
        
        ->order('product_name ASC')
        ->query();
    
    $data = array();
    foreach( $stmt->fetchAll() as $product ) {
      $data[$product['product_id']] = $product['product_name'];
    }
    
    return $data;
  }
}
