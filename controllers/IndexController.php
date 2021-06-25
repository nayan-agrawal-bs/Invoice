<?php

class Invoice_IndexController extends Core_Controller_Action_Standard
{
  // public function init()
  // {
  //     // only show to member_level if authorized
  //     if( !$this->_helper->requireAuth()->setAuthParams('invoice', null, 'view')->isValid() ) return;
  // }

  public function indexAction()
  {
    // Prepare data
    $viewer = Engine_Api::_()->user()->getViewer();

    // Permissions
    //$this->view->canCreate = $this->_helper->requireAuth()->setAuthParams('blog', null, 'create')->checkRequire();

    // Make form
    // Note: this code is duplicated in the blog.browse-search widget
    //$this->view->form = $form = new Blog_Form_Search();

    // $form->removeElement('draft');
    // if( !$viewer->getIdentity() ) {
    //     $form->removeElement('show');
    // }

    // // Process form
    // $defaultValues = $form->getValues();
    // if( $form->isValid($this->_getAllParams()) ) {
    //     $values = $form->getValues();
    // } else {
    //     $values = $defaultValues;
    // }
    // $this->view->formValues = array_filter($values);
    // $values['draft'] = "0";
    // $values['visible'] = "1";

    // Do the show thingy
    $owner = $viewer->getIdentity();
    $values['owner'] = $owner;

    //$this->view->assign($values);

    // Get blogs
    $paginator = Engine_Api::_()->getItemTable('invoice')->getInvoicePaginator($values);

    $items_per_page = Engine_Api::_()->getApi('settings', 'core')->getSetting('invoice.page', 10);
    $paginator->setItemCountPerPage($items_per_page);

    $this->view->paginator = $paginator->setCurrentPageNumber($this->_getParam('page'));

    // if( !empty($values['category']) ) {
    //     $this->view->categoryObject = Engine_Api::_()->getDbtable('categories', 'blog')
    //         ->find($values['category'])->current();
    // }

    // // Render
    // $this->_helper->content
    //     //->setNoRender()
    //     ->setEnabled()
    // ;
  }

  // public function viewAction()
  // {
  //     // Check permission
  //     $viewer = Engine_Api::_()->user()->getViewer();
  //     $blog = Engine_Api::_()->getItem('blog', $this->_getParam('blog_id'));
  //     if( $blog ) {
  //         Engine_Api::_()->core()->setSubject($blog);
  //     }

  //     if( !$this->_helper->requireSubject()->isValid() ) {
  //         return;
  //     }
  //     if( !$this->_helper->requireAuth()->setAuthParams($blog, $viewer, 'view')->isValid() ) {
  //         return;
  //     }
  //     if( !$blog || !$blog->getIdentity() ||
  //         ($blog->draft && !$blog->isOwner($viewer)) ) {
  //         return $this->_helper->requireSubject->forward();
  //     }

  //     // Network check
  //     $networkPrivacy = Engine_Api::_()->network()->getViewerNetworkPrivacy($blog);
  //     if(empty($networkPrivacy))
  //         return $this->_forward('requireauth', 'error', 'core');

  //     // Prepare data
  //     $blogTable = Engine_Api::_()->getDbtable('blogs', 'blog');

  //     if (strpos($blog->body, '<') === false) {
  //         $blog->body = nl2br($blog->body);
  //     }

  //     $this->view->blog = $blog;
  //     $this->view->owner = $owner = $blog->getOwner();
  //     $this->view->viewer = $viewer;

  //     if( !$blog->isOwner($viewer) ) {
  //         $blogTable->update(array(
  //             'view_count' => new Zend_Db_Expr('view_count + 1'),
  //         ), array(
  //             'blog_id = ?' => $blog->getIdentity(),
  //         ));
  //     }

  //     // Get tags
  //     $this->view->blogTags = $blog->tags()->getTagMaps();

  //     // Get category
  //     if( !empty($blog->category_id) ) {
  //         $this->view->category = Engine_Api::_()->getDbtable('categories', 'blog')
  //             ->find($blog->category_id)->current();
  //     }

  //     // Get styles
  //     $table = Engine_Api::_()->getDbtable('styles', 'core');
  //     $style = $table->select()
  //         ->from($table, 'style')
  //         ->where('type = ?', 'user_blog')
  //         ->where('id = ?', $owner->getIdentity())
  //         ->limit(1)
  //         ->query()
  //         ->fetchColumn();
  //     if( !empty($style) ) {
  //         try {
  //             $this->view->headStyle()->appendStyle($style);
  //         }
  //             // silence any exception, exceptin in development mode
  //         catch (Exception $e) {
  //             if (APPLICATION_ENV === 'development') {
  //                 throw $e;
  //             }
  //         }
  //     }

  //     // Render
  //     $this->_helper->content
  //         //->setNoRender()
  //         ->setEnabled()
  //     ;
  // }

  // // USER SPECIFIC METHODS
  // public function manageAction()
  // {
  //     if( !$this->_helper->requireUser()->isValid() ) return;

  //     // Render
  //     $this->_helper->content
  //         //->setNoRender()
  //         ->setEnabled()
  //     ;


  //     // Prepare data
  //     $viewer = Engine_Api::_()->user()->getViewer();
  //     $this->view->form = $form = new Blog_Form_Search();
  //     $this->view->canCreate = $this->_helper->requireAuth()->setAuthParams('blog', null, 'create')->checkRequire();

  //     $form->removeElement('show');

  //     // Process form
  //     $defaultValues = $form->getValues();
  //     if( $form->isValid($this->_getAllParams()) ) {
  //         $values = $form->getValues();
  //     } else {
  //         $values = $defaultValues;
  //     }
  //     $this->view->formValues = array_filter($values);
  //     $values['user_id'] = $viewer->getIdentity();

  //     // Get paginator
  //     $this->view->paginator = $paginator = Engine_Api::_()->getItemTable('blog')->getBlogsPaginator($values);
  //     $items_per_page = Engine_Api::_()->getApi('settings', 'core')->blog_page;
  //     $paginator->setItemCountPerPage($items_per_page);
  //     $this->view->paginator = $paginator->setCurrentPageNumber( $values['page'] );
  // }


  public function createAction()
  {
    if (!$this->_helper->requireUser()->isValid()) return;
    if (!$this->_helper->requireAuth()->setAuthParams('invoice', null, 'create')->isValid()) return;

    // // Render
    // $this->_helper->content
    //     //->setNoRender()
    //     ->setEnabled()
    // ;

    // set up data needed to check quota
    // $viewer = Engine_Api::_()->user()->getViewer();
    // $values['user_id'] = $viewer->getIdentity();
    // $paginator = Engine_Api::_()->getItemTable('invoiced')->getInvoicePaginator();

    // //$this->view->quota = $quota = Engine_Api::_()->authorization()->getPermission($viewer->level_id, 'blog', 'max');
    // $this->view->current_count = $paginator->getTotalItemCount();

    // $parent_type = $this->_getParam('parent_type');
    // $parent_id = $this->_getParam('parent_id', $this->_getParam('subject_id'));

    // if( $parent_type == 'group' && Engine_Api::_()->hasItemType('group') ) {
    //     $this->view->group = $group = Engine_Api::_()->getItem('group', $parent_id);
    //     if( !Engine_Api::_()->authorization()->isAllowed('group', $viewer, 'blog') ) {
    //         return;
    //     }
    // } else {
    //     $parent_type = 'user';
    //     $parent_id = $viewer->getIdentity();
    // }

    // $this->view->parent_type = $parent_type;
    // Prepare form
    $this->view->form = $form = new Invoice_Form_Create();






    // If not post or form not valid, return
    if (!$this->getRequest()->isPost()) {
      return;
    }
    //print_r($this->getRequest()->getPost());

    if (!$form->isValid($this->getRequest()->getPost())) {
      return;
    }
    $values = $form->getValues();


    //email validation
    if (!filter_var($values['cust_email'], FILTER_VALIDATE_EMAIL)) {
      return $form->addError('Please enter a valid email');
    }

    //phone number validation
    if (empty($values['cust_contact'])) {
      return $form->addError('Please enter a valid number');
    } else {
      $number = $values['cust_number'];
      if (preg_match('/^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$/', $number)) {
        return $form->addError('Please enter a valid number');
      }
    }

    //product validation
    if (empty($values['product_id'])) {
      return $form->addError('Please select a product');
    }

   
    // echo "<pre>";
    // print_r($products);
    // die;





    $user = Engine_Api::_()->user()->getViewer();
    // $name = $values['cust_name'];
    $email = $values['cust_email'];
    // $address = $values['cust_address'];
    // $contact = $values['cust_contact'];
    $currency = $values['currency'];
    $region = $values['region'];
    // $status = $values['status'];
    $category_id = $values['category_id'];
    $prod = $values['product_id'];


    $product1 = Engine_Api::_()->getItemTable('invoice_product')-> getProductsWithCategory($category_id);
    $products = $product1->fetchAll();



    if (empty($values['discount'])) {
      $discount = 0;
    } else {
      $discount = $values['discount'];
    }



    $invoice_number = Engine_Api::_()->getItemTable('invoice')->getInvoiceNumber($category_id, $currency);
    date_default_timezone_set("Asia/Calcutta");
    $amount = 0;
    $subtotal=0;
    //process for purchases entry
    $table2 = Engine_Api::_()->getItemTable('invoice_purchase');
    $db2 = $table2->getAdapter();
    $db2->beginTransaction();

    // Process for invoice entry
    $table = Engine_Api::_()->getItemTable('invoice');
    $db = $table->getAdapter();
    $db->beginTransaction();

    try {

      foreach ($prod as $key => $val) {
        //print_r($val);
        foreach ($products as $first => $second) {
          if ($val == $second['product_id']) {
            //print_r($second['product_id']);
            $row = $table2->createRow();
            $row->product_id = $second['product_id'];
            $row->invoice_number = $invoice_number;
            $row->cust_email = $email;
            $row->product_name = $second['product_name'];
            $row->purchase_date = date('Y-m-d H:i:s');
            $row->product_price = $second['product_price'];
            $amount = $amount + (int)$second['product_price'];
            $row->save();
            $db2->commit();
          }
        }
      }



        if ($values['currency'] == 0) {
          $region = 3;
          $subtotal = $this->totalAmount($region, $amount, $discount);
        } else {
          $subtotal = $this->totalAmount($region, $amount, $discount);
        }




      //Transaction
      // insert the invoice entry into the database
      $row = $table->createRow();
      $row->owner_id   =  $user->getIdentity();
      $row->owner_type = $user->getType();
      $row->category_id = $category_id;
      $row->creation_date = date('Y-m-d H:i:s');
      $row->modified_date   = date('Y-m-d H:i:s');
      $row->cust_name = $values['cust_name'];
      $row->cust_email = $values['cust_email'];
      $row->cust_address = $values['cust_address'];
      $row->cust_contact = $values['cust_contact'];
      $row->currency = $values['currency'];
      $row->region = $region;
      $row->status = $values['status'];
      $category_id = $values['category_id'];
      $row->invoice_number = $invoice_number;
      $row->discount = $discount;
      $row->amount = $amount;
      $row->subtotal=$subtotal;
      $row->save();


      $db->commit();
    } catch (Exception $e) {
      $db2->rollBack();
      $db->rollBack();
      throw $e;
      return $this->exceptionWrapper($e, $form, $db);
    }

    //return $this->_helper->redirector->gotoRoute(array('action' => 'manage'));
  }


  // function to get total amount on the bases of region and discount
  public function totalAmount($region, $amount, $discount)
  {
    //for Haryana 
    if ($region == 0) {
      $conversionRate = Engine_Api::_()->getApi('settings', 'core')->getSetting('invoice.USDtoINR', 75);
      $amount = $amount * $conversionRate;
      $CGST = Engine_Api::_()->getApi('settings', 'core')->getSetting('invoice.CGST', 9);
      $SGST = Engine_Api::_()->getApi('settings', 'core')->getSetting('invoice.SGST', 9);

      $discount = $amount * $discount / 100;
      $amount = $amount - $discount;

      $SGST = $amount * $SGST / 100;
      $CGST = $amount * $CGST / 100;

      $amount = $amount + $SGST + $CGST;
    } else if ($region == 1) {
      //for Out side of Haryana 
      $conversionRate = Engine_Api::_()->getApi('settings', 'core')->getSetting('invoice.USDtoINR', 75);
      $amount = $amount * $conversionRate;
      $IGST = Engine_Api::_()->getApi('settings', 'core')->getSetting('invoice.IGST', 18);
      $discount = $amount * $discount / 100;
      $amount = $amount - $discount;

      $IGST = $amount * $IGST / 100;

      $amount = $amount + $IGST;
    } else {
      //for USD
      $discount = $amount * $discount / 100;
      $amount = $amount - $discount;
    }
    return $amount;
  }





  // public function currencyConverter($amount){

  // $fromCurrency = urlencode('USD');
  // $toCurrency = urlencode('INR');	
  // $url  = "https://www.google.com/search?q=".$fromCurrency."+to+".$toCurrency;
  // $get = file_get_contents($url);
  // $data = preg_split('/\D\s(.*?)\s=\s/',$get);
  // $exhangeRate = (float) substr($data[1],0,7);
  // $convertedAmount = $amount*$exhangeRate;
  // return $convertedAmount;

  // }  


  // action for ajax request
  public function demoAction()
  {

    $value = $this->getRequest()->getParams();

    $table = Engine_Api::_()->getDbtable('products', 'invoice');
    $rName = $table->info('name');
    $stmt = $table->select()->where($rName . '.category_id = ?', $value['cate_id'])
      ->query();

    $data = array();
    foreach ($stmt->fetchAll() as $product) {
      $data[$product['product_id']] = $product['product_name'];
    }
    $this->_helper->json($data);
  }

  public function editAction()
  {
      if( !$this->_helper->requireUser()->isValid() ) return;

      $viewer = Engine_Api::_()->user()->getViewer();
      $invoice = Engine_Api::_()->getItem('invoice', $this->_getParam('invoice_id'));


      $purch = Engine_Api::_()->getItemTable('invoice_purchase')->getPurchases($invoice['invoice_number']);
      $purchases=$purch->fetchAll();

      $data = array();
      foreach( $purchases as $purchase ) {
        $data[$purchase['product_id']] = $purchase['product_name'];
      }


      $add=Engine_Api::_()->getItemTable('invoice_product')
      ->getProductsWithCategory($invoice['category_id']);

      $addProducts=$add->fetchAll();

      $data2 = array();
      foreach( $addProducts as $pro ) {
        $data2[$pro['product_id']] = $pro['product_name'];
      }

      // print_r($addProducts);
      // die;


      // Get navigation
      $this->view->navigation = $navigation = Engine_Api::_()->getApi('menus', 'core')
          ->getNavigation('invoice_main');

        //  print_r($data);
        //  die;

      // if( !$this->_helper->requireAuth()->setAuthParams($invoice, $viewer, 'edit')->isValid() ) {
      //     return;
      // }

      // Prepare form
      $this->view->form = $form = new Invoice_Form_Edit();

      //Populate form
      

      $this->view->currency=$invoice['currency'];
      $this->view->products=$data;
      $this->view->addProducts=$data2;



      $form->populate($invoice->toArray());

     

    
       
     
     



      // Check post/form
      if( !$this->getRequest()->isPost() ) {
          return;
      }
      if( !$form->isValid($this->getRequest()->getPost()) ) {
          return;
      }
      date_default_timezone_set("Asia/Calcutta");

    $table2 = Engine_Api::_()->getItemTable('invoice_purchase');
    $db2 = $table2->getAdapter();
    $db2->beginTransaction();


      // Process
      $db = Engine_Db_Table::getDefaultAdapter();
      $db->beginTransaction();

      try {
          $values = $form->getValues();
          
          $amount=$invoice['amount'];
          $invoice_number=$invoice['invoice_number'];
          
          
          $email=$values['cust_email'];
          
          $discount=$values['discount'];
          $region= $values['region'];


        if(!empty($values['product_id'])){
        $prod = $values['product_id'];

          foreach ($prod as $key => $val) {
            //print_r($val);
            foreach ($purchases as $first => $second) {
              if ($val == $second['product_id']) {
                //print_r($second['product_id']);
               
                $amount = $amount - (int)$second['product_price'];
                // print_r($amount);
                // die;
                $table2->delete(array(
                  'invoice_number = ?' => $invoice_number,
                  'product_id = ?' => $second['product_id'],
                ));
               
               // $db2->commit();
              }
            }
          }
        }
         

          if(!empty($values['product_id1'])){
          $prod=$values['product_id1'];
          foreach ($prod as $key => $val) {
            //print_r($val);
            foreach ($addProducts as $first => $second) {
              if ($val == $second['product_id']) {
                //print_r($second['product_id']);
                $row = $table2->createRow();
                $row->product_id = $second['product_id'];
                $row->invoice_number = $invoice_number;
                $row->cust_email = $email;
                $row->product_name = $second['product_name'];
                $row->purchase_date = $invoice['creation_date'];
                $row->product_price = $second['product_price'];
                $amount = $amount + (int)$second['product_price'];
                $row->save();
                $db2->commit();
              }
            }
          }
        }

         $subtotal=0;
          if ($values['currency'] == 0) {
            $region = 3;
            $subtotal = $this->totalAmount($region, $amount, $discount);
          } else {
            $subtotal = $this->totalAmount($region, $amount, $discount);
          }

          

         

         

          $invoice->setFromArray($values);
          $invoice->modified_date = date('Y-m-d H:i:s');
          $invoice->amount=$amount;
          $invoice->subtotal=$subtotal;
          $invoice->save(); 

          $db->commit();

      }
      catch( Exception $e ) {
          $db2->rollBack();
          $db->rollBack();
          throw $e;
      }

      return $this->_helper->redirector->gotoRoute(array('action' => 'index'));
  }




  public function deleteAction()
  {
      $viewer = Engine_Api::_()->user()->getViewer();
      $invoice = Engine_Api::_()->getItem('invoice', $this->getRequest()->getParam('invoice_id'));
      //if( !$this->_helper->requireAuth()->setAuthParams($blog, null, 'delete')->isValid()) return;

      // In smoothbox
      $this->_helper->layout->setLayout('default-simple');

      $this->view->form = $form = new Invoice_Form_Delete();
    
      if( !$invoice ) {
          $this->view->status = false;
          $this->view->error = Zend_Registry::get('Zend_Translate')->_("Invoice entry doesn't exist or not authorized to delete");
          return;
      }
     


      if( !$this->getRequest()->isPost() ) {
          $this->view->status = false;
          $this->view->error = Zend_Registry::get('Zend_Translate')->_('Invalid request method');
          return;
      }
      
     
      $invoice_number=$invoice['invoice_number'];
      
      // print_r($invoice_number);
      // die;
      
      

    
    $table = Engine_Api::_()->getDbtable('purchases', 'invoice');
    $db = $invoice->getTable()->getAdapter();
    $db->beginTransaction();
    $db2 =$table->getAdapter();
    $db2->beginTransaction();

    try {
      // first delete all purchases,
      $table->delete(array(
        'invoice_number = ?' => $invoice_number,
      ));
      $invoice->delete();

      $db2->commit();
        $db->commit();
    } catch( Exception $e ) {
      //die('yo');
      $db2->rollBack();
        $db->rollBack();
        throw $e;
    }

      $this->view->status = true;
      $this->view->message = Zend_Registry::get('Zend_Translate')->_('Your invoice entry has been deleted.');
      return $this->_forward('success' ,'utility', 'core', array(
          'parentRedirect' => Zend_Controller_Front::getInstance()->getRouter()
          ->assemble(array('action' => 'index'), 'invoice_general', true),
          'messages' => Array($this->view->message)
      ));
  }


}
