<?php

namespace App\Controllers;

use App\Models\AllUserModel;

class Home extends BaseController{

    public function index(){

        helper(['form']);
        return view('home_view');
    }

    public function getUsers(){

        $allUserModel = new AllUserModel();
        $get['users'] = $allUserModel->getAllUsers();
        $jsonData = json_encode($get);
        return $this->response->setBody($jsonData)->setContentType('application/json');
        // return $this->response->setJSON($get);
    }


    public function getUser($val){
        $allUserModel = new AllUserModel();
        $get = $allUserModel->getUserById($val);
        // $json = json_encode($get);
        return view('user_view', ['user' => $get]);
    }


    public function postUser(){
        $request = \Config\Services::request();

        $data = $request->getJSON();

        $postData = array(
            'name' =>$data->username, 
            'email' =>$data->email, 
            'phone' =>$data->phone, 
        );

        $allUserModel = new AllUserModel();
        $email_check = $allUserModel->emailValid($data->email);
        $phone_check = $allUserModel->phoneValid($data->phone);
        
        if ($postData['name'] === '') {
            $err = array(
                'err' => 'Name is required!',
                'code' => 400
            );

            $jsonData = json_encode($err);
            return $this->response->setBody($jsonData)->setContentType('application/json');
        
        }else if ($postData['email'] === '') {
            $err = array(
                'err' => 'Email is required!',
                'code' => 400
            );

            $jsonData = json_encode($err);
            return $this->response->setBody($jsonData)->setContentType('application/json');
       
        }else if (!preg_match('/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/', $postData['email'])) {

            $err = array(
                'err' => 'Email invalid!',
                'code' => 400
            );

            $jsonData = json_encode($err);
            return $this->response->setBody($jsonData)->setContentType('application/json');
            
        }else if ($postData['phone'] === '') {
            
            $err = array(
                'err' => 'Phone number is required!',
                'code' => 400
            );

            $jsonData = json_encode($err);
            return $this->response->setBody($jsonData)->setContentType('application/json');
        
        }elseif (!preg_match('/^[6-9]{1}[0-9]{9}$/', $postData['phone'])) {

            $err = array(
                'err' => 'Phone number invalid!',
                'code' => 400
            );

            $jsonData = json_encode($err);
            return $this->response->setBody($jsonData)->setContentType('application/json');
        
        }else if ($email_check === true) {

            $err = array(
                'err' => 'Email already exists!', 
                'code' => 400
            );

            $jsonData = json_encode($err);
            return $this->response->setBody($jsonData)->setContentType('application/json');
        
        }else if ($phone_check === true) {

            $err = array(
                'err' => 'Phone number already exists!',
                'code' => 400
            );

            $jsonData = json_encode($err);
            return $this->response->setBody($jsonData)->setContentType('application/json');
            
        }else {

            $success = array(
                'msg' => 'inserted',
                'code' => 201
            );

            $allUserModel->postUserModel($postData);
            $jsonData = json_encode($success);
            return $this->response->setBody($jsonData)->setContentType('application/json');
        }
    }


    
}