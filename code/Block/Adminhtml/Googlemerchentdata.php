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
 * Google Merchent Information admin block
 *
 * @category    Develo
 * @package     Develo_Googletrustedstores
 * @author      Ultimate Module Creator
 */
class Develo_Googletrustedstores_Block_Adminhtml_Googlemerchentdata
    extends Mage_Adminhtml_Block_Widget_Grid_Container {
    /**
     * constructor
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function __construct(){
        $this->_controller         = 'adminhtml_googlemerchentdata';
        $this->_blockGroup         = 'develo_googletrustedstores';
        parent::__construct();
        $this->_headerText         = Mage::helper('develo_googletrustedstores')->__('Google Merchent Information');
        $this->_updateButton('add', 'label', Mage::helper('develo_googletrustedstores')->__('Add Google Merchent Information'));

    }
}
