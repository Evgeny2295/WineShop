<?php

namespace app\controllers;

use app\models\User;
use core\App;
use core\Pagination;

class OrderController extends AppController
{

    public function indexAction()
    {
        if(!User::checkAuth()){

            redirect(base_url().'user/login');
        }

        $userId = $_SESSION['user']['id'];

        $page = get('page');

        $perpage = App::$app->getProperty('pagination');

        $total = $this->model->get([
            'table'=>'orders',
            'where'=>['user_id'=>$userId],
            'count'=>1
        ]);

        $pagination = new Pagination($page,$perpage,$total);

        $start = $pagination->getStart();

        $orders = $this->model->get([
            'table'=>'orders',
            'where'=>['user_id'=>$userId],
            'limit'=>[" LIMIT $start,$perpage"]
        ]);
        $this->set(compact('orders','pagination','total'));
    }
}