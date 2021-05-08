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

    }

	public function list(){
		if(!file_exists(APPPATH.'views/themes/demo/pages/locationtype/retrieve.php')){
			echo file_exists(APPPATH.'views/themes/demo/pages/locationtype/retrieve.php');
			//show_404();
		}
        $this->load->model('MLocationType');
        $this->load->library("pagination");

        $config = array();
        $config["total_rows"] = $this->MLocationType->get_count();
        $config["per_page"] = 2;
        $config["uri_segment"] = 2;
        $config['attributes'] = array('class' => 'btn btn-primary');
        //  $config['num_tag_open'] = "<p class='btn btn-secondary'>";
        //  $config['num_tag_close'] = "</p>";
         $config['cur_tag_open'] = "<b class='btn btn-secondary'>";
         $config['cur_tag_close'] = "</b>";
        // $config['prev_tag_open'] = "<div>";
        // $config['prev_tag_close'] = "</div>";
        // $config['full_tag_open'] = '<p class="btn btn-primary">';
        // $config['full_tag_close'] = '</p>';
        // $config['first_tag_open'] = '<div>';
        // $config['first_tag_close'] = '</div>';
        // $config['last_link'] = 'Last';
        // $config['last_tag_open'] = '<div>';
        // $config['last_tag_close'] = '</div>';
        // $config['next_tag_open'] = '<div>';
        // $config['next_tag_close'] = '</div>';
        $config['next_link'] = '&gt;';
        $config['prev_link'] = '&lt;';
        $config['base_url'] = site_url('locationtype');
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $data["links"] = $this->pagination->create_links();
        $data['locationtype'] = $this->MLocationType->getAllLocationType($config["per_page"], $page);

        $this->layout->set_title("Location Type - List");
        $this->layout->set_body_attr(array('id' => 'locationtype', 'class' => 'test'));
		$this->load->view('themes/demo/pages/locationtype/list', $data);
	}


    public function create()
    {
        $this->form_validation->set_rules('locationtype', 'Location Type', 'required|min_length[2]|max_length[70]|alpha_numeric');   

        if($this->input->post() && $this->form_validation->run() === true){
            $data = array(
				'locationtype' => $this->input->post('locationtype')
			);
            $this->MLocationType->create($data);
            redirect(base_url('locationtype'));
        }

        $this->layout->set_title('Location Type - Create');
        $this->layout->set_body_attr(array('id' => 'locationtype', 'class' => 'locationtype'));
        $this->load->view('themes/demo/pages/locationtype/create');
    }

    public function modify($locationTypeId)
    {
        $this->form_validation->set_rules('locationtype', 'Location Type', 'required|min_length[2]|max_length[70]|alpha_numeric');   
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
            redirect(base_url('locationtype'));
        }

        $this->layout->set_title('Location Type - Modify');
        $this->layout->set_body_attr(array('id' => 'locationtype', 'class' => 'locationtype'));
        $this->load->view('themes/demo/pages/locationtype/modify', $data);
    }

    public function remove($id)
    {
        
        $data['locationtype'] = $this->MLocationType->getSpecificLocationType($locationTypeId);

        if($data['locationtype'] === null){
            show_404();
        }
        
        if($this->input->post()){
            $this->MLocationType->remove($locationTypeId);
            redirect(base_url('locationtype'));
        }

        $this->layout->set_title('Location Type - Modify');
        $this->layout->set_body_attr(array('id' => 'locationtype', 'class' => 'locationtype'));
        $this->load->view('themes/demo/pages/locationtype/remove', $data);
    }


}
