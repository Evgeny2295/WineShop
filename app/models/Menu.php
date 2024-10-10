<?php

namespace app\models;

use core\App;

class Menu extends AppModel
{

    public function getModel($language_id)
    {
        $categoryModel = new Category();
        return $categoryModel->getCategories($language_id);

    }

}