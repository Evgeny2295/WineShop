<div class="personal personal__credentials">
    <div class="container">
        <div class="col-12">
            <h1 class="section-title personal__title"><?php __('credential_user_title'); ?></h1>
        </div>
        <div class="personal__content">
            <?php $this->getPart('parts/cabinet_sidebar'); ?>
            <div class="personal__user-credentials">
                <div class="col-md-9 order-md-1">
                    <?php if (!empty($_SESSION['user'])): ?>

                        <div class="table-responsive">
                            <table class="table text-start table-bordered border-dark credential__table">
                                <tbody>
                                <tr>
                                    <th scope="col"><?php __('credential_index_email'); ?></th>
                                    <th scope="col"><?=$_SESSION['user']['email']?></th>
                                </tr>
                                <tr>
                                    <th scope="col"><?php __('credential_index_name'); ?></th>
                                    <th scope="col"><?=$_SESSION['user']['name']?></th>
                                </tr>
                                <tr>
                                    <th scope="col"><?php __('credential_index_address'); ?></th>
                                    <th scope="col"><?=$_SESSION['user']['address']?></th>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <h3 class="personal__orders-title"><?php __('user_orders_empty'); ?></h3>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelector('.header').classList.add("header-products")
    document.querySelector('.header__btn').classList.add('hidden')
</script>
