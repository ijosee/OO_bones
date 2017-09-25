<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_category extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
	}
	
	// Frontend User CRUD
	public function index()
	{
	   
		$crud = $this->generate_crud('category');
		$crud->set_theme('flexigrid');
		
		$crud->columns('name','description');
		
		// translations 
		$crud->display_as('name','Nombre');
		$crud->display_as('description','Descripcion');
		
		$crud->fields('name','description');
		
		$this->mPageTitle = 'Categoria productos';
		$this->render_crud();
		
	}

}
