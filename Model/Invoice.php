<?php

class Invoice_Model_Invoice extends Core_Model_Item_Abstract{

    protected $_route = 'invoice_general';
//     // protected $_parent_type = 'user';
//     public function getHref($params = array())
//     {
//         // $slug = $this->getSlug();

//         // $params = array_merge(array(
//         //     'route' => 'invoice_entry_view',
//         //     'reset' => true,
//         //     'user_id' => $this->owner_id,
//         //     'invoice_id' => $this->invoice_id,
//         //     'slug' => $slug,
//         // ), $params);
//         // $route = $params['route'];
//         // $reset = $params['reset'];
//         // unset($params['route']);
//         // unset($params['reset']);
//         // return Zend_Controller_Front::getInstance()->getRouter()
//         //     ->assemble($params, $route, $reset);
//     }

//     public function getPhotoUrl($type = null)
//     {
//         if( $this->photo_id ) {
//             return parent::getPhotoUrl($type);
//         }
//         return $this->getOwner()->getPhotoUrl($type);
//     }
// public function comments()
//     {
//         return new Engine_ProxyObject($this, Engine_Api::_()->getDbtable('comments', 'core'));
//     }


//     /**
//      * Gets a proxy object for the like handler
//      *
//      * @return Engine_ProxyObject
//      **/
//     public function likes()
//     {
//         return new Engine_ProxyObject($this, Engine_Api::_()->getDbtable('likes', 'core'));
//     }

//     /**
//      * Gets a proxy object for the tags handler
//      *
//      * @return Engine_ProxyObject
//      **/
//     public function tags()
//     {
//         return new Engine_ProxyObject($this, Engine_Api::_()->getDbtable('tags', 'core'));
//     }
    

//     public function getCategoryItem()
//     {
//         if(!$this->category_id)
//           return false;
//         return Engine_Api::_()->getItem('invoice_category',$this->category_id);
//     }


}

?>