<?php

class User
{
    public static function register($name, $email, $password) 
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO user (name, email, password) VALUES (:name, :email, :password)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);

        return $result->execute();
    }
    
    public static function edit($id, $name, $password, $phone_number)
    {
        $db = Db::getConnection();

        $sql = "UPDATE user SET name = :name, password = :password, phone_number = :phone_number WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->bindParam(':phone_number', $phone_number, PDO::PARAM_STR);
        return $result->execute();
    }

    //Проверяем существует ли пользователь с заданными email и password
    //return mixed: integer user id or false
    public static function checkUserData($email, $password)
    {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM user WHERE email = :email AND password = :password';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_INT);
        $result->bindParam(':password', $password, PDO::PARAM_INT);
        $result->execute();

        $user = $result->fetch();
        if($user) {
            return $user['id'];
        }
        return false;
    }

    //Запоминаем пользователя
    public static function auth($userId)
    {
        //запуск сессии
        $_SESSION['user'] = $userId;
    }

    //Проверить авторизирован ли пользователь, для отображения нужных кнопок в header (гость или не гость)
    public static function isGuest()
    {
        //запуск сессии
        //Если сессия есть, вернем идентификатор пользователя
        if (isset ($_SESSION['user'])) {
            return false;
        }
        return true;
    }

    //Проверка что пользователь авторизован - для доступа к кабинету
    public static function checkLogged()
    {
        //запуск сессии
        //Если сессия есть, вернется id пользователя
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }

        header("Location: /user/login");
    }


    //Проверка имени - не менее 2-х символов
    public static function checkName($name) {
        if (strlen($name) >=2) {
            return true;
        }
        return false;
    }

    //Проверка пароль - не менее 6-ти символов
    public static function checkPassword($password) {
        if (strlen($password) >=6) {
            return true;
        }
        return false;
    }

    //Проверка email
    public static function checkEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    //Проверка номера телефона
    public static function checkPhone($phone) {
        if (strlen($phone) >=7) {
            return true;
        }
        return false;
    }

    //Проверка что такой email уже не зарегистрирован
    public static function checkEmailExists($email) {

        $db = Db::getConnection();

        $sql = 'SELECT count(*) FROM user WHERE email = :email';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if($result->fetchColumn())
            return true;
        return false;
    }

    public static function getUserById($id)
    {
        if ($id) {
            $db = Db::getConnection();
            $sql = 'SELECT * FROM user WHERE id = :id';

            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);

            //Указываем что хотим получить данные в виде массива
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();

            return $result->fetch();
        }
    }


    //Метод которй проверяет на то, что пользователь администратор для пользовательской части
    public static function checkAdminUser()
    {
        //Проверяем авторизован ли пользователь
        if (isset($_SESSION['user'])) {
            $userId = $_SESSION['user'];

            //Получаем информацию о текущем пользователе
            $user = User::getUserById($userId);

            //Если текущий пользователь администратор, то пускаем его в панель
            if ($user['role'] == 'admin') {
                return true;
            }
        } 
    }

    //Поиск заказов из БД, для отображения в кабинете
    public static function checkOrder($id)
    {
        $id = intval($id);

        if ($id) {
            $db = Db::getConnection();

            //Получение и возврат результатов
            $sql = 'SELECT * FROM product_order WHERE user_id ='.$id.' ORDER BY id DESC';
            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            $result->execute();

            $i = 0;
            $orderList = array();
            while ($row = $result->fetch()) {
             $orderList[$i]['id'] = $row['id'];
             $orderList[$i]['user_name'] = $row['user_name'];
             $orderList[$i]['user_phone'] = $row['user_phone'];
             $orderList[$i]['user_comment'] = $row['user_comment'];
             $orderList[$i]['user_id'] = $row['user_id'];
             $orderList[$i]['date'] = $row['date'];
             $orderList[$i]['products'] = $row['products'];
             $orderList[$i]['status'] = $row['status'];
             switch ($orderList[$i]['status']) {
                case '1':
                     $orderList[$i]['status'] = 'Новый заказ';
                     break;

                case '2':
                     $orderList[$i]['status'] = 'В обработке';
                     break;

                case '3':
                     $orderList[$i]['status'] = 'Выполняется';
                     break;

                case '4':
                     $orderList[$i]['status'] = 'Закрыт';
                     break;
                 
                 default:
                     $orderList[$i]['status'] = 'Новый заказ';
                     break;
             }
             $i++;
         }
         return $orderList;

            /*$sql = 'SELECT * FROM product_order WHERE user_id = :id';

            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);

            //Указываем что хотим получить данные в виде массива
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();

            return $result->fetch();*/
        }
    }

    //Получить заказы
    public static function checkOrderById($id) 
    {
        $id = intval($id);

        if ($id) {
            $db = Db::getConnection();

            //Получение и возврат результатов
            $sql = 'SELECT * FROM product_order WHERE user_id = :id';
            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);

            //Указываем, что хотим получить данные в виде массива
            $result->setFetchMode(PDO::FETCH_ASSOC);

            //Выполняем запрос
            $result->execute();
            //Возвращаем данные
            return $result->fetch();
        }
    }
}