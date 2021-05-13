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
        $this->layout->set_title('District');
        $this->layout->set_body_attr(array('id' => 'district', 'class' => 'district'));
    }

	public function list(){
		if(!file_exists(APPPATH.'views/themes/demo/pages/district/list.php')){
			show_404();
		}
        $this->load->library("pagination");
        $this->config->load('pagination', true);

        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $per_page = $this->config->item('per_page', 'pagination');
        $settings = $this->config->item('pagination',true);
        $settings["total_rows"] = $this->MLocationName->get_count(GUID_DISTRICT);
        $settings['base_url'] = site_url('district');
        
        $this->pagination->initialize($settings);
        $data["links"] = $this->pagination->create_links();
        $data['district'] = $this->MLocationName->getAllLocationNameByLocationTypeWithParentJoin($per_page, $page, GUID_DISTRICT);
        $this->layout->set_title("District - List");
        $this->layout->set_body_attr(array('id' => 'district', 'class' => 'district'));	
        $this->load->view('themes/demo/includes/header');
        $this->load->view('themes/demo/pages/district/list', $data);
        $this->load->view('themes/demo/includes/footer');
	}


    public function create()
    {
        $data['region'] = $this->MLocationName->getAllLocationNameByLocationTypeNoPagination(GUID_REGION);

        if($this->input->post() && $this->form_validation->run('district/create') === true){
            $data = array(
                'locationtypeid' => GUID_DISTRICT,
				'locationname' => $this->input->post('locationname'),
                'locationnameidparent' => $this->input->post('locationnameidparent')
			);
            $this->MLocationName->create($data);
            $this->session->set_flashdata('session_district_create','District created successfully:'. $this->input->post('locationname'));
            redirect(base_url('district'));
        }

        $this->layout->set_title('District - Create');
        $this->layout->set_body_attr(array('id' => 'locationname', 'class' => 'locationname'));
        $this->load->view('themes/demo/includes/header');
        $this->load->view('themes/demo/pages/district/create', $data);
        $this->load->view('themes/demo/includes/footer');
    }

    public function modify($locationNameId)
    {
        $data['region'] = $this->MLocationName->getAllLocationNameByLocationTypeNoPagination(GUID_REGION);
        $data['district'] = $this->MLocationName->getSpecificLocationNameByLocationType($locationNameId);
        $data['group'] = $this->MLocationName->getSpecificLocationGroupByLocationNameIdChild($locationNameId);

        if($data['district'] === null){
            show_404();
        }
        
        if($this->input->post() && $this->form_validation->run('district/modify') === true){
            $data = array(
                'locationnameid' => $this->input->post('locationnameid'),
                'locationnameidparent' => $this->input->post('locationnameidparent'),
				'locationname' => $this->input->post('locationname')
			);
            $this->MLocationName->modify($data);
            $this->session->set_flashdata('session_district_modify','District updated successfully:'. $this->input->post('locationname'));
            redirect(base_url('district'));
        }
       // die(var_dump($data));
        $this->layout->set_title('District - Modify');
        $this->layout->set_body_attr(array('id' => 'district', 'class' => 'district'));
        $this->load->view('themes/demo/includes/header');
        $this->load->view('themes/demo/pages/district/modify', $data);
        $this->load->view('themes/demo/includes/footer');
    }

    public function remove($locationNameId)
    {
        $data['region'] = $this->MLocationName->getAllLocationNameByLocationTypeNoPagination(GUID_REGION);
        $data['district'] = $this->MLocationName->getSpecificLocationNameByLocationType($locationNameId);
        $data['group'] = $this->MLocationName->getSpecificLocationGroupByLocationNameIdChild($locationNameId);

        if($data['district'] === null){
            show_404();
        }
        

        if($this->input->post() && $this->form_validation->run('district/remove') === true){
            $data = array(
				'locationnameid' => $this->input->post('locationnameid')
			);
            $this->MLocationName->remove($data);
            $this->session->set_flashdata('session_district_remove','District remove successfully:'. $this->input->post('locationname'));
            redirect(base_url('district'));
        }

        $this->layout->set_title('District - Remove');
        $this->layout->set_body_attr(array('id' => 'district', 'class' => 'district'));
        $this->load->view('themes/demo/includes/header');
        $this->load->view('themes/demo/pages/district/remove', $data);
        $this->load->view('themes/demo/includes/footer');
    }

    public function _district_name_exist()
    {
        $locationNameId = $this->input->post('locationnameid');
        $locationName = $this->input->post('locationname');
        $locationNameIdParent = $this->input->post('locationnameidparent');
        $isExist = $this->MLocationName->hasLocationNameExistWithParentId($locationNameId, $locationNameIdParent, GUID_DISTRICT, $locationName);


        if ($isExist === true )
        {
            $this->form_validation->set_message('_district_name_exist', 'The {field} already exist.');
            return false;
        }else{
            return true;
        }  
    }

    public function _region_name_exist()
    {
        $locationnameidparent = $this->input->post('locationnameidparent');
        $isExist = $this->MLocationName->hasLocationNameIdParent($locationnameidparent , GUID_REGION);

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
