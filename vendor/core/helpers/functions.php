<?php

function debug($data,$die = false){

    echo '<pre>' . print_r($data,1) . '</pre>';

    if($die){
        die;
    }

}

function h($str){
    return htmlspecialchars($str);
}
function redirect($http = false){
    if($http){
        $redirect = $http;
    }else{
        $redirect = $_SERVER['HTTP_REFERER'] ?? PATH;
    }
    header("Location: $redirect");
    die;
}

function base_url(){
    if(core\App::$app->getProperty('language')['code'] !== 'ru'){
        return PATH . '/' . (\core\App::$app->getProperty('language')['code']).'/';
    }elseif (\core\App::$app->getProperty('language')['code'] == 'ru'){
        return '/';
    } else{
        return '';
    }
}

/**
 * @param string $key Key of GET array
 * @param string $type Values 'i,'f,'s'
 * @return float|int|string
*/
function get($key,$type = 'i')
{
    $param = $key;
    $$param = $_GET[$param] ?? '';  //$key = 'page' ; $param = 'page'; $page = $_GET['page']

    if($type == 'i' && (!empty($$param) || $$param == 0)){
        return (int)$$param;
    }elseif($type == 'f'){
        return (float)$$param;
    }else{
        return trim($$param);
    }
}

/**
 * @param string $key Key of GET array
 * @param string $type Values 'i,'f,'s'
 * @return float|int|string
 */
function post($key,$type = 's')
{
    $param = $key;
    $$param = $_POST[$param] ?? '';  //$key = 'page' ; $param = 'page'; $page = $_GET['page']
    if($type == 'i'){
        return (int)$$param;
    }elseif($type == 'f'){
        return (float)$$param;
    }else{
        return trim($$param);
    }
}

function __($key){
    
    echo \core\Language::get($key);
}
function ___($key){
    return \core\Language::get($key);
}

function get_cart_icon($id){
    if(!empty($_SESSION['cart']) && array_key_exists($id,$_SESSION['cart'])){
        $icon = '<i class="fas fa-cart-plus"></i>';
    }else{
        $icon = '<i class="fas fa-shopping-cart"></i>';
    }

    return $icon;
}

function get_field_value($name){
    
    return isset($_SESSION['form_data'][$name]) ? h($_SESSION['form_data'][$name]) : '';
}
function get_field_array_value($name,$key,$index){

    return isset($_SESSION['form_data'][$name][$key][$index]) ? h($_SESSION['form_data'][$name][$key][$index]) : '';
}