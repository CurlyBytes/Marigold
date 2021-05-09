<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MLocationName extends MariGold_Model {

    protected $locationName = 'LocationName';
    protected $locationNameId = 'LocationNameId';
    protected $locationGroup = 'LocationGroup'
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

        if($data['locationNameIdParent']){

            $locationGroupRecord = array(
                'LocationGroupId' => $locationGroupid,
                'LocationNameIdParent' => $data['locationNameIdParent'],
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
            'LocationTypeId' => $data['locationtypeid'],
            'LocationName' => $data['locationname'],
            'UpdatedAt' => $now
        );

        $this->db->where($this->LocationNameId, $data['locationnameid']);
        return $this->db->update($this->locationName, $record);
    }
	
	

    public function remove($data){
        
        $this->db->where($this->LocationNameId, $data['locationnameid']);
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


    public function getAllLocationNameByLocationType($limit, $start,$locationTypeId){
        $this->db->limit($limit, $start);
        $query = $this->db
                    ->from($this->locationName)
                    ->where('LocationTypeId', $locationTypeId)
                    
        return $query->result();
    }



    public function hasLocationNameExist($data){
        $query = $this->db->get_where($this->locationName, 
            array(
                'LocationTypeId' => $data['locationtypeid'] ,
                'LocationName' => $data['locationname']
            )
        );

        if(empty($query->row_array())){
            return true;
        } else {
            return false;
        }
    }


    public function get_count($locationTypeId) {
        return $this->db
            ->from($this->locationName)
            ->where('LocationTypeId', $locationTypeId)
            ->count_all_results();
    }
}