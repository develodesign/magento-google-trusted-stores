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
 * Google Merchant Information admin grid block
 *
 * @category    Develo
 * @package     Develo_Googletrustedstores
 * @author      Ultimate Module Creator
 */
class Develo_Googletrustedstores_Block_Adminhtml_Googlemerchantdata_Grid
    extends Mage_Adminhtml_Block_Widget_Grid {
    /**
     * constructor
     * @access public
     * @author Ultimate Module Creator
     */
    public function __construct(){
        parent::__construct();
        $this->setId('googlemerchantdataGrid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }
    /**
     * prepare collection
     * @access protected
     * @return Develo_Googletrustedstores_Block_Adminhtml_Googlemerchantdata_Grid
     * @author Ultimate Module Creator
     */
    protected function _prepareCollection(){
        $collection = Mage::getModel('develo_googletrustedstores/googlemerchantdata')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
    /**
     * prepare grid collection
     * @access protected
     * @return Develo_Googletrustedstores_Block_Adminhtml_Googlemerchantdata_Grid
     * @author Ultimate Module Creator
     */
    protected function _prepareColumns(){
        $this->addColumn('entity_id', array(
            'header'    => Mage::helper('develo_googletrustedstores')->__('Id'),
            'index'        => 'entity_id',
            'type'        => 'number'
        ));
        $this->addColumn('store_id', array(
            'header'    => Mage::helper('develo_googletrustedstores')->__('Google Trusted Stores Id'),
            'align'     => 'left',
            'index'     => 'store_id',
        ));
        $this->addColumn('status', array(
            'header'    => Mage::helper('develo_googletrustedstores')->__('Status'),
            'index'        => 'status',
            'type'        => 'options',
            'options'    => array(
                '1' => Mage::helper('develo_googletrustedstores')->__('Enabled'),
                '0' => Mage::helper('develo_googletrustedstores')->__('Disabled'),
            )
        ));
        $this->addColumn('bage_position', array(
            'header'=> Mage::helper('develo_googletrustedstores')->__('Badge Position'),
            'index' => 'bage_position',
            'type'  => 'options',
            'options' => Mage::helper('develo_googletrustedstores')->convertOptions(Mage::getModel('develo_googletrustedstores/googlemerchantdata_attribute_source_bageposition')->getAllOptions(false))

        ));
        $this->addColumn('badge_container', array(
            'header'=> Mage::helper('develo_googletrustedstores')->__('Badge Container'),
            'index' => 'badge_container',
            'type'=> 'text',

        ));
        $this->addColumn('locale', array(
            'header'=> Mage::helper('develo_googletrustedstores')->__('Locale'),
            'index' => 'locale',
            'type'=> 'text',

        ));
        $this->addColumn('item_google_shopping_id', array(
            'header'=> Mage::helper('develo_googletrustedstores')->__('Item Google Shopping Id'),
            'index' => 'item_google_shopping_id',
            'type'=> 'text',

        ));
        $this->addColumn('item_google_shopping_account_id', array(
            'header'=> Mage::helper('develo_googletrustedstores')->__('Item Google Shopping Account Id'),
            'index' => 'item_google_shopping_account_id',
            'type'=> 'text',

        ));
        $this->addColumn('item_google_shopping_country', array(
            'header'=> Mage::helper('develo_googletrustedstores')->__('Google Shopping Country'),
            'index' => 'item_google_shopping_country',
            'type'=> 'text',

        ));
        $this->addColumn('item_google_shopping_language', array(
            'header'=> Mage::helper('develo_googletrustedstores')->__('Google Shopping Language'),
            'index' => 'item_google_shopping_language',
            'type'=> 'text',

        ));
        if (!Mage::app()->isSingleStoreMode() && !$this->_isExport) {
            $this->addColumn('store_id', array(
                'header'=> Mage::helper('develo_googletrustedstores')->__('Store Views'),
                'index' => 'store_id',
                'type'  => 'store',
                'store_all' => true,
                'store_view'=> true,
                'sortable'  => false,
                'filter_condition_callback'=> array($this, '_filterStoreCondition'),
            ));
        }
        $this->addColumn('created_at', array(
            'header'    => Mage::helper('develo_googletrustedstores')->__('Created at'),
            'index'     => 'created_at',
            'width'     => '120px',
            'type'      => 'datetime',
        ));
        $this->addColumn('updated_at', array(
            'header'    => Mage::helper('develo_googletrustedstores')->__('Updated at'),
            'index'     => 'updated_at',
            'width'     => '120px',
            'type'      => 'datetime',
        ));
        $this->addColumn('action',
            array(
                'header'=>  Mage::helper('develo_googletrustedstores')->__('Action'),
                'width' => '100',
                'type'  => 'action',
                'getter'=> 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('develo_googletrustedstores')->__('Edit'),
                        'url'   => array('base'=> '*/*/edit'),
                        'field' => 'id'
                    )
                ),
                'filter'=> false,
                'is_system'    => true,
                'sortable'  => false,
        ));
        $this->addExportType('*/*/exportCsv', Mage::helper('develo_googletrustedstores')->__('CSV'));
        $this->addExportType('*/*/exportExcel', Mage::helper('develo_googletrustedstores')->__('Excel'));
        $this->addExportType('*/*/exportXml', Mage::helper('develo_googletrustedstores')->__('XML'));
        return parent::_prepareColumns();
    }
    /**
     * prepare mass action
     * @access protected
     * @return Develo_Googletrustedstores_Block_Adminhtml_Googlemerchantdata_Grid
     * @author Ultimate Module Creator
     */
    protected function _prepareMassaction(){
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('googlemerchantdata');
        $this->getMassactionBlock()->addItem('delete', array(
            'label'=> Mage::helper('develo_googletrustedstores')->__('Delete'),
            'url'  => $this->getUrl('*/*/massDelete'),
            'confirm'  => Mage::helper('develo_googletrustedstores')->__('Are you sure?')
        ));
        $this->getMassactionBlock()->addItem('status', array(
            'label'=> Mage::helper('develo_googletrustedstores')->__('Change status'),
            'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
            'additional' => array(
                'status' => array(
                        'name' => 'status',
                        'type' => 'select',
                        'class' => 'required-entry',
                        'label' => Mage::helper('develo_googletrustedstores')->__('Status'),
                        'values' => array(
                                '1' => Mage::helper('develo_googletrustedstores')->__('Enabled'),
                                '0' => Mage::helper('develo_googletrustedstores')->__('Disabled'),
                        )
                )
            )
        ));
        $this->getMassactionBlock()->addItem('bage_position', array(
            'label'=> Mage::helper('develo_googletrustedstores')->__('Change Badge Position'),
            'url'  => $this->getUrl('*/*/massBagePosition', array('_current'=>true)),
            'additional' => array(
                'flag_bage_position' => array(
                        'name' => 'flag_bage_position',
                        'type' => 'select',
                        'class' => 'required-entry',
                        'label' => Mage::helper('develo_googletrustedstores')->__('Badge Position'),
                        'values' => Mage::getModel('develo_googletrustedstores/googlemerchantdata_attribute_source_bageposition')->getAllOptions(true),

                )
            )
        ));
        return $this;
    }
    /**
     * get the row url
     * @access public
     * @param Develo_Googletrustedstores_Model_Googlemerchantdata
     * @return string
     * @author Ultimate Module Creator
     */
    public function getRowUrl($row){
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
    /**
     * get the grid url
     * @access public
     * @return string
     * @author Ultimate Module Creator
     */
    public function getGridUrl(){
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }
    /**
     * after collection load
     * @access protected
     * @return Develo_Googletrustedstores_Block_Adminhtml_Googlemerchantdata_Grid
     * @author Ultimate Module Creator
     */
    protected function _afterLoadCollection(){
        $this->getCollection()->walk('afterLoad');
        parent::_afterLoadCollection();
    }
    /**
     * filter store column
     * @access protected
     * @param Develo_Googletrustedstores_Model_Resource_Googlemerchantdata_Collection $collection
     * @param Mage_Adminhtml_Block_Widget_Grid_Column $column
     * @return Develo_Googletrustedstores_Block_Adminhtml_Googlemerchantdata_Grid
     * @author Ultimate Module Creator
     */
    protected function _filterStoreCondition($collection, $column){
        if (!$value = $column->getFilter()->getValue()) {
            return;
        }
        $collection->addStoreFilter($value);
        return $this;
    }
}
