<?php

//Управление товарами в панели администратора
class AdminProductController extends AdminBase
{

	//Action для страницы управление товарами
	public function actionIndex()
	{   
		//Проверка прав доступа
		self::checkAdmin();

		//Получаем список товаров
		$productList = Product::getProductsList();

		//Подключаем вид
		require_once(ROOT.'/views/admin_product/index.php');
		return true;
	}

	//Action для страницы добавить товар
	public function actionCreate()
	{
		//Проверка прав доступа
		self::checkAdmin();

		//Получаем список категорий для выпадающего списка
		$categoriesList = Category::getCategoriesListAdmin();

		//Обработка формы
		if (isset($_POST['submit'])) {
			//Если форма отправлена
			//Получаем данные из формы
			$options['name'] = $_POST['name'];
			$options['code'] = $_POST['code'];
			$options['price'] = $_POST['price'];
			$options['category_id'] = $_POST['category_id'];
			$options['brand'] = $_POST['brand'];
			$options['availability'] = $_POST['availability'];
			$options['description'] = $_POST['description'];
			$options['is_new'] = $_POST['is_new'];
			$options['is_recommended'] = $_POST['is_recommended'];
			$options['status'] = $_POST['status'];

			$options['size'] = $_POST['size'];
			$options['mass'] = $_POST['mass'];
			$options['work_temp'] = $_POST['work_temp'];
			$options['sensitivity'] = $_POST['sensitivity'];
			$options['voltage'] = $_POST['voltage'];
			$options['place'] = $_POST['place'];
			$options['other_characteristics'] = $_POST['other_characteristics'];

			//Ошибки в форме
			$errors = false;

			//Валидация полей
			if (!isset($options['name']) || empty($options['name'])) {
				$errors[] = 'Заполните поля';
			}

			if ($errors == false) {
				//Если ошибок нет
				//Добавляем новый товар
				$id = Product::createProduct($options);

				//Если запись добавлена
				if ($id) {
					//Проверим загружалось ли через форму изображение
					if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
						//Если загружалось, переместим его в нужную папку и дадим новое имя
						move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT']."/upload/images/products/{$id}.jpg");
					}
				};

				//Перенаправляем пользователя на страницу управления товарами
				header("Location: /admin/product");
			}
		}
		//Подключаем вид
		require_once(ROOT.'/views/admin_product/create.php');
		return true;	
	}

	//Action для тсраницы редактировать товар
	public function actionUpdate($id)
	{
		//Проверка прав доступа
		self::checkAdmin();

		//Получаем список категорий для выпадающего списка
		$categoriesList = Category::getCategoriesListAdmin();

		//Получаем данные о конкретном товаре
		$product = Product::getProductById($id);

		//Обработка формы
		if (isset($_POST['submit'])) {
			//Если форма отправлена
			//Получаем данные из формы редактирования
			$options['name'] = $_POST['name'];
			$options['code'] = $_POST['code'];
			$options['price'] = $_POST['price'];
			$options['category_id'] = $_POST['category_id'];
			$options['brand'] = $_POST['brand'];
			$options['availability'] = $_POST['availability'];
			$options['description'] = $_POST['description'];
			$options['is_new'] = $_POST['is_new'];
			$options['is_recommended'] = $_POST['is_recommended'];
			$options['status'] = $_POST['status'];

			$options['size'] = $_POST['size'];
			$options['mass'] = $_POST['mass'];
			$options['work_temp'] = $_POST['work_temp'];
			$options['sensitivity'] = $_POST['sensitivity'];
			$options['voltage'] = $_POST['voltage'];
			$options['place'] = $_POST['place'];
			$options['other_characteristics'] = $_POST['other_characteristics'];
			//Сохраняем изменения
			if (Product::updateProductById($id, $options)) {

				//Если форма сохранена
				//Проверяем загружалось ли изображение через форму
				if (is_uploaded_file($_FILES["image"]["tmp_name"])) {

					//Если загружалось, переместим его в нужную папку, дадим новое имя
					move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT']."/upload/images/products/{$id}.jpg");
				}
			}

			//Пернаправляем пользователя на страницу управления товарами
			header("Location: /admin/product");
		}
		//Подключаем вид
		require_once(ROOT.'/views/admin_product/update.php');
		return true;	
	}

	public function actionDelete($id)
	{
		//Проверка прав доступа
		self::checkAdmin();

		//Обработка формы
		if(isset($_POST['submit'])) {
			//Если форма отправлена
			//Удаляем товар
			Product::deleteProductById($id);

			//Перенаправляем пользователя на страницу управления товарами
			header("Location: /admin/product");
		}

		//Подключаем вид
		require_once(ROOT.'/views/admin_product/delete.php');
		return true;
	}

}
