<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pos extends Admin_Controller {
    
    
    // Frontend User POS
    public function index()
    {
        $this->render('pos');
    }
    
    
    
    // get elements
    // GET CUSTOMERS
    
    public function getCustomers (){
        
        $return_arr = array();
        
        $query = $this->db->get('customers');
        
        foreach ($query->result() as $row) {
            $row_array['id'] = $row->customer_id;
            $row_array['text'] = utf8_encode($row->last_name.",".$row->first_name);
            array_push($return_arr, $row_array);
        }
        
        $ret = array();
        /*
         * this is the return for a single result needed by select2 for
         * initSelection
         */
        if (isset($id)) {
            $ret = $row_array;
        }        /*
        * this is the return for a multiple results needed by select2
        * Your results in select2 options needs to be data.result
        */
        else {
            $ret['results'] = $return_arr;
        }
        
        echo json_encode($ret);
        
    }
    
    public function getProducts (){
        
        $return_arr = array();
        
        $query = $this->db->get('products');
        
        foreach ($query->result() as $row) {
            $row_array['id'] = $row->id;
            $row_array['text'] = utf8_encode($row->name);
            array_push($return_arr, $row_array);
        }
        
        $ret = array();
        /*
         * this is the return for a single result needed by select2 for
         * initSelection
         */
        if (isset($id)) {
            $ret = $row_array;
        }        /*
        * this is the return for a multiple results needed by select2
        * Your results in select2 options needs to be data.result
        */
        else {
            $ret['results'] = $return_arr;
        }
        
        echo json_encode($ret);
        
    }
    
    public function getProductsWithPrice (){
        
        $return_arr = array();
        
        $query = $this->db->get('products');
        
        foreach ($query->result() as $row) {
            $row_array['name'] = $row->name;
            $row_array['price'] = $row->price_sale;
            $row_array['image'] = "http://placehold.it/460x250/e67e22/ffffff&text=HTML5";
            array_push($return_arr, $row_array);
        }
        
        $ret = array();
        /*
         * this is the return for a single result needed by select2 for
         * initSelection
         */
        if (isset($id)) {
            $ret = $row_array;
        }        /*
        * this is the return for a multiple results needed by select2
        * Your results in select2 options needs to be data.result
        */
        else {
            $ret = $return_arr;
        }
        
        echo json_encode($ret);
        
    }
    
    public function getCategories (){
        
        $return_arr = array();
        
        $query = $this->db->get('category');
        
        foreach ($query->result() as $row) {
            $row_array['id'] = $row->id;
            $row_array['text'] = utf8_encode($row->name);
            array_push($return_arr, $row_array);
        }
        
        $ret = array();
        /*
         * this is the return for a single result needed by select2 for
         * initSelection
         */
        if (isset($id)) {
            $ret = $row_array;
        }        /*
        * this is the return for a multiple results needed by select2
        * Your results in select2 options needs to be data.result
        */
        else {
            $ret['results'] = $return_arr;
        }
        
        echo json_encode($ret);
        
    }
    
    
}
