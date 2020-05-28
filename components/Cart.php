<?php

class Cart
{
    
    //Добавление товара в корзину (в массив сессии)
    public static function addProduct($id)
    {
        $id = intval($id);

        //Пустой массив для товаров в корзине
        $productsInCart = array();

        //Если в корзине уже есть товары (они храняться в сессии)
        if (isset($_SESSION['products'])) {
            //То заполняем наш массив товарами
            $productsInCart = $_SESSION['products'];
        }

        //Если товар есть в корзине, но был добавлен еще раз, увеличиваем колличество
        if (array_key_exists($id, $productsInCart)) {
            $productsInCart[$id] ++;
        } else {
            //Добавление нового товара в корзину
            $productsInCart[$id] = 1;
        }

        $_SESSION['products'] = $productsInCart;

        return self::countItems();
    }

    //Добавляение в корзину из товара
    public static function addToCartByProduct($id, $col)
    {
        $id = intval($id);

        //Пустой массив для товаров в корзине
        $productsInCart = array();

        //Если в корзине уже есть товары (они храняться в сессии)
        if (isset($_SESSION['products'])) {
            //То заполняем наш массив товарами
            $productsInCart = $_SESSION['products'];
        }

        //Если товар есть в корзине, но был добавлен еще раз, увеличиваем колличество
        if (array_key_exists($id, $productsInCart)) {
            $productsInCart[$id] += $col;
        } else {
            //Добавление нового товара в корзину
            $productsInCart[$id] = $col;
        }

        $_SESSION['products'] = $productsInCart;

        return self::countItems();
    }

    //Подсчет колличество товаров в корзине (сессии)
    public static function countItems()
    {
        if (isset($_SESSION['products'])) {
            $count = 0;
            foreach ($_SESSION['products'] as $id => $quantity) {
                $count = $count + $quantity;
            }
            return $count;
        } else {
            return 0;
        }
    }

    //Получаем массив с продуктами который храниться в сессии
    public static function getProducts()
    {
        if(isset($_SESSION['products'])) {
            return $_SESSION['products'];
        }
        return false;
    }

    //Получаем общую стоимость товаров
    public static function getTotalPrice($products)
    {
        $productsInCart = self::getProducts();

        if($productsInCart) {
            $total = 0;
            foreach ($products as $item) {
                $total += $item['price'] * $productsInCart[$item['id']];
            }
        }
        return $total;
    }

    //Удаление списка товаров из сесии (очистка списка)
    public static function clear()
    {
        if (isset($_SESSION['products'])) {
            unset($_SESSION['products']);
        }
    }


    //Удаление определенного товара из корзины по Id
    public static function deleteProduct($id)
    {
        // Получаем массив с идентификаторами и количеством товаров в корзине
        $productsInCart = self::getProducts();

        // Удаляем из массива элемент с указанным id
        unset($productsInCart[$id]);
        
        // Записываем массив товаров с удаленным элементом в сессию
        $_SESSION['products'] = $productsInCart;
    }

    //Убрать одну единицу товара из корзины по Id
    public static function deleteoneProduct($id)
    {
        // Получаем массив с идентификаторами и количеством товаров в корзине
        $productsInCart = self::getProducts();

        // Удаляем из массива элемент с указанным id
        $productsInCart[$id] --;

        //Если товаров меньше 0 или 0 удалить товар из корзины
        if ($productsInCart[$id] <= 0) {
            // Удаляем из массива элемент с указанным id
            unset($productsInCart[$id]);
        }
        
        // Записываем массив товаров с удаленным элементом в сессию
        $_SESSION['products'] = $productsInCart;
    }

    //Добавить одну единицу товара из корзины по Id
    public static function addoneProduct($id)
    {
        // Получаем массив с идентификаторами и количеством товаров в корзине
        $productsInCart = self::getProducts();

        // Удаляем из массива элемент с указанным id
        $productsInCart[$id] ++;
        
        // Записываем массив товаров с удаленным элементом в сессию
        $_SESSION['products'] = $productsInCart;

        return self::countItems();
    }

    //Подсчет колличество товаров в корзине (сессии)
    public static function countItem($id)
    {
        echo $_SESSION['products'][$id];
    }


}
