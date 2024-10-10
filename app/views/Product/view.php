<?php
/** @var $product*/
/** @var $similarProducts*/
?>
<?php $categories = \core\App::$app->getProperty('categories')?>
<div id="main-block">
    <main class="main main-products">
        <section class="main__breadcrumbs">
            <div class="container">
                <ul class="main__breadcrumbs-list">
                    <li class="main__breadcrumbs-item"><a href="#">Главная</a></li>
                    <li class="main__breadcrumbs-item"><?=$product['title']?></li>
                </ul>
            </div>
        </section>
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
                        <?php if(!empty($product)):?>
                            <div class="main__product">
                                <a href="product/<?=$product['slug']?>" class="main__product-link"><img src="<?= PATH . $product['img']?>" class="main__product-img" alt=""></a>
                                <a class="main__product-link"><h2 class="main__product-title"><?=$product['title']?></h2></a>
                                <div class="main__product-description">
                                    <p>Крепость:<?=$product['strength']?></p>
                                    <p>Емкость:<?=$product['capacity']?></p>
                                    <p>Страна:<?=$product['country']?></p>
                                    <?php if(!empty($product_wine)):?>
                                        <p>Производитель:<?=$product_wine['manufacture']?></p>
                                        <p>Сорт винограда:<?=$product_wine['sort_grap']?></p>
                                        <p>Цвет:<?=$product_wine['color']?></p>
                                        <p>Сахар:<?=$product_wine['sugar']?></p>
                                    <?php endif;?>
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
                                            <button type="submit" class="main__product-addtocart-link" data-id="<?=$product['id']?>">В корзину</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="main__product-wishlist">
                                    <a href="<?=PATH?>/wishlist/add?id=<?=$product['id']?>" data-id="<?=$product['id']?>"class="main__product-wishlist-add-link"><i class="far fa-heart"></i></a>
                                </div>
                            </div>
                        <?php else:?>
                            <p>Такой продукт отсутстует</p>
                        <?php endif?>
                            <div>
                                <h3></h3>Вам также могут понравиться:
                                <div class="main__similar-products">
                                    <?php foreach ($similarProducts as $item):?>
                                    <div class="main__similar-one-product">
                                        <a href="product/<?=$item['slug']?>"><img src="<?=PATH . $item['img']?>" alt=""></a>
                                        <h4><?=$item['title']?></h4>
                                        <h4>Страна: <?=$item['country']?></h4>
                                        <p>Емкость: <?=$item['capacity']?></p>
                                        <p><?=$item['price']?></p>
                                        <?php if(!empty($item['old_price'])):?>
                                            <del><p><?=$item['old_price']?></p></del>
                                        <?php endif?>
                                    </div>
                                    <?php endforeach;?>
                                </div>
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
</script>
