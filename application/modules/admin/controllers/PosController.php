<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PosController extends Admin_Controller {
    
    
    // Frontend User POS
    public function index()
    {
        $this->render('pos');
    }

    public function history()
    {
        $this->render('pos_history');
    }
    

   //
   //
   //........................... PRODUCTS
   //
   //
   
    
    
    

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
    
    
    
    
}
