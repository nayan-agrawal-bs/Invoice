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
            'onchanged'=> 'checkNumber(this.value)',
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
            'onchanged'=> 'checkEmail(this.value)',
            'autofocus' => 'autofocus',
        ));



        // prepare categories
        $categories = Engine_Api::_()->getDbtable('categories', 'invoice')->getCategoriesAssoc();
        if (count($categories) > 0) {
            $this->addElement('Select', 'category_id', array(
                'id' => 'cate',
                'label' => 'Category',
                'multiOptions' => $categories,
                'onclick' => 'fun(this.value)',
            ));
        }






        $this->addElement('Select', 'product_id', array(
            'label' => 'Products',
            'id' => 'pro',
            'multiple' => 'true',
            'RegisterInArrayValidator' => false,
                'allowEmpty' => true,
                'required' => false,
            // 'style' => 'display:none',
        ));



        $this->addElement('Select', 'currency', array(
            'id' => 'currency',
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
                '1'=> 'Outside Haryana'
            ),
        ));

        $this->addElement('Select', 'status', array(
            'id' => 'status',
            //'decorator'=>'Select the region',
            'label' => 'Status',
            'multiOptions' => array(
                '0'=> 'Pending',
                '1'=> 'Paid'
            ),
        ));

        // $this->addElement('Select', 'draft', array(
        //     'label' => 'Status',
        //     'multiOptions' => array("0"=>"Published", "1"=>"Saved As Draft"),
        //     'description' => 'If this entry is published, it cannot be switched back to draft mode.'
        // ));
        // $this->draft->getDecorator('Description')->setOption('placement', 'append');

        // $allowedHtml = Engine_Api::_()->authorization()->getPermission($userLevel, 'blog', 'auth_html');
        // $uploadUrl = "";

        // if( Engine_Api::_()->authorization()->isAllowed('album', $user, 'create') ) {
        //     $uploadUrl = Zend_Controller_Front::getInstance()->getRouter()->assemble(array('action' => 'upload-photo'), 'blog_general', true);
        // }

        // $editorOptions = array(
        //     'uploadUrl' => $uploadUrl,
        //     'html' => (bool) $allowedHtml,
        // );

        // $this->addElement('TinyMce', 'body', array(
        //     'disableLoadDefaultDecorators' => true,
        //     'required' => true,
        //     'allowEmpty' => false,
        //     'decorators' => array(
        //         'ViewHelper'
        //     ),
        //     'editorOptions' => $editorOptions,
        //     'filters' => array(
        //         new Engine_Filter_Censor(),
        //         new Engine_Filter_Html(array('AllowedTags' => $allowedHtml))),
        // ));

        // $this->addElement('File', 'photo', array(
        //     'label' => 'Choose Profile Photo',
        // ));
        // $this->photo->addValidator('Extension', false, 'jpg,png,gif,jpeg');

        // $this->addElement('Checkbox', 'search', array(
        //     'label' => 'Show this blog entry in search results',
        //     'value' => 1,
        // ));

        // if (Engine_Api::_()->authorization()->isAllowed('blog', $user, 'allow_network')) {
        //     $networkOptions = array();
        //     foreach (Engine_Api::_()->getDbTable('networks', 'network')->fetchAll() as $network) {
        //         $networkOptions[$network->network_id] = $network->getTitle();
        //     }
        //     //Networks
        //     $this->addElement('Multiselect', 'networks', array(
        //         'description' => 'Choose the Networks to which this Blog will be displayed.',
        //         'multiOptions' => $networkOptions,
        //     ));
        // }

        // // Element: auth_view
        // $viewOptions = (array) Engine_Api::_()->authorization()->getAdapter('levels')->getAllowed('blog', $user, 'auth_view');
        // // Element: auth_comment
        // $commentOptions = (array) Engine_Api::_()->authorization()->getAdapter('levels')->getAllowed('blog', $user, 'auth_comment');

        // if( $this->_parent_type == 'user' ) {
        //     $availableLabels = array(
        //         'everyone'            => 'Everyone',
        //         'registered'          => 'All Registered Members',
        //         'owner_network'       => 'Friends and Networks',
        //         'owner_member_member' => 'Friends of Friends',
        //         'owner_member'        => 'Friends Only',
        //         'owner'               => 'Just Me'
        //     );
        //     $viewOptions = array_intersect_key($availableLabels, array_flip($viewOptions));
        //     $commentOptions = array_intersect_key($availableLabels, array_flip($commentOptions));

        // } else if( $this->_parent_type == 'group' ) {

        //     $availableLabels = array(
        //         'everyone'      => 'Everyone',
        //         'registered'    => 'All Registered Members',
        //         'parent_member' => 'Group Members',
        //         'member'        => 'Blog Guests Only',
        //         'owner'         => 'Just Me',
        //     );
        //     $viewOptions = array_intersect_key($availableLabels, array_flip($viewOptions));
        //     $commentOptions = array_intersect_key($availableLabels, array_flip($commentOptions));
        // }

        // if( !empty($viewOptions) && count($viewOptions) >= 1 ) {
        //     // Make a hidden field
        //     if( count($viewOptions) == 1 ) {
        //         $this->addElement('hidden', 'auth_view', array( 'order' => 101, 'value' => key($viewOptions)));
        //         // Make select box
        //     } else {
        //         $this->addElement('Select', 'auth_view', array(
        //             'label' => 'Privacy',
        //             'description' => 'Who may see this blog entry?',
        //             'multiOptions' => $viewOptions,
        //             'value' => key($viewOptions),
        //         ));
        //         $this->auth_view->getDecorator('Description')->setOption('placement', 'append');
        //     }
        // }

        // if( !empty($commentOptions) && count($commentOptions) >= 1 ) {
        //     // Make a hidden field
        //     if( count($commentOptions) == 1 ) {
        //         $this->addElement('hidden', 'auth_comment', array('order' => 102, 'value' => key($commentOptions)));
        //         // Make select box
        //     } else {
        //         $this->addElement('Select', 'auth_comment', array(
        //             'label' => 'Comment Privacy',
        //             'description' => 'Who may post comments on this blog entry?',
        //             'multiOptions' => $commentOptions,
        //             'value' => key($commentOptions),
        //         ));
        //         $this->auth_comment->getDecorator('Description')->setOption('placement', 'append');
        //     }
        // }

        // $this->addElement('Hash', 'token', array(
        //     'timeout' => 3600,
        // ));

        //         $spamSettings = Engine_Api::_()->getApi('settings', 'core')->core_spam;
        //         $recaptchaVersionSettings = Engine_Api::_()->getApi('settings', 'core')->core_spam_recaptcha_version;
        //         if($recaptchaVersionSettings == 0  && $spamSettings['recaptchaprivatev3'] && $spamSettings['recaptchapublicv3']) {
        //           $this->addElement('captcha', 'captcha', Engine_Api::_()->core()->getCaptchaOptions());
        //         }

        // Element: submit
        $this->addElement('Button', 'submit', array(
            'label' => 'Post Entry',
            'type' => 'submit',
        ));
    }

    public function postEntry()
    {
        $values = $this->getValues();

        $user = Engine_Api::_()->user()->getViewer();
        $title = $values['title'];
        $body = $values['body'];
        $category_id = $values['category_id'];
        $tags = preg_split('/[,]+/', $values['tags']);

        $db = Engine_Db_Table::getDefaultAdapter();
        $db->beginTransaction();
        try {
            // Transaction
            $table = Engine_Api::_()->getDbtable('blogs', 'blog');

            // insert the blog entry into the database
            $row = $table->createRow();
            $row->owner_id   =  $user->getIdentity();
            $row->owner_type = $user->getType();
            $row->category_id = $category_id;
            $row->creation_date = date('Y-m-d H:i:s');
            $row->modified_date   = date('Y-m-d H:i:s');
            $row->title   = $title;
            $row->body   = $body;
            //$row->category_id = $category_id;
            $row->save();

            $blogId = $row->blog_id;

            if ($tags) {
                $this->handleTags($blogId, $tags);
            }

            $attachment = Engine_Api::_()->getItem($row->getType(), $blogId);
            $action = Engine_Api::_()->getDbtable('actions', 'activity')->addActivity($user, $row, 'blog_new');
            Engine_Api::_()->getDbtable('actions', 'activity')->attachActivity($action, $attachment);
            $db->commit();
        } catch (Exception $e) {
            $db->rollBack();
            throw $e;
        }
    }

    public function handleTags($blogId, $tags)
    {
        $tagTable = Engine_Api::_()->getDbtable('tags', 'blog');
        $tabMapTable = Engine_Api::_()->getDbtable('tagmaps', 'blog');
        $tagDup = array();
        foreach ($tags as $tag) {

            $tag = htmlspecialchars((trim($tag)));
            if (!in_array($tag, $tagDup) && $tag != "" && strlen($tag) <  20) {
                $tagId = $this->checkTag($tag);
                // check if it is new. if new, createnew tag. else, get the tag_id and insert
                if (!$tagId) {
                    $tagId = $this->createNewTag($tag, $blogId, $tagTable);
                }

                $tabMapTable->insert(array(
                    'blog_id' => $blogId,
                    'tag_id' => $tagId
                ));
                $tagDup[] = $tag;
            }
            if (strlen($tag) >= 20) {
                $this->_error[] = $tag;
            }
        }
    }

    public function checkTag($text)
    {
        $table = Engine_Api::_()->getDbtable('tags', 'blog');
        $select = $table->select()->order('text ASC')->where('text = ?', $text);
        $results = $table->fetchRow($select);
        $tagId = "";
        if ($results) $tagId = $results->tag_id;
        return $tagId;
    }

    public function createNewTag($text, $blogId, $tagTable)
    {
        $row = $tagTable->createRow();
        $row->text =  $text;
        $row->save();
        $tagId = $row->tag_id;

        return $tagId;
    }
}
