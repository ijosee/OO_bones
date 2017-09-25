<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends Admin_Controller {
    
    // Frontend User CRUD
    public function index()
    {


        $this->render('calendar');
    }
    
}
