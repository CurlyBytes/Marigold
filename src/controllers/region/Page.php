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
        $this->load->helper('security');
        $this->layout->set_title('Region');
        $this->layout->set_body_attr(array('id' => 'region', 'class' => 'region'));
    }

	public function list(){
		if(!file_exists(APPPATH.'views/themes/demo/pages/region/list.php')){
			show_404();
		}
        $this->load->library("pagination");
        $this->config->load('pagination', true);

        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $per_page = $this->config->item('per_page', 'pagination');
        $settings = $this->config->item('pagination',true);
        $settings["total_rows"] = $this->MLocationName->get_count(GUID_REGION);
        $settings['base_url'] = site_url('region');
        
        $this->pagination->initialize($settings);
        $data["links"] = $this->pagination->create_links();
        $data['region'] = $this->MLocationName->getAllLocationNameByLocationType($per_page, $page, GUID_REGION);

        $this->layout->set_title("Region - List");
        $this->layout->set_body_attr(array('id' => 'region', 'class' => 'region'));
        $this->load->view('themes/demo/includes/header');
        $this->load->view('themes/demo/pages/region/list', $data);
        $this->load->view('themes/demo/includes/footer');
        
	}


    public function create()
    {

        if($this->input->post() && $this->form_validation->run('region/create') === true){
            $data = array(
                'locationtypeid' => GUID_REGION,
				'locationname' => $this->input->post('locationname'),
                'locationnameidparent' => false
			);
            $this->MLocationName->create($data);
            $this->session->set_flashdata('session_region_create','Region created successfully:'. $this->input->post('locationname'));
            redirect(base_url('region'));
        }

        $this->layout->set_title('Region - Create');
        $this->layout->set_body_attr(array('id' => 'locationname', 'class' => 'locationname'));
        $this->load->view('themes/demo/includes/header');
        $this->load->view('themes/demo/pages/region/create');
        $this->load->view('themes/demo/includes/footer');
    }

    public function modify($locationNameId)
    {
        $data['region'] = $this->MLocationName->getSpecificLocationNameByLocationType($locationNameId);

        if($data['region'] === null){
            show_404();
        }
        

        if($this->input->post() && $this->form_validation->run('region/modify') === true){
            $data = array(
                'locationnameid' => $this->input->post('locationnameid'),
				'locationname' => $this->input->post('locationname')
			);
            $this->MLocationName->modify($data);
            $this->session->set_flashdata('session_region_modify','Region updated successfully:'. $this->input->post('locationname'));
            redirect(base_url('region'));
        }

        $this->layout->set_title('Region - Modify');
        $this->layout->set_body_attr(array('id' => 'region', 'class' => 'region'));
        $this->load->view('themes/demo/includes/header');
        $this->load->view('themes/demo/pages/region/modify', $data);
        $this->load->view('themes/demo/includes/footer');
    }

    public function remove($locationNameId)
    {
        
        $data['region'] = $this->MLocationName->getSpecificLocationNameByLocationType($locationNameId);

        if($data['region'] === null){
            show_404();
        }
        

        if($this->input->post() && $this->form_validation->run('region/remove') === true){
            $data = array(
				'locationnameid' => $this->input->post('locationnameid')
			);
            $this->MLocationName->remove($data);
            $this->session->set_flashdata('session_region_remove','Region remove successfully:'. $this->input->post('locationname'));
            redirect(base_url('region'));
        }

        $this->layout->set_title('Region - Remove');
        $this->layout->set_body_attr(array('id' => 'region', 'class' => 'region'));
        $this->load->view('themes/demo/includes/header');
        $this->load->view('themes/demo/pages/region/remove', $data);
        $this->load->view('themes/demo/includes/footer');
    }



    public function _region_name_exist()
    {
        $locationNameId = $this->input->post('locationnameid');
        $locationName = $this->input->post('locationname');
        $isExist = $this->MLocationName->hasLocationNameExist($locationNameId , GUID_REGION, $locationName);

        if ($isExist === true)
        {
            $this->form_validation->set_message('_region_name_exist', 'The {field} field can not be the word "test"');
            return true;
        }
 
        return false;
        
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
