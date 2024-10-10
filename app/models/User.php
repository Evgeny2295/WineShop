<?php

namespace app\models;

class User extends AppModel
{

    public array $attributes = [
        'email' => '',
        'password' => '',
        'name' => '',
        'address' => '',
    ];

    public array $rules = [
        'required'=>['email','name','password','address'],
        'email'=>['email'],
        'lengthMin'=>[
            ['password',6]
        ],
        'optional'=>['email','password']

    ];

    public array $labels = [
        'email' => 'tpl_signup_email_input',
        'password' => 'tpl_signup_password_input',
        'name' => 'tpl_signup_name_input',
        'address' => 'tpl_signup_address_input',
    ];

    public function login($is_admin = false): bool
    {
        $email = post('email');
        $password = post('password');

        if($email && $password){

            if($is_admin){
                $stmt = $this->conn->prepare("SELECT * FROM user WHERE email = :email AND role='admin'");
                $stmt->execute(['email'=>$email]);
                $user = $stmt->fetch();
            }else{
                $stmt = $this->conn->prepare("SELECT * FROM user WHERE email = :email");
                $stmt->execute(['email'=>$email]);
                $user = $stmt->fetch();
            }

            if($user){
                if(password_verify($password,$user['password'])){
                    foreach ($user as $k=>$v){
                        if($k != 'password'){
                            $_SESSION['user'][$k] = $v;
                        }
                    }
                    return true;
                }
            }
        }
        return false;
    }

    public static function checkAuth(): bool
    {
        return isset($_SESSION['user']);
    }

    public function load($post = true)
    {
        $data = $post ? $_POST : $_GET;
        foreach ($this->attributes as $name => $value) {
            if (isset($data[$name])) {
                $this->attributes[$name] = $data[$name];
            }
        }

    }

    public function checkUnique(): bool
    {
        $stmt = $this->conn->prepare("SELECT id FROM user WHERE email= :email");

        $stmt->execute(['email'=>$this->attributes['email']]);

        $user = $stmt->fetch();

        if(!empty($user)){

            $this->errors['unique'][] = ___('user_signup_error_email_unique');

            return false;
        }
        return true;
    }

    public function getCountUsers(): int
    {
        $stmt = $this->conn->prepare("SELECT count(*) FROM user");
        $stmt->execute();
        return $stmt->fetch()['count(*)'];
    }

}