<?php
class SkyWex_StoreSelector_Model_Resource_Order_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract {
    public function _construct() {
        parent::_construct();
        $this->_init('storeselector/order');
    }
}