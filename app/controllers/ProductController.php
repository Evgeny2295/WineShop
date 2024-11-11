<?php

namespace app\controllers;

use app\models\Category;
use core\App;

class ProductController extends AppController
{
    public function viewAction()
    {
        $product = '';
        $product_wine = '';
        $similarProducts = '';
        $language_id = App::$app->getProperty('language')['id'];
        $slug = $this->route['slug'];

        $product = $this->model->get([
           'table'=>'product p',
           'join'=>[
                'table'=>'product_description pd',
                'on'=>'p.id=pd.product_id',
                'join_table'=>[
                    'table'=>'category c',
                    'on'=>'c.id = p.category_id'
                ]
           ],
           'where'=>['p.status'=>1,'p.slug'=>$slug,'pd.language_id'=>$language_id]
        ]);
        if(!empty($product)){
            $product = $product[0];
            $similarProducts = $this->model->get([
                'table'=>'product p',
                'join'=>[
                    'table'=>'product_description pd',
                    'on'=>'p.id=pd.product_id'
                ],
                'where'=>['p.status'=>1,'p.category_id'=>$product['category_id'],'pd.language_id'=>$language_id],
                'limit'=>" LIMIT 6"
            ]);

            if($product['category_title'] === 'vino'){
                $product_wine = $this->model->get([
                    'table'=>'wine_description',
                    'where'=>['product_id'=>$product['product_id'],'language_id'=>$language_id]
                ]);
            }
        }

        $this->set(compact('product','product_wine','similarProducts'));

    }

}