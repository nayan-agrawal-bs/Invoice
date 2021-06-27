<?php

class Invoice_Form_Create extends Engine_Form
{
    // public $_error = array();

    // protected $_parent_type;

    // protected $_parent_id;

    // public function setParent_type($value)
    // {
    //     $this->_parent_type = $value;
    // }

    // public function setParent_id($value)
    // {
    //     $this->_parent_id = $value;
    // }

    public function init()
    {
        $this->setTitle('Write New Entry')
            ->setDescription('Compose your new  entry below, then click "Post Entry" to publish the entry to your blog.')
            ->setAttrib('name', 'Invoice_create');
        $user = Engine_Api::_()->user()->getViewer();
        $userLevel = Engine_Api::_()->user()->getViewer()->level_id;

        $this->addElement('Text', 'cust_name', array(
            'label' => 'Customer\'s Name',
            'allowEmpty' => false,
            'required' => true,
            'maxlength' => '63',

            'filters' => array(
                new Engine_Filter_Censor(),
                'StripTags',
                new Engine_Filter_StringLength(array('max' => '63'))
            ),
            'autofocus' => 'autofocus',
        ));

        $this->addElement('Text', 'cust_contact', array(
            'label' => 'Customer\'s Contact Number',
            'allowEmpty' => false,
            'required' => true,
            'maxlength' => '10',
            //'onchanged'=> 'checkNumber(this.value)',
            'autofocus' => 'autofocus',
        ));

        $this->addElement('Text', 'cust_address', array(
            'label' => 'Customer\'s address',
            'allowEmpty' => false,
            'required' => true,
            'maxlength' => '63',
            'filters' => array(
                new Engine_Filter_Censor(),
                'StripTags',
                new Engine_Filter_StringLength(array('max' => '63'))
            ),
            'autofocus' => 'autofocus',
        ));

        $this->addElement('Text', 'cust_email', array(
            'label' => 'Customer\'s Email',
            'allowEmpty' => false,
            'required' => true,
            'inputtype' => 'email',
            'maxlength' => '32',
            //'onchanged'=> 'checkEmail(this.value)',
            'autofocus' => 'autofocus',
        ));



        // prepare categories
        $categories = Engine_Api::_()->getDbtable('categories', 'invoice')->getCategoriesAssoc();
        if (count($categories) > 0) {
            $this->addElement('Select', 'category_id', array(
                'id' => 'cate',
                'label' => 'Category',
                'allowEmpty' => false,
            'required' => true,
                'multiOptions' => $categories,
                'onclick' => 'fun(this.value)',
            ));
        }


        $this->addElement('Select', 'product_id', array(
            'label' => 'Products',
            'id' => 'pro',
            'multiple' => 'true',
            'allowEmpty' => false,
            'required' => true,
            'RegisterInArrayValidator' => false,
                'allowEmpty' => true,
                'required' => false,
            // 'style' => 'display:none',
        ));



        $this->addElement('Select', 'currency', array(
            'id' => 'currency',
            'allowEmpty' => false,
            'required' => true,
            //'decorator'=>'Select the currency',
            'label' => 'Currency',
            'multiOptions' => array(
                '0'=> 'USD',
                '1'=> 'INR'
            ),
            'onchange' => 'isUSD(this.value)',
        ));


        $this->addElement('Select', 'region', array(
            'id' => 'region',
            //'decorator'=>'Select the region',
            'label' => 'Region',
            'multiOptions' => array(
                '0'=> 'Haryana',
                '1'=> 'Out Of Haryana'
            ),
        ));

        $this->addElement('Text', 'discount', array(
            'label' => 'Discount % ',
            'allowEmpty' => true,
            'maxlength' => '3',
            //'onchanged'=> 'checkEmail(this.value)',
            'autofocus' => 'autofocus',
        ));

        $this->addElement('Select', 'status', array(
            'allowEmpty' => false,
            'required' => true,
            'id' => 'status',
            //'decorator'=>'Select the region',
            'label' => 'Status',
            'multiOptions' => array(
                '0'=> 'Pending',
                '1'=> 'Paid'
            ),
        ));

        

        // Element: submit
        $this->addElement('Button', 'submit', array(
            'label' => 'Post Entry',
            'type' => 'submit',
        ));
    }

}
