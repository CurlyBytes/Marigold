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
		$this->load->view('themes/demo/pages/locationtype/list', $data);
	}


    public function create()
    {
        $this->form_validation->set_rules('locationtype', 'Location Type', 'required|min_length[2]|max_length[70]|alpha_numeric');   
        $this->form_validation->set_error_delimiters('<div class="error">','</div>');
        if($this->input->post() && $this->form_validation->run() === true){
            $data = array(
				'locationtype' => $this->input->post('locationtype')
			);
            $this->MLocationType->create($data);
            $this->session->set_flashdata('session_locationtype','LocationType created successfully:'. $this->input->post('locationtype'));
            redirect(base_url('locationtype'));
        }

        $this->layout->set_title('Location Type - Create');
        $this->layout->set_body_attr(array('id' => 'locationtype', 'class' => 'locationtype'));
        $this->load->view('themes/demo/pages/locationtype/create');
    }

    public function modify($locationTypeId)
    {
        $this->form_validation->set_rules('locationtype', 'Location Type', 'required|min_length[2]|max_length[70]|alpha_numeric');  
        $this->form_validation->set_error_delimiters('<div class="error">','</div>'); 
        $data['locationtype'] = $this->MLocationType->getSpecificLocationType($locationTypeId);

        if($data['locationtype'] === null){
            show_404();
        }
        

        if($this->input->post() && $this->form_validation->run() === true){
            $data = array(
                'locationtypeid' => $this->input->post('locationtypeid'),
				'locationtype' => $this->input->post('locationtype')
			);
            $this->MLocationType->modify($data);
            $this->session->set_flashdata('session_locationtype','LocationType updated successfully:'. $this->input->post('locationtype'));
            redirect(base_url('locationtype'));
        }

        $this->layout->set_title('Location Type - Modify');
        $this->layout->set_body_attr(array('id' => 'locationtype', 'class' => 'locationtype'));
        $this->load->view('themes/demo/pages/locationtype/modify', $data);
    }

    public function remove($locationTypeId)
    {
        
        $this->form_validation->set_rules('locationtype', 'Location Type', 'required|min_length[2]|max_length[70]|alpha_numeric');  
        $this->form_validation->set_error_delimiters('<div class="error">','</div>'); 
        $data['locationtype'] = $this->MLocationType->getSpecificLocationType($locationTypeId);

        if($data['locationtype'] === null){
            show_404();
        }
        

        if($this->input->post() && $this->form_validation->run() === true){
            $data = array(
				'locationtypeid' => $this->input->post('locationtypeid')
			);
            $this->MLocationType->remove($data);
            $this->session->set_flashdata('session_locationtype','LocationType remove successfully:'. $this->input->post('locationtype'));
            redirect(base_url('locationtype'));
        }

        $this->layout->set_title('Location Type - Remove');
        $this->layout->set_body_attr(array('id' => 'locationtype', 'class' => 'locationtype'));
        $this->load->view('themes/demo/pages/locationtype/remove', $data);
    }


}
