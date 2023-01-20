<?php

namespace App\Models;
use CodeIgniter\Model;

class DeleteModel extends Model{


    public function getUserById($id){
        $db = \Config\Database::connect();

        return $db->table('users')->delete(['id' => $id]);
    }    
}
