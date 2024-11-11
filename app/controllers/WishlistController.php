<?php

namespace app\controllers;

use app\models\Wishlist;
use core\App;

class WishlistController extends AppController
{
    public function indexAction(){
        $products = [];
        $language_id = App::$app->getProperty('language')['id'];

        $wishListIds = $this->model->get_wishlist_ids();
        if(!empty($wishListIds)){
            $wishListIds = implode(',',$wishListIds);

            $products = $this->model->get([
                'table'=>'product p',
                'join'=>[
                    'table'=> 'product_description pd',
                    'on'=>'p.id=pd.product_id'
                ],
                'where'=>['pd.language_id'=>$language_id,'p.status'=>1],
                'in'=>"p.id IN ({$wishListIds})",
                'limit'=>['LIMIT 6']
            ]);
        }


        $this->setMeta(___('wishlist_index_title'));
        $this->set(['products'=>$products]);
    }

    public function addAction(){
        $id = get('id');

        if(!$id){
            $answer = ['result'=>'error', 'text'=>___('tpl_wishlist_add_error')];
            exit(json_encode($answer));
        }

        $product = $this->model->get([
            'table'=>'product',
            'where'=>['status'=>1,'id'=>$id]
        ]);


        if($product){
            $this->model->add_to_wishlist($id);

            $answer = ['result'=>'success', 'text'=>___('tpl_wishlist_add_success')];
        }else{
            $answer = ['result'=>'error', 'text'=>___('tpl_wishlist_add_error')];
        }
        exit(json_encode($answer));

    }

    public function deleteAction()
    {
        $id = get('id');
        if ($this->model->delete_from_wishlist($id)) {
            $answer = ['result' => 'success', 'text' => ___('tpl_wishlist_delete_success')];
        } else {
            $answer = ['result' => 'error', 'text' => ___('tpl_wishlist_delete_error')];
        }
        exit(json_encode($answer));
    }
}