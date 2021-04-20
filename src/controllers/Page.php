<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Page extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
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

	public function view($page = 'home'){
		if(!file_exists(APPPATH.'views/themes/demo/pages/'.ucfirst($page).'.php')){
			echo file_exists(APPPATH.'views/themes/demo/pages/'.ucfirst($page).'.php');
			//show_404();
		}
		
        $this->layout->set_title(ucfirst($page));
        $this->layout->set_body_attr(array('id' => $page, 'class' => 'test'));
		$data['title'] = ucfirst($page);

		$this->load->view('themes/demo/includes/header');
		$this->load->view('themes/demo/pages/'. $page , $data);
		$this->load->view('themes/demo/includes/footer');
	}


	public function add($page = 'home'){
		if(!file_exists(APPPATH.'views/themes/demo/pages/add/'.$page.'.php')){
			show_404();
		}
		
        $this->layout->set_title(ucfirst($page));
        $this->layout->set_body_attr(array('id' => $page, 'class' => 'test'));
		$data['title'] = ucfirst($page);

		$this->load->view('themes/demo/includes/header');
		$this->load->view('themes/demo/pages/add/'. $page, $data);
		$this->load->view('themes/demo/includes/footer');
	}

	public function edit($page = '', $guid = '' ){
		if(!file_exists(APPPATH.'views/themes/demo/pages/edit/'.$page.'.php')){
			show_404();
		}
		
        $this->layout->set_title(ucfirst($page));
        $this->layout->set_body_attr(array('id' => $page, 'class' => $page));


		$this->load->view('themes/demo/includes/header');
		$this->load->view('themes/demo/pages/edit/'. $page);
		$this->load->view('themes/demo/includes/footer');
	}

	// function _remap($method,  $params = array())
	// {
	// // $method contains the method name from URI, that is second URI segment.
	// 	// switch($method)
	// 	// {
	// 	// 	case 'Region':
	// 	// 		$this->about_me();
	// 	// 	break;
			
	// 	// 	case 'District':
	// 	// 		$this->contact_us();
	// 	// 	break;

	// 	// 	default:
	// 	// 		$this->Not_Found();
	// 	// 	break;

	// 	// }

	// 	$method = 'process'.ucwords($method);
	// 	if (method_exists($this, $method))
	// 	{
	// 		return call_user_func_array(array($this, $method), $params);
	// 	}
	// 	show_404();
	// }

	// public function about_me(){
	// 	echo "Welcome to profile function";
	//    }
	//    public function contact_us(){
	// 	echo "Hi I am John !";
	//    }
	//    public function Not_Found(){
	// 	echo " I am Master in Computer application.";
	//    }
}
