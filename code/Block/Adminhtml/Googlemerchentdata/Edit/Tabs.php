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
/**
 * Google Merchent Information admin edit tabs
 *
 * @category    Develo
 * @package     Develo_Googletrustedstores
 * @author      Ultimate Module Creator
 */
class Develo_Googletrustedstores_Block_Adminhtml_Googlemerchentdata_Edit_Tabs
    extends Mage_Adminhtml_Block_Widget_Tabs {
    /**
     * Initialize Tabs
     * @access public
     * @author Ultimate Module Creator
     */
    public function __construct() {
        parent::__construct();
        $this->setId('googlemerchentdata_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('develo_googletrustedstores')->__('Google Merchent Information'));
    }
    /**
     * before render html
     * @access protected
     * @return Develo_Googletrustedstores_Block_Adminhtml_Googlemerchentdata_Edit_Tabs
     * @author Ultimate Module Creator
     */
    protected function _beforeToHtml(){
        $this->addTab('form_googlemerchentdata', array(
            'label'        => Mage::helper('develo_googletrustedstores')->__('Google Merchent Information'),
            'title'        => Mage::helper('develo_googletrustedstores')->__('Google Merchent Information'),
            'content'     => $this->getLayout()->createBlock('develo_googletrustedstores/adminhtml_googlemerchentdata_edit_tab_form')->toHtml(),
        ));
        if (!Mage::app()->isSingleStoreMode()){
            $this->addTab('form_store_googlemerchentdata', array(
                'label'        => Mage::helper('develo_googletrustedstores')->__('Store views'),
                'title'        => Mage::helper('develo_googletrustedstores')->__('Store views'),
                'content'     => $this->getLayout()->createBlock('develo_googletrustedstores/adminhtml_googlemerchentdata_edit_tab_stores')->toHtml(),
            ));
        }
        return parent::_beforeToHtml();
    }
    /**
     * Retrieve google merchent information entity
     * @access public
     * @return Develo_Googletrustedstores_Model_Googlemerchentdata
     * @author Ultimate Module Creator
     */
    public function getGooglemerchentdata(){
        return Mage::registry('current_googlemerchentdata');
    }
}
