<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MLocationName extends MariGold_Model {

    protected $locationName = 'LocationName';
    protected $locationNameId = 'LocationNameId';
    protected $locationGroup = 'LocationGroup';
    protected $locationGroupId = 'LocationGroupId';

    public function __construct(){
         parent::__construct(); 
         
    }

	//Insert single data
	public function create($data){  
        $now = date('Y-m-d H:i:s');  
        $locationNameId =  $this->Guid();
        $locationGroupid =  $this->Guid();

        $locationNameRecord = array(
            'LocationNameId' => $locationNameId,
            'LocationTypeId' => $data['locationtypeid'],
            'LocationName' => $data['locationname'],
            'CreatedAt' => $now,
            'UpdatedAt' => $now
        );

        if($data['locationnameidparent']){

            $locationGroupRecord = array(
                'LocationGroupId' => $locationGroupid,
                'LocationNameIdParent' => $data['locationnameidparent'],
                'LocationNameIdChild' => $locationNameId,
                'CreatedAt' => $now,
                'UpdatedAt' => $now
            );
            $this->db->insert($this->locationGroup, $locationGroupRecord);
        }

        return $this->db->insert($this->locationName, $locationNameRecord);
    }
	

    public function modify($data){
        $now = date('Y-m-d H:i:s');
        $record = array(
            'LocationName' => $data['locationname'],
            'UpdatedAt' => $now
        );

        if($data['locationnameidparent']){
            $locationGroupRecord = array(
                'LocationNameIdParent' => $data['locationnameidparent'],
                'UpdatedAt' => $now
            );
            $this->db->where($this->locationGroupId, $data['locationgroupid']);
            $this->db->update($this->locationGroup, $locationGroupRecord);
        }

        $this->db->where($this->locationNameId, $data['locationnameid']);
        return $this->db->update($this->locationName, $record);
    }
	
	

    public function remove($data){
        
        $this->db->where($this->locationNameId, $data['locationnameid']);
        $this->db->delete($this->locationName);
        
        $this->db->where('LocationNameIdChild', $data['locationnameid']);
        $this->db->delete($this->locationGroup);

        return true;       
    }
	
    public function getSpecificLocationNameByLocationType($locationNameId){

        $query = $this->db
            ->get_where($this->locationName, 
                array($this->locationNameId => $locationNameId)
            )
            ->row();
        
        return $query;
    }

    public function getSpecificLocationGroupByLocationNameIdChild($locationNameIdChild){

        $query = $this->db
            ->get_where($this->locationGroup, 
                array('LocationNameIdChild' => $locationNameIdChild)
            )
            ->row();
        
        return $query;
    }



    public function getAllLocationNameByLocationType($limit, $start,$locationTypeId){
        $this->db->limit($limit, $start);
        $query = $this->db->get_where($this->locationName, 
            array(
                'LocationTypeId' => $locationTypeId 
            )
        );      

        return $query->result();
    }

    public function getAllLocationNameByLocationTypeWithParentJoin($limit, $start,$locationTypeId){

        $this->db->select('Child.LocationNameId AS LocationNameId, Parent.LocationName AS ParentName ,Child.LocationName As ChildName,Child.CreatedAt,Child.UpdatedAt');
        $this->db->from($this->locationName . ' AS Child');
        $this->db->where('Child.LocationTypeId', $locationTypeId);
        $this->db->join('LocationGroup', 'LocationGroup.LocationNameIdChild=Child.LocationNameId');
        $this->db->join($this->locationName . ' AS Parent', 'Parent.LocationNameId=LocationGroup.LocationNameIdParent');
        $this->db->limit($limit, $start);
 
        return $this->db->get()->result();
    }

    public function getAllLocationNameByLocationTypeNoPagination($locationTypeId){

        $query = $this->db->get_where($this->locationName, 
            array(
                'LocationTypeId' => $locationTypeId 
            )
        );      

        return $query->result();
    }


    public function hasLocationNameExist($locationNameId, $locationTypeId, $locationName){

        $query = '';
        $paramaters = array(
            'LocationTypeId' => $locationTypeId ,
            'LocationName' => $locationName
            );

        if($locationNameId == false){
            $paramaters['LocationNameId !='] = $LocationNameId;
        }
       
        
        $query = $this->db->get_where($this->locationName,  $paramaters);
        

        if(empty($query->row_array())){
            return false;
        } else {
            return true;
        }
    }


    public function hasLocationNameExistWithParentId($locationNameId,
     $locationNameIdParent, 
     $locationTypeId, 
     $locationName){

        $locationGroupFilter = array(
            'LocationGroup.LocationNameIdParent' => $locationNameIdParent 
            );
     
        $locationNameFilter = array(
            'LocationName.LocationNameId !=' => $locationNameId,
            'LocationName.LocationTypeId' => $locationTypeId,
            'LocationName.LocationName' => $locationName 
             
            );
        $this->db->select('*');
        $this->db->from($this->locationName . ' AS LocationName');
        $this->db->where($locationNameFilter);
        $this->db->join($this->locationGroup . ' AS LocationGroup' , 'LocationGroup.LocationNameIdChild = LocationName.LocationNameId','LEFT');
        $this->db->where($locationGroupFilter);
        $query = $this->db->get()->result();
        
        if(empty($query)){
            return false;
        } else {
            return true;
        }
    }


    
    public function hasLocationNameIdParent($locationNameId, $locationTypeId){
        $query = $this->db->get_where($this->locationName, 
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

    public function hasLocationGroupIdExist($locationGroupId){

        $query = $this->db
            ->get_where('LocationGroup', 
                array('LocationGroupId' => $locationGroupId)
            )
            ->row();
        if(empty($query)){
            return false;
        } else {
            return true;
        }
    }


    public function hasLocationGroupHasChild($locationNamedId){

        $query = $this->db
            ->get_where('LocationGroup', 
                array('LocationNameIdParent' => $locationNamedId)
            )
            ->row();
        if(empty($query)){
            return false;
        } else {
            return true;
        }
    }
    public function get_count($locationTypeId) {
        return $this->db
            ->from($this->locationName)
            ->where('LocationTypeId', $locationTypeId)
            ->count_all_results();
    }
}