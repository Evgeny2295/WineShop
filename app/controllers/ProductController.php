<?php

namespace app\controllers;

use core\App;

class ProductController extends AppController
{
    public function viewAction()
    {
        $product_wine = '';
        $language_id = App::$app->getProperty('language')['id'];
        $slug = $this->route['slug'];


        $product = $this->model->getProd($slug,$language_id);


        $similarProducts = $this->model->getSimilarProducts($product['category_id'],$language_id);

        if($product['alias'] === 'vino'){

            $product_wine = $this->model->getProductWine($product['product_id'],$language_id);
        }


        if(empty($product)){
            //выдать ошибку
        }

        $this->set(compact('product','product_wine','similarProducts'));

    }

}