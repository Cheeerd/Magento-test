<?php
class Cheerd_Test2_Block_Featured extends Mage_Core_Block_Template
{
	public function getFeaturedProducts()
	{
		$storeId = Mage::app()->getStore()->getId();
		$featuredProducts = Mage::getResourceModel('reports/product_collection')
		->addAttributeToSelect('*')
		->setStoreId($storeId)
		->addStoreFilter($storeId)
		->addAttributeToFilter('is_featured', 1)
		->addAttributeToFilter('status', 1)
		->setPageSize(4);
		return $featuredProducts;
	}
	
	public function getPrice($product)
	{
		$baseCurrencyCode = Mage::app()->getStore()->getBaseCurrencyCode();
		$currentCurrencyCode = Mage::app()->getStore()->getCurrentCurrencyCode();
		
		$price = Mage::helper('directory')->currencyConvert($product->getPrice(), $baseCurrencyCode, $currentCurrencyCode);
		
		return Mage::getModel('directory/currency')
            ->load($currentCurrencyCode)->format($price);
	}
}