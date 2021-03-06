INSERT IGNORE INTO `engine4_core_modules` (`name`, `title`, `description`, `version`, `enabled`, `type`) VALUES 
 ('invoice', 'Invoice', 'Can be used to create invoices', '5.5.0', 1, 'extra') ;






--
-- Table structure for table `engine4_invoice_invoices`
--

DROP TABLE IF EXISTS `engine4_invoice_invoices`;
CREATE TABLE `engine4_invoice_invoices` (
  `invoice_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `owner_type` varchar(64) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `owner_id` int UNSIGNED NOT NULL,
  `cust_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `cust_contact` int UNSIGNED NOT NULL,
  `cust_address` varchar(64) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `cust_email` varchar(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `currency` int UNSIGNED NOT NULL DEFAULT '0',
  `region` int UNSIGNED NOT NULL DEFAULT '0',
  `creation_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `category_id` int NOT NULL,
  `discount` int NOT NULL DEFAULT '0',
  `status` int NOT NULL,
  `amount` int NOT NULL,
  `subtotal` int NOT NULL,
  `SGST` int NOT NULL,
  `CGST` int NOT NULL,
  `IGST` int NOT NULL,
  PRIMARY KEY (`invoice_id`),
  KEY `owner_type` (`owner_type`,`owner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;






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








--
-- Table structure for table `engine4_invoice_products`
--

DROP TABLE IF EXISTS `engine4_invoice_products`;
CREATE TABLE `engine4_invoice_products` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED NOT NULL,
  `product_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int NOT NULL,
  `product_price` int NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;




--
-- Table structure for table `engine4_invoice_purchases`
--

DROP TABLE IF EXISTS `engine4_invoice_purchases`;
CREATE TABLE `engine4_invoice_purchases` (
  `purchase_id` int NOT NULL  AUTO_INCREMENT,
  `invoice_number` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `product_id` int NOT NULL,
  `cust_email` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `product_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `product_price` int NOT NULL,
  `purchase_date` date NOT NULL,
  PRIMARY KEY (`purchase_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
















--
-- Dumping data for table `engine4_core_menus`
--

INSERT IGNORE INTO `engine4_core_menus` (`name`, `type`, `title`) VALUES
('invoice_main', 'standard', 'Invoice Main Navigation Menu');





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
('invoice_admin_main_categories', 'invoice', 'Domains', '', '{"route":"admin_default","module":"invoice","controller":"settings", "action":"categories"}', 'invoice_admin_main', '', 4),
('invoice_admin_main_products', 'invoice', 'Products', '', '{"route":"admin_default","module":"invoice","controller":"settings", "action":"products"}', 'invoice_admin_main', '', 5);










--
-- Creator 
--

INSERT INTO engine4_authorization_levels ( title, description, type, flag) 
VALUES ('Creator', 'Invoice Creator', 'user', NULL);





--
-- Dumping data for table `engine4_authorization_permissions`
--

INSERT INTO `engine4_authorization_permissions` (`level_id`, `type`, `name`, `value`, `params`) VALUES
(1, 'invoice', 'create', 1, NULL),
(1, 'invoice', 'delete', 2, NULL),
(1, 'invoice', 'edit', 2, NULL),
(1, 'invoice', 'view', 2, NULL),
(6, 'invoice', 'create', 1, NULL),
(6, 'invoice', 'delete', 1, NULL),
(6, 'invoice', 'edit', 1, NULL),
(6, 'invoice', 'view', 1, NULL);





--
-- Dumping data for table `engine4_core_settings`
--

INSERT INTO `engine4_core_settings` (`name`, `value`) VALUES
('invoice.baccname', 'bstep'),
('invoice.baccnumber', '9887954625'),
('invoice.baddress', 'C&&'),
('invoice.bname', 'HDFC'),
('invoice.caddress', 'XYZ'),
('invoice.CGST', '9'),
('invoice.cname', 'BIG STEP'),
('invoice.cnum', '1234569870'),
('invoice.gstno', '434343434'),
('invoice.ifsc', 'HDFC0088'),
('invoice.IGST', '18'),
('invoice.page', '5'),
('invoice.SGST', '9'),
('invoice.USDtoINR', '75');