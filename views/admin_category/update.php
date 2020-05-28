<?php include ROOT.'/views/layouts/header_admin.php'; ?>

<div class="center-block-main admin-product-create">
    <div class="admin-nav">
        <ul>
            <li><a href="/admin">Админпанель</a></li>
            <li><a href="/admin/category">Управление категориями</a></li>
            <li class="active-admin-nav">Редактировать категорию</li>
        </ul>
    </div>

    <div class="clearfix"></div>

    <h4>Редактировать товар</h4>

    <?php if(isset($errors) && is_array($errors)): ?>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li> <?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <div class="admin-create-product-form">
        <form action="#" method="post">

            <p>Название</p>
            <input type="text" name="name" placeholder="" value="<?php echo $category['name']; ?>">

            <p>Порядковый номер</p>
            <input type="text" name="sort_order" placeholder="" value="<?php echo $category['sort_order']; ?>">

            <p>Статус</p>
            <select name="status">
                <option value="1" <?php if ($category['status'] == 1) echo ' selected="selected"'; ?>>Отображается</option>
                <option value="0" <?php if ($category['status'] == 0) echo ' selected="selected"'; ?>>Скрыта</option>
            </select>

            <br><br>

            <input type="submit" name="submit" class="btn-add-new-product" value="Сохранить">

            <br><br>
        </form>

    </div>
</div>

</div>
</body>
<?php include ROOT.'/views/layouts/footer_admin.php'; ?>
