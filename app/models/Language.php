<?php

namespace app\models;

class Language extends AppModel
{
    public function getLangs(){
        $stmt = $this->conn->prepare("SELECT * FROM `language` ORDER BY base DESC");
        $stmt->execute();
        return $langs = $stmt->fetchAll();
    }

}