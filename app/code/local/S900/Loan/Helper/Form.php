<?php

class S900_Loan_Helper_Form extends Mage_Core_Helper_Abstract{
	
	public function select($name, $selected = null,$options = array(), $attrs = array()){
		$attrsRender = " ";

		foreach ($attrs as $key => $value) {
			$attrsRender .= "{$key}='$value' ";
		}


		$render = "<select name='$name' {$attrsRender}>";

		foreach ($options as $key => $value) {
			$isSelected = $key == $selected ? 'selected' :'';
			$render .= "<option value='$key' $isSelected>$value </options>";
		}

		$render .= "</select>";

		return $render;
	}
}