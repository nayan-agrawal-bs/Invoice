<?php return array (
  'package' => 
  array (
    'type' => 'module',
    'name' => 'invoice',
    'version' => '5.5.0',
    'path' => 'application/modules/Invoice',
    'title' => 'Invoice',
    'description' => 'Can be used o create invoices',
    'author' => 'admin',
    'callback' => 
    array (
      'class' => 'Engine_Package_Installer_Module',
    ),
    'actions' => 
    array (
      0 => 'install',
      1 => 'upgrade',
      2 => 'refresh',
      3 => 'enable',
      4 => 'disable',
    ),
    'callback' => array(
      'path' => 'application/modules/Invoice/settings/install.php',
      'class' => 'Invoice_Installer',
    ),
    'directories' => 
    array (
      0 => 'application/modules/Invoice',
    ),
    'files' => 
    array (
      0 => 'application/languages/en/invoice.csv',
    ),
  ),

  'hooks' => array(
    array(
      'event' => 'onUserDeleteBefore',
      'resource' => 'Invoice_Plugin_Core',
    ),
  ),

  'items' => array(
    'invoice',
    'invoice_category',
    'invoice_product',
    'invoice_purchase'
  ),
  
  'routes' => array(
    // Public
    
    'invoice_general' => array(
      'route' => 'invoice/:action/*',
      'defaults' => array(
        'module' => 'invoice',
        'controller' => 'index',
        'action' => 'index',
      ),
      'reqs' => array(
        'action' => '(index|create|demo)',
      ),
    ),
    'invoice_specific' => array(
      'route' => 'invoice/:action/:invoice_id/*',
      'defaults' => array(
        'module' => 'invoice',
        'controller' => 'index',
        'action' => 'edit',
      ),
      'reqs' => array(
        'invoice_id' => '\d+',
        'action' => '(delete|edit|view)',
      ),
    ),
    'invoice_default' => array(
      'route' => 'invoice/:action',
      'defaults' => array(
        'module' => 'invoice',
        'controller' => 'index',
        'action' => 'index',
      ),
      'reqs' => array(
        'action' => '(index|demo)',
      ),  
    ),
    
  ),
); ?>