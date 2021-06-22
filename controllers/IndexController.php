<?php

class Invoice_IndexController extends Core_Controller_Action_Standard
{
  // public function init()
  // {
  //     // only show to member_level if authorized
  //     if( !$this->_helper->requireAuth()->setAuthParams('invoice', null, 'view')->isValid() ) return;
  // }

  // public function indexAction()
  // {
  //     // Prepare data
  //     $viewer = Engine_Api::_()->user()->getViewer();

  //     // Permissions
  //     $this->view->canCreate = $this->_helper->requireAuth()->setAuthParams('blog', null, 'create')->checkRequire();

  //     // Make form
  //     // Note: this code is duplicated in the blog.browse-search widget
  //     $this->view->form = $form = new Blog_Form_Search();

  //     $form->removeElement('draft');
  //     if( !$viewer->getIdentity() ) {
  //         $form->removeElement('show');
  //     }

  //     // Process form
  //     $defaultValues = $form->getValues();
  //     if( $form->isValid($this->_getAllParams()) ) {
  //         $values = $form->getValues();
  //     } else {
  //         $values = $defaultValues;
  //     }
  //     $this->view->formValues = array_filter($values);
  //     $values['draft'] = "0";
  //     $values['visible'] = "1";

  //     // Do the show thingy
  //     if( @$values['show'] == 2 ) {
  //         // Get an array of friend ids
  //         $table = Engine_Api::_()->getItemTable('user');
  //         $select = $viewer->membership()->getMembersSelect('user_id');
  //         $friends = $table->fetchAll($select);
  //         // Get stuff
  //         $ids = array();
  //         foreach( $friends as $friend )
  //         {
  //             $ids[] = $friend->user_id;
  //         }
  //         //unset($values['show']);
  //         $values['users'] = $ids;
  //     }

  //     $this->view->assign($values);

  //     // Get blogs
  //     $paginator = Engine_Api::_()->getItemTable('blog')->getBlogsPaginator($values);

  //     $items_per_page = Engine_Api::_()->getApi('settings', 'core')->blog_page;
  //     $paginator->setItemCountPerPage($items_per_page);

  //     $this->view->paginator = $paginator->setCurrentPageNumber( $values['page'] );

  //     if( !empty($values['category']) ) {
  //         $this->view->categoryObject = Engine_Api::_()->getDbtable('categories', 'blog')
  //             ->find($values['category'])->current();
  //     }

  //     // Render
  //     $this->_helper->content
  //         //->setNoRender()
  //         ->setEnabled()
  //     ;
  // }

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
    $this->view->form = $form = new Invoice_Form_Create(array(
      // 'parent_type' => $parent_type,
      // 'parent_id' => $parent_id
    ));






    // If not post or form not valid, return
    if (!$this->getRequest()->isPost()) {
      return;
    }
    //print_r($this->getRequest()->getPost());

    if (!$form->isValid($this->getRequest()->getPost())) {
      return;
    }
    $values = $form->getValues();











    // if (empty($values['cust_contact'])) {
    //   return $form->addError('Please enter a valid number');
    // } else {
    //   $number = $values['cust_number'];
    //   if (preg_match('/^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$/', $number)) {
    //     return $form->addError('Please enter a valid number');
    //   }
    // }

    if (empty($values['product_id'])) {
      return $form->addError('Please select a product');
    }

    $product1 = Engine_Api::_()->getItemTable('invoice_product')->getProducts();
    $products = $product1->fetchAll();
    // echo "<pre>";
    // print_r($products);
    // die;

    $user = Engine_Api::_()->user()->getViewer();
    // $name = $values['cust_name'];
     $email = $values['cust_email'];
    // $address = $values['cust_address'];
    // $contact = $values['cust_contact'];
    // $currency = $values['currency'];
    // $region = $values['region'];
    // $status = $values['status'];
    $category_id = $values['category_id'];
    $prod = $values['product_id'];
    print_r($category_id);
    //die;
    $invoice_number = $this->createInvoiceNumber($category_id);
    // print_r($invoice_number);
    // die;
    $amount=0;
    //process for purchases entry
    $table2 = Engine_Api::_()->getItemTable('invoice_purchase');
    $db2 = $table2->getAdapter();
    $db2->beginTransaction();

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
            $amount=$amount + $second['product_price'];
            $row->save();
            $db2->commit();
          }
        }
      }
    } catch (Exception $e) {
      return $this->exceptionWrapper($e, $form, $db2);
    }

    // Process for invoice entry
    $table = Engine_Api::_()->getItemTable('invoice');
    $db = $table->getAdapter();
    $db->beginTransaction();

    // try {
      // Transaction
      //$table = Engine_Api::_()->getDbtable('invoices', 'invoice');

      // insert the invoice entry into the database
      $row = $table->createRow();print_r('1-');
      $row->owner_id   =  $user->getIdentity();print_r('2-');
      $row->owner_type = $user->getType();print_r('3-');
      $row->category_id = $category_id;print_r('4-');
      $row->creation_date = date('Y-m-d H:i:s');print_r('5-');
      $row->modified_date   = date('Y-m-d H:i:s');print_r('6-');

      $row->cust_name = $values['cust_name'];print_r('7-');
      $row->cust_email = $values['cust_email'];print_r('8-');
      $row->cust_address = $values['cust_address'];print_r('9-');
      $row->cust_contact = $values['cust_contact'];print_r('10-');
      $row->currency = $values['currency'];print_r('11-');
      $row->region = $values['region'];print_r('12-');
      $row->status = $values['status'];print_r('13-');
      $category_id = $values['category_id'];print_r('14-');
      $row->invoice_number = $invoice_number;print_r('16-');






      $row->save();


      $db->commit();
    // } catch (Exception $e) {
    //   return $this->exceptionWrapper($e, $form, $db);
    // }

    //return $this->_helper->redirector->gotoRoute(array('action' => 'manage'));
  }

  public function createInvoiceNumber($category_id)
  {

    $categoryArray = Engine_Api::_()->getItemTable('invoice_category')->getCategoriesAssoc();
    $category = $categoryArray[$category_id];


    $invoice = Engine_Api::_()->getItemTable('invoice')->getLastInvoiceId($category_id);
    $invoice_number = $invoice->fetch();
    //print_r($invoice_number);
    if( $invoice_number==''){
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

    return $num . "/" . $category . "/" . $firstYear . "-" . $secondYear;
    }
    else{
    $value = explode('/', $invoice_number['invoice_number']);

    $num = $value[0];
    print_r($num);
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

    return $num . "/" . $category . "/" . $firstYear . "-" . $secondYear;
    }
  }


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

  // public function editAction()
  // {
  //     if( !$this->_helper->requireUser()->isValid() ) return;

  //     $viewer = Engine_Api::_()->user()->getViewer();
  //     $blog = Engine_Api::_()->getItem('blog', $this->_getParam('blog_id'));
  //     if( !Engine_Api::_()->core()->hasSubject('blog') ) {
  //         Engine_Api::_()->core()->setSubject($blog);
  //     }

  //     if( !$this->_helper->requireSubject()->isValid() ) return;

  //     // Get navigation
  //     $this->view->navigation = $navigation = Engine_Api::_()->getApi('menus', 'core')
  //         ->getNavigation('blog_main');

  //     $parent_type = $blog->parent_type;
  //     $parent_id = $blog->parent_id;

  //     if( !$this->_helper->requireAuth()->setAuthParams($blog, $viewer, 'edit')->isValid() ) {
  //         return;
  //     }

  //     // Prepare form
  //     $this->view->form = $form = new Blog_Form_Edit(array(
  //         'parent_type' => $parent_type,
  //         'parent_id' => $parent_id
  //     ));

  //     // Populate form
  //     $form->populate($blog->toArray());

  //     $tagStr = '';
  //     foreach( $blog->tags()->getTagMaps() as $tagMap ) {
  //         $tag = $tagMap->getTag();
  //         if( !isset($tag->text) ) continue;
  //         if( '' !== $tagStr ) $tagStr .= ', ';
  //         $tagStr .= $tag->text;
  //     }

  //     $form->populate(array(
  //         'tags' => $tagStr,
  //         'networks' => explode(',', $blog->networks),
  //     ));
  //     $this->view->tagNamePrepared = $tagStr;

  //     $auth = Engine_Api::_()->authorization()->context;
  //     if( $parent_type == 'group' ) {
  //         $roles = array('owner', 'member', 'parent_member', 'registered', 'everyone');
  //     } else {
  //         $roles = array('owner', 'member', 'owner_member', 'owner_member_member', 'owner_network', 'registered', 'everyone');
  //     }

  //     foreach( $roles as $role ) {
  //         if ($form->auth_view){
  //             if( $auth->isAllowed($blog, $role, 'view') ) {
  //                 $form->auth_view->setValue($role);
  //             }
  //         }

  //         if ($form->auth_comment){
  //             if( $auth->isAllowed($blog, $role, 'comment') ) {
  //                 $form->auth_comment->setValue($role);
  //             }
  //         }
  //     }

  //     // hide status change if it has been already published
  //     if( $blog->draft == "0" ) {
  //         $form->removeElement('draft');
  //     }


  //     // Check post/form
  //     if( !$this->getRequest()->isPost() ) {
  //         return;
  //     }
  //     if( !$form->isValid($this->getRequest()->getPost()) ) {
  //         return;
  //     }


  //     // Process
  //     $db = Engine_Db_Table::getDefaultAdapter();
  //     $db->beginTransaction();

  //     try {
  //         $values = $form->getValues();

  //         if (isset($values['networks'])) {
  //             $network_privacy = 'network_'. implode(',network_', $values['networks']);
  //             $values['networks'] = implode(',', $values['networks']);
  //         }

  //         if( empty($values['auth_view']) ) {
  //             $values['auth_view'] = 'everyone';
  //         }
  //         if( empty($values['auth_comment']) ) {
  //             $values['auth_comment'] = 'everyone';
  //         }

  //         $values['view_privacy'] = $values['auth_view'];

  //         $blog->setFromArray($values);
  //         $blog->modified_date = date('Y-m-d H:i:s');
  //         $blog->save();

  //         // Add photo
  //         if( !empty($values['photo']) ) {
  //             $blog->setPhoto($form->photo);
  //         }

  //         // Auth
  //         $viewMax = array_search($values['auth_view'], $roles);
  //         $commentMax = array_search($values['auth_comment'], $roles);

  //         foreach( $roles as $i => $role ) {
  //             $auth->setAllowed($blog, $role, 'view', ($i <= $viewMax));
  //             $auth->setAllowed($blog, $role, 'comment', ($i <= $commentMax));
  //         }

  //         // handle tags
  //         $tags = preg_split('/[,]+/', $values['tags']);
  //         $blog->tags()->setTagMaps($viewer, $tags);

  //         // insert new activity if blog is just getting published
  //         $action = Engine_Api::_()->getDbtable('actions', 'activity')->getActionsByObject($blog);
  //         if( count($action->toArray()) <= 0 && $values['draft'] == '0' ) {
  //             $action = Engine_Api::_()->getDbtable('actions', 'activity')->addActivity($viewer, $blog, 'blog_new', '', array('privacy' => isset($values['networks'])? $network_privacy : null));
  //             // make sure action exists before attaching the blog to the activity
  //             if( $action != null ) {
  //                 Engine_Api::_()->getDbtable('actions', 'activity')->attachActivity($action, $blog);
  //             }
  //         }

  //         // Rebuild privacy
  //         $actionTable = Engine_Api::_()->getDbtable('actions', 'activity');
  //         foreach( $actionTable->getActionsByObject($blog) as $action ) {
  //             $action->privacy = isset($values['networks'])? $network_privacy : null;
  //             $action->save();
  //             $actionTable->resetActivityBindings($action);
  //         }

  //         // Send notifications for subscribers
  //         Engine_Api::_()->getDbtable('subscriptions', 'blog')
  //             ->sendNotifications($blog);

  //         $db->commit();

  //     }
  //     catch( Exception $e ) {
  //         $db->rollBack();
  //         throw $e;
  //     }

  //     return $this->_helper->redirector->gotoRoute(array('action' => 'manage'));
  // }

  // public function deleteAction()
  // {
  //     $viewer = Engine_Api::_()->user()->getViewer();
  //     $blog = Engine_Api::_()->getItem('blog', $this->getRequest()->getParam('blog_id'));
  //     if( !$this->_helper->requireAuth()->setAuthParams($blog, null, 'delete')->isValid()) return;

  //     // In smoothbox
  //     $this->_helper->layout->setLayout('default-simple');

  //     $this->view->form = $form = new Blog_Form_Delete();

  //     if( !$blog ) {
  //         $this->view->status = false;
  //         $this->view->error = Zend_Registry::get('Zend_Translate')->_("Blog entry doesn't exist or not authorized to delete");
  //         return;
  //     }

  //     if( !$this->getRequest()->isPost() ) {
  //         $this->view->status = false;
  //         $this->view->error = Zend_Registry::get('Zend_Translate')->_('Invalid request method');
  //         return;
  //     }

  //     $db = $blog->getTable()->getAdapter();
  //     $db->beginTransaction();

  //     try {
  //         $blog->delete();

  //         $db->commit();
  //     } catch( Exception $e ) {
  //         $db->rollBack();
  //         throw $e;
  //     }

  //     $this->view->status = true;
  //     $this->view->message = Zend_Registry::get('Zend_Translate')->_('Your blog entry has been deleted.');
  //     return $this->_forward('success' ,'utility', 'core', array(
  //         'parentRedirect' => Zend_Controller_Front::getInstance()->getRouter()->assemble(array('action' => 'manage'), 'blog_general', true),
  //         'messages' => Array($this->view->message)
  //     ));
  // }


}
