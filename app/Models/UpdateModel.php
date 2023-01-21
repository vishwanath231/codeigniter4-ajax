<?php

namespace App\Models;

use CodeIgniter\Model;

class UpdateModel extends Model{


    protected $db;

    public function __construct(){
        $this->db = \Config\Database::connect();
    }


    public function getUserById($id){
        return $this->db->table('users')->where(['id' => $id])->get()->getResult();
    }


    public function updateCurrentUser($id, $data){
        return $this->db->table('users')->where(['id' => $id])->update($data);
    }
}
