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
        $this->load->model('MBranchInformation');
        $this->layout->set_body_attr(array('id' => 'propose-branch', 'class' => 'propose-branch'));
    }

	public function list(){
		if(!file_exists(APPPATH.'views/themes/demo/pages/propose_branch/list.php')){
			show_404();
		}
        $this->load->library("pagination");
        $this->config->load('pagination', true);

        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $per_page = $this->config->item('per_page', 'pagination');
        $settings = $this->config->item('pagination',true);
        $settings["total_rows"] = $this->MBranchInformation->get_count();
        $settings['base_url'] = site_url('propose-branch');
        
        $this->pagination->initialize($settings);
        $data["links"] = $this->pagination->create_links();
        $data['propose_branch'] = $this->MBranchInformation->getAllProposeBranch($per_page, $page );
       // die(var_dump($data['propose_branch'] ));
        $this->layout->set_title("Propose Branch - List");
        $this->load->view('themes/demo/includes/header');
        $this->load->view('themes/demo/pages/propose_branch/list', $data);
        $this->load->view('themes/demo/includes/footer');
	}


    public function create()
    {
        $data['branch'] = $this->MBranchInformation->branchWithoutLocation();

        if($this->input->post() && $this->form_validation->run('propose-branch/create') === true){
            $data = array(
				'branchid' => $this->input->post('branchid'),
                'openingdate' => $this->input->post('openingdate'),
                'latitude' => $this->input->post('latitude'),
                'longtitude' => $this->input->post('longtitude')
			);
            $this->MBranchInformation->propose($data);
            $this->session->set_flashdata('session_propose_branch_create','Propose new branch successfully: '. $this->input->post('branchid'));
            redirect(base_url('propose-branch'));
        }

        $this->layout->set_title('Propose Branch - Create');
        $this->load->view('themes/demo/includes/header');
        $this->load->view('themes/demo/pages/propose_branch/create', $data);
        $this->load->view('themes/demo/includes/footer');
    }

    public function modify($branchInformationId)
    {
        $data['branch'] = $this->MBranchInformation->branchWithoutLocation();
        $data['propose_branch'] = $this->MBranchInformation->getSpecificLocationProposeBranch($branchInformationId);

        
        if($data['propose_branch'] === null){
            show_404();
        }
        
        if($this->input->post() && $this->form_validation->run('propose-branch/modify') === true){
            $data = array(
                'branchinformationid' => $this->input->post('branchinformationid'),
				'branchid' => $this->input->post('branchid'),
                'openingdate' => $this->input->post('openingdate'),
                'latitude' => $this->input->post('latitude'),
                'longtitude' => $this->input->post('longtitude')
			);
            $this->MBranchInformation->modify($data);
            $this->session->set_flashdata('session_propose_branch_modify','Area updated successfully:'. $this->input->post('branchid'));
            redirect(base_url('propose-branch'));
        }

        $this->layout->set_title('Propose Branch - Modify');
        $this->load->view('themes/demo/includes/header');
        $this->load->view('themes/demo/pages/propose_branch/modify', $data);
        $this->load->view('themes/demo/includes/footer');
    }

    public function remove($locationNameId)
    {
        $data['district'] = $this->MBranchInformation->getAllLocationNameByLocationTypeNoPagination(GUID_DISTRICT);
        $data['area'] = $this->MBranchInformation->getSpecificLocationNameByLocationType($locationNameId);
        $data['group'] = $this->MBranchInformation->getSpecificLocationGroupByLocationNameIdChild($locationNameId);

        if($data['area'] === null){
            show_404();
        }
        
        if($this->input->post() && $this->form_validation->run('propose-branch/remove') === true){
            $data = array(
				'locationnameid' => $this->input->post('locationnameid'),
                'locationgroupid' => $this->input->post('locationgroupid'),
			);
            $this->MBranchInformation->remove($data);
            $this->session->set_flashdata('session_propose_branch_remove','Area remove successfully:'. $this->input->post('locationname'));
            redirect(base_url('area'));
        }

        $this->layout->set_title('Area - Remove');
        $this->load->view('themes/demo/includes/header');
        $this->load->view('themes/demo/pages/area/remove', $data);
        $this->load->view('themes/demo/includes/footer');
    }

    public function _branch_name_exist()
    {
        $branchid = $this->input->post('branchid');
        $isExist = $this->MBranchInformation->IsBranchIdExist($branchid , GUID_BRANCH);

        if ($isExist === false)
        {
            $this->form_validation->set_message('_branch_name_exist', 'The {field} record does not exist.');
            return false;
        }else{
            return true;
        }
    }

    public function _valid_latitude($latitude)
    {
        if(!preg_match('/\A[+-]?(?:90(?:\.0{1,18})?|\d(?(?<=9)|\d?)\.\d{1,18})\z/x', $latitude))  
        {
            $this->form_validation->set_message('_valid_latitude', 'Invalid {field} format.');
            return false;
        }else{
            return true;
        }
    }

    public function _valid_longtitude($longtitude)
    {
        if(!preg_match('/\A[+-]?(?:180(?:\.0{1,18})?|(?:1[0-7]\d|\d{1,2})\.\d{1,18})\z/x', $longtitude))  
        {
            $this->form_validation->set_message('_valid_longtitude', 'Invalid {field} format.');
            return false;
        }else{
            return true;
        }
    }

    public function _valid_date($date, $format){
        $d = DateTime::createFromFormat($format, $date);
        if($d && $d->format($format) == $date) {
            return true;
        } else {
            $this->form_validation->set_message('_valid_date', 'The {field} field must have a Date format.');
            return false;
        }
    }
}
