<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MLocationType extends MariGold_Model {

    protected $locationType = 'LocationType';
    protected $locationTypeId = 'LocationTypeId';

    public function __construct(){
         parent::__construct(); 
         
    }

	//Insert single data
	public function create($data){    
        $locationTypeId =  $this->Guid();
        $now = date('Y-m-d H:i:s');

        $locationTypeRecord = array(
            'LocationTypeId' => $locationTypeId,
            'LocationType' => strtoupper($data['locationtype']),
            'CreatedAt' =>  $now,
            'UpdatedAt' => $now
        );


        return $this->db->insert($this->locationType, $locationTypeRecord);
    }
	

    public function modify($data){ 
        $now = date('Y-m-d H:i:s');
        $record = array(
            'LocationType' => strtoupper($data['locationtype']),
            'UpdatedAt' => $now
        );

        $this->db->where($this->locationTypeId, $data['locationtypeid']);
        return $this->db->update($this->locationType, $record);
    }
	
	

    public function remove($data){

        $this->db->where($this->locationTypeId, $data['locationtypeid']);
        return $this->db->delete($this->locationType);
    }
	
    public function getAllLocationType($limit, $start){


        $this->db->limit($limit, $start);
        $query = $this->db->get($this->locationType);
        return $query->result();
    }

    public function getSpecificLocationType($locationTypeId){

        $query = $this->db
            ->get_where($this->locationType, 
                array($this->locationTypeId => $locationTypeId)
            )
            ->row();
        
        return $query;
    }

    public function get_count() {
        return $this->db->count_all($this->locationType);
    }
}