<?php

class S900_Loan_Block_Adminhtml_Widget_Grid_Column_Renderer_Action extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Action{
	
	public function render(Varien_Object $row){
		$actions = $this->getColumn()->getActions();

		$out = '';
		foreach ($actions as $action) {
			$out .= $this->_toLinkHtml($action,$row) . ' | ';
		}
		return $out;
	}
}