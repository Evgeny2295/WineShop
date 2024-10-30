<?php

namespace app\controllers;

use app\models\Order;
use app\models\User;
use core\App;
use core\Pagination;

class UserController extends AppController
{

    public function loginAction(){
        if (User::checkAuth()) {
            redirect(base_url());
        }
        if(!empty($_POST)){
            if($this->model->login()){
                $_SESSION['success'] = ___('user_login_success_login');
                redirect(base_url());
            }else{
                $_SESSION['errors'] = ___('user_login_error_login');
                redirect();
            }
        }

        $this->setMeta(___('tpl_login '));
    }

    public function signupAction()
    {
        if (User::checkAuth()) {
            redirect(base_url());
        }

        if (!empty($_POST)) {
            $this->model->load();
            if (!$this->model->validate($this->model->attributes) || !$this->model->checkUnique()) {
                $this->model->getErrors();
                $_SESSION['form_data'] = $this->model->attributes;
                redirect('/user/signup');
            } else {
                $this->model->attributes['password'] = password_hash($this->model->attributes['password'], PASSWORD_DEFAULT);
                if ($this->model->save('user')) {
                    $_SESSION['success'] = ___('user_signup_success_register');
                } else {
                    $_SESSION['errors'] = ___('user_signup_error_register');
                }
            }
            redirect('/user/login');
        }

        $this->setMeta(___('tpl_signup'));
    }

    public function logoutAction()
    {

        if (User::checkAuth()) {
            unset($_SESSION['user']);
        }
        redirect(base_url() . 'user/login');

    }


}