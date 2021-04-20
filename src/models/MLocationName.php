<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MLocationName extends MariGold_Model {
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

        $locationGroupRecord = array(
            'LocationGroupId' => $locationGroupid,
            'LocationNameIdParent' => $data['locationNameIdParent'],
            'LocationNameIdChild' => $locationNameId,
            'CreatedAt' => $now,
            'UpdatedAt' => $now
        );

        $this->db->insert('LocationGroup', $locationGroupRecord);
        return $this->db->insert('LocationName', $locationNameRecord);
    }
	

    public function modify($data){
        $now = date('Y-m-d H:i:s');
        $record = array(
            'LocationTypeId' => $data['locationtypeid'],
            'LocationName' => $data['locationname'],
            'UpdatedAt' => $now
        );

        $this->db->where('LocationNameId', $data['locationnameid']);
        return $this->db->update('LocationName', $record);
    }
	
	

    public function remove($data){
        
        $this->db->where('LocationNameId', $data['locationnameid']);
        $this->db->delete('LocationName');
        
        $this->db->where('LocationNameIdChild', $data['locationnameid']);
        $this->db->delete('LocationGroup');

        return true;       
    }
	

    public function getByLocationType($data){
        $query = $this->db->get_where('LocationName', array('LocationTypeId' => $data['locationtypeid']));
        return $query->row();
    }

    public function hasLocationNameExist($data){
        $query = $this->db->get_where('LocationName', 
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
}