<?php

class S900_Loan_Block_Applicationloan extends Mage_Adminhtml_Block_Widget_Container{

	protected $_amount_options,
				$_duration_options,
				$_reasonCat;


	public function getAmountOptions(){
		if( empty($this->_amount_options) )
		$this->_amount_options =  Mage::getStoreConfig('s900/loan/amount_options');

		return $this->_amount_options;
	}

	public function getDurationOptions(){
		if( empty($this->_duration_options) )
			$this->_duration_options = Mage::getStoreConfig('s900/loan/duration_options');

		return $this->_duration_options;
	}

	public function getReasonCategory(){
		if( empty($this->_reasonCat))
			$this->_reasonCat = Mage::getModel('loan/reason')->getCollection();

		return $this->_reasonCat;
	}
}