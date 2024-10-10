<?php

namespace app\controllers\admin;

use app\models\admin\Order;
use app\models\admin\User;
use app\models\Product;
use core\Pagination;

class UserController extends AppController
{

    public function loginAdminAction()
    {
        $this->layout = 'login';

        if(User::isAdmin()){
            redirect(ADMIN);
        }

        if(!empty($_POST)){

            if($this->model->login(true)) {
                $_SESSION['success'] = 'Вы успешно авторизовались';
            }else{
                $_SESSION['error'] = 'Данные введены неверно';

            }

            if($this->model::isAdmin()){

                redirect(ADMIN);
            }
            redirect();
        }
    }

    public function logoutAction()
    {
        if(User::isAdmin()){
            unset($_SESSION['user']);
        }
        redirect(ADMIN . '/user/login-admin');

    }

    public function indexAction()
    {
        $page = get('page');
        $perpage = 3;

        $total = $this->model->getCountUsers();
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();

        $users = $this->model->getUsers($start, $perpage);


        $this->set(compact('users','total','pagination'));
    }

    public function viewAction()
    {
        $id = get('id');

        $page = get('page');
        $perpage = 3;

        $total = $this->model->getCountUsers();
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();

        $orderModel = new Order();
        $user = $this->model->getUser($id);
        $orders = $orderModel->getOrdersByUserId($id,$start,$perpage);
        $this->set(compact('user','orders','pagination','total'));
    }

    public function editAction()
    {
        $id = get('id');

        $user = $this->model->getUser($id);

        if(!empty($_POST)){
            $this->model->load($_POST);
            if($this->model->validate($this->model->attributes)){
                if($this->model->updateUser($id)){
                    $_SESSION['user'] = $this->model->attributes;
                    $_SESSION['success'] = 'Данные успешно обновлены';
                }else{
                    $_SESSION['errors'] = 'Ошибка обновления';
                }
                redirect();
            }
        }

        $this->set(compact('user'));
    }



}