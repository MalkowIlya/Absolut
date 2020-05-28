<?php include ROOT.'/views/layouts/header.php'; ?>
<head>
    <title>Последние товары</title>
</head>
<div class="center-block-main clearfix">
    <aside class="list-catalog">
        <h2>КАТАЛОГ</h2>

        <?php foreach ($categories as $categoryItem): ?>
            <p>
                <a href="/category/<?php echo $categoryItem['id']; ?>">
                    <?php echo $categoryItem['name']; ?>
                </a>
            </p>
        <?php endforeach; ?>
    </aside>

    <main class="catalog">
        <h2 class="title text-center">Последние товары</h2>

        <?php foreach ($latestProduct as $product): ?>
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

    </main>
</div>
</div>
</body>
<?php include ROOT.'/views/layouts/footer.php'; ?>