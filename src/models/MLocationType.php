<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MLocationType extends MariGold_Model {
    public function __construct(){
         parent::__construct(); 
         $this->load->database();
    }

	//Insert single data
	public function create($data){    
        $locationTypeId =  $this->Guid();
        $now = date('Y-m-d H:i:s');

        $locationTypeRecord = array(
            'LocationTypeId' => $locationTypeId,
            'LocationType' => $data['locationtype'],
            'CreatedAt' =>  $now,
            'UpdatedAt' => $now
        );


        return $this->db->insert('LocationType', $locationTypeRecord);
    }
	

    public function modify($data){
        $now = date('Y-m-d H:i:s');
        $record = array(
            'LocationType' => $data['locationtype'],
            'UpdatedAt' => $now
        );

        $this->db->where('LocationTypeId', $data['locationtypeid']);
        return $this->db->update('LocationType', $record);
    }
	
	

    public function remove($data){
        $now = date('Y-m-d H:i:s');
        $this->db->where('LocationTypeId', $data['locationtypeid']);
        $this->db->delete('LocationType');

        return true;       
    }
	

}