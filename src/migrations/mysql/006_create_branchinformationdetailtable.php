<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_BranchInformationDetailTable extends CI_Migration  
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
            'BranchInformationDetailId' => array(
                'type' => 'CHAR',
                'constraint' => 36
            ),
            'BranchInformationId' => array(
                'type' => 'CHAR',
                'constraint' => 36,
                'null' => FALSE
            ),

            'BranchLocation' => array(
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => FALSE
            ),

            'OtherDetails' => array(
                'type' => 'VARCHAR',
                'constraint' => 450,
                'null' => FALSE
            ),
            'RentalPrice' => array(
                'type' => 'FLOAT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'CreatedAt datetime default current_timestamp',
            'UpdatedAt datetime default current_timestamp'
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('BranchInformationDetailId',TRUE);
        $this->dbforge->create_table('BranchInformationDetail',TRUE); 

        $this->db->trans_start();
        // $sqlSynxtax = "ALTER TABLE BranchInformationPhoto ADD FOREIGN KEY(BranchInformationId) REFERENCES BranchInformation(BranchInformationId)";
        // $this->db->query($sqlSynxtax);
        $this->db->trans_complete();
        #TASK  Ifdata exist on dummy page RegionArchive import data on this table
        #Task if going down, archive the data first
    } 

    public function down()
    {
        $this->dbforge->drop_table('BranchInformationDetail', TRUE);
    }

}