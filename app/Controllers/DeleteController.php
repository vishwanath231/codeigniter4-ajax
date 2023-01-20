<?php

namespace App\Controllers;
use App\Models\DeleteModel;

class DeleteController extends BaseController{

    public function deleteUser($val){

        $deleteModel = new DeleteModel();
        $deleteModel->getUserById($val);

        $msg = array(
            'err' => 'Deleted Successfull!',
            'code' => 200
        );

        $jsonData = json_encode($msg);
        return $this->response->setBody($jsonData)->setContentType('application/json');
    }
}




?>