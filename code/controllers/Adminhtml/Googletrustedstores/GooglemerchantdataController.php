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
 * Google Merchant Information admin controller
 *
 * @category    Develo
 * @package     Develo_Googletrustedstores
 * @author      Ultimate Module Creator
 */
class Develo_Googletrustedstores_Adminhtml_Googletrustedstores_GooglemerchantdataController
    extends Develo_Googletrustedstores_Controller_Adminhtml_Googletrustedstores {
    /**
     * init the googlemerchantdata
     * @access protected
     * @return Develo_Googletrustedstores_Model_Googlemerchantdata
     */
    protected function _initGooglemerchantdata(){
        $googlemerchantdataId  = (int) $this->getRequest()->getParam('id');
        $googlemerchantdata    = Mage::getModel('develo_googletrustedstores/googlemerchantdata');
        if ($googlemerchantdataId) {
            $googlemerchantdata->load($googlemerchantdataId);
        }
        Mage::register('current_googlemerchantdata', $googlemerchantdata);
        return $googlemerchantdata;
    }
     /**
     * default action
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function indexAction() {
        $this->loadLayout();
        $this->_title(Mage::helper('develo_googletrustedstores')->__('Google Trusted Stores'))
             ->_title(Mage::helper('develo_googletrustedstores')->__('Google Merchant Information'));
        $this->renderLayout();
    }
    /**
     * grid action
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function gridAction() {
        $this->loadLayout()->renderLayout();
    }
    /**
     * edit google merchant information - action
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function editAction() {
        $googlemerchantdataId    = $this->getRequest()->getParam('id');
        $googlemerchantdata      = $this->_initGooglemerchantdata();
        if ($googlemerchantdataId && !$googlemerchantdata->getId()) {
            $this->_getSession()->addError(Mage::helper('develo_googletrustedstores')->__('This google merchant information no longer exists.'));
            $this->_redirect('*/*/');
            return;
        }
        $data = Mage::getSingleton('adminhtml/session')->getGooglemerchantdataData(true);
        if (!empty($data)) {
            $googlemerchantdata->setData($data);
        }
        Mage::register('googlemerchantdata_data', $googlemerchantdata);
        $this->loadLayout();
        $this->_title(Mage::helper('develo_googletrustedstores')->__('Google Trusted Stores'))
             ->_title(Mage::helper('develo_googletrustedstores')->__('Google Merchant Information'));
        if ($googlemerchantdata->getId()){
            $this->_title($googlemerchantdata->getStoreId());
        }
        else{
            $this->_title(Mage::helper('develo_googletrustedstores')->__('Add google merchant information'));
        }
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
        $this->renderLayout();
    }
    /**
     * new google merchant information action
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function newAction() {
        $this->_forward('edit');
    }
    /**
     * save google merchant information - action
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function saveAction() {
        if ($data = $this->getRequest()->getPost('googlemerchantdata')) {
            try {
                $googlemerchantdata = $this->_initGooglemerchantdata();
                $googlemerchantdata->addData($data);
                $googlemerchantdata->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('develo_googletrustedstores')->__('Google Merchant Information was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $googlemerchantdata->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            }
            catch (Mage_Core_Exception $e){
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setGooglemerchantdataData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
            catch (Exception $e) {
                Mage::logException($e);
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('develo_googletrustedstores')->__('There was a problem saving the google merchant information.'));
                Mage::getSingleton('adminhtml/session')->setGooglemerchantdataData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('develo_googletrustedstores')->__('Unable to find google merchant information to save.'));
        $this->_redirect('*/*/');
    }
    /**
     * delete google merchant information - action
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function deleteAction() {
        if( $this->getRequest()->getParam('id') > 0) {
            try {
                $googlemerchantdata = Mage::getModel('develo_googletrustedstores/googlemerchantdata');
                $googlemerchantdata->setId($this->getRequest()->getParam('id'))->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('develo_googletrustedstores')->__('Google Merchant Information was successfully deleted.'));
                $this->_redirect('*/*/');
                return;
            }
            catch (Mage_Core_Exception $e){
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('develo_googletrustedstores')->__('There was an error deleting google merchant information.'));
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                Mage::logException($e);
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('develo_googletrustedstores')->__('Could not find google merchant information to delete.'));
        $this->_redirect('*/*/');
    }
    /**
     * mass delete google merchant information - action
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function massDeleteAction() {
        $googlemerchantdataIds = $this->getRequest()->getParam('googlemerchantdata');
        if(!is_array($googlemerchantdataIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('develo_googletrustedstores')->__('Please select google merchant information to delete.'));
        }
        else {
            try {
                foreach ($googlemerchantdataIds as $googlemerchantdataId) {
                    $googlemerchantdata = Mage::getModel('develo_googletrustedstores/googlemerchantdata');
                    $googlemerchantdata->setId($googlemerchantdataId)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('develo_googletrustedstores')->__('Total of %d google merchant information were successfully deleted.', count($googlemerchantdataIds)));
            }
            catch (Mage_Core_Exception $e){
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('develo_googletrustedstores')->__('There was an error deleting google merchant information.'));
                Mage::logException($e);
            }
        }
        $this->_redirect('*/*/index');
    }
    /**
     * mass status change - action
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function massStatusAction(){
        $googlemerchantdataIds = $this->getRequest()->getParam('googlemerchantdata');
        if(!is_array($googlemerchantdataIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('develo_googletrustedstores')->__('Please select google merchant information.'));
        }
        else {
            try {
                foreach ($googlemerchantdataIds as $googlemerchantdataId) {
                $googlemerchantdata = Mage::getSingleton('develo_googletrustedstores/googlemerchantdata')->load($googlemerchantdataId)
                            ->setStatus($this->getRequest()->getParam('status'))
                            ->setIsMassupdate(true)
                            ->save();
                }
                $this->_getSession()->addSuccess($this->__('Total of %d google merchant information were successfully updated.', count($googlemerchantdataIds)));
            }
            catch (Mage_Core_Exception $e){
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('develo_googletrustedstores')->__('There was an error updating google merchant information.'));
                Mage::logException($e);
            }
        }
        $this->_redirect('*/*/index');
    }
    /**
     * mass Badge Position change - action
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function massBagePositionAction(){
        $googlemerchantdataIds = $this->getRequest()->getParam('googlemerchantdata');
        if(!is_array($googlemerchantdataIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('develo_googletrustedstores')->__('Please select google merchant information.'));
        }
        else {
            try {
                foreach ($googlemerchantdataIds as $googlemerchantdataId) {
                $googlemerchantdata = Mage::getSingleton('develo_googletrustedstores/googlemerchantdata')->load($googlemerchantdataId)
                            ->setBagePosition($this->getRequest()->getParam('flag_bage_position'))
                            ->setIsMassupdate(true)
                            ->save();
                }
                $this->_getSession()->addSuccess($this->__('Total of %d google merchant information were successfully updated.', count($googlemerchantdataIds)));
            }
            catch (Mage_Core_Exception $e){
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('develo_googletrustedstores')->__('There was an error updating google merchant information.'));
                Mage::logException($e);
            }
        }
        $this->_redirect('*/*/index');
    }
    /**
     * export as csv - action
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function exportCsvAction(){
        $fileName   = 'googlemerchantdata.csv';
        $content    = $this->getLayout()->createBlock('develo_googletrustedstores/adminhtml_googlemerchantdata_grid')->getCsv();
        $this->_prepareDownloadResponse($fileName, $content);
    }
    /**
     * export as MsExcel - action
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function exportExcelAction(){
        $fileName   = 'googlemerchantdata.xls';
        $content    = $this->getLayout()->createBlock('develo_googletrustedstores/adminhtml_googlemerchantdata_grid')->getExcelFile();
        $this->_prepareDownloadResponse($fileName, $content);
    }
    /**
     * export as xml - action
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function exportXmlAction(){
        $fileName   = 'googlemerchantdata.xml';
        $content    = $this->getLayout()->createBlock('develo_googletrustedstores/adminhtml_googlemerchantdata_grid')->getXml();
        $this->_prepareDownloadResponse($fileName, $content);
    }
    /**
     * Check if admin has permissions to visit related pages
     * @access protected
     * @return boolean
     * @author Ultimate Module Creator
     */
    protected function _isAllowed() {
        return Mage::getSingleton('admin/session')->isAllowed('develo_googletrustedstores/googlemerchantdata');
    }
}
