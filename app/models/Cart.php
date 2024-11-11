<?php

namespace app\models;

class Cart extends AppModel
{

    public function add_to_cart($product,$qty = 1){
        $qty = abs($qty);

        if(!empty($_SESSION['cart'][$product['id']])){
            $_SESSION['cart'][$product['id']]['qty'] +=$qty;
        }else{

            $_SESSION['cart'][$product['id']] = [
                'title'=>$product['title'],
                'slug'=>$product['slug'],
                'price'=>$product['price'],
                'qty'=>$qty,
                'img'=>$product['img'],
            ];
        }

        $_SESSION['cart.qty'] = !empty($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + $qty : $qty;
        $_SESSION['cart.sum'] = !empty($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] + $qty*$product['price'] : $qty*$product['price'] ;
        return true;
    }

    public function delete_item($id){
        $qty_minus = $_SESSION['cart'][$id]['qty'];
        $qty_sum = $qty_minus*$_SESSION['cart'][$id]['price'];

        $_SESSION['cart.qty'] -= $qty_minus;
        $_SESSION['cart.sum'] -= $qty_sum;

        unset($_SESSION['cart'][$id]);
    }

}