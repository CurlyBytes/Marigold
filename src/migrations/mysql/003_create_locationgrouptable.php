<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_CreateLocationGroupTable extends CI_Migration  
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
            'LocationGroupId' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'LocationNameIdParent' => array(
                'type' => 'INT',
                'constraint' => 11
                'null' => FALSE
            ),
            'LocationNameIdChild' => array(
                'type' => 'INT',
                'constraint' => 11
                'null' => FALSE
            ),
            'CreatedAt datetime default current_timestamp',
            'UpdatedAt datetime default current_timestamp'
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('LocationTypeId',TRUE);
        $this->dbforge->create_table('LocationGroup',TRUE); 

        $sqlSynxtax = "ALTER TABLE 'LocationGroup' ADD FOREIGN KEY('LocationNameIdParent') REFERENCES LocationName'('LocationNameId');";
        $sqlSynxtax .= "ALTER TABLE 'LocationGroup' ADD FOREIGN KEY('LocationNameIdChild') REFERENCES 'LocationName'('LocationNameId');";

        $this->db->query($sqlSynxtax);
        #TASK  Ifdata exist on dummy page RegionArchive import data on this table
        #Task if going down, archive the data first
    } 

    public function down()
    {
        $this->dbforge->drop_table('LocationGroup', TRUE);
    }

}