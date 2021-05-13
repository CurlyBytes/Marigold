<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MBranchInformation extends MariGold_Model {

    private int $MinimumBranchProposal = 3;
    private int $MaximumBranchProposal = 6;
    private int $BranchProposalForApproval = 0;
    private int $BranchWasApproved = 1;

    public function __construct(){
         parent::__construct(); 
         
    }

    	//Insert single data
	public function branchWithoutLocation(){    
 
        $this->db->select('LocationName, LocationNameId');
        $this->db->from('LocationName AS LocationName');
        $this->db->join('BranchInformation AS BranchInformation', 'BranchInformation.BranchId = LocationName.LocationNameId','LEFT');
        $this->db->where('LocationName.LocationTypeId', GUID_BRANCH);
        $this->db->where('BranchInformation.IsApprove', null);
        $this->db->or_where('BranchInformation.IsApprove', $this->BranchProposalForApproval);

        return $this->db->get()->result();
    }
	

	//Insert single data
	public function propose($data = null){    
        $now = date('Y-m-d H:i:s');
        $branchInformation =  $this->Guid();
        $data['branchid'] =  "DF1F33B2-3AB4-1F88-0ADF-335BBAFABE6A";
        $query = $this->db->query("SELECT BranchRecord.LocationName AS BranchRecord, BranchRecord.LocationNameId AS BranchId, Branch.LocationNameIdParent AS AreaId, Area.LocationNameIdParent AS DistrictId, District.LocationNameIdParent AS RegionId FROM LocationName AS BranchRecord LEFT JOIN LocationGroup AS Branch ON Branch.LocationNameIdChild = BranchRecord.LocationNameId LEFT JOIN LocationGroup AS Area ON Area.LocationNameIdChild = Branch.LocationNameIdParent LEFT JOIN LocationGroup AS District ON District.LocationNameIdChild = Area.LocationNameIdParent LEFT JOIN LocationGroup AS Region ON District.LocationNameIdChild = District.LocationNameIdParent WHERE BranchRecord.LocationNameId = ?" , array($data['branchid']) );

        $row = $query->row_array();
        if (isset($row))
        {
            $data['areaid'] = $row['AreaId'];
            $data['districtid'] = $row['DistrictId'];
            $data['regionid'] = $row['RegionId'];
        }
        $branchInformationRecord = array(
            'BranchInformationId ' => $branchInformation,
            'RegionId ' => $data['regionid'],
            'Districtid  ' => $data['districtid'],
            'AreaId  ' => $data['areaid'],
            'BranchId  ' => $data['branchid'],
            'Latitude ' => $data['latitude'],
            'Longtitude ' => $data['longtitude'],
            'IsApprove ' => $this->BranchProposalForApproval,
            'OpeningDate ' => $data['openingdate'],
            'CreatedAt' => $now,
            'UpdatedAt' => $now
        );


       return $this->db->insert('BranchInformation', $branchInformationRecord);
    }
	

	//Insert single data
	public function approve($data){    
        $now = date('Y-m-d H:i:s');
        $branchInformation =  $this->Guid();



        $branchInformationRecord = array(
            'IsApprove ' => $this->BranchWasApproved,
            'UpdatedAt' => $now
        );

        $this->db->where('BranchInformationId ', $data['locationnameid']);
        $result = $this->db->update('BranchInformation', $branchInformationRecord);

        $query = ' IsApprove = '. $this->$BranchProposalForApproval.' AND BranchId = '. $data['branchid'] ;
        $this->db->where($query);
        $this->db->delete('BranchInformation');

        return $result;     
    }
	
	
    public function modify($data){
        $now = date('Y-m-d H:i:s');
        $branchInformationRecord = array(
            'RegionId ' => $data['regionid'],
            'Districtid  ' => $data['districtid'],
            'AreaId  ' => $data['areaid'],
            'BranchId  ' => $data['branchid'],
            'Latitude ' => $data['latitude'],
            'Longtitude ' => $data['longtitude'],
            'OpeningDate ' => $data['locationtypeid'],
            'UpdatedAt' => $now
        );


        $this->db->where('BranchInformationId', $data['locationnameid']);
        return $this->db->update('BranchInformation', $branchInformationRecord);
    }

    public function remove($data){
        
        $this->db->where('BranchInformationId ', $data['branchinformationid ']);
        $this->db->delete('BranchInformation');

        return true;       
    }
	
    public function getProposedBranchLocationList($data){
        $query = $this->db->get_where('BranchInformation', array('IsApprove' => $this->BranchProposalForApproval));
        return $query->result();
    }


    public function getApproveBranchLocationList($data){
        $query = $this->db->get_where('BranchInformation', array('IsApprove' => $this->BranchWasApproved));
        return $query->result();
    }

    public function IsBranchIdExist($locationNameId, $locationTypeId){
        $query = $this->db->get_where('LocationName', 
            array(
                'LocationNameId' => $locationNameId ,
                'LocationTypeId' => $locationTypeId 
            )
        );

        if(empty($query->row_array())){
            return false;
        } else {
            return true;
        }
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

    public function get_count(){    
 
        $locationNameFilter = array(
            'LocationName.LocationTypeId' => GUID_BRANCH,
            'BranchInformation.IsApprove' => null
        );

        $this->db->select('LocationName, LocationNameId');
        $this->db->from('LocationName AS LocationName');
        $this->db->join('BranchInformation AS BranchInformation', 'BranchInformation.BranchId = LocationName.LocationNameId','LEFT');
        $this->db->where('LocationName.LocationTypeId', GUID_BRANCH);
        $this->db->where('BranchInformation.IsApprove', null);
        $this->db->or_where('BranchInformation.IsApprove', 1);

        return count($this->db->get()->row_array());
    }
}