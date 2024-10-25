<?php

namespace app\models\admin;

class Product extends AppModel
{

    public array $attributes = [
        'category_id'=>'',
        'slug'=>'',
        'price'=>'',
        'old_price'=>'',
        'strength'=>'',
        'capacity'=>'',
        'img'=>'',
        'hit'=>'',
        'status'=>'',
    ];
    public array $rules = [
    'required'=>['category_id','slug','price','strength','capacity','img'],
    'integer'=>['price','old_price','strength','capacity','hit','status'],
    'optional'=>['old_price']
    ];
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
                                            p.id = pd.product_id WHERE  
                                             pd.language_id = :language_id AND p.id=:id");

        $stmt->execute(['language_id'=>$language_id,'id'=>$id]);

        return $stmt->fetch();

    }

    public function getProductWithDescription($id,$languages): array
    {
        $product = [];
        $stmt = $this->conn->prepare("SELECT * FROM product p JOIN product_description pd ON 
                                            p.id = pd.product_id 
                                            JOIN wine_description wd ON 
                                            p.id = wd.product_id  WHERE  
                                             pd.language_id = :language_id 
                                            AND pd.language_id = :lang_id 
                                            AND p.id=:id");

        foreach ($languages as $language){
            $langId = $language['id'];
            $stmt->execute(['language_id'=>$langId,'lang_id'=>$langId,'id'=>$id]);
            $product[$langId] = $stmt->fetch();
        }

        return $product;

    }

    public function getProd($slug,$language_id): array
    {

        $stmt = $this->conn->prepare("SELECT * FROM product p JOIN product_description pd ON 
                                            p.id = pd.product_id JOIN category c ON p.category_id = c.id WHERE status=1 AND 
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

    public function get_products_by_lang($language_id,$start, $perpage): array
    {

        $stmt = $this->conn->prepare("SELECT * FROM product p JOIN product_description pd 
                                            ON p.id=pd.product_id WHERE pd.language_id = :language_id LIMIT $start, $perpage");

        $stmt->execute(['language_id'=>$language_id]);

        return $stmt->fetchAll();
    }

    public function validateDescription()
    {

        foreach ($_POST['product_description'] as $product){
            foreach ($product as $key=>$value){
                if(!empty($value)) {
                    continue;
                }else{
                      $this->errors[] = "Не заполнено полу {$key}";
                }
            }
        }

        if(!empty($_POST['wine_description'][1]['manufacture'])){

            foreach ($_POST['wine_description'] as $wine){
                foreach ($wine as $key=>$value){
                    if(!empty($value)) {
                        continue;
                    }else{
                        $this->errors[] = "Не заполнено поле {$key}";
                    }
                }
            }
        }

        return !empty($this->errors) ? false : true;
    }


    public function saveProduct()
    {
        $imgFile = $_FILES['img'];
        try{
            $this->conn->beginTransaction();
            $this->attributes['slug'] = $this->get_slug('product',$this->attributes['slug'],'slug');

            $productId = $this->saveIntoProductTable();
            $this->insert_into_description('product',$productId);

            if(!empty($_POST['wine_description'][1]['manufacture'])){
                $this->insert_into_description('wine',$productId);
            }

            $this->conn->commit();
        }catch (\Exception $e){
            $this->conn->rollBack();
            echo ('Ошибка' . $e);
        }

    }

    protected function saveIntoProductTable()
    {

        $this->uploadImg();

        return $this->save('product');

    }

    public function updateProduct($id)
    {
        try{
            $this->conn->beginTransaction();
            $this->updateProductTable($id);

            if(!empty($_POST['wine_description'][1])){
                $this->update_description('product',$id);
            }
            $this->conn->commit();
        }catch (\Exception $e){
            $this->conn->rollBack();
            echo 'Ошибка' . $e;
        }

    }

    public function updateProductTable($id){
        $fields = '';
        $this->uploadImg();
        $product = $this->attributes;
        unset($product['product_description']);
        if(!empty($_POST['wine_description']))  unset($product['wine_description']);

        foreach ($product as $k=>$v){
            $fields .= $k . '=' . ":{$k},";
        }
        $fields = rtrim($fields,',');

        $stmt = $this->conn->prepare("UPDATE product SET $fields WHERE id = :id");
        $product['id'] = $id;
        $stmt->execute($product);

    }


}