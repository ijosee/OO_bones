<?php
// this model is for customer
class Calendar_model extends CI_Model {
		
		// all values in DDBB
        public $id;
        public $shop_id;
        public $date_in;
        public $date_out;
        public $value;
        public $backgroundColor;
        public $borderColor;
        public $last_update;
        public $shop_id;
        public $all_day;
        
        public function __construct(){
        	
        		parent::__construct();
        		// code here if you need init some values
        }
		
        // CRUD values
        // C
        
        public function create (){
        	
	        	$required_fields = array (
	        			'id'
	        			,'shop_id'
	        			,'date_in'
	        			,'date_out'
	        			,'value'
	        			,'backgorundColor'
	        			,'borderColor'
	        			,'last_update'
	        			,'all_day'
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
	        		$this->shop_id   		= $_POST['shop_id'];
	        		$this->date_in    		= $_POST['date_in'];
	        		$this->date_out    		= $_POST['date_out'];
	        		$this->value  			= $_POST['value'];
	        		$this->backgroundColor  	= $_POST['backgroundColor'];
	        		$this->borderColor		= $_POST['borderColor'];
	        		$this->last_update    	= $_POST['last_update'];
	        		$this->all_day   		= $_POST['all_day'];
	        		
	        		$this->db->insert('calendar', $this);
	        		
	        		// return last id inserted
	        		echo $this->db->insert_id();
	        		
	        	}else{
	        		
	        		echo 'All fields are required to insert a row. This is empty : '. $field_empty ;
	        	}
        	
        }
        
        // R
        
        public function read(){
        	
	        	if(isset($_POST['id'])){
	        		
	        		$this->db->where('id',$_POST['id'] );
	        		$result =  $this->db->get('calendar');
	        		
	        		echo json_encode($result);
	        	
	        	}else{
	        		
	        		echo 'Calendar id is empty, nothing to read' ; 
	        	}
        	
        }
        
        // U 
        
        public function update () {
        	
	        	$required_fields = array (
	        			'id'
	        			,'shop_id'
	        			,'date_in'
	        			,'date_out'
	        			,'value'
	        			,'backgorundColor'
	        			,'borderColor'
	        			,'last_update'
	        			,'all_day'
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
	        		$this->shop_id   		= $_POST['shop_id'];
	        		$this->date_in    		= $_POST['date_in'];
	        		$this->date_out    		= $_POST['date_out'];
	        		$this->value  			= $_POST['value'];
	        		$this->backgroundColor  	= $_POST['backgroundColor'];
	        		$this->borderColor		= $_POST['borderColor'];
	        		$this->last_update    	= $_POST['last_update'];
	        		$this->all_day 			= $_POST['all_day'];
	        		
	        		// eye , ¿must be an array?
	        		$this->db->where ('id' , $_POST['id']) ;
	        		$this->db->update('calendar', $this);
	        		
	        		// return last id inserted
	        		echo $this->db->insert_id();
	        		
	        	}else{
	        		
	        		echo 'All fields are required to update a row. This is empty : '. $field_empty ;
	        	}
        }
        
        // D
        
        public function delete(){
        	
	        	if(isset($_POST['id'])){
	        		
	        		$this->db->where('id',$_POST['id'] );
	        		$result =  $this->db->delete('calendar');
	        		
	        		echo json_encode($result);
	        		
	        	}else{
	        		
	        		echo 'Calendar id is empty, nothing to delete' ;
	        	}
        	
        }

}
?>
