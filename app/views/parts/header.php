<?php
/**@var $categories Category*/
$categories = \core\App::$app->getProperty('categories');

?>
<!doctype html>
<html lang="en">
<head>
    <base href="<?=base_url()?>">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php PATH?>/assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="<?php PATH?>/assets/css/style.css">
    <link rel="stylesheet" href="<?php PATH?>/assets/css/product.css">
    <link rel="stylesheet" href="<?php PATH?>/assets/css/user.css">
    <title>Document</title>
</head>
<body>
<header class="header">
    <div class="container">
        <div class="header__block">
            <a href="<?=base_url()?>"><img style="width: 50px;height: 50px" src="<?php PATH?>/uploads/logo.png" alt=""></a>
            <p class="header__block-address"> <?php __('tpl_header_address')?></p>
            <div class="header__block-button">
                <div class="header__search">
                    <button class="header__search-icon" onclick="search()"><i class="fas fa-search"></i></button>
                    <div class="header__search-form" >
                        <form action="/search" >
                            <input class="header__search-input" type="text" name="s" placeholder="Поиск">
                            <button type="button" class="header__search-close" onclick="search()"><i class="fas fa-times"></i></i></button>
                            <button type="submit" class="header__search-btn"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                </div>
                <div class="header__wishlist">
                    <a href="wishlist"><i class="far fa-heart"></i></a>
                </div>
                <div class="dropdown d-inline-block">
                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="far fa-user"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if(empty($_SESSION['user'])):?>
                            <li><a class="dropdown-item" href="user/login"><?=___('tpl_login')?></a></li>
                            <li><a class="dropdown-item" href="user/signup"><?=___('tpl_signup')?></a></li>
                        <?php else:?>
                            <li><a class="dropdown-item" href="orders"><?=___('tpl_cabinet')?></a></li>
                            <li><a class="dropdown-item" href="user/logout"><?=___('tpl_logout')?></a></li>
                        <?php endif?>
                    </ul>
                </div>
                <div class="header__cart">
                    <a href="#"  id="get-cart" class="relative" data-bs-toggle="modal" data-bs-target="#cart-modal">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="badge bg-danger rounded-pill count-items"><?=$_SESSION['cart.qty'] ?? 0?></span>
                    </a>
                </div>
            </div>
            <p class="header__block-phone">8 (800) 900-90-90</p>
            <div class="header__language">
                <?php new \app\widgets\language\Language()?>
            </div>
        </div>
        <nav class="header__menu">
            <table class="header__menu-table">
                <tr class="header__menu-row">
                    <td class="header__menu-column header__menu-column-catalog">
                        <button class="header__menu-catalog" onclick="showCatalogList()">
                            <?php __('tpl_header_catalog')?>
                        </button>
                        <ul class="header__menu-catalog-dropdown" style="display: none">
                            <?php foreach ($categories as $category):?>
                                <li class="header__menu-catalog-item"><a href="category/<?=$category['category_title']?>"><?=$category['title']?></a></li>
                            <?php endforeach;?>
                        </ul>
                    </td>
                    <td class="header__menu-column">
                        <a href="#" class="header__menu-link"><?php __('tpl_header_delivery')?></a>
                    </td>
                    <td class="header__menu-column">
                        <a href="#" class="header__menu-link"><?php __('tpl_header_collection')?></a>
                    </td>
                    <td class="header__menu-column">
                        <a href="#" class="header__menu-link"><?php __('tpl_header_contacts')?></a>
                    </td>
                </tr>
            </table>
        </nav>
        <div class="header__btn">
            <a href="" class="btn btn--green header__btn-link">ВИННАЯ КАРТА</a>
            <a href="" class="btn btn--green header__btn-link">ДЕГУСТАЦИЯ</a>
        </div>
    </div>
</header>