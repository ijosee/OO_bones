<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * @author jose
 *        
 */
class Calendario extends \MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    
    function index ()
    {
        $data = array();
        
        $this->load->view('calendario/comp_widget_calendar', $data);
    }

    function comp_full_calendar ()
    {
        $data = array();

        echo 'dentro del metodo <br>';

        $this->load->view('calendario/comp_full_calendar', $data);
    }

  
}

