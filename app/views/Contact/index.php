<div id="main-block">
    <main class="main main-contacts">
        <section class="main__block">
            <div class="container">
                <div class="main__breadcrumbs">
                    <ul class="main__breadcrumbs-list">
                        <li class="main__breadcrumbs-item"><a href="/"><?php __('tpl_main')?></a></li>
                    </ul>
                </div>
                <div class="main__block-row">
                    <div class="main__content">
                        <h1 class="title main__content-title">
                            <?php __('contact_index_title')?>
                        </h1>
                        <div class="main__info">
                            <p class="main__info-address"><?php __('contact_index_address')?>:</p>
                            <p class="main__info-number"><?php __('contact_index_number')?>:</p>
                            <p class="main__info-email"><?php __('contact_index_email')?>:</p>
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
