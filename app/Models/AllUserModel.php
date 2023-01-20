<?php

namespace App\Models;
use CodeIgniter\Model;

class AllUserModel extends Model{


    public function getAllUsers(){
        $db = \Config\Database::connect();

        $query = $db->query("SELECT id, name, email FROM users");
        $result = $query->getResult();
        return $result;
    }

    public function getUserById($id){
        $db = \Config\Database::connect();

        $query = $db->query("SELECT * FROM users WHERE id = '$id'");
        $result = $query->getResult();
        return $result;
    }


    public function postUserModel($data){
        $db = \Config\Database::connect();

        $query = $db->table("users");
        $result = $query->insert($data);
        return $result;
    }

    public function emailValid($email){
        $db = \Config\Database::connect();

        $query = $db->table('users');
        $result = $query->where('email', $email);
        if ($result->countAllResults() > 0) {
            return true;
        }else {
            return false;
        }
    }


    public function phoneValid($phone){
        $db = \Config\Database::connect();

        $query = $db->table('users');
        $result = $query->where('phone', $phone);
        if ($result->countAllResults() > 0) {
            return true;
        } else {
            return false;
        }
    }


    
}


?>