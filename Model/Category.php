<?php

class Invoice_Model_Category extends Core_Model_Category
{
  protected $_searchTriggers = false;
  protected $_route = 'invoice_general';

  public function getTitle()
  {
    return $this->category_name;
  }
  
  public function getUsedCount()
  {
    $blogTable = Engine_Api::_()->getItemTable('invoice');
    return $blogTable->select()
        ->from($blogTable, new Zend_Db_Expr('COUNT(invoice_id)'))
        ->where('category_id = ?', $this->category_id)
        ->query()
        ->fetchColumn();
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
            ->assemble($params, $this->_route, true) . '?category=' . $this->category_id;
  }
}
