<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * @author jose
 *        
 */
class Graph extends \MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }
    
    function comp_widget_graph ( )
    {
        $data = array();
        
        $this->load->view('graph/comp_widget_graph', $data);
    }
}

