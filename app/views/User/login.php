<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item active"><?php __('tpl_login'); ?></li>
        </ol>
    </nav>
</div>

<div class="container py-3">
    <div class="row">
        <div class="col-lg-12 category-content">
            <?php if(!empty($_SESSION['errors'])): ?>
                <h2 class="errors""><?=$_SESSION['errors'];unset($_SESSION['errors'])?></h2>
            <?php endif?>
            <h1 class="title section-title"><?php __('tpl_login'); ?></h1>

            <form class="row g-3" method="post">

                <div class="col-md-6 offset-md-3">
                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control" id="email" placeholder="<?php __('tpl_signup_email_input'); ?>">
                        <label class="required" for="email" style="color: #282828"><?php __('tpl_signup_email_input'); ?></label>
                    </div>
                </div>

                <div class="col-md-6 offset-md-3">
                    <div class="form-floating mb-3">
                        <input type="password" name="password" class="form-control" id="password" placeholder="password">
                        <label class="required" for="password" style="color: #282828"><?php __('tpl_signup_password_input'); ?></label>
                    </div>
                </div>

                <div class="col-md-6 offset-md-3">
                    <button type="submit" class="btn btn-danger"><?php __('user_login_login_btn'); ?></button>
                </div>
            </form>

        </div>
    </div>
</div>
<script>
    document.querySelector('.header').classList.add("header-products")
    document.querySelector('.header__btn').classList.add('hidden')
</script>