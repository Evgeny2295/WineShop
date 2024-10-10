<?php

namespace app\controllers\admin;

use app\models\Order;
use core\App;
use core\Pagination;

class OrderController extends AppController
{

    public function indexAction(){

        $status = get('status','s');
        $title = 'Заказы';
        $page = get('page');
        $perpage = 3;

        $total = $this->model->getCountOrders($status);
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();

        $orders = $this->model->getOrders($start, $perpage,$status);
        $title = 'Список заказов';
        $this->setMeta("Админка :: {$title}");
        $this->set(compact('title', 'orders', 'pagination', 'total'));


    }

    public function editAction()
    {
        $id = get('id');
        $status = get('status','i');
        $langId = App::$app->getProperty('language')['id'];
        $order = $this->model->getOrder($id,$langId);
        if($status === 0 || $status === 1){
            $this->model->change_status($id,$status);
            $_SESSION['success'] = 'Статус заказа успешно изменен';
            redirect(PATH . '/admin/order/edit?id='.$id);
        }

        $this->set(compact('order',));
    }

}