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
 * Google Merchant Information admin edit form
 *
 * @category    Develo
 * @package     Develo_Googletrustedstores
 * @author      Ultimate Module Creator
 */
class Develo_Googletrustedstores_Block_Adminhtml_Googlemerchantdata_Edit
    extends Mage_Adminhtml_Block_Widget_Form_Container {
    /**
     * constructor
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function __construct(){
        parent::__construct();
        $this->_blockGroup = 'develo_googletrustedstores';
        $this->_controller = 'adminhtml_googlemerchantdata';
        $this->_updateButton('save', 'label', Mage::helper('develo_googletrustedstores')->__('Save Google Merchant Information'));
        $this->_updateButton('delete', 'label', Mage::helper('develo_googletrustedstores')->__('Delete Google Merchant Information'));
        $this->_addButton('saveandcontinue', array(
            'label'        => Mage::helper('develo_googletrustedstores')->__('Save And Continue Edit'),
            'onclick'    => 'saveAndContinueEdit()',
            'class'        => 'save',
        ), -100);
        $this->_formScripts[] = "
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }
    /**
     * get the edit form header
     * @access public
     * @return string
     * @author Ultimate Module Creator
     */
    public function getHeaderText(){
        if( Mage::registry('current_googlemerchantdata') && Mage::registry('current_googlemerchantdata')->getId() ) {
            return Mage::helper('develo_googletrustedstores')->__("Edit Google Merchant Information '%s'", $this->escapeHtml(Mage::registry('current_googlemerchantdata')->getStoreId()));
        }
        else {
            return Mage::helper('develo_googletrustedstores')->__('Add Google Merchant Information');
        }
    }
}
