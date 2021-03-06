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
        $this->db->join('BranchInformation AS BranchInformation', 'BranchInformation.BranchId = LocationName.LocationNameId','right');
        $this->db->where('LocationName.LocationTypeId', GUID_BRANCH);
        $this->db->where('BranchInformation.IsApprove', $this->BranchProposalForApproval);
        $this->db->group_by('LocationNameId');

        return $this->db->get()->result();     
    }
	


	//Insert single data
	public function propose($data){    
        $now = date('Y-m-d H:i:s');
        $branchInformation =  $this->Guid();
        $branchInformationDetailId =  $this->Guid();
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
            'RegionId' => $data['regionid'],
            'Districtid' => $data['districtid'],
            'AreaId' => $data['areaid'],
            'BranchId' => $data['branchid'],
            'Latitude' => $data['latitude'],
            'Longtitude' => $data['longtitude'],
            'IsApprove' => $this->BranchProposalForApproval,
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

        $branchInformationDetailRecord = array(
            'BranchInformationDetailId ' => $branchInformationDetailId,
            'BranchInformationId' => $branchInformation,
            'BranchLocation' => $data['branchlocation'],
            'Ratings' => $data['ratings'],
            'OtherDetails' => $data['otherdetails'],
            'RentalPrice' =>  $data['rentalprice'],
            'CreatedAt' => $now,
            'UpdatedAt' => $now
        );
        $this->db->insert('BranchInformationDetail', $branchInformationDetailRecord);
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

        $this->db->where('BranchInformationId ', $data['branchinformationid']);
        $result = $this->db->update('BranchInformation', $branchInformationRecord);
        $param = array('IsApprove' => $this->BranchProposalForApproval, 'BranchId' => $data['branchid']);
     
        $this->db->delete('BranchInformation', $param);
        return $result;     
    }
	
	
    public function modify($data){
        $now = date('Y-m-d H:i:s');
        $branchInformationRecord = array(
            'BranchId' => $data['branchid'],
            'Latitude' => $data['latitude'],
            'Longtitude' => $data['longtitude'],
            'OpeningDate' => $data['openingdate'],
            'UpdatedAt' => $now
        );

        $branchInformationDetailRecord = array(
            'BranchLocation' => $data['branchlocation'],
            'Ratings' => $data['ratings'],
            'OtherDetails' => $data['otherdetails'],
            'RentalPrice' =>  $data['rentalprice'],
            'UpdatedAt' => $now
        );
        $this->db->where('BranchInformationDetailId', $data['branchinformationdetailid']);
        $this->db->update('BranchInformationDetail', $branchInformationDetailRecord);

        $this->db->where('BranchInformationId', $data['branchinformationid']);
        return $this->db->update('BranchInformation', $branchInformationRecord);
    } 


    public function replaceimage($data){
        $now = date('Y-m-d H:i:s');
        $query = $this->db
                ->get_where('BranchInformationPhoto', array('BranchInformationid' => $data['branchinformationid']));

        $this->db->where('BranchInformationId ', $data['branchinformationid']);
        $this->db->delete('BranchInformationPhoto');

        foreach ($query->result() as $row)
        {   
            unlink(FCPATH . 'uploads/files/'. $row->PhotoName);    
        }

        foreach($data['photoname'] as $photoname ){
            $branchInfomrationPhoto = array(
                'BranchInformationPhotoId' =>  $this->Guid(),
                'BranchInformationId' =>  $data['branchinformationid'],
                'PhotoName' => $photoname,
                'CreatedAt' => $now,
                'UpdatedAt' => $now
            );

            $this->db->insert('BranchInformationPhoto', $branchInfomrationPhoto);
        }
    } 
    public function remove($data){

        $query = $this->db
                ->get_where('BranchInformationPhoto', array('BranchInformationid' => $data['branchinformationid']));

        $this->db->where('BranchInformationId ', $data['branchinformationid']);
        $this->db->delete('BranchInformationPhoto');

        foreach ($query->result() as $row)
        {   
            unlink(FCPATH . 'uploads/files/'. $row->PhotoName);    
        }

        $this->db->where('BranchInformationDetailId ', $data['branchinformationdetailid']);
        $this->db->delete('BranchInformationDetail');

        $this->db->where('BranchInformationId ', $data['branchinformationid']);
        $this->db->delete('BranchInformation');

        $this->db->where('BranchInformationId ', $data['branchinformationid']);
        $this->db->delete('InternetServiceProvider');
        return true;       
    }
	
    public function getAllBranchInformationDetailById($branchInformationId){
        
        $query = $this->db->get_where('BranchInformationDetail', array('BranchInformationId' => $branchInformationId));
        return $query->row();
    }



    public function getAllBranchInformationPhotoByBranchInfomrationId($branchInformationId){
        
        $query = $this->db->get_where('BranchInformationPhoto', array('BranchInformationid' => $branchInformationId));
        return $query->result();
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

    public function IsPrimaryKeyExists($primarykeyid , $primarytablename){
        
        $query = $this->db->get_where($primarytablename, array( $primarytablename . 'Id' => $primarykeyid));
        if(empty($query->row_array())){
            return false;
        } else {
            return true;
        }
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


    public function IsCoordinateExist($latitude, $longtitude){
        $query = $this->db->get_where('BranchInformation', 
            array(
                'Latitude' => $latitude ,
                'Longtitude' => $longtitude
            )
        );

        if(empty($query->row_array())){
            return false;
        } else {
            return true;
        }
    }
    
    public function hasMinimumBranchProposal($branchinformationid){
        $query = $this->db->get_where('BranchInformation', 
            array(
                'BranchId' => $branchinformationid ,
                'IsApprove' => $this->BranchProposalForApproval
            )
        );
        $count = count($query->result_array());
    
        if(count($query->result_array()) >= 3 ){
            return true;
        } else {
            
            return false;
        }
    }

    public function hasMinimumIsp($branchinformationid){
        $query = $this->db->get_where('InternetServiceProvider', 
            array(
                'BranchInformationId' => $branchinformationid,
            )
        );

    
        if(count($query->result_array()) >= $this->MinimumBranchProposal ){
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

    
        if(count($query->result_array()) <= $this->MaximumBranchProposal ){
            return true;
        } else {         
            return false;
        }
    }

    public function hasMinimimumImages($branchinformationid){
        $query = $this->db->get_where('BranchInformationPhoto', 
            array(
                'BranchInformationId' => $branchinformationid 
            )
        );

    
        if(count($query->result_array()) >= 3 ){
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