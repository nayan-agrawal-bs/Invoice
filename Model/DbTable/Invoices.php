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

        // if (!Engine_Api::_()->getApi('settings', 'core')->getSetting('demo.allow.unauthorized', 0))
        //     return $this->getAuthorisedSelect($select);
        // else
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


    public function getInvoiceNumber($category_id,$currnecy)
    {
        $categoryArray = Engine_Api::_()->getItemTable('invoice_category')->getCategoriesAssoc();
        $category = $categoryArray[$category_id];


        $stmt = $this->select()
            ->from($this, array('Max(invoice_id) as id'))
            ->where('category_id = ?', $category_id)
            ->order('invoice_id')
            ->query();

        $id = $stmt->fetch();
        
        if (empty($id['id'])&& $currnecy == 0) {
            $num = 1;
            $num = str_pad($num, 4, '0', STR_PAD_LEFT);

            $month = date('m');
            $firstYear = date('y');
            $secondYear = date('y');
            if ($month >= 4) {
                $secondYear = $secondYear + 1;
            } else {
                $firstYear = $firstYear - 1;
            }

            return $num . "/" ."P". $category . "/" . $firstYear . "-" . $secondYear;

        } else  if (empty($id['id'])&& $currnecy == 1) {
            $num = 1;
            $num = str_pad($num, 4, '0', STR_PAD_LEFT);

            $month = date('m');
            $firstYear = date('y');
            $secondYear = date('y');
            if ($month >= 4) {
                $secondYear = $secondYear + 1;
            } else {
                $firstYear = $firstYear - 1;
            }

            return $num . "/" ."GST". $category . "/" . $firstYear . "-" . $secondYear;

        } else if ($currnecy ==0) {


            $stmt = $this->select()->from($this, array('invoice_number'))
                ->where('invoice_id = ?', $id['id'])
                ->query();


            $invoice_number = $stmt->fetch();
            //print_r($invoice_number);



            $value = explode('/', $invoice_number['invoice_number']);

            $num = $value[0];
            //print_r($num);
            $num = (int)$num;
            $num++;
            $num = str_pad($num, 4, '0', STR_PAD_LEFT);

            $month = date('m');
            $firstYear = date('y');
            $secondYear = date('y');
            if ($month >= 4) {
                $secondYear = $secondYear + 1;
            } else {
                $firstYear = $firstYear - 1;
            }

            return $num . "/" ."P". $category . "/" . $firstYear . "-" . $secondYear;
        }
        else {


            $stmt = $this->select()->from($this, array('invoice_number'))
                ->where('invoice_id = ?', $id['id'])
                ->query();


            $invoice_number = $stmt->fetch();
            //print_r($invoice_number);



            $value = explode('/', $invoice_number['invoice_number']);

            $num = $value[0];
            //print_r($num);
            $num = (int)$num;
            $num++;
            $num = str_pad($num, 4, '0', STR_PAD_LEFT);

            $month = date('m');
            $firstYear = date('y');
            $secondYear = date('y');
            if ($month >= 4) {
                $secondYear = $secondYear + 1;
            } else {
                $firstYear = $firstYear - 1;
            }

            return $num . "/" ."GST". $category . "/" . $firstYear . "-" . $secondYear;
        }
    }
}
