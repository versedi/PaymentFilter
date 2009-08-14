<?php

/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * @category   RicoNeitzel
 * @package    RicoNeitzel_PaymentFilter
 * @copyright  Copyright (c) 2008 Vinai Kopp http://netzarbeiter.com/
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Add the allowed_payment_methods to the customer_group model
 * 
 * @category	RicoNeitzel
 * @package		RicoNeitzel_PaymentFilter
 * @author		Vinai Kopp <vinai@netzarabeiter.com>
 */

/**
 * @var RicoNeitzel_PaymentFilter_Model_Eav_Setup $this
 * 
 * @see Mage_Sales_Model_Mysql4_Setup
 */
$this->startSetup();

$this->run("
ALTER TABLE {$this->getTable('customer_group')} ADD allowed_payment_methods TEXT NOT NULL DEFAULT '';
");


$this->addAttribute('catalog_product', 'product_payment_methods', array(
	'group'           => 'Prices',
	'type'            => 'varchar',
	'label'           => 'Disable payment methods for this product',
	'input'           => 'multiselect',
	'source'          => 'payfilter/config_source_payment_methods',
	'backend'         => 'payfilter/entity_backend_payment_methods',
	'global'          => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_WEBSITE,
	'required'        => true,
	'default'         => '',
	'user_defined'    => 1,
	'required'        => 0,
	//'apply_to'        => 'simple',
	//'is_configurable' => true
));

$this->endSetup();


// EOF
