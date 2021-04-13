<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_CreateBranchInformationPhotoTable extends CI_Migration  
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
            'BranchInformationPhotoId' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'BranchInformationId' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'PhotoName' => array(
                'type' => 'VARCHAR',
                'constraint' => 80,
                'null' => FALSE
            ),
            'CreatedAt datetime default current_timestamp',
            'UpdatedAt datetime default current_timestamp'
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('BranchInformationPhotoId',TRUE);
        $this->dbforge->create_table('BranchInformationPhoto',TRUE); 

        $sqlSynxtax = "ALTER TABLE 'BranchInformationPhoto' ADD FOREIGN KEY('BranchInformationId') REFERENCES BranchInformation'('BranchInformationId');";
        $this->db->query($sqlSynxtax);
        #TASK  Ifdata exist on dummy page RegionArchive import data on this table
        #Task if going down, archive the data first
    } 

    public function down()
    {
        $this->dbforge->drop_table('BranchInformationPhoto', TRUE);
    }

}