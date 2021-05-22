<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Page extends MariGold_Controller {

    protected $final_files_data = array();
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
        $this->load->helper('file');
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

        $data = array();
        $photoNames = array();  
        $errorUploadType = $statusMsg = ''; 
       
        $data['branch'] = $this->MBranchInformation->branchWithoutLocation();

        if($this->input->post() && $this->form_validation->run('propose-branch/create') === true){

         
        // If files are selected to upload 

            $filesCount = count($_FILES['files']['name']); 
            for($i = 0; $i < $filesCount; $i++){ 
                $config['file_name'] = $this->MBranchInformation->Guid();
                $this->load->library('upload', $config);
                $_FILES['file']['name']     = $_FILES['files']['name'][$i]; 
                $_FILES['file']['type']     = $_FILES['files']['type'][$i]; 
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i]; 
                $_FILES['file']['error']     = $_FILES['files']['error'][$i]; 
                $_FILES['file']['size']     = $_FILES['files']['size'][$i]; 

                // Upload file to server 
                if($this->upload->do_upload('file')){ 
                    // Uploaded file data 
                    $fileData = $this->upload->data(); 
                    array_push($photoNames, $fileData['file_name']); 
                  
                }else{  
                    $errorUploadType .= $_FILES['file']['name'].' | ';  
                } 
           
            } 

            $data = array(
				'branchid' => $this->input->post('branchid'),
                'openingdate' => $this->input->post('openingdate'),
                'latitude' => $this->input->post('latitude'),
                'longtitude' => $this->input->post('longtitude'),
                'photoname' =>  $photoNames  
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

    public function remove($branchInformationId)
    {
        $data['branch'] = $this->MBranchInformation->branchWithoutLocation();
        $data['propose_branch'] = $this->MBranchInformation->getSpecificLocationProposeBranch($branchInformationId);

        
        if($data['propose_branch'] === null){
            show_404();
        }
        
        if($this->input->post() && $this->form_validation->run('propose-branch/remove') === true){
            $data = array(
                'branchinformationid' => $this->input->post('branchinformationid')
			);
            $this->MBranchInformation->remove($data);
            $this->session->set_flashdata('session_propose_branch_remove','Propose Branch remove successfully:'. $this->input->post('branchinformationid'));
            redirect(base_url('propose-branch'));
        }

        $this->layout->set_title('Propose Branch - Remove');
        $this->load->view('themes/demo/includes/header');
        $this->load->view('themes/demo/pages/propose_branch/remove', $data);
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

       /*
     * file value and type check during validation
     */
    public function _file_check($str){
        $allowed_mime_type_arr = array('image/jpeg','image/jpg','image/png','image/x-png');
        $filesCount = count($_FILES['files']['name']); 
        $fileNameInvalid = array();
        $filenamestr= '';
        $invalidFileTypeCount = 0;
        for($i = 0; $i < $filesCount; $i++){ 
            $_FILES['file']['name']     = $_FILES['files']['name'][$i]; 
            $_FILES['file']['type']     = $_FILES['files']['type'][$i]; 
            $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i]; 
            $_FILES['file']['error']     = $_FILES['files']['error'][$i]; 
            $_FILES['file']['size']     = $_FILES['files']['size'][$i]; 
             
            $mime = get_mime_by_extension($_FILES['file']['name']);

            if(!in_array($mime, $allowed_mime_type_arr)){
                $invalidFileTypeCount++;
                array_push($fileNameInvalid , $_FILES['file']['name']);
            }
        } 

        if(empty($_FILES['file']['name'])){
            $this->form_validation->set_message('_file_check', 'Please choose a file to upload.');
            return false;
        }

        if($invalidFileTypeCount > 0){
            foreach($fileNameInvalid as $filename){
                $filenamestr .= $filename . "; ";
            }
            $this->form_validation->set_message('_file_check', 'Please select only jpeg/jpg/png file. There are ' .$invalidFileTypeCount .' invalid file type: ' . $filenamestr);
            return false;
        }

        if($filesCount < 3){
            $this->form_validation->set_message('_file_check', 'Minimum with atleast 3 images');
            return false;
        }

        if($filesCount > 6){
            $this->form_validation->set_message('_file_check', 'Maximum number of images should only be at 6');
            return false;
        }
        return true;
    }

  
    private function upload_files($title, $files)
    {
  

        $images = array();

        foreach ($files['name'] as $key => $image) {
            $_FILES['userfile']['name']= $files['name'][$key];
            $_FILES['userfile']['type']= $files['type'][$key];
            $_FILES['userfile']['tmp_name']= $files['tmp_name'][$key];
            $_FILES['userfile']['error']= $files['error'][$key];
            $_FILES['userfile']['size']= $files['size'][$key];
            $config['file_name'] = $title .'_'. $image;
           $this->upload->initialize($config);
            $test = $this->upload->do_upload('userfile');

            if ($test) {
                $uploadData = $this->upload->data();
                $uploadedFile = $uploadData['file_name'];
                array_push($this->final_files_data, $uploadedFile);
            } else {
                return false;
            }
        }

        return $images;
    }

  
}
