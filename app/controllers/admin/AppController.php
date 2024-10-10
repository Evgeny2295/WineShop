<?php

namespace app\controllers\admin;

use app\models\admin\User;
use app\models\Category;
use app\widgets\language\Language;
use core\App;
use core\Controller;

class AppController extends Controller
{

    public false|string $layout = 'admin';

    public function __construct($route)
    {
        parent::__construct($route);

        if(!User::isAdmin() && $route['action'] !== 'login-admin'){

            redirect(ADMIN . '/user/login-admin');
        }
        $model = 'app\models\\' . $route['admin_prefix'] . $this->route['controller'];
        if(class_exists($model)){
            $this->model = new $model();
        }

        App::$app->setProperty('languages',Language::getLanguages());
        App::$app->setProperty('language',Language::getLanguage(App::$app->getProperty('languages')));

        $categoryModel = new Category();
        $language = App::$app->getProperty('language');
        $categories = $categoryModel->getCategories($language['id']);
        App::$app->setProperty("categories",$categories);
    }
}