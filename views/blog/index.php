<?php include ROOT.'/views/layouts/header.php'; ?>
<head>
    <title>Полезная информация</title>
</head>
<div class="center-block-main clearfix">
    <main class="blog">
        <h2>БЛОГ</h2>


        <?php foreach ($latestPost as $post): ?>
            <article class="clearfix">
                <img src="<?php echo Blog::getImage($post['id']); ?>" alt="">
                <div class="blog-small-description">
                    <h3><?php echo $post['name'];?></h3>
                    <p><?php echo $post['small_description'];?></p>
                    <div class="clearfix"></div>
                    <a href="/blog/post/<?php echo $post['id']; ?>"><i class="fa fa-info" aria-hidden="true"></i> Подробнее</a>
                    <br>
                </div>
                <div class="clearfix"></div>
            </article>
        <?php endforeach; ?>

    </main>
</div>




</div>
</body>
<?php include ROOT.'/views/layouts/footer.php'; ?>