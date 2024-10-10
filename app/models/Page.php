<?php

namespace app\models;

class Page extends AppModel
{

    public function getPage($language_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM page WHERE language_id = :language_id");

        $stmt->execute(['language_id'=>$language_id]);
        return $stmt->fetch();
    }
}