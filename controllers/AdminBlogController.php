<?php

//Управление блогом в панели администратора
class AdminBlogController extends AdminBase
{

	//Action для страницы управление блогом
	public function actionIndex()
	{   
		//Проверка прав доступа
		self::checkAdmin();

		//Получаем список товаров
		$postList = Blog::getBlogPostsAdmin();

		//Подключаем вид
		require_once(ROOT.'/views/admin_blog/index.php');
		return true;
	}

	//Удалениее статьи по Id
	public function actionDelete($id)
	{
		//Проверка прав доступа
		self::checkAdmin();

		//Обработка формы
		if(isset($_POST['submit'])) {
			//Если форма отправлена
			//Удаляем статью
			Blog::deletePostById($id);

			//Перенаправляем пользователя на страницу управления блогом
			header("Location: /admin/blog");
		}

		//Подключаем вид
		require_once(ROOT.'/views/admin_blog/delete.php');
		return true;
	}

	//Добавление новой статьи
	public function actionCreate()
	{
		//Проверка прав доступа
		self::checkAdmin();

		//Обработка формы
		if (isset($_POST['submit'])) {
			//Если форма отправлена
			//Получаем данные из формы
			$options['name'] = $_POST['name'];
			$options['small_description'] = $_POST['small_description'];
			$options['text_post'] =$_POST['text_post'];
			$options['status'] = $_POST['status'];


			//Оибки в форме
			$errors = false;

			//Валидация полей
			if (!isset($options['name']) || empty($options['name'])) {
				$errors[] = 'Заполните поля';
			}

			if ($errors == false) {
				//Если ошибок нет
				//Добавляем новый товар
				$id = Blog::createPost($options);

				//Если запись добавлена
				if ($id) {
					//Проверим загружалось ли через форму изображение
					if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
						//Если загружалось, переместим его в нужную папку и дадим новое имя
						move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT']."/upload/images/blog/{$id}.jpg");
					}
				};

				//Перенаправляем пользователя на страницу управления товарами
				header("Location: /admin/blog");
			}
		}
		//Подключаем вид
		require_once(ROOT.'/views/admin_blog/create.php');
		return true;	
	}

	//Редактировать статью
	public function actionUpdate($id)
	{
		//Проверка прав доступа
		self::checkAdmin();

		//Получаем данные о конкретной статье
		$post = Blog::getPostById($id);

		//Обработка формы
		if (isset($_POST['submit'])) {
			//Если форма отправлена
			//Получаем данные из формы редактирования
			$options['name'] = $_POST['name'];
			$options['small_description'] = $_POST['small_description'];
			$options['text_post'] = $_POST['text_post'];
			$options['status'] = $_POST['status'];

			//Сохраняем изменения
			if (Blog::updatePostById($id, $options)) {

				//Если форма сохранена
				//Проверяем загружалось ли изображение через форму
				if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
					//Если загружалось, переместим его в нужную папку, дадим новое имя
					move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT']."/upload/images/blog/{$id}.jpg");
				}
			}

			//Пернаправляем пользователя на страницу управления блогом
			header("Location: /admin/blog");
		}
		//Подключаем вид
		require_once(ROOT.'/views/admin_blog/update.php');
		return true;	
	}
}