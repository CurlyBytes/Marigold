<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MGeoMap extends MariGold_Model {

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
     
        $this->db->join('BranchInformation AS BranchInformation', 'BranchInformation.BranchId = LocationName.LocationNameId','RIGHT');
        $this->db->group_by('LocationNameId');
        $this->db->where('LocationName.LocationTypeId', GUID_BRANCH);
        $this->db->where('BranchInformation.IsApprove', $this->BranchProposalForApproval);
        return $this->db->get()->result();     
    }
	

    public function getAllProposeLocationByBranchNameWithOpeningDateRange($data){
        $this->db->select('BranchInformation.BranchInformationId,Latitude, OpeningDate, Longtitude,  Branch.LocationName As BranchName, Area.LocationName As AreaName, District.LocationName As DistrictName, Region.LocationName As RegionName, BranchInformation.CreatedAt As CreatedAt, BranchInformation.UpdatedAt As UpdatedAt');
        $this->db->from('BranchInformation');
        $this->db->join('LocationName AS Region', 'Region.LocationNameId=BranchInformation.RegionId');
        $this->db->join('LocationName AS District', 'District.LocationNameId=BranchInformation.DistrictId');
        $this->db->join('LocationName AS Area', 'Area.LocationNameId=BranchInformation.AreaId');
        $this->db->join('LocationName AS Branch', 'Branch.LocationNameId=BranchInformation.BranchId');
        $this->db->where('BranchInformation.IsApprove', $this->BranchProposalForApproval);
        $this->db->where('BranchInformation.IsApprove', $data['branchlocationnameid']);
        $this->db->where('BranchInformation.OpeningDate >=',$data['beginningdate']);
        $this->db->where('BranchInformation.OpeningDate <=', $data['endingdate']);
        return $this->db->get()->result();
    }

    public function getAllProposeLocationWithOpeningDateRange($data){
        $this->db->select('BranchInformation.BranchInformationId, ContactPerson, ContactNumber, ContactAddress, SquareMeter, Description, RentalPrice, Latitude, OpeningDate, Longtitude, Branch.LocationName As BranchName, Area.LocationName As AreaName, District.LocationName As DistrictName, Region.LocationName As RegionName, BranchInformation.CreatedAt As CreatedAt, BranchInformation.UpdatedAt As UpdatedAt');
        $this->db->from('BranchInformation');
        $this->db->join('LocationName AS Region', 'Region.LocationNameId=BranchInformation.RegionId');
        $this->db->join('LocationName AS District', 'District.LocationNameId=BranchInformation.DistrictId');
        $this->db->join('LocationName AS Area', 'Area.LocationNameId=BranchInformation.AreaId');
        $this->db->join('LocationName AS Branch', 'Branch.LocationNameId=BranchInformation.BranchId');
        $this->db->join('BranchInformationDetail AS BranchInformationDetail', 'BranchInformationDetail.BranchInformationId=BranchInformation.BranchInformationId');
        $this->db->where('BranchInformation.IsApprove', $this->BranchProposalForApproval);
        if($data['proposebranchid'] != 0){
            $this->db->where('BranchInformation.BranchId', $data['proposebranchid']);
        }
        $this->db->where('DATE_FORMAT(BranchInformation.OpeningDate,"%Y-%m")',$data['openingdate']);
        $query = $this->db->get()->result();   
        return $query;
    }
  

    public function getALlBranchLocation(){
        $this->db->select('BranchInformation.BranchInformationId, ContactPerson, ContactNumber, ContactAddress, SquareMeter, Description, RentalPrice, Latitude, OpeningDate, Longtitude, Branch.LocationName As BranchName, Area.LocationName As AreaName, District.LocationName As DistrictName, Region.LocationName As RegionName, BranchInformation.CreatedAt As CreatedAt, BranchInformation.UpdatedAt As UpdatedAt');
        $this->db->from('BranchInformation');
        $this->db->join('LocationName AS Region', 'Region.LocationNameId=BranchInformation.RegionId');
        $this->db->join('LocationName AS District', 'District.LocationNameId=BranchInformation.DistrictId');
        $this->db->join('LocationName AS Area', 'Area.LocationNameId=BranchInformation.AreaId');
        $this->db->join('LocationName AS Branch', 'Branch.LocationNameId=BranchInformation.BranchId');
        $this->db->join('BranchInformationDetail AS BranchInformationDetail', 'BranchInformationDetail.BranchInformationId=BranchInformation.BranchInformationId');
        $this->db->where('BranchInformation.IsApprove', $this->BranchWasApproved);
        $query = $this->db->get()->result();   
        return $query;
    }
    public function getProposedBranchLocationList($data){
        $query = $this->db->get_where('BranchInformation', array('IsApprove' => $this->BranchProposalForApproval));
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