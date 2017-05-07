<?php

/**
 * Develo_Googletrustedstores extension
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 *
 * @category       Develo
 * @package        Develo_Googletrustedstores
 * @copyright      Copyright (c) 2015
 * @license        http://opensource.org/licenses/mit-license.php MIT License
 */
class Develo_Googletrustedstores_Model_Adminhtml_System_Config_Source_Ordernumberoption
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = array(
            array(
                'value' => 'entity_id',
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
            "entity_id" => Mage::helper('adminhtml')->__('Entity ID'),
            "increment_id" => Mage::helper('adminhtml')->__('Increment ID')
        );

        return $options;
    }
}