<?php

class Invoice_Form_Admin_Settings_Level extends Authorization_Form_Admin_Level_Abstract
{
    public function init()
    {
        parent::init();

        // My stuff
        $this
            ->setTitle('Member Level Settings')
            ->setDescription("DEMO_FORM_ADMIN_LEVEL_DESCRIPTION");

        // Element: view
        $this->addElement('Radio', 'view', array(
            'label' => 'Allow Viewing of Invoices?',
            'description' => 'Do you want to let members view Invoices? If set to no, some other settings on this page may not apply.',
            'multiOptions' => array(
                2 => 'Yes, allow viewing of all invoice even private ones.',
                1 => 'Yes, allow viewing of invoice.',
                0 => 'No, do not allow invoice to be viewed.',
            ),
            'value' => ( $this->isModerator() ? 2 : 1 ),
        ));
        if( !$this->isModerator() ) {
            unset($this->view->options[2]);
        }

        if( !$this->isPublic() ) {

            // Element: create
            $this->addElement('Radio', 'create', array(
                'label' => 'Allow Creation of Invoices?',
                'description' => 'Do you want to let members create invoices? If set to no, some other settings on this page may not apply. This is useful if you want members to be able to view blogs, but only want certain levels to be able to create blogs.',
                'multiOptions' => array(
                    1 => 'Yes, allow creation of invoices.',
                    0 => 'No, do not allow invoices to be created.'
                ),
                'value' => 1,
            ));

            // Element: edit
            $this->addElement('Radio', 'edit', array(
                'label' => 'Allow Editing of Invoice?',
                'description' => 'Do you want to let members edit invoice? If set to no, some other settings on this page may not apply.',
                'multiOptions' => array(
                    2 => 'Yes, allow members to edit all invoice.',
                    1 => 'Yes, allow members to edit their own invoice.',
                    0 => 'No, do not allow members to edit their invoice.',
                ),
                'value' => ( $this->isModerator() ? 2 : 1 ),
            ));
            if( !$this->isModerator() ) {
                unset($this->edit->options[2]);
            }

            // Element: delete
            $this->addElement('Radio', 'delete', array(
                'label' => 'Allow Deletion of Invoices?',
                'description' => 'Do you want to let members delete invoice? If set to no, some other settings on this page may not apply.',
                'multiOptions' => array(
                    2 => 'Yes, allow members to delete all invoice.',
                    1 => 'Yes, allow members to delete their own invoice.',
                    0 => 'No, do not allow members to delete their invoice.',
                ),
                'value' => ( $this->isModerator() ? 2 : 1 ),
            ));
            if( !$this->isModerator() ) {
                unset($this->delete->options[2]);
            }

            // Element: comment
            // $this->addElement('Radio', 'comment', array(
            //     'label' => 'Allow Commenting on Invoice?',
            //     'description' => 'Do you want to let members of this level comment on invoice?',
            //     'multiOptions' => array(
            //         2 => 'Yes, allow members to comment on all invoice, including private ones.',
            //         1 => 'Yes, allow members to comment on invoice.',
            //         0 => 'No, do not allow members to comment on invoice.',
            //     ),
            //     'value' => ( $this->isModerator() ? 2 : 1 ),
            // ));
            // if( !$this->isModerator() ) {
            //     unset($this->comment->options[2]);
            // }

            // // Element: auth_view
            // $this->addElement('MultiCheckbox', 'auth_view', array(
            //     'label' => 'Invoice Entry Privacy',
            //     'description' => 'Your members can choose from any of the options checked below when they decide who can see their blog entries. These options appear on your members\' "Add Entry" and "Edit Entry" pages. If you do not check any options, settings will default to the last saved configuration. If you select only one option, members of this level will not have a choice.',
            //     'multiOptions' => array(
            //         'everyone'            => 'Everyone',
            //         'registered'          => 'All Registered Members',
            //         'owner_network'       => 'Friends and Networks',
            //         'owner_member_member' => 'Friends of Friends',
            //         'owner_member'        => 'Friends Only',
            //         'owner'               => 'Just Me'
            //     ),
            //     'value' => array('everyone', 'owner_network', 'owner_member_member', 'owner_member', 'owner'),
            // ));

            // // Element: auth_comment
            // $this->addElement('MultiCheckbox', 'auth_comment', array(
            //     'label' => 'Invoice Comment Options',
            //     'description' => 'Your members can choose from any of the options checked below when they decide who can post comments on their entries. If you do not check any options, settings will default to the last saved configuration. If you select only one option, members of this level will not have a choice.',
            //     'multiOptions' => array(
            //         'everyone'            => 'Everyone',
            //         'registered'          => 'All Registered Members',
            //         'owner_network'       => 'Friends and Networks',
            //         'owner_member_member' => 'Friends of Friends',
            //         'owner_member'        => 'Friends Only',
            //         'owner'               => 'Just Me'
            //     ),
            //     'value' => array('everyone', 'owner_network', 'owner_member_member', 'owner_member', 'owner'),
            // ));

            // // Element: allow_network
            // $this->addElement('Radio', 'allow_network', array(
            //     'label' => 'Allow to Choose Network Privacy?',
            //     'description' => 'Do you want to let members of this level choose Network Privacy for their Invoice? These options appear on your members\' "Add Entry" and "Edit Entry" pages.',
            //     'multiOptions' => array(
            //         1 => 'Yes, allow to choose Network Privacy.',
            //         0 => 'No, do not allow to choose Network Privacy. '
            //     ),
            //     'value' => 1,
            // ));

            // // Element: style
            // $this->addElement('Radio', 'style', array(
            //     'label' => 'Allow Custom CSS Styles?',
            //     'description' => 'If you enable this feature, your members will be able to customize the colors and fonts of their invoice by altering their CSS styles.',
            //     'multiOptions' => array(
            //         1 => 'Yes, enable custom CSS styles.',
            //         0 => 'No, disable custom CSS styles.',
            //     ),
            //     'value' => 1,
            // ));

            // // Element: auth_html
            // $this->addElement('Text', 'auth_html', array(
            //     'label' => 'HTML in Blog Entries?',
            //     'description' => 'If you want to allow specific HTML tags, you can enter them below (separated by commas). Example: b, img, a, embed, font',
            //     'value' => 'strong, b, em, i, u, strike, sub, sup, p, div, pre, address, h1, h2, h3, h4, h5, h6, span, ol, li, ul, a, img, embed, br, hr'
            // ));

            // // Element: max
            // $this->addElement('Text', 'max', array(
            //     'label' => 'Maximum Allowed Blog Entries?',
            //     'description' => 'Enter the maximum number of allowed invoice entries. The field must contain an integer between 1 and 999, or 0 for unlimited.',
            //     'validators' => array(
            //         array('Int', true),
            //         new Engine_Validate_AtLeast(0),
            //     ),
            // ));
            // $this->addElement('FloodControl', 'flood', array(
            //     'label' => 'Maximum Allowed Blog Entries per Duration',
            //     'description' => 'Enter the maximum number of blog entries allowed for the selected duration (per minute / per hour / per day) for members of this level. The field must contain an integer between 1 and 9999, or 0 for unlimited.',
            //     'required' => true,
            //     'allowEmpty' => false,
            //     'value' => array(0, 'minute'),
            // ));
        }
    }
}
