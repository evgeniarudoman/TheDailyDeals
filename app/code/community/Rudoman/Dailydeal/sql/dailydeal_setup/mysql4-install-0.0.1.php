<?php

/**
 * dailydeal_setup
 * 
 * @category    Rudoman
 * @package     Rudoman_Dailydeal
 * @author      Evgenia Rudoman (evgenia.rudoman@gmail.com)
 */
/* @var $installer Rudoman_Dailydeal_Model_Mysql4_Setup */
$installer = $this;
$installer->startSetup();
$installer->addAttributeGroup('catalog_product', 'Default', 'Daily Deals', 1000);
$installer->addAttribute('catalog_product', 'is_active_deals', array(
    'group' => 'Daily Deals',
    'input' => 'select',
    'type' => 'int',
    'label' => 'Active',
    'source' => 'eav/entity_attribute_source_boolean',
    'default_value' => 0,
    'visible' => 1,
    'required' => 0,
    'user_defined' => 1,
    'searchable' => 0,
    'filterable' => 0,
    'comparable' => 0,
    'visible_on_front' => 0,
    'visible_in_advanced_search' => 0,
    'is_html_allowed_on_front' => 0,
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
));
$installer->addAttribute('catalog_product', 'deals_from_date', array(
    'group' => 'Daily Deals',
    'input' => 'date',
    'type' => 'datetime',
    'label' => 'Start date and time',
    'backend' => "rudoman_dailydeal/eav_entity_attribute_backend_datetime",
    'input_renderer' => 'rudoman_dailydeal/varien_data_form_element_date',
    'visible' => 1,
    'required' => 0,
    'user_defined' => 1,
    'searchable' => 0,
    'filterable' => 0,
    'comparable' => 0,
    'visible_on_front' => 0,
    'visible_in_advanced_search' => 0,
    'is_html_allowed_on_front' => 0,
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
));
$installer->addAttribute('catalog_product', 'deals_to_date', array(
    'group' => 'Daily Deals',
    'input' => 'date',
    'type' => 'datetime',
    'label' => 'End date and time',
    'backend' => "rudoman_dailydeal/eav_entity_attribute_backend_datetime",
    'input_renderer' => 'rudoman_dailydeal/varien_data_form_element_date',
    'note' => 'Don\'t forget to set timezone in System &rarr; Config &rarr; General &rarr; Locale &rarr; Timezone',
    'visible' => 1,
    'required' => 0,
    'user_defined' => 1,
    'searchable' => 0,
    'filterable' => 0,
    'comparable' => 0,
    'visible_on_front' => 0,
    'visible_in_advanced_search' => 0,
    'is_html_allowed_on_front' => 0,
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
));