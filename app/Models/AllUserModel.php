<?php

namespace App\Models;
use CodeIgniter\Model;

class AllUserModel extends Model{

    protected $db;

    public function __construct(){
        $this->db = \Config\Database::connect();
    }

    public function getAllUsers(){

        return $this->db
                    ->table('users')
                    ->get()
                    ->getResult();
    }

    public function getUserById($id){

        return $this->db
                    ->table('users')
                    ->where(['id' => $id])
                    ->get()
                    ->getResult();
    }


    public function postUserModel($data){
        return $this->db->table("users")->insert($data);
    }

    public function emailValid($email){
        $result = $this->db
                    ->table('users')
                    ->where(['email' => $email])
                    ->countAllResults();

        if ($result > 0) {
            return true;
        }else {
            return false;
        }
    }


    public function phoneValid($phone){
        $result = $this->db
                        ->table('users')
                        ->where(['phone' => $phone])
                        ->countAllResults();
        
        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }
    
}


?>