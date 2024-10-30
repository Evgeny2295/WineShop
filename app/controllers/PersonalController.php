<?php

namespace app\controllers;

use app\models\User;
use core\App;
use core\Controller;
use core\Pagination;

class PersonalController extends AppController
{






    public function credentialsAction()
    {
        if(!User::checkAuth()){
            redirect(base_url().'user/login');
        }


    }

}