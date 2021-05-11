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
        $this->load->model('MLocationType');
        $this->layout->set_title('Location Type');
        $this->layout->set_body_attr(array('id' => 'locationtype', 'class' => 'locationtype'));
    }

	public function list(){
		if(!file_exists(APPPATH.'views/themes/demo/pages/locationtype/list.php')){
			show_404();
		}
        $this->load->library("pagination");
        $this->config->load('pagination', true);

        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $per_page = $this->config->item('per_page', 'pagination');
        $settings = $this->config->item('pagination',true);
        $settings["total_rows"] = $this->MLocationType->get_count();
        $settings['base_url'] = site_url('locationtype');
        
        $this->pagination->initialize($settings);
        $data["links"] = $this->pagination->create_links();
        $data['locationtype'] = $this->MLocationType->getAllLocationType($per_page, $page);
        

        $this->layout->set_title("Location Type - List");
        $this->layout->set_body_attr(array('id' => 'locationtype', 'class' => 'test'));
        $this->load->view('themes/demo/includes/header');
        $this->load->view('themes/demo/pages/locationtype/list', $data);
        $this->load->view('themes/demo/includes/footer');
	}


    public function create()
    {

        if($this->input->post() && $this->form_validation->run('locationtype/create') === true){
            $data = array(
				'locationtype' => $this->input->post('locationtype')
			);
            $this->MLocationType->create($data);
            $this->session->set_flashdata('session_locationtype_create','LocationType created successfully:'. $this->input->post('locationtype'));
            redirect(base_url('locationtype'));
        }

        $this->layout->set_title('Location Type - Create');
        $this->layout->set_body_attr(array('id' => 'locationtype', 'class' => 'locationtype'));
        $this->load->view('themes/demo/includes/header');
        $this->load->view('themes/demo/pages/locationtype/create');
        $this->load->view('themes/demo/includes/footer');
    }

    public function modify($locationTypeId)
    {
        $data['locationtype'] = $this->MLocationType->getSpecificLocationType($locationTypeId);

        if($data['locationtype'] === null){
            show_404();
        }
        

        if($this->input->post() && $this->form_validation->run('locationtype/modify') === true){
            $data = array(
                'locationtypeid' => $this->input->post('locationtypeid'),
				'locationtype' => $this->input->post('locationtype')
			);
            $this->MLocationType->modify($data);
            $this->session->set_flashdata('session_locationtype_modify','LocationType updated successfully:'. $this->input->post('locationtype'));
            redirect(base_url('locationtype'));
        }

        $this->layout->set_title('Location Type - Modify');
        $this->layout->set_body_attr(array('id' => 'locationtype', 'class' => 'locationtype'));
        $this->load->view('themes/demo/includes/header');
        $this->load->view('themes/demo/pages/locationtype/modify', $data);
        $this->load->view('themes/demo/includes/footer');
    }

    public function remove($locationTypeId)
    {
        
        $data['locationtype'] = $this->MLocationType->getSpecificLocationType($locationTypeId);

        if($data['locationtype'] === null){
            show_404();
        }
        

        if($this->input->post() && $this->form_validation->run('locationtype/remove') === true){
            $data = array(
				'locationtypeid' => $this->input->post('locationtypeid')
			);
            $this->MLocationType->remove($data);
            $this->session->set_flashdata('session_locationtype_remove','LocationType remove successfully:'. $this->input->post('locationtype'));
            redirect(base_url('locationtype'));
        }

        $this->layout->set_title('Location Type - Remove');
        $this->layout->set_body_attr(array('id' => 'locationtype', 'class' => 'locationtype'));
        $this->load->view('themes/demo/includes/header');
        $this->load->view('themes/demo/pages/locationtype/remove', $data);
        $this->load->view('themes/demo/includes/footer');
    }


}
