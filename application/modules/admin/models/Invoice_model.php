<?php
// this model is for customer
class Invoice_model extends CI_Model {
		
		
	// all values in DDBB
	public $id;
	public $customer_id;
	public $active;
	public $on_hold;
	public $paid;
	public $last_update;
	public $comment;
	
	public function __construct(){
		
		parent::__construct();
		// code here if you need init some values
	}
	
	// CRUD values
	// C
	
	public function create (){
		
		$required_fields = array (
				'customer_id'
		);
		
		$error = false;
		$field_empty = '';
		foreach($required_fields as $field){
			//echo 'field : ' . $field; 
			//echo '    ///    POST -> field : ' . $_POST[$field]; 
			//ECHO ' TRUE / FALSE : ' .isset($_POST[$field]) ; 
			if( $_POST[$field] == 0) {
				$error= true;
				$field_empty = $field;
				$field_value = $_POST[$field];
				echo '<br> Field : '. $field_empty.  ' -//- Field value : '.$_POST[$field].'<br>' ;
			}
		}
		
		if(!$error){
			//$this->id    			= $_POST['id'];
			$this->customer_id     	= $_POST['customer_id'];
			$this->active    		= true;
			$this->on_hold  			= false;
			$this->paid   			= false;
			$this->last_update  		= time();
			$this->comment    		= "" ;
			
			$this->db->insert('invoice', $this);
			
			// return last id inserted
			echo $this->db->insert_id();
			
		}else{
			
			echo 'All fields are required to insert a row. This is empty : '. $field_empty ;
		}
		
	}
	
	// R
	
	public function read(){
		
		if(isset($_POST['invoice_id'])){
			
			$this->db->where('invoice_id',$_POST['invoice_id'] );
			$result =  $this->db->get('invoice');
			
			echo json_encode($result);
			
		}else{
			
			return $this->db->get('invoice')->result();
			
		}
		
	}
	
	// U
	
	public function update () {
		
		$required_fields = array (
				'id'
				,'customer_id'
				,'active'
				,'on_hold'
				,'paid'
				,'last_update'
				,'comment'
		);
		
		$error = false;
		$field_empty = '';
		foreach($required_fields as $field){
			if(isset($_POST[$field])){
				$error= true;
				$field_empty = $_POST[$field];
			}
		}
		
		if(!error){
			$this->id    			= $_POST['id'];
			$this->customer_id     	= $_POST['customer_id'];
			$this->active    		= $_POST['active'];
			$this->on_hold  			= $_POST['on_hold'];
			$this->paid   			= $_POST['paid'];
			$this->last_update  		= $_POST['last_update'];
			$this->comment    		= $_POST['comment'];
			
			// eye , ¿must be an array?
			$this->db->where ('customer_id' , $_POST['customer_id']) ;
			$this->db->update('customers', $this);
			
			// return last id inserted
			echo $this->db->insert_id();
			
		}else{
			
			echo 'All fields are required to update a row. This is empty : '. $field_empty ;
		}
	}
	
	// D
	
	public function delete(){
		
		if(isset($_POST['invoice_id'])){
			
			$this->db->where('customer_id',$_POST['invoice_id'] );
			$result =  $this->db->delete('invoice');
			
			echo json_encode($result);
			
		}else{
			
			echo 'Customer id is empty, nothing to delete' ;
		}
		
	}
        
        
}
?>
