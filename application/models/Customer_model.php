<?php 

class Customer_model extends MY_Model {
    
    public function __construct(){
        
        parent::__construct();
        $this->load->database();
        
    }
    
    public function get_customer_emails(){
        
        $query = $this->db->query("Select * from customers where email is not null and email != '' and email != '0'");
        
        foreach ($query->result() as $row)
        {
            echo $row->title;
            echo $row->name;
            echo $row->body;
        }
        
        return $query;
    }
    
}