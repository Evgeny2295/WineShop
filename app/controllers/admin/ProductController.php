<?php

namespace app\controllers\admin;

use core\App;
use core\Pagination;

class ProductController extends  AppController
{

    public function indexAction()
    {
        $languageId = App::$app->getProperty('language')['id'];
        $page = get('page');
        $perpage = 3;

        $total = $this->model->getCountProducts();
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();

        $products = $this->model->get_products_by_lang($languageId, $start, $perpage);
        $title = 'Список товаров';
        $this->setMeta("Админка :: {$title}");
        $this->set(compact('title', 'products', 'pagination', 'total'));
    }

    public function addAction()
    {

        $languages = App::$app->getProperty('languages');
        $categories = App::$app->getProperty('categories');

        if(!empty($_POST) && !empty($_POST['product_description']) && !empty($_FILES)){

            $this->model->load();
            if (!$this->model->validate($this->model->attributes) || !$this->model->validateDescription()) {

                $this->model->getErrors();
                $_SESSION['form_data'] = $this->model->attributes;
                $_SESSION['form_data']['product_description'] = $_POST['product_description'];
                $_SESSION['form_data']['wine_description'] = $_POST['wine_description'];
            } else {
                $this->model->saveProduct();
            }
            redirect();


        }

        $title = 'Добавление товара товаров';
        $this->setMeta("Админка :: {$title}");
        $this->set(compact('title', 'languages','categories'));
    }

    public function editAction()
    {
        $id = get('id');
        $languages = App::$app->getProperty('languages');
        $product = $this->model->getProductWithDescription($id, $languages );

        if(!empty($product)){
            $languageCode = App::$app->getProperty('language')['id'];
            $categories = App::$app->getProperty('categories');

            if(!empty($_POST)){
                $this->model->load();
                if (!$this->model->validate($this->model->attributes) || !$this->model->validateDescription()) {

                    $this->model->getErrors();
                    $_SESSION['form_data'] = $this->model->attributes;
                    $_SESSION['form_data']['product_description'] = $_POST['product_description'];
                    $_SESSION['form_data']['wine_description'] = $_POST['wine_description'];
                } else {

                    $this->model->updateProduct($id);
                    redirect(PATH . '/admin/product');
                }
                redirect();
            }

            $this->set(compact('categories','product','languages'));
        }else{

        }

    }


}