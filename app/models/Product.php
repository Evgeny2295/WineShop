<?php

namespace app\models;

class Product extends AppModel
{
    public function getProducts($cat_id,$language_id,$start,$perpage,$name = null,$order=null): array
    {
        $order_query = '';
        if($name && $order) $order_query = "order by $name $order";

        $stmt = $this->conn->prepare("SELECT * FROM product p JOIN product_description pd ON 
                                            p.id = pd.product_id WHERE p.category_id = :cat_id AND status=1 AND pd.language_id = :language_id
                                             $order_query LIMIT $start,$perpage");

        $stmt->execute(['cat_id'=>$cat_id,'language_id'=>$language_id]);

        return $stmt->fetchAll();
    }
    public function getProduct($id,$language_id): array
    {

        $stmt = $this->conn->prepare("SELECT * FROM product p JOIN product_description pd ON 
                                            p.id = pd.product_id WHERE status=1 AND 
                                            pd.language_id = :language_id AND p.id=:id");

        $stmt->execute(['language_id'=>$language_id,'id'=>$id]);

        return $stmt->fetch();
    }

    public function getProd($slug,$language_id): array
    {

        $stmt = $this->conn->prepare("SELECT * FROM product p JOIN product_description pd ON 
                                            p.id = pd.product_id JOIN category c ON p.category_id = c.id WHERE p.status=1 AND 
                                            pd.language_id = :language_id AND p.slug=:slug");

        $stmt->execute(['language_id'=>$language_id,'slug'=>$slug]);

       return $stmt->fetch();
    }

    public function getSimilarProducts($cat_id,$language_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM product p JOIN product_description pd ON 
                                            p.id = pd.product_id WHERE status=1 AND 
                                            pd.language_id = :language_id AND p.category_id=:cat_id LIMIT 6");

        $stmt->execute(['language_id'=>$language_id,'cat_id'=>$cat_id]);

        return $stmt->fetchAll();
    }

    public function getProductWine($product_id,$language_id)
    {

        $stmt = $this->conn->prepare("SELECT * FROM product_wine WHERE product_id=:product_id AND 
                                        language_id = :language_id");

        $stmt->execute(['language_id'=>$language_id,'product_id'=>$product_id]);

        return $stmt->fetch();
    }

    public function getCountProducts(): int
    {
        $stmt = $this->conn->prepare("SELECT count(*) FROM product");
        $stmt->execute();
        return $stmt->fetch()['count(*)'];
    }

    public function get_product_by_category_id($id): array
    {
        $stmt = $this->conn->prepare("SELECT id FROM product WHERE category_id = :category_id");

        $stmt->execute(['category_id'=>$id]);

        return $stmt->fetchAll();

    }

    public function get_products_by_lang($language_id): array
    {
        $stmt = $this->conn->prepare("SELECT p.*,pd.title FROM product p JOIN product_desciption pd 
                                            ON p.id=pd.product_id WHERE language_id = :language_id");
        $stmt->execute(['language_id'=>$language_id]);

        return $stmt->fetchAll();
    }


}