<?php include ROOT.'/views/layouts/header.php'; ?>
<head>
    <title><?php echo $product['name']; ?></title>
</head>
<div class="center-block-main clearfix">
    <main class="product">

        <div class="product-image">
            <img src="<?php echo Product::getImage($product['id']); ?>" alt="" />
        </div>
        
        <div class="product-buy">
            <h2><?php echo $product['name']; ?></h2>
            <span>Артикул: <?php echo $product['code']; ?></span>

            <h3>Цена: <span><?php echo $product['price']; ?> руб.</span></h3>

            <form action="" method="post">
                <p>Количество:</p>
                <input type="number" max="99" min="1" name="count-tov" class="numb" placeholder="1" value="1">
                <button type="submit" name="add-to-cart" class="product-to-cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i>  В корзину</button>
            </form>
            
            <?php $availability = Product::getAvailabilityText($product['availability']); ?>
            <p>Наличие: <span><?php echo  $availability; ?></span></p>
            <p>Производитель: <span><?php echo $product['brand']; ?></span></p>
        </div>

        <div class="clearfix"></div>

        <div class="description">
            <h4>Описание товара</h4>
            <p><?php echo $product['description']; ?></p>
            
            <?php if($product['size'] || $product['mass'] || $product['work_temp'] || $product['sensitivity'] || $product['voltage'] || $product['place'] || $product['other_characteristics']): ?>
                <h4>Технические характеристики</h4>
            <?php endif; ?>
            <table>
                <?php if($product['size']): ?>
                    <tr>
                        <?php echo '<td>Габаритные размеры извещателей, мм</td>'; ?>
                        <?php echo '<td>'.$product['size'].'</td>'; ?>
                    </tr>
                <?php endif; ?>

                <?php if($product['mass']): ?>
                    <tr>
                        <?php echo '<td>Масса извещателя, кг</td>'; ?>
                        <?php echo '<td>'.$product['mass'].'</td>'; ?>
                    </tr>
                <?php endif; ?>

                <?php if($product['work_temp']): ?>
                    <tr>
                        <?php echo '<td>Диапазон рабочих температур извещателя, °С</td>'; ?>
                        <?php echo '<td>'.$product['work_temp'].'</td>'; ?>
                    </tr>
                <?php endif; ?>

                <?php if($product['sensitivity']): ?>
                    <tr>
                        <?php echo '<td>Чувствительность извещателей соответствует задымленности среды с оптической плотностью, дБ/м</td>'; ?>
                        <?php echo '<td>'.$product['sensitivity'].'</td>'; ?>
                    </tr>
                <?php endif; ?>

                <?php if($product['voltage']): ?>
                    <tr>
                        <?php echo '<td>Напряжение питания (от источника постоянного тока), В</td>'; ?>
                        <?php echo '<td>'.$product['voltage'].'</td>'; ?>
                    </tr>
                <?php endif; ?>

                <?php if($product['place']): ?>
                    <tr>
                        <?php echo '<td>Максимально-допустимая защищаемая площадь одним извещателем, м2</td>'; ?>
                        <?php echo '<td>'.$product['place'].'</td>'; ?>
                    </tr>
                <?php endif; ?>
            </table>
            <?php if($product['other_characteristics']): ?>
                <?php echo $product['other_characteristics']; ?>
            <?php endif; ?>

            

            <?php if ($commentAll): ?>
                <h4>Отзывы</h4>
                <?php foreach($commentAll as $comment): ?>

                    <?php $id = $comment['id']; ?>

                    <article class="clearfix">

                    <?php if(User::checkAdminUser()): ?>
                            <form action="#" method="post">
                                <button class="btn-admin-delete-comment" type="submit" name="delete" value="<?php echo $id ?>"><i class="fa fa-times"></i></button>
                            </form>
                            <div class="clearfix"></div>
                        <?php endif; ?>

                        <div class="user-comment">

                            <?php $userId = $comment['user_id'];
                            $user = User::getUserById($userId); ?>

                            <p><?php echo (date('d.m.Y', strtotime($comment['time'])));?></p>
                            <p><?php echo $user['name']; ?></p>
                        </div>

                        <div class="text-comment">
                            <p><?php echo $comment['text_comment']; ?></p>
                        </div>
                        
                        
                        <br>

                    </article>
                <?php endforeach; ?>
            <?php endif; ?>



            <?php if (isset($errors) && is_array($errors)): ?>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li> - <?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <?php if(!User::isGuest()): ?>
                <h4>Напишите ваш отзыв</h4>
                <div class="new-comment">
                    <form action="#" method="post">
                        <textarea name="text_comment" id="" cols="30" rows="10"></textarea>
                        <button type="submit" name="send_comment">Отправить</button>
                    </form>
                </div>
            <?php else: ?>
                <?php echo "<h4>Войдите что бы написать отзыв</h4>"; ?>
            <?php endif; ?>


        </div>


    </main>
</div>
</div>
<?php include ROOT.'/views/layouts/footer.php'; ?>