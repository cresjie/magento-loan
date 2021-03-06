<?php

class S900_Loan_Block_Adminhtml_Loan_Account extends Mage_Adminhtml_Block_Widget_Grid_Container{

	public function __construct(){
        
        $this->_blockGroup = 'loan';
        $this->_controller = 'adminhtml_loan_account';
        $this->_headerText = Mage::helper('loan')->__('Loan Account');
        $this->_addButtonLabel = Mage::helper('sales')->__('Add Account');
        parent::__construct();
        
        if (!Mage::getSingleton('admin/session')->isAllowed('sales/order/actions/create')) {
            $this->_removeButton('add');
        }


       
    }
}