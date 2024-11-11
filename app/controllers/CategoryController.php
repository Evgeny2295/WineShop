<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use core\App;
use core\Pagination;

class CategoryController extends AppController
{

    public function viewAction(){
        $orderBy='';
        $language_id = App::$app->getProperty('language')['id'];
        $category_title = $this->route['category_title'];
        $productModel = new Product();
//        $condition = ['slug'=>$slug,'language_id'=>$language_id];
        $category = $this->model->get([
            'table'=>'category c',
            'join'=>[
                'table'=>'category_description cd',
                'on'=>'c.id=cd.category_id'
            ],
            'where'=>['c.category_title'=>$category_title,'cd.language_id'=>$language_id]
        ])[0];

        $page = get('page');

//        $sortPrice = get('price');
//        debug($sortPrice);
        $perpage = App::$app->getProperty('pagination');

        $total = $this->model->get([
            'table'=>'product p',
            'where'=>['p.category_id'=>$category['id'],'p.status'=>1],
            'count'=>true
        ]);
        $pagination = new Pagination($page,$perpage,$total);
        $start = $pagination->getStart();


        if(!empty($_GET['name']) && !empty($_GET['order'])){
            $orderBy = $_GET['name'] . ' ' . $_GET['order'];
        }


        $products = $this->model->get([
            'table'=>'product p',
            'join'=>[
                'table'=>'product_description pd',
                'on'=>'p.id=pd.product_id'
            ],
            'where'=>[
                'p.category_id'=>$category['id'],
                'pd.language_id'=>$language_id
            ],
            'orderBy'=>$orderBy,
            'limit'=>" LIMIT $start,$perpage"
        ]);


        if($this->isAjax()){

           $this->loadView('view',compact('products','category','total','pagination'));
        }

        $this->set(compact('products','category','total','pagination',));


    }

}