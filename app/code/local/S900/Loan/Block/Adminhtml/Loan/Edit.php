<?php

class S900_Loan_Block_Adminhtml_Loan_Edit extends Mage_Adminhtml_Block_Widget_Form_Container{
	
	public function __construct(){
		
		
		$this->_objectId = 'loan_id';
		$this->_blockGroup = 'loan';
                $this->_controller = 'adminhtml_loan';

                parent::__construct();

                $this->_updateButton('save','label', Mage::helper('loan')->__('Save Loan') );
                $this->_updateButton('delete','label', Mage::helper('loan')->__('Delete Loan') );
                
                $this->_addButton(
                	'save_and_edit_button',
                	array(
                		'label' => Mage::helper('loan')->__('Save and Continue Edit'),
                		'onclick' => "editForm.submit( '{$this->getUrl('*/*/save',array('back' => true,'loan_id' => $this->getRequest()->getParam('loan_id')))}' )",
                		'class' => 'save'
                	),
                	100
                );

                
        
	}


        public function getBackUrl(){
                return $this->getUrl('*/*/manage');
        }
        public function getValidationUrl(){
                return $this->getUrl('*/*/validate', array('_current'=>true));
        }

        protected function _getSaveAndContinueUrl(){
                return $this->getUrl('*/*/save', array(
                    '_current'  => true,
                    'back'      => 'edit',
                    'tab'       => '{{tab_id}}'
                ));
        }

        public function getFormActionUrl(){
                return $this->getUrl('*/loan/save');
        }
        


}