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
 * Googletrustedstores module install script
 *
 * @category    Develo
 * @package     Develo_Googletrustedstores
 * @author      Ultimate Module Creator
 */
$this->startSetup();
$table = $this->getConnection()
    ->newTable($this->getTable('develo_googletrustedstores/googlemerchantdata'))
    ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Google Merchant Information ID')
    ->addColumn('store_id', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        'nullable'  => false,
        ), 'Google Trusted Stores Id')

    ->addColumn('bage_position', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable'  => false,
        ), 'Badge Position')

    ->addColumn('badge_container', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Badge Container')

    ->addColumn('locale', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        'nullable'  => false,
        ), 'Locale')

    ->addColumn('item_google_shopping_id', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Item Google Shopping Id')

    ->addColumn('item_google_shopping_account_id', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Item Google Shopping Account Id')

    ->addColumn('item_google_shopping_country', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Google Shopping Country')

    ->addColumn('item_google_shopping_language', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Google Shopping Language')

    ->addColumn('status', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        ), 'Enabled')

     ->addColumn('status', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        ), 'Google Merchant Information Status')
    ->addColumn('updated_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
            ), 'Google Merchant Information Modification Time')
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        ), 'Google Merchant Information Creation Time')
    ->setComment('Google Merchant Information Table');
$this->getConnection()->createTable($table);
$table = $this->getConnection()
    ->newTable($this->getTable('develo_googletrustedstores/googlemerchantdata_store'))
    ->addColumn('googlemerchantdata_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'nullable'  => false,
        'primary'   => true,
        ), 'Google Merchant Information ID')
    ->addColumn('store_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Store ID')
    ->addIndex($this->getIdxName('develo_googletrustedstores/googlemerchantdata_store', array('store_id')), array('store_id'))
    ->addForeignKey($this->getFkName('develo_googletrustedstores/googlemerchantdata_store', 'googlemerchantdata_id', 'develo_googletrustedstores/googlemerchantdata', 'entity_id'), 'googlemerchantdata_id', $this->getTable('develo_googletrustedstores/googlemerchantdata'), 'entity_id', Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->addForeignKey($this->getFkName('develo_googletrustedstores/googlemerchantdata_store', 'store_id', 'core/store', 'store_id'), 'store_id', $this->getTable('core/store'), 'store_id', Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->setComment('Google Merchant Information To Store Linkage Table');
$this->getConnection()->createTable($table);
$this->endSetup();
