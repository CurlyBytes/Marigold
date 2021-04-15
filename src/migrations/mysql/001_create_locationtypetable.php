<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_CreateLocationTypeTable extends CI_Migration  
{

    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
    } 

    public function up()
    {
        $fields = array
        (
            'LocationTypeId' => array(
                'type' => 'CHAR',
                'constraint' => 16
            ),
            'LocationType' => array(
                'type' => 'VARCHAR',
                'constraint' => 80,
                'null' => FALSE
            ),
            'CreatedAt datetime default current_timestamp',
            'UpdatedAt datetime default current_timestamp'
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('LocationTypeId',TRUE);
        $this->dbforge->create_table('LocationType',TRUE); 
        //$this->db->query("ALTER TABLE {$this->tables['phones']} CHANGE COLUMN update_time update_time TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP() ;");
        #TASK  Ifdata exist on dummy page RegionArchive import data on this table
        #Task if going down, archive the data first
    } 

    public function down()
    {
        $this->dbforge->drop_table('LocationType', TRUE);
    }

}