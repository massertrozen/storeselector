<?php
class SkyWex_StoreSelector_Block_Checkout_Onepage_Shipping_Method_Available extends Mage_Checkout_Block_Onepage_Abstract {
    /* Overrided code */
    protected $_rates;
    protected $_address;

    public function getShippingRates() {
        if (empty($this->_rates)) {
            $this->getAddress()->collectShippingRates()->save();

            $groups = $this->getAddress()->getGroupedAllShippingRates();
            /*
            if (!empty($groups)) {
                $ratesFilter = new Varien_Filter_Object_Grid();
                $ratesFilter->addFilter(Mage::app()->getStore()->getPriceFilter(), 'price');

                foreach ($groups as $code => $groupItems) {
                    $groups[$code] = $ratesFilter->filter($groupItems);
                }
            }
            */

            return $this->_rates = $groups;
        }

        return $this->_rates;
    }

    public function getAddress() {
        if (empty($this->_address)) {
            $this->_address = $this->getQuote()->getShippingAddress();
        }

        return $this->_address;
    }

    public function getCarrierName($carrierCode) {
        if ($name = Mage::getStoreConfig('carriers/'.$carrierCode.'/title')) {
            return $name;
        }

        return $carrierCode;
    }

    public function getAddressShippingMethod() {
        return $this->getAddress()->getShippingMethod();
    }

    public function getShippingPrice($price, $flag) {
        return $this->getQuote()->getStore()->convertPrice(Mage::helper('tax')->getShippingPrice($price, $flag, $this->getAddress()), true);
    }
    /* end of overrided code */

    /* SkyWex_StoreSelector Module code */
    public function isModuleEnabled() {
        return Mage::getStoreConfig('carriers/storeselector/enabled');
    }

    public function getModuleTitle() {
        return Mage::getStoreConfig('carriers/storeselector/title');
    }

    public function getStores() {
        $output = array();
        $stores = Mage::getStoreConfig('carriers/storeselector/stores');

        if ($stores) {
            $stores = unserialize($stores);

            if (is_array($stores)) {
                foreach($stores as $storeItem) {
                    $storeTitle = $storeItem['store_title'];
                    array_push($output, $storeTitle);
                }
            }
        }

        return $output;
    }
    /* end of SkyWex_StoreSelector Module code */
}