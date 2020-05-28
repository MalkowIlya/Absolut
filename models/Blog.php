<?php

class Blog
{

    //Получить список со статьями
    public static function getBlogPosts()
    {
        $db=Db::getConnection();
        $postList = array();

        $result = $db->query('SELECT id, name, image, text_post, time, small_description FROM blog WHERE status = "1" ORDER BY id DESC');

        $i = 0;
        while ($row = $result->fetch()) {
            $postList[$i]['id'] = $row['id'];
            $postList[$i]['name'] = $row['name'];
            $postList[$i]['image'] = $row['image'];
            $postList[$i]['text_post'] = $row['text_post'];
            $postList[$i]['time'] = $row['time'];
            $postList[$i]['small_description'] = $row['small_description'];
            $i++;
        }
        return $postList;
    }

    //Получить статьи для админа
    public static function getBlogPostsAdmin()
    {
        $db=Db::getConnection();
        $postList = array();

        $result = $db->query('SELECT id, name, image, text_post, time, small_description FROM blog ORDER BY id ASC');

        $i = 0;
        while ($row = $result->fetch()) {
            $postList[$i]['id'] = $row['id'];
            $postList[$i]['name'] = $row['name'];
            $postList[$i]['image'] = $row['image'];
            $postList[$i]['text_post'] = $row['text_post'];
            $postList[$i]['time'] = $row['time'];
            $postList[$i]['small_description'] = $row['small_description'];
            $i++;
        }
        return $postList;
    }

    //Вернет пост по идентификатору
    public static function getPostById($id)
    {
        $id = intval($id);

        if ($id) {
           $db=Db::getConnection();

           $result = $db->query("SELECT * FROM blog WHERE id = " .$id);
           $result->setFetchMode(PDO::FETCH_ASSOC);

           return $result->fetch();
       }
    }

    //Удалит пост по идентификатору
    public static function deletePostById($id)
    {
         //Соединение с БД
        $db=Db::getConnection();    

        //Текст запроса БД
        $sql = 'DELETE FROM blog where id = :id';

        //Получение и возврат результатов используя подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }


    //Добавляет новыую статью
    public static function createPost($options)
    {
        //Соединение с БД
        $db = Db::getConnection();
        //Текст запроса к БД
        $sql = 'INSERT INTO blog (name, small_description, text_post, status) VALUES (:name, :small_description, :text_post, :status)';
    
        //Получение и возврат результатов используя подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':small_description', $options['small_description'], PDO::PARAM_STR);
        $result->bindParam(':text_post', $options['text_post'], PDO::PARAM_STR);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        if($result->execute()) {
         //Если запрос выполнен успешно, возвращаем Id добавленной записи
         return $db->lastInsertId();
        }
        //Иначе возвращаем 0
        return 0;
    }

    //Редактировать статью с заданным Id
    public static function updatePostById($id, $options)
    {
        //Соединение с БД
        $db = Db::getConnection();

        //Текст запроса к БД
        $sql = "UPDATE blog SET name = :name, small_description = :small_description, text_post = :text_post, status = :status WHERE id = :id";

        //Получение и возврат результатов используя подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':small_description', $options['small_description'], PDO::PARAM_STR);
        $result->bindParam(':text_post', $options['text_post'], PDO::PARAM_STR);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        return $result->execute();
    }

    //Возвращает путь к изображению
    public static function getImage($id)
    {
        //Название изображения-пустышки
        $noImage = 'no-image.jpg';

        //Путь к папке с товарами
        $path = '/upload/images/blog/';

        //Путь к изображению статьи
        $pathToPostImage = $path . $id . '.jpg';
        
        if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToPostImage)) {
            //Если изображение для статьи существует
            //Возвращаем путь изображения статьи
            return $pathToPostImage;
        }

        //Возвращаем путь пустого изображения
        return $path . $noImage;
    }
}