<?php

namespace core;

use Valitron\Validator;

abstract class Model
{

    public array $attributes = [];
    public array $errors = [];
    public array $rules = [];
    public array $labels = [];
    protected $conn;

    public function __construct(){
        $this->conn = Db::getInstance()->conn;
    }
    public function load($post = true)
    {
        $data = $post ? $_POST : $_GET;

        if(!empty($_FILES['img']) && !empty($_FILES['img']['name'])) $data['img'] = $_FILES['img'];


        foreach ($this->attributes as $name => $value) {
            if (isset($data[$name])) {
                $this->attributes[$name] = $data[$name];
            }
        }

    }

    public function validate($data)
    {
        Validator::langDir(APP . '/languages/validator/lang');
        Validator::lang(App::$app->getProperty('language')['code']);
        $validator = new Validator($data);
        $validator->rules($this->rules);
        $validator->labels($this->getLabels());
        if($validator->validate()){
            return true;
        }else{
            $this->errors=$validator->errors();
            return false;
        }

    }

    public function getErrors()
    {
        if(!empty($this->errors)){
            $errors = '<ul>';
            $allErrors = array_unique($this->errors);
            foreach ($allErrors as $error){
                if(is_array($error)){
                    foreach ($error as $item){

                        $errors .= "<li>{$item}</li>";
                    }
                }else{
                    $errors .= "<li>{$error}</li>";
                }

            }
            $errors .= '</ul>';

            $_SESSION['errors'] = $errors;
        }

    }

    public function getLabels(): array
    {
        $labels = [];

        foreach($this->labels as $k=>$v){
            $labels[$k] = ___($v);
        }
        return $labels;
    }

    public function save($table): int|string
    {
        $fields = '(';
        $values = '(';
        $data = [];
        foreach ($this->attributes as $name=>$value){
            $fields .= $name . ',';
        }
        $fields =rtrim($fields,',');
        $fields .= ')';

        foreach ($this->attributes as $name=>$value){
            $values .= ":$name,";
        }
        $values =rtrim($values,',');
        $values .= ')';

        $sql = "INSERT INTO $table $fields VALUES $values";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute($this->attributes);

        return $this->conn->lastInsertId();
    }

    public function update($table,$id): int|string
    {
        $fields = '';
        $exec = [];


        foreach ($this->attributes as $name=>$value){
            if(!empty($value)){
                $fields .= $name . '=' . ':' . $name . ',' ;
                $exec[$name] =  $value;
            }

        }

        $stmt = $this->conn->prepare("UPDATE users SET {$fields}");

        $id = $stmt->execute([$exec]);


    }

    public function getAll($table,$params = [],$condition = [],$orderName = null,$order = null): array
    {
        $fields = '*';
        $where = '';
        $execute = '';
        $firstWord = '';
        if(!empty($params)){

            $fields = '';
            foreach ($params as $key=>$param)
            {
                $fields.= $table . '.' . $param . ',';

            }
            $fields = rtrim($fields,',');
        }

        if(!empty($condition)) {
          $where = 'WHERE ';
            $execute = [];
          foreach ($condition as $key=>$cond) {
              $where .= $key . '=' . ':'.$key . ' ' . 'AND' . ' ';
              $execute[$key] = $cond;
          }
            $where = (array_filter(explode(' ',$where)));
            array_pop($where);
            $where = implode(' ',$where);


        }

        if(!empty($execute['language_id'])){
            $firstWord = substr($table,0,1);
            $join = " JOIN {$table}_description {$firstWord}d ON $firstWord.id = {$firstWord}d.{$table}_id ";
        }


        if(!empty($orderName)){
            $orderQuery = "ORDER BY $orderName ";

            if(!empty($order)){
                $orderQuery .= $order;
            }else{
                $orderQuery .= 'ASC';
            }

        }

       $stmt = $this->conn->prepare("SELECT {$fields} FROM $table $firstWord $join $where");

        $stmt->execute($execute);
    }




}