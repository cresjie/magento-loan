<?php

class S900_Loan_Adminhtml_Loan_ReasonController extends Mage_Adminhtml_Controller_Action{

	public function getAction(){

		$reason = Mage::getModel('loan/reason')->getCollection();

		$this->getResponse()->setHeader('Content-type','application/json');
		$this->getResponse()->setBody( json_encode($reason->toArray()) );
	}

	public function deleteAction(){

		$id = $this->getRequest()->getPost('cat_id');

		$cat = Mage::getModel('loan/reason')->load($id);
		$cat->delete();

		//delete also its children category

		$subCat = Mage::getModel('loan/reason')->getCollection()
				->addFieldToFilter('parent_id', $id);
		$subCat->walk('delete');

	}

	public function createAction(){
		$cat = Mage::getModel('loan/reason');
		$cat->setData( $this->getRequest()->getPost() );
		$cat->save();

		//return info to frontend
		$this->getResponse()->setHeader('Content-type','application/json');
		$this->getResponse()->setBody( $cat->toJson() );
	}

	public function editAction(){
		$id = $this->getRequest()->getPost('cat_id');
		$cat = Mage::getModel('loan/reason')->load($id);

		$cat->setData('cat_name', $this->getRequest()->getPost('cat_name'));
		$cat->save();

		$this->getResponse()->setHeader('Content-type','application/json');
		$this->getResponse()->setBody( $cat->toJson() );
	}

}