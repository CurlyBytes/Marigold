<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_InternetServiceProviderTable extends CI_Migration  
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
            'InternetServiceProviderId' => array(
                'type' => 'CHAR',
                'constraint' => 36
            ),
            'BranchInformationId' => array(
                'type' => 'CHAR',
                'constraint' => 36,
                'null' => FALSE
            ),
            'InternetServiceProviderName' => array(
                'type' => 'VARCHAR',
                'constraint' => 25,
                'null' => FALSE
            ),
            'InternetServiceTechnologyType' => array(
                'type' => 'VARCHAR',
                'constraint' => 25,
                'null' => FALSE
            ),
            'Speed' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'CreatedAt datetime default current_timestamp',
            'UpdatedAt datetime default current_timestamp'
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('InternetServiceProviderId',TRUE);
        $this->dbforge->create_table('InternetServiceProvider',TRUE);
        
        $this->db->trans_start();
        // $sqlSynxtax = "ALTER TABLE InternetServiceProvider ADD FOREIGN KEY(BranchInformationId) REFERENCES BranchInformation(BranchInformationId)";
        // $this->db->query($sqlSynxtax);
        $this->db->trans_complete();
        #Task if going down, archive the data first
    } 

    public function down()
    {
        $this->dbforge->drop_table('InternetServiceProvider', TRUE);
    }

}