<?php include ROOT.'/views/layouts/header.php'; ?>
<head>
    <title>Каталог</title>
</head>
<div class="center-block-main clearfix">
    <aside class="list-catalog">
        <h2>КАТАЛОГ</h2>

        <?php foreach ($categories as $categoryItem): ?>
            <p class="<?php if ($categoryId == $categoryItem['id']) echo 'list-catalog-active' ?>">
                <a href="/category/<?php echo $categoryItem['id']; ?>" >
                    <?php echo $categoryItem['name']; ?>
                </a>
            </p>
        <?php endforeach; ?>

        <!--<p><a href="#">Извещатели пожарные</a></p>
        <p><a href="#">Извещатели охранные</a></p>
        <p class="list-catalog-active"><a href="#" >Приборы приемно-контрольные</a></p>
        <p><a href="#">Средства пожаротушения</a></p>
        <p><a href="#">Взрывозащищенное оборудование</a></p>-->

    </aside>

    <main class="catalog">

        <form action="" method="post">
            <select name="sort" id="" class="sort" onchange="submit();">
                <option <?php if($_SESSION['type_sort'] == 1) echo 'selected'; ?> value="1">Новизне</option>
                <option <?php if($_SESSION['type_sort'] == 2) echo 'selected'; ?> value="2">Уменьшению цены</option>
                <option <?php if($_SESSION['type_sort'] == 3) echo 'selected'; ?> value="3">Увеличению цены</option>
            </select>
        </form>


        <!--<form action="" method="post">
            <select name="sort" id="" class="sort">
                <option value="">Новизне</option>
                <option value="">Уменьшению цены</option>
                <option value="">Увеличению цены</option>
            </select>
        </form>-->

        <div class="clearfix"></div>


        <?php foreach ($categoryProduct as $product): ?>
                <div class="catalog-tovar">

                    <article class="content-tovar">

                            <img src="<?php echo Product::getImage($product['id']); ?>" alt="" />
                            <h2><?php echo $product['price'];?> руб.</h2>
                            <p>
                                <a href="/product/<?php echo $product['id'];?>">
                                    <?php echo $product['name'];?>
                                </a>
                            </p>
                            <br>
                            
                        <!--<?php //if ($product['is_new']): ?>
                            <img src="/template/images/home/new.png" class="new" alt="">
                        <?php //endif; ?>-->

                    </article>
                    <p><a href="/cart/add/<?php echo $product['id']; ?>" data-id="<?php echo $product['id']; ?>" class="add-to-cart"><i class="fa fa-shopping-cart"></i> В корзину</a></p>
                    <br>
                </div>
        <?php endforeach; ?>

        <!--<div class="catalog-tovar">
            <article class="content-tovar">
                <img src="template/images/sensor.png" alt="">
                <h2>512 руб.</h2>
                <p>ИП 105-1G "Сауна-150" Извещатель тепловой пожарный, 144-160С, НЗ</p>
                <br>
            </article>
            <p><a href="#" class="add-to-cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i> В корзину</a></p>
            <br>
        </div>-->

        <div class="clearfix"></div>

        <!--<div class="pagination">
            <ul>
                <li><a href="">1</a></li>
                <li class="active-pagination"><a href="">2</a></li>
                <li><a href="">></a></li>
            </ul>
        </div>-->

        <!-- Постраничная навигация -->
        <?php echo $pagination->get(); ?>

    </main>
</div>
</div>
<?php include ROOT.'/views/layouts/footer.php'; ?>
</div>