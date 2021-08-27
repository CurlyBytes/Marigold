<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//https://avenir.ro/how-to-make-truly-seo-urls-in-codeigniter-without-duplicate-content-on-underscore-urls/
class MariGold_Controller extends CI_Controller {

 
    protected $username;

    function __construct()
    {
        parent::__construct();
        $this->load->library(array('session', 'layout','form_validation'));
        $this->load->helper(array('url','form','text', 'security'));
        $this->layout->add_custom_meta('meta', array(
            'charset' => 'utf-8'
        ));
        $this->layout->add_custom_meta('meta', array(
            'http-equiv' => 'X-UA-Compatible',
            'content' => 'IE=edge'
        ));
        $this->layout->add_css_files(
            array('css2?family=Inter:wght@300;400;600&display=swap'),
            'https://fonts.googleapis.com/');
        $this->layout->add_css_files(array('main.css','normalize.css','app.css'), base_url().'assets/theme-demo/css/');
        $this->layout->add_js_files(array('app.js'), base_url().'assets/theme-demo/js/', 'footer');

        $this->username = $this->session->username ?? null;
     
 
    } 

   
  
}