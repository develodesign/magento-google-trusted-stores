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
 * Google Merchent Information edit form tab
 *
 * @category    Develo
 * @package     Develo_Googletrustedstores
 * @author      Ultimate Module Creator
 */
class Develo_Googletrustedstores_Block_Adminhtml_Googlemerchentdata_Edit_Tab_Form
    extends Mage_Adminhtml_Block_Widget_Form {
    /**
     * prepare the form
     * @access protected
     * @return Googletrustedstores_Googlemerchentdata_Block_Adminhtml_Googlemerchentdata_Edit_Tab_Form
     * @author Ultimate Module Creator
     */
    protected function _prepareForm(){
        $form = new Varien_Data_Form();
        $form->setHtmlIdPrefix('googlemerchentdata_');
        $form->setFieldNameSuffix('googlemerchentdata');
        $this->setForm($form);
        $fieldset = $form->addFieldset('googlemerchentdata_form', array('legend'=>Mage::helper('develo_googletrustedstores')->__('Google Merchent Information')));

        $fieldset->addField('store_id', 'text', array(
            'label' => Mage::helper('develo_googletrustedstores')->__('Google Trusted Stores Id'),
            'name'  => 'store_id',
            'required'  => true,
            'class' => 'required-entry',

        ));

        $fieldset->addField('bage_position', 'select', array(
            'label' => Mage::helper('develo_googletrustedstores')->__('Badge Position'),
            'name'  => 'bage_position',
            'required'  => true,
            'class' => 'required-entry',

            'values'=> Mage::getModel('develo_googletrustedstores/googlemerchentdata_attribute_source_bageposition')->getAllOptions(true),
        ));

        $fieldset->addField('badge_container', 'text', array(
            'label' => Mage::helper('develo_googletrustedstores')->__('Badge Container'),
            'name'  => 'badge_container',
            'note'	=> $this->__('Required for USER_DEFINED badge position'),

        ));

        $fieldset->addField('locale', 'text', array(
            'label' => Mage::helper('develo_googletrustedstores')->__('Locale'),
            'name'  => 'locale',
            'note'	=> $this->__('<Language> is a two-letter language code defined in ISO 639-1, and <country> is a two-letter country code defined in ISO 3166-1 alpha-2. Usually <country> should be all capitalized, and <language> should be in lowercase. e.g. en_US, en_GB, en_AU, fr_FR, de_DE, or ja_JP.'),
            'required'  => true,
            'class' => 'required-entry',

        ));

        $fieldset->addField('item_google_shopping_id', 'text', array(
            'label' => Mage::helper('develo_googletrustedstores')->__('Item Google Shopping Id'),
            'name'  => 'item_google_shopping_id',
            'note'	=> $this->__('Provide this field only if you submit feeds for Google Shopping.'),

        ));

        $fieldset->addField('item_google_shopping_account_id', 'text', array(
            'label' => Mage::helper('develo_googletrustedstores')->__('Item Google Shopping Account Id'),
            'name'  => 'item_google_shopping_account_id',
            'note'	=> $this->__('Provide this field only if you submit feeds for Google Shopping.  Account ID from Google Merchant Center. This value should match the account ID you use to submit your product data feed to Google Shopping through Google Merchant center. If you have a MCA account, use the subaccount ID associated with that product feed.'),

        ));

        $fieldset->addField('item_google_shopping_country', 'text', array(
            'label' => Mage::helper('develo_googletrustedstores')->__('Google Shopping Country'),
            'name'  => 'item_google_shopping_country',
            'note'	=> $this->__('Provide this field only if you submit feeds for Google Shopping.  Account country from Google Shopping. This value should match the account country you use to submit your product data feed to Google Shopping.  The value of the country parameter should be a two-letter ISO 3166 country code.  For example, values could be “US”, “GB”, “AU”, “FR”, “DE”, “JP”.'),

        ));

        $fieldset->addField('item_google_shopping_language', 'text', array(
            'label' => Mage::helper('develo_googletrustedstores')->__('Google Shopping Language'),
            'name'  => 'item_google_shopping_language',
            'note'	=> $this->__('Provide this field only if you submit feeds for Google Shopping.  Account language from Google Shopping. This value should match the account language you use to submit your product data feed to Google Shopping.  The value of the language parameter should be a two-letter ISO 639-1 language code.  For example, values could be "en", "fr", "de", "ja".'),

        ));
        $fieldset->addField('status', 'select', array(
            'label' => Mage::helper('develo_googletrustedstores')->__('Status'),
            'name'  => 'status',
            'values'=> array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('develo_googletrustedstores')->__('Enabled'),
                ),
                array(
                    'value' => 0,
                    'label' => Mage::helper('develo_googletrustedstores')->__('Disabled'),
                ),
            ),
        ));
        if (Mage::app()->isSingleStoreMode()){
            $fieldset->addField('store_id', 'hidden', array(
                'name'      => 'stores[]',
                'value'     => Mage::app()->getStore(true)->getId()
            ));
            Mage::registry('current_googlemerchentdata')->setStoreId(Mage::app()->getStore(true)->getId());
        }
        $formValues = Mage::registry('current_googlemerchentdata')->getDefaultValues();
        if (!is_array($formValues)){
            $formValues = array();
        }
        if (Mage::getSingleton('adminhtml/session')->getGooglemerchentdataData()){
            $formValues = array_merge($formValues, Mage::getSingleton('adminhtml/session')->getGooglemerchentdataData());
            Mage::getSingleton('adminhtml/session')->setGooglemerchentdataData(null);
        }
        elseif (Mage::registry('current_googlemerchentdata')){
            $formValues = array_merge($formValues, Mage::registry('current_googlemerchentdata')->getData());
        }
        $form->setValues($formValues);
        return parent::_prepareForm();
    }
}
