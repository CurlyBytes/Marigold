<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Api extends CI_Controller {



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


        $this->form_validation->set_rules('locationtype', 'locationtype', 'required|min_length[2]|max_length[70]|alpha_numeric');


        if($this->form_validation->run() === FALSE){
            $this->layout->set_title('Info Type');
            $this->layout->set_body_attr(array('id' => 'locationtype', 'class' => 'locationtype'));

            $this->load->view('themes/demo/includes/header');
            $this->load->view('themes/demo/pages/locationtype/create');
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


    public function modify()
    {
        $this->layout->set_title('Info Type');
        $this->layout->set_body_attr(array('id' => 'locationtype', 'class' => 'locationtype'));

        $this->form_validation->set_rules('locationtype', 'locationtype', 'required');


        if($this->form_validation->run() === FALSE){

            $this->layout->set_title('Info Type');
            $this->layout->set_body_attr(array('id' => 'locationtype', 'class' => 'locationtype'));

            $this->load->view('themes/demo/includes/header');
            $this->load->view('themes/demo/pages/locationtype/modify');
            $this->load->view('themes/demo/includes/footer');
        } else {

            $data = array(
                'locationtypeid' => $this->input->post('locationtypeid'),
				'locationtype' => $this->input->post('locationtype')
			);

            $this->load->model('MLocationType');
            $this->MLocationType->modify($data);
            redirect('locationtype');
        }
    }

    public function retrieve()
    {
        $this->layout->set_title('Info Type');
        $this->layout->set_body_attr(array('id' => 'locationtype', 'class' => 'locationtype'));

        $this->load->model('MLocationType');
        $data = $this->MLocationType->getAllLocationType();
        

        $this->load->view('themes/demo/includes/header');
        $this->load->view('themes/demo/pages/locationtype' , $data);
        $this->load->view('themes/demo/includes/footer');        
    }

	public function index(){
		if(!file_exists(APPPATH.'views/themes/demo/pages/location.php')){
			echo file_exists(APPPATH.'views/themes/demo/pages/location.php');
			//show_404();
		}
		
        $this->layout->set_title(ucfirst($page));
        $this->layout->set_body_attr(array('id' => $page, 'class' => 'test'));
		$data['title'] = ucfirst($page);

		$this->load->view('themes/demo/includes/header');
		$this->load->view('themes/demo/pages/'. $page , $data);
		$this->load->view('themes/demo/includes/footer');
	}

}
