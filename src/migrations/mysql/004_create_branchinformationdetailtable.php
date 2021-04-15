<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_CreateBranchInformationTable extends CI_Migration  
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
                'constraint' => 16
            ),
            'RegionId' => array(
                'type' => 'CHAR',
                'constraint' => 16,
                'null' => FALSE
            ),
            'Districtid' => array(
                'type' => 'INT',
                'constraint' => 11
                'null' => FALSE
            ),
            'AreaId' => array(
                'type' => 'CHAR',
                'constraint' => 16,
                'null' => FALSE
            ),
            'BranchId' => array(
                'type' => 'CHAR',
                'constraint' => 16,
                'null' => FALSE
            ),
            'Latitude' => array(
                'type' => 'CHAR',
                'constraint' => 16,
                'null' => FALSE
            ),
            'Longtitude' => array(
                'type' => 'DECIMAL(4,16)',
                'constraint' => 11
                'null' => FALSE
            ),
            'IsApprove' => array(
                'type' => 'TINYINT',
                'constraint' => 1
                'null' => FALSE
            ),
            'OpeningDate datetime default current_timestamp',
            'CreatedAt datetime default current_timestamp',
            'UpdatedAt datetime default current_timestamp'
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('BranchInformationId',TRUE);
        $this->dbforge->create_table('BranchInformation',TRUE); 

        $sqlSynxtax = "ALTER TABLE 'BranchInformation' ADD FOREIGN KEY('RegionId') REFERENCES LocationName'('LocationNameId');";
        $sqlSynxtax .= "ALTER TABLE 'BranchInformation' ADD FOREIGN KEY('Districtid') REFERENCES 'LocationName'('LocationNameId');";
        $sqlSynxtax .= "ALTER TABLE 'BranchInformation' ADD FOREIGN KEY('AreaId') REFERENCES 'LocationName'('LocationNameId');";
        $sqlSynxtax .= "ALTER TABLE 'BranchInformation' ADD FOREIGN KEY('BranchId') REFERENCES 'LocationName'('LocationNameId');";
        $this->db->query($sqlSynxtax);
        #TASK  Ifdata exist on dummy page RegionArchive import data on this table
        #Task if going down, archive the data first
    } 

    public function down()
    {
        $this->dbforge->drop_table('BranchInformation', TRUE);
    }

}