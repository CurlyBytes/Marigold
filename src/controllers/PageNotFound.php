<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class PageNotFound extends MariGold_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('layout'));
        $this->load->helper(array('url'));

        $this->layout->add_custom_meta('meta', array(
            'charset' => 'utf-8'
        ));
        
        $this->layout->add_custom_meta('meta', array(
            'http-equiv' => 'X-UA-Compatible',
            'content' => 'IE=edge'
        ));
    }

    public function index()
    {
        $this->layout->set_title('404 - Page Not Found');
        $this->layout->set_body_attr(array('id' => '404', 'class' => '404'));
        $this->output->set_status_header('404'); 
        $this->load->view('themes/demo/includes/404');
    }
}