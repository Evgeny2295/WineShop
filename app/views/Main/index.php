<?php /**@var $page*/?>
<main class="main">
    <section class="main-quote">
        <div class="container">
            <div class="main-quote__block">
                <h2 class="title main-quote__title"><?=$page['title_quote']?></h2>
                <span class="main-quote__line"></span>
                <p class="main-quote__text">
                    <?=$page['description_quote']?>                </p>
                <div class="main-quote__img">
                    <img src="<?php PATH?>/assets/img/image.png" class="main-quote__image" alt="glass">
                </div>
            </div>
        </div>
    </section>
    <section class="new-collections">
        <div class="container">
            <div class="new-collections__info">
                <div class="new-collections__content">
                    <p class="new-collections__name">Новинки коллекций</p>
                    <h2 class="title new-collections__title">Март 1980 Урожай Марселя</h2>
                    <span class="new-collections__line"></span>
                    <p class="new-collections__text">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Feugiat enim tortor in hac id imperdiet adipiscing. Pellentesque nisi, mi sit non sit sed fermentum. Felis adipiscing morbi sodales ac.
                    </p>
                    <table class="new-collections__table">
                        <tr class="new-collections__row">
                            <td class="new-collections__column">1980</td>
                            <td class="new-collections__column "> <span class="new-collections__column-title">Colli Euganei Bianco Ca' Lustra 1980 </span><br>Красочная бутылка вина из Марселя</td>
                        </tr>
                        <tr class="new-collections__row">
                            <td class="new-collections__column">1980</td>
                            <td class="new-collections__column"><span class="new-collections__column-title">Colli Euganei Bianco Ca' Lustra 1980 </span> <br>Красочная бутылка вина из Марселя</td>
                        </tr>
                        <tr class="new-collections__row">
                            <td class="new-collections__column">1980</td>
                            <td class="new-collections__column"><span class="new-collections__column-title">Colli Euganei Bianco Ca' Lustra 1980 </span><br>Красочная бутылка вина из Марселя</td>
                        </tr>
                    </table>
                    <p class="new-collections__text">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Feugiat enim tortor in hac id imperdiet adipiscing. Pellentesque nisi, mi sit non sit sed fermentum. Felis adipiscing morbi sodales ac.
                    </p>
                    <div class="btn btn--green new-collections__btn">
                        <a href="" class="new-collection__link">Узнать подробнее</a>
                    </div>
                </div>
                <div class="new-collections__content-images">
                    <div class="new-collections__main-img">
                        <img src="<?php PATH?>/assets/img/main.jpeg" alt="Бокал">
                    </div>
                    <div class="new-collections__images">
                        <div class="new-collections__img">
                            <img src="<?php PATH?>/assets/img/img_1.jpeg" alt="Бокалы">
                        </div>
                        <div class="new-collections__img">
                            <img src="<?php PATH?>/assets/img/img_2.jpeg" alt="Бокалы">
                        </div>
                    </div>
                </div>
                <span class="new-collections__main-line"></span>
            </div>
        </div>
    </section>
    <section class="record-testing">
        <div class="container">
            <div class="record-testing__info">
                <h2 class="title record-testing__title">Запись на дегустацию</h2>
                <span class="record-testing__line"></span>
                <div class="record-testing__description">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Feugiat enim tortor in hac id imperdiet adipiscing. Pellentesque nisi, mi sit non sit sed fermentum.
                </div>
                <form action="">
                    <div class="record-testing__form">
                        <div class="record-testing__form-row">
                            <input type="text" class="record-testing__input" placeholder="Имя">
                            <input type="number" class="record-testing__input" placeholder="Телефон">
                        </div>
                        <input type="address" class="record-testing__input" placeholder="Адрес">
                    </div>
                    <button type="submit" class="btn record-testing__btn">
                        Записаться
                    </button>
                </form>
            </div>
        </div>
    </section>
</main>

