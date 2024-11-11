<div class="personal personal__credentials">
    <div class="container">
        <div class="col-12">
            <h1 class="section-title personal__title"><?php __('credential_update_title'); ?></h1>
            <h3><?php if(!empty($_SESSION['errors'])) echo $_SESSION['errors'];unset($_SESSION['errors'])?></h3>
        </div>
        <div class="personal__content">
            <?php $this->getPart('parts/cabinet_sidebar'); ?>
            <div class="personal__user-credentials">
                <div class="col-md-9 order-md-1">
                        <form action="/credential/update" method="POST">
                            <div class="table-responsive">
                                <table class="table text-start table-bordered border-dark credential__table">
                                    <tbody>
                                    <tr>
                                        <th ><?php __('credential_update_email'); ?></th>
                                        <td><input class="credential__table-input" type="text" value="<?=$_SESSION['user']['email']?>" name="email" required></td>
                                    </tr>
                                    <tr>
                                        <th><?php __('credential_update_name'); ?></th>
                                        <td><input class="credential__table-input" type="text" value="<?=$_SESSION['user']['name']?>" name="name" required></td>
                                    </tr>
                                    <tr>
                                        <th><?php __('credential_update_address'); ?></th>
                                        <td><textarea class="credential__table-textarea"  name="address" required><?=$_SESSION['user']['address']?></textarea></td>
                                    </tr>
                                    <tr class="credential__table-col">
                                        <th  colspan="2"><button class="credential__table-btn" type="submit"><?php __('credential_update_save'); ?></button></th>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelector('.header').classList.add("header-products")
    document.querySelector('.header__btn').classList.add('hidden')
</script>
