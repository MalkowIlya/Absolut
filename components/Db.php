<?php

class Db
{
    
    public static function getConnection()
    {
        $paramsPath = ROOT . '/config/db_params.php';
        $params = include($paramsPath);
        
        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        //Проверка на соединение с базой данных
        try {
        	$db = new PDO($dsn, $params['user'], $params['password']);
        }
        catch(PDOException $e) {  
            echo "Нет соединения с базой данных";  
        }
        
        $db->exec("set names utf8");
        
        return $db;
    }

}
