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
 * Google Merchent Information resource model
 *
 * @category    Develo
 * @package     Develo_Googletrustedstores
 * @author      Ultimate Module Creator
 */
class Develo_Googletrustedstores_Model_Resource_Googlemerchantdata
    extends Mage_Core_Model_Resource_Db_Abstract {
    /**
     * constructor
     * @access public
     * @author Ultimate Module Creator
     */
    public function _construct(){
        $this->_init('develo_googletrustedstores/googlemerchantdata', 'entity_id');
    }
    /**
     * Get store ids to which specified item is assigned
     * @access public
     * @param int $googlemerchantdataId
     * @return array
     * @author Ultimate Module Creator
     */
    public function lookupStoreIds($googlemerchantdataId){
        $adapter = $this->_getReadAdapter();
        $select  = $adapter->select()
            ->from($this->getTable('develo_googletrustedstores/googlemerchantdata_store'), 'store_id')
            ->where('googlemerchantdata_id = ?',(int)$googlemerchantdataId);
        return $adapter->fetchCol($select);
    }
    /**
     * Perform operations after object load
     * @access public
     * @param Mage_Core_Model_Abstract $object
     * @return Develo_Googletrustedstores_Model_Resource_Googlemerchantdata
     * @author Ultimate Module Creator
     */
    protected function _afterLoad(Mage_Core_Model_Abstract $object){
        if ($object->getId()) {
            $stores = $this->lookupStoreIds($object->getId());
            $object->setData('store_id', $stores);
        }
        return parent::_afterLoad($object);
    }

    /**
     * Retrieve select object for load object data
     *
     * @param string $field
     * @param mixed $value
     * @param Develo_Googletrustedstores_Model_Googlemerchantdata $object
     * @return Zend_Db_Select
     */
    protected function _getLoadSelect($field, $value, $object){
        $select = parent::_getLoadSelect($field, $value, $object);
        if ($object->getStoreId()) {
            $storeIds = array(Mage_Core_Model_App::ADMIN_STORE_ID, (int)$object->getStoreId());
            $select->join(
                array('googletrustedstores_googlemerchantdata_store' => $this->getTable('develo_googletrustedstores/googlemerchantdata_store')),
                $this->getMainTable() . '.entity_id = googletrustedstores_googlemerchantdata_store.googlemerchantdata_id',
                array()
            )
            ->where('googletrustedstores_googlemerchantdata_store.store_id IN (?)', $storeIds)
            ->order('googletrustedstores_googlemerchantdata_store.store_id DESC')
            ->limit(1);
        }
        return $select;
    }
    /**
     * Assign google merchant information to store views
     * @access protected
     * @param Mage_Core_Model_Abstract $object
     * @return Develo_Googletrustedstores_Model_Resource_Googlemerchantdata
     * @author Ultimate Module Creator
     */
    protected function _afterSave(Mage_Core_Model_Abstract $object){
        $oldStores = $this->lookupStoreIds($object->getId());
        $newStores = (array)$object->getStores();
        if (empty($newStores)) {
            $newStores = (array)$object->getStoreId();
        }
        $table  = $this->getTable('develo_googletrustedstores/googlemerchantdata_store');
        $insert = array_diff($newStores, $oldStores);
        $delete = array_diff($oldStores, $newStores);
        if ($delete) {
            $where = array(
                'googlemerchantdata_id = ?' => (int) $object->getId(),
                'store_id IN (?)' => $delete
            );
            $this->_getWriteAdapter()->delete($table, $where);
        }
        if ($insert) {
            $data = array();
            foreach ($insert as $storeId) {
                $data[] = array(
                    'googlemerchantdata_id'  => (int) $object->getId(),
                    'store_id' => (int) $storeId
                );
            }
            $this->_getWriteAdapter()->insertMultiple($table, $data);
        }
        return parent::_afterSave($object);
    }}
