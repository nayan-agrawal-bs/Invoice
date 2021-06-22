<?php
class Invoice_Model_DbTable_Invoices extends Core_Model_Item_DbTable_Abstract
{
    protected $_rowClass = "Invoice_Model_Invoice";






    public function getInvoiceSelect($params = array())
    {
        // echo "<pre>";
        // print_r($params);
        // die;
        $viewer = Engine_Api::_()->user()->getViewer();
        $viewerId = $viewer->getIdentity();
        $table = Engine_Api::_()->getDbtable('invoices', 'invoice');
        $rName = $table->info('name');

        //$tmTable = Engine_Api::_()->getDbtable('TagMaps', 'core');
        //$tmName = $tmTable->info('name');
        //$tmTable = Engine_Api::_()->getDbtable('tagmaps', 'blog');
        //$tmName = $tmTable->info('name');

        $select = $table->select();
        // echo "<pre>";
        // print_r($params);
        //  die;



        if (!empty($params['category'])) {
            $select->where($rName . '.category_id = ?', $params['category']);
            // die('yo');
        }



        //else $select->group("$rName.blog_id");

        // Could we use the search indexer for this?
        if (!empty($params['search'])) {
            $select->where($rName . ".title LIKE ? OR " . $rName . ".body LIKE ?", '%' . $params['search'] . '%');
        }





        //$select = Engine_Api::_()->network()->getNetworkSelect($rName, $select);

        if (!empty($params['owner'])) {
            $select->where($rName . '.owner_id = ?', $params['owner']);
        }

        if (!Engine_Api::_()->getApi('settings', 'core')->getSetting('demo.allow.unauthorized', 0))
            return $this->getAuthorisedSelect($select);
        else
            return $select;
    }




    public function getInvoicePaginator()
    {
        // echo "<pre>";
        // print_r($params);
        // die;
        $paginator = Zend_Paginator::factory($this->getInvoiceSelect());
        // if( !empty($params['page']) )
        // {
        //     $paginator->setCurrentPageNumber($params['page']);
        // }
        // if( !empty($params['limit']) )
        // {
        //     $paginator->setItemCountPerPage($params['limit']);
        // }

        // if( empty($params['limit']) )
        // {
        //     $page = 10;
        //     $paginator->setItemCountPerPage($page);
        // }

        return $paginator;
    }


    public function getLastInvoiceId($categoryId)
    {
        $stmt = $this->select()
            ->from($this, array('Max(invoice_id) as id'))
            ->where('category_id = ?', $categoryId)
            ->order('invoice_id')
            ->query();

        $id = $stmt->fetch();

        $stmt = $this->select()->from($this, array('invoice_number'))
            ->where('invoice_id = ?', $id['id'])
            ->query();





        return $stmt;
    }
}
