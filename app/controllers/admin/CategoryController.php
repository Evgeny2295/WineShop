<?php

namespace app\controllers\admin;

use app\models\Product;
use core\App;

class CategoryController extends AppController
{

    public function indexAction()
    {
        $title = 'Категории';

        $categories = App::$app->getProperty('categories');

        $this->set(compact('title','categories'));
    }

    public function addAction()
    {
        $languages = App::$app->getProperty('languages');

        if (!empty($_POST)) {
            if ($this->model->category_validate()) {

                if($this->model->save_category('category')){

                    $_SESSION['success'] = 'Категория сохранена';

                }else{

                    $_SESSION['errors'] = 'Категория не добавлена';

                }
            }
            redirect();
        }
        $title = 'Добавление категории';
        $this->setMeta("Админка :: {$title}");
        $this->set(compact('title','languages'));
    }

    public function editAction()
    {

        $id = get('id');
        $languages = App::$app->getProperty('languages');
        $category = $this->model->get_category_description($id);

        if(!empty($_POST)){
            if($this->model->category_validate()){
                if($this->model->update_category('category',$id)){
                    $_SESSION['success'] = 'Категория обновлена';
                }else{
                    $_SESSION['success'] = 'Ошибка в обновлении';

                }
            }
            redirect();
        }

        $title = 'Добавление категории';
        $this->setMeta("Админка :: {$title}");
        $this->set(compact('title','category','languages'));
    }

    public function deleteAction()
    {
        $id = get('id');

        $productModel = new Product();

        $productByCategoryId = $productModel->get_product_by_category_id($id);

        if(!empty($productByCategoryId)){
            $_SESSION['errors'] = 'Категория не может быть удалена, так как в ней есть проудкты';
        }else{
            if($this->model->delete_category($id)){
                $_SESSION['success'] = 'Категория удалена';
            }else{

                $_SESSION['errors'] = 'Ошибка удаления';
            }
        }

        redirect();
    }



}