<?php
class SkyWex_StoreSelector_Model_Observer {
    // gets selected store title on checkout and saves to session;
    public function checkout_controller_onepage_save_shipping_method($event) {
        $request = $event->getRequest();
        $isStoreSelected = $request->getParam('isStoreSelected');
        $storeTitle = $request->getParam('delivery_store');

        Mage::getSingleton('checkout/session')->setIsStoreSelected(false); // resets value;

        if ($isStoreSelected) {
            Mage::getSingleton('checkout/session')->setIsStoreSelected(true);
            Mage::getSingleton('checkout/session')->setStoreTitle($storeTitle);
        }
    }

    // connects selected store to order in custom db table;
    public function checkout_submit_all_after($observer) {
        $order = $observer->getEvent()->getOrder();
        $isStoreSelected = Mage::getSingleton('checkout/session')->getIsStoreSelected();
        $storeTitle = Mage::getSingleton('checkout/session')->getStoreTitle();

        if ($isStoreSelected) {
            $orderData = array(
                'order_id' => $order->getId(),
                'store_title' => $storeTitle
            ); 
    
            $updateOrderModel = Mage::getModel('storeselector/order')->setData($orderData)->save();
        }       

        return true;
    }
}