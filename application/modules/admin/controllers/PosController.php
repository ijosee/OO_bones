<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PosController extends Admin_Controller {
    
    
    // Frontend User POS
    public function index()
    {
        $this->render('pos');
    }
    
   //
   //
   //........................... CUSTOMERS
   //
   //
    
    
    public function getCustomers (){
        
    	$return_arr['results'] = array();
        
        $this->load->model('Customer_model');
        
        $query = $this->Customer_model->read();
        
        foreach ($query as $row) {	
            $row_array['id'] = $row->customer_id;
            $row_array['text'] = utf8_encode($row->last_name.",".$row->first_name);
            array_push($return_arr['results'], $row_array);
        }
        
        echo json_encode($return_arr);
        
    }
    

   //
   //
   //........................... PRODUCTS
   //
   //
   
    public function getProducts (){
        
    	    $return_arr['results'] = array();
        
        $query = $this->db->get('products');
        
        foreach ($query->result() as $row) {
            $row_array['id'] = $row->id;
            $row_array['text'] = utf8_encode($row->name);
            array_push( 	$return_arr['results'], $row_array);
        }
        
        echo json_encode($return_arr);
        
    }
    
    

    /// is the mixting , if exist update else insert
    // replace in CODEIGNITER
    public function replaceProducts (){
    	
    	$return_arr['results'] = array();
    	
    	$query = $this->db->get('products');
    	
    	foreach ($query->result() as $row) {
    		$row_array['id'] = $row->id;
    		$row_array['text'] = utf8_encode($row->name);
    		array_push($return_arr['results'], $row_array);
    	}
    	
    	echo json_encode($return_arr);
    	
    }
    
    
    public function getProductsWithPrice (){
        
        $return_arr = array();
        
        $query = $this->db->get('products');
        
        foreach ($query->result() as $row) {
            $row_array['id'] = $row->id;
            $row_array['name'] = $row->name;
            $row_array['price'] = $row->price_sale;
            $row_array['image'] = "http://placehold.it/460x250/e67e22/ffffff&text=HTML5";
            array_push($return_arr, $row_array);
        }
        
        echo json_encode($return_arr);
        
    }
    
    
    // Categories
    
    public function getCategories (){
        
    		$return_arr['results'] = array();
        
        $query = $this->db->get('category');
        
        foreach ($query->result() as $row) {
            $row_array['id'] = $row->id;
            $row_array['text'] = utf8_encode($row->name);
            array_push($return_arr, $row_array);
        }
        
        echo json_encode($return_arr);
        
    }
    
    
}
