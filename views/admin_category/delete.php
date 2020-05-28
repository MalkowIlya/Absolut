<?php include ROOT.'/views/layouts/header_admin.php'; ?>


<div class="center-block-main admin-product-create">
    <div class="admin-nav">
        <ul>
            <li><a href="/admin">Админпанель</a></li>
            <li><a href="/admin/category">Управление категориями</a></li>
            <li class="active-admin-nav">Удалить категорию</li>
        </ul>
    </div>

    <div class="clearfix"></div>

    <h4>Удалить категорию №<?php echo $id ?></h4>
    <p>Вы действительно хотите удалить эту категорию?</p>
    <form action="#" method="post">
        <input class="btn-delete-product" type="submit" name="submit" value="Удалить">
    </form>

</div>



</div>
</body>
<?php include ROOT.'/views/layouts/footer_admin.php'; ?>
