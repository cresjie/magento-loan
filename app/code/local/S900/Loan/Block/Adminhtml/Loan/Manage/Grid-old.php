<?php

class S900_Loan_Block_Adminhtml_Loan_Manage_Grid extends Mage_Adminhtml_Block_Widget_Grid{
	
	public function __construct()
    {
        parent::__construct();
        $this->setId('loan_manage_grid');
        $this->setUseAjax(true);
        $this->setDefaultSort('loan_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);

    }

    protected function _prepareCollection(){
    	
    	$collection = Mage::getResourceModel('loan/loan_collection')
                ->join(array('status_attr' => 'loan/status_attr'),'main_table.status=status_attr.status_code',array('status_value' => 'status_value'));

        

    	$this->setCollection( $collection );


    	return parent::_prepareCollection();
    	
    	

    }
    
    protected function _prepareColumns(){

    	
    	$this->addColumn('loan_id',array(
    		'header' => Mage::helper('loan')->__('ID'),
    		'align' => 'right',
    		'width' => '80px',
    		'index' => 'loan_id'
    	));

        $this->addColumn('email',array(
            'header' => Mage::helper('loan')->__('Email'),
            'index' => 'email'
        ));

    	$this->addColumn('first_name',array(
    		'header' => Mage::helper('loan')->__('First Name'),
    		'index' => 'first_name'
    	));

    	$this->addColumn('last_name',array(
    		'header' => Mage::helper('loan')->__('Last Name'),
    		'index' => 'last_name'
    	));

    	$this->addColumn('loan_value',array(
    		'header' => Mage::helper('loan')->__('Loan Value'),
    		'index' => 'loan_value'
    	));
    	
        $statusCollection = Mage::getResourceModel('loan/status_attr_collection')->load();

        $options = array();
        foreach ($statusCollection as $id => $obj) {
            $options[$id] = $obj->getStatusValue();
        }

    	$this->addColumn('status',array(
    		'header' => Mage::helper('loan')->__('Status'),
    		'index' => 'status',
            'type' => 'options',
            'options' => $options
            
    	));

    	$this->addColumn('action',array(
    		'header' => Mage::helper('loan')->__('Action'),
            'width' => '200px',
    		'type' => 'action',
    		'getter' => 'getLoanId',
    		'filter' => false,
    		'sortable' => false,
    		'index' => 'stores',
    		'is_system' => true,
            'renderer' => 'loan/adminhtml_widget_grid_column_renderer_action',
    		'actions' => array(
    			array('caption' => Mage::helper('loan')->__('Edit'),'url' => array('base' => '*/*/edit'),'field' => 'loan_id'),
                array('caption' => Mage::helper('loan')->__('Approve'),'url' => array('base' => '*/*/approve'),'field' => 'loan_id'),
                 array('caption' => Mage::helper('loan')->__('Decline'),'url' => array('base' => '*/*/decline'),'field' => 'loan_id')
    		)
    	));


        
    	return parent::_prepareColumns();
    	
    }
	
	
    public function getRowUrl($row){
       if (Mage::getSingleton('admin/session')->isAllowed('loan/view')) {
            return $this->getUrl('*/loan/edit', array('loan_id' => $row->getLoanId()));
        }
        return false;
    }
    public function getGridUrl(){
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }

   

}