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

class Develo_Googletrustedstores_Certifiedshop extends Mage_Core_Block_Template
{
    private $_merchantData = 'develo_googletrustedstores/merchant_data/';

    private $_badgePositionRequiresContainer = 'USER_DEFINED';

    /**
     * Get the Merchant's store Id
     *
     * @return string
     */
    public function getStoreId()
    {
        return Mage::getStoreConfig( $this->_merchantData . 'id' );
    }

    /**
     * Get the badge position for the trusted stores badge
     *
     * @return string
     */
    public function getBadgePosition()
    {
        return Mage::getStoreConfig( $this->_merchantData . 'badge_position' );
    }

    /**
     * Does the Certified Shop Badge require a container?
     *
     * @return bool
     */
    public function requiresBadgeContainer()
    {
        return $this->getBadgePosition() == $this->_badgePositionRequiresContainer;
    }

    /**
     * Get the badge container name.
     * Will return an empty string unless badge position is user defined.
     *
     * @return string
     */
    public function getBadgeContainer()
    {
        return $this->requiresBadgeContainer() ?
            Mage::getStoreConfig( $this->_merchantData . 'badge_container' ):
            '';
    }

    /**
     * Get the locale string.
     * If one is not defined will just get the magento store locale setting.
     *
     * @return string
     */
    public function getLocale()
    {
        $locale = Mage::getStoreConfig( $this->_merchantData . 'locale' );

        if( ! $locale )
            $locale = Mage::app()->getLocale()->getLocaleCode();

        return $locale;
    }

    /**
     * Get the Item Google Shopping Id
     *
     * @return mixed
     */
    public function getGoogleBaseOfferId()
    {
        return Mage::getStoreConfig( $this->_merchantData . 'google_base_offer_id' );
    }

    /**
     * Get the Item Google Shopping Account Id
     *
     * @return mixed
     */
    public function getGoogleBaseSubaccountId()
    {
        return Mage::getStoreConfig( $this->_merchantData . 'google_base_subaccount_id' );
    }

    /**
     * Get the item google shopping country
     *
     * @return mixed
     */
    public function getGoogleBaseCountry()
    {
        return Mage::getStoreConfig( $this->_merchantData . 'google_base_country' );
    }

    /**
     * Get the item google shopping language
     */
    public function getGoogleBaseLanguage()
    {
        return Mage::getStoreConfig( $this->_merchantData . 'google_base_language' );
    }

}