<?php

namespace app\models;

class Category extends AppModel
{

        public function getCategories($language_id): array
        {

            $stmt = $this->conn->prepare("SELECT * FROM category c JOIN category_description cd 
                                                ON c.id=cd.category_id WHERE language_id = :language_id");

            $stmt->execute(['language_id'=>$language_id]);

            return $stmt->fetchAll();

        }

        public function getCategory($slug,$language_id): array
        {
            $stmt = $this->conn->prepare("SELECT * FROM category c JOIN category_description cd 
                                                ON c.id=cd.category_id WHERE language_id = :language_id AND slug=:slug");

            $stmt->execute(['language_id'=>$language_id,'slug'=>$slug]);

            return $stmt->fetch();
        }

        public function getCountProducts($cat_id)
        {
            $stmt = $this->conn->prepare("SELECT COUNT(id) FROM product p WHERE p.category_id = :cat_id AND status=1");

            $stmt->execute(['cat_id'=>$cat_id]);

            return $stmt->fetch()['COUNT(id)'];
        }

        public function getCat($condition)
        {
            $this->getAll('category',condition:$condition);
        }

}