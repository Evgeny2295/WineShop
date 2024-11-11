<?php

namespace app\controllers;



use app\models\Category;
use app\widgets\language\Language;
use core\App;
use core\Controller;

class AppController extends Controller
{
    public function __construct($route = [])
    {

        parent::__construct($route);

        $model = 'app\models\\' . $route['admin_prefix'] . $this->route['controller'];
        if(class_exists($model)){
            $this->model = new $model();
        }

        App::$app->setProperty('languages',Language::getLanguages());
        App::$app->setProperty('language',Language::getLanguage(App::$app->getProperty('languages')));

        $language = App::$app->getProperty('language');
        \core\Language::load($language['code'],$this->route);

        $categoryModel = new Category();
        $categories = $categoryModel->getCategoriesWithCountProducts($language['id']);

        App::$app->setProperty("categories",$categories);
    }
}