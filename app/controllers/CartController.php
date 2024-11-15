<?php
namespace app\controllers;

use app\models\Cart;
use app\models\Order;
use app\models\Product;
use app\models\User;
use core\App;
use core\Controller;

class CartController extends AppController
{
    public function showAction()
    {
        $this->loadView('cart_modal');

    }

    public function viewAction()
    {

    }


    public function addAction()
    {
        $language_id = App::$app->getProperty('language')['id'];

        $id = post('id');
        $qty = post('qty');

        if(!$id){
            return false;
        }
        $product = $this->model->get([
            'table'=>'product p',
            'join'=>[
                'table'=>'product_description pd',
                'on'=>'p.id=pd.product_id'
            ],
            'where'=>['p.id'=>$id,'pd.language_id'=>$language_id]
        ])[0];
        $this->model->add_to_cart($product,$qty);

        if($this->isAjax()){
            $this->loadView('cart_modal');
        }
        redirect();
    }

    public function destroyAction()
    {
        if(empty($_SESSION['cart'])){
            return false;
        }

        unset($_SESSION['cart']);
        unset($_SESSION['cart.qty']);
        unset($_SESSION['cart.sum']);
        $this->loadView('cart_modal');
    }

    public function checkoutAction()
    {
        if (!empty($_POST)) {
            // регистрация пользователя, если не авторизован
            if (!User::checkAuth()) {
                $user = new User();
                $user->load();
                if (!$user->validate($user->attributes) || !$user->checkUnique()) {
                    $user->getErrors();
                    $_SESSION['form_data'] = $user->attributes;
                    redirect();
                }elseif(empty($_POST['user']['name'])){
                    $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);
                    if (!$user_id = $user->save('user')) {
                        $_SESSION['errors'] = ___('cart_checkout_error_register');
                        redirect();
                    }
                }else {
                    if(!$this->model->login()){
                        $_SESSION['errors'] = ___('user_login_error_login');
                        redirect();
                    }
                }
            }

            /* Сохраняем заказ*/

            $data['user_id'] = $user_id ?? $_SESSION['user']['id'];
            $data['note'] = post('note');
            $user_email = $_SESSION['user']['email'] ?? post('email');

            $order = new Order();

            if(!$order_id = $order->saveOrder($data)){
                $_SESSION['errors'] = ___('cart_checkout_error_save_order');
            }else{
                $order->mailOrder($order_id,$user_email,'mail_order_user');
                $order->mailOrder($order_id,App::$app->getProperty('admin_email'),'mail_order_admin');
                unset($_SESSION['cart']);
                unset($_SESSION['cart.sum']);
                unset($_SESSION['cart.qty']);
                $_SESSION['success'] = ___('cart_checkout_order_success');
            }

        }
        redirect();
    }

    public function deleteAction(){
        $id = get('id');

        if(isset($_SESSION['cart'][$id])){
            $this->model->delete_item($id);
        }
        if($this->isAjax()){
            $this->loadView('cart_modal');
        }
        redirect();
    }
}