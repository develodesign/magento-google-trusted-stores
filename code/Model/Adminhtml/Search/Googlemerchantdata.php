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
 * Admin search model
 *
 * @category    Develo
 * @package     Develo_Googletrustedstores
 * @author      Ultimate Module Creator
 */
class Develo_Googletrustedstores_Model_Adminhtml_Search_Googlemerchantdata
    extends Varien_Object {
    /**
     * Load search results
     * @access public
     * @return Develo_Googletrustedstores_Model_Adminhtml_Search_Googlemerchantdata
     * @author Ultimate Module Creator
     */
    public function load(){
        $arr = array();
        if (!$this->hasStart() || !$this->hasLimit() || !$this->hasQuery()) {
            $this->setResults($arr);
            return $this;
        }
        $collection = Mage::getResourceModel('develo_googletrustedstores/googlemerchantdata_collection')
            ->addFieldToFilter('store_id', array('like' => $this->getQuery().'%'))
            ->setCurPage($this->getStart())
            ->setPageSize($this->getLimit())
            ->load();
        foreach ($collection->getItems() as $googlemerchantdata) {
            $arr[] = array(
                'id'=> 'googlemerchantdata/1/'.$googlemerchantdata->getId(),
                'type'  => Mage::helper('develo_googletrustedstores')->__('Google Merchent Information'),
                'name'  => $googlemerchantdata->getStoreId(),
                'description'   => $googlemerchantdata->getStoreId(),
                'url' => Mage::helper('adminhtml')->getUrl('*/googletrustedstores_googlemerchantdata/edit', array('id'=>$googlemerchantdata->getId())),
            );
        }
        $this->setResults($arr);
        return $this;
    }
}
