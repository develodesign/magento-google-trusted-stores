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
class Develo_Googletrustedstores_Helper_Data extends Mage_Core_Helper_Abstract
{
	const CONFIG_PATH_PARENT                        = "develo_googletrustedstores/";
	const CONFIG_PATH_MERCHANT_ID                   = "develo_googletrustedstores/merchant_data/id";
	const CONFIG_PATH_BADGE_POSITION                = "develo_googletrustedstores/merchant_data/badge_position";
	const CONFIG_PATH_BADGE_CONTAINER               = "develo_googletrustedstores/merchant_data/badge_container";
	const CONFIG_PATH_LOCALE                        = "develo_googletrustedstores/merchant_data/locale";
	const CONFIG_PATH_ORDER_NUMBER_OPTION           = "develo_googletrustedstores/merchant_data/order_number_option";
	const CONFIG_PATH_GOOGLE_BASE_SUBACCOUNT_ID     = "develo_googletrustedstores/googleshopping_fields/google_base_subaccount_id";
	const CONFIG_PATH_GOOGLE_BASE_COUNTRY           = "develo_googletrustedstores/googleshopping_fields/google_base_country";
	const CONFIG_PATH_GOOGLE_BASE_LANGUAGE          = "develo_googletrustedstores/googleshopping_fields/google_base_language";
	const CONFIG_PATH_ORDER_ESTIMATE_SHIPPING_DAYS  = "develo_googletrustedstores/order/estimated_shipping_days";
	const CONFIG_PATH_ORDER_ESTIMATE_DELIVERY_DAYS  = "develo_googletrustedstores/order/estimated_delivery_days";

	/**
	 * Fetch Extension Config Value
	 *
	 * @param $configPath String - see self::constants
	 *
	 * @return Array | String | Int System Config Array or Value
	 */
	public function getExtensionConfig( $configPath = null )
	{
		if ( is_null( $configPath ) ) {
			return Mage::getStoreConfig( self::CONFIG_PATH_PARENT );
		}

		return Mage::getStoreConfig($configPath);
	}
}
