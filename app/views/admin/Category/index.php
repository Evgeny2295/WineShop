<!-- Default box -->
<div class="card">
    <div class="card-header">
        <a href="<?=ADMIN?>/category/add" class="btn btn-default">Добавить</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered w-50" >
                       <thead>
            <tr>
                <th style="width: 10px">id</th>
                <th class="w-75">Категория</th>
                <th colspan="2">Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($categories as $category):?>
            <tr>
                <td><?=$category['id']?></td>
                <td><?=$category['title']?></td>
                <td><a href="<?=ADMIN?>/category/edit?id=<?=$category['id']?>">Изменить</a></td>
                <td><a href="<?=ADMIN?>/category/delete?id=<?=$category['id']?>" class="link__delete">Удалить</a></td>
            </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
<!-- /.card -->

