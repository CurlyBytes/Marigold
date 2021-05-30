<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Page extends MariGold_Controller {
    /**
     * __construct function.
     *
     * @access public
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MGeoMap');
        $this->layout->add_js_files(
            array('js?key='.  $_ENV['GOOGLE_API_KEY'] ?? $_SERVER['GOOGLE_API_KEY'] ??  getenv('GOOGLE_API_KEY')),
            'https://maps.googleapis.com/maps/api/');
        $this->layout->set_body_attr(array('id' => 'branch-information', 'class' => 'branch-information'));
    }

	public function index(){
		if(!file_exists(APPPATH.'views/themes/demo/pages/branch_information/geomap.php')){
			show_404();
		}
              

        $branch_information['branch_information'] = $this->MGeoMap->getALlBranchLocation();
        $data['branch_information'] = $branch_information['branch_information'];
        if(!empty($branch_information['branch_information'])){
            $js_geomap_javascript = $this->load->view('themes/demo/pages/branch_information/geomap_javascript', $branch_information, true);
            $this->layout->add_js_rawtext($js_geomap_javascript, 'footer');
        }

        $this->layout->set_title("Branch Information - Geomap");	
        $this->load->view('themes/demo/includes/header');
        $this->load->view('themes/demo/pages/branch_information/geomap', $data);
        $this->load->view('themes/demo/includes/footer');
	}

}
