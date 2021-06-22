<?php

class Invoice_Model_Product extends Core_Model_Category
{
  protected $_searchTriggers = false;
  protected $_route = 'invoice_general';

  public function getTitle()
  {
    return $this->product_name;
  }
  
 

  public function isOwner($owner)
  {
    return false;
  }

  public function getOwner($recurseType = null)
  {
    return $this;
  }

  public function getHref($params = array())
  {
    return Zend_Controller_Front::getInstance()->getRouter()
            ->assemble($params, $this->_route, true) . '?product=' . $this->product_id;
  }
}
?>