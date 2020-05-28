<?php include ROOT.'/views/layouts/header_admin.php'; ?>


<div class="center-block-main admin-product-create">
    <div class="admin-nav">
        <ul>
            <li><a href="/admin">Админпанель</a></li>
            <li><a href="/admin/product">Управление товарами</a></li>
            <li class="active-admin-nav">Добавить товар</li>
        </ul>
    </div>

    <div class="clearfix"></div>

    <h4>Добавить новый товар</h4>
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

            <p>Название товара</p>
            <input type="text" name="name" placeholder="" value="">

            <p>Артикул</p>
            <input type="text" name="code" placeholder="" value="">

            <p>Стоимость</p>
            <input type="text" name="price" placeholder="" value="">

            <p>Категория</p>
            <select name="category_id">
                <?php if(is_array($categoriesList)): ?>
                    <?php foreach ($categoriesList as $category): ?>
                        <option value="<?php echo $category['id']; ?>">
                            <?php echo $category['name']; ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>

            <br><br>

            <p>Производитель</p>
            <input type="text" name="brand" placeholder="" value="">

            <p>Изображение товара</p>
            <div class="file-upload">
                <label>
                    <input type="file" name="image" placeholder="" value="">
                    <span>Выберите файл</span>
                </label>
            </div>
            <input type="text" id="filename" class="filename" disabled>

            <p>Детальное описание</p>
            <textarea name="description" id="" cols="30" rows="10"></textarea>

            <p>Габаритные размеры, мм</p>
            <input type="text" name="size" placeholder="" value="">

            <p>Масса, кг</p>
            <input type="text" name="mass" placeholder="" value="">

            <p>Диапазон рабочих температур, °С</p>
            <input type="text" name="work_temp" placeholder="" value="">

            <p>Чувствительность, дБ/м</p>
            <input type="text" name="sensitivity" placeholder="" value="">

            <p>Напряжение питания (от источника постоянного тока), В</p>
            <input type="text" name="voltage" placeholder="" value="">

            <p>Максимально-допустимая защищаемая площадь, м2</p>
            <input type="text" name="place" placeholder="" value="">

            <p>Прочие характеристики</p>
            <textarea name="other_characteristics" id="sk-editor-text-post" cols="30" rows="20"></textarea>
            <script>
                CKEDITOR.replace('sk-editor-text-post');
            </script>

            <br><br>

            <p>Наличие на складе</p>
            <select name="availability">
                <option value="1" selected="selected">Да</option>
                <option value="0">Нет</option>
            </select>

            <p>Новинка</p>
            <select name="is_new">
                <option value="1" selected="selected">Да</option>
                <option value="0">Нет</option>
            </select>

            <br/><br/>

            <p>Рекомендуемые</p>
            <select name="is_recommended">
                <option value="1" selected="selected">Да</option>
                <option value="0">Нет</option>
            </select>

            <br/><br/>

            <p>Статус</p>
            <select name="status">
                <option value="1" selected="selected">Отображается</option>
                <option value="0">Скрыт</option>
            </select>

            <br><br>

            <input type="submit" name="submit" class="btn-add-new-product" value="Сохранить">

            <br><br>
        </form>

    </div>

</div>



</div>
<?php include ROOT.'/views/layouts/footer_admin.php'; ?>



