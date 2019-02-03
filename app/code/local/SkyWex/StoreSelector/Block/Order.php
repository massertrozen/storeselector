<?php
class SkyWex_StoreSelector_Block_Order extends Mage_Core_Block_Template {
    public function isModuleEnabled() {
        return Mage::getStoreConfig('carriers/storeselector/enabled');
    }

    public function getModuleTitle() {
        return Mage::getStoreConfig('carriers/storeselector/title');
    }

    public function getOrderStore() {
        $orderId = Mage::registry('current_order')->getId();
        $orderModel = Mage::getModel('storeselector/order');
        $storeTitle = $orderModel->load($orderId, 'order_id')->getStoreTitle();

        return $storeTitle;
    }       
}