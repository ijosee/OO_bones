<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//require '/vendor/autoload.php';

/**
 * Home page
 */
class HomeSecondary extends MY_Controller {

	public function index()
	{
		$this->render('home', 'empty');
	}
	
	
}
