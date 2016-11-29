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
class Develo_Googletrustedstores_Block_Certifiedshop extends Develo_Googletrustedstores_Block_Template
{

	private $_badgePositionRequiresContainer = 'USER_DEFINED';

	/**
	 * Get the Merchant's store Id
	 *
	 * @return string
	 */
    public function getStoreId()
    {
		return $this->getGTSHelper()->getExtensionConfig(
			Develo_Googletrustedstores_Helper_Data::CONFIG_PATH_MERCHANT_ID
		);
	}

	/**
	 * Get the badge position for the trusted stores badge
	 *
	 * @return string
	 */
    public function getBadgePosition()
    {
		return $this->getGTSHelper()->getExtensionConfig(
			Develo_Googletrustedstores_Helper_Data::CONFIG_PATH_BADGE_POSITION
		);
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
		return $this->requiresBadgeContainer() ? $this->getGTSHelper()->getExtensionConfig(
			Develo_Googletrustedstores_Helper_Data::CONFIG_PATH_BADGE_CONTAINER
		) : '';
	}

	/**
	 * Get the locale string.
	 * If one is not defined will just get the magento store locale setting.
	 *
	 * @return string
	 */
    public function getLocale()
    {
		$locale = $this->getGTSHelper()->getExtensionConfig(
			Develo_Googletrustedstores_Helper_Data::CONFIG_PATH_LOCALE
		);

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
		return $this->getItemGoogleShoppingId();
	}

	/**
	 * Get the Item Google Shopping Account Id
	 *
	 * @return mixed
	 */
    public function getGoogleBaseSubaccountId()
    {
		return $this->getItemGoogleShoppingAccountId();
	}

	/**
	 * Get the item google shopping country
	 *
	 * @return mixed
	 */
    public function getGoogleBaseCountry()
    {
		return $this->getItemGoogleShoppingCountry();
	}

	/**
	 * Get the item google shopping language
	 */
    public function getGoogleBaseLanguage()
    {
		return $this->getItemGoogleShoppingLanguage();
	}
}