<?php

class BlogController
{
    public function actionIndex()
    {   
    	//Список постов
			$latestPost = array();
			$latestPost = Blog::getBlogPosts(); 

      require_once(ROOT . '/views/blog/index.php');
      return true;
    }

    //Просмотр определенного поста
    public function actionView($postId)
    {   
    	//Нужный пост по Id
			$post = Blog::getPostById($postId); 

      require_once(ROOT . '/views/blog/view.php');
      return true;
    }
}
