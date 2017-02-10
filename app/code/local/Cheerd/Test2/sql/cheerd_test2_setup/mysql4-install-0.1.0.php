<?php
$this->startSetup();
$this->addAttribute(catalog_product, 'is_featured', array(
		'group'         => 'General',
		'input'         => 'select',
		'type'          => 'text',
		'label'         => 'Is Featured',
		'backend'       => '',
		'visible'       => true,
		'required'      => false,
		'visible_on_front' => true,
		'global'        => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
		'source' => 'eav/entity_attribute_source_boolean',
		'sort_order'        => 8,
));

$this->endSetup();