<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * @author jose
 *        
 */
class Sand extends \MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }
    
    function comp_widget_sand ( )
    {
        $data = array();
        
        $this->load->view('sand/comp_widget_sand', $data);
    }
    
    function comp_widget_sand_large ( )
    {
        $data = array();
        
        $this->load->view('sand/comp_widget_sand_large', $data);
    }
}

