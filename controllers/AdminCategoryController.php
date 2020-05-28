<?php

//Управление категориями в панели администратора
class AdminCategoryController extends AdminBase
{

	//Action для страницы управление категриями
	public function actionIndex()
	{   
		//Проверка прав доступа
		self::checkAdmin();

		//Получаем список категорий
		$categoriesList = Category::getCategoriesListAdmin();

		//Подключаем вид
		require_once(ROOT.'/views/admin_category/index.php');
		return true;
	}

	//Action для страницы добавить категорию
	public function actionCreate()
	{
		//Проверка прав доступа
		self::checkAdmin();

		//Обработка формы
		if (isset($_POST['submit'])) {
			//Если форма отправлена
			//Получаем данные из формы
			$name = $_POST['name'];
			$sortOrder = $_POST['sort_order'];
			$status = $_POST['status'];

			//Оибки в форме
			$errors = false;

			//Валидация полей
			if (!isset($name) || empty($name)) {
				$errors[] = 'Заполните поля';
			}

			if ($errors == false) {
				//Если ошибок нет
				//Добавляем новыую категорию
				Category::createCategory($name, $sortOrder, $status);

				//Перенаправляем пользователя на страницу управления категориями
				header("Location: /admin/category");
			}
		}
		//Подключаем вид
		require_once(ROOT.'/views/admin_category/create.php');
		return true;	
	}

	//Action для тсраницы редактировать категорию
	public function actionUpdate($id)
	{
		//Проверка прав доступа
		self::checkAdmin();

		//Получаем данные о конкретной категории
		$category = Category::getCategoryById($id);

		//Обработка формы
		if (isset($_POST['submit'])) {
			//Если форма отправлена
			//Получаем данные из формы редактирования
			$name = $_POST['name'];
			$sortOrder = $_POST['sort_order'];
			$status = $_POST['status'];

			//Сохраняем изменения
			Category::updateCategoryById($id, $name, $sortOrder, $status);

			//Пернаправляем пользователя на страницу управления категориями
			header("Location: /admin/category");
		}
		//Подключаем вид
		require_once(ROOT.'/views/admin_category/update.php');
		return true;	
	}

	public function actionDelete($id)
	{
		//Проверка прав доступа
		self::checkAdmin();

		//Обработка формы
		if(isset($_POST['submit'])) {
			//Если форма отправлена
			//Удаляем категорию
			Category::deleteCategoryById($id);

			//Перенаправляем пользователя на страницу управления категориями
			header("Location: /admin/category");
		}

		//Подключаем вид
		require_once(ROOT.'/views/admin_category/delete.php');
		return true;
	}
}
