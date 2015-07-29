<?php

class S900_Loan_Block_Adminhtml_Loan_Edit_Form extends Mage_Adminhtml_Block_Widget_Form{
	
	
	protected function _prepareForm(){

		$form = new Varien_Data_Form(array(
			'id' => 'edit_form',
			'action' => $this->getUrl('*/*/save',array('loan_id' => $this->getRequest()->getParam('loan_id') )),
			'method' => 'post',
			'enctype'   => 'multipart/form-data'
		));

		$form->addField('account_id','text',array(
			'label' => Mage::helper('loan')->__('Account Id'),
			'class' => 'required-entry',
			'required' => true,
			'name' => 'account_id'
		));

		$form->addField('amount','text',array(
			'label' => Mage::helper('loan')->__('Amount'),
			'class' => 'required-entry validate-number',
			'required' => true,
			'name' => 'amount'
		));

		$form->addField('duration','text',array(
			'label' => Mage::helper('loan')->__('Duration'),
			'class' => 'required-entry',
			'required' => true,
			'name' => 'duration'
		));

		$form->addField('interest','text',array(
			'label' => Mage::helper('loan')->__('Interest'),
			'class' => 'required-entry validate-number',
			'required' => true,
			'name' => 'interest'
		));

		$reasonCat = Mage::getModel('loan/reason')->getCollection();
		$reasonFiltered = array();
		

		foreach ($reasonCat as $key => $reason) {
			if( $reason->parent_id)
				$reasonFiltered[$key] = $reasonCat->getItems()[$reason->parent_id]->cat_name . ' | '. $reason->cat_name;
		}



		$form->addField('reason_cat_id','select',array(
			'label' => Mage::helper('loan')->__('Reason'),
			'class' => 'required-entry',
			'required' => true,
			'name' => 'reason_cat_id',
			'values' => $reasonFiltered
		));

		$form->addField('reason_details','textarea',array(
			'label' => Mage::helper('loan')->__('Reason Details'),
			//'class' => 'required-entry',
			
			'name' => 'reason_details'
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