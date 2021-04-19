<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MLocationName extends MariGold_Model {
    public function __construct(){
         parent::__construct(); 
    }

	//Insert single data
	public function create($data){    
        $locationNameId =  $this->Guid();
        $locationGroupid =  $this->Guid();

        $locationNameRecord = array(
            'LocationNameId' => $locationNameId,
            'LocationTypeId' => $data['locationtypeid'],
            'LocationName' => $data['locationname'],
            'CreatedAt' => getdate(),
            'UpdatedAt' => getdate()
        );

        $locationGroupRecord = array(
            'LocationGroupId' => $locationGroupid,
            'LocationNameIdParent' => $data['locationNameIdParent'],
            'LocationNameIdChild' => $locationNameId,
            'CreatedAt' => getdate(),
            'UpdatedAt' => getdate()
        );

        $this->db->insert('LocationGroup', $locationGroupRecord);
        return $this->db->insert('LocationName', $record);
    }
	

    public function modify($data){
        $record = array(
            'LocationTypeId' => $data['locationtypeid'],
            'LocationName' => $data['locationname'],
            'UpdatedAt' => getdate()
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