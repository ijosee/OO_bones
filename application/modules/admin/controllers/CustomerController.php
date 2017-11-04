<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomerController extends Admin_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_builder');
    }
    
    // Frontend User CRUD
    public function index()
    {
        $crud = $this->generate_crud('customers','Customer');
        
        $crud->columns( 'first_name','last_name','email','phone','active','last_login');
        
        $crud->display_as('first_name','Nombre');
        $crud->display_as('last_name','Apellido');
        $crud->display_as('email','Mail');
        $crud->display_as('phone','Teléfono');
        $crud->display_as('active','Activo');
        $crud->display_as('last_login','Última visita');
        $crud->display_as('observations','Observaciones');
       
        $this->unset_crud_fields('username','ip_address', 'last_login', 'company');
        
        $crud->fields('first_name', 'last_name', 'email','phone', 'active','last_login','observations');
        $crud->field_type('observations','text');
        
        // only webmaster and admin can change member groups
        if ($crud->getState()=='list' || $this->ion_auth->in_group(array('webmaster', 'admin')))
        {
            //action when list and web master or admin active
        }
        
        $this->mPageTitle = 'Clientes';
        
        $this->render_crud();
    }
    
    // Create Frontend User
    public function create()
    {
        $form = $this->form_builder->create_form();
        
        if ($form->validate())
        {
            // passed validation
            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $identity = empty($username) ? $email : $username;
            $additional_data = array(
                'first_name'	   => $this->input->post('first_name'),
                'last_name'	   => $this->input->post('last_name'),
            );
            $groups = $this->input->post('groups');
            //$observations = $this->input->post('observations');
            
            // [IMPORTANT] override database tables to update Frontend Users instead of Admin Users
            $this->ion_auth_model->tables = array(
                'users'				=> 'users',
                'groups'			    => 'groups',
                'users_groups'		=> 'users_groups',
                'login_attempts'    	=> 'login_attempts',
            );
            
            // proceed to create user
            $user_id = $this->ion_auth->register($identity, $password, $email, $additional_data, $groups);
            if ($user_id)
            {
                // success
                $messages = $this->ion_auth->messages();
                $this->system_message->set_success($messages);
                
                // directly activate user
                $this->ion_auth->activate($user_id);
            }
            else
            {
                // failed
                $errors = $this->ion_auth->errors();
                $this->system_message->set_error($errors);
            }
            refresh();
        }
        
        // get list of Frontend user groups
        $this->load->model('group_model', 'groups');
        $this->mViewData['groups'] = $this->groups->get_all();
        $this->mPageTitle = 'Nuevo cliente' ;
        
        $this->mViewData['form'] = $form;
        $this->render('customer/create');
    }
    
    // User Groups CRUD
    public function group()
    {
        $crud = $this->generate_crud('groups');
        $this->mPageTitle = 'User Groups';
        $this->render_crud();
    }
    
    // POS Customers

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
    
    
}
