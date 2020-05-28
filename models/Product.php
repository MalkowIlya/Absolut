<?php

class Product
{

    const SHOW_BY_DEFAULT = 6;


    //Return array of product
    //Для последнийх товаров
    public static function getLatestProducts($count = self::SHOW_BY_DEFAULT)
    {
        $count = intval($count);

        $db=Db::getConnection();
        $productList = array();

        $result = $db->query('SELECT id, name, price, image, is_new FROM product WHERE status = "1" ORDER BY id DESC LIMIT ' . $count);

        $i = 0;
        while ($row = $result->fetch()) {
            $productList[$i]['id'] = $row['id'];
            $productList[$i]['name'] = $row['name'];
            $productList[$i]['image'] = $row['image'];
            $productList[$i]['price'] = $row['price'];
            $productList[$i]['is_new'] = $row['is_new'];
            $i++;
        }
        return $productList;
    }

    //Return array of product
    //Для Каталога товаров по определенной категории
    public static function getProductListByCategory($categoryId = false, $page = 1, $type_sort = 1)
    {
        if ($categoryId) {

            $page = intval($page);
            $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

            $db=Db::getConnection();
            $products = array();

            if (!isset($_SESSION['type_sort'])) {
              $_SESSION['type_sort'] = '1';
            }

            if (isset($_POST['sort'])) {
              $_SESSION['type_sort'] = $_POST['sort'];
            }

            switch ($_SESSION['type_sort']) {
              case '1':
              $result = $db->query("SELECT id, name, price, image, is_new FROM product WHERE status = '1' AND category_id = '$categoryId' ORDER BY id DESC LIMIT ".self::SHOW_BY_DEFAULT . ' OFFSET ' . $offset);
              break;

              case '2':
              $result = $db->query("SELECT id, name, price, image, is_new FROM product WHERE status = '1' AND category_id = '$categoryId' ORDER BY price DESC LIMIT ".self::SHOW_BY_DEFAULT . ' OFFSET ' . $offset);
              break;

              case '3':
              $result = $db->query("SELECT id, name, price, image, is_new FROM product WHERE status = '1' AND category_id = '$categoryId' ORDER BY price ASC LIMIT ".self::SHOW_BY_DEFAULT . ' OFFSET ' . $offset);
              break;
              default: 
              $result = $db->query("SELECT id, name, price, image, is_new FROM product WHERE status = '1' AND category_id = '$categoryId' ORDER BY id DESC LIMIT ".self::SHOW_BY_DEFAULT . ' OFFSET ' . $offset);
               break;
            }

            $i = 0;
            while ($row = $result->fetch()) {
                $products[$i]['id'] = $row['id'];
                $products[$i]['name'] = $row['name'];
                $products[$i]['image'] = $row['image'];
                $products[$i]['price'] = $row['price'];
                $products[$i]['is_new'] = $row['is_new'];
                $i++;
            }
            return $products;
        }
    }

    //Возвращает статус выбранной сортировки
    /*public static function getSort($type_sort)
    {
        switch ($_POST['sort']) {
            case '1':
                return '1';
                break;
            case '2':
                return '2';
                break;
            case '3':
                return '3';
                break;
            default:
                return '1';
                break;
        }
    }*/



    //Вернет продукт по идентификатору
    public static function getProductById($id)
    {
        $id = intval($id);

        if ($id) {
           $db=Db::getConnection();

           $result = $db->query("SELECT * FROM product WHERE id = " .$id);
           $result->setFetchMode(PDO::FETCH_ASSOC);

           return $result->fetch();
       }
   }

   //Подсчитает и вернет общее колличество товара определенной категории
   public static function getTotalProductInCategory($categoryId)
   {
        $db=Db::getConnection();

        $result = $db->query('SELECT count(id) AS count FROM product WHERE status="1" AND category_id = "'.$categoryId. '"');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];
   }

   public static function getProductsByIds($idsArray)
    {
        $products = array();

        $db=Db::getConnection();

        $idsString = implode(',', $idsArray);

        $sql = "SELECT * FROM product WHERE status ='1' AND id IN ($idsString)";

        $result = $db->query($sql);

        $result->setFetchMode(PDO::FETCH_ASSOC);

        $i = 0;
        while ($row = $result->fetch()) {
           $products[$i]['id'] = $row['id'];
           $products[$i]['code'] = $row['code'];
           $products[$i]['name'] = $row['name'];
           $products[$i]['price'] = $row['price'];
           $i++;
       }
       return $products;
   }

   //Возвращает список рекомендуемых товаров
   public static function getRecommendedProducts()
   {
    //Соединение с БД
     $db=Db::getConnection();

     //Получение и возврат результатов
     $result = $db->query('SELECT id, name, price, is_new FROM product WHERE status = "1" AND is_recommended = "1" ORDER BY id DESC');

     $i = 0;
     $productList = array();
        while ($row = $result->fetch()) {
           $productList[$i]['id'] = $row['id'];
           $productList[$i]['name'] = $row['name'];
           $productList[$i]['price'] = $row['price'];
           $productList[$i]['is_new'] = $row['is_new'];
           $i++;
       }
       return $productList;
   }


     //Возвращает список товаров
    public static function getProductsList()
    {
        // Соединение с БД
        $db = Db::getConnection();
        //Запрос к БД
        $result = $db->query('SELECT id, category_id, name, price, code FROM product ORDER BY id ASC');
        // Получение и возврат результатов
        $productsList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['category_id'] = $row['category_id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['code'] = $row['code'];
            $productsList[$i]['price'] = $row['price'];
            $i++;
        }
        return $productsList;
    }

    //Добавляет новый товар
    public static function createProduct($options)
    {
      //Соединение с БД
      $db = Db::getConnection();

      //Текст запроса к БД
      $sql = 'INSERT INTO product (name, code, price, category_id, brand, availability, description, is_new, is_recommended, status, size, mass, work_temp, sensitivity, voltage, place, other_characteristics) VALUES (:name, :code, :price, :category_id, :brand, :availability, :description, :is_new, :is_recommended, :status, :size, :mass, :work_temp, :sensitivity, :voltage, :place, :other_characteristics)';

      //Получение и возврат результатов используя подготовленный запрос
     $result = $db->prepare($sql);
     $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
     $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
     $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
     $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
     $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
     $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
     $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
     $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
     $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
     $result->bindParam(':status', $options['status'], PDO::PARAM_INT);

     $result->bindParam(':size', $options['size'], PDO::PARAM_STR);
     $result->bindParam(':mass', $options['mass'], PDO::PARAM_STR);
     $result->bindParam(':work_temp', $options['work_temp'], PDO::PARAM_STR);
     $result->bindParam(':sensitivity', $options['sensitivity'], PDO::PARAM_STR);
     $result->bindParam(':voltage', $options['voltage'], PDO::PARAM_STR);
     $result->bindParam(':place', $options['place'], PDO::PARAM_STR);
     $result->bindParam(':other_characteristics', $options['other_characteristics'], PDO::PARAM_STR);
     if($result->execute()) {
      //Если запрос выполнен успешно, возвращаем Id добавленной записи
      return $db->lastInsertId();
     }
     //Иначе возвращаем 0
     return 0;
    }

    //Редактировать товар с заданным Id
    public static function updateProductById($id, $options)
    {
      //Соединение с БД
      $db = Db::getConnection();

      //Текст запроса к БД
      $sql = "UPDATE product SET name = :name, code = :code, price = :price, category_id = :category_id, brand = :brand, availability = :availability, description = :description, is_new = :is_new, is_recommended = :is_recommended, status = :status, size = :size, mass = :mass, work_temp = :work_temp, sensitivity = :sensitivity, voltage = :voltage, place = :place, other_characteristics = :other_characteristics WHERE id = :id";

      //Получение и возврат результатов используя подготовленный запрос
     $result = $db->prepare($sql);
     $result->bindParam(':id', $id, PDO::PARAM_INT);
     $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
     $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
     $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
     $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
     $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
     $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
     $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
     $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
     $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
     $result->bindParam(':status', $options['status'], PDO::PARAM_INT);

     $result->bindParam(':size', $options['size'], PDO::PARAM_STR);
     $result->bindParam(':mass', $options['mass'], PDO::PARAM_STR);
     $result->bindParam(':work_temp', $options['work_temp'], PDO::PARAM_STR);
     $result->bindParam(':sensitivity', $options['sensitivity'], PDO::PARAM_STR);
     $result->bindParam(':voltage', $options['voltage'], PDO::PARAM_STR);
     $result->bindParam(':place', $options['place'], PDO::PARAM_STR);
     $result->bindParam(':other_characteristics', $options['other_characteristics'], PDO::PARAM_STR);
     return $result->execute();
   }

    //Удаляет товар с указанным Id
    public static function deleteProductById($id)
    {
      //Соединение с БД
     $db=Db::getConnection();

     //Текст запроса БД
     $sql = 'DELETE FROM product where id = :id';

     //Получение и возврат результатов используя подготовленный запрос
     $result = $db->prepare($sql);
     $result->bindParam(':id', $id, PDO::PARAM_INT);
     return $result->execute();
    }

    //Возвращает текстовое пояснение наличия товара
    public static function getAvailabilityText($availability)
    {
        switch ($availability) {
            case '1':
                return 'В наличии';
                break;
            case '0':
                return 'Под заказ';
                break;
        }
    }

    //Возвращает путь к изображению
    public static function getImage($id)
    {
        // Название изображения-пустышки
        $noImage = 'no-image.jpg';

        // Путь к папке с товарами
        $path = '/upload/images/products/';

        // Путь к изображению товара
        $pathToProductImage = $path . $id . '.jpg';
        
        if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage)) {
            // Если изображение для товара существует
            // Возвращаем путь изображения товара
            return $pathToProductImage;
        }

        // Возвращаем путь пустого изображения
        return $path . $noImage;
    }

}