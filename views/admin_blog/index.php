<?php include ROOT.'/views/layouts/header_admin.php'; ?>

<div class="center-block-main admin-product-index">
    <div class="admin-nav">
        <ul>
            <li><a href="/admin">Админпанель</a></li>
            <li class="active-admin-nav">Управление полезной информацией</li>
        </ul>
    </div>

    <div class="clearfix"></div>

   
    <h4>Список статей</h4>

    <table>
        <tr>
            <th>Id статьи</th>
            <th>Название статьи</th>
            <th>Описание</th>
        </tr>
        <?php foreach($postList as $post): ?>
            <tr>
                <td><?php echo $post['id']; ?></td>
                <td><?php echo $post['name']; ?></td>
                <td><?php echo $post['small_description']; ?></td>
                <td><a href="/admin/blog/update/<?php echo $post['id']; ?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></td>
                <td><a href="/admin/blog/delete/<?php echo $post['id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>
            </tr>
        <?php endforeach; ?>
    </table>

     <a href="/admin/blog/create" class="btn-create-new-product"><i class="fa fa-plus"></i> Добавить статью</a>


</div>

</div>
</body>
<?php include ROOT.'/views/layouts/footer_admin.php'; ?>
