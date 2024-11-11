<?php

namespace app\controllers;

use app\models\User;

class CredentialController extends AppController
{

    public function indexAction()
    {
        if (!User::checkAuth()) {
            redirect(base_url());
        }
    }

    public function updateAction()
    {
        if (!User::checkAuth()) {
            redirect(base_url());
        }

        if(!empty($_POST)){
            $this->model->load();
            $name=$this->model->attributes['name'];
            $email=$this->model->attributes['email'];
            $address=$this->model->attributes['address'];
            if($_SESSION['user']['name'] === $name && $_SESSION['user']['email'] === $email
                && $_SESSION['user']['address'] === $address) {

                $_SESSION['errors'] = 'Данные не были изменены';
                redirect('/credential/update');
            }

           if($this->model->validate($this->model->attributes)){
               $this->model->update('user',$_SESSION['user']['id']);
           }
        }
    }
}