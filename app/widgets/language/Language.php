<?php

namespace app\widgets\language;

use core\App;

class Language
{

    protected $tpl;
    protected $languages;
    protected $language;

    public function __construct(){
        $this->tpl = __DIR__ . '/language_tpl.php';
        $this->run();
    }

    protected function run(){
        $this->languages = App::$app->getProperty('languages');
        $this->language = App::$app->getProperty('language');
        echo $this->getHtml();
    }

    public static function getLanguages(): array
    {
        $languageModel = new \app\models\Language();
        $langs = $languageModel->getLangs();

        $languages = [];
        foreach ($langs as $key=>$lang){
            $languages[$lang['code']] = $lang;
        }
        return $languages;
    }
    public static function getLanguage($langs)
    {

        $lang = App::$app->getProperty('lang');

        if($lang && array_key_exists($lang,$langs)){
            $key = $lang;
        }elseif(!$lang){
            $key = key($langs);
        }else{
            $lang = h($lang);
            throw new \Exception("Not found lang {$lang}",404);
        }
        return  $langs[$key];
    }
    protected function getHtml(){
        ob_start();
        require_once $this->tpl;
        return ob_get_clean();
    }
}