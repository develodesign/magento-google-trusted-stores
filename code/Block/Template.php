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
class Develo_Googletrustedstores_Block_Template extends Mage_Core_Block_Template
{

    /**
     * Get the Item Google Shopping Account Id
     * This is the current product.
     *
     * @return mixed
     */
    public function getItemGoogleShoppingId()
    {
        $currentProduct = Mage::Registry( 'current_product' );

        return $currentProduct ? $currentProduct->getSku() : false;
    }

    /**
     * Get the Item Google Shopping Account Id
     *
     * @return mixed
     */
    public function getItemGoogleShoppingAccountId()
    {
        return $this->getGTSHelper()->getExtensionConfig(
            Develo_Googletrustedstores_Helper_Data::CONFIG_PATH_GOOGLE_BASE_SUBACCOUNT_ID
        );
    }

    /**
     * Get the shopping country
     *
     * @return mixed
     */
    public function getItemGoogleShoppingCountry()
    {
        return $this->getGTSHelper()->getExtensionConfig(
            Develo_Googletrustedstores_Helper_Data::CONFIG_PATH_GOOGLE_BASE_COUNTRY
        );
    }

    /**
     * Get the google shopping language
     *
     * @return mixed
     */
    public function getItemGoogleShoppingLanguage()
    {
        return $this->getGTSHelper()->getExtensionConfig(
            Develo_Googletrustedstores_Helper_Data::CONFIG_PATH_GOOGLE_BASE_LANGUAGE
        );
    }

    /**
     * Get Develo GTS Helper
     *
     * @return Develo_Googletrustedstores_Helper_Data
     */
    public function getGTSHelper()
    {
        return Mage::helper('develo_googletrustedstores');
    }
}