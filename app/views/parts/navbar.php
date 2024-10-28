<div class="main__navbar">
    <ul class="main__navbar-list">
        <?php foreach ($categories as $category):?>
            <li class="main__navbar-item"><a href="category/<?=$category['category_title']?>"><?=$category['title']?></a><span class="main__navbar-item-qty">2</span></li>
        <?php endforeach?>
    </ul>
</div>