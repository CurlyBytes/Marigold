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

        $this->db->select("LocationName, LocationNameId");
        $this->db->from('LocationName AS LocationName');
        $this->db->where('LocationName.LocationTypeId', GUID_BRANCH);
        $this->db->join('BranchInformation AS BranchInformation', 'BranchInformation.BranchId = LocationName.LocationNameId','left');
        $this->db->group_by('LocationNameId');

        return $this->db->get()->result();     
    }
	

	//Insert single data
	public function propose($data){    
        $now = date('Y-m-d H:i:s');
        $branchInformation =  $this->Guid();
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

        foreach($data['photoname'] as $photoname ){

            $branchInfomrationPhoto = array(
                'BranchInformationPhotoId ' =>  $this->Guid(),
                'BranchInformationId ' =>  $branchInformation,
                'PhotoName ' => $photoname,
                'CreatedAt' => $now,
                'UpdatedAt' => $now
            );

            $this->db->insert('BranchInformationPhoto', $branchInfomrationPhoto);
        }

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
            'BranchId  ' => $data['branchid'],
            'Latitude ' => $data['latitude'],
            'Longtitude ' => $data['longtitude'],
            'OpeningDate ' => $data['openingdate'],
            'UpdatedAt' => $now
        );


        $this->db->where('BranchInformationId', $data['branchinformationid']);
        return $this->db->update('BranchInformation', $branchInformationRecord);
    } 

    public function remove($data){
        
        $this->db->where('BranchInformationId ', $data['branchinformationid']);
        $this->db->delete('BranchInformation');

        return true;       
    }
	
    public function getSpecificLocationProposeBranch($branchInformationId){

        $query = $this->db
            ->get_where('BranchInformation', 
                array('BranchInformationid' => $branchInformationId)
            )
            ->row();
        
        return $query;
    }

    public function getAllProposeBranch($limit, $start){
        $this->db->select('BranchInformation.BranchInformationId, Latitude,  Longtitude, Branch.LocationName As BranchName, Area.LocationName As AreaName, District.LocationName As DistrictName, Region.LocationName As RegionName, BranchInformation.CreatedAt As CreatedAt, BranchInformation.UpdatedAt As UpdatedAt');
        $this->db->from('BranchInformation');
        $this->db->join('LocationName AS Region', 'Region.LocationNameId=BranchInformation.RegionId');
        $this->db->join('LocationName AS District', 'District.LocationNameId=BranchInformation.DistrictId');
        $this->db->join('LocationName AS Area', 'Area.LocationNameId=BranchInformation.AreaId');
        $this->db->join('LocationName AS Branch', 'Branch.LocationNameId=BranchInformation.BranchId');
        $this->db->where('BranchInformation.IsApprove', $this->BranchProposalForApproval);
        $this->db->limit($limit, $start);
        return $this->db->get()->result();
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
 
        return $this->db
            ->from('BranchInformation')
            ->where('IsApprove', $this->BranchProposalForApproval)
            ->count_all_results();
    }
}