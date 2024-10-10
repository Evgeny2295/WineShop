<?php

namespace app\controllers\admin;


use app\models\Product;
use app\models\User;
use app\models\Order;

class MainController extends AppController
{

    public function indexAction()
    {

        $orderModel = new Order(); //подумать как изменить на статитику, в модели используется this  для бд
        $userModel = new User();
        $productModel = new Product();

        $orders = $orderModel->getCountAllOrders();
        $newOrders = $orderModel->getCountNewOrders();
        $users = $userModel->getCountUsers();
        $products = $productModel->getCountProducts();



        $title = 'Главная страница';
        $this->set(compact('title','orders','newOrders','users','products'));
        $this->setMeta('Админка:: главная страница');

    }

}