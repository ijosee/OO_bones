<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmployeeController extends Admin_Controller {
    
    
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_builder');
    }
    
    // Frontend Employee CRUD
    public function index()
    {
        $crud = $this->generate_crud('employees','Employees');
        
        $crud->columns('first_name','last_name','email','phone','active','has_photo','salary','last_login','company','path_photo');
        $crud->set_field_upload('path_photo','application/assets/employee/');
        $crud->display_as('first_name','Nombre');
        $crud->display_as('last_name','Apellido');
        $crud->display_as('email','Mail');
        $crud->display_as('phone','Teléfono');
        $crud->display_as('active','Activo');
        $crud->display_as('has_photo','Foto');
        $crud->display_as('last_login','Último Login');
        $crud->display_as('salary','Salario');
        $crud->display_as('observations','Observaciones');
        $crud->display_as('company','Empresa');
        $crud->display_as('path_photo','Url foto');
       
        $this->unset_crud_fields('ip_address', 'last_login');
        
        //$crud->fields('first_name', 'last_name', 'email','phone', 'active','has_photo','last_login','observations');
        
        
        // only webmaster and admin can change member groups
        if ($crud->getState()=='list' || $this->ion_auth->in_group(array('webmaster', 'admin')))
        {
            //action when list and web master or admin active
        }
        
        $this->mPageTitle = 'Empleados';
        
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
    
    // Frontend User Reset Password

    
    
    
}
