<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//https://avenir.ro/how-to-make-truly-seo-urls-in-codeigniter-without-duplicate-content-on-underscore-urls/
class MariGold_Controller extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->library(array('session', 'layout','form_validation'));
        $this->load->helper(array('url','form','text'));
        
        $this->layout->add_custom_meta('meta', array(
            'charset' => 'utf-8'
        ));
        
        $this->layout->add_custom_meta('meta', array(
            'http-equiv' => 'X-UA-Compatible',
            'content' => 'IE=edge'
        ));
        
        $this->layout->add_css_files(array('main.css','normalize.css'), base_url().'assets/css/');
        $this->load->view('themes/demo/includes/header');
    } 
 
    function __destruct()
    {
        $this->load->view('themes/demo/includes/footer');
    } 
}