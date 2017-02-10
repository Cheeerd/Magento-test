<?php

class Cheerd_Test1_Model_Courier
	extends Mage_Shipping_Model_Carrier_Abstract
	implements  Mage_Shipping_Model_Carrier_Interface
{
	protected $_code = 'cheerd_test1';
	const BICYCLE = 'Bicycle delivery';
	const AUTOMOBILE = 'Automobile delivery';
	
	public function getAllowedMethods()
	{
		return array(
				'bicycle' => Mage::helper('cheerd_test1')->__($this->BYCICLE),
				'automobile' => Mage::helper('cheerd_test1')->__($this->AUTOMOBILE)
		);
	}
	
	public function collectRates(Mage_Shipping_Model_Rate_Request $request)
	{
		$result = Mage::getModel('shipping/rate_result');
		$helper = Mage::helper('cheerd_test1');

		$cost = $request->getPackageValue();
		$bicycleMaxWeight = $helper->getBicycleMaxWeight();

		$totalWeight = 0;
		foreach($request->getAllItems() as $item)
		{
			$totalWeight += $item->getWeight();
		}
		
		if ($request->getDestCity() == $helper->__('Taganrog') && $totalWeight <= $bicycleMaxWeight)
		{
			$result->append($this->getBicycleRate($helper->getBicycleFreeTotalCost() < $cost));
		}
		$result->append($this->getAutomobileRate($helper->getAutomobileFreeTotalCost() < $cost));
		
		return $result;
	}
	
	public function getBicycleRate(bool $free = false)
	{
		/** @var Mage_Shipping_Model_Rate_Result_Method $rate */
		$rate = Mage::getModel('shipping/rate_result_method');
		$helper = Mage::helper('cheerd_test1');
		
		$rate->setCarrier($this->_code);
		$rate->setCarrierTitle($helper->__($this->getConfigData('title')));
		$rate->setMethod('bicycle');
		$rate->setMethodTitle($helper->__(self::BICYCLE));
		$rate->setPrice($free ? 0 : $helper->getBicycleCost());
		$rate->setCost(0);
		
		return $rate;
	}
	
	public function getAutomobileRate(bool $free = false)
	{
		/** @var Mage_Shipping_Model_Rate_Result_Method $rate */
		$rate = Mage::getModel('shipping/rate_result_method');
		$helper = Mage::helper('cheerd_test1');
		
		$rate->setCarrier($this->_code);
		$rate->setCarrierTitle($helper->__($this->getConfigData('title')));
		$rate->setMethod('automobile');
		$rate->setMethodTitle($helper->__(self::AUTOMOBILE));
		$rate->setPrice($free ? 0 : Mage::helper('cheerd_test1')->getAutomobileCost());
		$rate->setCost(0);
		
		return $rate;
	}
}