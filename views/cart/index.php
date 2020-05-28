<?php include ROOT.'/views/layouts/header.php'; ?>

<head>
    <title>Корзина</title>
</head>
<div class="center-block-main clearfix">
    <div class="cart-index">
        <h2>Корзина</h2>


        <?php if ($productsInCart): ?>
            <p>Ваши товары:</p>
            <table>
                <tr>
                    <th>Код товара</th>
                    <th>Название</th>
                    <th>Стоимость</th>
                    <th>Колличество, шт</th>
                    <th>Добавить</th>
                    <th>Убрать</th>
                    <th>Удалить</th>
                </tr>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo $product['code']; ?></td>
                        <td>
                            <a href="/product/<?php echo $product['id']; ?>">
                                <?php echo $product['name']; ?>
                            </a>
                        </td>
                        <td><?php echo $product['price']; ?> р.</td>
                        <td><?php echo $productsInCart[$product['id']]; ?></td>
                        <td>
                            <a href="/cart/addone/<?php echo $product['id']; ?>">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </a>
                        </td>
                        <td>
                            <a href="/cart/deleteone/<?php echo $product['id']; ?>">
                                <i class="fa fa-minus" aria-hidden="true"></i>
                            </a>
                        </td>
                        <td>
                            <a href="/cart/delete/<?php echo $product['id']; ?>">
                                <i class="fa fa-times"></i>
                            </a>
                        </td>
                    </tr>

                <?php endforeach; ?>
                <tr>
                    <td>Общая стоимость:</td>
                    <td><?php echo $totalPrice; ?> руб.</td>
                </tr>
            </table>
            <a class="btn-cart-index-checkout" href="/cart/checkout/"><i class="fa fa-shopping-cart"></i> Офорить заказ</a>

        <?php else: ?>
            <p>Корзина пуста</p>
            <a class="btn-cart-index-back" href="/catalog/"><i class="fa fa-shopping-cart"></i> Вернуться к покупкам</a>
        <?php endif; ?>
    </div>

</div>
</div>
<?php include ROOT.'/views/layouts/footer.php'; ?>