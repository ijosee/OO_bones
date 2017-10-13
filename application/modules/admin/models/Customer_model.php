<?php
class Customer_model extends CI_Model {

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

        public function get_last_ten_entries()
        {
                $query = $this->db->get('entries', 10);
                return $query->result();
        }

        public function insert_entry()
        {
                $this->title    = $_POST['title']; // please read the below note
                $this->content  = $_POST['content'];
                $this->date     = time();

                $this->db->insert('entries', $this);
        }

        public function update_entry()
        {
                $this->title    = $_POST['title'];
                $this->content  = $_POST['content'];
                $this->date     = time();

                $this->db->update('entries', $this, array('id' => $_POST['id']));
        }

}
?>
