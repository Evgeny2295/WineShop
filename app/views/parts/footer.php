<footer id="footer">
    <div class="container">
        <span class="footer-line"></span>
        <ul class="footer__list">
            <li class="footer__item"><a href="" class="footer__link">Главная</a></li>
            <li class="footer__item"><a href="" class="footer__link">Каталог</a></li>
            <li class="footer__item"><a href="" class="footer__link">Поставщики</a></li>
            <li class="footer__item"><a href="" class="footer__link">Коллекции</a></li>
            <li class="footer__item"><a href="" class="footer__link">Дегустация</a></li>
            <li class="footer__item"><a href="" class="footer__link">Коллекции 2024</a></li>
            <li class="footer__item"><a href="" class="footer__link">Контакты</a></li>
        </ul>
        <table class="footer__table">
            <tboody>
                <tr>
                    <td>Винный бутик</td>
                </tr>
                <tr>
                    <td>8(812)123-45-67</td>
                </tr>
                <tr>
                    <td><img src="<?php PATH?>/assets/img/youtube.png" alt=""></td>
                    <td><img src="<?php PATH?>/assets/img/facebook.png" alt=""></td>
                    <td><img src="<?php PATH?>/assets/img/vk.png" alt=""></td>
                </tr>
                <tr>
                    <td>© le-corte.ru</td>
                </tr>
            </tboody>
        </table>
    </div>
</footer>

<div class="modal fade" id="cart-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php __('tpl_cart_title')?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-cart-content">

            </div>
        </div>
    </div>
</div>

<script>
    const PATH = '<?=PATH?>';
</script>
<script src="<?php PATH?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php PATH?>/assets/js/jquery.magnific-popup.min.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>
<script src="<?php PATH?>/assets/js/main.js"></script>
</body>
</html>