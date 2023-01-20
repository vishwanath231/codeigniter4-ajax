<?php

namespace App\Controllers;
use App\Models\UpdateModel;

class UpdateController extends BaseController{

    public function selectUser($val){

        helper(['form']);
        $updateModel = new UpdateModel();
        $get['user'] = $updateModel->getUserById($val);
        // $json = json_encode($get);
        return view('update_view', $get);
    }


    public function updateUser(){
        $request = \Config\Services::request();

        $data = $request->getJSON();

        $postData = array(
            'name' => $data->name,
            'email' => $data->email,
            'phone' => $data->phone,
        );

        if ($postData['name'] === '') {
            $err = array(
                'err' => 'Name is required!',
                'code' => 400
            );

            $jsonData = json_encode($err);
            return $this->response->setBody($jsonData)->setContentType('application/json');
        } else if ($postData['email'] === '') {
            $err = array(
                'err' => 'Email is required!',
                'code' => 400
            );

            $jsonData = json_encode($err);
            return $this->response->setBody($jsonData)->setContentType('application/json');

        } else if (!preg_match('/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/', $postData['email'])) {

            $err = array(
                'err' => 'Email invalid!',
                'code' => 400
            );

            $jsonData = json_encode($err);
            return $this->response->setBody($jsonData)->setContentType('application/json');
        } else if ($postData['phone'] === '') {

            $err = array(
                'err' => 'Phone number is required!',
                'code' => 400
            );

            $jsonData = json_encode($err);
            return $this->response->setBody($jsonData)->setContentType('application/json');
        } elseif (!preg_match('/^[6-9]{1}[0-9]{9}$/', $postData['phone'])) {

            $err = array(
                'err' => 'Phone number invalid!',
                'code' => 400
            );

            $jsonData = json_encode($err);
            return $this->response->setBody($jsonData)->setContentType('application/json');
        } else {

            $updateModel = new UpdateModel();
            $updateModel->updateCurrentUser($data->id, $postData);

            $msg = array(
                'suc' => 'Updated Successfull!',
                'code' => 200
            );

            $jsonData = json_encode($msg);
            return $this->response->setBody($jsonData)->setContentType('application/json');
        }
        
    }
}
