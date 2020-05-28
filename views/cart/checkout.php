<?php include ROOT.'/views/layouts/header.php'; ?>
<head>
    <title>Оформление заказа</title>
</head>
<div class="center-block-main clearfix">
    <div class="checkout-order">
        <h2>Оформление заказа</h2>


        <?php if ($result): ?>
            <p>Заказ оформлен. С вами свяжутся в ближайшее время.</p>
        <?php else: ?>

            <p>Выбрано товаров: <?php echo $totalQuantity; ?>, на сумму: <?php echo $totalPrice; ?> рублей</p>

            <?php if (!$result): ?>

                <div class="col-sm-4">
                    <?php if (isset($errors) && is_array($errors)): ?>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li> - <?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <p>Для оформления заказа заполните форму. Наш менеджер с вами свяжется в ближайшее время.</p>
                    <div class="login-form">
                        <form action="#" method="post">
                            <p>Ваше имя</p>
                            <input type="text" name="userName" placeholder="" value="<?php echo $userName; ?>">

                            <p>Номер телефона</p>
                            <input type="text" name="userPhone" placeholder="" value="<?php echo $userPhone; ?>">

                            <p>Комментарий к заказу</p>
                            <input type="text" name="userComment" placeholder="Сообщение" value="<?php echo $userComment; ?>">

                            <br>
                            <br>
                            <button type="submit" name="submit" class="btn btn-default" value="Заказать">Заказать</button>
                        </form>
                    </div>

                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

</div>


</div>
<?php include ROOT.'/views/layouts/footer.php'; ?>