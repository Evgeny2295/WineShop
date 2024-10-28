<?php

namespace app\controllers;

use app\models\Category;
use core\App;

class ProductController extends AppController
{
    public function viewAction()
    {
        $product_wine = '';
        $language_id = App::$app->getProperty('language')['id'];
        $slug = $this->route['slug'];
        $cat_id = 1;

//        $products = $this->model->get(
//            ['table'=>'product p',
//             'join'=>[
//                 'table'=>'product_description pd',
//                 'on'=>'p.id = pd.product_id'
//             ],
//             'where'=>[
//                 'p.category_id'=>$cat_id,
//                 'p.status'=>1,
//                 'pd.language_id'=>$language_id
//             ],
//                'orderBy'=>'ORDER BY title ASC',
//                'limit'=>'LIMIT 0,1'
//            ]
//        );


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
        ])[0];
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


        if(empty($product)){
            //выдать ошибку
        }

        $this->set(compact('product','product_wine','similarProducts'));

    }

}