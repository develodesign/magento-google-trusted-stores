<?php
/**
 *
 * @author  Joel Hart @Mediotype
 */
class Develo_Googletrustedstores_Model_System_Config_Source_OrderNumberOption{


    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {

        $options = array(
	        array(
		          'value' =>'entity_id',
	              'label' => Mage::helper('adminhtml')->__('Entity ID')
	        ),
	        array(
		          'value' => 'increment_id',
	              'label' => Mage::helper('adminhtml')->__('Increment ID')
	        ),
        );

        return $options;

    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        $options = array(
	        "entity_id"      => Mage::helper('adminhtml')->__('Entity ID'),
	        "increment_id"   => Mage::helper('adminhtml')->__('Increment ID')
        );

        return $options;
    }

}