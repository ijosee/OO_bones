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
				,invoice.created_time as created_time
				,invoice.active as active
				,invoice.on_hold as on_hold
				,invoice.paid as paid
				,customers.customer_id as customer_id
				,customers.first_name as customer_name
				,customers.observations as comment
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
			
			$fields_datatable = array(
				'draw'
				,'start'
				,'length' );

			$error = false ;

			foreach ($fields_datatable as $value) {

				if(!isset($_POST[$value])){
					$error = true ; 
				}
			}
			
			if($error) 
				return 'error';

			$this->db->join('customers c','invoice.customer_id = c.customer_id');

			if($_POST['search']['value'] != ''){

				$this->db->like('c.first_name',$_POST['search']['value']);
				$this->db->or_like('c.last_name',$_POST['search']['value']);
				
				$this->db->order_by($_POST['order'][0]['column'], $_POST['order'][0]['dir']);
				$result = $this->db->get('invoice',$_POST['length'],$_POST['start'])->result();

			}else{

				$this->db->order_by($_POST['order'][0]['column'], $_POST['order'][0]['dir']);
				$result = $this->db->get('invoice',$_POST['length'],$_POST['start'])->result();

			}

			$newResult = array ();

			foreach ($result as $row) {

				$resultFormated = array (
					$row->id
					,$row->first_name
					,$row->last_name
					,$row->active
					,$row->on_hold
					,$row->paid
					,$row->created_time
					,$row->last_update
					,$row->comment
					,$row->pay_method
				);

				array_push($newResult, $resultFormated);
			}

			$modifiedArray = array(
				'draw' => intval( $_POST['draw'] )
				,'recordsTotal' => intval( $this->db->get('invoice')->num_rows() )
				,'recordsFiltered' => intval( $this->db->get('invoice')->num_rows() )
				,'data' => $newResult
			);

			return $modifiedArray ;

		}
		
	}
	
	// U
	
	public function update () {
		
		if(isset($_POST['invoice_id'])){
			
			if(isset($_POST['invoice_active'])
				&& isset($_POST['invoice_on_hold'])
				&& isset($_POST['invoice_paid'])){

				if( strval($_POST['invoice_active']) == "true" ){
					$_POST['invoice_active'] = 1;
				}else{
					$_POST['invoice_active'] = 0;
				}

				if( strval($_POST['invoice_on_hold']) == "true" ){
					$_POST['invoice_on_hold'] = 1;
				}else{
					$_POST['invoice_on_hold'] = 0;

				}

				if( strval($_POST['invoice_paid']) == "true" ){
					$_POST['invoice_paid'] = 1;
				}else{
					$_POST['invoice_paid'] = 0;
				}

				$data = array(
				        'active' => $_POST['invoice_active']
				        ,'on_hold' => $_POST['invoice_on_hold']
				        ,'paid' => $_POST['invoice_paid']
				);

				$this->db->where ('id' , $_POST['invoice_id']) ;
				$this->db->update('invoice',$data);

			return $_POST['invoice_id'];

			}else{

				return 0 ;
			}
			
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
