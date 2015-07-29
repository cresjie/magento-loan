<?php

class S900_Loan_Block_Adminhtml_Loan_Account_Grid extends Mage_Adminhtml_Block_Widget_Grid{
	
	public function __construct()
    {
        parent::__construct();
        $this->setId('loan_account_grid');
        $this->setUseAjax(true);
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);

    }

    protected function _prepareCollection(){
    	
    	$collection = Mage::getResourceModel('loan/account_collection');

        

    	$this->setCollection( $collection );


    	return parent::_prepareCollection();
    	
    	

    }
    
    protected function _prepareColumns(){

    	
    	$this->addColumn('id',array(
    		'header' => Mage::helper('loan')->__('ID'),
    		'align' => 'right',
    		'width' => '80px',
    		'index' => 'id'
    	));

        $this->addColumn('title',array(
            'header' => Mage::helper('loan')->__('Title'),
            'index' => 'title'
        ));


    	$this->addColumn('first_name',array(
    		'header' => Mage::helper('loan')->__('First Name'),
    		'index' => 'first_name'
    	));


    	$this->addColumn('last_name',array(
    		'header' => Mage::helper('loan')->__('Last Name'),
    		'index' => 'last_name'
    	));

        $this->addColumn('email',array(
            'header' => Mage::helper('loan')->__('Email'),
            'index' => 'email'
        ));

    	$this->addColumn('address',array(
    		'header' => Mage::helper('loan')->__('Address'),
    		'index' => 'address'
    	));
    	
        $this->addColumn('mobile_phone',array(
            'header' => Mage::helper('loan')->__('Mobile Phone'),
            'index' => 'mobile_phone'
        ));

        

    	$this->addColumn('action',array(
    		'header' => Mage::helper('loan')->__('Action'),
            'width' => '200px',
    		'type' => 'action',
    		'getter' => 'getId',
    		'filter' => false,
    		'sortable' => false,
    		'index' => 'stores',
    		'is_system' => true,
    		'actions' => array(
    			array('caption' => Mage::helper('loan')->__('Edit'),'url' => array('base' => '*/*/edit'),'field' => 'id'),
               
    		)
    	));


        
    	return parent::_prepareColumns();
    	
    }
	
	
    public function getRowUrl($row){
       if (Mage::getSingleton('admin/session')->isAllowed('loan/view')) {
            return $this->getUrl('*/*/edit', array('id' => $row->getId()));
        }
        return false;
    }
    public function getGridUrl(){
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }

   

}