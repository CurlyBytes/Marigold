<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MBranchInformation extends MariGold_Model {

    private const $MinimumBranchProposal = 3;
    private const $MaximumBranchProposal = 6;
    private const $BranchProposalForApproval = 0;
    private const $BranchWasApproved = 1;

    public function __construct(){
         parent::__construct(); 
    }

	//Insert single data
	public function propose($data){    
        $branchInformation =  $this->Guid();

        $branchInformationRecord = array(
            'BranchInformationId ' => $locationNameId,
            'RegionId ' => $data['regionid'],
            'Districtid  ' => $data['districtid'],
            'AreaId  ' => $data['areaid'],
            'BranchId  ' => $data['branchid'],
            'Latitude ' => $data['latitude'],
            'Longtitude ' => $data['longtitude'],
            'IsApprove ' => $this->BranchProposalForApproval,
            'OpeningDate ' => $data['locationtypeid']
            'CreatedAt' => getdate(),
            'UpdatedAt' => getdate()
        );


        return $this->db->insert('BranchInformation', $branchInformationRecord);
    }
	

	//Insert single data
	public function approve($data){    
        $branchInformation =  $this->Guid();



        $branchInformationRecord = array(
            'IsApprove ' => $this->BranchWasApproved,
            'UpdatedAt' => getdate()
        );

        $this->db->where('BranchInformationId ', $data['locationnameid']);
        $result = $this->db->update('BranchInformation', $branchInformationRecord);

        $query = ' IsApprove = '. $this->$BranchProposalForApproval.' AND BranchId = '. $data['branchid'] ;
        $this->db->where($query);
        $this->db->delete('BranchInformation');

        return $result;     
    }
	
	

    public function remove($data){
        
        $this->db->where('BranchInformationId ', $data['branchinformationid ']);
        $this->db->delete('BranchInformation');

        return true;       
    }
	
    public function getProposedBranchLocationList($data){
        $query = $this->db->get_where('BranchInformation', array('IsApprove' => $this->BranchProposalForApproval));
        return $query->row();
    }


    public function getApproveBranchLocationList($data){
        $query = $this->db->get_where('BranchInformation', array('IsApprove' => $this->BranchWasApproved));
        return $query->row();
    }



    public function hasBranchProposalExist($data){
        $query = $this->db->get_where('BranchInformation', 
            array(
                'BranchId' => $data['branchid'] ,
                'IsApprove' => $this->BranchWasApproved
            )
        );

        if(empty($query->row_array())){
            return true;
        } else {
            return false;
        }
    }

    public function hasMinimumBranchProposal($data){
        $query = $this->db->get_where('BranchInformation', 
            array(
                'BranchId' => $data['branchid'] ,
                'IsApprove' => $this->BranchProposalForApproval
            )
        );

    
        if(empty($query->row_array()) || count($query->row_array()) >= $this->MinimumBranchProposal ){
            return true;
        } else {
            
            return false;
        }
    }

    public function hasMaximumBranchProposal($data){
        $query = $this->db->get_where('BranchInformation', 
            array(
                'BranchId' => $data['branchid'] ,
                'IsApprove' => $this->BranchProposalForApproval
            )
        );

    
        if(count($query->row_array()) <= $this->MaximumBranchProposal ){
            return true;
        } else {         
            return false;
        }
    }
}