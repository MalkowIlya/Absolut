<?php include ROOT.'/views/layouts/header_admin.php'; ?>


<div class="center-block-main admin-product-create">
    <div class="admin-nav">
        <ul>
            <li><a href="/admin">Админпанель</a></li>
            <li><a href="/admin/blog">Управление полезной информацией</a></li>
            <li class="active-admin-nav">Добавить статью</li>
        </ul>
    </div>

    <div class="clearfix"></div>

    <h4>Добавить новую статью</h4>
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
            <input type="text" name="name" placeholder="" value="">

            <p>Описание статьи</p>
            <textarea name="small_description" id="" cols="30" rows="10"></textarea>

            <p>Текст статьи</p>
            <textarea name="text_post" id="sk-editor-text-post" cols="30" rows="20"></textarea>
            <script>
                CKEDITOR.replace('sk-editor-text-post');
            </script>

            <br/><br/>

            <p>Изображение для статьи</p>
            <div class="file-upload">
                <label>
                    <input type="file" name="image" placeholder="" value="">
                    <span>Выберите файл</span>
                </label>
            </div>
            <input type="text" id="filename" class="filename" disabled>

            <br><br>

            <p>Статус</p>
            <select name="status">
                <option value="1" selected="selected">Отображается</option>
                <option value="0">Скрыта</option>
            </select>

            <br><br>

            <input type="submit" name="submit" class="btn-add-new-product" value="Добавить">

            <br><br>
        </form>

    </div>

</div>


</div>
<?php include ROOT.'/views/layouts/footer_admin.php'; ?>



