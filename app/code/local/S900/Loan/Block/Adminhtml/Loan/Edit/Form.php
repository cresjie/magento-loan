<?php

class S900_Loan_Block_Adminhtml_Loan_Edit_Form extends Mage_Adminhtml_Block_Widget_Form{
	
	
	protected function _prepareForm(){

		$form = new Varien_Data_Form(array(
			'id' => 'edit_form',
			'action' => $this->getUrl('*/*/save',array('loan_id' => $this->getRequest()->getParam('loan_id') )),
			'method' => 'post',
			'enctype'   => 'multipart/form-data'
		));	

		$form->addField('email','text',array(
			'label' => Mage::helper('loan')->__('Email'),
			'class' => 'required-entry',
			'required' => true,
			'name' => 'email'
		));

		$form->addField('first_name','text',array(
			'label' => Mage::helper('loan')->__('First Name'),
			'class' => 'required-entry',
			'required' => true,
			'name' => 'first_name'
		));

		$form->addField('last_name','text',array(
			'label' => Mage::helper('loan')->__('Last Name'),
			'class' => 'required-entry',
			'required' => true,
			'name' => 'last_name'
		));

		$form->addField('loan_value','text',array(
			'label' => Mage::helper('loan')->__('Loan Value'),
			'class' => 'required-entry',
			'required' => true,
			'name' => 'loan_value'
		));

		$form->addField('status','select',array(
			'label' => Mage::helper('loan')->__('Status'),
			'class' => 'required-entry',
			'required' => true,
			'name' => 'status',
			'values' => array(
				'-1' => 'Pending',
				'1' => 'Approved',
				'0' => 'Decline'
			)
		));

		$form->setValues( Mage::registry('current_loan')->getData() );
		$form->setUseContainer(true);

		$this->setForm($form);

		return parent::_prepareForm();
	}
}