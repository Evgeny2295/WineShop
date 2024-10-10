<?php

namespace app\models\admin;

use app\models\AppModel;

class Category extends AppModel
{
    public function category_validate(): bool
    {
        $errors = '';
        foreach ($_POST['category_description'] as $lang_id => $item) {
            $item['title'] = trim($item['title']);
            if (empty($item['title'])) {
                $errors .= "Не заполнено Наименование во вкладке {$lang_id}<br>";
            }
        }
        if ($errors) {
            $_SESSION['errors'] = $errors;
            $_SESSION['form_data'] = $_POST;
            return false;
        }
        return true;
    }


    public function save_category($table)
    {

        try {

            $this->conn->beginTransaction();

            $slug = $this->get_slug($table,$_POST['slug'],'slug',);

            $lastInsertId = $this->insert_slug($table,$slug);

            $this->insert_into_description($table,$lastInsertId);

            $this->conn->commit();

            return true;

        }catch (\Exception $e){

            echo 'Ошибка добавления категории' . $e->getMessage();
        }

    }

    public function get_category_description($id): array
    {
        $stmt = $this->conn->prepare("SELECT * from category_description WHERE category_id = :id");
        $stmt->execute(['id'=>$id]);
        $category = $stmt->fetchAll();
        return $this->change_key($category);
    }

    protected function change_key($category):array
    {
        $categoryChange = [];
        foreach ($category as $v){
            $categoryChange[$v['language_id']] = $v;
        }
        return $categoryChange;
    }

    public function update_category($table,$id)
    {
       return $this->update_description($table,$id);
    }

    public function delete_category($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM category WHERE id= :id");

        $stmt->execute(['id'=>$id]);

        return true;
    }


}