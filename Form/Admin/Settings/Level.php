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

        }
    }
}
