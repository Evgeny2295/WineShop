<?php

namespace app\models;

use core\Model;

class AppModel extends Model
{

    public function get($data)
    {

        $table = $data['table'];
        $join = '';
        $where = '';
        $limit = '';
        $orderBy = '';
        $exec = [];
        $like = '';
        if(!empty($data['join'])){

            $join = "JOIN {$data['join']['table']} ON {$data['join']['on']}";
            if(!empty($data['join']['join_table'])){
                $join .=" JOIN {$data['join']['join_table']['table']} ON {$data['join']['join_table']['on']}";
            }
        }
        if(!empty($data['where'])){
            $where = 'WHERE ';
            foreach ($data['where'] as $key=>$value){

                $keyExec = preg_replace('#[a-zA-z]+\.#','',$key);

                $where .= $key . "=:$keyExec AND ";

                $exec[$keyExec] = $value;
            }

            $where = substr($where,0,strrpos($where,'AND'));

        }
        if(!empty($data['limit'])){
            $limit = $data['limit'][0];
        }
        if(!empty($data['orderBy'])){
            $orderBy = $data['orderBy'];
        }

        if(!empty($data['like'])){
            if(!empty($where)) $like = "AND " .$data['like']['query'];
                else $like = "WHERE {$data['like']['query']}";

                $exec[$data['like']['keyExec']] = $data['like']['exec'];
        }

        if(empty($data['count'])){
            $stmt = $this->conn->prepare("SELECT * FROM $table $join $where $like $orderBy $limit");
        }else{
            $stmt = $this->conn->prepare("SELECT COUNT(*) FROM $table $join $where $like $orderBy $limit");

        }

        $stmt->execute($exec);
        if(empty($data['count'])){
            return $stmt->fetchAll();
        }else{
            return $stmt->fetch()['COUNT(*)'];
        }

    }


}