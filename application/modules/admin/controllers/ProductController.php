<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductController extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
	}
	
	// Frontend User CRUD
	public function index()
	{
	   
		$crud = $this->generate_crud('products');
		$crud->set_theme('flexigrid');
		
		$crud->columns('name','description','provider_string','price_base','price_sale','active','category');
		
		// translations 
		$crud->display_as('name','Nombre');
		$crud->display_as('description','Descripcion');
		$crud->display_as('provider_string','Proveedor');
		$crud->display_as('price_base','Precio base');
		$crud->display_as('price_sale','Precio venta');
		$crud->display_as('active','Activo');
		$crud->display_as('category','Categoria');
		
		$crud->fields('name','description','provider_string','price_base','price_sale','active','category');
		
		// only webmaster and admin can change member groups
		if ($crud->getState()=='list' || $this->ion_auth->in_group(array('webmaster', 'admin')))
		{
		    
		}

		// disable direct create / delete Frontend User
		$crud->set_relation_n_n('category', 'products_category', 'category', 'product_id', 'id', 'name');
		$this->mPageTitle = 'Productos';
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
				'first_name'	=> $this->input->post('first_name'),
				'last_name'		=> $this->input->post('last_name'),
			);
			$groups = $this->input->post('groups');

			// [IMPORTANT] override database tables to update Frontend Users instead of Admin Users
			$this->ion_auth_model->tables = array(
				'users'				=> 'users',
				'groups'			=> 'groups',
				'users_groups'		=> 'users_groups',
				'login_attempts'	=> 'login_attempts',
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
		$this->mPageTitle = 'Create User';

		$this->mViewData['form'] = $form;
		$this->render('user/create');
	}

	// User Groups CRUD
	public function group()
	{
		$crud = $this->generate_crud('groups');
		$this->mPageTitle = 'User Groups';
		$this->render_crud();
	}

	// Frontend User Reset Password
	public function reset_password($user_id)
	{
		// only top-level users can reset user passwords
		$this->verify_auth(array('webmaster', 'admin'));

		$form = $this->form_builder->create_form();
		if ($form->validate())
		{
			// pass validation
			$data = array('password' => $this->input->post('new_password'));
			
			// [IMPORTANT] override database tables to update Frontend Users instead of Admin Users
			$this->ion_auth_model->tables = array(
				'users'				=> 'users',
				'groups'			=> 'groups',
				'users_groups'		=> 'users_groups',
				'login_attempts'	=> 'login_attempts',
			);

			// proceed to change user password
			if ($this->ion_auth->update($user_id, $data))
			{
				$messages = $this->ion_auth->messages();
				$this->system_message->set_success($messages);
			}
			else
			{
				$errors = $this->ion_auth->errors();
				$this->system_message->set_error($errors);
			}
			refresh();
		}

		$this->load->model('user_model', 'users');
		$target = $this->users->get($user_id);
		$this->mViewData['target'] = $target;

		$this->mViewData['form'] = $form;
		$this->mPageTitle = 'Reset User Password';
		$this->render('user/reset_password');
	}

	// POS Products
	public function getProducts (){

		$this->load->model('Product_model');
		
		$query = $this->Product_model->read();
        
    	$return_arr['results'] = array();
        
        foreach ($query->result() as $row) {
            $row_array['id'] = $row->id;
            $row_array['text'] = utf8_encode($row->name);
            array_push($return_arr['results'], $row_array);
        }
        
        echo json_encode($return_arr);
    }

    public function getProductsWithPrice (){

    	$this->load->model('Product_model');
		
		$query = $this->Product_model->read();
        
        $return_arr = array();
        
        foreach ($query->result() as $row) {
            $row_array['id'] = $row->id;
            $row_array['name'] = $row->name;
            $row_array['price'] = $row->price_sale;
            $row_array['image'] = "http://placehold.it/460x250/1EAB49/ffffff&text=Producto";
            array_push($return_arr, $row_array);
        }
        
        echo json_encode($return_arr);
    }
    
    // POS Categories
    public function getCategories (){

    	$this->load->model('Product_model');
		
		$query = $this->Product_model->readCategories();
        
    	$return_arr['results'] = array();
        
        foreach ($query->result() as $row) {
            $row_array['id'] = utf8_encode($row->provider_string);
            $row_array['text'] = utf8_encode($row->provider_string);
            array_push($return_arr['results'], $row_array);
        }
        
        echo json_encode($return_arr);
    }
}
