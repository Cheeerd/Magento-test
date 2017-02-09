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
				'bicycle' => $this->BYCICLE,
				'automobile' => $this->AUTOMOBILE
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
		
		if ($request->getDestCity() == 'Taganrog' && $totalWeight <= $bicycleMaxWeight)
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
		
		$rate->setCarrier($this->_code);
		$rate->setCarrierTitle($this->getConfigData('title'));
		$rate->setMethod('bicycle');
		$rate->setMethodTitle(self::BICYCLE);
		$rate->setPrice($free ? 0 : Mage::helper('cheerd_test1')->getBicycleCost());
		$rate->setCost(0);
		
		return $rate;
	}
	
	public function getAutomobileRate(bool $free = false)
	{
		/** @var Mage_Shipping_Model_Rate_Result_Method $rate */
		$rate = Mage::getModel('shipping/rate_result_method');
		
		$rate->setCarrier($this->_code);
		$rate->setCarrierTitle($this->getConfigData('title'));
		$rate->setMethod('automobile');
		$rate->setMethodTitle(self::AUTOMOBILE);
		$rate->setPrice($free ? 0 : Mage::helper('cheerd_test1')->getAutomobileCost());
		$rate->setCost(0);
		
		return $rate;
	}
}