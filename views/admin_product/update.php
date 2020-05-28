<?php include ROOT.'/views/layouts/header_admin.php'; ?>

<div class="center-block-main admin-product-create">
    <div class="admin-nav">
        <ul>
            <li><a href="/admin">Админпанель</a></li>
            <li><a href="/admin/product">Управление товарами</a></li>
            <li class="active-admin-nav">Редактировать товар</li>
        </ul>
    </div>

    <div class="clearfix"></div>

    <h4>Редактировать товары</h4>
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
            <input type="text" name="name" placeholder="" value="<?php echo $product['name'] ?>">

            <p>Артикул</p>
            <input type="text" name="code" placeholder="" value="<?php echo $product['code'] ?>">

            <p>Стоимость</p>
            <input type="text" name="price" placeholder="" value="<?php echo $product['price'] ?>">

            <p>Категория</p>
            <select name="category_id">
                <?php if(is_array($categoriesList)): ?>
                    <?php foreach ($categoriesList as $category): ?>
                        <option value="<?php echo $category['id']; ?>"
                            <?php if ($product['category_id'] == $category['id']) echo ' selected="selected"'; ?>>
                            <?php echo $category['name']; ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>

            <br><br>

            <p>Производитель</p>
            <input type="text" name="brand" placeholder="" value="<?php echo $product['brand'] ?>">

            <p>Изображение товара</p>
            <img src="<?php echo Product::getImage($product['id']); ?>" width="200" alt="" />
            <div class="clearfix"></div>
            <div class="file-upload">
                <label>
                    <input type="file" name="image" placeholder="" value="<?php echo $product['image'] ?>">
                    <span>Выберите файл</span>
                </label>
            </div>
            <input type="text" id="filename" class="filename" disabled>


            <!--<input type="file" name="image" placeholder="" value="<?php //echo $product['image'] ?>">-->

            <p>Детальное описание</p>
            <textarea name="description" id="" cols="30" rows="10"><?php echo $product['description'] ?></textarea>

            <p>Габаритные размеры, мм</p>
            <input type="text" name="size" placeholder="" value="<?php echo $product['size'] ?>">

            <p>Масса, кг</p>
            <input type="text" name="mass" placeholder="" value="<?php echo $product['mass'] ?>">

            <p>Диапазон рабочих температур, °С</p>
            <input type="text" name="work_temp" placeholder="" value="<?php echo $product['work_temp'] ?>">

            <p>Чувствительность, дБ/м</p>
            <input type="text" name="sensitivity" placeholder="" value="<?php echo $product['sensitivity'] ?>">

            <p>Напряжение питания (от источника постоянного тока), В</p>
            <input type="text" name="voltage" placeholder="" value="<?php echo $product['voltage'] ?>">

            <p>Максимально-допустимая защищаемая площадь, м2</p>
            <input type="text" name="place" placeholder="" value="<?php echo $product['place'] ?>">

            <p>Прочие характеристики</p>
            <textarea name="other_characteristics" id="sk-editor-text-post" cols="30" rows="20"><?php echo $product['other_characteristics'] ?></textarea>
            <script>
                CKEDITOR.replace('sk-editor-text-post');
            </script>

            <br><br>

            <p>Наличие на складе</p>
            <select name="availability">
                <option value="1" <?php if ($product['availability'] == 1) echo ' selected="selected"'; ?>>Да</option>
                <option value="0" <?php if ($product['availability'] == 0) echo ' selected="selected"'; ?>>Нет</option>
            </select>

            <p>Новинка</p>
            <select name="is_new">
                <option value="1" <?php if ($product['is_new'] == 1) echo ' selected="selected"'; ?>>Да</option>
                <option value="0" <?php if ($product['is_new'] == 0) echo ' selected="selected"'; ?>>Нет</option>
            </select>

            <br/><br/>

            <p>Рекомендуемые</p>
            <select name="is_recommended">
                <option value="1" <?php if ($product['is_recommended'] == 1) echo ' selected="selected"'; ?>>Да</option>
                <option value="0" <?php if ($product['is_recommended'] == 0) echo ' selected="selected"'; ?>>Нет</option>
            </select>

            <br/><br/>

            <p>Статус</p>
            <select name="status">
                <option value="1" <?php if ($product['status'] == 1) echo ' selected="selected"'; ?>>Отображается</option>
                <option value="0" <?php if ($product['status'] == 0) echo ' selected="selected"'; ?>>Скрыт</option>
            </select>

            <br><br>

            <input type="submit" name="submit" class="btn-add-new-product" value="Сохранить">

            <br><br>
        </form>
    </div>

</div>



</div>
<?php include ROOT.'/views/layouts/footer_admin.php'; ?>

