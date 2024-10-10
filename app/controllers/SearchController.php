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

        $language = App::$app->getProperty('language');

        $searchModel = new Search();

        $page = get('page');
        $perpage = App::$app->getProperty('pagination');
        $total = $searchModel->getTotalFindProducts($s);

        $pagination = new Pagination($page,$perpage,$total);
        $start = $pagination->getStart();

        $findProducts = $searchModel->getFindProducts($s,$language,$start,$perpage);

        $this->set(compact('findProducts','pagination','total','perpage'));
    }
}