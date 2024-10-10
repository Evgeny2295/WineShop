<?php

namespace app\controllers;

use core\App;

class LanguageController extends AppController
{

    public function changeAction(){
        $language = get('lang','s');

        if($language){

            if(array_key_exists($language,App::$app->getProperty('languages'))){
                //отрезаем базовый URL
                $url = trim(str_replace(PATH,'',$_SERVER['HTTP_REFERER']),'/');

                //разбиваем на 2 части.. 1-я часть - возможный бывший язык

                $url_parts = explode('/',$url,2);

               if(array_key_exists($url_parts[0],App::$app->getProperty('languages'))){
                   //Присваиваем первой части новый язк, если он не является базовым
                   if($language != App::$app->getProperty('language')['code']){
                       $url_parts[0] = $language;
                   }else{

                       //если это базовый язык --- удалим язык из url
                       array_shift($url_parts);
                   }
               }else{
                   //присваиваем первой части новый язык, если он не является базовым
                   if($language != App::$app->getProperty('language')['code']){
                       array_unshift($url_parts,$language);
                   }
               }
               $url = PATH . '/' . implode('/',$url_parts);
               redirect($url);
            }
        }
        redirect();
    }
}