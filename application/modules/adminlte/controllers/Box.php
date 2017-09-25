<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * @author jose
 *        
 */
class Box extends \MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 
     * @param string $color
     * @param int $number
     * @param string $label
     * @param string $icon
     * @param string $url
     */
    function comp_widget_static_box ($color, $number, $label, $icon, $url )
    {
        $data = array(
            'color' => $color,
            'number' => $number,
            'label' => $label,
            'icon' => $icon,
            'url' => $url,
            'more_info' => empty($url) ? '&nbsp;' : "More info <i class='fa fa-arrow-circle-right'></i>"
        );
        
        $this->load->view('box/comp_widget_static_box', $data);
    }

    public function comp_widget_dynamic_box($title, $body, $isLoading , $url)
    {
        $data = array(
            'title'=> $title,
            'body'=> $body,
            'isLoading'=> $isLoading,
            'url'=> $url
        );
        
        $this->load->view('box/comp_widget_dynamic_box', $data);
    }
    
    public function comp_widget_box_task($title, $tasks)
    {
        $data = array(
            'title'=> $title,
            'tasks'=> $tasks
        );
        
        $this->load->view('box/comp_widget_box_task', $data);
    }
}

