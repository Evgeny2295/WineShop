<?php

namespace app\controllers;

use app\models\Search;
use core\App;
use core\Pagination;

class SearchController extends AppController
{
    public function indexAction(){
        $s = get('s','s') ?: '';

        if(empty($s)) redirect();

        $language_id = App::$app->getProperty('language')['id'];
        $searchModel = new Search();

        $page = get('page');

        $perpage = App::$app->getProperty('pagination');

        $total = $this->model->get([
            'table'=>'product p',
            'join'=>[
                'table'=>'product_description pd',
                'on'=>'p.id=pd.product_id'
            ],
            'count'=>1,
            'like'=>[
                'query'=>"p.slug LIKE :slug",
                'keyExec'=>':slug',
                'exec'=>"%{$s}%"
            ]
        ]);

        $pagination = new Pagination($page,$perpage,$total);

        $start = $pagination->getStart();

        $findProducts = $this->model->get( [
            'table'=>'product p',
            'join'=>[
                'table'=>'product_description pd',
                'on'=>'p.id = pd.product_id'
            ],
            'where'=>['language_id'=>$language_id],
            'like'=>[
                'query'=>'p.slug LIKE :slug',
                'keyExec'=>':slug',
                'exec'=>"%{$s}%"
            ],
            'limit'=>[" LIMIT $start,$perpage"]
        ]);

        $this->set(compact('findProducts','pagination','total','perpage'));
    }
}