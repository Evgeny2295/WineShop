<?php $categories = \core\App::$app->getProperty('categories')?>
<main class="main main-products">
    <section class="main__block">
        <div class="container">
            <div class="main__block-row">
                <div class="main__navbar">
                    <ul class="main__navbar-list">
                        <?php foreach ($categories as $cat):?>
                            <li class="main__navbar-item"><a href="#"><?=$cat['title']?></a><span class="main__navbar-item-qty">2</span></li>
                        <?php endforeach?>
                    </ul>
                </div>
                <div class="main__content">
                    <div><h1 class="title">Понравившиеся товары</h1></div>
                    <div class="main__goods">
                        <?php if(!empty($products)):?>
                            <?php foreach ($products as $product):?>
                                <div class="main__product">
                                    <a class="main__product-link"><img src="<?= PATH . $product['img']?>" class="main__product-img" alt=""></a>
                                    <a class="main__product-link"><h2 class="main__product-title"><?=$product['title']?></h2></a>
                                    <div class="main__product-description">
                                        <p>Крепость:<?=$product['strength']?></p>
                                        <p>Емкость:<?=$product['capacity']?></p>
                                        <p>Страна:<?=$product['country']?></p>
                                    </div>
                                    <div class="main__product-rating">
                                        <div class="main__product-rating-price"><?=$product['price']?></div>
                                        <div class="main__product-rating-price"><?=$product['old_price']?></div>
                                        <div class="main__product-rating-stars"></div>
                                    </div>
                                    <div class="main__product-cart">
                                        <div class="main__product-cart-qty">
                                            <button type="button" class="main__product-qty-minus"></button>
                                            <span class="main__product-qty">1</span>
                                            <button type="button" class="main__product-qty-plus"></button>
                                        </div>
                                        <div class="main__product-addtocart">
                                            <a href="cart/addtocart" class="main__product-addtocart-link">В корзину</a>
                                        </div>
                                        <div class="main__product-wishlist">
                                            <a href="<?=PATH?>/wishlist/delete?id=<?=$product['id']?>" data-id="<?=$product['id']?>"class="main__product-wishlist-delete-link">Удалить</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach?>


                        <?php else:?>
                            <p>Нет понравившихся товаров</p>
                        <?php endif?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script>
    document.querySelector('.header').classList.add("header-products")
    document.querySelector('.header__btn').classList.add('hidden')
</script>