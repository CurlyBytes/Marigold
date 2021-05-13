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
        $this->load->model('MLocationName');
        $this->layout->set_title('Branch');
        $this->layout->set_body_attr(array('id' => 'branch', 'class' => 'branch'));
    }

	public function list(){
		if(!file_exists(APPPATH.'views/themes/demo/pages/branch/list.php')){
			show_404();
		}
        $this->load->library("pagination");
        $this->config->load('pagination', true);

        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $per_page = $this->config->item('per_page', 'pagination');
        $settings = $this->config->item('pagination',true);
        $settings["total_rows"] = $this->MLocationName->get_count(GUID_BRANCH);
        $settings['base_url'] = site_url('branch');
        
        $this->pagination->initialize($settings);
        $data["links"] = $this->pagination->create_links();
        $data['branch'] = $this->MLocationName->getAllLocationNameByLocationTypeWithParentJoin($per_page, $page, GUID_BRANCH);
        $this->layout->set_title("Branch - List");
        $this->layout->set_body_attr(array('id' => 'branch', 'class' => 'branch'));	
        $this->load->view('themes/demo/includes/header');
        $this->load->view('themes/demo/pages/branch/list', $data);
        $this->load->view('themes/demo/includes/footer');
	}


    public function create()
    {
        $data['branch'] = $this->MLocationName->getAllLocationNameByLocationTypeNoPagination(GUID_AREA);

        if($this->input->post() && $this->form_validation->run('branch/create') === true){
            $data = array(
                'locationtypeid' => GUID_BRANCH,
				'locationname' => $this->input->post('locationname'),
                'locationnameidparent' => $this->input->post('locationnameidparent')
			);
            $this->MLocationName->create($data);
            $this->session->set_flashdata('session_branch_create','Branch created successfully:'. $this->input->post('locationname'));
            redirect(base_url('branch'));
        }

        $this->layout->set_title('Branch - Create');
        $this->layout->set_body_attr(array('id' => 'locationname', 'class' => 'locationname'));
        $this->load->view('themes/demo/includes/header');
        $this->load->view('themes/demo/pages/branch/create', $data);
        $this->load->view('themes/demo/includes/footer');
    }

    public function modify($locationNameId)
    {
        $data['branch'] = $this->MLocationName->getAllLocationNameByLocationTypeNoPagination(GUID_AREA);
        $data['branch'] = $this->MLocationName->getSpecificLocationNameByLocationType($locationNameId);
        $data['group'] = $this->MLocationName->getSpecificLocationGroupByLocationNameIdChild($locationNameId);

        if($data['branch'] === null){
            show_404();
        }
        
        if($this->input->post() && $this->form_validation->run('branch/modify') === true){
            $data = array(
                'locationnameid' => $this->input->post('locationnameid'),
                'locationnameidparent' => $this->input->post('locationnameidparent'),
				'locationname' => $this->input->post('locationname'),
                'locationgroupid' => $this->input->post('locationgroupid')
			);
            $this->MLocationName->modify($data);
            $this->session->set_flashdata('session_branch_modify','Branch updated successfully:'. $this->input->post('locationname'));
            redirect(base_url('branch'));
        }
       // die(var_dump($data));
        $this->layout->set_title('Branch - Modify');
        $this->layout->set_body_attr(array('id' => 'branch', 'class' => 'branch'));
        $this->load->view('themes/demo/includes/header');
        $this->load->view('themes/demo/pages/branch/modify', $data);
        $this->load->view('themes/demo/includes/footer');
    }

    public function remove($locationNameId)
    {
        $data['branch'] = $this->MLocationName->getAllLocationNameByLocationTypeNoPagination(GUID_AREA);
        $data['branch'] = $this->MLocationName->getSpecificLocationNameByLocationType($locationNameId);

        if($data['branch'] === null){
            show_404();
        }
        

        if($this->input->post() && $this->form_validation->run('branch/remove') === true){
            $data = array(
				'locationnameid' => $this->input->post('locationnameid')
			);
            $this->MLocationName->remove($data);
            $this->session->set_flashdata('session_branch_remove','Branch remove successfully:'. $this->input->post('locationname'));
            redirect(base_url('branch'));
        }

        $this->layout->set_title('Branch - Remove');
        $this->layout->set_body_attr(array('id' => 'branch', 'class' => 'branch'));
        $this->load->view('themes/demo/includes/header');
        $this->load->view('themes/demo/pages/branch/remove', $data);
        $this->load->view('themes/demo/includes/footer');
    }

    public function _branch_name_exist()
    {
        $locationNameId = $this->input->post('locationnameid');
        $locationName = $this->input->post('locationname');
        $locationNameIdParent = $this->input->post('locationnameidparent');
        $isExist = $this->MLocationName->hasLocationNameExist($locationNameId, GUID_BRANCH, $locationName);

        if ($isExist === true)
        {
            $this->form_validation->set_message('_branch_name_exist', 'The {field} already exist.');
            return false;
        }else{
            return true;
        }  
    }

    public function _area_name_exist()
    {
        $locationnameidparent = $this->input->post('locationnameidparent');
        $isExist = $this->MLocationName->hasLocationNameIdParent($locationnameidparent , GUID_AREA);

        if ($isExist === false)
        {
            $this->form_validation->set_message('_region_name_exist', 'The {field} field does not exist.');
            return false;
        }else{
            return true;
        }
    }

    public function _group_location_id_exist()
    {
        $locationnameidparent = $this->input->post('locationgroupid');
        $isExist = $this->MLocationName->hasLocationGroupIdExist($locationnameidparent);

        if ($isExist === false)
        {
            $this->form_validation->set_message('_group_location_id_exist', 'The {field} field does not exist.');
            return false;
        }else{
            return true;
        }
    }

    public function _has_location_name_has_child()
    {
        $locationnameidparent = $this->input->post('locationnameid');
        $isExist = $this->MLocationName->hasLocationGroupHasChild($locationnameidparent);

        if ($isExist === true)
        {
            $this->form_validation->set_message('_has_location_name_has_child', 'The {field} cannot delete, has an information within.');
            return false;
        }else{
            return true;
        }
    }

}
