<?php

class Comment
{
    //Получить комментарии по Id комменатрия
    public static function getComment($id) 
    {
        //Соединение с базой данных
        $db = Db::getConnection();

        $commentAll = array();

        $result = $db->query('SELECT * FROM commentary WHERE id_product = '.$id);

        $i = 0;
        while ($row = $result->fetch()) {
            $commentAll[$i]['id'] = $row['id'];
            $commentAll[$i]['user_id'] = $row['user_id'];
            $commentAll[$i]['text_comment'] = $row['text_comment'];
            $commentAll[$i]['id_product'] = $row['id_product'];
            $commentAll[$i]['time'] = $row['time'];
            $i++;
        }

        return $commentAll;
    }

    //Добавить комментарий
    public static function createComment($options)
    {
        //Соединение с базой данных
        $db = Db::getConnection();

        //Текст запроса к БД
        $sql = 'INSERT INTO commentary (user_id, text_comment, id_product) VALUES (:user_id, :text_comment, :id_product)';

        //Получение и возврат результатов используя подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':user_id', $options['user_id'], PDO::PARAM_INT);
        $result->bindParam(':text_comment', $options['text_comment'], PDO::PARAM_STR);
        $result->bindParam(':id_product', $options['id_product'], PDO::PARAM_INT);

        if($result->execute()) {
          //Если запрос выполнен успешно, возвращаем Id добавленной записи
          return $db->lastInsertId();
      }
      //Иначе возвращаем 0
      return 0;
    }

    //Проверка комментария на валидность меньше 5 символов
    public static function checkMinComment($textComment)
    {
        if (strlen($textComment) <=5) {
            return true;
        }
        return false;
    }

    //Проверка комментария на валидность больше 450 символов
    public static function checkMaxComment($textComment)
    {
        if (strlen($textComment) >= 450) {
            return true;
        }
        return false;
    }

    //Удаляет комментарий с указанным Id
    public static function deleteCommentById($id)
    {
      //Соединение с БД
     $db=Db::getConnection();

     //Текст запроса БД
     $sql = 'DELETE FROM commentary where id = :id';

     //Получение и возврат результатов используя подготовленный запрос
     $result = $db->prepare($sql);
     $result->bindParam(':id', $id, PDO::PARAM_INT);
     return $result->execute();
    }
}