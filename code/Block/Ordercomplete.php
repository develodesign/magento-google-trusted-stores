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
class Develo_Googletrustedstores_Block_Ordercomplete extends Develo_Googletrustedstores_Block_Template
{
    private $_dateFormat = 'Y-m-d';

    private $_hasDigitalProducts = false;

    private $_hasBackOrder = false;

    public $order;

    /**
     * Get the order and customer information.
     */
    protected function _construct()
    {
        $this->order = $this->getOrder();

        $this->_prepareOrderData();

        parent::_construct();
    }

    /**
     * Should be called before the page has rendered.
     * Spin through all the order items and work out if:
     * - The order contains digital products.
     * - The order contains an item which is on back order.
     */
    private function _prepareOrderData()
    {
        foreach( $this->getOrderItems() as $item )
        {
            if( $item->getProductType() == 'virtual' )
                $this->_hasDigitalProducts = true;

            if( $item->getQtyBackordered() )
                $this->_hasBackOrder = true;
        }
    }

    /**
     * Add days to date
     *
     * @param $date
     * @param $daysToAdd
     *
     * @return bool|string
     */
    private function _addDays( $date, $daysToAdd )
    {
        return date( $this->_dateFormat, strtotime( $date . ' + ' . $daysToAdd . ' days' ) );
    }

    /**
     * Calculates the estimated shipping date based on the settings defined in the system config
     *
     * @param $type string containing either shipping or delivery
     *
     * @return string
     */
    private function _getEstimatedDays( $type = 'shipping' )
    {
        $today = date( $this->_dateFormat );

        $shippingDays = $this->getGTSHelper()->getExtensionConfig(

            $type == 'shipping' ?
                Develo_Googletrustedstores_Helper_Data::CONFIG_PATH_ORDER_ESTIMATE_SHIPPING_DAYS:
                Develo_Googletrustedstores_Helper_Data::CONFIG_PATH_ORDER_ESTIMATE_DELIVERY_DAYS

        );

        return $this->_addDays( $today, $shippingDays );
    }

    /**
     * Does the order contain digital products?
     *
     * @return bool
     */
    public function doesOrderContainDigitalProducts()
    {
        return $this->_hasDigitalProducts;
    }

    /**
     * Does the order contain a back order?
     *
     * @return bool
     */
    public function doesOrderContainBackOrder()
    {
        $containsBackOrder = false;

        foreach( $this->getOrderItems() as $item )
        {
            if( $item->getQtyBackordered() )
                $containsBackOrder = true;
        }

        return $containsBackOrder;
    }

    /**
     * Format a number for google.
     *
     * @param $number
     *
     * @return string
     */
    public function formatNumberForGoogle( $number )
    {
        return number_format( $number, 2, '.', '' );
    }

    /**
     * Gets the items price in a format google expects.
     *
     * @param $item
     *
     * @return string
     */
    public function getPriceForItem( $item )
    {
        return $this->formatNumberForGoogle( $item->getPrice() );
    }

    /**
     * Get the order total
     */
    public function getOrderTotal()
    {
        return $this->formatNumberForGoogle( $this->order->getGrandTotal() );
    }

    /**
     * Get any order discounts applied to the cart.
     *
     * @return float negative
     */
    public function getOrderDiscounts()
    {
        return $this->formatNumberForGoogle( $this->order->getDiscountAmount() );
    }

    /**
     * Get the order shipping amount.
     *
     * @return float
     */
    public function getOrderShipping()
    {
        return $this->formatNumberForGoogle( $this->order->getShippingAmount() );
    }

    /**
     * Get the total amount taxed.
     *
     * @return float
     */
    public function getOrderTax()
    {
        return $this->formatNumberForGoogle( $this->order->getTaxInvoiced() );
    }

    /**
     * Retrieve order model instance
     *
     * @return Mage_Sales_Model_Order
     */
    public function getOrder()
    {
        return Mage::getModel('sales/order')->loadByIncrementId( Mage::getSingleton('checkout/session')->getLastRealOrderId() );
    }

    /**
     * Get the order id.
     *
     * @return mixed
     */
    public function getOrderId()
    {
        $orderNumberOption = $this->getGTSHelper()->getExtensionConfig(
            Develo_Googletrustedstores_Helper_Data::CONFIG_PATH_ORDER_NUMBER_OPTION
        );

        if($orderNumberOption == 'increment_id'){
            return $this->order->getIncrementId();
        }

        return $this->order->getId();
    }

    /**
     * Get all the order items on the order
     *
     * @return mixed
     */
    public function getOrderItems()
    {
        return $this->order->getAllVisibleItems();
    }

    /**
     * Get the merchant order domain formatted for google.
     *
     * @return string
     */
    public function getMerchantOrderDomain()
    {
        return strstr( str_replace( 'http://', '', str_replace( 'https://', '', $this->getUrl() ) ), '/', true );
    }

    /**
     * Get the customer model
     *
     * @return Mage_Customer_Model
     */
    public function getCustomer()
    {
        return Mage::getModel( 'customer/customer' )->load( $this->order->getCustomerId() );
    }

    /**
     * Returns the store's currency code.
     *
     * @return string
     */
    public function getCurrency()
    {
        return Mage::app()->getStore()->getCurrentCurrencyCode();
    }

    /**
     * Get the customer's country
     *
     * @return string
     */
    public function getCustomerCountry()
    {
        return $this->order->getShippingAddress()->getCountry();
    }

    /**
     * Calculates the estimated shipping date based on the settings defined in the system config
     *
     * @return string
     */
    public function getEstimatedShippingDate()
    {
        return $this->_getEstimatedDays( 'shipping' );
    }

    /**
     * Calculates the estimated delivery date based on the settings defined in the system config
     *
     * @return string
     */
    public function getEstimatedDeliveryDate()
    {
        return $this->_getEstimatedDays( 'delivery' );
    }
}
