<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Marigold\Domain\BranchLocation\Region;
use Marigold\Domain\BranchLocation\ValueObjects\RegionName;

class Region extends CI_Controller {



    /**
     * __construct function.
     *
     * @access public
     * @return void
     */
    public function __construct()
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

    }

    /**
     * index function.
     *
     * @access public
     * @param mixed $slug (default: false)
     * @return void
     */
    public function index()
    {
        $this->layout->set_title('Test! This is test title');
        $this->layout->set_body_attr(array('id' => 'home', 'class' => 'test more_class'));
        $data["dummy"]='test';
        // load views and send data
        $this->load->view('themes/demo/includes/header', $data);
        $this->load->view('themes/demo/includes/index', $data);
        $this->load->view('themes/demo/includes/footer', $data);
    }
}
