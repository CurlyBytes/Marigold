<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_CreateBranchInformationDetailTable extends CI_Migration  
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
                'constraint' => 16
            ),
            'BranchInformationId' => array(
                'type' => 'CHAR',
                'constraint' => 16,
                'null' => FALSE
            ),
            'ContactPerson' => array(
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => FALSE
            ),
            'ContactNumber' => array(
                'type' => 'VARCHAR',
                'constraint' => 25,
                'null' => FALSE
            ),
            'ContactAddress' => array(
                'type' => 'VARCHAR',
                'constraint' => 35,
                'null' => FALSE
            ),
            'SquareMeter' => array(
                'type' => 'INT',
                'constraint' => 11
                'null' => FALSE
            ),
            'Description' => array(
                'type' => 'VARCHAR',
                'constraint' => 450,
                'null' => FALSE
            ),
            'RentalPrice' => array(
                'type' => 'FLOAT',
                'constraint' => 11
                'null' => FALSE
            ),
            'CreatedAt datetime default current_timestamp',
            'UpdatedAt datetime default current_timestamp'
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('BranchInformationDetailId',TRUE);
        $this->dbforge->create_table('BranchInformationDetail',TRUE); 

        $sqlSynxtax = "ALTER TABLE 'BranchInformationDetail' ADD FOREIGN KEY('BranchInformationId') REFERENCES BranchInformation'('BranchInformationId');";
        $this->db->query($sqlSynxtax);
        #TASK  Ifdata exist on dummy page RegionArchive import data on this table
        #Task if going down, archive the data first
    } 

    public function down()
    {
        $this->dbforge->drop_table('BranchInformationDetail', TRUE);
    }

}