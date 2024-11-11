<?php

namespace app\models;

class Credential extends AppModel
{
    public array $attributes = [
        'email'=>'',
        'name'=>'',
        'address'=>'',

    ];
    public array $rules = [
        'required'=>['email','name','address'],
    ];
}