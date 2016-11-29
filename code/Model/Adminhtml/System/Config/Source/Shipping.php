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
class Develo_GoogletrustedStores_Model_Adminhtml_System_Config_Source_Shipping
{
    private $_maxDays = 10;

    /**
     * Get all valid options as an array
     *
     * @return array
     */
    public function toOptionArray()
    {
        $timeOptions = array();

        for( $i = 1; $i <= $this->_maxDays; $i++ )
        {
            $timeOptions[] = array(

                'label' => Mage::helper('develo_googletrustedstores')->__( $i . ' days' ),
                'value' => $i
            );
        }
        return $timeOptions;
    }
}