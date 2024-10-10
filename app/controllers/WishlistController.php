<?php

namespace app\controllers;

use app\models\Wishlist;
use core\App;

class WishlistController extends AppController
{
    public function indexAction(){

        $language = App::$app->getProperty('language');

        $wishlistModel = new Wishlist();
        $products = $wishlistModel->getWishlistProducts($language);

        $this->setMeta(___('wishlist_index_title'));
        $this->set(['products'=>$products]);
    }

    public function addAction(){
        $id = get('id');

        if(!$id){
            $answer = ['result'=>'error', 'text'=>___('tpl_wishlist_add_error')];
            exit(json_encode($answer));
        }

        $wishlistModel = new Wishlist();
        $product = $wishlistModel->getProduct($id);

        if($product){
            $wishlistModel->add_to_wishlist($id);
            $answer = ['result'=>'success', 'text'=>___('tpl_wishlist_add_success')];
        }else{
            $answer = ['result'=>'error', 'text'=>___('tpl_wishlist_add_error')];
        }
        exit(json_encode($answer));

    }

    public function deleteAction()
    {
        $id = get('id');
        $wishlistModel = new Wishlist();
        if ($wishlistModel->delete_from_wishlist($id)) {
            $answer = ['result' => 'success', 'text' => ___('tpl_wishlist_delete_success')];
        } else {
            $answer = ['result' => 'error', 'text' => ___('tpl_wishlist_delete_error')];
        }
        exit(json_encode($answer));
    }
}