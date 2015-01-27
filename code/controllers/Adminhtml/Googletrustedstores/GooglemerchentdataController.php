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
 * Google Merchent Information admin controller
 *
 * @category    Develo
 * @package     Develo_Googletrustedstores
 * @author      Ultimate Module Creator
 */
class Develo_Googletrustedstores_Adminhtml_Googletrustedstores_GooglemerchentdataController
    extends Develo_Googletrustedstores_Controller_Adminhtml_Googletrustedstores {
    /**
     * init the googlemerchentdata
     * @access protected
     * @return Develo_Googletrustedstores_Model_Googlemerchentdata
     */
    protected function _initGooglemerchentdata(){
        $googlemerchentdataId  = (int) $this->getRequest()->getParam('id');
        $googlemerchentdata    = Mage::getModel('develo_googletrustedstores/googlemerchentdata');
        if ($googlemerchentdataId) {
            $googlemerchentdata->load($googlemerchentdataId);
        }
        Mage::register('current_googlemerchentdata', $googlemerchentdata);
        return $googlemerchentdata;
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
             ->_title(Mage::helper('develo_googletrustedstores')->__('Google Merchent Information'));
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
     * edit google merchent information - action
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function editAction() {
        $googlemerchentdataId    = $this->getRequest()->getParam('id');
        $googlemerchentdata      = $this->_initGooglemerchentdata();
        if ($googlemerchentdataId && !$googlemerchentdata->getId()) {
            $this->_getSession()->addError(Mage::helper('develo_googletrustedstores')->__('This google merchent information no longer exists.'));
            $this->_redirect('*/*/');
            return;
        }
        $data = Mage::getSingleton('adminhtml/session')->getGooglemerchentdataData(true);
        if (!empty($data)) {
            $googlemerchentdata->setData($data);
        }
        Mage::register('googlemerchentdata_data', $googlemerchentdata);
        $this->loadLayout();
        $this->_title(Mage::helper('develo_googletrustedstores')->__('Google Trusted Stores'))
             ->_title(Mage::helper('develo_googletrustedstores')->__('Google Merchent Information'));
        if ($googlemerchentdata->getId()){
            $this->_title($googlemerchentdata->getStoreId());
        }
        else{
            $this->_title(Mage::helper('develo_googletrustedstores')->__('Add google merchent information'));
        }
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
        $this->renderLayout();
    }
    /**
     * new google merchent information action
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function newAction() {
        $this->_forward('edit');
    }
    /**
     * save google merchent information - action
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function saveAction() {
        if ($data = $this->getRequest()->getPost('googlemerchentdata')) {
            try {
                $googlemerchentdata = $this->_initGooglemerchentdata();
                $googlemerchentdata->addData($data);
                $googlemerchentdata->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('develo_googletrustedstores')->__('Google Merchent Information was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $googlemerchentdata->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            }
            catch (Mage_Core_Exception $e){
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setGooglemerchentdataData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
            catch (Exception $e) {
                Mage::logException($e);
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('develo_googletrustedstores')->__('There was a problem saving the google merchent information.'));
                Mage::getSingleton('adminhtml/session')->setGooglemerchentdataData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('develo_googletrustedstores')->__('Unable to find google merchent information to save.'));
        $this->_redirect('*/*/');
    }
    /**
     * delete google merchent information - action
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function deleteAction() {
        if( $this->getRequest()->getParam('id') > 0) {
            try {
                $googlemerchentdata = Mage::getModel('develo_googletrustedstores/googlemerchentdata');
                $googlemerchentdata->setId($this->getRequest()->getParam('id'))->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('develo_googletrustedstores')->__('Google Merchent Information was successfully deleted.'));
                $this->_redirect('*/*/');
                return;
            }
            catch (Mage_Core_Exception $e){
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('develo_googletrustedstores')->__('There was an error deleting google merchent information.'));
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                Mage::logException($e);
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('develo_googletrustedstores')->__('Could not find google merchent information to delete.'));
        $this->_redirect('*/*/');
    }
    /**
     * mass delete google merchent information - action
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function massDeleteAction() {
        $googlemerchentdataIds = $this->getRequest()->getParam('googlemerchentdata');
        if(!is_array($googlemerchentdataIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('develo_googletrustedstores')->__('Please select google merchent information to delete.'));
        }
        else {
            try {
                foreach ($googlemerchentdataIds as $googlemerchentdataId) {
                    $googlemerchentdata = Mage::getModel('develo_googletrustedstores/googlemerchentdata');
                    $googlemerchentdata->setId($googlemerchentdataId)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('develo_googletrustedstores')->__('Total of %d google merchent information were successfully deleted.', count($googlemerchentdataIds)));
            }
            catch (Mage_Core_Exception $e){
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('develo_googletrustedstores')->__('There was an error deleting google merchent information.'));
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
        $googlemerchentdataIds = $this->getRequest()->getParam('googlemerchentdata');
        if(!is_array($googlemerchentdataIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('develo_googletrustedstores')->__('Please select google merchent information.'));
        }
        else {
            try {
                foreach ($googlemerchentdataIds as $googlemerchentdataId) {
                $googlemerchentdata = Mage::getSingleton('develo_googletrustedstores/googlemerchentdata')->load($googlemerchentdataId)
                            ->setStatus($this->getRequest()->getParam('status'))
                            ->setIsMassupdate(true)
                            ->save();
                }
                $this->_getSession()->addSuccess($this->__('Total of %d google merchent information were successfully updated.', count($googlemerchentdataIds)));
            }
            catch (Mage_Core_Exception $e){
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('develo_googletrustedstores')->__('There was an error updating google merchent information.'));
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
        $googlemerchentdataIds = $this->getRequest()->getParam('googlemerchentdata');
        if(!is_array($googlemerchentdataIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('develo_googletrustedstores')->__('Please select google merchent information.'));
        }
        else {
            try {
                foreach ($googlemerchentdataIds as $googlemerchentdataId) {
                $googlemerchentdata = Mage::getSingleton('develo_googletrustedstores/googlemerchentdata')->load($googlemerchentdataId)
                            ->setBagePosition($this->getRequest()->getParam('flag_bage_position'))
                            ->setIsMassupdate(true)
                            ->save();
                }
                $this->_getSession()->addSuccess($this->__('Total of %d google merchent information were successfully updated.', count($googlemerchentdataIds)));
            }
            catch (Mage_Core_Exception $e){
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('develo_googletrustedstores')->__('There was an error updating google merchent information.'));
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
        $fileName   = 'googlemerchentdata.csv';
        $content    = $this->getLayout()->createBlock('develo_googletrustedstores/adminhtml_googlemerchentdata_grid')->getCsv();
        $this->_prepareDownloadResponse($fileName, $content);
    }
    /**
     * export as MsExcel - action
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function exportExcelAction(){
        $fileName   = 'googlemerchentdata.xls';
        $content    = $this->getLayout()->createBlock('develo_googletrustedstores/adminhtml_googlemerchentdata_grid')->getExcelFile();
        $this->_prepareDownloadResponse($fileName, $content);
    }
    /**
     * export as xml - action
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function exportXmlAction(){
        $fileName   = 'googlemerchentdata.xml';
        $content    = $this->getLayout()->createBlock('develo_googletrustedstores/adminhtml_googlemerchentdata_grid')->getXml();
        $this->_prepareDownloadResponse($fileName, $content);
    }
    /**
     * Check if admin has permissions to visit related pages
     * @access protected
     * @return boolean
     * @author Ultimate Module Creator
     */
    protected function _isAllowed() {
        return Mage::getSingleton('admin/session')->isAllowed('develo_googletrustedstores/googlemerchentdata');
    }
}
