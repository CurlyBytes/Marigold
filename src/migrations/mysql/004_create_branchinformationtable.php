<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_BranchInformationTable extends CI_Migration  
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
            'BranchInformationId' => array(
                'type' => 'CHAR',
                'constraint' => 36
            ),
            'RegionId' => array(
                'type' => 'CHAR',
                'constraint' => 36,
                'null' => FALSE
            ),
            'Districtid' => array(
                'type' => 'CHAR',
                'constraint' => 36,
                'null' => FALSE
            ),
            'AreaId' => array(
                'type' => 'CHAR',
                'constraint' => 36,
                'null' => FALSE
            ),
            'BranchId' => array(
                'type' => 'CHAR',
                'constraint' => 36,
                'null' => FALSE
            ),
            'Latitude' => array(
                'type' => 'DECIMAL',
                'constraint' => '10, 8',
                'null' => FALSE
            ),
            'Longtitude' => array(
                'type' => 'DECIMAL',
                'constraint' => '11, 8',
                'null' => FALSE
            ),
            'OpeningDate datetime default current_timestamp',
            'CreatedAt datetime default current_timestamp',
            'UpdatedAt datetime default current_timestamp'
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('BranchInformationId',TRUE);
        $this->dbforge->create_table('BranchInformation',TRUE); 

        $this->db->trans_start();
        $sqlSynxtax = "ALTER TABLE BranchInformation ADD FOREIGN KEY(RegionId) REFERENCES LocationName(LocationNameId)";
        $this->db->query($sqlSynxtax);

        $sqlSynxtax = "ALTER TABLE BranchInformation ADD FOREIGN KEY(Districtid) REFERENCES LocationName(LocationNameId)";
        $this->db->query($sqlSynxtax);

        $sqlSynxtax = "ALTER TABLE BranchInformation ADD FOREIGN KEY(AreaId) REFERENCES LocationName(LocationNameId)";
        $this->db->query($sqlSynxtax);

        $sqlSynxtax = "ALTER TABLE BranchInformation ADD FOREIGN KEY(BranchId) REFERENCES LocationName(LocationNameId)";
        $this->db->query($sqlSynxtax);
        $this->db->trans_complete();
        #TASK  Ifdata exist on dummy page RegionArchive import data on this table
        #Task if going down, archive the data first
    } 

    public function down()
    {
        $this->dbforge->drop_table('BranchInformation', TRUE);
    }

}