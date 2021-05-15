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
            array('js?key=AIzaSyColWfyFStBR5YA_2rBCo4SbKYwvWrzrR4'),
            'https://maps.googleapis.com/maps/api/');
        $this->layout->set_body_attr(array('id' => 'branch-expansion', 'class' => 'branch-expansion'));
    }

	public function proposegeomap(){
		if(!file_exists(APPPATH.'views/themes/demo/pages/branch_expansion/geomap.php')){
			show_404();
		}
       
        $data['branch'] = $this->MGeoMap->branchWithoutLocation();
        $propose_branch['propose_branch'] = null;
        
        if($this->input->post() && $this->form_validation->run('branch-expansion/monthyear-filter') === true){
            $parameter = array(
                'branchid' => $this->input->post('branchid'),
                'beginningdate' => $this->input->post('beginningdate'),
                'endingdate' => $this->input->post('endingdate')
            );
            $propose_branch['propose_branch'] = $this->MGeoMap->getAllProposeLocationWithOpeningDateRange($parameter);
        }else{
            $dateToday = date('Y-m-d'); 
            $dateComputation = date_create($dateToday);
            $endingdate = date_add($dateComputation, date_interval_create_from_date_string('1 month'));
            $parameter = array(
                'beginningdate' => $dateToday,
                'endingdate' => $endingdate->format('Y-m-d')
            );
            $propose_branch['propose_branch'] = $this->MGeoMap->getAllProposeLocationWithOpeningDateRange($parameter);
        }

        if(!empty($propose_branch['propose_branch'])){
            $js_geomap_javascript = $this->load->view('themes/demo/pages/branch_expansion/geomap_javascript', $propose_branch, true);
            $this->layout->add_js_rawtext($js_geomap_javascript, 'footer');
        }

        $this->layout->set_title("Branch Expansion - Geomap");	
        $this->load->view('themes/demo/includes/header');
        $this->load->view('themes/demo/pages/branch_expansion/geomap', $data);
        $this->load->view('themes/demo/includes/footer');
	}

    //TODO: add button for branch approval  
    public function create()
    {
        $data['district'] = $this->MLocationName->getAllLocationNameByLocationTypeNoPagination(GUID_DISTRICT);

        if($this->input->post() && $this->form_validation->run('area/create') === true){
            $data = array(
                'locationtypeid' => GUID_AREA,
				'locationname' => $this->input->post('locationname'),
                'locationnameidparent' => $this->input->post('locationnameidparent')
			);
            $this->MLocationName->create($data);
            $this->session->set_flashdata('session_area_create','Area created successfully:'. $this->input->post('locationname'));
            redirect(base_url('area'));
        }

        $this->layout->set_title('Area - Create');
        $this->load->view('themes/demo/includes/header');
        $this->load->view('themes/demo/pages/area/create', $data);
        $this->load->view('themes/demo/includes/footer');
    }

}
