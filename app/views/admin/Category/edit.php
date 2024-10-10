<!-- Default box -->
<div class="card">

    <div class="card-body">

        <form action="" method="post">

            <div class="card card-info card-outline card-tabs">

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
                                    <input type="text" name="category_description[<?= $language['id'] ?>][title]" class="form-control" id="title" placeholder="Наименование категории" value="<?=$category[$language['id']]['title']?>" required2>
                                </div>

                                <div class="form-group">
                                    <label for="content">Описание категории</label>
                                    <textarea id="editor" name="category_description[<?= $language['id'] ?>][description]" class="form-control editor" id="content" rows="3" placeholder="Описание категории"><?=$category[$language['id']]['description']?></textarea>
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

<script>
    const image_upload_handler_callback = (blobInfo, progress) => new Promise((resolve, reject) => {
        const xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', "upload.php");

        xhr.upload.onprogress = (e) => {
            progress(e.loaded / e.total * 100);
        };

        xhr.onload = () => {
            if (xhr.status === 403) {
                reject({ message: 'HTTP Error: ' + xhr.status, remove: true });
                return;
            }

            if (xhr.status < 200 || xhr.status >= 300) {
                reject('HTTP Error: ' + xhr.status);
                return;
            }

            const json = JSON.parse(xhr.responseText);

            if (!json || typeof json.location != 'string') {
                reject('Invalid JSON: ' + xhr.responseText);
                return;
            }

            resolve(json.location);
        };

        xhr.onerror = () => {
            reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
        };

        const formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());

        xhr.send(formData);
    });
    tinymce.init({
        selector:'#editor',
        plugins: 'image',
        toolbar: 'undo redo | styles | bold italic | image',
        images_upload_url: "upload.php",
        images_upload_handler: image_upload_handler_callback
    })
</script>





