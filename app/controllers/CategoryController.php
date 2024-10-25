<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use core\App;
use core\Pagination;

class CategoryController extends AppController
{

    public function viewAction(){

        $categoryModel = new Category();
        $productModel = new Product();
        $language_id = App::$app->getProperty('language')['id'];
        $slug = $this->route['slug'];

//        $condition = ['slug'=>$slug,'language_id'=>$language_id];
        $category = $categoryModel->getCategory($slug,$language_id);
//        $category = $categoryModel->getCat(condition:$condition);



        $page = get('page');

//        $sortPrice = get('price');
//        debug($sortPrice);
        $perpage = App::$app->getProperty('pagination');
        $total = $categoryModel->getCountProducts($category['id']);
        $pagination = new Pagination($page,$perpage,$total);
        $start = $pagination->getStart();

        $name = '';
        $order = '';
        if(!empty($_GET['name']))  $name = $_GET['name'];
        if(!empty($_GET['order']))  $order = $_GET['order'];

        $products = $productModel->getProducts($category['id'],$language_id,$start,$perpage,$name,$order);

        if($this->isAjax()){

           $this->loadView('view',compact('products','category','total','pagination'));
        }

        $this->set(compact('products','category','total','pagination',));


    }

}