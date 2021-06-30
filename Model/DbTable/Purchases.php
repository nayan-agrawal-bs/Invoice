<?php

class Invoice_Model_DbTable_Purchases extends Core_Model_Item_DbTable_Abstract
{
  protected $_rowClass = 'Invoice_Model_Purchase';
  
  public function getPurchases($invoice_number)
  {
    $stmt = $this->select()
        ->from($this, array('product_id', 'product_name','product_price'))
        ->where('invoice_number = ?',$invoice_number)
        ->query();
    
   
    
    return $stmt;
  }



 


  
  
}
?>
