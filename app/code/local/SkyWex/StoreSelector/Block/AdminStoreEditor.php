<?php
// adds table with stores editor in admin panel;
class SkyWex_StoreSelector_Block_AdminStoreEditor extends Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract {
    public function _prepareToRender() {
        $this->addColumn('store_title', array(
            'label' => Mage::helper('storeselector')->__('Title'),
            'style' => 'width:100px',
        ));

        $this->_addAfter = false;
        $this->_addButtonLabel = Mage::helper('storeselector')->__('Add');
    }
}