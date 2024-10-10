<?php

namespace app\controllers;

use app\models\Category;
use app\models\Language;
use app\models\Page;
use core\App;
use core\Cache;
use core\Controller;
use core\Pagination;

/**@property Main $model*/
class MainController extends AppController
{

//    public false|string $layout = 'test2';
    public function indexAction(){

        $pageModel = new Page();

        $language_id = App::$app->getProperty('language')['id'];

        $page = $pageModel->getPage($language_id);

        $this->set(compact('page'));


    }

}