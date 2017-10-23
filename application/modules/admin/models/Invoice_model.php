<?php
// this model is for customer
class Invoice_model extends CI_Model {
		
		
	// all values in DDBB
	public $id;
	public $customer_id;
	public $active;
	public $on_hold;
	public $paid;
	public $created_time;
	public $last_update;
	public $pay_method;
	public $comment;
	
	public function __construct(){
		
		parent::__construct();
		// code here if you need init some values
	}
	
	// CRUD values
	// C
	
	public function create (){
		
		$required_fields = array (
				'item_id'
				,'customer_id'
				,'invoice_id'
		);
		
		$error = false;
		$field_empty = '';
		foreach($required_fields as $field){

			if(!isset($_POST[$field])) 
			{
				$error= true;
				$field_empty = $field;
				$field_value = $_POST[$field];
				//echo '<br> Field : '. $field_empty.  ' -//- Field value : '.$_POST[$field].'<br> -//- isset_value : '.isset($_POST[$field]);
			}

		}
		
		if(!$error && (int)$_POST['invoice_id'] === 0){

			$this->customer_id     	= $_POST['customer_id'];
			$this->active    		= true;
			$this->on_hold  		= false;
			$this->paid   			= false;
			$this->created_time  	= date("Y-m-d H:i:s");
			$this->last_update  	= date("Y-m-d H:i:s");
			$this->comment    		= "" ;
			
			$this->db->insert('invoice', $this);

			// return last id inserted
			$tem_invoice_id =  $this->db->insert_id();


			$customer_id    = $_POST['customer_id'];
			$invoice_id   	= $tem_invoice_id;
			$date = date('Y-m-d H:i:s');

			$data_invoice_customer = array(
				'customer_id' => $customer_id
				, 'invoice_id' => $invoice_id
				, 'last_update' => $date
			);
			
			$this->db->insert('invoice_customer', $data_invoice_customer);

			$product_id  	= $_POST['item_id'];

			$data_invoice_product = array(
				 'invoice_id' => $invoice_id
				, 'product_id' => $product_id
				, 'last_update' => $date
			);
			
			$this->db->insert('invoice_product', $data_invoice_product);
			
			// return last id invoice inserted 
			return $invoice_id ;
			
		}else if(!$error && (int)$_POST['invoice_id'] !== 0){

			$invoice_id   	= $_POST['invoice_id'];
			$product_id  	= $_POST['item_id'];
			$date 			= date('Y-m-d H:i:s');

			$data_invoice_product = array(
				 'invoice_id' => $invoice_id
				, 'product_id' => $product_id
				, 'last_update' => $date
			);
			
			$this->db->insert('invoice_product', $data_invoice_product);

			$this->db->set('last_update',$date);
			$this->db->where('id',$invoice_id);
			$this->db->update('invoice');

			// return last invoice updated
			return $_POST['invoice_id'] ; 

		}else{

			return 'You have to fill up all params' ;

		}
		
	}
	
	// R
	
	public function read($invoice_id = NULL){
		
		if(isset($invoice_id)){
			
			$this->db->select('invoice.id as invoice_id
				,customers.customer_id as customer_id
				,customers.first_name as customer_name
				,products.id as product_id
				,products.name as product_name
				,products.price_sale as product_price
				,COUNT(*) as total') ;

			$this->db->from('invoice');
			$this->db->where('invoice.id',$invoice_id);

			$this->db->join('invoice_customer','invoice.id = invoice_customer.invoice_id');

			$this->db->join('invoice_product','invoice.id = invoice_product.invoice_id');

			$this->db->join('customers','invoice.customer_id = customers.customer_id');

			$this->db->join('products','invoice_product.product_id = products.id');

			$this->db->group_by("products.id");

			$result = $this->db->get()->result();
			
			return $result;
			
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
		
		if(!$error){
			$this->id    			= $_POST['id'];
			$this->customer_id     	= $_POST['customer_id'];
			$this->active    		= $_POST['active'];
			$this->on_hold  		= $_POST['on_hold'];
			$this->paid   			= $_POST['paid'];
			$this->last_update  	= $_POST['last_update'];
			$this->comment    		= $_POST['comment'];
			
			// eye , ¿must be an array?
			$this->db->where ('customer_id' , $_POST['customer_id']) ;
			$this->db->update('customers', $this);
			
			// return last id inserted
			return $this->db->insert_id();
			
		}else{
			
			return 'All fields are required to update a row. This is empty : '. $field_empty ;
		}
	}
	
	// D
	
	public function delete(){
		
		$required_fields = array (
				'customer_id'
				,'invoice_id'
		);
		
		$error = false;
		$field_empty = '';
		foreach($required_fields as $field){

			if(!isset($_POST[$field])) 
			{
				$error= true;
				$field_empty = $field;
				$field_value = $_POST[$field];
			}

		}

		if(!$error){

			$this->db->where('id',$_POST['invoice_id']);
			$this->db->limit(1);
			$this->db->delete('invoice');

			$this->db->where('invoice_id',$_POST['invoice_id']);
			$this->db->where('customer_id',$_POST['customer_id']);
			$this->db->limit(1);
			$this->db->delete('invoice_customer');

			return $_POST['invoice_id'];
			
		}else{
			
			return 'Invoice id is empty, nothing to delete' ;
		}
		
	}

	public function deleteItem(){
		
		$required_fields = array (
				'item_id'
				,'customer_id'
				,'invoice_id'
		);
		
		$error = false;
		$field_empty = '';
		foreach($required_fields as $field){

			if(!isset($_POST[$field])) 
			{
				$error= true;
				$field_empty = $field;
				$field_value = $_POST[$field];
			}

		}

		if(!$error){

			$this->db->where('invoice_id',$_POST['invoice_id']);
			$this->db->where('product_id',$_POST['item_id']);

			$this->db->limit(1);

			$this->db->delete('invoice_product');
			
			return $_POST['invoice_id'];
			
		}else{
			
			return 'Customer id is empty, nothing to delete' ;
		}
		
	}
        
        
}
?>
