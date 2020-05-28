<?php include ROOT.'/views/layouts/header_admin.php'; ?>

<div class="center-block-main admin-product-create">
    <div class="admin-nav">
        <ul>
            <li><a href="/admin">Админпанель</a></li>
            <li><a href="/admin/blog">Управление полезной информацией</a></li>
            <li class="active-admin-nav">Редактировать статью</li>
        </ul>
    </div>

    <div class="clearfix"></div>

    <h4>Редактировать статью</h4>
    <br>

    <?php if(isset($errors) && is_array($errors)): ?>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li> <?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <div class="admin-create-product-form">
        <form action="#" method="post" enctype="multipart/form-data">

            <p>Название статьи</p>
            <input type="text" name="name" placeholder="" value="<?php echo $post['name'] ?>">

            <p>Описание статьи</p>
            <textarea name="small_description" id="" cols="30" rows="10"><?php echo $post['small_description'] ?></textarea>

            <p>Текст статьи</p>
            <textarea name="text_post" id="sk-editor-text-post" cols="30" rows="20"><?php echo $post['text_post'] ?></textarea>
            <script>
                CKEDITOR.replace('sk-editor-text-post');
            </script>

            <br/><br/>

            <p>Изображение для статьи</p>
            <img src="<?php echo Blog::getImage($post['id']); ?>" alt="" width="400px;">
            <div class="clearfix"></div>
            <div class="file-upload">

                <label>
                    <input type="file" name="image" placeholder="" value="<?php echo $post['image'] ?>">

                    <span>Выберите файл</span>
                </label>

            </div>

            <input type="text" id="filename" class="filename" disabled>


            <!--<img src="<?php //echo Product::getImage($post['id']); ?>" width="200" alt="" />
            <input type="file" name="image" placeholder="" value="<?php //echo $post['image'] ?>">-->

            <br><br>

            <p>Статус</p>
            <select name="status">
                <option value="1" <?php if ($post['status'] == 1) echo ' selected="selected"'; ?>>Отображается</option>
                <option value="0" <?php if ($post['status'] == 0) echo ' selected="selected"'; ?>>Скрыта</option>
            </select>

            <br><br>

            <input type="submit" name="submit" class="btn-add-new-product" value="Сохранить">

            <br><br>
        </form>
    </div>

</div>



</div>
<?php include ROOT.'/views/layouts/footer_admin.php'; ?>

