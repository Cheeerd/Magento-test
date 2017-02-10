<?php
class Cheerd_Test2_Block_Featured extends Mage_Catalog_Block_Product_Abstract
{
	public function getFeaturedProducts()
	{
		$storeId = Mage::app()->getStore()->getId();
		$featuredProducts = Mage::getResourceModel('catalog/product_collection')
		->addAttributeToSelect('*')
		->setStoreId($storeId)
		->addAttributeToFilter('is_featured', 1)
		->addAttributeToFilter('status', Mage_Catalog_Model_Product_Status::STATUS_ENABLED)
		->setPageSize(4);
		return $featuredProducts;
	}
}