<?php
class MUser extends MariGold_Model
{


    public function __construct()
    {
        $this->load->database();
    }

    public function find_or_create($email)
    {
        $now = date('Y-m-d H:i:s');  
        $userId =  $this->Guid();
        $data = [
            'UserId' => $userId,
            'UserEmail' => $email,
            'CreatedAt' => $now,
            'UpdatedAt' => $now
        ];

        $query = $this->db->get_where('User', array('UserEmail' => $email));
        $result = $query->row_array();

        if (!$result) {
            $this->db->insert('User', $data);
            return $userId;
        };

        return $result['UserId'];
    }
}
