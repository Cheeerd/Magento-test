<?php

class Cheerd_Test1_Helper_Data extends Mage_Core_Helper_Abstract
{
	public function getBicycleMaxWeight()
	{
		return Mage::getStoreConfig('carriers/cheerd_test1/bicycle_max_weight');
	}
	
	public function getBicycleCost()
	{
		return Mage::getStoreConfig('carriers/cheerd_test1/bicycle_cost');
	}
	
	public function getAutomobileCost()
	{
		return Mage::getStoreConfig('carriers/cheerd_test1/automobile_cost');
	}
	
	public function getBicycleFreeTotalCost()
	{
		return Mage::getStoreConfig('carriers/cheerd_test1/bicycle_free_total_cost');
	}
	
	public function getAutomobileFreeTotalCost()
	{
		return Mage::getStoreConfig('carriers/cheerd_test1/automobile_free_total_cost');
	}
	
	public function getCity()
	{
		return Mage::getStoreConfig('carriers/cheerd_test1/city');
	}
}