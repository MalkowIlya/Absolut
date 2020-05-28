<?php include ROOT.'/views/layouts/header_admin.php'; ?>

<div class="center-block-main admin-product-create">
    <div class="admin-nav">
        <ul>
            <li><a href="/admin">Админпанель</a></li>
            <li><a href="/admin/order">Управление заказами</a></li>
            <li class="active-admin-nav">Редактировать заказ</li>
        </ul>
    </div>

    <div class="clearfix"></div>

    <h4>Редактировать заказ №<?php echo $id; ?></h4>
    <br>

    <?php if(isset($errors) && is_array($errors)): ?>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li> <?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <div class="admin-create-product-form">
        <form action="#" method="post">

            <p>Имя клиента</p>
            <input type="text" name="userName" placeholder="" value="<?php echo $order['user_name']; ?>">

            <p>Телефон клиента</p>
            <input type="text" name="userPhone" placeholder="" value="<?php echo $order['user_phone']; ?>">

            <p>Комментарий клиента</p>
            <input type="text" name="userComment" placeholder="" value="<?php echo $order['user_comment']; ?>">

            <p>Дата оформления заказа</p>
            <input type="text" name="date" placeholder="" value="<?php echo $order['date']; ?>">

            <p>Статус</p>
            <select name="status">
                <option value="1" <?php if ($order['status'] == 1) echo ' selected="selected"'; ?>>Новый заказ</option>
                <option value="2" <?php if ($order['status'] == 2) echo ' selected="selected"'; ?>>В обработке</option>
                <option value="3" <?php if ($order['status'] == 3) echo ' selected="selected"'; ?>>Доставляется</option>
                <option value="4" <?php if ($order['status'] == 4) echo ' selected="selected"'; ?>>Закрыт</option>
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