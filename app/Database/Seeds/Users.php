<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Users extends Seeder{

    public function run(){
        
        $data = [
            ['name' => 'vishwanath', 'email' => 'vishwanathvishwabai@gmail.com', 'phone' => 6385213119]
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
