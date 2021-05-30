<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_UserAccount extends CI_Migration  
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
            'UserId' => array(
                'type' => 'CHAR',
                'constraint' => 36
            ),
            'UserEmail' => array(
                'type' => 'VARCHAR',
                'constraint' => 130,
                'null' => FALSE
            ),
            'CreatedAt datetime default current_timestamp',
            'UpdatedAt datetime default current_timestamp'
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('UserId',TRUE);
        $this->dbforge->create_table('User',TRUE);
        
        $this->db->trans_start();
        // $sqlSynxtax = "ALTER TABLE InternetServiceProvider ADD FOREIGN KEY(BranchInformationId) REFERENCES BranchInformation(BranchInformationId)";
        // $this->db->query($sqlSynxtax);
        $this->db->trans_complete();
        #Task if going down, archive the data first
    } 

    public function down()
    {
        $this->dbforge->drop_table('User', TRUE);
    }

}