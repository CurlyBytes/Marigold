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
        $this->layout->set_title('Area');
        $this->layout->set_body_attr(array('id' => 'area', 'class' => 'area'));
    }

	public function list(){
		if(!file_exists(APPPATH.'views/themes/demo/pages/area/list.php')){
			show_404();
		}
        $this->load->library("pagination");
        $this->config->load('pagination', true);

        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $per_page = $this->config->item('per_page', 'pagination');
        $settings = $this->config->item('pagination',true);
        $settings["total_rows"] = $this->MLocationName->get_count(GUID_AREA);
        $settings['base_url'] = site_url('area');
        
        $this->pagination->initialize($settings);
        $data["links"] = $this->pagination->create_links();
        $data['area'] = $this->MLocationName->getAllLocationNameByLocationTypeWithParentJoin($per_page, $page, GUID_AREA);
        $this->layout->set_title("Area - List");
        $this->layout->set_body_attr(array('id' => 'area', 'class' => 'area'));	
        $this->load->view('themes/demo/includes/header');
        $this->load->view('themes/demo/pages/area/list', $data);
        $this->load->view('themes/demo/includes/footer');
	}


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
        $this->layout->set_body_attr(array('id' => 'locationname', 'class' => 'locationname'));
        $this->load->view('themes/demo/includes/header');
        $this->load->view('themes/demo/pages/area/create', $data);
        $this->load->view('themes/demo/includes/footer');
    }

    public function modify($locationNameId)
    {
        $data['district'] = $this->MLocationName->getAllLocationNameByLocationTypeNoPagination(GUID_DISTRICT);
        $data['area'] = $this->MLocationName->getSpecificLocationNameByLocationType($locationNameId);
        $data['group'] = $this->MLocationName->getSpecificLocationGroupByLocationNameIdChild($locationNameId);

        
        if($data['area'] === null){
            show_404();
        }
        
        if($this->input->post() && $this->form_validation->run('area/modify') === true){
            $data = array(
                'locationnameid' => $this->input->post('locationnameid'),
                'locationnameidparent' => $this->input->post('locationnameidparent'),
				'locationname' => $this->input->post('locationname'),
                'locationtypeid' => GUID_AREA,
                'locationgroupid' => $this->input->post('locationgroupid')
			);
            $this->MLocationName->modify($data);
            $this->session->set_flashdata('session_area_modify','Area updated successfully:'. $this->input->post('locationname'));
            redirect(base_url('area'));
        }

        $this->layout->set_title('Area - Modify');
        $this->layout->set_body_attr(array('id' => 'area', 'class' => 'area'));
        $this->load->view('themes/demo/includes/header');
        $this->load->view('themes/demo/pages/area/modify', $data);
        $this->load->view('themes/demo/includes/footer');
    }

    public function remove($locationNameId)
    {
        $data['district'] = $this->MLocationName->getAllLocationNameByLocationTypeNoPagination(GUID_DISTRICT);
        $data['area'] = $this->MLocationName->getSpecificLocationNameByLocationType($locationNameId);
        $data['group'] = $this->MLocationName->getSpecificLocationGroupByLocationNameIdChild($locationNameId);

        if($data['area'] === null){
            show_404();
        }
        
        if($this->input->post() && $this->form_validation->run('area/remove') === true){
            $data = array(
				'locationnameid' => $this->input->post('locationnameid'),
                'locationgroupid' => $this->input->post('locationgroupid'),
			);
            $this->MLocationName->remove($data);
            $this->session->set_flashdata('session_area_remove','Area remove successfully:'. $this->input->post('locationname'));
            redirect(base_url('area'));
        }

        $this->layout->set_title('Area - Remove');
        $this->layout->set_body_attr(array('id' => 'area', 'class' => 'area'));
        $this->load->view('themes/demo/includes/header');
        $this->load->view('themes/demo/pages/area/remove', $data);
        $this->load->view('themes/demo/includes/footer');
    }

    public function _area_name_exist()
    {
        $locationNameId = $this->input->post('locationnameid');
        $locationNameIddParent = $this->input->post('locationnameidparent');   
        $locationName = $this->input->post('locationname');
        $isExist = $this->MLocationName->hasLocationNameExistWithParentId($locationNameId, $locationNameIddParent, GUID_AREA, $locationName);

        if ($isExist === true )
        {
            $this->form_validation->set_message('_area_name_exist', 'The {field} already exist.');
            return false;
        }else{
            return true;
        }  
    }

    public function _district_name_exist()
    {
        $locationnameidparent = $this->input->post('locationnameidparent');
        $isExist = $this->MLocationName->hasLocationNameIdParent($locationnameidparent , GUID_DISTRICT);

        if ($isExist === false)
        {
            $this->form_validation->set_message('_district_name_exist', 'The {field} field does not exist.');
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
