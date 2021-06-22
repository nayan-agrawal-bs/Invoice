<?php

class Invoice_Model_DbTable_Purchases extends Core_Model_Item_DbTable_Abstract
{
  protected $_rowClass = 'Invoice_Model_Purchase';
  
//   public function getPurchases()
//   {
//     $stmt = $this->select()
//         ->from($this, array('product_id', 'product_name','product_price','category_id'))
//         //->where('category_id = ?',$categoryId)
//         ->order('product_name ASC')
//         ->query();
    
//     $data = array();
//     foreach( $stmt->fetchAll() as $product ) {
//       $data[$product['product_id']] = $product['product_name'];
//     }
    
//     return $data;
//   }

  
  
}
?>
