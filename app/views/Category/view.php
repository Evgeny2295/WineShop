
<?php $categories = \core\App::$app->getProperty('categories')?>
<div id="main-block">
    <main class="main main-products">
        <section class="main__block">
            <div class="container">
                <div class="main__breadcrumbs">
                    <ul class="main__breadcrumbs-list">
                        <li class="main__breadcrumbs-item"><a href="/"><?php __('tpl_main')?></a></li>
                        <li class="main__breadcrumbs-item"><a href="#"><?php __('tpl_header_catalog')?></a></li>
                        <li class="main__breadcrumbs-item"><?=$category['title']?></li>
                    </ul>
                </div>
                <div class="main__block-row">
                    <div class="main__navbar">
                        <ul class="main__navbar-list">
                            <?php foreach ($categories as $cat):?>
                                <li class="main__navbar-item"><a href="#" class="main__navbar-link"><?=$cat['title']?></a><span class="main__navbar-item-qty"><?=$cat['count']?></span></li>
                            <?php endforeach?>
                        </ul>
                    </div>
                    <div class="main__content">
                        <h1 class="title main__content-title">
                            <?=$category['title']?>
                        </h1>
                        <p class="main__content-description">
                            <?=$category['description']?>
                        </p>
                        <div class="filters main__filters">
                            <div class="main__filters-location">
                                <button class="main__filters-location-btn main__filters-location-row" onclick="doRowGoods()"><i class="fas fa-list"></i></button>
                                <button class="main__filters-location-btn main__filters-location-list" onclick="doColumnGoods()"><i class="fas fa-th-list"></i></button>
                            </div>
                            <div class="main__filters">
                                <div class="main__filters-location">
                                    <a href="category/<?=$category['slug']?>?sort=price&order=ASC"
                                       class="main__filters-location-butt main__filters-location-row" data-alias="<?=$category['slug']?>" data-name="price" data-order="ASC"><i class="fas fa-list"></i>
                                    </a>
                                    <a href="category/<?=$category['slug']?>?sort=price&order=DESC"
                                       class="main__filters-location-butt main__filters-location-row" data-alias="<?=$category['slug']?>" data-name="price" data-order="DESC"><i class="fas fa-th-list"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="main__goods">
                            <?php if(!empty($products)):?>
                                <?php foreach ($products as $product):?>
                                    <div class="main__product">

                                        <a href="product/<?=$product['slug']?>" class="main__product-link"><img src="<?= PATH . $product['img']?>" class="main__product-img" alt=""></a>
                                        <a class="main__product-link"><h2 class="main__product-title"><?=$product['title']?></h2></a>
                                        <div class="main__product-description">
                                            <p><?php __('category_view_strength')?>:<?=$product['strength']?></p>
                                            <p><?php __('category_view_capacity')?>:<?=$product['capacity']?></p>
                                            <p><?php __('category_view_country')?>:<?=$product['country']?></p>
                                        </div>
                                        <div class="main__product-rating">
                                            <div class="main__product-rating-price"><?=$product['price']?></div>
                                            <div class="main__product-rating-price"><?=$product['old_price']?></div>
                                            <div class="main__product-rating-stars"></div>
                                        </div>
                                        <div class="main__product-cart">
                                            <form action="/cart/add" method="post">
                                                <div class="main__product-qty">
                                                    <input class="main_product-input-qtu" type="number" name="qty" value="1">
                                                </div>
                                                <div class="main__product-cart-qty">
                                                    <button type="button" class="main__product-qty-minus"></button>
                                                    <span class="main__product-qty">1</span>
                                                    <button type="button" class="main__product-qty-plus"></button>
                                                </div>
                                                <div class="main__product-addtocart">
                                                    <input type="hidden" name="id" value="<?=$product['id']?>">
                                                    <button type="submit" class="main__product-addtocart-link" data-id="<?=$product['id']?>">
                                                        <?php __(    'category_view_add_to_cart')?>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="main__product-wishlist">
                                            <a href="<?=PATH?>/wishlist/add?id=<?=$product['id']?>" data-id="<?=$product['id']?>"class="main__product-wishlist-add-link"><i class="far fa-heart"></i></a>
                                        </div>
                                    </div>
                                <?php endforeach?>


                            <?php else:?>
                                <p>Категория пуста</p>
                            <?php endif?>
                        </div>
                        <div>
                            <?php if ($pagination->countPages > 1): ?>
                                <?= $pagination ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
<script>
    document.querySelector('.header').classList.add("header-products")
   document.querySelector('.header__btn').classList.add('hidden')
    document.querySelector('.header__menu-catalog-dropdown').classList.add('header__menu-catalog-dropdown--dark')
</script>
