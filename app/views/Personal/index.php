<div class="personal">
    <div class="container">
        <div class="col-12">
            <h1 class="section-title cabinet__title"><?php __('tpl_cabinet'); ?></h1>
        </div>
        <?php $this->getPart('parts/cabinet_sidebar'); ?>
    </div>
</div>
<script>
    document.querySelector('.header').classList.add("header-products")
    document.querySelector('.header__btn').classList.add('hidden')
</script>
