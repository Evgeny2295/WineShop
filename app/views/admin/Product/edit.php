<!-- Default box -->
<?php $langId = \core\App::$app->getProperty('language')['id'];?>
<div class="card">
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="card card-info card-outline card-tabs">
                <div class="mt-1">
                    <select name="category_id">
                        <option value="" selected disabled>Выбрать категорию</option>
                        <?php foreach ($categories as $category):?>
                            <option value="<?=$category['id']?>" <?php if($category['id'] === $product[$langId]['category_id']) echo 'selected'?>><?=$category['title']?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="mt-1">
                    <input type="text" class="form-control w-25 mb-2" name="slug" placeholder="Введите название продукта" value="<?=$product[$langId]['title']?>">
                </div>
                <div class="mt-1">
                </div>
                <div class="mt-1">
                    <input type="number" class="form-control w-25 mb-2" name="price" placeholder="Введите стоимость продукта" value="<?=$product[$langId]['price']?>" required>
                </div>
                <div class="mt-1">
                    <input type="number" class="form-control w-25 mb-2" name="old_price" placeholder="Введите старую стоимость продукта" value="<?=$product[$langId]['old_price']?>">
                </div>
                <div class="mt-1">
                    <input type="number" class="form-control w-25 mb-2" name="strength" placeholder="Введите крепость" value="<?=$product[$langId]['strength']?>" required>
                </div>
                <div class="mt-1">
                    <input type="number" class="form-control w-25 mb-2" name="capacity" placeholder="Введите объем" value="<?=$product[$langId]['capacity']?>" required>
                </div>
                <div class="mt-1">
                    <img style="width: 80px;height:80px" src="<?= PATH . '/' .$product[$langId]['img']?>" alt="">
                    <input type="file" class="form-control w-25 mb-2" name="img" placeholder="Добавить фото">
                    <input type="hidden" name="img" value="<?= $product[$langId]['img'] ?>">
                </div>
                <div class="mt-1">
                    <div>
                        <input type="radio" id="hit" name="hit" value="0" <?php if($product[$langId]['hit'] === 0) echo 'checked'?> />
                        <label for="status">Не хит</label>
                    </div>

                    <div>
                        <input type="radio" id="hit" name="hit" value="1" <?php if($product[$langId]['hit'] === 1) echo 'checked'?> />
                        <label for="hit">Хит</label>
                    </div>
                </div>
                <div class="mt-1">
                    <div>
                        <input type="radio" id="status" name="status" value="0" <?php if($product[$langId]['status'] === 0) echo 'checked'?> />
                        <label for="status">Не активен товар</label>
                    </div>

                    <div>
                        <input type="radio" id="status" name="status" value="1" <?php if($product[$langId]['status'] === 1) echo 'checked'?>/>
                        <label for="status">Активен</label>
                    </div>
                </div>
                <div class="card-header p-0 pt-1 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                        <?php foreach ($languages as $k => $language): ?>

                            <li class="nav-item">
                                <a class="nav-link <?php if ($language['base']) echo 'active' ?>" data-toggle="pill" href="#<?= $k ?>">
                                    <img src="<?php PATH?>/assets/img/langs/<?=$k?>.png" alt="">
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="card-body">
                    <div class="tab-content">
                        <?php foreach ($languages as $k => $language): ?>
                            <div class="tab-pane fade <?php if ($language['base']) echo 'active show' ?>" id="<?= $k ?>">
                                <div class="form-group">
                                    <label class="required" for="title">Наименование</label>
                                    <input type="text" name="product_description[<?= $language['id'] ?>][title]" class="form-control" id="title" placeholder="Наименование категории" value="<?=$product[$language['id']]['title']?>">
                                </div>

                                <div class="form-group">
                                    <label for="content">Описание продукта</label>
                                    <textarea id="editor" name="product_description[<?= $language['id'] ?>][description]" class="form-control editor" id="content" rows="3" placeholder="Описание категории"><?=$product[$language['id']]['description']?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="content">Страна</label>
                                    <input type="text" name="product_description[<?= $language['id'] ?>][country]" class="form-control" id="country" placeholder="Наименование страны" value="<?=$product[$language['id']]['country']?>" >
                                </div>
                                <h3>Поля для добавления вина</h3>
                                <div class="form-group">
                                    <label for="manufacture">Производитель</label>
                                    <input type="text" name="wine_description[<?= $language['id'] ?>][manufacture]" class="form-control" id="manufacture" placeholder="Наименование производителя" value="<?=$product[$language['id']]['manufacture']?>" >
                                </div>
                                <div class="form-group">
                                    <label for="sort_grap">Сорт винограда</label>
                                    <input type="text" name="wine_description[<?= $language['id'] ?>][sort_grap]" class="form-control" id="sort_grap" placeholder="Наименование сорта винограда" value="<?=$product[$language['id']]['sort_grap']?>" >
                                </div>
                                <div class="form-group">
                                    <label for="sugar">Сахар</label>
                                    <input type="text" name="wine_description[<?= $language['id'] ?>][sugar]" class="form-control" id="sugar" placeholder="Наименование сахара" value="<?=$product[$language['id']]['sugar']?>" >
                                </div>
                                <div class="form-group">
                                    <label for="color">Цвет</label>
                                    <input type="text" name="wine_description[<?= $language['id'] ?>][color]" class="form-control" id="color" placeholder="Наименование цвета" value="<?=$product[$language['id']]['color']?>" >
                                </div>
                            </div>

                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- /.card -->
            </div>

            <button type="submit" class="btn btn-primary">Сохранить</button>

        </form>

        <?php
        if (isset($_SESSION['form_data'])) {
            unset($_SESSION['form_data']);
        }
        ?>

    </div>

</div>
<!-- /.card -->

<!--<script>-->
<!--    const image_upload_handler_callback = (blobInfo, progress) => new Promise((resolve, reject) => {-->
<!--        const xhr = new XMLHttpRequest();-->
<!--        xhr.withCredentials = false;-->
<!--        xhr.open('POST', "upload.php");-->
<!---->
<!--        xhr.upload.onprogress = (e) => {-->
<!--            progress(e.loaded / e.total * 100);-->
<!--        };-->
<!---->
<!--        xhr.onload = () => {-->
<!--            if (xhr.status === 403) {-->
<!--                reject({ message: 'HTTP Error: ' + xhr.status, remove: true });-->
<!--                return;-->
<!--            }-->
<!---->
<!--            if (xhr.status < 200 || xhr.status >= 300) {-->
<!--                reject('HTTP Error: ' + xhr.status);-->
<!--                return;-->
<!--            }-->
<!---->
<!--            const json = JSON.parse(xhr.responseText);-->
<!---->
<!--            if (!json || typeof json.location != 'string') {-->
<!--                reject('Invalid JSON: ' + xhr.responseText);-->
<!--                return;-->
<!--            }-->
<!---->
<!--            resolve(json.location);-->
<!--        };-->
<!---->
<!--        xhr.onerror = () => {-->
<!--            reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);-->
<!--        };-->
<!---->
<!--        const formData = new FormData();-->
<!--        formData.append('file', blobInfo.blob(), blobInfo.filename());-->
<!---->
<!--        xhr.send(formData);-->
<!--    });-->
<!--    tinymce.init({-->
<!--        selector:'#editor',-->
<!--        plugins: 'image',-->
<!--        toolbar: 'undo redo | styles | bold italic | image',-->
<!--        images_upload_url: "upload.php",-->
<!--        images_upload_handler: image_upload_handler_callback-->
<!--    })-->
<!--</script>-->





