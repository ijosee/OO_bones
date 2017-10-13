<?php
// this model is for customer
class Customer_model extends CI_Model {
		
		// all values in DDBB
        public $customer_id;
        public $ip_address;
        public $usermane;
        public $password;
        public $salt;
        public $email;
        public $activation_code;
        public $forgotten_password_code;
        public $forgotten_password_time;
        public $remember_code;
        public $created_on;
        public $last_login;
        public $active;
        public $first_name;
        public $company;
        public $phone;
        public $observations;
        
        public function __construct(){
        	
        		parent::__construct();
        		// code here if you need init some values
        }
		
        // CRUD values
        // C
        
        public function create (){
        	
	        	$required_fields = array (
	        			'customer_id'
	        			,'ip_address'
	        			,'username'
	        			,'password'
	        			,'salt'
	        			,'email'
	        			,'activation_code'
	        			,'forgotten_password_code'
	        			,'forgotten_password_time'
					,'remember_code'
	        			,'created_on'
	        			,'last_login'
	        			,'active'
	        			,'first_name'
	        			,'last_name'
	        			,'company'
	        			,'phone'
	        			,'observations'
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
	        		$this->customer_id    			= $_POST['customer_id'];
	        		$this->ip_address     			= $_POST['ip_address'];
	        		$this->username    				= $_POST['username'];
	        		$this->password  				= $_POST['password'];
	        		$this->salt   					= $_POST['salt'];
	        		$this->email  					= $_POST['email'];
	        		$this->activation_code    		= $_POST['activation_code'];
	        		$this->forgotten_password_code   = $_POST['forgotten_password_code'];
	        		$this->forgotten_password_time   = $_POST['forgotten_password_time'];
	        		$this->remember_code  		 	= $_POST['remember_code'];
	        		$this->created_on    			= time();
	        		$this->last_login  				= $_POST['last_login'];
	        		$this->active    				= $_POST['active'];
	        		$this->first_name  				= $_POST['first_name'];
	        		$this->last_name  				= $_POST['last_name'];
	        		$this->company     				= $_POST['company'];
	        		$this->phone     				= $_POST['phone'];
	        		$this->observations     			= $_POST['observations'];
	        		
	        		$this->db->insert('customers', $this);
	        		
	        		// return last id inserted
	        		echo $this->db->insert_id();
	        		
	        	}else{
	        		
	        		echo 'All fields are required to insert a row. This is empty : '. $field_empty ;
	        	}
        	
        }
        
        // R
        
        public function read(){
        	
	        	if(isset($_POST['customer_id'])){
	        		
	        		$this->db->where('customer_id',$_POST['customer_id'] );
	        		$result =  $this->db->get('customer');
	        		
	        		echo json_encode($result);
	        	
	        	}else{
	        		
	        		return $this->db->get('customers')->result();
	        		
	        	}
        	
        }
        
        // U 
        
        public function update () {
        	
	        	$required_fields = array (
	        			'customer_id'
	        			,'ip_address'
	        			,'username'
	        			,'password'
	        			,'salt'
	        			,'email'
	        			,'activation_code'
	        			,'forgotten_password_code'
	        			,'forgotten_password_time'
	        			,'remember_code'
	        			,'created_on'
	        			,'last_login'
	        			,'active'
	        			,'first_name'
	        			,'last_name'
	        			,'company'
	        			,'phone'
	        			,'observations'
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
	        		$this->customer_id    			= $_POST['customer_id'];
	        		$this->ip_address     			= $_POST['ip_address'];
	        		$this->username    				= $_POST['username'];
	        		$this->password  				= $_POST['password'];
	        		$this->salt   					= $_POST['salt'];
	        		$this->email  					= $_POST['email'];
	        		$this->activation_code    		= $_POST['activation_code'];
	        		$this->forgotten_password_code   = $_POST['forgotten_password_code'];
	        		$this->forgotten_password_time   = $_POST['forgotten_password_time'];
	        		$this->remember_code  		 	= $_POST['remember_code'];
	        		$this->created_on    			= time();
	        		$this->last_login  				= $_POST['last_login'];
	        		$this->active    				= $_POST['active'];
	        		$this->first_name  				= $_POST['first_name'];
	        		$this->last_name  				= $_POST['last_name'];
	        		$this->company     				= $_POST['company'];
	        		$this->phone     				= $_POST['phone'];
	        		$this->observations     			= $_POST['observations'];
	        		
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
        	
	        	if(isset($_POST['customer_id'])){
	        		
	        		$this->db->where('customer_id',$_POST['customer_id'] );
	        		$result =  $this->db->delete('customer');
	        		
	        		echo json_encode($result);
	        		
	        	}else{
	        		
	        		echo 'Customer id is empty, nothing to delete' ;
	        	}
        	
        }
        

}
?>
