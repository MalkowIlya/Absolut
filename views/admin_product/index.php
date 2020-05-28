<?php include ROOT.'/views/layouts/header_admin.php'; ?>

<div class="center-block-main admin-product-index">
    <div class="admin-nav">
        <ul>
            <li><a href="/admin">Админпанель</a></li>
            <li class="active-admin-nav">Управление товарами</li>
        </ul>
    </div>

    <div class="clearfix"></div>

   
    <h4>Список товаров</h4>

    <table>
        <tr>
            <th>Id товара</th>
            <th>Категория товара</th>
            <th>Артикул</th>
            <th>Название товара</th>
            <th>Цена</th>
            <th></th>
            <th></th>
        </tr>
        <?php foreach($productList as $product): ?>
            <tr>
                <td><?php echo $product['id']; ?></td>
                <?php $category_id = Category::getCategoryById($product['category_id']); ?>
                <td><?php echo $category_id['name']; ?></td>
                <td><?php echo $product['code']; ?></td>
                <td><?php echo $product['name']; ?></td>
                <td><?php echo $product['price']; ?></td>
                <td><a href="/admin/product/update/<?php echo $product['id']; ?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></td>
                <td><a href="/admin/product/delete/<?php echo $product['id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>
            </tr>
        <?php endforeach; ?>
    </table>

     <a href="/admin/product/create" class="btn-create-new-product"><i class="fa fa-plus"></i> Добавить товар</a>


</div>

</div>
</body>
<?php include ROOT.'/views/layouts/footer_admin.php'; ?>
