<?php
// this model is for customer
class Product_model extends CI_Model {
	
	// all values in DDBB
	public $id;
	public $REF;
	public $name;
	public $price_base;
	public $price_sale;
	public $active;
	public $provider_id;
	public $provider_string;
	public $description;
	public $last_update;
	
	public function __construct() {
		parent::__construct ();
		// code here if you need init some values
	}
	
	// CRUD values
	// C
	public function create() {
		$required_fields = array (
				'id',
				'REF',
				'name',
				'price_base',
				'price_sale',
				'active',
				'provider_id',
				'provider_string',
				'description',
				'last_update'
		);
		
		$error = false;
		$field_empty = '';
		foreach ( $required_fields as $field ) {
			if (isset ( $_POST [$field] )) {
				$error = true;
				$field_empty = $_POST [$field];
			}
		}
		
		if (! error) {
			$this->id = $_POST ['id'];
			$this->REF = $_POST ['REF'];
			$this->price_base = $_POST ['price_base'];
			$this->price_sale = $_POST ['price_sale'];
			$this->active = $_POST ['active'];
			$this->provider_id = $_POST ['provider_id'];
			$this->provider_string = $_POST ['provider_string'];
			$this->description = $_POST ['description'];
			$this->last_update = $_POST ['last_update'];
			
			$this->db->insert ( 'product', $this );
			
			// return last id inserted
			echo $this->db->insert_id ();
		} else {
			
			echo 'All fields are required to insert a row. This is empty : ' . $field_empty;
		}
	}
	
	// R
	public function read() {
		if (isset ( $_POST ['product_id'] )) {
			
			$this->db->where ( 'product_id', $_POST ['product_id'] );
			$result = $this->db->get ( 'product' );
			
			echo json_encode ( $result );
		} else {
			
			echo 'Product id is empty, nothing to read';
		}
	}
	
	// U
	public function update() {
		$required_fields = array (
				'id',
				'REF',
				'name',
				'price_base',
				'price_sale',
				'active',
				'provider_id',
				'provider_string',
				'description',
				'last_update'
		);
		
		$error = false;
		$field_empty = '';
		foreach ( $required_fields as $field ) {
			if (isset ( $_POST [$field] )) {
				$error = true;
				$field_empty = $_POST [$field];
			}
		}
		
		if (! error) {
			$this->id = $_POST ['id'];
			$this->REF = $_POST ['REF'];
			$this->price_base = $_POST ['price_base'];
			$this->price_sale = $_POST ['price_sale'];
			$this->active = $_POST ['active'];
			$this->provider_id = $_POST ['provider_id'];
			$this->provider_string = $_POST ['provider_string'];
			$this->description = $_POST ['description'];
			$this->last_update = $_POST ['last_update'];
			
			// eye , ¿must be an array?
			$this->db->where ( 'product_id', $_POST ['product_id'] );
			$this->db->update ( 'product', $this );
			
			// return last id inserted
			echo $this->db->insert_id ();
		} else {
			
			echo 'All fields are required to update a row. This is empty : ' . $field_empty;
		}
	}
	
	// D
	public function delete() {
		if (isset ( $_POST ['product_id'] )) {
			
			$this->db->where ( 'product_id', $_POST ['product_id'] );
			$result = $this->db->delete ( 'product' );
			
			echo json_encode ( $result );
		} else {
			
			echo 'Product id is empty, nothing to delete';
		}
	}
}
?>
