<?php $categories = \core\App::$app->getProperty('categories')?>
<main class="main main-products">
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
                    <div><h1 class="title">Понравившиеся товары</h1></div>
                    <div class="main__goods">
                        <?php if(!empty($products)):?>
                            <?php foreach ($products as $product):?>
                                <div class="main__product">
                                    <a href="product/<?=$product['slug']?>" class="main__product-link">
                                        <img src="<?= PATH . $product['img']?>" class="main__product-img" alt="">
                                        <div class="main__product-wishlist">
                                            <a href="<?=PATH?>/wishlist/add?id=<?=$product['id']?>" data-id="<?=$product['id']?>"class="main__product-wishlist-add-link"><i class="far fa-heart"></i></a>
                                        </div>
                                        <h2 class="main__product-title"><?=$product['title']?></h2>
                                    </a>
                                    <div class="main__product-description">
                                        <p class="main__product-description-text"><span class="main__product-text main__product-text--bold"><?php __('wishlist_view_strength')?>:</span><?=$product['strength']?></p>
                                        <p class="main__product-description-text"><span class="main__product-text main__product-text--bold"><?php __('wishlist_view_capacity')?>:</span><?=$product['capacity']?></p>
                                        <p class="main__product-description-text"><span class="main__product-text main__product-text--bold"><?php __('wishlist_view_country')?>:</span><?=$product['country']?></p>
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
                                                    <?php __(    'wishlist_view_add_to_cart')?> <i class="fas fa-cart-plus"></i>
                                                </button>
                                            </div>
                                        </form>
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