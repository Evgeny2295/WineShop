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
                    <li class="main__breadcrumbs-item"><?=$product['title'] ?? ''?></li>
                </ul>
            </div>
        </section>
        <section class="main__block">
            <div class="container">
                <div class="main__block-row">
                    <div class="main__navbar">
                        <ul class="main__navbar-list">
                            <?php foreach ($categories as $cat):?>
                                <li class="main__navbar-item"><a href="category/<?=$cat['category_title']?>" class="main__navbar-link"><?=$cat['title']?></a><span class="main__navbar-item-qty"><?=$cat['count']?></span></li>
                            <?php endforeach?>
                        </ul>
                    </div>
                    <div class="main__content">
                        <?php if(!empty($product)):?>
                            <div class="main__product">
                                <p class="main__product-link"><img src="<?= PATH . $product['img']?>" class="main__product-img" alt=""></p>
                                <div class="main__product-wishlist">
                                    <p data-id="<?=$product['id']?>"class="main__product-wishlist-add-link"><i class="far fa-heart"></i></p>
                                </div>
                                <a class="main__product-link"><h2 class="main__product-title"><?=$product['title']?></h2></a>
                                <div class="main__product-description">
                                    <p class="main__product-description-text"><span class="main__product-text main__product-text--bold"><?php __('product_view_strength')?>:</span><?=$product['strength']?></p>
                                    <p class="main__product-description-text"><span class="main__product-text main__product-text--bold"><?php __('product_view_capacity')?>:</span><?=$product['capacity']?></p>
                                    <p class="main__product-description-text"><span class="main__product-text main__product-text--bold"><?php __('product_view_country')?>:</span><?=$product['country']?></p>
                                    <?php if(!empty($product_wine)):?>
                                        <p>Производитель:<?=$product_wine['manufacture']?></p>
                                        <p>Сорт винограда:<?=$product_wine['sort_grap']?></p>
                                        <p>Цвет:<?=$product_wine['color']?></p>
                                        <p>Сахар:<?=$product_wine['sugar']?></p>
                                    <?php endif;?>
                                </div>
                                <div class="main__product-rating">
                                    <div class="main__product-rating-price"><span class="main__product-text main__product-text--bold">Новая цена:</span><?=$product['price']?> Р</div>
                                    <div class="main__product-rating-price"><span class="main__product-text main__product-text--bold">Старая цена</span><del><?=$product['old_price']?> Р</del></div>
                                    <div class="main__product-rating-stars"></div>
                                </div>
                                <div class="main__product-cart">
                                    <form action="/cart/add" method="post">
                                        <div class="main__product-qty">
                                            <label for="main__product-input-qtu"><span class="main__product-text--bold">Выберите количество</span></label>
                                            <input id="main__product-input-qty" class="main__product-input-qty" type="number" name="qty" value="1">
                                        </div>
                                        <div class="main__product-addtocart">
                                            <input type="hidden" name="id" value="<?=$product['id']?>">
                                            <button type="submit" class="main__product-addtocart-link" data-id="<?=$product['id']?>">
                                                <?php __(    'product_view_add_to_cart')?> <i class="fas fa-cart-plus"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div>
                                <h3 class="product__similar-title">Вам также могут понравиться:</h3>
                                <div class="main__similar-products">
                                    <?php foreach ($similarProducts as $item):?>
                                        <div class="main__similar-one-product">
                                            <img src="<?=PATH . $item['img']?>" alt="">
                                            <h4><?=$item['title']?></h4>
                                            <h4><?php __('product_view_country')?>:<?=$item['country']?></h4>
                                            <p><?php __('product_view_capacity')?>: <?=$item['capacity']?></p>
                                            <p>Цена:<?=$item['price']?></p>
                                            <?php if(!empty($item['old_price'])):?>
                                                <del><p>Старая цена:<?=$item['old_price']?></p></del>
                                            <?php endif?>
                                        </div>
                                    <?php endforeach;?>
                                </div>
                            </div>
                        <?php else:?>
                            <div class="product__empty">
                                <p>Такой продукт отсутстует</p>
                            </div>
                        <?php endif?>

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
