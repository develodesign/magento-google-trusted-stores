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
class Develo_Googletrustedstores_Model_Badgeposition
{

    /**
     * Get all valid options as an array
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(

            array(

                'label' => Mage::helper('develo_googletrustedstores')->__('Bottom Right'),
                'value' => 'BOTTOM_RIGHT'
            ),

            array(

                'label' => Mage::helper('develo_googletrustedstores')->__('Bottom Left'),
                'value' => 'BOTTOM_LEFT'
            ),

            array(

                'label' => Mage::helper('develo_googletrustedstores')->__('User Defined'),
                'value' => 'USER_DEFINED'
            ),
        );
    }

}