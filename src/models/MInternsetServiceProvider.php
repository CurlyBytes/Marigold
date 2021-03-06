<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MInternsetServiceProvider extends MariGold_Model {



    public function __construct(){
         parent::__construct(); 
         
    }


    //Insert single data
	public function create($data){  
        $now = date('Y-m-d H:i:s');  
        $internetServiceProviderId =  $this->Guid();


        $internetServiceProviderRecord = array(
            'InternetServiceProviderId' => $internetServiceProviderId,
            'BranchInformationId' => $data['branchinformationid'],
            'InternetServiceProviderName' => strtoupper($data['internetserviceprovidername']),
            'InternetServiceProviderPackageName' => strtoupper($data['internetserviceproviderpackagename']),
            'InternetServiceTechnologyType' => strtoupper($data['internetservicetechnologytype']),
            'Speed' => $data['speed'],
            'CreatedAt' => $now,
            'UpdatedAt' => $now
        );

        return $this->db->insert('InternetServiceProvider', $internetServiceProviderRecord);
    }

    public function modify($data){
        $now = date('Y-m-d H:i:s');  

        $internetServiceProviderRecord = array(
            'InternetServiceProviderName' => strtoupper($data['internetserviceprovidername']),
            'InternetServiceProviderPackageName' => strtoupper($data['internetserviceproviderpackagename']),
            'InternetServiceTechnologyType' => strtoupper($data['internetservicetechnologytype']),
            'Speed' => $data['speed'],
            'UpdatedAt' => $now
        );

        $this->db->where('InternetServiceProviderId', $data['internetserviceproviderid']);
        return $this->db->update('InternetServiceProvider', $internetServiceProviderRecord);
    } 

    public function remove($data){
        $this->db->where('InternetServiceProviderId ', $data['internetserviceproviderid']);
        $this->db->delete('InternetServiceProvider');
        return true;       
    }
    public function getAllInternetServiceProviderById($internetServiceProviderId){
        
        $query = $this->db->get_where('InternetServiceProvider', array('InternetServiceProviderId' => $internetServiceProviderId));
        return $query->row();
    }
	
    public function getAllInternetServiceProviderByBranchIinformationdId($branchInformationId){
        
        $query = $this->db->get_where('InternetServiceProvider', array('BranchInformationId' => $branchInformationId));
        return $query->result();
    }

    public function IsIspNameExists($data){
        $query = array();
        if($data['internetserviceproviderid']){
            $query = $this->db->get_where('InternetServiceProvider', 
                array(
                    'BranchInformationId' => $data['branchinformationid'] ,
                    'InternetServiceProviderId !=' => $data['internetserviceproviderid'] ,
                    'InternetServiceProviderName' => $data['internetserviceprovidername']  
                )
            );

        }else {
            $query = $this->db->get_where('InternetServiceProvider', 
                array(
                    'BranchInformationId' => $data['branchinformationid'] ,
                    'InternetServiceProviderName' => $data['internetserviceprovidername']  
                )
            );


        }
     

        


        if(empty($query->row_array())){
            return false;
        } else {
            return true;
        }
    }

    public function HasReachMaximumIspCount($data){
        $query = $this->db->get_where('InternetServiceProvider', 
            array(
                'BranchInformationId' => $data['branchinformationid']
            )
        );

    
        if(count($query->result()) >= 6 ){
            return true;
        } else {         
            return false;
        }
    }


    public function HasReachMinimum($data){
        $query = $this->db->get_where('InternetServiceProvider', 
            array(
                'BranchInformationId' => $data['branchinformationid']
            )
        );
        $test =count($query->result());
    
        if(count($query->result()) <= 3 ){
            return true;
        } else {         
            return false;
        }
    }
}