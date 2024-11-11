<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item active"><?php __('tpl_signup'); ?></li>
        </ol>
    </nav>
</div>
<?php if(!empty($_SESSION['errors'])): ?>
<h2 style="color:#282828"><?=$_SESSION['errors'];unset($_SESSION['errors'])?></h2>
<?php endif?>
<div class="container py-3">
    <div class="row">

        <div class="col-lg-12 category-content">
            <h1 class="section-title"><?php __('tpl_signup'); ?></h1>

            <form lass="row g-3" method="post">

                <div class="col-md-6 offset-md-3">
                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control" id="email" value="<?= get_field_value('email')?>" placeholder="name@example.com">
                        <label style="color: #282828" class="required" for="email"><?php __('tpl_signup_email_input'); ?></label>
                    </div>
                </div>

                <div class="col-md-6 offset-md-3">
                    <div class="form-floating mb-3">
                        <input type="password" name="password" class="form-control" id="password" placeholder="password">
                        <label style="color: #282828" class="required" for="password"><?php __('tpl_signup_password_input'); ?></label>
                    </div>
                </div>

                <div class="col-md-6 offset-md-3">
                    <div class="form-floating mb-3">
                        <input type="text" name="name" class="form-control" id="name" value="<?= get_field_value('name')?>" placeholder="Name">
                        <label style="color: #282828" class="required" for="name"><?php __('tpl_signup_name_input'); ?></label>
                    </div>
                </div>

                <div class="col-md-6 offset-md-3">
                    <div class="form-floating mb-3">
                        <input type="text" name="address" class="form-control" id="address" value="<?= get_field_value('address')?>" placeholder="Address">
                        <label style="color: #282828" class="required" for="address"><?php __('tpl_signup_address_input'); ?></label>
                    </div>
                </div>

                <div class="col-md-6 offset-md-3">
                    <button type="submit" class="btn btn-danger"><?php __('user_signup_signup_btn'); ?></button>
                </div>
            </form>

            <?php
                if(isset($_SESSION['form_data'])){
                    unset($_SESSION['form_data']);
                }
            ?>
        </div>
    </div>
</div>
<script>
    document.querySelector('.header').classList.add("header-products")
    document.querySelector('.header__btn').classList.add('hidden')
</script>

