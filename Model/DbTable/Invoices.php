<?php
class Invoice_Model_DbTable_Invoices extends Core_Model_Item_DbTable_Abstract
{
    protected $_rowClass = "Invoice_Model_Invoice";






    public function getInvoiceSelect($params = array())
    {
       
        $viewer = Engine_Api::_()->user()->getViewer();
        $viewerId = $viewer->getIdentity();
        $table = Engine_Api::_()->getDbtable('invoices', 'invoice');
        $rName = $table->info('name');

       

        $select = $table->select();
        


        // for searching using email
        if (!empty($params['email'])) {
            $select->where($rName . '.cust_email = ?', $params['email']);
            
        }

        // for searching using category
        if (!empty($params['category'])) {
            $select->where($rName . '.category_id = ?', $params['category']);
            
        }

        // for searching using payment status
        if (!empty($params['status'])) {
            $select->where($rName . '.status = ?', $params['status']);
            
        }

        // // for searching using Invoice Number
        if (!empty($params['search'])) {
            $select->where($rName . ".invoice_number = ? " , $params['search'] );
        }

        //for manage page admin search is working without this
        if (!empty($params['owner'])) {
            $select->where($rName . '.owner_id = ?', $params['owner']);
        }

       
        return $select;
    }




    public function getInvoicePaginator($params = array())
    {
       
        $paginator = Zend_Paginator::factory($this->getInvoiceSelect($params));
        

        return $paginator;
    }

    // for generating invoice number
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



    public function updateOwner($userId,$userName){
        $whereClause = array(
            'owner_id = ?' =>$userId,
        );  
    
        $this->update(array("owner_id"=>1,"owner_type"=>'user'),$whereClause);
    
      }
}
