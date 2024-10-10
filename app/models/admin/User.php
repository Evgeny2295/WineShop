<?php

namespace app\models\admin;

class User extends \app\models\User
{

    public array $attributes = [
        'email' => '',
        'password' => '',
        'name' => '',
        'address' => '',
        'role'=>''
    ];

    public array $rules = [
        'required'=>['email','name','address','role'],
        'email'=>['email'],
        'lengthMin'=>[
            ['password',6]
        ],
        'optional'=>['password']

    ];

    public array $labels = [
        'email' => 'tpl_signup_email_input',
        'password' => 'tpl_signup_password_input',
        'name' => 'tpl_signup_name_input',
        'address' => 'tpl_signup_address_input',
    ];


    public static function isAdmin(): bool
    {
        return (isset($_SESSION['user']) &&($_SESSION['user']['role']) == 'admin');
    }

    public function getUsers($start,$perpage)
    {
        $stmt = $this->conn->prepare("SELECT * FROM user LIMIT $start,$perpage");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getUser($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE id=:id");
        $stmt->execute(['id'=>$id]);
        return $stmt->fetch();
    }

    public function updateUser($id)
    {
        $fields = '';


        $user = array_filter($this->attributes,function ($element){
          return $element !== '';
        });

        foreach ($user as $k=>$v){
            $fields .= $k . '=' . ":{$k},";
        }

        $fields = rtrim($fields,',');

        $stmt = $this->conn->prepare("UPDATE user SET $fields WHERE id = :id");
        $user['id'] = $id;

        $stmt->execute($user);

        return true;
    }
}