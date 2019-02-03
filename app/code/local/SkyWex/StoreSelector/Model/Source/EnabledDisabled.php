<?php
class SkyWex_StoreSelector_Model_Source_EnabledDisabled {
    const ENABLED = 1;
    const DISABLED = 0;

    public function toOptionArray() {
        return array(
            array('value' => self::ENABLED, 'label' => Mage::helper('storeselector')->__('On')),
            array('value' => self::DISABLED, 'label' => Mage::helper('storeselector')->__('Off')),
        );
    }

    public function toArray() {
        return array(
            self::ENABLED => Mage::helper('storeselector')->__('On'),
            self::DISABLED => Mage::helper('storeselector')->__('Off'),            
        );
    }
}