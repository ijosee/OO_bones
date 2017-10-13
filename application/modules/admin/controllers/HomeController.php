<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends Admin_Controller {

	public function index()
	{
		
		$this->render('home');
	}
	
	
	
}
