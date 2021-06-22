INSERT IGNORE INTO `engine4_core_modules` (`name`, `title`, `description`, `version`, `enabled`, `type`) VALUES 
 ('invoice', 'Invoice', 'Can be used o create invoices', '5.5.0', 1, 'extra') ;




-- --------------------------------------------------------

--
-- Table structure for table `engine4_invoice_invoices`
--

DROP TABLE IF EXISTS `engine4_invoice_invoices`;
CREATE TABLE `engine4_invoice_invoices` (
  `invoice_id` int(11) unsigned NOT NULL auto_increment,
  `invoice_number` varchar(128) NOT NULL,
  
  `owner_type` varchar(64) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `owner_id` int(11) unsigned NOT NULL,
  `category_id` int(11) unsigned NOT NULL ,
  `cust_Contact` int(11) unsigned NOT NULL , 
  `cust_Address` varchar(64) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `cust_Email`varchar(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `currency` int(11) unsigned NOT NULL default '0',
  `region` int(11) unsigned NOT NULL default '0',

  `creation_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `view_privacy` VARCHAR(24) NOT NULL default 'owner',
  `networks` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`invoice_id`),
  KEY `owner_type` (`owner_type`, `owner_id`),
  
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;




-- --------------------------------------------------------

--
-- Table structure for table `engine4_invoice_categories`
--

DROP TABLE IF EXISTS `engine4_invoice_categories`;
CREATE TABLE `engine4_invoice_categories` (
  `category_id` int(11) NOT NULL auto_increment,
  `user_id` int(11) unsigned NOT NULL,
  `category_name` varchar(128) NOT NULL,
  PRIMARY KEY (`category_id`),
  KEY `user_id` (`user_id`),
  KEY `category_id` (`category_id`, `category_name`),
  KEY `category_name` (`category_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;






-------------------------------------------------------------------------------------------------

--
-- Table structure for table `engine4_invoice_products`
--

DROP TABLE IF EXISTS `engine4_invoice_products`;
CREATE TABLE `engine4_invoice_products` (
  `product_id` int(11) NOT NULL auto_increment,
  `user_id` int(11) unsigned NOT NULL,
  `product_name` varchar(128) NOT NULL,
  `category_name` varchar(128) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_price` int(11) NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `user_id` (`user_id`),
  
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;


-------------------------------------------------------------------------------------------------

--
-- Table structure for table `engine4_invoice_purchases`
--

DROP TABLE IF EXISTS `engine4_invoice_purchases`;
CREATE TABLE `engine4_invoice_purchases` (
  `invoice_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL ,
  `user_id` int(11) unsigned NOT NULL,
  `product_name` varchar(128) NOT NULL,
  `product_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;





- --------------------------------------------------------

--
-- Dumping data for table `engine4_core_menus`
--

INSERT IGNORE INTO `engine4_core_menus` (`name`, `type`, `title`) VALUES
('invoice_main', 'standard', 'Invoice Main Navigation Menu');



-- --------------------------------------------------------

--
-- Dumping data for table `engine4_core_menuitems`
--

INSERT IGNORE INTO `engine4_core_menuitems` (`name`, `module`, `label`, `plugin`, `params`, `menu`, `submenu`, `order`) VALUES
('core_main_invoice', 'invoice', 'Invoices', '', '{"route":"invoice_general","icon":"fa fa-pencil-alt"}', 'core_main', '', 4),

('invoice_main_manage', 'invoice', 'My Entries', '', '{"route":"invoice_general","action":"index","icon":"fa fa-user"}', 'invoice_main', '', 2),
('invoice_main_create', 'invoice', 'Write New Entry', '', '{"route":"invoice_general","action":"create","icon":"fa fa-pencil-alt"}', 'invoice_main', '', 3),


('core_admin_main_plugins_invoice', 'invoice', 'Invoices', '', '{"route":"admin_default","module":"invoice","controller":"manage"}', 'core_admin_main_plugins', '', 999),

('invoice_admin_main_manage', 'invoice', 'View Invoices', '', '{"route":"admin_default","module":"invoice","controller":"manage"}', 'invoice_admin_main', '', 1),
('invoice_admin_main_settings', 'invoice', 'Global Settings', '', '{"route":"admin_default","module":"invoice","controller":"settings"}', 'invoice_admin_main', '', 2),
('invoice_admin_main_level', 'invoice', 'Member Level Settings', '', '{"route":"admin_default","module":"invoice","controller":"level"}', 'invoice_admin_main', '', 3),
('invoice_admin_main_categories', 'invoice', 'Domains', '', '{"route":"admin_default","module":"invoice","controller":"settings", "action":"categories"}', 'invoice_admin_main', '', 4);
('invoice_admin_main_products', 'invoice', 'Products', '', '{"route":"admin_default","module":"invoice","controller":"settings", "action":"products"}', 'invoice_admin_main', '', 4);
