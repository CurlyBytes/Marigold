<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_LocationNameTable extends CI_Migration  
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
            'LocationNameId' => array(
                'type' => 'CHAR',
                'constraint' => 36
            ),
            'LocationTypeId' => array(
                'type' => 'CHAR',
                'constraint' => 36,
            ),
            'LocationName' => array(
                'type' => 'VARCHAR',
                'constraint' => 80,
                'null' => FALSE
            ),
            'CreatedAt datetime default current_timestamp',
            'UpdatedAt datetime default current_timestamp'
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('LocationNameId',TRUE);
        $this->dbforge->create_table('LocationName',TRUE); 

        $sqlSynxtax = "ALTER TABLE LocationName ADD FOREIGN KEY(LocationTypeId) REFERENCES LocationType(LocationTypeId);";
        $sqls = explode(';', $sqlSynxtax);
        array_pop($sqls);

        $this->db->trans_start();
        foreach($sqls as $statement){
            $statment = $statement . ";";
            $this->db->query($statement);   
        }
        $this->db->trans_complete(); 

        #TASK  Ifdata exist on dummy page RegionArchive import data on this table
        #Task if going down, archive the data first
    } 

    public function down()
    {
        $this->dbforge->drop_table('LocationName', TRUE);
    }

}