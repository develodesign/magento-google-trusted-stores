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
    protected $_merchantData = 'develo_googletrustedstores/merchant_data/';

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
        return Mage::getStoreConfig( $this->_merchantData . 'google_base_subaccount_id' );
    }

    /**
     * Get the shopping country
     *
     * @return mixed
     */
    public function getItemGoogleShoppingCountry()
    {
        return Mage::getStoreConfig( $this->_merchantData . 'google_base_country' );
    }

    /**
     * Get the google shopping language
     *
     * @return mixed
     */
    public function getItemGoogleShoppingLanguage()
    {
        return Mage::getStoreConfig( $this->_merchantData . 'google_base_language' );
    }
}