<?php include ROOT.'/views/layouts/header_admin.php'; ?>

<div class="center-block-main admin-product-index">
    <div class="admin-nav">
        <ul>
            <li><a href="/admin">Админпанель</a></li>
            <li class="active-admin-nav">Управление категориями</li>
        </ul>
    </div>

    <div class="clearfix"></div>
    
    <h4>Список категорий</h4>

    <table>
        <tr>
            <th>Id категории</th>
            <th>Название категории</th>
            <th>Номер категории</th>
            <th>Статус</th>
            <th></th>
            <th></th>
        </tr>
        <?php foreach($categoriesList as $category): ?>
            <tr>
                <td><?php echo $category['id']; ?></td>
                <td><?php echo $category['name']; ?></td>
                <td><?php echo $category['sort_order']; ?></td>
                <td><?php echo Category::getStatusText($category['status']); ?></td>
                <td><a href="/admin/category/update/<?php echo $category['id']; ?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></td>
                <td><a href="/admin/category/delete/<?php echo $category['id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <a href="/admin/category/create" class="btn-create-new-product"><i class="fa fa-plus"></i>Добавить категорию</a>


</div>


</div>
</body>
<?php include ROOT.'/views/layouts/footer_admin.php'; ?>
