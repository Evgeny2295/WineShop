<?php

namespace app\models;

class Search extends AppModel
{
    public function getTotalFindProducts($s)
    {
        $stmt = $this->conn->prepare('SELECT COUNT(id) FROM product p JOIN product_description pd 
                                            ON p.id=pd.product_id WHERE slug LIKE ?');
        $stmt->execute(["%{$s}%"]);
        return $stmt->fetch()["COUNT(id)"];
    }

    public function getFindProducts($s,$lang,$start,$perpage): array
    {
        $stmt = $this->conn->prepare("SELECT p.*,pd.* FROM product p JOIN 
                                    product_description pd ON p.id=pd.product_id WHERE p.status =1 AND pd.language_id=? AND p.slug LIKE ? LIMIT $start,$perpage");
        $stmt->execute([$lang['id'],"%{$s}%"]);
        return $stmt->fetchAll();
    }

}