<?php

namespace App\Models;
use CodeIgniter\Model;

class DeleteModel extends Model{

    protected $db;

    public function __construct(){
        $this->db = \Config\Database::connect();
    }

    public function getUserById($id){

        return $this->db->table('users')->delete(['id' => $id]);
    }    
}
