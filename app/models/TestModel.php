<?php

namespace app\models;

class TestModel extends AppModel
{

    public function getWish($condition,$orderName = null,$order =null): array
    {
        return $this->getAll('wish',['id','key'],$condition,$orderName,$order);
    }

}