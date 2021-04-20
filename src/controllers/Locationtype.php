<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Locationtype extends CI_Controller {



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
    public function create()
    {
        $this->layout->set_title('Info Type');
        $this->layout->set_body_attr(array('id' => 'locationtype', 'class' => 'locationtype'));

        $this->form_validation->set_rules('locationtype', 'locationtype', 'required');


        if($this->form_validation->run() == FALSE){

            $this->layout->set_title('Info Type');
            $this->layout->set_body_attr(array('id' => 'locationtype', 'class' => 'locationtype'));

            $this->load->view('themes/demo/includes/header');
            $this->load->view('themes/demo/pages/add/locationtype');
            $this->load->view('themes/demo/includes/footer');
        } else {

            $data = array(
				'locationtype' => $this->input->post('locationtype')
			);

            $this->load->model('MLocationType');
            $this->MLocationType->create($data);
            redirect('locationtype');
        }
    }
}