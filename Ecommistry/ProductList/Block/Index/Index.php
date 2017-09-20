<?php
/**
 * Customer Product list.
 *
 * @category  Ecommistry
 * @package   Ecommistry_Productlist
 * @author    Sumil
 * 
 */
namespace Ecommistry\ProductList\Block\Index;
use Magento\Catalog\Block\Product\ListProduct;

class Index extends ListProduct {
   public function getProductCollection() {
		$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		$scopeConfig = $objectManager->create('Magento\Framework\App\Config\ScopeConfigInterface');
		$configPath = 'productlist/options/limit';
	    $value =  $scopeConfig->getValue(
	        $configPath,
	        \Magento\Store\Model\ScopeInterface::SCOPE_STORE
	    );
		$visibleProducts = $objectManager->create('\Magento\Catalog\Model\Product\Visibility')->getVisibleInCatalogIds();
		$collection = $objectManager->create('\Magento\Catalog\Model\ResourceModel\Product\Collection')->setVisibility($visibleProducts);
		$collection->addMinimalPrice()
			->addFinalPrice()
			->addTaxPercents()
			->addAttributeToSelect('*')
			->addStoreFilter($this->getStoreId())
			->setPageSize($value) // only get 10 products 
        	->setCurPage(1);
		
		$collection->addAttributeToFilter('handle_display' , '1');
		return $collection;
	}

	public function getCurrentMode() {
		$mode = $this->getRequest()->getParam('mode');
		if(isset($mode) && $mode!=''){
			return $mode;
		}		
	}
}